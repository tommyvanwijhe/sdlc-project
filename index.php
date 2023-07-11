<?php
session_start();
include '../private/cios_connection.php';
require __DIR__ . '/functions/flash.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'login';

include 'functions/timeout.php'; 
include 'templates/pages/'.$page.'.inc.php'; 
?>

    </body>
</html>

<script>
<?php
include 'assets/js/menu_toggle.js';
?>
</script>