<?php
namespace CPMF\Models\Entities;

class SimpleQuestion extends Question
{
	private $correctAnswer;
	private $word;

	public function __construct(array $data)
	{
		parent::__construct($data);
	}

	protected function callFunction(string $methodName, $value = null): void
    {
        if(method_exists($this, $methodName)) {
            $this->$methodName($value);
        }   
    }

	public function getCorrectAnswer(): string
	{
		return $this->correctAnswer;
	}

	public function getWord(): string
	{
		return $this->word;
	}

	public function setCorrectAnswer(string $correctAnswer): void
	{
		$this->correctAnswer = $correctAnswer;
	}

	public function setWord(string $word): void
	{
		$this->word = $word;
	}
}
