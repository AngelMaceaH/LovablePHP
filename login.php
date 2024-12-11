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
    <style>
      .login,
      .image {
        min-height: 100vh;
      }
      .bg-image1, .bg-image2, .bg-image3 {
        animation: carouselAnimation 5s infinite;
      }
      .bg-image1 {
        background-image: url('assets/img/loginbg1.jpg');
        background-size: cover;
        background-position: center center;
        animation-delay: 0s;
      }
      .bg-image2 {
        background-image: url('assets/img/loginbg2.jpg');
        background-size: cover;
        background-position: center center;
        animation-delay: 0s;
      }
      .bg-image3 {
        background-image: url('assets/img/loginbg3.jpg');
        background-size: cover;
        background-position: center center;
        animation-delay: 0s;
      }
      @keyframes carouselAnimation {
        0% {
          opacity: 0.4;
        }
        33% {
          opacity: 1;
        }
        66% {
          opacity: 1;
        }
        100% {
          opacity: 0.4;
        }
      }


    </style>
  </head>
  <body>
    <?php
      if (substr($_SERVER['REMOTE_ADDR'], 0, 4) !== '172.') {
          http_response_code(403);
          //echo json_encode(["error" => "Acceso denegado"]);
          exit;
      }else{
        session_start();
      }
    ?>
    <div class="container-fluid  m-0">
    <div class="row no-gutter">
        <div class="col-md-6">
            <div class="login d-flex align-items-center py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-xl-7 mx-auto text-center">
                        <img src="assets/img/lovableLogo.png" class="mb-5 ms-4" alt="Lovable Logo" width="275px">
                            <form action="assets/php/access/access.php" method="POST" class="needs-validation" novalidate>
                <h5 class="text-start">Inicia Sesión</h5>
                <p class="text-medium-emphasis"> </p>
                        <div class="row">
                          <div class="col-12">
                          <div class="input-group mb-3 mt-1 has-validation">
                              <span class="input-group-text" id="inputGroupPrepend">
                                <svg class="icon">
                                  <use xlink:href="assets/vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                              </svg>
                              </span>
                              <input class="form-control" type="text" id="user" name="user" oninput="uppercase(this)" placeholder="Usuario" id="validationCustomUsername" aria-describedby="inputGroupPrepend" autocomplete="off" required>
                              <div class="invalid-feedback text-start">
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
                            <input class="form-control" type="password" id="password" name="password" placeholder="Contraseña" id="validationCustomPassword" aria-describedby="inputGroupPrepend" autocomplete="off" required>
                            <div class="invalid-feedback text-start">
                                  Ingrese una contraseña.
                            </div>
                          </div>
                          <div id="Labelerror" class="Labelerror mb-3 text-start" ></div>
                        </div>


                        <div class="col-12">
                          <button class="btn bg-blck btn-dark px-5" type="submit">Ingresar</button>
                        </div>
                      </form>
                        </div>
                    </div>
                </div><!-- End -->

            </div>
        </div><!-- End -->
  <!-- The image half -->
      <div class="col-md-6 d-none d-md-flex bg-image m-0 p-0">
        <div class="row" style="width:100%">
        <div style="width:100%" id="bg-image1" class="bg-image1 col-12"></div>
        <div style="width:100%" id="bg-image2" class="bg-image2 d-none col-12"></div>
        <div style="width:100%" id="bg-image3" class="bg-image3 d-none col-12"></div>
        </div>
      </div>

    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      function bg1(){
            $("#bg-image1").removeClass('d-none');
            $("#bg-image2").addClass('d-none');
            $("#bg-image3").addClass('d-none');
            setTimeout(bg2, 4000);
        }

        function bg2(){
            $("#bg-image1").addClass('d-none');
            $("#bg-image2").removeClass('d-none');
            $("#bg-image3").addClass('d-none');

            setTimeout(bg3, 4000);
        }

        function bg3(){
            $("#bg-image1").addClass('d-none');
            $("#bg-image2").addClass('d-none');
            $("#bg-image3").removeClass('d-none');

            setTimeout(bg1, 4000);
        }

        bg1();


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