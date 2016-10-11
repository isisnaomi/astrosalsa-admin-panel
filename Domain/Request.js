
var Request;

$(function(){

  Request = function( data ) {

    var _this = this;

    _this.target = data.target;
    _this.type = data.type;
    _this.data = data.data;

    _this.getTarget = function() {
      return _this.target;
    }

    _this.getType = function() {
      return _this.type;
    }

    _this.getData = function() {
      return _this.data;
    }

  }

});
