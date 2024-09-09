<?php
session_start();
include '../config/db.php';
include '../includes/header.php';
include '../controllers/ActivityController.php';

if ($_SESSION['role'] !== 'student') {
    header('Location: ../public/login.php');
    exit();
}

$activityController = new ActivityController($pdo);
$activities = $activityController->getActivitiesByStudent($_SESSION['user_id']);
?>

<h1>My Activities</h1>
<table>
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Date</th>
    </tr>
    <?php foreach ($activities as $activity): ?>
        <tr>
            <td><?php echo htmlspecialchars($activity['title']); ?></td>
            <td><?php echo htmlspecialchars($activity['description']); ?></td>
            <td><?php echo htmlspecialchars($activity['date']); ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include '../includes/footer.php'; ?>
