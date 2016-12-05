<?php

require_once '../Domain/Request.php';
require_once '../Domain/Administrator.php';
require_once '../Domain/StudentsAdministrator.php';
require_once '../Domain/ClassPackagesAdministrator.php';
require_once '../Domain/SubscriptionsAdministrator.php';

require_once '../Control/DataTranslator.php';


/**
 * CommunicationHandler
 * Class
 * 1. Filters incoming data and converts it into a Request.
 * 2. Delegates the generated Request to its target (an Administrator).
 * 3. Asks the target Administrator for its Report,
 *    then sends it to the petitioner.
 */
class CommunicationHandler {

  /**
  * @var Request
  */
  private $request;

  /**
  * @var Report
  */
  private $report;

  /**
   * Procedure
   * Looks for request as parameters in the given method.
   * If there are enough parameters to proceed check if they're valid.
   * If all of them are valid saves them as a Request in $this->request.
   *
   * @param $method
   */
  public function receiveRequest( $method ) {

    $isRequestValid = $this->isRequestValid ( $method );

    if ( $isRequestValid ) {

      $requestAsArray = [

        'target' => $method[ 'target' ],
        'type' => $method[ 'type' ],
        'data' => $method[ 'data' ]

      ];

      $this->request = DataTranslator::translateRequest( $requestAsArray );

    } else {

      die( 'There is no valid request.' );

    }

  }

  /**
   * Procedure
   * lookForARequest() checks if parameters are valid (are defined and have value),
   * this function will check if the value is of the expected type and will
   * try to filter malicious data.
   * Each Administrator should check if the received request matches
   * their business rules.
   */
  private function isRequestValid ( $method ) {

    $isThereAValidRequest = true;

    $parameters = [

        'target',
        'type'

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

    return $isThereAValidRequest;

  }

  /**
  * Procedure
  * Delegates the $this->request to its target.
  * Sets that target as $this->administratorWatching.
  */
  public function delegateRequest() {

    $targetAdministrator = $this->request->getTarget();
    $administratorInCharge = null;

    switch ( $targetAdministrator ) {

      case 'studentsAdministrator' :
        $administratorInCharge = new StudentsAdministrator();
        break;

      case 'classPackagesAdministrator' :
        $administratorInCharge = new ClassPackagesAdministrator();
        break;

      case 'subscriptionsAdministrator' :
        $administratorInCharge = new SubscriptionsAdministrator();
        break;

      default :
        die ( 'Target administrator is not valid' );

    }

    $requestType = $this->request->getType();
    $requestData = $this->request->getData();

    $administratorReport = $administratorInCharge->doTask( $requestType, $requestData );

    $this->report = $administratorReport;

  }

  /**
   * Procedure
   * Asks the $this->watchingAdministrator for its Report,
   * and sends it back to the petitioner.
   *
   * @param $report
   */
  public function sendReport( $report ) {

    $reportAsArray = DataTranslator::translateReport( $report );
    $reportAsJsonEncodedArray = json_encode( $reportAsArray );
    

    print ( $reportAsJsonEncodedArray );

  }

  public function getReport (){

    return $this->report;

  }

}


/**
 * Main procedure in PHP code
 */
function Main() {

  $communicationHandler = new CommunicationHandler();
  $communicationHandler->receiveRequest( $_POST );
  $report = $communicationHandler->getReport();
  $this->sendReport( $report );

}

Main();
