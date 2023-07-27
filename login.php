<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Lovable - Inicio Sesión</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/mystyle.css" rel="stylesheet">
  </head>
  <body>
    <?php
      session_start();
    ?>
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="card-group d-block d-md-flex row">
              <div class="card col-md-7 p-4 mb-0">
                <div class="card-body">
                <form action="assets/php/access/access.php" method="POST" class="needs-validation" novalidate>
                <h1>Inicia Sesión</h1>
                <p class="text-medium-emphasis"> </p>
                        <div class="row">
                          <div class="col-12">
                          <div class="input-group mb-3 has-validation">
                              <span class="input-group-text" id="inputGroupPrepend">
                                <svg class="icon">
                                  <use xlink:href="assets/vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                              </svg>
                              </span>
                              <input class="form-control" type="text" id="user" name="user" oninput="uppercase(this)" placeholder="Usuario" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                              <div class="invalid-feedback">
                                   Ingrese un usuario.
                              </div>
                            </div>
                          </div>
                          <div class="input-group mb-4 has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">
                            <svg class="icon">
                              <use xlink:href="assets/vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                            </svg>
                            </span>
                            <input class="form-control" type="password" id="password" name="password" placeholder="Contraseña" id="validationCustomPassword" aria-describedby="inputGroupPrepend" required>
                            <div class="invalid-feedback">
                                  Ingrese una contraseña.
                            </div>
                          </div>
                          <div id="Labelerror" class="Labelerror mb-3" ></div>
                        </div>
                        
                        
                        <div class="col-12">
                          <button class="btn bg-blck btn-dark px-5" type="submit">Ingresar</button>
                        </div>
                      </form>
                </div>
              </div>
              <div class="card col-md-5 text-white bg-blck py-5">
                <div class="card-body text-center">
                <div class="position-absolute top-50 start-50 translate-middle">
                   <img src="assets/img/lovableLogoDark.jpg" class="img-fluid" alt="Lovable Logo">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <script>
        $( document ).ready(function() {
          function ajaxRequest(url, data = {}, method = "GET") {
          var dataResponse = null;
          var Token = null;
          var HTTPError = {
              message: '',
              code: 0,
              success: false,
              data: null
          };
          $.ajax({
              url: url,
              data: JSON.stringify(data),
              method: method,
              dataType: "json",
              headers: {
                  'Content-Type': 'application/json',
              },
              async: false,
              success: function (response) {
                  dataResponse = response;
              },
              error: function (jqXHR, exception) {
                  HTTPError.code = jqXHR.status;
                  HTTPError.data = jqXHR;
                  HTTPError.message += "Request http Error: " + url + ", Exception: ";
                  // http errors 
                  if (jqXHR.status === 0) {
                      HTTPError.message += 'Not connect.\n Verify Network.';
                  } else if (jqXHR.status == 404) {
                      HTTPError.message += 'Requested page not found. [404]';
                  } else if (jqXHR.status == 500) {
                      HTTPError.message += 'Internal Server Error [500].';
                  } else if (jqXHR.status == 401) {
                      HTTPError.message += 'Unauthorized Server Action [401].';
                  }
                  else if (exception === 'parsererror') {
                      HTTPError.message += 'Requested JSON parse failed.';
                  } else if (exception === 'timeout') {
                      HTTPError.message += 'Time out error.';
                  } else if (exception === 'abort') {
                      HTTPError.message += 'Ajax request aborted.';
                  } else {
                      HTTPError.message += jqXHR.responseText;
                  }
                  dataResponse = HTTPError;
                  console.log(HTTPError);
              }
          });
          return dataResponse;
          }
                
      var val = "<?php echo isset($_SESSION["val"]) ? $_SESSION["val"] : "";?>";
      if (val=="2" && $("#user").val()!=' ' && $("#password").val()!=' ') {
        $( "#Labelerror" ).append( "El usuario y/o la contraseña son incorrectos." );
        <?php session_destroy(); ?>
      }else{
        $('#Labelerror').empty();
      }
      });

        var forms = document.querySelectorAll('.needs-validation')
      // Loop over them and prevent submission
      Array.prototype.slice.call(forms)
        .forEach(function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
              $("#Labelerror").remove();
            }else{
             
            }

            form.classList.add('was-validated')
          }, false)
        })
    
        function uppercase(this_) {
          var upper = this_.value.toUpperCase();
          return this_.value = upper;
        }
    </script>

  </body>
</html>