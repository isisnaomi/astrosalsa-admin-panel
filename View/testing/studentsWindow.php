<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'>
    <title>Add student window</title>
  </head>
  <body>
    <input type='text' placeholder='Student name'>
    <input type='button' value='add student'>

    <script src='http://localhost/libs/jquery.min.js'></script>

    <script>
      $(function() {

        $('input:button').on('click', function() {

          $.ajax({
            data : {

              'target' : 'studentsAdministrator',
              'type' : 'add',

              'data' : {
                'name' : $('input:text').val()
              }

            },
            type: 'POST',
            dataType: 'JSON',
            url: '../../Control/CommunicationHandler.php',
            beforeSend: function() {
              console.log('BeforeSend');
            },
            success: function( response ) {
              console.log('Ajax call successful');
              console.log( response.data );
            },
            error: function( xhr, statusText ) {
              console.error( 'Communication error: ' + statusText + ' - ' + xhr);

            },
            complete: function( response ) {
              console.log( 'Ajax request completed.' );
              console.log( response );
            }
          });

        });

      });
    </script>

  </body>
</html>
