<?php
class AdminSessionAdministrator {


  public function existSession( ) {

    if(isset($_SESSION['login_user'])){
      return true;
    }

    return false;
  }
  
  public function startSession( $username ) {

    session_start(); // Starting Session
    $_SESSION['login_user']=$username; // Initializing Session

  }

  public function terminateSession( ) {
    session_start();

    if(session_destroy()){ // Destroying All Sessions
      header("Location: index.php"); // Redirecting To Home Page
    }

  }

}
?>
