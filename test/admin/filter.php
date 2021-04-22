<?php
require_once '../vendor/autoload.php';
use Fbdn\Utilities\Utility;
$db = new Utility();
$html = '';
if(isset($_POST['filter'],$_POST['table']) && !empty($_POST['filter']) && !empty($_POST['table'])){
	$filter = strip_tags(htmlspecialchars($_POST['filter']));
	$table = strip_tags(htmlspecialchars($_POST['table']));
	if($filter == 'all'){
		$query = "SELECT * FROM ".$table;
	}else{
		$query = "SELECT * FROM ".$table." WHERE categoria='".$filter."'";
	}
}

$res = $db->link->query($query);
if($table == 'staff'){
	while($items = $res->fetch_assoc()){
		$html .= '<tr id="'.$items['idstaff'].'">
						<td>
							<a id="'.$items['idstaff'].'" href="deleteStaff.php" class="btn btn-danger deleteStaff btn-circle btn-sm d-inline-block" data-toggle="tooltip" title="Elimina Membro" alt="Elimina Membro"><i class="fas fa-trash"></i></a>
						</td>';
		$html .= '<td>'.strtoupper($items['nome']).' '.strtoupper($items['cognome']).'</td><td>'.$items['qualifica'].'</td>';

		if($filter=='fm'){
			$html.='<td>Functional Move</td>';
		}else{
			$html.='<td>Walking Program</td>';
		}
		$html.='</tr>';
	}
}
if($table == 'corsi'){
	while($items = mysqli_fetch_assoc($res)){
		$datainizio = new \DateTime($items['datainiziocorso'],timezone_open('Europe/Rome'));
		$datafine= new \DateTime($items['datafinecorso'],timezone_open('Europe/Rome'));

		// var_dump($items);
		$html .= '<tr id="'.$items['idcorso'].'">
					<td contenteditable="true" onBlur="saveToDatabase(this,\'corsi\',\'nomecorso\','.$items['idcorso'].')" onClick="showEdit(this)">'.utf8_encode($items['nomecorso']).'</td>
					<td contenteditable="true" onBlur="saveToDatabase(this,\'corsi\',\'categoria\','.$items['idcorso'].')" onClick="showEdit(this)">'.$items['categoria'].'</td>
					<td contenteditable="true" onBlur="saveToDatabase(this,\'corsi\',\'datainiziocorso\','.$items['idcorso'].')" onClick="showEdit(this)">'.$datainizio->format("d/m/Y").'</td>
					<td contenteditable="true" onBlur="saveToDatabase(this,\'corsi\',\'datafinecorso\','.$items['idcorso'].')" onClick="showEdit(this)">'.$datafine->format("d/m/Y").'</td>
					<td contenteditable="true" onBlur="saveToDatabase(this,\'corsi\',\'orario\','.$items['idcorso'].')" onClick="showEdit(this)">'.$items['orario'].'</td>
					<td contenteditable="true" onBlur="saveToDatabase(this,\'corsi\',\'statocorso\','.$items['idcorso'].')" onClick="showEdit(this)">'.$items['statocorso'].'</td>
					<td contenteditable="true" onBlur="saveToDatabase(this,\'corsi\',\'location\','.$items['idcorso'].')" onClick="showEdit(this)">'.$items['location'].'</td>
					<td contenteditable="true" onBlur="saveToDatabase(this,\'corsi\',\'sede\','.$items['idcorso'].')" onClick="showEdit(this)">'.$items['sede'].'</td>
					<td contenteditable="true" onBlur="saveToDatabase(this,\'corsi\',\'indirizzo\','.$items['idcorso'].')" onClick="showEdit(this)">'.$items['indirizzo'].'</td>
					<td contenteditable="true" onBlur="saveToDatabase(this,\'corsi\',\'emailcorso\','.$items['idcorso'].')" onClick="showEdit(this)">'.$items['emailcorso'].'</td>
					<td contenteditable="true" onBlur="saveToDatabase(this,\'corsi\',\'telcorso\','.$items['idcorso'].')" onClick="showEdit(this)">'.$items['telcorso'].'</td>

                  <td>
					<a id="'.$items['idcorso'].'" href="addProgramma.php" class="btn btn-primary addPdf btn-circle btn-sm d-inline-block" title="Aggiungi PDF" alt="Aggiungi PDF"><i class="fas fa-plus"></i></a>
                    <a id="'.$items['idcorso'].'" href="deleteCorso.php" class="btn btn-danger deleteCorso btn-circle btn-sm d-inline-block" title="Elimina Corso" alt="Elimina Corso"><i class="fas fa-trash"></i></a>
                    <a id="'.$items['idcorso'].'" href="updateCorso.php?idcorso='.$items['idcorso'].'" class="btn btn-primary updateCorso btn-circle btn-sm d-inline-block" title="Aggiorna Corso" alt="Aggiorna Corso"><i class="fas fa-pen-alt"></i></a>
                  </td>
                </tr>';

	}
}
$db->link->close();
echo $html;