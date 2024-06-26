<?php
define('APP_ROOT', dirname(__FILE__, 1));
require APP_ROOT . '/src/functions.php';                 // Functions (NOTE: The path printed in book was wrong, use this path)
require APP_ROOT . '/config.php';                 // Functions (NOTE: The path printed in book was wrong, use this path)

spl_autoload_register(function($class) {
    $path = APP_ROOT . '/src/classes/';
    require $path . $class . '.php';
});

if (DEV === false) {
    set_exception_handler('handle_exception');
    set_error_handler('handle_error');
    register_shutdown_function('handle_shutdown');
}

$cms = new CMS($dsn, $username, $password);
unset($dsn, $username, $password);