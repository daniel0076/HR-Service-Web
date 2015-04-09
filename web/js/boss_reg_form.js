function accountExist() {
    $('#response').removeClass("blue").removeClass("positive").addClass("error").show();
};
function Error() {
    $('#response').removeClass("blue").removeClass("positive").addClass("error").show();
};
function Succeeded() {
    $('#response').removeClass("blue").removeClass("error").addClass("positive").show();
};

$(document).ready(function(){
   $('#response').hide();
   $('#bossform').form({
       account: {
           identifier  :'account',
           rules: [
           {
               type    :'length[4]',
               prompt  :'Please enter your account! At least 4 characters'
           },
           {
               type    :'maxLength[30]',
               prompt  :'Your account name can\'t longer than 30 characters'
           }
           ]
       },
       password: {
            identifier  :'password',
            rules: [
            {
                type    :'length[8]',
                prompt  :'Your password must be at least 8 characters!'
            }
            ]
        },
        password: {
            identifier  :'conpassword',
            rules: [
            {
                type    :'length[8]',
                prompt  :'Your password must be at least 8 characters!'
            },
            {
                type    : 'match[password]',
                prompt  : 'Password doesn\'t match!'
            }
            ]
        },
        email: {
            identifier  :'email',
            rules: [
            {
                type    :'maxLength[50]',
                prompt  :'Please enter your email!'
            },
            {
                type    :'contains[@]',
                prompt  :'Invalid email!'
            }
            ]
        },
        phone: {
            identifier  :'phone',
            rules: [
            {
                type    :'length[8]',
                prompt  :'Please enter your phone number!'
            }
            ]
        }
    },{
        inline          :'true',
        on              :'change'
    });
});
