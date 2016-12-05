<?php
require_once 'AdminSessionAdministrator.php';

/**
 * Admin Authenticator
 * Authorizes account access
 */
class AdminAuthenticator {

  const DEFAULT_USERNAME = 'admin';

  const DEFAULT_PASSWORD = '21232f297a57a5a743894a0e4a801fc3';

/**
 * @var String
 */
  public $errorMessage = ' ';

/**
 * @var AdminSessionAdministrator
 */
  public $admin;

  /**
   * AdminAuthenticator constructor.
   */
  public function __construct() {

    if ( session_status() == PHP_SESSION_NONE ) {

      session_start();

    }

  }

  /**
   * @param $username
   * @param $password
   * @return boolean
   */
  public function authenticate($username, $password) {

    if ( self::DEFAULT_USERNAME == $username && self::DEFAULT_PASSWORD == $password ) {

      $admin = new AdminSessionAdministrator();
      $admin->startSession( $username );

      return true;

    } else {

      return false;

    }

  }
}