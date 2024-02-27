<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.6/ladda-themeless.min.css"
        integrity="sha512-EOY99TUZ7AClCNvbnvrhtMXDuWzxUBXV7SFovruHvYf2dbvRB5ya+jgDPk5bOyTtZDbqFH3PTuTWl/D7+7MGsA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.0/spin.min.js"
        integrity="sha512-fgSmjQtBho/dzDJ+79r/yKH01H/35//QPPvA2LR8hnBTA5bTODFncYfSRuMal78C08vUa93q3jyxPa273cWzqA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.0/ladda.min.js"
        integrity="sha512-hZL8cWjOAFfWZza/p0uD0juwMeIuyLhAd5QDodiK4sBp1sG7BIeE1TbMGIbnUcUgwm3lVSWJzBK6KxqYTiDGkg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <?php
      include '../layout-prg.php';
      include '../../assets/php/ZPL/ZLO0019P/header.php';
      //COMBOBOX
        $sqlCOMARC = "SELECT T2.CODSEC,LO0705.CODCIA COMCOD, LO0705.NOMCIA COMDES
        FROM LBPRDDAT/LO0705
        INNER JOIN LBPRDDAT/LO0686 AS T2 ON T2.CODCIA = LO0705.CODCIA AND T2.CODCIA NOT IN(1,35,20,21,22,23,24,50)
        ORDER BY T2.CODSEC";
        $resultCOMARC=odbc_exec($connIBM,$sqlCOMARC);
    ?>
    <script>
    var usuario = '<?php echo $_SESSION["CODUSU"];?>';
    </script>
    <div class="container-fluid p-0">
        <nav aria-label="breadcrumb" style="width:100%" class="p-0">
            <div class="row" style="width:100%">
                <div class="col-2 mt-1">
                    <button type="button" id="exportExcel" class="btn btn-success text-light fs-6 text-center mt-4"
                        style="width:100%;">
                        <i class="fa-solid fa-file-excel me-1"></i><b>Enviar a Excel</b>
                    </button>
                </div>
                <div class="col-2">
                    <label class="form-control border border-0">Año:</label>
                    <select id="setYear" class="form-select fw-bold">
                    </select>
                </div>
                <div class="col-6">
                    <label class="form-control border border-0">Tiendas:</label>
                    <div class="overflow-auto">
                        <select class="form-select fw-bold" id="cbbCia" name="cbbCia[]" style="width: 100%;">
                            <option class="fw-bold" value="47,52,56,57,59,63,64,65,68,70,72,73,74,75,76,78,82,85,88,50">Tiendas Honduras</option>
                            <option class="fw-bold" value="49,66,69,71,86">Tiendas Guatemala</option>
                            <option class="fw-bold" value="48,53,61,62">Tiendas El Salvador</option>
                            <option class="fw-bold" value="83,87">Tiendas Nicaragua</option>
                            <option class="fw-bold" value="60,80">Tiendas Costa Rica</option>
                            <option class="fw-bold" value="81">Tiendas Republica Dominicana</option>
                        </select>
                    </div>
                    <label class="text-danger mt-2 d-none " id="lblError">Debe de seleccionar una o mas tiendas</label>
                </div>
                <div class="col-2 mt-1">
                    <button type="button" class="btn btn-danger mt-4 fw-bold text-white" style="width:100%;"
                        onclick="searchF()">
                        <span class="me-2">BUSCAR</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#fff" class="bi bi-search"
                            viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg>
                    </button>
                </div>

            </div>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body ">
        <div class="card m-0 p-0">
            <div class="card-body  m-0 p-0 overflow-auto table-container" id="tableDiv">

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../assets/vendors/@coreui/chartjs/js/coreui-chartjs.js"></script>
    <script src="../../assets/vendors/@coreui/utils/js/coreui-utils.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>
    <script>
    var yearSelected = 0;
    var ciasSelected = [];
    //PROMEDIOS TRANSACCIONES
    var prolea=[];
    var tottralea=[];
    var prototlea=0;
    var tratprolea=0;

    var provip=[];
    var tottravip=[];
    var prototvip=0;
    var tratprovip=0;

    var pronor=[];
    var tottranor=[];
    var prototnor=0;
    var tratpronor=0;

    //PROMEDIOS PORCENTAJES
    var tottransacciones=[];
    var tottratransacciones=[];

    var porcelea=[];
    var porcetotlea=0;

    var porceact=[];
    var porcetotact=0;

    //INFO DE CONTACTO
    var protelefono=[];
    var protottelefono=0;
    var proemail=[];
    var prototemail=0;
    var proemailte=[];
    var prototemailte=0;

    var prototclie=[]
    var totalproclie=0;

    //TICKETS
    var ticketlea=0;
    var ticketvip=0;
    var ticketnor=0;
    var tickettot=0;
    $(document).ready(function() {
        yearSelected = getCookie('year') || 2023;
        var cookieSelect= getCookie('cias') || '47,52,56,57,59,63,64,65,68,70,72,73,74,75,76,78,82,85,88,50';
        ciasSelected = JSON.parse("[" + cookieSelect + "]");
        var selectTiendas= document.getElementById('cbbCia');
        selectTiendas.value = cookieSelect;

        var select = document.getElementById('setYear');
        var currentYear = new Date().getFullYear();
        for (var year = 2023; year <= currentYear; year++) {
            var option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            select.appendChild(option);
        }
        select.value = yearSelected;
        if (ciasSelected.length>1) {
            ciasSelected.push(0);
        }
        var width = 30000;
        var widthTh = "1.2";
        switch (ciasSelected.length) {
            case 21:
                width = 30000;
                widthTh = "1.2";
                break;
            case 6:
                width = 9000;
                widthTh = "4.5";
                break;
            case 5:
                width = 8000;
                widthTh = "4.9";
                break;
            case 4:
                width = 7000;
                widthTh = "5.5";
                break;
            case 3:
                width = 5000;
                widthTh = "7.5";
                break;
            default:
                width = 2500;
                widthTh = "10.5";
                break;
        }
        $("#exportExcel").on('click', function() {
            document.getElementById('loaderExcel').classList.remove('d-none');
            var url = "http://172.16.15.20/API.LovablePHP/ZLO0019P/Export2/?anio=" + yearSelected +
                "&tiendas=" + ciasSelected + "";
                console.log(url);
            fetch(url)
                .then(response => response.blob())
                .then(blob => {
                    var tempUrl = window.URL.createObjectURL(blob);
                    var a = document.createElement('a');
                    a.href = tempUrl;
                    a.download =
                    'ProgramaLealtad-Tiendas.xlsx'; // Puedes personalizar el nombre del archivo
                    document.body.appendChild(a);
                    a.click();
                    window.URL.revokeObjectURL(tempUrl);
                    a.remove();
                    document.getElementById('loaderExcel').classList.add(
                        'd-none');
                })
                .catch(error => {
                    console.error('Hubo un problema con la petición Fetch:', error);
                });
        });
        $("#tableDiv").empty();
        $("#tableDiv").append(`
                            <div id="loaderExcel" class="d-none">
                                        <button class="btn btn-success position-absolute top-50 start-50 translate-middle p-4"
                                            style="z-index: 9999;" type="button" disabled>
                                            <i class="fa-solid fa-file-excel fa-flip text-white" style="font-size:70px;"></i>
                                        </button>
                                        <div class="position-absolute top-0 start-0 w-100  bg-secondary bg-opacity-50 rounded"
                                            style="z-index: 9998; height:1950px !important; width:` + width + `px !important;"></div>
                                    </div>
                                <table  id="tableMetricas" class="table stripe table-hover" style="width:` + width + `px !important;">
                                                <thead class="sticky-top bg-white ">
                                                    <tr id="headerMes">

                                                    <tr>
                                                    <tr id="headerPaises">

                                                    <tr>
                                                </thead>
                                                <tbody id="tbody">

                                                </tbody>
                                 </table>`);
        //HEADER----------------------------------------------------------------------------------------------------------------------
        const headerMes = $("#headerMes");
        var countCias = ciasSelected.length;
        headerMes.empty();
        headerMes.append(`
                            <th class="text-center sticky-col" style="width:` + widthTh + `%;"></th>
                            <th class="text-center fs-3  border border-dark bg-secondary"   colspan="` + countCias + `">Enero</th>
                            <th class="text-center fs-3  border border-dark text-danger"   colspan="` + countCias + `">Febrero</th>
                            <th class="text-center fs-3  border border-dark bg-secondary"   colspan="` + countCias + `">Marzo</th>
                            <th class="text-center fs-3  border border-dark text-danger"   colspan="` + countCias + `">Abril</th>
                            <th class="text-center fs-3  border border-dark bg-secondary"   colspan="` + countCias + `">Mayo</th>
                            <th class="text-center fs-3  border border-dark text-danger"    colspan="` + countCias + `">Junio</th>
                            <th class="text-center fs-3  border border-dark bg-secondary"   colspan="` + countCias + `">Julio</th>
                            <th class="text-center fs-3  border border-dark text-danger"   colspan="` + countCias + `">Agosto</th>
                            <th class="text-center fs-3  border border-dark bg-secondary"   colspan="` + countCias + `">Septiembre</th>
                            <th class="text-center fs-3  border border-dark text-danger"   colspan="` + countCias + `">Octubre</th>
                            <th class="text-center fs-3  border border-dark bg-secondary"   colspan="` + countCias + `">Noviembre</th>
                            <th class="text-center fs-3  border border-dark text-danger"   colspan="` + countCias + `">Diciembre</th>
                            <th class="text-center fs-3  border border-dark bg-secondary"    colspan="` + countCias +
            `">Totales</th>`);
        const header = $("#headerPaises");
        header.append('<th></th>');
        //obteniendo descripcion de compañias
        var urlCias = "http://172.16.15.20/API.LovablePHP/ZLO0019P/GetComdes/?tiendas="+ciasSelected+"";
        var responseCias = ajaxRequest(urlCias);
        let tiendasCerradas=[];
        var tiendasArray = [];
        if (responseCias.code == 200) {
            let data = responseCias.data;
            for (let i = 0; i < data.length; i++) {
                tienda={CODCIA:data[i].CODCIA,COMDES:data[i].COMDES,ESTADO:data[i].GRUC02};
                tiendasArray.push(tienda);
            }
        }
        for (let i = 1; i <= 12; i++) {
            for (let j = 0; j < tiendasArray.length; j++) {
                if (tiendasArray[j].ESTADO == 1 || tiendasArray[j].ESTADO == 0) {
                    header.append(
                    `<th class="text-center border border-dark bg-light align-middle" style="font-size:14px;">` +
                    tiendasArray[j].COMDES+ `</th>`);
                } else {
                    header.append(
                        `<th class="text-center border border-dark bg-secondary bg-gradient text-white align-middle" style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;` +
                        tiendasArray[j].COMDES +`</th>`
                    );
                    tiendasCerradas.push(tiendasArray[j].CODCIA);
                }
            }
            if (ciasSelected.length>1) {
                header.append(
                `<th class="text-center border border-dark bg-black text-white align-middle" style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>`
                );
            }

        }
        header.append(`<th class="text-start responsive-font-example"></th>`);
        const tbody = $("#tbody");
        //REGISTROS----------------------------------------------------------------------------------------------------------------------
        var arrayRegistros =['PROGRAMAS LEALTAD NUEVOS',
                          'ACTUALIZADOS A PROGRAMA LEALTAD',
                          'TOTAL DE CLIENTES EN EL PROGRAMA DE LEALTAD',
                          'CLIENTES VIP',
                          'CLIENTES NORMALES',
                          'TOTAL REGISTROS DEL MES',
                          'ACUMULADOS PROGRAMA LEALTAD',
                          'ACUMULADOS VIP',
                          'ACUMULADOS NORMALES'];
        var rowtd = "";
        var urlRegistros = "http://172.16.15.20/API.LovablePHP/ZLO0019P/TiendasR/?anio=" + yearSelected +
            "&tiendas=" + ciasSelected + "";
            console.log(urlRegistros);
        var responseRegistros = ajaxRequest(urlRegistros);
        tbody.append(`<tr class="border border-dark">
                            <td colspan="1" class="bg-dark text-white fw-bold text-center sticky-col">REGISTROS</td>
                            <td colspan="300" class="bg-dark"></td>
                        </tr>`);
        var backgroundColor = ['#F4E8FF','#F4E8FF','#F4E8FF', '#EED4FF','#EED4FF','#EED4FF', '#E8C1FF','#E8C1FF', '#E8C1FF'];
        if (responseRegistros.code == 200) {
            let data = responseRegistros.data;
            let datosRow1 = {};
            let datosRow2 = {};
            let datosRow3 = {};
            let datosRow4 = {};
            let datosRow5 = {};
            let datosRow6 = {};
            let datosRow7 = {};
            let datosRow8 = {};
            let datosRow9 = {};
            for (let mes = 1; mes <= 12; mes++) {
                datosRow1[mes] = {};
                datosRow2[mes] = {};
                datosRow3[mes] = {};
                datosRow4[mes] = {};
                datosRow5[mes] = {};
                datosRow6[mes] = {};
                datosRow7[mes] = {};
                datosRow8[mes] = {};
                datosRow9[mes] = {};
                ciasSelected.forEach(codcia => {
                    datosRow1[mes][codcia] = 0;
                    datosRow2[mes][codcia] = 0;
                    datosRow3[mes][codcia] = 0;
                    datosRow4[mes][codcia] = 0;
                    datosRow5[mes][codcia] = 0;
                    datosRow6[mes][codcia] = 0;
                    datosRow7[mes][codcia] = 0;
                    datosRow8[mes][codcia] = 0;
                    datosRow9[mes][codcia] = 0;
                });
            }
            data.forEach(dato => {
                //ROW1
                datosRow1[dato.MESPRO][dato.CODCIA] = parseInt(dato.CLINUE);
                //ROW2
                datosRow2[dato.MESPRO][dato.CODCIA] = parseInt(dato.CLIVIE);
                //ROW3
                datosRow3[dato.MESPRO][dato.CODCIA] = parseInt(dato.TOTCLI);
                //ROW4
                datosRow4[dato.MESPRO][dato.CODCIA] = parseInt(dato.CLIVIP);
                //ROW5
                datosRow5[dato.MESPRO][dato.CODCIA] = parseInt(dato.CLINOR);
                //ROW6
                datosRow6[dato.MESPRO][dato.CODCIA] = parseInt(dato.TOTMES);
                //ROW7
                datosRow7[dato.MESPRO][dato.CODCIA] = parseInt(dato.ACULEA);
                //ROW8
                datosRow8[dato.MESPRO][dato.CODCIA] = parseInt(dato.ACUVIP);
                //ROW9
                datosRow9[dato.MESPRO][dato.CODCIA] = parseInt(dato.ACUNOR);
            });
            var rowIndex = 1;
            for (let k = 0; k < arrayRegistros.length; k++) {

                rowtd += '<tr class="border border-dark" style="background-color: ' + backgroundColor[k] +
                    '; height:50px;">';

                rowtd +=
                    '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: ' +
                    backgroundColor[k] + '">' + arrayRegistros[k] + '</td>';
                var totalRow = 0;
                var totalMes = 0;
                var acum=0;
                switch (rowIndex) {
                    case 1:
                        Object.keys(datosRow1).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                    if (totalMes == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border '+bgColorC+' border-dark"> </td>';
                                    } else {
                                        rowtd +=
                                            '<td class="text-end fontM border '+bgColorC+' border-dark">' +
                                            totalMes.toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) + '</td>';
                                    }
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border '+bgColorC+' border-dark">' +
                                        (datosRow1[mes][codcia] != 0 ? datosRow1[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) : '‎') + '</td>';
                                    totalMes += parseInt(datosRow1[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow1[mes][codcia] || '0');
                                }

                            });
                        });
                        break;
                    case 2:
                        Object.keys(datosRow2).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                    if (totalMes == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+'"> </td>';
                                    } else {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                            totalMes.toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) + '</td>';
                                    }
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                        (datosRow2[mes][codcia] != 0 ? datosRow2[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) : '‎') + '</td>';
                                    totalMes += parseInt(datosRow2[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow2[mes][codcia] || '0');
                                }
                            });
                        });
                        break;
                    case 3:
                        Object.keys(datosRow3).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                    prolea.push(totalMes);
                                    if (totalMes == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+'"> </td>';
                                    } else {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                            totalMes.toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) + '</td>';
                                    }
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                        (datosRow3[mes][codcia] != 0 ? datosRow3[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) : '‎') + '</td>';
                                    totalMes += parseInt(datosRow3[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow3[mes][codcia] || '0');
                                    prototlea=totalRow;
                                }
                            });
                        });
                        break;
                    case 4:
                        Object.keys(datosRow4).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                    provip.push(totalMes);
                                    if (totalMes == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+'"> </td>';
                                    } else {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                            totalMes.toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) + '</td>';
                                    }
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                        (datosRow4[mes][codcia] != 0 ? datosRow4[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) : '‎') + '</td>';
                                    totalMes += parseInt(datosRow4[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow4[mes][codcia] || '0');
                                    prototvip=totalRow;
                                }
                            });
                        });
                        break;
                    case 5:
                        Object.keys(datosRow5).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                    pronor.push(totalMes);
                                    if (totalMes == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+'"> </td>';
                                    } else {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                            totalMes.toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) + '</td>';
                                    }
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                        (datosRow5[mes][codcia] != 0 ? datosRow5[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) : '‎') + '</td>';
                                    totalMes += parseInt(datosRow5[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow5[mes][codcia] || '0');
                                    prototnor=totalRow;
                                }
                            });
                        });
                        break;
                    case 6:
                        Object.keys(datosRow6).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                    if (totalMes == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+'"> </td>';
                                    } else {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                            totalMes.toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) + '</td>';
                                    }
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                        (datosRow6[mes][codcia] != 0 ? datosRow6[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) : '‎') + '</td>';
                                    totalMes += parseInt(datosRow6[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow6[mes][codcia] || '0');
                                }
                            });
                        });
                        break;
                    case 7:
                        Object.keys(datosRow7).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                    if (totalMes == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+'"> </td>';
                                    } else {
                                        totalRow = parseInt(totalMes || '0');
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                            totalMes.toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) + '</td>';
                                    }
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                        (datosRow7[mes][codcia] != 0 ? datosRow7[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) : '‎') + '</td>';
                                    totalMes += parseInt(datosRow7[mes][codcia] || '0');
                                    if (codcia==81 && parseInt(datosRow7[mes][codcia])!=0) {
                                        totalRow=parseInt(datosRow7[mes][codcia]);
                                    }
                                }
                            });
                        });
                        break;
                    case 8:
                        Object.keys(datosRow8).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                    if (totalMes == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+'"> </td>';
                                    } else {
                                        totalRow = parseInt(totalMes || '0');
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                            totalMes.toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) + '</td>';
                                    }
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                        (datosRow8[mes][codcia] != 0 ? datosRow8[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) : '‎') + '</td>';
                                    totalMes += parseInt(datosRow8[mes][codcia] || '0');
                                    if (codcia==81 && parseInt(datosRow8[mes][codcia])!=0) {
                                         totalRow = parseInt(datosRow8[mes][codcia]);
                                    }
                                }
                            });
                        });
                        break;
                    case 9:
                        Object.keys(datosRow9).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                    if (totalMes == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+'"> </td>';
                                    } else {
                                        totalRow = parseInt(totalMes || '0');
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                            totalMes.toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) + '</td>';
                                    }
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                        (datosRow9[mes][codcia] != 0 ? datosRow9[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) : '‎') + '</td>';
                                    totalMes += parseInt(datosRow9[mes][codcia] || '0');
                                    if (codcia==81 && parseInt(datosRow9[mes][codcia])!=0) {
                                        totalRow = parseInt(datosRow9[mes][codcia]);
                                    }
                                }
                            });
                        });
                        break;
                    default:
                        rowtd += '<td class="text-end fontM border border-dark">0</td>';
                    break;
                }
                if (totalRow!=0) {
                    rowtd += '<td class="text-end fontM border border-dark">' + totalRow.toLocaleString('es-419', {
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0
                    }) + '</td>';
                }else{
                    rowtd += '<td class="text-end fontM border border-dark"> </td>';
                }
                rowtd += '</tr>';
                rowIndex++;
            }

        } else {
            for (let k = 0; k < arrayRegistros.length; k++) {
                rowtd += '<tr class="border border-dark" style="background-color: ' + backgroundColor[k] +
                    '; height:50px;">';
                rowtd +=
                    '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: ' +
                    backgroundColor[k] + '">' + arrayRegistros[k] + '</td>';
                for (let i = 0; i < 12; i++) {
                    for (let j = 0; j < tiendasArray.length; j++) {
                        rowtd += '<td class="text-end fontM border border-dark"> </td>';
                    }
                }
                rowtd += '<td class="text-end fontM border border-dark"> </td>';
                rowtd += '</tr>';
            }
        }
        tbody.append(rowtd);
        //TRANSACCIONES----------------------------------------------------------------------------------------------------------------------
        var arrayTransacciones = [
            'PROGRAMAS LEALTAD NUEVOS',
            'ACTUALIZADOS A PROGRAMA LEALTAD',
            'TOTAL DE TRANSACCIONES DE PROGRAMA LEALTAD',
            'TOTAL DE TRANSACCIONES DE CLIENTES VIP',
            'TOTAL DE TRANSACCIONES DE CLIENTES NORMALES',
            'TOTAL DE TRANSACCIONES DEL MES',
            'PROMEDIO DE TRANSACCIONES DE PROGRAMA LEALTAD',
            'PROMEDIO DE TRANSACCIONES DE CLIENTES VIP',
            'PROMEDIO DE TRANSACCIONES DE CLIENTES NORMALES',
            'ACUMULADOS PROGRAMA LEALTAD',
            'ACUMULADOS VIP',
            'ACUMULADOS NORMALES'
        ];
        var rowtd = "";
        var urlTransacciones = " http://172.16.15.20/API.LovablePHP/ZLO0019P/TiendasT/?anio=" + yearSelected +
            "&tiendas=" + ciasSelected + "";
        var responseTransacciones = ajaxRequest(urlTransacciones);
        tbody.append(`<tr><td colspan='14'></td></tr>
                          <tr class="border border-dark">
                            <td colspan="1" class="bg-dark text-white fw-bold text-center sticky-col">TRANSACCIONES</td>
                            <td colspan="300" class="bg-dark"></td>
                          </tr>
                          <tr><td colspan='14'></td></tr>`);

        //var backgroundColor = ['#DAEFFB', '#D1EEF2', '#C8EDF9', '#BFECE0', '#B6EBC7', '#ADEAAE', '#A4E995','#9BE88C'];
        var backgroundColor = ['#DAEFFB', '#DAEFFB','#DAEFFB', '#BFECE0', '#BFECE0', '#BFECE0','#BFECE0','#ADEAAE','#ADEAAE','#9BE88C','#9BE88C','#9BE88C'];
        if (responseTransacciones.code == 200) {
            let data = responseTransacciones.data;
            let datosRow1 = {};
            let datosRow2 = {};
            let datosRow3 = {};
            let datosRow4 = {};
            let datosRow5 = {};
            let datosRow6 = {};
            let datosRow7 = {};
            let datosRow8 = {};
            let datosRow9 = {};
            let datosRow10 = {};
            let datosRow11 = {};
            let datosRow12 = {};
            for (let mes = 1; mes <= 12; mes++) {
                datosRow1[mes] = {};
                datosRow2[mes] = {};
                datosRow3[mes] = {};
                datosRow4[mes] = {};
                datosRow5[mes] = {};
                datosRow6[mes] = {};
                datosRow7[mes] = {};
                datosRow8[mes] = {};
                datosRow9[mes] = {};
                datosRow10[mes] = {};
                datosRow11[mes] = {};
                datosRow12[mes] = {};
                ciasSelected.forEach(codcia => {
                    datosRow1[mes][codcia] = 0;
                    datosRow2[mes][codcia] = 0;
                    datosRow3[mes][codcia] = 0;
                    datosRow4[mes][codcia] = 0;
                    datosRow5[mes][codcia] = 0;
                    datosRow6[mes][codcia] = 0;
                    datosRow7[mes][codcia] = 0;
                    datosRow8[mes][codcia] = 0;
                    datosRow9[mes][codcia] = 0;
                    datosRow10[mes][codcia] = 0;
                    datosRow11[mes][codcia] = 0;
                    datosRow12[mes][codcia] = 0;
                });
            }
            data.forEach(dato => {
                //ROW1
                datosRow1[dato.MESPRO][dato.CODCIA] = parseInt(dato.TRANUE);
                //ROW2
                datosRow2[dato.MESPRO][dato.CODCIA] = parseInt(dato.TRAVIE);
                //ROW3
                datosRow3[dato.MESPRO][dato.CODCIA] = parseInt(dato.TOTLEA);
                //ROW4
                datosRow4[dato.MESPRO][dato.CODCIA] = parseInt(dato.TRAVIP);
                //ROW5
                datosRow5[dato.MESPRO][dato.CODCIA] = parseInt(dato.TRANOR);
                //ROW6
                datosRow6[dato.MESPRO][dato.CODCIA] = parseInt(dato.TOTTRA);
                //ROW7
                datosRow7[dato.MESPRO][dato.CODCIA] = parseFloat(dato.PORLEA);
                //ROW8
                datosRow8[dato.MESPRO][dato.CODCIA] = parseFloat(dato.PORVIP);
                //ROW9
                datosRow9[dato.MESPRO][dato.CODCIA] = parseFloat(dato.PORNOR);
                //ROW10
                datosRow10[dato.MESPRO][dato.CODCIA] = parseFloat(dato.TACULE);
                //ROW11
                datosRow11[dato.MESPRO][dato.CODCIA] = parseFloat(dato.TACUVI);
                //ROW12
                datosRow12[dato.MESPRO][dato.CODCIA] = parseFloat(dato.TACUNO);
            });

            var rowIndex = 1;
            for (let k = 0; k < arrayTransacciones.length; k++) {
                rowtd += '<tr class="border border-dark" style="background-color: ' + backgroundColor[k] +
                    '; height:50px;">';
                rowtd +=
                    '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: ' +
                    backgroundColor[k] + '">' + arrayTransacciones[k] + '</td>';
                var totalRow = 0;
                var totalMes = 0;
                switch (rowIndex) {
                    case 1:
                        Object.keys(datosRow1).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                    porcelea.push(totalMes);
                                    if (totalMes == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' "> </td>';
                                    } else {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                            totalMes.toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) + '</td>';
                                    }
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                        (datosRow1[mes][codcia] != 0 ? datosRow1[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) : '‎') + '</td>';
                                    totalMes += parseInt(datosRow1[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow1[mes][codcia] || '0');
                                    porcetotlea=totalRow;

                                }
                            });
                        });
                    break;
                    case 2:
                        Object.keys(datosRow2).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                    porceact.push(totalMes);
                                    if (totalMes == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+'"> </td>';
                                    } else {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                            totalMes.toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) + '</td>';
                                    }
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                        (datosRow2[mes][codcia] != 0 ? datosRow2[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) : '‎') + '</td>';
                                    totalMes += parseInt(datosRow2[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow2[mes][codcia] || '0');
                                    porcetotact=totalRow;
                                }
                            });
                        });
                    break;
                    case 3:
                        Object.keys(datosRow3).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                    tottralea.push(totalMes);
                                    if (totalMes == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+'"> </td>';
                                    } else {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                            totalMes.toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) + '</td>';
                                    }
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                        (datosRow3[mes][codcia] != 0 ? datosRow3[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) : '‎') + '</td>';
                                    totalMes += parseInt(datosRow3[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow3[mes][codcia] || '0');
                                    tratprolea=totalRow;
                                }
                            });
                        });
                    break;
                    case 4:
                        Object.keys(datosRow4).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                    tottravip.push(totalMes);

                                    if (totalMes == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+'"> </td>';
                                    } else {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                            totalMes.toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) + '</td>';
                                    }
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                        (datosRow4[mes][codcia] != 0 ? datosRow4[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) : '‎') + '</td>';
                                    totalMes += parseInt(datosRow4[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow4[mes][codcia] || '0');
                                    tratprovip=totalRow;
                                }
                            });
                        });
                    break;
                    case 5:
                        Object.keys(datosRow5).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                    tottranor.push(totalMes);
                                    if (totalMes == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+'"> </td>';
                                    } else {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                            totalMes.toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) + '</td>';
                                    }
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                        (datosRow5[mes][codcia] != 0 ? datosRow5[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) : '‎') + '</td>';
                                    totalMes += parseInt(datosRow5[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow5[mes][codcia] || '0');
                                    tratpronor=totalRow;
                                }
                            });
                        });
                    break;
                    case 6:
                        Object.keys(datosRow6).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                    tottransacciones.push(totalMes);
                                    if (totalMes == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+'"> </td>';
                                    } else {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                            totalMes.toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) + '</td>';
                                    }
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                        (datosRow6[mes][codcia] != 0 ? datosRow6[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) : '‎') + '</td>';
                                    totalMes += parseInt(datosRow6[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow6[mes][codcia] || '0');
                                    tottratransacciones=totalRow;

                                }
                            });
                        });
                    break;
                    case 7:
                        var currentMes=0;
                        Object.keys(datosRow7).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                        var promedio=0;
                                        if (prolea[currentMes]!=0) {
                                            promedio=tottralea[currentMes]/prolea[currentMes];
                                        }
                                        if (promedio == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+'"> </td>';
                                        } else {
                                            rowtd +=
                                                '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                                promedio.toLocaleString('es-419', {
                                                    minimumFractionDigits: 2,
                                                    maximumFractionDigits: 2
                                                }) + '%</td>';
                                        }
                                    currentMes++;
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+'">' +
                                        (datosRow7[mes][codcia] != 0 ? datosRow7[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 2,
                                                maximumFractionDigits: 2
                                            }) +'%' : '‎') + '</td>';
                                    totalMes += parseInt(datosRow7[mes][codcia] || '0');

                                    var promedio=0;
                                        if (prototlea!=0) {
                                            promedio=tratprolea/prototlea;
                                        }
                                        totalRow = promedio;
                                }
                            });
                        });
                    break;
                    case 8:
                        var currentMes=0;
                        Object.keys(datosRow8).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                        var promedio=0;
                                        if (provip[currentMes]!=0) {
                                            promedio=tottravip[currentMes]/provip[currentMes];
                                        }
                                        if (promedio == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' "> </td>';
                                        } else {
                                            rowtd +=
                                                '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                                promedio.toLocaleString('es-419', {
                                                    minimumFractionDigits: 2,
                                                    maximumFractionDigits: 2
                                                }) + '%</td>';
                                        }
                                    currentMes++;
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                        (datosRow8[mes][codcia] != 0 ? datosRow8[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 2,
                                                maximumFractionDigits: 2
                                            }) +'%' : '‎') + '</td>';
                                    totalMes += parseInt(datosRow8[mes][codcia] || '0');

                                    var promedio=0;
                                        if (prototvip!=0) {
                                            promedio=tratprovip/prototvip;
                                        }
                                        totalRow = promedio;
                                }
                            });
                        });
                    break;
                    case 9:
                        var currentMes=0;
                        Object.keys(datosRow9).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                        var promedio=0;
                                        if (pronor[currentMes]!=0) {
                                            promedio=tottranor[currentMes]/pronor[currentMes];
                                        }
                                        if (promedio == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' "> </td>';
                                        } else {
                                            rowtd +=
                                                '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                                promedio.toLocaleString('es-419', {
                                                    minimumFractionDigits: 2,
                                                    maximumFractionDigits: 2
                                                }) + '%</td>';
                                        }
                                    currentMes++;
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                        (datosRow9[mes][codcia] != 0 ? datosRow9[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 2,
                                                maximumFractionDigits: 2
                                            }) +'%' : '‎') + '</td>';
                                    totalMes += parseInt(datosRow9[mes][codcia] || '0');

                                    var promedio=0;
                                        if (prototnor!=0) {
                                            promedio=tratpronor/prototnor;
                                        }
                                        totalRow = promedio;
                                }
                            });
                        });
                    break;
                    case 10:
                        Object.keys(datosRow10).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                               let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                    if (totalMes == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' "> </td>';
                                    } else {
                                        totalRow = parseInt(totalMes || '0');
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                            totalMes.toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) + '</td>';
                                    }
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                        (datosRow10[mes][codcia] != 0 ? datosRow10[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) : '‎') + '</td>';
                                    totalMes += parseInt(datosRow10[mes][codcia] || '0');
                                    if (codcia==81 && parseInt(datosRow10[mes][codcia])!=0) {
                                        totalRow = parseInt(datosRow10[mes][codcia]);
                                    }
                                }
                            });
                        });
                    break;
                    case 11:
                        Object.keys(datosRow11).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                               let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                    if (totalMes == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' "> </td>';
                                    } else {
                                        totalRow = parseInt(totalMes || '0');
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                            totalMes.toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) + '</td>';
                                    }
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                        (datosRow11[mes][codcia] != 0 ? datosRow11[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) : '‎') + '</td>';
                                    totalMes += parseInt(datosRow11[mes][codcia] || '0');
                                    if (codcia==81 && parseInt(datosRow11[mes][codcia])!=0) {
                                        totalRow = parseInt(datosRow11[mes][codcia]);
                                    }
                                }
                            });
                        });
                    break;
                    case 12:
                        Object.keys(datosRow12).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                               let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                    if (totalMes == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' "> </td>';
                                    } else {
                                        totalRow = parseInt(totalMes || '0');
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                            totalMes.toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) + '</td>';
                                    }
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                        (datosRow12[mes][codcia] != 0 ? datosRow12[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) : '‎') + '</td>';
                                    totalMes += parseInt(datosRow12[mes][codcia] || '0');
                                    if (codcia==81 && parseInt(datosRow12[mes][codcia])!=0) {
                                        totalRow = parseInt(datosRow12[mes][codcia]);
                                    }
                                }
                            });
                        });
                    break;
                    default:
                        rowtd += '<td class="text-end fontM border border-dark">0</td>';
                    break;
                }
                if (totalRow==0) {
                    rowtd += '<td class="text-end fontM border border-dark"></td>';
                } else {
                   if (k==6 || k==7 || k==8) {
                    rowtd += '<td class="text-end fontM border border-dark">' + totalRow.toLocaleString('es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + '%</td>';

                   }else{
                    rowtd += '<td class="text-end fontM border border-dark">' + totalRow.toLocaleString(
                        'es-419', {
                            minimumFractionDigits: 0,
                            maximumFractionDigits: 0
                        }) + '</td>';
                   }
                }
                rowtd += '</tr>';
                rowIndex++;
            }

        } else {
            for (let k = 0; k < arrayTransacciones.length; k++) {
                rowtd += '<tr class="border border-dark" style="background-color: ' + backgroundColor[k] +
                    '; height:50px;">';
                rowtd +=
                    '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: ' +
                    backgroundColor[k] + '">' + arrayTransacciones[k] + '</td>';
                for (let i = 0; i < 12; i++) {
                    for (let j = 0; j < tiendasArray.length; j++) {
                        rowtd += '<td class="text-end fontM border border-dark"> </td>';
                    }
                }
                rowtd += '<td class="text-end fontM border border-dark"> </td>';
                rowtd += '</tr>';
            }
        }
        tbody.append(rowtd);

        //PORCENTAJE TRANSACCIONES----------------------------------------------------------------------------------------------------------------------
        var arrayPorTransacciones=[
                          '% DE TRANSACCIONES CON NUEVOS REGISTROS VS TOTAL DE TRANSACCIONES',
                          '% DE TRANSACCIONES CON ACTUALIZACION  DE DATOS VS TOTAL DE TRANSACCIONES',
                          '% DE TRANSACCIONES DE PROGRAMA LEALTAD',
                          '% DE TRANSACCIONES DE CLIENTES VIP',
                          '% DE TRANSACCIONES DE CLIENTES NORMALES'
                        ];
        var rowtd = "";
        var urlPTransacciones = " http://172.16.15.20/API.LovablePHP/ZLO0019P/TiendasPT/?anio=" + yearSelected +
            "&tiendas=" + ciasSelected + "";
        var responsePTransacciones = ajaxRequest(urlPTransacciones);
        tbody.append(`<tr><td colspan='14'></td></tr>
                          <tr class="border border-dark">
                            <td colspan="1" class="bg-dark text-white fw-bold text-center sticky-col">PORCENTAJES  DE TRANSACCIONES</td>
                            <td colspan="300" class="bg-dark"></td>
                          </tr>
                          <tr><td colspan='14'></td></tr>`);
                          var backgroundColor = [ '#FBFFCC', '#FAFF99','#F9FF66','#F8FF33','#F7FF00'];
        if (responsePTransacciones.code == 200) {
            let data = responsePTransacciones.data;
            let datosRow1 = {};
            let datosRow2 = {};
            let datosRow3 = {};
            let datosRow4 = {};
            let datosRow5 = {};
            for (let mes = 1; mes <= 12; mes++) {
                datosRow1[mes] = {};
                datosRow2[mes] = {};
                datosRow3[mes] = {};
                datosRow4[mes] = {};
                datosRow5[mes] = {};
                ciasSelected.forEach(codcia => {
                    datosRow1[mes][codcia] = 0;
                    datosRow2[mes][codcia] = 0;
                    datosRow3[mes][codcia] = 0;
                    datosRow4[mes][codcia] = 0;
                    datosRow5[mes][codcia] = 0;
                });
            }
            data.forEach(dato => {
                //ROW1
                datosRow1[dato.MESPRO][dato.CODCIA] = parseFloat(dato.PORCE6);
                //ROW2
                datosRow2[dato.MESPRO][dato.CODCIA] = parseFloat(dato.PORCE7);
                //ROW3
                datosRow3[dato.MESPRO][dato.CODCIA] = parseFloat(dato.PORCE8);
                //ROW4
                datosRow4[dato.MESPRO][dato.CODCIA] = (parseFloat(dato.TRAVIP)/parseFloat(dato.TOTTRA))*100;
                //ROW5
                datosRow5[dato.MESPRO][dato.CODCIA] = (parseFloat(dato.TRANOR)/parseFloat(dato.TOTTRA))*100;
            });

            var rowIndex = 1;
            for (let k = 0; k < arrayPorTransacciones.length; k++) {
                rowtd += '<tr class="border border-dark" style="background-color: ' + backgroundColor[k] +
                    '; height:50px;">';
                rowtd +=
                    '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: ' +
                    backgroundColor[k] + '">' + arrayPorTransacciones[k] + '</td>';
                var totalRow = 0;
                switch (rowIndex) {
                    case 1:
                        var currentMes=0;
                        Object.keys(datosRow1).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                               let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                        var promedio=0;
                                        if (tottransacciones[currentMes]!=0) {
                                            promedio=(porcelea[currentMes]/tottransacciones[currentMes])*100;
                                        }
                                        if (promedio == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' "> </td>';
                                        } else {
                                            rowtd +=
                                                '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                                promedio.toLocaleString('es-419', {
                                                    minimumFractionDigits: 2,
                                                    maximumFractionDigits: 2
                                                }) + '%</td>';
                                        }
                                    currentMes++;
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                        (datosRow1[mes][codcia] != 0 ? datosRow1[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 2,
                                                maximumFractionDigits: 2
                                            }) +'%' : '‎') + '</td>';
                                    totalMes += parseInt(datosRow1[mes][codcia] || '0');

                                    var promedio=0;
                                        if (tottratransacciones!=0) {
                                            promedio=porcetotlea/tottratransacciones;
                                        }
                                        totalRow = promedio*100;
                                }
                            });
                        });
                        break;
                    case 2:
                        var currentMes=0;
                        Object.keys(datosRow2).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                               let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                        var promedio=0;
                                        if (tottransacciones[currentMes]!=0) {
                                            promedio=(porceact[currentMes]/tottransacciones[currentMes]) *100;
                                        }
                                        if (promedio == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' "> </td>';
                                        } else {
                                            rowtd +=
                                                '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                                promedio.toLocaleString('es-419', {
                                                    minimumFractionDigits: 2,
                                                    maximumFractionDigits: 2
                                                }) + '%</td>';
                                        }
                                    currentMes++;
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                        (datosRow2[mes][codcia] != 0 ? datosRow2[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 2,
                                                maximumFractionDigits: 2
                                            }) +'%' : '‎') + '</td>';
                                    totalMes += parseInt(datosRow2[mes][codcia] || '0');
                                    var promedio=0;
                                    if (tottratransacciones!=0) {
                                        promedio=porcetotact/tottratransacciones;
                                    }
                                    totalRow = promedio*100;
                                }
                            });
                        });
                        break;
                    case 3:
                        var currentMes=0;
                        Object.keys(datosRow3).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                               let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                        var promedio=0;
                                        if (tottransacciones[currentMes]!=0) {
                                            promedio=(tottralea[currentMes]/tottransacciones[currentMes]) *100;
                                        }
                                        if (promedio == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' "> </td>';
                                        } else {
                                            rowtd +=
                                                '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                                promedio.toLocaleString('es-419', {
                                                    minimumFractionDigits: 2,
                                                    maximumFractionDigits: 2
                                                }) + '%</td>';
                                        }
                                    currentMes++;
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                        (datosRow3[mes][codcia] != 0 ? datosRow3[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 2,
                                                maximumFractionDigits: 2
                                            }) +'%' : '‎') + '</td>';
                                    totalMes += parseInt(datosRow3[mes][codcia] || '0');
                                    var promedio=0;
                                    if (tottratransacciones!=0) {
                                        promedio=tratprolea/tottratransacciones;
                                    }
                                    totalRow = promedio*100;
                                }
                            });
                        });
                        break;
                    case 4:
                        var currentMes=0;
                        Object.keys(datosRow4).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                               let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                        var promedio=0;
                                        if (tottransacciones[currentMes]!=0) {
                                            var suma=parseFloat(tottravip[currentMes]);
                                            promedio=(suma/tottransacciones[currentMes]) *100;
                                        }
                                        if (promedio == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' "> </td>';
                                        } else {
                                            rowtd +=
                                                '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                                promedio.toLocaleString('es-419', {
                                                    minimumFractionDigits: 2,
                                                    maximumFractionDigits: 2
                                                }) + '%</td>';
                                        }
                                    currentMes++;
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                        ((datosRow4[mes][codcia] != 0 && !isNaN(datosRow4[mes][codcia])) ? datosRow4[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 2,
                                                maximumFractionDigits: 2
                                            }) +'%' : '‎') + '</td>';
                                    totalMes += parseInt(datosRow4[mes][codcia] || '0');
                                    var promedio=0;
                                    if (tottratransacciones!=0) {
                                        var suma=tratprovip;
                                        promedio=suma/tottratransacciones;
                                    }
                                    totalRow = promedio*100;
                                }
                            });
                        });
                        break;
                    case 5:
                        var currentMes=0;
                        Object.keys(datosRow5).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                               let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                        var promedio=0;
                                        if (tottransacciones[currentMes]!=0) {
                                            var suma=parseFloat(tottranor[currentMes]);
                                            promedio=(suma/tottransacciones[currentMes]) *100;
                                        }
                                        if (promedio == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' "> </td>';
                                        } else {
                                            rowtd +=
                                                '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                                promedio.toLocaleString('es-419', {
                                                    minimumFractionDigits: 2,
                                                    maximumFractionDigits: 2
                                                }) + '%</td>';
                                        }
                                    currentMes++;
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                        ((datosRow5[mes][codcia] != 0 && !isNaN(datosRow5[mes][codcia])) ? datosRow5[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 2,
                                                maximumFractionDigits: 2
                                            }) +'%' : '‎') + '</td>';
                                    totalMes += parseInt(datosRow5[mes][codcia] || '0');
                                    var promedio=0;
                                    if (tottratransacciones!=0) {
                                        var suma=tratpronor;
                                        promedio=suma/tottratransacciones;
                                    }
                                    totalRow = promedio*100;
                                }
                            });
                        });
                        break;
                    default:
                        rowtd += '<td class="text-end fontM border border-dark">0</td>';
                        break;
                }
                if (totalRow==0) {
                    rowtd += '<td class="text-end fontM border border-dark"></td>';
                } else {
                    rowtd += '<td class="text-end fontM border border-dark">' + totalRow.toLocaleString('es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + '%</td>';

                }
                rowtd += '</tr>';
                rowIndex++;
            }
        } else {
            for (let k = 0; k < arrayPorTransacciones.length; k++) {
                rowtd += '<tr class="border border-dark" style="background-color: ' + backgroundColor[k] +
                    '; height:50px;">';
                rowtd +=
                    '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: ' +
                    backgroundColor[k] + '">' + arrayPorTransacciones[k] + '</td>';
                for (let i = 0; i < 12; i++) {
                    for (let j = 0; j < tiendasArray.length; j++) {
                        rowtd += '<td class="text-end fontM border border-dark"> </td>';
                    }
                }
                rowtd += '<td class="text-end fontM border border-dark"> </td>';
                rowtd += '</tr>';
            }
        }
        tbody.append(rowtd);

        //DESGLOSE DEL TIPO DE INFORMACION----------------------------------------------------------------------------------------------------------------------
        var arrayDesglose = [
            'TOTAL QUE INGRESARON O MODIFICARON DATOS EN EL MES',
            'CANTIDAD DE CLIENTES QUE BRINDARON AMBOS:  TELEFONO Y CORREO',
            '% DE CLIENTES QUE BRINDARON AMBOS: TELEFONO Y CORREO',
            'CANTIDAD DE CLIENTES QUE BRINDARON SOLO TELEFONO',
            '% DE CLIENTES QUE BRINDARON SOLO TELEFONO',
            'CANTIDAD DE CLIENTES QUE BRINDARON SOLO CORREO',
            '% DE CLIENTES QUE BRINDARON SOLO CORREO'
        ];
        var rowtd = "";
        var urlDesglose = "http://172.16.15.20/API.LovablePHP/ZLO0019P/TiendasD/?anio=" + yearSelected +
            "&tiendas=" + ciasSelected + "";
        var responseDesglose = ajaxRequest(urlDesglose);
        tbody.append(`<tr><td colspan='14'></td></tr>
                          <tr class="border border-dark">
                            <td colspan="1" class="bg-dark text-white fw-bold text-center sticky-col">DESGLOSE DEL TIPO DE INFORMACION QUE EL CLIENTE PROPORCIONA</td>
                            <td colspan="300" class="bg-dark"></td>
                          </tr>
                          <tr><td colspan='14'></td></tr>`);
        var backgroundColor = ['#D4E5FF', '#C3E2FF', '#B2DFFF', '#A1DCFF', '#90D9FF', '#7FD6FF', '#6ED3FF'];
        if (responseDesglose.code == 200) {
            let data = responseDesglose.data;
            let datosRow1 = {};
            let datosRow2 = {};
            let datosRow3 = {};
            let datosRow4 = {};
            let datosRow5 = {};
            let datosRow6 = {};
            let datosRow7 = {};
            for (let mes = 1; mes <= 12; mes++) {
                datosRow1[mes] = {};
                datosRow2[mes] = {};
                datosRow3[mes] = {};
                datosRow4[mes] = {};
                datosRow5[mes] = {};
                datosRow6[mes] = {};
                datosRow7[mes] = {};
                ciasSelected.forEach(codcia => {
                    datosRow1[mes][codcia] = 0;
                    datosRow2[mes][codcia] = 0;
                    datosRow3[mes][codcia] = 0;
                    datosRow4[mes][codcia] = 0;
                    datosRow5[mes][codcia] = 0;
                    datosRow6[mes][codcia] = 0;
                    datosRow7[mes][codcia] = 0;
                });
            }
            data.forEach(dato => {
                //ROW1
                datosRow1[dato.MESPRO][dato.CODCIA] = parseFloat(dato.TOTCLI);
                //ROW2
                datosRow2[dato.MESPRO][dato.CODCIA] = parseFloat(dato.MAILTE);
                //ROW3
                datosRow3[dato.MESPRO][dato.CODCIA] = parseFloat(dato.PORCE3);
                //ROW4
                datosRow4[dato.MESPRO][dato.CODCIA] = parseFloat(dato.TELEFO);
                //ROW5
                datosRow5[dato.MESPRO][dato.CODCIA] = parseFloat(dato.PORCE5);
                //ROW6
                datosRow6[dato.MESPRO][dato.CODCIA] = parseFloat(dato.EMAIL);
                //ROW7
                datosRow7[dato.MESPRO][dato.CODCIA] = parseFloat(dato.PORCE4);
            });
            var rowIndex = 1;
            for (let k = 0; k < arrayDesglose.length; k++) {
                rowtd += '<tr class="border border-dark" style="background-color: ' + backgroundColor[k] +
                    '; height:50px;">';
                rowtd +=
                    '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: ' +
                    backgroundColor[k] + '">' + arrayDesglose[k] + '</td>';
                var totalRow = 0;
                var totalMes = 0;
                switch (rowIndex) {
                    case 1:
                        Object.keys(datosRow1).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                               let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                    prototclie.push(totalMes);
                                    if (totalMes == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' "> </td>';
                                    } else {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                            totalMes.toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) + '</td>';
                                    }
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                        (datosRow1[mes][codcia] != 0 ? datosRow1[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) : '‎') + '</td>';
                                    totalMes += parseInt(datosRow1[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow1[mes][codcia] || '0');
                                    totalproclie=totalRow;
                                }
                            });
                        });
                        break;
                    case 2:
                        Object.keys(datosRow2).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                               let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                    proemailte.push(totalMes);
                                    if (totalMes == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' "> </td>';
                                    } else {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                            totalMes.toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) + '</td>';
                                    }
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                        (datosRow2[mes][codcia] != 0 ? datosRow2[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) : '‎') + '</td>';
                                    totalMes += parseInt(datosRow2[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow2[mes][codcia] || '0');
                                    prototemailte=totalRow;
                                }
                            });
                        });
                        break;
                    case 3:
                        var currentMes=0;
                        Object.keys(datosRow3).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                               let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                        var promedio=0;
                                        if (prototclie[currentMes]!=0) {
                                            promedio=(proemailte[currentMes]/prototclie[currentMes]) *100;
                                        }
                                        if (promedio == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' "> </td>';
                                        } else {
                                            rowtd +=
                                                '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                                promedio.toLocaleString('es-419', {
                                                    minimumFractionDigits: 2,
                                                    maximumFractionDigits: 2
                                                }) + '%</td>';
                                        }
                                    currentMes++;
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                        (datosRow3[mes][codcia] != 0 ? datosRow3[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 2,
                                                maximumFractionDigits: 2
                                            }) +'%' : '‎') + '</td>';
                                    totalMes += parseInt(datosRow3[mes][codcia] || '0');
                                    var promedio=0;
                                    if (totalproclie!=0) {
                                        promedio=prototemailte/totalproclie;
                                    }
                                    totalRow = promedio*100;
                                }
                            });
                        });
                        break;
                    case 4:
                        Object.keys(datosRow4).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                               let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                    protelefono.push(totalMes);
                                    if (totalMes == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' "> </td>';
                                    } else {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                            totalMes.toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) + '</td>';
                                    }
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                        (datosRow4[mes][codcia] != 0 ? datosRow4[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) : '‎') + '</td>';
                                    totalMes += parseInt(datosRow4[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow4[mes][codcia] || '0');
                                    protottelefono=totalRow;
                                }
                            });
                        });
                        break;
                    case 5:
                        var currentMes=0;
                        Object.keys(datosRow5).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                               let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                        var promedio=0;
                                        if (prototclie[currentMes]!=0) {
                                            promedio=(protelefono[currentMes]/prototclie[currentMes]) *100;
                                        }
                                        if (promedio == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' "> </td>';
                                        } else {
                                            rowtd +=
                                                '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                                promedio.toLocaleString('es-419', {
                                                    minimumFractionDigits: 2,
                                                    maximumFractionDigits: 2
                                                }) + '%</td>';
                                        }
                                    currentMes++;
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                        (datosRow5[mes][codcia] != 0 ? datosRow5[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 2,
                                                maximumFractionDigits: 2
                                            }) +'%' : '‎') + '</td>';
                                    totalMes += parseInt(datosRow5[mes][codcia] || '0');
                                    var promedio=0;
                                    if (totalproclie!=0) {
                                        promedio=protottelefono/totalproclie;
                                    }
                                    totalRow = promedio*100;
                                }
                            });
                        });
                        break;
                    case 6:
                        Object.keys(datosRow6).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                               let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                    proemail.push(totalMes);
                                    if (totalMes == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' "> </td>';
                                    } else {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                            totalMes.toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) + '</td>';
                                    }
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                        (datosRow6[mes][codcia] != 0 ? datosRow6[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 0,
                                                maximumFractionDigits: 0
                                            }) : '‎') + '</td>';
                                    totalMes += parseInt(datosRow6[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow6[mes][codcia] || '0');
                                    prototemail=totalRow;
                                }
                            });
                        });
                        break;
                    case 7:
                        var currentMes=0;
                        Object.keys(datosRow7).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                               let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                        var promedio=0;
                                        if (prototclie[currentMes]!=0) {
                                            promedio=(proemail[currentMes]/prototclie[currentMes]) *100;
                                        }
                                        if (promedio == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' "> </td>';
                                        } else {
                                            rowtd +=
                                                '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                                promedio.toLocaleString('es-419', {
                                                    minimumFractionDigits: 2,
                                                    maximumFractionDigits: 2
                                                }) + '%</td>';
                                        }
                                    currentMes++;
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                        (datosRow7[mes][codcia] != 0 ? datosRow7[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 2,
                                                maximumFractionDigits: 2
                                            }) +'%' : '‎') + '</td>';
                                    totalMes += parseInt(datosRow7[mes][codcia] || '0');
                                    var promedio=0;
                                    if (totalproclie!=0) {
                                        promedio=prototemail/totalproclie;
                                    }
                                    totalRow = promedio*100;
                                }
                            });
                        });
                        break;
                    default:
                        rowtd += '<td class="text-end fontM border border-dark">0</td>';
                        break;
                }

                if (totalRow==0) {
                    rowtd += '<td class="text-end fontM border border-dark"></td>';
                } else {
                   if (k==2 || k==4 || k==6) {
                    rowtd += '<td class="text-end fontM border border-dark">' + totalRow.toLocaleString('es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + '%</td>';

                   }else{
                    rowtd += '<td class="text-end fontM border border-dark">' + totalRow.toLocaleString(
                        'es-419', {
                            minimumFractionDigits: 0,
                            maximumFractionDigits: 0
                        }) + '</td>';
                   }
                }
                rowtd += '</tr>';
                rowIndex++;
            }

        } else {
            for (let k = 0; k < arrayDesglose.length; k++) {
                rowtd += '<tr class="border border-dark" style="background-color: ' + backgroundColor[k] +
                    '; height:50px;">';
                rowtd +=
                    '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: ' +
                    backgroundColor[k] + '">' + arrayDesglose[k] + '</td>';
                for (let i = 0; i < 12; i++) {
                    for (let j = 0; j < tiendasArray.length; j++) {
                        rowtd += '<td class="text-end fontM border border-dark"> </td>';
                    }
                }
                rowtd += '<td class="text-end fontM border border-dark"> </td>';
                rowtd += '</tr>';
            }
        }
        tbody.append(rowtd);
        //TICKET PROMEDIO----------------------------------------------------------------------------------------------------------------------
        var arrayTicket = [
            'TICKET PROMEDIO DE TRANSACCIONES DE PROGRAMA DE LEALTAD',
            'TICKET PROMEDIO DE TRANSACCIONES DE CLIENTES VIP',
            'TICKET PROMEDIO DE TRANSACCIONES DE CLIENTES NORMALES',
            'TICKET PROMEDIO  GENERAL'
        ];
        var rowtd = "";
        var urlTicket = "http://172.16.15.20/API.LovablePHP/ZLO0019P/TiendasTC/?anio=" + yearSelected +
            "&tiendas=" + ciasSelected + "";
        var responseTicket = ajaxRequest(urlTicket);
        tbody.append(`<tr><td colspan='14'></td></tr>
                          <tr class="border border-dark">
                            <td colspan="1" class="bg-dark text-white fw-bold text-center sticky-col">TICKET PROMEDIO</td>
                            <td colspan="300" class="bg-dark"></td>
                          </tr>
                          <tr><td colspan='14'></td></tr>`);
        var backgroundColor = ['#FFE0CC', '#FFD199','#FFD199', '#FFC266'];
        if (responseTicket.code == 200) {
            let data = responseTicket.data;
            let datosRow1 = {};let datosRow2 = {};let datosRow3 = {}; let datosRow4 = {}; let datosVallea = {}; let datosValvip = {}; let datosValnor = {}; let datosValtot = {};
            for (let mes = 1; mes <= 12; mes++) {
                datosRow1[mes] = {};
                datosRow2[mes] = {};
                datosRow3[mes] = {};
                datosRow4[mes] = {};
                datosVallea[mes] = {};
                datosValvip[mes] = {};
                datosValnor[mes] = {};
                datosValtot[mes] = {};
                ciasSelected.forEach(codcia => {
                    datosRow1[mes][codcia] = 0;
                    datosRow2[mes][codcia] = 0;
                    datosRow3[mes][codcia] = 0;
                    datosRow4[mes][codcia] = 0;
                    datosVallea[mes][codcia] = 0;
                    datosValvip[mes][codcia] = 0;
                    datosValnor[mes][codcia] = 0;
                    datosValtot[mes][codcia] = 0;
                });
            }
            data.forEach(dato => {
                //ROW1
                datosRow1[dato.MESPRO][dato.CODCIA] = parseFloat(dato.PORVLE);
                //ROW2
                datosRow2[dato.MESPRO][dato.CODCIA] = parseFloat(dato.PORVVI);
                //ROW3
                datosRow3[dato.MESPRO][dato.CODCIA] = parseFloat(dato.PORVNO);
                //ROW3
                datosRow4[dato.MESPRO][dato.CODCIA] = parseFloat(dato.PORVTO);
                //VALORES VENTA
                datosVallea[dato.MESPRO][dato.CODCIA] = parseFloat(dato.VALLEA);
                datosValvip[dato.MESPRO][dato.CODCIA] = parseFloat(dato.VALVIP);
                datosValnor[dato.MESPRO][dato.CODCIA] = parseFloat(dato.VALNOR);
                datosValtot[dato.MESPRO][dato.CODCIA] = parseFloat(dato.VALTOT);
            });
            var rowIndex = 1;
            for (let k = 0; k < arrayTicket.length; k++) {
                rowtd += '<tr class="border border-dark" style="background-color: ' + backgroundColor[k] +
                    '; height:50px;">';
                rowtd +=
                    '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: ' +
                    backgroundColor[k] + '">' + arrayTicket[k] + '</td>';
                var totalRowVal = 0;
                var totalRowTra=0;
                var totalMes = 0;
                switch (rowIndex) {
                    case 1:
                        var currentMes=0;
                        Object.keys(datosRow1).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                               let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                        var promedio=0;
                                        if (tottralea[currentMes]!=0) {
                                            promedio=(totalMes/tottralea[currentMes]);
                                            totalRowTra+=tottralea[currentMes];
                                        }
                                        if (promedio == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' "> </td>';
                                        } else {
                                            rowtd +=
                                                '<td class="text-end fontM border border-dark '+bgColorC+' "> D.' +
                                                promedio.toLocaleString('es-419', {
                                                    minimumFractionDigits: 2,
                                                    maximumFractionDigits: 2
                                                }) + '</td>';
                                        }
                                    currentMes++;
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                        (datosRow1[mes][codcia] != 0 ? 'D.'+datosRow1[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 2,
                                                maximumFractionDigits: 2
                                            }) : '‎') + '</td>';
                                    totalMes += parseFloat(datosVallea[mes][codcia] || '0');
                                    totalRowVal += parseFloat(datosVallea[mes][codcia] || '0');
                                    if (codcia==81 && tratprolea!=0) {
                                        totalRowTra=tratprolea;
                                    }
                                }
                            });
                        });
                        break;
                    case 2:
                        var currentMes=0;
                        Object.keys(datosRow2).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                               let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                        var promedio=0;
                                        if (tottravip[currentMes]!=0) {
                                            promedio=(totalMes/tottravip[currentMes]);
                                            totalRowTra+=tottravip[currentMes];
                                        }
                                        if (promedio == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' "> </td>';
                                        } else {
                                            rowtd +=
                                                '<td class="text-end fontM border border-dark '+bgColorC+' "> D.' +
                                                promedio.toLocaleString('es-419', {
                                                    minimumFractionDigits: 2,
                                                    maximumFractionDigits: 2
                                                }) + '</td>';
                                        }
                                    currentMes++;
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                        (datosRow2[mes][codcia] != 0 ? 'D.'+datosRow2[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 2,
                                                maximumFractionDigits: 2
                                            }) : '‎') + '</td>';
                                    totalMes += parseFloat(datosValvip[mes][codcia] || '0');
                                    totalRowVal += parseFloat(datosValvip[mes][codcia] || '0');
                                    if (codcia==81 && tratprovip!=0) {
                                        totalRowTra=tratprovip;
                                    }
                                }
                            });
                        });
                        break;
                    case 3:
                        var currentMes=0;
                        Object.keys(datosRow3).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                               let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                        var promedio=0;
                                        if (tottranor[currentMes]!=0) {
                                            promedio=(totalMes/tottranor[currentMes]);
                                            totalRowTra+=tottranor[currentMes];
                                        }
                                        if (promedio == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' "> </td>';
                                        } else {
                                            rowtd +=
                                                '<td class="text-end fontM border border-dark '+bgColorC+' "> D.' +
                                                promedio.toLocaleString('es-419', {
                                                    minimumFractionDigits: 2,
                                                    maximumFractionDigits: 2
                                                }) + '</td>';
                                        }
                                    currentMes++;
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                        (datosRow3[mes][codcia] != 0 ? 'D.'+datosRow3[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 2,
                                                maximumFractionDigits: 2
                                            }) : '‎') + '</td>';
                                    totalMes += parseFloat(datosValnor[mes][codcia] || '0');
                                    totalRowVal += parseFloat(datosValnor[mes][codcia] || '0');
                                    if (codcia==81 && tratpronor!=0) {
                                        totalRowTra=tratpronor;
                                    }
                                }
                            });
                        });
                        break;
                    case 4:
                        var currentMes=0;
                        Object.keys(datosRow4).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                               let bgColorC="";
                                if(tiendasCerradas.includes(codcia.toString())){
                                    bgColorC="bg-secondary bg-gradient text-white";
                                }
                                if (codcia == 0) {
                                        var promedio=0;
                                        if (tottransacciones[currentMes]!=0) {
                                            promedio=(totalMes/tottransacciones[currentMes]);
                                            totalRowTra+=tottransacciones[currentMes];
                                        }
                                        if (promedio == 0) {
                                        rowtd +=
                                            '<td class="text-end fontM border border-dark '+bgColorC+' "> </td>';
                                        } else {
                                            rowtd +=
                                                '<td class="text-end fontM border border-dark '+bgColorC+' "> D.' +
                                                promedio.toLocaleString('es-419', {
                                                    minimumFractionDigits: 2,
                                                    maximumFractionDigits: 2
                                                }) + '</td>';
                                        }
                                    currentMes++;
                                    totalMes = 0;
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark '+bgColorC+' ">' +
                                        (datosRow4[mes][codcia] != 0 ? 'D.'+datosRow4[mes][codcia]
                                            .toLocaleString('es-419', {
                                                minimumFractionDigits: 2,
                                                maximumFractionDigits: 2
                                            }) : '‎') + '</td>';
                                    totalMes += parseFloat(datosValtot[mes][codcia] || '0');
                                    totalRowVal += parseFloat(datosValtot[mes][codcia] || '0');
                                    if (codcia==81 && tratpronor!=0) {
                                        totalRowTra=tratpronor+tratprovip+tratprolea;
                                    }
                                }
                            });
                        });
                        break;
                    default:
                        rowtd += '<td class="text-end fontM border border-dark">0</td>';
                        break;
                }
                if (totalRowVal==0) {
                    rowtd += '<td class="text-end fontM border border-dark"></td>';
                } else {
                    var promedio=0;
                    if (totalRowTra!=0) {
                        promedio=totalRowVal/totalRowTra;
                    }
                    rowtd += '<td class="text-end fontM border border-dark"> D.' + promedio.toLocaleString('es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + '</td>';
                }
                rowtd += '</tr>';
                rowIndex++;
            }
        } else {
            for (let k = 0; k < arrayTicket.length; k++) {
                rowtd += '<tr class="border border-dark" style="background-color: ' + backgroundColor[k] +
                    '; height:50px;">';
                rowtd +=
                    '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: ' +
                    backgroundColor[k] + '">' + arrayTicket[k] + '</td>';
                for (let i = 0; i < 12; i++) {
                    for (let j = 0; j < tiendasArray.length; j++) {
                        rowtd += '<td class="text-end fontM border border-dark"> </td>';
                    }
                }
                rowtd += '<td class="text-end fontM border border-dark"> </td>';
                rowtd += '</tr>';
            }
        }
        tbody.append(rowtd);
    });

    function searchF() {
        var yearSelected = $("#setYear").val();
        setCookie('year', yearSelected, 1);
        var cias = $("#cbbCia").val();
        setCookie('cias', cias, 1);
        if (cias.length != 0) {
            location.reload();
        } else {
            $("#lblError").removeClass('d-none');
        }

    }
    </script>
    <!-- <script src="../../assets/js/PRG/ZPL/ZLO0017P.js"></script>-->
</body>

</html>