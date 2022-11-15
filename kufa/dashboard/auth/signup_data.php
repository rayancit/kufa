<?php
session_start();
require_once('../../db_connect.php');
$name = htmlspecialchars(trim($_POST['user_name']));
$email = htmlspecialchars($_POST['user_email']);
$password =  htmlspecialchars($_POST['user_password']);
$user_confirm_password = htmlspecialchars($_POST['user_confirm_password']);

// email check in database
$email_check_query = "SELECT COUNT(*) AS 'result' FROM admins WHERE email = '$email'";
$email_check_db=mysqli_query($db_connect,$email_check_query);
$email_chcek_result = mysqli_fetch_assoc( $email_check_db);
$flag = false;

if ($name) {
    $remove_name_space = str_replace(" ", "", $name);
    if (ctype_alpha($remove_name_space)) {
        $_SESSION["old_name"]= $name;
    }else {
        $flag = true;
        $_SESSION['name_error'] = 'name ';
    }
} else {
    $flag = true;
    $_SESSION['name_error'] = 'name daw nai';
}
if ($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if ($email_chcek_result['result']) {
            $flag = true;
            $_SESSION['email_error'] = 'email ache';
        }
        $_SESSION["old_email"]= $email;
    }else {
        $flag = true;
        $_SESSION['email_error'] = 'email not valid';
    }
} else {
    $flag = true;
    $_SESSION['email_error'] = 'email daw nai';
}

if ($password) {
    if (!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/', $password)) {
        $flag = true;
        $_SESSION['password_error'] = 'password thik nai';
    }
} else {
    $flag = true;
    $_SESSION['password_error'] = 'password daw nai';
}
if ($user_confirm_password) {
    if (!($password === $user_confirm_password)) {
        $flag = true;
        $_SESSION['confirm_password_error'] = 'confirm password mile nai';
    }
} else {
    $flag = true;
    $_SESSION['confirm_password_error'] = 'confirm password daw nai';
}
if ($flag) {
    header('location:./signup.php');
}else {
    $password_encode = sha1($password);
    $admin_query = "INSERT INTO `admins` (name, email, password) VALUES ( '$name', '$email', '$password_encode')";
    mysqli_query($db_connect,$admin_query);
    $_SESSION['signin_status'] = "hello $name";
    header('location: ./sign.php');
}
