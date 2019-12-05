<?php
namespace CPMF\Models\Entities;

class Step
{
	private $id;
	private $name;
	private $lesson;
	private $exercices;

	public function __construct(int $id, string $name, string $lesson)
	{
		$this->id = $id;
		$this->name = $name;
		$this->lesson = $lesson;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getLesson(): string
	{
		return $this->lesson;
	}

	public function getExercices(): array
	{
		return $this->exercices;
	}

	public function setExercices(array $exercices): void
	{
		$this->exercices = $exercices;
	}
}
