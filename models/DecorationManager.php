<?php
namespace CPMF\Models;

class DecorationManager 
{

	private $tableName;

	public static function __construct(string $tabname)
	{
		$this->tableName = $tabname;
	}

	public static function getIdDecoration(int $idDecoration): int
	{
		$id = 'id' . $this->tableName;

		$req = Manager::getDatabase()->prepare("SELECT $id FROM $this->tableName WHERE  $id = :idDecoration");
		$req->execute(['idDecoration' => $idDecoration]);
		return $req->fetch()[$id];
	}

	public static function getLabelDecoration(int $idDecoration): string
	{
		$id = 'id' . $this->tableName;

		$req = Manager::getDatabase()->prepare("SELECT label FROM $this->tableName WHERE $id = :idDecoration");
		$req->execute(['idDecoration' => $idDecoration]);
		return $req->fetch()['label'];

	}
	public static function getFilePathDecoration(int $idDecoration): string
	{
		$id = 'id' . $this->tableName;

		$req = Manager::getDatabase()->prepare("SELECT filePath FROM $this->tableName WHERE $id = :idDecoration");
		$req->execute(['idDecoration' => $idDecoration]);
		return $req->fetch()['filePath'];

	}

	public static function getPointsRequiredDecoration(int $idDecoration): int
	{
		$id = 'id' . $this->tableName;

		$req = Manager::getDatabase()->prepare("SELECT pointsRequired FROM $this->tableName WHERE $id = :idDecoration");
		$req->execute(['idDecoration' => $idDecoration]);
		return intval($req->fetch()['pointsRequired']);
	}

	public static function setIdDecoration(int $idDecoration): void
	{
		$id = 'id' . $this->tableName;

		$req = Manager::getDatabase()->prepare("INSERT INTO $this->tableName($id) VALUES(:idDecoration)");
		$req->execute(['idDecoration' => $idDecoration]);
	}

	public static function setLabelDecoration(string $label, int $idDecoration): void
	{
		$id = 'id' . $this->tableName;

		$req = Manager::getDatabase()->prepare("UPDATE $this->tableName SET label = :label WHERE $id = :idDecoration");
		$req->execute(['idDecoration' => $idDecoration, 'label' => $label]);

	}

	public static function setFilePathDecoration(string $filePath, int $idDecoration): void
	{
		$id = 'id' . $this->tableName;

		$req = Manager::getDatabase()->prepare("UPDATE $this->tableName SET filePath = :filePath WHERE $id = :idDecoration");
		$req->execute(['idDecoration' => $idDecoration, 'filePath' => $filePath]);
	}

	public static function setPointsRequiredDecoration(int $points, int $idDecoration): void
	{
		$id = 'id' . $this->tableName;

		$req = Manager::getDatabase()->prepare("UPDATE $this->tableName SET pointsRequired = :points WHERE $id = :idDecoration");
		$req->execute(['idDecoration' => $idDecoration, 'points' => $points]);
	}
}

