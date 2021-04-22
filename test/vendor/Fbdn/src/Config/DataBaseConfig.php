<?php

namespace Fbdn\Config;
{
	/**
	 * DataBaseConfig short summary.
	 *
	 * DataBaseConfig description.
	 *
	 * @version 1.0
	 * @author Francesco
	 */
	class DataBaseConfig
	{
		private $dsn;
		private $host;
		private $user;
		private $pass;
		private $database;

		public function __construct($dsn,$host,$user,$pass,$database){
			$this->dsn = $dsn;
			$this->host = $host;
			$this->user = $user;
			$this->pass = $pass;
			$this->database = $database;
		}

	}
}