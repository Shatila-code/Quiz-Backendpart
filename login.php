<?php
include 'connection.php';

if($_SERVER['REQUEST_METHOD'] === 'POST')
{

     if(!isset($_POST['email'],$_POST['password'])){
        http_response_code(400);
        echo json_encode(['error'=>'Email and password are required .']);
        exit;
     }
}
$email = $_POST['email'];
$password = $_POST['password'];


try{
    $query = $pdo->prepare(" SELECT * FROM users WHERE Email = :email");
     $query->bindParam(":email",$email,PDO::PARAM_STR);
     $query->execute();
 

     if($user && password_verify($password, $user['Password'])){

        unset($user['Password']);

        echo json_encode([
            'message'=> ' successfull Login :)',
            'user'=>$user
        ]);
     }
     else{

        http_response_code(401);
        echo json_encode(['error'=> 'Invalid email or password']);
     }
}


catch(){

}