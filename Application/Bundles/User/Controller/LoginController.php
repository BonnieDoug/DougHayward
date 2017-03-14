<?php
/**
 * Created by PhpStorm.
 * User: doug
 * Date: 14/03/17
 * Time: 00:32
 */

namespace User\Controller;


use User\Form\LoginType;
use User\Model\User;

class LoginController
{

    public function indexAction(){

        $form = new LoginType(new User());
        //if get{
        //display login form if not already logged in, if $this->getUser()->isLogged === true then $this->redirect(index)
        $this->render("User/Login.html.twig",[
            "form" => $form
        ]);
        //}
        //Process post and login or display error.

    }
}