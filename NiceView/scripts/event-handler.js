
$(function() {

    var conf = {
    animationSpeed : 300
  }

  var $checkInButton = $('.quick-access-button.check-in');
  var $checkInWindow = $('.check-in-window');

  $checkInButton.on('click', function(){
    $checkInWindow.fadeIn(conf.animationSpeed, function(){
      $('#check-in-form input').focus();
    });
  });

  $checkInWindow.on('keydown', function(event){
    if (event.keyCode === 27) $checkInWindow.fadeOut(conf.animationSpeed);
  });

  $checkInWindow.on('click', '.close', function(){
    $checkInWindow.fadeOut(conf.animationSpeed);
  });

});