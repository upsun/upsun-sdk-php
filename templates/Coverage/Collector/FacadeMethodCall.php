<?php

namespace Upsun\Coverage\Collector;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

class FacadeMethodCall extends NodeVisitorAbstract
{
    private array $calledMethods = [];
    private string $currentNamespace = '';
    private array $propertyTypes = [];
    private array $useStatements = [];
    private ?string $currentClass = null;

    public function enterNode(Node $node)
    {
        // --- Namespace ---
        if ($node instanceof Node\Stmt\Namespace_) {
            $this->currentNamespace = $node->name ? $node->name->toString() : '';
            $this->useStatements = [];
        }

        // --- Use statements ---
        if ($node instanceof Node\Stmt\Use_) {
            foreach ($node->uses as $use) {
                $alias = $use->alias ? $use->alias->toString() : $use->name->getLast();
                $this->useStatements[$alias] = $use->name->toString();
            }
        }

        // --- current Class ---
        if ($node instanceof Node\Stmt\Class_) {
            $className = $node->name->toString();
            $this->currentClass = $this->currentNamespace
                ? $this->currentNamespace . '\\' . $className
                : $className;
        }

        // --- classic properties ---
        if ($node instanceof Node\Stmt\Property && $node->type) {
            $propertyType = $this->resolveTypeName($node->type);
            if ($propertyType) {
                foreach ($node->props as $prop) {
                    $propertyName = $prop->name->toString();
                    $this->propertyTypes[$propertyName] = $propertyType;
                }
            }
        }

        // --- from constructor ---
        if ($node instanceof Node\Stmt\ClassMethod && $node->name->toString() === '__construct') {
            foreach ($node->params as $param) {
                if ($param->flags !== 0 && $param->type) { // private/protected/public
                    $propertyType = $this->resolveTypeName($param->type);
                    if ($propertyType) {
                        $this->propertyTypes[$param->var->name] = $propertyType;
                    }
                }
            }
        }

        // --- Explicit assign ($this->foo = new BarApi()) ---
        if (
            $node instanceof Node\Expr\Assign &&
            $node->var instanceof Node\Expr\PropertyFetch &&
            $node->var->var instanceof Node\Expr\Variable &&
            $node->var->var->name === 'this' &&
            $node->expr instanceof Node\Expr\New_ &&
            $node->expr->class instanceof Node\Name
        ) {
            $propertyName = $node->var->name->toString();
            $propertyType = $this->resolveClassName($node->expr->class->toString());
            $this->propertyTypes[$propertyName] = $propertyType;
        }

        // --- Method calls using $this->xxx ---
        if (
            $node instanceof Node\Expr\MethodCall &&
            $node->var instanceof Node\Expr\PropertyFetch &&
            $node->var->var instanceof Node\Expr\Variable &&
            $node->var->var->name === 'this'
        ) {
            $propertyName = $node->var->name instanceof Node\Identifier
                ? $node->var->name->toString()
                : null;

            $methodName = $node->name instanceof Node\Identifier
                ? $node->name->toString()
                : null;

            if ($propertyName && $methodName && isset($this->propertyTypes[$propertyName])) {
                $className = $this->propertyTypes[$propertyName];
                $this->calledMethods[] = $className . '::' . $methodName;
            }
        }

        return null;
    }

    private function resolveTypeName(Node $type): ?string
    {
        if ($type instanceof Node\Name) {
            return $this->resolveClassName($type->toString());
        }

        if ($type instanceof Node\UnionType || $type instanceof Node\IntersectionType) {
            $first = $type->types[0] ?? null;
            if ($first instanceof Node\Name) {
                return $this->resolveClassName($first->toString());
            }
        }

        return null;
    }

    private function resolveClassName(string $name): string
    {
        if (isset($this->useStatements[$name])) {
            return $this->useStatements[$name];
        }
        if (!str_contains($name, '\\')) {
            return $this->currentNamespace ? $this->currentNamespace . '\\' . $name : $name;
        }
        return $name;
    }

    public function getCalledMethods(): array
    {
        return $this->calledMethods;
    }
}
