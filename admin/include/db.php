<?php
$servername = "127.0.0.1";
$username = "root";
$userpwd = "";
$dbname = "cources";

//db connect
$conn = mysqli_connect($servername, $username, $userpwd, $dbname);

 //$conn = mysqli_connect('localhost', 'root','', 'cources');


//check connection
if(!$conn){
	die("connection failed:" . mysqli_connect_error());
}