<?php
session_start();
include '../config/db.php';
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    include '../controllers/UserController.php';
    $userController = new UserController($pdo);

    if ($userController->registerUser($username, $password, $role)) {
        header('Location: login.php');
        exit();
    } else {
        echo 'Error registering user';
    }
}
?>

<form method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    <label for="role">Role:</label>
    <select name="role" id="role" required>
        <option value="student">Student</option>
        <option value="teacher">Teacher</option>
    </select>
    <button type="submit">Register</button>
</form>

<?php include '../includes/footer.php'; ?>
