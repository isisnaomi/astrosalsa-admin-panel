<?php
require_once '../Domain/Administrator.php';
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
      $stamp = 'get ' . $this->tableName;

      return $this->writeReport( $isTaskSuccessful, $stamp );
  }

  protected function getStudentByID( $taskData ) {

      $this->accessDatabase();
      $attributes = ["*" => "*"];
      $rowFilters = "id=".$taskData['id'];

      $isTaskSuccessful = $this->databaseAccessor->selectRows( $attributes, $rowFilters );
      $stamp = 'get ' . $this->tableName;

      return $this->writeReport( $isTaskSuccessful, $stamp );

  }

  protected function logStudentInscription(){
      $tableName = 'studentAssistanceLog';
      $activity = [
          'studentId' => $this->databaseAccessor->getLastInsertedId(),
          'date' => date('Y/m/d H:i:s')
      ];

      ActivityLogger::logActivity ( $tableName, $activity );

  }

  protected  function logActivity( $stamp ){

      if( $stamp === 'add students'){

          $this->logStudentInscription();

      }
  }
}
