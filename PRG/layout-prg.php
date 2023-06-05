<!DOCTYPE html>
<html lang="es">
  <head>
  <meta name="google" content="notranslate">
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Lovable </title>
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
    <link rel="stylesheet" href="../../assets/vendors/simplebar/css/simplebar.css">
    <link rel="stylesheet" href="../../assets/css/vendors/simplebar.css">
    <link href="../../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css" />
   
    <link href="../../assets/css/examples.css" rel="stylesheet">
    <link href="../../assets/css/mystyle.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js"
        integrity="sha512-2bMhOkE/ACz21dJT8zBOMgMecNxx0d37NND803ExktKiKdSzdwn+L7i9fdccw/3V06gM/DBWKbYmQvKMdAA9Nw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@500&display=swap" rel="stylesheet">
    <style>
        h1,h2,h3,h4,h5,h6,p,span,td,th,a,button,label,b,li,ul{
    font-family: 'Rubik', sans-serif;
      }
    </style>
  </head>
  <body>
        <?php
          date_default_timezone_set('America/Tegucigalpa');
          session_set_cookie_params(86400);
          session_start();
          $_SESSION['DEV']="";

          include '../../assets/php/conn.php';
          if($_SESSION["NOMUSU"] == ""){
              header('Location: /'.$_SESSION['DEV'].'LovablePHP/login.php');
          }
          if(isset($_GET['logout'])){
              session_destroy();
              header('Location: /'.$_SESSION['DEV'].'LovablePHP/login.php');
          } 
          $connIBM=conexionIBM();
        ?>
        <script>    
         $( document ).ready(function() {
              const spinnerWrapperEl = document.querySelector('.spinner-wrapper');
              setTimeout(() => {spinnerWrapperEl.style.display = 'none';}, 500);
          var usuario='<?php echo $_SESSION['CODUSU'];?>';
          var isDev='<?php echo $_SESSION['DEV'];?>';
           //MODULOS
            var urlModulos='http://172.16.15.20/API.LovablePHP/Access/LayoutM/?user='+usuario+'';
            var responseModulos = ajaxRequest(urlModulos);
            if (responseModulos.code==200) {
            for (let i = 0; i < responseModulos.data.length; i++) {
              $("#menu-display").append(`<li class="nav-group mt-2"><a class="nav-link nav-group-toggle" href="#">
              `+responseModulos.data[i]['APLDES']+`</a>
                                          <ul class="nav-group-items">
                                            <div id="`+responseModulos.data[i]['DETC91']+`">
                                              <li class="nav-item" id="hiddenli"><a class="nav-link" href="#"><span class="nav-icon"></span></a></li>
                                            </div>
                                          </ul>
                                          </li>`);
            }
          }
           //PROGRAMAS
            var urlProgramas='http://172.16.15.20/API.LovablePHP/Access/LayoutP/?user='+usuario+'';
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
            }
       
        });
        </script>
      
    <div class="sidebar bg-blck sidebar-fixed" id="sidebar">
   
      <div class="sidebar-brand d-none d-md-flex p-4"><a href="/<?php echo $_SESSION['DEV'] ?>LovablePHP/<?php echo $_SESSION['INDEX']; ?>">
        <img src="../../assets/img/lovableLogoDark.jpg" class="img-fluid" alt="Lovable Logo"></a>
      </div>
      <ul class="sidebar-nav bg-blck2 mt-3" data-coreui="navigation" data-simplebar="">
        <li class="nav-item mt-3"><a class="nav-link" href="/<?php echo $_SESSION['DEV'] ?>LovablePHP/<?php echo $_SESSION['INDEX']; ?>">
        <svg class="nav-icon">
              <use xlink:href="../../assets/vendors/@coreui/icons/svg/free.svg#cil-home"></use>
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
              <use xlink:href="../../assets/vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
            </svg>
          </button><a class="header-brand d-md-none" href="/<?php echo $_SESSION['DEV'] ?>LovablePHP/">
             <img src="../../assets/img/lovableLogo.png" width="205px" alt="Lovable Logo">
            </a>
          <ul class="header-nav d-none d-md-flex">
          </ul>
          <ul class="header-nav ms-auto mt-2">
            <div class="mt-2 me-4">
                <h6><?php echo isset($_SESSION["NOMUSU"]) ? $_SESSION["NOMUSU"] : ""; ?></h6>
            </div>
                <button type="button" class="btn btn-light" onclick="logOut()">
                  <svg class="icon me-2">
                    <use xlink:href="../../assets/vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                  </svg>
                </button>
          </ul>
          
        </div>
        <div class="header-divider"></div>
    <script src="../../assets/vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
    <script src="../../assets/vendors/simplebar/js/simplebar.min.js"></script>
    <script src="../../assets/vendors/@coreui/utils/js/coreui-utils.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"> </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"> </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"> </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"> </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"> </script>
    <script type="text/javascript" charset="utf8"
        src="../../assets/js/buttons.html5.js"> </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"> </script>
    <!--<script src="../../js/table.js"></script>-->
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
          $(function() {
                var tabs = $('.tablist__tab'),
                    tabPanels = $('.tablist__panel');
                tabs.on('click', function() {
                    var thisTab = $(this),
                        thisTabPanelId = thisTab.attr('aria-controls'),
                        thisTabPanel = $('#' + thisTabPanelId);
                    tabs.attr('aria-selected', 'false').removeClass('is-active');
                    thisTab.attr('aria-selected', 'true').addClass('is-active');
                    tabPanels.attr('aria-hidden', 'true').addClass('is-hidden');
                    thisTabPanel.attr('aria-hidden', 'false').removeClass('is-hidden');
                });
                tabs.on('keydown', function(e) {
                    var thisTab = $(this);
                    if(e.which == 13) {
                    thisTab.click();
                    }
                });
                
          });

      function logOut() {
        window.location.assign('/<?php echo $_SESSION['DEV'] ?>LovablePHP/index.php?logout=1');
      }
    </script>
  </body>
</html>
