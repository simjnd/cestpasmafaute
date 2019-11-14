<?php
namespace CPMF\Models;

class Class {
	private $name;
	private $students;
	private $course;

	public function __construct(string $name) 
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

	public function setStudents(array $students): void
	{
		$this->students = $students;
	}

	public function setCourse(Course $course): void
	{
		$this->course = $course;
	}
}