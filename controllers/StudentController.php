<?php
namespace CPMF\Controller;

class StudentController extends Controller
{
    public function seeClass(): void
    {
        parent::view('student-see-class');
    }
    
    public function seeProfile(): void
    {
        
    }
    
    public function seeHomepage(): void
    {
        $steps = StepManager::getStepsByStudentID($_SESSION['idLogin']);
        $student = 
    }
}