<?php
namespace CPMF\Controller;

class NotFoundController extends Controller
{
	public function seePage(): void
	{
		header("HTTP/1.0 404 Not Found");
		parent::view('general-not-found', ['url' => $_SERVER['REQUEST_URI']]);
	}
}