<?php
session_start();
$user = $_POST['user'];
$key = array_search($user, $_SESSION["name"]);
if ($key == 0) {
    array_shift($_SESSION["name"]);
} else {
    unset($_SESSION["name"]["$key"]);
}
