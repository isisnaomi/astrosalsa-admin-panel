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
  private static $databaseAccessor;


  /**
   * ActivityLogger constructor.
   */
  public function __construct() {

  }

  /**
   * @return string
   */
  private static function accessDatabase( $tableName ) {

      self::$databaseAccessor = new DatabaseAccessor( 'astrosalsa', $tableName );
      $isAccessSuccessful = self::$databaseAccessor->connect( 'root' );

      return $isAccessSuccessful;
  }

  /**
   * Procedure
   * @param $activityReport
   */
  public static function logActivity ( $tableName, $activityReport ) {

      self::accessDatabase( $tableName );
      self::$databaseAccessor->insertRow( $activityReport );

  }

  public  static function getActivityLog ( $tableName, $attributes ){
      self::accessDatabase( $tableName );
      $isAccessSuccessful = self::$databaseAccessor->selectRows( $attributes );

      return $isAccessSuccessful;


  }

}
