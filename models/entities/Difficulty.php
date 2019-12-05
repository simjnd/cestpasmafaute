<?php
namespace CPMF\Models\Entities;

class Difficulty
{
	private $id;
	private $label;

	public function __construct($id, $label)
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
