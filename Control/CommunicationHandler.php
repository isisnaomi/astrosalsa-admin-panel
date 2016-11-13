<?php

require_once '../Domain/Request.php';
require_once '../Domain/Administrator.php';
require_once '../Domain/StudentsAdministrator.php';
require_once '../Domain/PackagesAdministrator.php';
require_once '../Domain/SubscriptionsAdministrator.php';

require_once '../Control/ReportSender.php';
require_once '../Control/DataTrasnlator.php';

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
  * @var Administrator
  */
  private $administratorWatching;


  public function __construct() {

    $this->lookForARequest( $_POST );

    /* TODO: Awaiting implementation of isRequestValid() */
    /* $this->isRequestValid(); */

    $this->delegateRequest();
    $this->sendReport();

  }

  /**
  * Procedure
  * Looks for request as parameters in the given method.
  * If there are enough parameters to proceed check if they're valid.
  * If all of them are valid saves them as a Request in $this->request.
  */
  private function lookForARequest( $method ) {

    /* TODO: Validate method parameter */

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

      $requestAsArray = [
        'target' => $method['target'],
        'type' => $method['type'],
        'data' => $method['data']
      ];

      $request = DataTrasnlator::translateReport( $requestAsArray );

      $this->request = $request;

    } else {

      die( 'There is no valid request.' );

      /* Do nothing? */
      /* TODO: Throw exception if there's no valid request? */

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
  private function isRequestValid() {

    /* TODO */

  }

  /**
  * Procedure
  * Delegates the $this->request to its target.
  * Sets that target as $this->administratorWatching.
  */
  public function delegateRequest() {

    switch ( $this->request->getTarget() ) {

      case 'studentsAdministrator' :
        $this->administratorWatching = new StudentsAdministrator();
        break;

      case 'packagesAdministrator' :
        $this->administratorWatching = new PackagesAdministrator();
        break;

      case 'subscriptionsAdministrator' :
        $this->administratorWatching = new SubscriptionsAdministrator();
        break;

      /* TODO: Throw exception if invalid target */

    }

    $requestType = $this->request->getType();
    $requestData = $this->request->getData();

    $this->administratorWatching->doTask( $requestType, $requestData );

  }

  /**
  * Procedure
  * Asks the $this->watchingAdministrator for its Report,
  * and sents it back to the petitioner.
  */
  public function sendReport() {

    $report = $this->administratorWatching->getReport();
    $reportAsArray = DataTrasnlator::translateRequest( $report );

    $reportAsJsonEncodedArray = json_encode( $reportAsArray );

    print ( $reportAsJsonEncodedArray );

  }

}



/**
 * Main procedure in PHP code
 */
function Main() {

  $requestReceiver = new CommunicationHandler();

}

Main();
