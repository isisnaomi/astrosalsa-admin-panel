<!doctype html>
<html>
  <head>

    <meta charset='utf-8'>
    <title>Request Poster</title>

  </head>
  <body>

    <input type='text' class='field' id='name' placeholder='name'>
    <input type='button' value='RUN'
      style='display: block;'>

    <textarea id='JSON'
      style='font-family: monospace; width: 100%; height: 600px; font-size: 18px; display: top; margin-top: 20px; letter-spacing: 1px;'>

    </textarea>

    <script src='http://localhost/libs/jquery.min.js'></script>

    <script>
      $(function() {

        var data;

        $('.field').on('keyup', function() {

          data = {

            //'target' : 'subscriptionsAdministrator',
            //'type' : 'getPaymentLog',
            //'data' : {
            //  initDate: '20150101',
            //  finalDate: '20170101'
            //}

            'target' : 'subscriptionsAdministrator',
            'type' : 'checkIn',
            'data' : {
              'id': 7
            }

          };

          $('#JSON').text( JSON.stringify( data, null, 2 ) );

        });

        $('input:button').on('click', function() {

          $.ajax({

            data : data,

            type: 'POST',

            dataType: 'JSON',

            url: '../Control/CommunicationHandler.php',

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
