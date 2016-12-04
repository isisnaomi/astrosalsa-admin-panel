<?php
require_once '../Control/AdminSessionAdministrator.php';
$admin = new AdminSessionAdministrator();

 if ( $admin->terminateSession() ) {

   header( "Location: index.php" );

 }