<?php
    require_once 'models/PersonMapper.php';
    require_once __DIR__."/../models/Dto/PersonDto.php";
    
    class PersonController {
        protected $personMapper;
        protected $adapter;
    
        public function __construct($adapter) {
            $this->adapter = $adapter;
            $this->personMapper = new PersonMapper($adapter);
        }
    
        public function index() {
            $allPersons = $this->personMapper->getAllPersons();
            include 'views/PersonView.php'; 
            return $allPersons;
        }
    
        public function addAction() {
            $personDto = new PersonDto();
    
            $personDto->firstName = 'John';
            $personDto->lastName = 'Doe';
            $personDto->phone = '123-456-7890';
            $personDto->email = 'john@example.com';
            $personDto->personNumber = 'P12345';
            $personDto->gender = 'Male';
            $personDto->isAvailable = true;
    
            $this->personMapper->setPerson($personDto);
            $allPersons = $this->personMapper->getAllPersons();
            return $allPersons;
        }

        public function updateAction($personId) {

            $existingPerson = $this->personMapper->getPersonById($personId);
            if (!empty($existingPerson->id)) {
                $this->personMapper->updatePerson($existingPerson);
            } 
        }

        public function getAllAction() {
            $allPersons = $this->personMapper->getAllPersons();
            return $allPersons;
        }

    }
    