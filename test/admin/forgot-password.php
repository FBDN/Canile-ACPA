<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Functional Move - Forgot Password</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Hai dimentiato la  Password?</h1>
                    <p class="mb-4">Scrivi il tuo indirizzo email e ti manderemo un link per resettare la password</p>
                  </div>
                  <form id="reset" class="user" enctype="multipart/form-data">
                    <div class="form-group">
                      <input type="email" name="email" class="email form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Scrivi l'indirizzo Email..." required>
                        <input type="hidden" name="reset" value="1" />
                    </div>
					  <div class="ajaxloader col-md-12 text-center"><img src="../img/ajax/loader.gif"></div>
                    <button type="submit" class="reset btn btn-primary btn-user btn-block">
                      Resetta Password
                    </button>
                  </form>
                    
                </div>
                 
              </div>
                 <div class="col-md-12 m-0 p-4 text-center alert"></div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

    <script type="text/javascript">
		$(function () {
			$('.ajaxloader').hide();
            $("#reset").on("submit", function (e) {
				e.preventDefault();
				$('.alert').removeClass('alert-danger');
				$('.alert').removeClass('alert-success');
                var formElement = document.querySelector("form");
                $.ajax({
                    url: 'resetPassword.php',
                    type: 'post',
                    data: new FormData(formElement),
                    processData: false,
                    contentType: false,
					dataType: 'json',
					beforeSend: function () {
						$('.ajaxloader').show();
					},
					success: function (data) {
						$('.ajaxloader').hide();
						if (data.success == false) {

							$('.alert').addClass('alert-danger').html(data.msg);
						} else {
							$('.alert').addClass('alert-success').html(data.msg);
						}
                        
					}
                });
            });
        });
    </script>
</body>

</html>
