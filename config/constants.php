<?php
//display errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//this if condition will make sure we got get error or warning 
//we will start session only when if it isn't active
if (!isset($_SESSION)) {
    session_start();
}
//Constants for site url
//this if condition will avoid warnings
if (!defined("SITEURL")) define("SITEURL", "http://localhost/projects/ecom/");

//For DB connections
//for connecting to the database
$server_name = "localhost";
$username = "root";
$password = "";
$database = "ecom";

$conn = mysqli_connect($server_name, $username, $password, $database);
if (!$conn) {
    die("Sorry failed to connect");
}
