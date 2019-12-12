<?php
namespace CPMF\Models;

class StepManager
{
	
	public static function getStepsByStudentID(int $idLogin): array
	{
    	$steps = [];
    	
    	$query = Manager::getDatabase()->prepare('SELECT Step.idStep AS idStep, Step.name AS name FROM Login, Student, Class, Course_Step, Step WHERE Login.idLogin = :idLogin AND Login.idLogin = Student.idLogin AND Student.idClass = Class.idClass AND Class.idCourse = Course_Step.idCourse AND Course_Step.idStep = Step.idStep');
    	$query->execute(['idLogin' => $idLogin]);
    	
    	foreach ($query->fetchAll() as $rawStep) {
        	$steps[] = new Step($rawStep);
    	}
    	
    	return $steps;
	}

    public static function getStepByID(int $idStep): Step
    {
        $query = Manager::getDatabase()->prepare('SELECT * FROM Step WHERE Step.idStep = :idStep');
        $query->execute(['idStep' => $idStep]);

        $stepData = $query->fetch();

        return new Step($stepData);
    }

    public static function getExercicesByStepID(int $idStep): array
    {
        $exercices[];

        $query = Manager::getDatabase()->prepare('SELECT Exercice.idExercice, Exercice.idDifficulty FROM Step, Step_Exercice, Exercice, Difficulty WHERE Step.idStep = :idStep AND Step.idStep = Step_Exercice.idStep AND Exercice.idExercice = Step_Exercice.idExercice AND Difficulty.idDifficulty = Exercice.idDifficulty');
        $query->execute(['idStep' => $idStep]);

        foreach ($query->fetchAll() as $rawExercice) {
            $exercices[] = new Exercice($rawExercice);
        }

        return $exercices;

    }
    
	
}