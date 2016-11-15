<?php

/**
* SubscriptionAdministrator
* Administrates the subscriptions
*/
class SubscriptionsAdministrator extends Administrator {

  /**
  * @var string
  */
  private $location;

  public function __construct() {
    parent::__construct( 'classPackages' );
  }

  protected function getSubscriptionByStudentID( $taskData ) {
    $this->accessDatabase();
    $attributes = "*";
    $rowFilters = "studentId=".$taskData['studentId'];

    $isTaskSuccessful = $this->database->selectRows( $this->tableName, $attributes, $rowFilters );

    return $this->writeReport( $isTaskSuccessful );
  }

  protected function getSubscriptionByPackageID( $taskData ) {
    $this->accessDatabase();
    $attributes = "*";
    $rowFilters = "packageId=".$taskData['packageId'];

    $isTaskSuccessful = $this->database->selectRows( $this->tableName, $attributes, $rowFilters );

    return $this->writeReport( $isTaskSuccessful );
  }

}
