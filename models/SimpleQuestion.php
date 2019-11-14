<?php
	namespace CPMF\Models;

	class SimpleQuestion extends Question
	{
		private $correctAnswer;
		private $word;

		public __construct(int $id, string $sentence, string $correctAnswer, string $word)
		{
			parent::__construct($id,$sentence);
			$this->correctAnswer = $correctAnswer;
			$this->word = $word;
		}

		public getCorrectAnswer(): string
		{
			return $this->correctAnswer;
		}

		public getWord(): string
		{
			return $this->word;
		}
	}
