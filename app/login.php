<?php
session_start();
error_reporting(0);
require 'autoload.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $user = new UserController();

    // Fetch informations
    $accountNumber = $_POST['accountNumber'];
    $password      = $_POST['password'];

    // Checking wether account and password isset. If so, let's auth it.
    if(isset($accountNumber) && isset($password))
    {
        $user = $user->authUser($accountNumber, $password);

        if(isset($_SESSION['userid'])){
            header('location:../admin.php');
            exit();
        }else{
            header('location:../login.php');
            $_SESSION['error'] = 'true';
            exit();
        }

        print_r($_SESSION);
    }
}