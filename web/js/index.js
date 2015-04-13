$(document).ready(function(){
    $('.ui.dropdown').dropdown();
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
            $('#modal_edit').val(1);
            changeValue('#location_id',$(this).parent().children('#loca').val());
            changeValue('#occupation_id',$(this).parent().children('#occu').val());
            changeValue('#worktime',$(this).parent().children('#work').val());
            changeValue('#education',$(this).parent().children('#educa').val());
            changeValue('#experience',$(this).parent().children('#exp').val());
            changeValue('#salary',$(this).parent().children('#sal').val());

        }
    )
    function changeValue(dropdownID,value){
            $('.ui.dropdown.selection').has(dropdownID).dropdown('set selected',value);
    }

    $('#post_button').click(
        function(){
            $('#modal_header').html('New Post');
            $('#modal_edit').val(0);
            $('.ui.dropdown.selection').has('#locaion_id,#occupation_id,#worktime,#education,#experience,#salary').dropdown('restore default text');
        }
    )


    $('.ui.red.tiny.button').click(
            function(){
                $('#p').val($(this).parent().children().val());
            }
            )
    $('.ui.basic.test.modal').modal('attach events','.ui.red.tiny.button','show');
    $('.ui.red.button.deny').click(function(){

    })
    $('.close.icon').click(function(){

    })

});
