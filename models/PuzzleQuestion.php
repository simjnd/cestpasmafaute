<?php
	namespace CPMF\Models;

	class PuzzleQuestion extends Question
	{
		private $choices;

		public getChoices(): array
		{
			return $this->choices;
		}

		public setChoices(array $choices): void 
		{
			$this->choices = $choices;
		}
	}
