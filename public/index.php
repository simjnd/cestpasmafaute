<?php
namespace CPMF;
use CPMF\Router\Router;

spl_autoload_register(function($name) {
	$exploded = explode('\\', $name);
	$subdir = '';
	switch($exploded[1]) {
		case 'Router':
			$subdir = 'router/';
			break;
		case 'Controller':
			$subdir = 'controllers/';
			break;
		case 'Models':
			$subdir = 'models/';
			break;
	}

    require '../'. $subdir . end($exploded) .'.php';
});

Router::init();

Router::setDefault('NotFound');

Router::view('/', 'hello');

Router::run();