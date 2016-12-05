/**
 * Created by isisramirez on 12/5/16.
 */
var $assistanceButton = $('#assistance');
var $paymentsButton = $('#payments');
var $inscriptionsButton = $('#studentInscriptions');

$assistanceButton.on('click', function(){
    $('#graph').attr('src','statistics/assistance.php');
    $(".activated").removeClass("activated");
    $('#assistance').addClass('activated');

});
$paymentsButton.on('click', function(){
    $('#graph').attr('src','statistics/payments.php');
    $(".activated").removeClass("activated");
    $('#payments').addClass('activated');

});
$inscriptionsButton.on('click', function(){
    $('#graph').attr('src','statistics/inscriptions.php');
    $(".activated").removeClass("activated");
    $('#studentInscriptions').addClass('activated');


});
