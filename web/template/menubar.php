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
            include 'before_login.php';
        }
        else
        {
            include 'after_login.php';
        }?>
    </div>
    <div class="ui modal">
        <i class="close icon"></i>
            <div class="header">Account Type</div>
        <div class="content">
        <div class="ui small images" align="middle">
            <a href="boss_reg.php"><img src="image/boss.png" id="boss_img"></a>
            <div type="hidden"></div>
            <a href="user_reg.php"><img src="image/jobseeker.png" id="jobseeker_img"></a>
        </div>
    </div>
    </div>
</div>
