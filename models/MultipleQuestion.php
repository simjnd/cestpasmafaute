<?php
namespace CPMF\Models;

class MultipleQuestion extends Question
{
	private $choices;

	public function __construct(int $id, string $sentence)
	{
		parent::__construct($id, $sentence);
	}

	public function getChoices(): array
	{
		return $this->choices;
	}

	public function setChoices(array $choices): void
	{
		$this->choices = $choices;
	}
}