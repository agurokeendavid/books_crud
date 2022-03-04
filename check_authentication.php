<?php
session_start();

if ($pageTitle === 'Login' || $pageTitle === 'Register') {
    if (isset($_SESSION['isLoggedIn'])) {
        header('location: books.php');
        return;
    }
    return;
}

if (!isset($_SESSION['isLoggedIn'])) {
    header('location: index.php');
}

?>