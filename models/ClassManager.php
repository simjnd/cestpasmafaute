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
		
		$query = Manager::getDatabase()->prepare('SELECT * from Student where idClass = :idClass');
		$query->execute(['idClass' => $idClass]);

		foreach($query->fetchAll() as $rawStudent) {
			$students[] = new Student($rawStudent);
		}

		return $students;
	}
}