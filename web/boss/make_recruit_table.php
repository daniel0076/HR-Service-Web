<?php
require_once('model/user_query.php');
function make_recruit_table ($db) {
    $res=$db->make_table_query();

    echo "<div class='ui basic test modal'><i class='close icon'></i><div class='header'>Delete the Post</div><form action='boss/deletePost.php' method='POST'><input type='hidden' name='p' id='p' value=''><div class='actions' style='text-align:center'><div class='ui red button'>Cancel</div><button type='submit' class='ui green button'>Confirm</div></div></form></div>";
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
                    $op.="<input type='hidden' id='loca'  value='" .$r['location_id']. "'>";
                    $op.="<input type='hidden' id='occu'  value='" .$r['occupation_id']. "'>";
                    $op.="<input type='hidden' id='work'  value='" .$r['working_time']. "'>";
                    $op.="<input type='hidden' id='educa'  value='" .$r['education']. "'>";
                    $op.="<input type='hidden' id='exp'  value='" .$r['experience']. "'>";
                    $op.="<input type='hidden' id='sal'  value='" .$r['salary']. "'>";

                    $op.="</form>";
                    $op.="<div style='display:inline'><input type='hidden' value='".$r['id']."'><div class='ui red tiny button' id='delPostButton'>刪除</div></div>";


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
function make_user_table($db) {
    $res=$db->make_user_table_query();
    if($res)
    {
        foreach($res as $r)
        {
            if(isset($_SESSION['is_boss'])){
            $spec=$db->fetchUserSpecialty($r['id']);
            $row="<tr>";
            $row.="<td>".htmlspecialchars($r['account'])."</td>";
            $row.="<td>".htmlspecialchars($r['education'])."</td>";
            $row.="<td>".htmlspecialchars($r['expected_salary'])."</td>";
            $row.="<td>".htmlspecialchars($r['phone'])."</td>";
            $row.="<td>".htmlspecialchars($r['gender'])."</td>";
            $row.="<td>".htmlspecialchars($r['age'])."</td>";
            $row.="<td>".htmlspecialchars($r['email'])."</td>";
            $row.="<td><div class='ui icon top left pointing fluid dropdown button' style='text-align:center'><i class='chevron circle down icon'></i><div class='menu'>";
            if($spec)
            {
                foreach($spec as $sp)
                {
                    $row.="<div class='item'>".$sp['specialty']."</div>";
                }
            }
            else
            {
                $row.="<div class='item'>Empty</div>";
            }
            $row.="</div></div></td>";
            $row.="</tr>";
            echo ($row);
            }
        }
    }
}
function make_occupation_dropdown($db){
    $res=$db->DropdownValue("occupation");
    if($res)
    {
        foreach($res as $value)
        {
            echo "<option value='" . $value['id'] . "'>" . $value['occupation'] . "</option>";
        }
    }
}
function make_location_dropdown($db){
    $res=$db->DropdownValue("location");
    if($res)
    {
        foreach($res as $value)
        {
            echo "<option value='" . $value['id'] . "'>" . $value['location'] . "</option>";
        }
    }

}
function make_application_list()
{

}
?>
