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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />
    <link href="../../assets/css/examples.css" rel="stylesheet">
    <link href="../../assets/css/mystyle.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js"
        integrity="sha512-2bMhOkE/ACz21dJT8zBOMgMecNxx0d37NND803ExktKiKdSzdwn+L7i9fdccw/3V06gM/DBWKbYmQvKMdAA9Nw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@500&display=swap" rel="stylesheet">
    <style>
        h1, h2, h3, h4, h5, h6, p, span, td, th, a, button, label, b, li, ul { font-family: 'Rubik', sans-serif; }
        .loader {
            position: relative; width: 40px; height: 60px;
            animation: heartBeat 1.2s infinite cubic-bezier(0.215, 0.61, 0.355, 1);
        }
        .loader:before, .loader:after {
            content: ""; background: #ff3d00; width: 40px; height: 60px; border-radius: 50px 50px 0 0;
            position: absolute; left: 0; bottom: 0; transform: rotate(45deg); transform-origin: 50% 68%;
            box-shadow: 5px 4px 5px #0004 inset;
        }
        .loader:after { transform: rotate(-45deg); }
        @keyframes heartBeat {
            0% { transform: scale(0.95) }
            5% { transform: scale(1.1) }
            39% { transform: scale(0.85) }
            45% { transform: scale(1) }
            60% { transform: scale(0.95) }
            100% { transform: scale(0.9) }
        }
    </style>
</head>
<body>
<div class="spinner-wrapper">
      <img src="../../assets/img/lovableLoader.png" alt="loader" style="width:250px;">
      <span class="loader p-0 mb-5 me-4 "></span>
  </div>
    <?php
        if (substr($_SERVER['REMOTE_ADDR'], 0, 4) !== '172.') {
            http_response_code(403);
            echo json_encode(["error" => "Acceso denegado"]);
            exit;
        }
  session_set_cookie_params(604800);
  session_start();
  date_default_timezone_set('America/Tegucigalpa');
  //session_set_cookie_params(86400);
  $_SESSION['DEV'] = "";
  include '../../assets/php/conn.php';
  if (isset($_SESSION["NOMUSU"]) == "" || isset($_SESSION['VALIDATE'])) {
    $host= $_SERVER["HTTP_HOST"];
    $url= $_SERVER["REQUEST_URI"];

   if(trim(substr($url,20,8))=='ZLO0015P' || trim(substr($url,20,8))=='ZLO0016P'){
    if (isset($_GET['user'])) {$codusu=$_GET['user'];}
    $_SESSION['CODUSU']=$codusu;
    $connIBM=conexionIBM();
    $sqlValidate="select * from LBPRDDAT/LO2294 where USUARI='".$codusu."' LIMIT 1";
    $resultVal=odbc_exec($connIBM, $sqlValidate);
    if (odbc_num_rows($resultVal)!=0) {
        $sqlGet="select * from LBPRDDAT/lo2207 where CODUSU='".$codusu."'";
        $result=odbc_exec($connIBM, $sqlGet);
        while ($row = odbc_fetch_array($result)) {
            $_SESSION['VALIDATE']=1;
            $_SESSION["NOMUSU"]=utf8_encode(trim($row['NOMUSU']));
            $_SESSION["NIVEL"]=$row['NIVEL'];
            $_SESSION["ANOING"]=$row['ANOING'];
            $_SESSION["NUMEMP"]=$row['NUMEMP'];
            $_SESSION["PERESP"]=$row['PERESP'];
        }
        $sqlHist= "SELECT COUNT(*) CONT FROM LBDESDAT/LO2207B WHERE CODUSU='".$codusu."'";
        $resultHist = odbc_exec($connIBM, $sqlHist);
        $contador = 0;
        while ($row = odbc_fetch_array($resultHist)) {
            $contador=utf8_encode(trim($row['CONT']));
        }
        $currentTime= date('H:i:s');
        $currentDate= date('Ymd');
        if($contador==0){
            $sqlHist= "INSERT INTO LBDESDAT/LO2207B (CODUSU,FECGRA,HORGRA) VALUES ('".$codusu."',$currentDate,'$currentTime')";
            $resultHist = odbc_exec($connIBM, $sqlHist);
        }else {
            $sqlHist= "UPDATE LBDESDAT/LO2207B SET FECGRA=$currentDate,HORGRA='$currentTime' WHERE CODUSU='".$codusu."'";
            $resultHist = odbc_exec($connIBM, $sqlHist);
        }
    }else{
        header('Location: /' . $_SESSION['DEV'] . 'LovablePHP/login.php');
    }
   }else {
    header('Location: /' . $_SESSION['DEV'] . 'LovablePHP/login.php');
   }
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: /' . $_SESSION['DEV'] . 'LovablePHP/login.php');
  }
  $connIBM = conexionIBM();
  ?>
    <script>
    $(document).ready(function() {
        const spinnerWrapperEl = document.querySelector('.spinner-wrapper');
        setTimeout(() => {
            spinnerWrapperEl.style.display = 'none';
        }, 1000);
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        var usuario = '<?php echo $_SESSION['CODUSU']; ?>';
        var isDev = '<?php echo $_SESSION['DEV']; ?>';
        if (usuario=='MARVIN') {
            $("#dropdown-admin").append(`<div class="dropdown-menu dropdown-menu-end pt-0" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 42px);" data-popper-placement="bottom-end">
                                                <div class="dropdown-header bg-light py-2">
                                                <div class="fw-semibold">Opciones de administrador</div></div>
                                                <a class="dropdown-item p-2" href="/<?php echo $_SESSION['DEV'] ?>LovablePHP/PRG/Admin/Usuarios.php"><i class="fa-solid fa-user me-2"></i>Usuarios</a>
                                                <a class="dropdown-item p-2" href="/<?php echo $_SESSION['DEV'] ?>LovablePHP/PRG/Admin/Opciones.php"><i class="fa-solid fa-bars me-2"></i>Menú</a>`);
        }
        var anoing = "<?php echo isset($_SESSION['ANOING'])? $_SESSION['ANOING']: ''; ?>";
        var numemp = "<?php echo isset($_SESSION['NUMEMP'])? $_SESSION['NUMEMP']: ''; ?>";
        var getArea="/API.LovablePHP/ZLO0016P/FindArea/?anoing="+anoing+"&numemp="+numemp+"";
            var responseArea = ajaxRequest(getArea);
            if (responseArea.code==200){
                $("#descripArea").text(responseArea.data['SECDES']);
            }
        if (anoing == 0 && numemp == 0) {
          anoing=1;
          numemp=1;
        }else{
          var getArea="/API.LovablePHP/ZLO0016P/FindArea/?anoing="+anoing+"&numemp="+numemp+"";
            var responseArea = ajaxRequest(getArea);
            var areaDesc='';
            var areaId='';
            var seccionId='';
            if (responseArea.code==200){
              areaDesc=responseArea.data['SECDES'];
              areaId=responseArea.data['SECDEP'];
              seccionId=responseArea.data['SECCOD'];
            }
          /*$("#hasNumber").append(`<div class="col-12">
                                        <span class="text-end" style="font-size: 14px;">ID: `+combineNumbers(anoing, numemp)+`</span>
                                    </div>`);*/
          $("#isEmpleado").append(`<div class="col-12">
                                        <span class="text-end" style="font-size: 14px;">Depto: (`+areaId+`) `+areaDesc+`</span>&nbsp;&nbsp;
                                    </div>`);
        }
        var urlCia="/API.LovablePHP/Access/GetCia/?anoing="+anoing+"&numemp="+numemp+"";
        var responseCia=ajaxRequest(urlCia);
        if(responseCia.code==200){
          $("#userCia").text(responseCia.data[0]['COMDES']);
        }
        //MODULOS
        var urlModulos = '/API.LovablePHP/Opc/LayoutM/?code=' + usuario + '';
        var responseModulos = ajaxRequest(urlModulos);
        if (responseModulos.code == 200) {
            for (let i = 0; i < responseModulos.data.length; i++) {
                $("#menu-display").append(
                    `<li class="nav-group  me-2 ms-2 mt-1"><a class="nav-link nav-group-toggle"
                            style="font-size:13px; word-wrap: break-word; white-space: normal;" href="#"><i class="fa-solid fa-folder me-2 ms-2"></i> `+
                            responseModulos.data[i]['APLDES'] + `</a>
                        <ul class="nav-group-items">
                            <div id="` + responseModulos.data[i]['DETC91'] + `">
                            </div>
                        </ul>
                    </li>`);
            }
        }
        //SUBMODULOS
        var urlSubModulosCount = '/API.LovablePHP/Opc/LayoutSCount/?code=' + usuario + '';
        var responseSMCount = ajaxRequest(urlSubModulosCount);
        var urlSubModulos = '/API.LovablePHP/Opc/LayoutS/';
        var responseSM = ajaxRequest(urlSubModulos);
        if (responseSM.code == 200 && responseSMCount.code == 200) {
            for (let i = 0; i < responseSM.data.length; i++) {
                for (let j = 0; j < responseSMCount.data.length; j++) {
                    if (responseSM.data[i]['CATSE1'] == responseSMCount.data[j]['CATSEC']) {
                        $("#" + responseSMCount.data[j]['DETC91'] + "").append(
                            `<li class="nav-group" aria-expanded="false">
                                      <a class="nav-link nav-group-toggle" style="font-size:13px; word-wrap: break-word; white-space: normal;" href="#"><i class="fa-solid fa-folder me-2 ms-2"></i> ` + responseSM.data[i][
                                'CATDES'
                            ].toUpperCase() + `</a>
                                          <ul class="nav-group-items ">
                                            <div id="` + responseSMCount.data[j]['DETC91'] + "-" + responseSM.data[i][
                                'CATSE1'
                            ] + `">
                                              <li class="nav-item" id="hiddenli"><a class="nav-link" href="#"><span class="nav-icon"></span></a></li>
                                          </div>
                                        </ul>
                                      </li>`);
                        $("#" + responseSMCount.data[j]['DETC91'] + " #hiddenli").remove();
                    }
                }
            }
        }

        //PROGRAMAS
        var urlProgramas = '/API.LovablePHP/Opc/LayoutP/?code=' + usuario + '';
        var responsePRG = ajaxRequest(urlProgramas);
        var arrayOrder=responsePRG.data;
        arrayOrder.sort((a, b) => {
            if (a.CATDE1 < b.CATDE1) {
                return -1;
            }
            if (a.CATDE1 > b.CATDE1) {
                return 1;
            }
            return 0;
        });

        if (responsePRG.code == 200) {
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
            for (let i = 0; i < arrayOrder.length; i++) {
                $("#" + arrayOrder[i]['DETC91'] + "-" + arrayOrder[i]['CATSEC'] + "").append(
                    `<li class="nav-item">
                      <a class="nav-link" style="font-size:13px; word-wrap: break-word; white-space: normal;" href="/` + isDev + `LovablePHP/PRG/` + arrayOrder[i]['DETC91'] + `/` + arrayOrder[i]['CATNOM'] + `.php">
                       <span class="nav-icon"></span><i class="fa-solid fa-circle me-2 ms-2" style="font-size:8px;"></i>` +
                    descripcionPrograma(arrayOrder[i]['CATDE1']).toUpperCase() + ` </a> </li>`);
            }


            let currentPgm='<?php echo trim(substr($_SERVER["REQUEST_URI"],20,8)); ?>';
            switch (currentPgm) {
                case 'ZLO0034P':
                    case 'ZLO0035P':
                        $("#sidebar").addClass('hide');
                    break;
                default:
                    break;
            }
        }
        document.querySelectorAll('.nav-group').forEach(function(navGroup) {
            setTimeout(() => {
                if(navGroup.classList.contains('show')){
                    var icon = navGroup.querySelector('.fa-folder, .fa-folder-open');
                    if (icon.classList.contains('fa-folder')) {
                                icon.classList.remove('fa-folder');
                                icon.classList.add('fa-folder-open');
                    } else {
                                icon.classList.remove('fa-folder-open');
                                icon.classList.add('fa-folder');
                    }
                }
            }, 2000);
            navGroup.addEventListener('click', function() {
                setTimeout(() => {
                    document.querySelectorAll('.nav-group').forEach(function(navGroup) {
                        var icon = navGroup.querySelector('.fa-folder, .fa-folder-open');
                        icon.classList.remove('fa-folder-open');
                        icon.classList.add('fa-folder');
                    });
                }, 10);
                setTimeout(() => {
                    if (this.classList.contains('show')) {
                        var icon = this.querySelector('.fa-folder, .fa-folder-open');
                            icon.classList.remove('fa-folder');
                            icon.classList.add('fa-folder-open');
                    }
                }, 300);
            });
        });


    });
    </script>

    <div class="sidebar bg-blck sidebar-fixed" id="sidebar">

        <div class="sidebar-brand d-none d-md-flex p-4"><a
                href="/<?php echo $_SESSION['DEV'] ?>LovablePHP/<?php echo isset($_SESSION['INDEX'])? $_SESSION['INDEX']:''; ?>">
                <img src="../../assets/img/lovableLogoDark.jpg" class="img-fluid" alt="Lovable Logo"></a>
        </div>
        <ul class="sidebar-nav bg-blck2 mt-3" data-coreui="navigation" data-simplebar="">
            <li class="nav-item mt-3"><a class="nav-link"
                    href="/<?php echo $_SESSION['DEV'] ?>LovablePHP/<?php echo isset($_SESSION['INDEX'])? $_SESSION['INDEX']:''; ?>">
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
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        <header class="header header-sticky mb-4">
            <div class="container-fluid">

                <button class="header-toggler px-md-0 me-md-5" type="button"
                    onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                    <svg class="icon icon-lg">
                        <use xlink:href="../../assets/vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
                    </svg>
                </button><a class="header-brand d-md-none" href="/<?php echo $_SESSION['DEV'] ?>LovablePHP/">
                    <img src="../../assets/img/lovableLogo.png" width="205px" alt="Lovable Logo">
                </a>
                <ul class="header-nav d-none d-md-flex">
                </ul>
                <ul class="header-nav ms-auto mt-3">
                    <div class="row">
                        <div class="col-12 text-end">
                          <span id="userCia" class=" me-lg-5 pe-lg-4"></span>
                        </div>
                        <div class="col-12">
                            <div class="mt-2 me-4 d-flex justify-content-end" style="width: 100%;">
                                <div class="row me-3">
                                    <div class="col-12">
                                    <ul class="header-nav ms-3">
                                        <li class="nav-item dropdown">
                                          <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                                            <span class="text-end" style="font-size: 15px;">Usuario: <?php echo isset($_SESSION["NOMUSU"]) ? $_SESSION["NOMUSU"] : ""; ?></span>&nbsp;&nbsp;</a>
                                            <div id="dropdown-admin">

                                            </div>
                                        </li>
                                      </ul>
                                    </div>
                                    <div id="hasNumber">
                                    </div>
                                </div>
                                <div class="row me-5" id="isEmpleado">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-light rounded" onclick="logOut()" style="height:50px;" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Salir">
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
                src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"> </script>
            <script type="text/javascript" charset="utf8"
                src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"> </script>
            <script type="text/javascript" charset="utf8"
                src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"> </script>
            <script type="text/javascript" charset="utf8"
                src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"> </script>
            <script type="text/javascript" charset="utf8"
                src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"> </script>
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"> </script>
            <script type="text/javascript" charset="utf8"
                src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"> </script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
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
                    success: function(response) {
                        dataResponse = response;
                    },
                    error: function(jqXHR, exception) {
                        HTTPError.code = jqXHR.status;
                        HTTPError.data = jqXHR;
                        HTTPError.message += "Request http Error: " + url + ", Exception: ";
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
                    if (e.which == 13) {
                        thisTab.click();
                    }
                });

            });

            function logOut() {
                deleteCookies();
                window.location.assign('/<?php echo $_SESSION['DEV'] ?>LovablePHP/index.php?logout=1');
            }

            function deleteCookies() {
                var cookies = document.cookie.split(";");

                for (var i = 0; i < cookies.length; i++) {
                    var cookie = cookies[i];
                    var eqPos = cookie.indexOf("=");
                    var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
                    document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/";
                }
                localStorage.clear();
                window.location.href = "/login.php";
            }

            function setCookie(nombre, valor, expiracion) {
                var fechaExpiracion = new Date();
                fechaExpiracion.setTime(fechaExpiracion.getTime() + expiracion * 24 * 60 * 60 * 1000);
                var cookie = nombre + "=" + encodeURIComponent(valor) + ";expires=" + fechaExpiracion.toUTCString() +
                    ";path=/";
                document.cookie = cookie;
            }

            function getCookie(nombre) {
                var cookieName = nombre + "=";
                var cookies = document.cookie.split(';');
                for (var i = 0; i < cookies.length; i++) {
                    var cookie = cookies[i].trim();
                    if (cookie.indexOf(cookieName) === 0) {
                        return decodeURIComponent(cookie.substring(cookieName.length));
                    }
                }
                return null;
            }

            function combineNumbers(num1, num2) {
    let combined = num1 + num2;
    while (combined.length < 6) {
        num1 += "0";
        combined = num1 + num2;
    }
    return parseInt(combined);
}
            </script>
</body>

</html>