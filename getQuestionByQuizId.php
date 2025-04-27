<?php
include 'connection.php';
if($_SERVER['REQUEST_METHOD']==='GET'){

    if(!isset($_GET['quizId'])){

        http_response_code(400);
        echo json_encode(['error'=>'Quiz ID is required please renter it']);
        exit;

    }


    $quizId = $_GET['quizId'];


    try{

        $query = $pdo->prepare("SELECT * FROM Questions WHERE QuizId = :quizId");
        $query->bindParam(":quizId",$quizId, PDO::PARAM_INT);
        $query->execute();

        $questions = $query->fetchAll(PDO::FETCH_ASSOC);

    

        foreach ($questions as &$question) {
            $questionOptions = $pdo->prepare("SELECT Id, OptionName, isCorrect FROM Question_options WHERE QuestionId = :questionId");
            $questionOptions->bindParam(":questionId", $question['Id'], PDO::PARAM_INT);
            $questionOptions->execute();
            $question['options'] = $questionOptions->fetchAll(PDO::FETCH_ASSOC);
        }

        echo json_encode($questions);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to fetch questions: ' . $e->getMessage()]);
    }

}