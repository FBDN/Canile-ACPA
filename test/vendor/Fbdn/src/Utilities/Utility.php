<?php
/**

 * @author Francesco

 *

 */
namespace Fbdn\Utilities;
use Fbdn\Database\Database;
use Fbdn\Exceptions\UserNotFoundException;
use Fbdn\Database\MySql;
use Fbdn\Interfaces\IDatabase;
class Utility{

    public $link;

    public function __construct(){
		$this->link = $this->GetLinkToDatabase(new MySql());
		if(session_id() == "" || session_status() !== PHP_SESSION_ACTIVE){
            session_start();

        }
	}
	public function __destruct(){
		$this->link->close();
	}

	public function  GetLinkToDatabase(IDatabase $db){
		$this->link = $db;
		return $this->link->getDatabaseLink();
	}

	public function SendTextQuery($query){
		$result = $this->link->query($query);
		return $result;
	}
    public function Query($query){
		$result = $this->link->query($query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}
		if(!empty($resultset))
           
		return json_encode($resultset);

	}

	public function verifyUserEmail(int $id){
		$queryEmail = "SELECT email FROM utenti WHERE idutente =".$id;
		$result = $this->link->query($queryEmail);
		$userEmail = $result->fetch_object();
		if($userEmail->email == ""){
			echo ' <div class="alert alert-danger">Devi Inserire una email valida</div>';
		}else{
			echo ' <div class="alert alert-success">Bravo hai una mail '.$userEmail->email.'</div>';
		}
	}
    /**
	 * public function getTable($tableName,$filter,$numCol,$totalCol)
	 * ritorna gli elementi della tabella
	 * visualizzandoli rispettando il Grid System di Bootstrap
	 * accetta 4 parametri
	 * @params $tableName (nome tabella)
	 * @params $filter mysql Where
	 * @params $numCol numero di colonne per riga
	 * @params $totalCol (12) Default
	 **/

    public function getSelectFromTable(string $tablename):string{
        $html ='';
        $tableQuery = "SELECT * FROM ".$tablename;
        //echo $tableQuery;
        $res = $this->link->query($tableQuery) or die("Errore: ".$this->link->error());
        //$itemsArray = array();
        if(mysqli_num_rows($res) >0){
            $html .= '<select class="form-control" name="'.$tablename.'">';
            while($item = mysqli_fetch_assoc($res)){
                $html .='<option value="'.$item['nome'].'">'.$item['nome'].'</option>';
            }
            $html .= '</select>';
        }
		
        return $html;
    }

    public function getItemsFromCart($session_cart){
        $html = "";
        global $item_total;
        $item_total = 0;
        foreach ($session_cart as $item){
            //print_r($item);
            $datainizio = new \DateTime($item['datainizio']);
            $html.= '<tr>
                        <th scope="row" class="border-0">
                          <div class="p-2">

                                <img src="img/no-image.jpg" alt="" width="30" class="img-fluid rounded shadow-sm">

                            <div class="ml-3 d-inline-block align-middle">
                              <p class="mb-0"> '.substr($item['nomecorso'],0,30).'...</p>
                            <span class="text-muted font-weight-normal font-italic d-block">
                            <i class="fa fa-map-marker-alt"></i> '.$item['indirizzo'].'
                            <i class="far fa-clock"></i> '.$item['orario'].'</span>
                            </div>
                          </div>
                        </th>
                        <td class="border-0 align-middle text-center">'.$datainizio->format("d/m/Y").'</td>
                        <td class="border-0 align-middle text-center">&euro;' .$item['price'].'</td>
                        <td class="border-0 align-middle text-center">'.$item['quantity'].'</td>
                        <td class="border-0 align-middle text-center"><a href="#!" onclick="cartAction(\'remove\',\''.$item['idcorso'].'\')" class="text-danger" data-toggle="tooltip" title="Rimuovi Corso"><i class="fa fa-trash"></i></a></td>
                      </tr>';
            $item_total += ($item["price"]*$item["quantity"]);
        }
        return $html;
    }

	public function getCategoria($table){
		$html ='';
		$query = "SELECT * FROM ".$table;
		$res = $this->link->query($query);
		while($data = $res->fetch_object() ){
			$html .= '<option value="'.$data->idcategoria.'">'.$data->categoria.'</option>';
		}
		return $html;
	}

    public function getTable($tableName,$filter="",$classname="",$numCol,$totalCol=12){
        $html ='';
        $tableQuery = "SELECT * FROM ".$tableName." WHERE ".$filter;
        //echo $tableQuery;
        $res = $this->link->query($tableQuery) or die("Errore: ".$this->link->error());
        //print_r($this->link->error);
        //$numRows = $this->countItems($tableName);

        
        //$itemsArray = array();
        if(mysqli_num_rows($res) >0){
            while($item = mysqli_fetch_assoc($res)){
               
                $html .='<div class="image-item"><img src="'.$item['path'].'"/></div>';
                

            }
            return $html;

        }else{
            $html = '<h2 class="alert alert-danger text-center">Non Ci Sono Risultati</h2>';

            return $html;

        }
		
    }

	//get table staff wp
	public function getStaffWp($tableName,$filter="",$classname="",$numCol,$totalCol=12){
        $html ='';
        $tableQuery = "SELECT * FROM ".$tableName." ".$filter;
        //echo $tableQuery;
        $res = $this->link->query($tableQuery) or die("Errore: ".$this->link->error());
        //print_r($this->link->error);
        //$numRows = $this->countItems($tableName);

        $rowCount = 0;
        //$itemsArray = array();
        if(mysqli_num_rows($res) >0){
            while($item = mysqli_fetch_assoc($res)){
                if($rowCount % $numCol == 0) {
                    $html .='<div class="row '.$classname.'">';
                }
                $rowCount++;
                $html .='<div class="col-md-'.($totalCol/$numCol).'">'
                .'<div class="row"><div class="col"><h4 class="text-uppercase font-weight-light">'.strip_tags($item['nome']).'</h4><p class="lh-small">'.strtolower($item['qualifica']).'</p></div></div></div>';
                if($rowCount % $numCol == 0) {
                    $html .='</div>';
                }

            }
           
            return $html;

        }else{
            $html = '<h2 class="alert alert-danger text-center">Non Ci Sono Risultati</h2>';
            
            return $html;

        }

    }

    public function getCorsiWP($tableName,$filter="",$classname="",$numCol,$totalCol=12){
        $html ='';
        $tableQuery = "SELECT * FROM ".$tableName." ".$filter."ORDER BY filepdf DESC";
        //echo $tableQuery;
        $res = $this->link->query($tableQuery) or die("Errore: ".$this->link->error());
        //print_r($this->link->error);
        //$numRows = $this->countItems($tableName);

        $rowCount = 0;
        //$itemsArray = array();
        if(mysqli_num_rows($res) >0){
            while($item = mysqli_fetch_assoc($res)){
				$datainizio = new \DateTime($item['datainiziocorso'],timezone_open('Europe/Rome'));
                if($rowCount % $numCol == 0) {
                    $html .='<div class="row">';
                }
                $rowCount++;
                $html .='<div class="col-md-'.($totalCol/$numCol).' '.$classname.'">'.
                    '<div class="wrapper">
                <div class="col-md-12 pl-0">
                   <div class="position-absolute float-left b-0">
                    <img src="'.$item['immagine'].'" class="w-100">
                  </div>
                  <div class="we-table-corso">
                    <h3>'.utf8_encode($item['nomecorso']).'</h3>
                    <div class="border-bottom"></div>
                    '.utf8_encode($item['programma']).'
                    <div class="prezzo">&euro; '.$item['prezzo'].'</div>
                  </div>
                </div>
                <div class="col-md-12 dettagli">
                  <div class="durata">
                    <ul>
                      <li>Durata: '.$item['orario'].'</li>
                    </ul>
                  </div>';

				if(!empty($item['filepdf'])){
					$html.='<div class="programma">
                  <form method="post" action="">
        <fieldset>
            <input type="hidden" disabled name="cart-item-id" value="'.$item['idcorso'].'" />
            <input type="hidden" disabled name="cart-item-name" value="'.$item['nomecorso'].'" />
            <input type="hidden" disabled id="cart-item-price" name="cart-item-price" value="'.$item['prezzo'].'" />
        <input type="hidden" disabled id="cart-item-address" name="cart-item-address" value="'.$item['sede'].'" />
        <input type="hidden" disabled id="cart-item-date" name="cart-item-date" value="'.$datainizio->format("d/m/Y").'" />
            <input type="hidden" id=qty_'.$item['idcorso'].' name="quantity" value="1" size="2" />
            <div class=""> <a href="#!" id="add_'.$item['idcorso'].'" class="" onclick ="cartAction(\'add\',\''.$item['idcorso'].'\')"><i class="fas fa-shopping-cart"></i> AGGIUNGI AL CARRELLO</a></div>
        </fieldset></form>
                  </div>';
					$html.='<div class="programma">
                    <a href="'.$item['filepdf'].'"   data-id="'.$item['idcorso'].'" target="_blank">SCARICA PROGRAMMA E DATE</a>
                  </div>';
				}else{
					$html.='';
				}

                $html.='</div></div></div>';

                if($rowCount % $numCol == 0) {
                    $html .='</div>';
                }

            }
			
            return $html;

        }else{
            $html = '<h2 class="alert alert-danger text-center">Non Ci Sono Risultati</h2>';
            
            return $html;

        }

    }

    public function getCalendar(string $tableName="",string $filter="",string $classname="",int $numCol=1,int $totalCol=12):string{
        $html ='';
        $tableQuery = "SELECT * FROM ".$tableName." ".$filter;
        //echo $tableQuery." ".$classname." ".$numCol." ".$totalCol;
        $res = $this->link->query($tableQuery);
		// print_r($res);
        //$numRows = $this->countItems($tableName);

        $rowCount = 0;
        //$itemsArray = array();
        if(mysqli_num_rows($res) >0){
            while($item = mysqli_fetch_assoc($res)){

                $datainizio = new \DateTime($item['datainiziocorso'],timezone_open('Europe/Rome'));
                $datafine = new \DateTime($item['datafinecorso'],timezone_open('Europe/Rome'));
                $oggi = new \DateTime('today',timezone_open('Europe/Rome'));
                //$diff = $oggi->diff($datafine);
                if($rowCount % $numCol == 0) {
                    if($datafine < $oggi){
                        $html .='<div class="row '.$classname.' disabled">';
                    }else{
                        $html .='<div class="row '.$classname.'">';
                    }
                }
                $rowCount++;
                if($datafine < $oggi){
                    $html .='<div class="col-12 col-md-1 text-center white py-3 data-corso-lista bg-super-dark">
                  <div class="text-xs">'.$datainizio->format("D").'</div>
                  <div class="font-weight-black text-xl">'.$datainizio->format("d").'</div>
                  <div class="text-xs">'.$datainizio->format("M").'</div>
<div class="text-xs">&euro; '.$item['prezzo'].'</div>
                </div>
                <div class="col-md-'.($totalCol-1/$numCol).' white">
                <h3>'.utf8_encode($item['nomecorso']).'<span class="text-xxs"><a href="#'.$item['idcorso'].'"  data-toggle="modal" class="super-dark">&nbsp;<i class="fas fa-info-circle"></i></a></span></h3>
                <div class="d-block font-weight-bold"><i class="fa fa-map-marker-alt"></i> '.$item['indirizzo'].'</div>
                <div class="text-xs">Per info:<span class="color-light"> '.$item['emailcorso'].' <i class="fa fa-mobile-alt"></i> '.$item['telcorso'].'</span></div>
<div class="text-xs d-inline px-1"><i class="far fa-clock"></i><span class="color-light"> '.$item['orario'].'</span></div>
<div class="text-xs d-inline px-1">Fine corso:<span class="color-light"> '.$datafine->format("d/m/Y").'</span></div>
                <div class="text-xs d-inline px-1">Formatore: <span class="color-light"> '.$item['formatore'].'</span></div>';
					$html.='<div class="text-xs d-inline px-1"><span class="bg-black px-1">Corso Terminato</span></div>';

                    $html.='<div class="text-xs d-inline px-1"><span class="bg-black px-1">da fare</span></div>';
                    $_SESSION['utente']=0;
                    if(!isset($_SESSION['utente'])){
                        $html.='<!-- SE LOG=no -->
                <div class="text-xs d-inline px-1 btn-prenota"><a href="login.php" role="button" class="btn btn-light btn-sm">Iscriviti</a></div>';
                    }else{
                        $html.='<!-- SE LOG=si -->

                <div class="d-inline px-1 btn-prenota"> <a href="#!" id="add_'.$item['idcorso'].'" onClick = "cartAction("add","'.$item['idcorso'].'")" class="btn btn-light btn-sm"><i class="fas fa-shopping-cart"></i>Acquista</a></div>';
                    }
                    $html.='</div>';
                }else{
                    $html .='<div class="col-12 col-md-1 text-center white py-3 data-corso-lista super-black">
                  <div class="text-xs">'.$datainizio->format("D").'</div>
                  <div class="font-weight-black text-xl">'.$datainizio->format("d").'</div>
                  <div class="text-xs">'.$datainizio->format("M").'</div>
                  <div class="text-md">&euro;<strong> '.$item['prezzo'].'</strong></div>
                </div>
                <div class="col-md-'.($totalCol-1/$numCol).' white">
                <h3>'.$item['nomecorso'].'<span class="text-xxs"><a href="#!"   data-toggle="modal" data-id="'.$item['idcorso'].'"class="super-dark btnModal">&nbsp; <i class="fas fa-info-circle"></i></a></span></h3>
                <div class="d-block font-weight-bold"><i class="fa fa-map-marker-alt"></i> '.$item['indirizzo'].'</div>
                <div class="text-xs">Per info:<span class="color-light"> '.$item['emailcorso'].' <i class="fa fa-mobile-alt"></i> '.$item['telcorso'].'</span></div>
<div class="text-xs d-inline px-1"><i class="far fa-clock"></i><span class="color-light"> '.$item['orario'].'</span></div>
<div class="text-xs d-inline px-1">Fine corso:<span class="color-light"> '.$datafine->format("d/m/Y").'</span></div>
                <div class="text-xs d-inline px-1">Formatore: <span class="color-light"> '.$item['formatore'].'</span></div>';

					$html.='<div class="text-xs d-inline px-1"><span class="bg-green px-1">Iscrizioni aperte</span></div>';

                    if(!isset($_SESSION['user'])){
                        //LOG NO
                        $html.='<div class="text-xs d-inline px-1 btn-prenota"><a href="login.php" role="button" class="btn btn-light btn-sm">Iscriviti</a></div>';
                    }else{
                        //LOG SI
                        $html.='<form method="post" action="">
        <fieldset>
            <input type="hidden" disabled name="cart-item-id" value="'.$item['idcorso'].'" />
            <input type="hidden" disabled name="cart-item-name" value="'.$item['nomecorso'].'" />
            <input type="hidden" disabled id="cart-item-price" name="cart-item-price" value="'.$item['prezzo'].'" />
        <input type="hidden" disabled id="cart-item-address" name="cart-item-address" value="'.$item['sede'].'" />
        <input type="hidden" disabled id="cart-item-date" name="cart-item-date" value="'.$datainizio->format("d/m/Y").'" />
            <input type="hidden" id="qty_'.$item['idcorso'].'" name="quantity" value="1" size="2" />
            <div class="d-inline px-1 btn-prenota"> <a href="#!" id="add_'.$item['idcorso'].'" class="btn btn-light btn-sm" onclick ="cartAction(\'add\',\''.$item['idcorso'].'\')"><i class="fas fa-shopping-cart"></i>Acquista</a></div>
        </fieldset></form>';
                    }
                    $html.='</div>';
                }

                if($rowCount % $numCol == 0) {
                    $html .='</div>';
                }

            }
		
            return $html;

        }else{
            $html = '<h2 class="alert alert-danger text-center">Non Ci Sono Corsi Disponibili</h2>';
            
            return $html;

        }

    }

    /**
	 * Crea una Password casuale di caratteri
	 *
	 * @param $chars (Numero Caratteri)
	 */

    public function getTableHtml($tableName,$clause){
        $html = '';
        $query = "SELECT * FROM ".$tableName." ".$clause;
        $res = $this->link->query($query);
        while($items = mysqli_fetch_assoc($res)){
            $datainizio = new \DateTime($items['datainiziocorso'],timezone_open('Europe/Rome'));
            $datafine= new \DateTime($items['datafinecorso'],timezone_open('Europe/Rome'));

            // var_dump($items);
            $html .= '<tr id="'.$items['idcorso'].'">
					<td contenteditable="true" onBlur="saveToDatabase(this,\'corsi\',\'nomecorso\','.$items['idcorso'].',\'idcorso\')" onClick="showEdit(this)">'.utf8_encode($items['nomecorso']).'</td>
					<td contenteditable="true" onBlur="saveToDatabase(this,\'corsi\',\'categoria\','.$items['idcorso'].',\'idcorso\')" onClick="showEdit(this)">'.$items['categoria'].'</td>
					<td contenteditable="true" onBlur="saveToDatabase(this,\'corsi\',\'datainiziocorso\','.$items['idcorso'].',\'idcorso\')" onClick="showEdit(this)">'.$datainizio->format("d/m/Y").'</td>
					<td contenteditable="true" onBlur="saveToDatabase(this,\'corsi\',\'datafinecorso\','.$items['idcorso'].',\'idcorso\')" onClick="showEdit(this)">'.$datafine->format("d/m/Y").'</td>
					<td contenteditable="true" onBlur="saveToDatabase(this,\'corsi\',\'orario\','.$items['idcorso'].',\'idcorso\')" onClick="showEdit(this)">'.$items['orario'].'</td>
					<td contenteditable="true" onBlur="saveToDatabase(this,\'corsi\',\'statocorso\','.$items['idcorso'].',\'idcorso\')" onClick="showEdit(this)">'.$items['statocorso'].'</td>
					<td contenteditable="true" onBlur="saveToDatabase(this,\'corsi\',\'location\','.$items['idcorso'].',\'idcorso\')" onClick="showEdit(this)">'.$items['location'].'</td>
					<td contenteditable="true" onBlur="saveToDatabase(this,\'corsi\',\'sede\','.$items['idcorso'].',\'idcorso\')" onClick="showEdit(this)">'.$items['sede'].'</td>
					<td contenteditable="true" onBlur="saveToDatabase(this,\'corsi\',\'indirizzo\','.$items['idcorso'].',\'idcorso\')" onClick="showEdit(this)">'.$items['indirizzo'].'</td>
					<td contenteditable="true" onBlur="saveToDatabase(this,\'corsi\',\'emailcorso\','.$items['idcorso'].',\'idcorso\')" onClick="showEdit(this)">'.$items['emailcorso'].'</td>
					<td contenteditable="true" onBlur="saveToDatabase(this,\'corsi\',\'telcorso\','.$items['idcorso'].',\'idcorso\')" onClick="showEdit(this)">'.$items['telcorso'].'</td>

                  <td>
					<a id="'.$items['idcorso'].'" href="addProgramma.php" class="btn btn-primary addPdf btn-circle btn-sm d-inline-block" title="Aggiungi PDF" alt="Aggiungi PDF"><i class="fas fa-plus"></i></a>
                    <a id="'.$items['idcorso'].'" href="deleteCorso.php" class="btn btn-danger deleteCorso btn-circle btn-sm d-inline-block" title="Elimina Corso" alt="Elimina Corso"><i class="fas fa-trash"></i></a>
                    <a id="'.$items['idcorso'].'" href="updateCorso.php?idcorso='.$items['idcorso'].'" class="btn btn-primary updateCorso btn-circle btn-sm d-inline-block" title="Aggiorna Corso" alt="Aggiorna Corso"><i class="fas fa-pen-alt"></i></a>
                  </td>
                </tr>';

        }
		$this->link->close();
        return $html;
    }

	public function getAllOrders(){
		$html = '';
        $query = "SELECT * FROM ordini JOIN utenti ON ordini.idutente = utenti.idutente ORDER BY dataordine DESC";
        $res = $this->link->query($query);
        while($items = mysqli_fetch_assoc($res)){
            $dataacquisto = date_create($items['dataordine']);

            //$datainiziocorso= date_create($items['datainiziocorso']);
			$html .= '<tr id="'.$items['idordine'].'">
				<td>'.$items['idordine'].'</td>
                  <td>'.date_format($dataacquisto,"d/m/Y").'</td>
					<td>'.$items['pagamento'].'</td>
					 <td>'.$items['transid'].'</td>

                  <td>'.$items['totale'].'</td>

					<td>'.$items['nome'].'</td>
					<td>'.$items['cognome'].'</td>
					<td>'.$items['email'].'</td>
					<td>'.$items['tel'].'</td>
                </tr>';
		}
		//while($itemsDetail =  mysqli_fetch_assoc($resDetail) ){
		//    $html .= '<tr>
		//    <td>'.$itemsDetail['nomecorso'].'</td>

		//      <td>'.$items['totale'].'</td>
		//       <td></td>

		//    </tr>';
		//}

		//      $html.='</tbody></table>';

		// }
		$this->link->close();
        return $html;

	}
	public function getUserOrderDetails($idutente,$idordine,$nomecorso){
		$html = '';
		$oggi = new \DateTime('today',timezone_open('Europe/Rome'));
		$queryVerify = "SELECT *
FROM ordini
JOIN utenti ON ordini.idutente = utenti.idutente
WHERE ordini.idutente =".$idutente."
AND ordini.idordine =".$idordine;
		$resVerify = $this->link->query($queryVerify);
        while($items = $resVerify->fetch_assoc()){
            $dataordine = new \DateTime($items['dataordine']);
			$datascadenza = new \DateTime($items['dataordine']);
            //$datainiziocorso= date_create($items['datainiziocorso']);
            // var_dump($items);
			$html .= '<tr id="'.$items['idordine'].'">
			<td>'.$items['idordine'].'</td>
			<td>'.$items['nome'].'</td>
			<td>'.$items['cognome'].'</td>
			<td>'.$items['email'].'</td>
			<td>'.$items['tel'].'</td>';
			$queryCorso="SELECT * FROM corsi WHERE nomecorso='".$nomecorso."'";
			$resCorso = $this->link->query($queryCorso);
			while($detailCorso = $resCorso->fetch_object()){
				$html.='<td>'.$detailCorso->nomecorso.'</td>';
				if($detailCorso->datafinecorso < $oggi){
					$html.='<td class=\'alert alert-danger\'>Corso Scaduto</td>';
				}else{
					$html.='<td class=\'alert alert-success\'>Corso in Programma</td>';
				}
				if( $datascadenza->modify("+1 year") < $oggi){
					$html.='<td class=\'alert alert-danger\'>Ordine Scaduto</td>';
				}else{
					$html.='<td class=\'alert alert-success\'>Ordine Valido</td>';
				}

			}
			$html.='<td>'.$dataordine->format("d/m/Y").'</td>

                  <td>'.$items['totale'].'</td>
                   <td></td>
                </tr>';
		}
		$this->link->close();
        return $html;
	}
    public function getTableOrdiniByUserId($idutente){
        $html = '';
        $query = "SELECT * FROM `ordini` JOIN utenti ON ordini.idutente = utenti.idutente WHERE ordini.idutente = ".$idutente;
        $res = $this->link->query($query);
        while($items = mysqli_fetch_assoc($res)){
            $dataacquisto = date_create($items['dataordine']);
            //$datainiziocorso= date_create($items['datainiziocorso']);
            // var_dump($items);
			$html .= '<tr id="'.$items['idordine'].'">
				<td>'.$items['idordine'].'</td>
                  <td>'.date_format($dataacquisto,"d/m/Y").'</td>

                  <td>'.$items['totale'].'</td>
                   <td></td>
                </tr>';
		}
		//while($itemsDetail =  mysqli_fetch_assoc($resDetail) ){
		//    $html .= '<tr>
		//    <td>'.$itemsDetail['nomecorso'].'</td>

		//      <td>'.$items['totale'].'</td>
		//       <td></td>

		//    </tr>';
		//}

		//      $html.='</tbody></table>';

		// }
		$this->link->close();
        return $html;
    }

    public function getUserInfoById($idutente){
        $html = '';
        $query = "SELECT * FROM utenti WHERE idutente = ".$idutente;
        $res = $this->link->query($query);
        while($utente = mysqli_fetch_assoc($res)){
            $date = new \DateTime($utente['datan']);
            $datanascita = $date->format("d/m/Y");

            // var_dump($items);
            $html .= '<div class="col">
            <form>
              <div class="form-row">
                  <div class="col-md-6">
                      <div class="form-group"><label class="text-gray-600 small" for="Nome">Nome</label><input class="form-control sb-form-control-solid py-4" type="text" placeholder="" aria-label="Nome" aria-describedby="Nome" name="nome" id="nome" value="'.$utente['nome'].'" /></div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group"><label class="text-gray-600 small" for="cognome">Cognome</label><input class="form-control sb-form-control-solid py-4" type="text" placeholder="" aria-label="Cognome" aria-describedby="cognome"  name="cognome" id="cognome" value="'.$utente['cognome'].'" /></div>
                  </div>
              </div>
              <div class="form-row">
                  <div class="col-md-6">
                      <div class="form-group"><label class="text-gray-600 small" for="data_nascita">Data di Nascita</label><input class="form-control sb-form-control-solid py-4" type="text" placeholder="" aria-label="data_nascita" aria-describedby="data_nascita"  name="data_nascita" id="data_nascita" value="'.$datanascita.'" /></div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group"><label class="text-gray-600 small" for="luogo_nascita">Luogo</label><input class="form-control sb-form-control-solid py-4" type="text" placeholder="" aria-label="luogo_nascita" aria-describedby="luogo_nascita" name="luogo_nascita" id="luogo_nascita" value="'.$utente['luogo'].'" /></div>
                  </div>
              </div>

              <div class="form-row">
                  <div class="col-md-6">
                      <div class="form-group"><label class="text-gray-600 small" for="cf">Codice Fiscale</label><input class="form-control sb-form-control-solid py-4" type="text" placeholder="" aria-label="cf" aria-describedby="cf" name="cf" id="cf" value="'.$utente['cf'].'" /></div>
                  </div>
                 <!-- <div class="col-md-6">
                      <div class="form-group"><label class="text-gray-600 small" for="carta_identita">Numero Carta di Identità</label><input class="form-control sb-form-control-solid py-4" type="text" placeholder="" aria-label="carta_identita" aria-describedby="carta_identita" name="carta_identita" id="carta_identita" /></div>
                  </div>-->
              </div>

              <div class="form-group"><label class="text-gray-600 small" for="indirizzo_email">indirizzo Email</label><input class="form-control sb-form-control-solid py-4" type="email" placeholder="" aria-label="Indirizzo Email" aria-describedby="indirizzo_email" name="indirizzo_email" id="indirizzo_email" value="'.$utente['email'].'" /></div>
              <div class="form-row">
                  <div class="col-md-6">
                      <div class="form-group"><label class="text-gray-600 small" for="password">Password</label><input class="form-control sb-form-control-solid py-4" type="password" placeholder="" aria-label="Password" aria-describedby="password" name="password" id="password" /></div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group"><label class="text-gray-600 small" for="conferma_password">Conferma Password</label><input class="form-control sb-form-control-solid py-4" type="password" placeholder="" aria-label="Conferma Password" aria-describedby="conferma_password" name="conferma_password" id="conferma_password" /></div>
                  </div>
                  <div class="col-12"><a href="updateUtente.php?idutente='.$utente['idutente'].'" class="btn btn-primary rounded-pill py-2 btn-block">Modifica i dati</a></div>
              </div>
            </form>
          </div>';

        }
		$this->link->close();
        return $html;
    }

    private function password_generate($chars):string
    {
        $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($data), 0, $chars);
    }
    /**
	 * Controlla se Esiste un Utente nel Database
	 * se esiste ritorna true altrimenti false
	 *
	 * @param string $fieldToCheck
	 * @param string $dbColumn
	 */
    private function checkUser($fieldToCheck,$dbColumn):bool{
        $query = "SELECT * FROM utenti WHERE ".$dbColumn." = '".mysqli_real_escape_string($this->GetLinkToDatabase,$fieldToCheck)."'";
        $res = $this->link->query($query);
        if(mysqli_num_rows($res)==1){
			$this->link->close();
            return true;
        }else{
			$this->link->close();
            return false;
        }
    }
    public function resetPassword($email){

        if($this->checkUser($email,'email')){
            $newPass = $this->password_generate(12);
            $query = "UPDATE utenti SET password =".$newPass."WHERE email=".mysqli_real_escape_string($this->link->getDatabaseLink(),$email);
			$this->link->query($query);
			$this->link->close();
			return $newPass;
        }else{
			$this->link->close();
            throw new UserNotFoundException('Spiacenti la Mail Inserita non Esiste');

        }

    }
    /**
	 * Restituisce tutti gli elemnti della tabella
	 *
	 * @param mixed $table
	 */
	public function getStaff(){
		$html = '';
		$query = "SELECT * FROM staff";
        $res = $this->link->query($query);
		while($items = $res->fetch_assoc()){
			$html .= '<tr id="'.$items['idstaff'].'">
						<td>
							<a id="'.$items['idstaff'].'" href="deleteStaff.php" class="btn btn-danger deleteStaff btn-circle btn-sm d-inline-block" data-toggle="tooltip" title="Elimina Membro" alt="Elimina Membro"><i class="fas fa-trash"></i></a>
						</td>';
			$html .= '<td>'.strtoupper($items['nome']).' '.strtoupper($items['cognome']).'</td><td>'.$items['qualifica'].'</td>';
			if($items['categoria']=='fm'){
				$html.='<td>Functional Move</td>';
			}else{
				$html.='<td>Walking Program</td>';
			}

                $html.='</tr>';
		}
		$this->link->close();
        return $html;
	}
    public function getAll($table){
        $html = '';
        $query = "SELECT * FROM ".$table." ORDER BY datascadenza DESC ";
        $res = $this->link->query($query);
        $oggi = new \DateTime('today', timezone_open('Europe/Rome'));
        //var_dump($oggi);
        while($items = mysqli_fetch_assoc($res)){
            $datan = new \DateTime($items['datan']);
            $datatessera= new \DateTime($items['datatessera']);
            $datascadenza = new \DateTime($items['datascadenza']);
            $intervallo = $oggi->diff($datascadenza);
            $totalTime = intval($intervallo->format('%R%a giorni'));
            // var_dump($items);
            $html .= '<tr id="'.$items['idutente'].'">
						<td>
							<a id="'.$items['idutente'].'" href="deleteUtente.php" class="btn btn-danger deleteUtente btn-circle btn-sm d-inline-block" data-toggle="tooltip" title="Elimina Utente" alt="Elimina Utente"><i class="fas fa-trash"></i></a>
						</td>';
            if($totalTime < 0){
                $html .= '<td class="alert alert-danger">Scaduta da '.$intervallo->format('%a giorni').'</td>';
            }else{
                if($totalTime < 30){
                    $html .= '<td class="alert alert-warning">in Scadenza fra '.$intervallo->format('%a giorni').'</td>';
                }else{
                    $html .= '<td class="alert alert-success">Attiva</td>';
                }
            }

            $html .= '

					<td contenteditable="true" onBlur="saveToDatabase(this,\'utenti\',\'tessera\','.$items['idutente'].',\'idutente\')" onClick="showEdit(this)">'.$items['tessera'].'</td>
					<td>'.$items['nome'].' '.$items['cognome'].'</td>
					<td contenteditable="true" onBlur="saveToDatabase(this,\'utenti\',\'datan\','.$items['idutente'].',\'idutente\')" onClick="showEdit(this)">'.$datan->format("d/m/Y").'</td>
					<td contenteditable="true" onBlur="saveToDatabase(this,\'utenti\',\'datatessera\','.$items['idutente'].',\'idutente\')" onClick="showEdit(this)">'.$datatessera->format("d/m/Y").'</td>
					<td contenteditable="true" onBlur="saveToDatabase(this,\'utenti\',\'datascadenza\','.$items['idutente'].',\'idutente\')" onClick="showEdit(this)">'.$datascadenza->format("d/m/Y").'</td>
					<td>'.$items['cf'].'</td>
					<td>'.$items['email'].'</td>
					<td contenteditable="true" onBlur="saveToDatabase(this,\'utenti\',\'tel\','.$items['idutente'].',\'idutente\')" onClick="showEdit(this)">'.$items['tel'].'</td>
                </tr>';

        }
		$this->link->close();
        return $html;
    }

    public function countItem():string

    {

        if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['cart_item']) && !empty($_SESSION['cart_item']) ) {

			return array_sum(array_column($_SESSION['cart_item'], 'quantity'));

        }else{

            return "0";

        }

    }

    public function countItems($table){

        $query = "SELECT COUNT(*) FROM ".$table;
        $res = $this->link->query($query);
        $count = mysqli_fetch_row($res);
		//$this->link->close();
		echo $count[0];


    }
    public function XlsToDatabase($file){
        try{
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file);
			//return json_encode(array('success'=>true,'msg'=>$reader));
			$reader->setReadDataOnly(true);
			$filexls = $reader->load($file);
			$fileData = $filexls->getActiveSheet()->toArray();
        }
        catch(\Exception $ex){
            return json_encode(array('success'=>false,'msg'=>$ex->getMessage()));
        }
        $cf="";
        $cognome ="";
        $nome="";
        $email="";
        $tel="";
        $tessera="";
        $qualifica="";
        $associazione="";
        $datan="";
        $luogo="";
        $datatessera="";
        $datascadenza = "";
        for($i=1;$i<count($fileData);$i++){

			$cf = $fileData[$i][1];
			$cognome = mysqli_real_escape_string($this->link->getDatabaseLink(),$fileData[$i][2]);
			$nome =  mysqli_real_escape_string($this->link->getDatabaseLink(),$fileData[$i][3]);
			$email = $fileData[$i][16];
			$tel = $fileData[$i][17];
			$tessera = $fileData[$i][4];
			$qualifica = $fileData[$i][6];
			$associazione = $fileData[$i][8];
			$datan = $fileData[$i][10];
			$luogo = mysqli_real_escape_string($this->link->getDatabaseLink(),$fileData[$i][11]);
			$datatessera = $fileData[$i][13];
			$datascadenza = $fileData[$i][15];
            $datanascita = \DateTime::createFromFormat('d/m/Y',$datan);
            $datanascita = $datanascita->format("Y-m-d");
            $datatessera = \DateTime::createFromFormat('d/m/Y',$datatessera);
            $datatessera = $datatessera->format("Y-m-d");
            $datascadenza = \DateTime::createFromFormat('d/m/Y',$datascadenza);
            $datascadenza = $datascadenza->format("Y-m-d");

			if(!$this->link->query("INSERT into utenti (idutente,nome,cognome,cf,email,password,tel,tessera,qualifica,associazione,datan,luogo,datatessera,datascadenza)
                   values (null,'".$nome."','".$cognome."','".$cf."','".$email."','".md5($tessera)."','".$tel."','".$tessera."','".$qualifica."','".$associazione."','".$datanascita."','".$luogo."','".$datatessera."','".$datascadenza."') ON DUPLICATE KEY UPDATE cf = '".$cf."'")){
				return json_encode(array('success'=>false,'msg'=>$this->link->error));
			}

		}

        
		return json_encode(array('success'=>true,'msg'=>'Utenti Caricati nel Database <a href="utenti.php">Visualizza Utenti</a>'));
    }

	public function AddOrder($idutente,$transid,$totale,$sessionCart){
		$queryOrders = "INSERT INTO ordini (idordine,idutente,pagamento,transid,dataordine,totale) values (null,'".$idutente."','PayPal','".$transid."',NOW(),'".$totale."')";
		//echo $queryOrders;
		if(!$this->link->query($queryOrders)){
		    return json_encode(array('success'=>false,'msg'=>$this->link->error));
		}
		$lastid = "SELECT MAX(idordine) as lastid FROM ordini";
		$res = $this->link->query($lastid);
		$lastIdInserted = $res->fetch_row();
		//if(!$this->link->query($lastid)){
		//    return json_encode(array('success'=>false,'msg'=>$this->link->error));
		//}

		$_SESSION['ordernumber'] = $lastIdInserted[0];
		//print_r($sessionCart)."\n\r";
		foreach($sessionCart as $item){
			$queryDetOrders = "INSERT INTO  detordini (idordine,nomecorso,quantita,prezzo) VALUES ('".$lastIdInserted[0]."','".utf8_encode($item['nomecorso'])."','".$item['quantity']."','".$item['price']."')";
			//echo $queryDetOrders."<br />";
			if(!$this->link->query($queryDetOrders)){
				$this->link->close();
			    return json_encode(array('success'=>false,'msg'=>$this->link->error));

			}

		}
		$this->link->close();
	}

	public function userCountOrders($idutente){
		$queryCountOrders = "select count(*) from ordini where idutente = ".intval($idutente);
		$res = $this->link->query($queryCountOrders);
		$norders= $res->fetch_row();
		$this->link->close();
		return $norders[0];
	}

	public function editRecord($table,$columnName, $columnValue, $Id,$idcolumn)
    {
		if($columnName == 'datainiziocorso' || $columnName == 'datafinecorso' || $columnName == 'datan' || $columnName == 'datascadenza' || $columnName == 'datatessera'){

			$columnValue = self::dbConvertDate($columnValue);
			$query = "UPDATE ".$table." set " . $columnName . " = '".$columnValue."' WHERE  ".$idcolumn." = ".$Id;
		}else{
			$query = "UPDATE ".$table." set " . $columnName . " = '".utf8_decode($columnValue)."' WHERE  idcorso = ".$Id;
		}


        echo $query;
		$this->link->query($query);
		$this->link->close();
    }

	static function dbConvertDate($date){
		$dateDb = \DateTime::createFromFormat("d/m/Y",$date);
		return $dateDb->format("Y-m-d");
	}

	public function checkTessera($idutente){
		$html = '';
		$query = "SELECT * FROM utenti WHERE idutente = ".intval($idutente);
        $res = $this->link->query($query);
        $oggi = new \DateTime('today', timezone_open('Europe/Rome'));
        //var_dump($oggi);
        while($items = $res->fetch_assoc()){
            $datan = new \DateTime($items['datan']);
            $datatessera= new \DateTime($items['datatessera']);
            $datascadenza = new \DateTime($items['datascadenza']);
            $intervallo = $oggi->diff($datascadenza);
            $totalTime = intval($intervallo->format('%R%a giorni'));
            // var_dump($items);
            if($totalTime < 0){
                $html .= '<span class="alert alert-danger">Tessera Scaduta da '.$intervallo->format('%a giorni').'</span>';
            }else{
                if($totalTime < 30){
                    $html .= '<span class="alert alert-warning">Tessera in Scadenza fra '.$intervallo->format('%a giorni').'</span>';
                }else{
                    $html .= '<span class="alert alert-success">Tessera Attiva</span>';
                }
            }

		}
		return $html;
	}

}