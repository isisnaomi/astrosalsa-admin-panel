$(function() {

    $( '#students-list' ).DataTable({

        'processing' : true,

        'ajax' : {

          'method' : 'POST',

          'url' : '../Control/CommunicationHandler.php',

          'dataType' : 'json',

          'dataSrc' : function( response ) {
            return response.content;
          },

          'data' : {

            'target' : 'classPackagesAdministrator',

            'type' : 'getList',

            data : {}

          }

        },

        'columns': [

            { data: 'id' },
            { data: 'name' },
            { data: 'classesIncluded' },
            { data: 'price' }

        ],

        'columnDefs': [

            {
                'targets': 4,
                'searchable': false,
                'data': null,
                'defaultContent':
                  "<span class='button button-edit'>editar</span>"
                  /* "<span class='button button-subscription'>lista</span>" */
            }

        ]


      }); // $('#students-data-table').dataTable();

}); // $.function();
