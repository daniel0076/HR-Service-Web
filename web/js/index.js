$(document).ready(function(){
    $('#post_modal').modal({
        closable:false,
        onApprove :
            function(){
                return false;
            }
    }).modal('attach events','#post_button','show');
    $('#post_modal').modal('attach events','.ui.blue.tiny.button','show');

    $('.ui.blue.tiny.button').click(
        function(){
            var rid=($(this).parent().children('#recruit_id').val());
            alert(rid);
            $('#modal_rid').val(rid);
            $('#modal_header').html('Edit Post');
            $('#modal_edit').val('1');

        }
    )

    $('#post_button').click(
        function(){
            $('#modal_header').html('New Post');
            $('#modal_edit').val(0);
    $('.dropdown').dropdown('restore default text');
        }
    )

    $('#modal_msg').hide();

    $('.ui.basic.test.modal').modal('attach events','.ui.red.tiny.button','show');


});
