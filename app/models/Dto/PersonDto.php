<?php

    class PersonDto{
        public $id;
        public $firstName;
        public $lastName;
        public $phone;
        public $email;
        public $personNumber;
        public $gender;
        public $isAvailable;
        
        public function toArray() {
            return [
                'id' => $this->id,
                'firstName' => $this->firstName,
                'lastName' => $this->lastName,
                'phone' => $this->phone,
                'email' => $this->email,
                'personNumber' => $this->personNumber,
                'gender' => $this->gender,
                'isAvailable' => $this->isAvailable,
            ];
        }
    }