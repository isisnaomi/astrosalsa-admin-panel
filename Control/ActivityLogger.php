<?php

require_once '../Domain/DatabaseAccessor.php';
require_once '../Domain/QueryGenerator.php';

/**
 * ActivityLogger
 * logs activity abstracted from a report
 * only when the activity reflects success
 */
class ActivityLogger {

  const DATABASE_NAME = 'astrosalsa';

  const DATABASE_USER = 'root';

  const DATABASE_PASS = 'root';

  /**
   * @var DatabaseAccessor
   */
  private static $databaseAccessor;

  /**
   * @param $tableName
   * @return string
   */
  private static function accessDatabase( $tableName ) {

    self::$databaseAccessor = new DatabaseAccessor( self::DATABASE_NAME, $tableName );
    $isAccessSuccessful = self::$databaseAccessor->connect( self::DATABASE_USER, self::DATABASE_PASS );

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

  /**
   * @param $tableName
   * @param $logFilter
   * @return array|bool
   */
  public  static function getActivityLog ( $tableName, $logFilter ) {

    $initDate = $logFilter[ 'initDate' ];
    $finalDate = $logFilter[ 'finalDate' ];
    $activityFilter = 'date';

    $rowFilter = QueryGenerator::generateRangeRowFilter( $activityFilter, $initDate, $finalDate );

    self::accessDatabase( $tableName );
    $databaseResponse = self::$databaseAccessor->selectRows( null, $rowFilter );
    $loggerResponse = $databaseResponse;

    return $loggerResponse;

  }

}
