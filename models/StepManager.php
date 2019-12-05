<?php
namespace CPMF\Models;

class StepManager
{
	
	public static function getStepsByStudentID(int $idLogin): array
	{
    	$steps = [];
    	
    	$query = Manager::getDatabase()->prepare('SELECT Step.idStep AS idStep, Step.name AS name FROM Login, Student, Class, Course_Step, Step WHERE Login.idLogin = :idLogin AND Login.idLogin = Student.idLogin AND Student.idClass = Class.idClass AND Class.idCourse = Course_Step.idCourse AND Course_Step.idStep = Step.idStep');
    	$query->execute(['idLogin' => $idLogin]);
    	
    	foreach ($query->fetchAll() as $step) {
        	$steps[] = new Step($step);
    	}
    	
    	return $steps;
	}
	
}