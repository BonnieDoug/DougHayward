<?php
//Debug
if(isset($_GET['dev'])){
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
}
////Load composers Autoloader. If you get an error here don't forget to run "composer update" and
// if still getting errors try "composer dump-autoload"
require '../vendor/autoload.php';
// Start Routing to the bundle and controller.
new Core\Router();
