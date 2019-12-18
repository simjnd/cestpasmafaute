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
        $queryStep = Manager::getDatabase()->prepare('SELECT idStep, name FROM Step WHERE idStep = :idStep');
        $queryStep->execute(['idStep' => $idStep]);

        $stepData = $queryStep->fetch();

        return new Step($stepData);
    }

    public static function getExercicesByStepID(int $idStep): array
    {
        $exercices[];

        $query = Manager::getDatabase()->prepare('SELECT Exercice.idExercice AS idExercice, Exercice.idDifficulty AS idDifficulty FROM Step, Step_Exercice, Exercice, Difficulty WHERE Step.idStep = :idStep AND Step.idStep = Step_Exercice.idStep AND Exercice.idExercice = Step_Exercice.idExercice AND Difficulty.idDifficulty = Exercice.idDifficulty');
        $query->execute(['idStep' => $idStep]);

        foreach ($query->fetchAll() as $rawExercice) {
            $exercices[] = new Exercice($rawExercice);
        }

        return $exercices;

    }

    public static function getLessonEasyByStepID(int $idStep): string
    {
        $query = Manager::getDatabase()->prepare('SELECT Step_Difficulty.lesson AS lessonEasy FROM Step_Difficulty WHERE Step_Difficulty.idStep = :idStep AND Step_Difficulty.idDifficulty = 0');
        $query->execute(['idStep' => $idStep]);

        $lessonData = $query->fetch();

        return $lessonData;
    }

    public static function getLessonMediumByStepID(int $idStep): string
    {
        $query = Manager::getDatabase()->prepare('SELECT Step_Difficulty.lesson AS lessonEasy FROM Step_Difficulty WHERE Step_Difficulty.idStep = :idStep AND Step_Difficulty.idDifficulty = 1');
        $query->execute(['idStep' => $idStep]);

        $lessonData = $query->fetch();

        return $lessonData;
    }

    public static function getLessonHardByStepID(int $idStep): string
    {
        $query = Manager::getDatabase()->prepare('SELECT Step_Difficulty.lesson AS lessonEasy FROM Step_Difficulty WHERE Step_Difficulty.idStep = :idStep AND Step_Difficulty.idDifficulty = 2');
        $query->execute(['idStep' => $idStep]);

        $lessonData = $query->fetch();

        return $lessonData;
    }

    public static function getClickableQuestionByID(int $idClickableQuestion): Question 
    {
        $query = Manager::getDatabase()->prepare('SELECT idClickableQuestion, sentence FROM ClickableQuestion WHERE idClickableQuestion = :idClickableQuestion');
        $query->execute(['idClickableQuestion' => $idClickableQuestion]);

        $questionData = $query->fecth();
        return new Question($questionData);
    }

    public static function getMultipleQuestionByID(int $idMultipleQuestion): Question 
    {
        $query = Manager::getDatabase()->prepare('SELECT idMultipleQuestion, sentence FROM MultipleQuestion WHERE idMultipleQuestion = :idMultipleQuestion');
        $query->execute(['idMultipleQuestion' => $idMultipleQuestion]);

        $questionData = $query->fecth();
        return new Question($questionData);
    }

    public static function getPuzzleQuestionByID(int $idPuzzleQuestion): Question 
    {
        $query = Manager::getDatabase()->prepare('SELECT idPuzzleQuestion, sentence FROM PuzzleQuestion WHERE idPuzzleQuestion = :idPuzzleQuestion');
        $query->execute(['idPuzzleQuestion' => $idPuzzleQuestion]);

        $questionData = $query->fecth();
        return new Question($questionData);
    }

    public static function getSimpleQuestionByID(int $idSimpleQuestion): Question
    {
        $query = Manager::getDatabase()->prepare('SELECT idSimpleQuestion, sentence FROM SimpleQuestion WHERE idSimpleQuestion = :idSimpleQuestion');
        $query->execute(['idSimpleQuestion' => $idSimpleQuestion]);

        $questionData = $query->fecth();
        return new Question($questionData);
    }
	
}