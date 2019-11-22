<?php
namespace App\Router;

class Router
{
    private static $url;
    private static $routes;
    private static $namedRoutes;
   	private static $defaultRoute;

    public static function init(): void
    {
    	self::$url = $_SERVER['REQUEST_URI'];
    	self::$routes = [];
    	self::$namedRoutes = [];
    }

    public static function setDefault($callable, ?string $name = null): void
    {
    	self::$defaultRoute = new Route('', $callable);
    }

    public static function get(string $path, $callable, ?string $name = null): Route
    {
        return self::add($path, $callable, $name, 'GET');
    }

    public static function post(string $path, $callable, ?string $name = null): Route
    {
        return self::add($path, $callable, $name, 'POST');
    }
    
    public static function view(string $path, string $view): Route
    {
        return self::add($path, function() use ($view) {
            require '../views/'. $view .'.php';
        }, null, 'GET');
    }

    private static function add(string $path, $callable, ?string $name, string $method): Route
    {
        $route = new Route($path, $callable);
        self::$routes[$method][] = $route;
        if(is_string($callable) && is_null($name)){
            $name = $callable;
        }
        if($name){
            self::$namedRoutes[$name] = $route;
        }
        return $route;
    }

    public static function run()
    {
        if(!isset(self::$routes[$_SERVER['REQUEST_METHOD']])) {
            throw new RouterException('REQUEST_METHOD does not exist');
        }
        foreach(self::$routes[$_SERVER['REQUEST_METHOD']] as $route){
            if($route->match(self::$url)){
                return $route->call();
            }
        }
        return self::$defaultRoute->call();
    }

    public function url(string $name, ?array $params = [])
    {
        if(!isset(self::$namedRoutes[$name])){
            return self::$defaultRoute->getUrl($params);
        }
        return self::$namedRoutes[$name]->getUrl($params);
    }

}