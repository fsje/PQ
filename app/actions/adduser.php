<?php
session_start();

if(!isset($_SESSION['userid']) && $_SESSION['userid'] == 1)
{
    header('location:login.php');
    exit();
}

require_once '../autoload.php';

// Image processing
$currentDirectory       = getcwd();     // current dir.
$uploadDirectory        = '/assets/avatars/'; // preferede upload

$errors                 = []; // Error array.

$fileExtensionsAllowed = ['jpeg','jpg','png']; // These will be the only file extensions allowed 

$fileName = $_FILES['avatar']['name'];
$fileSize = $_FILES['avatar']['size'];
$fileTmpName  = $_FILES['avatar']['tmp_name'];
$fileType = $_FILES['avatar']['type'];
$tmp = explode('.',$fileName);
$fileExtension = strtolower(end($tmp));

$uploadPath = $_SERVER['DOCUMENT_ROOT'] . $uploadDirectory . basename($fileName); 

if (! in_array($fileExtension,$fileExtensionsAllowed)) {
    $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
  }

  if ($fileSize > 4000000) {
    $errors[] = "File exceeds maximum size (4MB)";
  }

  if (empty($errors)) {
    $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

    if ($didUpload) {
      echo "The file " . basename($fileName) . " has been uploaded";
    } else {
      echo "An error occurred. Please contact the administrator.";
    }
  } else {
    foreach ($errors as $error) {
      echo $error . "These are the errors" . "\n";
    }
  }


    $accountData = array(
        'name'  => $_POST['companyName']
    );

    $accountController  = new AccountController();

    $accountId          = $accountController->addAccountWithArray($accountData, 'pq_accounts');

    // Check product information
    $userData = array(
        'companyName'           => $_POST['companyName'],
        'avatar'                 => basename($fileName),
        'accountNumber'          => $accountId,
        'mail'                   => $_POST['mail'],
        'password'               => password_hash($_POST['password'], PASSWORD_BCRYPT),
    );

// Initalize product controller
$userController  = new UserController();

print_r($userData);

$userID          = $userController->addUserWithArray($userData, 'pq_users');


    $data = 'RewriteRule ^' . $_POST['companyName'] . '*$ ./index.php?account=' . $_POST['companyName'] . ''.PHP_EOL;
    $fp = fopen('../../.htaccess', 'a');
    fwrite($fp, $data);

    header('location:../../portal.php');

