<?php
session_start();

if (!isset($_SESSION["login_admin"])) {
    echo "<script>
                alert('Please log in first!');
                window.location.href='./index.php';
                </script>";
    exit();
}