<?php

abstract class Administrator{

  private $database = new DataBase;
  private $viewNotifier = new ViewNotifier;


  public function __construct(){

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

  abstract protected function addEntity($data);
  abstract protected function editEntity($filter);
  abstract protected function deleteEntity($filter);
  abstract protected function getEntity($filter);
  abstract protected function notifyView();




}



?>
