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
            $objRes->assign('response', 'innerHTML', $msg);
            return $objRes;
        }
    }

    $db = new Boss();
    $res = $db->PostJob($_SESSION['boss_id'],$form['occupation_id'],$form['location_id'],$form['working_time'],
        $form['education'],$form['experience'],$form['salary']
    );

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

    $objRes->assign('response', 'innerHTML', $msg);
return $objRes;
};



?>
