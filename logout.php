<?php require('./autoload.php'); ?>
<?php 
	
    if (isset($_SESSION['user'])) {
    
        unset($_SESSION['user']);
        session_destroy();
    }
    header('location: index.php');exit;
?>