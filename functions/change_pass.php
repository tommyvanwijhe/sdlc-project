<?php
session_start();
include '../../private/cios_connection.php';
require __DIR__ . '/flash.php';

$old_pass = !empty($_POST['old_pass']) ? $_POST['old_pass'] : false;
$new_pass = !empty($_POST['new_pass']) ? $_POST['new_pass'] : false;
$val_pass = !empty($_POST['val_pass']) ? $_POST['val_pass'] : false;

$sql = 'SELECT * FROM login WHERE login_id = :login_id';
$fetch = $PDO->prepare($sql);
$fetch->execute([':login_id' => $_SESSION['login_id']]);
$result = $fetch->fetch(PDO::FETCH_ASSOC);

print_r($result);

if($new_pass === $val_pass){
    if($result && password_verify($old_pass, $result['password'])){
        $sql1 = "UPDATE login SET password=:password WHERE login_id=:login_id";
        $editpass = $PDO->prepare($sql1);
        $editpass->execute([
            ':password' => password_hash($new_pass, PASSWORD_DEFAULT),
            ':login_id' => $_SESSION['login_id']
        ]);
        flash('pass-success','Wachtwoord is gewijzigd.','alert-success');
        header('location: ../index.php?page=profile');
    } else {
        flash('pass-fail','Oud wachtwoord is onjuist.','alert-danger');
        header('location: ../index.php?page=change_pass');
    }
} else {
    flash('val-fail','Nieuwe wachtwoorden zijn niet hetzelfde.','alert-danger');
    header('location: ../index.php?page=change_pass');
}
?>