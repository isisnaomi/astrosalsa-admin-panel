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

            'target' : 'studentsAdministrator',

            'type' : 'getList',

            data : {}

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
