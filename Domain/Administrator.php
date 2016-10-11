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
  private $database;
  /**
  * @var string
  */
  private static $tableName;

  /**
  * @param string $tableName
  */
  public function __construct( $tableName ) {

    $this->tableName = $tableName;

  }

  /**
  * @return boolean  $isAccessSucessful
  */
  public function accessDatabase() {

    $this->database = new DataBase( 'astrosalsa' );
    $isAccessSucessful = $this->database->connect( 'root' );
    return $isAccessSucessful;

  }

  /**
  * @param  string  $taskType
  * @param  string  $taskData
  * @return Report  $report
  */
  public function assignTask ( $taskType, $taskData ) {

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

    return $report;

  }

  /**
  * @param  string  $taskData
  * @return Report  $report
  */
  protected function add( $taskData ) {

    $this->accessDatabase();

    $isTaskSucessful = $this->database->insertRow( $this->tableName, $taskData );

    if ( $isTaskSucessful ) {

      $report = new Report( 'data', null );

    } else {

      $report = new Report( 'error', ['errorDescription'=> 'No se pudo agregar el elemento'] );

    }

    return $report;

  }


  protected function update( $taskData ) {
    /* TODO */
  }

  protected function delete( $taskData ) {
    /* TODO */
  }

  protected function getList( $taskData ) {
    /* TODO */
  }

}
