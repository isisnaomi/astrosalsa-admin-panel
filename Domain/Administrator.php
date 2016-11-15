<?php

require_once '../Domain/Database.php';
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
  private $tableName; /* was static */


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
    $isTaskSuccessful = $this->database->insertRow( $this->tableName, $taskData );

    return $this->writeReport( $isTaskSuccessful);

  }

  /**
  * @param  string  $taskData
  * @return Report  $report
  */
  protected function update( $taskData ) {

    $this->accessDatabase();
    $attributes = $taskData['attributes'];
    $rowFilters = $taskData['rowFilters'];
    $isTaskSuccessful = $this->database->updateRow( $this->tableName, $attributes, $rowFilters );

    return $this->writeReport( $isTaskSuccessful);

  }

  /**
  * @param  string  $taskData
  * @return Report  $report
  */
  protected function delete( $taskData ) {

    $this->accessDatabase();
    $isTaskSuccessful = $this->database->deleteRow( $this->tableName, $taskData );

    return $this->writeReport( $isTaskSuccessful);
  }

  /**
  * @param  string  $taskData
  * @return Report  $report
  */
  protected function getList( $taskData ) {

    $this->accessDatabase();
    $isTaskSuccessful = $this->database->selectRows( $this->tableName, $taskData );

    return $this->writeReport( $isTaskSuccessful);

  }

  /**
  * @param  string  $taskData
  * @return Report  $report
  */
  protected function writeReport( $isTaskSuccessful ) {

    if ( $isTaskSuccessful ) {

      $reportType = 'data';
      $reportContent = $isTaskSuccessful;
      $report = new Report( $reportType, $reportContent );

    } else {

      $reportType = 'error';
      $errorDescription = $this->database->getErrorMessage();
      $reportContent = [ 'errorDescription' => $errorDescription ];
      $report = new Report( $reportType, $reportContent );

    }

    return $report;

  }

  /**
  * @return boolean  $isAccessSuccessful
  */
  protected function accessDatabase() {

    $this->database = new DataBase( 'astrosalsa' );
    $isAccessSuccessful = $this->database->connect( 'root' );
    return $isAccessSuccessful;

  }

}
