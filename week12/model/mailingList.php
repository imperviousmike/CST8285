<?php
class mailingList{
  private $name;
  private $deleted;
  private $phone;
  private $email;
  private $referrer;



  function __construct($name,$deleted,$phone,$email,$referrer){
    $this->name = $name;
    $this->phone = $phone;
    $this->email = $email;
    $this->referrer = $referrer;
    $this->deleted = $deleted;
  }


  function getName(){
    return $this->name;
  }

  function setName($name){
    $this->name = $name;
  }

  function getDeleted(){
    return $this->deleted;
  }

  function setDeleted($deleted){
    $this->deleted = $deleted;
  }

  function getPhone(){
    return $this->phone;
  }

  function setPhone($phone){
    $this->phone = $phone;
  }

  function getEmail(){
    return $this->email;
  }

  function  setEmail($email){
    $this->email = $email;
  }

  function getReferrer(){
    return $this->referrer;
  }

  function setReferrer($referrer){
    $this->referrer = $referrer;
  }



}
