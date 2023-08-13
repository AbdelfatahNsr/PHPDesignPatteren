<?php
    use PHPUnit\Framework\TestCase;
        
    class PersonModelIntegrationTest extends TestCase {
        public function testSetPerson() {

            $inMemoryDb = new InMemoryDatabase();

            $connection = new Connection();
            $connection->setDatabase($inMemoryDb); 

            $personModel = new PersonModel($connection);

            $result = $personModel->setPerson(new PersonDto(/*...*/));

            $this->assertTrue($result);
            $this->assertCount(1, $inMemoryDb->getData('person')); 
        }
        
        public function testUpdatePerson() {
            
            $inMemoryDb = new InMemoryDatabase();

            $connectionMock = $this->createMock(Connection::class);
            $connectionMock->method('executeQuery')->willReturn(true);
    

            $connectionMock->expects($this->once())
                ->method('executeQuery')
                ->willReturn(true);

            $personModel = new PersonModel($connectionMock);
    

            $inMemoryDb->insert('person', ['id' => 1, 'name' => 'John']);

            $updatedPerson = new PersonDto(/*...*/);

            $result = $personModel->updatePerson(1, $updatedPerson);

            $this->assertTrue($result);
    
            
            $updatedData = $inMemoryDb->getData('person')[0];
            $this->assertEquals('Updated Name', $updatedData['name']);
        }
    }
    
    class InMemoryDatabase {
        private $data = [];
    
        public function insert($table, $data) {
            $this->data[$table][] = $data;
        }
    
        public function getData($table) {
            return $this->data[$table] ?? [];
        }
    }