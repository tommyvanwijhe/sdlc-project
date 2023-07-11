<?php
if($_SESSION['role'] == ''):
    header('location: index.php');
endif;

$sql = 'SELECT sport_id, name, firstname, middlename, lastname, weekday, time, description, maximum FROM sports 
INNER JOIN teachers as t ON sports.teacher_id=t.teacher_id 
INNER JOIN datetime as d ON sports.datetime_id=d.datetime_id';
$sports = $PDO->prepare($sql);
$sports->execute();

include 'templates/partials/header.inc.php';
?>

<div class="page sports-page">
    <div class="container">
        <div class="content">

            <?php display_flash(); ?>

            <div class="title-btn">
                <h2>Sporten</h2>
                <?php 
                if($_SESSION['role'] == 'teacher'): ?>
                    <div class="btn-group">
                        <a class="btn btn-style" href="index.php?page=new_sport">Nieuwe sport</a>
                    </div>
                <?php 
                endif; ?>
            </div>
            <hr>

            <ul class="card-list" id="sports-list">
                <?php 
                while($data = $sports->fetch(PDO::FETCH_ASSOC)): 
                    $sport_id = $data['sport_id'];
                    $lastname = !empty($data['middlename']) ? $data['middlename']." ".$data['lastname'] : $data['lastname']; 
                    $sql1 = 'SELECT * FROM sport_students WHERE sport_id = :sport_id';
                    $members = $PDO->prepare($sql1);
                    $members->execute([':sport_id' => $sport_id]);
                    $count = $members->rowCount();
                    ?>
                    <li class="sports-card">
                        <div class="row">
                            <div class="col-2">
                                <h4 class="sport-title"><?= $data['name'] ?></h4>
                            </div>

                            <div class="offset-3 col-2">
                                <p><?= $data['weekday'].", ".$data['time'] ?></p>
                            </div>

                            <div class="offset-3 col-2">
                                    <p>deelnemers: <?= $count ?> <?= $data['maximum'] ? "/ ".$data['maximum'] : false; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 group">
                                <p>door <?= $data['firstname']." ".$lastname ?></p>

                                <form class="form" method="POST" action='index.php?page=sport_detail&sport_id=<?= $data['sport_id'] ?>'>
                                    <div class="btn-group">
                                        <button class="btn btn-style" type='submit'>Details</button>
                                    </div>
                                </form>
                                    
                            </div>
                            
                        </div>

                        
                        
                    </li>
                <?php 
                endwhile; ?>
            </ul>

        </div>
    </div>
</div>
