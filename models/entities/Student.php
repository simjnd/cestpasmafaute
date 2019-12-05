<?php
namespace CPMF\Models\Entities;

class Student extends User
{
	private $frame;
	private $accessories;
	private $portrait;
	private $finishedExercises;
	private $lastConnection;
	private $timeSpent;

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

	// public function __construct(Frame $frame, array $accessories, Portrait $portrait, array $finishedExercises, string $lastConnection, int $timeSpent)
	// {
	// 	$this->frame = $frame;
	// 	$this->accessories = $accessories;
	// 	$this->portrait = $portrait;
	// 	$this->finishedExercises = $finishedExercises;
	// 	$this->lastConnection = $lastConnection;
	// 	$this->timeSpent = $timeSpent;
	// }

	public function getFrame(): Frame
	{
		return $this->frame;
	}

	public function getAccessories(): array
	{
		return $this->accessories;
	}

	public function getPortrait(): Portrait
	{
		return $this->portrait;
	}

	public function getFinishedExercises(): array
	{
		return $this->finishedExercises;
	}

	public function getLastConnection(): string
	{
		return $this->lastConnection;
	}

	public function getTimeSpent(): int
	{
		return $this->timeSpent;
	}
}