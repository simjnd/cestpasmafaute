<?php
namespace CPMF\Models\Entities;

class Course extends Model
{
	private $idCourse;
	private $label;

	public function __construct(array $data)
	{
		parent::__construct($data);
	}

	protected function callFunction(string $methodName, string $value = ""): void 
	{
		if(method_exists($this, $methodName)) {
			$this->$methodName($value);
		}
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getLabel(): string
	{
		return $this->label;
	}

	private function setLabel(string $label): void
	{
		$this->label = $label;
	}
}
