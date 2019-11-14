<?php
	namespace CPMF\Models;

	class Choice
	{
		private $id;
		private $label;

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
	}
