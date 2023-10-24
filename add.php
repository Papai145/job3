<?php
require('connect.php');
$winPlayer = $_POST['winPlayer'];
$losePlayer = $_POST['losePlayer'];
win($winPlayer,$connection);
loss($losePlayer,$connection);


function win($winPlayer,$connection)
{
    $query = "SELECT  win FROM `players` WHERE `name` = '$winPlayer'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $new = $row['win'] + 1;
    $query = "UPDATE `players` SET `win` = $new WHERE `name` = '$winPlayer'";
    mysqli_query($connection, $query);
}
function loss($losePlayer,$connection)
{
    $query = "SELECT  losing FROM `players` WHERE `name` = '$losePlayer'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $new = $row['losing'] + 1;
    $query = "UPDATE `players` SET `losing` = $new WHERE `name` = '$losePlayer'";
    mysqli_query($connection, $query);
}