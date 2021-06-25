<?php

session_start();
function h($string){
    return htmlspecialchars($string);
}
?>
<!doctype html >
<html lang="en" class="white-theme" style="max-width: 500px">
<head>
  <?php require_once('includes/header.inc.php'); ?> 
</head>

<body>
 <?php require_once('includes/loading.php'); ?>


 <?php require_once('includes/sidebar.inc.php'); ?>
 <div class="wrapper">

 <?php include_once('includes/navtop.php'); ?>

 <?php include_once('includes/feed.inc.php'); ?>

<?php


	if (isset($_GET['page'])) {
		$page = $_GET['page'];

		if (file_exists("pages/". $page . ".php")) {
			include "pages/". $page . ".php";
		}

		if (!file_exists("pages/". $page . ".php")) {
			$error = 1;
			echo "BAH";

		}
	} else {
			include "pages/home.php";
	}

?>
 </div>

 <?php require_once('includes/nav.inc.php'); ?>

<?php // require_once('includes/notification.php'); ?>
 <?php require_once('includes/modais.php'); ?>
</body>
<?php require_once('includes/footer.inc.php'); ?> 
</html>
