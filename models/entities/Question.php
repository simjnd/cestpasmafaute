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

	protected function callFunction(string $methodName, string $value): void
    {
        if(method_exists($this, $methodName)) {
            $this->$methodName($value);
        }   
    }

	public function getId(): int
	{
		return $this->idQuestion;
	}

	public function getSentence(): string 
	{
		return $this->sentence;
	}

	public function setId(int $idQuestion): void
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