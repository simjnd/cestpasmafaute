<?php
namespace CPMF\Models\Entities;

class Difficulty extends Model
{
	private $idDifficulty;
	private $label;

	public function __construct(array $data)
    {
        parent::__construct($data);
    } 

    protected function callFunction(string $methodName, ?string $value = ""): void
    {
        if(method_exists($this, $methodName)) {
            $this->$methodName($value);
        }   
    }

	public function getId(): int
	{
		return $this->id;
	}

	public function getName(): string
	{
		return $this->label;
	}

	public function setId(int $idDifficulty): void
	{
		$this->idDifficulty = $idDifficulty;
	}

	public function setLabel(string $label): void
	{
		$this->label = $label;
	}
}
