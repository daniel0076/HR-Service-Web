<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js?ver=2.0.3"></script>
    <link rel="stylesheet" type="text/css" href="static/semantic-ui/dist/semantic.css"/>
    <link rel="stylesheet" type="text/css" href="css/custom.css"/>
    <link rel="stylesheet" type="text/css" href="css/index.css"/>
    <script src="static/semantic-ui/dist/semantic.js"></script>
    <script src="js/register_button.js"></script>
    <script src="js/index.js"></script>
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
    <div class="container">
      <div class="ui segment">
          <!--display all post-->
         <?php 
          if(!isset($_SESSION['is_boss']))
          { ?>
         <div class="ui section divider"></div> 
          <div class="massive ui animated fade yellow button" id="post_button">
            <div class="visible content">New Post</div>
            <div class="hidden content"><i class="plus icon"></i></div>
          </div>
          <div class="ui fullscreen modal">
            <i class="close icon"></i>
            <div class="header">New Post</div>
            <div class="content">
            <form class="ui form">
              <div class="inline fields">
                <div class="field">
                  <label>Location</label>
                  <div class="ui search dropdown">
<?php
require('admin/auth/db_auth.php');
require('admin/reg_boss.php');
$db = new Boss();
$res=$db->DropdownValue("location");
if($res!="")
{
    
}
?>
                  </div>
              </div>
              <div class="field">
                <label>Occupation</label>
                <input type="text" placeholder="Occupation">
              </div>
              <div class="field">
                <label>Working Time</label>
                <input type="text" placeholder="Working Time">
              </div>
              <div class="field">
                <label>Education</label>
                <input type="text" placeholder="Education">
              </div>
              <div class="field">
                <label>Experience</label>
                <input type="text" placeholder="Experience">
              </div>
              <div class="field">
                <label>Salary</label>
                <input type="text" placeholder="Salary">
              </div>
            </div>
          </form>
          </div>
          <div class="actions">
            <div class="ui red button">Cancel</div>
            <div class="ui green button">Post</div>
          </div>
        </div>
        <?php }?>
      </div>
    </div>
  </body>
</html>
