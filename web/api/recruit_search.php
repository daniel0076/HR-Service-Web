<?php
session_start();
require_once('../model/common_query.php');
require_once('../admin/auth/db_auth.php');
$db=new commonQuery();

$form=json_decode(file_get_contents('php://input'),true);

if(empty($form['location'])){ $location=null; }else{ $location=$form['location'];}
if(empty($form['occupation'])){ $occupation=null; }else{ $occupation=$form['occupation'];}
if(empty($form['worktime'])){ $worktime=null; }else{ $worktime=$form['worktime'];}
if(empty($form['education'])){ $education=null; }else{ $education=$form['education'];}
if(empty($form['experience'])){ $experience=null; }else{ $experience=$form['experience'];}
if(empty($form['salary'])){ $salary=0; }else{ $salary=$form['salary'];}
if(empty($form['sort'])){ $sort=""; }else{ $sort=$form['sort'];}

$res=$db->searchJob($occupation,$location,$worktime,$education,$experience,$salary,$sort);
$applied=array();
if(isset($_SESSION['is_user'])){

    $applied=$db->appliedList($_SESSION['user_id']);
}

if($res) make_recruit_table($res,$applied);
else echo "Not Found";


function make_recruit_table ($res,$applied=null) {
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
        else if(isset($_SESSION['is_user']))
        {
            if(!empty($applied)&&in_array($r['id'],$applied)){
                $op.="<div class='ui red button'>已申請</div>";
            }
            else{
                $op.="<div class='buttonContainer' style='display:inline'><input type='hidden' value='".$r['id']."'><div class='ui green button' id='apply'>申請</div></div>";
            }
            $op.="<div class='ui yellow button'>加入最愛</div>";
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
    unset($db);
}
?>
