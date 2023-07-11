<?php
session_start();
include '../../private/cios_connection.php';
require __DIR__ . '/flash.php';

$email = !empty($_POST['email']) ? $_POST['email'] : false;
$password = !empty($_POST['password']) ? $_POST['password'] : false;

$sql1 = 'SELECT login_id, role_name, email, password FROM login 
INNER JOIN roles ON login.role_id=roles.role_id WHERE email = :email';
$fetch = $PDO->prepare($sql1);
$fetch->execute([':email' => $email]);

$result = $fetch->fetch(PDO::FETCH_ASSOC);
if(!empty($result)){
    if(password_verify($password, $result['password'])){
        $_SESSION['login_id'] = $result['login_id'];
        $_SESSION['role'] = $result['role_name'];
    
        header('location: ../index.php?page=sports');
    } else {
        flash('pass-fail','Wachtwoord is onjuist.','alert-danger');
        header('location: ../index.php?page=login');
    }
} else {
    flash('name-fail','E-mailadres is niet geregistreerd.','alert-danger');
    header('location: ../index.php?page=login');
}
?>