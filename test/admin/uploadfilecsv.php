<?php
header('Content-type:application/json');
require_once "../vendor/autoload.php";
use Fbdn\Utilities\Utility;
$utility = new Utility();
if (isset($_POST["upload"])) {
    //echo $_FILES["file"]["tmp_name"];
    $fileName = $_FILES["file"]["tmp_name"];

	if ($_FILES["file"]["size"] > 0) {
		$token = date("dmYhis");
		if(is_uploaded_file($fileName) && $_FILES['file']['error'] == UPLOAD_ERR_OK){
			move_uploaded_file($fileName,'upload/'.$token.$_FILES['file']['name']);
			echo $utility->XlsToDatabase('upload/'.$token.$_FILES['file']['name']);
		}else{
			echo json_encode(array('success'=>false,'msg'=>'Errore nel File'));
		}
	}

}
?>