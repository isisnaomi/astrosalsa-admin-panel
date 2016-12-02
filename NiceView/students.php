<!doctype html>
<html lang='en'>
<head>
  
  <meta charset='utf-8'>
  <title>Alumnos</title>

  <?php require "php-segments/stylesheet-links.php"; ?>

  <link rel='stylesheet' href='stylesheets/students.css'>

</head>
<body>

  <?php include "php-segments/sidebar.php"; ?>

  <?php include "php-segments/top-bar.php"; ?>

  <div class='students main-container'>

    <h1 class='section-title'>
      Alumnos
      <div class='table-button add' title='Agregar un alumno'></div>
      <div class='table-button filter' title='Buscar alumno(s)'></div>
    </h1>

    <div class='table students'></div>

  </div>

  <?php include "php-segments/script-links.php"; ?>

  <script>
    $(function(){
      for(i = 0; i < 25; i++) {
        var row = "<div class='row'>" +
          "<div class='user'>" +
            "<span class='id'>" + ( 1995 + i ) + "</span>" +
            "<div class='table-photo'></div>" +
              "<span class='name'>Nombre genérico</span>" +
              "<div class='action-buttons'>" +
                "<div class='action-button charge'></div>" +
                "<div class='action-button edit'></div>" +
                "<div class='action-button delete'></div>" +
              "</div>" +
            "</div>" +
            "<span class='pay-day'>15</span>" +
          "</div>";

        $('.students.table').append(row);
      }
    });
  </script>

</body>
</html>