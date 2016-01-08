<?php
    session_start();

	unset($_SESSION["UserID"]);
	unset($_SESSION["basket"]);

	header("Location: loginSignUp.php");

	exit;
?>