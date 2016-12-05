<!doctype html>
<html class='astrosalsa'>
  <head>

    <meta charset='utf-8'>
    <title>Students dashboard</title>

    <!-- Dashboard libraries: Scripts -->
    <script src='vendor/libs/jquery.min.js'></script>
    <script src='vendor/libs/jquery.dataTables.min.js'></script>

    <!-- Students dashboard script -->
    <script src='assets/scripts/ajax-setup.js'></script>
    <script src='assets/scripts/dashboard-students/event-handler.js'></script>
    <script src='assets/scripts/dashboard-students/table-definition.js'></script>

    <!-- Dashboard libraries: Stylesheets -->
    <link rel='stylesheet' href='vendor/libs/bootstrap.min.css'>
    <link rel='stylesheet' href='vendor/libs/jquery.dataTables.min.css'>

    <!-- Students Dashboard styles -->
    <link rel='stylesheet' href='assets/stylesheets/dashboard-students/layout.css'>
    <link rel='stylesheet' href='assets/stylesheets/dashboard-students/popup-window.css'>

  </head>
  <body>

    <div class='popup-window success-message'>
      <div class='frame'>
        La operación se ha realizado correctamente.<br />
        Se recargará la lista.
      </div>
    </div>

    <div class='popup-window fail-message'>
      <div class='frame'>
        Ha ocurrido un error inesperado.<br />
        Se recargará la lista.
      </div>
    </div>

    <div class='popup-window add-student-window'>
      <div class='form'>
        <span class='title'>Agregar alumno</span>
        <input type='text' name='first-name' placeholder='Nombre' />
        <input type='text' name='last-name' placeholder='Apellido' />
        <div class='form-buttons'>
          <span class='button button-ok'>Agregar</span>
          <span class='button button-cancel'>Cancelar</span>
        </div>
      </div>
    </div>

    <div class='popup-window edit-student-photo-window'>
      <div class='form'>
        <input type='text' name='id' placeholder='ID' disabled='disabled' />
        <input type='text' name='name' placeholder='Nombre' disabled='disabled' />
        <div id='webcam' style="margin: 0 auto;"></div>
        <div class='form-buttons'>
          <span class='button button-ok'>Capturar</span>
          <span class='button button-cancel'>Cancelar</span>
        </div>
      </div>
    </div>

    <div class='popup-window subscription-window'>

      <div class='form renew-subscription-form'>
        <span class='title'>Renovar subscripción</span>
        <input type='text' name='name' placeholder='Nombre' disabled='disabled' />
        <select name='package'>
          <option value='0'>No hay paquetes disponibles</option>
        </select>
        <select name='paymentDay'>
          <option value='15'>Pagar día 15</option>
          <option value='30'>Pagar día 30</option>
        </select>

        <div class='form-buttons'>
          <span class='button button-ok'>Renovar</span>
          <span class='button button-cancel'>Cancelar</span>
        </div>
      </div>

    </div>

    <div class='popup-window edit-student-window'>
      <div class='form'>
        <span class='title'>Editar alumno</span>
        <input type='text' name='id' placeholder='ID' disabled='disabled' />
        <input type='text' name='name' placeholder='Nombre' />
        <div class='form-buttons'>
          <span class='button button-ok'>Editar</span>
          <span class='button button-delete'>Eliminar</span>
          <span class='button button-cancel'>Cancelar</span>
        </div>
      </div>
    </div>

    <div class='row panel panel-default'>

        <div class='panel-heading'>
          <span class='title'>Alumnos</span>
          <span class='button button-add-student'>Agregar alumno</span>
        </div>

        <div class='panel-body'>
          <table id='students-list' class='table display' cellspacing='0' width='100%'>
              <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Foto</th>
                    <th></th>
                  </tr>
              </thead>
          </table>
        </div>

    </div>


    <form id="upload-photo-form" method="post" action="http://localhost/MAMP/astrosalsa-admin-panel/View/upload-photo.php">
      <input id="rawImageData" type="hidden" name="image" value="" />
      <input id="studentId" type="hidden" name="studentId" value="" />
    </form>
  </body>
</html>
