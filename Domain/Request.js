/**
* Request
* Includes the target, the type and data of the request
* in javascript lenguage
*/
var Request;

$(function(){

  Request = function( data ) {

    var _this = this;

    /**
    * @var string
    */
    _this.target = data.target;

    /**
    * @var string
    */
    _this.type = data.type;

    /**
    * @var string[][]
    */
    _this.data = data.data;


    /**
    * @return string  _this.target
    */
    _this.getTarget = function() {

      return _this.target;

    }

    /**
    * @return string _this.type
    */
    _this.getType = function() {

      return _this.type;

    }

    /**
    * @return string[][] _this.data
    */
    _this.getData = function() {

      return _this.data;

    }

  }

});
