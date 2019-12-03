<?php
namespace CPMF\Models;

abstract class DecorationManager extends Manager 
{

	private $tableName;

	public function __construct(string $tabname)
	{
		$this->tableName = $tabname;
	}

	public function getIdDecoration(int $idDecoration): int
	{
		$id = 'id' . $this->tableName;

		$req = $this->db->prepare("SELECT $id FROM $this->tableName WHERE  $id = :idDecoration");
		$req->execute(['idDecoration' => $idDecoration]);
		return intval($req->fetch()[$id]);
	}

	public function getLabelDecoration(int $idDecoration): string
	{
		$id = 'id' . $this->tableName;

		$req = $this->db->prepare("SELECT label FROM $this->tableName WHERE $id = :idDecoration");
		$req->execute(['idDecoration' => $idDecoration]);
		return intval($req->fetch()[$id]);

	}
	public function getFilePathDecoration(int $idDecoration): string
	{
		$id = 'id' . $this->tableName;

		$req = $this->db->prepare("SELECT filePath FROM $this->tableName WHERE $id = :idDecoration");
		$req->execute(['idDecoration' => $idDecoration]);
		return intval($req->fetch()[$id]);

	}

	public function getPointsRequiredDecoration(int $idDecoration): int
	{
		$id = 'id' . $this->tableName;

		$req = $this->db->prepare("SELECT pointsRequired FROM $this->tableName WHERE $id = :idDecoration");
		$req->execute(['idDecoration' => $idDecoration]);
		return intval($req->fetch()[$id]);
	}

	/*public function setIdDecoration(int $idDecoration): void
	{
		$id = 'id' . $this->tableName;

		$req = $this->db->prepare("UPDATE $this->tableName SET $id = :idDecoration");
		$req->execute(['idDecoration' => $idDecoration]);
		return intval($req->fetch()[$id]);
	}*/

	public function setLabelDecoration(string $label, int $idDecoration): void
	{
		$id = 'id' . $this->tableName;

		$req = $this->db->prepare("UPDATE $this->tableName SET label = :label WHERE $id = :idDecoration");
		$req->execute(['idDecoration' => $idDecoration, 'label' => $label]);
		return intval($req->fetch()[$id]);
	}

	public function setFilePathDecoration(string $filePath, int $idDecoration): void
	{
		$id = 'id' . $this->tableName;

		$req = $this->db->prepare("UPDATE $this->tableName SET filePath = :filePath WHERE $id = :idDecoration");
		$req->execute(['idDecoration' => $idDecoration, 'filePath' => $filePath]);
		return intval($req->fetch()[$id]);
	}

	public function setPointsRequiredDecoration(int $points, int $idDecoration): void
	{
		$id = 'id' . $this->tableName;

		$req = $this->db->prepare("UPDATE $this->tableName SET pointsRequired = :points WHERE $id = :idDecoration");
		$req->execute(['idDecoration' => $idDecoration, 'points' => $points]);
		return intval($req->fetch()[$id]);
	}
}

