<?php
namespace CPMF\Models\Entities;

use \CPMF\Models\StudentExerciseManager;

class Exercise extends Model
{
    private $idExercise;
    private $idDifficulty;
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

    public function getId(): int
    {
    	return $this->idExercise;
    }

    public function getDifficulty(): int 
    {
    	return $this->idDifficulty;
    }

    public function getQuestions(): array
    {
    	return $this->questions;
    }

    private function setId(int $idExercise): void
    {
    	$this->idExercise = $idExercise;
    }

    private function setDifficulty(int $idDifficulty): void
    {
    	$this->idDifficulty = $idDifficulty;
    }

    private function setQuestions(array $questions): void 
    {
    	$this->questions = $question;
    }

    public function fill(): void
    {
        if ($this->getID() !== NULL) {
            $this->setQuestions(StudentExerciseManager::getAllQuestionsByExerciseID($this->getId()));
        } else {
            $this->setQuestions(NULL);
        }
    }
    
    
}