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

  protected function getSubscriptionByStudentID( $id ) {
    /* TODO */
  }

  protected function getSubscriptionByPackageID( $id ) {
    /* TODO */
  }

}
