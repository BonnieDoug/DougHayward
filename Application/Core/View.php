<?php

namespace Core;

use Core\Face\ViewInterface;

class View implements ViewInterface
{
    public function render()
    {
        $view = $this->environment();
        return $view->render();
    }

    public function environment(){
        // Setup environment,trying to keep it generic as possible,
        // so if I decide to switch Twig for a different templating engine it'll be easy todo.
    }
}