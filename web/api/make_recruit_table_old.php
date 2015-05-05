<?php
session_start();
require_once('../model/common_query.php');
require_once('../admin/auth/db_auth.php');
$db=new commonQuery();
if(isset($_GET['sort'])){
    $sort=$_GET['sort'];
}else{
    $sort=null;
}
make_recruit_table($db,$sort);
function make_recruit_table ($db,$sort) {
    $res=$db->make_table_query($sort);


    if($res)
    {
        foreach($res as $r)
        {
            $op="";
            if(isset($_SESSION['is_boss'])){
                if($r['employer_id']==$_SESSION['boss_id'])
                {
                    $op.="<form style='display:inline' id='editform'>";
                    $op.="<div class='ui blue tiny button' id='editButton'>修改</div>";
                    $op.="<input type='hidden' id='recruit_id' name='recruit_id' value='" .$r['id']. "'>";
                    $op.="<input type='hidden' id='recruit_id' name='recruit_id' value='" .$r['id']. "'>";
                    $op.="<input type='hidden' id='loca'  value='" .$r['location_id']. "'>";
                    $op.="<input type='hidden' id='occu'  value='" .$r['occupation_id']. "'>";
                    $op.="<input type='hidden' id='work'  value='" .$r['working_time']. "'>";
                    $op.="<input type='hidden' id='educa'  value='" .$r['education']. "'>";
                    $op.="<input type='hidden' id='exp'  value='" .$r['experience']. "'>";
                    $op.="<input type='hidden' id='sal'  value='" .$r['salary']. "'>";

                    $op.="</form>";
                    $op.="<div style='display:inline'><input type='hidden' value='".$r['id']."'>";
                    $op.="<div class='ui red tiny button' id='delPostButton'>刪除</div></div>";


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
    unset($db);
}
?>
