<?php
session_start();

// If there's no session or the user is not the correct type, redirect
if (!isset($_SESSION['user_id']) || $_SESSION['account_type'] !== 'business owner') {
    header("Location: login.php");
    exit();
}

// Or, if you want to ensure logout functionality, add an explicit check to prevent auto-redirecting to dashboard after logout
if (isset($_GET['logged_out']) && $_GET['logged_out'] == 1) {
    echo "You have logged out successfully.";
}
?>
