<?php
namespace CPMF\Models\Entities;

class Group extends Model
{
	private $name;
	private $students;
	private $course;

	protected function callFunction(string $methodName, string $value = ""): void
    {
        if(method_exists($this, $methodName)) {
            $this->$methodName($value);
        }   
    }
    
    private function setName(string $name): void
    {
        $this->name = $name;
    }
    
    private function setStudents(array $students): void
    {
        $this->students = $students;
    }
    
    private function setCourse(Course $course): void
    {
        $this->course = $course;
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

	public function setStudents(array $students): void
	{
		$this->students = $students;
	}

	public function setCourse(Course $course): void
	{
		$this->course = $course;
	}
}