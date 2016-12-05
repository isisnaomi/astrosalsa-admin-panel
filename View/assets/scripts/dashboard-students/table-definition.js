$(function() {

    var table = $( '#students-list' ).DataTable({

        'processing' : true,

        'ajax' : {

          'method' : 'POST',

          'url' : '../Control/CommunicationHandler.php',

          'dataType' : 'json',

          'dataSrc' : function( response ) {
            return response.content;
          },

          'data' : {

            'target' : 'studentsAdministrator',

            'type' : 'getList',

            data : {}

          },

          complete: function( response ) {

            var setPhotos = function() {
              $( 'tr' ).each(function( indexTr, tr ) {

                var id = 0;

                $( tr ).find( 'td' ).each(function( indexTd, td ) {

                  if ( indexTd === 0 ) {
                    id = $( this ).text();
                  }

                  if ( indexTd === 2 ) {
                    $( this ).find('img').attr('src', 'photos/' + id + '.jpg' );
                  }

                });

              });
            }

            setTimeout(setPhotos, 800);
            setTimeout(setPhotos, 8000);

          }

        },

        'columns': [

            { data: 'id' },
            { data: 'name' }

        ],

        'columnDefs': [

            {
                'targets': 2,
                'searchable': false,
                'data': null,
                'defaultContent':
                  "<img class='student-photo' src='' alt='profile-image' width='32px' height='32px' onerror=\"this.src='photos/0.jpg'\" />"
            },
            {
                'targets': 3,
                'searchable': false,
                'data': null,
                'defaultContent':
                  "<span class='button button-edit'>editar</span>" +
                  "<span class='button button-subscription'>subscripción</span>"
            }

        ],

        'lengthMenu': [
          [5, 10, 20, -1],
          [5, 10, 20, 'All']
        ],

        'iDisplayLength': 10,

        'order': [0, 'des']


      }); // $('#students-data-table').dataTable();

}); // $.function();
