<?php
/**
* Student
* Contains the information of a student
*/
class Student {
  /**
  * @var int
  */
  private $studentId;

  /**
  * @var string
  */
  private $name;


  /**
  * @param int $studentId
  * @param string $name
  */
  public function __construct( $studentId, $name ) {

    $this->studentId = $studentId;
    $this->name = $name;

  }

  /**
  * @return int $this->studentId
  */
  public function getStudentId() {

    return $this->studentId;

  }

  /**
  * @return string $this->name
  */
  public function getName() {

    return $this->name;

  }

}
