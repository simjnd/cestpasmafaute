<?php
namespace CPMF\Router;

class Route
{
	private $path;
	private $callable;
	private $matches;
	private $params;

	public function __construct(string $path, $callable) 
	{
		$this->path = trim($path, '/');
		$this->callable = $callable;
		$this->matches = [];
		$this->params = [];
	}

	public function match(string $url): bool
	{
		$url = trim($url, '/');
		$path = preg_replace('#{([a-zA-Z0-9]+)*}#', '([^/]+)', $this->path);
		$regex = '#^'. $path. '$#i';
		if(!preg_match($regex, $url, $matches)){
			return false;
		}
		array_shift($matches);
		$this->matches = $matches;
		return true;
	}

	public function with(string $param, string $regex): Route
	{
		$this->params[$param] = str_replace('(', '(?:', $regex);
		return $this;
	}

	private function paramMatch(array $match): string
	{
		if(isset($this->params[$match[1]])) {
			return '('. $this->params[$match[1]] .')';
		}
		return '([^/]+)';
	}

	public function getUrl(array $params): string
	{
		$path = $this->path;
		foreach($params as $k => $v){
			$path = str_replace('{'.$k.'}', $v, $path);
		}
		return $path;
	}

	public function call()
	{
		if(is_string($this->callable)){
    		require_once '../conf.php';
			$params = explode('@', $this->callable);
			$controller = APPNAME.'\\Controller\\'. $params[0] .'Controller';
			$controller = new $controller();
			if (count($params) > 1) {
                return call_user_func_array(array($controller, $params[1]), $this->matches);
			} else {
    			return call_user_func_array(array($controller, 'show'), $this->matches);
			}
		} else {
			return call_user_func_array($this->callable, $this->matches);
		}
	}
}