<?php
session_start();
include '../../private/cios_connection.php';
require __DIR__ . '/flash.php';

$sport_id = !empty($_POST['sport_id']) ? $_POST['sport_id'] : false;
$student_id = !empty($_POST['student_id']) ? $_POST['student_id'] : false;

// sql om te kijken of de gebruiker al bij een sport is ingeschreven
$sql = 'SELECT * FROM sport_students WHERE student_id = :student_id';
$fetch = $PDO->prepare($sql);
$fetch->execute([':student_id' => $student_id]);
$count = $fetch->rowCount();

// sql om te kijken wat het maximum aantal deelnemers van een sport is
$sql1 = 'SELECT maximum FROM sports WHERE sport_id = :sport_id';
$state = $PDO->prepare($sql1);
$state->execute([':sport_id' => $sport_id]);
$sport = $state->fetch(PDO::FETCH_ASSOC);

// sql om te kijken hoeveel deelnemers er bij een sport zitten
$sql2 = 'SELECT student_id FROM sport_students WHERE sport_id = :sport_id';
$students = $PDO->prepare($sql2);
$students->execute([':sport_id' => $sport_id]);
$members = $students->rowCount();

// sql om het inschrijfmoment op te halen
$sql3 = 'SELECT start_date, end_date FROM votingdate';
$vali_date = $PDO->prepare($sql3);
$vali_date->execute();
$dates = $vali_date->fetch(PDO::FETCH_ASSOC);
$now_time = date('Y-m-d');

// controleert of er een resultaat is
if($count == 0){
    if($dates['start_date'] <= $now_time){
        if($now_time <= $dates['end_date']){
            if($members < $sport['maximum']){
                $sql3 = 'INSERT INTO sport_students (sport_id, student_id) 
                VALUES (:sport_id, :student_id)';
                $query = $PDO->prepare($sql3);
                $query->execute([
                    ':sport_id' => $sport_id,
                    ':student_id' => $student_id
                ]);
                flash('signup-success','Je bent ingeschreven.','alert-success');
                header('location: ../index.php?page=sports');

            } else {
                flash('sport-full','Helaas, deze groep zit vol.','alert-danger');
                header('location: ../index.php?page=sports');
            }
        } else {
            flash('date-late','Je bent te laat met inschrijven.','alert-danger');
            header('location: ../index.php?page=sports');
        }
    } else {
        flash('date-early','Je bent te vroeg met inschrijven.','alert-danger');
        header('location: ../index.php?page=sports');
    }
} else {
    flash('signup-fail','Je bent al voor een sport ingeschreven.','alert-danger');
    header('location: ../index.php?page=sports');
}
?>