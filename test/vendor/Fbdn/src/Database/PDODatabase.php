<?php

namespace Fbdn\Database;
use Fbdn\Interfaces\IDatabase;
	/**
	 * PDODatabase short summary.
	 *
	 * PDODatabase description.
	 *
	 * @version 1.0
	 * @author Francesco
	 */
	class PDODatabase implements IDatabase
	{
		public function connect(){
			$this->_connection = new \PDO("mysqli",$this->_host, $this->_username,
			   $this->_password, $this->_database);
			if($this->_connection->connect_errno) {
				trigger_error("Failed to connect to MySQL: " . mysqli_connect_error(),
					 E_USER_ERROR);
				return false;
			}else{
				return $this->_connection;
			}
		}
		
		
		#region Fbdn\Interfaces\IDatabase Members

		/**
		 *
		 * @param string $query 
		 */
		function query(string $query)
		{
		}

		/**
		 */
		function close()
		{
		}

		#endregion
	}
