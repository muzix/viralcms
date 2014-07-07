$( document ).ready(function() {

$('#table-ranking').show();
$('#table-code').hide();

$('#panel-ranking').click(function() {
    $('#table-ranking').show();
    $('#table-code').hide();
});

$('#panel-code').click(function() {
    $('#table-ranking').hide();
    $('#table-code').show();
});

});