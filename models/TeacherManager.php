<?php
namespace CPMF\Models;

use \CPMF\Models\Entities\User;
use \CPMF\Models\Entities\Teacher;

class TeacherManager
{
	public static function getByID(int $idLogin): Teacher
	{
    	$loginQuery = Manager::getDatabase()->prepare('SELECT * FROM Login WHERE idLogin = :idLogin');
        $loginQuery->execute(['idLogin' => $idLogin]);

        $loginData = $loginQuery->fetch();

        $teacherQuery = Manager::getDatabase()->prepare('SELECT * FROM Teacher WHERE idLogin = :idLogin');
        $teacherQuery->execute(['idLogin' => $idLogin]);
        
        $teacherData = $teacherQuery->fetch();
        
        $teacherData = array_merge($loginData, $teacherData);

        return new Teacher($teacherData);
	}

    public static function getWaitingStudents(): array
    {
        // TODO Arnaud
        Manager::getDatabase()->query('SELECT ');
    }

}