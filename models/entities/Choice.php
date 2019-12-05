<?php
namespace CPMF\Models\Entities;

class Choice extends Model
{
	private $idChoice;
	private $label;
	private $isCorrectAnswer;
	private $idMultipleQuestion;

	public function __construct(array $data) 
	{
		parent::__construct($data);
	}

	protected function callFunction(string $methodName, string $value = ""): void 
	{
		if(method_exists($this, $methodName)) {
			$this->$methodName($value);
		}
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getLabel(): string
	{
		return $this->label;
	}

	public function isCorrectAnswer(): bool
	{
		return $this->isCorrectAnswer;
	}

	public function getIdMultipleQuestion(): int
	{
		return $this->idMultipleQuestion;
	}

	private function setIdChoice(int $idChoice): void
	{
		$this->idChoice = $idChoice;
	}

	private function setLabel(string $label): void
	{
		$this->label = $label;
	}

	private function setIsCorrectAnswer(bool $isCorrectAnswer): void
	{
		$this->isCorrectAnswer = $isCorrectAnswer;
	}

	private function setIdMultipleQuestion(int $idMultipleQuestion): void
	{
		$this->idMultipleQuestion = $idMultipleQuestion;
	}
}
