<?php
namespace CPMF\Controller;

class StudentController extends Controller
{
    public function seeProfile(int $id): void
    {   
        parent::view('student-see-class');
    }
}