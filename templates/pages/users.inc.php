<?php
if($_SESSION['role'] !== 'teacher'):
    header('location: index.php');
endif;

$sql = 'SELECT l.login_id, email, firstname, middlename, lastname FROM login as l
INNER JOIN teachers as t ON l.login_id=t.login_id 
WHERE role_id=:role_id';
$teachers = $PDO->prepare($sql);
$teachers->execute([':role_id' => 1]);

$sql1 = 'SELECT l.login_id, email, firstname, middlename, lastname FROM login as l
INNER JOIN students as s ON l.login_id=s.login_id
WHERE role_id=:role_id';
$students = $PDO->prepare($sql1);
$students->execute([':role_id' => 2]);

include 'templates/partials/header.inc.php';
?>

<div class="page users-page">
    <div class="container">
        <div class="content">

            <?php display_flash(); ?>

            <div class="title-btn">
                <h2>Gebruikers</h2>
                <div class="btn-group">
                    <a class="btn btn-style" href="index.php?page=register_user">Nieuwe gebruiker</a>
                </div>
            </div>
            
            <hr>
            <h4>Docenten</h4>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Voornaam</th>
                        <th>tussenvoegsel</th>
                        <th>Achternaam</th>
                        <th>E-mailadres</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    while($teacher = $teachers->fetch(PDO::FETCH_ASSOC)):?>
                        <tr>
                            <td><?= $teacher['login_id'] ?></td>
                            <td><?= $teacher['firstname'] ?></td>
                            <td><?= $teacher['middlename'] ?></td>
                            <td><?= $teacher['lastname'] ?></td>
                            <td><?= $teacher['email'] ?></td>
                        </tr>
                    <?php 
                    endwhile; ?>
                </tbody>
            </table>
            
            <h4>Studenten</h4>
            <table class="styled-table purple">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Voornaam</th>
                        <th>tussenvoegsel</th>
                        <th>Achternaam</th>
                        <th>E-mailadres</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    while($student = $students->fetch(PDO::FETCH_ASSOC)):?>
                        <tr>
                            <td><?= $student['login_id'] ?></td>
                            <td><?= $student['firstname'] ?></td>
                            <td><?= $student['middlename'] ?></td>
                            <td><?= $student['lastname'] ?></td>
                            <td><?= $student['email'] ?></td>
                        </tr>
                    <?php 
                    endwhile; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
