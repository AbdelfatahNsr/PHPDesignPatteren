<?php

use PHPUnit\Framework\TestCase;

class StructureManagerTest extends TestCase
{
    public function testAddStructure()
    {
        $mockDatabase = $this->getMockBuilder(Database::class)
            ->disableOriginalConstructor()
            ->getMock();

        $structureManager = new StructureManager($mockDatabase);

        $newStructureData = ['name' => 'Test Structure'];
        $result = $structureManager->addStructure($newStructureData);

        $this->assertTrue($result);
    }
}