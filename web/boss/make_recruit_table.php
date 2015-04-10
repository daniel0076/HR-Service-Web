<?php
function make_recruit_table () {
require_once('admin/auth/db_auth.php');
require_once('model/boss_query.php');
require_once('static/xajax_core/xajaxAIO.inc.php');
$db = new Boss();
$res=$db->make_table_query();

if($res)
{
    foreach($res as $r)
    {
        $op="";
        if(isset($_SESSION['is_boss'])){
            if($r['employer_id']==$_SESSION['boss_id'])
            {
                $op.="<div class='ui blue tiny button'>修改</div>";
                $op.="<a href='boss/deletePost.php?p=".$r['id']."'><div class='ui red tiny button' id='delPostButton'>刪除</div></a>";
            }
        }
        $row="<tr>";
        $row.="<td>".$r['occupation']."</td>";
        $row.="<td>".$r['location']."</td>";
        $row.="<td>".$r['working_time']."</td>";
        $row.="<td>".$r['education']."</td>";
        $row.="<td>".$r['experience']."&nbsp;&nbsp;&nbsp;year(s)</td>";
        $row.="<td><i class='dollar icon'></i>".$r['salary']."</td>";
        $row.="<td>".$op."</td>";
        $row.="</tr>";
        echo ($row);

    }
}
}
?>
