<?php
require_once('check_authentication.php');
require_once('database.php');
try {
    $id = $_GET['id'];
    $query = 'DELETE FROM books WHERE id = :id';
    $statement = $connection->prepare($query);
    $statement->bindParam('id', $id, PDO::PARAM_INT);
    header('location: books.php');
} catch (Exception $exception) {
    header('location: books.php');
}
