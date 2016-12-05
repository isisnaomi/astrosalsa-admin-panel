<?php require 'segments/session-validator.php'; ?>
<!doctype html>
<html lang='en'>
<head>

  <meta charset='utf-8'>
  <title>Dashboard</title>

  <!-- Stylesheet links -->
  <?php include 'layout/layout-stylesheets-links.php'; ?>
  <link rel='stylesheet' href='assets/stylesheets/dashboard/layout.css' />
  <link rel='stylesheet' href='assets/stylesheets/dashboard/check-in.layout.css' />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

  <!-- CheckIn window -->
  <?php include 'segments/check-in-window.php'; ?>

  <!-- Sidebar -->
  <?php include 'layout/sidebar.php'; ?>

  <!-- Topbar -->
  <?php include 'layout/top-bar.php'; ?>

  <!-- Dashboard view -->
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

  <!-- Libs -->
  <script src='http://localhost/libs/jquery.min.js'></script>

  <!-- Sidebar script -->
  <script>
    $(function() {
      $('.main-menu')
        .find('li.dashboard')
        .addClass('active');
    });
  </script>

</body>
</html>
