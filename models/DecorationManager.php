<?php
namespace CPMF\Models;

use \CPMF\Models\Entities\Accessory;
use \CPMF\Models\Entities\Frame;
use \CPMF\Models\Entities\Portrait;
use \CPMF\Models\Entities\Decoration;

class DecorationManager 
{

	private $tableName;

	public function __construct(string $tabname)
	{
		$this->tableName = $tabname;
	}

	public function getAccessory(int $idAccessory): Decoration
	{
		$req = Manager::getDatabase()->prepare("SELECT * FROM Accessory WHERE  $id = :idAccessory");
		$req->execute(['idAccessory' => $idAccessory]);
		return new Accessory($req->fetch());
	}

	public function getFrame(int $idFrame): Decoration
	{
		$req = Manager::getDatabase()->prepare("SELECT * FROM Frame WHERE  $id = :idFrame");
		$req->execute(['idFrame' => $idFrame]);
		return new Frame($req->fetch());
	}

	public function getPortrait(int $idPortrait): Decoration
	{
		$req = Manager::getDatabase()->prepare("SELECT * FROM Portrait WHERE  $id = :idPortrait");
		$req->execute(['idPortrait' => $idPortrait]);
		return new Portrait($req->fetch());
	}

	public function getLabelDecoration(int $idDecoration): string
	{
		$id = 'id' . $this->tableName;

		$req = Manager::getDatabase()->prepare("SELECT label FROM $this->tableName WHERE $id = :idDecoration");
		$req->execute(['idDecoration' => $idDecoration]);
		return $req->fetch()['label'];

	}
	public function getFilePathDecoration(int $idDecoration): string
	{
		$id = 'id' . $this->tableName;

		$req = Manager::getDatabase()->prepare("SELECT filePath FROM $this->tableName WHERE $id = :idDecoration");
		$req->execute(['idDecoration' => $idDecoration]);
		return $req->fetch()['filePath'];

	}

	public function getPointsRequiredDecoration(int $idDecoration): int
	{
		$id = 'id' . $this->tableName;

		$req = Manager::getDatabase()->prepare("SELECT pointsRequired FROM $this->tableName WHERE $id = :idDecoration");
		$req->execute(['idDecoration' => $idDecoration]);
		return intval($req->fetch()['pointsRequired']);
	}

	public function setIdDecoration(int $idDecoration): void
	{
		$id = 'id' . $this->tableName;

		$req = Manager::getDatabase()->prepare("INSERT INTO $this->tableName($id) VALUES(:idDecoration)");
		$req->execute(['idDecoration' => $idDecoration]);
	}

	public function setLabelDecoration(string $label, int $idDecoration): void
	{
		$id = 'id' . $this->tableName;

		$req = Manager::getDatabase()->prepare("UPDATE $this->tableName SET label = :label WHERE $id = :idDecoration");
		$req->execute(['idDecoration' => $idDecoration, 'label' => $label]);

	}

	public function setFilePathDecoration(string $filePath, int $idDecoration): void
	{
		$id = 'id' . $this->tableName;

		$req = Manager::getDatabase()->prepare("UPDATE $this->tableName SET filePath = :filePath WHERE $id = :idDecoration");
		$req->execute(['idDecoration' => $idDecoration, 'filePath' => $filePath]);
	}

	public function setPointsRequiredDecoration(int $points, int $idDecoration): void
	{
		$id = 'id' . $this->tableName;

		$req = Manager::getDatabase()->prepare("UPDATE $this->tableName SET pointsRequired = :points WHERE $id = :idDecoration");
		$req->execute(['idDecoration' => $idDecoration, 'points' => $points]);
	}

	public function unlockedAccessory(int $studentID): array
	{
		$accessories = [];

		$req = Manager::getDatabase()->prepare('SELECT * FROM Accessory, Student WHERE Accessory.idAccessory = Student.idStudent AND Accessory.pointsRequired < :nbPoints');
		$req->execute(['nbPoints' => StudentManager::getTotalPoints($studentID)]);

		foreach($req->fetchAll() as $accessory) {
			$accessories[] = new Accessory($accessory);
		}
		return $accessories;
		
	}

	public function unlockedFrame(int $studentID): array
	{
		$frames = [];

		$req = Manager::getDatabase()->prepare('SELECT * FROM Frame, Student WHERE Frame.idFrame = Student.idStudent AND Frame.pointsRequired < :nbPoints');
		$req->execute(['nbPoints' => StudentManager::getTotalPoints($studentID)]);
		
		foreach($req->fetchAll() as $frame) {
			$frames[] = new Frame($frame);
		}
		return $frames;
	}

	public function unlockedPortrait(int $studentID): array
	{
		$portraits = [];

		$req = Manager::getDatabase()->prepare('SELECT * FROM Portrait, Student WHERE Portrait.idPortrait = Student.idStudent AND Portrait.pointsRequired < :nbPoints');
		$req->execute(['nbPoints' => StudentManager::getTotalPoints($studentID)]);

		foreach($req->fetchAll() as $portrait) {
			$portraits[] = new Portrait($portrait);
		}
		return $portraits;
	}
}

