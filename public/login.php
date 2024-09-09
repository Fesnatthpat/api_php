<?php
session_start();
include '../config/db.php';
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    include '../controllers/UserController.php';
    $userController = new UserController($pdo);

    $user = $userController->loginUser($username, $password);
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header('Location: ../public/index.php');
        exit();
    } else {
        echo 'Invalid username or password';
    }
}
?>

<form method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    <button type="submit">Login</button>
</form>

<?php include '../includes/footer.php'; ?>
