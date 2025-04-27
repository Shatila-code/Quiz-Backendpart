<?php

include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['questionTypeDesc'], $_POST['numOfPoints'], $_POST['timePerQuestion'])) {

        http_response_code(400);

        echo json_encode(['error' => 'All fields (questionTypeDesc, numOfPoints, timePerQuestion) are required']);
        exit;
    }

    $questionTypeDesc = $_POST['questionTypeDesc'];
    $numOfPoints = $_POST['numOfPoints'];
    $timePerQuestion = $_POST['timePerQuestion'];

    try {
        $query = $pdo->prepare("INSERT INTO QuestionType (QuestionTypeDesc, NumOfPoints, timePerQuestion) 
                               VALUES (:questionTypeDesc, :numOfPoints, :timePerQuestion)");

        $query->bindParam(":questionTypeDesc", $questionTypeDesc, PDO::PARAM_STR);

        $query->bindParam(":numOfPoints", $numOfPoints, PDO::PARAM_INT);
        
        $query->bindParam(":timePerQuestion", $timePerQuestion, PDO::PARAM_INT);
        $query->execute();

        echo json_encode([

            'message' => 'Question type created successfully',
            
            'questionTypeId' => $pdo->lastInsertId()
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to create question type: ' . $e->getMessage()]);
    }
}
?>