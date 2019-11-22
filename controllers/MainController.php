<?php
namespace App\Controller;

class MainController extends Controller
{	
	public function show(): void
	{
		parent::view('home');
	}
}