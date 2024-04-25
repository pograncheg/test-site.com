<?php

class User
{   
    private $login;
    private $password;
    private $salt;
    private $email;
    private $name;


    public function __construct($userData)
    {
        $this->login = $userData['login'];
        $this->password = $userData['password'];
        $this->salt = $userData['salt'];
        $this->email = $userData['email'];
        $this->name = $userData['name'];
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return $this->salt;
    }
    
    public function getEmail()
    {
        return $this->email;
    }

    public function getName()
    {
        return $this->name;
    }
}