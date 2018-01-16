<?php
session_start();

function isLoggedIn(){
    return isset($_SESSION['loggedIn']) && isset($_SESSION['loggedInUser']);
}

$loggedIn = isLoggedIn();

