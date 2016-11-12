<?php

require_once '../Domain/Database.php';
require_once '../Domain/Report.php';

/**
* Administrator
* Absctract class
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
  private static $tableName;

  /**
  * @var Report
  */
  private $report;


  /**
  * @param string $tableName
  */
  public function __construct( $tableName ) {

    $this->tableName = $tableName;

  }

  /**
  * @param  string  $taskType
  * @param  string[][]  $taskData
  */
  public function doTask ( $taskType, $taskData ) {

    $report;

    switch ( $taskType ) {

      case 'add' :
          $report = $this->add( $taskData );
          break;
      case 'edit' :
          $report = $this->edit( $taskData );
          break;
      case 'delete' :
          $report = $this->delete( $taskData );
          break;
      case 'getList' :
          $report = $this->getList( $taskData );
          break;

    }

    $this->report = $report;

  }

  /**
  * @return Report  $report
  */
  public function getReport(){

    return $this->report;

  }

  /**
  * @param  string  $taskData
  * @return Report  $report
  */
  protected function add( $taskData ) {

    $reportContent = null;
    $errorDescription = "No se pudo agregar el elemento";

    $this->accessDatabase();

    $isTaskSucessful = $this->database->insertRow( $this->tableName, $taskData );

    $report = writeReport( $isTaskSucessful , $reportContent, $errorDescription );

    return $report;

  }


  protected function update( $taskData ) {

    /* TODO */

  }

  protected function delete( $taskData ) {

    /* TODO */

  }

  protected function getList( $taskData ) {

    $reportContent = null;
    $errorDescription = "No se pudo recuperar la lista";

    $this->accessDatabase();

    $isTaskSucessful = $this->database->selectRows( $this->tableName, $taskData );

    $report = writeReport( $isTaskSucessful , $reportContent, $errorDescription );

    return $report;

  }

  /**
  * @return boolean  $isAccessSucessful
  */
  protected function accessDatabase() {

    $this->database = new DataBase( 'astrosalsa' );
    $isAccessSucessful = $this->database->connect( 'root' );
    return $isAccessSucessful;

  }

  protected function writeReport( $isTaskSucessful ,$reportContent, $errorDescription ){

    if ( $isTaskSucessful ) {

      $reportType = 'data';
      $report = new Report( $reportType, $reportContent );

    } else {

      $reportType = 'error';
      $reportContent = [ 'errorDescription'=> $errorDescription ];
      $report = new Report( $reportType, $reportContent );

    }

    return $report;

  }

}
