<?php
namespace CPMF\Controller;

abstract class Controller
{	
	public function view(string $view, array $data = []): void
	{
		extract($data);
		require '../views/'. $view. '.php';
	}	
}