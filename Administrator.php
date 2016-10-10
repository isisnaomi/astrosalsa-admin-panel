<?php

abstract class Administrator{

  private $database = new DataBase;
  private static $databaseName


  public function __construct() {


  }

  public function accessDatabase(){
    $isAccessSucessful = database->connect();
    return $isAccessSucessful;
  }


  public function assignTask ( $taskType, $taskData ) {
    $report = new Report();

    switch ($taskType) {
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


    $isTaskSucessful = database->insertRow( $dataBaseName, $taskData );

    if ($isTaskSucessful){
      $report = new Report( "data", null );

    }
    else{
      $report = new Report( "error", ["errorDescription"=> "No se pudo agregar el elemento" ] );
    }


  }

  protected function update( $taskData ){

  }
  protected function delete( $taskData ){

  }
  protected function getList( $taskData ){

  }


}
