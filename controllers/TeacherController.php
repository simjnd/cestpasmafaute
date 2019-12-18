<?php
namespace CPMF\Controller;
use CPMF\Models\TeacherManager;

class TeacherController extends Controller
{

	public function seeHomePage(): void
	{
		$teacher = TeacherManager::getByID($_SESSION['idLogin']);
		$numberWaitingStudents = StudentManager::getWaitingStudents();
		$classes = GroupManager::getByID($_SESSION['idLogin']);

		parent::view('teacher-home', ['teacher' => $teacher, 'numberWaitingStudents' => $numberWaitingStudents, 'classes' => $classes]);
	}

	public function seeWaitingStudents(): void
	{
		// TODO Arnaud
	}

	public function seeStudent(int $id): void
    {
        $teacher = TeacherManager::getById($_SESSION['idLogin']);
        $student = StudentManager::getById($id);
        $totalPoints = StudentManager::getTotalPoints($id);
        $globalAverage = StudentManager::getGlobalAverage($id);
        $group = GroupManager::getById($student->getIdClass());


        parent::view('teacher-see-student', ['student' => $student, 'teacher' => $teacher, 'group' => $group, 'totalPoints' => $totalPoints, 'globalAverage' => $globalAverage]);
    }
}
