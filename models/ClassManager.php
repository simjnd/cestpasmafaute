<?php
namespace CPMF\Models;

class ClassManager extends Manager
{
	public function getName(int $idClass): string
	{
		$nameRequest = $this->db->prepare('select name from Class where idClass = :idClass');
		$nameRequest->execute(['idClass' => $idClass]);
		return $nameRequest->fetch()['name'];
	}

	public function getIdCourse(int $idClass): int
	{
		$idCourseRequest = $this->db->prepare('select idCourse from Class where idClass = :idClass');
		$idCourseRequest->execute(['idClass' => $idClass]);
		return $idCourseRequest->fetch()['idCourse'];
	}

	public function getIdTeacher(int $idClass): string
	{
		$idTeacherRequest = $this->db->prepare('select idTeacher from Class where idClass = :idClass');
		$idTeacherRequest->execute(['idClass' => $idClass]);
		return $idTeacherRequest->fetch()['idTeacher'];
	}

	public function getStudents(int $idClass): array
	{
		$students = [];
		$studentsRequest = $this->db->prepare('select idLogin from Student where idClass = :idClass');
		$studentsRequest->execute(['idClass' => $idClass]);

		$studentManager = new StudentManager();

		foreach($studentsRequest->fetchAll() as $rawStudent) {
			$students[] = $studentManager->getStudent($rawStudent);
		}

		return $students;
	}
}