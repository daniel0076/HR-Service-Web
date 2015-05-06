<?php
require_once('../admin/auth/db_auth.php');
require_once('../model/common_query.php');
$form=json_decode(file_get_contents('php://input'),true);
$fid=$form['fid'];
$db=new commonQuery();
$res=$db->delFavorite($fid);
if($res)return true;
return false;
?>
