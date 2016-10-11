
var RequestSender;

$(function(){

  RequestSender = function() {

    var _this = this;
    _this.reportInterpreter = new ReportInterpreter();

    _this.sendRequest = function( data ) {

      var ajax = $.ajax({
        'url': '../Control/RequestReceiver.php',
        'dataType': 'JSON',
        'type': 'POST',
        'data': data,

        beforeSend: function() {
          console.log( 'About to send data through AJAX' );
        },

        success: function() {
          console.log( 'Communication successful.' );
        },

        error: function( xhr, statusText ) {
          console.error( 'Communication error: ' + statusText );
        },

        complete: function( data ) {
          console.log( 'The data we got: ' );
          console.log( data );
        }
      });

      // SUCCESS FUNCTION CALLBACK
      var report = ajax.always(function( data ) {

        console.log( 'The data we got: ' );
        console.log( data );
        return _this.reportInterpreter.interpretArrayAsReport( data );

      });

      return report;

    }

  }

});
