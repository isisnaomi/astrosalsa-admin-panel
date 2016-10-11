
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
        }

        var report = _this.requestSender.sendRequest( data );

      });


    }

  }

  var windowController = new WindowController();
  windowController.turnOnEventListeners();

});
