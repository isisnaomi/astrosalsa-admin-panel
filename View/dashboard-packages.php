<!doctype html>
<html class='astrosalsa'>
  <head>

    <meta charset='utf-8'>
    <title>Packages dashboard</title>

    <!-- Dashboard libraries: Scripts -->
    <script src='http://localhost/libs/jquery.min.js'></script>
    <script src='http://localhost/libs/jquery.dataTables.min.js'></script>

    <!-- Students dashboard script -->
    <script src='assets/scripts/ajax-setup.js'></script>
    <script src='assets/scripts/dashboard-packages/event-handler.js'></script>
    <script src='assets/scripts/dashboard-packages/table-definition.js'></script>

    <!-- Dashboard libraries: Stylesheets -->
    <link rel='stylesheet' href='http://localhost/libs/bootstrap.min.css'>
    <link rel='stylesheet' href='http://localhost/libs/jquery.dataTables.min.css'>

    <!-- Students Dashboard styles -->
    <link rel='stylesheet' href='assets/stylesheets/dashboard-packages/layout.css'>
    <link rel='stylesheet' href='assets/stylesheets/dashboard-packages/popup-window.css'>

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

    <div class='popup-window add-package-window'>
      <div class='form'>
        <span class='title'>Agregar paquete</span>
        <input type='text' name='name' placeholder='Nombre de paquete' />
        <input type='text' name='classesIncluded' placeholder='Número de clases' />
        <input type='text' name='price' placeholder='Precio' />
        
        <div class='form-buttons'>
          <span class='button button-ok'>Agregar</span>
          <span class='button button-cancel'>Cancelar</span>
        </div>
      </div>
    </div>

    <div class='popup-window edit-package-window'>
      <div class='form'>
        <span class='title'>Editar paquete</span>
        <input type='text' name='id' placeholder='ID' disabled='disabled' />
        <input type='text' name='name' placeholder='Nombre de paquete' />
        <input type='text' name='classesIncluded' placeholder='Número de clases' />
        <input type='text' name='price' placeholder='Precio' />

        <div class='form-buttons'>
          <span class='button button-ok'>Editar</span>
          <span class='button button-delete'>Eliminar</span>
          <span class='button button-cancel'>Cancelar</span>
        </div>
      </div>
    </div>

    <div class='row panel panel-default'>

        <div class='panel-heading'>
          <span class='title'>Paquetes</span>
          <span class='button button-add-student'>Agregar paquete</span>
        </div>

        <div class='panel-body'>
          <table id='students-list' class='table display' cellspacing='0' width='100%'>
              <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Número de clases</th>
                    <th>Precio</th>
                    <th></th>
                  </tr>
              </thead>
          </table>
        </div>

    </div>
  </body>
</html>
