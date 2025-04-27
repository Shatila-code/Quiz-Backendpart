<?php
include 'connection.php';

if($_SERVER['REQUEST_METHOD'] ==='POST'){

    $questionId = $_POST['questionId'];
    $questionName = $_POST['questionName'] ?? null;
    $questionTypeId = $_POST['questionTypeId'] ?? null;


    if(!$questionId){
        http_response_code(400);
        echo json_encode(['error'=>'Question ID is required']);
        exit;         
    }

    $fields = [];
    $params = [':questionId'=>$questionId];

    if($questionName !==null){
        $fields[] = "QuestionName =  :questionName";
        $params[':questionName'] = $questionName;
    }

    if($questionTypeId !==null){
        $fields[] ="QuestionTypeId = :questionTypeId";
        $params[':questionTypeId']=$questionTypeId;
    }
}