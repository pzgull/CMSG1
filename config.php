<?php
require_once __DIR__ . '/vendor/autoload.php';
// DB Constants
define('DB_HOST', 'localhost');
define('DB_NAME', 'kandt');
define('DB_USER', 'hetic');
define('DB_PASSWD', 'hetic');
define('DB_CHARSET', 'utf8');
// App Constants
define('APP_DEFAULT_ROUTE', 'teletubbies');
define('APP_DEFAULT_ACTION', 'lister');
define('APP_ROOT_DIR', __DIR__ . '/');
define('APP_VIEW_DIR', APP_ROOT_DIR . 'view/');
// Public Constants
define('PUBLIC_DIR', '/public/');
define('PUBLIC_BOOTSTRAP', '/vendor/twbs/bootstrap/dist/');

try {
    $pdo = new PDO('mysql:host='. DB_HOST . ';dbname='. DB_NAME .';charset='. DB_CHARSET,
        DB_USER, DB_PASSWD);
} catch (PDOException $e) {
    die( $e->getMessage() );
}

$display = new Controller\PageController($pdo);