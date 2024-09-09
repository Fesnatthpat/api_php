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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    if ($activityController->addActivity($title, $description, $date)) {
        echo "<p>Activity added successfully!</p>";
    } else {
        echo "<p>Failed to add activity.</p>";
    }
}
?>

<h1>Add New Activity</h1>

<form method="post" action="">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" required><br>
    
    <label for="description">Description:</label>
    <textarea id="description" name="description" required></textarea><br>
    
    <label for="date">Date:</label>
    <input type="date" id="date" name="date" required><br>
    
    <input type="submit" value="Add Activity">
</form>

<?php include '../includes/footer.php'; ?>
