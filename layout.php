<!DOCTYPE html>
<html lang="es">

<head>
  <meta name="google" content="notranslate">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Lovable </title>
  <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
  <link rel="stylesheet" href="assets/vendors/simplebar/css/simplebar.css">
  <link rel="stylesheet" href="assets/css/vendors/simplebar.css">
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <link href="assets/css/examples.css" rel="stylesheet">
  <link href="assets/css/mystyle.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@500&display=swap" rel="stylesheet">
  <style>
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    span,
    td,
    th,
    a,
    button,
    label,
    b,
    li,
    ul {
      font-family: 'Rubik', sans-serif;
    }

    .loader {
  position: relative;
  width: 40px;
  height: 60px;
  animation: heartBeat 1.2s infinite cubic-bezier(0.215, 0.61, 0.355, 1);
}

.loader:before,
.loader:after {
  content: "";
  background: #ff3d00 ;
  width: 40px;
  height: 60px;
  border-radius: 50px 50px 0 0;
  position: absolute;
  left: 0;
  bottom: 0;
  transform: rotate(45deg);
  transform-origin: 50% 68%;
  box-shadow: 5px 4px 5px #0004 inset;
}
.loader:after {
  transform: rotate(-45deg);
}
@keyframes heartBeat {
  0% { transform: scale(0.95) }
  5% { transform: scale(1.1) }
  39% { transform: scale(0.85) }
  45% { transform: scale(1) }
  60% { transform: scale(0.95) }
  100% { transform: scale(0.9) }
}
  </style>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <?php
  date_default_timezone_set('America/Tegucigalpa');
  session_set_cookie_params(86400);
  session_start();
  $_SESSION['DEV'] = "";
  include 'assets/php/conn.php';
  if (!isset($_SESSION["NOMUSU"]) || $_SESSION["NOMUSU"] == "") {
    header('Location: /' . $_SESSION['DEV'] . 'LovablePHP/login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    //setcookie("nombre_usuario", "", time() - 3600);
    header('Location: /' . $_SESSION['DEV'] . 'LovablePHP/login.php');
  }
  $connIBM = conexionIBM();
  ?>
  <script>
    $(document).ready(function() {
      var usuario = '<?php echo $_SESSION['CODUSU']; ?>';
      var isDev = '<?php echo $_SESSION['DEV']; ?>';
      const spinnerWrapperEl = document.querySelector('.spinner-wrapper');
      setTimeout(() => {
        spinnerWrapperEl.style.display = 'none';
      }, 1000);
      //MODULOS
      var urlModulos = 'http://172.16.15.20/API.LovablePHP/Access/LayoutM/?user=' + usuario + '';
      var responseModulos = ajaxRequest(urlModulos);
      if (responseModulos.code == 200) {
        for (let i = 0; i < responseModulos.data.length; i++) {
          $("#menu-display").append(`<li class="nav-group mt-2"><a class="nav-link nav-group-toggle" href="#">` + responseModulos.data[i]['APLDES'] + `</a>
                                          <ul class="nav-group-items">
                                            <div id="` + responseModulos.data[i]['DETC91'] + `">
                                          </div>
                                        </ul>
                                      </li>`);
        }
      }
      //SUBMODULOS
        var urlSubModulosCount='http://172.16.15.20/API.LovablePHP/Access/LayoutSCount/?user='+usuario+'';
        var responseSMCount = ajaxRequest(urlSubModulosCount);
        var urlSubModulos='http://172.16.15.20/API.LovablePHP/Access/LayoutS/';
        var responseSM = ajaxRequest(urlSubModulos);
        if (responseSM.code==200) {
          for (let i = 0; i < responseSM.data.length; i++) {
           for (let j = 0; j < responseSMCount.data.length; j++) {
              if (responseSM.data[i]['CATSE1']==responseSMCount.data[j]['CATSEC']) {
                  $("#"+responseSMCount.data[j]['DETC91']+"").append(`<li class="nav-group mt-2" aria-expanded="false">
                                      <a class="nav-link nav-group-toggle" href="#">` + responseSM.data[i]['CATDES'] + `</a>
                                          <ul class="nav-group-items">
                                            <div id="`+responseSMCount.data[j]['DETC91']+"-"+responseSM.data[i]['CATSE1'] + `">
                                              <li class="nav-item" id="hiddenli"><a class="nav-link" href="#"><span class="nav-icon"></span></a></li>
                                          </div>
                                        </ul>
                                      </li>`);
              }
           }
          }
        }

     //PROGRAMAS
      var urlProgramas='http://172.16.15.20/API.LovablePHP/Access/LayoutP2/?user='+usuario+'';
      var responsePRG= ajaxRequest(urlProgramas);
      if (responsePRG.code==200) {
        function descripcionPrograma(row) {
            let programa = row.trim().replace(/\s+/g, ' ').split(' ');
            let programaDescripcion = "";
            for (let i = 0; i < programa.length; i++) {
              if ((i + 1) % 3 === 0) {
                programaDescripcion += programa[i] + "<br>";
              } else {
                programaDescripcion += programa[i] + " ";
              }
            }
            return programaDescripcion;
          }
        for (let i = 0; i < responsePRG.data.length; i++) {
          $("#"+responsePRG.data[i]['DETC91']+"-"+responsePRG.data[i]['CATSEC']+"").append(`<li class="nav-item">
                                                                    <a class="nav-link" href="/`+isDev+`LovablePHP/PRG/`+responsePRG.data[i]['DETC91']+`/`+responsePRG.data[i]['CATNOM']+`.php">
                                                                    <span class="nav-icon"></span>`+descripcionPrograma(responsePRG.data[i]['CATDE1'])+`
                                                                    </a>
                                                                </li>`);
           $("#"+responsePRG.data[i]['DETC91']+"-"+responsePRG.data[i]['CATSEC']+" #hiddenli").remove();
        }
      }

      //PROGRAMAS
      /* var urlProgramas='http://172.16.15.20/API.LovablePHP/Access/LayoutP/?user='+usuario+'';
        var responseProgramas = ajaxRequest(urlProgramas);
      if (responseProgramas.code==200) {
        function descripcionPrograma(row) {
            let programa = row.trim().replace(/\s+/g, ' ').split(' ');
            let programaDescripcion = "";
            for (let i = 0; i < programa.length; i++) {
              if ((i + 1) % 3 === 0) {
                programaDescripcion += programa[i] + "<br>";
              } else {
                programaDescripcion += programa[i] + " ";
              }
            }
            return programaDescripcion;
          }
        for (let i = 0; i < responseProgramas.data.length; i++) {
            $("#"+responseProgramas.data[i]['DETC91']+"").append(`<li class="nav-item">
                                                                    <a class="nav-link" href="/`+isDev+`LovablePHP/PRG/`+responseProgramas.data[i]['DETC91']+`/`+responseProgramas.data[i]['CATNOM']+`.php">
                                                                    <span class="nav-icon"></span>`+descripcionPrograma(responseProgramas.data[i]['CATDE1'])+`
                                                                    </a>
                                                                </li>`);
          $("#"+responseProgramas.data[i]['DETC91']+" #hiddenli").remove();
          }
        }*/
    });
  </script>


  <div class="sidebar bg-blck sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex p-4"><a href="/<?php echo $_SESSION['DEV'] ?>LovablePHP/<?php echo $_SESSION['INDEX']; ?>">
        <img src="assets/img/lovableLogoDark.jpg" class="img-fluid" alt="Lovable Logo"></a>
    </div>
    <ul class="sidebar-nav bg-blck2 mt-3" data-coreui="navigation" data-simplebar="">
      <li class="nav-item mt-3"><a class="nav-link" href="<?php echo $_SESSION['INDEX']; ?>">
          <svg class="nav-icon">
            <use xlink:href="assets/vendors/@coreui/icons/svg/free.svg#cil-home"></use>
          </svg>
          Página principal</a>
      </li>
      <hr>
      <div id="menu-display">
    
      </div>
    </ul>

  </div>
  <div class="wrapper d-flex flex-column min-vh-100  bg-light">
    <header class="header header-sticky mb-4">
      <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
          <svg class="icon icon-lg">
            <use xlink:href="assets/vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
          </svg>
        </button><a class="header-brand d-md-none" href="/<?php echo $_SESSION['DEV'] ?>LovablePHP/">
          <img src="assets/img/lovableLogo.png" width="205px" alt="Lovable Logo">
        </a>
        <ul class="header-nav d-none d-md-flex">
        </ul>
        <ul class="header-nav ms-auto mt-2">
          <div class="mt-2 me-4">
            <h6><?php echo isset($_SESSION["NOMUSU"]) ? $_SESSION["NOMUSU"] : ""; ?></h6>
          </div>
          <button type="button" class="btn btn-light" onclick="logOut()">
            <svg class="icon me-2">
              <use xlink:href="assets/vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
            </svg>
          </button>
        </ul>

      </div>
      <div class="header-divider"></div>
      <script src="assets/vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
      <script src="assets/vendors/simplebar/js/simplebar.min.js"></script>
      <script src="assets/vendors/@coreui/utils/js/coreui-utils.js"></script>
      <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
      <script>
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
            success: function(response) {
              dataResponse = response;
            },
            error: function(jqXHR, exception) {
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
              } else if (exception === 'parsererror') {
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

        function logOut() {
          window.location.assign('/<?php echo $_SESSION['DEV'] ?>LovablePHP/index.php?logout=1');
        }
      </script>

</body>

</html>