<?php
namespace CPMF\Controller;

class StudentController extends Controller
{
    public function seeClass(): void
    {
        parent::view('student-see-class');
    }
    
    public function seeProfile(int $idLogin): void
    {
        $student = StudentManager::getById($idLogin);
        parent::view('teacher-see-student', ['student' => $student]);
    }
    
    public function seeHomepage(): void
    {
        $steps = StepManager::getStepsByStudentID($_SESSION['idLogin']);
        $student = 
    }
}