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

// GLOBAL PAGES

Router::get('/signout', 'Global@signOut');

Router::view('/', 'hello');
Router::view('/login', 'login');
Router::post('/login', 'Login@postLogin');
Router::get('/connected', 'Connected@connectedPage');

// STUDENT PAGES

Router::get('/class', 'Student@seeClass');

Router::get('/profile', 'Student@seeProfile');
Router::post('/profile', 'Student@saveProfileChanges');

// TEACHER PAGES

Router::get('/approval', 'Teacher@seeWaitingStudents');
Router::get('/approval', 'Teacher@seeWaitingStudents');


Router::run();