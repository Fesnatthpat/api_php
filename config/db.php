<?php
// ตั้งค่าการเชื่อมต่อฐานข้อมูล
$host = 'localhost'; // ที่อยู่ของเซิร์ฟเวอร์ฐานข้อมูล
$dbname = 'university_activity_management'; // ชื่อฐานข้อมูล
$username = 'root'; // ชื่อผู้ใช้ MySQL
$password = ''; // รหัสผ่านของผู้ใช้ MySQL (หากไม่มีให้ปล่อยว่าง)

// สร้างการเชื่อมต่อกับฐานข้อมูลโดยใช้ PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // ตั้งค่าให้ PDO แสดงข้อผิดพลาดเมื่อเกิดข้อผิดพลาดใน SQL
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // แสดงข้อผิดพลาดหากไม่สามารถเชื่อมต่อฐานข้อมูลได้
    die("Connection failed: " . $e->getMessage());
}
?>
