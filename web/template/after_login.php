<a class="floating item">
<?php 
if(isset($_SESSION['is_boss']))
{
    echo "Hi!   ".htmlspecialchars($_SESSION['boss_name']);
}
else if(isset($_SESSION['is_user']))
{
    echo "Hi!   ".htmlspecialchars($_SESSION['user_name']);
}
?>
</a>
<a class="item" href="login.php?logout">
    <i class="sign out icon"></i> Log out
</a>

