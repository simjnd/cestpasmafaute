<?php
namespace CPMF\Controller;

use CPMF\Models\UserManager;

class LoginController extends Controller
{
	public function postLogin(): void
	{
		$userManager = new UserManager();
		extract($_POST);
		$id = $userManager->userExists($_POST['email'], $_POST['password']);

		if($id == -1) {
			parent::view('login', ['error' => 'Compte inexistant']);
		} elseif($id == -2) {
			parent::view('login', ['error' => 'Email / Mot de passe incorrect']);
		} else {
			session_start();
			$_SESSION['connected'] = true;
			$_SESSION['email'] = $_POST['email'];
			parent::redirect('/connected');
		}
		
	}
}