$(function() {

  $.ajaxSetup({

    beforeSend: function() {
      console.log( 'About to send an AJAX request.' );
    },

    complete: function( response ) {
      console.log( 'AJAX request server response:' );
      console.log( response );
    },

    success: function( response ) {


      var isRequestSuccessful = response.type !== 'error';

      if ( isRequestSuccessful ) {

        showSuccessMessage();

      } else {

        showFailMessage();

      }

    },
    error: function() {
      showFailMessage();
    }
  });

  var getPackageId = function( cell ) {

    var td = $( cell ).parent();
    var tr = $( td ).parent();

    var packageIdTd = $( tr ).children()[0];
    var packageId = $( packageIdTd ).text();

    return packageId;

  }

  var getPackageName = function( cell ) {

    var td = $( cell ).parent();
    var tr = $( td ).parent();

    var packageNameTd = $( tr ).children()[1];
    var packageName = $( packageNameTd ).text();

    return packageName;

  }

  var getPackageClassesIncluded = function( cell ) {

    var td = $( cell ).parent();
    var tr = $( td ).parent();

    var packageClassesIncludedTd = $( tr ).children()[2];
    var packageClassesIncluded = $( packageClassesIncludedTd ).text();

    return packageClassesIncluded;

  }

  var getPackagePrice = function( cell ) {

    var td = $( cell ).parent();
    var tr = $( td ).parent();

    var packagePriceTd = $( tr ).children()[3];
    var packagePrice = $( packagePriceTd ).text();

    return packagePrice;

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


  /* Edit package POPUP listeners */


  $( 'body' ).on('click', '.button-edit', function( event ) {

      $( '.edit-package-window' ).css( 'display', 'block' );

      $( '.edit-package-window' )
        .find('input:text[name="id"]').val( getPackageId( this ) );

      $( '.edit-package-window' )
        .find('input:text[name="name"]').val( getPackageName( this ) );

      $( '.edit-package-window' )
        .find('input:text[name="classesIncluded"]').val( getPackageClassesIncluded( this ) );

      $( '.edit-package-window' )
        .find('input:text[name="price"]').val( getPackagePrice( this ) );

  });


  $( '.edit-package-window' ).find( '.button-ok' ).on('click', function() {

    var id =
      $( '.edit-package-window' )
        .find( 'input[name="id"]' )
          .val();

    var name =
      $( '.edit-package-window' )
        .find( 'input[name="name"]' )
          .val();

    var classesIncluded =
      $( '.edit-package-window' )
        .find( 'input[name="classesIncluded"]' )
          .val();

    var price =
      $( '.edit-package-window' )
        .find( 'input[name="price"]' )
          .val();

    $.ajax({
      data : {
        target : 'classPackagesAdministrator',
        type : 'update',
        data : {
          attributes: {
            name : name,
            classesIncluded : classesIncluded,
            price : price
          },
          filter : 'id=' + id
        }
      }
    });

  });


  $( '.edit-package-window' ).find( '.button-delete' ).on('click', function() {

    var id =
      $( '.edit-package-window' )
        .find( 'input[name="id"]' )
          .val();

    var name =
      $( '.edit-package-window' )
        .find( 'input[name="name"]' )
          .val();

    var hasDeleteConfirmation =
      confirm("¿Eliminar el paquete: ("+ id +") "+ name +"?");

    if ( hasDeleteConfirmation ) {

      $.ajax({
        data: {
          target: 'classPackagesAdministrator',
          type: 'delete',
          data: {
            filter: 'id=' + id
          }
        }
      });

    }

  });



  /* Add package POPUP listeners */

  $( '.button-add-student' ).on('click', function( event ) {

    $( '.add-package-window' )
      .css( 'display', 'block' );

  });


  $( '.add-package-window' ).find( '.button-ok' ).on('click', function() {

    var name =
      $( '.add-package-window' )
        .find( 'input[name="name"]' )
          .val();

    var classesIncluded =
      $( '.add-package-window' )
        .find( 'input[name="classesIncluded"]' )
          .val();

    var price =
      $( '.add-package-window' )
        .find( 'input[name="price"]' )
          .val();

    $.ajax({
      data : {
        target : 'classPackagesAdministrator',
        type : 'add',
        data : {
          name : name,
          classesIncluded : classesIncluded,
          price : price
        }
      }
    });

  });

});
