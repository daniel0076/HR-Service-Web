<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js?ver=2.0.3"></script>
    <link rel="stylesheet" type="text/css" href="static/semantic-ui/dist/semantic.css"/>
    <link rel="stylesheet" type="text/css" href="css/custom.css"/>
    <script src="static/semantic-ui/dist/semantic.js"></script>
    <script src="js/register_button.js"></script>
    <title>Just Sudo It</title>
    <link rel="shortcut icon" href="image/icon.png">
  </head>
  <body>
<?php include 'template/register_modal.php';?>
    <div></div>
    <div class="ui green inverted menu">
      <a class="item" href="index.php">
        <i class="lightning icon"></i> Just Sudo It
      </a>
      <!--    <div class="ui pointing dropdown link item">
        <div class="text">2015-DB</div>
        <i class="dropdown icon"></i>
        <div class="menu">
        <div class="item">Lab1</div>
        </div>
        </div>-->
        <div class="right menu">
          <?php
             if(!isset($_SESSION['is_authed']))
             {
                 require_once('template/before_login.php');
             }
             else
             {
                 require_once('template/after_login.php');
             }?>
        </div>
    </div>
  </body>
</html>
