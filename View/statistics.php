<?php require 'segments/session-validator.php'; ?>
<!doctype html>
<html>
  <head>

    <meta charset='utf-8'>
    <title>Estadísticas</title>

    <!-- Stylesheet links -->
    <?php include 'layout/layout-stylesheets-links.php'; ?>
    <link rel='stylesheet' href='assets/stylesheets/statistics/layout.css' />

  </head>
  <body>

    <!-- Sidebar -->
    <?php include 'layout/sidebar.php'; ?>

    <!-- Topbar -->
    <?php include 'layout/top-bar.php'; ?>

    <!-- Students view -->
    <div class='statistics main-container'>
      <header>
        <h1>Estadísticas</h1>
        <nav>
          <span class='assistance'>Asistencia</span>
          <span class='payments'>Pagos</span>
          <span class='studentInscriptions'>Inscripciones</span>
        </nav>
      </header>

      <iframe src='statistics/assistance.php'></iframe>
    </div>

    <!-- Libs -->
    <script src='vendor/libs/jquery.min.js'></script>

    <!-- Sidebar script -->
    <script>
      $(function() {
        $('.main-menu')
          .find('li.statistics')
          .addClass('active');
      });
    </script>

  </body>
</html>