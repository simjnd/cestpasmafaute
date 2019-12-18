<?php
namespace Medical\Router;

class Router
{
    private static $url;
    private static $routes;
    private static $defaultRoute;

    public static function init(): void
    {
        self::$url = $_SERVER['REQUEST_URI'];
        self::$routes = [];
    }

    public static function setDefault($callback): void
    {
        self::$defaultRoute = new Route('', $callback, []);
    }

    public static function get(string $path, $callback, array $options = []): Route
    {
        return self::add($path, $callback, $options, 'GET');
    }

    public static function post(string $path, $callback, array $options = []): Route
    {
        return self::add($path, $callback, $options, 'POST');
    }
    
    public static function view(string $path, string $view, array $options = []): Route
    {
        return self::add($path, function() use ($view) {
            require '../views/'. $view .'.php';
        }, $options, 'GET');
    }

    private static function add(string $path, $callback, array $options, string $method): Route
    {
        $route = new Route($path, $callback, $options);
        self::$routes[$method][] = $route;
        return $route;
    }

    public static function run()
    {
        if (!isset(self::$routes[$_SERVER['REQUEST_METHOD']])) {
            throw new RouterException('REQUEST_METHOD does not exist');
        }
        
        foreach (self::$routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if (self::isMatchingRoute($route, self::$url)) {
                return $route->call();
            }
        }
        return self::$defaultRoute->call();
    }
    
    private static function isMatchingRoute(Route $route, string $url): bool
    {
        $url = trim($url, '/');
        $path = preg_replace('#{([a-zA-Z0-9]+)*}#', '([^/]+)', $route->getPath());
        $regex = '#^'. $path. '$#i';
        if (!preg_match($regex, $url, $matches)) {
            return false;
        }
        array_shift($matches);
        $route->setMatches($matches);
        return $route->verifyOptions();
    }
}