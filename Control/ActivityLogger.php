<?php
require_once '../Domain/DatabaseAccessor.php';
/**
 * ActivityLogger
 * logs activity abstracted from a report
 * only when the activity reflects success
 */
class ActivityLogger{
  /**
  * @var String
  */
  protected static $tableName = activityLog;

  /**
   * @param $activityReport
   */
  public static function logActivity ( $activityReport ) {
    $activityType = $activityReport['type'];

    if( $activityType == 'data' ){

      $this->accessDatabase();
      $isLogSuccessful = $this->database->insertRow( $activityReport );

    } else {

      die( $activityType );

    }

  }


}
  ?>
