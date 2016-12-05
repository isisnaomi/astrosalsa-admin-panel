$(function() {

  var getSQLDate = function( date ) {

    if ( ! date )
      return false;

    var splitedDate = date.split('/');

    var day = splitedDate[0];
    var month = splitedDate[1];
    var year = splitedDate[2];

    var SQLDate = year + month + day;

    alert( SQLDate );

    return SQLDate;

  }

  var table = $( '#dtAssistance' ).DataTable({

      'processing': true,

      'ajax': {

          'method': 'POST',

          'url': '../../Control/CommunicationHandler.php',

          'dataType': 'JSON',

          'dataSrc': function( response ) {
            return response.content;
          },

          error: function() {
            window.location.href = '';
          },

          'data': {
              target: 'subscriptionsAdministrator',
              type: 'getAssistanceLog',
              data: {
                initDate: '20050101',
                finalDate: '20770201'
             }
          }
      },

      'columns': [
          { data: 'studentId' },
          { data: 'date' },
          { data: 'time' }
      ],

      'columnDefs' : [
        {
          target: 2,
          searchable: false
        }
      ],

      'order': [0, 'des'],

      'lengthMenu': [
        [5, 10, 20, -1],
        [5, 10, 20, 'All']
      ]

  });

  var refreshGraphic = function () {

      var allDates = table.columns(1).data().toArray();

      var datesForTheGraph = [];
      var assistance = [];
      var commonIndex = 0;

      $.each( allDates[0], function ( index, date ) {

          var matchIndex = $.inArray( date, datesForTheGraph );

          if ( matchIndex > -1 ) {

              assistance[ matchIndex ]++;

          }

          else {

              datesForTheGraph[ commonIndex ] = date;
              assistance[ commonIndex ] = 1;
              commonIndex++;

          }

      });

      var data = [
        {
            x: datesForTheGraph,
            y: assistance,

            type: 'scatter',

            marker: {
                color: 'tomato'
            }

        }
      ];

      var layout = {
        xaxis: {type: 'category'},
      };

      Plotly.newPlot('bar-table', data, layout);
  };


  $( '#dtAssistance' )
    .on('draw.dt length.dt processing.dt ajax.dt', refreshGraphic);


});
