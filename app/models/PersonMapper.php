<?php 
    require_once __DIR__.'/Interfaces/PersonInterface.php';

    class PersonMapper implements PersonInterface{
        protected $adapter;
    
        public function __construct(DatabaseAdapterInterface $adapter) {
            $this->adapter = $adapter;
        }
    
        
        function setPerson(PersonDto $personDto){

            $personDtoArray = $personDto->toArray();
            $this->adapter->getConnection();
            return $this->adapter->insert('person', $personDtoArray);
        }

        public function getPersonById($personId) {
            $query = "SELECT * FROM person WHERE id = :id";
            $params = [':id' => $personId];
    
            $result = $this->adapter->fetch($query, $params);
    
            if ($result) {
                $personDto = new PersonDto();
                $personDto->id = $result['id'];
                $personDto->firstName = $result['firstName'];
                $personDto->lastName = $result['lastName'];
                $personDto->phone = $result['phone'];
                $personDto->email = $result['email'];
                $personDto->personNumber = $result['personNumber'];
                $personDto->gender = $result['gender'];
                $personDto->isAvailable = $result['isAvailable'];
    
                return $personDto;
            } else {
                return null;
            }
        }
    
        public function updatePerson(PersonDto $personDto) {
            $personDtoArray = $personDto->toArray();
            $conditions = ['id' => $personDto->id];
    
            return $this->adapter->update('person', $personDtoArray, $conditions);
        }

        public function getAllPersons() {
            return $this->adapter->getAllPersons();
        }
    }
    