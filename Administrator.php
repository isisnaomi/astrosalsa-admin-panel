<?php

abstract class Administrator{

  private $databaseManager = new DataBaseManager;
  private $viewNotifier = new ViewNotifier;


  public function __construct(){

  }

  protected function receiveRequest($request){

  }

  protected function addEntity($data){

  }
  protected function editEntity($filter){

  }
  protected function deleteEntity($filter){

  }
  protected function getEntity($filter){

  }
  protected function notifyView(){

  }




}



?>
