<?php
namespace CPMF\Models\Entities;

class Course
{
	private $id;
	private $label;
	private $steps;

	public function __construct(int $id, string $label)
	{
		$this->id = $id;
		$this->label = $label;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getLabel(): string
	{
		return $this->label;
	}

	public function getSteps(): array
	{
		return $this->steps;
	}

	public function setSteps(array $steps): void 
	{
		$this->steps = $steps;
	}
}
