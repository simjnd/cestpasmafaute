<?php
namespace CPMF\Models;
use \PDO;

class Manager
{
	private static $db;

	private function __construct() {}

	public static function getDatabase(): PDO
	{
    	if (is_null(self::$db)) {
        	require_once '../conf.php';
            self::$db = new PDO(DBTYPE.':host='.DBHOST.';dbname='.DBNAME, DBUSERNAME, DBPASSWORD);
    	}
    	
    	return self::$db;
    }
}