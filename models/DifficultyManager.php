<?php
namespace CPMF\Models;

use \CPMF\Models\Entities\Difficulty;

class DifficultyManager extends Manager
{
	public static function getDifficulties(): array
	{
		$difficulties = [];

		$request = Manager::getDatabase()->query('SELECT * FROM Difficulty');
		foreach($request->fetchAll() as $difficultyRaw){
			$difficulties[] = new Difficulty($difficultyRaw);
		}
		return $difficulties;
	}

	public static function getDifficultyById(int $idDifficulty): Difficulty
	{
		$difficultyQuery = Manager::getDatabase()->prepare('SELECT * FROM Difficulty WHERE idDifficulty = :idDifficulty');
		$difficultyQuery->execute(['idDifficulty' => $idDifficulty]);

		return new Difficulty($difficultyQuery->fetch());
	}
}