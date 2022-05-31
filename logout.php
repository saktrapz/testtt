<?php
include "function.php";
    session_start();
    unset($_SESSION['id']);
    header("location: login.php");
?>