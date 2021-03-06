<?php
namespace CPMF\Models;

class UserManager
{
	public static function getUser(int $idLogin): User
	{
		$userRequest = Manager::getDatabase()->prepare('select idLogin, email, password, firstName, lastName, type from Login where idLogin = :idLogin');
		$userRequest->execute(['idLogin' => $idLogin]);
		$userData = $userRequest->fetch();
		if ($userData == 'S') 
		{
			return new Student($userData);
		} 
		elseif ($userData == 'T')
		{
			return new Teacher($userData);
		}
		return NULL;
	}

	/**
	* Returns the user's idLogin from their email address
	* @return int
	*	user idLogin
	*/
	public static function getIdByEmail(string $email): int
	{
		$idRequest = Manager::getDatabase()->prepare('SELECT idLogin FROM Login WHERE email = :email');
		$idRequest->execute(['email' => $email]);
		return $idRequest->fetch()['idLogin'];
	}

	public static function getEmailAddress(int $idLogin): string
	{
		$emailRequest = Manager::getDatabase()->prepare('select email from Login where idLogin = :idLogin');
		$emailRequest->execute(['idLogin' => $idLogin]);
		return $emailRequest->fetch()['email'];
	}

	public static function getPassword(int $idLogin): string
	{
		$passwordRequest = Manager::getDatabase()->prepare('select password from Login where idLogin = :idLogin');
		$passwordRequest->execute(['idLogin' => $idLogin]);
		return $passwordRequest->fetch()['password'];
	}

	public static function getFirstName(int $idLogin): string
	{
		$firstNameRequest = Manager::getDatabase()->prepare('select firstName from Login where idLogin = :idLogin');
		$firstNameRequest->execute(['idLogin' => $idLogin]);
		return $firstNameRequest->fetch()['firstName'];
	}

	public static function getLastName(int $idLogin): string
	{
		$lastNameRequest = Manager::getDatabase()->prepare('select lastName from Login where idLogin = :idLogin');
		$lastNameRequest->execute(['idLogin' => $idLogin]);
		return $lastNameRequest->fetch()['lastName'];
	}

	public static function getType(int $idLogin): string
	{
		$typeRequest = Manager::getDatabase()->prepare('select type from Login where idLogin = :idLogin');
		$typeRequest->execute(['idLogin' => $idLogin]);
		return $typeRequest->fetch()['type'];
	}

	public static function checkLogin(string $email, string $password, int &$idLogin, string &$type) {
		$userRequest = Manager::getDatabase()->prepare('select idLogin, password, type from Login where email = :email');
		$userRequest->execute(['email' => $email]);

		if ($userRequest->rowCount() === 0) return -1;

		$result = $userRequest->fetch();
		$hashedPassword = $result['password'];

		if (password_verify($password, $hashedPassword)) {
			$idLogin = $result['idLogin'];
			$type = $result['type'];
			return 0;
		} 

		return -2;	
	}

	public static function userExists(string $email): bool
	{
		$userRequest = Manager::getDatabase()->prepare('select idLogin from Login where email = :email');
		$userRequest->execute(['email' => $email]);

		return $userRequest->rowCount() !== 0;
	}

	public static function addStudent(array $informations): int
	{
		if(self::userExists($informations['email'])) {
			// L'utilisateur existe déjà
			return -1;
		}

		// Insertion de l'étudiant dans la table Login
		$addRequest = Manager::getDatabase()->prepare('insert into Login values(NULL, :email, :password, :firstName, :lastName, "S")');
		if (!$addRequest) return -2;
		$addRequest->execute([
			'email' => $informations['email'],
			'password' => password_hash($informations['password'], PASSWORD_DEFAULT),
			'firstName' => $informations['firstName'],
			'lastName' => $informations['lastName']
		]);
		$idLogin = Manager::getDatabase()->lastInsertId();

		// Insertion de l'étudiant dans la table Student (avec les valeurs par défaut)
		$addStudentRequest = Manager::getDatabase()->prepare('INSERT INTO Student VALUES(:idLogin, NULL, 1, 1, 1, 0, NOW(), 0)');
		if(!$addStudentRequest) return -1;
		$addStudentRequest->execute([
			'idLogin' => $idLogin
		]);

		return $idLogin;
	}

	/**
	* Change a user's password based on their id
	* @param int $idLogin
	*	User id
	* @param string $password
	*	New password to write to the database
	*/
	public static function updatePassword(int $idLogin, string $password): void
	{
		$changePasswordRequest = Manager::getDatabase()->prepare('UPDATE Login SET password = :password WHERE idLogin = :idLogin');
		$changePasswordRequest->execute(['password' => password_hash($password, PASSWORD_DEFAULT), 'idLogin' => $idLogin]);
	}

	/**
	* Add a token in the database
	* @param int $idLogin
	*	User id
	* @param string $token
	*	Token allowing user identification
	*/
	public static function addToken(int $idLogin, string $token): void
	{
		$addTokenRequest = Manager::getDatabase()->prepare('INSERT INTO Token VALUES (:idLogin, :token, NOW())');
		$addTokenRequest->execute(['idLogin' => $idLogin, 'token' => $token]);
	}

	/**
	* Allows you to delete a token
	* @param int $idLogin
	*	User id
	* @param string $token
	*	Token allowing user identification
	*/
	public static function deleteToken(int $idLogin, string $token): void
	{
		$deleteTokenRequest = Manager::getDatabase()->prepare('DELETE FROM Token WHERE idLogin = :idLogin AND token = :token');
		$deleteTokenRequest->execute(['idLogin' => $idLogin, "token" => $token]);
	}

	/**
	* Check that the token matches the correct user id
	* @param int $idLogin
	*	User id
	* @param string $token
	*	Token allowing user identification
	*/
	public static function userVerification(int $idLogin, string $token): bool
	{
		$userVerificationRequest = Manager::getDatabase()->prepare('SELECT idLogin FROM Token WHERE idLogin = :idLogin AND token = :token AND NOW() <= ADDTIME(creationDate, "1800")');
		$userVerificationRequest->execute(['idLogin' => $idLogin, 'token' => $token]);

		return $userVerificationRequest->rowCount() !== 0;
	}
}