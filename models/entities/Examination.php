<?php
namespace CPMF\Models\Entities;

class Examination
{
	private $id;
	private $password;
	private $exercise;

	public function __construct(int $id, string $password)
	{
		$this->id = $id;
		$this->password = $password;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getPassword(): string
	{
		return $this->password;
	}

	public function getExercise(): string
	{
		return $this->exercise;
	}

	public function setExercise(Exercise $exercise): void
	{
		$this->exercise = $exercise;
	}
}