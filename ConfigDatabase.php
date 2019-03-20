<?php

namespace Config;

use \PDO;

class Database
{
	public function connection()
	{
		try {
		    $dbh = new PDO('mysql:host=localhost;dbname=restapi', 'hungtv1501', '0986372030Hung@');
		    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    return $dbh;
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}	
	}
}
?>