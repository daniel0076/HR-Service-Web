<?php
if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){
        $redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            header("Location: $redirect");
            die();
}

require_once('admin/auth/db_auth.php');
require_once('static/xajax_core/xajaxAIO.inc.php');
session_start();

if(isset($_GET['logout'])){
    unset($_SESSION['is_authed']);
    if(isset($_SESSION['is_boss'])){
        unset($_SESSION['is_boss']);
        unset($_SESSION['boss_id']);
        unset($_SESSION['boss_name']);
    }
    if(isset($_SESSION['is_user'])){
        unset($_SESSION['is_user']);
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
    }
    header("Location : index.php");
}
if(isset($_SESSION['is_authed'])){
    if($_SESSION['is_authed']){
        echo "<script>alert('你已經登入了');location.href='../index.php'</script>";
        die();
    }
}

$xajax = new xajax();
$login= $xajax->registerFunction('login');
$login->useSingleQuote();
$login->addParameter(XAJAX_FORM_VALUES, 'loginForm');
$xajax->processRequest();

function login($form) {
    $dsn="mysql:host=".$GLOBALS['hostname'].";dbname=".$GLOBALS['dbname'].";charset=".$GLOBALS['charset'];
    $db=new PDO($dsn,$GLOBALS['user'],$GLOBALS['passwd']);
    $success = false;
    $boss_success= false;
    $objRes = new xajaxResponse();
    $boss_query="SELECT * FROM `employer` WHERE `account` = :user LIMIT 1";
    $user_query="SELECT * FROM `user` WHERE `account` = :user LIMIT 1";

    try {
        $check= $db->prepare($boss_query);
        $check->execute(array(':user'=> $form['user']));
        $result=$check->fetch(PDO::FETCH_ASSOC);
        $pwd_hash=$result['password'];
        if(password_verify($form['password'],$pwd_hash)){
            $boss_success=true;
            $_SESSION['is_authed']=true;
            $_SESSION['is_boss']=true;
            $_SESSION['boss_id']=$result['id'];
            $_SESSION['boss_name']=$result['account'];
            $msg="人資主管，登入成功";
        }
    } catch (PDOException $e) {
        $msg="資料庫錯誤:$e";
    }

    if( !$boss_success) {
        try {
            $check= $db->prepare($user_query);
            $check->execute(array(':user'=> $form['user']));
            $result=$check->fetch(PDO::FETCH_ASSOC);
            $pwd_hash=$result['password'];
            if(password_verify($form['password'],$pwd_hash)){
                $success=true;
                $_SESSION['is_authed']=true;
                $_SESSION['is_user']=true;
                $_SESSION['user_id']=$result['id'];
                $_SESSION['user_name']=$result['account'];
                $msg="求職者，登入成功";
            }else {
                $msg="登入失敗，請檢查帳號或密碼";
            }
        } catch (PDOException $e) {
            $msg="資料庫錯誤:$e";
        }
    }
    $objRes->assign('response', 'innerHTML', $msg);
    if( $boss_success) {
        $objRes->call("loginAdminSucceeded");
        $objRes->redirect("index.php");
    }
    else if( $success ) {
        $objRes->call("loginSucceeded");
        $objRes->redirect("index.php");
    }
    else $objRes->call("loginFailed");
    return $objRes;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>登入 | DB_LAB1 </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="static/semantic-ui/dist/semantic.css"/>
    <link rel="stylesheet" type="text/css" href="css/login.css"/>
    <link rel="stylesheet" type="text/css" href="css/custom.css"/>
    <script src="static/semantic-ui/dist/semantic.js"></script>
    <script src="js/register_button.js"></script>
    <link rel="shortcut icon" href="image/icon.png">
<script>
/* <![CDATA[ */
$(document).ready(function(){
    $('#response').hide();
});
function loginAdminSucceeded() {
    $('#response').removeClass("blue").removeClass("error").addClass("positive").show();
}
function loginSucceeded() {
    $('#response').removeClass("blue").removeClass("error").addClass("positive").show();
}
function loginFailed() {
    $('#response').removeClass("blue").removeClass("positive").addClass("error").show();
}
$(function() {
    $('#loginForm')
        .form({
        name: { identifier: 'user', rules: [{type: 'empty'},] },
            idnum: { identifier: 'password', rules: [{type: 'empty'},] }
});
});
/* ]]> */
</script>
    <?php $xajax->printJavascript('static/'); ?>
</head>

<body>
<div id="navbar">
<?php require_once('template/menubar.php');
    require('template/register_modal.php');
?>
</div>
  <div class="content" id="content">
    <div class="container" id="login">
        <div class="ui large attached message"> 登入 </div>
        <div class="ui blue attached fluid message" id="response"> </div>
        <form class="ui form attached fluid segment" name="loginForm" id="loginForm" onsubmit="$('#loginForm').form('validate form');<?php $login->printScript(); ?>;return false;">
            <div class="field">
                <label>帳號</label>
                <div class="ui left icon corner labeled input">
                    <i class="user icon"></i>
                    <div class="ui corner label"><i class="icon asterisk"></i></div>

                    <input name="user" type="text" autocomplete="off">


                </div>
            </div>
            <div class="field">
                <label>密碼</label>
                <div class="ui left icon corner labeled input">
                    <i class="lock icon"></i>
                    <input name="password" type="password">
                    <div class="ui corner label"> <i class="icon asterisk"></i> </div>
                </div>
            </div>
            <div id="button_div">
                <input type="submit" value="Login" class="ui blue submit button" />
            </div>
        </form>
    </div>
</div>
</body>
</html>
