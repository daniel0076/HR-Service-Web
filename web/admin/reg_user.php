<?php

if(isset($_SESSION['is_user']))
{
    header('Location: ../index.php');
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
    $db = new JobSeeker();
    $res = $db->JobSeekerRegister($form['account'],$form['password'],$form['education'],$form['salary'],$form['phone'],$form['gender'],$form['age'],$form['email']);
    $res=true;
    if(!$res)
    {
        $error=true;
        $msg='Account already exist!';
    }
    else
    {
        $error=false;
        $msg='Reg success';
    }
    if($error){
        $objRes->call("accountExist");
    }else{
        $objRes->call("Succeeded");
        header('Location: ../index.php');
    }
    $objRes->assign('response', 'innerHTML', $msg);
return $objRes;
};



?>
