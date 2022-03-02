<?php
$dataSourceName = 'mysql:host=localhost;dbname=bookstore_db';

$username = 'root';

$password = '';

$options = [];
try {
    $connection = new PDO($dataSourceName, $username, $password, $options);
} catch (PDOException $exception) {
    $message = $exception->getMessage();
}
