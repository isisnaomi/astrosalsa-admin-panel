
var ReportInterpreter = function() {

  var _this = this;

  _this.interpretArrayAsReport = function( reportAsArray ) {

    if ( reportAsArray.type === 'data' ) {

      return new Report( 'data', reportAsArray.content  );

    } else if ( reportAsArray.type === 'error' ) {

      return new Report( 'error', reportAsArray.content );

    } else {

      console.error( 'Invalid server answer.' );
      return false;

    }

  }

}
