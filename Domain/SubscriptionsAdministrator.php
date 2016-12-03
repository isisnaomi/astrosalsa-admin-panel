<?php
require_once '../Domain/Administrator.php';
require_once '../Domain/ClassPackagesAdministrator.php';
require_once '../Domain/Report.php';
require_once '../Control/DataTranslator.php';
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

    parent::__construct( 'subscriptions' );
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


  protected function decrementClassesRemaining( $taskData ) {

      $this->accessDatabase();
      $attributes = [
          'classesRemaining' => 'classesRemaining-1'
      ];
      $rowFilters = 'studentId = '. $taskData['id'];
      $isTaskSuccessful = $this->databaseAccessor->updateRow( $attributes, $rowFilters );
      $stamp = 'decrement '. $this->tableName;
      return $this->writeReport( $isTaskSuccessful, $stamp );

  }

  protected function renewSubscription( $taskData ){
      $packageId = [
          'id' => $taskData['packageId']
      ];
      $studentId = $taskData['studentId'];
      $packageAdmin = new ClassPackagesAdministrator();
      $packageReport = DataTranslator::translateReport( $packageAdmin->getPackageByID( $packageId ) );
      $packageClasses = $packageReport['content'];
      $this->accessDatabase();
      $attributes = [
          'classesRemaining' => $packageClasses
      ];
      $rowFilters = 'studentId = '. $studentId;
      $isTaskSuccessful = $this->databaseAccessor->updateRow( $attributes, $rowFilters );
      $isTaskSuccessful = [
          'studentId' => $studentId,
          'packageId' => $taskData['packageId']
      ];
      $stamp = 'renew '. $this->tableName;
      return $this->writeReport( $isTaskSuccessful, $stamp );

  }


  protected  function logActivity( $activityData, $stamp ) {

        if ( $stamp === 'decrement subscriptions') {
            $this->logAssistance( $$activityData );
        } else if ( $stamp === 'renew subscriptions') {
            $this->logRenewSubscription( $activityData );
        }

  }

  protected function logAssistance( $activityData ) {
      $tableName = 'assistanceLog';
      $activity = [
          'studentId' => $activityData,
          'date' => date('Y/m/d'),
          'time' => date('H:i:s')
      ];

      ActivityLogger::logActivity ( $tableName, $activity );
  }

  protected function logRenewSubscription( $activityData ) {
      $tableName = 'paymentLog';
      echo('logrenewsubscription');
      $activity = [
          'studentId' => $activityData['studentId'],
          'packageId' => $activityData['packageId'],
          'date' => date('Y/m/d')
      ];

      ActivityLogger::logActivity ( $tableName, $activity );


  }

  protected function getAssistanceLog( $taskData ){

      $tableName = 'assistanceLog';
      ActivityLogger::getActivityLog( $tableName, $taskData );

  }
  protected function getPaymentLog( $taskData ){

      $tableName = 'paymentLog';
      ActivityLogger::getActivityLog( $tableName, $taskData );

  }

}
