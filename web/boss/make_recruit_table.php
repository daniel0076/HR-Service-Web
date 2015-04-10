<?php
function make_recruit_table () {
require_once('admin/auth/db_auth.php');
require_once('model/boss_query.php');
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
                $op.="<div class='ui red tiny button'>刪除</div>";
            }
        }
        $row="<tr>";
        $row.="<td>".$r['occupation']."</td>";
        $row.="<td>".$r['location']."</td>";
        $row.="<td>".$r['working_time']."</td>";
        $row.="<td>".$r['education']."</td>";
        $row.="<td>".$r['experience']."</td>";
        $row.="<td>".$r['salary']."</td>";
        $row.="<td>$op</td>";
        $row.="</tr>";
        echo ($row);
    }
}
}
?>
