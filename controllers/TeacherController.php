<?php
namespace CPMF\Controller;
use CPMF\Models\TeacherManager;
use CPMF\Models\StudentManager;

class TeacherController extends Controller
{

	public function seeHomePage(): void
	{
		$teacher = TeacherManager::getByID($_SESSION['idLogin']);
		$numberWaitingStudents = StudentManager::getWaitingStudents();
		$classes = GroupManager::getByID($_SESSION['idLogin']);

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

	/**
	* Accepts a student on hold.
	*/
	public function acceptWaitingStudent(int $idStudent): void
	{
		StudentManager::acceptWaitingStudent($idStudent);

		parent::redirect('/approval');
	}

	public function seeStudent(int $id): void
    {
        $teacher = TeacherManager::getByID($_SESSION['idLogin']);
        $student = StudentManager::getByID($id);
        $totalPoints = StudentManager::getTotalPoints($id);
        $globalAverage = StudentManager::getGlobalAverage($id);
        $group = GroupManager::getById($student->getIdClass());


        parent::view('teacher-see-student', ['student' => $student, 'teacher' => $teacher, 'group' => $group, 'totalPoints' => $totalPoints, 'globalAverage' => $globalAverage]);
    }
}
