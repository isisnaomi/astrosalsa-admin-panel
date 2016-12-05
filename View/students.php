<?php require 'segments/session-validator.php'; ?>
<!doctype html>
<html>
  <head>

    <meta charset='utf-8'>
    <title>Alumnos</title>

    <!-- Stylesheet links -->
    <?php include 'layout/layout-stylesheets-links.php'; ?>
    <link rel='stylesheet' href='assets/stylesheets/students/layout.css' />

  </head>
  <body>

    <!-- Sidebar -->
    <?php include 'layout/sidebar.php'; ?>

    <!-- Topbar -->
    <?php include 'layout/top-bar.php'; ?>

    <!-- Students view -->
    <div class='students main-container'>
      <iframe src='dashboard-students.php'></iframe>
    </div>

    <!-- Libs -->
    <script src='vendor/libs/jquery.min.js'></script>

    <!-- Sidebar script -->
    <script>
      $(function() {
        $('.main-menu')
          .find('li.students')
          .addClass('active');
      });
    </script>

  </body>
</html>
