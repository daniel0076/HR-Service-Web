<?php
session_start();
require_once('boss/make_recruit_table.php');
require_once('hrdb/search.php');
if(isset($_SESSION['is_boss']))
{
    require_once('boss/post_recruit.php');
}
?>
<!DOCTYPE html>
<html>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular-sanitize.js"></script>
    <script src="static/fullPage.js/vendors/jquery.slimscroll.min.js"></script>
    <script src="static/fullPage.js/vendors/jquery.easings.min.js"></script>
    <script src="static/fullPage.js/jquery.fullPage.min.js"></script>
    <script src="js/controller.js"></script>
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
        <?php
        if(isset($_SESSION['is_boss']))
        {?>
        <a class='item' id='moveSlideLeft' href='#'>
            <i class='list layout  icon'></i>Application List
        </a>
        <a class='item' id='moveSlideRight' href='#'>
            <i class='list layout icon'></i>Job Seeker List
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
  <div ng-app="recruitTable" ng-controller="tableCtrl" id="tableCtrl"  data-ng-init="search(); getFavor();" class="container" id='fullpage'>
    <div class='section'>
      <div class='slide' data-anchor='slide1' id="slideIndex">



<div class="ui segment" style="width:90%;height:100%;overflow-y:auto;">
        <h2 class="ui header" style='text-align:center;margin:auto'>最夯職缺，只差你一個
        <?php if(isset($_SESSION['is_boss']))
                 { ?>
          <span style='float:right'><div class="normal ui animated fade black button" id="post_button">
            <div class="visible content">New Post</div>
            <div class="hidden content" style='text-align:center'><i class="plus icon"></i></div>
            </div></span>

<?php }?>
        </h2>
    <form class='ui form' style='margin-top:30px;text-align:center' name='searchForm' id='searchForm'>
        <div class='six fields'>
            <div class="field">
            <input type="text" placeholder="Occupation" ng-model="occupation" ng-change="search()">
            </div>
            <div class="field">
            <input type="text" placeholder="Location" ng-model="location" ng-change="search()">
            </div>
            <div class="field">
            <input type="text" placeholder="Work Time" ng-model="worktime" ng-change="search()">
            </div>
            <div class="field">
            <input type="text" placeholder="Education Required" ng-model="education" ng-change="search()">
            </div>
            <div class="field">
            <input type="text" placeholder="Working Experience" ng-model="experience" ng-change="search()">
            </div>
            <div class="field">
            <input type="text" placeholder="Salary" ng-model="salary" ng-change="search()">
            </div>
        </div>
    </form>
    <table class="ui striped table" style='margin-bottom:100px' id='recruit_table'>
        <thead>
            <th><i class=""></i>ID</th>
            <th><i class="crosshairs icon"></i>Occupation</th>
            <th><i class="marker icon"></i>Location</th>
            <th><i class="wait icon"></i>Work Time</th>
            <th><i class="student icon"></i>Education Required</th>
            <th><i class="theme icon"></i>Minimal Experience</th>
            <th><i class="dollar icon"></i>Salary

                    <div class="ui icon mini button" ng-click="search('desc')">
                        <i class="caret down icon"></i>
                    </div>
                    <div class="ui icon mini button" ng-click="search('asc')">
                        <i class="caret up icon"></i>
                    </div>
            </th>
            <th style='text-align:center'><i class="edit icon"></i>Operation</th>
        </thead>
        <tbody id="recruitTable" ng-bind-html="table">
        </tbody>
    </table>

<?php

require_once('admin/auth/db_auth.php');
require_once('model/boss_query.php');

$db = new Boss();
//make_recruit_table($db);
?>
        <div></div>
          <!--display all post-->
<?php
         if(isset($_SESSION['is_user']))
         {?>
        <div class='ui basic test modal' id="apply_modal">
        <i class='close icon'></i>
        <div class='header'>Apply</div>
            <form id='applyform'>
                <input type='hidden' name='apply_num' id='apply_num' value=''>
                <div class='ui red button' id="cancelApp" >Cancel</div>
                <button type='submit' class='ui green button' id='applyConf'>Confirm</button>
            </form>
        </div>
<?php
         }
          if(isset($_SESSION['is_boss']))
          {


            $xajax->printJavascript('static/');
        ?>


        <div class='ui basic test modal' id="del_modal">
        <i class='close icon'></i>
        <div class='header'>Delete the Post</div>
            <form id='delpost'>
                <input type='hidden' name='p' id='p' value=''>
                <div class='ui red button' id="cancelDel" >Cancel</div>
                <button type='submit' class='ui green button' id='delConf'>Confirm</button>
            </form>
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
                    <option value="0">No experience required</option>
                    <option value="1">1 year</option>
                    <option value="2">2 years</option>
                    <option value="5">5 years</option>
                    <option value="10">10 years</option>
                  </select>
              </div>
              <div class="field">
                <label>Salary</label>
                  <select class="ui dropdown selection" name="salary" id='salary'>
                    <option value="">Salary</option>
                    <option value="1000">1000</option>
                    <option value="2000">2000</option>
                    <option value="3000">3000</option>
                    <option value="4000">4000</option>
                    <option value="5000">5000</option>
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
    <div class='ui segment' style='width:90%;height:100%;overflow-y:auto;'>
        <div class='ui header'>待審名單</div>
<?php

unset($db);
require_once 'api/applicationList.php';
require_once 'model/common_query.php';
require_once 'model/user_query.php';
$common = new commonQuery();
$user = new JobSeeker();
$res=$common->applicationList($_SESSION['boss_id']);
applied($res,$common,$user);
?>
    </div>
</div>
<?php }
if(isset($_SESSION['is_user']))
{?>
<div class='slide' data-anchor='slide2'>
    <div class='ui segment' style='width:90%;height:100%;overflow-y:auto;'>
    <div class='ui header'>我的最愛</div>
  <table class="ui striped table" style='margin-bottom:100px' id='recruit_table'>
      <thead>
          <th><i class=""></i>ID</th>
          <th><i class="crosshairs icon"></i>Occupation</th>
          <th><i class="marker icon"></i>Location</th>
          <th><i class="wait icon"></i>Work Time</th>
          <th><i class="student icon"></i>Education Required</th>
          <th><i class="theme icon"></i>Minimal Experience</th>
          <th><i class="dollar icon"></i>Salary </th>
          <th><i class="edit icon"></i>Operation</th>
      </thead>
      <tbody>
        <tr ng-repeat="row in list">
            <td>{{row.fid}}</td>
            <td>{{row.occupation}}</td>
            <td>{{row.location}}</td>
            <td>{{row.working_time}}</td>
            <td>{{row.education}}</td>
            <td>{{row.experience}}</td>
            <td>{{row.salary}}</td>
            <td>
              <button ng-click="delFavor(row.fid)" class='ui red button'>Delete</button>
            </td>
        </tr>
      </tbody>
  </table>
    </div>
</div>
<?php
}
?>
      </div>
    </div>
  </body>
</html>
