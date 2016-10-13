
/**
* RequestSender
* Class
* Sends a Request to the domain and returns the Report.
*/
var RequestSender;

$(function() {

  RequestSender = function() {

    var _this = this;

    /**
     * @var ReportInterpreter
     */
    _this.reportInterpreter = new ReportInterpreter();


    /**
     * @param Request request
     * @return Report report
     */
    _this.sendRequest = function( request ) {

      var ajax = $.ajax({

        'url': '../Control/RequestReceiver.php',
        'dataType': 'JSON',
        'type': 'POST',

        'data': {
          'target' : request.getTarget(),
          'type' : request.getType(),
          'data' : request.getData()
        },

        beforeSend: function() {
          console.log( 'About to send data through AJAX' );
        },

        success: function() {
          console.log( 'Communication successful.' );
        },

        error: function( xhr, statusText ) {
          console.error( 'Communication error: ' + statusText + ' - ' + xhr);
        },

      });

      var report = ajax.always(function( data ) {

        return _this.reportInterpreter.interpretArrayAsReport( data );

      });

      return report;

    }

  }

});
