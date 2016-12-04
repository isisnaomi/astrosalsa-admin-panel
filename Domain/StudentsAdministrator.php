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
  protected function doSpecificTask( $taskType, $taskData ){
    switch ( $taskType ) {
      case 'getStudentByName' :
        $report = $this->getStudentByName( $taskData );
        break;
      case 'getStudentByID' :
        $report = $this->getStudentByID( $taskData );
        break;
      case 'getInscriptionsLog' :
        $report = $this->getInscriptionsLog( $taskData );
        break;
    }
    return $report;

  }

  public function getStudentByName( $taskData ) {
      $this->accessDatabase();
      $rowFilters = "name=".$taskData['name'];
      $isTaskSuccessful = $this->databaseAccessor->selectRows( null, $rowFilters );
      $stamp = 'get ' . $this->tableName;

      return $this->writeReport( $isTaskSuccessful, $stamp );
  }

  public function getStudentByID( $taskData ) {

      $this->accessDatabase();
      $rowFilters = "id=".$taskData['id'];

      $isTaskSuccessful = $this->databaseAccessor->selectRows( $attributes, $rowFilters );
      $stamp = 'get ' . $this->tableName;
      $isTaskSuccessful = $isTaskSuccessful[0];

      return $this->writeReport( $isTaskSuccessful, $stamp );
  }

  protected function getInscriptionsLog( $taskData ){

    $tableName = 'studentInscriptionLog';
    $databaseResponse = ActivityLogger::getActivityLog( $tableName, $taskData );
    $stamp = 'get '. $this->tableName;

    return $this->writeReport( $databaseResponse, $stamp );

    }

  protected function logStudentInscription(){
    $tableName = 'studentInscriptionLog';
    $activity = [
        'studentId' => $this->databaseAccessor->getLastInsertedId(),
        'date' => date('Y/m/d')
    ];

    ActivityLogger::logActivity ( $tableName, $activity );

  }

  protected  function logActivity( $activityData, $activityType ){

    if( $activityType === 'add students'){

      $this->logStudentInscription();

    }
  }
}
