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

// ดึงข้อมูลกิจกรรมทั้งหมดที่ครูสามารถดูได้
$activities = $activityController->getAllActivities();
?>

<h1>Manage Activities</h1>

<table>
    <thead>
        <tr>
            <th>Activity Title</th>
            <th>Registered Students</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($activities as $activity): ?>
            <tr>
                <td><?php echo htmlspecialchars($activity['title']); ?></td>
                <td>
                    <?php
                    // ดึงข้อมูลนักเรียนที่ลงทะเบียนเข้ากิจกรรม
                    $students = $activityController->getStudentsByActivity($activity['id']);
                    if (!empty($students)) {
                        foreach ($students as $student) {
                            echo htmlspecialchars($student['student_name']) . "<br>";
                        }
                    } else {
                        echo "No students registered.";
                    }
                    ?>
                </td>
                <td>
                    <a href="edit_activity.php?id=<?php echo $activity['id']; ?>">Edit</a> |
                    <a href="delete_activity.php?id=<?php echo $activity['id']; ?>" onclick="return confirm('Are you sure you want to delete this activity?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="add_activity.php">Add New Activity</a>

<?php include '../includes/footer.php'; ?>
