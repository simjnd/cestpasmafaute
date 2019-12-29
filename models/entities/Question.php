<?php
namespace CPMF\Models\Entities;

abstract class Question extends Model
{
	protected $idQuestion;
	protected $sentence;

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

	public function getIdQuestion(): int
	{
		return $this->idQuestion;
	}

	public function getSentence(): string 
	{
		return $this->sentence;
	}

	public function setIdQuestion(int $idQuestion): void
	{
		$this->idQuestion = $idQuestion;
	}

	public function setSentence(string $sentence): void
	{
		$this->sentence = $sentence;
	}
	
	// Inutile pour l'instant
	//public abstract function getAnswer(): void;
}