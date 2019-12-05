<?php
namespace CPMF\Models;

class StudentManager
{
	public static function getIdClass(int $idLogin): int
	{
		$req = Manager::getDatabase()->prepare('SELECT idClass FROM Student WHERE idLogin = :idLogin');
		$req->execute(array('idLogin' => $idLogin));
		return $req->fetch()['idClass'];
	}

	public static function setIdClass(int $idLogin, int $idClass): void
	{
		$req = Manager::getDatabase()->prepare('UPDATE Student SET idClass = :idClass WHERE idLogin = idLogin');
		$req->execute(array(
			'idClass' => $idClass,
			'idLogin' => $idLogin
		));
	}

	public static function getIdAccessory(int $idLogin): int
	{
		$req = Manager::getDatabase()->prepare('SELECT idAccessory FROM Student WHERE idLogin = :idLogin');
		$req->execute(array('idLogin' => $idLogin));
		return $req->fetch()['idAccessory'];
	}

	public static function setIdAccessory(int $idLogin, int $idAccessory): void
	{
		$req = Manager::getDatabase()->prepare('UPDATE Student SET idAccessory = :idAccessory WHERE idLogin = :idLogin');
		$req->execute(array(
			'idAccessory' => $idAccessory,
			'idLogin' => $idLogin
		));
	}

	public static function getIdPortrait(int $idLogin): int
	{
		$req = Manager::getDatabase()->prepare('SELECT idPortrait FROM Student WHERE idLogin = :idLogin');
		$req->execute(array('idLogin' => $idLogin));
		return $req->fetch()['idPortrait'];
	}

	public static function setIdPortrait(int $idLogin, int $idPortrait): void
	{
		$req = Manager::getDatabase()->prepare('UPDATE Student SET idPortrait = :idPortrait WHERE idLogin = idLogin');
		$req->execute(array(
			'idPortrait' => $idPortrait,
			'idLogin' => $idLogin
		));
	}

	public static function getIdFrame(int $idLogin): int
	{
		$req = Manager::getDatabase()->prepare('SELECT idFrame FROM Student WHERE idLogin = :idLogin');
		$req->execute(array('idLogin' => $idLogin));
		return $req->fetch()['idFrame'];
	}

	public static function setIdFrame(int $idLogin, int $idFrame): void
	{
		$req = Manager::getDatabase()->prepare('UPDATE Student SET idFrame = :idFrame WHERE idLogin = idLogin');
		$req->execute(array(
			'idFrame' => $idFrame,
			'idLogin' => $idLogin
		));
	}

	public static function getVerified(int $idLogin): boolean
	{
		$req = Manager::getDatabase()->prepare('SELECT verified FROM Student WHERE idLogin = :idLogin');
		$req->execute(array('idLogin' => $idLogin));
		return $req->fetch()['verified'];
	}

	public static function setIdClass(int $idLogin, boolean $verified): void
	{
		$req = Manager::getDatabase()->prepare('UPDATE Student SET verified = :verified WHERE idLogin = idLogin');
		$req->execute(array(
			'verified' => $verified,
			'idLogin' => $idLogin
		));
	}

	public static function getLastConnection(int $idLogin): int
	{
		$req = Manager::getDatabase()->prepare('SELECT lastConnection FROM Student WHERE idLogin = :idLogin');
		$req->execute(array('idLogin' => $idLogin));
		return $req->fetch()['lastConnection'];
	}

	public static function setLastConnection(int $idLogin): void
	{
		$req = Manager::getDatabase()->prepare('UPDATE Student SET lastConnection = NOW() WHERE idLogin = :idLogin');
		$req->execute(array('idLogin' => $idLogin));
	}

	public static function setTotalTimeConnection(int $idLogin): void
	{
		$date = new DateTime();
		$timeConnection = $date->getTimestamp() - $this->getLastConnection($idLogin);
		$req = Manager::getDatabase()->prepare('UPDATE Student SET totalTimeConnection = totalTimeConnection + :timeConnection WHERE idLogin = :idLogin');
		$req->execute(array(
			'timeConnection' => $timeConnection,
			'idLogin' => $idLogin
		));
	}

	public static function getTotalPoints(int $idLogin): int
	{
		$req = Manager::getDatabase()->prepare('SELECT SUM(points) AS totalPoints FROM Student_Exercise WHERE idLogin = :idLogin GROUP BY idLogin');
		$req->execute(array('idLogin' => $idLogin));
		return $req->fetch()['totalPoints'];
	}
	
	public static function getGlobalAverage(int $idLogin): float
	{
    	$req = Manager::getDatabase()->prepare('SELECT ROUND(AVG(pointsLastTry), 2) AS globalAverage FROM Student_Exercise WHERE idLogin = :idLogin GROUP BY idLogin');
    	$req->execute(array('idLogin' => $idLogin));
    	return $req->fetch()['globalAverage'];
	}
	
	public static function getStepAverage(int $idLogin, int $idStep): float
	{
    	$req = Manager::getDatabase()->prepare('SELECT ROUND(AVG(pointsLastTry), 2) AS stepAverage FROM Student_Exercise, Step_Exercise WHERE Step_Exercise.idExercise = Student_Exercise.idExercise AND idLogin = :idLogin AND idStep = :idStep');
    	$req->execute(array(
    	    'idLogin' => $idLogin,
    	    'idStep' => $idStep
        ));
    	return $req->fetch()['stepAverage'];
	}
	
	public static function getPointsLastTry(int $idLogin, int $idExercise): int
	{
    	$req = Manager::getDatabase()->prepare('SELECT pointsLastTry FROM Student_Exercise WHERE idLogin = :idLogin AND idExercise = :idExercise');
    	$req->execute(array(
        	'idLogin' => $idLogin,
        	'idExercise' => $idExercise
    	));
    	return $req->fetch()['pointsLastTry'];
	}
	
}