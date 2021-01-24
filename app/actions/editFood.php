<?php

// Initialize a session
session_start();

// Is the user logged in? If not reject.
if(!isset($_SESSION['userid']))
{header('location:login.php');}

// We'd like to require our autoload.
require_once '../autoload.php';



   
