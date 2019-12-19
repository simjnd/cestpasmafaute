<?php
namespace CPMF\Models;

use \CPMF\Models\Entities\User;
use \CPMF\Models\Entities\Teacher;

class TeacherManager
{
	public static function getByID(int $idLogin): Teacher
	{
    	$query = Manager::getDatabase()->prepare('SELECT * FROM Login WHERE idLogin = :idLogin');
        $query->execute(['idLogin' => $idLogin]);

        $loginData = $query->fetch();

        return new Teacher($loginData);
	}

    /**
    * Returns the list of students awaiting validation
    * @return array
    *   List of students
    */
    public static function getWaitingStudents(): array
    {
        $query = Manager::getDatabase()->query('SELECT * FROM Login l, Student s WHERE s.verified = 0 AND l.idLogin = s.idLogin ORDER BY l.lastName');

        $waitingStudents = array();

        while ($student = $query->fetch()) {
            array_push($waitingStudents, new Student($data));
        }

        return $waitingStudents;
    }

}