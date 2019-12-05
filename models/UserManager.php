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

	public static function userExists(string $email, string $password): int
	{
		$hashRequest = Manager::getDatabase()->prepare('select idLogin, password from Login where email = :email');
		$hashRequest->execute(['email' => $email]);

		if ($hashRequest->rowCount() == 0) return -1;

		$hashedPassword = $hashRequest->fetch()['password'];

		if (password_verify($password, $hashedPassword)) return intval($hashRequest->fetch()['idLogin']);

		return -2;
	}

	public static function addStudent(array $informations): int
	{
		$addRequest = Manager::getDatabase()->prepare('insert into Login values(NULL, :email, :password, :firstName, :lastName, "S")');
		if (!$addRequest) return -1;
		$addRequest->execute([
			'email' => $informations['email'],
			'password' => password_hash($informations['password'], PASSWORD_DEFAULT),
			'firstName' => $informations['firstName'],
			'lastName' => $informations['lastName']
		]);
		return Manager::getDatabase()->lastInsertId();
	}
}