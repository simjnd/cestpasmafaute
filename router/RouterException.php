<?php
namespace CPMF\Router;

use \Exception;

class RouterException extends Exception
{
	public function __construct(string $message) {
		parent::__construct($message);
	}
}