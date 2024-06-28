<?php
$password = "123";
$salt = bin2hex(random_bytes(16)); // Generate a random 16-byte salt
$password_hash = hash('sha256', $password . $salt); // Hash the password and salt together
echo $salt;
echo "<br>";
echo $password_hash;