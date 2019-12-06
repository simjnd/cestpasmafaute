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

	public static function userExists(string $email, string $password, int &$idLogin, string &$type): int
	{
		$userRequest = Manager::getDatabase()->prepare('select idLogin, password, type from Login where email = :email');
		$userRequest->execute(['email' => $email]);

		if ($userRequest->rowCount() == 0) return -1;

		$result = $userRequest->fetch();
		$hashedPassword = $result['password'];

		if (password_verify($password, $hashedPassword)) {
			$idLogin = $result['idLogin'];
			$type = $result['type'];
			return 0;
		} 

		return -2;
	}

	public static function addStudent(array $informations): int
	{
		// TODO: Décomposer la fonction userExists en checkLogin et userExists
		if(self::userExists($informations['email'], $informations['password']) !== 0) {
			// L'utilisateur existe déjà
			return -1;
		}

		// Insertion de l'étudiant dans la table Login
		$addRequest = Manager::getDatabase()->prepare('insert into Login values(NULL, :email, :password, :firstName, :lastName, "S")');
		if (!$addRequest) return -1;
		$addRequest->execute([
			'email' => $informations['email'],
			'password' => password_hash($informations['password'], PASSWORD_DEFAULT),
			'firstName' => $informations['firstName'],
			'lastName' => $informations['lastName']
		]);
		$idLogin = Manager::getDatabase()->lastInsertId();

		// Insertion de l'étudiant dans la table Student (avec les valeurs par défaut)
		$addStudentRequest = Manager::getDatabase()->prepare('insert into Student values(:idLogin, NULL, 1, 1, 1, 0, NOW(), 0)');
		if(!$addStudentRequest) return -1;
		$addStudentRequest->execute([
			'idLogin' => $idLogin
		]);

		return $idLogin;
	}
}