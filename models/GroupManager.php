<?php
namespace CPMF\Models;

use CPMF\Models\Entities\Group;
use CPMF\Models\Entities\Student;

class GroupManager
{
    public static function getByID(int $idClass): Group
    {
        $query = Manager::getDatabase()->prepare('SELECT * FROM Class WHERE idClass = :idClass');
        $query->execute(['idClass' => $idClass]);
        $rawGroup = $query->fetch();
        
        return new Group($rawGroup);
    }

    public static function getTeacherGroups(int $idTeacher): array 
    {
    	$groups = [];

		$query = Manager::getDatabase()->prepare('SELECT * from Class where idTeacher = :idTeacher');
		$query->execute(['idTeacher' => $idTeacher]);

		foreach($query->fetchAll() as $group) {
			$groups[] = new Group($group);
		}

		return $groups;
    }

	public static function getStudents(int $idClass): array
	{
		$students = [];
		
		$query = Manager::getDatabase()->prepare('SELECT idLogin from Student where idClass = :idClass');
		$query->execute(['idClass' => $idClass]);

		foreach($query->fetchAll() as $rawId) {
			$students[] = StudentManager::getByID($rawId['idLogin']);
		}

		return $students;
	}
}