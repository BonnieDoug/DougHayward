<?php

namespace Core\Face;
use Symfony\Component\HttpFoundation\Request;
// Interface is a reserved word, so shortened to Face as I like to keep it tidy.
// Might think of something better soon.


interface RouterInterface
{

    function getBundle();

    function getController();

    function getAction();

    function getParams();

    function setBundle($bundle);

    function setController($controller);

    function setAction($action);

    function setParams($params);

    function splitUrl(Request $request);

}
