<?php
	namespace CPMF\Models;

	class Course
	{
		private $id;
		private $label;
		private $steps;

		public __construct(int $id, string $label)
		{
			$this->id = $id;
			$this->label = $label;
		}

		public getId(): int
		{
			return $this->id;
		}

		public getLabel(): string
		{
			return $this->label;
		}

		public getSteps(): array
		{
			return $this->steps;
		}

		public setSteps(array $steps): void 
		{
			$this->steps = $steps;
		}
	}
