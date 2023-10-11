
<?php
$servername="localhost";
$username="root";
$password="";
$database="mywebsite";

$conn=mysqli_connect($servername,$username,$password,$database);
if(!$conn){
    echo mysql_connect_error();
}
?>