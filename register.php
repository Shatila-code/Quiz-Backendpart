<?php
include 'connection.php';

if($_SERVER['REQUEST_METHOD']==='POST')
{
    // validate the user submitted all the required data

    if(!isset($__POST['name'],$_POST['email'],$_POST['password']))
    {
        http_response_code(400);
        echo json_encode(["error please enter all the required fields and try again"]);
        exit;
    }

    $name = $_POST['name'];
    $email = $__POST['email'];
    $password = $_POST['password'];

try{}


catch{}

}