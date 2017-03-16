<?php
namespace Core;

use Core\Face\RouterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Router implements RouterInterface
{

    /** @var null The bundle */
    private $bundle = null;

    /** @var null The controller */
    private $controller = null;

    /** @var null The method (of the above controller), often also named "action" */
    private $action = null;

    /** @var array URL parameters */
    private $params = array();

    function getBundle()
    {
        return $this->bundle;
    }

    function getController()
    {
        return $this->controller;
    }

    function getAction()
    {
        return $this->action;
    }

    function getParams()
    {
        return $this->params;
    }

    function setBundle($bundle)
    {
        $this->bundle = $bundle; // The bundle
    }

    function setController($controller)
    {
        $this->controller = $controller; // The controller we want.
    }

    function setAction($action)
    {
        $this->action = $action; // The action within the controller we want.
    }

    function setParams($params)
    {
        $this->params = $params; // These become variables passed straight into the controller.
    }

    /**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method or the fallback
     */
    public function __construct(Request $request)
    {

        // Check for Options request, if true send back 200.
        // Options headers fuck everything up by attempting to process a blank packet (if using Angular).
        if ($request->getMethod() == 'OPTIONS') {
            return http_response_code(200);
        }
        // create array with URL parts in $url
        $this->splitUrl($request);
        $this->getClass();

    }

    public function getClass()
    {
        $namespace = "{$this->getBundle()}\\Controller\\{$this->getController()}";
        if (class_exists($namespace)) {
            $class = new $namespace;
            // check for method: does such a method exist in the controller ?
            if (method_exists($class, $this->getAction())) {
                call_user_func_array(array($class, $this->getAction()), $this->getParams());
            } else {
                throw new NotFoundHttpException("Page not found", 404);
            }
        } else {
            (new \IndexController())->indexAction();
        }
    }

    /**
     * Get and split the URL
     */
    public function splitUrl(Request $request)
    {

        if ($request->query->get('url')) {
            // split URL
            $url = explode('/', filter_var(trim($request->query->get('url'), '/'), FILTER_SANITIZE_URL));
            // Put URL parts into according properties
            $this->setBundle(isset($url[0]) ? ucfirst(strtolower($url[0])) : null);
            $this->setController(isset($url[1]) ? ucfirst(strtolower($url[1])) . "Controller" : null);
            $this->setAction(isset($url[2]) ? ucfirst(strtolower($url[2])) . "Action" : null);
            // Remove controller and action from the split URL
            unset($url[0], $url[1], $url[2]);
            // Rebase array keys and store the URL params
            $this->setParams(array_values($url));
            return;
        }
    }

}
