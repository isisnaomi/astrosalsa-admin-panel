<?php

  require_once '../Control/AdminSessionAdministrator.php';
  require_once '../Control/AdminAuthenticator.php';

  $sessionAdministrator = new AdminSessionAdministrator();
  $auth = new AdminAuthenticator();
  $error = '';

  if ( $sessionAdministrator->existSession() ) {
    header( "location: dashboard.php" );
  }

  if ( isset( $_POST['submit'] ) ) {

    $uname = $_POST['username'];
    $upass = $_POST['password'];
    $upass = md5( $upass );

    if( $auth->authenticate( $uname, $upass ) ) {

      header( "location: dashboard.php" );

    } else {

      $error= "Invalid username or password, please verify and try again";
      echo "<script type='text/javascript'>alert('$error');</script>";

    }

  }

?>
<!doctype html>
<html>
  <head>

    <title>Iniciar Sesion</title>

    <link rel='stylesheet' href='assets/stylesheets/normalize.css'/>
    <link rel='stylesheet' href='assets/stylesheets/login.css'/>

  </head>
  <body>

  <div id="main">
    <div id="login">
      <h2 id="header"></h2>
        <form id="login-form" action="" method="post">
          <label>UserName:</label>
          <input id="name" name="username" placeholder="username" type="text">
          <label>Password:</label>
          <input id="password" name="password" placeholder="**********" type="password">
          <input name="submit" type="submit" value=" Login ">
        </form>
    </div>
  </div>

  </body>
</html>
