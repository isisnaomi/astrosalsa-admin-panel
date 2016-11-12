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

    }

    return $report;

  }


  /**
  * @param  string  $taskData
  * @return Report  $report
  */
  protected function add( $taskData ) {

    $reportContent = null;
    $errorDescription = "No se pudo agregar el elemento";

    $this->accessDatabase();

    $isTaskSuccessful = $this->database->insertRow( $this->tableName, $taskData );

    $report = $this->writeReport( $isTaskSuccessful , $reportContent, $errorDescription );

    return $report;

  }


  protected function update( $taskData ) {

    /* TODO */

  }

  protected function delete( $taskData ) {

    /* TODO */

  }

  protected function getList( $taskData ) {

    $this->accessDatabase();
    $isTaskSuccessful = $this->database->selectRows( $this->tableName, $taskData );

    if ( $isTaskSuccessful ) {

      $reportContent = $isTaskSuccessful;
      $isTaskSuccessful = true;

      return $this->writeReport( $isTaskSuccessful , $reportContent );

    } else {

      $isTaskSuccessful = false;
      $errorDescription = $this->database->getErrorMessage();

      return $this->writeReport( $isTaskSuccessful , $errorDescription );

    }

  }

  /**
  * @return boolean  $isAccessSuccessful
  */
  protected function accessDatabase() {

    $this->database = new DataBase( 'astrosalsa' );
    $isAccessSuccessful = $this->database->connect( 'root' );
    return $isAccessSuccessful;

  }

  protected function writeReport( $isTaskSuccessful, $reportContent ) {

    if ( $isTaskSuccessful ) {

      $reportType = 'data';
      $report = new Report( $reportType, $reportContent );

    } else {

      $reportType = 'error';
      $reportContent = [ 'errorDescription'=> $reportContent ];
      $report = new Report( $reportType, $reportContent );

    }

    return $report;

  }

}
