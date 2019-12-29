<?php
namespace CPMF\Models\Entities;

class ClickableQuestion extends Question
{
	private $answerIndex;

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

	public function getAnswerIndex(): int
	{
		return $this->answerIndex;
	}

	public function setAnswerIndex(int $answerIndex): void
	{
		$this->answerIndex = $answerIndex;
	}
}