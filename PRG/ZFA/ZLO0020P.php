<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
</head>

<body>
    <?php
      include '../layout-prg.php';
      include '../../assets/php/ZFA/ZLO0020P/header.php';
    ?>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <span>Módulo de facturación / Consultas</span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0020P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-3">
        <div class="card mb-5">
            <div class="card-header">
                <h1 class="fs-4 mb-1 mt-2 text-center">Consulta de ventas resumidas - Países</h1>
            </div>
            <div class="card-body">
                <div id="loaderTable" class="d-none" style="width: 100%; ">
                    <button class="btn btn-light position-absolute top-50 start-50 translate-middle p-4"
                        style="z-index: 9999;" type="button" disabled>
                        <i class="fa-solid fa-gear fa-spin" style="font-size:70px;"></i>
                    </button>
                    <div class="position-fixed  top-0 start-0 bg-secondary bg-opacity-50 rounded"
                        style="z-index: 9998; width:100%; height:100%;"></div>
                </div>
                <div class="demo">
                    <div class="d-flex">
                        <div class="form-check form-switch ms-2 mb-3">
                            <input class="form-check-input fs-5 " type="checkbox" role="switch" id="dolaresCk"
                                name="dolaresChk" checked>
                            <label class="form-check-label fs-6 fw-bold mt-2" for="dolaresCk">Mostrar valores en
                                dólares</label>
                        </div>
                        <div class="form-check form-switch ms-2 mb-3 d-flex">
                            <label class="form-check-label fs-6 fw-bold mt-2">Filtrar&nbsp;por:</label>
                            <select id="filterBy" class="form-select fw-bold ms-2">
                                <option value="0">TODOS</option>
                                <option value="G">General</option>
                                <option value="V">Ventas por catálogo</option>
                                <option value="T">Tienda en línea</option>
                                <option value="M">Mayoristas</option>
                                <option value="N">Ventas normales</option>
                            </select>
                        </div>
                        <div class="form-check form-switch ms-2 mb-3 d-flex">
                            <label class="form-check-label fs-6 fw-bold mt-2">Mostrar&nbsp;por:</label>
                            <select id="showBy" class="form-select fw-bold ms-2" style="width:280px;">
                                <option value="0">Fábrica + Tiendas</option>
                                <option value="1">Solo fábrica</option>
                                <option value="2">Solo tiendas</option>
                            </select>
                        </div>
                        <div class="form-check form-switch ms-2 mb-3 d-flex">
                                <div>
                                    <label class="form-control border border-0">Mostrar año:</label>
                                </div>
                                <div>
                                <select id="setYearTab" class="form-select fw-bold">
                                </select>
                                </div>
                                </div>
                                <div class="form-check form-switch ms-2 mb-3 d-flex">
                                <div>
                                    <label class="form-control border border-0">Mostrar mes:</label>
                                </div>
                                <div>
                                    <select id="setMesTab" class="form-select fw-bold">
                                </select>
                                </div>
                            </div>
                    </div>

                    <ul class="tablist" role="tablist">
                        <li id="tab1" class="tablist__tab text-center p-3 is-active" aria-controls="panel1"
                            aria-selected="true" role="tab" tabindex="0"></li>
                        <li id="tab2" class="tablist__tab text-center p-3 " aria-controls="panel2" aria-selected="true"
                            role="tab" tabindex="0"></li>
                        <li id="tab3" class="tablist__tab text-center p-3 " aria-controls="panel3" aria-selected="true"
                            role="tab" tabindex="0"></li>
                        <li id="tab4" class="tablist__tab text-center p-3 " aria-controls="panel4" aria-selected="true"
                            role="tab" tabindex="0"></li>
                    </ul>
                    <div id="panel1" class="tablist__panel p-2" aria-labelledby="tab1" aria-hidden="false"
                        role="tabpanel">
                    </div>
                    <div id="panel2" class="tablist__panel p-2 is-hidden" aria-labelledby="tab2" aria-hidden="true"
                        role="tabpanel">
                        <h1>Panel2</h1>
                    </div>
                    <div id="panel3" class="tablist__panel p-2 is-hidden" aria-labelledby="tab3" aria-hidden="true"
                        role="tabpanel">
                        <h1>Panel3</h1>
                    </div>
                    <div id="panel4" class="tablist__panel p-2 is-hidden" aria-labelledby="tab4" aria-hidden="true"
                        role="tabpanel">
                        <h1>Panel4</h1>
                    </div>
                </div>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
    </div>

    </div>
    <div class="footer bg-blck flex-grow-1 d-flex justify-content-center">
        <p class="bggray responsive-font-example"><i>Lovable de Honduras S.A. de C.V</i></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/variable-pie.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
    var dolar = 1;
    //Valores a comparar
    var ano1 = 0;
    var ano2 = 0;
    var mes1 = 0;
    var mes2 = 0;
    //Tab variables
    var ano1Tab = 0;
    var ano2Tab = 0;
    var mes1Tab = 0;
    var mes2Tab = 0;

    var usuario = '<?php echo $_SESSION["CODUSU"];?>';
    document.addEventListener("DOMContentLoaded", (event) => {
        var currentDate = new Date();
        ano1 = currentDate.getFullYear();
        mes1 = currentDate.getMonth() + 1;
        ano2 = ano1;
        mes2 = mes1 - 1;
        if (mes2 == 0) {
            mes2 = 12;
            ano2 = ano1 - 1;
        }
        //MOSTRAR VALORES EN DOLARES
        var ckDolar = document.getElementById("dolaresCk");
        dolar = (getCookie("isDolar") != null) ? getCookie("isDolar") : 1;
        if (dolar == 1) {
            ckDolar.checked = true;
        } else {
            ckDolar.checked = false;
        }
        //TAB1
        if (getCookie("yearTab") != null) {
            ano1Tab = getCookie("yearTab");
            ano2Tab = getCookie("yearTab") - 1;
        } else {
            ano1Tab = ano1;
            ano2Tab = ano2;
        }
        if (getCookie("mesTab") != null) {
            mes1Tab = getCookie("mesTab");
            mes2Tab = getCookie("mesTab") - 1;
            if (mes2Tab == 0) {
                mes2Tab = 12;
                ano2Tab = ano2 - 1;
            }
        }else{
            mes1Tab = mes1;
            mes2Tab = mes2;
        }
        document.getElementById("tab1").innerHTML = 'MES VS MES ANTERIOR';
        chargeTab1(ano1Tab, ano2Tab, mes1Tab, mes2Tab);
        //TAB2
        document.getElementById("tab2").innerHTML = 'MES VS MISMO MES DEL AÑO ANTERIOR';
        chargeTab2(ano1Tab, (ano1Tab-1), mes1Tab, mes1Tab);
        //TAB3
        document.getElementById("tab3").innerHTML = 'ANUAL TODO EL AÑO';
        chargeTab3(ano1Tab, (ano1Tab-1));
        //TAB4
        document.getElementById("tab4").innerHTML = 'ANUAL HASTA EL MES';
        chargeTab4(ano1Tab, (ano1Tab-1), mes1Tab);

        ckDolar.addEventListener('change', (event) => {
            if (ckDolar.checked) {
                dolar = 1;
                setCookie('isDolar', 1, 1);
            } else {
                dolar = 0;
                setCookie('isDolar', 0, 1);
            }
            loaderTable.classList.remove('d-none');
            setTimeout(() => {
                chargeTab1(ano1Tab, ano2Tab, mes1Tab, mes2Tab);
            }, 1000);
            setTimeout(() => {
                chargeTab2(ano1Tab, (ano1Tab-1), mes1Tab, mes2Tab);
            }, 1000);
            setTimeout(() => {
                chargeTab3(ano1Tab, (ano1Tab-1));
            }, 1000);
            setTimeout(() => {
                chargeTab4(ano1Tab, (ano1Tab-1), mes1Tab);
            }, 1000);
            setTimeout(() => {
                loaderTable.classList.add('d-none');
            }, 1000);
        });
        filterBy.addEventListener('change', (event) => {
            loaderTable.classList.remove('d-none');
            setTimeout(() => {
                chargeTab1(ano1Tab, ano2Tab, mes1Tab, mes2Tab);
            }, 1000);
            setTimeout(() => {
                chargeTab2(ano1Tab, (ano1Tab-1), mes1Tab, mes2Tab);
            }, 1000);
            setTimeout(() => {
                chargeTab3(ano1Tab, (ano1Tab-1));
            }, 1000);
            setTimeout(() => {
                chargeTab4(ano1Tab, (ano1Tab-1), mes1Tab);
            }, 1000);
            setTimeout(() => {
                loaderTable.classList.add('d-none');
            }, 1000);

        });
        showBy.addEventListener('change', (event) => {
            loaderTable.classList.remove('d-none');
            setTimeout(() => {
                chargeTab1(ano1Tab, ano2Tab, mes1Tab, mes2Tab);
            }, 1000);
            setTimeout(() => {
                chargeTab2(ano1Tab, (ano1Tab-1), mes1Tab, mes2Tab);
            }, 1000);
            setTimeout(() => {
                chargeTab3(ano1Tab, (ano1Tab-1));
            }, 1000);
            setTimeout(() => {
                chargeTab4(ano1Tab, (ano1Tab-1), mes1Tab);
            }, 1000);
            setTimeout(() => {
                loaderTable.classList.add('d-none');
            }, 1000);

        });
        $('#setYearTab').on('change', function() {
            $("#loaderTable").removeClass('d-none');
            setCookie('yearTab', this.value, 1);
            ano1Tab = this.value;
            ano2Tab = this.value;
            mes1Tab = $("#setMesTab").val();
            mes2Tab = $("#setMesTab").val() - 1;
            if (mes2Tab == 0) {
                mes2Tab = 12;
                ano2Tab = ano1Tab - 1;
            }
            mes1Tab = (mes1Tab).toString().padStart(2, '0');
            mes2Tab = (mes2Tab).toString().padStart(2, '0');
            chargeTab1(ano1Tab, ano2Tab, mes1Tab, mes2Tab);
            setTimeout(() => {
                ano2Tab = ano1Tab - 1;
                chargeTab2(ano1Tab, ano2Tab, mes1Tab, mes1Tab);
            }, 500);
            setTimeout(() => {
                chargeTab3(ano1Tab, ano2Tab);
            }, 500);
            setTimeout(() => {
                chargeTab4(ano1Tab, ano2Tab, mes1Tab);
            }, 500);
            $("#loaderTable").addClass('d-none');
        });
        $('#setMesTab').on('change', function() {
            $("#loaderTable").removeClass('d-none');
            setCookie('mesTab', this.value, 1);
            mes1Tab = this.value
            mes2Tab = this.value - 1
            ano1Tab = $("#setYearTab").val();
            ano2Tab = $("#setYearTab").val();
            if (mes2Tab == 0) {
                mes2Tab = 12;
                ano2Tab = ano1Tab - 1;
            }
            mes1Tab = (mes1Tab).toString().padStart(2, '0');
            mes2Tab = (mes2Tab).toString().padStart(2, '0');
            chargeTab1(ano1Tab, ano2Tab, mes1Tab, mes2Tab);
            setTimeout(() => {
                chargeTab2(ano1Tab, ano2Tab, mes1Tab, mes1Tab);
            }, 1000);
            setTimeout(() => {
                chargeTab3(ano1Tab, ano2Tab);
            }, 1000);
            setTimeout(() => {
                chargeTab4(ano1Tab, ano2Tab, mes1Tab);
            }, 1000);
            $("#loaderTable").addClass('d-none');
        });
    });

    function chargeTab1(ano1, ano2, mes1, mes2) {
        mes1 = mes1.toString().padStart(2, '0');
        var filterBy = document.getElementById("filterBy");
        var showBy = document.getElementById("showBy");
        var url = 'http://172.16.15.20/API.LovablePHP/ZLO0020P/ListPanel1/?fechaFiltro=' + ano1 + mes1 + '01&usuario=' +
            usuario + '&case=' + dolar + '&vend=1&filtro=' + filterBy.value + '&mostrar=' + showBy.value;
        var response = ajaxRequest(url);
        var resultData = [];
        var chartLabels = [];
        var chartValues1 = [];
        var chartValues2 = [];
        var chartMon = [];
        if (response.code == 200) {
            response.data.sort(function(a, b) {
            if (a.CODSEC < b.CODSEC) {
                return -1;
            }
            if (a.CODSEC > b.CODSEC) {
                return 1;
            }
            return 0;
            });
            var count = 0;
            for (let i = 0; i < response.data.length; i++) {
                //
                if (response.data[i]['VENDEDOR'] == 0) {
                    chartLabels.push(response.data[i]['COMDES']);
                    chartValues1.push(parseFloat(response.data[i]['ANO1']));
                    chartValues2.push(parseFloat(response.data[i]['ANO2']));
                    chartMon.push(response.data[i]['MON']);
                    response.data[i]['detalle'] = [];
                    resultData[count] = response.data[i];
                    count++;
                } else {
                    resultData[count - 1]['detalle'].push(response.data[i]);

                }
            }
        }

        document.getElementById("panel1").innerHTML = '';
        document.getElementById("panel1").innerHTML =
            `  <div class="row">
                                    <div class="col-12" id="graficaTab1">
                                        <figure class="highcharts-figure ">
                                            <div id="ctx1" >
                                            </div>
                                        </figure>
                                    </div>
                                    <div class="col-12">
                                    <div class="container-fluid">
                                                            <div class="table-responsive">
                                                                <table id="tablePanel1" class="table stripe table-hover mt-2" style="width:100%" >
                                                                    <thead>
                                                                        <tr>

                                                                            <th style="width:21%;">País</th>
                                                                            <th class="text-end" style="width:21.5%;">Venta ` +
            getCurrentMonth(mes1) + ' ' +
            ano1 +
            `</th>
                                                                            <th class="text-end" style="width:22.5%;">Venta ` +
            getCurrentMonth(mes2) + ' ' + ano2 + `</th>
                                                                            <th class="text-end" style="width:17.5%;">Variación</th>
                                                                            <th class="text-end" style="width:14.5%;">Crecimiento</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                    </div>
                            </div> `;
        var currentDate = new Date();
        var yearSelected = getCookie('yearTab') ||  currentDate.getFullYear();
        var select = document.getElementById('setYearTab');
        var currentYear = new Date().getFullYear();
        select.innerHTML = '';
        for (var year = 2021; year <= currentYear; year++) {
            var option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            select.appendChild(option);
        }

        select.value = yearSelected;
        var monthSelected = getCookie('mesTab') ||  currentDate.getMonth() + 1;
        var select = document.getElementById('setMesTab');
        var currentMonth = new Date().getMonth();
        var meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE',
            'NOVIEMBRE', 'DICIEMBRE'
        ];
        select.innerHTML = '';
        for (var i = 0; i < meses.length; i++) {
            var option = document.createElement('option');
            option.value = i + 1;
            option.textContent = meses[i];
            select.appendChild(option);
        }
        select.value = monthSelected;

        var isLabel = true;
        var pixelWidth = window.innerWidth;
        if (pixelWidth <= 600) {
            isLabel = false;
            graficaTab1.classList.add('d-none');
        } else {
            graficaTab1.classList.remove('d-none');
        }
        const chart = new Highcharts.Chart({
            chart: {
                renderTo: 'ctx1',
                type: 'column',

            },
            xAxis: {
                categories: chartLabels
            },
            yAxis: {
                min: 0,
                endOnTick: false,
                lineWidth: 1,
                title: {
                    text: ' '

                },
            },
            tooltip: {
                headerFormat: '<b>{point.key}</b><br>',
                pointFormat: 'Venta: {point.mon}.{point.y}'
            },
            title: {
                text: getCurrentMonth(mes1) + ' ' + ano1 + ' vs ' + getCurrentMonth(mes2) +
                    ' ' + ano2,
                align: 'center'
            },
            lang: {
                viewFullscreen: "Ver en pantalla completa",
                exitFullscreen: "Salir de pantalla completa",
                downloadJPEG: "Descargar imagen JPEG",
                downloadPDF: "Descargar en PDF",
            },
            subtitle: {
                text: 'Lovable de Honduras',
                align: 'left'
            },
            credits: {
                enabled: false
            },
            legend: {
                enabled: true
            },
            plotOptions: {
                column: {
                    depth: 25
                },
                series: {
                    dataLabels: [{
                        enabled: isLabel,
                        formatter: function() {
                            return this.point.mon + '.' + Highcharts.numberFormat(this.point.y, 2,
                                    '.', ',') +
                                '</b>';
                        },
                    }]
                }
            },
            series: [{
                    name: getCurrentMonth(mes1) + ' ' + ano1,
                    data: chartLabels.map(function(item, index) {
                        return {
                            name: item, // nombre de la categoría
                            y: chartValues1[index], // valor correspondiente
                            mon: chartMon[index] // valor 'mon' correspondiente
                        };
                    })
                },
                {
                    name: getCurrentMonth(mes2) + ' ' + ano2,
                    data: chartLabels.map(function(item, index) {
                        return {
                            name: item, // nombre de la categoría
                            y: chartValues2[index], // valor correspondiente
                            mon: chartMon[index] // valor 'mon' correspondiente
                        };
                    })
                },
            ],
            exporting: {
                buttons: {
                    contextButton: {
                        menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
                    }
                },
                enabled: true,
                filename: 'Comparativo de ventas resumidas - Países',
                sourceWidth: 1600,
                sourceHeight: 900,
            }
        });
        const table = $("#tablePanel1").DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            },
            data: response.data,
            "columns": [{
                    data: "COMDES",
                    orderable: false,
                    width: "21%",
                    render: function(data, type, row) {
                        return '<span class="fw-bold">' + data + '</span>';
                    }
                },
                {
                    data: "ANO1",
                    className: "text-end",
                    width: "17%",
                    render: function(data, type, row) {
                        if (data == 0) {
                            return '<span class="text-danger fw-bold">' + row['MON'] + '.' + parseFloat(
                                data).toLocaleString('es-419', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }) + '</span>';
                        } else {
                            return '<span class="fw-bold">' + row['MON'] + '.' + parseFloat(data)
                                .toLocaleString('es-419', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }) + '</span>';
                        }
                    }
                },
                {
                    data: "ANO2",
                    className: "text-end",
                    width: "20%",
                    render: function(data, type, row) {
                        if (data == 0) {
                            return '<span class="text-danger fw-bold ">' + row['MON'] + '.' +
                                parseFloat(data).toLocaleString('es-419', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }) + '</span>';
                        } else {
                            return '<span class="fw-bold">' + row['MON'] + '.' + parseFloat(data)
                                .toLocaleString('es-419', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }) + '</span>';
                        }
                    }
                },
                {
                    data: "VARIA",
                    className: "text-end",
                    width: "21%",
                    render: function(data, type, row) {
                        if (data <= 0) {
                            return '<span class="text-danger fw-bold">' + row['MON'] + '.' + parseFloat(
                                data).toLocaleString('es-419', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }) + '</span>';
                        } else {
                            return '<span class="text-success fw-bold">' + row['MON'] + '.' +
                                parseFloat(data).toLocaleString('es-419', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }) + '</span>';
                        }
                    }
                },
                {
                    data: "CRECI",
                    className: "text-end",
                    width: "16%",
                    render: function(data, type, row) {
                        if (data <= 0) {
                            return '<span class="text-danger fw-bold">' + parseInt(data).toLocaleString(
                                'es-419', {
                                    minimumFractionDigits: 0,
                                    maximumFractionDigits: 0
                                }) + '%</span>';
                        } else {
                            return '<span class="text-success fw-bold">' + parseInt(data)
                                .toLocaleString('es-419', {
                                    minimumFractionDigits: 0,
                                    maximumFractionDigits: 0
                                }) + '%</span>';
                        }
                    }
                },
            ],
            "pageLength": 100,
            searching: false,
            ordering: false,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fa-solid fa-file-excel me-1"></i><b>Enviar a Excel</b>',
                    className: "btn btn-success text-light fs-6 mb-2",
                    title: 'Comparativo de ventas resumidas - Países',
                    customize: function(xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        var sSh = xlsx.xl['styles.xml'];
                        var lastXfIndex = $('cellXfs xf', sSh).length - 1;
                        var lastFontIndex = $('fonts font', sSh).length - 1;
                        var i;
                        var y;
                        var f1 = '<font>' +
                            '<sz val="11" />' +
                            '<name val="Calibri" />' +
                            '<color rgb="FF0000" />' + // color rojo en la fuente
                            '</font>';
                        var f2 = '<font>' +
                            '<sz val="11" />' +
                            '<name val="Calibri" />' +
                            '<color rgb="007800" />' + // color verde en la fuente
                            '</font>';

                        var n1 = '<numFmt formatCode="##0%"   numFmtId="300"/>';
                        var n2 = '<numFmt formatCode="#,##0.00"   numFmtId="200" />';
                        var s1 =
                            '<xf numFmtId="300" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>';
                        var s2 =
                            '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="center"/></xf>';
                        var s3 =
                            '<xf numFmtId="4" fontId="2" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>'
                        var s4 =
                            '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="center" wrapText="1"/></xf>'
                        var s5 = '<xf  numFmtId="200" fontId="' + (lastFontIndex + 1) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s6 = '<xf  numFmtId="200" fontId="' + (lastFontIndex + 2) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s7 = '<xf  numFmtId="300" fontId="' + (lastFontIndex + 1) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s8 = '<xf  numFmtId="300" fontId="' + (lastFontIndex + 2) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        sSh.childNodes[0].childNodes[0].innerHTML += n1 + n2;
                        sSh.childNodes[0].childNodes[1].innerHTML += f1 + f2;
                        sSh.childNodes[0].childNodes[5].innerHTML += s1 + s2 + s3 + s4 + s5 + s6 +
                            s7 + s8;

                        var fourDecPlaces = lastXfIndex + 1;
                        var greyBoldCentered = lastXfIndex + 2;
                        var twoDecPlacesBold = lastXfIndex + 3;
                        var greyBoldWrapText = lastXfIndex + 4;
                        var textred1 = lastXfIndex + 5;
                        var textgreen1 = lastXfIndex + 6;
                        var textred2 = lastXfIndex + 7;
                        var textgreen2 = lastXfIndex + 8;
                        $('c[r=A1] t', sheet).text(
                            'CONSULTA DE VENTAS RESUMIDAS POR PAÍS - MES VS MES ANTERIOR');
                        $('row:eq(0) c', sheet).attr('s', greyBoldCentered);
                        $('row:eq(1) c', sheet).attr('s', 7);
                        for (let index = 2; index <= 50; index++) {
                            $('row:eq(' + index + ') c[r^="B"]', sheet).attr('s', 52);
                            $('row:eq(' + index + ') c[r^="C"]', sheet).attr('s', 52);
                            $('row:eq(' + index + ') c[r^="D"]', sheet).attr('s', 52);
                            $('row:eq(' + index + ') c[r^="E"]', sheet).attr('s', 52);
                            if (parseFloat(($('row:eq(' + index + ') c[r^="D"]', sheet).text()).slice(
                                    2)) < 0) {
                                $('row:eq(' + index + ') c[r^="D"]', sheet).attr('s',
                                    textred1); //ROJO
                            } else {
                                $('row:eq(' + index + ') c[r^="D"]', sheet).attr('s',
                                    textgreen1); //VERDE
                            }
                            if (parseFloat($('row:eq(' + index + ') c[r^="E"]', sheet).text()) < 0) {
                        $('row:eq(' + index + ') c[r^="E"]', sheet).attr('s',
                            textred1); //ROJO
                    } else {
                        $('row:eq(' + index + ') c[r^="E"]', sheet).attr('s',
                            textgreen1); //VERDE
                    }
                            var tagName = sSh.getElementsByTagName('sz');
                            for (i = 0; i < tagName.length; i++) {
                                tagName[i].setAttribute("val", "13");
                            }
                        }
                    },
                },
            ],
            rowCallback: function(row, data) {
                if (data.VENDEDOR == '1' || data.VENDEDOR == '2') {
                    row.classList.add('bg-secondary2');
                }
            }
        });

        /* const detailRows = []
         table.on('click', 'tbody td.dt-control', function() {
             let tr = event.target.closest('tr');
             let row = table.row(tr);
             let idx = detailRows.indexOf(tr.id);
             var ct1=[];
             var ct1Values1=[];
             var ct1Values2=[];
             if (row.child.isShown()) {
                 tr.classList.remove('details');
                 row.child.hide();
                 detailRows.splice(idx, 1);
             } else {
                 tr.classList.add('details');
                 row.child(format(row.data().detalle)).show();
                 if (row.data().detalle.length == 0) {
                     ctx1.classList.add('d-none');
                 }else{
                     ctx1.classList.remove('d-none');
                     row.data().detalle.forEach(element => {
                     ct1.push(element.COMDES);
                     ct1Values1.push(parseFloat(element.ANO1));
                     ct1Values2.push(parseFloat(element.ANO2));
                 });
                 }

                 if (idx === -1) {
                     detailRows.push(tr.id);
                 }
                 setTimeout(() => {
                     let tds = document.querySelectorAll('td:has(table)');
                     tds.forEach(function(td) {
                         td.classList.add('p-0');
                         td.classList.add('m-0');
                     });
                 }, 1);
             }
             if (detailRows.length > 0) {
                 chart.update({
                 xAxis: {
                     categories: ct1,
                 },
                 plotOptions: {
                 column: {
                     depth: 25
                 },
                 series: {
                     dataLabels: [{
                         enabled: isLabel,
                         formatter: function() {
                             return 'D.' + Highcharts.numberFormat(this.point.y, 2, '.', ',') +
                                 '</b>';
                         },
                     }]
                 }
                 },
                 series: [{
                         name: getCurrentMonth(mes1) + ' ' + ano1 ,
                         data: ct1Values1
                     },
                     {
                         name: getCurrentMonth(mes2) + ' ' + ano2 ,
                         data: ct1Values2
                     }
                 ],
             });
             }else{
                 ctx1.classList.remove('d-none');
                 chart.update({
                 xAxis: {
                     categories: chartLabels
                 },
                 plotOptions: {
                 column: {
                     depth: 25
                 },
                 series: {
                     dataLabels: [{
                         enabled: isLabel,
                         formatter: function() {
                             return 'D.' + Highcharts.numberFormat(this.point.y, 2, '.', ',') +
                                 '</b>';
                         },
                     }]
                 }
                 },
                 series: [{
                         name: getCurrentMonth(mes1) + ' ' + ano1 ,
                         data: chartValues1
                     },
                     {
                         name: getCurrentMonth(mes2) + ' ' + ano2 ,
                         data: chartValues2
                     }
                 ],
             });
             }
         });

         function format(d) {
             if (d.length!=0) {
             var row = '';
             for (let i = 0; i < d.length; i++) {
                 row = row + `<tr class="">
                                 <td style="width:4%;"></td>

                                 <td style="width:21%;">` + d[i]['COMDES'] + `</td>`;
                 if (parseFloat(d[i]['ANO1']) == 0) {
                     row = row + `<td class="text-end text-danger" style="width:17%;">`;
                 } else {
                     row = row + `<td class="text-end" style="width:17%;">`;
                 }


                 row = row + d[i]['MON'] + '.' +
                     parseFloat(d[i]['ANO1']).toLocaleString('es-419', {
                         minimumFractionDigits: 2,
                         maximumFractionDigits: 2
                     }) + `</td>`;
                 if (parseFloat(d[i]['ANO2']) == 0) {
                     row = row + `<td class="text-end text-danger" style="width:20%;">`
                 } else {
                     row = row + `<td class="text-end" style="width:20%;">`
                 }

                 row = row + d[i]['MON'] + '.' +
                     parseFloat(d[i]['ANO2']).toLocaleString('es-419', {
                         minimumFractionDigits: 2,
                         maximumFractionDigits: 2
                     }) + `</td>`;
                 if (parseFloat(d[i]['VARIA']) <= 0) {
                     row = row + `<td class="text-end text-danger" style="width:21%;">`
                 } else {
                     row = row + `<td class="text-end" style="width:21%;">`
                 }

                 row = row + d[i]['MON'] + '.' +
                     parseFloat(d[i]['VARIA']).toLocaleString('es-419', {
                         minimumFractionDigits: 2,
                         maximumFractionDigits: 2
                     }) + `</td>`;

                 if (parseFloat(d[i]['CRECI']) <= 0) {
                     row = row + `<td class="text-end text-danger" style="width:16%;">`
                 } else {
                     row = row + `<td class="text-end" style="width:16%;">`
                 }

                 row = row + parseInt(d[i]['CRECI']).toLocaleString('es-419', {
                     minimumFractionDigits: 0,
                     maximumFractionDigits: 0
                 }) + `%</td>
                             </tr>`;
             }
             var table = `<table class="table bg-secondary2 m-0 p-0" style="width:100%">
                                 <tbody>
                                 ` + row + `
                                 </tbody>
                             </table>`;
              }else{
                 var table = `<table class="table bg-secondary2 m-0 p-0" style="width:100%">
                                 <tbody>
                                 <tr>
                                 <td class="text-center">No hay datos para mostrar</td>
                                 </tr>
                                 </tbody>
                             </table>`;
                 }
             return table;

         }*/

    }
    function chargeTab2(ano1, ano2, mes1, mes2) {
        mes1 = mes1.toString().padStart(2, '0');
        var filterBy = document.getElementById("filterBy");
        var showBy = document.getElementById("showBy");
        var url = 'http://172.16.15.20/API.LovablePHP/ZLO0020P/ListPanel2/?fechaFiltro=' + ano1 + mes1 + '01&usuario=' +
            usuario + '&case=' + dolar + '&vend=1&filtro=' + filterBy.value + '&mostrar=' + showBy.value + '';
        var response = ajaxRequest(url);
        var resultData = [];
        var chartLabels = [];
        var chartValues1 = [];
        var chartValues2 = [];
        var chartMon = [];
        if (response.code == 200) {
            response.data.sort(function(a, b) {
            if (a.CODSEC < b.CODSEC) {
                return -1;
            }
            if (a.CODSEC > b.CODSEC) {
                return 1;
            }
            return 0;
            });
            var count = 0;
            for (let i = 0; i < response.data.length; i++) {
                if (response.data[i]['VENDEDOR'] == 0) {
                    chartLabels.push(response.data[i]['COMDES']);
                    chartValues1.push(parseFloat(response.data[i]['ANO1']));
                    chartValues2.push(parseFloat(response.data[i]['ANO2']));
                    chartMon.push(response.data[i]['MON']);
                    response.data[i]['detalle'] = [];
                    resultData[count] = response.data[i];
                    count++;
                } else {
                    resultData[count - 1]['detalle'].push(response.data[i]);

                }
            }
        }
        resultData.sort(function(a, b) {
            if (a.CODSEC < b.CODSEC) {
                return -1;
            }
            if (a.CODSEC > b.CODSEC) {
                return 1;
            }
            return 0;
        });
        document.getElementById("panel2").innerHTML = '';
        document.getElementById("panel2").innerHTML =
            `  <div class="row">
                                    <div class="col-12" id="graficaTab2">
                                        <figure class="highcharts-figure ">
                                            <div id="ctx2" >
                                            </div>
                                        </figure>
                                    </div>
                                    <div class="col-12">
                                    <div class="container-fluid">
                                                            <div class="table-responsive">
                                                                <table id="tablePanel2" class="table stripe table-hover mt-2" style="width:100%" >
                                                                    <thead>
                                                                        <tr>
                                                                            <th style="width:21%;"></th>
                                                                            <th class="text-end" style="width:21.5%;">Venta ` +
            getCurrentMonth(mes1) + ' ' +
            ano1 +
            `</th>
                                                                            <th class="text-end" style="width:22.5%;">Venta ` +
            getCurrentMonth(mes2) + ' ' + ano2 + `</th>
                                                                            <th class="text-end" style="width:17.5%;">Variación</th>
                                                                            <th class="text-end" style="width:14.5%;">Crecimiento</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                    </div>
                            </div> `;

                            var currentDate = new Date();
        var yearSelected = getCookie('yearTab') || currentDate.getFullYear();
        var select = document.getElementById('setYearTab');
        var currentYear = new Date().getFullYear();
        select.value = yearSelected;


        var monthSelected = getCookie('mesTab') ||  currentDate.getMonth() + 1;
        var select = document.getElementById('setMesTab');
        var currentMonth = new Date().getMonth();
        var meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE',
            'NOVIEMBRE', 'DICIEMBRE'
        ];
        select.value = monthSelected;
        var isLabel = true;
        var pixelWidth = window.innerWidth;
        if (pixelWidth <= 600) {
            isLabel = false;
            graficaTab1.classList.add('d-none');
        } else {
            graficaTab1.classList.remove('d-none');
        }
        const chart = new Highcharts.Chart({
            chart: {
                renderTo: 'ctx2',
                type: 'column',

            },
            xAxis: {
                categories: chartLabels
            },
            yAxis: {
                min: 0,
                endOnTick: false,
                lineWidth: 1,
                title: {
                    text: ' '

                },
            },
            tooltip: {
                headerFormat: '<b>{point.key}</b><br>',
                pointFormat: 'Venta: {point.mon}.{point.y}'
            },
            title: {
                text: getCurrentMonth(mes1) + ' ' + ano1 + ' vs ' + getCurrentMonth(mes2) +
                    ' ' + ano2,
                align: 'center'
            },
            lang: {
                viewFullscreen: "Ver en pantalla completa",
                exitFullscreen: "Salir de pantalla completa",
                downloadJPEG: "Descargar imagen JPEG",
                downloadPDF: "Descargar en PDF",
            },
            subtitle: {
                text: 'Lovable de Honduras',
                align: 'left'
            },
            credits: {
                enabled: false
            },
            legend: {
                enabled: true
            },
            plotOptions: {
                column: {
                    depth: 25
                },
                series: {
                    dataLabels: [{
                        enabled: isLabel,
                        formatter: function() {
                            return this.point.mon + '.' + Highcharts.numberFormat(this.point.y, 2,
                                    '.', ',') +
                                '</b>';
                        },
                    }]
                }
            },
            series: [{
                    name: getCurrentMonth(mes1) + ' ' + ano1,
                    data: chartLabels.map(function(item, index) {
                        return {
                            name: item, // nombre de la categoría
                            y: chartValues1[index], // valor correspondiente
                            mon: chartMon[index] // valor 'mon' correspondiente
                        };
                    })
                },
                {
                    name: getCurrentMonth(mes2) + ' ' + ano2,
                    data: chartLabels.map(function(item, index) {
                        return {
                            name: item, // nombre de la categoría
                            y: chartValues2[index], // valor correspondiente
                            mon: chartMon[index] // valor 'mon' correspondiente
                        };
                    })
                },
            ],
            exporting: {
                buttons: {
                    contextButton: {
                        menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
                    }
                },
                enabled: true,
                filename: 'Comparativo de ventas resumidas - Países',
                sourceWidth: 1600,
                sourceHeight: 900,
            }
        });
        const table = $("#tablePanel2").DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            },
            data: response.data,
            "columns": [{
                    data: "COMDES",
                    orderable: false,
                    width: "21%",
                    render: function(data, type, row) {
                        return '<span class="fw-bold">' + data + '</span>';
                    }
                },
                {
                    data: "ANO1",
                    className: "text-end",
                    width: "17%",
                    render: function(data, type, row) {
                        if (data == 0) {
                            return '<span class="text-danger fw-bold">' + row['MON'] + '.' + parseFloat(
                                data).toLocaleString('es-419', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }) + '</span>';
                        } else {
                            return '<span class="fw-bold">' + row['MON'] + '.' + parseFloat(data)
                                .toLocaleString('es-419', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }) + '</span>';
                        }
                    }
                },
                {
                    data: "ANO2",
                    className: "text-end",
                    width: "20%",
                    render: function(data, type, row) {
                        if (data == 0) {
                            return '<span class="text-danger fw-bold ">' + row['MON'] + '.' +
                                parseFloat(data).toLocaleString('es-419', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }) + '</span>';
                        } else {
                            return '<span class="fw-bold">' + row['MON'] + '.' + parseFloat(data)
                                .toLocaleString('es-419', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }) + '</span>';
                        }
                    }
                },
                {
                    data: "VARIA",
                    className: "text-end",
                    width: "21%",
                    render: function(data, type, row) {
                        if (data <= 0) {
                            return '<span class="text-danger fw-bold">' + row['MON'] + '.' + parseFloat(
                                data).toLocaleString('es-419', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }) + '</span>';
                        } else {
                            return '<span class="text-success fw-bold">' + row['MON'] + '.' +
                                parseFloat(data).toLocaleString('es-419', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }) + '</span>';
                        }
                    }
                },
                {
                    data: "CRECI",
                    className: "text-end",
                    width: "16%",
                    render: function(data, type, row) {
                        if (data <= 0) {
                            return '<span class="text-danger fw-bold">' + parseInt(data).toLocaleString(
                                'es-419', {
                                    minimumFractionDigits: 0,
                                    maximumFractionDigits: 0
                                }) + '%</span>';
                        } else {
                            return '<span class="text-success fw-bold">' + parseInt(data)
                                .toLocaleString('es-419', {
                                    minimumFractionDigits: 0,
                                    maximumFractionDigits: 0
                                }) + '%</span>';
                        }
                    }
                },
            ],
            "pageLength": 100,
            searching: false,
            ordering: false,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fa-solid fa-file-excel me-1"></i><b>Enviar a Excel</b>',
                    className: "btn btn-success text-light fs-6 mb-2",
                    title: 'Comparativo de ventas resumidas - Países',
                    customize: function(xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        var sSh = xlsx.xl['styles.xml'];
                        var lastXfIndex = $('cellXfs xf', sSh).length - 1;
                        var lastFontIndex = $('fonts font', sSh).length - 1;
                        var i;
                        var y;
                        var f1 = '<font>' +
                            '<sz val="11" />' +
                            '<name val="Calibri" />' +
                            '<color rgb="FF0000" />' + // color rojo en la fuente
                            '</font>';
                        var f2 = '<font>' +
                            '<sz val="11" />' +
                            '<name val="Calibri" />' +
                            '<color rgb="007800" />' + // color verde en la fuente
                            '</font>';

                        var n1 = '<numFmt formatCode="##0%"   numFmtId="300"/>';
                        var n2 = '<numFmt formatCode="#,##0.00"   numFmtId="200" />';
                        var s1 =
                            '<xf numFmtId="300" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>';
                        var s2 =
                            '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="center"/></xf>';
                        var s3 =
                            '<xf numFmtId="4" fontId="2" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>'
                        var s4 =
                            '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="center" wrapText="1"/></xf>'
                        var s5 = '<xf  numFmtId="200" fontId="' + (lastFontIndex + 1) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s6 = '<xf  numFmtId="200" fontId="' + (lastFontIndex + 2) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s7 = '<xf  numFmtId="300" fontId="' + (lastFontIndex + 1) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s8 = '<xf  numFmtId="300" fontId="' + (lastFontIndex + 2) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        sSh.childNodes[0].childNodes[0].innerHTML += n1 + n2;
                        sSh.childNodes[0].childNodes[1].innerHTML += f1 + f2;
                        sSh.childNodes[0].childNodes[5].innerHTML += s1 + s2 + s3 + s4 + s5 + s6 +
                            s7 + s8;

                        var fourDecPlaces = lastXfIndex + 1;
                        var greyBoldCentered = lastXfIndex + 2;
                        var twoDecPlacesBold = lastXfIndex + 3;
                        var greyBoldWrapText = lastXfIndex + 4;
                        var textred1 = lastXfIndex + 5;
                        var textgreen1 = lastXfIndex + 6;
                        var textred2 = lastXfIndex + 7;
                        var textgreen2 = lastXfIndex + 8;
                        $('c[r=A1] t', sheet).text(
                            'CONSULTA DE VENTAS RESUMIDAS POR PAÍS - MES VS MISMO MES DEL AÑO ANTERIOR');
                        $('row:eq(0) c', sheet).attr('s', greyBoldCentered);
                        $('row:eq(1) c', sheet).attr('s', 7);
                        for (let index = 2; index <= 50; index++) {
                            $('row:eq(' + index + ') c[r^="B"]', sheet).attr('s', 52);
                            $('row:eq(' + index + ') c[r^="C"]', sheet).attr('s', 52);
                            $('row:eq(' + index + ') c[r^="D"]', sheet).attr('s', 52);
                            $('row:eq(' + index + ') c[r^="E"]', sheet).attr('s', 52);
                            if (parseFloat(($('row:eq(' + index + ') c[r^="D"]', sheet).text()).slice(
                                    2)) < 0) {
                                $('row:eq(' + index + ') c[r^="D"]', sheet).attr('s',
                                    textred1); //ROJO
                            } else {
                                $('row:eq(' + index + ') c[r^="D"]', sheet).attr('s',
                                    textgreen1); //VERDE
                            }
                            if (parseFloat($('row:eq(' + index + ') c[r^="E"]', sheet).text()) < 0) {
                        $('row:eq(' + index + ') c[r^="E"]', sheet).attr('s',
                            textred1); //ROJO
                    } else {
                        $('row:eq(' + index + ') c[r^="E"]', sheet).attr('s',
                            textgreen1); //VERDE
                    }
                            var tagName = sSh.getElementsByTagName('sz');
                            for (i = 0; i < tagName.length; i++) {
                                tagName[i].setAttribute("val", "13");
                            }
                        }
                    },
                },

            ],
            rowCallback: function(row, data) {
                if (data.VENDEDOR == '1' || data.VENDEDOR == '2') {
                    row.classList.add('bg-secondary2');
                }
                $(row).on('dblclick', function() {

                });
            }
        });
        /* const detailRows = []
         table.on('click', 'tbody td.dt-control', function() {
             let tr = event.target.closest('tr');
             let row = table.row(tr);
             let idx = detailRows.indexOf(tr.id);
             var ct1=[];
             var ct1Values1=[];
             var ct1Values2=[];
             if (row.child.isShown()) {
                 tr.classList.remove('details');
                 row.child.hide();
                 detailRows.splice(idx, 1);
             } else {
                 tr.classList.add('details');
                 row.child(format(row.data().detalle)).show();
                 if (row.data().detalle.length == 0) {
                     ctx1.classList.add('d-none');
                 }else{
                     ctx1.classList.remove('d-none');
                     row.data().detalle.forEach(element => {
                     ct1.push(element.COMDES);
                     ct1Values1.push(parseFloat(element.ANO1));
                     ct1Values2.push(parseFloat(element.ANO2));
                 });
                 }

                 if (idx === -1) {
                     detailRows.push(tr.id);
                 }
                 setTimeout(() => {
                     let tds = document.querySelectorAll('td:has(table)');
                     tds.forEach(function(td) {
                         td.classList.add('p-0');
                         td.classList.add('m-0');
                     });
                 }, 1);
             }
             if (detailRows.length > 0) {
                 chart.update({
                 xAxis: {
                     categories: ct1,
                 },
                 plotOptions: {
                 column: {
                     depth: 25
                 },
                 series: {
                     dataLabels: [{
                         enabled: isLabel,
                         formatter: function() {
                             return 'D.' + Highcharts.numberFormat(this.point.y, 2, '.', ',') +
                                 '</b>';
                         },
                     }]
                 }
                 },
                 series: [{
                         name: getCurrentMonth(mes1) + ' ' + ano1 ,
                         data: ct1Values1
                     },
                     {
                         name: getCurrentMonth(mes2) + ' ' + ano2 ,
                         data: ct1Values2
                     }
                 ],
             });
             }else{
                 ctx1.classList.remove('d-none');
                 chart.update({
                 xAxis: {
                     categories: chartLabels
                 },
                 plotOptions: {
                 column: {
                     depth: 25
                 },
                 series: {
                     dataLabels: [{
                         enabled: isLabel,
                         formatter: function() {
                             return 'D.' + Highcharts.numberFormat(this.point.y, 2, '.', ',') +
                                 '</b>';
                         },
                     }]
                 }
                 },
                 series: [{
                         name: getCurrentMonth(mes1) + ' ' + ano1,
                         data: chartValues1
                     },
                     {
                         name: getCurrentMonth(mes2) + ' ' + ano2,
                         data: chartValues2
                     }
                 ],
             });
             }
         });
         function format(d) {
             if (d.length!=0) {
             var row = '';
             for (let i = 0; i < d.length; i++) {
                 row = row + `<tr class="">
                                 <td style="width:4%;"></td>

                                 <td style="width:21%;">` + d[i]['COMDES'] + `</td>`;
                 if (parseFloat(d[i]['ANO1']) == 0) {
                     row = row + `<td class="text-end text-danger" style="width:17%;">`;
                 } else {
                     row = row + `<td class="text-end" style="width:17%;">`;
                 }


                 row = row + d[i]['MON'] + '.' +
                     parseFloat(d[i]['ANO1']).toLocaleString('es-419', {
                         minimumFractionDigits: 2,
                         maximumFractionDigits: 2
                     }) + `</td>`;
                 if (parseFloat(d[i]['ANO2']) == 0) {
                     row = row + `<td class="text-end text-danger" style="width:20%;">`
                 } else {
                     row = row + `<td class="text-end" style="width:20%;">`
                 }

                 row = row + d[i]['MON'] + '.' +
                     parseFloat(d[i]['ANO2']).toLocaleString('es-419', {
                         minimumFractionDigits: 2,
                         maximumFractionDigits: 2
                     }) + `</td>`;
                 if (parseFloat(d[i]['VARIA']) <= 0) {
                     row = row + `<td class="text-end text-danger" style="width:21%;">`
                 } else {
                     row = row + `<td class="text-end" style="width:21%;">`
                 }

                 row = row + d[i]['MON'] + '.' +
                     parseFloat(d[i]['VARIA']).toLocaleString('es-419', {
                         minimumFractionDigits: 2,
                         maximumFractionDigits: 2
                     }) + `</td>`;

                 if (parseFloat(d[i]['CRECI']) <= 0) {
                     row = row + `<td class="text-end text-danger" style="width:16%;">`
                 } else {
                     row = row + `<td class="text-end" style="width:16%;">`
                 }

                 row = row + parseInt(d[i]['CRECI']).toLocaleString('es-419', {
                     minimumFractionDigits: 0,
                     maximumFractionDigits: 0
                 }) + `%</td>
                             </tr>`;
             }
             var table = `<table class="table bg-secondary2 m-0 p-0" style="width:100%">
                                 <tbody>
                                 ` + row + `
                                 </tbody>
                             </table>`;
              }else{
                 var table = `<table class="table bg-secondary2 m-0 p-0" style="width:100%">
                                 <tbody>
                                 <tr>
                                 <td class="text-center">No hay datos para mostrar</td>
                                 </tr>
                                 </tbody>
                             </table>`;
                 }
             return table;

         }*/

    }
    function chargeTab3(ano1, ano2) {
        var filterBy = document.getElementById("filterBy");
        var showBy = document.getElementById("showBy");
        var url = 'http://172.16.15.20/API.LovablePHP/ZLO0020P/ListPanel3/?fechaFiltro=' + ano1 + mes1 + '01&usuario=' +
            usuario + '&case=' + dolar + '&vend=1&filtro=' + filterBy.value + '&mostrar=' + showBy.value + '';
        var response = ajaxRequest(url);
        var resultData = [];
        var chartLabels = [];
        var chartValues1 = [];
        var chartValues2 = [];
        var chartMon = [];
        if (response.code == 200) {
            response.data.sort(function(a, b) {
            if (a.CODSEC < b.CODSEC) {
                return -1;
            }
            if (a.CODSEC > b.CODSEC) {
                return 1;
            }
            return 0;
            });
            var count = 0;
            for (let i = 0; i < response.data.length; i++) {
                if (response.data[i]['VENDEDOR'] == 0) {
                    chartLabels.push(response.data[i]['COMDES']);
                    chartValues1.push(parseFloat(response.data[i]['ANO1']));
                    chartValues2.push(parseFloat(response.data[i]['ANO2']));
                    chartMon.push(response.data[i]['MON']);
                    response.data[i]['detalle'] = [];
                    resultData[count] = response.data[i];
                    count++;
                } else {
                    resultData[count - 1]['detalle'].push(response.data[i]);

                }
            }
        }
        resultData.sort(function(a, b) {
            if (a.CODSEC < b.CODSEC) {
                return -1;
            }
            if (a.CODSEC > b.CODSEC) {
                return 1;
            }
            return 0;
        });
        document.getElementById("panel3").innerHTML = '';
        document.getElementById("panel3").innerHTML =
            `  <div class="row">
                                    <div class="col-12" id="graficaTab2">
                                        <figure class="highcharts-figure ">
                                            <div id="ctx3" >
                                            </div>
                                        </figure>
                                    </div>
                                    <div class="col-12">
                                    <div class="container-fluid">
                                                            <div class="table-responsive">
                                                                <table id="tablePanel3" class="table stripe table-hover mt-2" style="width:100%" >
                                                                    <thead>
                                                                        <tr>
                                                                            <th style="width:21%;"></th>
                                                                            <th class="text-end" style="width:21.5%;">Venta ` +
            'Año ' +
            ano1 +
            `</th>
                                                                            <th class="text-end" style="width:22.5%;">Venta ` +
            'Año ' + ano2 + `</th>
                                                                            <th class="text-end" style="width:17.5%;">Variación</th>
                                                                            <th class="text-end" style="width:14.5%;">Crecimiento</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                    </div>
                            </div> `;
                            var currentDate = new Date();
        var yearSelected = getCookie('yearTab') || currentDate.getFullYear();
        var select = document.getElementById('setYearTab');
        var currentYear = new Date().getFullYear();
        select.value = yearSelected;
        var isLabel = true;
        var pixelWidth = window.innerWidth;
        if (pixelWidth <= 600) {
            isLabel = false;
            graficaTab1.classList.add('d-none');
        } else {
            graficaTab1.classList.remove('d-none');
        }
        const chart = new Highcharts.Chart({
            chart: {
                renderTo: 'ctx3',
                type: 'column',

            },
            xAxis: {
                categories: chartLabels
            },
            yAxis: {
                min: 0,
                endOnTick: false,
                lineWidth: 1,
                title: {
                    text: ' '

                },
            },
            tooltip: {
                headerFormat: '<b>{point.key}</b><br>',
                pointFormat: 'Venta: {point.mon}.{point.y}'
            },
            title: {
                text: 'Año ' + ano1 + ' vs ' + 'Año ' + ano2,
                align: 'center'
            },
            lang: {
                viewFullscreen: "Ver en pantalla completa",
                exitFullscreen: "Salir de pantalla completa",
                downloadJPEG: "Descargar imagen JPEG",
                downloadPDF: "Descargar en PDF",
            },
            subtitle: {
                text: 'Lovable de Honduras',
                align: 'left'
            },
            credits: {
                enabled: false
            },
            legend: {
                enabled: true
            },
            plotOptions: {
                column: {
                    depth: 25
                },
                series: {
                    dataLabels: [{
                        enabled: isLabel,
                        formatter: function() {
                            return this.point.mon + '.' + Highcharts.numberFormat(this.point.y, 2,
                                    '.', ',') +
                                '</b>';
                        },
                    }]
                }
            },
            series: [{
                    name: 'Año ' + ano1,
                    data: chartLabels.map(function(item, index) {
                        return {
                            name: item, // nombre de la categoría
                            y: chartValues1[index], // valor correspondiente
                            mon: chartMon[index] // valor 'mon' correspondiente
                        };
                    })
                },
                {
                    name: 'Año ' + ano2,
                    data: chartLabels.map(function(item, index) {
                        return {
                            name: item, // nombre de la categoría
                            y: chartValues2[index], // valor correspondiente
                            mon: chartMon[index] // valor 'mon' correspondiente
                        };
                    })
                },
            ],
            exporting: {
                buttons: {
                    contextButton: {
                        menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
                    }
                },
                enabled: true,
                filename: 'Comparativo de ventas resumidas - Países',
                sourceWidth: 1600,
                sourceHeight: 900,
            }
        });
        const table = $("#tablePanel3").DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            },
            data: response.data,
            "columns": [{
                    data: "COMDES",
                    orderable: false,
                    width: "21%",
                    render: function(data, type, row) {
                        return '<span class="fw-bold">' + data + '</span>';
                    }
                },
                {
                    data: "ANO1",
                    className: "text-end",
                    width: "17%",
                    render: function(data, type, row) {
                        if (data == 0) {
                            return '<span class="text-danger fw-bold">' + row['MON'] + '.' + parseFloat(
                                data).toLocaleString('es-419', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }) + '</span>';
                        } else {
                            return '<span class="fw-bold">' + row['MON'] + '.' + parseFloat(data)
                                .toLocaleString('es-419', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }) + '</span>';
                        }
                    }
                },
                {
                    data: "ANO2",
                    className: "text-end",
                    width: "20%",
                    render: function(data, type, row) {
                        if (data == 0) {
                            return '<span class="text-danger fw-bold ">' + row['MON'] + '.' +
                                parseFloat(data).toLocaleString('es-419', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }) + '</span>';
                        } else {
                            return '<span class="fw-bold">' + row['MON'] + '.' + parseFloat(data)
                                .toLocaleString('es-419', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }) + '</span>';
                        }
                    }
                },
                {
                    data: "VARIA",
                    className: "text-end",
                    width: "21%",
                    render: function(data, type, row) {
                        if (data <= 0) {
                            return '<span class="text-danger fw-bold">' + row['MON'] + '.' + parseFloat(
                                data).toLocaleString('es-419', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }) + '</span>';
                        } else {
                            return '<span class="text-success fw-bold">' + row['MON'] + '.' +
                                parseFloat(data).toLocaleString('es-419', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }) + '</span>';
                        }
                    }
                },
                {
                    data: "CRECI",
                    className: "text-end",
                    width: "16%",
                    render: function(data, type, row) {
                        if (data <= 0) {
                            return '<span class="text-danger fw-bold">' + parseInt(data).toLocaleString(
                                'es-419', {
                                    minimumFractionDigits: 0,
                                    maximumFractionDigits: 0
                                }) + '%</span>';
                        } else {
                            return '<span class="text-success fw-bold">' + parseInt(data)
                                .toLocaleString('es-419', {
                                    minimumFractionDigits: 0,
                                    maximumFractionDigits: 0
                                }) + '%</span>';
                        }
                    }
                },
            ],
            "pageLength": 100,
            searching: false,
            ordering: false,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fa-solid fa-file-excel me-1"></i><b>Enviar a Excel</b>',
                    className: "btn btn-success text-light fs-6 mb-2",
                    title: 'Comparativo de ventas resumidas - Países',
                    customize: function(xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        var sSh = xlsx.xl['styles.xml'];
                        var lastXfIndex = $('cellXfs xf', sSh).length - 1;
                        var lastFontIndex = $('fonts font', sSh).length - 1;
                        var i;
                        var y;
                        var f1 = '<font>' +
                            '<sz val="11" />' +
                            '<name val="Calibri" />' +
                            '<color rgb="FF0000" />' + // color rojo en la fuente
                            '</font>';
                        var f2 = '<font>' +
                            '<sz val="11" />' +
                            '<name val="Calibri" />' +
                            '<color rgb="007800" />' + // color verde en la fuente
                            '</font>';

                        var n1 = '<numFmt formatCode="##0%"   numFmtId="300"/>';
                        var n2 = '<numFmt formatCode="#,##0.00"   numFmtId="200" />';
                        var s1 =
                            '<xf numFmtId="300" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>';
                        var s2 =
                            '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="center"/></xf>';
                        var s3 =
                            '<xf numFmtId="4" fontId="2" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>'
                        var s4 =
                            '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="center" wrapText="1"/></xf>'
                        var s5 = '<xf  numFmtId="200" fontId="' + (lastFontIndex + 1) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s6 = '<xf  numFmtId="200" fontId="' + (lastFontIndex + 2) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s7 = '<xf  numFmtId="300" fontId="' + (lastFontIndex + 1) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s8 = '<xf  numFmtId="300" fontId="' + (lastFontIndex + 2) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        sSh.childNodes[0].childNodes[0].innerHTML += n1 + n2;
                        sSh.childNodes[0].childNodes[1].innerHTML += f1 + f2;
                        sSh.childNodes[0].childNodes[5].innerHTML += s1 + s2 + s3 + s4 + s5 + s6 +
                            s7 + s8;

                        var fourDecPlaces = lastXfIndex + 1;
                        var greyBoldCentered = lastXfIndex + 2;
                        var twoDecPlacesBold = lastXfIndex + 3;
                        var greyBoldWrapText = lastXfIndex + 4;
                        var textred1 = lastXfIndex + 5;
                        var textgreen1 = lastXfIndex + 6;
                        var textred2 = lastXfIndex + 7;
                        var textgreen2 = lastXfIndex + 8;
                        $('c[r=A1] t', sheet).text(
                            'CONSULTA DE VENTAS RESUMIDAS POR PAÍS - ANUAL TODO EL AÑO');
                        $('row:eq(0) c', sheet).attr('s', greyBoldCentered);
                        $('row:eq(1) c', sheet).attr('s', 7);
                        for (let index = 2; index <= 50; index++) {
                            $('row:eq(' + index + ') c[r^="B"]', sheet).attr('s', 52);
                            $('row:eq(' + index + ') c[r^="C"]', sheet).attr('s', 52);
                            $('row:eq(' + index + ') c[r^="D"]', sheet).attr('s', 52);
                            $('row:eq(' + index + ') c[r^="E"]', sheet).attr('s', 52);
                            if (parseFloat(($('row:eq(' + index + ') c[r^="D"]', sheet).text()).slice(
                                    2)) < 0) {
                                $('row:eq(' + index + ') c[r^="D"]', sheet).attr('s',
                                    textred1); //ROJO
                            } else {
                                $('row:eq(' + index + ') c[r^="D"]', sheet).attr('s',
                                    textgreen1); //VERDE
                            }
                            if (parseFloat($('row:eq(' + index + ') c[r^="E"]', sheet).text()) < 0) {
                        $('row:eq(' + index + ') c[r^="E"]', sheet).attr('s',
                            textred1); //ROJO
                    } else {
                        $('row:eq(' + index + ') c[r^="E"]', sheet).attr('s',
                            textgreen1); //VERDE
                    }
                            var tagName = sSh.getElementsByTagName('sz');
                            for (i = 0; i < tagName.length; i++) {
                                tagName[i].setAttribute("val", "13");
                            }
                        }
                    },
                },

            ],
            rowCallback: function(row, data) {
                if (data.VENDEDOR == '1' || data.VENDEDOR == '2') {
                    row.classList.add('bg-secondary2');
                }
                $(row).on('dblclick', function() {

                });
            }
        });
        /*const detailRows = []
        table.on('click', 'tbody td.dt-control', function() {
            let tr = event.target.closest('tr');
            let row = table.row(tr);
            let idx = detailRows.indexOf(tr.id);
            var ct1=[];
            var ct1Values1=[];
            var ct1Values2=[];
            if (row.child.isShown()) {
                tr.classList.remove('details');
                row.child.hide();
                detailRows.splice(idx, 1);
            } else {
                tr.classList.add('details');
                row.child(format(row.data().detalle)).show();
                if (row.data().detalle.length == 0) {
                    ctx1.classList.add('d-none');
                }else{
                    ctx1.classList.remove('d-none');
                    row.data().detalle.forEach(element => {
                    ct1.push(element.COMDES);
                    ct1Values1.push(parseFloat(element.ANO1));
                    ct1Values2.push(parseFloat(element.ANO2));
                });
                }

                if (idx === -1) {
                    detailRows.push(tr.id);
                }
                setTimeout(() => {
                    let tds = document.querySelectorAll('td:has(table)');
                    tds.forEach(function(td) {
                        td.classList.add('p-0');
                        td.classList.add('m-0');
                    });
                }, 1);
            }
            if (detailRows.length > 0) {
                chart.update({
                xAxis: {
                    categories: ct1,
                },
                plotOptions: {
                column: {
                    depth: 25
                },
                series: {
                    dataLabels: [{
                        enabled: isLabel,
                        formatter: function() {
                            return 'D.' + Highcharts.numberFormat(this.point.y, 2, '.', ',') +
                                '</b>';
                        },
                    }]
                }
                },
                series: [{
                        name: getCurrentMonth(mes1) + ' ' + ano1 ,
                        data: ct1Values1
                    },
                    {
                        name: getCurrentMonth(mes2) + ' ' + ano2 ,
                        data: ct1Values2
                    }
                ],
            });
            }else{
                ctx1.classList.remove('d-none');
                chart.update({
                xAxis: {
                    categories: chartLabels
                },
                plotOptions: {
                column: {
                    depth: 25
                },
                series: {
                    dataLabels: [{
                        enabled: isLabel,
                        formatter: function() {
                            return 'D.' + Highcharts.numberFormat(this.point.y, 2, '.', ',') +
                                '</b>';
                        },
                    }]
                }
                },
                series: [{
                        name: getCurrentMonth(mes1) + ' ' + ano1,
                        data: chartValues1
                    },
                    {
                        name: getCurrentMonth(mes2) + ' ' + ano2,
                        data: chartValues2
                    }
                ],
            });
            }
        });
        function format(d) {
            if (d.length!=0) {
            var row = '';
            for (let i = 0; i < d.length; i++) {
                row = row + `<tr class="">
                                <td style="width:4%;"></td>

                                <td style="width:21%;">` + d[i]['COMDES'] + `</td>`;
                if (parseFloat(d[i]['ANO1']) == 0) {
                    row = row + `<td class="text-end text-danger" style="width:17%;">`;
                } else {
                    row = row + `<td class="text-end" style="width:17%;">`;
                }


                row = row + d[i]['MON'] + '.' +
                    parseFloat(d[i]['ANO1']).toLocaleString('es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + `</td>`;
                if (parseFloat(d[i]['ANO2']) == 0) {
                    row = row + `<td class="text-end text-danger" style="width:20%;">`
                } else {
                    row = row + `<td class="text-end" style="width:20%;">`
                }

                row = row + d[i]['MON'] + '.' +
                    parseFloat(d[i]['ANO2']).toLocaleString('es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + `</td>`;
                if (parseFloat(d[i]['VARIA']) <= 0) {
                    row = row + `<td class="text-end text-danger" style="width:21%;">`
                } else {
                    row = row + `<td class="text-end" style="width:21%;">`
                }

                row = row + d[i]['MON'] + '.' +
                    parseFloat(d[i]['VARIA']).toLocaleString('es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + `</td>`;

                if (parseFloat(d[i]['CRECI']) <= 0) {
                    row = row + `<td class="text-end text-danger" style="width:16%;">`
                } else {
                    row = row + `<td class="text-end" style="width:16%;">`
                }

                row = row + parseInt(d[i]['CRECI']).toLocaleString('es-419', {
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }) + `%</td>
                            </tr>`;
            }
            var table = `<table class="table bg-secondary2 m-0 p-0" style="width:100%">
                                <tbody>
                                ` + row + `
                                </tbody>
                            </table>`;
             }else{
                var table = `<table class="table bg-secondary2 m-0 p-0" style="width:100%">
                                <tbody>
                                <tr>
                                <td class="text-center">No hay datos para mostrar</td>
                                </tr>
                                </tbody>
                            </table>`;
                }
            return table;

        }*/
    }
    function chargeTab4(ano1, ano2, mes1) {
        var filterBy = document.getElementById("filterBy");
        var showBy = document.getElementById("showBy");
        var url = 'http://172.16.15.20/API.LovablePHP/ZLO0020P/ListPanel4/?fechaFiltro=' + ano1 + mes1 + '01&usuario=' +
            usuario + '&case=' + dolar + '&vend=1&filtro=' + filterBy.value + '&mostrar=' + showBy.value + '';
        var response = ajaxRequest(url);
        var resultData = [];
        var chartLabels = [];
        var chartValues1 = [];
        var chartValues2 = [];
        var chartMon = [];
        if (response.code == 200) {
            response.data.sort(function(a, b) {
            if (a.CODSEC < b.CODSEC) {
                return -1;
            }
            if (a.CODSEC > b.CODSEC) {
                return 1;
            }
            return 0;
            });
            var count = 0;
            for (let i = 0; i < response.data.length; i++) {
                if (response.data[i]['VENDEDOR'] == 0) {
                    chartLabels.push(response.data[i]['COMDES']);
                    chartValues1.push(parseFloat(response.data[i]['ANO1']));
                    chartValues2.push(parseFloat(response.data[i]['ANO2']));
                    chartMon.push(response.data[i]['MON']);
                    response.data[i]['detalle'] = [];
                    resultData[count] = response.data[i];
                    count++;
                } else {
                    resultData[count - 1]['detalle'].push(response.data[i]);

                }
            }
        }
        resultData.sort(function(a, b) {
            if (a.CODSEC < b.CODSEC) {
                return -1;
            }
            if (a.CODSEC > b.CODSEC) {
                return 1;
            }
            return 0;
        });
        document.getElementById("panel4").innerHTML = '';
        document.getElementById("panel4").innerHTML =
            `  <div class="row">
                                    <div class="col-12" id="graficaTab2">
                                        <figure class="highcharts-figure ">
                                            <div id="ctx4" >
                                            </div>
                                        </figure>
                                    </div>
                                    <div class="col-12">
                                    <div class="container-fluid">
                                                            <div class="table-responsive">
                                                                <table id="tablePanel4" class="table stripe table-hover mt-2" style="width:100%" >
                                                                    <thead>
                                                                        <tr>
                                                                            <th style="width:21%;"></th>
                                                                            <th class="text-end" style="width:21.5%;">Venta ` +
            'Año ' +
            ano1 +
            `</th>
                                                                            <th class="text-end" style="width:22.5%;">Venta ` +
            'Año ' + ano2 + `</th>
                                                                            <th class="text-end" style="width:17.5%;">Variación</th>
                                                                            <th class="text-end" style="width:14.5%;">Crecimiento</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                    </div>
                            </div> `;
        var currentDate = new Date();
        var yearSelected = getCookie('yearTab') || currentDate.getFullYear();
        var select = document.getElementById('setYearTab');
        var currentYear = new Date().getFullYear();
        select.value = yearSelected;
        var monthSelected = getCookie('mesTab') || currentDate.getMonth() + 1;
        var select = document.getElementById('setMesTab');
        var currentMonth = new Date().getMonth();
        var meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE',
            'NOVIEMBRE', 'DICIEMBRE'
        ];
        select.value = monthSelected;
        var isLabel = true;
        var pixelWidth = window.innerWidth;
        if (pixelWidth <= 600) {
            isLabel = false;
            graficaTab1.classList.add('d-none');
        } else {
            graficaTab1.classList.remove('d-none');
        }
        const chart = new Highcharts.Chart({
            chart: {
                renderTo: 'ctx4',
                type: 'column',

            },
            xAxis: {
                categories: chartLabels
            },
            yAxis: {
                min: 0,
                endOnTick: false,
                lineWidth: 1,
                title: {
                    text: ' '

                },
            },
            tooltip: {
                headerFormat: '<b>{point.key}</b><br>',
                pointFormat: 'Venta: {point.mon}.{point.y}'
            },
            title: {
                text: 'Año ' + ano1 + ' vs ' + 'Año ' + ano2 + ' hasta el mes: ' + getCurrentMonth(mes1),
                align: 'center'
            },
            lang: {
                viewFullscreen: "Ver en pantalla completa",
                exitFullscreen: "Salir de pantalla completa",
                downloadJPEG: "Descargar imagen JPEG",
                downloadPDF: "Descargar en PDF",
            },
            subtitle: {
                text: 'Lovable de Honduras',
                align: 'left'
            },
            credits: {
                enabled: false
            },
            legend: {
                enabled: true
            },
            plotOptions: {
                column: {
                    depth: 25
                },
                series: {
                    dataLabels: [{
                        enabled: isLabel,
                        formatter: function() {
                            return this.point.mon + '.' + Highcharts.numberFormat(this.point.y, 2,
                                    '.', ',') +
                                '</b>';
                        },
                    }]
                }
            },
            series: [{
                    name: 'Año ' + ano1,
                    data: chartLabels.map(function(item, index) {
                        return {
                            name: item, // nombre de la categoría
                            y: chartValues1[index], // valor correspondiente
                            mon: chartMon[index] // valor 'mon' correspondiente
                        };
                    })
                },
                {
                    name: 'Año ' + ano2,
                    data: chartLabels.map(function(item, index) {
                        return {
                            name: item, // nombre de la categoría
                            y: chartValues2[index], // valor correspondiente
                            mon: chartMon[index] // valor 'mon' correspondiente
                        };
                    })
                },
            ],
            exporting: {
                buttons: {
                    contextButton: {
                        menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
                    }
                },
                enabled: true,
                filename: 'Comparativo de ventas resumidas - Países',
                sourceWidth: 1600,
                sourceHeight: 900,
            }
        });
        const table = $("#tablePanel4").DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            },
            data: response.data,
            "columns": [{
                    data: "COMDES",
                    orderable: false,
                    width: "21%",
                    render: function(data, type, row) {
                        return '<span class="fw-bold">' + data + '</span>';
                    }
                },
                {
                    data: "ANO1",
                    className: "text-end",
                    width: "17%",
                    render: function(data, type, row) {
                        if (data == 0) {
                            return '<span class="text-danger fw-bold">' + row['MON'] + '.' + parseFloat(
                                data).toLocaleString('es-419', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }) + '</span>';
                        } else {
                            return '<span class="fw-bold">' + row['MON'] + '.' + parseFloat(data)
                                .toLocaleString('es-419', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }) + '</span>';
                        }
                    }
                },
                {
                    data: "ANO2",
                    className: "text-end",
                    width: "20%",
                    render: function(data, type, row) {
                        if (data == 0) {
                            return '<span class="text-danger fw-bold ">' + row['MON'] + '.' +
                                parseFloat(data).toLocaleString('es-419', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }) + '</span>';
                        } else {
                            return '<span class="fw-bold">' + row['MON'] + '.' + parseFloat(data)
                                .toLocaleString('es-419', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }) + '</span>';
                        }
                    }
                },
                {
                    data: "VARIA",
                    className: "text-end",
                    width: "21%",
                    render: function(data, type, row) {
                        if (data <= 0) {
                            return '<span class="text-danger fw-bold">' + row['MON'] + '.' + parseFloat(
                                data).toLocaleString('es-419', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }) + '</span>';
                        } else {
                            return '<span class="text-success fw-bold">' + row['MON'] + '.' +
                                parseFloat(data).toLocaleString('es-419', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }) + '</span>';
                        }
                    }
                },
                {
                    data: "CRECI",
                    className: "text-end",
                    width: "16%",
                    render: function(data, type, row) {
                        if (data <= 0) {
                            return '<span class="text-danger fw-bold">' + parseInt(data).toLocaleString(
                                'es-419', {
                                    minimumFractionDigits: 0,
                                    maximumFractionDigits: 0
                                }) + '%</span>';
                        } else {
                            return '<span class="text-success fw-bold">' + parseInt(data)
                                .toLocaleString('es-419', {
                                    minimumFractionDigits: 0,
                                    maximumFractionDigits: 0
                                }) + '%</span>';
                        }
                    }
                },
            ],
            "pageLength": 100,
            searching: false,
            ordering: false,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fa-solid fa-file-excel me-1"></i><b>Enviar a Excel</b>',
                    className: "btn btn-success text-light fs-6 mb-2",
                    title: 'Comparativo de ventas resumidas - Países',
                    customize: function(xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        var sSh = xlsx.xl['styles.xml'];
                        var lastXfIndex = $('cellXfs xf', sSh).length - 1;
                        var lastFontIndex = $('fonts font', sSh).length - 1;
                        var i;
                        var y;
                        var f1 = '<font>' +
                            '<sz val="11" />' +
                            '<name val="Calibri" />' +
                            '<color rgb="FF0000" />' + // color rojo en la fuente
                            '</font>';
                        var f2 = '<font>' +
                            '<sz val="11" />' +
                            '<name val="Calibri" />' +
                            '<color rgb="007800" />' + // color verde en la fuente
                            '</font>';

                        var n1 = '<numFmt formatCode="##0%"   numFmtId="300"/>';
                        var n2 = '<numFmt formatCode="#,##0.00"   numFmtId="200" />';
                        var s1 =
                            '<xf numFmtId="300" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>';
                        var s2 =
                            '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="center"/></xf>';
                        var s3 =
                            '<xf numFmtId="4" fontId="2" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>'
                        var s4 =
                            '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="center" wrapText="1"/></xf>'
                        var s5 = '<xf  numFmtId="200" fontId="' + (lastFontIndex + 1) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s6 = '<xf  numFmtId="200" fontId="' + (lastFontIndex + 2) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s7 = '<xf  numFmtId="300" fontId="' + (lastFontIndex + 1) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s8 = '<xf  numFmtId="300" fontId="' + (lastFontIndex + 2) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        sSh.childNodes[0].childNodes[0].innerHTML += n1 + n2;
                        sSh.childNodes[0].childNodes[1].innerHTML += f1 + f2;
                        sSh.childNodes[0].childNodes[5].innerHTML += s1 + s2 + s3 + s4 + s5 + s6 +
                            s7 + s8;

                        var fourDecPlaces = lastXfIndex + 1;
                        var greyBoldCentered = lastXfIndex + 2;
                        var twoDecPlacesBold = lastXfIndex + 3;
                        var greyBoldWrapText = lastXfIndex + 4;
                        var textred1 = lastXfIndex + 5;
                        var textgreen1 = lastXfIndex + 6;
                        var textred2 = lastXfIndex + 7;
                        var textgreen2 = lastXfIndex + 8;
                        $('c[r=A1] t', sheet).text(
                            'CONSULTA DE VENTAS RESUMIDAS POR PAÍS - ANUAL HASTA EL MES '+getCurrentMonth(mes1));
                        $('row:eq(0) c', sheet).attr('s', greyBoldCentered);
                        $('row:eq(1) c', sheet).attr('s', 7);
                        for (let index = 2; index <= 50; index++) {
                            $('row:eq(' + index + ') c[r^="B"]', sheet).attr('s', 52);
                            $('row:eq(' + index + ') c[r^="C"]', sheet).attr('s', 52);
                            $('row:eq(' + index + ') c[r^="D"]', sheet).attr('s', 52);
                            $('row:eq(' + index + ') c[r^="E"]', sheet).attr('s', 52);
                            if (parseFloat(($('row:eq(' + index + ') c[r^="D"]', sheet).text()).slice(
                                    2)) < 0) {
                                $('row:eq(' + index + ') c[r^="D"]', sheet).attr('s',
                                    textred1); //ROJO
                            } else {
                                $('row:eq(' + index + ') c[r^="D"]', sheet).attr('s',
                                    textgreen1); //VERDE
                            }
                            if (parseFloat($('row:eq(' + index + ') c[r^="E"]', sheet).text()) < 0) {
                        $('row:eq(' + index + ') c[r^="E"]', sheet).attr('s',
                            textred1); //ROJO
                    } else {
                        $('row:eq(' + index + ') c[r^="E"]', sheet).attr('s',
                            textgreen1); //VERDE
                    }
                            var tagName = sSh.getElementsByTagName('sz');
                            for (i = 0; i < tagName.length; i++) {
                                tagName[i].setAttribute("val", "13");
                            }
                        }
                    },
                },

            ],
            rowCallback: function(row, data) {
                if (data.VENDEDOR == '1' || data.VENDEDOR == '2') {
                    row.classList.add('bg-secondary2');
                }
                $(row).on('dblclick', function() {

                });
            }
        });

        /*const detailRows = []
        table.on('click', 'tbody td.dt-control', function() {
            let tr = event.target.closest('tr');
            let row = table.row(tr);
            let idx = detailRows.indexOf(tr.id);
            var ct1=[];
            var ct1Values1=[];
            var ct1Values2=[];
            if (row.child.isShown()) {
                tr.classList.remove('details');
                row.child.hide();
                detailRows.splice(idx, 1);
            } else {
                tr.classList.add('details');
                row.child(format(row.data().detalle)).show();
                if (row.data().detalle.length == 0) {
                    ctx1.classList.add('d-none');
                }else{
                    ctx1.classList.remove('d-none');
                    row.data().detalle.forEach(element => {
                    ct1.push(element.COMDES);
                    ct1Values1.push(parseFloat(element.ANO1));
                    ct1Values2.push(parseFloat(element.ANO2));
                });
                }

                if (idx === -1) {
                    detailRows.push(tr.id);
                }
                setTimeout(() => {
                    let tds = document.querySelectorAll('td:has(table)');
                    tds.forEach(function(td) {
                        td.classList.add('p-0');
                        td.classList.add('m-0');
                    });
                }, 1);
            }
            if (detailRows.length > 0) {
                chart.update({
                xAxis: {
                    categories: ct1,
                },
                plotOptions: {
                column: {
                    depth: 25
                },
                series: {
                    dataLabels: [{
                        enabled: isLabel,
                        formatter: function() {
                            return 'D.' + Highcharts.numberFormat(this.point.y, 2, '.', ',') +
                                '</b>';
                        },
                    }]
                }
                },
                series: [{
                        name: getCurrentMonth(mes1) + ' ' + ano1 ,
                        data: ct1Values1
                    },
                    {
                        name: getCurrentMonth(mes2) + ' ' + ano2 ,
                        data: ct1Values2
                    }
                ],
            });
            }else{
                ctx1.classList.remove('d-none');
                chart.update({
                xAxis: {
                    categories: chartLabels
                },
                plotOptions: {
                column: {
                    depth: 25
                },
                series: {
                    dataLabels: [{
                        enabled: isLabel,
                        formatter: function() {
                            return 'D.' + Highcharts.numberFormat(this.point.y, 2, '.', ',') +
                                '</b>';
                        },
                    }]
                }
                },
                series: [{
                        name: getCurrentMonth(mes1) + ' ' + ano1,
                        data: chartValues1
                    },
                    {
                        name: getCurrentMonth(mes2) + ' ' + ano2,
                        data: chartValues2
                    }
                ],
            });
            }
        });
        function format(d) {
            if (d.length!=0) {
            var row = '';
            for (let i = 0; i < d.length; i++) {
                row = row + `<tr class="">
                                <td style="width:4%;"></td>

                                <td style="width:21%;">` + d[i]['COMDES'] + `</td>`;
                if (parseFloat(d[i]['ANO1']) == 0) {
                    row = row + `<td class="text-end text-danger" style="width:17%;">`;
                } else {
                    row = row + `<td class="text-end" style="width:17%;">`;
                }


                row = row + d[i]['MON'] + '.' +
                    parseFloat(d[i]['ANO1']).toLocaleString('es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + `</td>`;
                if (parseFloat(d[i]['ANO2']) == 0) {
                    row = row + `<td class="text-end text-danger" style="width:20%;">`
                } else {
                    row = row + `<td class="text-end" style="width:20%;">`
                }

                row = row + d[i]['MON'] + '.' +
                    parseFloat(d[i]['ANO2']).toLocaleString('es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + `</td>`;
                if (parseFloat(d[i]['VARIA']) <= 0) {
                    row = row + `<td class="text-end text-danger" style="width:21%;">`
                } else {
                    row = row + `<td class="text-end" style="width:21%;">`
                }

                row = row + d[i]['MON'] + '.' +
                    parseFloat(d[i]['VARIA']).toLocaleString('es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + `</td>`;

                if (parseFloat(d[i]['CRECI']) <= 0) {
                    row = row + `<td class="text-end text-danger" style="width:16%;">`
                } else {
                    row = row + `<td class="text-end" style="width:16%;">`
                }

                row = row + parseInt(d[i]['CRECI']).toLocaleString('es-419', {
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }) + `%</td>
                            </tr>`;
            }
            var table = `<table class="table bg-secondary2 m-0 p-0" style="width:100%">
                                <tbody>
                                ` + row + `
                                </tbody>
                            </table>`;
             }else{
                var table = `<table class="table bg-secondary2 m-0 p-0" style="width:100%">
                                <tbody>
                                <tr>
                                <td class="text-center">No hay datos para mostrar</td>
                                </tr>
                                </tbody>
                            </table>`;
                }
            return table;

        }*/

    }
    function getCurrentMonth(mes) {
        const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre",
            "Octubre", "Noviembre", "Diciembre"
        ];
        return meses[mes - 1];
    }
    </script>
</body>

</html>