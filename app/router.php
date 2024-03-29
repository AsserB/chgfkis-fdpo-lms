<?php

namespace app;

class Router
{

    private $routes = [
        '/^\/?$/' => ['controller' => 'home\\homeController', 'action' => 'index'],
        '/^\/info(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'info\\InfoController'],
        '/^\/users(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'users\\usersController'],
        '/^\/pages(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'pages\\pageController'],
        '/^\/roles(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'roles\\roleController'],
        '/^\/auth(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'auth\\authController'],
        '/^\/lms(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'lms\\lmsController'],
    ];

    public function run()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $controller = null;
        $action = null;
        $params = null;

        //Пробегаемся по маршрутам ($routes), пока не найдем нужный
        foreach ($this->routes as $pattern => $route) {
            //Ищем маршрут который соотвествует URI при помощи регулярного выражения
            if (preg_match($pattern, $uri, $matches)) {
                //Получаем имя контроллера с маршрута($route)
                $controller = "controllers\\" . $route['controller'];
                //Получаем действие из маршрута, если оно есть, или из URI
                $action = $route['action'] ?? $matches['action'] ?? 'index';
                //Получаем параметы из совпавших с регулярным выражением подстрок
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                //Прерываем цикл, если нашли подходящий маршрут
                break;
            }
        }

        if (!$controller) {
            http_response_code(404);
            echo "Страница не найдена";
            return;
        }

        $controllerInstance = new $controller();
        if (!method_exists($controllerInstance, $action)) {
            http_response_code(404);
            echo "Страница не найдена";
            return;
        }
        call_user_func_array([$controllerInstance, $action], [$params]);
    }
}
