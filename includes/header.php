<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Activity Management System</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <header>
        <nav>
            <a href="../public/index.php">Home</a>
            <?php if (isset($_SESSION['role'])): ?>
                <a href="../students/activities.php">My Activities</a>
                <a href="../students/register_activity.php">Register for Activity</a>
                <?php if ($_SESSION['role'] == 'teacher'): ?>
                    <a href="../teachers/manage_activities.php">Manage Activities</a>
                <?php endif; ?>
                <a href="../public/logout.php">Logout</a>
            <?php else: ?>
                <a href="../public/login.php">Login</a>
                <a href="../public/register.php">Register</a>
            <?php endif; ?>
        </nav>
    </header>
