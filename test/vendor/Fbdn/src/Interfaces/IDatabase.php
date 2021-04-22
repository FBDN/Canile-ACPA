<?php

/**
 * IDatabase short summary.
 *
 * IDatabase description.
 *
 * @version 1.0
 * @author Francesco
 */
namespace Fbdn\Interfaces;

interface IDatabase
{
    public function connect(array $conf);
	public function query(string $query);
	public function close();
	public function error();
	public function getDatabaseLink();

}
