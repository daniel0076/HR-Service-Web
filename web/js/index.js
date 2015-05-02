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

    $('#del_modal').modal({
        closable:false,
        onApprove :
            function(){
                return false;
            },
        onDeny:
            function(){
                alert('gg');
            }
    })


    $('body').on('click','.ui.blue.tiny.button',
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
            $('#post_modal').modal('show');
        }
    )
    $('body').on('click','.ui.red.tiny.button',
            function(){
                $('#p').val($(this).parent().children().val());
                $('.ui.basic.test.modal').modal('show');
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


    $('.ui.red.button.deny').click(function(){

    })
    $('.close.icon').click(function(){

    })
    $('#moveSlideRight').click(function(){
        $.fn.fullpage.moveTo(0,1);
        setActive();
    })
    $('#moveSlideLeft').click(function(){
        $.fn.fullpage.moveTo(0,2);
        setActive();
    })
    $('#mainpage').click(function(){
        $.fn.fullpage.moveTo(0,0);
        setActive();
    })
    $('#salarySortASC').click(function(){
        sortBy("asc");
    })
    $('#salarySortDESC').click(function(){
        sortBy("desc");
    })
});


function setActive() {
    if ($('#slideIndex').hasClass("active")) {
        $('#moveSlideRight,#moveSlideLeft').removeClass("active");
    }else if ($('#slideJobseeker').hasClass("active")) {
        $('#moveSlideLeft').removeClass("active");
        $('#moveSlideRight').addClass("active");
    }else if ($('#slideAppli').hasClass("active")) {
        $('#moveSlideRight').removeClass("active");
        $('#moveSlideLeft').addClass("active");
    }
};

function sortBy(sort){
    $.get("api/make_recruit_table.php?sort="+sort,function(data){
        $('#recruitTable').html(data);
    });

}
