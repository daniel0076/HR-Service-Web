<?php
#session_start();
#if(!isset($_SESSION['is_boss']))
#{
#    header("Location: ../index.php");
#    die();
#}

function applied($res=null,$common=null,$user=null)
{
    if($res)
    {
        foreach($res as $r)
        {
            $row='';
            $applied=$common->findAppliedUser($r['id']);
            $row.="<table class='ui striped table' id='applied".$r['id']."'>";
            $row.="<input type='hidden' name='p' value=".$r['id'].">";
            $row.="<thead>";
            $row.="<tr >";
            $row.="<th style='width:10%'>".$r['occupation']."</th>";
            $row.="<th style='width:10%'>".$r['location']."</th>";
            $row.="<th style='width:10%'>".$r['working_time']."</th>";
            $row.="<th style='width:15%'>".$r['education']."</th>";
            $row.="<th style='width:10%'>".$r['experience']." year(s)</th>";
            $row.="<th style='width:10%'><i class='dollar icon'></i>".$r['salary']."</th>";
            $row.="<th style='width:20%'> </th>"; 
            $row.="<th style='width:5%'> </th>"; 
            $row.="<th style='width:7%'> </th>"; 
            $row.="</tr>";
            $row.="</thead>";
            $row.="<tbody>";
            if($applied && $user)
            {

                foreach($applied as $users)
                {
                $row.="<tr>";
                    $spec=$user->fetchUserSpecialty($users['id']);
                    $row.="<td>".$users['account']."</td>";
                    $row.="<td>".$users['gender']."</td>";
                    $row.="<td>".$users['age']."</td>";
                    $row.="<td>".$users['education']."</td>";
                    $row.="<td>".$users['expected_salary']."</td>";
                    $row.="<td>".$users['phone']."</td>";
                    $row.="<td>".$users['email']."</td>";
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
                    $row.="<td><div class='ui green button' id='hire'>錄取</div></td>";
                $row.="</tr>";
                }

            }
            $row.="</tbody>";
            $row.="</table>";
            echo $row;
        }
    }
}
?>
