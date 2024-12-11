<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
</head>

<body>
    <?php
      include '../layout-prg.php';
      include '../../assets/php/ZPT/ZLO0024P/headera.php';
  ?>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <span> Ventas por clasificación de producto</span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0024P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-1">
        <div class="card mb-5">
            <div class="card-header">
                <h1 class="fs-4 mb-1 mt-2 text-center">Análisis de ventas por clasificación de productos por país</h1>
            </div>
            <div class="card-body" id="body-page">
                <div id="loaderExcel" class="d-none">
                    <button class="btn btn-success position-absolute top-0 start-50 translate-top p-4"
                        style="z-index: 9999; margin-top: 350px;" type="button" disabled>
                        <i class="fa-solid fa-file-excel fa-flip text-white" style="font-size:70px;"></i>
                    </button>
                    <div class="position-absolute top-0 start-0 w-100  bg-secondary bg-opacity-50 rounded"
                        style="z-index: 9998; height:2500px !important; width:7800px !important;"></div>
                </div>
                <div class="card border border-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="position-relative">
                                    <form>
                                        <div class="row mb-2">
                                            <div class="col-0 col-lg-3">

                                            </div>
                                            <div class="col-12 col-lg-3">
                                                <label class="mt-2">País:</label>
                                                <select class="form-select mt-1 fw-bold" id="cbbAgrup">
                                                    <option value="11">Tiendas Honduras (Lov. Ecommerce)</option>
                                                    <option value="9">Tiendas Honduras (Mod. Íntima)</option>
                                                    <option value="10">Tiendas Guatemala</option>
                                                    <option value="12">Tiendas El Salvador</option>
                                                    <option value="13">Tiendas Costa Rica</option>
                                                    <option value="16">Tiendas Nicaragua</option>
                                                    <option value="15">Tiendas Republica Dominicana</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-lg-3">
                                                <label class="mt-2">Año:</label>
                                                <select class="form-select  mt-1" id="cbbAno" name="cbbAno">
                                                    <?php
                                              $anio_actual = date('Y');
                                              for ($i = $anio_actual; $i >= 2015; $i--) {
                                              echo "<option value='$i'>$i</option>";
                                              }
                                          ?>
                                                </select>
                                            </div>
                                            <div class="col-0 col-lg-3">

                                            </div>
                                            <div class="col-12">
                                                <hr>
                                            </div>
                                            <div class="col-12">
                                                <figure class="highcharts-figure">
                                                    <div id="container" class="highcharts-dark text-white Math.rounded">
                                                    </div>
                                                </figure>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-2">
                        <button type="button" id="exportExcel" class="btn btn-success text-light fs-6 text-center"
                            style="width:20%;">
                            <i class="fa-solid fa-file-excel me-1"></i><b>Enviar a Excel</b>
                        </button>
                    </div>
                </div>

                <div class="table-responsive" style="width:100%">
                    <table id="tableInventario" class="table stripe table-hover text-center "
                        style="width:100%; font-size:15px; color:#000;">
                        <thead>
                            <tr>
                                <th colspan="2" class=" border border-dark bg-secondary  border-bottom-0"></th>
                                <th colspan="22" class=" border border-dark bg-secondary align-middle">
                                    <span id="lblano1" class="fs-5"></span>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2"
                                    class=" border border-dark bg-secondary border-bottom-0 border-top-0 boder-end-0 ">
                                </th>
                                <th colspan="2" class=" border border-dark bg-secondary align-middle">Ventas Precio
                                    Regular</th>
                                <th colspan="16" class=" border border-dark bg-secondary align-middle">Ventas Con
                                    Descuento</th>
                                <th colspan="4" class=" border border-dark bg-secondary align-middle">Segundas</th>
                            </tr>
                            <tr>
                                <th colspan="2"
                                    class=" border border-dark bg-secondary border-bottom-0 border-top-0 boder-end-0 ">
                                </th>
                                <th colspan="2" class=" border border-dark bgEnc1">Sin Descuento</th>
                                <th colspan="2" class="border border-dark bgEnc2">&lt; 20%</th>
                                <th colspan="2" class=" border border-dark bgEnc3">20%</th>
                                <th colspan="2" class=" border border-dark bgEnc4">30%</th>
                                <th colspan="2" class=" border border-dark bgEnc5">40%</th>
                                <th colspan="2" class=" border border-dark bgEnc6">50%</th>
                                <th colspan="2" class=" border border-dark bgEnc7">60%</th>
                                <th colspan="2" class=" border border-dark bgEnc8">70%</th>
                                <th colspan="2" class="border border-dark bgEnc9">&gt; 70%</th>
                                <th colspan="2" class=" border border-dark bgEnc10">Segunda Nivel 1</th>
                                <th colspan="2" class=" border border-dark bgEnc11">Segunda Nivel 2</th>
                            </tr>
                            <tr>
                                <th class=" border border-dark bg-secondary">Mes</th>
                                <th class=" border border-dark bg-secondary">Total</th>
                                <th class=" border border-dark bgCol1">Und.</th>
                                <th class=" border border-dark bgCol1">Porce.</th>
                                <th class=" border border-dark bgCol2">Und.</th>
                                <th class=" border border-dark bgCol2">Porce.</th>
                                <th class=" border border-dark bgCol3">Und.</th>
                                <th class=" border border-dark bgCol3">Porce.</th>
                                <th class=" border border-dark bgCol4">Und.</th>
                                <th class=" border border-dark bgCol4">Porce.</th>
                                <th class=" border border-dark bgCol5">Und.</th>
                                <th class=" border border-dark bgCol5">Porce.</th>
                                <th class=" border border-dark bgCol6">Und.</th>
                                <th class=" border border-dark bgCol6">Porce.</th>
                                <th class=" border border-dark bgCol7">Und.</th>
                                <th class=" border border-dark bgCol7">Porce.</th>
                                <th class=" border border-dark bgCol8">Und.</th>
                                <th class=" border border-dark bgCol8">Porce.</th>
                                <th class=" border border-dark bgCol9">Und.</th>
                                <th class=" border border-dark bgCol9">Porce.</th>
                                <th class=" border border-dark bgCol10">Und.</th>
                                <th class=" border border-dark bgCol10">Porce.</th>
                                <th class=" border border-dark bgCol11">Und.</th>
                                <th class=" border border-dark bgCol11">Porce.</th>
                            </tr>
                        </thead>
                        <tbody id="tableInventarioDetalle">
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive mt-4" style="width:100%">
                    <table id="tableInventario2" class="table stripe table-hover text-center "
                        style="width:100%; font-size:15px; color:#000;">
                        <thead>
                            <tr>
                                <th colspan="2" class=" border border-dark bg-secondary  border-bottom-0"></th>
                                <th colspan="22" class=" border border-dark bg-secondary align-middle">
                                    <span id="lblano2" class="fs-5"></span>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2"
                                    class=" border border-dark bg-secondary border-bottom-0 border-top-0 boder-end-0 ">
                                </th>
                                <th colspan="2" class=" border border-dark bg-secondary align-middle">Ventas Precio
                                    Regular</th>
                                <th colspan="16" class=" border border-dark bg-secondary align-middle">Ventas Con
                                    Descuento</th>
                                <th colspan="4" class=" border border-dark bg-secondary align-middle">Segundas</th>
                            </tr>
                            <tr>
                                <th colspan="2"
                                    class=" border border-dark bg-secondary border-bottom-0 border-top-0 boder-end-0 ">
                                </th>
                                <th colspan="2" class=" border border-dark bgEnc1">Sin Descuento</th>
                                <th colspan="2" class="border border-dark bgEnc2">&lt; 20%</th>
                                <th colspan="2" class=" border border-dark bgEnc3">20%</th>
                                <th colspan="2" class=" border border-dark bgEnc4">30%</th>
                                <th colspan="2" class=" border border-dark bgEnc5">40%</th>
                                <th colspan="2" class=" border border-dark bgEnc6">50%</th>
                                <th colspan="2" class=" border border-dark bgEnc7">60%</th>
                                <th colspan="2" class=" border border-dark bgEnc8">70%</th>
                                <th colspan="2" class="border border-dark bgEnc9">&gt; 70%</th>
                                <th colspan="2" class=" border border-dark bgEnc10">Segunda Nivel 1</th>
                                <th colspan="2" class=" border border-dark bgEnc11">Segunda Nivel 2</th>
                            </tr>
                            <tr>
                                <th class=" border border-dark bg-secondary">Mes</th>
                                <th class=" border border-dark bg-secondary">Total</th>
                                <th class=" border border-dark bgCol1">Und.</th>
                                <th class=" border border-dark bgCol1">Porce.</th>
                                <th class=" border border-dark bgCol2">Und.</th>
                                <th class=" border border-dark bgCol2">Porce.</th>
                                <th class=" border border-dark bgCol3">Und.</th>
                                <th class=" border border-dark bgCol3">Porce.</th>
                                <th class=" border border-dark bgCol4">Und.</th>
                                <th class=" border border-dark bgCol4">Porce.</th>
                                <th class=" border border-dark bgCol5">Und.</th>
                                <th class=" border border-dark bgCol5">Porce.</th>
                                <th class=" border border-dark bgCol6">Und.</th>
                                <th class=" border border-dark bgCol6">Porce.</th>
                                <th class=" border border-dark bgCol7">Und.</th>
                                <th class=" border border-dark bgCol7">Porce.</th>
                                <th class=" border border-dark bgCol8">Und.</th>
                                <th class=" border border-dark bgCol8">Porce.</th>
                                <th class=" border border-dark bgCol9">Und.</th>
                                <th class=" border border-dark bgCol9">Porce.</th>
                                <th class=" border border-dark bgCol10">Und.</th>
                                <th class=" border border-dark bgCol10">Porce.</th>
                                <th class=" border border-dark bgCol11">Und.</th>
                                <th class=" border border-dark bgCol11">Porce.</th>
                            </tr>
                        </thead>
                        <tbody id="tableInventarioDetalle2">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card border border-0">
                <div class="card-body ">
                    <div class="row ">
                        <div class="col-12">
                            <label class="form-control border border-0 fw-bold">Visualizar gráfica:</label>
                            <select id="selectGrafica" class="form-select fw-bold">
                                <option value="G1">Promedio histórico de ventas Sin descuento</option>
                                <option value="G2">Promedio histórico de ventas Con &lt;20% descuento</option>
                                <option value="G3">Promedio histórico de ventas Con 20% descuento</option>
                                <option value="G4">Promedio histórico de ventas Con 30% descuento</option>
                                <option value="G5">Promedio histórico de ventas Con 40% descuento</option>
                                <option value="G6">Promedio histórico de ventas Con 50% descuento</option>
                                <option value="G7">Promedio histórico de ventas Con 60% descuento</option>
                                <option value="G8">Promedio histórico de ventas Con 70% descuento</option>
                                <option value="G9">Promedio histórico de ventas Con &gt;70% descuento</option>
                                <option value="G10">Promedio histórico de ventas Segundas Nivel 1</option>
                                <option value="G11">Promedio histórico de ventas Segundas Nivel 2</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="mt-4">
                                <figure class="highcharts-figure">
                                    <div id="container2" class="highcharts-dark text-white Math.rounded"></div>
                                </figure>
                            </div>
                        </div>
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
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
    let responseDataA1 = [];
    let responseDataA2 = [];
    let barGra1 = [];
    let barGra2 = [];
    let gArray = {
        'lineSinDesc1': [],
        'lineSinDesc2': [],
        'line10Desc1': [],
        'line10Desc2': [],
        'line20Desc1': [],
        'line20Desc2': [],
        'line30Desc1': [],
        'line30Desc2': [],
        'line40Desc1': [],
        'line40Desc2': [],
        'line50Desc1': [],
        'line50Desc2': [],
        'line60Desc1': [],
        'line60Desc2': [],
        'line70Desc1': [],
        'line70Desc2': [],
        'line80Desc1': [],
        'line80Desc2': [],
        'lineZ1Desc1': [],
        'lineZ1Desc2': [],
        'lineZ2Desc1': [],
        'lineZ2Desc2': []
    };
    let seriesData = [];
    let chart1 = null;
    let chart2 = null;
    window.addEventListener('DOMContentLoaded', (event) => {
        const cbbAgrup = document.getElementById('cbbAgrup');
        let usuario = '<?php echo $_SESSION["CODUSU"];?>';
        const urlVal="http://172.16.15.20/API.LovablePHP/Users/FindAgrupP/?codusu="+usuario+"";
        fetch(urlVal).then(response => response.json()).then(data => {
                if(data.code==200){
                    cbbAgrup.innerHTML = '';
                    const dataResponse= data.data;
                    let count=0;
                    if (dataResponse.length>0) {
                        dataResponse.forEach(element => {
                            if (element.DESCRI.includes("honduras")) {
                                count++;
                            cbbAgrup.innerHTML += `<option value="11">Tiendas Honduras (Lov. Ecommerce)</option>
                                                    <option value="9">Tiendas Honduras (Mod. Íntima)</option>`;
                            }else if (element.DESCRI.includes("guatemala")) {
                                count++;
                            cbbAgrup.innerHTML += '<option value="10">Tiendas Guatemala</option>';
                            }else if (element.DESCRI.includes("salvador")) {
                                count++;
                            cbbAgrup.innerHTML += '<option value="12">Tiendas El Salvador</option>';
                            }else if(element.DESCRI.includes("costa rica")){
                                count++;
                            cbbAgrup.innerHTML += '<option value="13">Tiendas Costa Rica</option>';
                            }else if(element.DESCRI.includes("nicaragua")){
                                count++;
                            cbbAgrup.innerHTML += '<option value="16">Tiendas Nicaragua</option>';
                            }else if(element.DESCRI.includes("republica dominicana")){
                                count++;
                            cbbAgrup.innerHTML += '<option value="15">Tiendas Republica Dominicana</option>';
                            }
                    });
                    }
                    if (count==6) {
                        cbbAgrup.value=11;
                    }
                    if (data.acceso==0) {
                    $("#body-page").empty();
                    $("#body-page").append('<div class="text-center p-5 fs-3 m-5" style="height:600px;"><div class="border border-1 rounded p-5 m-5"><i class="fa-solid fa-question fa-fade fa-2xl mb-4"></i><br /> No hay contenido para mostrar.</div></div>');
                     }
                }

            });
        const cbbAno = document.getElementById('cbbAno');
        const cbbGrafica = document.getElementById('selectGrafica');
        let valAno = parseInt(cbbAno.value);
        let valAno2 = valAno - 1;
        let valAgrup = cbbAgrup.value;
        chargeHistoricoInit(valAno, valAgrup);
        chargeTable(valAno, valAgrup);
        chargeTable2(valAno2, valAgrup);
        cbbAgrup.addEventListener('change', (event) => {
            let valAno = parseInt(cbbAno.value);
            let valAno2 = valAno - 1;
            let valAgrup = cbbAgrup.value;
            chargeTable(valAno, valAgrup);
            chargeTable2(valAno2, valAgrup);
            chargeHistorico(valAno, valAgrup);
            setTimeout(() => {
                chargeGrafica(valAno, valAgrup);
            }, 500);
        });
        cbbAno.addEventListener('change', (event) => {
            let valAno = parseInt(cbbAno.value);
            let valAno2 = valAno - 1;
            let valAgrup = cbbAgrup.value;
            chargeTable(valAno, valAgrup);
            chargeTable2(valAno2, valAgrup);
            chargeHistorico(valAno, valAgrup);
            setTimeout(() => {
                chargeGrafica(valAno, valAgrup);
            }, 500);

        });
        cbbGrafica.addEventListener('change', (event) => {
            const cbbGrafica = document.getElementById('selectGrafica');
            let valAgrup = cbbAgrup.value;
            let valAno = parseInt(cbbAno.value);
            chargeHistorico(valAno, valAgrup);
        });
        setTimeout(() => {
            chart1 = Highcharts.chart('container', {
                chart: {
                    type: 'column',
                    style: {
                        color: '#FFFFFF'
                    }
                },
                title: {
                    text: 'Promedio histórico por tipo de descuento <br>' + cbbAgrup.options[
                        cbbAgrup.selectedIndex].text,
                    align: 'center',
                    style: {
                        color: '#FFFFFF',
                    }
                },
                lang: {
                    viewFullscreen: "Ver en pantalla completa",
                    exitFullscreen: "Salir de pantalla completa",
                    downloadJPEG: "Descargar imagen JPEG",
                    downloadPDF: "Descargar en PDF",
                },
                xAxis: {
                    categories: ['Prendas Sin Dscto.', 'Prendas <20%', 'Prendas 20%',
                        'Prendas 30%', 'Prendas 40%', 'Prendas 50%', 'Prendas 60%',
                        'Prendas 70%', 'Prendas >70%', 'Segundas Nivel 1',
                        'Segundas Nivel 2'
                    ],
                    crosshair: true,
                    accessibility: {
                        description: 'Countries'
                    },
                    labels: {
                        style: {
                            color: '#FFFFFF'
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: ' ',
                        style: {
                            color: '#FFFFFF'
                        }
                    },
                    labels: {
                        style: {
                            color: '#FFFFFF'
                        }
                    }
                },
                tooltip: {
                    valueSuffix: ' %',
                    style: {
                        color: '#FFFFFF'
                    }
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    },
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.2f}%'
                        }
                    }
                },
                credits: {
                    enabled: false
                },
                legend: {
                    itemStyle: {
                        color: '#FFFFFF'
                    }
                },
                exporting: {
                    buttons: {
                        contextButton: {
                            menuItems: ["viewFullscreen", "separator", "downloadJPEG",
                                "downloadPDF"
                            ]
                        }
                    },
                    enabled: true,
                    sourceWidth: 1600,
                    sourceHeight: 700,
                    chartOptions: {
                        chart: {
                            backgroundColor: '#303030'
                        }
                    }
                },
                series: [{
                        name: 'Ano ' + valAno,
                        data: barGra1
                    },
                    {
                        name: 'Ano ' + valAno2,
                        data: barGra2
                    }
                ]
            });
        }, 1700);

        const exportExcel = document.getElementById('exportExcel');
        exportExcel.addEventListener('click', (event) => {
            const cbbAgrup = document.getElementById('cbbAgrup');
            document.getElementById('loaderExcel').classList.remove('d-none');
            valAgrup= cbbAgrup.value;
            var url = "/API.LovablePHP/ZLO0024P/Export/?anopro=" + valAno +
                "&agrup=" + valAgrup + "&cia=" + cbbAgrup.options[cbbAgrup.selectedIndex].text;
            fetch(url)
                .then(response => response.blob())
                .then(blob => {
                    var tempUrl = window.URL.createObjectURL(blob);
                    var a = document.createElement('a');
                    a.href = tempUrl;
                    a.download =
                        'VentasProductos-Pais.xlsx'; // Puedes personalizar el nombre del archivo
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
    });

    function chargeTable(valAno, valAgrup) {
        //AÑO 1
        gArray['lineSinDesc1'] = [];
        gArray['line10Desc1'] = [];
        gArray['line20Desc1'] = [];
        gArray['line30Desc1'] = [];
        gArray['line40Desc1'] = [];
        gArray['line50Desc1'] = [];
        gArray['line60Desc1'] = [];
        gArray['line70Desc1'] = [];
        gArray['line80Desc1'] = [];
        gArray['lineZ1Desc1'] = [];
        gArray['lineZ2Desc1'] = [];
        var urlList = "/API.LovablePHP/ZLO0024P/List/?anopro=" + valAno + "&agrup=" + valAgrup;
        let lblAno1 = document.getElementById('lblano1');
        lblAno1.innerHTML = 'Año ' + valAno;
        const tbDetalle = document.getElementById('tableInventarioDetalle');
        tbDetalle.innerHTML = '';
        fetch(urlList)
            .then(response => response.json())
            .then(data => {
                if (data.code == 200) {
                    let total = 0,
                        totdes = 0,
                        tot10 = 0,
                        tot20 = 0,
                        tot30 = 0,
                        tot40 = 0,
                        tot50 = 0,
                        tot60 = 0,
                        tot70 = 0,
                        tot80 = 0,
                        totz1 = 0,
                        totz2 = 0;
                    responseDataA1 = [...data.data];
                    let count = 0;
                    data.data.forEach((item) => {
                        const row = document.createElement('tr');
                        if (item.UNITOT != 0) {
                            count++;
                        }
                        row.innerHTML = `
                  <td class="bg-light border border-dark">${item.MESDES}</td>
                  <td class="bg-light border border-dark">${parseFloat(item.UNITOT) === 0 ? '‎' : parseFloat(item.UNITOT).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgCol1 border border-dark">${parseFloat(item.SIDESC) === 0 ? '‎' : parseFloat(item.SIDESC).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgCol1 border border-dark">${parseFloat(item.PORDESC) === 0 ? '‎' : parseFloat(item.PORDESC).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgCol2 border border-dark">${parseFloat(item.UNI10) === 0 ? '‎' : parseFloat(item.UNI10).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgCol2 border border-dark">${parseFloat(item.POR10) === 0 ? '‎' : parseFloat(item.POR10).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgCol3 border border-dark">${parseFloat(item.UNI20) === 0 ? '‎' : parseFloat(item.UNI20).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgCol3 border border-dark">${parseFloat(item.POR20) === 0 ? '‎' : parseFloat(item.POR20).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgCol4 border border-dark">${parseFloat(item.UNI30) === 0 ? '‎' : parseFloat(item.UNI30).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgCol4 border border-dark">${parseFloat(item.POR30) === 0 ? '‎' : parseFloat(item.POR30).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgCol5 border border-dark">${parseFloat(item.UNI40) === 0 ? '‎' : parseFloat(item.UNI40).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgCol5 border border-dark">${parseFloat(item.POR40) === 0 ? '‎' : parseFloat(item.POR40).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgCol6 border border-dark">${parseFloat(item.UNI50) === 0 ? '‎' : parseFloat(item.UNI50).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgCol6 border border-dark">${parseFloat(item.POR50) === 0 ? '‎' : parseFloat(item.POR50).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgCol7 border border-dark">${parseFloat(item.UNI60) === 0 ? '‎' : parseFloat(item.UNI60).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgCol7 border border-dark">${parseFloat(item.POR60) === 0 ? '‎' : parseFloat(item.POR60).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgCol8 border border-dark">${parseFloat(item.UNI70) === 0 ? '‎' : parseFloat(item.UNI70).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgCol8 border border-dark">${parseFloat(item.POR70) === 0 ? '‎' : parseFloat(item.POR70).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgCol9 border border-dark">${parseFloat(item.UNI80) === 0 ? '‎' : parseFloat(item.UNI80).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgCol9 border border-dark">${parseFloat(item.POR80) === 0 ? '‎' : parseFloat(item.POR80).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgCol10 border border-dark">${parseFloat(item.UNIZ1) === 0 ? '‎' : parseFloat(item.UNIZ1).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgCol10 border border-dark">${parseFloat(item.PORZ1) === 0 ? '‎' : parseFloat(item.PORZ1).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgCol11 border border-dark">${parseFloat(item.UNIZ2) === 0 ? '‎' : parseFloat(item.UNIZ2).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgCol11 border border-dark">${parseFloat(item.PORZ2) === 0 ? '‎' : parseFloat(item.PORZ2).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                `;
                        tbDetalle.appendChild(row);
                        total += parseFloat(item.UNITOT);
                        totdes += parseFloat(item.SIDESC);
                        tot10 += parseFloat(item.UNI10);
                        tot20 += parseFloat(item.UNI20);
                        tot30 += parseFloat(item.UNI30);
                        tot40 += parseFloat(item.UNI40);
                        tot50 += parseFloat(item.UNI50);
                        tot60 += parseFloat(item.UNI60);
                        tot70 += parseFloat(item.UNI70);
                        tot80 += parseFloat(item.UNI80);
                        totz1 += parseFloat(item.UNIZ1);
                        totz2 += parseFloat(item.UNIZ2);
                        gArray['lineSinDesc1'].push(Math.round(parseFloat(item.PORDESC) * 100) / 100);
                        gArray['line10Desc1'].push(Math.round(parseFloat(item.POR10) * 100) / 100);
                        gArray['line20Desc1'].push(Math.round(parseFloat(item.POR20) * 100) / 100);
                        gArray['line30Desc1'].push(Math.round(parseFloat(item.POR30) * 100) / 100);
                        gArray['line40Desc1'].push(Math.round(parseFloat(item.POR40) * 100) / 100);
                        gArray['line50Desc1'].push(Math.round(parseFloat(item.POR50) * 100) / 100);
                        gArray['line60Desc1'].push(Math.round(parseFloat(item.POR60) * 100) / 100);
                        gArray['line70Desc1'].push(Math.round(parseFloat(item.POR70) * 100) / 100);
                        gArray['line80Desc1'].push(Math.round(parseFloat(item.POR80) * 100) / 100);
                        gArray['lineZ1Desc1'].push(Math.round(parseFloat(item.PORZ1) * 100) / 100);
                        gArray['lineZ2Desc1'].push(Math.round(parseFloat(item.PORZ2) * 100) / 100);
                    });
                    let unitot = 0;
                    let unides = 0;
                    let uni1 = 0;
                    let uni20 = 0;
                    let uni30 = 0;
                    let uni40 = 0;
                    let uni50 = 0;
                    let uni60 = 0;
                    let uni70 = 0;
                    let uni80 = 0;
                    let uniz1 = 0;
                    let uniz2 = 0;
                    let protot = 0;
                    let prodes = 0;
                    let pro10 = 0;
                    let pro20 = 0;
                    let pro30 = 0;
                    let pro40 = 0;
                    let pro50 = 0;
                    let pro60 = 0;
                    let pro70 = 0;
                    let pro80 = 0;
                    let proz1 = 0;
                    let proz2 = 0;
                    if (count > 0) {
                        unitot = total / count;
                        unides = totdes / count;
                        uni10 = tot10 / count;
                        uni20 = tot20 / count;
                        uni30 = tot30 / count;
                        uni40 = tot40 / count;
                        uni50 = tot50 / count;
                        uni60 = tot60 / count;
                        uni70 = tot70 / count;
                        uni80 = tot80 / count;
                        uniz1 = totz1 / count;
                        uniz2 = totz2 / count;
                        prodes = (gArray['lineSinDesc1'].reduce((a, b) => a + b, 0)) / count;
                        pro10 = (gArray['line10Desc1'].reduce((a, b) => a + b, 0)) / count;
                        pro20 = (gArray['line20Desc1'].reduce((a, b) => a + b, 0)) / count;
                        pro30 = (gArray['line30Desc1'].reduce((a, b) => a + b, 0)) / count;
                        pro40 = (gArray['line40Desc1'].reduce((a, b) => a + b, 0)) / count;
                        pro50 = (gArray['line50Desc1'].reduce((a, b) => a + b, 0)) / count;
                        pro60 = (gArray['line60Desc1'].reduce((a, b) => a + b, 0)) / count;
                        pro70 = (gArray['line70Desc1'].reduce((a, b) => a + b, 0)) / count;
                        pro80 = (gArray['line80Desc1'].reduce((a, b) => a + b, 0)) / count;
                        proz1 = (gArray['lineZ1Desc1'].reduce((a, b) => a + b, 0)) / count;
                        proz2 = (gArray['lineZ2Desc1'].reduce((a, b) => a + b, 0)) / count;
                    }
                    barGra1 = [
                        Math.round(prodes * 100) / 100,
                        Math.round(pro10 * 100) / 100,
                        Math.round(pro20 * 100) / 100,
                        Math.round(pro30 * 100) / 100,
                        Math.round(pro40 * 100) / 100,
                        Math.round(pro50 * 100) / 100,
                        Math.round(pro60 * 100) / 100,
                        Math.round(pro70 * 100) / 100,
                        Math.round(pro80 * 100) / 100,
                        Math.round(proz1 * 100) / 100,
                        Math.round(proz2 * 100) / 100
                    ];
                    const row = document.createElement('tr');
                    row.innerHTML = `
                  <td class="bg-secondary border border-dark">Promedio</td>
                  <td class="bg-secondary border border-dark">${parseFloat(unitot) === 0 ? '‎' : parseFloat(unitot).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(unides) === 0 ? '‎' : parseFloat(unides).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(prodes) === 0 ? '‎' : parseFloat(prodes).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uni10) === 0 ? '‎' : parseFloat(uni10).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(pro10) === 0 ? '‎' : parseFloat(pro10).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uni20) === 0 ? '‎' : parseFloat(uni20).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(pro20) === 0 ? '‎' : parseFloat(pro20).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uni30) === 0 ? '‎' : parseFloat(uni30).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(pro30) === 0 ? '‎' : parseFloat(pro30).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uni40) === 0 ? '‎' : parseFloat(uni40).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(pro40) === 0 ? '‎' : parseFloat(pro40).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uni50) === 0 ? '‎' : parseFloat(uni50).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(pro50) === 0 ? '‎' : parseFloat(pro50).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uni60) === 0 ? '‎' : parseFloat(uni60).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(pro60) === 0 ? '‎' : parseFloat(pro60).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uni70) === 0 ? '‎' : parseFloat(uni70).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(pro70) === 0 ? '‎' : parseFloat(pro70).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uni80) === 0 ? '‎' : parseFloat(uni80).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(pro80) === 0 ? '‎' : parseFloat(pro80).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uniz1) === 0 ? '‎' : parseFloat(uniz1).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(proz1) === 0 ? '‎' : parseFloat(proz1).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uniz2) === 0 ? '‎' : parseFloat(uniz2).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(proz2) === 0 ? '‎' : parseFloat(proz2).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                `;
                    tbDetalle.appendChild(row);
                } else {
                    const row = document.createElement('tr');
                    row.innerHTML = `
              <td colspan="24"><span style="font-size:16px; margin:50px;">No hay datos</span></td>
              `;
                    tbDetalle.appendChild(row);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                const row = document.createElement('tr');
                row.innerHTML = `
              <td colspan="24">No hay datos</td>
              `;
                tbDetalle.appendChild(row);
            });
    }

    function chargeTable2(valAno, valAgrup) {
        //AÑO 2
        gArray['lineSinDesc2'] = [];
        gArray['line10Desc2'] = [];
        gArray['line20Desc2'] = [];
        gArray['line30Desc2'] = [];
        gArray['line40Desc2'] = [];
        gArray['line50Desc2'] = [];
        gArray['line60Desc2'] = [];
        gArray['line70Desc2'] = [];
        gArray['line80Desc2'] = [];
        gArray['lineZ1Desc2'] = [];
        gArray['lineZ2Desc2'] = [];
        var urlList = "/API.LovablePHP/ZLO0024P/List/?anopro=" + valAno + "&agrup=" + valAgrup;
        let lblAno2 = document.getElementById('lblano2');
        lblAno2.innerHTML = 'Año ' + valAno;
        const tbDetalle = document.getElementById('tableInventarioDetalle2');
        tbDetalle.innerHTML = '';
        fetch(urlList)
            .then(response => response.json())
            .then(data => {
                if (data.code == 200) {
                    let total = 0;
                    let totdes = 0;
                    let tot10 = 0;
                    let tot20 = 0;
                    let tot30 = 0;
                    let tot40 = 0;
                    let tot50 = 0;
                    let tot60 = 0;
                    let tot70 = 0;
                    let tot80 = 0;
                    let totz1 = 0;
                    let totz2 = 0;
                    responseDataA2 = [...data.data];
                    let count = 0;
                    data.data.forEach((item) => {
                        const row = document.createElement('tr');
                        if (item.UNITOT != 0) {
                            count++;
                        }
                        row.innerHTML = `
                  <td class="bg-light border border-dark">${item.MESDES}</td>
                  <td class="bg-light border border-dark">${parseFloat(item.UNITOT) === 0 ? '‎' : parseFloat(item.UNITOT).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgCol1 border border-dark">${parseFloat(item.SIDESC) === 0 ? '‎' : parseFloat(item.SIDESC).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgCol1 border border-dark">${parseFloat(item.PORDESC) === 0 ? '‎' : parseFloat(item.PORDESC).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgCol2 border border-dark">${parseFloat(item.UNI10) === 0 ? '‎' : parseFloat(item.UNI10).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgCol2 border border-dark">${parseFloat(item.POR10) === 0 ? '‎' : parseFloat(item.POR10).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgCol3 border border-dark">${parseFloat(item.UNI20) === 0 ? '‎' : parseFloat(item.UNI20).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgCol3 border border-dark">${parseFloat(item.POR20) === 0 ? '‎' : parseFloat(item.POR20).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgCol4 border border-dark">${parseFloat(item.UNI30) === 0 ? '‎' : parseFloat(item.UNI30).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgCol4 border border-dark">${parseFloat(item.POR30) === 0 ? '‎' : parseFloat(item.POR30).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgCol5 border border-dark">${parseFloat(item.UNI40) === 0 ? '‎' : parseFloat(item.UNI40).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgCol5 border border-dark">${parseFloat(item.POR40) === 0 ? '‎' : parseFloat(item.POR40).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgCol6 border border-dark">${parseFloat(item.UNI50) === 0 ? '‎' : parseFloat(item.UNI50).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgCol6 border border-dark">${parseFloat(item.POR50) === 0 ? '‎' : parseFloat(item.POR50).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgCol7 border border-dark">${parseFloat(item.UNI60) === 0 ? '‎' : parseFloat(item.UNI60).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgCol7 border border-dark">${parseFloat(item.POR60) === 0 ? '‎' : parseFloat(item.POR60).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgCol8 border border-dark">${parseFloat(item.UNI70) === 0 ? '‎' : parseFloat(item.UNI70).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgCol8 border border-dark">${parseFloat(item.POR70) === 0 ? '‎' : parseFloat(item.POR70).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgCol9 border border-dark">${parseFloat(item.UNI80) === 0 ? '‎' : parseFloat(item.UNI80).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgCol9 border border-dark">${parseFloat(item.POR80) === 0 ? '‎' : parseFloat(item.POR80).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgCol10 border border-dark">${parseFloat(item.UNIZ1) === 0 ? '‎' : parseFloat(item.UNIZ1).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgCol10 border border-dark">${parseFloat(item.PORZ1) === 0 ? '‎' : parseFloat(item.PORZ1).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgCol11 border border-dark">${parseFloat(item.UNIZ2) === 0 ? '‎' : parseFloat(item.UNIZ2).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgCol11 border border-dark">${parseFloat(item.PORZ2) === 0 ? '‎' : parseFloat(item.PORZ2).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                `;
                        tbDetalle.appendChild(row);
                        total += parseFloat(item.UNITOT);
                        totdes += parseFloat(item.SIDESC);
                        tot10 += parseFloat(item.UNI10);
                        tot20 += parseFloat(item.UNI20);
                        tot30 += parseFloat(item.UNI30);
                        tot40 += parseFloat(item.UNI40);
                        tot50 += parseFloat(item.UNI50);
                        tot60 += parseFloat(item.UNI60);
                        tot70 += parseFloat(item.UNI70);
                        tot80 += parseFloat(item.UNI80);
                        totz1 += parseFloat(item.UNIZ1);
                        totz2 += parseFloat(item.UNIZ2);
                        gArray['lineSinDesc2'].push(Math.round(parseFloat(item.PORDESC) * 100) / 100);
                        gArray['line10Desc2'].push(Math.round(parseFloat(item.POR10) * 100) / 100);
                        gArray['line20Desc2'].push(Math.round(parseFloat(item.POR20) * 100) / 100);
                        gArray['line30Desc2'].push(Math.round(parseFloat(item.POR30) * 100) / 100);
                        gArray['line40Desc2'].push(Math.round(parseFloat(item.POR40) * 100) / 100);
                        gArray['line50Desc2'].push(Math.round(parseFloat(item.POR50) * 100) / 100);
                        gArray['line60Desc2'].push(Math.round(parseFloat(item.POR60) * 100) / 100);
                        gArray['line70Desc2'].push(Math.round(parseFloat(item.POR70) * 100) / 100);
                        gArray['line80Desc2'].push(Math.round(parseFloat(item.POR80) * 100) / 100);
                        gArray['lineZ1Desc2'].push(Math.round(parseFloat(item.PORZ1) * 100) / 100);
                        gArray['lineZ2Desc2'].push(Math.round(parseFloat(item.PORZ2) * 100) / 100);
                    });
                    let unitot = 0;
                    let unides = 0;
                    let uni1 = 0;
                    let uni20 = 0;
                    let uni30 = 0;
                    let uni40 = 0;
                    let uni50 = 0;
                    let uni60 = 0;
                    let uni70 = 0;
                    let uni80 = 0;
                    let uniz1 = 0;
                    let uniz2 = 0;
                    let protot = 0;
                    let prodes = 0;
                    let pro10 = 0;
                    let pro20 = 0;
                    let pro30 = 0;
                    let pro40 = 0;
                    let pro50 = 0;
                    let pro60 = 0;
                    let pro70 = 0;
                    let pro80 = 0;
                    let proz1 = 0;
                    let proz2 = 0;
                    if (count > 0) {
                        unitot = total / count;
                        unides = totdes / count;
                        uni10 = tot10 / count;
                        uni20 = tot20 / count;
                        uni30 = tot30 / count;
                        uni40 = tot40 / count;
                        uni50 = tot50 / count;
                        uni60 = tot60 / count;
                        uni70 = tot70 / count;
                        uni80 = tot80 / count;
                        uniz1 = totz1 / count;
                        uniz2 = totz2 / count;
                        prodes = (gArray['lineSinDesc2'].reduce((a, b) => a + b, 0)) / count;
                        pro10 = (gArray['line10Desc2'].reduce((a, b) => a + b, 0)) / count;
                        pro20 = (gArray['line20Desc2'].reduce((a, b) => a + b, 0)) / count;
                        pro30 = (gArray['line30Desc2'].reduce((a, b) => a + b, 0)) / count;
                        pro40 = (gArray['line40Desc2'].reduce((a, b) => a + b, 0)) / count;
                        pro50 = (gArray['line50Desc2'].reduce((a, b) => a + b, 0)) / count;
                        pro60 = (gArray['line60Desc2'].reduce((a, b) => a + b, 0)) / count;
                        pro70 = (gArray['line70Desc2'].reduce((a, b) => a + b, 0)) / count;
                        pro80 = (gArray['line80Desc2'].reduce((a, b) => a + b, 0)) / count;
                        proz1 = (gArray['lineZ1Desc2'].reduce((a, b) => a + b, 0)) / count;
                        proz2 = (gArray['lineZ2Desc2'].reduce((a, b) => a + b, 0)) / count;
                    }
                    barGra2 = [
                        Math.round(prodes * 100) / 100,
                        Math.round(pro10 * 100) / 100,
                        Math.round(pro20 * 100) / 100,
                        Math.round(pro30 * 100) / 100,
                        Math.round(pro40 * 100) / 100,
                        Math.round(pro50 * 100) / 100,
                        Math.round(pro60 * 100) / 100,
                        Math.round(pro70 * 100) / 100,
                        Math.round(pro80 * 100) / 100,
                        Math.round(proz1 * 100) / 100,
                        Math.round(proz2 * 100) / 100
                    ];
                    const row = document.createElement('tr');
                    row.innerHTML = `
                  <td class="bg-secondary border border-dark">Promedio</td>
                  <td class="bg-secondary border border-dark">${parseFloat(unitot) === 0 ? '‎' : parseFloat(unitot).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(unides) === 0 ? '‎' : parseFloat(unides).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(prodes) === 0 ? '‎' : parseFloat(prodes).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uni10) === 0 ? '‎' : parseFloat(uni10).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(pro10) === 0 ? '‎' : parseFloat(pro10).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uni20) === 0 ? '‎' : parseFloat(uni20).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(pro20) === 0 ? '‎' : parseFloat(pro20).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uni30) === 0 ? '‎' : parseFloat(uni30).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(pro30) === 0 ? '‎' : parseFloat(pro30).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uni40) === 0 ? '‎' : parseFloat(uni40).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(pro40) === 0 ? '‎' : parseFloat(pro40).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uni50) === 0 ? '‎' : parseFloat(uni50).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(pro50) === 0 ? '‎' : parseFloat(pro50).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uni60) === 0 ? '‎' : parseFloat(uni60).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(pro60) === 0 ? '‎' : parseFloat(pro60).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uni70) === 0 ? '‎' : parseFloat(uni70).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(pro70) === 0 ? '‎' : parseFloat(pro70).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uni80) === 0 ? '‎' : parseFloat(uni80).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(pro80) === 0 ? '‎' : parseFloat(pro80).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uniz1) === 0 ? '‎' : parseFloat(uniz1).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(proz1) === 0 ? '‎' : parseFloat(proz1).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uniz2) === 0 ? '‎' : parseFloat(uniz2).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(proz2) === 0 ? '‎' : parseFloat(proz2).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                `;
                    tbDetalle.appendChild(row);
                } else {
                    const row = document.createElement('tr');
                    row.innerHTML = `
              <td colspan="24"><span style="font-size:16px; margin:50px;">No hay datos</span></td>
              `;
                    tbDetalle.appendChild(row);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                const row = document.createElement('tr');
                row.innerHTML = `
              <td colspan="24">No hay datos</td>
              `;
                tbDetalle.appendChild(row);
            });
    }

    function chargeHistoricoInit(valAno, valAgrup) {
        var url = "/API.LovablePHP/ZLO0024P/ListHistorico/?anopro=" + valAno + "&agrup=" + valAgrup +
            "";
        fetch(url)
            .then(response => response.json())
            .then(data => {
                let seriesData = [];
                let response = data.data;
                let grupoYear = {};
                response.forEach(element => {
                    const ano = element.ANOPRO;
                    if (!grupoYear[ano]) {
                        grupoYear[ano] = [];
                    }
                    grupoYear[ano].push(Math.round(element.PORDESC * 100) / 100);
                });
                for (let ano in grupoYear) {
                    let values = grupoYear[ano];
                    seriesData.push({
                        name: ano,
                        data: values
                    });
                }
                let cbbGrafica = document.getElementById('selectGrafica');
                chart2 = Highcharts.chart('container2', {
                    chart: {
                        type: 'line',
                        height: 500,
                        style: {
                            color: '#FFFFFF'
                        }
                    },
                    lang: {
                        viewFullscreen: "Ver en pantalla completa",
                        exitFullscreen: "Salir de pantalla completa",
                        downloadJPEG: "Descargar imagen JPEG",
                        downloadPDF: "Descargar en PDF",
                    },
                    title: {
                        text: cbbGrafica.options[cbbGrafica.selectedIndex].text + '<br>' + cbbAgrup.options[
                            cbbAgrup.selectedIndex].text,
                        align: 'center',
                        style: {
                            color: '#FFFFFF'
                        }
                    },
                    xAxis: {
                        categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
                            'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                        ],
                        labels: {
                            style: {
                                color: '#FFFFFF'
                            }
                        }
                    },
                    yAxis: {
                        title: {
                            text: ' ',
                            style: {
                                color: '#FFFFFF'
                            }
                        },
                        labels: {
                            style: {
                                color: '#FFFFFF'
                            }
                        }
                    },
                    tooltip: {
                        style: {
                            color: '#FFFFFF'
                        }
                    },
                    plotOptions: {
                        line: {
                            dataLabels: {
                                enabled: true,
                                format: '{y} %',
                                style: {
                                    color: '#FFFFFF'
                                }
                            },
                            enableMouseTracking: true
                        },
                        series: {
                            lineWidth: 5,
                            states: {
                                hover: {
                                    enabled: true,
                                    lineWidth: 5
                                }
                            }
                        }
                    },
                    credits: {
                        enabled: false
                    },
                    legend: {
                        itemStyle: {
                            color: '#FFFFFF'
                        }
                    },
                    exporting: {
                        buttons: {
                            contextButton: {
                                menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
                            },
                            showAllButton: {
                                text: 'Mostrar todos',
                                onclick: function() {
                                    this.series.forEach(function(series) {
                                        series.setVisible(true, false);
                                    });
                                    this.redraw();
                                },
                                theme: {
                                    fill: 'white',
                                    stroke: 'silver',
                                    r: 0,
                                    style: {
                                        color: '#FFFFFF'
                                    },
                                    states: {
                                        hover: {
                                            fill: '#a4edba'
                                        },
                                        select: {
                                            stroke: '#039',
                                            fill: '#a4edba'
                                        }
                                    }
                                }
                            },
                            removeAllButton: {
                                text: 'Quitar todos',
                                onclick: function() {
                                    this.series.forEach(function(series) {
                                        series.setVisible(false, false);
                                    });
                                    this.redraw();
                                },
                                theme: {
                                    fill: 'white',
                                    stroke: 'silver',
                                    r: 0,
                                    style: {
                                        color: '#FFFFFF'
                                    },
                                    states: {
                                        hover: {
                                            fill: '#a4edba'
                                        },
                                        select: {
                                            stroke: '#039',
                                            fill: '#a4edba'
                                        }
                                    }
                                }
                            }
                        },
                        enabled: true,
                        sourceWidth: 1600,
                        sourceHeight: 700,
                        chartOptions: {
                            chart: {
                                backgroundColor: '#303030'
                            }
                        }
                    },
                    series: seriesData,
                });

            }).catch(error => {
                console.error('Hubo un problema con la petición Fetch:', error);
            });
    }

    function chargeHistorico(valAno, valAgrup) {
        var url = "/API.LovablePHP/ZLO0024P/ListHistorico/?anopro=" + valAno + "&agrup=" + valAgrup +
            "";
        fetch(url)
            .then(response => response.json())
            .then(data => {
                let seriesData = [];
                let response = data.data;
                let grupoYear = {};
                const cbbGrafica = document.getElementById('selectGrafica');
                let valGrafica = cbbGrafica.value;
                response.forEach(element => {
                    const ano = element.ANOPRO;
                    if (!grupoYear[ano]) {
                        grupoYear[ano] = [];
                    }
                    switch (valGrafica) {
                        case 'G2':
                            grupoYear[ano].push(Math.round(element.POR10 * 100) / 100);
                            break;
                        case 'G3':
                            grupoYear[ano].push(Math.round(element.POR20 * 100) / 100);
                            break;
                        case 'G4':
                            grupoYear[ano].push(Math.round(element.POR30 * 100) / 100);
                            break;
                        case 'G5':
                            grupoYear[ano].push(Math.round(element.POR40 * 100) / 100);
                            break;
                        case 'G6':
                            grupoYear[ano].push(Math.round(element.POR50 * 100) / 100);
                            break;
                        case 'G7':
                            grupoYear[ano].push(Math.round(element.POR60 * 100) / 100);
                            break;
                        case 'G8':
                            grupoYear[ano].push(Math.round(element.POR70 * 100) / 100);
                            break;
                        case 'G9':
                            grupoYear[ano].push(Math.round(element.POR80 * 100) / 100);
                            break;
                        case 'G10':
                            grupoYear[ano].push(Math.round(element.PORZ1 * 100) / 100);
                            break;
                        case 'G11':
                            grupoYear[ano].push(Math.round(element.PORZ2 * 100) / 100);
                            break;
                        default:
                            grupoYear[ano].push(Math.round(element.PORDESC * 100) / 100);
                            break;
                    }

                });
                for (let ano in grupoYear) {
                    let values = grupoYear[ano];
                    seriesData.push({
                        name: ano,
                        data: values
                    });
                }
                chart2 = Highcharts.chart('container2', {
                    chart: {
                        type: 'line',
                        height: 500,
                        style: {
                            color: '#FFFFFF'
                        }
                    },
                    lang: {
                        viewFullscreen: "Ver en pantalla completa",
                        exitFullscreen: "Salir de pantalla completa",
                        downloadJPEG: "Descargar imagen JPEG",
                        downloadPDF: "Descargar en PDF",
                    },
                    title: {
                        text: cbbGrafica.options[cbbGrafica.selectedIndex].text + '<br>' + cbbAgrup.options[
                            cbbAgrup.selectedIndex].text,
                        align: 'center',
                        style: {
                            color: '#FFFFFF'
                        }
                    },
                    xAxis: {
                        categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
                            'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                        ],
                        labels: {
                            style: {
                                color: '#FFFFFF'
                            }
                        }
                    },
                    yAxis: {
                        title: {
                            text: ' ',
                            style: {
                                color: '#FFFFFF'
                            }
                        },
                        labels: {
                            style: {
                                color: '#FFFFFF'
                            }
                        }
                    },
                    tooltip: {
                        style: {
                            color: '#FFFFFF'
                        }
                    },
                    plotOptions: {
                        line: {
                            dataLabels: {
                                enabled: true,
                                format: '{y} %',
                                style: {
                                    color: '#FFFFFF'
                                }
                            },
                            enableMouseTracking: true
                        },
                        series: {
                            lineWidth: 5,
                            states: {
                                hover: {
                                    enabled: true,
                                    lineWidth: 5
                                }
                            }
                        }
                    },
                    credits: {
                        enabled: false
                    },
                    legend: {
                        itemStyle: {
                            color: '#FFFFFF'
                        }
                    },
                    exporting: {
                        buttons: {
                            contextButton: {
                                menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
                            },
                            showAllButton: {
                                text: 'Mostrar todos',
                                onclick: function() {
                                    this.series.forEach(function(series) {
                                        series.setVisible(true, false);
                                    });
                                    this.redraw();
                                },
                                theme: {
                                    fill: 'white',
                                    stroke: 'silver',
                                    r: 0,
                                    style: {
                                        color: '#FFFFFF'
                                    },
                                    states: {
                                        hover: {
                                            fill: '#a4edba'
                                        },
                                        select: {
                                            stroke: '#039',
                                            fill: '#a4edba'
                                        }
                                    }
                                }
                            },
                            removeAllButton: {
                                text: 'Quitar todos',
                                onclick: function() {
                                    this.series.forEach(function(series) {
                                        series.setVisible(false, false);
                                    });
                                    this.redraw();
                                },
                                theme: {
                                    fill: 'white',
                                    stroke: 'silver',
                                    r: 0,
                                    style: {
                                        color: '#FFFFFF'
                                    },
                                    states: {
                                        hover: {
                                            fill: '#a4edba'
                                        },
                                        select: {
                                            stroke: '#039',
                                            fill: '#a4edba'
                                        }
                                    }
                                }
                            }
                        },
                        enabled: true,
                        sourceWidth: 1600,
                        sourceHeight: 700,
                        chartOptions: {
                            chart: {
                                backgroundColor: '#303030'
                            }
                        }
                    },
                    series: seriesData,
                });

            }).catch(error => {
                console.error('Hubo un problema con la petición Fetch:', error);
            });
    }

    function chargeGrafica() {
        const cbbGrafica = document.getElementById('selectGrafica');
        let valGrafica = cbbGrafica.value;
        const cbbAno = document.getElementById('cbbAno');
        let valAno = parseInt(cbbAno.value);
        let valAno2 = valAno - 1;
        chart1.update({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Promedio histórico por tipo de descuento <br>' + cbbAgrup.options[cbbAgrup.selectedIndex]
                    .text,
                align: 'center'
            },
            xAxis: {
                categories: ['Prendas Sin Dscto.', 'Prendas <20%', 'Prendas 20%', 'Prendas 30%', 'Prendas 40%',
                    'Prendas 50%', 'Prendas 60%', 'Prendas 70%', 'Prendas >70%', 'Segundas Nivel 1',
                    'Segundas Nivel 2'
                ],
                crosshair: true,
                accessibility: {
                    description: 'Countries'
                },
                labels: {
                    style: {
                        color: '#FFFFFF'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: ' ',
                }
            },
            tooltip: {
                valueSuffix: '%'
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            credits: {
                enabled: false
            },
            series: [{
                    name: 'Año ' + valAno,
                    data: barGra1
                },
                {
                    name: 'Año ' + valAno2,
                    data: barGra2
                },
            ]
        });
        /* SIN USO let valoresLineal1=[];
         let valoresLineal2=[];
         switch (valGrafica){
           case 'G2':
             valoresLineal1=gArray['line10Desc1'];
             valoresLineal2=gArray['line10Desc2'];
             break;
           case 'G3':
             valoresLineal1=gArray['line20Desc1'];
             valoresLineal2=gArray['line20Desc2'];
             break;
           case 'G4':
             valoresLineal1=gArray['line30Desc1'];
             valoresLineal2=gArray['line30Desc2'];
             break;
           case 'G5':
             valoresLineal1=gArray['line40Desc1'];
             valoresLineal2=gArray['line40Desc2'];
             break;
           case 'G6':
             valoresLineal1=gArray['line50Desc1'];
             valoresLineal2=gArray['line50Desc2'];
             break;
             case 'G7':
             valoresLineal1=gArray['line60Desc1'];
             valoresLineal2=gArray['line60Desc2'];
             break;
             case 'G8':
             valoresLineal1=gArray['line70Desc1'];
             valoresLineal2=gArray['line70Desc2'];
             break;
             case 'G9':
             valoresLineal1=gArray['line80Desc1'];
             valoresLineal2=gArray['line80Desc2'];
             break;
             case 'G10':
             valoresLineal1=gArray['lineZ1Desc1'];
             valoresLineal2=gArray['lineZ1Desc2'];
             break;
             case 'G11':
             valoresLineal1=gArray['lineZ2Desc1'];
             valoresLineal2=gArray['lineZ2Desc2'];
             break;
             default:
             valoresLineal1=gArray['lineSinDesc1'];
             valoresLineal2=gArray['lineSinDesc2'];
             break;
         }

         chart2.update({
             chart: {
                 type: 'line'
             },
             title: {
                     text: cbbGrafica.options[cbbGrafica.selectedIndex].text + '<br>' + cbbAgrup.options[cbbAgrup.selectedIndex].text,
                     align: 'center'
                 },
             xAxis: {
                 categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
             },
             plotOptions: {
                 line: {
                     dataLabels: {
                         enabled: true
                     },
                     enableMouseTracking: false
                 }
             },
             credits: {
                     enabled: false
                 },
             series: [{
               name: 'Año '+valAno,
               data: valoresLineal1,
             }, {
               name: 'Año '+valAno2,
               data: valoresLineal2,
             }]
         });*/
    }
    </script>
</body>

</html>