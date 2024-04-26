<?php

require_once 'User.php';

class UserManager
{
    private string $file;

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    public function getAllUsers()
    {
        $users = [];
        if (file_exists($this->file)) {
            $usersData = json_decode(file_get_contents($this->file), true);
            foreach ($usersData as $user) {
                $users[] = new User($user);
            }
        }
        return $users;
    }

    public function getByLogin(string $login)
    {
        $users = $this->getAllUsers();
        foreach ($users as $user) {
            if ($user->getLogin() == $login) {
                return [
                    'login' => $user->getLogin(),
                    'password' => $user->getPassword(),
                    'salt' => $user->getSalt(),
                    'email' => $user->getEmail(),
                    'name' => $user->getName(),
                ];
            }
        }
        return false;
    }

    public function create(User $user)
    {
        $users = $this->getAllUsers();
        $users[] = $user;
        $this->save($users);
    }

    public function update(User $user)
    {
        $users = $this->getAllUsers();
        foreach ($users as &$u) {
            if ($u->getLogin() == $user->getLogin()) {
                $u = $user;
                break;
            }
        }
        $this->save($users);
    }

    public function delete(string $login)
    {
        $users = $this->getAllUsers();
        $users = array_filter($users, function ($user) use ($login) {
            return $user->getLogin() !== $login;
        });
        $this->save($users);
    }

    private function save(array $users) 
    {
        $data = array_map(function ($user) {
            return [
                'login' => $user->getLogin(),
                'password' => $user->getPassword(),
                'salt' => $user->getSalt(),
                'email' => $user->getEmail(),
                'name' => $user->getName(),
            ];
        }, $users);
        file_put_contents($this->file, json_encode($data));
    }
}