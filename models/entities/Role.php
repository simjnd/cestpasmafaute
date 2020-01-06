<?php
namespace CPMF\Models\Entities;

class Role extends Model
{
	private $idRole;
	private $label;
	private $startMarker;
	private $endMarker;

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

	public function getIdRole(): int
	{
		return $this->idRole;
	}

	public function getLabel(): string
	{
		return $this->label;
	}

	public function getStartMarker(): ?int
	{
		return $this->startMarker;
	}

	public function getEndMarker(): ?int
	{
		return $this->endMarker;
	}

	public function setIdRole(int $idRole): void
	{
		$this->idRole = $idRole;
	}

	public function setLabel(string $label): void
	{
		$this->label = $label;
	}

	public function setStartMarker(int $startMarker): void
	{
		$this->startMarker = $startMarker;
	}

	public function setEndMarker(int $endMarker): void
	{
		$this->endMarker = $endMarker;
	}
}