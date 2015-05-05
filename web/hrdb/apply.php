<?php   
session_start();
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']))
{
if(!isset($_SESSION['is_user']))
{
    header("Location: ../index.php");
    die();
}
require_once('../model/common_query.php');
require_once('../admin/auth/db_auth.php');
$db=new commonQuery();
if(isset($_POST['apply_num']))
{
    $res=$db->apply($_SESSION['user_id'],$_POST['apply_num']);
    #    header("Location: index.php");
    return true;
}
}
?>
