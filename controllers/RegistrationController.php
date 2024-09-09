<?php
class RegistrationController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function registerStudent($student_id, $activity_id) {
        $sql = "INSERT INTO registrations (student_id, activity_id) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$student_id, $activity_id]);
    }
}
?>
