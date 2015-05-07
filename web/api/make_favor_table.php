<?php
session_start();
require_once('../model/common_query.php');
require_once('../admin/auth/db_auth.php');
$db=new commonQuery();
$user_id=$_SESSION['user_id'];

$res=$db->getFavor($user_id);
if($res) echo json_encode($res);
else echo json_encode([])
?>
