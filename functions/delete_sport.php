<?php
session_start();
include '../../private/cios_connection.php';
require __DIR__ . '/flash.php';

$sport_id = !empty($_POST['sport_id']) ? $_POST['sport_id'] : false;

$sql = 'DELETE FROM sports WHERE sport_id=:sport_id';
$delete = $PDO->prepare($sql);
$delete->execute([':sport_id' => $sport_id]);

flash('deleted-sport','Sport is verwijderd.','alert-success');
header('location: ../index.php?page=sports');
?>