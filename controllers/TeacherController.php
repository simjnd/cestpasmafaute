<?php
namespace CPMF\Controller;

class TeacherController extends Controller
{

	public function seeHome(): void
	{
		$teacher = TeacherManager::getByID($_SESSION['idLogin']);
		$numberWaitingStudents = StudentManager::getWaitingStudents();
		$classes = GroupManager::getByID($_SESSION['idLogin']);

		parent::view('teacher-home', 'teacher' => $teacher, 'numberWaitingStudents' => $numberWaitingStudents, 'classes' => $classes);
	}

	public function seeWaitingStudents(): void
	{
		parent::view('teacher-approve', [
			'waitingStudents' => [
				'Arnaud',
				'Guillaume',
				'Pierre', 
				'Simon'
			]
		]);
	}
}
