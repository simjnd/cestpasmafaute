<?php
namespace CPMF\Models;

use \CPMF\Models\Entities\Difficulty;

class DifficultyManager extends Manager
{
	public static function getIdDifficulties(): array
	{
		$difficulties = [];

		$request = Manager::getDatabase()->query('SELECT idDifficulty FROM Difficulty');
		foreach($request->fetchAll() as $difficulty){
			$difficulties[] = new Difficulty($difficulty);
		}
		return $difficulties;
	}

	public static function getDifficultyById(int $idDifficulty): Difficulty
	{
		$difficultyQuery = Manager::getDatabase()->prepare('SELECT * FROM Difficulty WHERE idDifficulty = :idDifficulty');
		$difficultyQuery->execute(['idDifficulty' => $idDifficulty]);
		$difficultyData = $difficultyQuery->fetch();

		return new Difficulty($difficultyData);
	}
}