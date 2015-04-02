<head>
<?php 
    include '../template/pre_css_js.php';
?>
    <link rel="stylesheet" href="../css/register.css">

</head>
<body>
<?php
    include '../template/menubar.php';
    include '../template/register_modal_.php';
?>
<div class="ui segment">
<form class="ui form" id="bossform" action="reg_boss.php" method="POST">
<!--  <div class="ui error message">
    <div class="header">Action Forbidden</div>
    <p>You can only sign up for an account once with a given e-mail address.</p>
  </div>-->
 <h4 class="ui dividing header">Employer</h4>
    <div class="field">
      <label>Account</label>
      <input placeholder="Account" type="text" name="account">
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
    <button class="ui submit button" type="submit">Submit</button>
</form>
</div>
</body>
