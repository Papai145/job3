<?php
session_start();
$_SESSION["name"];
require('connect.php');

$name = $_GET["name"];

if (!empty($name)) {
    $query = "SELECT  * FROM `players` WHERE `name` = '$name'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);
    if ($row["name"]) {
   
        $_SESSION["name"][] = $row["name"];
        header("Location:classes.php");
    } else {
        $query = "INSERT INTO `players` (`name`) VALUES ('$name')";
        $result = mysqli_query($connection, $query);

        $_SESSION["name"][] = $name;
        header("Location:classes.php");
    }
} else{
    header("Location:classes.php");
}

