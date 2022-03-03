<?php
require_once('database.php');
try {
    $id = $_GET['id'];
    $query = 'DELETE FROM books WHERE id = :id';
    $statement = $connection->prepare($query);
    $statement->bindParam('id', $id, PDO::PARAM_INT);
    if ($statement->execute()) {
        header('location: books.php');
    }
} catch (Exception $exception) {
    header('location: books.php');
} finally {
    $connection = null;
}
