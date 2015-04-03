$(document).ready(function(){
    $('#jobseekerform').form({
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
        education: {
            identifier  :'education',
            rules: [
            {
                type    :'empty',
                prompt  :'Please select your highest education!'
            }
            ]
        },
        expected_salary: {
            identifier  :'expected_salary',
            rules: [
            {
                type    :'integer',
                prompt  :'Please select the salary you expected to get!'
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
        },
        gender: {
            identifier  :'gender',
            rules: [
            {
                type    :'maxLength[10]',
                prompt  :'Please enter your gender!'
            }
            ]
        },
        age: {
            identifier  :'age',
            rules: [
            {
                type    :'integer',
                prompt  :'Please enter your age!'
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
        }
    },{
        inline          :'true',
        on              :'change'
    });
});
