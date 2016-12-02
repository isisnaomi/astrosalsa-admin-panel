
$(function() {

  /**
  * WindowController
  * Class
  * Controls user-window interaction.
  * Access a RequestSender to ask the domain
  * for adding, updating or getting data when
  * view asks for it.
  */
  var WindowController = function() {

    var _this = this;

    /**
    * @var RequestSender
    */
    _this.requestSender = new RequestSender();

    /**
    * @var JQuery[][]
    */
    _this.domElements = {
      $button : $('input:button'),
      $input : $('input:text')
    };


    /**
    * Procedure: turn listed event listeners on.
    */
    _this.turnOnEventListeners = function() {

      _this.domElements.$button.on('click', function() {

        var data = {

          'target' : 'studentsAdministrator',
          'type' : 'getList',

          'data' : {
            '*': '*'
            //'name' : _this.domElements.$input.val()
          }

        };

        var request = new Request( data );
        var report = _this.requestSender.sendRequest( request );

      });

    }

  }



/**
 * Main procedure in JavaScript code
 */
  var Main = function() {

    var windowController = new WindowController();
    windowController.turnOnEventListeners();

  };

  Main();

});
