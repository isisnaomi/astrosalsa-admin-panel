<!doctype html>
<html>
  <head>

    <meta charset='utf-8'>
    <title>Reporte de asistencia</title>

    <!-- Javascript libraries -->
    <script src='../vendor/libs/jquery.min.js'></script>
    <script src='../vendor/libs/jquery-ui.js'></script>
    <script src='../vendor/libs/jquery.dataTables.min.js'></script>
    <script src='../vendor/libs/plotly-latest.min.js'></script>

    <!-- CSS libraries -->
    <link rel='stylesheet' href='../vendor/libs/bootstrap.min.css'>
    <link rel='stylesheet' href='../vendor/libs/jquery.dataTables.min.css'>
    <link rel='stylesheet' href='../vendor/libs/jquery-ui.css'>

    <!-- Statistics scripts -->
    <script src='../assets/scripts/statistics-assistance/graphic-definition.js'></script>

    <!-- Statistics Stylesheets -->
    <link rel='stylesheet' href='../assets/stylesheets/statistics-assistance/layout.css'>

  </head>
  <body>

    <div class='form'>
        Fecha inicio: <input type='text' id='initialDate' />
        Fecha final: <input type='text' id='finalDate' />
        <input type='button' value='Filtrar' />
    </div>

    <div id='bar-table' style='width: 100%; height: 600px;'></div>


    <div class='row panel panel-default'>
      <div class='panel-body'>
        <table id='dtAssistance' class='table display' cellspacing='0' width='100%'>
          <thead>
            <tr>
              <th>ID Alumno</th>
              <th>Fecha</th>
              <th>Hora</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>

  <script>
    $(function() {
        $('#initialDate').datepicker();
        $('#finalDate').datepicker();
    });
  </script>

  </body>
</html>
