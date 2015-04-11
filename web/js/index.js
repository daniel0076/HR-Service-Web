$(document).ready(function(){
    $('#post_modal').modal({
        closable:false,
        onApprove :
            function(){
                return false;
            }
    }).modal('attach events','#post_button','show');
    $('#post_modal').modal('attach events','#editButton','show');

    $('#editButton').click(
        function(){
            $('#modal_header').html('Edit Post');
            $('#re_loca').val($('#loca').value);
            $('#modal_edit').val($('#recruit_id').val());
            
        }
    )

    $('#post_button').click(
        function(){
            $('#modal_header').html('New Post');
            $('#modal_edit').val(0);
        }
    )

    $('#modal_msg').hide();

    $('.ui.small.modal').modal('attach events','#delPostButton','show');

    $('.dropdown').dropdown();
});
