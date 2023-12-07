<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
    <link href="../../assets/vendors/uppyjs/uppy.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/flexselect.css">
    <link rel="stylesheet" href="../../assets/vendors/dayrangepicker/index.css">
</head>

<body>
    <?php include '../layout-prg.php';
     include '../../assets/php/ZDD/ZLO0018P/header.php';
    ?>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <span>Digitalización de documentos / Revisión</span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0018P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-1">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-6 col-lg-4" id="searchDiv">
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="fa fa-search"></i></span>
                            <label type="text" class="form-control" id="searchInput" onclick="showProveedores()">Buscar...</label>
                            <button type="button" class="search-btn-clear" onclick="vaciarInput()">
                                <i class="fa-solid fa-xmark search-icon-clear"></i>
                            </button>
                            <input class="d-none" id="originalData" /> <input class="d-none" id="codigo" />
                            <input class="d-none" id="originalValue" /> <input class="d-none" id="valueTipo" value="0" />
                            <button class="input-group-text btn btn-light border" onclick="showRange()" type="button">
                                <i class="fa-solid fa-calendar-day"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8 text-center">
                        <h1 class="fs-4 mb-1 mt-2">Revisión de solicitudes</h1>
                    </div>
                </div>
            </div>
            <div class="card-body card-index">
                <div class="row">
                    <div class="col-12 col-lg-3">
                        <div class="card overflow-auto maxbox">
                            <div class="card-header bg-light sticky-top">
                                <div class="text-end">
                                    <span class="fw-bold text-black" id="countRequest"></span> <i class="fa-solid fa-bell"></i>
                                </div>
                            </div>
                            <div class="card-body background-primary" style="height:100%;">
                                <div class="row" id="containerRequest">
                                </div>
                                <div class="position-absolute top-50 start-50 translate-middle d-none" id="NoRequest">
                                    <p class="text-secondary textInfo fs-6">No hay solicitudes</p>  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-9">
                        <div class="card ">
                            <div class="card-body m-0 p-0" id="containerVisual">
                            </div>
                            <div id="spinnerStart" class="spinner-background position-absolute">
                                    <div class="spinner-border text-danger position-absolute" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script src="../../assets/js/jquery.flexselect.js"></script>
    <script src="../../assets/js/liquidmetal.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../assets/vendors/dayrangepicker/index.umd.min.js"></script>
    <script>
    var codigo = "";
    var comarcOptions = "";
    var tiendasOptions = "";
    var camposDes = "";
    var inputs = "";
    var cor = "";
    var countInputs = "";
    var boolIsChange=0;
    var searchval=0; var proveedorval=0;
    $(document).ready(function() {

    $("#toggle-menu-btn").on('click', function() {
        $('#my-dropdown-menu').toggleClass('show');
    });

    $("#searchInput").on('click', function() {
        searchval=1;
        proveedorval=0;
    });

        chargeRequest();
        var urlComarc = 'http://172.16.15.20/API.LovablePHP/ZLO0015P/ListComarc/?user=' + 'MARVIN' + '';
        var responseComarc = ajaxRequest(urlComarc);
        if (responseComarc.code == 200) {
            for (let i = 0; i < responseComarc.data.length; i++) {
                comarcOptions += '<option value="' + responseComarc.data[i].COMCOD.padStart(2, '0') + '">' +
                    responseComarc.data[
                        i].COMDES + '</option>';
            }
        }
        var urlTiendas = 'http://172.16.15.20/API.LovablePHP/ZLO0015P/ListTiendas/?user=' + 'MARVIN' + '';
        var responseTiendas = ajaxRequest(urlTiendas);
        if (responseTiendas.code == 200) {
            for (let i = 0; i < responseTiendas.data.length; i++) {
                tiendasOptions += '<option value="' + responseTiendas.data[i].COMCOD.padStart(2, '0') + '">' +
                    responseTiendas.data[
                        i].COMDES + '</option>';
            }
        }
        $("#tiendasSelect").append(tiendasOptions);
        $("#CompaniaSelect").append(comarcOptions);
        $('#tbProveedores thead th').each(function() {
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
                "url": "http://172.16.15.20/API.LovablePHP/ZLO0015P/ListProveedoresAsync/",
                "type": "POST",
                "complete": function(xhr) {
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    requestError = true;
                }
            },
            "ordering": false,
            "dom": 'rtip',
            "columns": [{
                    "data": "ARCCIU",
                    render: function(data) {
                        return data.padStart(2, '0');
                    }
                },
                {
                    "data": "ARCCO1",
                    render: function(data) {
                        return data.padStart(4, '0');
                    }
                },
                {
                    "data": "ARCNOM"
                },
            ],
            "drawCallback": function() {
                $('#tbProveedores tbody tr').on('click', function() {
                   if (proveedorval==1 && searchval==0) {
                    sendProveedor(this);
                   }else{
                    sendProveedor2(this);
                   }
                    
                });
            }
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
    });

    function chargeRequest(){
        $("#spinnerStart").removeClass('d-none');
        if ($("#valueTipo").val()==1) {
        var prov= $("#codigo").val();
        var urlList="http://172.16.15.20/API.LovablePHP/ZLO0018P/List/?prov1="+prov+"";
        }else if($("#valueTipo").val()==2){ 
         var fechas=  $("#searchInput").text().split(" - ");
         var fecha1=formatFechaSent(fechas[0].replace(/\//g, ''));
         var fecha2=formatFechaSent(fechas[1].replace(/\//g, ''));
         var urlList="http://172.16.15.20/API.LovablePHP/ZLO0018P/List/?fech1="+fecha1+"&fech2="+fecha2+"";
        }else{
        var urlList="http://172.16.15.20/API.LovablePHP/ZLO0018P/List/";
        }
        var responseList=ajaxRequest(urlList);
        $("#countRequest").text('0');
        const containerRequest = $("#containerRequest");
        containerRequest.empty();
        if (responseList.code==200) {
            $("#countRequest").text(responseList.data.length);
            const data=responseList.data;
            for (let i = 0; i < data.length; i++) {
                $("#NoRequest").addClass('d-none');
                var urlFind = "http://172.16.15.20/API.LovablePHP/ZLO0015P/ProveedoresFind/?tipo=" +data[i]['PROVE1'] + "&proveedor=" + data[i]['PROVE2'] + "";
                var responseFind = ajaxRequest(urlFind);
                var descripcion = (responseFind.code == 200) ? responseFind.data[0]['ARCNOM'] : "";
                var urlCampos = "http://172.16.15.20/API.LovablePHP/ZLO0015P/ListTiposFind/?tipo=" + data[i]['TIPDOC'];
                var responseCampos = ajaxRequest(urlCampos);
                var desTipo="";
                if (responseCampos.code==200) {
                    desTipo=responseCampos.data[0]['DESCRP'];
                }
                containerRequest.append(`<a href="#"><div class="col-12 " onclick="showCard('card`+i+`','` + data[i]['NOMDOC'] + `','` +data[i]['USUGRA'] + `','` + data[i]['FECGRA'] + `','` + data[i]['HORGRA'] + `','` + data[i]['EXTDOC'] +`','` + data[i]['URLDOC'] + `','` + data[i]['TIPDOC'] + `','` + data[i]['DESCRP'] + `','` +data[i]['FECHA'] + `','` + data[i]['CAM1'] + `','` + data[i]['CAM2'] + `','` + data[i]['CAM3'] + `','` + data[i]['CAM4'] + `','` +data[i]['CAM5'] + `','` + data[i]['CAM6'] + `','` + data[i]['CAM7'] + `','` + data[i]['CAM8'] + `','` + data[i]['CAM9'] + `','` +data[i]['CAM10'] + `','` + data[i]['CODDEP'] + `','` + data[i]['CODSEC'] + `')">
                                    <div id="card`+i+`" class="card mt-2" style="height:140px;">
                                        <div class="card-header p-2 d-flex justify-content-between textInfo  fw-bold ">
                                            <div>
                                            ` + truncarEnca(descripcion)+ `
                                            </div>
                                            <div>
                                            ` + data[i]['PROVE1'].padStart(2, '0') + ` ` + data[i]['PROVE2'].padStart(4, '0') + `
                                            </div>
                                        </div>
                                        <div class="card-body m-0 p-0">
                                             <div class="row">
                                                    <div class="col-12 text-body-secondary">
                                                        <p class="m-2 text-secondary textInfo"> ` + truncarTexto(data[i]['NOMDOC']) + `</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer m-0 p-0 row">
                                                <div class="col-8">
                                                    <p class="mt-2 text-start text-secondary textDate">`+desTipo+`</p>
                                                </div>
                                                <div class="col-4">
                                                    <p class="mt-2 text-end text-secondary textDate"> ` + formatFecha(data[i]['FECGRA']) + ` ` + formatTime(data[i]['HORGRA']) + `</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div></a>`);
            }
        }else{
            $("#NoRequest").removeClass('d-none');
        }
        $("#containerVisual").empty();
        $("#containerVisual").append(` <div class="card overflow-auto maxbox">
                                    <div class="card-body" style="height:100%;">

                                        <div class="position-absolute top-50 start-50 translate-middle">
                                            <p class="m-2 text-secondary textInfo fs-4">Haz click en una petición para ver su contenido.</p>
                                        </div>
                                    </div>
                                </div>`);
        setTimeout(() => {
            $("#spinnerStart").addClass('d-none');  
        }, 300);
      

        
    }

    var lastid="card";
    function showCard(id,nomcard, usugra, fecgra, horgra, extdoc, urldoc, tipdoc, descrp, fecha, cam0, cam1, cam2, cam3,
        cam4, cam5, cam6, cam7, cam8, cam9, coddep, codsec) {
        $("#"+lastid).removeClass('bgClick');
        $("#"+id).addClass('bgClick');
        lastid=id;
        $("#spinnerStart").removeClass('d-none');
        const containerVisual = $("#containerVisual");
        containerVisual.empty();
        containerVisual.append(` <div id="visual" class="card overflow-auto maxbox" >
                                    <div class="card-body" style="height:100%;" id="cardbody">
                                
                                    </div>
                                </div>`);
        const cardbody = $("#cardbody");
        setTimeout(() => {  
            cardbody.append(`<div class="card">
                                            <div class="row">
                                                <div class="col-12 col-lg-1">
                                                </div>
                                                <div class="col-12 col-lg-12">
                                                    <div class="card-body text-center p-3" id="downloadFrame">
                                                    </div>
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
                                                                        <select class="form-select"
                                                                            id="tiposDoc"></select>
                                                                    </div>
                                                                    <div class="col-6 col-lg-2">
                                                                        <h6 class=" mt-1">Fecha de documento:</h6>
                                                                    </div>
                                                                    <div class="col-6 col-lg-4">
                                                                        <input type="date" class="form-control"
                                                                            id="fechaDoc">
                                                                        
                                                                    </div>
                                                                    <div class="col-12 col-lg-2 mt-2">
                                                                        <h6 class=" mt-1">Descripcion:</h6>
                                                                    </div>
                                                                    <div class="col-12 col-lg-4 mt-2">
                                                                    <input type="text" class="form-control"
                                                                            id="descrpDoc">
                                                                    </div>
                                                                    <div class="col-12 col-lg-2 mt-2">
                                                                        <h6 class=" mt-1">Departamento:</h6>
                                                                    </div>
                                                                    <div class="col-12 col-lg-4 mt-2">
                                                                        <label class="text-start form-control"
                                                                            id="depaDoc"></label>
                                                                    </div>
                                                                </div>
                                                        
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
                                                                    <label class="text-start form-control"
                                                                        id="usuaGra"></label>
                                                                </div>
                                                                <div class="col-6 col-lg-2">
                                                                    <h6 class=" mt-1">Fecha digitalización:</h6>
                                                                </div>
                                                                <div class="col-6 col-lg-4">
                                                                    <label class="text-start form-control"
                                                                        id="horaGra"></label>
                                                                </div>
                                                                <div class="col-12 d-none" id="lblError">
                                                                 <label class="text-danger mt-2" id="lblError">Rellene todos los campos.</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer m-0 p-0">
                                        <div class="d-flex ">
                                            <div class="flex-fill">
                                                <button onclick="changeState('R','`+nomcard+`','`+urldoc+`','`+extdoc+`','`+usugra+`','`+fecgra+`','`+horgra+`')" class="btn btn-danger btn-sm fw-bold text-white border bgred"
                                                    style="width:100%;">
                                                    RECHAZAR
                                                    &nbsp;&nbsp;&nbsp;  
                                                    <i class="fa-solid fa-xmark"></i>
                                                    </button>
                                            </div>
                                            <div class="flex-fill">
                                                <button onclick="changeState('A','`+nomcard+`','`+urldoc+`','`+extdoc+`','`+usugra+`','`+fecgra+`','`+horgra+`')"  class="btn btn-success btn-sm fw-bold text-white border bggreen"
                                                    style="width:100%;">
                                                    ACEPTAR
                                                    &nbsp;&nbsp;&nbsp;
                                                    <i class="fa-solid fa-check"></i>
                                                    </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>`);
                var urlTipos = "http://172.16.15.20/API.LovablePHP/ZLO0015P/ListTipos/";
                var responseTipos = ajaxRequest(urlTipos);
                if (responseTipos.code == 200) {
                    const tipos = $("#tiposDoc");
                    for (let i = 0; i < responseTipos.data.length; i++) {
                        tipos.append(`<option value="` + responseTipos.data[i].TIPDOC + `">` + responseTipos.data[i]
                            .DESCRP + `</option>`);
                    }
                }

                $("#tiposDoc").on('change', function() {
                    boolIsChange=1;
                    chargeCampos($(this).val(),cam0, cam1, cam2, cam3,
        cam4, cam5, cam6, cam7, cam8, cam9);
                 });
                                        $("#downloadFrame").empty();

switch (extdoc) {
    case 'png':
    case 'jpg':
    case 'jpeg':
        $("#downloadFrame").append('<img src="http://172.16.15.20' + urldoc + '" style="width:200px;" alt="">');
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
        <a class="btn btn-warning fw-bold text-white" style="width:100%;" target="_blank" href="http://172.16.15.20` +
        urldoc + `" >Visualizar documento <i class="fa-solid fa-eye"></i></a>
        
        </div>
        <div class="col-6">
            <a class="btn btn-info fw-bold text-white" style="width:100%;" href="http://172.16.15.20` +
        urldoc + `" download>Descargar <i class="fa-solid fa-download"></i></a>
        </div>
    </div>
    `);
} else {
    $("#downloadCard").append(
        `
        <div class="col-12">
            <a class="btn btn-info fw-bold text-white" style="width:100%;" href="http://172.16.15.20` +
        urldoc + `" download>Descargar <i class="fa-solid fa-download"></i></a>
        </div>
    </div>
    `);
}



$("#titleDoc").text(nomcard);

$("#tiposDoc").val(tipdoc);
$("#fechaDoc").val(formatFechaInput(fecha));
if (descrp == 'S-N') {
    descrp = '';
}
$("#descrpDoc").val(descrp);
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

chargeCampos(tipdoc,cam0, cam1, cam2, cam3,
        cam4, cam5, cam6, cam7, cam8, cam9);
$("#spinnerStart").addClass('d-none');      
        }, 200);
    }

    function changeState(state,nomdoc,urldoc,extdoc,usugra,fecgra,horgra) {
        $("#lblError").addClass('d-none');
        var isBlank=0;
        for (let i = 0; i < countInputs; i++) {
           if($("#CAM"+i).val()==''){
            isBlank=1;
           } 
        }
        if (state=='A') {
            if (isBlank==0) {
                var dataSave = {
                            "NOMDOC": nomdoc,
                            "EXTDOC": extdoc,
                            "CODSEC": 60,
                            "CODDEP": 6,
                            "USUGRA": usugra,
                            "FECGRA": fecgra,
                            "HORGRA": horgra,
                            "ARCHIVO": urldoc,
                            "TIPDOC": $("#tiposDoc").val(),
                            "DESCRP": $("#descrpDoc").val(),
                            "FECHA": $("#fechaDoc").val().replace(/-/g, ''),
                            "CAM1":  ($("#CAM0").val()==null)?'':$("#CAM0").val(),
                            "CAM2":  ($("#CAM1").val()==null)?'':$("#CAM1").val(),
                            "CAM3":  ($("#CAM2").val()==null)?'':$("#CAM2").val(),
                            "CAM4":  ($("#CAM3").val()==null)?'':$("#CAM3").val(),
                            "CAM5":  ($("#CAM4").val()==null)?'':$("#CAM4").val(),
                            "CAM6":  ($("#CAM5").val()==null)?'':$("#CAM5").val(),
                            "CAM7":  ($("#CAM6").val()==null)?'':$("#CAM6").val(),
                            "CAM8":  ($("#CAM7").val()==null)?'':$("#CAM7").val(),
                            "CAM9":  ($("#CAM8").val()==null)?'':$("#CAM8").val(),
                            "CAM10": ($("#CAM9").val()==null)?'':$("#CAM9").val()
                        };
                        var urlSave ="http://172.16.15.20/API.LovablePHP/ZLO0018P/DocUpdate/";
                        var responseSave = ajaxRequest(urlSave, dataSave, "POST");
                        var urlChange="http://172.16.15.20/API.LovablePHP/ZLO0018P/ChangeState/?nomdoc="+nomdoc+"&urldoc="+urldoc+"&estado="+state+"";
                        var responseChange=ajaxRequest(urlChange);
                        if (responseChange.code==200) {
                            chargeRequest(); 
                        }
            }else{
                $("#lblError").removeClass('d-none');
            }
        }else{
            var urlChange="http://172.16.15.20/API.LovablePHP/ZLO0018P/ChangeState/?nomdoc="+nomdoc+"&urldoc="+urldoc+"&estado="+state+"";
            var responseChange=ajaxRequest(urlChange);
            if (responseChange.code==200) {
                chargeRequest(); 
            }
        }
    }

    function truncarEnca(texto) {
        if (texto.length <= 19) {
            return texto;
        }
        return texto.substring(0, 19) + "...";
    }
    function truncarTexto(texto) {
        if (texto.length <= 22) {
            return texto;
        }
        return texto.substring(0, 22) + "...";
    }

    function formatFecha(inputDate) {
        var year = inputDate.substring(0, 4);
        var month = inputDate.substring(4, 6);
        var day = inputDate.substring(6, 8);
        var formattedDate = day + "/" + month + "/" + year;

        return formattedDate;
    }
    function formatFechaSent(inputDate) {
        var year = inputDate.substring(4, 8);
        var month = inputDate.substring(2, 4);
        var day = inputDate.substring(0, 2);
        var formattedDate = year + "" + month + "" + day;

        return formattedDate;
    }
    function formatFechaInput(inputDate) {
        var year = inputDate.substring(0, 4);
        var month = inputDate.substring(4, 6);
        var day = inputDate.substring(6, 8);
        var formattedDate = year+'-'+month+'-'+day;

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

    function chargeCampos(tipdoc,cam0,cam1,cam2,cam3,cam4,cam5,cam6,cam7,cam8,cam9){
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
        if (boolIsChange==1) {
            boolIsChange=0;
            var campos = {
                        "CAM0": " ",
                        "CAM1": " ",
                        "CAM2": " ",
                        "CAM3": " ",
                        "CAM4": " ",
                        "CAM5": " ",
                        "CAM6": " ",
                        "CAM7": " ",
                        "CAM8": " ",
                        "CAM9": " "
                    };
        }
 
var urlCampos = "http://172.16.15.20/API.LovablePHP/ZLO0015P/ListTiposFind/?tipo=" + tipdoc;
var responseCampos = ajaxRequest(urlCampos);
if (responseCampos.code == 200) {
    const inputs = $("#extraInfo");
    inputs.empty();
    var camposDes = responseCampos.data[0].CAMPOS.split("/");
    var cont = 0;
    var length = camposDes.length;
    countInputs=length;
    for (let i = 0; i < length; i++) {
        var descripcion = "";
        if (camposDes[i].toLowerCase() == "tienda" ) {
            if (campos['cam' + i]!=undefined) {
                var urlDes = "http://172.16.15.20/API.LovablePHP/ZLO0001P/FindComarc/?compFiltro=" + campos['cam' + i] + "";
                var responseDes = ajaxRequest(urlDes);
                descripcion = (responseDes.code == 200) ? responseDes.data[0]['COMDES'] : "";
                inputs.append(`<div class="col-6 col-lg-2 mt-2">
                            <h6 class=" mt-1">` + camposDes[i] + `:</h6></div>
                            <div class="col-6 col-lg-4 mt-2">
                            <label id="tienda" onclick="showTiendas(`+i+`)" class="text-start form-control">` + campos['cam' + i] + ` ` + descripcion.toUpperCase() + `</label>
                            <input id="CAM`+i+`" class="d-none" value="` + campos['cam' + i] + `" />
                            </div>`);
            }else{
                inputs.append(`<div class="col-6 col-lg-2 mt-2">
                            <h6 class=" mt-1">` + camposDes[i] + `:</h6></div>
                            <div class="col-6 col-lg-4 mt-2">
                            <label id="tienda" onclick="showTiendas(`+i+`)" class="text-start form-control">Selecciona una tienda</label>
                            <input id="CAM`+i+`" class="d-none" value="" />
                            </div>`);
            }
            
        } else if(camposDes[i].toLowerCase() == "compañia"){
            if (campos['cam' + i]!=undefined) {
            var urlDes = "http://172.16.15.20/API.LovablePHP/ZLO0001P/FindComarc/?compFiltro=" + campos[
                'cam' + i] + "";
            var responseDes = ajaxRequest(urlDes);
            descripcion = (responseDes.code == 200) ? responseDes.data[0]['COMDES'] : "";
            inputs.append(`<div class="col-6 col-lg-2 mt-2">
                        <h6 class=" mt-1">` + camposDes[i] + `:</h6></div>
                        <div class="col-6 col-lg-4 mt-2">
                        <label id="compania" onclick="showCompanias(`+i+`)" class="text-start form-control">` + campos['cam' + i] + ` ` + descripcion.toUpperCase() + `</label>
                        <input id="CAM`+i+`" class="d-none" value="` + campos['cam' + i] + `" />
                        </div>`);
            }else{
                inputs.append(`<div class="col-6 col-lg-2 mt-2">
                        <h6 class=" mt-1">` + camposDes[i] + `:</h6></div>
                        <div class="col-6 col-lg-4 mt-2">
                        <label id="compania" onclick="showCompanias(`+i+`)" class="text-start form-control">Selecciona una compañía</label>
                        <input id="CAM`+i+`" class="d-none" value="" />
                        </div>`);
            }
        } else if (camposDes[i].toLowerCase() == "proveedor") {
            if (campos['cam' + i]!=undefined) {
            var id = campos['cam' + i].split("-");
            var tipo = id[0];
            var prov = id[1];
            var urlFind = "http://172.16.15.20/API.LovablePHP/ZLO0015P/ProveedoresFind/?tipo=" + tipo +
                "&proveedor=" + prov + "";
            var responseFind = ajaxRequest(urlFind);
            descripcion = (responseFind.code == 200) ? responseFind.data[0]['ARCNOM'] : "";
            inputs.append(`<div class="col-6 col-lg-2 mt-2">
                        <h6 class=" mt-1">` + camposDes[i] + `:</h6></div>
                        <div class="col-6 col-lg-4 mt-2">
                        <label id="proveedor" onclick="showProveedores(`+i+`)" class="text-start form-control">` + campos['cam' + i] + ` ` + descripcion.toUpperCase() + `</label>
                        <input id="CAM`+i+`" class="d-none" value="` + campos['cam' + i] + `" />
                        </div>`);
             }else{
                inputs.append(`<div class="col-6 col-lg-2 mt-2">
                        <h6 class=" mt-1">` + camposDes[i] + `:</h6></div>
                        <div class="col-6 col-lg-4 mt-2">
                        <label id="proveedor" onclick="showProveedores(`+i+`)" class="text-start form-control">Selecciona un proveedor</label>
                        <input id="CAM`+i+`" class="d-none" value="" />
                        </div>`);
             }
            $("#proveedor").on('click', function() {
                searchval=0;
                proveedorval=1;
            });
        } else if (camposDes[i].toLowerCase() == "numero doc. fiscal") {
            if (campos['cam' + i]!=undefined) {
            if (campos['cam' + i] == '99999999999999999999') {
                campos['cam' + i] = '';
            }
            inputs.append(`<div class="col-6 col-lg-2 mt-2">
                        <h6 class=" mt-1">` + camposDes[i] + `:</h6></div>
                        <div class="col-6 col-lg-4 mt-2">
                        <input id="CAM`+i+`" class="form-control" type="text" value="` + campos['cam' + i] + ` ` + descripcion.toUpperCase() + `"></label>
                        </div>`);
            }else{
                inputs.append(`<div class="col-6 col-lg-2 mt-2">
                        <h6 class=" mt-1">` + camposDes[i] + `:</h6></div>
                        <div class="col-6 col-lg-4 mt-2">
                        <input id="CAM`+i+`" class="form-control" type="text" value=""></label>
                        </div>`);
            }
        }else{
            if (campos['cam' + i]!=undefined) {
            inputs.append(`<div class="col-6 col-lg-2 mt-2">
                        <h6 class=" mt-1">` + camposDes[i] + `:</h6></div>
                        <div class="col-6 col-lg-4 mt-2">
                        <input id="CAM`+i+`" class="form-control" type="text" value="` + campos['cam' + i] + ` ` + descripcion.toUpperCase() + `"></label>
                        </div>`);
            }else{
                inputs.append(`<div class="col-6 col-lg-2 mt-2">
                        <h6 class=" mt-1">` + camposDes[i] + `:</h6></div>
                        <div class="col-6 col-lg-4 mt-2">
                        <input id="CAM`+i+`" class="form-control" type="text" value=""></label>
                        </div>`); 
            }
        }

    
    }
}
    }

    function showTiendas(id) {
        $("#inputIdTiendas").val(id);
        $("#modalTiendas").modal('show');
    }

    function showCompanias(id) {
        $("#inputIdCompania").val(id);
        $("#modalCompania").modal('show');
    }

    function saveCompania() {
        var id = $("#CompaniaSelect").val();
        var descrp=$("#CompaniaSelect option:selected").text();
        var input=$("#inputIdCompania").val();
        $("#compania").text(id + ' ' + descrp);
        $("#CAM"+input).val(id);
        $("#modalCompania").modal('hide');
    }

    function saveTienda() {
        var id = $("#tiendasSelect").val();
        var descrp=$("#tiendasSelect option:selected").text();
        var input=$("#inputIdTiendas").val();
        $("#tienda").text(id + ' ' + descrp);
        $("#CAM"+input).val(id);
        $("#modalTiendas").modal('hide');
    }
    function showProveedores(id) {
        $("#inputIdProveedores").val(id);
        $("#modalProveedores").modal('show');
    }

    function sendProveedor(row) {
        var tr = $(row).closest('tr');
        var tds = tr.find('td');
        var tipo = tds.eq(0).text();
        var id = tds.eq(1).text();
        var desc = tds.eq(2).text();
        codigo = tipo + '-' + id;
        var input=$("#inputIdProveedores").val();
        $("#codigo").val(codigo);
        $("#proveedor").text(tipo + '-' + id + ' ' + desc);
        $("#modalProveedores").modal('hide');
    }
  
    function showRange() {
        $("#dayRange").empty();
        var currentDate = new Date().toISOString().split('T')[0];
        Date1 = currentDate.substr(0, 10);
        Date2 = currentDate.substr(13, 10);
        var fechasActual = $("#searchInput").text();
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
    function sendForm() {
        var rangeDocumento = $('#datepicker2').val();
        $("#originalvalue").val(rangeDocumento);
        $("#valueTipo").val(2);
        $("#searchInput").text(rangeDocumento);
        $("#modalRangeDocumento").modal('hide');
        chargeRequest();
    }
    function sendProveedor2(row) {
        var tr = $(row).closest('tr');
        var tds = tr.find('td');
        var tipo = tds.eq(0).text();
        var id = tds.eq(1).text();
        var desc = tds.eq(2).text();
        codigo = tipo + '-' + id;
        var input=$("#inputIdProveedores").val();
        $("#codigo").val(codigo);
        $("#searchInput").text(tipo + '-' + id + ' ' + desc);
        $("#modalProveedores").modal('hide');
        $("#valueTipo").val(1);
        chargeRequest();
    }
    function vaciarInput() {
        $('#searchInput').text('Buscar...');
        $("#valueTipo").val(0);
        $("#originalvalue").val('');
        $("#codigo").val('');
        chargeRequest();
    }

    </script>

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
                    <button type="button" class="btn btn-primary" onclick="sendForm()">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>