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

	public function getLessons(): array
	{
		$lessons[];

		$lessons[] = $this->lessonEasy;
		$lessons[] = $this->lessonMedium;
		$lessons[] = $this->lessonHard;

		return $lessons;
	}

	public function getExercices(): array
	{
		return $this->exercices;
	}

	public function fill(): void
	{
		if ($this->getIdStep() !== NULL) {
			$this->setLessonEasy(StepManager::getLessonEasyByStepID($this->getIdStep()));
			$this->setLessonMedium(StepManager::getLessonMediumByStepID($this->getIdStep()));
			$this->setLessonHard(StepManager::getLessonHardByStepID($this->getIdStep()));
			$this->setExercices(StepManager::getExercicesByStepID($this->getIdStep()));
		} else {
			$this->setLessonEasy(NULL);
			$this->setLessonMedium(NULL);
			$this->setLessonHard(NULL);
			$this->setExercices(NULL);
		}
	}
	
}
