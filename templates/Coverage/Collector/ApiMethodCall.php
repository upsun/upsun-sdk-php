<?php

namespace Upsun\Coverage\Collector;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

class ApiMethodCall extends NodeVisitorAbstract
{
    private array $apiMethods = [];
    private $currentClass = null;
    private $currentNamespace = '';

    public function enterNode(Node $node)
    {
        if ($node instanceof Node\Stmt\Namespace_) {
            $this->currentNamespace = $node->name ? $node->name->toString() : '';
        }

        if ($node instanceof Node\Stmt\Class_) {
            $className = $node->name->toString();
            $this->currentClass = $this->currentNamespace ? $this->currentNamespace . '\\' . $className : $className;
        }

        if ($node instanceof Node\Stmt\ClassMethod && $node->isPublic()) {
            $methodName = $node->name->toString();
            // Ignore constructors
            if ($methodName !== '__construct' && $this->currentClass) {
                $this->apiMethods[] = $this->currentClass . '::' . $methodName;
            }
        }

        return null;
    }

    public function getApiMethods()
    {
        return $this->apiMethods;
    }
}
