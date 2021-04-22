<?php

namespace Fbdn\Database;
use Fbdn\Interfaces\IDatabase;
use Fbdn\Exceptions\MysqlConnectionException;

/**
 * MySql short summary.
 *
 * MySql description.
 *
 * @version 1.0
 * @author Francesco
 */

class MySql implements IDatabase
{
	private $conf = array(
		//'host'=>"sql.acpacesena.org",
		//'username' => "acpacese32677",
		//'password' => "Fb@24111975",
		//'database' => "acpacese32677"
		'host'=>"localhost",
		'username' => "root",
		'password' => "Fb@24111975",
		'database' => "acpacesena"
		);

	private $_connection;


	public function __construct(){
		$this->_connection = $this->connect($this->conf);
	}

	public function connect(array $conf){
		try{
			$this->_connection = new \mysqli($conf['host'], $conf['username'],
			   $conf['password'], $conf['database']);
			if($this->_connection->connect_error){
				throw new MysqlConnectionException("Impossibile Connettersi a Mysql Server");
			}else{
				return $this->_connection;
			}


		}
		catch(MysqlConnectionException $ex){
			echo $ex->getMessage();
			return false;
		}



	}


	#region Fbdn\Interfaces\IDatabase Members

	/**
	 */
	public function query(string $query)
	{
		return $this->_connection->query($query);
	}


	#endregion

	#region Fbdn\Interfaces\IDatabase Members

	/**
	 */
	public function close()
	{
		return $this->_connection->close();
	}

	#endregion

	#region Fbdn\Interfaces\IDatabase Members

	/**
	 */
	public function error()
	{
		return $this->_connection->error;
	}

	#endregion

	#region Fbdn\Interfaces\IDatabase Members

	/**
	 */
	public function getDatabaseLink()
	{
		return $this->_connection;
	}

	#endregion
}
