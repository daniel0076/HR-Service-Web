<?php
session_start();
require_once('boss/make_recruit_table.php');
if(isset($_SESSION['is_boss']))
{
    require_once('boss/post_recruit.php');
}
?>
<!DOCTYPE html>
<html>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="static/fullPage.js/vendors/jquery.slimscroll.min.js"></script>
    <script src="static/fullPage.js/vendors/jquery.easings.min.js"></script>
    <script src="static/fullPage.js/jquery.fullPage.min.js"></script>
    <link rel="stylesheet" type="text/css" href="static/fullPage.js/jquery.fullPage.css"/>
    <link rel="stylesheet" type="text/css" href="static/semantic-ui/dist/semantic.css"/>
    <link rel="stylesheet" type="text/css" href="css/custom.css"/>
    <link rel="stylesheet" type="text/css" href="css/index.css"/>
    <script src="static/semantic-ui/dist/semantic.js"></script>
<?php if(!isset($_SESSION['is_authed'])){?>
<script src="js/register_button.js"></script><?php }?>
    <script src="js/index.js"></script>
    <title>Just Sudo It</title>
    <link rel="shortcut icon" href="image/icon.png">
    <script type='text/javascript'>
$(document).ready(function() {
    $('#fullpage').fullpage();
});
</script>
  </head>
  <body>
<?php require_once('template/register_modal.php');?>
    <div class="ui green inverted menu" id="navbar">
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
    <div class="container" id='fullpage'>
<div class='section'>
    <div class='slide' data-anchor='slide1'>
      <div class="ui segment">
        <table class="ui striped table">
        <h2 class="ui dividing header">最夯職缺，只差你一個</h2>
            <thead>
                <th><i class="crosshairs icon"></i>Occupation</th>
                <th><i class="marker icon"></i>Location</th>
                <th><i class="wait icon"></i>Work Time</th>
                <th><i class="student icon"></i>Education Required</th>
                <th><i class="theme icon"></i>Minimal Experience</th>
                <th><i class="dollar icon"></i>Salary</th>
                <th><i class="edit icon"></i>Operation</th>
            </thead>
            <tbody>
<?php
make_recruit_table();
?>
            </tbody>
        </table>
          <!--display all post-->
         <?php
          if(isset($_SESSION['is_boss']))
          {
            $xajax->printJavascript('static/');
        ?>
         <div class="ui section divider"></div>
          <div class="massive ui animated fade yellow button" id="post_button">
            <div class="visible content">New Post</div>
            <div class="hidden content"><i class="plus icon"></i></div>
          </div>
          <div class="ui modal" id="post_modal">
            <i class="close icon"></i>
            <div class="header" id="modal_header">New Post</div>
            <div class="content">
            <form class="ui form" name="recruitForm" id="recruitForm"  onsubmit="<?php $reg->printScript();?>;return false;">
            <input type="hidden" name="edit" id="modal_edit" value="0">
            <input type="hidden" name="recruit_id" id="modal_rid" value="0">
              <div class="three fields">
                <div class="field">
                  <label>Location</label>
                  <select class="ui dropdown selection" name="location_id" id="location_id">
                    <option value="">Location</option>
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
                  <select class="ui dropdown selection" name="occupation_id" id='occupation_id'>
                    <option value="">Occupation</option>
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
                  <select class="ui dropdown selection" name="worktime" id='worktime'>
                    <option value="">Working Time</option>
                    <option value="DayShift">Day Shift</option>
                    <option value="NightShift">Night Shift</option>
                    <option value="GraveyardShift">Graveyard Shift</option>
                  </select>
              </div>
            </div>
            <div class="three fields">
              <div class="field">
                <label>Education</label>
                  <select class="ui dropdown selection" name="education" id='education'>
                    <option value="">Education</option>
                    <option value="GraduateSchool">Graduate School</option>
                    <option value="UndergraduateSchool">Undergraduate School</option>
                    <option value="SeniorHighSchool">Senior High School</option>
                    <option value="JuniorHighSchool">Junior High School</option>
                    <option value="ElementarySchool">Elementary School</option>
                  </select>
              </div>
              <div class="field">
                <label>Experience</label>
                  <select class="ui dropdown selection" name="experience" id='experience'>
                    <option value="">Experience</option>
                    <option value="no">No experience required</option>
                    <option value="1">1 year</option>
                    <option value="2">2 years</option>
                    <option value="3">3 years</option>
                    <option value="4">4 years</option>
                  </select>
              </div>
              <div class="field">
                <label>Salary</label>
                  <select class="ui dropdown selection" name="salary" id='salary'>
                    <option value="">Salary</option>
                    <option value="22000">22000</option>
                    <option value="30000">30000</option>
                    <option value="40000">40000</option>
                    <option value="50000">50000</option>
                    <option value="70000">70000</option>
                  </select>
              </div>
            </div>
          </div>
          <div class="actions">
            <div id="modal_msg"></div>
            <div class="ui red button deny">Cancel</div>
            <button type="submit" class="ui green submit button ok">Post</button>
          </div>
          </form>
        </div>
        <?php }?>
      </div>
</div>
<?php 
if(isset($_SESSION['is_boss']))
{
?>
<div class='slide' data-anchor='slide2'>
      <div class="ui segment">
        <table class="ui striped table">
        </table>
      </div>
</div>
<?php }?>
    </div>
</div>
  </body>
</html>
