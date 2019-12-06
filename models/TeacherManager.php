<?php
namespace CPMF\Models;

use \CPMF\Models\Entities\User;
use \CPMF\Models\Entities\Teacher;

class TeacherManager
{
	public static function getByID(int $idLogin): Teacher
	{
		$loginQuery = Manager::getDatabase()->prepare('select * from Login where idLogin = :idLogin');
        $loginQuery->execute(['idLogin' => $idLogin]);

        $loginData = $loginQuery->fetch();

        $teacherQuery = Manager::getDatabase()->prepare('select * from Teacher where idLogin = :idLogin');
        $teacherQuery->execute(['idLogin' => $idLogin]);
        
        $teacherData = $studentQuery->fetch();
        
        $teacherData = array_merge($loginData, $teacherData);

        return new Teacher($teacherData);
	}

}