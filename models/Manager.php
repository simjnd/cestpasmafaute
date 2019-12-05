<?php
namespace CPMF\Models;
use \PDO;

abstract class Manager
{
	protected $db;

	public function __construct() 
	{
        require_once '../conf.php';
		$this->db = new PDO(DBTYPE.':host='.DBHOST.';dbname='.DBNAME, DBUSERNAME, DBPASSWORD);
	}
}