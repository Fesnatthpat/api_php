<?php
class ActivityController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addActivity($title, $description, $date) {
        $sql = "INSERT INTO activities (title, description, date) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$title, $description, $date]);
    }

    public function getAllActivities() {
        $sql = "SELECT * FROM activities";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getActivityById($id) {
        $sql = "SELECT * FROM activities WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateActivity($id, $title, $description, $date) {
        $sql = "UPDATE activities SET title = ?, description = ?, date = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$title, $description, $date, $id]);
    }

    public function deleteActivity($id) {
        // ลบการลงทะเบียนที่เกี่ยวข้องก่อนลบกิจกรรม
        $sql = "DELETE FROM registrations WHERE activity_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);

        // ลบกิจกรรม
        $sql = "DELETE FROM activities WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function getActivitiesByStudent($student_id) {
        $sql = "
            SELECT activities.*, users.username AS student_name
            FROM activities
            JOIN registrations ON activities.id = registrations.activity_id
            JOIN users ON registrations.student_id = users.id
            WHERE registrations.student_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$student_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ฟังก์ชันใหม่ในการดึงนักเรียนที่ลงทะเบียนสำหรับกิจกรรมเฉพาะ
    public function getStudentsByActivity($activity_id) {
        $sql = "
            SELECT users.username AS student_name
            FROM registrations
            JOIN users ON registrations.student_id = users.id
            WHERE registrations.activity_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$activity_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
