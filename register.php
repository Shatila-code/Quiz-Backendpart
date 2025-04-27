<?php
include 'connection.php';

if($_SERVER['REQUEST_METHOD']==='POST')
{
    // validate the user submitted all the required data

    if(!isset($_POST['name'],$_POST['email'],$_POST['password']))
    {
        http_response_code(400);
        echo json_encode(["error "=>"please enter all the required fields and try again"]);
        exit;
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

try{
    $query = $pdo->prepare("select * from users where Email = :email");
    $query->bindParam(":email",$email,PDO::PARAM_STR);
    $query->execute();

    if($query->fetch(PDO::FETCH_ASSOC)){
        http_response_code(400);
        echo json_encode(["error"=> " user already exits"]);
        exit;
    }
   $hashedPassword = password_hash($password,PASSWORD_BCRYPT);

   $query = $pdo->prepare("insert into users(Name,Email,Password) Values(:name,:email,:password)");
   $query->bindParam(":name",$name,PDO::PARAM_STR);
   $query->bindParam(":email",$email,PDO::PARAM_STR);
   $query->bindParam(":password",$hashedPassword,PDO::PARAM_STR);
   $query->execute();

   echo json_encode([

    'message'=> 'user successfully registered :)'
   ]);
}

catch(PDOException $e){
    
    http_response_code(500);

    echo json_encode(['error '=>'registration failed:'. $e->getMessage()]);
}

}