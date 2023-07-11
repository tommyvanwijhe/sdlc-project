<?php
session_start();
require __DIR__ . '/flash.php';

session_unset();
session_destroy();

session_start();
header('location: ../index.php?page=login');
?>