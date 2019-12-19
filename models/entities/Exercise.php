<?php
namespace CPMF\Models\Entities;

class Exercise
{
    private $idExercice;
    private $idDifficulty;
    private $questions;

    public function getId(): int
    {
    	return $this->idExercice;
    }

    public function getDifficulty(): int 
    {
    	return $this->idDifficulty;
    }

    public function getQuestions(): array
    {
    	return $this->questions;
    }

    public function setId(int $idExercice): void
    {
    	$this->idExercice = $idExercice;
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
            $this->setQuestion(StudentExerciceManager::getAllQuestionsByExerciceID($this->getId()));
        } else {
            $this->setQuestion(NULL);
        }
    }
    
    
}