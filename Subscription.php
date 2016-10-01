<?php

class Subscription{

  private $studentId;
  private $packageId;
  private $classesRemaining;
  private $paymentDay;

  public function __construct($studentId, $packageId, $classesRemaining, $paymentDay){
    $this->studentId = $studentId;
    $this->packageId = $packageId;
    $this->classesRemaining = $classesRemaining;
    $this->paymentDay = $paymentDay;
  }

  public function getStudentId(){
    return $this->$studentId;
  }

  public function getPackageId(){
    return $this->$packageId;
  }

  public function getClassesRemaining(){
    return $this->classesRemaining;
  }
  
  public function getPaymentDay(){
    return $this->$paymentDay;
  }



}


?>
