<?php

namespace Core;

use Core\Face\ControllerInterface;

use Core\View;

class Controller implements ControllerInterface
{

    public function render()
    {
        return print (new View())->render();
    }

}
