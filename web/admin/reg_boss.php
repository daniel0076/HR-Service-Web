<?php
    if(isset($_SESSION['is_boss']))
    {
        header('Location: index.php');
    }
    require('admin/auth/db_auth.php');
    require('model/boss_query.php');
    require_once('static/xajax_core/xajaxAIO.inc.php');

    $xajax = new xajax();
    $reg = $xajax->registerFunction('regCheck');
    $reg->useSingleQuote();
    $reg->addParameter(XAJAX_FORM_VALUES,'bossform');
    $xajax->processRequest();

    function regCheck($form)
    {
        $objRes = new xajaxResponse();
        foreach ($form as $x)
        {
            if(trim($x)=="")
            {
                $msg="您有空白的欄位";
                $objRes->call("Error");
                $objRes->assign('response','innerHTML',$msg);
                return $objRes;
            }
        }
    $db = new Boss();
    $avail=$db->checkAvail($form['account']);
    if($avail)
    {
        $res = $db->BossRegister($form['account'],$form['password'],$form['phone'],$form['email']);
        if($res)
        {

            $error=false;
            $msg='註冊成功';
        }
        else
        {
            $error=true;
            $msg='資料庫錯誤，請稍後再試';
        }
    }
    else
    {
        $error=true;
        $msg='帳號已經存在，請試試別的帳號';
        $objRes->assign('error','innerHTML',$msg);
    }
    if($error)
    {
        $objRes->call('accountExist');
    }
    else
    {
        $objRes->call('Succeeded');
        $objRes->redirect('index.php');
    }
    $objRes->assign('response','innerHTML',$msg);
    return $objRes;
    }
?>
