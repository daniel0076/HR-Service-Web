$(document).ready(function(){
    $('#post_modal').modal({
        closable:false,
        onApprove :
            function(){
                return false;
            }
    }).modal('attach events','#post_button','show');

    $('#modal_msg').hide();

    $('.ui.small.modal').modal('attach events','#delPostButton','show');

    $('.dropdown').dropdown();
});
