<?php
namespace Config;
use \PDO;
// la noi ket noi voi co so du lieu
class Database
{
	// su dung thu vien PDO PHP connect database
	// tai vi PDO co the lam viec hay thao tac voi nhieu co so du lieu khac nhau: My SQL, SQL Server, Orlacal
	// chung ta khong dung My SQLli de connect database
	// vi khong ho tro da dang cac kieu co so du lieu khac nhau ma no chi lamf viec voi moi mySQL
	protected $db;
	public function __construct()
	{
		$this->db = $this->connection();
	}
	public function __destruct()
	{
		$this->disconnection();
	}
	// viet phuong thuc ngat ket noi toi database
	private function disconnection()
	{
		$this->db = null;
	}
	// viet 1 phuong thuc ket noi voi database
	public function connection()
	{
		try {
		    $dbh = new PDO('mysql:host=localhost;dbname=restapi', 'hungtv1501', '0986372030Hung@');
		    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		    return $dbh;
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}	
	}
}