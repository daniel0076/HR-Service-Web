<?php
    session_start();
    require_once('admin/reg_user.php');
?>

<!DOCTYPE html>
<head>
<?php
    include 'template/pre_css_js.php';
?>
    <script src="js/register_button.js"></script>
    <script src="js/user_reg_form.js"></script>
    <link rel="stylesheet" href="css/register.css">
    <?php $xajax->printJavascript('static/'); ?>
    <title>User Register</title>
</head>
<body>
<?php
    include 'template/menubar.php';
    include 'template/register_modal.php';
?>
<div class="container">
<form class="ui form" id="jobseekerform" name="jobseekerform" onsubmit="<?php $reg->printScript();?>;return false;">
        <h4 class="ui dividing header">立即註冊，找個好工作</h4>
        <div class="ui blue attached fluid message" id="response"> </div>
        <div class="field">
            <label>Account</label>
            <input placeholder="Account" type="text" name="account" id="account">
        </div>
        <div class="field">
            <label>Password</label>
            <input placeholder="Password" type="password" name="password">
        </div>
        <div class="field">
            <label>Confirm Password</label>
            <input placeholder="Confirm Password" type="password" name="conpassword">
        </div>
        <div class="field">
            <label>Education</label>
            <div class="ui selection dropdown">
            <div class="default text">Select Education</div>
            <i class="dropdown icon"></i>
            <input type="hidden" name="education">
                <div class="menu">
                    <div class="item" data-value="GraduateSchool">Graduate School</div>
                    <div class="item" data-value="UndergraduateSchool">Undergraduate School</div>
                    <div class="item" data-value="SeniorHighSchool">Senior High School</div>
                    <div class="item" data-value="JuniorHighSchool">Junior School</div>
                    <div class="item" data-value="ElementarySchool">Elementary School</div>
                </div>
            </div>
        </div>
        <div class="field">
            <label>Expected Salary</label>
            <div class="ui selection dropdown">
            <div class="default text">Select Salary</div>
            <i class="dropdown icon"></i>
            <input type="hidden" name="salary">
                <div class="menu">
                    <div class="item" data-value="22000">22000</div>
                    <div class="item" data-value="30000">30000</div>
                    <div class="item" data-value="40000">40000</div>
                    <div class="item" data-value="50000">50000</div>
                    <div class="item" data-value="70000">70000</div>
                </div>
            </div>
        </div>
        <div class="field">
            <label>Phone</label>
            <input placeholder="Phone" type="text" name="phone">
        </div>
        <div class="field">
            <label>Gender</label>
            <div class="ui selection dropdown">
            <div class="default text">Select Gender</div>
            <i class="dropdown icon"></i>
            <input type="hidden" name="gender">
                <div class="menu">
                    <div class="item" data-value="male">Male</div>
                    <div class="item" data-value="female">Female</div>
                </div>
            </div>
        </div>
        <div class="field">
            <label>Age</label>
            <input placeholder="Age" type="text" name="age">
        </div>
        <div class="field">
            <label>Email</label>
            <input placeholder="Email" type="text" name="email">
        </div>
        <div class='inline fields'>
            <label>Specialties</label>
            <br>
<?php
    $db=new JobSeeker();
    make_specialty_list($db);
?>
        </div>
        <div class="ui submit button" type="submit">Submit</div>
    </form>
</div>
</body>
