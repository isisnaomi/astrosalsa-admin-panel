<?php

/**
* StudentAdministrator
* Administrates the students
*/
class StudentsAdministrator extends Administrator {

  public function __construct() {

    parent::__construct( 'students' );

  }

  protected function getStudentByName( $taskData ) {
    $this->accessDatabase();
    $attributes = ["*" => "*"];
    $rowFilters = "name=".$taskData['name'];

    $isTaskSuccessful = $this->databaseAccessor->selectRows( $attributes, $rowFilters );

    return $this->writeReport( $isTaskSuccessful );
  }

  protected function getStudentByID( $taskData ) {
    $this->accessDatabase();
    $attributes = ["*" => "*"];
    $rowFilters = "id=".$taskData['id'];

    $isTaskSuccessful = $this->databaseAccessor->selectRows( $attributes, $rowFilters );

    return $this->writeReport( $isTaskSuccessful );

  }

}
