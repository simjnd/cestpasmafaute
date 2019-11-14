<?php
namespace CPMF\Models;

class ClickableQuestion extends Question
{
	private $answerIndex;

	public function __construct(int $id, string $sentence, int $answerIndex)
	{
		parent::__construct($id, $sentence);
		$this->answerIndex = $answerIndex;
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