$(document).ready(function(){
    $('#post_modal').modal('attach events','#post_button','show');
});
$(document).ready(function(){
    $('.ui.search.dropdown').dropdown();
    $('#modal_msg').hide();
});
function Error() {
    $('#modal_msg').addClass("error").show();
}
