<?php

  include('../Control/AdminAuthenticator.php');

  $admin = new AdminSessionAdministrator();
  $error = '';

  if ( ! $admin->existSession() ) {

    header( "location: index.php" );

  }
