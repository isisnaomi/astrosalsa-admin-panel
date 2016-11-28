<?php
require_once 'AdminSessionAdministrator.php';

define("default_username", "admin");
define("default_password", "21232f297a57a5a743894a0e4a801fc3");


class AdminAuthenticator {

  public $error=' '; // Variable To Store Error Message
  public $admin;

  public function authenticate( $username, $password ){

        if (default_username == $username && default_password == $password ) {

          $admin = new AdminSessionAdministrator();
          $admin->startSession( $username );

          return true;

        } else {
          $error= "Invalid username or password, please verify and try again";
          echo "<script type='text/javascript'>alert('$error');</script>";
          return false;
        }
  }
}
 ?>
