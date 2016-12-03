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
      $stamp = 'renew '. $this->tableName;
      return $this->writeReport( $isTaskSuccessful, $stamp );

  }


  protected  function logActivity( $report, $stamp ) {

        if ( $stamp === 'decrement subscriptions') {
            $this->logAssistance( $report );
        } else if ( $stamp === 'renew subscriptions') {
            $this->logRenewSubscription( $report );
        }

  }

  protected function logAssistance( $report ) {
      $tableName = 'assistanceLog';
      $activity = [
          'studentId' => $report,
          'date' => date('Y/m/d'),
          'time' => date('H:i:s')
      ];

      ActivityLogger::logActivity ( $tableName, $activity );
  }

  protected function logRenewSubscription( $report ) {
      $tableName = 'paymentLog';
      echo('logrenewsubscription');
      $activity = [
          'studentId' => $report,
          'packageId' => '1',
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
