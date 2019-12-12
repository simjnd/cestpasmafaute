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
			if ($exploded[2] === 'Entities') {
    		    $subdir = $subdir . 'entities/';
		    }
			break;
	}

    require '../'. $subdir . end($exploded) .'.php';
});

Router::init();

Router::setDefault('NotFound');

// GLOBAL PAGES

Router::get('/signout', 'Global@signOut');

Router::get('/', 'General@homePage');

// SIGNIN

Router::view('/signin', 'general-signin');
Router::post('/signin', 'General@postSignin');

// SIGNUP

Router::view('/signup', 'general-signup');
Router::post('/signup', 'General@postSignup');

// STUDENT PAGES

Router::get('/class', 'Student@seeClass');

Router::get('/profile/{idLogin}', 'Student@seeProfile');
Router::post('/profile', 'Student@saveProfileChanges');

// TEACHER PAGES

Router::get('/approval', 'Teacher@seeWaitingStudents');
Router::get('/approval', 'Teacher@seeWaitingStudents');

// TEST

Router::view('/test', 'test-view');

session_start();

Router::run();