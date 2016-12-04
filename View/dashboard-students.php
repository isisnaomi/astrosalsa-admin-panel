<!doctype html>
<html>
  <head>

    <script src='http://localhost/libs/jquery.min.js'></script>
    <link rel='stylesheet' href='http://localhost/libs/bootstrap.min.css'>

    <script src='https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js'></script>
    <link href='https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css'>

  </head>
  <body>

    <div class='row'></div>

    <div class='row panel panel-default'>

        <div class='panel-heading'>
            Lista de alumnos
        </div>

        <div class='panel-body'>
          <table id='dtStudents' class='table display' cellspacing='0' width='100%'>
              <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                  </tr>
              </thead>
          </table>
        </div>

    </div>
  </body>

    <script>
      $(function(){

          $('#dtStudents').DataTable(
            {
              "processing": true,
              "ajax": {
                "method": "POST",
                "url": "../Control/CommunicationHandler.php", // cambiar por CommunicationHandler
                "dataType": "json",
                "dataSrc" : function( response ) {
                  return response.content;
                },
                "data": {
                  target: "studentsAdministrator",
                  type: "getList",
                  data: {
                    "*":"*"
                  }
                }
              },

              'columns': [
                  {
                    data: 'id'
                  },
                  {
                    data: 'name'
                  }
              ],

              'columnDefs': [
                  {
                      'targets': 2,
                      'searchable': false,
                      'data': null,
                      'defaultContent':
                          "<button action='edit' type='button' class='btn btn-success btn-xs' title='Editar dispositivo'>" +
                          "<span class='glyphicon glyphicon-edit' aria-hidden='true'></span> " +
                          "</button>"
                  },
                  {
                      'targets': 3,
                      'searchable': false,
                      'data': null,
                      'defaultContent':
                        "<button action='delete' type='button' class='btn btn-danger btn-xs' " +
                        "data-toggle='modal' title='Eliminar dispositivo' data-target='#modal-confirm'>" +
                        "<span class='glyphicon glyphicon-trash' aria-hidden='true'></span> " +
                        "</button>"
                  }
              ]

            }); // $('#students-data-table').dataTable();

      }); // $.function();

    </script>
</html>
