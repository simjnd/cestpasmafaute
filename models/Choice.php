<?php
namespace CPMF\Models;

class Choice
{
	private $id;
	private $label;

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
}
