<?php

// start session
session_start();

//  Create constrant to store non 
define('SITEURL', 'http://localhost/project/Foodorder1-main/admin/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'food-order');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); // db connection
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); // selecting db
