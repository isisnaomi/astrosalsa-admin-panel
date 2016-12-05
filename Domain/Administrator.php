<?php

require_once '../Domain/DatabaseAccessor.php';
require_once '../Domain/SubscriptionsAdministrator.php';
require_once '../Domain/StudentsAdministrator.php';
require_once '../Domain/Report.php';
require_once '../Control/ActivityLogger.php';

/**
* Administrator
* Abstract class
* Defines the behavior of all Administrators in Domain
*/
abstract class Administrator {

  const DATABASE_NAME = 'astrosalsa';
  const DATABASE_USER = 'root';
  const DATABASE_PASS = 'root';

  const UNIQUE_ELEMENT = 0;

  /**
  * @var DatabaseAccessor
  */
  protected $databaseAccessor;

  /**
  * @var string
  */
  protected $tableName; /* was static */


  /**
  * @param string $tableName
  */
  public function __construct( $tableName ) {

    $this->tableName = $tableName;

  }

  /**
   * @param $taskType
   * @param $taskData
   * @return Report
   */
  public function doTask ( $taskType, $taskData ) {
    $report = null;

    switch ( $taskType ) {

      case 'add' :
          $report = $this->add( $taskData );
          break;
      case 'update' :
          $report = $this->update( $taskData );
          break;
      case 'delete' :
          $report = $this->delete( $taskData );
          break;
      case 'getList' :
          $report = $this->getList( $taskData );
          break;
      default:
          $report = $this->doSpecificTask( $taskType, $taskData );
          break;
    }

    return $report;

  }

  protected abstract function doSpecificTask( $taskType, $taskData );

  /**
  * @param  string  $taskData
  * @return Report  $report
  */
  protected function add( $taskData ) {

    $this->accessDatabase();
    $databaseResponse = $this->databaseAccessor->insertRow( $taskData );
    $administratorResponse = $databaseResponse;
    $taskType = 'add ' . $this->tableName;

    $report = $this->writeReport( $administratorResponse, $taskType );

    return $report;

  }

  /**
  * @param  string  $taskData
  * @return Report  $report
  */
  protected function update( $taskData ) {

    $this->accessDatabase();
    $attributes = $taskData['attributes'];
    $rowFilters = $taskData['filter'];
    $databaseResponse = $this->databaseAccessor->updateRow( $attributes, $rowFilters );
    $administratorResponse = $databaseResponse;
    $taskType = 'update ' . $this->tableName;

    $report = $this->writeReport( $administratorResponse, $taskType );
    return $report;

  }

  /**
  * @param  string  $taskData
  * @return Report  $report
  */
  protected function delete( $taskData ) {

    $this->accessDatabase();
    $rowFilters = $taskData['filter'];
    $databaseResponse = $this->databaseAccessor->deleteRow( $rowFilters );
    $administratorResponse = $databaseResponse;
    $taskType = 'delete ' . $this->tableName;

    $report = $this->writeReport( $administratorResponse, $taskType );
    return $report;
  }

  /**
  * @param  string[] $taskData
  * @return Report  $report
  */
  protected function getList( $taskData ) {

    $this->accessDatabase();
    $databaseResponse = $this->databaseAccessor->selectRows( $taskData );
    $administratorResponse = $databaseResponse;
    $taskType = 'get ' . $this->tableName;

    $report = $this->writeReport( $administratorResponse, $taskType );
    return $report;

  }

  /**
   * @param mixed $administratorResponse
   * @param $taskType
   * @return Report $report
   */
  protected function writeReport( $administratorResponse, $taskType ) {

    if ( $administratorResponse ) {

      $reportType = 'data';
      $reportContent = $administratorResponse;
      $report = new Report( $reportType, $reportContent );

      $activityType = $taskType;
      $activityData = $administratorResponse;
      $this->logActivity( $activityData, $activityType );

    } else {

      $reportType = 'error';
      $errorDescription = $this->databaseAccessor->getErrorMessage();
      $reportContent = [ 'errorDescription' => $errorDescription ];
      $report = new Report( $reportType, $reportContent );

    }

    return $report;

  }

  protected abstract function logActivity( $activityData, $activityType );

  /**
  * @return boolean  $isAccessSuccessful
  */
  protected function accessDatabase() {

    $this->databaseAccessor = new DatabaseAccessor( self::DATABASE_NAME , $this->tableName );
    $isAccessSuccessful = $this->databaseAccessor->connect( self::DATABASE_USER, self::DATABASE_PASS );
    return $isAccessSuccessful;

  }

}
