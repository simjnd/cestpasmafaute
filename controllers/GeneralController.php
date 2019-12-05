<?php
namespace CPMF\Controller;

use CPMF\Models\UserManager;

class GeneralController extends Controller
{
	public function homePage(): void
	{
		session_start();
		
		$type = $_SESSION['type'] ?? NULL;

		if(isset($_SESSION['type'])) 
		{
			if($_SESSION['type'] === 'S') // Cas d'un étudiant
			{
				$idStudent = $_SESSION['idStudent'] ?? NULL;
				$validated = $_SESSION['validated'] ?? NULL;
				if ($validated) // Étudiant validé
				{
					parent::view('student-home');
				}
				else // Étudiant en attente de validation
				{
					parent::view('student-home-validation');	
				}		
			}
			elseif ($_SESSION['type'] === 'T') // Cas d'un professeur
			{
				$idTeacher = $_SESSION['idLogin'] ?? NULL;
				parent::view('teacher-home');
			}
		} 
		else
		{
			parent::view('general-home');
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
			$_SESSION['idLogin'] = $resultCode;
			$_SESSION['type'] = 'S';
			$_SESSION['validated'] = false;
			parent::redirect('/');
		}
	}
}
