<?php
session_start();
error_reporting(0);
require 'autoload.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $user = new UserController();

    $accountNumber = $_POST['accountNumber'];
    $password      = $_POST['password'];

    #echo $accountNumber . ' ' . password_hash($password, PASSWORD_BCRYPT);


    if(isset($accountNumber) && isset($password))
    {
        $user = $user->authUser($accountNumber, $password);

        if($_SESSION['userid']){
            header('location:../admin.php');
        }

        print_r($_SESSION);
    }
}