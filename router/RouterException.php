<?php
namespace CPMF\Router;

class RouterException extends Exception
{
	public function __construct(string $message) {
		parent::__construct($message);
	}
}