<?php
namespace CPMF\Models\Entities;

class PuzzleQuestion extends Question
{
	private $roles;

	public function __construct(array $data)
	{
		parent::__construct($data);
	}

	protected function callFunction(string $methodName, $value = null): void
    {
        if(method_exists($this, $methodName)) {
            $this->$methodName($value);
        }   
    }

	public function getRoles(): array
	{
		return $this->roles;
	}

	public function setRoles(array $roles): void
	{
		$this->roles = $roles;
	}
}
