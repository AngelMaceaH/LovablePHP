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
      include '../../assets/php/ZPL/ZLO0017P/header.php';
    ?>
    <script>
    var usuario = '<?php echo $_SESSION["CODUSU"];?>';
    </script>
    <div class="container-fluid">
        <nav aria-label="breadcrumb" style="width:100%">
            <div class="row">
                <div class="col-8">
                    <ol class="breadcrumb my-0 ms-2 mt-3">
                        <li class="breadcrumb-item">
                            <span>Programa Lealtad / Estádistica</span>
                        </li>
                        <li class="breadcrumb-item active"><span>ZLO0017P</span></li>
                    </ol>
                </div>
                <div class="col-2 mt-1">
                    <button type="button" id="exportExcel" class="btn btn-success text-light fs-6 text-center"
                        style="width:100%;">
                        <i class="fa-solid fa-file-excel me-1"></i><b>Enviar a Excel</b>
                    </button>
                </div>
                <div class="col-2 d-flex">
                    <label class="form-control border border-0" style="width: 30%;">Año:</label>
                    <select id="setYear" class="form-select fw-bold" style="width: 70%;">
                    </select>
                </div>
            </div>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body ">
        <div class="card m-0 p-0" id="body-page">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>
    <script>
    var yearSelected = 0;
    //PROMEDIOS TRANSACCIONES
    var prolea = 0;
    var provip = 0;
    var pronor = 0;

    var tralea = 0;
    var travip = 0;
    var tranor = 0;
    //TRANSACCIONES
    var totaltransacciones = 0;
    var tranue = 0;
    var travie = 0;
    //CONTACTO
    var contotal = 0;
    var conmailte = 0;
    var contelefono = 0;
    var conemail = 0;
    let arrayCountries=[];
    $(document).ready(function() {
        var currentYear = new Date().getFullYear();
        yearSelected = getCookie('year') || currentYear;
        var select = document.getElementById('setYear');
        for (var year = currentYear; year >= 2023; year--) {
            var option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            select.appendChild(option);
        }
        select.value = yearSelected;
        $('#setYear').on('change', function() {
            setCookie('year', this.value, 1);
            location.reload();
        });
        $


        ("#exportExcel").on('click', function() {
            document.getElementById('loaderExcel').classList.remove('d-none');
            var url = "/API.LovablePHP/ZLO0017P/Export/?anio=" + yearSelected +"&tiendas="+arrayCountries.toString()+"";
            fetch(url)
                .then(response => response.blob())
                .then(blob => {
                    var tempUrl = window.URL.createObjectURL(blob);
                    var a = document.createElement('a');
                    a.href = tempUrl;
                    a.download =
                        'ProgramaLealtad-Paises.xlsx'; // Puedes personalizar el nombre del archivo
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
        //HEADER----------------------------------------------------------------------------------------------------------------------
        let headersTh="";
        let countHeaders=0;
        let arrayCountriesStr="";
        var usuario = '<?php echo $_SESSION["CODUSU"];?>';
        const urlVal="http://172.16.15.20/API.LovablePHP/Users/FindAgrupP/?codusu="+usuario+"";
            let defaultArray="";
            fetch(urlVal).then(response => response.json()).then(data => {
                if(data.code==200){
                    const dataResponse= data.data;
                    if (dataResponse.length>2) {
                        if(dataResponse[0]['CODIGO']==10 && dataResponse[1]['CODIGO']==11){
                            const temp=dataResponse[1];
                            dataResponse[1]=dataResponse[0];
                            dataResponse[0]=temp;
                        }
                    }
                    if (dataResponse.length>0) {
                        dataResponse.forEach(element => {
                       if (element.DESCRI.includes("honduras")) {
                            countHeaders++;
                            arrayCountries.push(1);
                       }else if (element.DESCRI.includes("guatemala")) {
                            countHeaders++;
                            arrayCountries.push(3);
                       }else if (element.DESCRI.includes("salvador")) {
                            countHeaders++;
                            arrayCountries.push(4);
                       }else if(element.DESCRI.includes("costa rica")){
                            countHeaders++;
                            arrayCountries.push(5);
                       }else if(element.DESCRI.includes("nicaragua")){
                            countHeaders++;
                            arrayCountries.push(6);
                       }else if(element.DESCRI.includes("republica dominicana")){
                            countHeaders++;
                            arrayCountries.push(19);
                      }
                    });
                    }
                    arrayCountries.sort((a, b) => a - b);
                    var width = 7800;
                    var widthTh = "5";
                    var widthPai="1.3"
                    var widthRow="73";
                    switch (arrayCountries.length){
                        case 6:
                            width = 8400;
                            widthTh = "5";
                            widthRow="73";
                            break;
                        case 5:
                            width = 7200;
                            widthTh = "5";
                            widthRow="61";
                            break;
                        case 4:
                            width = 6000;
                            widthTh = "7";
                            widthRow="49";
                            break;
                        case 3:
                            width = 4800;
                            widthTh = "7";
                            widthRow="37";
                            break;
                        case 2:
                            width = 3500;
                            widthTh = "14";
                            widthRow="25";
                        break;
                        default:
                            width = 2500;
                            widthTh = "15";
                            widthRow="13";
                        break;
                    }
                    arrayCountries.forEach(codpai => {
                        switch (codpai) {
                            case 1:
                                headersTh += '<th class="text-center border border-dark bg-light" style="width:100px !important;" >HONDURAS</th>';
                                break;
                            case 3:
                                headersTh += '<th class="text-center border border-dark bg-light" style="width:100px !important;" >GUATEMALA</th>';
                                break;
                            case 4:
                                headersTh += '<th class="text-center border border-dark bg-light" style="width:100px !important;" >EL&nbsp;&nbsp;SALVADOR</th>';
                                break;
                            case 5:
                                headersTh += '<th class="text-center border border-dark bg-light" style="width:100px !important;" >COSTA&nbsp;&nbsp;RICA</th>';
                                break;
                            case 6:
                                headersTh += '<th class="text-center border border-dark bg-light" style="width:100px !important;" >NICARAGUA</th>';
                                break;
                            case 19:
                                headersTh += '<th class="text-center border border-dark bg-light" style="width:100px !important;" >REP.&nbsp;&nbsp;DOMINICANA</th>';
                                break;
                        }
                    });
                    $("#tableDiv").empty();
                    $("#tableDiv").append(`
                            <div id="loaderExcel" class="d-none">
                                <button class="btn btn-success position-absolute top-50 start-50 translate-middle p-4"
                                    style="z-index: 9999;" type="button" disabled>
                                    <i class="fa-solid fa-file-excel fa-flip text-white" style="font-size:70px;"></i>
                                </button>
                                <div class="position-absolute top-0 start-0 w-100  bg-secondary bg-opacity-50 rounded"
                                    style="z-index: 9998; height:2350px !important; width:` + width + `px  !important;"></div>
                            </div>
                            <table id="tableMetricas" class="table stripe table-hover " style="width:` + width + `px ;">
                                <thead class="sticky-top bg-white ">
                                    <tr id="headerMeses">

                                    </tr>
                                    <tr style="font-size:14px;" id="headerPaises">

                                    <tr>
                                </thead>
                                <tbody id="tbody">
                                </tbody>
                            </table>`);



                    setTimeout(() => {
                    //MES----------------------------------------------------------------------------------------------------------------------
                    const headerMeses = $("#headerMeses");
                    headerMeses.append(` <th class="text-center sticky-col bg-white border border-dark" style="width:` + widthTh + `%;" colspan="1"><span class="fs-3" id="lblPais"></span></th>
                            <th class="text-center fs-3  border border-dark bg-secondary" colspan="${countHeaders}">Enero</th>
                            <th class="text-center fs-3  border border-dark text-danger" colspan="${countHeaders}">Febrero</th>
                            <th class="text-center fs-3  border border-dark bg-secondary" colspan="${countHeaders}">Marzo</th>
                            <th class="text-center fs-3  border border-dark text-danger" colspan="${countHeaders}">Abril</th>
                            <th class="text-center fs-3  border border-dark bg-secondary" colspan="${countHeaders}">Mayo</th>
                            <th class="text-center fs-3  border border-dark text-danger" colspan="${countHeaders}">Junio</th>
                            <th class="text-center fs-3  border border-dark bg-secondary" colspan="${countHeaders}">Julio</th>
                            <th class="text-center fs-3  border border-dark text-danger" colspan="${countHeaders}">Agosto</th>
                            <th class="text-center fs-3  border border-dark bg-secondary" colspan="${countHeaders}">Septiembre</th>
                            <th class="text-center fs-3  border border-dark text-danger" colspan="${countHeaders}">Octubre</th>
                            <th class="text-center fs-3  border border-dark bg-secondary" colspan="${countHeaders}">Noviembre</th>
                            <th class="text-center fs-3  border border-dark text-danger" colspan="${countHeaders} ">Diciembre</th>
                            <th class="text-center fs-3  border border-dark bg-secondary" colspan="1">Totales</th>`);
                    const header = $("#headerPaises");
                    if (arrayCountries.length>1) {
                        header.append('<th></th>');
                            for (let i = 1; i <= 12; i++) {
                                header.append(headersTh);
                            }
                        header.append(`<th class="text-start responsive-font-example"></th>`);
                    }else{
                        switch (arrayCountries[0]) {
                            case 1:
                                $("#lblPais").text("HONDURAS");
                                break;
                            case 3:
                                $("#lblPais").text("GUATEMALA");
                               break;
                            case 4:
                                $("#lblPais").text("EL SALVADOR");
                                break;
                            case 5:
                                $("#lblPais").text("COSTA RICA");
                                break;
                            case 6:
                                $("#lblPais").text("NICARAGUA");
                                break;
                            case 19:
                                $("#lblPais").text("REP. DOMINICANA");
                                break;
                        }

                    }

                        const tbody = $("#tbody");
                        //REGISTROS----------------------------------------------------------------------------------------------------------------------
                        var arrayRegistros = ['PROGRAMAS LEALTAD NUEVOS',
                            'ACTUALIZADOS A PROGRAMA LEALTAD',
                            'TOTAL DE CLIENTES EN EL PROGRAMA DE LEALTAD',
                            'CLIENTES VIP',
                            'CLIENTES NORMALES',
                            'TOTAL REGISTROS DEL MES',
                            'ACUMULADOS PROGRAMA LEALTAD',
                            'ACUMULADOS VIP',
                            'ACUMULADOS NORMALES'
                        ];
                        var rowtd = "";
                        var urlRegistros = "/API.LovablePHP/ZLO0017P/PaisesR/?anio=" +yearSelected+"&tiendas="+arrayCountries.toString()+"";
                        var responseRegistros = ajaxRequest(urlRegistros);
                        tbody.append(`<tr class="border border-dark">
                                            <td colspan="1" class="bg-dark text-white fw-bold text-center sticky-col">REGISTROS</td>
                                            <td colspan="${widthRow}" class="bg-dark"></td>
                                        </tr>`);
                        //var backgroundColor = ['#F4E8FF', '#EED4FF', '#E8C1FF', '#D2A8FF','#CDB4FF','#C0A1FF'];
                        var backgroundColor = ['#F4E8FF', '#F4E8FF', '#F4E8FF', '#EED4FF', '#EED4FF', '#EED4FF', '#E8C1FF',
                            '#E8C1FF', '#E8C1FF'
                        ];
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
                                arrayCountries.forEach(codpai => {
                                    datosRow1[mes][codpai] = 0;
                                    datosRow2[mes][codpai] = 0;
                                    datosRow3[mes][codpai] = 0;
                                    datosRow4[mes][codpai] = 0;
                                    datosRow5[mes][codpai] = 0;
                                    datosRow6[mes][codpai] = 0;
                                    datosRow7[mes][codpai] = 0;
                                    datosRow8[mes][codpai] = 0;
                                    datosRow9[mes][codpai] = 0;
                                });
                            }
                            data.forEach(dato => {
                                //ROW1
                                datosRow1[dato.MESPRO][dato.CODPAI] = parseInt(dato.CLINUE);
                                //ROW2
                                datosRow2[dato.MESPRO][dato.CODPAI] = parseInt(dato.CLIVIE);
                                //ROW3
                                datosRow3[dato.MESPRO][dato.CODPAI] = parseInt(dato.TOTCLI);
                                //ROW4
                                datosRow4[dato.MESPRO][dato.CODPAI] = parseInt(dato.CLIVIP);
                                //ROW5
                                datosRow5[dato.MESPRO][dato.CODPAI] = parseInt(dato.CLINOR);
                                //ROW6
                                datosRow6[dato.MESPRO][dato.CODPAI] = parseInt(dato.TOTMES);
                                //ROW7
                                datosRow7[dato.MESPRO][dato.CODPAI] = parseInt(dato.ACULEA);
                                //ROW8
                                datosRow8[dato.MESPRO][dato.CODPAI] = parseInt(dato.ACUVIP);
                                //ROW9
                                datosRow9[dato.MESPRO][dato.CODPAI] = parseInt(dato.ACUNOR);
                            });
                            var rowIndex = 1;
                            for (let k = 0; k < arrayRegistros.length; k++) {
                                rowtd += '<tr class="border border-dark" style="background-color: ' + backgroundColor[k] +
                                    '; height:50px;">';
                                rowtd +=
                                    '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: ' +
                                    backgroundColor[k] + '">' + arrayRegistros[k] + '</td>';
                                var totalRow = 0;
                                switch (rowIndex) {
                                    case 1:
                                        Object.keys(datosRow1).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow1[mes][codpai] != 0 ? datosRow1[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 0,
                                                        maximumFractionDigits: 0
                                                    }) : '‎') + '</td>';
                                                totalRow += parseInt(datosRow1[mes][codpai] || '0');
                                            });
                                        });
                                        break;
                                    case 2:
                                        Object.keys(datosRow2).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow2[mes][codpai] != 0 ? datosRow2[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 0,
                                                        maximumFractionDigits: 0
                                                    }) : '‎') + '</td>';
                                                totalRow += parseInt(datosRow2[mes][codpai] || '0');
                                            });
                                        });
                                        break;
                                    case 3:
                                        Object.keys(datosRow3).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow3[mes][codpai] != 0 ? datosRow3[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 0,
                                                        maximumFractionDigits: 0
                                                    }) : '‎') + '</td>';
                                                totalRow += parseInt(datosRow3[mes][codpai] || '0');
                                                prolea += parseInt(datosRow3[mes][codpai] || '0');
                                            });
                                        });
                                        break;
                                    case 4:
                                        Object.keys(datosRow4).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow4[mes][codpai] != 0 ? datosRow4[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 0,
                                                        maximumFractionDigits: 0
                                                    }) : '‎') + '</td>';
                                                totalRow += parseInt(datosRow4[mes][codpai] || '0');
                                                provip += parseInt(datosRow4[mes][codpai] || '0');
                                            });
                                        });
                                        break;
                                    case 5:
                                        Object.keys(datosRow5).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow5[mes][codpai] != 0 ? datosRow5[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 0,
                                                        maximumFractionDigits: 0
                                                    }) : '‎') + '</td>';
                                                totalRow += parseInt(datosRow5[mes][codpai] || '0');
                                                pronor += parseInt(datosRow5[mes][codpai] || '0');
                                            });
                                        });
                                        break;
                                    case 6:
                                        Object.keys(datosRow6).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow6[mes][codpai] != 0 ? datosRow6[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 0,
                                                        maximumFractionDigits: 0
                                                    }) : '‎') + '</td>';
                                                totalRow += parseInt(datosRow6[mes][codpai] || '0');
                                            });
                                        });
                                        break;
                                    case 7:
                                        Object.keys(datosRow7).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow7[mes][codpai] != 0 ? datosRow7[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 0,
                                                        maximumFractionDigits: 0
                                                    }) : '‎') + '</td>';
                                                    if (datosRow7[mes][codpai] != 0) {
                                                        totalRow = acumularFila(datosRow7[mes]);
                                                    }
                                            });
                                        });
                                        break;
                                    case 8:
                                        Object.keys(datosRow8).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow8[mes][codpai] != 0 ? datosRow8[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 0,
                                                        maximumFractionDigits: 0
                                                    }) : '‎') + '</td>';
                                                    if (datosRow8[mes][codpai] != 0) {
                                                        totalRow = acumularFila(datosRow8[mes]);
                                                    }
                                            });
                                        });
                                        break;
                                    case 9:
                                        Object.keys(datosRow9).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow9[mes][codpai] != 0 ? datosRow9[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 0,
                                                        maximumFractionDigits: 0
                                                    }) : '‎') + '</td>';
                                                    if (datosRow9[mes][codpai] != 0) {
                                                        totalRow = acumularFila(datosRow9[mes]);
                                                    }
                                            });
                                        });
                                        break;
                                    default:
                                        rowtd += '<td class="text-end fontM border border-dark">0</td>';
                                        break;
                                }
                                if (totalRow != 0) {
                                    rowtd += '<td class="text-end fontM border border-dark">' + totalRow.toLocaleString(
                                        'es-419', {
                                            minimumFractionDigits: 0,
                                            maximumFractionDigits: 0
                                        }) + '</td>';
                                } else {
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
                                for (let i = 0; i < widthRow; i++) {
                                    rowtd += '<td class="text-end fontM border border-dark"> </td>';
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
                        var urlTransacciones = "/API.LovablePHP/ZLO0017P/PaisesT/?anio=" + yearSelected +"&tiendas="+arrayCountries.toString()+"";
                        var responseTransacciones = ajaxRequest(urlTransacciones);
                        tbody.append(`<tr><td colspan='${widthRow}'></td></tr>
                                        <tr class="border border-dark">
                                            <td colspan="1" class="bg-dark text-white fw-bold text-center sticky-col">TRANSACCIONES</td>
                                            <td colspan="${widthRow}" class="bg-dark"></td>
                                        </tr>
                                        <tr><td colspan='${widthRow}'></td></tr>`);
                        var backgroundColor = ['#DAEFFB', '#DAEFFB', '#DAEFFB', '#BFECE0', '#BFECE0', '#BFECE0', '#BFECE0',
                            '#ADEAAE', '#ADEAAE', '#9BE88C', '#9BE88C', '#9BE88C'
                        ];
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
                                arrayCountries.forEach(codpai => {
                                    datosRow1[mes][codpai] = 0;
                                    datosRow2[mes][codpai] = 0;
                                    datosRow3[mes][codpai] = 0;
                                    datosRow4[mes][codpai] = 0;
                                    datosRow5[mes][codpai] = 0;
                                    datosRow6[mes][codpai] = 0;
                                    datosRow7[mes][codpai] = 0;
                                    datosRow8[mes][codpai] = 0;
                                    datosRow9[mes][codpai] = 0;
                                    datosRow10[mes][codpai] = 0;
                                    datosRow11[mes][codpai] = 0;
                                    datosRow12[mes][codpai] = 0;
                                });
                            }
                            data.forEach(dato => {
                                //ROW1
                                datosRow1[dato.MESPRO][dato.CODPAI] = parseInt(dato.TRANUE);
                                //ROW2
                                datosRow2[dato.MESPRO][dato.CODPAI] = parseInt(dato.TRAVIE);
                                //ROW3
                                datosRow3[dato.MESPRO][dato.CODPAI] = parseInt(dato.TOTLEA);
                                //ROW4
                                datosRow4[dato.MESPRO][dato.CODPAI] = parseInt(dato.TRAVIP);
                                //ROW5
                                datosRow5[dato.MESPRO][dato.CODPAI] = parseInt(dato.TRANOR);
                                //ROW6
                                datosRow6[dato.MESPRO][dato.CODPAI] = parseInt(dato.TOTTRA);
                                //ROW7
                                datosRow7[dato.MESPRO][dato.CODPAI] = parseFloat(dato.PORLEA);
                                //ROW8
                                datosRow8[dato.MESPRO][dato.CODPAI] = parseFloat(dato.PORVIP);
                                //ROW9
                                datosRow9[dato.MESPRO][dato.CODPAI] = parseFloat(dato.PORNOR);
                                //ROW10
                                datosRow10[dato.MESPRO][dato.CODPAI] = parseFloat(dato.TACULE);
                                //ROW11
                                datosRow11[dato.MESPRO][dato.CODPAI] = parseFloat(dato.TACUVI);
                                //ROW12
                                datosRow12[dato.MESPRO][dato.CODPAI] = parseFloat(dato.TACUNO);
                            });
                            var rowIndex = 1;
                            for (let k = 0; k < arrayTransacciones.length; k++) {
                                rowtd += '<tr class="border border-dark" style="background-color: ' + backgroundColor[k] +
                                    '; height:50px;">';
                                rowtd +=
                                    '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: ' +
                                    backgroundColor[k] + '">' + arrayTransacciones[k] + '</td>';
                                var totalRow = 0;
                                switch (rowIndex) {
                                    case 1:
                                        Object.keys(datosRow1).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow1[mes][codpai] != 0 ? datosRow1[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 0,
                                                        maximumFractionDigits: 0
                                                    }) : '‎') + '</td>';
                                                totalRow += parseInt(datosRow1[mes][codpai] || '0');
                                                tranue += parseInt(datosRow1[mes][codpai] || '0');
                                            });
                                        });
                                        break;
                                    case 2:
                                        Object.keys(datosRow2).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow2[mes][codpai] != 0 ? datosRow2[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 0,
                                                        maximumFractionDigits: 0
                                                    }) : '‎') + '</td>';
                                                totalRow += parseInt(datosRow2[mes][codpai] || '0');
                                                travie += parseInt(datosRow2[mes][codpai] || '0');
                                            });
                                        });
                                        break;
                                    case 3:
                                        Object.keys(datosRow3).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow3[mes][codpai] != 0 ? datosRow3[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 0,
                                                        maximumFractionDigits: 0
                                                    }) : '‎') + '</td>';
                                                totalRow += parseInt(datosRow3[mes][codpai] || '0');
                                                tralea += parseInt(datosRow3[mes][codpai] || '0');
                                            });
                                        });
                                        break;
                                    case 4:
                                        Object.keys(datosRow4).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow4[mes][codpai] != 0 ? datosRow4[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 0,
                                                        maximumFractionDigits: 0
                                                    }) : '‎') + '</td>';
                                                totalRow += parseInt(datosRow4[mes][codpai] || '0');
                                                travip += parseInt(datosRow4[mes][codpai] || '0');
                                            });
                                        });
                                        break;
                                    case 5:
                                        Object.keys(datosRow5).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow5[mes][codpai] != 0 ? datosRow5[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 0,
                                                        maximumFractionDigits: 0
                                                    }) : '‎') + '</td>';
                                                totalRow += parseInt(datosRow5[mes][codpai] || '0');
                                                tranor += parseInt(datosRow5[mes][codpai] || '0');
                                            });
                                        });
                                        break;
                                    case 6:
                                        Object.keys(datosRow6).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow6[mes][codpai] != 0 ? datosRow6[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 0,
                                                        maximumFractionDigits: 0
                                                    }) : '‎') + '</td>';
                                                totalRow += parseInt(datosRow6[mes][codpai] || '0');
                                                totaltransacciones += parseInt(datosRow6[mes][codpai] || '0');
                                            });
                                        });
                                        break;
                                    case 7:
                                        Object.keys(datosRow7).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow7[mes][codpai] != 0 ? datosRow7[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 2,
                                                        maximumFractionDigits: 2
                                                    }) + '%' : '‎') + '</td>';
                                                totalRow = 0;
                                                if (prolea != 0) {
                                                    totalRow = tralea / prolea;
                                                }
                                            });
                                        });
                                        break;
                                    case 8:
                                        Object.keys(datosRow8).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow8[mes][codpai] != 0 ? datosRow8[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 2,
                                                        maximumFractionDigits: 2
                                                    }) + '%' : '‎') + '</td>';
                                                totalRow = 0;
                                                if (provip != 0) {
                                                    totalRow = travip / provip;
                                                }
                                            });
                                        });
                                        break;
                                    case 9:
                                        Object.keys(datosRow9).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow9[mes][codpai] != 0 ? datosRow9[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 2,
                                                        maximumFractionDigits: 2
                                                    }) + '%' : '‎') + '</td>';
                                                totalRow = 0;
                                                if (pronor != 0) {
                                                    totalRow = tranor / pronor;
                                                }
                                            });
                                        });
                                        break;
                                    case 10:
                                        Object.keys(datosRow10).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow10[mes][codpai] != 0 ? datosRow10[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 0,
                                                        maximumFractionDigits: 0
                                                    }) : '‎') + '</td>';
                                                    if (datosRow10[mes][codpai] != 0) {
                                                        totalRow = acumularFila(datosRow10[mes]);
                                                    }
                                            });
                                        });
                                        break;
                                    case 11:
                                        Object.keys(datosRow11).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow11[mes][codpai] != 0 ? datosRow11[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 0,
                                                        maximumFractionDigits: 0
                                                    }) : '‎') + '</td>';
                                                    if (datosRow11[mes][codpai] != 0) {
                                                        totalRow = acumularFila(datosRow11[mes]);
                                                    }
                                            });
                                        });
                                        break;
                                    case 12:
                                        Object.keys(datosRow12).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow12[mes][codpai] != 0 ? datosRow12[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 0,
                                                        maximumFractionDigits: 0
                                                    }) : '‎') + '</td>';
                                                    if (datosRow12[mes][codpai] != 0) {
                                                        totalRow = acumularFila(datosRow12[mes]);
                                                    }
                                            });
                                        });
                                        break;
                                    default:
                                        rowtd += '<td class="text-end fontM border border-dark">0</td>';
                                        break;
                                }
                                if (totalRow == 0) {
                                    rowtd += '<td class="text-end fontM border border-dark"></td>';
                                } else {
                                    if (rowIndex == 7 || rowIndex == 8 || rowIndex == 9) {
                                        rowtd += '<td class="text-end fontM border border-dark">' + totalRow.toLocaleString(
                                            'es-419', {
                                                minimumFractionDigits: 2,
                                                maximumFractionDigits: 2
                                            }) + '%</td>';

                                    } else {
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
                                for (let i = 0; i < widthRow; i++) {
                                    rowtd += '<td class="text-end fontM border border-dark"> </td>';
                                }
                                rowtd += '<td class="text-end fontM border border-dark"> </td>';
                                rowtd += '</tr>';
                            }
                        }
                        tbody.append(rowtd);

                        //PORCENTAJE TRANSACCIONES----------------------------------------------------------------------------------------------------------------------
                        var arrayPorTransacciones = [
                            '% DE TRANSACCIONES CON NUEVOS REGISTROS VS TOTAL DE TRANSACCIONES',
                            '% DE TRANSACCIONES CON ACTUALIZACION  DE DATOS VS TOTAL DE TRANSACCIONES',
                            '% DE TRANSACCIONES DE PROGRAMA LEALTAD',
                            '% DE TRANSACCIONES DE CLIENTES VIP',
                            '% DE TRANSACCIONES DE CLIENTES NORMALES'
                        ];
                        var rowtd = "";
                        var urlPTransacciones = " /API.LovablePHP/ZLO0017P/PaisesPT/?anio=" + yearSelected +"&tiendas="+arrayCountries.toString()+"";
                        var responsePTransacciones = ajaxRequest(urlPTransacciones);
                        tbody.append(`<tr><td colspan='${widthRow+2}'></td></tr>
                                        <tr class="border border-dark">
                                            <td colspan="1" class="bg-dark text-white fw-bold text-center sticky-col">PORCENTAJES  DE TRANSACCIONES</td>
                                            <td colspan="${widthRow+1}" class="bg-dark"></td>
                                        </tr>
                                        <tr><td colspan='${widthRow+2}'></td></tr>`);
                        var backgroundColor = ['#FBFFCC', '#FAFF99', '#F9FF66', '#F8FF33', '#F7FF00'];
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
                                arrayCountries.forEach(codpai => {
                                    datosRow1[mes][codpai] = 0;
                                    datosRow2[mes][codpai] = 0;
                                    datosRow3[mes][codpai] = 0;
                                    datosRow4[mes][codpai] = 0;
                                    datosRow5[mes][codpai] = 0;
                                });
                            }
                            data.forEach(dato => {
                                //ROW1
                                datosRow1[dato.MESPRO][dato.CODPAI] = parseFloat(dato.PORCE6);
                                //ROW2
                                datosRow2[dato.MESPRO][dato.CODPAI] = parseFloat(dato.PORCE7);
                                //ROW3
                                datosRow3[dato.MESPRO][dato.CODPAI] = parseFloat(dato.PORCE8);
                                //ROW4
                                datosRow4[dato.MESPRO][dato.CODPAI] = (parseFloat(dato.TRAVIP) / parseFloat(dato
                                    .TOTTRA)) * 100;
                                //ROW5
                                datosRow5[dato.MESPRO][dato.CODPAI] = (parseFloat(dato.TRANOR) / parseFloat(dato
                                    .TOTTRA)) * 100;
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
                                        Object.keys(datosRow1).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow1[mes][codpai] != 0 ? datosRow1[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 2,
                                                        maximumFractionDigits: 2
                                                    }) + '%' : '‎') + '</td>';
                                                totalRow = 0;
                                                if (totaltransacciones != 0) {
                                                    totalRow = (tranue / totaltransacciones) * 100;
                                                }
                                            });
                                        });
                                        break;
                                    case 2:
                                        Object.keys(datosRow2).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow2[mes][codpai] != 0 ? datosRow2[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 2,
                                                        maximumFractionDigits: 2
                                                    }) + '%' : '‎') + '</td>';
                                                totalRow = 0;
                                                if (totaltransacciones != 0) {
                                                    totalRow = (travie / totaltransacciones) * 100;
                                                }
                                            });
                                        });
                                        break;
                                    case 3:
                                        Object.keys(datosRow3).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow3[mes][codpai] != 0 ? datosRow3[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 2,
                                                        maximumFractionDigits: 2
                                                    }) + '%' : '‎') + '</td>';
                                                totalRow = 0;
                                                if (totaltransacciones != 0) {
                                                    totalRow = (tralea / totaltransacciones) * 100;
                                                }
                                            });
                                        });
                                        break;
                                    case 4:
                                        Object.keys(datosRow4).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + ((
                                                        datosRow4[mes][codpai] != 0 && !isNaN(datosRow4[mes]
                                                            [codpai])) ? datosRow4[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 2,
                                                        maximumFractionDigits: 2
                                                    }) + '%' : '‎') + '</td>';
                                                totalRow = 0;
                                                if (totaltransacciones != 0) {
                                                    totalRow = (travip / totaltransacciones) * 100;
                                                }
                                            });
                                        });
                                        break;
                                    case 5:
                                        Object.keys(datosRow5).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + ((
                                                        datosRow5[mes][codpai] != 0 && !isNaN(datosRow5[mes]
                                                            [codpai])) ? datosRow5[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 2,
                                                        maximumFractionDigits: 2
                                                    }) + '%' : '‎') + '</td>';
                                                totalRow = 0;
                                                if (totaltransacciones != 0) {
                                                    totalRow = (tranor / totaltransacciones) * 100;
                                                }
                                            });
                                        });
                                        break;
                                    default:
                                        rowtd += '<td class="text-end fontM border border-dark">0</td>';
                                        break;
                                }
                                if (totalRow == 0) {
                                    rowtd += '<td class="text-end fontM border border-dark"></td>';
                                } else {
                                    rowtd += '<td class="text-end fontM border border-dark">' + totalRow.toLocaleString(
                                        'es-419', {
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
                                for (let i = 0; i < widthRow; i++) {
                                    rowtd += '<td class="text-end fontM border border-dark"> </td>';
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
                        var urlDesglose = "/API.LovablePHP/ZLO0017P/PaisesD/?anio=" + yearSelected +"&tiendas="+arrayCountries.toString()+"";
                        var responseDesglose = ajaxRequest(urlDesglose);
                        tbody.append(`<tr><td colspan='${widthRow+2}'></td></tr>
                                        <tr class="border border-dark">
                                            <td colspan="1" class="bg-dark text-white fw-bold text-center sticky-col">DESGLOSE DEL TIPO DE INFORMACION QUE EL CLIENTE PROPORCIONA</td>
                                            <td colspan="${widthRow+1}" class="bg-dark"></td>
                                        </tr>
                                        <tr><td colspan='${widthRow+2}'></td></tr>`);
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
                                arrayCountries.forEach(codpai => {
                                    datosRow1[mes][codpai] = 0;
                                    datosRow2[mes][codpai] = 0;
                                    datosRow3[mes][codpai] = 0;
                                    datosRow4[mes][codpai] = 0;
                                    datosRow5[mes][codpai] = 0;
                                    datosRow6[mes][codpai] = 0;
                                    datosRow7[mes][codpai] = 0;
                                });
                            }
                            data.forEach(dato => {
                                //ROW1
                                datosRow1[dato.MESPRO][dato.CODPAI] = parseFloat(dato.TOTCLI);
                                //ROW2
                                datosRow2[dato.MESPRO][dato.CODPAI] = parseFloat(dato.MAILTE);
                                //ROW3
                                datosRow3[dato.MESPRO][dato.CODPAI] = parseFloat(dato.PORCE3);
                                //ROW4
                                datosRow4[dato.MESPRO][dato.CODPAI] = parseFloat(dato.TELEFO);
                                //ROW5
                                datosRow5[dato.MESPRO][dato.CODPAI] = parseFloat(dato.PORCE5);
                                //ROW6
                                datosRow6[dato.MESPRO][dato.CODPAI] = parseFloat(dato.EMAIL);
                                //ROW7
                                datosRow7[dato.MESPRO][dato.CODPAI] = parseFloat(dato.PORCE4);
                            });
                            var rowIndex = 1;
                            for (let k = 0; k < arrayDesglose.length; k++) {
                                rowtd += '<tr class="border border-dark" style="background-color: ' + backgroundColor[k] +
                                    '; height:50px;">';
                                rowtd +=
                                    '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: ' +
                                    backgroundColor[k] + '">' + arrayDesglose[k] + '</td>';
                                var totalRow = 0;
                                switch (rowIndex) {
                                    case 1:
                                        Object.keys(datosRow1).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow1[mes][codpai] != 0 ? datosRow1[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 0,
                                                        maximumFractionDigits: 0
                                                    }) : '‎') + '</td>';
                                                totalRow += parseInt(datosRow1[mes][codpai] || '0');
                                                contotal += parseInt(datosRow1[mes][codpai] || '0');
                                            });
                                        });
                                        break;
                                    case 2:
                                        Object.keys(datosRow2).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow2[mes][codpai] != 0 ? datosRow2[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 0,
                                                        maximumFractionDigits: 0
                                                    }) : '‎') + '</td>';
                                                totalRow += parseInt(datosRow2[mes][codpai] || '0');
                                                conmailte += parseInt(datosRow2[mes][codpai] || '0');

                                            });
                                        });
                                        break;
                                    case 3:
                                        Object.keys(datosRow3).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow3[mes][codpai] != 0 ? datosRow3[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 2,
                                                        maximumFractionDigits: 2
                                                    }) + '%' : '‎') + '</td>';
                                                totalRow = 0;
                                                if (contotal != 0) {
                                                    totalRow = (conmailte / contotal) * 100;
                                                }
                                            });
                                        });
                                        break;
                                    case 4:
                                        Object.keys(datosRow4).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow4[mes][codpai] != 0 ? datosRow4[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 0,
                                                        maximumFractionDigits: 0
                                                    }) : '‎') + '</td>';
                                                totalRow += parseInt(datosRow4[mes][codpai] || '0');
                                                contelefono += parseInt(datosRow4[mes][codpai] || '0');

                                            });
                                        });
                                        break;
                                    case 5:
                                        Object.keys(datosRow5).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow5[mes][codpai] != 0 ? datosRow5[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 2,
                                                        maximumFractionDigits: 2
                                                    }) + '%' : '‎') + '</td>';
                                                totalRow = 0;
                                                if (contotal != 0) {
                                                    totalRow = (contelefono / contotal) * 100;
                                                }
                                            });
                                        });
                                        break;
                                    case 6:
                                        Object.keys(datosRow6).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow6[mes][codpai] != 0 ? datosRow6[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 0,
                                                        maximumFractionDigits: 0
                                                    }) : '‎') + '</td>';
                                                totalRow += parseInt(datosRow6[mes][codpai] || '0');
                                                conemail += parseInt(datosRow6[mes][codpai] || '0');

                                            });
                                        });
                                        break;
                                    case 7:
                                        Object.keys(datosRow7).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow7[mes][codpai] != 0 ? datosRow7[mes][codpai]
                                                    .toLocaleString('es-419', {
                                                        minimumFractionDigits: 2,
                                                        maximumFractionDigits: 2
                                                    }) + '%' : '‎') + '</td>';
                                                totalRow = 0;
                                                if (contotal != 0) {
                                                    totalRow = (conemail / contotal) * 100;
                                                }
                                            });
                                        });
                                        break;
                                    default:
                                        rowtd += '<td class="text-end fontM border border-dark">0</td>';
                                        break;
                                }
                                if (totalRow == 0) {
                                    rowtd += '<td class="text-end fontM border border-dark"></td>';
                                } else {
                                    if (k == 2 || k == 4 || k == 6) {
                                        rowtd += '<td class="text-end fontM border border-dark">' + totalRow.toLocaleString(
                                            'es-419', {
                                                minimumFractionDigits: 2,
                                                maximumFractionDigits: 2
                                            }) + '%</td>';
                                    } else {
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
                                for (let i = 0; i < widthRow; i++) {
                                    rowtd += '<td class="text-end fontM border border-dark"> </td>';
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
                        var urlTicket = "/API.LovablePHP/ZLO0017P/PaisesTC/?anio=" + yearSelected +"&tiendas="+arrayCountries.toString()+"";
                        var responseTicket = ajaxRequest(urlTicket);
                        tbody.append(`<tr><td colspan='${widthRow+2}'></td></tr>
                                        <tr class="border border-dark">
                                            <td colspan="1" class="bg-dark text-white fw-bold text-center sticky-col">TICKET PROMEDIO</td>
                                            <td colspan="${widthRow+1}" class="bg-dark"></td>
                                        </tr>
                                        <tr><td colspan='${widthRow+2}'></td></tr>`);
                        var backgroundColor = ['#FFE0CC', '#FFD199', '#FFD199', '#FFC266'];
                        if (responseTicket.code == 200) {
                            let data = responseTicket.data;
                            let datosRow1 = {};
                            let datosRow2 = {};
                            let datosRow3 = {};
                            let datosRow4 = {};
                            let datosVallea = {};
                            let datosValvip = {};
                            let datosValnor = {};
                            let datosValtot = {};
                            for (let mes = 1; mes <= 12; mes++) {
                                datosRow1[mes] = {};
                                datosRow2[mes] = {};
                                datosRow3[mes] = {};
                                datosRow4[mes] = {};
                                datosVallea[mes] = {};
                                datosValvip[mes] = {};
                                datosValnor[mes] = {};
                                datosValtot[mes] = {};
                                arrayCountries.forEach(codpai => {
                                    datosRow1[mes][codpai] = 0;
                                    datosRow2[mes][codpai] = 0;
                                    datosRow3[mes][codpai] = 0;
                                    datosRow4[mes][codpai] = 0;
                                    datosVallea[mes][codpai] = 0;
                                    datosValvip[mes][codpai] = 0;
                                    datosValnor[mes][codpai] = 0;
                                    datosValtot[mes][codpai] = 0;
                                });
                            }
                            data.forEach(dato => {
                                //ROW1
                                datosRow1[dato.MESPRO][dato.CODPAI] = parseFloat(dato.PORVLE);
                                //ROW2
                                datosRow2[dato.MESPRO][dato.CODPAI] = parseFloat(dato.PORVVI);
                                //ROW3
                                datosRow3[dato.MESPRO][dato.CODPAI] = parseFloat(dato.PORVNO);
                                //ROW3
                                datosRow4[dato.MESPRO][dato.CODPAI] = parseFloat(dato.PORVTO);

                                datosVallea[dato.MESPRO][dato.CODPAI] = parseFloat(dato.VALLEA);
                                datosValvip[dato.MESPRO][dato.CODPAI] = parseFloat(dato.VALVIP);
                                datosValnor[dato.MESPRO][dato.CODPAI] = parseFloat(dato.VALNOR);
                                datosValtot[dato.MESPRO][dato.CODPAI] = parseFloat(dato.VALTOT);
                            });
                            var rowIndex = 1;
                            for (let k = 0; k < arrayTicket.length; k++) {
                                rowtd += '<tr class="border border-dark" style="background-color: ' + backgroundColor[k] +
                                    '; height:50px;">';
                                rowtd +=
                                    '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: ' +
                                    backgroundColor[k] + '">' + arrayTicket[k] + '</td>';
                                var totalRowVal = 0;
                                var totalMes = 0;
                                switch (rowIndex) {
                                    case 1:
                                        Object.keys(datosRow1).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow1[mes][codpai] != 0 ? 'D.' + datosRow1[mes][
                                                        codpai
                                                    ].toLocaleString('es-419', {
                                                        minimumFractionDigits: 2,
                                                        maximumFractionDigits: 2
                                                    }) : '‎') + '</td>';
                                                totalRow += parseInt(datosRow1[mes][codpai] || '0');
                                                totalRowVal += parseInt(datosVallea[mes][codpai] || '0');
                                                totalRowTra = tralea;
                                            });
                                        });
                                        break;
                                    case 2:
                                        Object.keys(datosRow2).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow2[mes][codpai] != 0 ? 'D.' + datosRow2[mes][
                                                        codpai
                                                    ].toLocaleString('es-419', {
                                                        minimumFractionDigits: 2,
                                                        maximumFractionDigits: 2
                                                    }) : '‎') + '</td>';
                                                totalRow += parseInt(datosRow2[mes][codpai] || '0');
                                                totalRowVal += parseInt(datosValvip[mes][codpai] || '0');
                                                totalRowTra = travip;
                                            });
                                        });
                                        break;
                                    case 3:
                                        Object.keys(datosRow3).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow3[mes][codpai] != 0 ? 'D.' + datosRow3[mes][
                                                        codpai
                                                    ].toLocaleString('es-419', {
                                                        minimumFractionDigits: 2,
                                                        maximumFractionDigits: 2
                                                    }) : '‎') + '</td>';
                                                totalRow += parseInt(datosRow3[mes][codpai] || '0');
                                                totalRowVal += parseInt(datosValnor[mes][codpai] || '0');
                                                totalRowTra = tranor;
                                            });
                                        });
                                        break;
                                    case 4:
                                        Object.keys(datosRow4).forEach(mes => {
                                            arrayCountries.forEach(codpai => {
                                                rowtd += '<td class="text-end fontM border border-dark">' + (
                                                    datosRow4[mes][codpai] != 0 ? 'D.' + datosRow4[mes][
                                                        codpai
                                                    ].toLocaleString('es-419', {
                                                        minimumFractionDigits: 2,
                                                        maximumFractionDigits: 2
                                                    }) : '‎') + '</td>';
                                                totalRow += parseInt(datosRow4[mes][codpai] || '0');
                                                totalRowVal += parseInt(datosValtot[mes][codpai] || '0');
                                                totalRowTra = tralea + travip + tranor;
                                            });
                                        });
                                        break;
                                    default:
                                        rowtd += '<td class="text-end fontM border border-dark">0</td>';
                                        break;
                                }
                                if (totalRowVal == 0) {
                                    rowtd += '<td class="text-end fontM border border-dark"></td>';
                                } else {
                                    var promedio = 0;
                                    if (totalRowTra != 0) {
                                        promedio = totalRowVal / totalRowTra;
                                    }
                                    rowtd += '<td class="text-end fontM border border-dark"> D.' + promedio.toLocaleString(
                                        'es-419', {
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
                                for (let i = 0; i < widthRow; i++) {
                                    rowtd += '<td class="text-end fontM border border-dark"> </td>';
                                }
                                rowtd += '<td class="text-end fontM border border-dark"> </td>';
                                rowtd += '</tr>';
                            }
                        }
                        tbody.append(rowtd);

                        //TIENDAS----------------------------------------------------------------------------------------------------------------------

                        var arrayTiendas = ['NUMERO DE TIENDAS'];
                        var urlTiendas = "/API.LovablePHP/ZLO0017P/PaisesTiendas/?tiendas="+arrayCountries.toString()+"";
                            var responseTiendas = ajaxRequest(urlTiendas);
                            if (responseTiendas.code == 200) {
                                let data = responseTiendas.data;
                                tbody.append(`<tr><td colspan='${widthRow+2}'></td></tr>`);
                                tbody.append(`<tr class="border border-dark">
                                                <td colspan="1" class="bg-dark text-white fw-bold text-center"></td>
                                                <td colspan="${widthRow+1}" class="bg-dark"></td>
                                            </tr>`);
                                tbody.append(`<tr><td colspan='${widthRow+2}'></td></tr>`);
                                var rowtd = "";
                                var suma = 0;
                                for (let i = arrayTiendas.length - 1; i >= 0; i--) {
                                    let row = "";
                                    for (let j = 1; j <= 12; j++) {
                                        for (let k = 0; k < arrayCountries.length; k++) {
                                            row += `<td class="text-end fontM border border-dark">${data[k].COUNT}</td>`;
                                        }
                                    }
                                    for (let k = 0; k < arrayCountries.length; k++) {
                                        suma+=parseInt(data[k].COUNT);
                                    }
                                    rowtd +=
                                        `<tr class="border border-dark bg-secondary" style="height:50px;"><td class="text-center align-middle fontS border border-dark sticky-col bg-secondary">${arrayTiendas[i]}</td>${row}<td class="text-end fontM border border-dark">${suma}</td></tr>`;
                                }
                                tbody.append(rowtd);
                            }
                    }, 1);
                    if (data.acceso==0) {
                    $("#body-page").empty();
                    $("#body-page").append('<div class="text-center p-5 fs-3 m-5" style="height:600px;"><div class="border border-1 rounded p-5 m-5"><i class="fa-solid fa-question fa-fade fa-2xl mb-4"></i><br /> No hay contenido para mostrar.</div></div>');
                    $("#exportExcel").addClass("d-none");
                    }
                }
            });
    });

    function acumularFila(array) {
        let suma=0;
        for (let i = 0; i < arrayCountries.length; i++) {
            suma += parseFloat(array[arrayCountries[i]]);
        }
        return suma;
    }
    </script>
    <!-- <script src="../../assets/js/PRG/ZPL/ZLO0017P.js"></script>-->
</body>

</html>