<?php
namespace CPMF\Controller;

use CPMF\Models\TeacherManager;
use CPMF\Models\StudentManager;
use CPMF\Models\GroupManager;
use CPMF\Models\DifficultyManager;

class TeacherController extends Controller
{

	public function seeHomePage(): void
	{
		$teacher = TeacherManager::getByID($_SESSION['idLogin']);
		$numberWaitingStudents = count(StudentManager::getWaitingStudents());
		$classes = GroupManager::getTeacherGroups($_SESSION['idLogin']);
		foreach($classes as $class) $class->fill();

		parent::view('teacher-home', ['teacher' => $teacher, 'numberWaitingStudents' => $numberWaitingStudents, 'classes' => $classes]);
	}

	/**
    * Displays the list of students awaiting validation
    */
	public function seeWaitingStudents(): void
	{
		$teacher = TeacherManager::getByID($_SESSION['idLogin']);
		$waitingStudents = StudentManager::getWaitingStudents();

		parent::view('teacher-see-waiting-students', ['waitingStudents' => $waitingStudents, 'teacher' => $teacher]);
	}

	public function seeClass(int $idClass): void
	{
		// TODO: Checker si le teacher a bien le droit de consulter la classe
		$teacher = TeacherManager::getByID($_SESSION['idLogin']);
		$class = GroupManager::getByID($idClass);
		$class->fill();
		$examinations = []; // TODO
		parent::view('teacher-see-class', ['teacher' => $teacher, 'class' => $class, 'students' => $class->getStudents(), 'examinations' => $examinations]);
	}

	/**
	* Accepts a student on hold.
	*/
	public function acceptWaitingStudent(int $idStudent): void
	{
		StudentManager::acceptWaitingStudent($idStudent);

		parent::redirect('/approval');
	}

	public function deleteWaitingStudent(int $idStudent): void
	{
		StudentManager::deleteWaitingStudent($idStudent);

		parent::redirect('/approval');
	}

	public function seeStudent(int $id): void
    {
        $teacher = TeacherManager::getByID($_SESSION['idLogin']);
        $student = StudentManager::getByID($id);
        $totalPoints = StudentManager::getTotalPoints($id);
        $globalAverage = StudentManager::getGlobalAverage($id);
        $group = GroupManager::getById($student->getIdClass());
        $difficulties = DifficultyManager::getDifficulties();


        parent::view('teacher-see-student', ['student' => $student, 'teacher' => $teacher, 'group' => $group, 'totalPoints' => $totalPoints, 'globalAverage' => $globalAverage, 'difficulties' => $difficulties]);
    }
}
