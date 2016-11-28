<?php
include('../Control/AdminSessionAdministrator.php');
$admin = new AdminSessionAdministrator();

 if($admin->terminateSession()){
   header("Location: index.php"); // Redirecting To Home Page
 }

?>
