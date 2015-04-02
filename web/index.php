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
  </head>
  <body>
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
               echo '
              <a class="item" id="reg_button">
                  <i class="plus icon"></i> Register
              </a>
              <a class="item" href="admin/login.php">
                  <i class="sign in icon"></i> Log in
              </a>
              ';
             }
             else
             {
               echo '
                <a class="item" href="admin/login.php?logout">
                    <i class="sign out icon"></i> Log out
                </a>
            ';
             }?>
        </div>
        <div class="ui modal">
          <i class="close icon"></i>
          <div class="header">Account Type</div>
          <div class="content">
            <div class="ui small images" align="middle">
              <a href="admin/reg_boss.php"><img src="image/boss.png" id="boss_img"></a>
              <div type="hidden"></div>
              <a href="admin/reg_jobseeker.php"><img src="image/jobseeker.png" id="jobseeker_img"></a>
            </div>
          </div>
        </div>
    </div>
    <div class="ui button">
      Follow
    </div>
  </body>
</html>
