<?php
namespace CPMF\Models\Entities;

class Teacher extends User 
{
	private $classes;

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

    private function setClasses(array $classes): void
    {
    	$this->classes = $classes;
    }

}