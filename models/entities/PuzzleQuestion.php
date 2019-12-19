<?php
namespace CPMF\Models\Entities;

class PuzzleQuestion extends Question
{
	private $idRole;
	private $startMarker;
	private $endMarker;

	public function __construct(int $id, string $sentence)
	{
		parent::__construct($id, $sentence);
	}

	public function getIdRole(): int
	{
		return $this->idRole;
	}

	public function getStartMarker(): int
	{
		return $this->startMarker;
	}

	public function getEndMarker(): int
	{
		return $this->endMarker;
	}

	public function setIdRole(int $idRole): void 
	{
		$this->idRole = $idRole;
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
