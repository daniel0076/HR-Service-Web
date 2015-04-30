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
      <a class="item" id='mainpage' href="#">
        <i class="lightning icon"></i> Just Sudo It
      </a>
      <!--    <div class="ui pointing dropdown link item">
        <div class="text">2015-DB</div>
        <i class="dropdown icon"></i>
        <div class="menu">
        <div class="item">Lab1</div>
        </div>
        </div>-->
        <?php
        if(isset($_SESSION['is_boss']))
        {?>
        <a class='item' id='moveSlideLeft' href='#'>
            <i class='angle double left  icon'></i>Application List
        </a>
        <a class='item' id='moveSlideRight' href='#'>
            <i class='angle double right icon'></i>Job Seeker List
        </a>
        <?php }
        if(isset($_SESSION['is_user']))
        {?>
        <a class='item' id='moveSlideRight' href='#'>
            <i class='angle double right icon'></i>Favorite List
        </a>
        <?php }?>
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
    <div class='slide' data-anchor='slide1' id="slideIndex">
      <div class="ui segment" style="width:90%;height:100%;overflow-y:auto;">
        <table class="ui striped table" style='margin-bottom:100px'>
        <h2 class="ui header" style='text-align:center'>最夯職缺，只差你一個
        <?php if(isset($_SESSION['is_boss']))
                 { ?>
          <span style='float:right'><div class="normal ui animated fade black button" id="post_button">
            <div class="visible content">New Post</div>
            <div class="hidden content" style='text-align:center'><i class="plus icon"></i></div>
            </div></span> <?php }?>
        </h2>

            <thead>
                <th><i class="crosshairs icon"></i>Occupation</th>
                <th><i class="marker icon"></i>Location</th>
                <th><i class="wait icon"></i>Work Time</th>
                <th><i class="student icon"></i>Education Required</th>
                <th><i class="theme icon"></i>Minimal Experience</th>
                <th><i class="dollar icon"></i>Salary
                    <i class="caret up icon"></i>
                    <i class="caret down icon"></i>
                </th>
                <th><i class="edit icon"></i>Operation</th>
            </thead>
            <tbody>
<?php
require_once('admin/auth/db_auth.php');
require_once('model/boss_query.php');
$db = new Boss();
make_recruit_table($db);
?>
            </tbody>
        </table>
        <div></div>
          <!--display all post-->
         <?php
          if(isset($_SESSION['is_boss']))
          {
            $xajax->printJavascript('static/');
        ?>

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
    make_location_dropdown($db);
?>
                  </select>
              </div>
              <div class="field">
                <label>Occupation</label>
                  <select class="ui dropdown selection" name="occupation_id" id='occupation_id'>
                    <option value="">Occupation</option>
<?php
    make_occupation_dropdown($db);
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
<div class='slide' data-anchor='slide2' id="slideJobseeker">
      <div class="ui segment" style="width:90%;height:100%;overflow-y:auto;">
        <div></div>
        <div class='ui header'>所有好人才，都從這裡找</div>
        <table class="ui striped table" style='margin-bottom:200px'>
            <thead>
                <th><i class='user icon'></i>Name</th>
                <th><i class='student icon'</i>Education</th>
                <th><i class='dollar icon'></i>Expected Salary</th>
                <th><i class='call icon'></i>Phone</th>
                <th><i class='heart icon'></i>Gender</th>
                <th><i class='birthday icon'></i>Age</th>
                <th><i class='mail icon'></i>Email</th>
                <th><i class='lab icon'></i>Specialtys</th>
            </thead>
<?php
    make_user_table($db);
?>

        </table>

      </div>
</div>
<div class='slide' data-anchor='slide3' id="slideAppli">
</div>
<?php }
if(isset($_SESSION['is_user']))
{?>
<div class='slide' data-anchor='slide2'>
</div>
<?php
}
?>
    </div>
</div>
  </body>
</html>
