<?php
namespace CPMF\Models\Entities;

class Decoration
{
	private $id;
	private $label;
	private $filePath;
	private $pointsRequired;

	public function __construct(int $id, string $label, string $filePath, int $pointsRequired)
	{
		$this->id = $id;
		$this->label = $label;
		$this->filePath = $filePath;
		$this->pointsRequired = $pointsRequired;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getLabel(): string
	{
		return $this->label;
	}

	public function getFilePath(): string
	{
		return $this->filePath;
	}

	public function getPointsRequired(): int
	{
		return $this->pointsRequired;
	}
}
