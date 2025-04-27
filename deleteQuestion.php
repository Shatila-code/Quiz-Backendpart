<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['questionId'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Question ID is required']);
        exit;
    }

    $questionId = $_POST['questionId'];

    try {
        $questionoptions = $pdo->prepare("DELETE FROM Question_options WHERE QuestionId = :questionId");
        $questionoptions->bindParam(":questionId", $questionId, PDO::PARAM_INT);
        $questionoptions->execute();

         $query = $pdo->prepare("DELETE FROM Questions WHERE Id = :questionId");
        $query->bindParam(":questionId", $questionId, PDO::PARAM_INT);
        $query->execute();

        echo json_encode(['message' => 'Question deleted successfully']);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to delete question: ' . $e->getMessage()]);
    }
}
?>