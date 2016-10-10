<?php

require 'Request.php';
require 'Administrator.php';
require 'StudentsAdministrator.php';
require 'ReportSender.php';
require 'Report.php';
require 'Database.php';

class requestReceiver {

  private $request;

  public function __construct() {

  }

  public function delegateRequest() {

    $isThereAValidRequest = $this->lookForARequest();

    if ( $isThereAValidRequest ) {

      $admin;
      $report;
      $request = $isThereAValidRequest;

      switch ( $request->getTarget() ) {

        case 'studentsAdministrator':
          $admin = new studentsAdministrator();
        break;

      }

      $report = $admin->assignTask( $request->getType(), $request->getData() );

      $reportSender = new ReportSender( $report );

      $reportSender->sendReport();

    }

  }

  private function lookForARequest() {

    $method = $_POST;
    $isThereAValidRequest = true;

    $parameters = [
      'target',
      'type',
      'data'
    ];

    foreach ( $parameters as $parameter ) {

      $isParameterNotSet = ! isset( $method[ $parameter ] );
      $isParameterEmpty = $method[ $parameter ] == '';

      $isParameterNotValid = $isParameterNotSet || $isParameterEmpty;

      if ( $isParameterNotValid ) {
        $isThereAValidRequest = false;
        break;
      }

    }

    if ( $isThereAValidRequest ) {

      $requestData = [
        'target' => $method['target'],
        'type' => $method['type'],
        'data' => $method['data']
      ];

      return new Request( $requestData );

    }

    else return false;

  }

}

$requestReceiver = new RequestReceiver();
$requestReceiver->delegateRequest();
