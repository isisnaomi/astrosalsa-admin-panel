$(function() {


  function getQueryVariable( variable ) {

    var query = window.location.search.substring( 1 );

    var vars = query.split( '&' );

    for ( var i = 0; i < vars.length; i++ ) {

      var pair = vars[i].split( '=' );

      if (pair[0] == variable)
        return pair[1];

    }

    return false;
  }

  var action = getQueryVariable( 'action' );

  if ( action ) {

    if ( action === 'addStudent' ) {

      $( '.add-student-window' ).css( 'display', 'block' );

    } else if ( action === 'payment' ) {

      $( '.subscription-window' ).css( 'display', 'block' );

    }

  }


  $.ajaxSetup({
    beforeSend: function() {
      console.log( 'About to send an AJAX request.' );
    },
    complete: function( response ) {
      console.log( 'AJAX request server response:' );
      console.log( response );
    },
    success: function() {
      showSuccessMessage();
    },
    error: function() {
      showFailMessage();
    }
  });

  var getStudentId = function( cell ) {

    var td = $( cell ).parent();
    var tr = $( td ).parent();

    var studentIdTd = $( tr ).children()[0];
    var studentId = $( studentIdTd ).text();

    return studentId;

  }

  var getStudentName = function( cell ) {

    var td = $( cell ).parent();
    var tr = $( td ).parent();

    var studentNameTd = $( tr ).children()[1];
    var studentName = $( studentNameTd ).text();

    return studentName;

  }

  var waitAndReloadWindow = function( miliseconds ) {

    miliseconds = miliseconds || 0;

    setTimeout(function() {
      window.location.href = '';
    }, miliseconds);

  }

  var showSuccessMessage = function() {

    $('.popup-window.success-message')
      .css('display', 'block');

    waitAndReloadWindow( 1000 );

  }

  var showFailMessage = function() {

    $('.popup-window.fail-message')
      .css('display', 'block');

    waitAndReloadWindow( 500 );

  }


  $( '.button-cancel' ).on('click', function( event ) {

    $( this ).parents( '.popup-window' )
      .css( 'display', 'none' )
      .find('input:text').val('');

  });


  /* Subscription POPUP listeners */

  $( 'body' ).on('click', '.button-subscription', function( event ) {

    var studentId = getStudentId( this );
    var studentName = getStudentName( this );

    $( '.subscription-window' )
      .css( 'display', 'block' )
      .find( 'form' )
        .css( 'display', 'block' );

    $( '.subscription-window' )
      .find( 'input:text[name="name"]' )
        .val( '('+ studentId +') ' + studentName )
        .attr( 'id', studentId );


    $.ajax({

      data: {
        target: 'classPackagesAdministrator',
        type: 'getList',
        data: {}
      },
      success: function( response ) {

        var classPackages = response.content;
        var optionsHtml = '';

        $.each( classPackages, function( index, classPackage ) {

          optionsHtml +=
            "<option value='"+ classPackage.id +"'>" +
              "("+ classPackage.id +") " + classPackage.name +
            "</option>";

        });

        $( '.subscription-window' )
          .find( 'select[name="package"]' ).html( optionsHtml );

      }

    });

  });


  $( '.subscription-window' )
    .find( '.button-ok' ).on('click', function( event ) {

      var studentId =
        $( '.subscription-window' )
          .find( 'input:text[name="name"]' )
          .attr( 'id' );

      var packageId =
        $( '.subscription-window' )
          .find( 'select[name="package"]' )
          .val();

      var paymentDay =
        $( '.subscription-window' )
          .find( 'select[name="paymentDay"]' )
          .val();

      $.ajax({
        data: {
          target: 'subscriptionsAdministrator',
          type: 'payment',
          data: {
            studentId: studentId,
            packageId: packageId,
            paymentDay: paymentDay
          }
        },
        success: function( paymentResponse ) {

          var isPaymentRequestSuccessful = paymentResponse.type !== 'error';

          if ( isPaymentRequestSuccessful ) {

            window.open( 'ticket.php?content=' + paymentResponse.content.ticket );
            showSuccessMessage();

          } else {

            showFailMessage();

          }

        }

        // Default error callback
      });

    });


  /* Edit student POPUP listeners */


  $( 'body' ).on('click', '.button-edit', function( event ) {

      $( '.edit-student-window' ).css( 'display', 'block' );

      $( '.edit-student-window' )
        .find('input:text[name="id"]').val( getStudentId( this ) );

      $( '.edit-student-window' )
        .find('input:text[name="name"]').val( getStudentName( this ) );

  });


  $( '.edit-student-window' ).find( '.button-ok' ).on('click', function() {

    var name = $( '.edit-student-window' ).find( 'input[name="name"]' ).val();
    var id = $( '.edit-student-window' ).find( 'input[name="id"]' ).val();

    $.ajax({
      data : {
        target : 'studentsAdministrator',
        type : 'update',
        data : {
          attributes: {
            name : name
          },
          filter : 'id=' + id
        }
      }
    });

  });


  $( '.edit-student-window' ).find( '.button-delete' ).on('click', function() {

    var name = $( '.edit-student-window' ).find( 'input[name="name"]' ).val();
    var id = $( '.edit-student-window' ).find( 'input[name="id"]' ).val();

    var hasDeleteConfirmation = confirm("¿Eliminar al alumno: ("+ id +") "+ name +"?");

    if ( hasDeleteConfirmation ) {

      $.ajax({
        data: {
          target: 'studentsAdministrator',
          type: 'delete',
          data: {
            filter: 'id=' + id
          }
        }
      });

    }

  });



  /* Add Student POPUP listeners */

  $( '.button-add-student' ).on('click', function( event ) {

    $( '.add-student-window' ).css( 'display', 'block' );

  });


  $( '.add-student-window' ).find( '.button-ok' ).on('click', function() {

    var firstName = $( '.add-student-window' ).find( 'input[name="first-name"]' ).val();
    var lastName = $( '.add-student-window' ).find( 'input[name="last-name"]' ).val();
    var name = firstName + ' ' + lastName;

    $.ajax({
      data : {
        target : 'studentsAdministrator',
        type : 'add',
        data : {
          name : name
        }
      },
      success: function( response ) {

        var studentId = response.content;

        console.log( studentId );

        $.ajax({

          data: {
            target: 'subscriptionsAdministrator',
            type: 'add',
            data: {
              'studentId': studentId,
              'packageId': '0',
              'classesRemaining': '0',
              'paymentDay': '15'
            }
          }

          /* Default success and error */

        });

      }
    });

  });

});
