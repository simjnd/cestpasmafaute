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

	public function getIdAccessory(int $idLogin): int
	{
		$req = $this->db->prepare('SELECT idAccessory FROM Student WHERE idLogin = :idLogin');
		$req->execute(array('idLogin' => $idLogin));
		return intval($req->fetch()['idAccessory']);
	}

	public function getIdPortrait(int $idLogin): int
	{
		$req = $this->db->prepare('SELECT idPortrait FROM Student WHERE idLogin = :idLogin');
		$req->execute(array('idLogin' => $idLogin));
		return intval($req->fetch()['idPortrait']);
	}

	public function getIdFrame(int $idLogin): int
	{
		$req = $this->db->prepare('SELECT idFrame FROM Student WHERE idLogin = :idLogin');
		$req->execute(array('idLogin' => $idLogin));
		return intval($req->fetch()['idFrame']);
	}

	public function getVerified(int $idLogin): boolean
	{
		$req = $this->db->prepare('SELECT verified FROM Student WHERE idLogin = :idLogin');
		$req->execute(array('idLogin' => $idLogin));
		return boolval($req->fetch()['verified']);
	}
}