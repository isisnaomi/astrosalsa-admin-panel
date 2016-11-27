<!doctype html>
<html>
  <head>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" type="text/css" />

    </head>

<div class="row">
    </div>
    <div class="row panel panel-default">
        <div class="panel-heading">
            Lista de paquetes
        </div>
        <div class="panel-body">
        <table id="dtStudents" class="table display" cellspacing="0" width="100%">
            <thead>
                <tr>
                <th>ID</th>
                <th>Clases incluidas</th>
                <th>Precio</th>
                <th>Editar</th>
                <th>Eliminar</th>
                </tr>
            </thead>
        </table>
        </div>
    </div>

    <script>

        $(document).ready(function(){

            $('#dtStudents').DataTable(
              {
                "processing": true,
                "ajax": "../dataGetter.php/?data=packages",
                "columns": [
                    {data: 'IdPackage'},
                    {data: 'ClassesIncluded'},
                    {data: 'Price'},
                ],
                "columnDefs":
                [
                    {
                        "targets": 3,
                        "searchable": false,
                        "data": null,
                        "defaultContent": "<button action='edit' type='button' class='btn btn-success btn-xs' title='Editar dispositivo'>" +
                            "<span class='glyphicon glyphicon-edit' aria-hidden='true'></span> " +
                            "</button>"
                    },
                    {
                        "targets": 4,
                        "searchable": false,
                        "data": null,
                        "defaultContent": "<button action='delete' type='button' class='btn btn-danger btn-xs' " +
                        "data-toggle='modal' title='Eliminar dispositivo' data-target='#modal-confirm'>" +
                        "<span class='glyphicon glyphicon-trash' aria-hidden='true'></span> " +
                        "</button>"
                    }
                ]

              }); // end of dt definition

        }); // end doc ready

    </script>

</html>
