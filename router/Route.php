<?php
namespace CPMF\Router;
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

	public function verifyOptions(): bool
	{
		if (key_exists('user_type', $this->options)) {
			if ($this->options['user_type'] == 'none') {
				if (isset($_SESSION['type'])) {
					return false;
				}
			} elseif ($this->options['user_type' == 'either']) {
				if (!isset($_SESSION['type'])) {
					return false;
				}
			} elseif ($this->options['user_type'] != $_SESSION['type']) {
				return false;
			}
		}
		return true;
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
    			return call_user_func_array([$controller, 'seePage'], $this->matches);
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