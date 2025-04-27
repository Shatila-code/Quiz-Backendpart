<?php

include 'connection.php';

if($_SERVER['REQUEST_METHOD'] ==='POST'){
 
    if(!isset($_POST['questionName'], $_POST['questionTypeId'], $_POST['quizId'])){


     http_response_code(400);
     
     echo json_encode(['error'=>'All fields are required']);
     exit;
    }
    $questionName = $_POST['questionName'];
    $questionTypeId = $_POST['questionTypeId'];
    $quizId = $_POST['quizId'];



    try{

        $query = $pdo->prepare("INSERT INTO Questions(QuestionName,QuestionTypeId,QuizId)
        Values(:questionName,:questionTypeId,:quizId)");

        $query->bindParam(":questionName",$questionName,PDO::PARAM_STR);
        $query->bindParam(":questionTypeId",$questionTypeId,PDO::PARAM_INT);
        $query->bindParam(":quizId",$quizId,PDO::PARAM_INT);
        $query->execute();

        echo json_encode([

            'message'=>'Question created successfully',
            'questionId'=>$pdo->lastInsertId()
        ]);
    }


    catch(PDOException $e){

        http_response_code(400);
        echo json_encode(['error'=>'Failed to creatte question: ' . $e->getMessage()]);
    }
}