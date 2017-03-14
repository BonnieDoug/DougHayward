<?php
namespace Core;

use Core\Face\RouterInterface;

class Router implements RouterInterface {

    /** @var null The bundle */
    private $bundle = null;

    /** @var null The controller */
    private $controller = null;

    /** @var null The method (of the above controller), often also named "action" */
    private $action = null;

    /** @var array URL parameters */
    private $params = array();

    function getBundle() {
        return $this->bundle;
    }

    function getController() {
        return $this->controller;
    }

    function getAction() {
        return $this->action;
    }

    function getParams() {
        return $this->params;
    }

    function setBundle($bundle) {
        $this->bundle = $bundle;
    }

    function setController($controller) {
        $this->controller = $controller;
    }

    function setAction($action) {
        $this->action = $action;
    }

    function setParams($params) {
        $this->params = $params;
    }

    /**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method or the fallback
     */
    public function __construct() {

        // Check for Options request, if true send back 200. Options headers fuck everything up by attempting to process a blank packet.
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            return http_response_code(200);
        }
        // create array with URL parts in $url
        $this->splitUrl();

        $error = "";

        if (file_exists(APP ."Bundles/". $this->bundle . '/Controller/' . $this->controller . 'Controller.php')) {

            // here we did check for controller: does such a controller exist ?
            // if so, then load this file and create this controller
            // example: if controller would be "car", then this line would translate into: $this->car = new car();
            require APP ."Bundles/". $this->bundle . '/Controller/' . $this->controller . 'Controller.php';
            // Hacking together to allow namespace loading of class.
            $base = "\\SolutionHost\\" . $this->bundle . "\\Controller\\" . $this->controller . "Controller";
            $this->controller = new $base;
            // check for method: does such a method exist in the controller ?
            if (method_exists($this->controller, $this->action)) {
                if (!empty($this->params)) {
                    // Call the method and pass arguments to it
                    // eg localhost/Controller/Action/param1/param2 etc
                    call_user_func_array(array($this->controller, $this->action), $this->params);
                } else {
                    // If no parameters are given, just call the method without parameters, like $this->home->method();
                    $this->controller->{$this->action}();
                }
            } else {
                if (strlen($this->action) == 0) {
                    // no action defined: call the default index() method of a selected controller
                    $this->controller->indexAction();
                } else {
                    //Something failed so direct to error controller
                    $error->errorType404Action("Error - No action found, and indexAction not defined.");
                }
            }
        } else if ($this->bundle != null && file_exists(APP ."Bundles/". $this->bundle . '/Controller/IndexController.php')) { //ELSE IF 'Bundles' has an index page.
            require APP ."Bundles/". $this->bundle . '/Controller/IndexController.php';
            $base = "\\" . $this->bundle . "\\Controller\IndexController";
            $this->controller = new $base;
            if (strlen($this->action) == 0) {
                $this->controller->indexAction();
            } else {
                $error->errorType404Action("Error - No action found, and indexAction not defined.");
            }
        }
        else if ($this->bundle != null && file_exists(APP ."Bundles/". $this->bundle . '/IndexController.php')) { //ELSE IF 'Bundles' has an index page.
            require APP ."Bundles/". $this->bundle . '/Controller/IndexController.php';
            $base = "\\" . $this->bundle . "\\Controller\IndexController";
            $this->controller = new $base;
            if (strlen($this->action) == 0) {
                $this->controller->indexAction();
            } else {
                $error->errorType404Action("Error - No action found, and indexAction not defined.");
            }
        }
    }

    /**
     * Get and split the URL
     */
    private function splitUrl() {

        if (isset($_GET['url'])) {
            // split URL
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            //print_r($url);

            $bundle = isset($url[0]) ? ucfirst(strtolower($url[0])) : null;
            $controller = isset($url[1]) ? ucfirst(strtolower($url[1])) : null;
            $action = isset($url[2]) ? ucfirst(strtolower($url[2])) . "Action" : null;

            // Put URL parts into according properties
            $this->bundle = isset($bundle) ? $bundle : null;
            $this->controller = isset($controller) ? $controller : null;
            $this->action = isset($action) ? $action : null;

            // Remove controller and action from the split URL
            unset($url[0], $url[1], $url[2], $bundle, $action, $controller);
            // Rebase array keys and store the URL params
            $this->params = array_values($url);
            return;
        }
    }

}
