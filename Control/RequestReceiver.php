<?php

require_once '../Domain/Request.php';
require_once '../Domain/Administrator.php';
require_once '../Domain/StudentsAdministrator.php';
require_once '../Domain/PackagesAdministrator.php';
require_once '../Domain/SubscriptionsAdministrator.php';

require_once '../Control/ReportSender.php';

class requestReceiver {

  private $request;

  public function __construct() {

  }

  public function delegateRequest() {

    $isThereAValidRequest = $this->lookForARequest();

    if ( $isThereAValidRequest ) {

      $admininstrator;
      $report;

      $request = $isThereAValidRequest;

      switch ( $request->getTarget() ) {

        case 'studentsAdministrator':
          $administrator = new StudentsAdministrator();
        break;

        case 'packagesAdministrator':
          $administrator = new PackagesAdministrator();
        break;

        case 'subscriptionsAdministrator':
          $administrator = new SubscriptionsAdministrator();
        break;

      }

      $report = $administrator->assignTask( $request->getType(), $request->getData() );
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

    } else return false;

  }

}

function Main() {

  $requestReceiver = new RequestReceiver();
  $requestReceiver->delegateRequest();

}

Main();
