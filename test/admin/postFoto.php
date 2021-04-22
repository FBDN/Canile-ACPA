<?php
require_once "../vendor/autoload.php";
use Fbdn\Utilities\Utility;
$db = new Utility();
$message=array();
if (isset($_POST["upload"]) && $_POST['upload'] == 1) {
    //var_dump($_POST,$_FILES);
    $categoria = mysqli_real_escape_string($db->link,$_POST['categoria']);
    $editorprogramma = mysqli_real_escape_string($db->link,$_POST['editorprogramma']);

    if(!empty($_FILES['file']['name'])){
		$countFiles = count($_FILES['file']['name']);
		for($i=0;$i<$countFiles;$i++){
        $fileName = $_FILES["file"]["tmp_name"][$i];
        if ($_FILES["file"]["size"][$i] > 1048576) {
            $message = ['success'=>false,'msg'=>'Immagine Troppo Grande (Max 1 MB)'];
        }else{
            $token = date("dmYhis");
            move_uploaded_file($fileName,'../upload/'.$_FILES['file']['name'][$i]);
			$query = "INSERT into foto (idfoto,path,idcategoria) values (null,'upload/".$_FILES['file']['name'][$i]."','".$categoria."')";
			echo $query;
            if(!$db->link->query($query)){
					$message = ['success'=>false,'msg'=>'"'.$db->link->error().'"'];
			}else{
				$message = ['success'=>true,'msg'=>'Foto Inserita/e con Successo'];
			}
		}

    }
    header('Content-type:application/json');
    echo json_encode($message);
}
}
?>