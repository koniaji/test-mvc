<?php


namespace App\controllers;


use App\core\Application;
use App\core\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function actionLogin()
    {
        $user = Application::$container->get('user');
        /* @var $request Request */
        $request = Application::$container->get('request');

        if ($request->method() === 'POST') {
            if ($user->login($request->post('email'), $request->post('password'))) {
                header("Location: http://" . $_SERVER['HTTP_HOST']);
            }

            return $this->view->render(APP_DIR . '/views/auth/login.php', ['errors' => true]);
        }

        return $this->view->render(APP_DIR . '/views/auth/login.php', []);
    }

    public function actionLogout()
    {
        $user = Application::$container->get('user');
        if ($user->getId())
            $user->logout();

        header("Location: http://" . $_SERVER['HTTP_HOST']);
    }
}
