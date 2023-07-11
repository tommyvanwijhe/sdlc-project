<?php 
include 'templates/partials/header.inc.php'; 
?>

<div class="page login-page">
    <div class="container">
        <div class="content offset-4 col-4">

            <?php display_flash(); ?>

            <h2>Inloggen</h2>
            <hr>
            <form class="form" method="POST" action='functions/login.php'>
                <div class="form-group full">
                    <label>E-mailadres</label>
                    <input class="text-input" type='email' name='email' maxlength="100" required/>
                </div>
                <div class="form-group full">
                    <label>Wachtwoord</label>
                    <input class="text-input" type='password' name='password' maxlength="20" required/>
                </div>
                <div class="btn-group solo">
                    <button class="btn btn-style" type='submit'>Inloggen</button>
                </div>
            </form>

        </div>
    </div>
</div>
