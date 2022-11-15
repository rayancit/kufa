<?php
require_once('../../db_connect.php');
session_start();

$email = $_POST['email'];
$password =sha1($_POST['password']);

$email_password_check_query = "SELECT COUNT(*) AS 'result' FROM admins  WHERE email = '$email' AND password = '$password'";
$email_password_check_db = mysqli_query($db_connect,$email_password_check_query);
$email_password_chcek_result = mysqli_fetch_assoc( $email_password_check_db);

$name_query = "SELECT id,name FROM admins WHERE email = '$email'";
$name_query_db = mysqli_query($db_connect,$name_query);
$name_query_result = mysqli_fetch_assoc( $name_query_db);
$name = $name_query_result['name'];
$id = $name_query_result['id'];

if ($email_password_chcek_result['result']) {
    $_SESSION['auth_email'] = $email;
    $_SESSION['auth_name'] = $name;
    $_SESSION['auth_id'] = $id;
    header('location: ../home.php');
}else{
    $_SESSION['login_error']= 'email || paswword mile nai';
    header('location: ./sign.php');
}

?>