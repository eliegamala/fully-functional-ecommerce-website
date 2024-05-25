<?php


  //connect to databse
  $DBhost = "mysql:host=localhost;dbname=ecommerce_db";
  $DBuser = "root";
  $userPassword = "";


  $conn = new PDO($DBhost,$DBuser,$userPassword);

  if(!$conn){
    die("database not connected");
  }

?>