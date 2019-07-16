<?php

class User
{
//  private $id;
  private $name;
  private $lastName;
  private $email;
  private $dni;
  private $passwd;
  private $address;
  private $barrio;
  private $image;
  private $phone;
  private $registrationDate;


        public function __construct()
        {
          $this->registrationDate = date('Y-m-d H:i:s');
        //  $this->registrationDate = new DateTime;

        }
        public function setName (string $name) {
          $this->name = $name;
        }
        public function setLastName (string $lastName){
          $this->lastName = $lastName;
        }

        public function setEmail(string $email)
        {
            $this->email = $email;
        }
        public function setDni (string $dni){
          $this-> dni = $dni;
        }

        public function setPassword(string $passwd) {
            $this->passwd = password_hash($passwd, PASSWORD_DEFAULT);
        }
        public function setAddress(string $address){
          $this->address = $address;
        }
        public function setBarrio(string $barrio){
          $this->barrio = $barrio;
        }
        public function setImage(string $image){
          $this->image = $image;
        }
        public function setPhone(string $phone){
          $this->phone = $phone;
        }
      /*  public function registrationDate()
        {
            return $this->registrationDate;
        } */
        //public function getId() : int {
          //return $this->id;

        public function getName () : string {
          return $this->name;
        }
        public function getlastName () : string {
          return $this->lastName;
        }
       public function getDni() : string {
          return $this->dni;
        }
        public function getEmail() : string {
            return $this->email;
        }
        public function getPassword() : string {
            return $this->passwd;
        }
        public function getAddress() : string {
          return $this->address;
        }
        public function getBarrio() : string {
          return $this->barrio;
        }
        public function getImage() : string {
          return $this->image;
        }
        public function getPhone() : string {
          return $this->phone;
        }
      public function registrationDate()
        {
            return $this->registrationDate;
        }


  }
