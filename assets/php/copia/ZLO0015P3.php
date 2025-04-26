<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
    <link href="../../assets/vendors/uppyjs/uppy.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/flexselect.css">
    <link rel="stylesheet" href="../../assets/vendors/dayrangepicker/index.css">
    <style>
        .space-cards {
            width: 20%;
        }

        .h550 {
            height: 550px !important;
        }

        .h750 {
            height: 750px !important;
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
    <?php include '../layout-prg.php';
    include '../../assets/php/ZDD/ZLO0015P/header.php';
    ?>

    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <span>Digitalización de documentos / Subir</span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0015P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-1">
        <div class="card mb-5">
            <div class="card-header">
                <h1 class="fs-4 mb-1 mt-2 text-center">Subir documentos</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-xl-8 mt-2">
                        <div class="table-responsive">
                            <div class="d-none" id="searchingFilesDiv">
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                aria-expanded="true" aria-controls="collapseOne">
                                                Filtros
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="position-relative">
                                                    <form id="formFiltros"
                                                        action="../../assets/php/ZDD/ZLO0016P/filtrosLogica.php"
                                                        method="POST">
                                                        <div class="row mb-2">
                                                            <div class="col-12">
                                                                <div class="row" id="isGerencia">

                                                                </div>
                                                                <input type="text" class="form-control d-none"
                                                                    id="tipDocs2">
                                                            </div>
                                                            <div class="col-12 mt-3" id="searchBoxes">
                                                                <form action="#" id="header-search-people"
                                                                    class="form-area" novalidate="novalidate">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="table-responsive">
                                                                                <div class="styled-input wide multi"
                                                                                    id="filtrosDoc">


                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <button type="button"
                                                                                class="btn btn-success mt-3 fw-bold text-white"
                                                                                style="width:100%;" onclick="searchF()">
                                                                                <span class="me-2">BUSCAR</span>
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="28" height="28" fill="#fff"
                                                                                    class="bi bi-search"
                                                                                    viewBox="0 0 16 16">
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
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-2" style="width:100%;" id="tableDocs">

                                </div>
                            </div>
                            <div id="uppy"></div>
                        </div>
                        <div>
                            <label class="ms-2 me-1 mt-3 d-none" id="lblNumDoc">Se encontraron <span class="fw-bold"
                                    id="numDocumentos">0</span> documentos</label>
                        </div>
                    </div>
                    <div class="col-12 col-xl-4 mt-2">
                        <div class="card overflow-auto" id="divInfo">
                            <div class="card-header">
                                <h5 class="mb-1 mt-2">Información del documento</h5>
                            </div>
                            <div class="card-body text-center">
                                <label class="text-danger d-none" id="lblError">Rellene todos los campos.</label>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <h6 class="mb-3 text-start">Tipo de documento</h6>
                                        <select class="form-select" id="tiposDoc">
                                            <option value="1" selected disabled>Selecciona un tipo</option>

                                        </select>
                                        <input id="tipDocs" class="d-none" />
                                    </div>
                                    <div class="col-12" id="inputs">
                                    </div>
                                    <div class="col-12">
                                        <h6 class="mb-3 mt-4 text-start">Fecha de documento</h6>
                                        <input type="date" class="form-control" id="fechaDoc">
                                    </div>
                                    <div class="col-6">
                                        <h6 class="mb-1 mt-4 text-start">Fecha de digitalización</h6>
                                        <label class="form-control" id="fechaDigit"></label>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="mb-1 mt-4 text-start">Hora de digitalización</h6>
                                        <label class="form-control" id="horaDigit"></label>
                                    </div>
                                    <div class="col-12">
                                        <h6 class="mb-3 mt-4 text-start">Descripcion</h6>
                                        <textarea id="descrpDoc" placeholder="Ingrese una descripcion del documento"
                                            class="form-control" rows="5"
                                            style="height:150px; resize: none;"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-none" id="searchDocsDigDiv">
                        <button class="btn btn-light mt-4 fw-bold" type="button" id="searchDocsDig">
                            <span id="contentButton">

                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <div class="footer bg-blck flex-grow-1 d-flex justify-content-center">
        <p class="bggray responsive-font-example"><i>Lovable de Honduras S.A. de C.V</i></p>
    </div>
    <script src="../../assets/vendors/dayrangepicker/index.umd.min.js"></script>
    <script>
        $(document).on('keypress', function (e) {
            if (e.which == 13) {
                searchF();
            }
        });
        document.getElementById("descrpDoc").addEventListener("input", function (event) {
            var input = event.target;
            var newValue = input.value.replace(/[^\w\sáéíóúÁÉÍÓÚñÑ]/g, "");
            input.value = newValue;
        });
        var codusu;
        var anoing;
        var numemp;
        var codsec = 0;
        var coddep = 0;
        var codigo = "";
        var comarcOptions = "";
        var tiendasOptions = "";
        var camposDes = "";
        var cor = "";
        var tipoWeb = "";
        var user = "";
        var inputsLength = 0;
        var inputsDoc = [];
        var inputsData = [];
        const documentosSeleccionados = [];
        $(document).ready(function () {
            $("#contentButton").html(`<i class="fa-solid fa-paste"></i>
                            <span class="ms-3">Encontrar un documento ya digitalizado</span>`)
            $("#divInfo").addClass('h550')
            codusu = "<?php echo isset($_SESSION['CODUSU']) ? $_SESSION['CODUSU'] : ''; ?>";
            anoing = "<?php echo isset($_SESSION['ANOING']) ? $_SESSION['ANOING'] : ''; ?>";
            numemp = "<?php echo isset($_SESSION['NUMEMP']) ? $_SESSION['NUMEMP'] : ''; ?>";

            const currentUrl = window.location.href;
            var url = new URL(currentUrl);
            user = url.searchParams.get("user");
            if (user) {
                var cia = "";
                var prv = "";
                var tip = "";
                var doc = "";
                var apl = "";
                var docf = "";
                var fec = "";
                var tienda = "";
                var descrp = "";
                var paramsLength = "";
                cor = url.searchParams.get("cor");
                var getParamsurl = "/API.LovablePHP/ZLO0015P/GetParams2/?cod=" + cor + "";
                var responseParams = ajaxRequest(getParamsurl);
                if (responseParams.code == 200) {
                    paramsData = responseParams.data;
                    inputsData = paramsData;
                    paramsLength = paramsData['LENGTH'];
                    fec = paramsData['FECDOC'];
                    apl = paramsData['MODULO'];
                    tipoWeb = paramsData['TIPWEB'];
                    descrp = paramsData['DESCRP'];
                    //comprobando si es factura con varias ordenes
                    const urlFac = '/API.LovablePHP/ZLO0015P/GetOrdenes/';
                    const codcia = paramsData['CAM1'] ? paramsData['CAM1'].split(':')[1] : '';
                    const prov = paramsData['CAM2'] ? paramsData['CAM2'].split(':')[1] : '';
                    const tipo = paramsData['CAM3'] ? paramsData['CAM3'].split(':')[1] : '';
                    const fac = paramsData['CAM6'] ? paramsData['CAM6'].split(':')[1] : '';
                    const data = {
                        "CIA": codcia,
                        "APL": paramsData['MODULO'],
                        "TIPO": tipo,
                        "FAC": fac,
                        "PROV": prov
                    }
                    fetch(urlFac, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    }).then(response => {
                        return response.json();
                    }).then(data => {
                        if (data.code == 200) {
                            $("#lbl4").addClass('d-none');
                        } else {
                            console.log(data.message);
                        }
                    });

                    const urlRelacion = "http://172.16.15.20/API.LovablePHP/ZLO0015P/GetRelacion/";
                    const dataRel = {
                        "TIPDOC": tipoWeb,
                    }
                    fetch(urlRelacion, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(dataRel)
                    }).then(response => {
                        return response.json();
                    }).then(data => {
                        if (data.code == 200) {
                            const tdoc = data.data[0]['TIPDO2']
                            setCookie("tipdoc", tdoc, 1);
                            $("#searchDocsDigDiv").removeClass('d-none')
                        } else {
                            $("#searchDocsDigDiv").addClass('d-none')
                        }
                    });

                }
            }

            var usuario = '<?php echo $_SESSION["CODUSU"]; ?>';
            var urlComarc = '/API.LovablePHP/ZLO0015P/ListComarc2/?user=' + usuario + '';
            var responseComarc = ajaxRequest(urlComarc);
            if (responseComarc.code == 200) {
                for (let i = 0; i < responseComarc.data.length; i++) {
                    comarcOptions += '<option value="' + responseComarc.data[i].COMCOD.padStart(2, '0') + '">' +
                        responseComarc.data[i].COMDES + '</option>';
                }
                $("#CompaniaSelect").append(comarcOptions);
            }
            var urlTiendas = '/API.LovablePHP/ZLO0015P/ListTiendas/?user=' + usuario + '';
            var responseTiendas = ajaxRequest(urlTiendas);
            if (responseTiendas.code == 200) {
                for (let i = 0; i < responseTiendas.data.length; i++) {
                    tiendasOptions += '<option value="' + responseTiendas.data[i].COMCOD.padStart(2, '0') + '">' +
                        responseTiendas.data[
                            i].COMDES + '</option>';
                }
                $("#tiendasSelect").append(tiendasOptions);
            }
            //var urlTipos = "/API.LovablePHP/ZLO0015P/ListTipos/";
            var urlTipos = "/API.LovablePHP/ZLO0015P/ListTipos2/?user=" + usuario + "";
            var responseTipos = ajaxRequest(urlTipos);
            if (responseTipos.code == 200) {
                const tipos = $("#tiposDoc");
                for (let i = 0; i < responseTipos.data.length; i++) {
                    tipos.append(`<option value="` + responseTipos.data[i].TIPDOC + `">` + responseTipos.data[i]
                        .DESCRP + `</option>`);
                }
            }

            var currentDate = new Date().toISOString().split('T')[0];
            $('#fechaDigit').text(currentDate);
            $('#fechaDoc').val(currentDate);

            $('#tbProveedores thead th').each(function () {
                var title = $(this).text();
                $(this).html(title +
                    '<br /><input type="text"  oninput="this.value = this.value.toUpperCase()" class="form-control mt-2"/>'
                );
            });
            var table = $('#tbProveedores').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                },
                "pageLength": 10,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "/API.LovablePHP/ZLO0015P/ListProveedoresAsync/",
                    "type": "POST",
                    "complete": function (xhr) {
                        //console.log(xhr.responseJSON);
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                        requestError = true;
                    }
                },
                "ordering": false,
                "dom": 'rtip',
                "columns": [{
                    "data": "ARCCIU",
                    render: function (data) {
                        return data.padStart(2, '0');
                    }
                },
                {
                    "data": "ARCCO1",
                    render: function (data) {
                        return data.padStart(4, '0');
                    }
                },
                {
                    "data": "ARCNOM"
                },
                ],
                "drawCallback": function () {
                    $('#tbProveedores tbody tr').on('click', function () {
                        sendProveedor(this);
                    });
                }
            });
            $('#tbProveedores thead input').on('keyup', function () {
                var columnIndex = $(this).parent().index();
                var inputValue = $(this).val().trim();

                if (table.column(columnIndex).search() !== inputValue) {
                    table
                        .column(columnIndex)
                        .search(inputValue)
                        .draw();
                }
            });

            $("#tiposDoc").on('change', function () {
                const inputs = $("#inputs");
                inputs.empty();
                var selectedTipo = $("#tiposDoc").val();
                var urlCampos = "/API.LovablePHP/ZLO0015P/ListTiposFind/?tipo=" +
                    selectedTipo;
                var responseCampos = ajaxRequest(urlCampos);
                if (responseCampos.code == 200) {
                    $("#tipDocs").val(responseCampos.data[0]['TIPDOC']);
                    camposDes = responseCampos.data[0].CAMPOS.split("/");
                    for (let i = 0; i < camposDes.length; i++) {
                        inputsDoc.push({
                            "campoId": responseCampos.data[0]['TIPDOC'] + i,
                            "desc": camposDes[i].toLowerCase()
                        })
                        if (camposDes[i].toLowerCase() == "proveedor") {
                            var select = '<span class="" onclick="showProveedores()"><input type="text" class="text-muted form-select inputsDoc" id="' +
                                responseCampos.data[0]['TIPDOC'] + i + '" placeholder="Selecciona un proveedor" readonly /></span> <input class="d-none" id="provId" value="' +
                                responseCampos.data[0]['TIPDOC'] + i + '" />';
                            inputs.append(`<label class=" text-start" id="lbl` + i +
                                `" style="width:100%; margin-top: 15px;">` + camposDes[i] + `: ` +
                                select + `</label>`);
                            //$(".selectProveedores").flexselect();
                        } else if (camposDes[i].toLowerCase() == "tienda") {
                            var select = `<label class=" text-start" id="lbl` + i +
                                `" style="width:100%;   margin-top: 15px;">` + camposDes[i] +
                                `:<select class="form-select inputsDoc" id="` + responseCampos.data[0][
                                'TIPDOC'
                                ] + i + `" placeholder="Selecciona una tienda"  /></select></label>`;
                            inputs.append(select);
                            $("#" + responseCampos.data[0]['TIPDOC'] + i).append(tiendasOptions);
                        } else if (camposDes[i].toLowerCase() == "compañia") {
                            var select = `<label class=" text-start"  id="lbl` + i +
                                `" style="width:100%;  margin-top: 15px;">` + camposDes[i] +
                                `:<select class="form-select inputsDoc" id="` + responseCampos.data[0][
                                'TIPDOC'
                                ] + i + `" placeholder="Selecciona una compañía"  /></select></label>`;
                            inputs.append(select);
                            $("#" + responseCampos.data[0]['TIPDOC'] + i).append(comarcOptions);
                        } else {
                            inputs.append(`<label class=" text-start" id="lbl` + i +
                                `" style="width:100%;  margin-top: 15px;">` + camposDes[i] +
                                `: <input type="text" maxlength="30" class="form-control inputsDoc" id="` +
                                responseCampos.data[0]['TIPDOC'] + i + `" /></label>`);
                        }
                    }
                }
            });
            if (tipoWeb != '') {
                $("#tiposDoc").val(tipoWeb).trigger('change');
                const inputs = $(".inputsDoc");
                var length = inputs.length;
                var camposId = paramsLength - 5;
                for (let i = 0; i < camposId; i++) {
                    var data = paramsData['CAM' + (i + 1) + ''].split(':');
                    if (data[0] == 'proveedor') {
                        var id = data[1].split("-");
                        var tipo = id[0];
                        var prov = id[1];
                        var urlFind = "/API.LovablePHP/ZLO0015P/ProveedoresFind/?tipo=" + tipo + "&proveedor=" + prov + "";
                        var responseFind = ajaxRequest(urlFind);
                        var descripcion = (responseFind.code == 200) ? responseFind.data[0]['ARCNOM'] : "";
                        prv = tipo + '-' + prov;
                        codigo = prv;
                        $("#" + tipoWeb + i + "").val(tipo + ' ' + prov + ' ' + descripcion);
                    } else {
                        $("#" + tipoWeb + i + "").val(data[1]);
                    }
                    $("#" + tipoWeb + i + "").prop('disabled', true);
                }
                $("#tiposDoc").prop('disabled', true);
                $("#fechaDoc").prop('disabled', true);
                $("#descrpDoc").prop('disabled', true);
                var anio = fec.substring(0, 4);
                var mes = fec.substring(4, 6);
                var dia = fec.substring(6, 8);

                $("#fechaDoc").val(anio + '-' + mes + '-' + dia);
                if (descrp == 'S-N') {
                    descrp = '';
                }
                $("#descrpDoc").val(descrp);
            }
            $("#searchDocsDig").on('click', () => {
                $("#searchingFilesDiv").toggleClass('d-none')
                $("#lblNumDoc").toggleClass('d-none')
                $("#uppy").toggleClass('d-none')
                const currentText = $("#contentButton");
                if (currentText.text().includes('Encontrar')) {
                    currentText.empty();
                    currentText.html(`<i class="fa-solid fa-arrow-rotate-left"></i><span class="ms-3">Regresar a digitalizar documento</span>`)
                    $("#divInfo").removeClass('h550')
                    $("#divInfo").addClass('h750')
                } else {
                    currentText.empty();
                    currentText.html(`<i class="fa-solid fa-paste"></i>
                            <span class="ms-3">Encontrar un documento ya digitalizado</span>`);
                    $("#divInfo").removeClass('h750')
                    $("#divInfo").addClass('h550')
                }
                tiposChange();
                chargeTable();
            })
        });

        function showProveedores() {
            $("#modalProveedores").modal('show');
        }

        function sendProveedor(row) {
            var tr = $(row).closest('tr');
            var tds = tr.find('td');
            var desc = tds.eq(2).text();
            var tipo = tds.eq(0).text();
            var id = tds.eq(1).text();
            tipo = tipo.padStart(2, '0');
            id = id.padStart(4, '0');
            codigo = tipo + '-' + id;
            var idInput = $("#provId").val();
            $("#" + idInput + "").val(tipo + ' ' + id + ' ' + desc);
            $("#modalProveedores").modal('hide');
        }

        function selectDepa() {
            var value = $("#cbbDepartamentos2").val();
            var secdep = value.split("-")[0];
            var seccod = value.split("-")[1];
            codsec = seccod;
            coddep = secdep;
            if(documentosSeleccionados.length==0){
                 $(".btnSend").click();
            }else{
                saveDocRel()
            }
            $("#departModal").modal('hide');
        }

        function tiposChange() {
            codigo = "";
            var camposLength = 0;
            const selectedTipo = getCookie("tipdoc");
            var urlCampos = "/API.LovablePHP/ZLO0015P/ListTiposFind2/?tipo=" + selectedTipo;
            var responseCampos = ajaxRequest(urlCampos);
            const camposBus = [];
            let tipoweb;
            if (responseCampos.code == 200) {
                tipoweb = responseCampos.data[0]['TIPDOC'];
                camposDes = responseCampos.data[0].CAMPOS.split("/");
                var counter = camposDes.length;
                $("#tipDocs2").val(selectedTipo);
                camposDes[counter] = 'Fecha de documento';
                camposDes[counter + 1] = 'Fecha de digitalización';
                camposDes[counter + 2] = 'Nombre de documento';
                var htmlAppend = "";
                camposLength = camposDes.length;
                $("#filtrosDoc").empty();
                for (let i = 0; i < camposDes.length; i++) {
                    camposBus.push({
                        "campoId": '2' + responseCampos.data[0]['TIPDOC'] + i,
                        "desc": camposDes[i].toLowerCase()
                    })
                    htmlAppend += '<div id="input-first-name" class="wideInput">';
                    if (camposDes[i].toLowerCase() == "proveedor") {
                        // htmlAppend+='<span onclick="showProveedores()"><input class="form-select inputsDoc fn" type="text" id="'+responseCampos.data[0]['TIPDOC']+i+'" required readonly /></span>';
                        htmlAppend +=
                            '<input class="inputsDoc fn" style="font-size:16px;"  type="text" data-placeholder-focus="false" required id="2' +
                            responseCampos.data[0]['TIPDOC'] + i +
                            '" onclick="showProveedores()"  oninput="noTextInput(this)"/><button type="button" class="btn p-0 m-0 fs-5" onclick="vaciarInput()"><i class="fa-solid fa-xmark fs-6 "></i></button>';
                        htmlAppend +=
                            '<input class="d-none" id="originalData" /> <input class="d-none" id="codigo" /> <input class="d-none" id="provId" value="2' +
                            responseCampos.data[0]['TIPDOC'] + i + '" />'
                    } else if (camposDes[i].toLowerCase() == "tienda") {
                        htmlAppend +=
                            '<input class="inputsDoc2 fn" style="font-size:16px;"  type="text"  data-placeholder-focus="false" required id="2' +
                            responseCampos.data[0]['TIPDOC'] + i + '" onclick="showTiendas(`2' + responseCampos.data[0][
                            'TIPDOC'
                            ] + i +
                            '`)"  oninput="noTextInput3(this)"/><button type="button" class="btn p-0 m-0 fs-5" onclick="vaciarInput3()"><i class="fa-solid fa-xmark fs-6"></i></button>';
                        htmlAppend +=
                            '<input class="d-none" id="originalTienda" /> <input class="d-none" id="codigoTienda" />'
                    } else if (camposDes[i].toLowerCase() == "compañia") {
                        htmlAppend +=
                            '<input class="inputsDoc2 fn" style="font-size:16px;"  type="text"  data-placeholder-focus="false" required id="2' +
                            responseCampos.data[0]['TIPDOC'] + i + '" onclick="showCompanias(`2' + responseCampos.data[0][
                            'TIPDOC'
                            ] + i +
                            '`)"  oninput="noTextInput5(this)"/><button type="button" class="btn p-0 m-0 fs-5" onclick="vaciarInput5()"><i class="fa-solid fa-xmark fs-6"></i></button>';
                        htmlAppend +=
                            '<input class="d-none" id="originalCompania" /> <input class="d-none" id="2codigoCompania" />'
                    } else if (camposDes[i] == "Fecha de documento") {
                        htmlAppend +=
                            '<input class="inputsDoc2 fn" style="font-size:14px;"  type="text"  data-placeholder-focus="false" required id="2FechasDocs" onclick="showRange()"  oninput="noTextInput2(this)"/><button type="button" class="btn p-0 m-0 fs-5" onclick="vaciarInput2()"><i class="fa-solid fa-xmark fs-6"></i></button>';
                        htmlAppend +=
                            '<input class="d-none" id="originalRangeDocumento" /> <input class="d-none" id="valueTipo" />'
                    } else if (camposDes[i] == "Fecha de digitalización") {
                        htmlAppend +=
                            '<input class="inputsDoc2 fn" style="font-size:14px;"  type="text"  data-placeholder-focus="false" required id="FechasGrabs" onclick="showRange2()"  oninput="noTextInput4(this)"/><button type="button" class="btn p-0 m-0 fs-5" onclick="vaciarInput4()"><i class="fa-solid fa-xmark fs-6"></i></button>';
                        htmlAppend += '<input class="d-none" id="originalRangeGrabado" /> <input class="d-none" />'
                    } else {

                        htmlAppend +=
                            '<input class="inputsDoc2 fn"  type="text"  data-placeholder-focus="false" required id="2' +
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
                    $("#filtrosDoc").append(htmlAppend);
                    htmlAppend = "";
                    inputsLength++;
                }
                var numElements = camposLength / 2;
                var porcentajes = 100 / numElements;
                var elements = document.querySelectorAll('.wideInput');
                elements.forEach(function (element) {
                    element.style.flex = '1 0 ' + porcentajes + '%';
                });
                var length = paramsData['LENGTH'] - 5;
                for (let i = 0; i < length; i++) {
                    var data = paramsData['CAM' + (i + 1) + ''].split(':');
                    if (data[0] == 'proveedor') {
                        var id = data[1].split("-");
                        var tipo = id[0];
                        var prov = id[1];
                        var urlFind = "/API.LovablePHP/ZLO0015P/ProveedoresFind/?tipo=" + tipo + "&proveedor=" + prov + "";
                        var responseFind = ajaxRequest(urlFind);
                        var descripcion = (responseFind.code == 200) ? responseFind.data[0]['ARCNOM'] : "";
                        prv = tipo + '-' + prov;
                        codigo = prv;
                        $("#2" + tipoweb + i + "").val(tipo + ' ' + prov + ' ' + descripcion);
                    }else if (data[0] == 'compañia') {
                        var companialbl = $("#CompaniaSelect option[value='" + data[1] + "']").text();
                        $("#2" + tipoweb + i + "").val(companialbl);
                        $("#codigoCompania").val(data[1]);
                        $("#inputIdCompania").val(tipoweb);
                    }else if (data[0] == 'tienda') {
                        var tiendalbl = $("#TiendasSelect option[value='" + data[1] + "']").text();
                        $("#2" + tipoweb + i + "").val(tiendalbl);
                        $("#codigoTienda").val(data[1]);
                        $("#inputIdTienda").val(tipoweb);
                    }else if (data[0]=='numero doc. fiscal'){
                        console.log(data[0]);
                        $("#2" + tipoweb + (i+1) + "").val(data[1]);
                    }
                }
                searchF();
            }
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
                `<div class="row p-0 m-0">
                <div class="col-8">
                    <label class="ms-2 fw-bold text-black text-start mt-3" id="lblSelect">**Haga clic para seleccionar o doble clic para ver los detalles**</label>
                </div>
                <div class="col-4 text-end d-none" id="divSelect">
                    <button class="btn btn-info fw-bold text-white shadow-lg mx-3 my-2" onclick="saveDocRel()">
                        <span class="mx-3">Guardar este documento</span> <i class="fa-solid fa-floppy-disk"></i>
                    </button>
                </div>
            </div>
            `);
            $("#tableDocs").append(`
                    <div class="table-responsive" style="height:580px;">
                                <table id="myTableInvDesc" class="table stripe mt-5" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th class="space-cards"></th>
                                            <th class="space-cards"></th>
                                            <th class="space-cards"></th>
                                            <th class="space-cards" id="col1"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTableBody">


                                    </tbody>
                                </table>
                            </div>`);

            let width = screen.width;
            var row = 5;
            if (width < 1024) {
                $("#col1, #col2, #col3").remove();
                row = 3;
            }
            var anoing = "<?php echo isset($_SESSION['ANOING']) ? $_SESSION['ANOING'] : ''; ?>";
            var numemp = "<?php echo isset($_SESSION['NUMEMP']) ? $_SESSION['NUMEMP'] : ''; ?>";
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
            if (document.getElementById('2FechasDocs')) {
                if ($("#2FechasDocs").val() != '') {
                    var fecha = $("#2FechasDocs").val();
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
            var idNomdoc = "2" + tipo + (inputsLength - 1);
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
            var baseUrl = "/API.LovablePHP/ZLO0016P/ListAsync/";
            var queryParams = [];
            queryParams.push("user=" + user);
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
                    if (campos[key] != "undefined") {
                        if (nomdoc != campos[key]) {
                            queryParams.push(key + "=" + campos[key]);
                        }
                    }
                }
            }
            var urlList = baseUrl + "?" + queryParams.join("&");
            var response = ajaxRequest(urlList);
            const body = $("#myTableBody");
            if (response.code == 200) {
                // $("#cbbDepartamentos").val(response.data[0]['CODDEP'] + '-' + response.data[0]['CODSEC']);
                let tr;
                let limit = Math.min(response.data.length, 100);
                //let limit=response.data.length;
                //$("#numDocumentos").text(limit);
                var dataTable = $("#myTableInvDesc").DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                    },
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": urlList,
                        "type": "POST",
                        "dataSrc": function (json) {
                            var newData = [];
                            var columna1 = [];
                            var columna2 = [];
                            var columna3 = [];
                            var columna4 = [];
                            var data = json.data;
                            for (let i = 0; i < data.length; i++) {
                                switch (data[i]['COLUMNA']) {
                                    case 1:
                                        columna1.push(data[i]);
                                        break;
                                    case 2:
                                        columna2.push(data[i]);
                                        break;
                                    case 3:
                                        columna3.push(data[i]);
                                        break;
                                    case 4:
                                        columna4.push(data[i]);
                                        break;
                                    default:
                                        break;
                                }

                            }
                            (columna1.length > 0) ? newData[0] = columna1 : '';
                            (columna2.length > 0) ? newData[1] = columna2 : '';
                            (columna3.length > 0) ? newData[2] = columna3 : '';
                            (columna4.length > 0) ? newData[3] = columna4 : '';
                            return newData;
                        },
                        "complete": function (xhr) {
                            if (xhr.status == 200) {
                                $("#numDocumentos").text(xhr.responseJSON.data[0]['TOTALROWS']);
                                $("#myTableInvDesc").removeClass('mt-5');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.log(error);
                            requestError = true;
                        }
                    },
                    "columns": [{
                        "data": null,
                        "render": function (data, type, row) {
                            return renderCards(data[0]);
                        }
                    },
                    {
                        "data": null,
                        "render": function (data, type, row) {
                            return renderCards(data[1]);
                        }
                    },
                    {
                        "data": null,
                        "render": function (data, type, row) {
                            return renderCards(data[2]);
                        }
                    },
                    {
                        "data": null,
                        "render": function (data, type, row) {
                            return renderCards(data[3]);
                        }
                    },
                    ],
                    searching: false,
                    paging: true,
                    processing: true,
                    ordering: false,
                    pageLength: 4,
                    bInfo: false,
                    lengthChange: false
                });
            } else {
                body.append('<tr><td class="text-center p-3 fs-5" colspan="100%">No se encontraron documentos</td></tr>')
            }
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
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
            var tipo = $("#tipDocs2").val();
            for (let i = 0; i < camposDes.length; i++) {
                if (camposDes[i].toLowerCase() == "tienda") {
                    var tienda = $("#2codigoTienda").val().padStart(2, '0');
                    if (tienda != '00') {
                        campos["CAM" + i] = tienda;
                    }
                } else if (camposDes[i].toLowerCase() == "compañia") {
                    var cia = $("#2codigoCompania").val().padStart(2, '0');
                    if (cia != '00') {
                        campos["CAM" + i] = cia;
                    }

                } else if (camposDes[i].toLowerCase() == "proveedor") {
                    campos["CAM" + i] = codigo;
                } else {
                    campos["CAM" + i] = $("#2" + tipo + i + "").val();
                }
            }
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

        function selectDoc(card, nomcard, usugra, fecgra, horgra, extdoc, urldoc, tipdoc, descrp, fecha, cam0, cam1, cam2, cam3, cam4, cam5, cam6, cam7, cam8, cam9, coddep, codsec, apr, modulo) {
            const counter = documentosSeleccionados.length;
            const checkbox = card.querySelector('.form-check-input');

            if (counter === 0) {
                const isBgLightAdded = card.classList.toggle('bg-light');

                if (isBgLightAdded) {
                    checkbox.checked = true;
                    const documento = {
                        "nomcard": nomcard,
                        "tipdoc": tipdoc,
                        "urldoc": urldoc,
                        "cam1": cam0,
                        "cam2": cam1,
                        "cam3": cam2,
                        "cam4": cam3,
                        "cam5": cam4,
                        "cam6": cam5,
                        "cam7": cam6,
                        "cam8": cam7,
                        "cam9": cam8,
                        "cam10": cam9,
                    };
                    documentosSeleccionados.push(documento);
                    $("#lblSelect").text('Haz seleccionado 1 documento');
                    $("#divSelect").removeClass('d-none');
                } else {
                    checkbox.checked = false;
                }
            } else {
                if (
                    documentosSeleccionados[0].nomcard === nomcard &&
                    documentosSeleccionados[0].tipdoc === tipdoc &&
                    documentosSeleccionados[0].urldoc === urldoc &&
                    documentosSeleccionados[0].cam1 === cam0 &&
                    documentosSeleccionados[0].cam2 === cam1 &&
                    documentosSeleccionados[0].cam3 === cam2 &&
                    documentosSeleccionados[0].cam4 === cam3 &&
                    documentosSeleccionados[0].cam5 === cam4 &&
                    documentosSeleccionados[0].cam6 === cam5 &&
                    documentosSeleccionados[0].cam7 === cam6 &&
                    documentosSeleccionados[0].cam8 === cam7 &&
                    documentosSeleccionados[0].cam9 === cam8 &&
                    documentosSeleccionados[0].cam10 === cam9
                ) {
                    checkbox.checked = false;
                    documentosSeleccionados.length = 0;
                    card.classList.remove('bg-light');
                    $("#lblSelect").text('**Haga clic para seleccionar o doble clic para ver los detalles**');
                    $("#divSelect").addClass('d-none');
                }

            }
        }
        function saveDocRel() {

            if(codsec!=0 && coddep!=0){
            var fecgra = currentDate();
            var horgra = currentTime();
            var fileExtension = documentosSeleccionados[0].nomcard.split('.')[1];
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
            const inputs = $(".inputsDoc");
            var tipo = $("#tipDocs").val();
            var length = inputs.length;
            for (let i = 0; i < length; i++) {
                if ($("#lbl" + i).text().toLowerCase().includes("proveedor:")) {
                    campos["CAM" + i] = codigo;
                } else {
                    campos["CAM" + i] = $("#" + tipo + i + "").val();
                }
            }

            var nameFile = documentosSeleccionados[0].nomcard;
            var fecha = $("#fechaDoc").val();
            var descrip = $("#descrpDoc").val();
            var dataSave = {
                "NOMDOC": nameFile,
                "EXTDOC": fileExtension,
                "ANOING": anoing,
                "NUMEMP": numemp,
                "CODSEC": codsec,
                "CODDEP": coddep,
                "USUGRA": codusu,
                "FECGRA": fecgra,
                "HORGRA": horgra,
                "ARCHIVO": documentosSeleccionados[0].urldoc,
                "TIPDOC": tipo,
                "DESCRP": descrip,
                "FECHA": fecha.replace(/-/g, ''),
                "CAM1": campos['CAM0'],
                "CAM2": campos['CAM1'],
                "CAM3": campos['CAM2'],
                "CAM4": campos['CAM3'],
                "CAM5": campos['CAM4'],
                "CAM6": campos['CAM5'],
                "CAM7": campos['CAM6'],
                "CAM8": campos['CAM7'],
                "CAM9": campos['CAM8'],
                "CAM10": campos['CAM9']
            };
            var urlSave =
                "/API.LovablePHP/ZLO0015P/SaveDocument/";
            var responseSave = ajaxRequest(urlSave, dataSave, "POST");
            if (responseSave.code == 200) {
                Swal.fire(
                    'Realizado',
                    'Archivos subidos correctamente.',
                    'success'
                ).then((result) => {
                    if (result.isConfirmed) {
                       location.href = 'http://172.16.15.20/LovablePHP/PRG/ZDD/ZLO0015P2.php';
                    }
                }
                )
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Ha ocurrido un error.',
                    text: 'Porfavor notifiquelo al administrador del sistema.',
                });
            }
           }else{
                var urlDepas = "/API.LOVABLEPHP/ZLO0015P/ListDepas/";
                var responseDepas = ajaxRequest(urlDepas);
                if (responseDepas.code == 200) {
                    const departamentos = $("#cbbDepartamentos2");
                    departamentos.empty();
                    departamentos.append(`<option value="0"> </option>`);
                    for (let i = 0; i < responseDepas.data.length; i++) {
                        departamentos.append(`<option value="` + responseDepas.data[i].SECDEP + `-` + responseDepas.data[i]
                            .SECCOD + `">` + responseDepas.data[i].SECDES + `</option>`);
                    }
                    $("#cbbDepartamentos2").flexselect();
                }
                $("#departModal").modal('show');
           }
        }
        var contador = 1;
        function renderCards(data) {
            if (data) {
                var extension = data['EXTDOC'];
                switch (extension) {
                    case 'png':
                    case 'jpg':
                    case 'jpeg':
                        return `<div class="card" id="card` + contador + `" ondblclick="showCard('` + data['NOMDOC'] + `','` +
                            data['USUGRA'] + `','` + data['FECGRA'] + `','` + data['HORGRA'] + `','` + data['EXTDOC'] +
                            `','` + data[
                            'URLDOC'
                            ] + `','` + data['TIPDOC'] + `','` + data['DESCRP'] + `','` +
                            data['FECHA'] + `','` + data['CAM1'] + `','` + data[
                            'CAM2'
                            ] + `','` + data['CAM3'] + `','` + data['CAM4'] + `','` +
                            data['CAM5'] + `','` + data['CAM6'] + `','` + data[
                            'CAM7'
                            ] + `','` + data['CAM8'] + `','` + data['CAM9'] + `','` +
                            data['CAM10'] + `','` + data['CODDEP'] + `','` + data['CODSEC'] + `','` + data['APR'] + `','` + data['MODULO'] + `')">
                                        <div class="card-body text-center">
                                            <img src="` + data['URLDOC'] +
                            `"
                                                style="height:50px;" alt="">
                                            <h6 class=" responsive-font-example mt-1" style="font-size:12px;" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="` +
                            data['NOMDOC'] + `">` +
                            truncarTexto(data['NOMDOC'].split('.').slice(0, -1).join('.')) + `</h6>
                                        </div>
                                    </div>`;
                        break;
                    case 'xlsx':
                        return `
                                    <div class="card" id="card` + contador + `" ondblclick="showCard('` + data['NOMDOC'] +
                            `','` +
                            data['USUGRA'] + `','` + data['FECGRA'] + `','` + data['HORGRA'] + `','` + data['EXTDOC'] +
                            `','` + data[
                            'URLDOC'
                            ] + `','` + data['TIPDOC'] + `','` + data['DESCRP'] + `','` +
                            data['FECHA'] + `','` + data['CAM1'] + `','` + data[
                            'CAM2'
                            ] + `','` + data['CAM3'] + `','` + data['CAM4'] + `','` +
                            data['CAM5'] + `','` + data['CAM6'] + `','` + data[
                            'CAM7'
                            ] + `','` + data['CAM8'] + `','` + data['CAM9'] + `','` +
                            data['CAM10'] + `','` + data['CODDEP'] + `','` + data['CODSEC'] +
                            `','` + data['APR'] + `','` + data['MODULO'] + `')">
                                        <div class="card-body text-center">
                                            <img src="../../assets/img/icons/excel.png"
                                                width="50" alt="">
                                            <h6 class=" responsive-font-example mt-1" style="font-size:12px;" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="` +
                            data['NOMDOC'] + `">` + truncarTexto(data['NOMDOC']
                                .split('.').slice(0, -1).join('.')) + `</h6>
                                        </div>
                                    </div>`;
                        break;
                    case 'docx':
                        return `
                                    <div class="card" id="card` + contador + `" ondblclick="showCard('` + data['NOMDOC'] +
                            `','` +
                            data['USUGRA'] + `','` + data['FECGRA'] + `','` + data['HORGRA'] + `','` + data['EXTDOC'] +
                            `','` + data[
                            'URLDOC'
                            ] + `','` + data['TIPDOC'] + `','` + data['DESCRP'] + `','` +
                            data['FECHA'] + `','` + data['CAM1'] + `','` + data[
                            'CAM2'
                            ] + `','` + data['CAM3'] + `','` + data['CAM4'] + `','` +
                            data['CAM5'] + `','` + data['CAM6'] + `','` + data[
                            'CAM7'
                            ] + `','` + data['CAM8'] + `','` + data['CAM9'] + `','` +
                            data['CAM10'] + `','` + data['CODDEP'] + `','` + data['CODSEC'] +
                            `','` + data['APR'] + `','` + data['MODULO'] + `')">
                                        <div class="card-body text-center">
                                            <img src="../../assets/img/icons/word.png"
                                                width="50" alt="">
                                            <h6 class=" responsive-font-example mt-1" style="font-size:12px;" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="` +
                            data['NOMDOC'] + `">` + truncarTexto(data['NOMDOC']
                                .split('.').slice(0, -1).join('.')) + `</h6>
                                        </div>
                                    </div>`;
                        break;
                    case 'pdf':
                        return `
                                    <div class="card" id="card` + contador + `" onclick="selectDoc(this,'` + data['NOMDOC'] +
                            `','` +
                            data['USUGRA'] + `','` + data['FECGRA'] + `','` + data['HORGRA'] + `','` + data['EXTDOC'] +
                            `','` + data[
                            'URLDOC'
                            ] + `','` + data['TIPDOC'] + `','` + data['DESCRP'] + `','` +
                            data['FECHA'] + `','` + data['CAM1'] + `','` + data[
                            'CAM2'
                            ] + `','` + data['CAM3'] + `','` + data['CAM4'] + `','` +
                            data['CAM5'] + `','` + data['CAM6'] + `','` + data[
                            'CAM7'
                            ] + `','` + data['CAM8'] + `','` + data['CAM9'] + `','` +
                            data['CAM10'] + `','` + data['CODDEP'] + `','` + data['CODSEC'] +
                            `','` + data['APR'] + `','` + data['MODULO'] + `')" ondblclick="showCard('` + data['NOMDOC'] +
                            `','` +
                            data['USUGRA'] + `','` + data['FECGRA'] + `','` + data['HORGRA'] + `','` + data['EXTDOC'] +
                            `','` + data[
                            'URLDOC'
                            ] + `','` + data['TIPDOC'] + `','` + data['DESCRP'] + `','` +
                            data['FECHA'] + `','` + data['CAM1'] + `','` + data[
                            'CAM2'
                            ] + `','` + data['CAM3'] + `','` + data['CAM4'] + `','` +
                            data['CAM5'] + `','` + data['CAM6'] + `','` + data[
                            'CAM7'
                            ] + `','` + data['CAM8'] + `','` + data['CAM9'] + `','` +
                            data['CAM10'] + `','` + data['CODDEP'] + `','` + data['CODSEC'] +
                            `','` + data['APR'] + `','` + data['MODULO'] + `')">
                                        <div class="card-body text-center">
                                            <div class="row">
                                            <div class="col-10"></div>
                                            <div class="col-2">
                                            <input class="form-check-input fs-5" disabled type="checkbox" value="" id="flexCheckDefault">
                                            </div>
                                            <div class="col-12">
                                            <img src="../../assets/img/icons/pdf.png"
                                                width="50" alt="">
                                                            <h6 class=" responsive-font-example mt-1" style="font-size:12px;" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="` +
                            data['NOMDOC'] + `">` + truncarTexto(data['NOMDOC'].split('.')
                                .slice(0, -1).join('.')) + `</h6>
                                            </div>
                                            </div>

                                        </div>
                                    </div>`;
                        break;
                    case 'txt':
                        return `
                                    <div class="card" id="card` + contador + `" ondblclick="showCard('` + data['NOMDOC'] +
                            `','` +
                            data['USUGRA'] + `','` + data['FECGRA'] + `','` + data['HORGRA'] + `','` + data['EXTDOC'] +
                            `','` + data[
                            'URLDOC'
                            ] + `','` + data['TIPDOC'] + `','` + data['DESCRP'] + `','` +
                            data['FECHA'] + `','` + data['CAM1'] + `','` + data[
                            'CAM2'
                            ] + `','` + data['CAM3'] + `','` + data['CAM4'] + `','` +
                            data['CAM5'] + `','` + data['CAM6'] + `','` + data[
                            'CAM7'
                            ] + `','` + data['CAM8'] + `','` + data['CAM9'] + `','` +
                            data['CAM10'] + `','` + data['CODDEP'] + `','` + data['CODSEC'] +
                            `','` + data['APR'] + `','` + data['MODULO'] + `')">
                                        <div class="card-body text-center">
                                            <img src="../../assets/img/icons/txt.png"
                                                width="50" alt="">
                                            <h6 class=" responsive-font-example mt-1" style="font-size:12px;" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="` +
                            data['NOMDOC'] + `">` + truncarTexto(data['NOMDOC']
                                .split('.').slice(0, -1).join('.')) + `</h6>
                                        </div>
                                    </div>`;
                        break;
                    case 'ppx':
                        return `
                                    <div class="card" id="card` + contador + `" ondblclick="showCard('` + data['NOMDOC'] +
                            `','` +
                            data['USUGRA'] + `','` + data['FECGRA'] + `','` + data['HORGRA'] + `','` + data['EXTDOC'] +
                            `','` + data[
                            'URLDOC'
                            ] + `','` + data['TIPDOC'] + `','` + data['DESCRP'] + `','` +
                            data['FECHA'] + `','` + data['CAM1'] + `','` + data[
                            'CAM2'
                            ] + `','` + data['CAM3'] + `','` + data['CAM4'] + `','` +
                            data['CAM5'] + `','` + data['CAM6'] + `','` + data[
                            'CAM7'
                            ] + `','` + data['CAM8'] + `','` + data['CAM9'] + `','` +
                            data['CAM10'] + `','` + data['CODDEP'] + `','` + data['CODSEC'] +
                            `','` + data['APR'] + `','` + data['MODULO'] + `')">
                                        <div class="card-body text-center">
                                            <img src="../../assets/img/icons/pp.png"
                                                width="50" alt="">
                                            <h6 class=" responsive-font-example mt-1" style="font-size:12px;" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="` +
                            data['NOMDOC'] + `">` + truncarTexto(data['NOMDOC']
                                .split('.').slice(0, -1).join('.')) + `</h6>
                                        </div>
                                    </div>`;
                        break;
                    case 'zip':
                    case 'rar':
                        return `
                                    <div class="card" id="card` + contador + `" ondblclick="showCard('` + data['NOMDOC'] +
                            `','` +
                            data['USUGRA'] + `','` + data['FECGRA'] + `','` + data['HORGRA'] + `','` + data['EXTDOC'] +
                            `','` + data[
                            'URLDOC'
                            ] + `','` + data['TIPDOC'] + `','` + data['DESCRP'] + `','` +
                            data['FECHA'] + `','` + data['CAM1'] + `','` + data[
                            'CAM2'
                            ] + `','` + data['CAM3'] + `','` + data['CAM4'] + `','` +
                            data['CAM5'] + `','` + data['CAM6'] + `','` + data[
                            'CAM7'
                            ] + `','` + data['CAM8'] + `','` + data['CAM9'] + `','` +
                            data['CAM10'] + `','` + data['CODDEP'] + `','` + data['CODSEC'] +
                            `','` + data['APR'] + `','` + data['MODULO'] + `')">
                                        <div class="card-body text-center">
                                            <img src="../../assets/img/icons/folder.png"
                                                width="50" alt="">
                                            <h6 class=" responsive-font-example mt-1" style="font-size:12px;" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="` +
                            data['NOMDOC'] + `">` + truncarTexto(data['NOMDOC']
                                .split('.').slice(0, -1).join('.')) + `</h6>
                                        </div>
                                    </div>`;
                        break;
                    default:
                        return `<div class="card" id="card` + contador + `" ondblclick="showCard('` + data['NOMDOC'] + `','` +
                            data['USUGRA'] + `','` + data['FECGRA'] + `','` + data['HORGRA'] + `','` + data['EXTDOC'] +
                            `','` + data[
                            'URLDOC'
                            ] + `','` + data['TIPDOC'] + `','` + data['DESCRP'] + `','` +
                            data['FECHA'] + `','` + data['CAM1'] + `','` + data[
                            'CAM2'
                            ] + `','` + data['CAM3'] + `','` + data['CAM4'] + `','` +
                            data['CAM5'] + `','` + data['CAM6'] + `','` + data[
                            'CAM7'
                            ] + `','` + data['CAM8'] + `','` + data['CAM9'] + `','` +
                            data['CAM10'] + `','` + data['CODDEP'] + `','` + data['CODSEC'] +
                            `','` + data['APR'] + `','` + data['MODULO'] + `')">
                                        <div class="card-body text-center">
                                            <img src="../../assets/img/icons/file.png"
                                                width="50" alt="">
                                            <h6 class="responsive-font-example mt-1" style="font-size:12px;" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="` +
                            data['NOMDOC'] + `">` + truncarTexto(data['NOMDOC']
                                .split('.').slice(0, -1).join('.')) + `</h6>
                                        </div>
                                    </div>`;
                        break;
                }
            } else {
                return '';
            }
            contador++;
        }
        function showCard(nomcard, usugra, fecgra, horgra, extdoc, urldoc, tipdoc, descrp, fecha, cam0, cam1, cam2, cam3, cam4, cam5, cam6, cam7, cam8, cam9, coddep, codsec, apr, modulo) {
            findCons1(nomcard, usugra, fecgra, horgra, extdoc, urldoc, tipdoc, descrp, fecha, cam0, cam1, cam2, cam3, cam4, cam5, cam6, cam7, cam8, cam9, coddep, codsec, apr)
            $("#docInfo").modal('show');
        }
        function findCons1(nomcard, usugra, fecgra, horgra, extdoc, urldoc, tipdoc, descrp, fecha, cam0, cam1, cam2, cam3, cam4, cam5, cam6, cam7, cam8, cam9, coddep, codsec, apr) {

            $("#downloadFrame").empty();
            switch (extdoc) {
                case 'png':
                case 'jpg':
                case 'jpeg':
                    $("#downloadFrame").append('<img src="' + urldoc +
                        '"  style="width:200px;" alt="">');
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
            if (extdoc == 'pdf' || extdoc == 'png' || extdoc == 'jpg' || extdoc == 'jpeg') {
                $("#downloadCard").append(
                    `
            <div class="row m-3">
                <div class="col-6">
                <a class="btn btn-warning fw-bold text-white" style="width:100%;" target="_blank" href="` +
                    urldoc + `" >Visualizar documento <i class="fa-solid fa-eye"></i></a>

                </div>
                <div class="col-6">
                    <a class="btn btn-info fw-bold text-white" style="width:100%;" href="` +
                    urldoc + `" download>Descargar <i class="fa-solid fa-download"></i></a>
                </div>
            </div>
            `);
            } else {
                $("#downloadCard").append(
                    `
                <div class="col-12">
                    <a class="btn btn-info fw-bold text-white" style="width:100%;" href="` +
                    urldoc + `" download>Descargar <i class="fa-solid fa-download"></i></a>
                </div>
            </div>
            `);
            }
            $("#trashDoc").empty();
            $("#AuthDoc").empty();
            let titleDoc = apr === 'A' ? `${nomcard}<span class="badge text-bg-success text-white ms-4">Aprobado</span>` : nomcard;
            $("#titleDoc").html(titleDoc);

            var selectElement = document.getElementById('tiposDoc');
            var optionText = Array.from(selectElement.options).find(option => option.value === tipdoc);
            var textoSelect = "";
            if (optionText) {
                textoSelect = optionText.textContent || optionText.innerText;
            }
            $("#tipDoc").text(textoSelect);
            $("#fechaDoc2").text(formatFecha(fecha));
            if (descrp == 'S-N') {
                descrp = '';
            }
            $("#descrpDoc").text(descrp);
            var depaUrl = "/API.LovablePHP/ZLO0016P/GetDepa/?coddep=" + coddep + "&secdep=" + codsec +
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
            var urlCampos = "/API.LovablePHP/ZLO0015P/ListTiposFind/?tipo=" + tipdoc;
            var responseCampos = ajaxRequest(urlCampos);
            if (responseCampos.code == 200) {

                const inputs = $("#extraInfo");
                inputs.empty();
                camposDes = responseCampos.data[0].CAMPOS.split("/");
                var cont = 0;
                var length = camposDes.length;
                for (let i = 0; i < length; i++) {
                    var descripcion = "";
                    if (camposDes[i].toLowerCase() == "tienda" || camposDes[i].toLowerCase() == "compañia") {
                        var urlDes = "/API.LovablePHP/ZLO0001P/FindComarc/?compFiltro=" + campos[
                            'cam' + i] + "";
                        var responseDes = ajaxRequest(urlDes);
                        descripcion = (responseDes.code == 200) ? responseDes.data[0]['COMDES'] : "";
                    } else if (camposDes[i].toLowerCase() == "proveedor") {
                        var id = campos['cam' + i].split("-");
                        var tipo = id[0];
                        var prov = id[1];
                        var urlFind = "/API.LovablePHP/ZLO0015P/ProveedoresFind/?tipo=" + tipo +
                            "&proveedor=" + prov + "";
                        var responseFind = ajaxRequest(urlFind);
                        descripcion = (responseFind.code == 200) ? responseFind.data[0]['ARCNOM'] : "";
                    } else if (camposDes[i].toLowerCase() == "numero doc. fiscal") {

                        if (campos['cam' + i] == '99999999999999999999') {
                            campos['cam' + i] = '';
                        }
                    }

                    inputs.append(`<div class="col-6 col-lg-2 mt-2">
                                <h6 class=" mt-1">` + camposDes[i] + `:</h6></div>
                                <div class="col-6 col-lg-4 mt-2">
                                <label class="text-start form-control">` + campos['cam' + i] + ` ` + descripcion
                            .toUpperCase() + `</label>
                                </div>`);
                }
            }


        }
        function truncarTexto(texto) {
            if (texto.length <= 11) {
                return texto;
            }
            return texto;
            //return texto.substring(0, 11) + "...";
        }
        function currentTime() {
            const fecha = new Date();
            const horas = fecha.getHours().toString().padStart(2, "0");
            const minutos = fecha.getMinutes().toString().padStart(2, "0");
            const segundos = fecha.getSeconds().toString().padStart(2, "0");
            const horaActual = horas + minutos + segundos;
            return horaActual;
        }
        function currentDate() {
            const fecha = new Date();
            const año = fecha.getFullYear();
            const mes = (fecha.getMonth() + 1).toString().padStart(2, "0");
            const dia = fecha.getDate().toString().padStart(2, "0");
            const fechaActual = año.toString() + mes + dia;
            return fechaActual;
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

        var Date1;
        var Date2;

        function showTiendas(id) {
            $("#inputIdTiendas").val(id);
            $("#modalTiendas").modal('show');
        }

        function showCompanias(id) {
            $("#inputIdCompania").val(id);
            $("#modalCompania").modal('show');
        }

        function saveCompania() {
            var id = $("#inputIdCompania").val();
            $("#codigoCompania").val($("#CompaniaSelect").val());
            $("#" + id).val($("#CompaniaSelect option:selected").text());
            $("#originalCompania").val($("#CompaniaSelect option:selected").text());
            $("#modalCompania").modal('hide');
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
            var fechasActual = $("#2FechasDocs").val();
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
            $("#2FechasDocs").val(rangeDocumento);
            $("#FechasGrabs").val(rangeGrabado);
            $("#lblRange").text("Fecha de documento");
            $("#valueTipo").val(1);
            $("#modalRangeDocumento").modal('hide');
            $("#modalRangeGrabado").modal('hide');
        }

        function vaciarInput() {
            var idInput = $("#provId").val();
            $('#' + idInput + '').val('');
            codigo = '';
        }

        function vaciarInput2() {
            $('#originalRangeDocumento').val('');
            $('#valueTipo').val('');
            $('#2FechasDocs').val('');
            $('#datepicker2').val('');
        }

        function vaciarInput3() {
            var id = $("#inputIdTiendas").val();
            $('#originalTienda').val('');
            $('#codigoTienda').val('');
            $('#' + id).val('');
        }

        function vaciarInput5() {
            var id = $("#inputIdCompania").val();
            $('#originalCompania').val('');
            $('#codigoCompania').val('');
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

        function sendProveedor(row) {
            var tr = $(row).closest('tr');
            var tds = tr.find('td');
            var tipo = tds.eq(0).text();
            var id = tds.eq(1).text();
            var desc = tds.eq(2).text();
            codigo = tipo + '-' + id;
            var idInput = $("#provId").val();
            $("#" + idInput + "").val(tipo + ' ' + id + ' ' + desc);
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

        function noTextInput5(inputElement) {
            var originalData2 = $("#originalCompania").val();
            inputElement.value = originalData2;
        }

        function noTextInput2(inputElement) {
            var originalData2 = $("#originalRangeGrabado").val();
            inputElement.value = originalData2;
        }

    </script>
    <script type="module">
        /**
         * Este archivo contiene el código para subir documentos utilizando la biblioteca Uppy.js.
         *
         * @package LovablePHP
         * @subpackage PRG/ZDD
         */

        import {
            Uppy,
            Dashboard
        } from "../../assets/vendors/uppyjs/uppy.min.js"

        const uppy = new Uppy()

        /**
         * Configura el panel de control de Uppy y define el elemento HTML de destino.
         *
         * @param {string} target - El selector CSS del elemento HTML de destino.
         * @param {boolean} inline - Indica si el panel de control debe mostrarse en línea o en un modal.
         */
        uppy.use(Dashboard, {
            target: '#uppy',
            inline: true
        })

        /**
         * Maneja el evento 'complete' de Uppy cuando se han subido los archivos.
         *
         * @param {object} result - El objeto que contiene los archivos subidos.
         */
        function handleComplete(result) {
            // Verifica si se han seleccionado valores válidos para numemp, anoing, codsec y coddep
            if ((numemp != 0 && anoing != 0) || (codsec != 0 && coddep != 0)) {
                var fecgra = currentDate();
                var horgra = currentTime();
                var codeResponse = 0;
                var promises = [];
                result.successful.forEach(file => {
                    var promise = new Promise((resolve, reject) => {
                        blobToBase64(file.data, (base64) => {
                            var fileExtension = file.name.split('.').pop();
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
                            const inputs = $(".inputsDoc");
                            var tipo = $("#tipDocs").val();
                            var length = inputs.length;
                            for (let i = 0; i < length; i++) {
                                if ($("#lbl" + i).text().toLowerCase().includes("proveedor:")) {
                                    campos["CAM" + i] = codigo;
                                } else {
                                    campos["CAM" + i] = $("#" + tipo + i + "").val();
                                }
                            }

                            var nameFile = file.name;
                            nameFile = nameFile.normalize('NFD').replace(/[\u0300-\u036f]/g, "");
                            var fecha = $("#fechaDoc").val();
                            var descrip = $("#descrpDoc").val();
                            var dataSave = {
                                "NOMDOC": nameFile,
                                "EXTDOC": fileExtension,
                                "ANOING": anoing,
                                "NUMEMP": numemp,
                                "CODSEC": codsec,
                                "CODDEP": coddep,
                                "USUGRA": codusu,
                                "FECGRA": fecgra,
                                "HORGRA": horgra,
                                "ARCHIVO": base64,
                                "TIPDOC": tipo,
                                "DESCRP": descrip,
                                "FECHA": fecha.replace(/-/g, ''),
                                "CAM1": campos['CAM0'],
                                "CAM2": campos['CAM1'],
                                "CAM3": campos['CAM2'],
                                "CAM4": campos['CAM3'],
                                "CAM5": campos['CAM4'],
                                "CAM6": campos['CAM5'],
                                "CAM7": campos['CAM6'],
                                "CAM8": campos['CAM7'],
                                "CAM9": campos['CAM8'],
                                "CAM10": campos['CAM9']
                            };
                            var urlSave =
                                "/API.LovablePHP/ZLO0015P/SaveDocument/";
                            var responseSave = ajaxRequest(urlSave, dataSave, "POST");
                            if (responseSave.code == 200) {
                                resolve(responseSave.code);
                            } else {
                                reject(responseSave.code);
                            }
                            resolve(200);
                        });
                    });
                    promises.push(promise);
                });
                Promise.all(promises)
                    .then((responses) => {
                        Swal.fire(
                            'Realizado',
                            'Archivos subidos correctamente.',
                            'success'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                uppy.cancelAll();
                                $("#tiposDoc").val(1).trigger('change');
                                $("#descrpDoc").val("").trigger('change');
                                var isOut =
                                    '<?php echo isset($_SESSION['VALIDATE']) ? $_SESSION['VALIDATE'] : "0"; ?>';
                                if (isOut == '1') {
                                    var usuario = '<?php echo $_SESSION['CODUSU']; ?>';
                                    var urlDelete =
                                        '/API.LovablePHP/ZLO0015P/DelUsuario/?user=' +
                                        usuario + '';
                                    var responseDel = ajaxRequest(urlDelete);
                                    var inactivarUrl =
                                        "/API.LovablePHP/ZLO0015P/Inactivar2296/?cod=" +
                                        cor + "";
                                    var responseParams = ajaxRequest(inactivarUrl);
                                }
                            }
                        });
                    })
                    .catch((errorCode) => {
                        console.log(errorCode);
                        Swal.fire({
                            icon: 'error',
                            title: 'Ha ocurrido un error.',
                            text: 'Porfavor notifiquelo al administrador del sistema.',
                        });
                    });
            } else {
                var urlDepas = "/API.LOVABLEPHP/ZLO0015P/ListDepas/";
                var responseDepas = ajaxRequest(urlDepas);
                if (responseDepas.code == 200) {
                    const departamentos = $("#cbbDepartamentos2");
                    departamentos.empty();
                    departamentos.append(`<option value="0"> </option>`);
                    for (let i = 0; i < responseDepas.data.length; i++) {
                        departamentos.append(`<option value="` + responseDepas.data[i].SECDEP + `-` + responseDepas.data[i]
                            .SECCOD + `">` + responseDepas.data[i].SECDES + `</option>`);
                    }
                    $("#cbbDepartamentos2").flexselect();
                }
                $("#departModal").modal('show');
            }
        }

        /**
         * Cierra la ventana actual.
         *
         * @returns {boolean} - Devuelve false para evitar que la ventana se cierre.
         */
        function closeWindow() {
            let new_window =
                open(location, '_self');
            new_window.close();
            return false;
        }

        /**
         * Convierte un objeto Blob a una cadena base64.
         *
         * @param {Blob} blob - El objeto Blob a convertir.
         * @param {function} callback - La función de devolución de llamada que se ejecuta después de la conversión.
         */
        function blobToBase64(blob, callback) {
            const reader = new FileReader();
            reader.onload = function () {
                const dataUrl = reader.result;
                const base64String = dataUrl.split(',')[1];
                callback(base64String);
            };
            reader.readAsDataURL(blob);
        }

        /**
         * Devuelve la hora actual en formato HHMMSS.
         *
         * @returns {string} - La hora actual en formato HHMMSS.
         */
        function currentTime() {
            const fecha = new Date();
            const horas = fecha.getHours().toString().padStart(2, "0");
            const minutos = fecha.getMinutes().toString().padStart(2, "0");
            const segundos = fecha.getSeconds().toString().padStart(2, "0");
            const horaActual = horas + minutos + segundos;
            return horaActual;
        }

        /**
         * Devuelve la fecha actual en formato AAAAMMDD.
         *
         * @returns {string} - La fecha actual en formato AAAAMMDD.
         */
        function currentDate() {
            const fecha = new Date();
            const año = fecha.getFullYear();
            const mes = (fecha.getMonth() + 1).toString().padStart(2, "0");
            const dia = fecha.getDate().toString().padStart(2, "0");
            const fechaActual = año.toString() + mes + dia;
            return fechaActual;
        }

        uppy.on('complete', handleComplete);

        /**
         * Actualiza el reloj en la página mostrando la hora actual.
         */
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const timeString = `${hours}:${minutes}:${seconds}`;

            document.getElementById('horaDigit').innerText = timeString;
        }
        setInterval(updateClock, 1000);


    </script>
    <script src="../../assets/js/jquery.flexselect.js"></script>
    <script src="../../assets/js/liquidmetal.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="modal fade" id="departModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" onclick="$('#departModal').modal('hide')"></button>
                </div>
                <div class="modal-body">
                    <h6 class="mb-3 mt-4 text-start">Departamento</h6>
                    <select id="cbbDepartamentos2" class="form-select" data-placeholder="Selecciona una departamento">
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="selectDepa()">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalProveedores" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
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
                            <div class="col-2 col-lg-1 p-0 text-end" id="trashDoc">

                            </div>
                        </div>
                        <div id="downloadCard">

                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h5 class="mt-2 mb-2" id="titleDoc"></h5>
                                </div>
                                <div class="col-12" id="AuthDoc">

                                </div>
                                <div id="AuthDiv" class="col-12 rounded mt-2 bg-success d-none">
                                    <div class="row p-2 text-center text-white">
                                        <div class="col-12">
                                            <h5 class="mt-2 mb-3 fw-bold">Documento autorizado</h5>
                                        </div>
                                        <div class="col-4">
                                            <label>Autorizado por:</label>
                                            <span id="userAuth"></span>
                                        </div>
                                        <div class="col-4">
                                            <label>Fecha:</label>
                                            <span id="fechaAuth"></span>
                                        </div>
                                        <div class="col-4">
                                            <label>Hora:</label>
                                            <span id="horaAuth"></span>
                                        </div>
                                    </div>
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
                                                    <label class="text-start form-control" id="fechaDoc2"></label>
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
        <div class="modal-dialog modal-lg">
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Selecciona una tienda</h1>

                    <button type="button" class="btn-close" onclick="$('#modalTiendas').modal('hide')"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <input type="text" class="d-none" id="inputIdTiendas">
                            <label class="mb-3">Tienda: </label>
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
    <div class="modal fade" id="modalCompania" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Selecciona una compañía</h1>

                    <button type="button" class="btn-close" onclick="$('#modalCompania').modal('hide')"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <input type="text" class="d-none" id="inputIdCompania">
                            <label class="mb-3">Compañía: </label>
                            <select id="CompaniaSelect" class="form-select">

                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="saveCompania()">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>