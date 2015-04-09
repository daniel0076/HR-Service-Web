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
        $res = $db->JobSeekerRegister($form['account'],$form['password'],$form['education'],$form['salary'],$form['phone'],$form['gender'],$form['age'],$form['email']);


    if($error){
        $objRes->call("accountExist");
    }else{
        $objRes->call("Succeeded");
        $objRes->redirect("index.php");
    }

    $objRes->assign('response', 'innerHTML', $msg);
return $objRes;
};



?>
