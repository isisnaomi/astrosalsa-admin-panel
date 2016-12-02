<?php
require_once '../Domain/Administrator.php';
/**
 * SubscriptionAdministrator
 * Administrates the subscriptions
 */
class SubscriptionsAdministrator extends Administrator {

  /**
   * @var string
   */
  private $academiesLocations;

  public function __construct() {

    parent::__construct( 'classPackages' );
    $this->academiesLocations = array();

  }

  protected function getSubscriptionByStudentID( $taskData ) {
    $this->accessDatabase();
    $attributes = ["*"];
    $rowFilters = "studentId=".$taskData['studentId'];

    $isTaskSuccessful = $this->databaseAccessor->selectRows( $attributes, $rowFilters );
    $stamp = 'get '. $this->tableName;

    return $this->writeReport( $isTaskSuccessful, $stamp );
  }

  protected function getSubscriptionByPackageID( $taskData ) {
    $this->accessDatabase();
    $attributes = ["*"];
    $rowFilters = "packageId=".$taskData['packageId'];

    $isTaskSuccessful = $this->databaseAccessor->selectRows( $attributes, $rowFilters );
    $stamp = 'get '. $this->tableName;

    return $this->writeReport( $isTaskSuccessful, $stamp );
  }


  protected function decrementClassesRemaining( $taskData ){
      $stamp = 'decrement '. $this->tableName;
      return $this->writeReport( $isTaskSuccessful, $stamp );

  }

  protected function renewSubscription( $taskData ){
      $stamp = 'renew'. $this->tableName;
      return $this->writeReport( $isTaskSuccessful, $stamp );

  }


  protected  function logActivity( $stamp ){

        if( $stamp === 'decrement subscription'){
            $this->logAssistance();
        }
        if( $stamp === 'renew subscription'){
            $this->logRenewSubscription();
        }


  }

    protected function logAssistance(){
        $tableName = 'assistanceLog';
        $activity = [
            'studentId' => $this->databaseAccessor->getLastInsertedId(),
            'date' => date('Y/m/d H:i:s')
        ];

        ActivityLogger::logActivity ( $tableName, $activity );
    }

    protected function logRenewSubscription(){
        $tableName = 'paymentLog';
        $activity = [
            'studentId' => $this->databaseAccessor->getLastInsertedId(),
            'date' => date('Y/m/d H:i:s')
        ];

        ActivityLogger::logActivity ( $tableName, $activity );


    }

    protected function getAssistanceLog( $taskData ){
        $tableName = 'assistanceLog';

    }
    protected function getPaymentLog( $taskData ){
        $tableName = 'paymentLog';

        ActivityLogger::getActivityLog( $tableName, $taskData );

    }

}
