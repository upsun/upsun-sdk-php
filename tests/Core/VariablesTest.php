<?php

use PHPUnit\Framework\TestCase;
use Upsun\Core\Variables;

class VariablesTest extends TestCase
{
    protected $upsun;

    protected function setUp(): void
    {
        $this->upsun = new Upsun('your_api_key', 'your_api_url');
    }

    public function testListVariables()
    {
        $variables = $this->upsun->variables->list();
        $this->assertIsArray($variables);
    }

    public function testCreateVariable()
    {
        $variableData = ['name' => 'Test Variable', 'value' => 'Test Value'];
        $variable = $this->upsun->variables->create($variableData);
        $this->assertArrayHasKey('id', $variable);
    }

    public function testUpdateVariable()
    {
        $variableId = 1; // Assuming a variable with ID 1 exists
        $updatedData = ['name' => 'Updated Variable', 'value' => 'Updated Value'];
        $variable = $this->upsun->variables->update($variableId, $updatedData);
        $this->assertEquals('Updated Variable', $variable['name']);
    }

    public function testDeleteVariable()
    {
        $variableId = 1; // Assuming a variable with ID 1 exists
        $result = $this->upsun->variables->delete($variableId);
        $this->assertTrue($result);
    }
}