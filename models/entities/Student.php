<?php
namespace CPMF\Models\Entities;

use \CPMF\Models\StudentManager;
use \CPMF\Models\GroupManager;
use \CPMF\Models\DecorationManager;

class Student extends User
{
	private $frame;
	private $accessory;
	private $portrait;
	private $finishedExercises;
	private $lastConnection;
	private $totalTimeConnected;
	private $idClass;
	private $group;

	public function __construct(array $data)
	{
		parent::__construct($data);
	}

    protected function callFunction(string $methodName, ?string $value = ""): void
    {
        if(method_exists($this, $methodName)) {
            $this->$methodName($value);
        }   
    }
    
    private function setFrame(Frame $frame): void
    {
        $this->frame = $frame;
    }
    
    private function setAccessory(Accessory $accessory): void
    {
        $this->accessory = $accessory;
    }
    
    private function setPortrait(Portrait $portrait): void
    {
        $this->portrait = $portrait;
    }
    
    private function setLastConnection(string $lastConnection): void
    {
        $this->lastConnection = $lastConnection;
    }
    
    private function setTotalTimeConnected(string $totalTimeConnected): void
    {
        $this->totalTimeConnected = $totalTimeConnected;
    }
    
    private function setIdClass(?int $idClass): void
    {
        $this->idClass = $idClass;
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

	public function getLastConnection(): string
	{
		return $this->lastConnection;
	}

	public function getTotalTimeConnected(): int
	{
		return $this->totalTimeConnected;
	}
	
	public function getIdClass(): ?int
	{
    	return $this->idClass;
	}

	public function setGroup(?Group $group): void
	{
		$this->group = $group;
	}

	public function getGroup(): ?Group
	{
		return $this->group;
	}

	public function fill(): void
	{
		if($this->getIdClass() !== NULL) {
			$this->setGroup(GroupManager::getById($this->getIdClass()));
		} else {
			$this->setGroup(NULL);	
		} 
		// TODO: fill les frames, portraits et accessoires
        // $frames = DecorationManager::unlockedFrame($student->getIdLogin());
        // $portraits = DecorationManager::unlockedPortrait($student->getIdLogin());
        // $accessories = DecorationManager::unlockedAccessory($student->getIdLogin());
	}
}