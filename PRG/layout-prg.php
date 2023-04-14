<!DOCTYPE html>
<html>
  <head>
  <meta name="google" content="notranslate">
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Lovable </title>
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
    <link rel="stylesheet" href="../../vendors/simplebar/css/simplebar.css">
    <link rel="stylesheet" href="../../css/vendors/simplebar.css">
    <link href="../../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link href="../../css/examples.css" rel="stylesheet">
    <link href="../../css/mystyle.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js"
        integrity="sha512-2bMhOkE/ACz21dJT8zBOMgMecNxx0d37NND803ExktKiKdSzdwn+L7i9fdccw/3V06gM/DBWKbYmQvKMdAA9Nw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </head>
  <body>
 
        <?php
          date_default_timezone_set('America/Tegucigalpa');
          session_set_cookie_params(86400);
          session_start();
          include '../../php/conn.php';
          if($_SESSION["NOMUSU"] == ""){
              header('Location: /LovablePHP/login.php');
          }
          if(isset($_GET['logout'])){
              session_destroy();
              header('Location: /LovablePHP/login.php');
          } 
          $connIBM=conexionIBM();
          $sqlModulos= "SELECT DETA16.DETC91, APLARC.APLDES, COUNT(*) as count 
          FROM LBPRDDAT/DETA16
          INNER JOIN LBPRDDAT/APLARC ON DETA16.DETC91 = APLARC.APLCOD
          WHERE DETA16.DETUSU='".$_SESSION["CODUSU"]."' AND DETA16.DETC91 LIKE 'Z%'
          GROUP BY DETA16.DETC91, APLARC.APLDES";
          $resultModulos=odbc_exec($connIBM,$sqlModulos);
          $sqlProgramas= "SELECT DETA16.DETC91, CATA99.CATNOM, CATA99.CATDE1, COUNT(*) as count 
          FROM LBPRDDAT/DETA16
          INNER JOIN LBPRDDAT/CATA99 ON DETA16.DETPR1 = CATA99.CATNOM
          WHERE DETA16.DETUSU='".$_SESSION["CODUSU"]."' AND DETA16.DETC91 LIKE 'Z%'
          GROUP BY DETA16.DETC91, CATA99.CATNOM, CATA99.CATDE1" ;
        ?>
        <script>    
         $( document ).ready(function() {
              const spinnerWrapperEl = document.querySelector('.spinner-wrapper');
              setTimeout(() => {
                    spinnerWrapperEl.style.display = 'none';
                }, 1000);
                function tableInit(name) {
                   var table = $(name).DataTable( {
                      "ordering": false,
                    "pageLength": 100,
                    "language": {
                        url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                    },
                    "columnDefs": [
                    {
                        target: 0,
                        visible: false,
                        searchable: false,
                    },
                    {
                        target: 1,
                        visible: false,
                        searchable: true,
                    },
                    {
                        target: 3,
                        visible: true,
                        searchable: false,
                    },
                    {
                        target: 4,
                        visible: true,
                        searchable: false,
                    },
                  ],
                  } );
                  return table;
                }
                tableInit("#myTable");
                tableInit("#myTableAnual");
                tableInit("#myTableTransacciones");

                
              var table2 = $('#myTable2, myTable3').DataTable( {
                "ordering": false,
                "pageLength": 100,
                "language": {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                },
                "columnDefs": [
                {
                    target: 0,
                    visible: false,
                    searchable: false,
                },
              ],
              } );
              var tableFac = $('#myTableFactura').DataTable( {
                "searching": false,
                "paging": false,
                "lengthChange": false,
                "bInfo" : false,
                "ordering": false,
                "pageLength": 100,
                "language": {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                },
                "columnDefs": [
                {
                    target: 0,
                    visible: false,
                    searchable: false,
                },
              ],
              } );
              
          <?php
          while($rowLM= odbc_fetch_array($resultModulos)){
            $modulo = explode(" ", ucfirst(strtolower(rtrim(utf8_encode($rowLM['APLDES'])))));
            $moduloDescripcion = "";
            for ($i = 0; $i < count($modulo); $i++) {
                if (($i + 1) % 3 == 0) {
                    $moduloDescripcion .= $modulo[$i] . "<br>";
                } else {
                    $moduloDescripcion .= $modulo[$i] . " ";
                }
            }
            echo '$("#menu-display").append(\'<li class="nav-group mt-2"><a class="nav-link nav-group-toggle" href="#">\
            '.$moduloDescripcion.'\</a>\
            <ul class="nav-group-items">\
              <div id="'.$rowLM['DETC91'].'">\
                <li class="nav-item" id="hiddenli"><a class="nav-link" href="#"><span class="nav-icon"></span></a></li>\
              </div>\
            </ul>\
            </li>\');';
         
            $resultProgramas=odbc_exec($connIBM,$sqlProgramas);
            while ($rowPR= odbc_fetch_array($resultProgramas)) {
              $programa = explode(" ", ucfirst(strtolower(rtrim(utf8_encode($rowPR['CATDE1'])))));
              $programaDescripcion = "";
              for ($i = 0; $i < count($programa); $i++) {
                  if (($i + 1) % 3 == 0) {
                      $programaDescripcion .= $programa[$i] . "<br>";
                  } else {
                      $programaDescripcion .= $programa[$i] . " ";
                  }
              }
              if ($rowPR['DETC91']==$rowLM['DETC91']) {
                echo '$("#'.$rowLM['DETC91'].'").append("<li class=\"nav-item\"><a class=\"nav-link\" href=\"/LovablePHP/PRG/'.$rowPR['DETC91'].'/'.preg_replace('/\s+/', '', $rowPR['CATNOM']).'.php\"><span class=\"nav-icon\"></span>'.$programaDescripcion.'</a></li>");';
                echo "$('#".$rowLM['DETC91']." #hiddenli').remove();";
              }
            }
          }
          ?>
       
        });
        </script>
      
    <div class="sidebar bg-blck sidebar-fixed" id="sidebar">
   
      <div class="sidebar-brand d-none d-md-flex p-4"><a href="/LovablePHP/">
        <img src="../../assets/img/lovableLogoDark.jpg" class="img-fluid" alt="Lovable Logo"></a>
      </div>
      <ul class="sidebar-nav bg-blck2 mt-3" data-coreui="navigation" data-simplebar="">
        <li class="nav-item mt-3"><a class="nav-link" href="/LovablePHP/">
             Inicio</a>
        </li>
       <div id="menu-display">
         
       </div>
      </ul>
    
    </div>
    <div class="wrapper d-flex flex-column min-vh-100  bg-light">
      <header class="header header-sticky mb-4">
        <div class="container-fluid">
          
          <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <svg class="icon icon-lg">
              <use xlink:href="../../vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
            </svg>
          </button><a class="header-brand d-md-none" href="/LovablePHP/">
             <img src="../../assets/img/lovableLogo.png" width="205px" alt="Lovable Logo">
            </a>
          <ul class="header-nav d-none d-md-flex">
           <!-- <li class="nav-item"><a class="nav-link" href="#">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Users</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Settings</a></li>-->
          </ul>
          <ul class="header-nav ms-auto mt-2">
            <div class="mt-2 me-4">
                <h6><?php echo isset($_SESSION["NOMUSU"]) ? utf8_encode($_SESSION["NOMUSU"]) : ""; ?></h6>
            </div>
                <button type="button" class="btn btn-light" onclick="logOut()">
                  <svg class="icon me-2">
                    <use xlink:href="../../vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                  </svg>
                </button>
          </ul>
          
        </div>
        <div class="header-divider"></div>
        
    
    <!-- CoreUI and necessary plugins-->
    <script src="../../vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
    <script src="../../vendors/simplebar/js/simplebar.min.js"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="../../vendors/@coreui/utils/js/coreui-utils.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    
    <script>
    
      function logOut() {
        window.location.assign('/LovablePHP/index.php?logout=1');
      }
      
    </script>

  </body>
  
</html>
