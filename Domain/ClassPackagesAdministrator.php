<?php

/**
* ClassPackagesAdministrator
* Administrates de class packages
*/
class ClassPackagesAdministrator extends Administrator {

  public function __construct() {

    parent::__construct( 'packages' );

  }
  protected function doSpecificTask( $taskType, $taskData ){

    $report = null;
    switch ( $taskType ) {

      case 'getPackageById' :
        $report = $this->getPackageByID( $taskData );
        break;

    }

    return $report;

  }

  public function getPackageByID( $taskData ) {

    $this->accessDatabase();
    $rowFilters = "id=".$taskData[ 'id' ];

    $isTaskSuccessful = $this->databaseAccessor->selectRows( null, $rowFilters );
    $taskType = 'get '. $this->tableName;
    $databaseResponse = $isTaskSuccessful[ self::UNIQUE_ELEMENT ];
    $administratorResponse = $databaseResponse;

    $report =  $this->writeReport( $administratorResponse, $taskType );

    return $report;

  }

    protected  function logActivity( $activityData, $activityType ) {

    }

}
