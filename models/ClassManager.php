<?php
namespace CPMF\Models;

class ClassManager
{
    public static function getByID(int $idClass): Class
    {
        $query = Manager::getDatabase()->prepare('SELECT * FROM Class WHERE idClass = :idClass');
        $query->execute(['idClass' => $idClass]);
        $rawClass = $query->fetch();
        return new Class($rawClass);
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