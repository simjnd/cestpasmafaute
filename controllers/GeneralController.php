<?php
namespace CPMF\Controller;

use CPMF\Models\UserManager;
use CPMF\Models\StudentManager;

class GeneralController extends Controller
{
	public function homePage(): void
	{
		$type = $_SESSION['type'] ?? NULL;

		if (isset($_SESSION['type'])) 
		{
			if ($_SESSION['type'] === 'S') // Cas d'un étudiant
			{
				$idStudent = $_SESSION['idLogin'] ?? NULL;
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
		$idLogin = 0;
		$type = "";
		$result = UserManager::checkLogin($_POST['email'], $_POST['password'], $idLogin, $type);
		$verified = StudentManager::isVerified($idLogin);
		if($id == -1) {
			parent::view('general-signin', ['error' => 'Compte inexistant']);
		} elseif($id == -2) {
			parent::view('general-signin', ['error' => 'Email / Mot de passe incorrect']);
		} else {
			$_SESSION['idLogin'] = intval($idLogin);
			$_SESSION['type'] = $type;
			if ($type === 'S')
			{
				$_SESSION['validated'] = $verified;
			}
			parent::redirect('/profile');
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

		if ($informations['password'] === $informations['passwordConfirmation']) {
			$resultCode = UserManager::addStudent($informations);
		} else {
			die("Le mot de passe n'est pas vérifié");
		}
		
		if($resultCode < 0) {
			// ERROR
			die('Erreur lors de l\'ajout: ('.$resultCode.')');
		} else {
			$_SESSION['idLogin'] = intval($resultCode);
			$_SESSION['type'] = 'S';
			$_SESSION['validated'] = false;
			parent::redirect('/');
		}
	}

	public function signout(): void
	{
		session_destroy();
		parent::redirect('/');
	}

	public function changePassword(): void
	{
		$informations = $_POST;

		$actualPassword = UserManager::getPassword($_SESSION['idLogin']);

		echo $actualPassword;
		echo password_hash($informations['actualPassword'], PASSWORD_DEFAULT);


		if (password_hash($informations['actualPassword'], PASSWORD_DEFAULT) === $actualPassword) {
			if ($informations['password'] === $informations['passwordConfirmation']) {
				UserManager::updatePassword($_SESSION['idLogin'], $password);
			}
		} else {
			echo "actualPassword (clai)" . $informations['actualPassword'] . "\n";
			echo "actualPassword (Form) : " . $actualPassword . "\n";
			echo "actualPassword (BDD) : " password_hash($informations['actualPassword'], PASSWORD_DEFAULT) ."\n";
			die("Le mot de passe actuel n'est pas correct");
		}

		parent::redirect('/profile');
	}
}
