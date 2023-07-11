<?php
if($_SESSION['role'] == ''):
    header('location: index.php');
endif;

$login_id = !empty($_SESSION['login_id']) ? $_SESSION['login_id']: false;
$role = !empty($_SESSION['role']) ? $_SESSION['role']: false;

if($role):
    switch($role):
        case('teacher'):
            $sql1 = 'SELECT firstname, middlename, lastname, email FROM login 
            INNER JOIN teachers ON login.login_id=teachers.login_id 
            WHERE login.login_id = :login_id';

            break;
        case('student'):
            $sql1 = 'SELECT firstname, middlename, lastname, email FROM login 
            INNER JOIN students ON login.login_id=students.login_id 
            WHERE login.login_id = :login_id';

            break;
    endswitch;
endif;

$fetch = $PDO->prepare($sql1);
$fetch->execute([':login_id' => $login_id]);
$result = $fetch->fetch(PDO::FETCH_ASSOC);

$lastname = !empty($result['middlename']) ? $result['lastname'].", ".$result['middlename'] : $result['lastname'];

include 'templates/partials/header.inc.php';
?>

<div class="page profile-page">
    <div class="container">
        <div class="content offset-2 col-8">

            <?php display_flash(); ?>

            <h2>Accountgegevens</h2>
            <hr>
            <div>
                <label>Voornaam</label>
                <p><?= $result['firstname'] ?></p>
            </div>
            <div>
                <label>Achternaam</label>
                <p><?= $lastname ?></p>
            </div>
            <div>
                <label>E-mailadres</label>
                <p><?= $result['email'] ?></p>
            </div>
            <div>
                <div class="btn-group">
                    <a class="btn btn-style pass-change" href="index.php?page=change_pass">Wachtwoord wijzigen</a>
                </div>
            </div>

        </div>
    </div>
</div>
