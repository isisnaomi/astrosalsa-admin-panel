<?php

require_once '../Domain/DatabaseAccessor.php';
require_once '../Domain/Report.php';

/**
* Administrator
* Abstract class
* Defines the behavior of all Administrators in Domain
*/
abstract class Administrator {

  /**
  * @var Database
  */
  protected $database;

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
   * @return null|Report|void
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
      case 'getStudentByName' :
          $report = $this->getStudentByName( $taskData );
          break;
      case 'getStudentByID' :
          $report = $this->getStudentByID( $taskData );
          break;
      case 'getPackageByID' :
          $report = $this->getPackageByID( $taskData );
          break;
      case 'getSubscriptionByPackageID' :
          $report = $this->getSubscriptionByPackageID( $taskData );
          break;
      case 'getSubscriptionByStudentID' :
          $report = $this->getSubscriptionByStudentID( $taskData );
          break;

    }

    return $report;

  }


  /**
  * @param  string  $taskData
  * @return Report  $report
  */
  protected function add( $taskData ) {

    $this->accessDatabase();
    $isTaskSuccessful = $this->database->insertRow( $taskData );
    $taskType = 'add '.tableName;

    return $this->writeReport( $isTaskSuccessful, $stamp );

  }

  /**
  * @param  string  $taskData
  * @return Report  $report
  */
  protected function update( $taskData ) {

    $this->accessDatabase();
    $attributes = $taskData['attributes'];
    $rowFilters = $taskData['rowFilters'];
    $isTaskSuccessful = $this->database->updateRow( $attributes, $rowFilters );
    $taskType = 'update '.tableName;

    return $this->writeReport( $isTaskSuccessful, $stamp );

  }

  /**
  * @param  string  $taskData
  * @return Report  $report
  */
  protected function delete( $taskData ) {

    $this->accessDatabase();
    $isTaskSuccessful = $this->database->deleteRow( $taskData );
    $taskType = 'delete '.tableName;

    return $this->writeReport( $isTaskSuccessful, $stamp );
  }

  /**
  * @param  string[] $taskData
  * @return Report  $report
  */
  protected function getList( $taskData ) {

    $this->accessDatabase();
    $databaseResponse = $this->database->selectRows( $taskData );
    $taskType = 'getList '.tableName;

    return $this->writeReport( $databaseResponse, $stamp );

  }

  /**
   * @param mixed  $databaseResponse
   * @return Report $report
   */
  protected function writeReport( $databaseResponse, $stamp ) {

    if ( $databaseResponse ) {

      $reportType = 'data';
      $reportContent = $databaseResponse;
      $report = new Report( $reportType, $reportContent, $stamp );

    } else {

      $reportType = 'error';
      $errorDescription = $this->database->getErrorMessage();
      $reportContent = [ 'errorDescription' => $errorDescription ];
      $report = new Report( $reportType, $reportContent, $stamp );

    }

    return $report;

  }

  /**
  * @return boolean  $isAccessSuccessful
  */
  protected function accessDatabase() {

    $this->database = new DataBase( 'astrosalsa', $this->tableName );
    $isAccessSuccessful = $this->database->connect( 'root' );
    return $isAccessSuccessful;

  }

}
