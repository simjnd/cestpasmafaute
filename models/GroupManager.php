<?php
namespace CPMF\Models;

use \CPMF\Models\Entities\Group;

class GroupManager
{
    public static function getByID(int $idClass): Group
    {
        $query = Manager::getDatabase()->prepare('SELECT * FROM Class WHERE idClass = :idClass');
        $query->execute(['idClass' => $idClass]);
        $rawClass = $query->fetch();
        return new Group($rawClass);
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