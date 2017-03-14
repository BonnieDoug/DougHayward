<?php
/**
 * Created by PhpStorm.
 * User: doug
 * Date: 14/03/17
 * Time: 00:32
 */

namespace User\Model;


use Core\Model;

/**
 * @ORM\Entity(repositoryClass="User\Model\Repository\UserRepository")
 */
class User extends Model implements \Core\Face\User

{

    private $id;
    private $username;
    private $password;
    private $email;
    private $retired;
    private $lastLogged;
    private $createdAt;
    private $auth;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getRetired()
    {
        return $this->retired;
    }

    /**
     * @param mixed $retired
     */
    public function setRetired($retired)
    {
        $this->retired = $retired;
    }

    /**
     * @return mixed
     */
    public function getLastLogged()
    {
        return $this->lastLogged;
    }

    /**
     * @param mixed $lastLogged
     */
    public function setLastLogged($lastLogged)
    {
        $this->lastLogged = $lastLogged;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getAuth()
    {
        return $this->auth;
    }

    /**
     * @param mixed $auth
     */
    public function setAuth($auth)
    {
        $this->auth = $auth;
    }

}