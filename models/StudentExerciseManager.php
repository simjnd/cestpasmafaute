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

    public static function getExerciseById(int $idExercise, bool $fill = true): Exercise
    {
        $exerciseReq = Manager::getDatabase()->prepare('SELECT * FROM Exercise WHERE idExercise = :idExercise');
        $exerciseReq->execute(['idExercise' => $idExercise]);
        $exerciseData = $exerciseReq->fetch();

        $exercise = new Exercise($exerciseData);
        if($fill) $exercise->fill();
        return $exercise;
    }

    public static function getAllQuestionsByExerciseID(int $idExercise): array 
    {
        $exercise = self::getExerciseById($idExercise);

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

    public static function getClickableQuestionByID(int $idClickableQuestion): ClickableQuestion 
    {
        $questionQuery = Manager::getDatabase()->prepare('SELECT * FROM ClickableQuestion WHERE idClickableQuestion = :idQuestion');
        $questionQuery->execute(['idClickableQuestion' => $idQuestion]);

        $questionData = $questionQuery->fetch();

        return new ClickableQuestion($questionData);
    }

    public static function getMultipleQuestionByID(int $idMultipleQuestion): MultipleQuestion 
    {
        $choices = [];

        $questionQuery = Manager::getDatabase()->prepare('SELECT * FROM MultipleQuestion WHERE idMultipleQuestion = :idQuestion');
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

    public static function getPuzzleQuestionByID(int $idPuzzleQuestion): PuzzleQuestion
    {
        $questionQuery = Manager::getDatabase()->prepare('SELECT * FROM PuzzleQuestion WHERE idPuzzleQuestion = :idPuzzleQuestion');
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
                'idRole' =>
                'startMarker' => $rawRole['startMarker'],
                'endRole' => $rawRole['endMarker'],
                'label' => $roleLabel
            ]);
        }

        $puzzleQuestion->setRoles($roles);

        return $puzzleQuestion;
    }

    public static function getSimpleQuestionByID(int $idSimpleQuestion): SimpleQuestion
    {
        $questionQuery = Manager::getDatabase()->prepare('SELECT * FROM SimpleQuestion WHERE idSimpleQuestion = :idSimpleQuestion');
        $questionQuery->execute(['idSimpleQuestion' => $idSimpleQuestion]);

        $questionData = $questionQuery->fetch();

        return new SimpleQuestion($questionData);
    }
}