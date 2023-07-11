<?php
session_start();
include '../../private/cios_connection.php';
require __DIR__ . '/flash.php';

$firstname = !empty($_POST['firstname']) ? $_POST['firstname'] : false;
$middlename = !empty($_POST['middlename']) ? $_POST['middlename'] : false;
$lastname = !empty($_POST['lastname']) ? $_POST['lastname'] : false;
$email = !empty($_POST['email']) ? $_POST['email'] : false;
$role_id = !empty($_POST['role_id']) ? $_POST['role_id'] : false;

$sql1 = 'SELECT * FROM login WHERE email = :email';
$fetch = $PDO->prepare($sql1);
$fetch->execute([':email' => $email]);
$count = $fetch->rowCount();

// controleert of er een emailadres is gevonden
if($count == 0){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $pass = 'Welkom01';

        $sql2 = 'INSERT INTO login (email, password, role_id) 
        VALUES (:email, :password, :role_id)';
        $query = $PDO->prepare($sql2);
        $query->execute([
            ':email' => $email,
            ':password' => password_hash($pass, PASSWORD_DEFAULT),
            ':role_id' => $role_id
        ]);

        $login_id = $PDO->lastInsertId();

        switch($role_id):
            case 1:
                $sql3 = 'INSERT INTO teachers (login_id, firstname, middlename, lastname) 
                VALUES (:login_id, :firstname, :middlename, :lastname)';
                $register = $PDO->prepare($sql3);
                $register->execute([
                    ':login_id' => $login_id,
                    ':firstname' => $firstname,
                    ':middlename' => $middlename,
                    ':lastname' => $lastname
                ]);
                break;
            case 2:
                $sql3 = 'INSERT INTO students (login_id, firstname, middlename, lastname) 
                VALUES (:login_id, :firstname, :middlename, :lastname)';
                $register = $PDO->prepare($sql3);
                $register->execute([
                    ':login_id' => $login_id,
                    ':firstname' => $firstname,
                    ':middlename' => $middlename,
                    ':lastname' => $lastname
                ]);
                break;
        endswitch;

        flash('register-success','Account is geregistreerd.','alert-success');
        header('location: ../index.php?page=register_user');

    } else {
        flash('email-fail','Emailadres is niet geldig.','alert-danger');
        header('location: ../index.php?page=register_user');
    }
} else {
    flash('email-taken','Emailadres is al in gebruik.','alert-danger');
    header('location: ../index.php?page=register_user');
}
?>