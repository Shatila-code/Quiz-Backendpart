<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['quizId'])) {

        http_response_code(400);
        echo json_encode(['error' => 'Quiz ID is required']);
        exit;
    }

    $quizId = $_POST['quizId'];

    $quizName = $_POST['quizName'] ?? null; 

    $categoryId = $_POST['categoryId'] ?? null; 

    $passingScore = $_POST['passingScore'] ?? null; 

    $totalTime = $_POST['totalTime'] ?? null; 


    try {
        $sql = "UPDATE Quiz SET ";

        $params = [];

        $updates = [];

        if ($quizName !== null) {

            $updates[] = "QuizName = :quizName";

            $params[':quizName'] = $quizName;
        }

        if ($categoryId !== null) {

            $updates[] = "CategoryId = :categoryId";

            $params[':categoryId'] = $categoryId;
        }

        if ($passingScore !== null) {

            $updates[] = "PassingScore = :passingScore";

            $params[':passingScore'] = $passingScore;
        }

        if ($totalTime !== null) {

            $updates[] = "totalTime = :totalTime";

            $params[':totalTime'] = $totalTime;
        }

        if (empty($updates)) {

            http_response_code(response_code: 400);

            echo json_encode(['error' => 'No fields provided for update']);
            exit;
        }

        $sql .= implode(", ", $updates) . " WHERE Id = :quizId";

        $params[':quizId'] = $quizId;

        $query = $pdo->prepare($sql);

        foreach ($params as $key => $value) {
            $query->bindValue($key, $value);
        }

        $query->execute();

        echo json_encode(['message' => 'Quiz updated successfully']);

    } catch (PDOException $e) {

        http_response_code(response_code: 500);

        echo json_encode(['error' => 'Failed to update quiz: ' . $e->getMessage()]);
    }
}