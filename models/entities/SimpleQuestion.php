<?php
namespace CPMF\Models\Entities;

class SimpleQuestion extends Question
{
	private $correctAnswer;
	private $word;

	public function __construct(int $id, string $sentence, string $correctAnswer, string $word)
	{
		parent::__construct($id, $sentence);
		$this->correctAnswer = $correctAnswer;
		$this->word = $word;
	}

	public function getCorrectAnswer(): string
	{
		return $this->correctAnswer;
	}

	public function getWord(): string
	{
		return $this->word;
	}
}
