
<?php

if(isset($_SESSION['usertype'])==0)
{
    header("Location: index.php");
}