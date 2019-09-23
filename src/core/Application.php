<?php

namespace App\core;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class Application
{
    public static $app;

    public static $container;

    public function __construct($config)
    {
        self::$app = $this;
        self::$container = new Container;
        $this->bootstrap($config);
    }

    public function run()
    {
        $request = self::$container->get('request');

        die($this->handleRequest($request));
    }

    public function handleRequest(Request $request)
    {
        $pathItem = explode('/', trim($request->getPathInfo(), '/'));
        if (!$pathItem[0]) {
            $pathItem[0] = 'index';
        }

        if (!$pathItem[1]) {
            $pathItem[1] = 'index';
        }

        $controllerClassName = 'App\controllers\\' . ucfirst($pathItem[0]) . 'Controller';
        if (class_exists($controllerClassName)) {
            $controllerObject = new $controllerClassName;
            if (method_exists($controllerObject, 'action' . ucfirst($pathItem[1]))) {
                return $controllerObject->{'action' . $pathItem[1]}();
            }
        }

        throw new BadRequestHttpException('Page not found');
    }

    private function bootstrap($config = [])
    {
        foreach ($config as $key => $item) {
            self::$container->set($key, $item);
        }
    }

}
