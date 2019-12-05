<?php
namespace CPMF\Controller;

use \CPMF\Models\StudentManager;
use \CPMF\Models\StepManager;

class StudentController extends Controller
{
    public function seeClass(): void
    {
        parent::view('student-see-class');
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
        //$student = 
    }
}