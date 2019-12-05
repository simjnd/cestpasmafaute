<?php
namespace CPMF\Models\Entities;

abstract class Model {
	
	public function __construct(array $data) 
	{
		foreach($data as $key => $value) {
			$methodName = 'set'.ucfirst($key);
			$this->callFunction($methodName, $value);
		}
	}

	protected abstract function callFunction(string $methodName, string $value = ""): void;
}