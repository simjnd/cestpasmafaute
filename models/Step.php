<?php
	namespace CPMF\Models;

	class Step
	{
		private $id;
		private $name;
		private $lesson;
		private $exercices;

		public __construct(int $id, string $name, string $lesson)
		{
			$this->id = $id;
			$this->name = $name;
			$this->lesson = $lesson;
		}

		public getId(): int
		{
			return $this->id;
		}

		public getName(): string
		{
			return $this->name;
		}

		public getLesson(): string
		{
			return $this->lesson;
		}

		public getExercices(): array
		{
			return $this->exercices;
		}

		public setExercices(array $exercices): void
		{
			$this->exercices = $exercices;
		}
	}
