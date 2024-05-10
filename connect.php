<?php
$sname="localhost";
$unmae="root";
$password="";
$db_name="online counter";

$conn = mysqli_connect($sname,$unmae,$password,$db_name);

if(!$conn){
    echo "Failed to Connect";
}

?>
