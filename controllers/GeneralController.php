<?php
namespace CPMF\Controller;

use CPMF\Models\UserManager;

class GeneralController extends Controller
{
	public function homePage(): void
	{
		$user = "student";
		$validated = false;
		if ($user === "student") 
		{
			if ($validated) 
			{
				parent::view('student-home');
			}
			else
			{
				parent::view('student-home-validation');	
			}		
		}
		else
		{
			parent::view($user . '-home');
		}
	}

	public function postSignin(): void
	{
		$id = UserManager::userExists($_POST['email'], $_POST['password']);

		if($id == -1) {
			parent::view('general-signin', ['error' => 'Compte inexistant']);
		} elseif($id == -2) {
			parent::view('general-signin', ['error' => 'Email / Mot de passe incorrect']);
		} else {
			session_start();
			$_SESSION['connected'] = true;
			$_SESSION['email'] = $_POST['email'];
			parent::redirect('/');
		}
	}

	public function postSignup(): void
	{
		// TODO: Check de la validation des informations

		// firstName
		// lastName
		// email
		// password

		$informations = $_POST;
		$resultCode = UserManager::addStudent($informations);
		if($resultCode === -1) {
			// ERROR
			die('Erreur lors de l\'ajout');
		} else {
			session_start();
			$_SESSION['idLogin'] = intval($resultCode);
			$_SESSION['type'] = 'T';
			parent::redirect('/');
		}
	}
}
