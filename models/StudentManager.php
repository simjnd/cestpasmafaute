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

	public function getLastConnexion(int $idLogin): int
	{
		$req = $this->db->prepare('SELECT lastConnexion FROM Student WHERE idLogin = :idLogin');
		$req->execute(array('idLogin' => $idLogin));
		return intval($req->fetch()['lastConnexion']);
	}

	public function setLastConnexion(int $idLogin): void
	{
		$req = $this->db->prepare('UPDATE Student SET lastConnexion = NOW() WHERE idLogin = :idLogin');
		$req->execute(array('idLogin' => $idLogin));
	}

	public function setTotalTimeConnexion(int $idLogin): void
	{
		$date = new DateTime();
		$timeConnexion = $date->getTimestamp() - $this->getLastConnexion($idLogin);
		$req = $this->db->prepare('UPDATE Student SET totalTimeConnexion = totalTimeConnexion + :timeConnexion WHERE idLogin = :idLogin');
		$req->execute(array(
			'totalTimeConnexion' => $totalTimeConnexion,
			'idLogin' => $idLogin
		));
	}

	public function getPoints(int $idLogin): int
	{
		$req = $this->db->prepare('SELECT SUM(points) AS nbTotalPoints FROM Student_Exercise WHERE idLogin = :idLogin GROUP BY idLogin');
		$req->execute(array('idLogin' => $idLogin));
		return intval($req->fetch()['nbTotalPoints']);
	}
}