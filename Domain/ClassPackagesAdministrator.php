<?php

/**
* ClassPackagesAdministrator
* Administrates de class packages
*/
class ClassPackagesAdministrator extends Administrator {

  public function __construct() {
    parent::__construct( 'classPackages' );
  }

  protected function getPackageByID( $taskData ) {
    $this->accessDatabase();
    $attributes = "*";
    $rowFilters = "id=".$taskData['id'];

    $isTaskSuccessful = $this->databaseAccessor->selectRows( $this->tableName, $attributes, $rowFilters );

    return $this->writeReport( $isTaskSuccessful );
  }

}
