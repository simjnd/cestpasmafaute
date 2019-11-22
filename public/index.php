<?php
namespace App;
use App\Router\Router;

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
		case 'Model':
			$subdir = 'models/';
			break;
	}

    require '../'. $subdir . end($exploded) .'.php';
});

Router::init();

Router::setDefault('NotFound');

Router::get('/', 'Main');

Router::get('/items', 'Item@getItems');
Router::get('/item/{id}', 'Item@getItem');

Router::get('/@{user}', 'Profile');

Router::view('/function', 'function');

Router::run();