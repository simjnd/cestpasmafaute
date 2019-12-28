<?php
namespace CPMF\Controller;

use \CPMF\Models\StudentManager;
use \CPMF\Models\StudentExerciseManager;
use \CPMF\Models\GroupManager;
use \CPMF\Models\DecorationManager;

class StudentController extends Controller
{
    public function seeHomePage(): void
    {
        $validated = $_SESSION['validated'] ?? NULL;
        if ($validated) {
            $steps = StudentExerciseManager::getStepsByStudentID($_SESSION['idLogin']);
            $student = StudentManager::getByID($_SESSION['idLogin']);
            $totalPoints = StudentManager::getTotalPoints($_SESSION['idLogin']);

            parent::view('student-home', ['steps' => $steps, 'student' => $student, 'totalPoints' => $totalPoints]);
        } else {
            parent::view('student-home-validation');    
        }
    }

    public function seeClass(): void
    {
        $student = StudentManager::getByID($_SESSION['idLogin']);
        $class = GroupManager::getByID($student->getIdClass());
        $classmates = GroupManager::getStudents($student->getIdClass());

        parent::view('student-see-class', ['student' => $student, 'class' => $class, 'classmates' => $classmates]);
    }

    public function seeProfile(): void
    {
        $student = StudentManager::getByID($_SESSION['idLogin']);
        $student->fill();

        parent::view('student-profile', ['student' => $student, 'class' => $student->getGroup(), 'frames' => $frames, 'protraits' => $portraits, 'accessories' => $accessories]);
    }

    public function seeStep(int $id): void
    {
        $student = StudentManager::getByID($_SESSION['idLogin']);
        $step = StudentExerciseManager::getStepByID($id);
        $step->fillLessons();
        $lessons = $step->getLessons();
        $totalPoints = StudentManager::getTotalPoints($_SESSION['idLogin']);
        $group = GroupManager::getByID($student->getIdClass());
        parent::view('student-step', ['student' => $student, 'step' => $step, 'lessons' => $lessons, 'totalPoints' => $totalPoints, 'group' => $group]);
    }

    public function seeExercise(int $idStep, int $idDifficulty): void
    {
        $step = StudentExerciseManager::getStepByID($idStep);
        $step->fillExercises();
        $Exercises = $step->getExercises();
        print_r($Exercises);
        foreach ($Exercises as $Exercise) {
            if ($Exercise->getDifficulty() === $idDifficulty) {
                $Exercise->fill(); // Récupère toutes les questions de l'Exercise
                // Transférer les valeurs vers la vue qui gère les vues de tous les types de question
            }
            exit;
        }
    }
}
