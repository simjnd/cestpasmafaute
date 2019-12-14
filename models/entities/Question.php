<?php
namespace CPMF\Models\Entities;

abstract class Question 
{
	private $id;
	private $sentence;

	public function __construct(int $id, string $sentence)
	{
		$this->id = $id;
		$this->sentence = $sentence;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getSentence(): string {
		return $this->sentence;
	}

	public abstract function getAnswer(): void;
}