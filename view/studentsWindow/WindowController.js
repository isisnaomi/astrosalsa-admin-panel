
$(function() {

  var Report = function( type, content ) {

    var _this = this;

    this._type = type;
    this._content = content;

    this.getType = function() {
      return _this._type;
    }

    this.getContent = function() {
      return _this._content;
    }

  }

  var RequestSender = function() {

    var _this = this;

    console.log('Converting array into report');

    this._convertArrayToReport = function( array ) {

      if ( array.type === 'data' ) {

        return new Report( 'data', array.content  );

      } else if ( array.type === 'error' ) {

        return new Report( 'error', array.content );

      } else {

        console.error( 'Invalid server answer.' );
        return false;

      }

    }

    this.sendRequest = function( data ) {

      var ajax = $.ajax({
        'url': '../../requestReceiver.php',
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

      var report = ajax.always(function( data ) {

        console.log( 'The data we got: ' );
        console.log( data );
        return _this._convertArrayToReport( data );

      });

      return report;

    }

  }

  var WindowController = function() {
    this.requestSender = RequestSender;
  }

  var domElements = {
    $button : $('input:button'),
    $input : $('input:text')
  }

  domElements.$button.on('click', function() {

    console.log( 'add button has been clicked' );

    var data = {
      'target' : 'studentsAdministrator',
      'type' : 'add',
      'data' : {
        'name' : domElements.$input.val(),
      }
    }

    var requestSender = new RequestSender();
    var report = requestSender.sendRequest( data );

  });

});
