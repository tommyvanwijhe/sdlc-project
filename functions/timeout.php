<?php
// check if last request was more than 30 minutes ago
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 10)) {
        session_unset();
	    session_destroy();

        session_start();
        flash('timeout','Je bent uitgelogd vanwege inactiviteit.','alert-danger');
        header('location: index.php?page=login');
	}
    // update last activity time stamp
	$_SESSION['LAST_ACTIVITY'] = time(); 
?>