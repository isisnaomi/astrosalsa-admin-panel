<?php

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

    parent::__construct( 'classPackages' );
    $this->academiesLocations = array();

  }

  protected function getSubscriptionByStudentID( $taskData ) {
    $this->accessDatabase();
    $attributes = ["*"];
    $rowFilters = "studentId=".$taskData['studentId'];

    $isTaskSuccessful = $this->databaseAccessor->selectRows( $attributes, $rowFilters );

    return $this->writeReport( $isTaskSuccessful );
  }

  protected function getSubscriptionByPackageID( $taskData ) {
    $this->accessDatabase();
    $attributes = ["*"];
    $rowFilters = "packageId=".$taskData['packageId'];

    $isTaskSuccessful = $this->databaseAccessor->selectRows( $attributes, $rowFilters );

    return $this->writeReport( $isTaskSuccessful );
  }

}
