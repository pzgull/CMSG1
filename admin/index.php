<?php
require_once '../vendor/autoload.php';
require_once '../config.php';

try {
    $pdo = new PDO('mysql:host='. DB_HOST . ';dbname='. DB_NAME .';charset='. DB_CHARSET,
        DB_USER, DB_PASSWD);
} catch (PDOException $e) {
    die( $e->getMessage() );
}

$display = new Controller\PageController($pdo);

$display->adminAction();