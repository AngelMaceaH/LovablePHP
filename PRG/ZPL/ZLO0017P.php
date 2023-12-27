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
        <nav aria-label="breadcrumb" style="width:100%" >
        <div class="row">
                    <div class="col-10">
                        <ol class="breadcrumb my-0 ms-2 mt-3">
                            <li class="breadcrumb-item">
                                <span>Programa Lealtad / Estádistica</span>
                            </li>
                            <li class="breadcrumb-item active"><span>ZLO0017P</span></li>
                        </ol>
                    </div>
                    <div class="col-2 d-flex">
                        <label class="form-control border border-0"  style="width: 30%;">Año:</label>
                        <select id="setYear" class="form-select fw-bold"  style="width: 70%;">
                        </select>
                    </div>
                </div>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body ">
        <div class="card m-0 p-0">
            <div class="card-body  m-0 p-0 overflow-auto table-container">
            <table  id="tableMetricas" class="table stripe table-hover " style="width:8200px;">
                            <thead class="sticky-top bg-white ">
                                <tr >
                                    <th class="text-center sticky-col" style="width:5%;" colspan="1"></th>
                                    <th class="text-center fs-3  border border-dark bg-secondary" colspan="6">Enero</th>
                                    <th class="text-center fs-3  border border-dark text-danger" colspan="6">Febrero</th>
                                    <th class="text-center fs-3  border border-dark bg-secondary" colspan="6">Marzo</th>
                                    <th class="text-center fs-3  border border-dark text-danger" colspan="6">Abril</th>
                                    <th class="text-center fs-3  border border-dark bg-secondary" colspan="6">Mayo</th>
                                    <th class="text-center fs-3  border border-dark text-danger" colspan="6">Junio</th>
                                    <th class="text-center fs-3  border border-dark bg-secondary" colspan="6">Julio</th>
                                    <th class="text-center fs-3  border border-dark text-danger" colspan="6">Agosto</th>
                                    <th class="text-center fs-3  border border-dark bg-secondary" colspan="6">Septiembre</th>
                                    <th class="text-center fs-3  border border-dark text-danger" colspan="6">Octubre</th>
                                    <th class="text-center fs-3  border border-dark bg-secondary" colspan="6">Noviembre</th>
                                    <th class="text-center fs-3  border border-dark text-danger" colspan="6">Diciembre</th>
                                    <th class="text-center fs-3  border border-dark bg-secondary" colspan="1">Totales</th>
                                </tr>
                                <tr style="font-size:14px;" id="headerPaises">
                                
                                <tr>
                            </thead>
                            <tbody id="tbody">
                            
                            </tbody>
                    </table>
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
        var yearSelected=0;
        $(document).ready(function() {
            yearSelected=getCookie('year') || 2023;
            var select = document.getElementById('setYear');
            var currentYear = new Date().getFullYear();
            for (var year = 2022; year <= currentYear; year++) {
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
            //HEADER----------------------------------------------------------------------------------------------------------------------
           const header=$("#headerPaises");
           header.append('<th></th>');
           for (let i = 1; i <=12;  i++) {
            header.append(`
                             <th class="text-center border border-dark bg-light" width="100px">HONDURAS</th>
                                <th class="text-center border border-dark bg-light"  width="100px">GUATEMALA</th>
                                <th class="text-center border border-dark bg-light"  width="100px">EL SALVADOR</th>
                                <th class="text-center border border-dark bg-light"  width="100px">COSTA RICA</th>
                                <th class="text-center border border-dark bg-light"  width="100px">NICARAGUA</th>
                                <th class="text-center border border-dark bg-light"  width="100px">REP. DOMINICANA</th>
                               `);
           } 
           header.append(`<th class="text-start responsive-font-example"></th>`);
           const tbody=$("#tbody");
           //REGISTROS----------------------------------------------------------------------------------------------------------------------
           var arrayRegistros=['NUEVOS CLIENTES REGISTRADOS AL PROGRAMA DE LEALTAD',
                          'CLIENTES QUE ACTUALIZARON DATOS DE VIP A PROGRMA DE LEALTAD',
                          'TOTAL NUEVOS CLIENTES REGISTRADOS Y/O EMIGRADOS AL PROGRAMA DE LEALTAD',
                          'TOTAL DE CLIENTES REGISTRADOS AL  PROGRAMA DE LEALTAD',
                          'CLIENTES QUE AUN ESTÁN EN STATUS VIP',
                        'CLIENTES NO INSCRITOS'];
                          
         
            var rowtd="";
            var urlRegistros="http://172.16.15.20/API.LovablePHP/ZLO0017P/PaisesR/?anio="+yearSelected+"";
            var responseRegistros=ajaxRequest(urlRegistros);
            tbody.append(`<tr class="border border-dark">
                            <td colspan="1" class="bg-dark text-white fw-bold text-center sticky-col">REGISTROS</td>
                            <td colspan="73" class="bg-dark"></td>
                        </tr>`);
            var backgroundColor = ['#F4E8FF', '#EED4FF', '#E8C1FF', '#D2A8FF','#CDB4FF','#C0A1FF'];
            if (responseRegistros.code==200) {
                let data=responseRegistros.data;
                let datosRow1 = {}; let datosRow2 = {}; let datosRow3 = {}; let datosRow4 = {}; let datosRow5 = {};let datosRow6 = {};
                for (let mes = 1; mes <= 12; mes++) {
                    datosRow1[mes] = {}; datosRow2[mes] = {}; datosRow3[mes] = {}; datosRow4[mes] = {}; datosRow5[mes] = {};datosRow6[mes] = {};
                    [1, 3, 4, 5, 6, 19].forEach(codpai => {
                        datosRow1[mes][codpai] = 0;
                        datosRow2[mes][codpai] = 0;
                        datosRow3[mes][codpai] = 0;
                        datosRow4[mes][codpai] = 0;
                        datosRow5[mes][codpai] = 0;
                        datosRow6[mes][codpai] = 0;
                    });
                }
                data.forEach(dato => {
                    //ROW1
                    datosRow1[dato.MESPRO][dato.CODPAI] = parseInt(dato.CLIVIE);
                    //ROW2
                    datosRow2[dato.MESPRO][dato.CODPAI] = parseInt(dato.CLINUE);
                    //ROW3
                    datosRow3[dato.MESPRO][dato.CODPAI] = parseInt(dato.TOTCLI);
                    //ROW4
                    datosRow4[dato.MESPRO][dato.CODPAI] = parseInt(dato.CLILEA); 
                    //ROW5
                    datosRow5[dato.MESPRO][dato.CODPAI] = parseInt(dato.CLIVIP);
                    //ROW6
                    datosRow6[dato.MESPRO][dato.CODPAI] = parseInt(dato.CLINOR);
                });
                var rowIndex=1;
                for (let k = 0; k < arrayRegistros.length; k++) {
                    rowtd+='<tr class="border border-dark" style="background-color: '+backgroundColor[k]+'; height:50px;">';
                    rowtd += '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: '+backgroundColor[k]+'">' + arrayRegistros[k] + '</td>';
                    var totalRow = 0;
                    switch (rowIndex) {
                        case 1:
                            Object.keys(datosRow1).forEach(mes => {
                        [1, 3, 4, 5, 6, 19].forEach(codpai => {
                            rowtd += '<td class="text-end fontM border border-dark">' + (datosRow1[mes][codpai]!=0 ? datosRow1[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                            totalRow += parseInt(datosRow1[mes][codpai] || '0');
                            });
                        });
                            break;
                        case 2:
                        Object.keys(datosRow2).forEach(mes => {
                            [1, 3, 4, 5, 6, 19].forEach(codpai => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow2[mes][codpai]!=0 ? datosRow2[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                totalRow += parseInt(datosRow2[mes][codpai] || '0');
                                });
                            });
                            break;
                        case 3:
                        Object.keys(datosRow3).forEach(mes => {
                            [1, 3, 4, 5, 6, 19].forEach(codpai => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow3[mes][codpai]!=0 ? datosRow3[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                totalRow += parseInt(datosRow3[mes][codpai] || '0');
                                });
                            });
                            break;
                        case 4:
                        Object.keys(datosRow4).forEach(mes => {
                            [1, 3, 4, 5, 6, 19].forEach(codpai => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow4[mes][codpai]!=0 ? datosRow4[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                totalRow += parseInt(datosRow4[mes][codpai] || '0');
                                });
                            });
                            break;
                        case 5:
                        Object.keys(datosRow5).forEach(mes => {
                            [1, 3, 4, 5, 6, 19].forEach(codpai => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow5[mes][codpai]!=0 ? datosRow5[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                totalRow += parseInt(datosRow5[mes][codpai] || '0');
                                });
                            });
                            break;
                        case 6:
                        Object.keys(datosRow5).forEach(mes => {
                            [1, 3, 4, 5, 6, 19].forEach(codpai => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow6[mes][codpai]!=0 ? datosRow6[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                totalRow += parseInt(datosRow6[mes][codpai] || '0');
                                });
                            });
                            break;
                        default:
                        rowtd += '<td class="text-end fontM border border-dark">0</td>';
                            break;
                    }
                    rowtd += '<td class="text-end fontM border border-dark">' + totalRow.toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + '</td>';
                    rowtd += '</tr>';
                    rowIndex++;
                }
                
            }else{
                    for (let k = 0; k < arrayRegistros.length; k++) {
                        rowtd+='<tr class="border border-dark" style="background-color: '+backgroundColor[k]+'; height:50px;">';
                        rowtd += '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: '+backgroundColor[k]+'">' + arrayRegistros[k] + '</td>';
                        for (let i = 0; i < 72; i++) {
                            rowtd += '<td class="text-end fontM border border-dark"> </td>';
                        }
                        rowtd += '<td class="text-end fontM border border-dark"> </td>';
                        rowtd += '</tr>';
                    }
             }
             tbody.append(rowtd);
             //TRANSACCIONES----------------------------------------------------------------------------------------------------------------------
             var arrayTransacciones=['TRANSACCIONES CON NUEVO REGISTRO A PROGRAMA DE LEALTAD',
                'TRANSACCIONES CON ACTUALIZACIÓN DE DATOS A PROGRAMA DE LEALTAD',
                'TRANSACCIONES CON STATUS YA REGISTRADO Y/O CON DATOS ACTUALIZADOS',
                'TOTAL DE TRANSACCIONES DE CLIENTES EN EL PROGRAMA DE LEALTAD',
                'TOTAL DE TRANSACCIONES DE CLIENTES NO INSCRITOS',
                'TOTAL DE TRANSACCIONES',
                'PROMEDIO DE TRANSACCIONES DE CLIENTES EN EL PROGRAMA DE LEALTAD',
                'PROMEDIO DE TRANSACCIONES DE CLIENTES NO INSCRITOS'];
            var rowtd="";
            var urlTransacciones="http://172.16.15.20/API.LovablePHP/ZLO0017P/PaisesT/?anio="+yearSelected+"";
            var responseTransacciones=ajaxRequest(urlTransacciones);
            tbody.append(`<tr><td colspan='74'></td></tr>
                          <tr class="border border-dark">
                            <td colspan="1" class="bg-dark text-white fw-bold text-center sticky-col">TRANSACCIONES</td>
                            <td colspan="73" class="bg-dark"></td>
                          </tr>
                          <tr><td colspan='74'></td></tr>`);
            var backgroundColor = ['#DAEFFB', '#D1EEF2', '#C8EDF9', '#BFECE0', '#B6EBC7', '#ADEAAE', '#A4E995','#9BE88C'];
            if (responseTransacciones.code==200) {
                let data=responseTransacciones.data;
                let datosRow1 = {}; let datosRow2 = {}; let datosRow3 = {}; let datosRow4 = {}; let datosRow5 = {};let datosRow6 = {};let datosRow7 = {};let datosRow8= {};
                for (let mes = 1; mes <= 12; mes++) {
                    datosRow1[mes] = {}; datosRow2[mes] = {}; datosRow3[mes] = {}; datosRow4[mes] = {}; datosRow5[mes] = {}; datosRow6[mes] = {}; datosRow7[mes] = {}; datosRow8[mes] = {};
                    [1, 3, 4, 5, 6, 19].forEach(codpai => {
                        datosRow1[mes][codpai] = 0;
                        datosRow2[mes][codpai] = 0;
                        datosRow3[mes][codpai] = 0;
                        datosRow4[mes][codpai] = 0;
                        datosRow5[mes][codpai] = 0;
                        datosRow6[mes][codpai] = 0;
                        datosRow7[mes][codpai] = 0;
                        datosRow8[mes][codpai] = 0;
                    });
                }
                data.forEach(dato => {
                    //ROW1
                    datosRow1[dato.MESPRO][dato.CODPAI] = parseInt(dato.TRANUE);
                    //ROW2
                    datosRow2[dato.MESPRO][dato.CODPAI] = parseInt(dato.TRAVIE);
                    //ROW3
                    datosRow3[dato.MESPRO][dato.CODPAI] = parseInt(dato.TRANSA);
                    //ROW4
                    datosRow4[dato.MESPRO][dato.CODPAI] = parseInt(dato.TOTLEA); 
                    //ROW5
                    datosRow5[dato.MESPRO][dato.CODPAI] = parseInt(dato.TOTNOR);
                    //ROW6
                    datosRow6[dato.MESPRO][dato.CODPAI] = parseInt(dato.TOTTR2);
                    //ROW7
                    datosRow7[dato.MESPRO][dato.CODPAI] = parseFloat(dato.PORLEA);
                    //ROW8
                    datosRow8[dato.MESPRO][dato.CODPAI] = parseFloat(dato.PORNOR);
                });
                var rowIndex=1;
                for (let k = 0; k < arrayTransacciones.length; k++) {
                    rowtd+='<tr class="border border-dark" style="background-color: '+backgroundColor[k]+'; height:50px;">';
                    rowtd += '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: '+backgroundColor[k]+'">' + arrayTransacciones[k] + '</td>';
                    var totalRow = 0;
                    switch (rowIndex) {
                        case 1:
                            Object.keys(datosRow1).forEach(mes => {
                        [1, 3, 4, 5, 6, 19].forEach(codpai => {
                            rowtd += '<td class="text-end fontM border border-dark">' + (datosRow1[mes][codpai]!=0 ? datosRow1[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                            totalRow += parseInt(datosRow1[mes][codpai] || '0');
                            });
                        });
                            break;
                        case 2:
                        Object.keys(datosRow2).forEach(mes => {
                            [1, 3, 4, 5, 6, 19].forEach(codpai => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow2[mes][codpai]!=0 ? datosRow2[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                totalRow += parseInt(datosRow2[mes][codpai] || '0');
                                });
                            });
                            break;
                        case 3:
                        Object.keys(datosRow3).forEach(mes => {
                            [1, 3, 4, 5, 6, 19].forEach(codpai => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow3[mes][codpai]!=0 ? datosRow3[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                totalRow += parseInt(datosRow3[mes][codpai] || '0');
                                });
                            });
                            break;
                        case 4:
                        Object.keys(datosRow4).forEach(mes => {
                            [1, 3, 4, 5, 6, 19].forEach(codpai => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow4[mes][codpai]!=0 ? datosRow4[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                totalRow += parseInt(datosRow4[mes][codpai] || '0');
                                });
                            });
                            break;
                        case 5:
                        Object.keys(datosRow5).forEach(mes => {
                            [1, 3, 4, 5, 6, 19].forEach(codpai => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow5[mes][codpai]!=0 ? datosRow5[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                totalRow += parseInt(datosRow5[mes][codpai] || '0');
                                });
                            });
                            break;
                            case 6:
                        Object.keys(datosRow5).forEach(mes => {
                            [1, 3, 4, 5, 6, 19].forEach(codpai => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow6[mes][codpai]!=0 ? datosRow6[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                totalRow += parseInt(datosRow6[mes][codpai] || '0');
                                });
                            });
                            break;
                            case 7:
                        Object.keys(datosRow5).forEach(mes => {
                            [1, 3, 4, 5, 6, 19].forEach(codpai => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow7[mes][codpai]!=0 ? datosRow7[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%' : '‎') + '</td>';
                                totalRow += parseFloat(datosRow7[mes][codpai] || '0');
                                });
                            });
                            break;
                            case 8:
                        Object.keys(datosRow5).forEach(mes => {
                            [1, 3, 4, 5, 6, 19].forEach(codpai => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow8[mes][codpai]!=0 ? datosRow8[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%' : '‎') + '</td>';
                                totalRow += parseFloat(datosRow8[mes][codpai] || '0');
                                });
                            });
                            break;
                        default:
                        rowtd += '<td class="text-end fontM border border-dark">0</td>';
                            break;
                    }
                    rowtd += '<td class="text-end fontM border border-dark">' + totalRow.toLocaleString('es-419', {
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            }) + '</td>';
                    rowtd += '</tr>';
                    rowIndex++;
                }
              
            }else{
                for (let k = 0; k < arrayTransacciones.length; k++) {
                    rowtd+='<tr class="border border-dark" style="background-color: '+backgroundColor[k]+'; height:50px;">';
                    rowtd += '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: '+backgroundColor[k]+'">' + arrayTransacciones[k] + '</td>';
                    for (let i = 0; i < 72; i++) {
                        rowtd += '<td class="text-end fontM border border-dark"> </td>';
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
                          '% DE TRANSACCIONES CON STATUS REGISTRADO Y/O ACTUALIZADO VS TOTAL DE TRANSACCIONES',
                          '% DE TRANSACCIONES DE CLIENTES INSCRITOS EN PDL VS TRANSACCIONES TOTALES',
                          '% DE TRANSACCIONES DE CLIENTE NO INSCRITO VS TRANSACCIONES TOTALES'
                        ];
            var rowtd="";
            var urlPTransacciones=" http://172.16.15.20/API.LovablePHP/ZLO0017P/PaisesPT/?anio="+yearSelected+"";
            var responsePTransacciones=ajaxRequest(urlPTransacciones);
            tbody.append(`<tr><td colspan='74'></td></tr>
                          <tr class="border border-dark">
                            <td colspan="1" class="bg-dark text-white fw-bold text-center sticky-col">PORCENTAJES  DE TRANSACCIONES</td>
                            <td colspan="73" class="bg-dark"></td>
                          </tr>
                          <tr><td colspan='74'></td></tr>`);
                          var backgroundColor = ['#F8FF33', '#F9FF66', '#FAFF99', '#FBFFCC', '#FCFFDF'];
            if (responsePTransacciones.code==200) {
                let data=responsePTransacciones.data;
                let datosRow1 = {}; let datosRow2 = {}; let datosRow3 = {}; let datosRow4 = {}; let datosRow5 = {};
                for (let mes = 1; mes <= 12; mes++) {
                    datosRow1[mes] = {}; datosRow2[mes] = {}; datosRow3[mes] = {}; datosRow4[mes] = {}; datosRow5[mes] = {};
                    [1, 3, 4, 5, 6, 19].forEach(codpai => {
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
                    datosRow4[dato.MESPRO][dato.CODPAI] = parseFloat(dato.PORCE9); 
                    //ROW5
                    datosRow5[dato.MESPRO][dato.CODPAI] = parseFloat(dato.PORCE0);
                });

                var rowIndex=1;
                for (let k = 0; k < arrayPorTransacciones.length; k++) {
                    rowtd+='<tr class="border border-dark" style="background-color: '+backgroundColor[k]+'; height:50px;">';
                    rowtd += '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: '+backgroundColor[k]+'">' + arrayPorTransacciones[k] + '</td>';
                    var totalRow = 0;
                    switch (rowIndex) {
                        case 1:
                            Object.keys(datosRow1).forEach(mes => {
                        [1, 3, 4, 5, 6, 19].forEach(codpai => {
                            rowtd += '<td class="text-end fontM border border-dark">' + (datosRow1[mes][codpai]!=0 ? datosRow1[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%' : '‎') + '</td>';
                            totalRow += parseInt(datosRow1[mes][codpai] || '0');
                            });
                        });
                            break;
                        case 2:
                        Object.keys(datosRow2).forEach(mes => {
                            [1, 3, 4, 5, 6, 19].forEach(codpai => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow2[mes][codpai]!=0 ? datosRow2[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%' : '‎') + '</td>';
                                totalRow += parseInt(datosRow2[mes][codpai] || '0');
                                });
                            });
                            break;
                        case 3:
                        Object.keys(datosRow3).forEach(mes => {
                            [1, 3, 4, 5, 6, 19].forEach(codpai => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow3[mes][codpai]!=0 ? datosRow3[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%' : '‎') + '</td>';
                                totalRow += parseInt(datosRow3[mes][codpai] || '0');
                                });
                            });
                            break;
                        case 4:
                        Object.keys(datosRow4).forEach(mes => {
                            [1, 3, 4, 5, 6, 19].forEach(codpai => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow4[mes][codpai]!=0 ? datosRow4[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%' : '‎') + '</td>';
                                totalRow += parseInt(datosRow4[mes][codpai] || '0');
                                });
                            });
                            break;
                        case 5:
                        Object.keys(datosRow5).forEach(mes => {
                            [1, 3, 4, 5, 6, 19].forEach(codpai => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow5[mes][codpai]!=0 ? datosRow5[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%' : '‎') + '</td>';
                                totalRow += parseInt(datosRow5[mes][codpai] || '0');
                                });
                            });
                            break;
                        default:
                        rowtd += '<td class="text-end fontM border border-dark">0</td>';
                            break;
                    }
                    rowtd += '<td class="text-end fontM border border-dark">' + totalRow.toLocaleString('es-419', {
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            }) + '</td>';
                    rowtd += '</tr>';
                    rowIndex++;
                }
            }else{
                for (let k = 0; k < arrayPorTransacciones.length; k++) {
                    rowtd+='<tr class="border border-dark" style="background-color: '+backgroundColor[k]+'; height:50px;">';
                    rowtd += '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: '+backgroundColor[k]+'">' + arrayPorTransacciones[k] + '</td>';
                    for (let i = 0; i < 72; i++) {
                        rowtd += '<td class="text-end fontM border border-dark"> </td>';
                    }
                    rowtd += '<td class="text-end fontM border border-dark"> </td>';
                    rowtd += '</tr>';
                }
            }
            tbody.append(rowtd);

             //DESGLOSE DEL TIPO DE INFORMACION----------------------------------------------------------------------------------------------------------------------
             var arrayDesglose=[
                          'TOTAL QUE INGRESARON O MODIFICARON DATOS EN EL MES',
                          'CANTIDAD DE CLIENTES QUE BRINDARON AMBOS:  TELEFONO Y CORREO',    
                          '% DE CLIENTES QUE BRINDARON AMBOS: TELEFONO Y CORREO',           
                          'CANTIDAD DE CLIENTES QUE BRINDARON TELEFONO',
                          '% DE CLIENTES QUE BRINDARON TELEFONO',
                          'CANTIDAD DE CLIENTES QUE BRINDARON CORREO',
                          '% DE CLIENTES QUE BRINDARON CORREO'
                        ];
            var rowtd="";
            var urlDesglose="http://172.16.15.20/API.LovablePHP/ZLO0017P/PaisesD/?anio="+yearSelected+"";
            var responseDesglose=ajaxRequest(urlDesglose);
            tbody.append(`<tr><td colspan='74'></td></tr>
                          <tr class="border border-dark">
                            <td colspan="1" class="bg-dark text-white fw-bold text-center sticky-col">DESGLOSE DEL TIPO DE INFORMACION QUE EL CLIENTE PROPORCIONA</td>
                            <td colspan="73" class="bg-dark"></td>
                          </tr>
                          <tr><td colspan='74'></td></tr>`);
            var backgroundColor = ['#D4E5FF', '#C3E2FF', '#B2DFFF', '#A1DCFF', '#90D9FF', '#7FD6FF','#6ED3FF'];
            if (responseDesglose.code==200) {
                let data=responseDesglose.data;
                let datosRow1 = {}; let datosRow2 = {}; let datosRow3 = {}; let datosRow4 = {}; let datosRow5 = {};let datosRow6 = {};let datosRow7 = {};
                for (let mes = 1; mes <= 12; mes++) {
                    datosRow1[mes] = {}; datosRow2[mes] = {}; datosRow3[mes] = {}; datosRow4[mes] = {}; datosRow5[mes] = {}; datosRow6[mes] = {}; datosRow7[mes] = {};
                    [1, 3, 4, 5, 6, 19].forEach(codpai => {
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
                var rowIndex=1;
                for (let k = 0; k < arrayDesglose.length; k++) {
                    rowtd+='<tr class="border border-dark" style="background-color: '+backgroundColor[k]+'; height:50px;">';
                    rowtd += '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: '+backgroundColor[k]+'">' + arrayDesglose[k] + '</td>';
                    var totalRow = 0;
                    switch (rowIndex) {
                        case 1:
                            Object.keys(datosRow1).forEach(mes => {
                        [1, 3, 4, 5, 6, 19].forEach(codpai => {
                            rowtd += '<td class="text-end fontM border border-dark">' + (datosRow1[mes][codpai]!=0 ? datosRow1[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                            totalRow += parseInt(datosRow1[mes][codpai] || '0');
                            });
                        });
                            break;
                        case 2:
                        Object.keys(datosRow2).forEach(mes => {
                            [1, 3, 4, 5, 6, 19].forEach(codpai => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow2[mes][codpai]!=0 ? datosRow2[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                totalRow += parseInt(datosRow2[mes][codpai] || '0');
                                });
                            });
                            break;
                        case 3:
                        Object.keys(datosRow3).forEach(mes => {
                            [1, 3, 4, 5, 6, 19].forEach(codpai => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow3[mes][codpai]!=0 ? datosRow3[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%' : '‎') + '</td>';
                                totalRow += parseInt(datosRow3[mes][codpai] || '0');
                                });
                            });
                            break;
                        case 4:
                        Object.keys(datosRow4).forEach(mes => {
                            [1, 3, 4, 5, 6, 19].forEach(codpai => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow4[mes][codpai]!=0 ? datosRow4[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                totalRow += parseInt(datosRow4[mes][codpai] || '0');
                                });
                            });
                            break;
                        case 5:
                        Object.keys(datosRow5).forEach(mes => {
                            [1, 3, 4, 5, 6, 19].forEach(codpai => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow5[mes][codpai]!=0 ? datosRow5[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%' : '‎') + '</td>';
                                totalRow += parseInt(datosRow5[mes][codpai] || '0');
                                });
                            });
                            break;
                            case 6:
                        Object.keys(datosRow5).forEach(mes => {
                            [1, 3, 4, 5, 6, 19].forEach(codpai => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow6[mes][codpai]!=0 ? datosRow6[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                totalRow += parseInt(datosRow6[mes][codpai] || '0');
                                });
                            });
                            break;
                            case 7:
                        Object.keys(datosRow5).forEach(mes => {
                            [1, 3, 4, 5, 6, 19].forEach(codpai => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow7[mes][codpai]!=0 ? datosRow7[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%' : '‎') + '</td>';
                                totalRow += parseFloat(datosRow7[mes][codpai] || '0');
                                });
                            });
                            break;
                        default:
                        rowtd += '<td class="text-end fontM border border-dark">0</td>';
                            break;
                    }
                    rowtd += '<td class="text-end fontM border border-dark">' + totalRow.toLocaleString('es-419', {
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            }) + '</td>';
                    rowtd += '</tr>';
                    rowIndex++;
                }

            }else{
                for (let k = 0; k < arrayDesglose.length; k++) {
                    rowtd+='<tr class="border border-dark" style="background-color: '+backgroundColor[k]+'; height:50px;">';
                    rowtd += '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: '+backgroundColor[k]+'">' + arrayDesglose[k] + '</td>';
                    for (let i = 0; i < 72; i++) {
                        rowtd += '<td class="text-end fontM border border-dark"> </td>';
                    }
                    rowtd += '<td class="text-end fontM border border-dark"> </td>';
                    rowtd += '</tr>';
                }
            }
           tbody.append(rowtd);
             //TICKET PROMEDIO----------------------------------------------------------------------------------------------------------------------
             var arrayTicket=[
                          'TICKET PROMEDIO DE TRANSACCIONES DE CLIENTES EN PROGRAMA DE LEALTAD',
                          'TICKET PROMEDIO DE TRANSACCIONES DE CLIENTES NO INSCRITOS',
                          'TICKET PROMEDIO  GENERAL'];
            var rowtd="";
            var urlTicket="http://172.16.15.20/API.LovablePHP/ZLO0017P/PaisesTC/?anio="+yearSelected+"";
            var responseTicket=ajaxRequest(urlTicket);
            tbody.append(`<tr><td colspan='74'></td></tr>
                          <tr class="border border-dark">
                            <td colspan="1" class="bg-dark text-white fw-bold text-center sticky-col">TICKET PROMEDIO</td>
                            <td colspan="73" class="bg-dark"></td>
                          </tr>
                          <tr><td colspan='74'></td></tr>`);
            var backgroundColor = ['#FFE0CC', '#FFD199','#FFC266'];
            if (responseTicket.code==200) {
                let data=responseTicket.data;
                let datosRow1 = {}; let datosRow2 = {}; let datosRow3 = {};
                for (let mes = 1; mes <= 12; mes++) {
                    datosRow1[mes] = {}; datosRow2[mes] = {}; datosRow3[mes] = {};
                    [1, 3, 4, 5, 6, 19].forEach(codpai => {
                        datosRow1[mes][codpai] = 0;
                        datosRow2[mes][codpai] = 0;
                        datosRow3[mes][codpai] = 0;
                    });
                }
                data.forEach(dato => {
                    //ROW1
                    datosRow1[dato.MESPRO][dato.CODPAI] = parseFloat(dato.PORVLE);
                    //ROW2
                    datosRow2[dato.MESPRO][dato.CODPAI] = parseFloat(dato.PORVNO);
                    //ROW3
                    datosRow3[dato.MESPRO][dato.CODPAI] = parseFloat(dato.PORVTO);
                });
                var rowIndex=1;
                for (let k = 0; k < arrayTicket.length; k++) {
                    rowtd+='<tr class="border border-dark" style="background-color: '+backgroundColor[k]+'; height:50px;">';
                    rowtd += '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: '+backgroundColor[k]+'">' + arrayTicket[k] + '</td>';
                    var totalRow = 0;
                    switch (rowIndex) {
                        case 1:
                            Object.keys(datosRow1).forEach(mes => {
                        [1, 3, 4, 5, 6, 19].forEach(codpai => {
                            rowtd += '<td class="text-end fontM border border-dark">' + (datosRow1[mes][codpai]!=0 ? datosRow1[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2}) : '‎') + '</td>';
                            totalRow += parseInt(datosRow1[mes][codpai] || '0');
                            });
                        });
                            break;
                        case 2:
                        Object.keys(datosRow2).forEach(mes => {
                            [1, 3, 4, 5, 6, 19].forEach(codpai => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow2[mes][codpai]!=0 ? datosRow2[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2}) : '‎') + '</td>';
                                totalRow += parseInt(datosRow2[mes][codpai] || '0');
                                });
                            });
                            break;
                        case 3:
                        Object.keys(datosRow3).forEach(mes => {
                            [1, 3, 4, 5, 6, 19].forEach(codpai => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow3[mes][codpai]!=0 ? datosRow3[mes][codpai].toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2}) : '‎') + '</td>';
                                totalRow += parseInt(datosRow3[mes][codpai] || '0');
                                });
                            });
                            break;
                            default:
                        rowtd += '<td class="text-end fontM border border-dark">0</td>';
                            break;
                    }
                    rowtd += '<td class="text-end fontM border border-dark"> </td>';
                    rowtd += '</tr>';
                    rowIndex++;
                }
            }else{
                for (let k = 0; k < arrayTicket.length; k++) {
                    rowtd+='<tr class="border border-dark" style="background-color: '+backgroundColor[k]+'; height:50px;">';
                    rowtd += '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: '+backgroundColor[k]+'">' + arrayTicket[k] + '</td>';
                    for (let i = 0; i < 72; i++) {
                        rowtd += '<td class="text-end fontM border border-dark"> </td>';
                    }
                    rowtd += '<td class="text-end fontM border border-dark"> </td>';
                    rowtd += '</tr>';
                }
            }
            tbody.append(rowtd);

             //TIENDAS----------------------------------------------------------------------------------------------------------------------
            var arrayTiendas=['NUMERO DE TIENDAS'];
            var urlTiendas="http://172.16.15.20/API.LovablePHP/ZLO0017P/PaisesTiendas/";
            var responseTiendas=ajaxRequest(urlTiendas);
            if(responseTiendas.code==200){
            let data=responseTiendas.data;
            tbody.append("<tr><td colspan='74'></td></tr>");
            tbody.append(`<tr class="border border-dark">
                            <td colspan="1" class="bg-dark text-white fw-bold text-center"></td>
                            <td colspan="73" class="bg-dark"></td>
                        </tr>`);
            tbody.append("<tr><td colspan='74'></td></tr>");
            var rowtd="";
           
            for (let i=(arrayTiendas.length-1); i >= 0 ; i--) {
                var row="";
                 for (let j = 1; j <= 12; j++) {
                     row=row+'<td class="text-end fontM border border-dark">'+data[0]['COUNT']+'</td>';
                     row=row+'<td class="text-end fontM border border-dark">'+data[1]['COUNT']+'</td>';
                     row=row+'<td class="text-end fontM border border-dark">'+data[2]['COUNT']+'</td>';
                     row=row+'<td class="text-end fontM border border-dark">'+data[3]['COUNT']+'</td>';
                     row=row+'<td class="text-end fontM border border-dark">'+data[4]['COUNT']+'</td>';
                     row=row+'<td class="text-end fontM border border-dark">'+data[5]['COUNT']+'</td>';
                  }
             rowtd=rowtd+'<tr class="border border-dark bg-secondary" style="height:50px;"><td class="text-center align-middle fontS border border-dark sticky-col bg-secondary">'+arrayTiendas[i]+'</td>'+row+'<td class="text-end fontM border border-dark"> </td></tr>';
            }
            tbody.append(rowtd);

            }
           
        });
       
    </script>
   <!-- <script src="../../assets/js/PRG/ZPL/ZLO0017P.js"></script>-->
</body>

</html>