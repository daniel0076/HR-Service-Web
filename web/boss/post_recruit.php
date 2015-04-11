<?php
if(! (isset($_SESSION['is_authed']) && isset($_SESSION['is_boss'])) )
{
    header('Location: ../index.php');
}
require('admin/auth/db_auth.php');
require('model/boss_query.php');
require_once('static/xajax_core/xajaxAIO.inc.php');

$xajax = new xajax();
$reg= $xajax->registerFunction('postRecruit');
$reg->useSingleQuote();
$reg->addParameter(XAJAX_FORM_VALUES, 'recruitForm');
$xajax->processRequest();

function postRecruit($form) {
    $objRes = new xajaxResponse();

    foreach ($form as $x) {
        if(trim($x)==""){
            $msg="您有空白的欄位";
            $objRes->call("Error");
            $objRes->assign('modal_msg', 'innerHTML', $msg);
            return $objRes;
        }
    }

    $db = new Boss();
    if($form['edit'])
    {
        $permission=$db->checkPermission($form['recruit_id'],$_SESSION['boss_id']);
        if($permission)
        {
            $res = $db->UpdateJob($form['recruit_id'],$form['occupation_id'], $form['location_id'],
                $form['worktime'],$form['education'],$form['experience'],$form['salary']);
        }else $res="false";
    }
    else
    {
        $res = $db->PostJob($_SESSION['boss_id'],$form['occupation_id'],$form['location_id'],
            $form['worktime'],$form['education'],$form['experience'],$form['salary']);
    }

    if($res){
        $error=false;
        $msg='Success';
    }else{
        $error=true;
        $msg='資料庫錯誤，請稍後再試';
    }

    if(!$error){
        $objRes->redirect("index.php");
    }

    $objRes->assign('modal_msg', 'innerHTML', $msg);
return $objRes;
};



?>
