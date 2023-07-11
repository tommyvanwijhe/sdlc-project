<?php
session_start();
include '../../private/cios_connection.php';
require __DIR__ . '/flash.php';

$teacher_id = !empty($_POST['teacher_id']) ? $_POST['teacher_id'] : false;
$datetime_id = !empty($_POST['datetime_id']) ? $_POST['datetime_id'] : false;
$name = !empty($_POST['name']) ? $_POST['name'] : false;
$description = !empty($_POST['description']) ? $_POST['description'] : NULL;
$maximum = !empty($_POST['maximum']) ? $_POST['maximum'] : NULL;

print_r($description);

$sql = 'SELECT * FROM sports WHERE teacher_id = :teacher_id AND datetime_id = :datetime_id';
$schedule = $PDO->prepare($sql);
$schedule->execute([
    ':teacher_id' => $teacher_id,
    ':datetime_id' => $datetime_id
]);
$count = $schedule->rowCount();

// controleert of docent op dit tijdstip al een les heeft
if($count == 0){
    $sql1 = 'INSERT INTO sports (teacher_id, datetime_id, name, description, maximum) 
    VALUES (:teacher_id, :datetime_id, :name, :description, :maximum)';
    $insert = $PDO->prepare($sql1);
    $insert->execute([
        ':teacher_id' => $teacher_id,
        ':datetime_id' => $datetime_id,
        ':name' => $name,
        ':description' => $description,
        ':maximum' => $maximum,
    ]);

    flash('new-sport','Sport is toegevoegd.','alert-success');
    header('location: ../index.php?page=sports');

} else {
    flash('email-taken','Deze docent heeft al een les op dit tijdstip.','alert-danger');
    header('location: ../index.php?page=new_sport');
}
?>