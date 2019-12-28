<?php
namespace CPMF\Models;

use \CPMF\Models\Entities\Step;
use \CPMF\Models\Entities\ClickableQuestion;
use \CPMF\Models\Entities\MultipleQuestion;
use \CPMF\Models\Entities\PuzzleQuestion;
use \CPMF\Models\Entities\SimpleQuestion;
use \CPMF\Models\Entities\Question;
use \CPMF\Models\Entities\Exercise;

class StudentExerciseManager
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

    public static function getLessonByStepAndDifficultyID(int $idStep, int $idDifficulty): string
    {
        $query = Manager::getDatabase()->prepare('SELECT Step_Difficulty.lesson AS lesson FROM Step_Difficulty WHERE Step_Difficulty.idStep = :idStep AND Step_Difficulty.idDifficulty = :idDifficulty');
        $query->execute(['idStep' => $idStep, 'idDifficulty' => $idDifficulty]);

        $lessonData = $query->fetch()['lesson'];

        return $lessonData;
    }

    public static function getExercisesByStepID(int $idStep): array
    {
        $exercises = [];

        $query = Manager::getDatabase()->prepare('SELECT Exercise.idExercise AS idExercise, Exercise.idDifficulty AS idDifficulty FROM Step_Exercise, Exercise WHERE Step_Exercise.idStep = :idStep AND Step_Exercise.idExercise = Exercise.idExercise ORDER BY Exercise.idDifficulty');
        $query->execute(['idStep' => $idStep]);

        foreach ($query->fetchAll() as $rawExercise) {
            print_r($rawExercise);
            $exercises[] = new Exercise($rawExercise);
        }

        return $exercises;

    }

    public static function getAllQuestionsByExerciseID(int $idExercise): array 
    {

        $idsSimple = [];
        $idsPuzzle = [];
        $idsMultiple = [];
        $idsClickable = [];

        $allQuestions = [];

        $simpleQuery = Manager::getDatabase()->prepare('SELECT SimpleQuestion.idSimpleQuestion FROM SimpleQuestion, Exercise_SimpleQuest, Exercise WHERE Exercise = :idExercise AND Exercise.idExercise = Exercise_SimpleQuest.idExercise AND SimpleQuestion.idSimpleQuestion = Exercise_SimpleQuest.idSimpleQuestion');
        $simpleQuery->execute(['idExercise' => $idExercise]);

        foreach ($simpleQuery->fecthAll() as $rawSimpleId) {
            $idsSimple[] = $rawSimpleId;
        }

        $puzzleQuery = Manager::getDatabase()->prepare('SELECT PuzzleQuestion.idPuzzleQuestion FROM PuzzleQuestion, Exercise_PuzzleQuest, Exercise WHERE Exercise = :idExercise AND Exercise.idExercise = Exercise_PuzzleQuest.idExercise AND PuzzleQuestion.idPuzzleQuestion = Exercise_PuzzleQuest.idPuzzleQuestion');
        $puzzleQuery->execute(['idExercise' => $idExercise]);

        foreach ($puzzleQuery->fecthAll() as $rawPuzzleId) {
            $idsPuzzle[] = $rawPuzzleId;
        }

        $multipleQuery = Manager::getDatabase()->prepare('SELECT MultipleQuestion.idMultipleQuestion FROM MultipleQuestion, Exercise_MultipleQuest, Exercise WHERE Exercise = :idExercise AND Exercise.idExercise = Exercise_MultipleQuest.idExercise AND MultipleQuestion.idMultipleQuestion = Exercise_MultipleQuest.idMultipleQuestion');
        $multipleQuery->execute(['idExercise' => $idExercise]);

        foreach ($multipleQuery->fecthAll() as $rawMultipleId) {
            $idsMultiple[] = $rawMultipleId;
        }

        $clickableQuery = Manager::getDatabase()->prepare('SELECT ClickableQuestion.idClickableQuestion FROM ClickableQuestion, Exercise_ClickableQuest, Exercise WHERE Exercise = :idExercise AND Exercise.idExercise = Exercise_ClickableQuest.idExercise AND ClickableQuestion.idClickableQuestion = Exercise_ClickableQuest.idClickableQuestion');
        $clickableQuery->execute(['idExercise' => $idExercise]);

        foreach ($clickableQuery->fecthAll() as $rawClickableId) {
            $idsClickable[] = $rawClickableId;
        }

        foreach ($idsSimple as $idSimple) {
            $allQuestions[] = StudentExerciseManager::getSimpleQuestionByID($idSimple);
        }

        foreach ($idsPuzzle as $idPuzzle) {
           $allQuestions[] = StudentExerciseManager::getPuzzleQuestionByID($idPuzzle);
        }

        foreach ($idsMultiple as $idMultiple) {
            $allQuestions[] = StudentExerciseManager::getMultipleQuestionByID($idMultiple);
        }

        foreach ($idsClickable as $idClickable) {
            $allQuestions[] = StudentExerciseManager::getClickableQuestionByID($idClickable);
        }

        return $allQuestions;
    }

    public static function getClickableQuestionByID(int $idQuestion): ClickableQuestion 
    {
        $questionQuery = Manager::getDatabase()->prepare('SELECT idClickableQuestion, sentence, answerIndex FROM ClickableQuestion WHERE idClickableQuestion = :idQuestion');
        $questionQuery->execute(['idQuestion' => $idQuestion]);

        $questionData = $questionQuery->fetch();

        return new ClickableQuestion($questionData);
    }

    public static function getMultipleQuestionByID(int $idQuestion): MultipleQuestion 
    {
        $choices = [];

        $questionQuery = Manager::getDatabase()->prepare('SELECT idMultipleQuestion, sentence FROM MultipleQuestion WHERE idMultipleQuestion = :idQuestion');
        $questionQuery->execute(['idQuestion' => $idQuestion]);

        $questionData = $questionQuery->fetch();

        $choicesQuery = Manager::getDatabase()->prepare('SELECT Choice.idChoice, Choice.label, Choice.isCorrectAnswer, Choice.idMultipleQuestion FROM Choice WHERE Choice.idMultipleQuestion = :idQuestion');
        $choicesQuery->execute(['idQuestion' => $idQuestion]);

        foreach ($choicesQuery->fetchAll() as $rawChoice) {
            $choices[] = new Choice($rawChoice);
        }

        $multipleData = array_merge($questionData, $choices);

        return new MultipleQuestion($multipleData);
    }

    public static function getPuzzleQuestionByID(int $idQuestion): PuzzleQuestion
    {
       $questionQuery = Manager::getDatabase()->prepare('SELECT idPuzzleQuestion, sentence FROM PuzzleQuestion WHERE idPuzzleQuestion = :idQuestion');
       $questionQuery->execute(['idQuestion' => $idQuestion]);

       $questionData = $questionQuery->fetch();

       $puzzleQuery = Manager::getDatabase()->prepare('SELECT PuzzleQuest_Role.idRole FROM PuzzleQuest_Role WHERE PuzzleQuest_Role.idPuzzleQuestion = :idQuestion');
       $puzzleQuery->execute(['idQuestion' => $idQuestion]);

       $puzzleData = $puzzleQuery->fetch();

       $puzzleData = array_merge($questionData, $puzzleData);

       return new PuzzleQuestion($puzzleData);
    }

    public static function getSimpleQuestionByID(int $idQuestion): SimpleQuestion
    {
        $questionQuery = Manager::getDatabase()->prepare('SELECT idSimpleQuestion, sentence, correctAnswer, wordToWrite FROM SimpleQuestion WHERE idSimpleQuestion = :idQuestion');
        $questionQuery->execute(['idQuestion' => $idQuestion]);

        $questionData = $questionQuery->fetch();

        return new SimpleQuestion($questionData);
    }


	
}