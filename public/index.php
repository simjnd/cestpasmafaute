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

// GLOBAL ROUTES
Router::get('/', 'General@seeHomePage', ['user_type' => 'none']);

Router::view('/signin', 'general-signin');
Router::post('/signin', 'General@postSignIn');

Router::view('/signup', 'general-signup');
Router::post('/signup', 'General@postSignUp');

Router::get('/signout', 'General@signOut');

Router::view('/change-password', 'general-change-password', ['user_type' => 'either']);
Router::post('/change-password', 'General@changePassword', ['user_type' => 'either']);

Router::view('/forgot-password', 'general-forgot-password');
Router::post('/forgot-password', 'General@sendPasswordEmail');

Router::view('/email-sended', 'general-email-sended');

Router::view('/change-forgot-password', 'general-change-forgot-password');
Router::get('/change-forgot-password/{idlogin}/{token}', 'General@changeForgotPasswordInfo');
Router::post('/change-forgot-password/{idLogin}/{token]', 'General@changeForgotPassword');


// STUDENT ROUTES
Router::get('/', 'Student@seeHomePage', ['user_type' => 'S']);

Router::get('/class', 'Student@seeClass', ['user_type' => 'S']);

Router::get('/profile', 'Student@seeProfile', ['user_type' => 'S']);
Router::post('/profile', 'Student@saveProfileChanges', ['user_type' => 'S']);

Router::get('/step/{id}', 'Student@seeStep', ['user_type' => 'S']);


// TEACHER ROUTES
Router::get('/', 'Teacher@seeHomePage', ['user_type' => 'T']);
Router::get('/approval', 'Teacher@seeWaitingStudents', ['user_type' => 'T']);
Router::get('/profile/{id}', 'Teacher@seeStudent', ['user_type' => 'T']);
Router::get('/approval/accept/{idLogin}', 'Teacher@acceptWaitingStudent');
Router::get('/approval/delete/{idLogin}', 'Teacher@deleteWaitingStudent');


// TEST ROUTES
Router::view('/test', 'test-view');
Router::view('/info', 'info');

session_start();

Router::run();