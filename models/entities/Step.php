<?php
namespace CPMF\Models\Entities;

use \CPMF\Models\StudentExerciseManager;

class Step extends Model
{
	private $idStep;
	private $name;
	private $lessonEasy;
	private $lessonMedium;
	private $lessonHard;
	private $exercises;

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
    
    private function setIdStep(int $idStep): void
    {
        $this->idStep = $idStep;
    }
    
    private function setName(string $name): void
    {
        $this->name = $name;
    }
    
    private function setLessonEasy(string $lessonEasy): void
    {
        $this->lessonEasy = $lessonEasy;
    }
    
    private function setLessonMedium(string $lessonMedium): void
    {
        $this->lessonMedium = $lessonMedium;
    }
    
    private function setLessonHard(string $lessonHard): void
    {
        $this->lessonHard = $lessonHard;
    }
    
    private function setExercises(array $exercises): void
	{
		$this->Exercises = $Exercises;
	}

	public function getIdStep(): int
	{
		return $this->idStep;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getLessons(): array
	{
		$lessons[] = $this->lessonEasy;
		$lessons[] = $this->lessonMedium;
		$lessons[] = $this->lessonHard;

		return $lessons;
	}

	public function getExercises(): array
	{
		return $this->exercises;
	}

	public function fillLessons(): void
	{
		if ($this->getIdStep() !== NULL) {
			$this->setLessonEasy(StudentExerciseManager::getLessonByStepAndDifficultyID($this->getIdStep(), 0));
			$this->setLessonMedium(StudentExerciseManager::getLessonByStepAndDifficultyID($this->getIdStep(), 1));
			$this->setLessonHard(StudentExerciseManager::getLessonByStepAndDifficultyID($this->getIdStep(), 2));
		} else {
			$this->setLessonEasy(NULL);
			$this->setLessonMedium(NULL);
			$this->setLessonHard(NULL);
		}
	}

	public function fillExercises(): void
	{
		if ($this->getIdStep() !== NULL) {
			$this->setExercises(StudentExerciseManager::getExercisesByStepID($this->getIdStep()));
		} else {
			$this->setExercises(NULL);
		}
	}
	
}
