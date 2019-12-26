<?php
namespace CPMF\Models;

use \CPMF\Models\Entities\Step;
use \CPMF\Models\Entities\ClickableQuestion;
use \CPMF\Models\Entities\MultipleQuestion;
use \CPMF\Models\Entities\PuzzleQuestion;
use \CPMF\Models\Entities\SimpleQuestion;
use \CPMF\Models\Entities\Question;
use \CPMF\Models\Entities\Exercice;

class StudentExerciceManager
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

        $lessonData = $query->fetch();

        return $lessonData;
    }

    public static function getExercicesByStepID(int $idStep): array
    {
        $exercices = [];

        $query = Manager::getDatabase()->prepare('SELECT Exercice.idExercice AS idExercice, Exercice.idDifficulty AS idDifficulty FROM Step, Step_Exercice, Exercice, Difficulty WHERE Step.idStep = :idStep AND Step.idStep = Step_Exercice.idStep AND Exercice.idExercice = Step_Exercice.idExercice AND Difficulty.idDifficulty = Exercice.idDifficulty');
        $query->execute(['idStep' => $idStep]);

        foreach ($query->fetchAll() as $rawExercice) {
            $exercices[] = new Exercice($rawExercice);
        }

        return $exercices;

    }

    public static function getAllQuestionsByExerciceID(int $idExercice): array 
    {

        $idsSimple = [];
        $idsPuzzle = [];
        $idsMultiple = [];
        $idsClickable = [];

        $allQuestions = [];

        $simpleQuery = Manager::getDatabase()->prepare('SELECT SimpleQuestion.idSimpleQuestion FROM SimpleQuestion, Exercice_SimpleQuest, Exercice WHERE Exercice = :idExercice AND Exercice.idExercice = Exercice_SimpleQuest.idExercice AND SimpleQuestion.idSimpleQuestion = Exercice_SimpleQuest.idSimpleQuestion');
        $simpleQuery->execute(['idExercice' => $idExercice]);

        foreach ($simpleQuery->fecthAll() as $rawSimpleId) {
            $idsSimple[] = $rawSimpleId;
        }

        $puzzleQuery = Manager::getDatabase()->prepare('SELECT PuzzleQuestion.idPuzzleQuestion FROM PuzzleQuestion, Exercice_PuzzleQuest, Exercice WHERE Exercice = :idExercice AND Exercice.idExercice = Exercice_PuzzleQuest.idExercice AND PuzzleQuestion.idPuzzleQuestion = Exercice_PuzzleQuest.idPuzzleQuestion');
        $puzzleQuery->execute(['idExercice' => $idExercice]);

        foreach ($puzzleQuery->fecthAll() as $rawPuzzleId) {
            $idsPuzzle[] = $rawPuzzleId;
        }

        $multipleQuery = Manager::getDatabase()->prepare('SELECT MultipleQuestion.idMultipleQuestion FROM MultipleQuestion, Exercice_MultipleQuest, Exercice WHERE Exercice = :idExercice AND Exercice.idExercice = Exercice_MultipleQuest.idExercice AND MultipleQuestion.idMultipleQuestion = Exercice_MultipleQuest.idMultipleQuestion');
        $multipleQuery->execute(['idExercice' => $idExercice]);

        foreach ($multipleQuery->fecthAll() as $rawMultipleId) {
            $idsMultiple[] = $rawMultipleId;
        }

        $clickableQuery = Manager::getDatabase()->prepare('SELECT ClickableQuestion.idClickableQuestion FROM ClickableQuestion, Exercice_ClickableQuest, Exercice WHERE Exercice = :idExercice AND Exercice.idExercice = Exercice_ClickableQuest.idExercice AND ClickableQuestion.idClickableQuestion = Exercice_ClickableQuest.idClickableQuestion');
        $clickableQuery->execute(['idExercice' => $idExercice]);

        foreach ($clickableQuery->fecthAll() as $rawClickableId) {
            $idsClickable[] = $rawClickableId;
        }

        foreach ($idsSimple as $idSimple) {
            $allQuestions[] = StudentExerciceManager::getSimpleQuestionByID($idSimple);
        }

        foreach ($idsPuzzle as $idPuzzle) {
           $allQuestions[] = StudentExerciceManager::getPuzzleQuestionByID($idPuzzle);
        }

        foreach ($idsMultiple as $idMultiple) {
            $allQuestions[] = StudentExerciceManager::getMultipleQuestionByID($idMultiple);
        }

        foreach ($idsClickable as $idClickable) {
            $allQuestions[] = StudentExerciceManager::getClickableQuestionByID($idClickable);
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