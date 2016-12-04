<?php
require_once '../Domain/Administrator.php';
require_once '../Domain/ClassPackagesAdministrator.php';
require_once '../Domain/Report.php';
require_once '../Control/DataTranslator.php';
require_once '../Domain/TicketGenerator.php';
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
  protected function doSpecificTask( $taskType, $taskData ){

    $report = null;
    switch ( $taskType ) {
      case 'getSubscriptionByPackageID' :
        $report = $this->getSubscriptionByPackageID($taskData);
        break;
      case 'getSubscriptionByStudentID' :
        $report = $this->getSubscriptionByStudentID($taskData);
        break;
      case 'getAssistanceLog' :
        $report = $this->getAssistanceLog($taskData);
        break;
      case 'getPaymentsLog' :
        $report = $this->getPaymentsLog($taskData);
        break;
      case 'checkIn' :
        $report = $this->decrementClassesRemaining($taskData);
        break;
      case 'payment' :
        $report = $this->renewSubscription($taskData);
        break;
    }
    return $report;
  }

  protected function getSubscriptionByStudentID( $taskData ) {

    $this->accessDatabase();

    $rowFilters = "studentId=".$taskData[ 'studentId' ];

    $databaseResponse = $this->databaseAccessor->selectRows( null, $rowFilters );
    $taskType = 'get ' . $this->tableName;
    $administratorResponse = $databaseResponse;

    if( $databaseResponse ){

      $administratorResponse = $databaseResponse[ self::UNIQUE ];

    }

    return $this->writeReport( $administratorResponse, $taskType );

  }

  protected function getSubscriptionByPackageID( $taskData ) {

    $this->accessDatabase();
    $rowFilters = "packageId=".$taskData[ 'packageId' ];

    $databaseResponse = $this->databaseAccessor->selectRows( null, $rowFilters );
    $taskType = 'get ' . $this->tableName;
    $administratorResponse = $databaseResponse;

    if( $databaseResponse ){

      $administratorResponse = $databaseResponse[ self::UNIQUE ];

    }

    return $this->writeReport( $administratorResponse, $taskType );

  }


  protected function decrementClassesRemaining( $taskData ) {

      $this->accessDatabase();

      $attributes = [

          'classesRemaining' => 'classesRemaining-1'

      ];
      $rowFilters = 'studentId = '. $taskData['id'];

      $databaseResponse = $this->databaseAccessor->updateRow( $attributes, $rowFilters );
      $administratorResponse = $databaseResponse;

      if( $databaseResponse ){

        $administratorResponse = [

            'studentId' => $taskData[ 'id' ]

        ];

      }

      $taskType = 'decrement '. $this->tableName;

      return $this->writeReport( $administratorResponse, $taskType );

  }

  protected function renewSubscription( $taskData ){

      $packageId = [

          'id' => $taskData[ 'packageId' ]

      ];

      $packageAdmin = new ClassPackagesAdministrator();
      $packageReport = DataTranslator::translateReport( $packageAdmin->getPackageByID( $packageId ) );

      $packageClasses = $packageReport[ 'content' ][ 'classesIncluded' ];

      $attributes = [

          'classesRemaining' => $packageClasses

      ];

      $studentId = $taskData[ 'studentId' ];
      $rowFilters = 'studentId = '. $studentId;

      $this->accessDatabase();
      $databaseResponse = $this->databaseAccessor->updateRow( $attributes, $rowFilters );
      $administratorResponse = $databaseResponse;

      if( $databaseResponse ){

        $ticket  = $this->getTicket( $packageReport, $studentId );

        $administratorResponse = [

            'ticket' => $ticket,
            'studentId' => $studentId,
            'packageId' => $taskData['packageId']

        ];

      }

      $taskType = 'renew '. $this->tableName;
      return $this->writeReport( $administratorResponse, $taskType );

  }


  protected  function logActivity( $activityData, $activityType ) {

        if ( $activityType === 'decrement subscriptions') {

            $this->logAssistance( $activityData );

        } else if ( $activityType === 'renew subscriptions') {

            $this->logRenewSubscription( $activityData );

        }

  }

  protected function logAssistance( $activityData ) {

      $tableName = 'assistanceLog';

      $activity = [

          'studentId' => $activityData[ 'studentId' ],
          'date' => date( 'Y/m/d' ),
          'time' => date( 'H:i:s ')

      ];

      ActivityLogger::logActivity ( $tableName, $activity );

  }

  protected function logRenewSubscription( $activityData ) {

      $tableName = 'paymentsLog';

      $activity = [

          'studentId' => $activityData[ 'studentId' ],
          'packageId' => $activityData[ 'packageId' ],
          'date' => date( 'Y/m/d' )

      ];

      ActivityLogger::logActivity ( $tableName, $activity );


  }

  protected function getAssistanceLog( $taskData ){

      $tableName = 'assistanceLog';
      $databaseResponse = ActivityLogger::getActivityLog( $tableName, $taskData );
      $stamp = 'get '. $this->tableName;

      return $this->writeReport( $databaseResponse, $stamp );

  }

  protected function getPaymentsLog($taskData ) {

      $tableName = 'paymentsLog';
      $databaseResponse = ActivityLogger::getActivityLog( $tableName, $taskData );
      $stamp = 'get '. $this->tableName;

      return $this->writeReport( $databaseResponse, $stamp );

  }

  private function getTicket( $packageInfo, $studentId ) {

      $packagePrice = $packageInfo[ 'content' ][ 'price' ];
      $packageName = $packageInfo[ 'content' ][ 'name' ];
      $packageClasses = $packageInfo[ 'content' ][ 'classesIncluded' ];

      $studentAdmin = new StudentsAdministrator();
      $studentId = [ 'id' => $studentId ];
      $studentInfo = DataTranslator::translateReport( $studentAdmin->getStudentByID( $studentId ) );
      $studentName = $studentInfo[ 'content' ][ 'name' ];

      $ticketData = [

        'studentName' => $studentName,
        'classesIncluded' => $packageClasses,
        'price' => $packagePrice,
        'packageName' => $packageName

      ];

      $generatedTicket = TicketGenerator::generateTicket( $ticketData );

      return $generatedTicket;

  }

}
