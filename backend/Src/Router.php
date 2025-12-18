<?php

declare(strict_types=1);

namespace Src;

class Router
{
    private array $routes = [];

    public function get(string $path, $handler): void
    {
        $this->addRoute("GET", $path, $handler);
    }

    public function post(string $path, $handler): void
    {
        $this->addRoute("POST", $path, $handler);
    }

    private function addRoute(string $method, string $path, $handler): void
    {
        $this->routes[$method][$path] = $handler;
    }

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (!isset($this->routes[$method][$uri])) {
            http_response_code(404);
            echo '404 Not Found';
            return;
        }

        $handler = $this->routes[$method][$uri];

        if (is_array($handler) && count($handler) === 2) {
            [$controllerClass, $controllerMethod] = $handler;
            if (class_exists($controllerClass)) {
                $controller = new $controllerClass();
                if (method_exists($controller, $controllerMethod)) {
                    $result = $controller->$controllerMethod();
                    if ($result !== null) {
                        echo $result;
                    }
                    return;
                }
            }
            http_response_code(500);
            echo 'Controller or method not found';
            return;
        }

        call_user_func($handler);
    }
}