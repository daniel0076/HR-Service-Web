<?php
    session_start();
    if(isset($_SESSION['is_user']))
    {
        header('Location: ../index.php');
    }
    require('auth/db_auth.php');
    require('../model/user_query.php');
    $db = new JobSeeker();
    $res = $db->JobSeekerRegister($_POST['account'],$_POST['password'],$_POST['education'],$_POST['salary'],$_POST['phone'],$_POST['gender'],$_POST['age'],$_POST['email'])
    if(!$res)
    {
        echo 'Account already exist!';
        header('Location: ../user_reg.php');
    }
    else
    {
        header('Location: ../index.php');
    }

?>
