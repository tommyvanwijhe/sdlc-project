<?php
session_start();
include '../../private/cios_connection.php';
require __DIR__ . '/flash.php';

$old_start = !empty($_POST['old_start_date']) ? $_POST['old_start_date'] : false;
$old_end = !empty($_POST['old_end_date']) ? $_POST['old_end_date'] : false;
$start = !empty($_POST['start_date']) ? $_POST['start_date'] : false;
$end = !empty($_POST['end_date']) ? $_POST['end_date'] : false;

date_default_timezone_set("Europe/Amsterdam");
$date = date('y-m-d H:i:s');

$sql = 'SELECT votingdate_id FROM votingdate';
$fetch = $PDO->prepare($sql);
$fetch->execute();
$result = $fetch->fetch(PDO::FETCH_ASSOC);

if($result) {
    if($start < $end){ // new start must be smaller than new end
        if($start > $old_end && $start > $date) { // new start must be greater than old end and current date
            $sql1 = "UPDATE votingdate SET start_date=:start_date, end_date=:end_date 
            WHERE votingdate_id=:votingdate_id";
            $edit_date = $PDO->prepare($sql1);
            $edit_date->execute([
                ':start_date' => $start,
                ':end_date' => $end,
                ':votingdate_id' => $result['votingdate_id']
            ]);
    
            flash('date-change','Inschrijfmoment is gewijzigd.','alert-success');
            header('location: ../index.php?page=voting_date');
        } else {
            flash('newstart-fail','Nieuwe datum mag niet eerder zijn dan de oude datum en/of vandaag.','alert-danger');
            header('location: ../index.php?page=voting_date');
        }
    } else {
        flash('start-end-fail','Nieuwe datum mag niet eerder zijn dan oude datum.','alert-danger');
        header('location: ../index.php?page=voting_date');
    }
} else {
    $sql2 = 'INSERT INTO votingdate (start_date, end_date) 
    VALUES (:start_date, :end_date)';
    $query = $PDO->prepare($sql2);
    $query->execute([
        ':start_date' => $start,
        ':end_date' => $end
    ]);

    flash('date-success','Inschrijfmoment is ingesteld.','alert-success');
    header('location: ../index.php?page=voting_date');
}

?>