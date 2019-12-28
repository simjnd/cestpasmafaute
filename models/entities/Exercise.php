<?php
namespace CPMF\Models\Entities;

class Exercise
{
    private $idExercise;
    private $idDifficulty;
    private $questions;

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

    public function setId(int $idExercise): void
    {
    	$this->idExercise = $idExercise;
    }

    public function setDifficulty(int $idDifficulty): void
    {
    	$this->idDifficulty = $idDifficulty;
    }

    public function setQuestion(array $questions): void 
    {
    	$this->questions = $question;
    }

    public function fill(): void
    {
        if ($this->getID() !== NULL) {
            $this->setQuestion(StudentExerciseManager::getAllQuestionsByExerciseID($this->getId()));
        } else {
            $this->setQuestion(NULL);
        }
    }
    
    
}