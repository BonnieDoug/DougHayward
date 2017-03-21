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
        $this->bundle = ucfirst(strtolower($bundle)); // The bundle
    }

    function setController($controller)
    {
        $this->controller = ucfirst(strtolower($controller)) . "Controller"; // The controller we want.
    }

    function setAction($action)
    {
        $this->action = ucfirst(strtolower($action)) . "Action"; // The action within the controller we want.
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
        $this->getClass($this->splitUrl($request));
    }

    public function getClass()
    {
        $namespace = "{$this->getBundle()}\\Controller\\{$this->getController()}";
        if (class_exists($namespace)) { // Namespace exists, and method found.
            $class = new $namespace;
            // check for method: does such a method exist in the controller ?
            if (method_exists($class, $this->getAction())) {
                return call_user_func_array(array($class, $this->getAction()), $this->getParams());
            } elseif (method_exists($class, "indexAction")) {
                return call_user_func(array($class, "indexAction"));
            } else {
                throw new NotFoundHttpException("Page not found");
            }
        } else { // Else show index page
            // Old PHP
            // $controller = new \IndexController();
            // return $controller->indexAction();
            // New PHP
            return (new \IndexController())->indexAction();
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
            $this->setBundle(@$url[0]);
            $this->setController(@$url[1]);
            $this->setAction(@$url[2]);
            // Remove controller and action from the split URL
            unset($url[0], $url[1], $url[2]);
            // Rebase array keys and store the URL params
            $this->setParams(array_values($url));
            return;
        }
    }

}
