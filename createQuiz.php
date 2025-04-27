<?php
include 'connection.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    if(!isset($_POST['quizName'], $_POST['categoryId'], $_POST['passingScore'], $POST['totalTime'], $POST['onwerId'])){
        http_response_code(400);
        echo json_encode(['error'=>'All fields are required']);

        exit;
    }

    <?php
    include 'db.php'; // Include the database connection file
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (!isset($_POST['quizName'], $_POST['categoryId'], $_POST['passingScore'], $_POST['totalTime'], $_POST['ownerId'])) {
            http_response_code(400);
            echo json_encode(['error' => 'All fields are required']);
            exit;
        }
    
        $quizName = $_POST['quizName'];
        $categoryId = $_POST['categoryId'];
        $passingScore = $_POST['passingScore'];
        $totalTime = $_POST['totalTime'];
        $ownerId = $_POST['ownerId'];
    
        try {
            $query = $pdo->prepare("INSERT INTO Quiz (QuizName, CategoryId, PassingScore, totalTime, OwnerId, DateAdded) 
                                   VALUES (:quizName, :categoryId, :passingScore, :totalTime, :ownerId, NOW())");

            $query->bindParam(":quizName", $quizName, PDO::PARAM_STR);

            $query->bindParam(":categoryId", $categoryId, PDO::PARAM_INT);

            $query->bindParam(":passingScore", $passingScore, PDO::PARAM_INT);

            $query->bindParam(":totalTime", $totalTime, PDO::PARAM_INT);

            $query->bindParam(":ownerId", $ownerId, PDO::PARAM_INT);
            $query->execute();
    
            echo json_encode([
                'message' => 'Quiz created successfully',
                'quizId' => $pdo->lastInsertId()
            ]);
        } catch (PDOException $e) {

            http_response_code(500);
            echo json_encode(['error' => 'Failed to create quiz: ' . $e->getMessage()]);
        }
    
    ?>