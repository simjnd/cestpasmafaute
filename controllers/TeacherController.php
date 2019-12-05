<?php
namespace CPMF\Controller;

class TeacherController extends Controller
{
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
