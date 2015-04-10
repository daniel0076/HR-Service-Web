$(document).ready(function(){
    $('#post_modal').modal({
        closable:false,
        onApprove : 
            function(){
                return false;
            }
    }).modal('attach events','#post_button','show');
});
$(document).ready(function(){
    $('.dropdown').dropdown();
});
