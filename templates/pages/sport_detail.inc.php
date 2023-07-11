<?php
if($_SESSION['role'] == ''):
    header('location: index.php');
endif;

$sport_id = !empty($_GET['sport_id']) ? $_GET['sport_id'] : false;

$sql = 'SELECT name, firstname, middlename, lastname, weekday, time, description, maximum FROM sports 
INNER JOIN teachers as t ON sports.teacher_id=t.teacher_id 
INNER JOIN datetime as d ON sports.datetime_id=d.datetime_id
WHERE sports.sport_id=:sport_id';
$sports = $PDO->prepare($sql);
$sports->execute([':sport_id' => $sport_id]);
$result = $sports->fetch(PDO::FETCH_ASSOC);

$lastname = !empty($result['middlename']) ? $result['middlename']." ".$result['lastname'] : $result['lastname']; 

include 'templates/partials/header.inc.php';
?>

<div class="page sports-detail-page">
    <div class="container">
        <div class="content offset-2 col-8">

            <?php display_flash(); ?>

            <div class="title-btn">
                <h2>Sport details</h2>
                <?php 
                if($_SESSION['role'] == 'teacher'): ?>
                    <div class="btn-group">
                        <a class="btn btn-style" href="index.php?page=edit_sport&sport_id=<?= $sport_id ?>">Sport wijzigen</a>
                    </div>
                <?php 
                endif; ?>
            </div>
            <hr>

            <div>
                <label>Sport</label>
                <p><?= $result['name'] ?></p>
            </div>
            <div>
                <label>Docent</label>
                <p><?= $result['firstname']." ".$lastname ?></p>
            </div>
            <div>
                <label>Iedere week op</label>
                <p><?= $result['weekday'].", om ".$result['time'] ?></p>
            </div>
            <?php 
            if($result['maximum']): ?>
                <div>
                    <label>Max. deelnemers</label>
                    <p><?= $result['maximum'] ?> leerlingen</p>
                </div>
            <?php 
            endif;?>
            <div>
                <label>Beschrijving</label>
                <p><?= $result['description'] ?></p>
            </div>
            <div>
                <?php 
                if($_SESSION['role'] == 'teacher'): ?>
                    <form class="form" method="POST" action='functions/delete_sport.php'>
                        <div class="btn-group">
                            <input class="text-input" type='hidden' name='sport_id' value="<?= $sport_id ?>"/>
                        </div>
                        <div class="btn-group">
                            <a class="return" href="index.php?page=sports">Terug</a>
                            <button class="btn btn-style" onclick="return confirm('Weet je zeker dat je <?= $result['name'] ?> wilt verwijderen?'); " type='submit'>Verwijderen</button>
                        </div>
                    </form>
                <?php 
                elseif($_SESSION['role'] == 'student'): 
                    $sql = 'SELECT student_id FROM students WHERE login_id=:login_id';
                    $query = $PDO->prepare($sql);
                    $query->execute([':login_id' => $_SESSION['login_id']]);
                    $student = $query->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <form class="form" method="POST" action='functions/signup_sport.php'>
                        <div class="btn-group">
                            <input class="text-input" type='hidden' name='sport_id' value="<?= $sport_id ?>"/>
                            <input class="text-input" type="hidden" name="student_id" value="<?= $student['student_id'] ?>">
                        </div>
                        <div class="btn-group">
                            <a class="return" href="index.php?page=sports">Terug</a>
                            <button class="btn btn-style" onclick="return confirm('Inschrijven bij <?= $result['name'] ?>?'); " type='submit'>Inschrijven</button>
                        </div>
                    </form>
                <?php
                endif; ?>
            </div>

        </div>
    </div>
</div>
