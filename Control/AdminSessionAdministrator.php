<?php
/**
* Admin Session Administrator
* Manages the current SESSION
*/
class AdminSessionAdministrator {

  /**
   * AdminSessionAdministrator constructor.
   */
  public function __construct() {

    if (session_status() == PHP_SESSION_NONE) {

      session_start();

    }

  }

  /**
   * @return boolean
   */
  public function existSession() {

    $isSessionSet = isset( $_SESSION[ 'login_user' ] );

    if ( $isSessionSet ) {

      return true;

    }

    return false;

  }

  /**
   * @param $username
   */
  public function startSession( $username ) {

    session_start();
    $_SESSION[ 'login_user' ] = $username;

  }

  /**
   * @return boolean
   */
  public function terminateSession() {

    session_start();
    $isSessionDestroyed = session_destroy();

    if( $isSessionDestroyed ) {

      return true;

    }
    else {

      return false;

    }

  }

}
