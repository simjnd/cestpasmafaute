<?php
namespace CPMF\Models\Entities;

use \CPMF\Models\StudentExerciseManager;

class Exercise extends Model
{
    private $idExercise;
    private $difficulty;
    private $questions;

    public function __construct(array $data)
    {
        parent::__construct($data);
    } 

    protected function callFunction(string $methodName, ?string $value = ""): void
    {
        if(method_exists($this, $methodName)) {
            $this->$methodName($value);
        }   
    }

    public function getIdExercise(): int
    {
    	return $this->idExercise;
    }

    public function getDifficulty(): ?Difficulty 
    {
    	return $this->idDifficulty;
    }

    public function getQuestions(): array
    {
    	return $this->questions;
    }

    public function setIdExercise(int $idExercise): void
    {
    	$this->idExercise = $idExercise;
    }

    public function setDifficulty(?Difficulty $difficulty): void
    {
    	$this->difficulty = $difficulty;
    }

    public function setQuestions(array $questions): void 
    {
    	$this->questions = $question;
    }
}