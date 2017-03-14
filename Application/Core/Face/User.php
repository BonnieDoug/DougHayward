<?php

namespace Core\Face;


interface User
{

    function getUsername();
    function setUsername($username);
    function getPassword();
    function setPassword($password);
    function getEmail();
    function setEmail($email);

}