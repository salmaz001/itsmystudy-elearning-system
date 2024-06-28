<?php
// XAMPP Local Datrabase
define('db_name', 'itsmystudy');
define('db_server', 'localhost');
define('db_user', 'root');
define('db_password', '');
define('db_port', 3306);  // Using port 3308 ---- Added 10/11/2021

// ------------------------------------------------------------------------------ //
$conn = mysqli_connect( db_server, db_user, db_password, db_name, db_port );

?>