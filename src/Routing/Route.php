<?php

class Route{
    private static array $routes = [];

    public static function add(RouteMethod $method, string $uri, string $controller, string $action){
        self::$routes[] = [
            "method" => $method,
            "uri" => $uri,
            "uriParts" => explode("/", preg_replace('/^\//', "", $uri)),
            "controller" => $controller,
            "action" => $action
        ];
    }

    public static function process(){
        $method = $_SERVER['REQUEST_METHOD'];
        $hostname = $_SERVER['SERVER_NAME'];
        $uri = $_SERVER['PATH_INFO'];
        // Remove first /
        $uriParts = explode("/", preg_replace('/^\//', "", $uri));

        for ($i = 0; $i < count(self::$routes); $i++){
            $route = self::$routes[$i];
            if (
                $route['method']->value != strtolower($method) ||
                count($uriParts) != count($route['uriParts'])
            ){
                continue;
            }
            $lastPartIndex = count($route['uriParts']) - 1;
            // Compare uri parts exclude last part (could be a parameter)
            $uriMatches = true;
            for ($j = 0; $j < $lastPartIndex; $j++){
                if ($uriParts[$j] != $route['uriParts'][$j]){
                    $uriMatches = false;
                    break;
                }
            }
            if (!$uriMatches){
                continue;
            }
            // Check last part for parameter
            preg_match('/\{.+\}/', $route['uriParts'][$lastPartIndex], $matches);
            // Last part is not a parameter and is not equal to each other
            if (count($matches) < 0 && $route['uriParts'][$lastPartIndex] != $uriParts[$lastPartIndex]){
                continue;
            }

            if (class_exists($route['controller'])){
                $controller = new $route['controller'];
                echo call_user_func([$controller, $route['action']], $uriParts[$lastPartIndex]);
                return;
            } else {
                throw new Exception("Controller does not exist.");
            }

        }
        Logger::Log("404");
    }
}