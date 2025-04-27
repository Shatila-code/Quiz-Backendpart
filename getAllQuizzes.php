<?php
include 'connection.php';

if($_SERVER['REQUEST_METHOD'] ==='GET'){

    try{

        $query =$pdo->query("SELECT Quiz.Id, Quiz.QuizName, category.CategoryDesc AS Category, Quiz.PassingScore, Quiz.totalTime 
 FROM Quiz 
        
        inner join category on Quiz.CateogryId = category.Id");
        $quizzes = $query->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($quizzes);

    }


    catch(PDOException $e){

        http_response_code(500);
        echo json_encode(['error' => 'Failed to fetch quizzes:'.$e->getMessage()]);

    }
}