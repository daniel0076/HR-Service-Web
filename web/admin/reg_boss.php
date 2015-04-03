<?php
    session_start();
    if(isset($_SESSION['is_boss']))
    {
        header('Location: ../index.php');
    }
    require('./auth/db_auth.php');
    require('../model/boss_query.php');
    $db = new Boss();
    $res = $db->BossRegister($_POST['account'],$_POST['password'],$_POST['phone'],$_POST['email']);
    if(!$res)
    {
        echo 'Account already exist!';
        header('Location: ../boss_reg.php');
    }
    else
    {
        header('Location: ../index.php');
    }
?>
