<?php require 'segments/session-validator.php'; ?>
<!doctype html>
<html>
  <head>

    <meta charset='utf-8'>
    <title>Paquetes</title>

    <!-- Stylesheet links -->
    <?php include 'layout/layout-stylesheets-links.php'; ?>
    <link rel='stylesheet' href='assets/stylesheets/packages/layout.css' />

  </head>
  <body>

    <!-- Sidebar -->
    <?php include 'layout/sidebar.php'; ?>

    <!-- Topbar -->
    <?php include 'layout/top-bar.php'; ?>

    <!-- Students view -->
    <div class='packages main-container'>
      <iframe src='dashboard-packages.php'></iframe>
    </div>

    <!-- Libs -->
    <script src='vendor/libs/jquery.min.js'></script>

    <!-- Sidebar script -->
    <script>
      $(function() {
        $('.main-menu')
          .find('li.packages')
          .addClass('active');

      function getQueryVariable( variable ) {

        var query = window.location.search.substring( 1 );

        var vars = query.split( '&' );

        for ( var i = 0; i < vars.length; i++ ) {

          var pair = vars[i].split( '=' );

          if (pair[0] == variable)
            return pair[1];

        }

        return false;
      }

      var action = getQueryVariable( 'action' );

      if ( action ) {

        if ( action === 'addPackage' ) {

          $( 'iframe' ).attr( 'src', 'dashboard-packages.php?action=addPackage' );

        }

      }
      });
    </script>

  </body>
</html>
