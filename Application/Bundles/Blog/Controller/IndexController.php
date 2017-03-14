<?php

namespace Blog\Controller;

use Core\Controller;

class IndexController extends Controller
{
    public function __construct()
    {
        return $this->redirect("Blog/Post");
    }
}