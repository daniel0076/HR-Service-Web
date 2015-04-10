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
<?php require_once('template/register_modal.php');?>
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
          if(isset($_SESSION['is_boss']))
          { ?>
         <div class="ui section divider"></div>
          <div class="massive ui animated fade yellow button" id="post_button">
            <div class="visible content">New Post</div>
            <div class="hidden content"><i class="plus icon"></i></div>
          </div>
          <div class="ui modal" id="post_modal">
            <i class="close icon"></i>
            <div class="header">New Post</div>
            <div class="content">
            <form class="ui form">
              <div class="three fields">
                <div class="field">
                  <label>Location</label>
                  <select class="ui search dropdown" name="location_id">
<?php
require_once('admin/auth/db_auth.php');
require_once('model/boss_query.php');
$db = new Boss();
$res=$db->DropdownValue("location");
if($res)
{
    foreach($res as $value)
    {
        echo "<option value='" . $value['id'] . "'>" . $value['location'] . "</option>";
    }
}
?>
                  </select>
              </div>
              <div class="field">
                <label>Occupation</label>

                  <select class="ui search dropdown" name="occupation_id">
<?php
$res=$db->DropdownValue("occupation");
if($res)
{
    foreach($res as $value)
    {
        echo "<option value='" . $value['id'] . "'>" . $value['occupation'] . "</option>";
    }
}
?>
                </select>
              </div>
              <div class="field">
                <label>Working Time</label>
                <input type="text" name="worktime" placeholder="Working Time">
              </div>
            </div>
            <div class="three fields">
              <div class="field">
                <label>Education</label>
                <input type="text" name="education" placeholder="Education">
              </div>
              <div class="field">
                <label>Experience</label>
                <input type="text" name="experience" placeholder="Experience">
              </div>
              <div class="field">
                <label>Salary</label>
                <input type="text" name="salary" placeholder="Salary">
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
