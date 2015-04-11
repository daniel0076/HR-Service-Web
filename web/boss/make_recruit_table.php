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
                $op.="<form style='display:inline' id='editform'><div class='ui blue tiny button' id='editButton'>修改</div>";
                $op.="<input type='hidden' id='recruit_id' name='recruit_id' value='" .$r['id']. "'>";
                $op.="</form>";
                $op.="<form action='boss/deletePost.php' method='POST' style='display:inline'><input type='hidden' name='p' value='".$r['id']."'><button class='ui red tiny button' id='delPostButton' type='submit'>刪除</button></form>";
            }
        }
        $row="<tr>";
        $row.="<td>".htmlspecialchars($r['occupation'])."</td>";
        $row.="<td>".htmlspecialchars($r['location'])."</td>";
        $row.="<td>".htmlspecialchars($r['working_time'])."</td>";
        $row.="<td>".htmlspecialchars($r['education'])."</td>";
        $row.="<td>".htmlspecialchars($r['experience'])."&nbsp;&nbsp;&nbsp;year(s)</td>";
        $row.="<td><i class='dollar icon'></i>".htmlspecialchars($r['salary'])."</td>";
        $row.="<td>".$op."</td>";
        $row.="</tr>";
        echo ($row);

    }
}
}
?>
