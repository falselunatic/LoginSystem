<?php
$_SERVER = 'localhost';
$username ='root';
$password = '';
$database = 'usersdata';

$conn = mysqli_connect($_SERVER,$username,$password,$database);
if(!$conn){
    die("error". mysqli_connect_error());
}
?>