<?php
session_start();

function isLoggedIn(){
	if(isset($_SESSION['loggedIn']) && isset($_SESSION['loggedInUser'])){
		return true;
	}
	return false;
}

$loggedIn = isLoggedIn();

?>
