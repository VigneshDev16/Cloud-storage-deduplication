<?php
function dbconnect(){
$server   = "localhost";
$database = "phpmyadmin";
$username = "root";
$password = "";

$mysqlConnection = mysqli_connect($server, $username, $password,$database);
		date_default_timezone_set("Asia/Kolkata");
		return $mysqlConnection;
}
//echo var_dump(function_exists('mysql_connect'));
?>
