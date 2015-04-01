<?php
    include '../template/menubar.php';
?>
<div class="ui error form segment">
<!--  <div class="ui error message">
    <div class="header">Action Forbidden</div>
    <p>You can only sign up for an account once with a given e-mail address.</p>
  </div>-->
    <div class="field">
      <label>Account</label>
      <input placeholder="Account" type="text">
    </div>
    <div class="field">
      <label>Password</label>
      <input placeholder="Password" type="password">
    </div>
  <div class="field">
    <label>Education</label>
    <div class="ui selection dropdown">
      <div class="default text">Select Education</div>
      <i class="dropdown icon"></i>
      <input type="hidden" name="gender">
      <div class="menu">
        <div class="item" data-value="graduate">Graduate School</div>
        <div class="item" data-value="undergraduate">Undergraduate School</div>
        <div class="item" data-value="senior">Senior High School</div>
        <div class="item" data-value="junior">Junior School</div>
        <div class="item" data-value="elementary">Elementary School</div>
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
        <div class="item" data-value="sal_22000">22000</div>
        <div class="item" data-value="sal_22-40">22000-40000</div>
        <div class="item" data-value="sal_40-60">40000-60000</div>
        <div class="item" data-value="sal_over60">Over 60000</div>
      </div>
    </div>
  </div>
  <div class="field">
    <label>Phone</label>
    <input placeholder="Phone" type="text">
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
    <input placeholder="Age" type="text">
  </div>
  <div class="field">
    <label>Email</label>
    <input placeholder="Email" type="text">
  </div>
  <div class="ui submit button">Submit</div>
</div>
