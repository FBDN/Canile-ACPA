<?php include 'classes/header.php';?>
		
		<!-- <div class="alert alert-warning"><h2>Causa maltempo ci scusiamo per la Bassa Qualità delle foto della GF Dolci Terre di Novi 2017</h2></div> -->
<!-- <div class="container content col-md-12 bg-success">
<h1>Le Nostre Adozioni</h1>
</div> -->
		
<div class="container fotoContainer"> 
<?php //include 'photos.php';?>
	
		<?php echo $db->getTable('foto','idcategoria=4','row',3); ?>
	
	
</div>
		
		<?php include 'classes/footer.php';?>
	

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script type="text/javascript">
	$(function () {
		$('.fotoContainer').masonry({
  // options
  itemSelector: '.image-item',
  columnWidth: 200
});
	});
</script>
</body>
</html>