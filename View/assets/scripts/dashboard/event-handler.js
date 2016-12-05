$(function() {

  var studentId;
  var classesRemaining;

  var setClassesRemaining = function( classesRemaining ) {
    $( '.identified-student' )
      .find( '.classes-left' )
        .text( classesRemaining + ' clases restantes' );
  }

  var setName = function( name ) {
    $( '.identified-student' )
      .find( '.name' )
        .text( name );
  }

  $.ajaxSetup({

    beforeSend: function() {
      console.log( 'About to send a AJAX request.' );
    },
    error: function() {
      console.error( 'RIP' );
    },
    complete: function( response ) {
      console.log( response );
    }

  });

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

  $checkInWindow.on('keydown', '#student-id', function( event ) {

    if ( event.keyCode === 27 )
      $checkInWindow.fadeOut( conf.animationSpeed );

    else if ( event.keyCode === 13 ) {
      identifyStudent( $( this ).val() );
      return false;
    }


  });

  $checkInWindow.on('click', '.close', function(){
    $checkInWindow.fadeOut(conf.animationSpeed, function() {
      $( '.identified-student' ).css( 'display', 'none' );
      $('#student-id')
        .val('')
        .removeAttr( 'disabled' )
        .focus();
    });
  });


  function identifyStudent( studentId ) {

    $( '.identified-student' )
      .removeClass( 'success' )
      .find( '.confirmation-buttons .cancel' )
        .css( 'display', 'block' );

    $.ajax({

      data: {
        target: 'studentsAdministrator',
        type: 'getStudentById',
        data: {
          'id' : studentId
        }
      },
      success: function( studentRequestResponse ) {

        var isStudentRequestSuccessful = studentRequestResponse.type !== 'error';

        if ( isStudentRequestSuccessful ) {

          studentId = studentRequestResponse.content.id;
          setName( studentRequestResponse.content.name );
          $('#student-id')
            .css('border', '0');

          $.ajax({
            data: {
              target: 'subscriptionsAdministrator',
              type: 'getSubscriptionByStudentId',
              data: {
                studentId: studentId
              }
            },
            success: function( subscriptionRequestResponse ) {

              var isSubscriptionRequestSuccessful = subscriptionRequestResponse.type !== 'error';

              if ( isSubscriptionRequestSuccessful ) {

                classesRemaining = subscriptionRequestResponse.content.classesRemaining;

                setClassesRemaining( classesRemaining );

                $( '.identified-student' )
                  .css( 'display', 'block' );

                $( '#student-id' ).attr( 'disabled', 'disabled' );

                if ( classesRemaining < 1 ) {
                  $( '.identified-student' )
                    .find( '.confirmation-buttons .confirm' )
                      .css( 'display', 'none' );
                } else {
                  $( '.identified-student' )
                    .find( '.confirmation-buttons .confirm' )
                      .css( 'display', 'block' );
                }

              } else {

                console.error( 'error' );
                window.location.href = '';

              }

            }
          });

        } else {

          $('#student-id')
            .css('border', '5px solid red')
            .val('');

        }

      }

    });

  }

  $('.confirmation-buttons .cancel').on('click', function() {

    $( '.identified-student' ).css( 'display', 'none' );
    $('#student-id')
      .val('')
      .removeAttr( 'disabled' )
      .focus();

  });

  $('.confirmation-buttons .confirm').on('click', function() {

    $( this )
      .css( 'display', 'none' );

    $.ajax({
      data: {
        target: 'subscriptionsAdministrator',
        type: 'checkIn',
        data: {
          'id' : $( '#student-id' ).val()
        }
      },
      success: function( checkInResponse ) {

        var isCheckInRequestSuccessful = checkInResponse.type !== 'error';

        if ( isCheckInRequestSuccessful ) {

          setClassesRemaining( classesRemaining - 1 );
          $( '.confirmation-buttons div' )
            .css( 'display', 'none' );

          $( '.identified-student' )
            .addClass('success');

          setTimeout(function() {

            $( '.identified-student' ).css( 'display', 'none' );
            $('#student-id')
              .val('')
              .removeAttr( 'disabled' )
              .focus();

          }, 2000);

        } else {

          console.error( 'error' );
          window.location.href = '';

        }

      }
    });

  });

});
