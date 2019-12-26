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

	public function postSignIn(): void
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
			parent::redirect('/');
		}
	}

	public function postSignUp(): void
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

	public function signOut(): void
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
			die("Le mot de passe actuel n'est pas correct");
		}

		parent::redirect('/profile');
	}

	/**
	* Send an email to change your forgotten password
	*/
	public function sendPasswordEmail(): void
	{
		$email = $_POST['email'];
		$userExists = UserManager::userExists($email);
		var_dump($userExists);
		if ($userExists) {
			$idLogin = UserManager::getIdByEmail($email);

			$token = bin2hex(random_bytes(16));
			var_dump($token);

			UserManager::addToken($idLogin, $token);

			$to = $email;
			$subject = 'Changer mot de passe';
			$from = 'climent.arnaud@gmail.com';

			// To send HTML mail, the Content-type header must be set
			$headers = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			// Create email headers
			$headers .= 'From: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion();

			$link = '/change-forgot-password/' . $idLogin . '/' . $token;

			echo '<a href="' . $link . '">Changer votre mot de passe</a>';
			 
			// Compose a simple HTML email message
			$message = '<html><body>';
			$message .= '<h1">Liens pour changer votre mot de passe</h1>';
			$message .= '<a href="' . $link . '">Changer votre mot de passe</a>';
			$message .= '</body></html>';
			 
			// Sending email
			if(mail($to, $subject, $message, $headers)) {
			    echo 'Votre mail a bien était envoyé.';
			    parent::redirect('/email-sended');
			} else {
			    echo 'Impossible d\'envoyer un e-mail. Veuillez réessayer.';
			}
		} else {
			die("L'utilisateur n'existe pas");
		}
	}

	public function changeForgotPasswordInfo(int $idLogin, string $token): void
	{
		parent::view('general-change-forgot-password', ['idLogin' => $idLogin, 'token' => $token]);
	}

	/**
	* Allows you to change your password when you have forgotten the previous one
	* @param int $idLogin
	*	User idLogin
	* @param string $token
	*	Token allowing user identification
	*/
	public function changeForgotPassword(int $idLogin, string $token):void
	{
		if (UserManager::userVerification($idLogin, $token)) {
			if ($_POST['newPassword'] === $_POST['verificationNewPassword']) {
				UserManager::updatePassword($idLogin, $_POST['newPassword']);
			} else {
				die("Le mot de passe n'est pas identique au mot de passe de vérification");
			}
		} else {
			die("Le token est expiré");
		}
	}
}