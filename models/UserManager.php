<?php
namespace CPMF\Models;

class UserManager extends Manager
{
	public function __construct() 
	{
		parent::__construct();
	}

	public function getUser(int $idLogin): User
	{
		$userRequest = $this->db->prepare('select idLogin, email, password, firstName, lastName, type from Login where idLogin = :idLogin');
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


	public function getEmailAddress(int $idLogin): string
	{
		$emailRequest = $this->db->prepare('select email from Login where idLogin = :idLogin');
		$emailRequest->execute(['idLogin' => $idLogin]);
		return $emailRequest->fetch()['email'];
	}

	public function getPassword(int $idLogin): string
	{
		$passwordRequest = $this->db->prepare('select password from Login where idLogin = :idLogin');
		$passwordRequest->execute(['idLogin' => $idLogin]);
		return $passwordRequest->fetch()['password'];
	}

	public function getFirstName(int $idLogin): string
	{
		$firstNameRequest = $this->db->prepare('select firstName from Login where idLogin = :idLogin');
		$firstNameRequest->execute(['idLogin' => $idLogin]);
		return $firstNameRequest->fetch()['firstName'];
	}

	public function getLastName(int $idLogin): string
	{
		$lastNameRequest = $this->db->prepare('select lastName from Login where idLogin = :idLogin');
		$lastNameRequest->execute(['idLogin' => $idLogin]);
		return $lastNameRequest->fetch()['lastName'];
	}

	public function getType(int $idLogin): string
	{
		$typeRequest = $this->db->prepare('select type from Login where idLogin = :idLogin');
		$typeRequest->execute(['idLogin' => $idLogin]);
		return $typeRequest->fetch()['type'];
	}

	public function userExists(string $email, string $password): int
	{
		$hashRequest = $this->db->prepare('select idLogin, password from Login where email = :email');
		$hashRequest->execute(['email' => $email]);

		if($hashRequest->rowCount() == 0) return -1;

		$hashedPassword = $hashRequest->fetch()['password'];

		if(password_verify($password, $hashedPassword)) return intval($hashRequest->fetch()['idLogin']);

		return -2;
	}
}