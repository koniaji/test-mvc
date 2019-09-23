<?php


namespace App\core;


class User
{
    public function login($username, $password)
    {
        $db = Application::$container->get('db');
        $result = $db->query("SELECT * FROM `users` WHERE username = \"$username\" and password = \"$password\"")
            ->fetch_assoc();
        if (!empty($result)) {
            $this->startUserSession($result['id']);

            return true;
        }

        return false;
    }

    public function logOut()
    {
        $this->endUserSession();
    }

    public function getId()
    {
        session_start();

        return $_SESSION['id'] ?: null;
    }

    private function startUserSession($userId)
    {
        session_start();

        $_SESSION['id'] = $userId;
    }

    private function endUserSession()
    {
        session_unset();
        session_destroy();
    }
}
