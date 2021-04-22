<?php
ob_start();
header('Content-type:application/json');
include '../../vendor/autoload.php';
use Fbdn\Utilities\Utility;
$utils = new Utility();
$link = $utils->link;
	$user = mysqli_real_escape_string($link,trim($_POST['email']));
	$password = md5($_POST['password']);
	$userQuery = "SELECT * FROM utenti WHERE (email = '".$user."' AND `password` = '".$password."')";
	//echo $userQuery."<br/>";
	$res = $link->query($userQuery);
	//echo "SELECT * FROM utenti WHERE (email = '".$user."' AND password = '".$password."') OR (cf = '".$user."' AND password = '".$password."')";
	$rows = $res->num_rows;
	$userres = $res->fetch_object();
	//echo $rows;
	if($rows != 1){
		echo json_encode(array('success'=>false,'msg'=>'Utente Insesistente'));
	}else{
		$_SESSION['admin']['id'] = $userres->idutente;
		$_SESSION['admin']['nome'] = $userres->nome;
		$_SESSION['admin']['cognome'] = $userres->cognome;
		$_SESSION['admin']['email'] = $userres->email;
		setcookie("admin",md5($userres->idutente),time()+3600*24*30,'/','localhost');
		echo json_encode(array('success'=>true,'link'=>'../admin/index.php'));
	}
?>