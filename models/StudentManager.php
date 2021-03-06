<?php
namespace CPMF\Models;

use \CPMF\Models\Entities\User;
use \CPMF\Models\Entities\Student;

class StudentManager
{
    public static function getByID(int $idLogin): Student
    {
        $loginQuery = Manager::getDatabase()->prepare('select * from Login where idLogin = :idLogin');
        $loginQuery->execute(['idLogin' => $idLogin]);

        $loginData = $loginQuery->fetch();

        $studentQuery = Manager::getDatabase()->prepare('select * from Student where idLogin = :idLogin');
        $studentQuery->execute(['idLogin' => $idLogin]);
        
        $studentData = $studentQuery->fetch();
        
        $studentData = array_merge($loginData, $studentData);

        return new Student($studentData);
    }

    public static function getStudentsByClass(int $idClass): array
    {
        $students = [];
        
        $query = Manager::getDatabase()->prepare('SELECT * FROM Student WHERE idClass = :idClass');
        $query->execute(['idClass' => $idClass]);
        
        foreach ($query->fetchAll() as $rawStudent) {
            $students[] = new Student($rawStudent);
        }
        
        return $students;
        
    }

    public static function isVerified(int $idLogin): bool
    {
    	$validatedRequest = Manager::getDatabase()->prepare('select verified from Student where idLogin = :idLogin');
    	$validatedRequest->execute(['idLogin' => $idLogin]);

    	$verified = $validatedRequest->fetch()['verified'];

    	return $verified === "1";
    }

	/**
    * Returns the list of students awaiting validation
    * @return array
    *   List of students
    */
    public static function getWaitingStudents(): array
    {
    	$waitingStudents = [];

    	$query = Manager::getDatabase()->query('SELECT * FROM Login l, Student s WHERE s.verified = 0 AND l.idLogin = s.idLogin ORDER BY l.lastName');

    	foreach ($query->fetchAll() as $waiting) {
    		$waitingStudents[] = new Student($waiting);
    	}

    	return $waitingStudents;
    }

    /**
	* Accepts a student awaiting validation
	*/
    public static function acceptWaitingStudent(int $idStudent): void
    {
    	$acceptWaitingStudentRequest = Manager::getDatabase()->prepare('UPDATE Student SET verified = 1 WHERE idLogin = :idStudent');
    	$acceptWaitingStudentRequest->execute(['idStudent' => $idStudent]);
    }

    /**
    * Delete a awaiting validation student
    */
    public function deleteWaitingStudent(int $idStudent):void
    {
    	$deleteWaitingStudentRequest = Manager::getDatabase()->prepare('DELETE FROM Student WHERE idLogin = :idStudent');
    	$deleteWaitingStudentRequest->execute(['idStudent' => $idStudent]);

    	$deleteWaitingStudentRequest = Manager::getDatabase()->prepare('DELETE FROM Login WHERE idLogin = :idStudent');
    	$deleteWaitingStudentRequest->execute(['idStudent' => $idStudent]);
    }

	public static function setIdClass(int $idLogin, int $idClass): void
	{
		$query = Manager::getDatabase()->prepare('UPDATE Student SET idClass = :idClass WHERE idLogin = idLogin');
		$query->execute(array(
			'idClass' => $idClass,
			'idLogin' => $idLogin
		));
	}

	public static function setIdAccessory(int $idLogin, int $idAccessory): void
	{
		$query = Manager::getDatabase()->prepare('UPDATE Student SET idAccessory = :idAccessory WHERE idLogin = :idLogin');
		$query->execute(array(
			'idAccessory' => $idAccessory,
			'idLogin' => $idLogin
		));
	}

	public static function setIdPortrait(int $idLogin, int $idPortrait): void
	{
		$query = Manager::getDatabase()->prepare('UPDATE Student SET idPortrait = :idPortrait WHERE idLogin = idLogin');
		$query->execute(array(
			'idPortrait' => $idPortrait,
			'idLogin' => $idLogin
		));
	}

	public static function setIdFrame(int $idLogin, int $idFrame): void
	{
		$query = Manager::getDatabase()->prepare('UPDATE Student SET idFrame = :idFrame WHERE idLogin = idLogin');
		$query->execute(array(
			'idFrame' => $idFrame,
			'idLogin' => $idLogin
		));
	}

	public static function setLastConnection(int $idLogin): void
	{
		$query = Manager::getDatabase()->prepare('UPDATE Student SET lastConnection = NOW() WHERE idLogin = :idLogin');
		$query->execute(array('idLogin' => $idLogin));
	}

	public static function setTotalTimeConnection(int $idLogin): void
	{
		$date = new DateTime();
		$timeConnection = $date->getTimestamp() - $this->getLastConnection($idLogin);
		$query = Manager::getDatabase()->prepare('UPDATE Student SET totalTimeConnection = totalTimeConnection + :timeConnection WHERE idLogin = :idLogin');
		$query->execute(array(
			'timeConnection' => $timeConnection,
			'idLogin' => $idLogin
		));
	}

	public static function getTotalPoints(int $idLogin): int
	{
		$query = Manager::getDatabase()->prepare('SELECT SUM(points) AS totalPoints FROM Student_Exercise WHERE idLogin = :idLogin GROUP BY idLogin');
		$query->execute(array('idLogin' => $idLogin));
		return $query->fetch()['totalPoints'] ?? 0;
	}
	
	public static function getGlobalAverage(int $idLogin): float
	{
    	$query = Manager::getDatabase()->prepare('SELECT ROUND(AVG(pointsLastTry), 2) AS globalAverage FROM Student_Exercise WHERE idLogin = :idLogin GROUP BY idLogin');
    	$query->execute(array('idLogin' => $idLogin));
    	return $query->fetch()['globalAverage'] ?? 0.0;
	}
	
	public static function getStepAverage(int $idLogin, int $idStep): float
	{
    	$query = Manager::getDatabase()->prepare('SELECT ROUND(AVG(pointsLastTry), 2) AS stepAverage FROM Student_Exercise, Step_Exercise WHERE Step_Exercise.idExercise = Student_Exercise.idExercise AND idLogin = :idLogin AND idStep = :idStep');
    	$query->execute(array(
    	    'idLogin' => $idLogin,
    	    'idStep' => $idStep
        ));
    	return $query->fetch()['stepAverage'] ?? 0.0;
	}
	
	public static function getPointsLastTry(int $idLogin, int $idExercise): int
	{
    	$query = Manager::getDatabase()->prepare('SELECT pointsLastTry FROM Student_Exercise WHERE idLogin = :idLogin AND idExercise = :idExercise');
    	$query->execute(array(
        	'idLogin' => $idLogin,
        	'idExercise' => $idExercise
    	));
    	return $query->fetch()['pointsLastTry'] ?? 0;
	}
	
}