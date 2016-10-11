
var Report = function( type, content ) {

  var _this = this;

  _this._type = type;
  _this._content = content;

  _this.getType = function() {
    return _this._type;
  }

  _this.getContent = function() {
    return _this._content;
  }

}
