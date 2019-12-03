<?php
namespace CPMF\Models;

class StudentManager extends Manager
{
	public function getIdClass(int $idLogin): int
	{
		$req = $this->db->prepare('SELECT idClass FROM Student WHERE idLogin = :idLogin');
		$req->execute(array('idLogin' => $idLogin));
		return intval($req->fetch()['idClass']);
	}

	public function setIdClass(int $idLogin, int $idClass): void
	{
		$req = $this->db->prepare('UPDATE Student SET idClass = :idClass WHERE idLogin = idLogin');
		$req->execute(array(
			'idClass' => $idClass,
			'idLogin' => $idLogin
		));
	}

	public function getIdAccessory(int $idLogin): int
	{
		$req = $this->db->prepare('SELECT idAccessory FROM Student WHERE idLogin = :idLogin');
		$req->execute(array('idLogin' => $idLogin));
		return intval($req->fetch()['idAccessory']);
	}

	public function setIdAccessory(int $idLogin, int $idAccessory): void
	{
		$req = $this->db->prepare('UPDATE Student SET idAccessory = :idAccessory WHERE idLogin = :idLogin');
		$req->execute(array(
			'idAccessory' => $idAccessory,
			'idLogin' => $idLogin
		));
	}

	public function getIdPortrait(int $idLogin): int
	{
		$req = $this->db->prepare('SELECT idPortrait FROM Student WHERE idLogin = :idLogin');
		$req->execute(array('idLogin' => $idLogin));
		return intval($req->fetch()['idPortrait']);
	}

	public function setIdPortrait(int $idLogin, int $idPortrait): void
	{
		$req = $this->db->prepare('UPDATE Student SET idPortrait = :idPortrait WHERE idLogin = idLogin');
		$req->execute(array(
			'idPortrait' => $idPortrait,
			'idLogin' => $idLogin
		));
	}

	public function getIdFrame(int $idLogin): int
	{
		$req = $this->db->prepare('SELECT idFrame FROM Student WHERE idLogin = :idLogin');
		$req->execute(array('idLogin' => $idLogin));
		return intval($req->fetch()['idFrame']);
	}

	public function setIdFrame(int $idLogin, int $idFrame): void
	{
		$req = $this->db->prepare('UPDATE Student SET idFrame = :idFrame WHERE idLogin = idLogin');
		$req->execute(array(
			'idFrame' => $idFrame,
			'idLogin' => $idLogin
		));
	}

	public function getVerified(int $idLogin): boolean
	{
		$req = $this->db->prepare('SELECT verified FROM Student WHERE idLogin = :idLogin');
		$req->execute(array('idLogin' => $idLogin));
		return boolval($req->fetch()['verified']);
	}

	public function setIdClass(int $idLogin, boolean $verified): void
	{
		$req = $this->db->prepare('UPDATE Student SET verified = :verified WHERE idLogin = idLogin');
		$req->execute(array(
			'verified' => $verified,
			'idLogin' => $idLogin
		));
	}

	public function getLastConnection(int $idLogin): int
	{
		$req = $this->db->prepare('SELECT lastConnection FROM Student WHERE idLogin = :idLogin');
		$req->execute(array('idLogin' => $idLogin));
		return intval($req->fetch()['lastConnection']);
	}

	public function setLastConnection(int $idLogin): void
	{
		$req = $this->db->prepare('UPDATE Student SET lastConnection = NOW() WHERE idLogin = :idLogin');
		$req->execute(array('idLogin' => $idLogin));
	}

	public function setTotalTimeConnection(int $idLogin): void
	{
		$date = new DateTime();
		$timeConnection = $date->getTimestamp() - $this->getLastConnection($idLogin);
		$req = $this->db->prepare('UPDATE Student SET totalTimeConnection = totalTimeConnection + :timeConnection WHERE idLogin = :idLogin');
		$req->execute(array(
			'timeConnection' => $timeConnection,
			'idLogin' => $idLogin
		));
	}

	public function getTotalPoints(int $idLogin): int
	{
		$req = $this->db->prepare('SELECT SUM(points) AS totalPoints FROM Student_Exercise WHERE idLogin = :idLogin GROUP BY idLogin');
		$req->execute(array('idLogin' => $idLogin));
		return intval($req->fetch()['totalPoints']);
	}
	
	public function getGlobalAverage(int $idLogin): float
	{
    	$req = $this->db->prepare('SELECT ROUND(AVG(pointsLastTry), 2) AS globalAverage FROM Student_Exercise WHERE idLogin = :idLogin GROUP BY idLogin');
    	$req->execute(array('idLogin' => $idLogin));
    	return $req->fetch()['globalAverage'];
	}
	
	public function getStepAverage(int $idLogin, int $idStep): float
	{
    	$req = $this->db->prepare('SELECT ROUND(AVG(pointsLastTry), 2) AS stepAverage FROM Student_Exercise, Step_Exercise WHERE Step_Exercise.idExercise = Student_Exercise.idExercise AND idLogin = :idLogin AND idStep = :idStep');
    	$req->execute(array(
    	    'idLogin' => $idLogin,
    	    'idStep' => $idStep
        ));
    	return $req->fetch()['stepAverage'];
	}
	
	public function getPointsLastTry(int $idLogin, int $idExercise): int
	{
    	$req = $this->db->prepare('SELECT pointsLastTry FROM Student_Exercise WHERE idLogin = :idLogin AND idExercise = :idExercise');
    	$req->execute(array(
        	'idLogin' => $idLogin,
        	'idExercise' => $idExercise
    	));
    	return intval($req->fetch()['pointsLastTry']);
	}
	
}