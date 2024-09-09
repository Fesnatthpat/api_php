<?php
session_start();
include '../config/db.php';
include '../includes/header.php';

if ($_SESSION['role'] !== 'teacher') {
    header('Location: ../public/login.php');
    exit();
}

include '../controllers/ActivityController.php';
$activityController = new ActivityController($pdo);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    if ($activityController->deleteActivity($id)) {
        echo "<p>Activity deleted successfully!</p>";
    } else {
        echo "<p>Failed to delete activity.</p>";
    }
} else {
    echo "<p>Activity ID is missing.</p>";
}

header('Location: manage_activities.php');
exit();
?>

<?php include '../includes/footer.php'; ?>
