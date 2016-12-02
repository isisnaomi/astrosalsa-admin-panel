<!doctype html>
<html lang='en'>
<head>

  <meta charset='utf-8'>
  <title>Dashboard</title>

  <?php require "php-segments/stylesheet-links.php"; ?>

  <link rel='stylesheet' href='assets/css/check-in.css' />
  <link rel='stylesheet' href='assets/css/dashboard.css' />

</head>
<body>

  <?php include "php-segments/check-in-window.php"; ?>

  <?php include "php-segments/sidebar.php"; ?>

  <?php include "php-segments/top-bar.php"; ?>

  <div class='dashboard main-container'>

    <h1 class='section-title'>Dashboard</h1>

    <div class='quick-access-button check-in'>Ingreso</div>
    <div class='quick-access-button charge'>Cobrar</div>
    <div class='quick-access-button add-student'>+ Alumno</div>
    <div class='quick-access-button add-package'>+ Paquete</div>

    <div class='quick-access-report'>
      <h2>Asistencia</h2>
    </div>

    <div class='social-media-links'>
      <h2>Redes sociales</h2>
      <a class='facebook social-icon' href='http://facebook.com/' target='_blank' title='Página de Facebook'></a>
      <a class='youtube social-icon' href='http://youtube.com/' target='_blank' title='Página de YouTube'></a>
      <a class='instagram social-icon' href='http://instagram.com/' target='_blank' title='Página de Instagram'></a>
    </div>

  </div>

  <?php include "php-segments/script-links.php"; ?>

</body>
</html>
