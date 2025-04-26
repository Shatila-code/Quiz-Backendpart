<?php

try{

    $host = "localhost";
    $dbname= "QuizDB";
    $user = "root";
    $pass = "";
 
  $connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
   
  $connection-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  echo "Connected successfully!";
 }
catch(\Throwable $e){

    echo "connection failed!" .$e->getMessage();
}
