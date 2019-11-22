<?php
namespace App\Controller;

class NotFoundController extends Controller
{
	public function show(): void
	{
		header("HTTP/1.0 404 Not Found");
		$data = array('url' => $_SERVER['REQUEST_URI']);
		parent::view('notfound', $data);
	}
}