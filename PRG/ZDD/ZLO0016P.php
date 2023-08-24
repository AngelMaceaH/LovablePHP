<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
    <style>
    .space-cards {
        width: 20%;
    }

    @media screen and (max-width: 1024px) {
        .space-cards {
            width: 33%;
        }
    }

    .imgWidth {
        width: 100%;
    }
    </style>
</head>

<body>
    <div class="spinner-wrapper">
        <span class="loader"></span>
    </div>
    <?php
      include '../layout-prg.php';
      include '../../assets/php/ZDD/ZLO0016P/header.php';
    ?>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <span>Digitalizacion de documentos / Consultar</span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0016P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-1">
        <div class="card mb-5">
            <div class="card-header">
                 <h2 class="fs-5 mb-1 mt-2 text-center">Consulta de documentos: <span  id="descripArea"></span> </h2>
            </div>
            <div class="card-body">
                <div class="position-relative">
                    <form id="formFiltros" action="../../assets/php/ZFA/ZLO0016P/filtrosLogica.php" method="POST">
                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="row" id="isGerencia">

                                </div>
                                <input type="text" class="form-control d-none" id="tipDocs">
                            </div>

                            <div class="col-12 mt-3 d-none" id="searchBoxes">
                                <form action="#" id="header-search-people" class="form-area" novalidate="novalidate"
                                    autocomplete="off">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="styled-input wide multi" id="filtrosDoc">
                                           
                                               
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="button" class="btn btn-success mt-3 fw-bold text-white"
                                                style="width:100%;" onclick="searchF()">
                                                <span class="me-2">BUSCAR</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                                    fill="#fff" class="bi bi-search" viewBox="0 0 16 16">
                                                    <path
                                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </form>
                </div>

                <div class="table-responsive mt-2" style="width:100%; height:700px;" id="tableDocs">

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>



    <div class="footer bg-blck flex-grow-1 d-flex justify-content-center">
        <p class="bggray responsive-font-example"><i>Lovable de Honduras S.A. de C.V</i></p>
    </div>
    <script>
        function setCookie(nombre, valor, expiracion) {
        var fechaExpiracion = new Date();
        fechaExpiracion.setTime(fechaExpiracion.getTime() + expiracion * 24 * 60 * 60 * 1000);
        var cookie = nombre + "=" + encodeURIComponent(valor) + ";expires=" + fechaExpiracion.toUTCString() + ";path=/";
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
        $(document).on('keypress', function(e) {
        if (e.which == 13) { 
            searchF(); 
        }
    });
    $(document).ready(function() {
        var anoing = "<?php echo isset($_SESSION['ANOING'])? $_SESSION['ANOING']: ''; ?>";
        var numemp = "<?php echo isset($_SESSION['NUMEMP'])? $_SESSION['NUMEMP']: ''; ?>";
       
        if (anoing == 0 & numemp == 0) {
            $("#descripArea").text("TODOS LOS DOCUMENTOS");
            $("#isGerencia").append(`<div class="col-6">
                                        <h6 class="mb-3 text-start">Departamento</h6>
                                        <select id="cbbDepartamentos" class="form-select" >
                                            
                                        </select>
                                        </div>
                                    <div class="col-6"> <h6 class="mb-3 text-start">Tipo de documento</h6>
                                        <select class="form-select" id="tiposDoc">
                                           <option value="1" selected disabled>Selecciona un tipo</option>
                                        </select>
                                    </div>`);

            var urlDepas = "http://172.16.15.20/API.LOVABLEPHP/ZLO0015P/ListDepas/";
            var responseDepas = ajaxRequest(urlDepas);
            if (responseDepas.code == 200) {
                const departamentos = $("#cbbDepartamentos");
                departamentos.empty();
                departamentos.append(`<option value="0-0" selected>TODOS LOS DOCUMENTOS</option>`);
                for (let i = 0; i < responseDepas.data.length; i++) {
                    departamentos.append(`<option value="` + responseDepas.data[i].SECDEP + `-` + responseDepas
                        .data[i].SECCOD + `">` + responseDepas.data[i].SECDES + `</option>`);

                }
            }

        } else {
            var getArea="http://172.16.15.20/API.LovablePHP/ZLO0016P/FindArea/?anoing="+anoing+"&numemp="+numemp+"";
            var responseArea = ajaxRequest(getArea);
            if (responseArea.code==200){
                $("#descripArea").text(responseArea.data['SECDES']);
            }
            $("#isGerencia").append(`<div class="col-12"> <h6 class="mb-3 text-start">Tipo de documento</h6>
                                        <select class="form-select" id="tiposDoc">
                                           <option value="1" selected disabled>Selecciona un tipo</option>
                                        </select>
                                    </div>`);
        }

        chargeTable();
        var urlTipos = "http://172.16.15.20/API.LovablePHP/ZLO0015P/ListTipos/";
        var responseTipos = ajaxRequest(urlTipos);
        if (responseTipos.code == 200) {
            const tipos = $("#tiposDoc");
            for (let i = 0; i < responseTipos.data.length; i++) {
                tipos.append(`<option value="` + responseTipos.data[i].TIPDOC + `">` + responseTipos.data[i]
                    .DESCRP + `</option>`);
            }
            var tipo = getCookie("tipdoc");
        if (tipo!=null) {
            $("#tiposDoc").val(tipo);
            tiposChange();
        }
        }
       
        $("#tiposDoc").on('change', function() {
            tiposChange();
        });
    });

    function tiposChange(){
        var tipo=$("#tiposDoc").val();
        if (tipo!=null) {
            document.cookie = "tipdoc=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/";
            setCookie("tipdoc",tipo,1); 
        }
        
        $("#searchBoxes").removeClass('d-none');
            const inputs = $("#filtrosDoc");
            inputs.empty();
            var selectedTipo = $("#tiposDoc").val();
                if (selectedTipo==null) {
                    selectedTipo=getCookie("tipdoc");
                }
            var urlCampos = "http://172.16.15.20/API.LovablePHP/ZLO0015P/ListTiposFind/?tipo=" +
                selectedTipo;
            var responseCampos = ajaxRequest(urlCampos);
            if (responseCampos.code == 200) {
                $("#tipDocs").val(responseCampos.data[0]['TIPDOC']);
                var camposDes = responseCampos.data[0].CAMPOS.split("/");
                for (let i = 0; i < camposDes.length; i++) {
                    
                    inputs.append(
                        `
                        <div id="input-first-name">
                                                    <input class="inputsDoc fn"  type="text" autocomplete="off" data-placeholder-focus="false" required id="`+responseCampos.data[0]['TIPDOC']+i+`"  />
                                                    <label>` + camposDes[i] + `</label>
                                                    <svg class="icon--check" width="21px" height="17px"
                                                        viewBox="0 0 21 17" version="1.1"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd" stroke-linecap="round">
                                                            <g id="UI-Elements-Forms"
                                                                transform="translate(-255.000000, -746.000000)"
                                                                fill-rule="nonzero" stroke="#81B44C" stroke-width="3">
                                                                <polyline id="Path-2"
                                                                    points="257 754.064225 263.505943 760.733489 273.634603 748">
                                                                </polyline>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                    <svg class="icon--error" width="15px" height="15px"
                                                        viewBox="0 0 15 15" version="1.1"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd" stroke-linecap="round">
                                                            <g id="UI-Elements-Forms"
                                                                transform="translate(-550.000000, -747.000000)"
                                                                fill-rule="nonzero" stroke="#D0021B" stroke-width="3">
                                                                <g id="Group"
                                                                    transform="translate(552.000000, 749.000000)">
                                                                    <path d="M0,11.1298982 L11.1298982,-5.68434189e-14"
                                                                        id="Path-2-Copy"></path>
                                                                    <path d="M0,11.1298982 L11.1298982,-5.68434189e-14"
                                                                        id="Path-2-Copy-2"
                                                                        transform="translate(5.564949, 5.564949) scale(-1, 1) translate(-5.564949, -5.564949) ">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </div>`);

                }
            }
    }

    function searchF() {
        var campos = {"CAM0": "","CAM1": "", "CAM2": "","CAM3": "","CAM4": "","CAM5": "","CAM6": "","CAM7": "","CAM8": "","CAM9": ""};
        const inputs=$(".inputsDoc");
        var tipo=$("#tipDocs").val();
        for (let i = 0; i < inputs.length; i++) {
            campos["CAM"+i]=$("#"+tipo+i+"").val();
        }
        for (let i = 0; i < 10; i++) {
            var j= i+1;
            document.cookie = "cam"+j+"=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/";
            setCookie("cam"+j,campos['CAM'+i+''],1);
        }
        var valArea=$("#cbbDepartamentos").val();
        if (valArea!=null) {
            var area=valArea.split('-');
            var depa=area[0];
            var sec=area[1];
            document.cookie = "coddep=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/";
            document.cookie = "secdep=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/";
            setCookie("valArea",valArea,1);
            setCookie("coddep",depa,1);
            setCookie("secdep",sec,1);
            $("#descripArea").text($("#cbbDepartamentos option:selected").text());
        }
        
        chargeTable();
    }

    function chargeTable() {
        if (anoing==0 & numemp==0) {
            var areaGen=getCookie("valArea");
            if (areaGen!=null) {
            $("#cbbDepartamentos").val(areaGen);
            $("#descripArea").text($("#cbbDepartamentos option:selected").text());
            }else{
                $("#descripArea").text("TODOS LOS DOCUMENTOS");
            }
        }
            
        $("#tableDocs").empty();
        $("#tableDocs").append(`<table id="myTableInvDesc" class="table stripe " >
                        <thead>
                            <tr>
                                <th class="space-cards"></th>
                                <th class="space-cards"></th>
                                <th class="space-cards"></th>
                                <th class="space-cards" id="col1"></th>
                                <th class="space-cards" id="col2"></th>
                            </tr>
                        </thead>
                        <tbody id="myTableBody">
                            
                           
                        </tbody>
                    </table>`);
        let width = screen.width;
        var row = 5;
        if (width < 1024) {
            $("#col1, #col2, #col3").remove();
            row = 3;
        }
        var anoing = "<?php echo isset($_SESSION['ANOING'])? $_SESSION['ANOING']: ''; ?>";
        var numemp = "<?php echo isset($_SESSION['NUMEMP'])? $_SESSION['NUMEMP']: ''; ?>";
        var tipo = getCookie("tipdoc");
        var coddep=getCookie("coddep");
        var secdep=getCookie("secdep");
       
        var campos = {
            'CAM1': getCookie("cam1"),
            'CAM2': getCookie("cam2"),
            'CAM3': getCookie("cam3"),
            'CAM4': getCookie("cam4"),
            'CAM5': getCookie("cam5"),
            'CAM6': getCookie("cam6"),
            'CAM7': getCookie("cam7"),
            'CAM8': getCookie("cam8"),
            'CAM9': getCookie("cam9"),
            'CAM10': getCookie("cam10")
        };

        var baseUrl = "http://172.16.15.20/API.LovablePHP/ZLO0016P/List/";
        var queryParams = [];

        if (anoing) queryParams.push("anoing=" + anoing);
        if (numemp) queryParams.push("numemp=" + numemp);
        if (tipo) queryParams.push("tipdoc=" + tipo);
        if (coddep) queryParams.push("coddep=" + coddep);
        if (secdep) queryParams.push("secdep=" + secdep);

        for (var key in campos) {
            if (campos[key]) {
                queryParams.push(key + "=" + campos[key]);
            }
        }

        var urlList = baseUrl + "?" + queryParams.join("&");

        console.log(urlList);
        var response = ajaxRequest(urlList);
        const body = $("#myTableBody");
        if (response.code == 200) {
            let tr;

            for (let i = 0; i < response.data.length; i++) {
                if (i % row === 0) {
                    tr = $('<tr></tr>');
                    body.append(tr);
                }
                let td;
                switch (response.data[i]['EXTDOC']) {
                    case 'png':
                    case 'jpg':
                    case 'jpeg':
                        td = $('<td></td>').append(`
                                    <div class="card" onclick="showCard('` + response.data[i]['NOMDOC'] + `','` +
                            response.data[i]['USUGRA'] + `','` + response.data[i]['FECGRA'] + `','` + response.data[
                                i]['HORGRA'] + `','` + response.data[i]['EXTDOC'] + `','` + response.data[i][
                                'URLDOC'
                            ] + `','` + response.data[i]['TIPDOC'] + `','` + response.data[i]['DESCRP'] + `','` +
                            response.data[i]['FECHA'] + `','` + response.data[i]['CAM1'] + `','` + response.data[i][
                                'CAM2'
                            ] + `','` + response.data[i]['CAM3'] + `','` + response.data[i]['CAM4'] + `','` +
                            response.data[i]['CAM5'] + `','` + response.data[i]['CAM6'] + `','` + response.data[i][
                                'CAM7'
                            ] + `','` + response.data[i]['CAM8'] + `','` + response.data[i]['CAM9'] + `','` +
                            response.data[i]['CAM10'] + `')">
                                        <div class="card-body text-center">
                                            <img src="http://172.16.15.20` + response.data[i]['URLDOC'] + `"
                                                style="height:50px;" alt="">
                                            <h6 class=" responsive-font-example mt-1">` + truncarTexto(response.data[i]['NOMDOC']
                            .split('.').slice(0, -1).join('.')) + `</h6>
                                        </div>
                                    </div>`);
                        tr.append(td);
                        break;
                    case 'xlsx':
                        td = $('<td></td>').append(`
                                    <div class="card" onclick="showCard('` + response.data[i]['NOMDOC'] + `','` +
                            response.data[i]['USUGRA'] + `','` + response.data[i]['FECGRA'] + `','` + response.data[
                                i]['HORGRA'] + `','` + response.data[i]['EXTDOC'] + `','` + response.data[i][
                                'URLDOC'
                            ] + `','` + response.data[i]['TIPDOC'] + `','` + response.data[i]['DESCRP'] + `','` +
                            response.data[i]['FECHA'] + `','` + response.data[i]['CAM1'] + `','` + response.data[i][
                                'CAM2'
                            ] + `','` + response.data[i]['CAM3'] + `','` + response.data[i]['CAM4'] + `','` +
                            response.data[i]['CAM5'] + `','` + response.data[i]['CAM6'] + `','` + response.data[i][
                                'CAM7'
                            ] + `','` + response.data[i]['CAM8'] + `','` + response.data[i]['CAM9'] + `','` +
                            response.data[i]['CAM10'] + `')">
                                        <div class="card-body text-center">
                                            <img src="../../assets/img/icons/excel.png"
                                                width="50" alt="">
                                            <h6 class=" responsive-font-example mt-1">` + truncarTexto(response.data[i]['NOMDOC']
                            .split('.').slice(0, -1).join('.')) + `</h6>
                                        </div>
                                    </div>`);
                        tr.append(td);
                        break;
                    case 'docx':
                        td = $('<td></td>').append(`
                                    <div class="card" onclick="showCard('` + response.data[i]['NOMDOC'] + `','` +
                            response.data[i]['USUGRA'] + `','` + response.data[i]['FECGRA'] + `','` + response.data[
                                i]['HORGRA'] + `','` + response.data[i]['EXTDOC'] + `','` + response.data[i][
                                'URLDOC'
                            ] + `','` + response.data[i]['TIPDOC'] + `','` + response.data[i]['DESCRP'] + `','` +
                            response.data[i]['FECHA'] + `','` + response.data[i]['CAM1'] + `','` + response.data[i][
                                'CAM2'
                            ] + `','` + response.data[i]['CAM3'] + `','` + response.data[i]['CAM4'] + `','` +
                            response.data[i]['CAM5'] + `','` + response.data[i]['CAM6'] + `','` + response.data[i][
                                'CAM7'
                            ] + `','` + response.data[i]['CAM8'] + `','` + response.data[i]['CAM9'] + `','` +
                            response.data[i]['CAM10'] + `')">
                                        <div class="card-body text-center">
                                            <img src="../../assets/img/icons/word.png"
                                                width="50" alt="">
                                            <h6 class=" responsive-font-example mt-1">` + truncarTexto(response.data[i]['NOMDOC']
                            .split('.').slice(0, -1).join('.')) + `</h6>
                                        </div>
                                    </div>`);
                        tr.append(td);
                        break;
                    case 'pdf':
                        td = $('<td></td>').append(`
                                    <div class="card" onclick="showCard('` + response.data[i]['NOMDOC'] + `','` +
                            response.data[i]['USUGRA'] + `','` + response.data[i]['FECGRA'] + `','` + response.data[
                                i]['HORGRA'] + `','` + response.data[i]['EXTDOC'] + `','` + response.data[i][
                                'URLDOC'
                            ] + `','` + response.data[i]['TIPDOC'] + `','` + response.data[i]['DESCRP'] + `','` +
                            response.data[i]['FECHA'] + `','` + response.data[i]['CAM1'] + `','` + response.data[i][
                                'CAM2'
                            ] + `','` + response.data[i]['CAM3'] + `','` + response.data[i]['CAM4'] + `','` +
                            response.data[i]['CAM5'] + `','` + response.data[i]['CAM6'] + `','` + response.data[i][
                                'CAM7'
                            ] + `','` + response.data[i]['CAM8'] + `','` + response.data[i]['CAM9'] + `','` +
                            response.data[i]['CAM10'] + `')">
                                        <div class="card-body text-center">
                                            <img src="../../assets/img/icons/pdf.png"
                                                width="50" alt="">
                                            <h6 class=" responsive-font-example mt-1">` + truncarTexto(response.data[i]['NOMDOC']
                            .split('.').slice(0, -1).join('.')) + `</h6>
                                        </div>
                                    </div>`);
                        tr.append(td);
                        break;
                    case 'txt':
                        td = $('<td></td>').append(`
                                    <div class="card" onclick="showCard('` + response.data[i]['NOMDOC'] + `','` +
                            response.data[i]['USUGRA'] + `','` + response.data[i]['FECGRA'] + `','` + response.data[
                                i]['HORGRA'] + `','` + response.data[i]['EXTDOC'] + `','` + response.data[i][
                                'URLDOC'
                            ] + `','` + response.data[i]['TIPDOC'] + `','` + response.data[i]['DESCRP'] + `','` +
                            response.data[i]['FECHA'] + `','` + response.data[i]['CAM1'] + `','` + response.data[i][
                                'CAM2'
                            ] + `','` + response.data[i]['CAM3'] + `','` + response.data[i]['CAM4'] + `','` +
                            response.data[i]['CAM5'] + `','` + response.data[i]['CAM6'] + `','` + response.data[i][
                                'CAM7'
                            ] + `','` + response.data[i]['CAM8'] + `','` + response.data[i]['CAM9'] + `','` +
                            response.data[i]['CAM10'] + `')">
                                        <div class="card-body text-center">
                                            <img src="../../assets/img/icons/txt.png"
                                                width="50" alt="">
                                            <h6 class=" responsive-font-example mt-1">` + truncarTexto(response.data[i]['NOMDOC']
                            .split('.').slice(0, -1).join('.')) + `</h6>
                                        </div>
                                    </div>`);
                        tr.append(td);
                        break;
                    case 'ppx':
                        td = $('<td></td>').append(`
                                    <div class="card" onclick="showCard('` + response.data[i]['NOMDOC'] + `','` +
                            response.data[i]['USUGRA'] + `','` + response.data[i]['FECGRA'] + `','` + response.data[
                                i]['HORGRA'] + `','` + response.data[i]['EXTDOC'] + `','` + response.data[i][
                                'URLDOC'
                            ] + `','` + response.data[i]['TIPDOC'] + `','` + response.data[i]['DESCRP'] + `','` +
                            response.data[i]['FECHA'] + `','` + response.data[i]['CAM1'] + `','` + response.data[i][
                                'CAM2'
                            ] + `','` + response.data[i]['CAM3'] + `','` + response.data[i]['CAM4'] + `','` +
                            response.data[i]['CAM5'] + `','` + response.data[i]['CAM6'] + `','` + response.data[i][
                                'CAM7'
                            ] + `','` + response.data[i]['CAM8'] + `','` + response.data[i]['CAM9'] + `','` +
                            response.data[i]['CAM10'] + `')">
                                        <div class="card-body text-center">
                                            <img src="../../assets/img/icons/pp.png"
                                                width="50" alt="">
                                            <h6 class=" responsive-font-example mt-1">` + truncarTexto(response.data[i]['NOMDOC']
                            .split('.').slice(0, -1).join('.')) + `</h6>
                                        </div>
                                    </div>`);
                        tr.append(td);
                        break;
                    case 'zip':
                    case 'rar':
                        td = $('<td></td>').append(`
                                    <div class="card" onclick="showCard('` + response.data[i]['NOMDOC'] + `','` +
                            response.data[i]['USUGRA'] + `','` + response.data[i]['FECGRA'] + `','` + response.data[
                                i]['HORGRA'] + `','` + response.data[i]['EXTDOC'] + `','` + response.data[i][
                                'URLDOC'
                            ] + `','` + response.data[i]['TIPDOC'] + `','` + response.data[i]['DESCRP'] + `','` +
                            response.data[i]['FECHA'] + `','` + response.data[i]['CAM1'] + `','` + response.data[i][
                                'CAM2'
                            ] + `','` + response.data[i]['CAM3'] + `','` + response.data[i]['CAM4'] + `','` +
                            response.data[i]['CAM5'] + `','` + response.data[i]['CAM6'] + `','` + response.data[i][
                                'CAM7'
                            ] + `','` + response.data[i]['CAM8'] + `','` + response.data[i]['CAM9'] + `','` +
                            response.data[i]['CAM10'] + `')">
                                        <div class="card-body text-center">
                                            <img src="../../assets/img/icons/folder.png"
                                                width="50" alt="">
                                            <h6 class=" responsive-font-example mt-1">` + truncarTexto(response.data[i]['NOMDOC']
                            .split('.').slice(0, -1).join('.')) + `</h6>
                                        </div>
                                    </div>`);
                        tr.append(td);
                        break;
                    default:
                        td = $('<td></td>').append(`
                                    <div class="card" onclick="showCard('` + response.data[i]['NOMDOC'] + `','` +
                            response.data[i]['USUGRA'] + `','` + response.data[i]['FECGRA'] + `','` + response.data[
                                i]['HORGRA'] + `','` + response.data[i]['EXTDOC'] + `','` + response.data[i][
                                'URLDOC'
                            ] + `','` + response.data[i]['TIPDOC'] + `','` + response.data[i]['DESCRP'] + `','` +
                            response.data[i]['FECHA'] + `','` + response.data[i]['CAM1'] + `','` + response.data[i][
                                'CAM2'
                            ] + `','` + response.data[i]['CAM3'] + `','` + response.data[i]['CAM4'] + `','` +
                            response.data[i]['CAM5'] + `','` + response.data[i]['CAM6'] + `','` + response.data[i][
                                'CAM7'
                            ] + `','` + response.data[i]['CAM8'] + `','` + response.data[i]['CAM9'] + `','` +
                            response.data[i]['CAM10'] + `')">
                                        <div class="card-body text-center">
                                            <img src="../../assets/img/icons/file.png"
                                                width="50" alt="">
                                            <h6 class="responsive-font-example mt-1">` + truncarTexto(response.data[i]['NOMDOC']
                            .split('.').slice(0, -1).join('.')) + `</h6>
                                        </div>
                                    </div>`);
                        tr.append(td);
                        break;
                }

            }

            let lastRowCells = tr.children().length;
            for (let j = lastRowCells; j < row; j++) {
                tr.append($('<td></td>'));
            }
        }else{
            body.append('<tr><td class="text-center p-3 fs-5" colspan="100%">No se encontraron documentos</td></tr>')
        }

        var dataTable = $("#myDataTable").DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            },
            searching: false,
            paging: false,
            processing: true,
            ordering: false,
            pageLength: 100,
        });
    }


    

    function showCard(nomcard, usugra, fecgra, horgra, extdoc, urldoc, tipdoc, descrp, fecha, cam0, cam1, cam2, cam3,
        cam4, cam5, cam6, cam7, cam8, cam9) {
        $("#downloadFrame").empty();
        switch (extdoc) {
            case 'png':
            case 'jpg':
            case 'jpeg':
                $("#downloadFrame").append('<img src="http://172.16.15.20' + urldoc + '" class="imgWidth" alt="">');
                break;
            case 'xlsx':
                $("#downloadFrame").append('<img src="../../assets/img/icons/excel.png" style="width:150px;" alt="">');
                break;
            case 'docx':
                $("#downloadFrame").append('<img src="../../assets/img/icons/word.png" style="width:150px;" alt="">');
                break;
            case 'pdf':
                $("#downloadFrame").append('<img src="../../assets/img/icons/pdf.png" style="width:150px;" alt="">');
                break;
            case 'txt':
                $("#downloadFrame").append('<img src="../../assets/img/icons/txt.png" style="width:150px;" alt="">');
                break;
            case 'ppx':
                $("#downloadFrame").append('<img src="../../assets/img/icons/pp.png" style="width:150px;" alt="">');
                break;
            case 'zip':
            case 'rar':
                $("#downloadFrame").append('<img src="../../assets/img/icons/folder.png" style="width:150px;" alt="">');
                break;

            default:
                $("#downloadFrame").append('<img src="../../assets/img/icons/file.png" style="width:150px;" alt="">');
                break;
        }
        $("#downloadCard").empty();
        $("#downloadCard").append('<a class="btn btn-primary" style="width:100%;" href="http://172.16.15.20' + urldoc +
            '" download>Descargar</a>');

        $("#trashDoc").empty();
        $("#trashDoc").append(
            ` <button type="button" class="btn btn-danger m-0 mt-2  text-white" onclick="deleteCard('` + nomcard +
            `','` + usugra + `','` + fecgra + `','` + horgra + `','` + extdoc + `','` + urldoc +
            `')" ><i class="fa-solid fa-trash-can"></i></button>`);
        $("#titleDoc").text(nomcard);
        $("#tipDoc").text(tipdoc);
        $("#fechaDoc").text(formatFecha(fecha));
        $("#descrpDoc").text(descrp);
        /*$("#usugra").text(usugra);
        $("#fecgra").text(formatFecha(fecgra));
        $("#horgra").text(formatTime(horgra));*/
        var campos = {
            cam0,
            cam1,
            cam2,
            cam3,
            cam4,
            cam5,
            cam6,
            cam7,
            cam8,
            cam9
        };
        var urlCampos = "http://172.16.15.20/API.LovablePHP/ZLO0015P/ListTiposFind/?tipo=" + tipdoc;
        var responseCampos = ajaxRequest(urlCampos);
        if (responseCampos.code == 200) {
            const inputs = $("#extraInfo");
            inputs.empty();
            var camposDes = responseCampos.data[0].CAMPOS.split("/");
            for (let i = 0; i < camposDes.length; i++) {
                inputs.append(`<div class="col-6 col-lg-3">
                                <h6 class=" mt-1">` + camposDes[i] + `:</h6>
                            </div>
                            <div class="col-6 col-lg-3">
                                <span class="text-start">` + campos['cam' + i] + `</span>
                            </div>`);

            }
        }

        $("#docInfo").modal('show');
    }
    function truncarTexto(texto) {
        if (texto.length <= 8) {
            return texto;
        }
        return texto.substring(0, 8) + "...";
    }
    function deleteCard(nomcard, usugra, fecgra, horgra, extdoc, urldoc) {
        var urlDelete = "http://172.16.15.20/API.LovablePHP/ZLO0016P/Delete/?nomdoc=" + nomcard + "&urldoc=" + urldoc +
            "";
        var response = ajaxRequest(urlDelete);
        if (response.code == 200) {
            chargeTable();
        }
        $("#docInfo").modal('hide');

    }

    function formatFecha(inputDate) {
        var year = inputDate.substring(0, 4);
        var month = inputDate.substring(4, 6);
        var day = inputDate.substring(6, 8);
        var formattedDate = day + "/" + month + "/" + year;

        return formattedDate;
    }

    function formatTime(inputTime) {
        inputTime = (inputTime.length < 6 ? "0" + inputTime : inputTime);
        var hour = inputTime.substring(0, 2);
        var minute = inputTime.substring(2, 4);
        var second = inputTime.substring(4, 6);
        var formattedHour = parseInt(hour);
        var ampm = "AM";
        if (formattedHour >= 12) {
            ampm = "PM";
            if (formattedHour > 12) {
                formattedHour -= 12;
            }
        }
        if (formattedHour === 0) {
            formattedHour = 12;
        }
        var formattedTime = formattedHour + ":" + minute + " " + ampm;
        return formattedTime;
    }
    </script>
    <div class="modal fade" id="docInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Información del documento</h1>
                    <button type="button" class="btn-close" onclick="$('#docInfo').modal('hide')"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="row">
                            <div class="col-12 col-lg-1">

                            </div>
                            <div class="col-10 col-lg-10">
                                <div class="card-body text-center p-3" id="downloadFrame">
                                </div>
                            </div>
                            <div class="col-2 col-lg-1 p-0" id="trashDoc">

                            </div>
                        </div>
                        <div id="downloadCard">

                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h5 class="text-center  mt-2 mb-2" id="titleDoc"></h5>
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>
                                <div class="col-12">
                                    <div class="container">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                 <div class="row mb-2">
                                                    <div class="col-6 col-lg-3">
                                                        <h6 class=" mt-1">Tipo:</h6>
                                                    </div>
                                                    <div class="col-6 col-lg-3">
                                                        <span class="text-start" id="tipDoc"></span>
                                                    </div>
                                                    <div class="col-6 col-lg-3">
                                                        <h6 class=" mt-1">Fecha:</h6>
                                                    </div>
                                                    <div class="col-6 col-lg-3">
                                                        <span class="text-start" id="fechaDoc"></span>
                                                    </div>
                                                    <div class="col-12 col-lg-3">
                                                        <h6 class=" mt-1">Descripcion:</h6>
                                                    </div>
                                                    <div class="col-12 col-lg-9">
                                                        <span class="text-justify" id="descrpDoc"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                            <button class="btn p-0 m-0" style="width:50px;">Editar <i class="fa-solid fa-pen-to-square"></i></button>
                                            </div>
                                        </div>
                                    <div class="row">
                                    <div class="col-12">
                                                        <hr>
                                                    </div>
                                    </div>
                                       
                                        <div class="row " id="extraInfo">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>


</body>

</html>