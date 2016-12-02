<?php
include('../../Control/AdminSessionAdministrator.php');
$admin = new AdminSessionAdministrator();
if(isset($_POST['logout']))
{
 $admin->terminateSession();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="profile">
<b id="welcome">Welcome : <i><?php echo $login_session; ?></i></b>
<form action="" method="post">
<input name="logout" type="submit" value=" Logout">
</form>
</div>
</body>
</html>
