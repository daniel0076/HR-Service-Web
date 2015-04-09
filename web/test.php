<?php
require('admin/auth/db_auth.php');
require('model/boss_query.php');
$db=new Boss();
$res=$db->DropdownValue("location");
print_r($res);
?>
