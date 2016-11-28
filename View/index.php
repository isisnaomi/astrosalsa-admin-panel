<?php
include('../Control/AdminAuthenticator.php');
$auth = new AdminAuthenticator();
$error = '';

if($admin->existSession){
  header("location: dashboard.php");
}
if(isset($_POST['submit']))
{
 $uname = $_POST['username'];
 $upass = $_POST['password'];
 $upass = md5($upass);

 if($auth->authenticate( $uname, $upass )){
   header("location: dashboard.php"); // Redirecting To Other Page
 }



}

?>
<!DOCTYPE html>
<html>
<head>
<title>Iniciar Sesion</title>

<link rel='stylesheet' href='assets/css/normalize.css'/>
<link rel='stylesheet' href='assets/css/login.css'/>
</head>
<body>
<div id="main">
  <div id="login">
    <h2 id="header"></h2>
      <form id="login-form" action="" method="post">
        <label>UserName :</label>
        <input id="name" name="username" placeholder="username" type="text">
        <label>Password :</label>
        <input id="password" name="password" placeholder="**********" type="password">
        <input name="submit" type="submit" value=" Login ">
      </form>
  </div>
</div>
</body>
</html>
