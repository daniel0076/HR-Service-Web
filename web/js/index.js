var lastClickedApply;
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
                $('#del_modal').modal('show');
            }
            )
    $('body').on('click','#apply',
            function(){
//                $(this).addClass('clicked');
//
                lastClickedApply=$(this);
                $('#apply_num').val($(this).parent().children().val());
                $('#apply_modal').modal('show');
            }
            )

    $('body').on('click','#cancelDel',
            function(){
                $('#del_modal').modal('hide');
            }
            )
    $('body').on('click','#cancelApp',
            function(){
                $('#apply_modal').modal('hide');
            }
            )
    $('body').on('click','#applyConf',function(){
        $.ajax({
            method:"POST",
            url:"hrdb/apply.php",
            data:{apply_num:$(this).parent().children().val()},
            async:true,
            success:function(result){
              lastClickedApply.parent().html("<div class='ui red button'>已申請</div>");
                $('#apply_modal').modal('hide');}
//          $.post("hrdb/apply.php",$('#applyform').serialize(),function(result){
//              $('.ui.green.button').parent().html("<div class='ui red button'>已申請</div>");
          });

      })


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
});

function addFavor(rid){
    $.post( "api/add_favor.php",{rid:rid}, function( data ) {
        //call angular in function
        angular.element('#tableCtrl').scope().search();
        angular.element('#tableCtrl').scope().getFavor();
    });
}


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
    $('#searching').click(function(){
        $('.ui.striped.table').remove();
    })
};

