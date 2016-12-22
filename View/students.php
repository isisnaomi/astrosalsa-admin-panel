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

          if ( action === 'addStudent' ) {

            $( 'iframe' ).attr( 'src', 'dashboard-students.php?action=addStudent' );

          } else if ( action === 'payment' ) {

            $( 'iframe' ).attr( 'src', 'dashboard-students.php?action=payment' );

          }

        }
      });
    </script>

    <script>
      $(function() {
        $( '.menu-item' ).on( 'click', function() {
            window.location.href = $($( this ).children( 'a' )[0]).attr( 'href' );
        });
      });
    </script>


  </body>
</html>
