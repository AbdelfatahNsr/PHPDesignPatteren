<?php
    use PHPUnit\Framework\TestCase;

    class PersonModelTest extends TestCase {
        public function testSetPerson() {
            $databaseMock = $this->createMock(PersonDatabase::class);
    

            $databaseMock->expects($this->once())
                ->method('insert')
                ->willReturn(true);
    
            $personModel = new PersonModel($databaseMock);

            $result = $personModel->setPerson(new PersonDto(/*...*/));

            $this->assertTrue($result);
        }

        public function testSetPerson() {
  
            $connectionMock = $this->createMock(Connection::class);
    
            $connectionMock->expects($this->once())
                ->method('executeQuery')
                ->willReturn(true);
    

            $personModel = new PersonModel($connectionMock);

            $result = $personModel->setPerson(new PersonDto(/*...*/));
    
            $this->assertTrue($result);
        }

    }
// ./vendor/bin/phpunit tests/PersonModelTest.php