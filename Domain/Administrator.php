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
    $taskType = 'add ' . $this->tableName;

    $report = $this->writeReport( $databaseResponse, $taskType );
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
    $taskType = 'update ' . $this->tableName;

    $report = $this->writeReport( $databaseResponse, $taskType );
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
    $taskType = 'delete ' . $this->tableName;

    $report = $this->writeReport( $databaseResponse, $taskType );
    return $report;
  }

  /**
  * @param  string[] $taskData
  * @return Report  $report
  */
  protected function getList( $taskData ) {

    $this->accessDatabase();
    $databaseResponse = $this->databaseAccessor->selectRows( $taskData );
    $taskType = 'get ' . $this->tableName;

    $report = $this->writeReport( $databaseResponse, $taskType );
    return $report;

  }

  /**
   * @param mixed $databaseResponse
   * @param $taskType
   * @return Report $report
   */
  protected function writeReport( $databaseResponse, $taskType ) {

    if ( $databaseResponse ) {

      $reportType = 'data';
      $reportContent = $databaseResponse;
      $report = new Report( $reportType, $reportContent );

      $activityType = $taskType;
      $activityData = $databaseResponse;
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

    $this->databaseAccessor = new DatabaseAccessor( DATABASE_NAME , $this->tableName );
    $isAccessSuccessful = $this->databaseAccessor->connect( DATABASE_USER, DATABASE_PASS );
    return $isAccessSuccessful;

  }

}
