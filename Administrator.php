<?php

abstract class Administrator{

  private $database = new DataBase;
  private $viewNotifier = new ViewNotifier;

  private $tableName;



  public function __construct(){
    database->establishConnection;
  }


  public function receiveRequest($request){
    $requestType=$request[0];

    switch ($requestType) {
      case 'addEntity' :
          addEntity($request);
          break ;
      case 'editEntity' :
          editEntity($request);
          break ;
      case 'deleteEntity' :
          deleteEntity($request);
          break ;
      case 'getEntity' :
          getEntity($request);
          break ;
 }


  }

  //$data =array(requestType,row)
  protected function addEntity($data){
    $row = $data[1];

    database->insertRow($tableName, $row);

  }
  abstract protected function editEntity($filter);
  abstract protected function deleteEntity($filter);
  abstract protected function getEntity($filter);
  abstract protected function notifyView();




}



?>
