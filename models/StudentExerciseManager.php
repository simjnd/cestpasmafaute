<?php
namespace CPMF\Models;

use \CPMF\Models\Entities\Step;

use \CPMF\Models\Entities\Question;
use \CPMF\Models\Entities\Exercise;
use \CPMF\Models\Entities\ClickableQuestion;
use \CPMF\Models\Entities\MultipleQuestion;
use \CPMF\Models\Entities\PuzzleQuestion;
use \CPMF\Models\Entities\SimpleQuestion;
use \CPMF\Models\Entities\Role;
use \CPMF\Models\Entities\Choice;

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

    public static function getExerciseById(int $idExercise, bool $fill = false): Exercise
    {
        $exerciseReq = Manager::getDatabase()->prepare('SELECT idExercise, idDifficulty AS Difficulty FROM Exercise WHERE idExercise = :idExercise');
        $exerciseReq->execute(['idExercise' => $idExercise]);
        $exerciseData = $exerciseReq->fetch();

        $exercise = new Exercise($exerciseData);

        if($fill) {
            $exercise->setQuestions(self::getAllQuestionsByExerciseId($idExercise));
        }

        return $exercise;
    }

    public static function getAllQuestionsByExerciseId(int $idExercise): array 
    {
        $exercise = self::getExerciseById($idExercise);

        $questions = [];

        $simpleQuery = Manager::getDatabase()->prepare('SELECT idSimpleQuestion FROM Exercise_SimpleQuest WHERE idExercise = :idExercise');
        $simpleQuery->execute(['idExercise' => $idExercise]);

        foreach ($simpleQuery->fetchAll() as $rawSimple) {
            $questions[] = self::getSimpleQuestionById($rawSimple['idSimpleQuestion']);
        }

        $puzzleQuery = Manager::getDatabase()->prepare('SELECT idPuzzleQuestion FROM Exercise_PuzzleQuest WHERE idExercise = :idExercise');
        $puzzleQuery->execute(['idExercise' => $idExercise]);

        foreach ($puzzleQuery->fetchAll() as $rawPuzzle) {
            $questions[] = self::getPuzzleQuestionById($rawPuzzle['idPuzzleQuestion']);
        }

        $multipleQuery = Manager::getDatabase()->prepare('SELECT idMultipleQuestion FROM Exercise_MultipleQuest WHERE idExercise = :idExercise');
        $multipleQuery->execute(['idExercise' => $idExercise]);

        foreach ($multipleQuery->fetchAll() as $rawMultiple) {
            $questions[] = self::getMultipleQuestionById($rawMultiple['idMultipleQuestion']);
        }

        $clickableQuery = Manager::getDatabase()->prepare('SELECT idClickableQuestion FROM Exercise_ClickableQuest WHERE idExercise = :idExercise');
        $clickableQuery->execute(['idExercise' => $idExercise]);

        foreach ($clickableQuery->fetchAll() as $rawClickable) {
            $questions[] = self::getClickableQuestionById($rawClickable['idClickableQuestion']);
        }

        return $questions;
    }

    public static function getClickableQuestionById(int $idClickableQuestion): ClickableQuestion 
    {
        $questionQuery = Manager::getDatabase()->prepare('SELECT idClickableQuestion AS idQuestion, sentence, answerIndex FROM ClickableQuestion WHERE idClickableQuestion = :idClickableQuestion');
        $questionQuery->execute(['idClickableQuestion' => $idClickableQuestion]);

        $questionData = $questionQuery->fetch();

        return new ClickableQuestion($questionData);
    }

    public static function getMultipleQuestionById(int $idMultipleQuestion): MultipleQuestion 
    {
        $choices = [];

        $questionQuery = Manager::getDatabase()->prepare('SELECT idMultipleQuestion AS idQuestion, sentence FROM MultipleQuestion WHERE idMultipleQuestion = :idMultipleQuestion');
        $questionQuery->execute(['idMultipleQuestion' => $idMultipleQuestion]);

        $questionData = $questionQuery->fetch();

        $multipleQuestion = new MultipleQuestion($questionData);

        $choicesQuery = Manager::getDatabase()->prepare('SELECT * FROM Choice WHERE idMultipleQuestion = :idMultipleQuestion');
        $choicesQuery->execute(['idMultipleQuestion' => $idMultipleQuestion]);

        foreach ($choicesQuery->fetchAll() as $rawChoice) {
            $choices[] = new Choice($rawChoice);
        }

        $multipleQuestion->setChoices($choices);

        return $multipleQuestion;
    }

    public static function getPuzzleQuestionById(int $idPuzzleQuestion): PuzzleQuestion
    {
        $questionQuery = Manager::getDatabase()->prepare('SELECT idPuzzleQuestion AS idQuestion, sentence FROM PuzzleQuestion WHERE idPuzzleQuestion = :idPuzzleQuestion');
        $questionQuery->execute(['idPuzzleQuestion' => $idPuzzleQuestion]);

        $questionData = $questionQuery->fetch();

        $puzzleQuestion = new PuzzleQuestion($questionData);

        $roles = [];

        $puzzleQuery = Manager::getDatabase()->prepare('SELECT * FROM PuzzleQuest_Role WHERE idPuzzleQuestion = :idPuzzleQuestion');
        $puzzleQuery->execute(['idPuzzleQuestion' => $idPuzzleQuestion]);

        foreach($puzzleQuery->fetchAll() as $rawRole) {
            $startMarker = $rawRole['startMarker'];
            $endMarker = $rawRole['endMarker'];

            $roleQuery = Manager::getDatabase()->prepare('SELECT label FROM Role WHERE idRole = :idRole');
            $roleQuery->execute(['idRole' => $rawRole['idRole']]);
            $roleLabel = $roleQuery->fetch()['label'];

            $roleQuery->closeCursor();
            
            $roles[] = new Role([
                'idRole' => $rawRole['idRole'],
                'startMarker' => $rawRole['startMarker'],
                'endMarker' => $rawRole['endMarker'],
                'label' => $roleLabel
            ]);
        }

        $puzzleQuestion->setRoles($roles);

        return $puzzleQuestion;
    }

    public static function getSimpleQuestionById(int $idSimpleQuestion): SimpleQuestion
    {
        $questionQuery = Manager::getDatabase()->prepare('SELECT idSimpleQuestion AS idQuestion, sentence, correctAnswer, wordToWrite FROM SimpleQuestion WHERE idSimpleQuestion = :idSimpleQuestion');
        $questionQuery->execute(['idSimpleQuestion' => $idSimpleQuestion]);

        $questionData = $questionQuery->fetch();

        return new SimpleQuestion($questionData);
    }
}