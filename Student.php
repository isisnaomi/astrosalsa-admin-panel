<?php

class Student{
  private $studentId;
  private $name;

  public function __construct($studentId, $name){
    $this->studentId = $studentId;
    $this->name = $name;
  }
  
  public function getStudentId(){
    return $this->studentId;
  }

  public function getName(){
    return $this->name;
  }




}


?>
