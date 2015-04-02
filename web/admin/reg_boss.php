<?php
    require('./auth/db_auth.php');
    require('../query/query.php');
    $db = new Boss();
    $res = $db->BossRegister($_POST['account'],$_POST['password'],$_POST['phone'],$_POST['email']);
    if(!$res)
    {
        echo 'Account already exist!';
        header('Location: reg_boss_page.php');
    }
    else
    {
        header('Location: ../index.php');
    }
?>
