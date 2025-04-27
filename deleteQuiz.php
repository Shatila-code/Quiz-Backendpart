<?php
include 'connection.php';

if($_SERVER['REQUEST_METHOD'] ==='POST'){

    if(!isset($_POST['quizId'])){
        http_response_code(400);
        echo json_encode(['error'=>'Quiz ID is required']);
        exit;
    }

    $quizId = $_POST['quizId'];


    try{
        $query = $pdo->prepare("DELETE FROM Quiz WHERE Id =:quizId");
        $query->bindParam(":quizId",$quizId,PDO::PARAM_INT);
        $query->execute();

        echo json_encode(['message'=>'Quiz deleted successfully']);
    }


    catch(PDOException $e){
        http_response_code(500);
        echo json_encode(['error'=>'Failed to update quiz ' . $e->getMessage()]);
    }

}