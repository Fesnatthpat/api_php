<?php
session_start();
include '../config/db.php';
include '../includes/header.php';
include '../controllers/ActivityController.php';

if ($_SESSION['role'] !== 'student') {
    header('Location: ../public/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $activity_id = $_POST['activity_id'];

    include '../controllers/RegistrationController.php';
    $registrationController = new RegistrationController($pdo);
    $registrationController->registerStudent($_SESSION['user_id'], $activity_id);

    header('Location: activities.php');
    exit();
}

$activityController = new ActivityController($pdo);
$activities = $activityController->getAllActivities();
?>

<h1>Register for Activity</h1>
<form method="POST">
    <label for="activity_id">Select Activity:</label>
    <select name="activity_id" id="activity_id" required>
        <?php foreach ($activities as $activity): ?>
            <option value="<?php echo $activity['id']; ?>"><?php echo htmlspecialchars($activity['title']); ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Register</button>
</form>

<?php include '../includes/footer.php'; ?>
