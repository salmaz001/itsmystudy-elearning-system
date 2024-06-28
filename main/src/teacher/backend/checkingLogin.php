<?php
session_start();

if (!isset($_SESSION["login_tch"])) {
    echo "<script>
                alert('Please log in first!');
                window.location.href='../../index.php';
                </script>";
    exit();
}