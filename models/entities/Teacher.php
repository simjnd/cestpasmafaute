<?php
namespace CPMF\Models\Entities;

class Teacher extends User 
{
	private $email;
	private $firstName;
	private $lastName;
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

    private function setEmail(string $email): void
    {
    	$this->email = $email; 
    }

    private function setFirstName(string $firstName): void
    {
    	$this->firstName = $firstName;
    }

    private function setLastName(string $lastName): void
    {
    	$this->lastName = $lastName;
    }

    private function setClasses(array $classes): void
    {
    	$this->classes = $classes;
    }

}