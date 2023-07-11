<?php 
if($_SESSION['role'] !== 'teacher'):
    header('location: index.php');
endif;

$sql = 'SELECT * FROM teachers';
$teachers = $PDO->prepare($sql);
$teachers->execute();

$sql1 = 'SELECT * FROM datetime';
$dates = $PDO->prepare($sql1);
$dates->execute();

include 'templates/partials/header.inc.php';
?>

<div class="page new-sport-page">
    <div class="container">
        <div class="content offset-2 col-8">

            <?php display_flash(); ?>

            <h2>Sport toevoegen</h2>
            <hr>
            <form class="form" id="sport-form" method="POST" action='functions/new_sport.php'>
                <div class="form-group">
                    <label>Sport</label>
                    <input class="text-input" type='text' name='name' maxlength="50" required/>
                </div>
                <div class="form-group">
                    <label>Docent</label>
                    <select form="sport-form" name="teacher_id">
                        <option value="">-</option>
                        <?php
                        while($names = $teachers->fetch(PDO::FETCH_ASSOC)): 
                            $middlename = !empty($names['middlename']) ? $names['middlename']." " : false;?>
                            <option value=<?= $names['teacher_id']?>><?= $names['firstname']." ".$middlename.$names['lastname']?></option>
                        <?php
                        endwhile;
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Dag en tijdstip</label>
                    <select form="sport-form" name="datetime_id" required>
                        <option value="">-</option>
                        <?php
                        while($results = $dates->fetch(PDO::FETCH_ASSOC)): ?>
                            <option value=<?= $results['datetime_id']?>><?= $results['weekday'].", ".$results['time']?></option>
                        <?php
                        endwhile;
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Max. deelnemers</label>
                    <input class="text-input" type='number' name='maximum'/>
                </div>
                <div class="form-group">
                    <label>Beschrijving</label>
                    <textarea form="sport-form" class="text-input desc" type='text' name='description' maxlength="400"></textarea>
                </div>
                <div class="btn-group">
                    <a class="return" href="index.php?page=sports">Terug</a>
                    <button class="btn btn-style" type='submit'>Opslaan</button>
                </div>
            </form>

        </div>
    </div>
</div>
