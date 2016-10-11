
$(function() {

  var WindowController = function() {

    var _this = this;

    _this.requestSender = new RequestSender();

    _this.domElements = {
      $button : $('input:button'),
      $input : $('input:text')
    };

    _this.turnOnEventListeners = function() {

      _this.domElements.$button.on('click', function() {

        console.log( 'add button has been clicked' );

        var data = {
          'target' : 'studentsAdministrator',
          'type' : 'add',
          'data' : {
            'name' : _this.domElements.$input.val()
          }
        };

        var request = new Request( data );
        var report = _this.requestSender.sendRequest( request );

      });


    }

  }

  var Main = function() {
    var windowController = new WindowController();
    windowController.turnOnEventListeners();
  }

  Main();

});
