<?php
namespace Medical\Router;
require_once('../conf.php');

class Route
{
	private $path;
	private $callback;
	private $matches;
	private $options;

	public function __construct(string $path, $callback, array $options) 
	{
		$this->path = trim($path, '/');
		$this->callback = $callback;
		$this->matches = [];
		$this->options = $options;
	}

	public function execute()
	{
		if (count($this->options) === 0) {
			$this->call();
		} else if (key_exists('user_type', $this->options)) {
			if ($this->options['user_type'] === 'either') {
				if (isset($_SESSION['type'])) {
					$this->call();
				} else {
					header('Locaton: /signin');
				}
			} else if ($this->options['user_type'] === $_SESSION['type']) {
				if (key_exists('verified', $this->options)) {
					if ($this->options['verified'] === isset($_SESSION['verified'])) {
						$this->call();
					} else {
						header('Location: /');
					}
				} else {
					$this->call();
				}
			} else {
				header('Location: /signin');
			}
		}
	}

	public function call()
	{
		if (is_string($this->callback)) {
			$params = explode('@', $this->callback);
			$controller = APPNAME.'\\Controller\\'. $params[0] .'Controller';
			$controller = new $controller();
			if (count($params) > 1) {
                return call_user_func_array([$controller, $params[1]], $this->matches);
			} else {
    			return call_user_func_array([$controller, 'show'], $this->matches);
			}
		} else {
			return call_user_func_array($this->callback, $this->matches);
		}
	}
	
	public function getPath(): string
	{
    	return $this->path;
	}
	
	public function setMatches(array $matches): void
	{
    	$this->matches = $matches;
	}
}