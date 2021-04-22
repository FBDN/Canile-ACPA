<?php
session_start();
require_once '../vendor/autoload.php';
use Fbdn\Utilities\Utility;
$db = new Utility();
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>ACPA Cesena - Aggiungi foto</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/gijgo/1.9.13/combined/css/gijgo.min.css" rel="stylesheet"/>
  <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include 'sidebar.php'?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include 'nav.php'?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Fotografie Canile</h1>
          <p class="mb-4">Aggiungi Foto</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3 text-center">
              <h6 class="m-0 font-weight-bold text-primary">Foto Canile Cesena</h6>
            </div>
            <div class="card-body">
              <form class="foto" action="postFoto.php" method="post" id="aggiungifoto" enctype="multipart/form-data">
                
                
                <div class="row">
                 
                 
                  
                  <div class="col">
                    <div class="form-group">
                        <label for="stato">Seleziona Categoria</label>
                       <select class="form-control"  name="categoria">
                        <option value="">Seleziona</option>
                        <?php
						echo $db->getCategoria("categorie");
                        ?>
                      </select>
                    </div>
                  </div>
                  
                </div>
                <div class="row">
                </div>
                  <div class="row">
                      
                     
                  </div>
                  <div class="row">
                      <div class="col">
                    <div class="form-group">
                        <!--<label for="editorprogramma">Note</label>
                        <textarea class="form-control form-control-user" id="editorprogramma" name="editorprogramma" placeholder="Programma"></textarea>-->
                        <script>
    

    CKEDITOR.replace('editorprogramma', {
      toolbar: [{
          name: 'document',
          items: ['Print']
        },
        {
          name: 'clipboard',
          items: ['Undo', 'Redo']
        },
        {
          name: 'styles',
          items: ['Format', 'Font', 'FontSize']
        },
        {
          name: 'colors',
          items: ['TextColor', 'BGColor']
        },
        {
          name: 'align',
          items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
        },
        '/',
        {
          name: 'basicstyles',
          items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'CopyFormatting']
        },
        {
          name: 'links',
          items: ['Link', 'Unlink']
        },
        {
          name: 'paragraph',
          items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
        },
        {
          name: 'insert',
          items: ['Image', 'Table']
        },
        {
          name: 'tools',
          items: ['Maximize']
        },
        {
          name: 'editing',
          items: ['Scayt']
        }
      ],

      extraAllowedContent: 'h3{clear};h2{line-height};h2 h3{margin-left,margin-top}',

     
    });
  </script>
                    </div>
                  </div>
                    
                  </div>
                  <div class="row">
                      <div class="col">
                          <label id="labelInput" class="btn btn-success"><i class="fas fa-upload"></i> Carica Immagine</label>
                          <input id ="fileElem" type="file" name="file[]" class="form-control-file" multiple/>
                          
                      </div>
                      
                  </div>
				  <div class="row">
                  <div class="col mt-5 text-center">
                    <button id="salva" type="submit" class="btn btn-primary d-inline">Salva</button>
                    <button type="reset" class="btn btn-secondary d-inline reset">Cancella</button>
                    <input type="hidden" name="upload" value="1" />
                  </div>
                </div>
				  <div class="container">
					  <div class="col-md-12">
						  <img class="loader" src="../ajax/img/loader.gif" />
					  </div>
				  </div>
				  <div class="container">
					  <div class="col-md-12">
						  <div id="preview"></div>
					  </div>
				  </div>
                  <div class="row">
                      <div class="col">
                          <div class="alert"></div>
                      </div>
                  </div>
                
              </form>
          </div>
        </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; ACPA CESENA <?php echo date("Y");?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
     <!--Result Modal-->

    <div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="resultModal" aria-hidden="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">AVVISO</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <i class="fas fa-check-double alert alert-success"></i>
                    <span>
                        <?php echo $_GET['msg'];?>
                    </span>
                </div>

            </div>
        </div>
    </div>

    <!--End Result Modal-->
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Vai via?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Selezione "Logout" se sei pronto a terminare la sessione.</div>
        <div class="modal-footer">  
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Annullla</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> 
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gijgo/1.9.13/combined/js/gijgo.min.js"></script>
    <script src="js/messages.it-it.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>  
    <script type="text/javascript" src="js/filePreview.js"></script>
   <script>
       $('#data_inizio_corso').datepicker({ locale : 'it-it', format:'dd/mm/yyyy' });
       $('#data_fine_corso').datepicker({locale:'it-it', format:'dd/mm/yyyy'});
    </script>
    <?php if(isset($_GET['msg']) && !empty($_GET['msg'])){?>
    <script type="text/javascript">
        $('#resultModal').modal('show');
    </script>
    <?php } ?>
</body>

</html>
