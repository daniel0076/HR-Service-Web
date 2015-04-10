<?php
session_start();
if(!isset($_SESSION['is_boss']))
{
    header("Location: ../index.php");
}
require_once('../admin/auth/db_auth.php');
require_once('../model/boss_query.php');
if(isset($_GET['p']))
{
    $db = new Boss();
    $res=$db->deletePost($_GET['p']);
    header("Location: ../index.php");
}
?>
