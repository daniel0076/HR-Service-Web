<head>
    <?php include '../template/pre_css_js.php';?>
    <link rel="stylesheet" href="../css/register.css">
</head>
<body>
<?php
    include '../template/menubar.php';
    include '../template/register_modal_.php';
?>
<div class="ui segment">
    <div class="ui form" id="jobseekerform" action="reg_jobseeker.php" method="POST">
        <h4 class="ui dividing header">Job Seeker</h4>
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
            <label>Education</label>
            <div class="ui selection dropdown">
            <div class="default text">Select Education</div>
            <i class="dropdown icon"></i>
            <input type="hidden" name="education">
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
                    <div class="item" data-value="22000">22000</div>
                    <div class="item" data-value="40000">40000</div>
                    <div class="item" data-value="60000">60000</div>
                    <div class="item" data-value="80000">80000</div>
                    <div class="item" data-value="100000">100000</div>
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
        <div class="ui submit button">Submit</div>
    </div>
</div>
</body>
