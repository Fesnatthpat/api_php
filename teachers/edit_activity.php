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
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    if ($activityController->updateActivity($id, $title, $description, $date)) {
        // Redirect to manage_activities.php after successful update
        header('Location: manage_activities.php');
        exit();
    } else {
        echo "<p>Failed to update activity.</p>";
    }
} else {
    if (!isset($_GET['id'])) {
        echo "<p>Activity ID is missing.</p>";
        exit();
    }

    $id = $_GET['id'];
    $activity = $activityController->getActivityById($id);

    if (!$activity) {
        echo "<p>Activity not found.</p>";
        exit();
    }
}
?>

<h1>Edit Activity</h1>

<form method="post" action="">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($activity['id']); ?>">
    
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($activity['title']); ?>" required><br>
    
    <label for="description">Description:</label>
    <textarea id="description" name="description" required><?php echo htmlspecialchars($activity['description']); ?></textarea><br>
    
    <label for="date">Date:</label>
    <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($activity['date']); ?>" required><br>
    
    <input type="submit" value="Update Activity">
</form>

<?php include '../includes/footer.php'; ?>
