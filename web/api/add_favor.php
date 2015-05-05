<?php
session_start();
require_once('../model/user_query.php');
require_once('../admin/auth/db_auth.php');
$db=new JobSeeker();
if( !isset($_SESSION['is_authed']) || isset($_SESSION['is_boss']) ){
    header('Location: ../index.php');
}
$user_id=$_SESSION['user_id'];
if(isset($_POST['rid'])) $rid=$_POST['rid'];
if(isset($_GET['rid'])) $rid=$_GET['rid'];
$db->addFavorite($user_id,$rid);
if(!$db)echo "Add Favorite Failed";
?>
