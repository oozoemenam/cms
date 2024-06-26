<?php
define('DEV', true);
// define('ROOT_FOLDER', 'public');
$this_folder   = substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT']));
$parent_folder = dirname($this_folder);  
define("DOC_ROOT", $parent_folder . '/public/');

$type = 'mysql';
$server = 'localhost';
$db = 'cms';
$port = '';
$charset = 'utf8mb4';

$username = 'admin';
$password = 'password';

$dsn = "$type:host=$server;dbname=$db;port=$port;charset=$charset";

define('MEDIA_TYPES', ['image/jpeg', 'image/png', 'image/gif',]);
define('FILE_EXTENSIONS', ['jpg', 'jpeg', 'png', 'gif',]);
define('MAX_SIZE', '5242880');
define('UPLOADS', dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR);

// TODO: Add unique constraint to category name, user email, article title