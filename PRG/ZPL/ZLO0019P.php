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
        INNER JOIN LBPRDDAT/LO0686 AS T2 ON T2.CODCIA = LO0705.CODCIA AND T2.CODCIA NOT IN(1,35,20,21,22,23,24)
        ORDER BY T2.CODSEC";
        $resultCOMARC=odbc_exec($connIBM,$sqlCOMARC);
    ?>
    <script>
        var usuario = '<?php echo $_SESSION["CODUSU"];?>';
    </script>
    <div class="container-fluid p-0">
        <nav aria-label="breadcrumb" style="width:100%" class="p-0">
        <div class="row" style="width:100%">
                    <div class="col-2">
                    <label class="form-control border border-0">Año:</label>
                        <select id="setYear" class="form-select fw-bold">
                        </select>
                    </div>
                    <div class="col-8" >
                        <label class="form-control border border-0">Tiendas:</label>
                        <div class="overflow-auto">
                        <select class="form-select" id="cbbCia" name="cbbCia[]" name="states[]" multiple="multiple" style="width: 100%;">
                            <?php
                                while ($rowCOMARC = odbc_fetch_array($resultCOMARC)) {
                                echo "<option value='" . $rowCOMARC['COMCOD'] . "'>" . rtrim(utf8_encode($rowCOMARC['COMDES'])) . "</option>";
                                }
                            ?>
                        </select>
                        </div>
                        <label class="text-danger mt-2 d-none " id="lblError">Debe de seleccionar una o mas tiendas</label>  
                    </div>
                    <div class="col-2 mt-2">
                        <button type="button" class="btn btn-success mt-4 fw-bold text-white"
                        style="width:100%;" onclick="searchF()">
                        <span class="me-2">BUSCAR</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                        fill="#fff" class="bi bi-search" viewBox="0 0 16 16">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>
    <script src="../../assets/js/select2.min.js"></script>
    <script>
        var yearSelected=0;
        var ciasSelected=[];
        $(document).ready(function() {
            yearSelected=getCookie('year') || 2023;
            ciasSelected=JSON.parse("["+ getCookie('cias') +"]") || [47];
            if (ciasSelected.length==0) {
                ciasSelected=[47];
            }else if(ciasSelected[0]==null){
                ciasSelected=[47];
            }
            var select = document.getElementById('setYear');
            var currentYear = new Date().getFullYear();
            for (var year = 2022; year <= currentYear; year++) {
                var option = document.createElement('option');
                option.value = year;
                option.textContent = year;
                select.appendChild(option);
            }
            select.value = yearSelected;
            $('#cbbCia').select2({closeOnSelect: false,
                                    maximumSelectionLength: 6,
                                    formatSelectionTooBig: function (limit) {
                                        return 'Demasiado items seleccionados. Maximo: ' + limit + '';
                                    }
                                });
            ciasSelected.push(0);
            $("#cbbCia").val(ciasSelected).trigger('change');
            $("#cbbCia").on('select2:select', function (e) {
                $("#lblError").addClass('d-none');
            });
            var width = 10000;
            var widthTh="4";
            switch (ciasSelected.length) {
                case 7:
                    width = 10000;
                    widthTh="4";
                break;
                case 6:
                    width = 9000;
                    widthTh="4.5";
                break;
                case 5:
                    width = 8000;
                    widthTh="4.9";
                break;
                case 4:
                    width = 7000;
                    widthTh="5.5";
                break;
                case 3:
                    width = 5000;
                    widthTh="7.5";
                break;
                default:
                width = 3500;
                widthTh="10.5";
                    break;
            }
            $("#tableDiv").empty();
            $("#tableDiv").append(`<table  id="tableMetricas" class="table stripe table-hover" style="width:`+width+`px !important;">
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
            const headerMes=$("#headerMes");
            var countCias=ciasSelected.length;
            headerMes.empty();
            headerMes.append(` 
                            <th class="text-center sticky-col" style="width:`+widthTh+`%;"></th>
                            <th class="text-center fs-3  border border-dark bg-secondary"   colspan="`+countCias+`">Enero</th>
                            <th class="text-center fs-3  border border-dark text-danger"   colspan="`+countCias+`">Febrero</th>
                            <th class="text-center fs-3  border border-dark bg-secondary"   colspan="`+countCias+`">Marzo</th>
                            <th class="text-center fs-3  border border-dark text-danger"   colspan="`+countCias+`">Abril</th>
                            <th class="text-center fs-3  border border-dark bg-secondary"   colspan="`+countCias+`">Mayo</th>
                            <th class="text-center fs-3  border border-dark text-danger"    colspan="`+countCias+`">Junio</th>
                            <th class="text-center fs-3  border border-dark bg-secondary"   colspan="`+countCias+`">Julio</th>
                            <th class="text-center fs-3  border border-dark text-danger"   colspan="`+countCias+`">Agosto</th>
                            <th class="text-center fs-3  border border-dark bg-secondary"   colspan="`+countCias+`">Septiembre</th>
                            <th class="text-center fs-3  border border-dark text-danger"   colspan="`+countCias+`">Octubre</th>
                            <th class="text-center fs-3  border border-dark bg-secondary"   colspan="`+countCias+`">Noviembre</th>
                            <th class="text-center fs-3  border border-dark text-danger"   colspan="`+countCias+`">Diciembre</th>
                            <th class="text-center fs-3  border border-dark bg-secondary"    colspan="`+countCias+`">Totales</th>`);
          const header=$("#headerPaises");
           header.append('<th></th>');
           var tiendasArray=$("#cbbCia").select2('data');
           for (let i = 1; i <=12;  i++) {
            for (let j = 0; j < tiendasArray.length; j++) {
                header.append(`<th class="text-center border border-dark bg-light align-middle" style="font-size:14px;">`+tiendasArray[j].text+`</th>`);
                }  
                header.append(`<th class="text-center border border-dark bg-black text-white align-middle" style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>`); 
            } 
           header.append(`<th class="text-start responsive-font-example"></th>`);
           const tbody=$("#tbody");
           //REGISTROS----------------------------------------------------------------------------------------------------------------------
           var arrayRegistros=['NUEVOS CLIENTES REGISTRADOS AL PROGRAMA DE LEALTAD',
                          'CLIENTES QUE ACTUALIZARON DATOS DE VIP A PROGRMA DE LEALTAD',
                          'TOTAL NUEVOS CLIENTES REGISTRADOS Y/O EMIGRADOS AL PROGRAMA DE LEALTAD',
                          'TOTAL DE CLIENTES REGISTRADOS AL  PROGRAMA DE LEALTAD',
                          'CLIENTES QUE AUN ESTÁN EN STATUS VIP',
                        'CLIENTES NORMALES'];
                          
         
            var rowtd="";
            var urlRegistros="http://172.16.15.20/API.LovablePHP/ZLO0019P/TiendasR/?anio="+yearSelected+"&tiendas="+ciasSelected+"";
            var responseRegistros=ajaxRequest(urlRegistros);
            tbody.append(`<tr class="border border-dark">
                            <td colspan="1" class="bg-dark text-white fw-bold text-center sticky-col">REGISTROS</td>
                            <td colspan="99" class="bg-dark"></td>
                        </tr>`);
            var backgroundColor = ['#F4E8FF', '#EED4FF', '#E8C1FF', '#D2A8FF','#CDB4FF','#C0A1FF'];
            if (responseRegistros.code==200) {
                let data=responseRegistros.data;
                let datosRow1 = {}; let datosRow2 = {}; let datosRow3 = {}; let datosRow4 = {}; let datosRow5 = {};let datosRow6 = {};
                for (let mes = 1; mes <= 12; mes++) {
                    datosRow1[mes] = {}; datosRow2[mes] = {}; datosRow3[mes] = {}; datosRow4[mes] = {}; datosRow5[mes] = {};datosRow6[mes] = {};
                    ciasSelected.forEach(codcia => {
                        datosRow1[mes][codcia] = 0;
                        datosRow2[mes][codcia] = 0;
                        datosRow3[mes][codcia] = 0;
                        datosRow4[mes][codcia] = 0;
                        datosRow5[mes][codcia] = 0;
                        datosRow6[mes][codcia] = 0;
                    });
                }
                data.forEach(dato => {
                    //ROW1
                    datosRow1[dato.MESPRO][dato.CODCIA] = parseInt(dato.CLIVIE);
                    //ROW2
                    datosRow2[dato.MESPRO][dato.CODCIA] = parseInt(dato.CLINUE);
                    //ROW3
                    datosRow3[dato.MESPRO][dato.CODCIA] = parseInt(dato.TOTCLI);
                    //ROW4
                    datosRow4[dato.MESPRO][dato.CODCIA] = parseInt(dato.CLILEA); 
                    //ROW5
                    datosRow5[dato.MESPRO][dato.CODCIA] = parseInt(dato.CLIVIP);
                    //ROW6
                    datosRow6[dato.MESPRO][dato.CODCIA] = parseInt(dato.CLINOR);
                });
                var rowIndex=1;
                for (let k = 0; k < arrayRegistros.length; k++) {
                    rowtd+='<tr class="border border-dark" style="background-color: '+backgroundColor[k]+'; height:50px;">';
                    rowtd += '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: '+backgroundColor[k]+'">' + arrayRegistros[k] + '</td>';
                    var totalRow = 0;
                    var totalMes = 0;
                    switch (rowIndex) {
                        case 1:
                            Object.keys(datosRow1).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                            if (codcia==0) {
                                rowtd += '<td class="text-end fontM border border-dark">' + totalMes.toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + '</td>';
                                totalMes=0;
                            }else{
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow1[mes][codcia]!=0 ? datosRow1[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                totalMes+= parseInt(datosRow1[mes][codcia] || '0');
                                totalRow += parseInt(datosRow1[mes][codcia] || '0');
                            }
                            
                            });
                        });
                            break;
                        case 2:
                        Object.keys(datosRow2).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                if (codcia==0) {
                                    rowtd += '<td class="text-end fontM border border-dark">' + totalMes.toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + '</td>';
                                    totalMes=0;
                                }else{
                                    rowtd += '<td class="text-end fontM border border-dark">' + (datosRow2[mes][codcia]!=0 ? datosRow2[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                    totalMes+= parseInt(datosRow2[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow2[mes][codcia] || '0');
                                }
                                });
                            });
                            break;
                        case 3:
                        Object.keys(datosRow3).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                if (codcia==0) {
                                    rowtd += '<td class="text-end fontM border border-dark">' + totalMes + '</td>';
                                    totalMes=0;
                                }else{
                                    rowtd += '<td class="text-end fontM border border-dark">' + (datosRow3[mes][codcia]!=0 ? datosRow3[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                    totalMes+= parseInt(datosRow3[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow3[mes][codcia] || '0');
                                }
                                });
                            });
                            break;
                        case 4:
                        Object.keys(datosRow4).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                if (codcia==0) {
                                    rowtd += '<td class="text-end fontM border border-dark">' + totalMes.toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + '</td>';
                                    totalMes=0;
                                }else{
                                    rowtd += '<td class="text-end fontM border border-dark">' + (datosRow4[mes][codcia]!=0 ? datosRow4[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                    totalMes+= parseInt(datosRow4[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow4[mes][codcia] || '0');
                                }
                                });
                            });
                            break;
                        case 5:
                        Object.keys(datosRow5).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                if (codcia==0) {
                                    rowtd += '<td class="text-end fontM border border-dark">' + totalMes.toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + '</td>';
                                    totalMes=0;
                                }else{
                                    rowtd += '<td class="text-end fontM border border-dark">' + (datosRow5[mes][codcia]!=0 ? datosRow5[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                    totalMes+= parseInt(datosRow5[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow5[mes][codcia] || '0');
                                }
                                });
                            });
                            break;
                        case 6:
                        Object.keys(datosRow5).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                if (codcia==0) {
                                    rowtd += '<td class="text-end fontM border border-dark">' + totalMes.toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + '</td>';
                                    totalMes=0;
                                }else{
                                    rowtd += '<td class="text-end fontM border border-dark">' + (datosRow6[mes][codcia]!=0 ? datosRow6[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                    totalMes+= parseInt(datosRow6[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow6[mes][codcia] || '0');
                                }
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
             var arrayTransacciones=['TRANSACCIONES CON NUEVO REGISTRO A PROGRAMA DE LEALTAD',
                'TRANSACCIONES CON ACTUALIZACIÓN DE DATOS A PROGRAMA DE LEALTAD',
                'TRANSACCIONES CON STATUS YA REGISTRADO Y/O CON DATOS ACTUALIZADOS',
                'TOTAL DE TRANSACCIONES DE CLIENTES EN EL PROGRAMA DE LEALTAD',
                'TOTAL DE TRANSACCIONES DE CLIENTES NO INSCRITOS',
                'TOTAL DE TRANSACCIONES',
                'PROMEDIO DE TRANSACCIONES DE CLIENTES EN EL PROGRAMA DE LEALTAD',
                'PROMEDIO DE TRANSACCIONES DE CLIENTES NO INSCRITOS'];
            var rowtd="";
            var urlTransacciones=" http://172.16.15.20/API.LovablePHP/ZLO0019P/TiendasT/?anio="+yearSelected+"&tiendas="+ciasSelected+"";
            var responseTransacciones=ajaxRequest(urlTransacciones);
            tbody.append(`<tr><td colspan='14'></td></tr>
                          <tr class="border border-dark">
                            <td colspan="1" class="bg-dark text-white fw-bold text-center sticky-col">TRANSACCIONES</td>
                            <td colspan="99" class="bg-dark"></td>
                          </tr>
                          <tr><td colspan='14'></td></tr>`);
            var backgroundColor = ['#DAEFFB', '#D1EEF2', '#C8EDF9', '#BFECE0', '#B6EBC7', '#ADEAAE', '#A4E995','#9BE88C'];
            if (responseTransacciones.code==200) {
                let data=responseTransacciones.data;
                let datosRow1 = {}; let datosRow2 = {}; let datosRow3 = {}; let datosRow4 = {}; let datosRow5 = {};let datosRow6 = {};let datosRow7 = {};let datosRow8= {};
                for (let mes = 1; mes <= 12; mes++) {
                    datosRow1[mes] = {}; datosRow2[mes] = {}; datosRow3[mes] = {}; datosRow4[mes] = {}; datosRow5[mes] = {}; datosRow6[mes] = {}; datosRow7[mes] = {}; datosRow8[mes] = {};
                    ciasSelected.forEach(codcia => {
                        datosRow1[mes][codcia] = 0;
                        datosRow2[mes][codcia] = 0;
                        datosRow3[mes][codcia] = 0;
                        datosRow4[mes][codcia] = 0;
                        datosRow5[mes][codcia] = 0;
                        datosRow6[mes][codcia] = 0;
                        datosRow7[mes][codcia] = 0;
                        datosRow8[mes][codcia] = 0;
                    });
                }
                data.forEach(dato => {
                    //ROW1
                    datosRow1[dato.MESPRO][dato.CODCIA] = parseInt(dato.TRANUE);
                    //ROW2
                    datosRow2[dato.MESPRO][dato.CODCIA] = parseInt(dato.TRAVIE);
                    //ROW3
                    datosRow3[dato.MESPRO][dato.CODCIA] = parseInt(dato.TRANSA);
                    //ROW4
                    datosRow4[dato.MESPRO][dato.CODCIA] = parseInt(dato.TOTLEA); 
                    //ROW5
                    datosRow5[dato.MESPRO][dato.CODCIA] = parseInt(dato.TOTNOR);
                    //ROW6
                    datosRow6[dato.MESPRO][dato.CODCIA] = parseInt(dato.TOTTR2);
                    //ROW7
                    datosRow7[dato.MESPRO][dato.CODCIA] = parseFloat(dato.PORLEA);
                    //ROW8
                    datosRow8[dato.MESPRO][dato.CODCIA] = parseFloat(dato.PORNOR);
                });
                var rowIndex=1;
                for (let k = 0; k < arrayTransacciones.length; k++) {
                    rowtd+='<tr class="border border-dark" style="background-color: '+backgroundColor[k]+'; height:50px;">';
                    rowtd += '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: '+backgroundColor[k]+'">' + arrayTransacciones[k] + '</td>';
                    var totalRow = 0;
                    var totalMes = 0;
                    switch (rowIndex) {
                        case 1:
                            Object.keys(datosRow1).forEach(mes => {
                        ciasSelected.forEach(codcia => {
                            if (codcia==0) {
                                rowtd += '<td class="text-end fontM border border-dark">' + totalMes.toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + '</td>';
                                totalMes=0;
                            }else{
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow1[mes][codcia]!=0 ? datosRow1[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                totalMes+= parseInt(datosRow1[mes][codcia] || '0');
                                totalRow += parseInt(datosRow1[mes][codcia] || '0');
                            }
                            });
                        });
                            break;
                        case 2:
                        Object.keys(datosRow2).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                if (codcia==0) {
                                    rowtd += '<td class="text-end fontM border border-dark">' + totalMes.toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + '</td>';
                                    totalMes=0;
                                }else{
                                    rowtd += '<td class="text-end fontM border border-dark">' + (datosRow2[mes][codcia]!=0 ? datosRow2[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                    totalMes+= parseInt(datosRow2[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow2[mes][codcia] || '0');
                                }
                                });
                            });
                            break;
                        case 3:
                        Object.keys(datosRow3).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                if (codcia==0) {
                                    rowtd += '<td class="text-end fontM border border-dark">' + totalMes.toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + '</td>';
                                    totalMes=0;
                                }else{
                                    rowtd += '<td class="text-end fontM border border-dark">' + (datosRow3[mes][codcia]!=0 ? datosRow3[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                    totalMes+= parseInt(datosRow3[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow3[mes][codcia] || '0');
                                }
                                });
                            });
                            break;
                        case 4:
                        Object.keys(datosRow4).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                if (codcia==0) {
                                    rowtd += '<td class="text-end fontM border border-dark">' + totalMes.toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + '</td>';
                                    totalMes=0;
                                }else{
                                    rowtd += '<td class="text-end fontM border border-dark">' + (datosRow4[mes][codcia]!=0 ? datosRow4[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                    totalMes+= parseInt(datosRow4[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow4[mes][codcia] || '0');
                                }
                                });
                            });
                            break;
                        case 5:
                        Object.keys(datosRow5).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                if (codcia==0) {
                                    rowtd += '<td class="text-end fontM border border-dark">' + totalMes.toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + '</td>';
                                    totalMes=0;
                                }else{
                                    rowtd += '<td class="text-end fontM border border-dark">' + (datosRow5[mes][codcia]!=0 ? datosRow5[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                    totalMes+= parseInt(datosRow5[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow5[mes][codcia] || '0');
                                }
                                });
                            });
                            break;
                            case 6:
                        Object.keys(datosRow5).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                if (codcia==0) {
                                    rowtd += '<td class="text-end fontM border border-dark">' + totalMes.toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + '</td>';
                                    totalMes=0;
                                }else{
                                    rowtd += '<td class="text-end fontM border border-dark">' + (datosRow6[mes][codcia]!=0 ? datosRow6[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                    totalMes+= parseInt(datosRow6[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow6[mes][codcia] || '0');
                                }
                                });
                            });
                            break;
                            case 7:
                        Object.keys(datosRow5).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow7[mes][codcia]!=0 ? datosRow7[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%' : '‎') + '</td>';
                                totalRow += parseFloat(datosRow7[mes][codcia] || '0');
                                });
                            });
                            break;
                            case 8:
                        Object.keys(datosRow5).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow8[mes][codcia]!=0 ? datosRow8[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%' : '‎') + '</td>';
                                totalRow += parseFloat(datosRow8[mes][codcia] || '0');
                                });
                            });
                            break;
                        default:
                        rowtd += '<td class="text-end fontM border border-dark">0</td>';
                            break;
                    }
                        if (k==6 || k==7) {
                        rowtd += '<td class="text-end fontM border border-dark"></td>';
                    }else{
                        rowtd += '<td class="text-end fontM border border-dark">' + totalRow.toLocaleString('es-419', {
                                    minimumFractionDigits: 0,
                                    maximumFractionDigits: 0
                                }) + '</td>';
                    }
                    rowtd += '</tr>';
                    rowIndex++;
                }
              
            }else{
                for (let k = 0; k < arrayTransacciones.length; k++) {
                    rowtd+='<tr class="border border-dark" style="background-color: '+backgroundColor[k]+'; height:50px;">';
                    rowtd += '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: '+backgroundColor[k]+'">' + arrayTransacciones[k] + '</td>';
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
                          '% DE TRANSACCIONES CON STATUS REGISTRADO Y/O ACTUALIZADO VS TOTAL DE TRANSACCIONES',
                          '% DE TRANSACCIONES DE CLIENTES INSCRITOS EN PDL VS TRANSACCIONES TOTALES',
                          '% DE TRANSACCIONES DE CLIENTE NO INSCRITO VS TRANSACCIONES TOTALES'
                        ];
            var rowtd="";
            var urlPTransacciones=" http://172.16.15.20/API.LovablePHP/ZLO0019P/TiendasPT/?anio="+yearSelected+"&tiendas="+ciasSelected+"";
            var responsePTransacciones=ajaxRequest(urlPTransacciones);
            tbody.append(`<tr><td colspan='14'></td></tr>
                          <tr class="border border-dark">
                            <td colspan="1" class="bg-dark text-white fw-bold text-center sticky-col">PORCENTAJES  DE TRANSACCIONES</td>
                            <td colspan="99" class="bg-dark"></td>
                          </tr>
                          <tr><td colspan='14'></td></tr>`);
                          var backgroundColor = ['#F8FF33', '#F9FF66', '#FAFF99', '#FBFFCC', '#FCFFDF'];
            if (responsePTransacciones.code==200) {
                let data=responsePTransacciones.data;
                let datosRow1 = {}; let datosRow2 = {}; let datosRow3 = {}; let datosRow4 = {}; let datosRow5 = {};
                for (let mes = 1; mes <= 12; mes++) {
                    datosRow1[mes] = {}; datosRow2[mes] = {}; datosRow3[mes] = {}; datosRow4[mes] = {}; datosRow5[mes] = {};
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
                    datosRow4[dato.MESPRO][dato.CODCIA] = parseFloat(dato.PORCE9); 
                    //ROW5
                    datosRow5[dato.MESPRO][dato.CODCIA] = parseFloat(dato.PORCE0);
                });

                var rowIndex=1;
                for (let k = 0; k < arrayPorTransacciones.length; k++) {
                    rowtd+='<tr class="border border-dark" style="background-color: '+backgroundColor[k]+'; height:50px;">';
                    rowtd += '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: '+backgroundColor[k]+'">' + arrayPorTransacciones[k] + '</td>';
                    var totalRow = 0;
                    switch (rowIndex) {
                        case 1:
                            Object.keys(datosRow1).forEach(mes => {
                        ciasSelected.forEach(codcia => {
                            rowtd += '<td class="text-end fontM border border-dark">' + (datosRow1[mes][codcia]!=0 ? datosRow1[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%' : '‎') + '</td>';
                            totalRow += parseInt(datosRow1[mes][codcia] || '0');
                            });
                        });
                            break;
                        case 2:
                        Object.keys(datosRow2).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow2[mes][codcia]!=0 ? datosRow2[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%' : '‎') + '</td>';
                                totalRow += parseInt(datosRow2[mes][codcia] || '0');
                                });
                            });
                            break;
                        case 3:
                        Object.keys(datosRow3).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow3[mes][codcia]!=0 ? datosRow3[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%' : '‎') + '</td>';
                                totalRow += parseInt(datosRow3[mes][codcia] || '0');
                                });
                            });
                            break;
                        case 4:
                        Object.keys(datosRow4).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow4[mes][codcia]!=0 ? datosRow4[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%' : '‎') + '</td>';
                                totalRow += parseInt(datosRow4[mes][codcia] || '0');
                                });
                            });
                            break;
                        case 5:
                        Object.keys(datosRow5).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow5[mes][codcia]!=0 ? datosRow5[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%' : '‎') + '</td>';
                                totalRow += parseInt(datosRow5[mes][codcia] || '0');
                                });
                            });
                            break;
                        default:
                        rowtd += '<td class="text-end fontM border border-dark">0</td>';
                            break;
                    }
                    rowtd += '<td class="text-end fontM border border-dark"></td>';
                    rowtd += '</tr>';
                    rowIndex++;
                }
            }else{
                for (let k = 0; k < arrayPorTransacciones.length; k++) {
                    rowtd+='<tr class="border border-dark" style="background-color: '+backgroundColor[k]+'; height:50px;">';
                    rowtd += '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: '+backgroundColor[k]+'">' + arrayPorTransacciones[k] + '</td>';
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
            var urlDesglose="http://172.16.15.20/API.LovablePHP/ZLO0019P/TiendasD/?anio="+yearSelected+"&tiendas="+ciasSelected+"";
            var responseDesglose=ajaxRequest(urlDesglose);
            tbody.append(`<tr><td colspan='14'></td></tr>
                          <tr class="border border-dark">
                            <td colspan="1" class="bg-dark text-white fw-bold text-center sticky-col">DESGLOSE DEL TIPO DE INFORMACION QUE EL CLIENTE PROPORCIONA</td>
                            <td colspan="99" class="bg-dark"></td>
                          </tr>
                          <tr><td colspan='14'></td></tr>`);
            var backgroundColor = ['#D4E5FF', '#C3E2FF', '#B2DFFF', '#A1DCFF', '#90D9FF', '#7FD6FF','#6ED3FF'];
            if (responseDesglose.code==200) {
                let data=responseDesglose.data;
                let datosRow1 = {}; let datosRow2 = {}; let datosRow3 = {}; let datosRow4 = {}; let datosRow5 = {};let datosRow6 = {};let datosRow7 = {};
                for (let mes = 1; mes <= 12; mes++) {
                    datosRow1[mes] = {}; datosRow2[mes] = {}; datosRow3[mes] = {}; datosRow4[mes] = {}; datosRow5[mes] = {}; datosRow6[mes] = {}; datosRow7[mes] = {};
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
                var rowIndex=1;
                for (let k = 0; k < arrayDesglose.length; k++) {
                    rowtd+='<tr class="border border-dark" style="background-color: '+backgroundColor[k]+'; height:50px;">';
                    rowtd += '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: '+backgroundColor[k]+'">' + arrayDesglose[k] + '</td>';
                    var totalRow = 0;
                    var totalMes = 0;
                    switch (rowIndex) {
                        case 1:
                            Object.keys(datosRow1).forEach(mes => {
                        ciasSelected.forEach(codcia => {
                            if (codcia==0) {
                                rowtd += '<td class="text-end fontM border border-dark">' + totalMes.toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + '</td>';
                                totalMes=0;
                            }else{
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow1[mes][codcia]!=0 ? datosRow1[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                totalMes+= parseInt(datosRow1[mes][codcia] || '0');
                                totalRow += parseInt(datosRow1[mes][codcia] || '0');
                            }
                            });
                        });
                            break;
                        case 2:
                        Object.keys(datosRow2).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                if (codcia==0) {
                                    rowtd += '<td class="text-end fontM border border-dark">' + totalMes.toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + '</td>';
                                    totalMes=0;
                                }else{
                                    rowtd += '<td class="text-end fontM border border-dark">' + (datosRow2[mes][codcia]!=0 ? datosRow2[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                    totalMes+= parseInt(datosRow2[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow2[mes][codcia] || '0');
                                }
                                });
                            });
                            break;
                        case 3:
                        Object.keys(datosRow3).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow3[mes][codcia]!=0 ? datosRow3[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%' : '‎') + '</td>';
                                totalRow += parseInt(datosRow3[mes][codcia] || '0');
                                });
                            });
                            break;
                        case 4:
                        Object.keys(datosRow4).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                if (codcia==0) {
                                    rowtd += '<td class="text-end fontM border border-dark">' + totalMes.toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + '</td>';
                                    totalMes=0;
                                }else{
                                    rowtd += '<td class="text-end fontM border border-dark">' + (datosRow4[mes][codcia]!=0 ? datosRow4[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                    totalMes+= parseInt(datosRow4[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow4[mes][codcia] || '0');
                                }
                                });
                            });
                            break;
                        case 5:
                        Object.keys(datosRow5).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow5[mes][codcia]!=0 ? datosRow5[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%' : '‎') + '</td>';
                                totalRow += parseInt(datosRow5[mes][codcia] || '0');
                                });
                            });
                            break;
                            case 6:
                        Object.keys(datosRow5).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                if (codcia==0) {
                                    rowtd += '<td class="text-end fontM border border-dark">' + totalMes.toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) + '</td>';
                                    totalMes=0;
                                }else{
                                    rowtd += '<td class="text-end fontM border border-dark">' + (datosRow6[mes][codcia]!=0 ? datosRow6[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0}) : '‎') + '</td>';
                                    totalMes+= parseInt(datosRow6[mes][codcia] || '0');
                                    totalRow += parseInt(datosRow6[mes][codcia] || '0');
                                }
                                });
                            });
                            break;
                            case 7:
                        Object.keys(datosRow5).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow7[mes][codcia]!=0 ? datosRow7[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%' : '‎') + '</td>';
                                totalRow += parseFloat(datosRow7[mes][codcia] || '0');
                                });
                            });
                            break;
                        default:
                        rowtd += '<td class="text-end fontM border border-dark">0</td>';
                            break;
                    }
                   if (k==2 || k==4 || k==6) {
                    rowtd += '<td class="text-end fontM border border-dark"></td>';
                   }else{
                    rowtd += '<td class="text-end fontM border border-dark">' + totalRow.toLocaleString('es-419', {
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            }) + '</td>';
                   }
                    rowtd += '</tr>';
                    rowIndex++;
                }

            }else{
                for (let k = 0; k < arrayDesglose.length; k++) {
                    rowtd+='<tr class="border border-dark" style="background-color: '+backgroundColor[k]+'; height:50px;">';
                    rowtd += '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: '+backgroundColor[k]+'">' + arrayDesglose[k] + '</td>';
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
             var arrayTicket=[
                          'TICKET PROMEDIO DE TRANSACCIONES DE CLIENTES EN PROGRAMA DE LEALTAD',
                          'TICKET PROMEDIO DE TRANSACCIONES DE CLIENTES NO INSCRITOS',
                          'TICKET PROMEDIO  GENERAL'];
            var rowtd="";
            var urlTicket="http://172.16.15.20/API.LovablePHP/ZLO0019P/TiendasTC/?anio="+yearSelected+"&tiendas="+ciasSelected+"";
            var responseTicket=ajaxRequest(urlTicket);
            tbody.append(`<tr><td colspan='14'></td></tr>
                          <tr class="border border-dark">
                            <td colspan="1" class="bg-dark text-white fw-bold text-center sticky-col">TICKET PROMEDIO</td>
                            <td colspan="99" class="bg-dark"></td>
                          </tr>
                          <tr><td colspan='14'></td></tr>`);
            var backgroundColor = ['#FFE0CC', '#FFD199','#FFC266'];
            if (responseTicket.code==200) {
                let data=responseTicket.data;
                let datosRow1 = {}; let datosRow2 = {}; let datosRow3 = {};
                for (let mes = 1; mes <= 12; mes++) {
                    datosRow1[mes] = {}; datosRow2[mes] = {}; datosRow3[mes] = {};
                    ciasSelected.forEach(codcia => {
                        datosRow1[mes][codcia] = 0;
                        datosRow2[mes][codcia] = 0;
                        datosRow3[mes][codcia] = 0;
                    });
                }
                data.forEach(dato => {
                    //ROW1
                    datosRow1[dato.MESPRO][dato.CODCIA] = parseFloat(dato.PORVLE);
                    //ROW2
                    datosRow2[dato.MESPRO][dato.CODCIA] = parseFloat(dato.PORVNO);
                    //ROW3
                    datosRow3[dato.MESPRO][dato.CODCIA] = parseFloat(dato.PORVTO);
                });
                var rowIndex=1;
                for (let k = 0; k < arrayTicket.length; k++) {
                    rowtd+='<tr class="border border-dark" style="background-color: '+backgroundColor[k]+'; height:50px;">';
                    rowtd += '<td class="text-center align-middle fontS border border-dark sticky-col" style="background-color: '+backgroundColor[k]+'">' + arrayTicket[k] + '</td>';
                    var totalRow = 0;
                    switch (rowIndex) {
                        case 1:
                            Object.keys(datosRow1).forEach(mes => {
                        ciasSelected.forEach(codcia => {
                            rowtd += '<td class="text-end fontM border border-dark">' + (datosRow1[mes][codcia]!=0 ? datosRow1[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2}) : '‎') + '</td>';
                            totalRow += parseInt(datosRow1[mes][codcia] || '0');
                            });
                        });
                            break;
                        case 2:
                        Object.keys(datosRow2).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow2[mes][codcia]!=0 ? datosRow2[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2}) : '‎') + '</td>';
                                totalRow += parseInt(datosRow2[mes][codcia] || '0');
                                });
                            });
                            break;
                        case 3:
                        Object.keys(datosRow3).forEach(mes => {
                            ciasSelected.forEach(codcia => {
                                rowtd += '<td class="text-end fontM border border-dark">' + (datosRow3[mes][codcia]!=0 ? datosRow3[mes][codcia].toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2}) : '‎') + '</td>';
                                totalRow += parseInt(datosRow3[mes][codcia] || '0');
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
       function searchF(){
        var yearSelected = $("#setYear").val();
        setCookie('year', yearSelected, 1);
        var cias = $("#cbbCia").val();
        setCookie('cias', cias, 1);
        if (cias.length != 0) {
            location.reload();
        }else{
            $("#lblError").removeClass('d-none');
        }
       
       }
    </script>
   <!-- <script src="../../assets/js/PRG/ZPL/ZLO0017P.js"></script>-->
</body>

</html>