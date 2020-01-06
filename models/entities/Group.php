<?php
namespace CPMF\Models\Entities;

use \CPMF\Models\GroupManager;

class Group extends Model
{
	private $idClass;
	private $name;
	private $students;
	private $course;

	protected function callFunction(string $methodName, string $value = ""): void
    {
        if(method_exists($this, $methodName)) {
            $this->$methodName($value);
        }   
    }

    public function getIdClass(): int
    {
    	return $this->idClass;
    }
    
    public function setName(string $name): void
    {
        $this->name = $name;
    }

	public function getName(): string
	{
		return $this->name;
	}

	public function getStudents(): array
	{
		return $this->students;
	}

	public function getCourse(): Course
	{
		return $this->course;
	}

	public function setIdClass(int $idClass): void
	{
		$this->idClass = $idClass;
	}

	public function setStudents(array $students): void
	{
		$this->students = $students;
	}

	public function setCourse(Course $course): void
	{
		$this->course = $course;
	}

	public function fill(): void
	{
		$this->setStudents(GroupManager::getStudents($this->getIdClass()));
	}
}