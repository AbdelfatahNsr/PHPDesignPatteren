<?php
    require_once "../app/PDODatabaseAdapter.php";
    require_once "../../vendor/autoload.php";
    
    use PHPUnit\Framework\TestCase;
    use PHPUnit\Framework\MockObject\MockObject;
    
   
    class PDODatabaseAdapterTest extends TestCase {
        /**
         * @var PDODatabaseAdapter|MockObject
         */
        private $adapter;
    
        protected function setUp(): void {
            $this->adapter = $this->getMockBuilder(PDODatabaseAdapter::class)
                ->disableOriginalConstructor()
                ->getMock();
        }
    
        public function testGetAllPersons() {
            // Mock the expected return value from fetchAll
            $expectedResult = [
                ['id' => 1, 'firstName' => 'John', 'lastName' => 'Doe'],
                ['id' => 2, 'firstName' => 'Jane', 'lastName' => 'Smith'],
            ];
    
            $this->adapter->expects($this->once())
                ->method('fetchAll')
                ->willReturn($expectedResult);
    
            $persons = $this->adapter->getAllPersons();
    
            $this->assertEquals($expectedResult, $persons);
        }
    }
    