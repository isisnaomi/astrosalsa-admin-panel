<?php

$requestedData = $_GET["data"];
switch($requestedData){

  case 'students':
      sendStudentsData();
  break;

  case 'packages':
      sendPackagesData();
  break;

}

function sendStudentsData(){
  $data = [
    'data' => [
      ['IdStudent' => '0001', 'Name' => 'Tontin'],
      ['IdStudent' => '0002', 'Name' => 'Alipo'],
      ['IdStudent' => '0003', 'Name' => 'Chelero'],
      ['IdStudent' => '0004', 'Name' => 'Cremero'],
      ['IdStudent' => '0005', 'Name' => 'Sopero'],
      ['IdStudent' => '0006', 'Name' => 'Sergio el bailador']
    ]
  ];

  header('Content-Type: application/json');
  echo json_encode($data);

}

function sendPackagesData(){
  $data = [
    'data' => [
      ['IdPackage' => '0001', 'ClassesIncluded' => '10', 'Price' => '200'],
      ['IdPackage' => '0002', 'ClassesIncluded' => '20', 'Price' => '500'],
      ['IdPackage' => '0003', 'ClassesIncluded' => '30', 'Price' => '600'],

    ]
  ];

  header('Content-Type: application/json');
  echo json_encode($data);

}
