<?php
    if(isset($_POST['employee']))
    {
        header("Location: register_ee.php");
    }
    elseif(isset($_POST['employer']))
    {
        header("Location: register_er.php");
    }
    else
        die();
?>
