<?php

abstract class Administrator{

  private $database = new DataBase;
  private $viewNotifier = new ViewNotifier;
  private static $databaseName


  public function __construct() {
    database->establishConnection;
  }


  public function assignTask ( $taskType, $taskData ) {


    switch ($taskType) {
      case 'addEntity' :
          addEntity( $taskData );
          break;
      case 'editEntity' :
          editEntity( $taskData );
          break;
      case 'deleteEntity' :
          deleteEntity( $taskData );
          break;
      case 'getEntity' :
          getEntity( $taskData );
          break;

    }

  }


  protected function add($taskData) {

    database->insertRow( $dataBaseName, $taskData );

  }

  abstract protected function edit($filter);
  abstract protected function delete($filter);
  abstract protected function get($filter);
  abstract protected function sendReport(){

    print (json_encode($array));
  }

}
