<?php 
if($_SESSION['role'] !== 'teacher'):
    header('location: index.php');
endif;

include 'templates/partials/header.inc.php';
?>

<div class="page register-page">
    <div class="container">
        <div class="content offset-2 col-8">

            <?php display_flash(); ?>

            <h2>Gebruiker registreren</h2>
            <hr>
            <form class="form" id="register-form" method="POST" action='functions/register_user.php'>
                <div class="form-group">
                    <label>Voornaam</label>
                    <input class="text-input" type='text' name='firstname' maxlength="50" required/>
                </div>
                <div class="form-group">
                    <label>Tussenvoegsel</label>
                    <input class="text-input" type='text' name='middlename' maxlength="20"/>
                </div>
                <div class="form-group">
                    <label>Achternaam</label>
                    <input class="text-input" type='text' name='lastname' maxlength="50" required/>
                </div>
                <div class="form-group">
                    <label>E-mailadres</label>
                    <input class="text-input" type='email' name='email' maxlength="100" required/>
                </div>
                <div class="form-group">
                    <label>Gebruiker type</label>
                    <select form="register-form" name="role_id">
                        <option value="">-</option>
                        <option value="2">Student</option>
                        <option value="1">Docent</option>
                    </select>
                </div>
                <div class="btn-group solo">
                    <button class="btn btn-style" type='submit'>Opslaan</button>
                </div>
            </form>

        </div>
    </div>
</div>
