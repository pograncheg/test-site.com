<?php

class User
{   
    private string $login;
    private string $password;
    private string $salt;
    private string $email;
    private string $name;


    public function __construct(array $userData)
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