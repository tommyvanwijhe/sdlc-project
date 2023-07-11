<?php
if($_SESSION['role'] !== 'teacher'):
    header('location: index.php');
endif;

$sql1 = 'SELECT votingdate_id, start_date, end_date FROM votingdate';
$fetch = $PDO->prepare($sql1);
$fetch->execute([]);
$result = $fetch->fetch(PDO::FETCH_ASSOC);

include 'templates/partials/header.inc.php';
?>

<div class="page voting-date-page">
    <div class="container">
        <div class="content offset-2 col-8">

            <?php display_flash(); ?>

            <h2>Inschrijfdatum instellen</h2>
            <hr>
            <?php 
            if($result){ 
                $start = new DateTimeImmutable($result['start_date']);
                $start_date = $start->format('Y-m-d');

                $end = new DateTimeImmutable($result['end_date']);
                $end_date = $end->format('Y-m-d');
                ?>
                <p>Huidige inschrijfmoment loopt van <?= $start_date." tot ".$end_date ?></p>
            
                <form class="form" id="datetime-form" method="POST" action='functions/voting_date.php'>
                    <input class="date-input" type='hidden' name='old_start_date' value="<?= $start_date?>" required/>
                    <input class="date-input" type='hidden' name='old_end_date' value="<?= $end_date?>" required/>
                    <div class="form-group">
                        <label>Startdatum</label>
                        <input class="date-input" type='datetime-local' name='start_date' required/>
                    </div>
                    <div class="form-group">
                        <label>Einddatum</label>
                        <input class="date-input" type='datetime-local' name='end_date' required/>
                    </div>
                    <div class="btn-group solo">
                        <button class="btn btn-style" onclick="return confirm('Wil je de oude data overschrijven?');" type='submit'>Opslaan</button>
                    </div>
                </form>
            
            <?php 
            } else { 
            ?>

                <form class="form" id="datetime-form" method="POST" action='functions/voting_date.php'>
                    <div class="form-group">
                        <label>Startdatum</label>
                        <input class="date-input" type='datetime-local' name='start_date' required/>
                    </div>
                    <div class="form-group">
                        <label>Einddatum</label>
                        <input class="date-input" type='datetime-local' name='end_date' required/>
                    </div>
                    <div class="btn-group solo">
                        <button class="btn btn-style" type='submit'>Opslaan</button>
                    </div>
                </form>

            <?php
            }; 
            ?>

        </div>
    </div>
</div>
