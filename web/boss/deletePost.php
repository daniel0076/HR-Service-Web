<?php
session_start();
if(!isset($_SESSION['is_boss']))
{
    header("Location: ../index.php");
}
require_once('../admin/auth/db_auth.php');
require_once('../model/boss_query.php');
if(isset($_POST['p']))
{
    $db = new Boss();
    if($db->checkPermission($_SESSION['boss_id']))
    {
        $res=$db->deletePost($_POST['p']);
    }
    header("Location: ../index.php");
}
?>
