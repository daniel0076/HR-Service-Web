<?php
    session_start();
    require_once('admin/reg_boss.php');
?>
<head>
    <?php include 'template/pre_css_js.php';?>
    <link rel="stylesheet" href="css/register.css">
    <script type="text/javascript" src="js/register_button.js"></script>
    <script type="text/javascript" src="js/boss_reg_form.js"></script>
    <?php $xajax->printJavascript('static/'); ?>
    <title>Boss Register</title>
</head>
<body>
<?php
    include 'template/menubar.php';
    include 'template/register_modal.php';
?>
<div class="container">
<form class="ui form" id="bossform" name="bossform" onsubmit="<?php $reg->printScript();?>;return false;">
 <h4 class="ui dividing header">Employer</h4>
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
      <label>Phone</label>
      <input placeholder="Phone" type="text" name="phone">
    </div>
    <div class="field">
      <label>Email</label>
      <input placeholder="Email" type="text" name="email">
    </div>
    <div class="ui submit button" type="submit">Submit</div>
</form>
</div>
</body>
