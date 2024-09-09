<?php
// api.php

include 'db.php'; // เชื่อมต่อฐานข้อมูล

$method = $_SERVER['REQUEST_METHOD']; // รับ HTTP method ที่ส่งมา
$pdo = connectDB(); // เชื่อมต่อฐานข้อมูล

if ($method == 'GET') {
    // ดึงข้อมูล (GET)
    $stmt = $pdo->query("SELECT * FROM activities");
    $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($activities);

} elseif ($method == 'POST') {
    // เพิ่มข้อมูล (POST)
    $data = json_decode(file_get_contents("php://input"), true);
    if (isset($data['name']) && isset($data['description'])) {
        $stmt = $pdo->prepare("INSERT INTO activities (name, description) VALUES (?, ?)");
        if ($stmt->execute([$data['name'], $data['description']])) {
            echo json_encode(['message' => 'Activity added successfully']);
        } else {
            echo json_encode(['message' => 'Failed to add activity']);
        }
    } else {
        echo json_encode(['message' => 'Invalid data']);
    }

} elseif ($method == 'PUT') {
    // แก้ไขข้อมูล (PUT)
    $data = json_decode(file_get_contents("php://input"), true);
    if (isset($data['id']) && isset($data['name']) && isset($data['description'])) {
        $stmt = $pdo->prepare("UPDATE activities SET name = ?, description = ? WHERE id = ?");
        if ($stmt->execute([$data['name'], $data['description'], $data['id']])) {
            echo json_encode(['message' => 'Activity updated successfully']);
        } else {
            echo json_encode(['message' => 'Failed to update activity']);
        }
    } else {
        echo json_encode(['message' => 'Invalid data']);
    }

} elseif ($method == 'DELETE') {
    // ลบข้อมูล (DELETE)
    $data = json_decode(file_get_contents("php://input"), true);
    if (isset($data['id'])) {
        $stmt = $pdo->prepare("DELETE FROM activities WHERE id = ?");
        if ($stmt->execute([$data['id']])) {
            echo json_encode(['message' => 'Activity deleted successfully']);
        } else {
            echo json_encode(['message' => 'Failed to delete activity']);
        }
    } else {
        echo json_encode(['message' => 'Invalid data']);
    }
}
?>
