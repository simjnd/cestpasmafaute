<?php
namespace CPMF\Controller;

use CPMF\Models\UserManager;

class SignupController extends Controller
{
	public function postSignup(): void
	{
		parent::view('general-signup');	
	}
}