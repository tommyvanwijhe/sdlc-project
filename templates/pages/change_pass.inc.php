<?php 
if($_SESSION['role'] == ''):
    header('location: index.php');
endif;

include 'templates/partials/header.inc.php'; 
?>

<div class="page pass-page">
    <div class="container">
        <div class="content offset-3 col-6">

            <?php display_flash(); ?>

            <h2>Wachtwoord wijzigen</h2>
            <hr>
            <form class="form" method="POST" action='functions/change_pass.php'>
                <div class="form-group">
                    <label>Oud wachtwoord</label>
                    <input class="text-input" type='password' name='old_pass' maxlength="20" required/>
                </div>
                <div class="form-group">
                    <label>Nieuw wachtwoord</label>
                    <input class="text-input" type='password' name='new_pass' maxlength="20" required/>
                </div>
                <div class="form-group">
                    <label>Wachtwoord herhalen</label>
                    <input class="text-input" type='password' name='val_pass' maxlength="20" required/>
                </div>
                <div class="btn-group">
                    <a class="return" href="index.php?page=profile">Terug</a>
                    <button class="btn btn-style" type='submit'>Opslaan</button>
                </div>
            </form>

        </div>
    </div>
</div>
