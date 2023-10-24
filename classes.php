<?php
session_start();
if(count($_SESSION["name"]) == 2){
    header("Location:index.php");
} ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form{
            position: absolute;
            left: 50%;
            top: 50%;
        }
    </style>
</head>
<body>
    <form action="login.php" method="GET">
        <h2>Введите имя</h2>
        <input type="text" name="name">
        <input type="submit">
    </form>
</body>
</html>