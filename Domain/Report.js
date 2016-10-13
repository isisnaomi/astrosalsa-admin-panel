
/**
* Report
* Includes type of report: data || error
* and the content generated after a requested action
* in javascript lenguage
*/
var Report = function( type, content ) {

  var _this = this;

  /**
  * @var string
  */
  _this._type = type;

  /**
  * @var string[][]
  */
  _this._content = content;


  /**
  * @return string _type
  */
  _this.getType = function() {

    return _this._type;

  }

  /**
  * @return string[][] _content
  */
  _this.getContent = function() {

    return _this._content;

  }

}
