<?php
namespace CPMF\Models;

class DifficultyManager extends Manager
{
	public static function getIdDifficulties(): array
	{
		$difficulties = [];

		$request = Manager::getDatabas()->query('SELECT idDifficulty FROM Difficulty');
		foreach($request->fetchAll() as $difficulty){
			$difficulties[] = new Difficulty($difficulty);
		}
		return $difficulties;
	}
}