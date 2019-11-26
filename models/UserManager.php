<?php
namespace CPMF\Models;

class UserManager extends Manager
{
	public function __construct() 
	{
		parent::__construct();
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