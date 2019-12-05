<?php
namespace CPMF\Controller;

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