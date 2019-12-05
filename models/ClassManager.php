<?php
namespace CPMF\Models;

class ClassManager
{
	public static function getName(int $idClass): string
	{
		$nameRequest = Manager::getDatabase()->prepare('select name from Class where idClass = :idClass');
		$nameRequest->execute(['idClass' => $idClass]);
		return $nameRequest->fetch()['name'];
	}

	public static function getIdCourse(int $idClass): int
	{
		$idCourseRequest = Manager::getDatabase()->prepare('select idCourse from Class where idClass = :idClass');
		$idCourseRequest->execute(['idClass' => $idClass]);
		return $idCourseRequest->fetch()['idCourse'];
	}

	public static function getIdTeacher(int $idClass): string
	{
		$idTeacherRequest = Manager::getDatabase()->prepare('select idTeacher from Class where idClass = :idClass');
		$idTeacherRequest->execute(['idClass' => $idClass]);
		return $idTeacherRequest->fetch()['idTeacher'];
	}

	public static function getStudents(int $idClass): array
	{
		$students = [];
		$studentsRequest = Manager::getDatabase()->prepare('select idLogin from Student where idClass = :idClass');
		$studentsRequest->execute(['idClass' => $idClass]);

		foreach($studentsRequest->fetchAll() as $rawStudent) {
			$students[] = StudentManager::getStudent($rawStudent);
		}

		return $students;
	}
}