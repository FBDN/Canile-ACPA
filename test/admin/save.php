<?php
session_start();
require_once '../vendor/autoload.php';
use Fbdn\Utilities\Utility;
$db = new Utility();
$columnName = $_POST["column"];
$columnValue = $_POST["editval"];
$Id = $_POST["id"];
$table = $_POST["table"];
$idcolumn = $_POST['idcolumn'];
$result = $db->editRecord($table,$columnName, $columnValue, $Id,$idcolumn);
?>