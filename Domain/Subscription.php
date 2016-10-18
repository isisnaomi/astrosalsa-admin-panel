<?php

/**
* Subscription
* Contains the information of a Subscription
*/
class Subscription {

  /**
  * @var int
  */
  private $studentId;

  /**
  * @var int
  */
  private $packageId;

  /**
  * @var int
  */
  private $classesRemaining;

  /**
  * @var int
  */
  private $paymentDay;


  /**
  * @param int $studentId
  * @param int $packageId
  * @param int $classRemaining
  * @param int $paymentDay
  */
  public function __construct( $studentId, $packageId, $classesRemaining, $paymentDay ) {

    $this->studentId = $studentId;
    $this->packageId = $packageId;
    $this->classesRemaining = $classesRemaining;
    $this->paymentDay = $paymentDay;

  }

  /**
	* @return int $this->$studentId
	*/
  public function getStudentId() {

    return $this->$studentId;

  }

  /**
	* @return int $this->$packageId
	*/
  public function getPackageId() {

    return $this->$packageId;

  }

  /**
	* @return int $this->$classesRemaining
	*/
  public function getClassesRemaining() {

    return $this->classesRemaining;

  }

  /**
	* @return int $this->$paymentDay
	*/
  public function getPaymentDay() {

    return $this->$paymentDay;

  }

}
