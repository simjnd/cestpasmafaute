<?php
namespace CPMF\Models\Entities;

class Step
{
	private $idStep;
	private $name;
	private $lessonEasy;
	private $lessonMedium;
	private $lessonHard;
	private $exercices;

	protected function callFunction(string $methodName, string $value = ""): void
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
    
    private function setLessonEasy(): void
    {
        $this->lessonEasy = $lessonEasy;
    }
    
    private function setLessonMedium(): void
    {
        $this->lessonMedium = $lessonMedium;
    }
    
    private function setLessonHard(): void
    {
        $this->lessonHard = $lessonHard;
    }
    
    private function setExercices(array $exercices): void
	{
		$this->exercices = $exercices;
	}

	public function getIdStep(): int
	{
		return $this->id;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getLesson(): string
	{
		return $this->lesson;
	}

	public function getExercices(): array
	{
		return $this->exercices;
	}
	
}
