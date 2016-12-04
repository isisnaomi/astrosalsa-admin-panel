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

    $report = null;
    switch ( $taskType ) {

      case 'getStudentByName' :
        $report = $this->getStudentByName( $taskData );
        break;

      case 'getStudentById' :
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
      $rowFilters = "name=".$taskData[ 'name' ];
      $databaseResponse = $this->databaseAccessor->selectRows( null, $rowFilters );
      $administratorResponse = $databaseResponse;
      $taskType = 'get ' . $this->tableName;

      $report = $this->writeReport( $administratorResponse, $taskType );
      return $report;

  }

  public function getStudentByID( $taskData ) {

      $this->accessDatabase();
      $rowFilters = "id=".$taskData[ 'id' ];

      $databaseResponse = $this->databaseAccessor->selectRows( null, $rowFilters );

      $taskType = 'get ' . $this->tableName;
      $administratorResponse = $databaseResponse;

      if( $databaseResponse ){

          $administratorResponse = $databaseResponse[ self::UNIQUE ];

      }

      return $this->writeReport( $administratorResponse, $taskType );


  }

  protected function getInscriptionsLog( $taskData ){

    $tableName = 'studentInscriptionLog';
    $loggerResponse = ActivityLogger::getActivityLog( $tableName, $taskData );

    $taskType = 'get '. $this->tableName;
    $report = $this->writeReport( $loggerResponse, $taskType );

    return $report;

    }

  protected function logStudentInscription(){
    $tableName = 'studentInscriptionLog';
    $studentId = $this->databaseAccessor->getLastInsertedId();

    $activity = [

        'studentId' => $studentId,
        'date' => date( 'Y/m/d' )

    ];

    ActivityLogger::logActivity ( $tableName, $activity );

  }

  protected  function logActivity( $activityData, $activityType ){

    if( $activityType === 'add students'){

      $this->logStudentInscription();

    }
  }
}
