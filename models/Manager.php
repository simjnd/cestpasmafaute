<?php
namespace CPMF\Models;
use \PDO;

class Manager
{
	private $db;

	private function __construct() {}

	public static function getDatabase(): PDO
	{
    	if (is_null($this->db)) {
        	require '../conf.php';
            $this->db = new PDO(DBTYPE.':host='.DBHOST.';dbname='.DBNAME, DBUSERNAME, DBPASSWORD);
    	}
    	
    	return $this->db;
    }
}