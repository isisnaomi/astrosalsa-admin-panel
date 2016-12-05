$(function() {

  var table = $('#dtAssistance').DataTable({

      "processing": true,

      "ajax": {
          "method": "POST",
          "url": "../../Control/CommunicationHandler.php", //cambiar por CommunicationHandler
          "dataType": "json",
          "dataSrc": function( response ) {
            return response.content;
          },
          //data: {
          //  'target' : 'subscriptionsAdministrator',
          //  'type' : 'getPaymentLog',
          //  'data' : {
          //    initDate: '20150101',
          //    finalDate: '20170101'
          //  }
          //}
          "data": {
              target: "subscriptionsAdministrator",
              type: "getAssistanceLog",
              data: {
                initDate: '20150101',
                finalDate: '20170101'
             }
          }
      },

      "columns": [
          {data: "studentId"},
          {data: "date"},
          {data: "time"}
      ],
      "order": [0, "des"],
      "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, 'All']],

  });

  var refreshGraphic = function () {
      var allDates = table.columns(1).data().toArray();
      // var allTimes = table.columns(2).data().toArray();
      //
      // $.each(allDates, function( index, date ) {
      //   date += allTimes[index];
      // });

      var datesForTheGraph = [];
      var assistance = [];
      var commonIndex = 0;

      $.each( allDates[0], function ( index, date ) {

          var matchIndex = $.inArray( date, datesForTheGraph ); //Return -1 when doesnt find coincidences

          if ( matchIndex > -1 ) {

              assistance[ matchIndex ]++;

          }

          else {

              datesForTheGraph[ commonIndex ] = date;
              assistance[ commonIndex ] = 1;
              commonIndex++;

          }

      });

      datesForTheGraph.reverse();

      var data = [
          {
              x: datesForTheGraph,
              y: assistance,
              type: ['bar', 'scatter'],
              marker: {
                  color: 'rgb(76, 175, 80)'
              }
          }
      ];

      Plotly.newPlot('bar-table', data);
  };


  var initDate = '20161201';
  var finalDate = '20161230';

  $("#btn-filtrar").click(function(){
      //initDate = $("#dateDe").val();
      //finalDate = $("#dateHasta").val();
      table.ajax.reload();
      refreshGraphic;
  });
  $('#dtAssistance').on('draw.dt length.dt processing.dt', refreshGraphic);

});
