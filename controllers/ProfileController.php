<?php
namespace App\Controller;

class ProfileController extends Controller
{
	public function show(string $user): void
	{
    	$data = array('user' => $user);
		parent::view('profile', $data);
	}
}