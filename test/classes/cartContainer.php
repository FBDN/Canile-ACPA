<?php
session_start();
if(isset($_SESSION["cart_item"]) && count($_SESSION['cart_item'])!==0){
    $item_total = 0;
    //var_dump($_SESSION['cart_item']);
?>	
<h3>CARRELLO</h3>
<!-- start cart table -->
<table class="table table-dark">
<tbody>
<tr>
<th scope="col"><strong>Gara</strong></th>
<th scope="col"><strong>Fotografia</strong></th>
<th scope="col"><strong>Quantit&agrave;</strong></th>
<th scope="col"><strong>Prezzo</strong></th>
<th scope="col">Pettorale</th>
<th scope="col"></th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
		?>
				<tr>
				<td><?php echo $item['gara'];?></td>
				<td><?php echo $item["name"]; ?></td>
				<td><?php echo $item["quantity"]; ?></td>
				<td><?php echo "&#8364;".$item["price"]; ?></td>
				<td><?php echo $item['tag'];?></td>
				<td><a data-toggle="tooltip" onClick="cartAction('remove','<?php echo $item["code"]; ?>')" class="btn btn-danger btnRemoveAction cart-action" title="Rimuovi Fotografia"><span class="glyphicon glyphicon-trash"></span></a></td>
				</tr>
				<?php
        $item_total += ($item["price"]*$item["quantity"]);
		}
		?>
</tbody>


</table>
<div class="container col-md-12">
<!-- RESPONSIVE ICONS FOR EXTRA SMALL DEVICES 
<a href="index.php"  class="btn btn-success visisble-xs hidden-lg hidden-md" title="Continua gli Acquisti"><span class="glyphicon glyphicon-shopping-cart"></span></a>
<a href="" onclick="cartAction('empty');" class="btn btn-danger visible-xs"  title="Svuota Carrello"><span class="glyphicon glyphicon-trash"></span></a>
  <a href="" class="btn btn-primary visible-xs" title="Paga Adesso"><span class="glyphicon glyphicon-euro"></span></a>
<!-- END RESPONSIVE -->
<a href="index.php"  class="btn btn-success" ><span class="glyphicon glyphicon-shopping-cart"></span> Continua gli Acquisti</a>
<a href="" onclick="cartAction('empty');" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Svuota Carrello</a>
  <hr>
  <div class="row">
  <div class="col-md-4">
  <div class="text-center alert alert-warning">
  <h3>Spedisci a</h3>
  </div>
  <div>
  <p>Francesco Biagini</p>
  <p>Via A. Arcangeli, 29</p>
  <p>47042 - Cesenatico - (FC)</p>
  </div>
  <!-- Accordion scelta indirizzo -->
  <div id="accordion" class="panel-group">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-paperclip"></span> Aggiungi un Altro Indirizzo</a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse">
            <div class="panel-body">
                       <form class="form-horizontal">
  <div class="form-group">
  <label class="control-label">Nome</label>
  <input type="text" value="" class="form-control" placeholder="Inserisci Nome">
  </div>
  <div class="form-group">
  <label class="control-label">Cognome</label>
  <input type="text" value="" class="form-control" placeholder="Inserisci Cognome">
  </div>
  <div class="form-group">
  <label class="control-label">Telefono</label>
  <input type="text" value="" class="form-control" placeholder="Inserisci Telefono">
  </div>
  <div class="form-group">
  <label class="control-label">Via</label>
  <input type="text" value="" class="form-control" placeholder="Inserisci Via">
  </div>
  <div class="form-group">
  <label class="control-label">Citt&agrave;</label>
  <input type="text" value="" class="form-control" placeholder="Inserisci Citt&agrave;">
  </div>
  <div class="form-group">
  <label class="control-label">Cap</label>
  <input type="text" value="" class="form-control" placeholder="Inserisci Cap">
  </div>
  <div class="form-group">
  <label class="control-label">Stato</h4></label>
  <input type="text" value="" class="form-control" placeholder="Inserisci Stato">
  </div>
  <div class="form-group">
  <div class="checkbox">
  <label>
  <input type="checkbox" value="">
  Acconsento al Trattamento dei Dati Secondo la norma vigente sulla Privacy
  </label>
  </div>
  </div>
  <button type="submit" class="btn btn-success">Salva</button>
  </form>
            </div>
        </div>
<!-- fine accordion -->
  </div>
  </div>
  </div>
  <div class="text-right col-md-4 col-md-offset-4">
  <div class="text-center alert alert-warning">
  <h3>Cassa</h3>
  </div>
  <strong><h4>SUBTOTALE: </strong>&euro; <?php echo floatval($item_total);?></h4>
  <strong><h4>SPEDIZIONE: </strong>&euro; <?php echo floatval(6.00);?></h4>
  <strong><h4 class="text-danger">TOTALE: </strong>&euro; <?php echo floatval($item_total + 6.00);?></h4>
  <div><a href="#" class="btn btn-primary"><span class="glyphicon glyphicon-euro"></span> Paga Adesso con PayPal</a></div>
  </div>
  </div>
  <hr>
</div>

<!-- end cart table -->
  <?php
}else{
    ?>
    <div class="container col-md-12">
    <div class="row text-center center-block">
    <h1 class="text-danger" style="text-transform: uppercase;">Il Carrello &egrave; Vuoto</h1>
    <div class="row">
    <a href="index.php"  class="btn btn-primary" ><span class="glyphicon glyphicon-shopping-cart"></span> Torna al Sito</a>
    </div>
    </div>
    </div>
    <?php 
}
?>