<?php

if(isset($_SESSION['is_user']))
{
    header('Location: index.php');
}
require('admin/auth/db_auth.php');
require('model/user_query.php');
require_once('static/xajax_core/xajaxAIO.inc.php');

$xajax = new xajax();
$reg= $xajax->registerFunction('regCheck');
$reg->useSingleQuote();
$reg->addParameter(XAJAX_FORM_VALUES, 'jobseekerform');
$xajax->processRequest();

function regCheck($form) {
    $objRes = new xajaxResponse();

    foreach ($form as $x) {
        if(is_array($x)){
            if(empty($x)){
                $msg="您有空白的欄位";
                $objRes->call("Error");
                $objRes->assign('response', 'innerHTML', $msg);
                return $objRes;
            }
        }
        else if(trim($x)==""){
            $msg="您有空白的欄位";
            $objRes->call("Error");
            $objRes->assign('response', 'innerHTML', $msg);
            return $objRes;
        }
    }

    $db = new JobSeeker();
    $avail=$db->checkAvail($form['account']);
    print_r($form);
    if($avail){
        $res = $db->JobSeekerRegister($form['account'],$form['password'],$form['education'],$form['salary'],$form['phone'],$form['gender'],$form['age'],$form['email'],$form['specialty']);

        if($res){
            $error=false;
            $msg='註冊成功';
        }else{
            $error=true;
            $msg='資料庫錯誤，請稍後再試';
        }

    }else{
        $error=true;
        $msg='帳號己經存在，請試試別的帳號';
        $objRes->assign('error', 'innerHTML', $msg);
    }

    if($error){
        $objRes->call("accountExist");
    }else{
        $objRes->call("Succeeded");
        $objRes->redirect("index.php");
    }

    $objRes->assign('response', 'innerHTML', $msg);
return $objRes;
};


function make_specialty_list($db){
    $res=$db->make_specialty_table_query();
    if($res){
        foreach($res as $x){
            echo "<div class='field'><div class='ui checkbox'><input type='checkbox' name='specialty[]' value='".$x['id']."' id='lab".$x['id']."'><label for='lab".$x['id']."'>".$x['specialty']."</label></div></div>";

        }
    }
}
?>
