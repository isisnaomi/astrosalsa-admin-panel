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
   * @param $tableName
   * @return string
   */
  private static function accessDatabase( $tableName ) {

      self::$databaseAccessor = new DatabaseAccessor( 'astrosalsa', $tableName );
      $isAccessSuccessful = self::$databaseAccessor->connect( 'root', 'root' );

      return $isAccessSuccessful;
  }

  /**
   * Procedure
   * @param $tableName
   * @param $activityReport
   */
  public static function logActivity ( $tableName, $activityReport ) {

      self::accessDatabase( $tableName );
      self::$databaseAccessor->insertRow( $activityReport );

  }

  public  static function getActivityLog ( $tableName, $logFilter ){
      $attributes = ["*" => "*"];
      $rowFilter= 'date BETWEEN '.$logFilter['initDate'].' AND '.$logFilter['finalDate'];

      self::accessDatabase( $tableName );
      $isAccessSuccessful = self::$databaseAccessor->selectRows( $attributes, $rowFilter );

      return $isAccessSuccessful;


  }

}
