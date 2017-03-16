<?php
////Load composers Autoloader. If you get an error here don't forget to run "composer update" and
// if still getting errors try "composer dump-autoload"
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Core\Router;

try {
    //$request = Request::createFromGlobals();
    //$response = new Response();
    // Start Routing to the bundle and controller.
    new Router(Request::createFromGlobals());

    //$response = call_user_func('render_template', $request);

} catch (Core\Exception\ResourceNotFoundException $e) {
    $response = new Response($e->getMessage(), $e->getCode());
} catch (Exception $e) {
    $response = new Response($e);
}
$response->send();