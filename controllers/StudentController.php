<?php
namespace CPMF\Controller;

use \CPMF\Models\StudentManager;
use \CPMF\Models\StepManager;
use \CPMF\Models\GroupManager;
use \CPMF\Models\DecorationManager;

class StudentController extends Controller
{
    public function seeHomePage(): void
    {
        $validated = $_SESSION['validated'] ?? NULL;
        if ($validated) {
            $steps = StepManager::getStepsByStudentID($_SESSION['idLogin']);
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
        $student = StudentManager::getById($_SESSION['idLogin']);
        $student->fill();

        parent::view('student-profile', ['student' => $student, 'class' => $student->getGroup(), 'frames' => $frames, 'protraits' => $portraits, 'accessories' => $accessories]);
    }

    public function seeStep(int $id): void
    {
        $student = StudentManager::getByID($_SESSION['idLogin']);
        $step = StepManager::getStepByID($id);
        $exercices = StepManager::getExercicesByStepID($id);
        $totalPoints = StudentManager::getTotalPoints($_SESSION['idLogin']);
        $class = GroupManager::getByID($student->getIdClass());
        //TODO
        parent::view('studen-step', ['']);
    }
}
