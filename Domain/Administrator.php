<?php

require_once '../Domain/DatabaseAccessor.php';
require_once '../Domain/Report.php';
require_once '../Control/ActivityLogger.php';

/**
* Administrator
* Abstract class
* Defines the behavior of all Administrators in Domain
*/
abstract class Administrator {

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
        case 'getAssistanceLog' :
            $report = $this->getAssistanceLog( $taskData );
            break;
        case 'getPaymentLog' :
            $report = $this->getPaymentLog( $taskData );
            break;
        case 'checkIn' :
            $report = $this->decrementClassesRemaining( $taskData );
            break;

        case 'payment' :
            $report = $this->renewSubscription( $taskData );
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
    $isTaskSuccessful = $this->databaseAccessor->insertRow( $taskData );
    $stamp = 'add ' . $this->tableName;

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
    $isTaskSuccessful = $this->databaseAccessor->updateRow( $attributes, $rowFilters );
    $stamp = 'update ' . $this->tableName;

    return $this->writeReport( $isTaskSuccessful, $stamp );

  }

  /**
  * @param  string  $taskData
  * @return Report  $report
  */
  protected function delete( $taskData ) {

    $this->accessDatabase();
    $isTaskSuccessful = $this->databaseAccessor->deleteRow( $taskData );
    $stamp = 'delete ' . $this->tableName;

    return $this->writeReport( $isTaskSuccessful, $stamp );
  }

  /**
  * @param  string[] $taskData
  * @return Report  $report
  */
  protected function getList( $taskData ) {

    $this->accessDatabase();
    $databaseResponse = $this->databaseAccessor->selectRows( $taskData );
    $stamp = 'get ' . $this->tableName;

    return $this->writeReport( $databaseResponse, $stamp );

  }

  /**
   * @param mixed $databaseResponse
   * @return Report $report
   */
  protected function writeReport( $databaseResponse, $stamp ) {

    if ( $databaseResponse ) {

      $reportType = 'data';
      $reportContent = $databaseResponse;
      $report = new Report( $reportType, $reportContent );
      $this->logActivity( $stamp );

    } else {

      $reportType = 'error';
      $errorDescription = $this->databaseAccessor->getErrorMessage();
      $reportContent = [ 'errorDescription' => $errorDescription ];
      $report = new Report( $reportType, $reportContent );

    }

    return $report;

  }

  protected abstract function logActivity( $stamp );


  /**
  * @return boolean  $isAccessSuccessful
  */
  protected function accessDatabase() {

    $this->databaseAccessor = new DatabaseAccessor( 'astrosalsa', $this->tableName );
    $isAccessSuccessful = $this->databaseAccessor->connect( 'root' );
    return $isAccessSuccessful;

  }

}
