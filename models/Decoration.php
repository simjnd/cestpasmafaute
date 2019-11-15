<?php
namespace CPMF\Models;

class Decoration
{
	private $id;
	private $label;
	private $findPath;
	private $pointsRequired;

	public function __construct(int $id, string $label, string $findPath, int $pointsRecquired)
	{
		$this->id = $id;
		$this->label = $label;
		$this->findPath = $findPath;
		$this->pointsRecquired = $pointsRecquired;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getLabel(): string
	{
		return $this->label;
	}

	public function getFindPath(): string
	{
		return $this->findPath;
	}

	public function getPointsRequired(): int
	{
		return $this->pointsRequired;
	}
}
