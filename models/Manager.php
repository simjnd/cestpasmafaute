<?php
namespace App\Model;

use \PDO;

abstract class Manager
{
	protected $db;

	public function __construct() 
	{
        require 'conf.php';
		$this->db = new PDO($dbType.':host='.$dbHost.';dbname='.$dbName, $dbUsername, $dbPassword);
	}
}