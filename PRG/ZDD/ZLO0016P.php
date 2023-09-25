<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
    <link rel="stylesheet" href="../../assets/css/flexselect.css">
    <link rel="stylesheet" href="../../assets/vendors/dayrangepicker/index.css">
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
    <?php
      include '../layout-prg.php';
      include '../../assets/php/ZDD/ZLO0016P/header.php';
     ?>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <span>Digitalización de documentos / Consultar</span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0016P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-1">
        <div class="card mb-5">
            <div class="card-header">
                <h2 class="fs-5 mb-1 mt-2 text-center">Consulta de documentos</h2>
            </div>
            <div class="card-body">
                <div class="position-relative">
                    <form id="formFiltros" action="../../assets/php/ZDD/ZLO0016P/filtrosLogica.php" method="POST">
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
                                        <div class="col-lg-12">
                                            <div class="styled-input wide multi" id="filtrosDoc">


                                            </div>
                                        </div>
                                        <div class="col-lg-12">
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
    $(document).on('keypress', function(e) {
        if (e.which == 13) {
            searchF();
        }
    });
    var codigo = "";
    var comarcOptions = "";
    var camposDes = "";
    var inputs = "";
    $(document).ready(function() {
        var anoing = "<?php echo isset($_SESSION['ANOING'])? $_SESSION['ANOING']: ''; ?>";
        var numemp = "<?php echo isset($_SESSION['NUMEMP'])? $_SESSION['NUMEMP']: ''; ?>";
        var usuario = '<?php echo $_SESSION["CODUSU"];?>';

        for (let i = 0; i < 10; i++) {
            document.cookie = "cam" + i + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/";
        }

        var urlComarc = 'http://172.16.15.20/API.LovablePHP/ZLO0001P/ListComarc/?usuario=' + usuario + '';
        var responseComarc = ajaxRequest(urlComarc);
        if (responseComarc.code == 200) {
            for (let i = 0; i < responseComarc.data.length; i++) {
                comarcOptions += '<option value="' + responseComarc.data[i].COMCOD + '">' + responseComarc.data[
                    i].COMDES + '</option>';
            }
        }
        if (anoing == 0 & numemp == 0) {
            $("#isGerencia").append(`<div class="col-12 col-lg-6">
                                        <h6 class="mb-3 mt-2 text-start">Departamento y Sección</h6>
                                        <select id="cbbDepartamentos" class="form-select mt-1" >   
                                        </select>
                                        </div>
                                    <div class="col-12 col-lg-6"> 
                                        <h6 class="mb-3 text-start mt-2">Tipo de documento</h6>
                                        <select class="form-select mt-1" id="tiposDoc">
                                           <option value="A" >TODOS LOS DOCUMENTOS</option>
                                        </select>
                                    </div>`);

            var urlDepas = "http://172.16.15.20/API.LOVABLEPHP/ZLO0015P/ListDepas/";
            var responseDepas = ajaxRequest(urlDepas);
            if (responseDepas.code == 200) {
                const departamentos = $("#cbbDepartamentos");
                departamentos.empty();
                departamentos.append(`<option value="0-0">TODAS LAS SECCIONES</option>`);
                for (let i = 0; i < responseDepas.data.length; i++) {
                    departamentos.append(`<option value="` + responseDepas.data[i].SECDEP + `-` + responseDepas
                        .data[i].SECCOD + `">` + responseDepas.data[i].SECDES + `</option>`);

                }
            }

        } else {

            $("#isGerencia").append(`<div class="col-12"> <h6 class="mb-3 text-start">Tipo de documento</h6>
                                        <select class="form-select mt-1" id="tiposDoc">
                                           <option value="A">TODOS LOS DOCUMENTOS</option>
                                        </select>
                                    </div>`);
        }
        var urlProveedores = "http://172.16.15.20/API.LovablePHP/ZLO0015P/ListProveedores/";
        var responseProveedores = ajaxRequest(urlProveedores);
        options = "";
        if (responseProveedores.code == 200) {
            for (let j = 0; j < responseProveedores.data.length; j++) {
                options += '<tr onclick="sendProveedor(this)"><td style="width:10%;" class="TipProveedor">' +
                    responseProveedores.data[j]['ARCCIU'] + '</td><td style="width:10%;" class="IDProveedor">' +
                    responseProveedores.data[j]['ARCCO1'] + '</td><td class="descProveedor">' +
                    responseProveedores.data[j]['ARCNOM'] + '</td></tr>';
            }
            $("#tbProveedoresBody").append(options);
            $('#tbProveedores thead th').each(function() {
                var title = $(this).text();
                $(this).html(title + '<br /><input type="text" class="form-control mt-2"/>');
            });
            var table = $('#tbProveedores').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                },
                "pageLength": 10,
                "ordering": false,
                "dom": 'rtip',
            });
            $('#tbProveedores thead input').on('keyup', function() {
                var columnIndex = $(this).parent().index();
                var inputValue = $(this).val().trim();

                if (table.column(columnIndex).search() !== inputValue) {
                    table
                        .column(columnIndex)
                        .search(inputValue)
                        .draw();
                }
            });
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
            if (tipo != null) {
                $("#tiposDoc").val(tipo);
                tiposChange();
            }
        }
        $("#cbbDepartamentos").on('change', function() {
            if ($("#cbbDepartamentos").val() == '0-0' || $("#tiposDoc").val() == 'A') {
                $("#filtrosDoc").addClass('d-none');
            } else {
                $("#filtrosDoc").removeClass('d-none');
            }
            tiposChange();
        });
        $("#tiposDoc").on('change', function() {
            if ($("#tiposDoc").val() == 'A') {
                $("#filtrosDoc").addClass('d-none');
            } else {
                $("#filtrosDoc").removeClass('d-none');
            }
            tiposChange();
        });
    });

    function tiposChange() {
        var camposLength=0;
        var tipo = $("#tiposDoc").val();
        if (tipo != null) {
            setCookie("tipdoc", tipo, 1);
        }

        $("#searchBoxes").removeClass('d-none');
        const inputs = $("#filtrosDoc");
        inputs.empty();
        var selectedTipo = $("#tiposDoc").val();
        if (selectedTipo == null) {
            selectedTipo = getCookie("tipdoc");
        }
        var urlCampos = "http://172.16.15.20/API.LovablePHP/ZLO0015P/ListTiposFind/?tipo=" + selectedTipo;
        var responseCampos = ajaxRequest(urlCampos);
        if (responseCampos.code == 200) {
            $("#tipDocs").val($("#tiposDoc").val());
            camposDes = responseCampos.data[0].CAMPOS.split("/");
            var counter = camposDes.length;
            camposDes[counter] = 'Fecha de documento';
            camposDes[counter + 1] = 'Fecha de digitalización';
            camposDes[counter + 2] = 'Nombre de documento';
            var htmlAppend = "";
            camposLength=camposDes.length;
            for (let i = 0; i < camposDes.length; i++) {
                htmlAppend += '<div id="input-first-name" class="wideInput">';
                if (camposDes[i].toLowerCase() == "proveedor") {
                    // htmlAppend+='<span onclick="showProveedores()"><input class="form-select inputsDoc fn" type="text" id="'+responseCampos.data[0]['TIPDOC']+i+'" required readonly /></span>';
                    htmlAppend +=
                        '<input class="inputsDoc fn" style="font-size:16px;"  type="text" autocomplete="off" data-placeholder-focus="false" required id="' +
                        responseCampos.data[0]['TIPDOC'] + i +
                        '" onclick="showProveedores()"  oninput="noTextInput(this)"/><button type="button" class="btn p-0 m-0 fs-5" onclick="vaciarInput()"><i class="fa-solid fa-xmark fs-6 "></i></button>';
                    htmlAppend += '<input class="d-none" id="originalData" /> <input class="d-none" id="codigo" /> <input class="d-none" id="provId" value="'+responseCampos.data[0]['TIPDOC']+i+'" />'
                } else if (camposDes[i].toLowerCase() == "tienda" || camposDes[i].toLowerCase() == "compañia") {
                    // htmlAppend+='<span onclick="showProveedores()"><input class="form-select inputsDoc fn" type="text" id="'+responseCampos.data[0]['TIPDOC']+i+'" required readonly /></span>';
                    htmlAppend +=
                        '<input class="inputsDoc fn" style="font-size:16px;"  type="text" autocomplete="off" data-placeholder-focus="false" required id="' +
                        responseCampos.data[0]['TIPDOC'] + i + '" onclick="showTiendas(`' + responseCampos.data[0][
                            'TIPDOC'
                        ] + i +
                        '`)"  oninput="noTextInput3(this)"/><button type="button" class="btn p-0 m-0 fs-5" onclick="vaciarInput3()"><i class="fa-solid fa-xmark fs-6"></i></button>';
                    htmlAppend +=
                        '<input class="d-none" id="originalTienda" /> <input class="d-none" id="codigoTienda" />'
                } else if (camposDes[i] == "Fecha de documento") {
                    htmlAppend +=
                        '<input class="inputsDoc fn" style="font-size:14px;"  type="text" autocomplete="off" data-placeholder-focus="false" required id="FechasDocs" onclick="showRange()"  oninput="noTextInput2(this)"/><button type="button" class="btn p-0 m-0 fs-5" onclick="vaciarInput2()"><i class="fa-solid fa-xmark fs-6"></i></button>';
                    htmlAppend +=
                        '<input class="d-none" id="originalRangeDocumento" /> <input class="d-none" id="valueTipo" />'
                } else if (camposDes[i] == "Fecha de digitalización") {
                    htmlAppend +=
                        '<input class="inputsDoc fn" style="font-size:14px;"  type="text" autocomplete="off" data-placeholder-focus="false" required id="FechasGrabs" onclick="showRange2()"  oninput="noTextInput4(this)"/><button type="button" class="btn p-0 m-0 fs-5" onclick="vaciarInput4()"><i class="fa-solid fa-xmark fs-6"></i></button>';
                    htmlAppend += '<input class="d-none" id="originalRangeGrabado" /> <input class="d-none" />'
                } else {
                    htmlAppend +=
                        '<input class="inputsDoc fn"  type="text" autocomplete="off" data-placeholder-focus="false" required id="' +
                        responseCampos.data[0]['TIPDOC'] + i + '"  />'
                }

                if (camposDes[i] == "Fecha de documento") {
                    htmlAppend += `<label id="lblRange">` + camposDes[i] + `</label>`;
                } else {
                    htmlAppend += `<label>` + camposDes[i] + `</label>`;
                }

                htmlAppend += `<svg class="icon--check" width="21px" height="17px"
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
                                                </div>`;
                inputs.append(htmlAppend);
                htmlAppend = "";
            }
            var numElements=camposLength/2;
            var porcentajes=100/numElements;
            var elements = document.querySelectorAll('.wideInput');
            elements.forEach(function(element) {
                element.style.flex = '1 0 '+porcentajes+'%'; 
            });
            

            

        }
    }
    var Date1;
    var Date2;

    function showTiendas(id) {
        $("#inputIdTiendas").val(id);
        $("#tiendasSelect").empty();
        $("#tiendasSelect").append(comarcOptions);
        $("#modalTiendas").modal('show');
    }

    function saveTienda() {
        var id = $("#inputIdTiendas").val();
        $("#codigoTienda").val($("#tiendasSelect").val());
        $("#" + id).val($("#tiendasSelect option:selected").text());
        $("#originalTienda").val($("#tiendasSelect option:selected").text());
        $("#modalTiendas").modal('hide');
    }

    function showRange() {
        $("#dayRange").empty();
        var currentDate = new Date().toISOString().split('T')[0];
        Date1 = currentDate.substr(0, 10);
        Date2 = currentDate.substr(13, 10);
        var fechasActual = $("#FechasDocs").val();
        if (fechasActual != "") {

            Date1 = fechasActual.substr(0, 10);
            Date2 = fechasActual.substr(13, 10);
        }
        $("#dayRange").append(`<div class="input-group mt-1">
                                        <input class="form-control" id="datepicker2" name="datepicker2"/>
                                        <span class="input-group-text" id="basic-addon2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                        </svg></span>
                                        </div>`);
        const picker2 = new easepick.create({
            element: "#datepicker2",
            css: ["../../assets/vendors/dayrangepicker/index.css"],
            zIndex: 10,
            plugins: ["RangePlugin"]
        });

        $("#modalRangeDocumento").modal('show');
    }

    function showRange2() {
        $("#dayRange2").empty();
        var currentDate = new Date().toISOString().split('T')[0];
        Date1 = currentDate.substr(0, 10);
        Date2 = currentDate.substr(13, 10);
        var fechasActual = $("#FechasGrabs").val();
        if (fechasActual != "") {

            Date1 = fechasActual.substr(0, 10);
            Date2 = fechasActual.substr(13, 10);
        }
        $("#dayRange2").append(`<div class="input-group mt-1">
                                        <input class="form-control" id="datepicker3" name="datepicker3"/>
                                        <span class="input-group-text" id="basic-addon2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                        </svg></span>
                                        </div>`);
        const picker2 = new easepick.create({
            element: "#datepicker3",
            css: ["../../assets/vendors/dayrangepicker/index.css"],
            zIndex: 10,
            plugins: ["RangePlugin"]
        });

        $("#modalRangeGrabado").modal('show');
    }

    function saveFecha() {
        $("#lblRange").text("Fecha de documento");
        $("#valueTipo").val(1);
        $("#modalRangeDocumento").modal('hide');
    }

    function sendForm() {
        var rangeDocumento = $('#datepicker2').val();
        $("#originalRangeDocumento").val(rangeDocumento);
        var rangeGrabado = $('#datepicker3').val();
        $("#originalRangeGrabado").val(rangeGrabado);
        $("#FechasDocs").val(rangeDocumento);
        $("#FechasGrabs").val(rangeGrabado);
        $("#lblRange").text("Fecha de documento");
        $("#valueTipo").val(1);
        $("#modalRangeDocumento").modal('hide');
        $("#modalRangeGrabado").modal('hide');
    }

    function vaciarInput() {
        var idInput=$("#provId").val();
        $('#'+idInput+'').val('');
        codigo='';
    }

    function vaciarInput2() {
        $('#originalRangeDocumento').val('');
        $('#valueTipo').val('');
        $('#FechasDocs').val('');
        $('#datepicker2').val('');
    }

    function vaciarInput3() {
        var id = $("#inputIdTiendas").val();
        $('#originalTienda').val('');
        $('#codigoTienda').val('');
        $('#' + id).val('');
    }

    function vaciarInput4() {
        $('#originalRangeGrabado').val('');
        $('#FechasGrabs').val('');
        $('#datepicker3').val('');
    }

    function showProveedores() {
        $("#modalProveedores").modal('show');
    }

    function sendProveedor(row){
            var tr=$(row).closest('tr');
            var tds=tr.find('td');
            var tipo=tds.eq(0).text();
            var id=tds.eq(1).text();
            var desc=tds.eq(2).text();
            codigo=tipo+'-'+id;
            var idInput=$("#provId").val();
            $("#"+idInput+"").val(tipo+' '+id+' '+desc);
            $("#modalProveedores").modal('hide');
        }

    function noTextInput(inputElement) {
        var originalData = $("#originalData").val();
        inputElement.value = originalData;
    }

    function noTextInput2(inputElement) {
        var originalData2 = $("#originalRangeDocumento").val();
        inputElement.value = originalData2;
    }

    function noTextInput3(inputElement) {
        var originalData2 = $("#originalTienda").val();
        inputElement.value = originalData2;
    }

    function noTextInput2(inputElement) {
        var originalData2 = $("#originalRangeGrabado").val();
        inputElement.value = originalData2;
    }

    function searchF() {
        //$('#modalConsulta').modal('hide');
        var campos = {
            "CAM0": "",
            "CAM1": "",
            "CAM2": "",
            "CAM3": "",
            "CAM4": "",
            "CAM5": "",
            "CAM6": "",
            "CAM7": "",
            "CAM8": "",
            "CAM9": ""
        };
        inputs = $(".inputsDoc");
        var tipo = $("#tipDocs").val();
        console.log('cambio');
        console.log(tipo);
        for (let i = 0; i < (inputs.length - 3); i++) {
            if (camposDes[i].toLowerCase() == "tienda" || camposDes[i].toLowerCase() == "compañia") {
                campos["CAM" + i] = $("#codigoTienda").val();
            }else if(camposDes[i].toLowerCase() == "proveedor"){
                campos["CAM" + i] = codigo;
            } 
            else {
                campos["CAM" + i] = $("#" + tipo + i + "").val();
            }
        }
        console.log(campos);
        var tipProv = "";
        var idProv = "";
        if (tipo == 'FAC' && tipo != 'A') {
            var proveedor = ($("#codigo").val()).split('-');
            tipProv = (proveedor[0] != null) ? proveedor[0] : "";
            idProv = (proveedor[1] != null) ? proveedor[1] : "";
        }

        for (let i = 0; i < 10; i++) {
            if (tipo + '0' == 'FAC0') {
                setCookie("cam1", tipProv, 1);
                setCookie("cam2", idProv, 1);
                setCookie("cam3", campos['CAM1'], 1);
                setCookie("cam4", campos['CAM2'], 1);
            } else {
                var j = i + 1;
                setCookie("cam" + j, campos['CAM' + i + ''], 1);
            }
        }
        var valArea = $("#cbbDepartamentos").val();
        if (valArea != null) {
            var area = valArea.split('-');
            var depa = area[0];
            var sec = area[1];
            setCookie("valArea", valArea, 1);
            setCookie("coddep", depa, 1);
            setCookie("secdep", sec, 1);
        }

        chargeTable();
    }

    function chargeTable() {
        if (anoing == 0 & numemp == 0) {
            var areaGen = getCookie("valArea");
            if (areaGen != null) {
                $("#cbbDepartamentos").val(areaGen);
            }
        }
        $("#tableDocs").empty();
        $("#tableDocs").append(
            '<label class="ms-2 fw-bold text-black mt-3">**Presione clic sobre el documento para ver los detalles**</label>'
            );
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
        if (tipo == null) {
            tipo = 'A';
        }
        var coddep = getCookie("coddep");
        var secdep = getCookie("secdep");

        var fecha1 = '';
        var fecha2 = '';
        var tipoFecha = '';
        var fecha3 = '';
        var fecha4 = '';
        if (document.getElementById('FechasDocs')) {
            if ($("#FechasDocs").val() != '') {
                var fecha = $("#FechasDocs").val();
                var fechas = fecha.split(' - ');
                fecha1 = formatFechaInput(fechas[0]);
                fecha2 = formatFechaInput(fechas[1]);
            }
            if ($("#FechasGrabs").val() != '') {
                var fecha = $("#FechasGrabs").val();
                var fechas = fecha.split(' - ');
                fecha3 = formatFechaInput(fechas[0]);
                fecha4 = formatFechaInput(fechas[1]);
            }
        }
        if (document.getElementById('valueTipo')) {
            if ($("#valueTipo").val() != '') {
                tipoFecha = $("#valueTipo").val();
            }
        }

        var idNomdoc = tipo + (inputs.length - 1);
        var nomdoc = $("#" + idNomdoc).val();
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
        if (fecha1) queryParams.push("fecha1=" + fecha1);
        if (fecha2) queryParams.push("fecha2=" + fecha2);
        if (fecha3) queryParams.push("fecha3=" + fecha3);
        if (fecha4) queryParams.push("fecha4=" + fecha4);
        if (nomdoc) queryParams.push("nomdoc=" + nomdoc);
        if (tipoFecha) queryParams.push("tipoFecha=" + tipoFecha);


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
            console.log(response.data);
            let tr;
            let limit = Math.min(response.data.length, 100);
            for (let i = 0; i < limit; i++) {
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
                            response.data[i]['CAM10'] + `','` + response.data[i]['CODDEP'] + `','` + response.data[
                                i]['CODSEC'] + `')">
                                        <div class="card-body text-center">
                                            <img src="http://172.16.15.20` + response.data[i]['URLDOC'] +
                            `"
                                                style="height:50px;" alt="">
                                            <h6 class=" responsive-font-example mt-1" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="` + response.data[i]['NOMDOC'] + `">` +
                            truncarTexto(response.data[i]['NOMDOC'].split('.').slice(0, -1).join('.')) + `</h6>
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
                            response.data[i]['CAM10'] + `','` + response.data[i]['CODDEP'] + `','` + response.data[
                                i]['CODSEC'] +
                            `')">
                                        <div class="card-body text-center">
                                            <img src="../../assets/img/icons/excel.png"
                                                width="50" alt="">
                                            <h6 class=" responsive-font-example mt-1" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="` +
                            response.data[i]['NOMDOC'] + `">` + truncarTexto(response.data[i]['NOMDOC']
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
                            response.data[i]['CAM10'] + `','` + response.data[i]['CODDEP'] + `','` + response.data[
                                i]['CODSEC'] +
                            `')">
                                        <div class="card-body text-center">
                                            <img src="../../assets/img/icons/word.png"
                                                width="50" alt="">
                                            <h6 class=" responsive-font-example mt-1" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="` +
                            response.data[i]['NOMDOC'] + `">` + truncarTexto(response.data[i]['NOMDOC']
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
                            response.data[i]['CAM10'] + `','` + response.data[i]['CODDEP'] + `','` + response.data[
                                i]['CODSEC'] +
                            `')">
                                        <div class="card-body text-center">
                                            <img src="../../assets/img/icons/pdf.png"
                                                width="50" alt="">
                                            <h6 class=" responsive-font-example mt-1" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="` +
                            response.data[i]['NOMDOC'] + `">` + truncarTexto(response.data[i]['NOMDOC'].split('.')
                                .slice(0, -1).join('.')) + `</h6>
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
                            response.data[i]['CAM10'] + `','` + response.data[i]['CODDEP'] + `','` + response.data[
                                i]['CODSEC'] +
                            `')">
                                        <div class="card-body text-center">
                                            <img src="../../assets/img/icons/txt.png"
                                                width="50" alt="">
                                            <h6 class=" responsive-font-example mt-1" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="` +
                            response.data[i]['NOMDOC'] + `">` + truncarTexto(response.data[i]['NOMDOC']
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
                            response.data[i]['CAM10'] + `','` + response.data[i]['CODDEP'] + `','` + response.data[
                                i]['CODSEC'] +
                            `')">
                                        <div class="card-body text-center">
                                            <img src="../../assets/img/icons/pp.png"
                                                width="50" alt="">
                                            <h6 class=" responsive-font-example mt-1" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="` +
                            response.data[i]['NOMDOC'] + `">` + truncarTexto(response.data[i]['NOMDOC']
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
                            response.data[i]['CAM10'] + `','` + response.data[i]['CODDEP'] + `','` + response.data[
                                i]['CODSEC'] +
                            `')">
                                        <div class="card-body text-center">
                                            <img src="../../assets/img/icons/folder.png"
                                                width="50" alt="">
                                            <h6 class=" responsive-font-example mt-1" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="` +
                            response.data[i]['NOMDOC'] + `">` + truncarTexto(response.data[i]['NOMDOC']
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
                            response.data[i]['CAM10'] + `','` + response.data[i]['CODDEP'] + `','` + response.data[
                                i]['CODSEC'] +
                            `')">
                                        <div class="card-body text-center">
                                            <img src="../../assets/img/icons/file.png"
                                                width="50" alt="">
                                            <h6 class="responsive-font-example mt-1" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="` +
                            response.data[i]['NOMDOC'] + `">` + truncarTexto(response.data[i]['NOMDOC']
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
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        } else {
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
        cam4, cam5, cam6, cam7, cam8, cam9, coddep, codsec) {

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
        $("#downloadCard").append(
            `
            <div class="row m-3">
                <div class="col-6">
                <a class="btn btn-warning fw-bold text-white" style="width:100%;" target="_blank" href="http://172.16.15.20` + urldoc + `" >Visualizar documento <i class="fa-solid fa-eye"></i></a>
                
                </div>
                <div class="col-6">
                    <a class="btn btn-info fw-bold text-white" style="width:100%;" href="http://172.16.15.20` +
            urldoc + `" download>Descargar <i class="fa-solid fa-download"></i></a>
                </div>
            </div>
            `);

        $("#trashDoc").empty();
        var permisos = "<?php echo isset($_SESSION['PERESP'])? $_SESSION['PERESP']: ''; ?>";
        if (permisos === 'S') {
            $("#trashDoc").append(
                ` <button type="button" class="btn btn-danger m-0 mt-2  text-white" onclick="deleteCard('` +
                nomcard +
                `','` + usugra + `','` + fecgra + `','` + horgra + `','` + extdoc + `','` + urldoc +
                `')" ><i class="fa-solid fa-trash-can"></i></button>`);
        }

        $("#titleDoc").text(nomcard);
        var selectElement = document.getElementById('tiposDoc');
        var optionText = Array.from(selectElement.options).find(option => option.value === tipdoc);
        var textoSelect = "";
        if (optionText) {
            textoSelect = optionText.textContent || optionText.innerText;
        }
        $("#tipDoc").text(textoSelect);
        $("#fechaDoc").text(formatFecha(fecha));
        $("#descrpDoc").text(descrp);
        var depaUrl = "http://172.16.15.20/API.LovablePHP/ZLO0016P/GetDepa/?coddep=" + coddep + "&secdep=" + codsec +
        "";
        var responseDepa = ajaxRequest(depaUrl);
        var depa = '';
        if (responseDepa.code == 200) {
            depa = responseDepa.data['SECDES'];
        }
        $("#depaDoc").text(coddep + " - " + codsec + " " + depa);
        $("#usuaGra").text(usugra);
        $("#horaGra").text(formatFecha(fecgra) + ' ' + formatTime(horgra));
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
            var cont = 0;
            var length = camposDes.length;
            for (let i = 0; i < length; i++) {
                    var descripcion = "";
                    if (camposDes[i].toLowerCase() == "tienda"|| camposDes[i].toLowerCase() == "compañia") {
                        var urlDes = "http://172.16.15.20/API.LovablePHP/ZLO0001P/FindComarc/?compFiltro=" + campos[
                            'cam' + i] + "";
                        var responseDes = ajaxRequest(urlDes);
                        descripcion = (responseDes.code == 200) ? responseDes.data[0]['COMDES'] : "";
                    }else if(camposDes[i].toLowerCase() == "proveedor"){
                        var id=campos['cam' + i].split("-");
                        var tipo = id[0]; var prov = id[1];
                        var urlFind = "http://172.16.15.20/API.LovablePHP/ZLO0015P/ProveedoresFind/?tipo=" + tipo +"&proveedor=" + prov + "";
                        var responseFind = ajaxRequest(urlFind);
                        descripcion = (responseFind.code == 200) ? responseFind.data[0]['ARCNOM'] : "";
                    }
                    inputs.append(`<div class="col-6 col-lg-2 mt-2">
                                <h6 class=" mt-1">` + camposDes[i] + `:</h6></div>
                                <div class="col-6 col-lg-4 mt-2">
                                <label class="text-start form-control">` + campos['cam' + i] + ` ` + descripcion
                        .toUpperCase() + `</label>
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

    function formatFechaInput(inputDate) {
        var year = inputDate.substring(10, 6);
        var month = inputDate.substring(3, 5);
        var day = inputDate.substring(0, 2);
        var formattedDate = year + month + day;

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
    <script src="../../assets/js/jquery.flexselect.js"></script>
    <script src="../../assets/js/liquidmetal.js"></script>
    <script src="../../assets/vendors/dayrangepicker/index.umd.min.js"></script>
    <div class="modal fade" id="docInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
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
                                    <div class="">
                                        <div class="">
                                            <div class="row mb-2">
                                                <div class="col-6 col-lg-2">
                                                    <h6 class=" mt-1">Tipo:</h6>
                                                </div>
                                                <div class="col-6 col-lg-4">
                                                    <label class="text-start form-control" id="tipDoc"></label>
                                                </div>
                                                <div class="col-6 col-lg-2">
                                                    <h6 class=" mt-1">Fecha de documento:</h6>
                                                </div>
                                                <div class="col-6 col-lg-4">
                                                    <label class="text-start form-control" id="fechaDoc"></label>
                                                </div>
                                                <div class="col-12 col-lg-2 mt-2">
                                                    <h6 class=" mt-1">Descripcion:</h6>
                                                </div>
                                                <div class="col-12 col-lg-4 mt-2">
                                                    <span class="text-justify " id="descrpDoc"></span>
                                                </div>
                                                <div class="col-12 col-lg-2 mt-2">
                                                    <h6 class=" mt-1">Departamento:</h6>
                                                </div>
                                                <div class="col-12 col-lg-4 mt-2">
                                                    <label class="text-start form-control" id="depaDoc"></label>
                                                </div>
                                            </div>
                                            <!--<div>
                                            <button class="btn p-0 m-0" style="width:50px;">Editar <i class="fa-solid fa-pen-to-square"></i></button>
                                            </div>-->
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <hr>
                                            </div>
                                        </div>

                                        <div class="row " id="extraInfo">

                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-6 col-lg-2">
                                                <h6 class=" mt-1">Usuario digitalización:</h6>
                                            </div>
                                            <div class="col-6 col-lg-4">
                                                <label class="text-start form-control" id="usuaGra"></label>
                                            </div>
                                            <div class="col-6 col-lg-2">
                                                <h6 class=" mt-1">Fecha digitalización:</h6>
                                            </div>
                                            <div class="col-6 col-lg-4">
                                                <label class="text-start form-control" id="horaGra"></label>
                                            </div>
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
    <div class="modal fade" id="modalProveedores" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>

                    <button type="button" class="btn-close" onclick="$('#modalProveedores').modal('hide')"></button>
                </div>
                <div class="modal-body">
                    <div class="table-container mt-3" style="width:100%;">
                        <table id="tbProveedores" class="table stripe table-hover " style="width:100%">
                            <thead>
                                <tr>
                                    <th colspan="10%" class="text-black text-start">Tipo</th>
                                    <th colspan="10%" class="text-black text-start">Proveedor</th>
                                    <th colspan="10%" class="text-black text-start">Descripción</th>
                                </tr>
                            </thead>
                            <tbody id="tbProveedoresBody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalRangeDocumento" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Selecciona un rango de fechas</h1>

                    <button type="button" class="btn-close" onclick="$('#modalRangeDocumento').modal('hide')"></button>
                </div>
                <div class="modal-body">
                    <label class="me-3">Fecha de documento</label>
                    <div id="dayRange">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="saveFecha()">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalRangeGrabado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Selecciona un rango de fechas</h1>

                    <button type="button" class="btn-close" onclick="$('#modalRangeGrabado').modal('hide')"></button>
                </div>
                <div class="modal-body">
                    <label class="me-3">Fecha de digitalización</label>
                    <div id="dayRange2">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="saveFecha()">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTiendas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Selecciona un rango de fechas</h1>

                    <button type="button" class="btn-close" onclick="$('#modalTiendas').modal('hide')"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <input type="text" class="d-none" id="inputIdTiendas">
                            <label class="mb-3">Punto de venta: </label>
                            <select id="tiendasSelect" class="form-select">

                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="saveTienda()">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>