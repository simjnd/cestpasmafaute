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

        $loginData = $loginQuery->fetch();

        return new Teacher($loginData);
	}

    public static function getWaitingStudents(): array
    {
        // TODO Arnaud
        Manager::getDatabase()->query('SELECT ...');
    }

}