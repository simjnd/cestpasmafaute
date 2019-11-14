<?php
namespace CPMF\Models;
class Student extends User
{
	private $frame;
	private $accessories;
	private $portrait;
	private $finishedExercises;
	private $lastConnection;
	private $timeSpent;

	public function __construct($frame, $accessories, $portrait, $finishedExercises, $lastConnection, $timeSpent)
	{
		$this->frame = $frame;
		$this->accessories = $accessories;
		$this->portrait = $portrait;
		$this->finishedExercises = $finishedExercises;
		$this->lastConnection = $lastConnection;
		$this->timeSpent = $timeSpent;
	}

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

	public function getLastConnection(): String
	{
		return $this->lastConnection;
	}

	public function getTimeSpent(): int
	{
		return $this->timeSpent;
	}
}