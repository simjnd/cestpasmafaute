<?php
namespace CPMF\Models\Entities;

class MultipleQuestion extends Question
{
	private $choices;

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

	public function getChoices(): array
	{
		return $this->choices;
	}

	public function setChoices(array $choices): void
	{
		$this->choices = $choices;
	}
}