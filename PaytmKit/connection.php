<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'userName');
define('DB_PASSWORD', 'password');
define('DB_NAME', 'dbName');
 

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
if($conn === false){
    die("[ERROR 401]: Could not connect to server. Try again later ");
}


?>
