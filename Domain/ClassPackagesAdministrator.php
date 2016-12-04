<?php

/**
* ClassPackagesAdministrator
* Administrates de class packages
*/
class ClassPackagesAdministrator extends Administrator {

  public function __construct() {
    parent::__construct( 'packages' );
  }

  public function getPackageByID( $taskData ) {

    $this->accessDatabase();
    $attributes = ["*" => "*"];
    $rowFilters = "id=".$taskData['id'];

    $isTaskSuccessful = $this->databaseAccessor->selectRows( $attributes, $rowFilters );
    $stamp = 'get '. $this->tableName;
    $isTaskSuccessful = $isTaskSuccessful[0];

    return $this->writeReport( $isTaskSuccessful, $stamp );

  }

    protected  function logActivity( $report, $stamp ) {

    }

}
