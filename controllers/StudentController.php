<?php
namespace CPMF\Controller;

use \CPMF\Models\StudentManager;
use \CPMF\Models\StepManager;
use \CPMF\Models\ClassManager;
use \CPMF\Models\DecorationManager;

class StudentController extends Controller
{
    public function seeClass(): void
    {
        $student = StudentManager::getByID($_SESSION['idLogin']);
        $class = ClassManager::getByID($student->getIdClass());
        $classmates = ClassManager::getStudents($student->getIdClass());

        parent::view('student-see-class', ['student' => $student, 'class' => $class, 'classmates' => $classmates]);
    }

     public function seeProfile(): void
    {
        $student = StudentManager::getById($_SESSION['idLogin']);
        $class = ClassManager::getById($student->getIdClass());
        $frames = DecorationManager::unlockedFrame($student->getIdLogin());
        $portraits = DecorationManager::unlockedPortrait($student->getIdLogin());
        $accessories = DecorationManager::unlockedAccessory($student->getIdLogin());

        parent::view('student-profile', ['student' => $student, 'class' => $class, 'frames' => $frames, 'protraits' => $portraits, 'accessories' => $accessories]);
    }

    public function seeHomepage(): void
    {
        $steps = StepManager::getStepsByStudentID($_SESSION['idLogin']);
        $student = StudentManager::getByID($_SESSION['idLogin']);
        $totalPoints = StudentManager::getTotalPoints($_SESSION['idLogin']);

        parent::view('student-home', ['steps' => $steps, 'student' => $student, 'totalPoints' => $totalPoints]);
    }

    public function seeStep(int $id): void
    {

    }
}
