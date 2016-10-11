<?php

require_once '../Domain/Database.php';
require_once '../Domain/Report.php';

abstract class Administrator {

  private $database;
  private static $tableName;

  public function __construct( $tableName ) {

    $this->tableName = $tableName;

  }

  public function accessDatabase() {

    $this->database = new DataBase( 'astrosalsa' );
    $isAccessSucessful = $this->database->connect( 'root' );
    return $isAccessSucessful;

  }

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

  }

  protected function delete( $taskData ) {

  }

  protected function getList( $taskData ) {

  }

}
