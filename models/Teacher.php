<?php
namespace CPMF\Models;
class Teacher extends User 
{
	private $classes;

	public function __construct(string $email, string $password, string $lastName, string $firstName, int $id) 
	{
		parent::__construct($email, $password, $lastName, $firstName, $id);
	}

	public function getClasses(): array
	{
		return $this->classes;
	}

	public function setClasses(array $classes): void
	{
		$this->classes = $classes;
	}
}