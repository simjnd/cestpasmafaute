<?php
namespace CPMF\Models\Entities;

class SimpleQuestion extends Question
{
	private $correctAnswer;
	private $wordToWrite;

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

	public function getWordToWrite(): string
	{
		return $this->wordToWrite;
	}

	public function setCorrectAnswer(string $correctAnswer): void
	{
		$this->correctAnswer = $correctAnswer;
	}

	public function setWordToWrite(string $wordToWrite): void
	{
		$this->wordToWrite = $wordToWrite;
	}
}
