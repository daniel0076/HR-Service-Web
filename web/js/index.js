$(document).ready(function(){
    $('#post_modal').modal({
        closable:false,
        onApprove :
            function(){
                return false;
            },
        onDeny:
            function(){
                $('#modal_msg').html('');
            }
    }).modal('attach events','#post_button','show');
    $('#post_modal').modal('attach events','.ui.blue.tiny.button','show');

    $('.ui.blue.tiny.button').click(
        function(){
            var rid=($(this).parent().children('#recruit_id').val());
            $('#modal_rid').val(rid);
            $('#modal_header').html('Edit Post');
            $('#modal_edit').val($('#recruit_id').val());
            $('#location_id').dropdown('set selected',$(this).parent().children('#loca').val())
            $('#occupation_id').dropdown('set selected',$(this).parent().children('#occu').val())
            $('#worktime').dropdown('set selected',$(this).parent().children('#work').val())
            $('#education').dropdown('set selected',$(this).parent().children('#educa').val())
            $('#experience').dropdown('set selected',$(this).parent().children('#exp').val())
            $('#salary').dropdown('set selected',$(this).parent().children('#sal').val())

    $('.dropdown').dropdown('clear');
        }
    )

    $('#post_button').click(
        function(){
            $('#modal_header').html('New Post');
            $('#modal_edit').val(0);
    $('.dropdown').dropdown('restore default text');
        }
    )


    $('.ui.red.tiny.button').click(
            function(){
//                alert($(this).parent().children().val());
                $('#p').val($(this).parent().children().val());
//                alert($('#p').val());
            }
            )
    $('.ui.basic.test.modal').modal('attach events','.ui.red.tiny.button','show');


});
