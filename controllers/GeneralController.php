<?php
namespace CPMF\Controller;

use CPMF\Models\UserManager;
use CPMF\Models\StudentManager;

class GeneralController extends Controller
{
	public function seeHomePage(): void
	{
		parent::view('general-home');
	}

	public function postSignin(): void
	{
		$idLogin = 0;
		$type = "";
		$id = UserManager::checkLogin($_POST['email'], $_POST['password'], $idLogin, $type);
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

		$hashedPassword = UserManager::getPassword($_SESSION['idLogin']);

		if (password_verify($informations['actualPassword'], $hashedPassword)) {
			if ($informations['password'] === $informations['passwordConfirmation']) {
				UserManager::updatePassword($_SESSION['idLogin'], $informations['password']);
			}
		} else {
			echo "actualPassword (clai)" . $informations['actualPassword'] . "\n";
			echo "actualPassword (Form) : " . $hashedPassword . "\n";
			echo "actualPassword (BDD) : " . password_hash($informations['actualPassword'], PASSWORD_DEFAULT) ."\n";
			die("Le mot de passe actuel n'est pas correct");
		}

		parent::redirect('/profile');
	}
}
