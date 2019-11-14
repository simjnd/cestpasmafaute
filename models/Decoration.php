<?php
	namespace CPMF\Models;

	class Decoration
	{
		private $id;
		private $label;
		private $findPath;
		private $pointsRequired;

		public __construct(int $id, string $label, string $findPath, int $pointsRecquired)
		{
			$this->id = $id;
			$this->label = $label;
			$this->findPath = $findPath;
			$this->pointsRecquired = $pointsRecquired;
		}

		public getId(): int
		{
			return $this->id;
		}

		public getLabel(): string
		{
			return $this->label;
		}

		public getFindPath(): string
		{
			return $this->findPath;
		}

		public getPointsRequired(): int
		{
			return $this->pointsRequired;
		}
	}
