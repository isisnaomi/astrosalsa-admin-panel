<?php

require_once '../Domain/DatabaseAccessor.php';

/**
 * ActivityLogger
 * logs activity abstracted from a report
 * only when the activity reflects success
 */
class ActivityLogger {

  /**
   * @var DatabaseAccessor
   */
  private $databaseAccessor;


  /**
   * ActivityLogger constructor.
   */
  public function __construct() {

  }

  /**
   * @return string
   */
  private function accessDatabase() {
    $tableName = 'activityLog';

    $this->databaseAccessor = new DatabaseAccessor( 'astrosalsa', $tableName );
    $isAccessSuccessful = $this->databaseAccessor->connect( 'root' );
    return $isAccessSuccessful;
  }

  /**
   * Procedure
   * @param $activityReport
   */
  public function logActivity ( $activityReport ) {

    $activityType = $activityReport['type'];

    if ( $activityType == 'data' ) {

      $this->accessDatabase();
      $this->databaseAccessor->insertRow( $activityReport );

    } else {

      die( $activityType );

    }

  }

}
