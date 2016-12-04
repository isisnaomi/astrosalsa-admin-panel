<?php
require_once 'AdminSessionAdministrator.php';

define("default_username", "admin");
define("default_password", "21232f297a57a5a743894a0e4a801fc3");
/**
* Admin Authenticator
* Authorizes account access
*/
class AdminAuthenticator {
  /**
   * @var String
   */
  public $error = ' '; // Variable To Store Error Message
  /**
   * @var AdminSessionAdministrator
   */
  public $admin;


  public function __construct() {

    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }

  }

  /**
   * @param $username
   * @param $password
   * @return boolean
   */
  public function authenticate($username, $password) {

    if (default_username == $username && default_password == $password) {

      $admin = new AdminSessionAdministrator();
      $admin->startSession( $username );

      return true;

    } else {

      return false;
    }
  }
}