<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
</head>

<body>
    <?php
      include '../layout-prg.php';
      include '../../assets/php/ZPT/ZLO0024P/header.php';
  ?>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <span>Producto Terminado / Histórico meses de inventario</span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0028P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-1">
        <div class="card mb-5">
            <div class="card-header">
                <h1 class="fs-4 mb-1 mt-2 text-center">Histórico meses de inventario por fábrica</h1>
            </div>
            <div class="card-body">
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
                                                <label class="mt-2">Punto de venta:</label>
                                                <select class="form-select mt-1 fw-bold" id="cbbAgrup">
                                                    <option value="1">Lovable de Honduras</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-lg-3">
                                                <label class="mt-2">Año:</label>
                                                <select class="form-select  mt-1" id="cbbAno" name="cbbAno">
                                                    <?php
                                                      $anio_actual = date('Y');
                                                      for ($i = $anio_actual; $i >= 2021; $i--) {
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
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="demo">
                    <ul class="tablist" role="tablist">
                        <li id="tab1" class="tablist__tab text-center p-3  is-active" aria-controls="panel1"
                            aria-selected="true" role="tab" tabindex="0">Meses</li>
                        <li id="tab2" class="tablist__tab text-center p-3" aria-controls="panel2" aria-selected="false"
                            role="tab" tabindex="0">Unidades</li>
                        <li id="tab3" class="tablist__tab text-center p-3" aria-controls="panel3" aria-selected="false"
                            role="tab" tabindex="0">Promedios</li>
                    </ul>
                    <div id="panel1" class="tablist__panel p-3" aria-labelledby="tab1" aria-hidden="false"
                        role="tabpanel">
                        <div class="card border border-0">
                            <div class="card-body ">
                                <div class="row ">
                                    <div class="col-12">
                                        <label class="form-control border border-0 fw-bold">Visualizar
                                            gráfica:</label>
                                        <select id="selectGrafica" class="form-select fw-bold">
                                            <option value="G1">Meses inventario 12 meses
                                            </option>
                                            <option value="G2">Meses inventario 6 meses</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <div class="mt-4">
                                            <figure class="highcharts-figure">
                                                <div id="container" class="highcharts-dark text-white Math.rounded">
                                                </div>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive" style="width:100%">
                            <table id="tableInventario" class="table stripe table-hover text-center "
                                style="width:100%; font-size:15px; color:#000;">
                                <thead>
                                    <tr>
                                        <th colspan="5" class=" border border-dark bg-secondary align-middle">
                                            <span id="lblano1" class="fs-5"></span>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="width:8%"
                                            class=" border border-dark bg-secondary border-bottom-0 border-top-0 boder-end-0 ">
                                            Mes</th>
                                        <th style="width:24%" class=" border border-dark bgSky">Meses Inv.12M</th>
                                        <th style="width:24%" class=" border border-dark bgGold">Mes</th>
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
                                        <th colspan="5" class=" border border-dark bg-secondary align-middle">
                                            <span id="lblano2" class="fs-5"></span>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="width:8%"
                                            class=" border border-dark bg-secondary border-bottom-0 border-top-0 boder-end-0 ">
                                            Mes</th>
                                        <th style="width:24%" class=" border border-dark bgSky">Meses Inv.12M</th>
                                        <th style="width:24%" class=" border border-dark bgGold">Mes</th>
                                    </tr>
                                </thead>
                                <tbody id="tableInventarioDetalle2">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="panel2" class="tablist__panel is-hidden p-3" aria-labelledby="tab2" aria-hidden="true"
                        role="tabpanel">
                        <div class="card border border-0">
                            <div class="card-body ">
                                <div class="row ">
                                    <div class="col-12">
                                        <label class="form-control border border-0 fw-bold">Visualizar
                                            gráfica:</label>
                                        <select id="selectGrafica2" class="form-select fw-bold">
                                            <option value="G1">Unidades Compradas 12M
                                            </option>
                                            <option value="G2">Unidades Vendidas 12M
                                            </option>
                                            <option value="G3">Unidades Existencia
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <div class="mt-4">
                                            <figure class="highcharts-figure">
                                                <div id="container2" class="highcharts-dark text-white Math.rounded">
                                                </div>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive" style="width:100%">
                            <table id="tableInventario3" class="table stripe table-hover text-center "
                                style="width:100%; font-size:15px; color:#000;">
                                <thead>
                                    <tr>
                                        <th colspan="5" class=" border border-dark bg-secondary align-middle">
                                            <span id="lblano3" class="fs-5"></span>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="width:8%"
                                            class=" border border-dark bg-secondary border-bottom-0 border-top-0 boder-end-0 ">
                                            Mes</th>
                                        <th style="width:24%" class=" border border-dark bgSky">Unidades Compradas 12M</th>
                                        <th style="width:24%" class=" border border-dark bgGold">Unidades Vendidas 12M</th>
                                        <th style="width:24%" class=" border border-dark bgGreen">Variación</th>
                                        <th style="width:24%" class=" border border-dark bgSea">Unidades Existencia</th>
                                    </tr>
                                </thead>
                                <tbody id="tableInventarioDetalle3">
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive mt-4" style="width:100%">
                            <table id="tableInventario4" class="table stripe table-hover text-center "
                                style="width:100%; font-size:15px; color:#000;">
                                <thead>
                                    <tr>
                                        <th colspan="5" class=" border border-dark bg-secondary align-middle">
                                            <span id="lblano4" class="fs-5"></span>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="width:8%"
                                            class=" border border-dark bg-secondary border-bottom-0 border-top-0 boder-end-0 ">
                                            Mes</th>
                                        <th style="width:24%" class=" border border-dark bgSky">Unidades Compradas 12M</th>
                                        <th style="width:24%" class=" border border-dark bgGold">Unidades Vendidas 12M</th>
                                        <th style="width:24%" class=" border border-dark bgGreen">Variación</th>
                                        <th style="width:24%" class=" border border-dark bgSea">Unidades Existencia</th>
                                    </tr>
                                </thead>
                                <tbody id="tableInventarioDetalle4">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="panel3" class="tablist__panel is-hidden p-3" aria-labelledby="tab3" aria-hidden="true"
                        role="tabpanel">
                        <div class="card border border-0">
                            <div class="card-body ">
                                <div class="row ">
                                    <div class="col-12">
                                        <label class="form-control border border-0 fw-bold">Visualizar
                                            gráfica:</label>
                                        <select id="selectGrafica3" class="form-select fw-bold">
                                            <option value="G1">Promedio ventas 12 meses
                                            </option>
                                            <option value="G2">Promedio ventas 6 meses
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <div class="mt-4">
                                            <figure class="highcharts-figure">
                                                <div id="container3" class="highcharts-dark text-white Math.rounded">
                                                </div>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive" style="width:100%">
                            <table id="tableInventario5" class="table stripe table-hover text-center "
                                style="width:100%; font-size:15px; color:#000;">
                                <thead>
                                    <tr>
                                        <th colspan="5" class=" border border-dark bg-secondary align-middle">
                                            <span id="lblano5" class="fs-5"></span>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="width:8%"
                                            class=" border border-dark bg-secondary border-bottom-0 border-top-0 boder-end-0 ">
                                            Mes</th>
                                            <th style="width:24%" class=" border border-dark bgSky">Prom. Vta 12M</th>
                                            <th style="width:24%" class=" border border-dark bgGold">Prom. Vta 6M</th>
                                    </tr>
                                </thead>
                                <tbody id="tableInventarioDetalle5">
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive mt-4" style="width:100%">
                            <table id="tableInventario6" class="table stripe table-hover text-center "
                                style="width:100%; font-size:15px; color:#000;">
                                <thead>
                                    <tr>
                                        <th colspan="5" class=" border border-dark bg-secondary align-middle">
                                            <span id="lblano6" class="fs-5"></span>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="width:8%"
                                            class=" border border-dark bg-secondary border-bottom-0 border-top-0 boder-end-0 ">Mes</th>
                                            <th style="width:24%" class=" border border-dark bgSky">Prom. Vta 12M</th>
                                            <th style="width:24%" class=" border border-dark bgGold">Prom. Vta 6M</th>
                                    </tr>
                                </thead>
                                <tbody id="tableInventarioDetalle6">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="footer bg-blck flex-grow-1 d-flex justify-content-center">
            <p class="bggray responsive-font-example"><i>Lovable de Honduras S.A. de C.V</i></p>
        </div>
    </div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
    let responseDataA1 = [];
    let responseDataA2 = [];

    let responseDataA3 = [];
    let responseDataA4 = [];

    let linePRV12M1 = [];
    let linePVR06M1 = [];
    let lineMIN12M1 = [];
    let lineMIN06M1 = [];

    let linePRV12M2 = [];
    let linePVR06M2 = [];
    let lineMIN12M2 = [];
    let lineMIN06M2 = [];

    let lineUNICOM1 = [];
    let lineUNIVEN1 = [];
    let lineUNIEXI1 = [];
    let lineVaria1=[];

    let lineUNICOM2 = [];
    let lineUNIVEN2 = [];
    let lineUNIEXI2 = [];
    let lineVaria2=[];

    let chart1 = null;
    let chart2 = null;
    let chart3 = null;
    window.addEventListener('DOMContentLoaded', (event) => {
        const cbbAgrup = document.getElementById('cbbAgrup');
        let usuario = '<?php echo $_SESSION["CODUSU"];?>';

        const cbbAno = document.getElementById('cbbAno');
        const cbbGrafica = document.getElementById('selectGrafica');
        const cbbGrafica2 = document.getElementById('selectGrafica2');
        const cbbGrafica3 = document.getElementById('selectGrafica3');
        let valAno = parseInt(cbbAno.value);
        let valAno2 = valAno - 1;
        let valAgrup = cbbAgrup.value;
        chargeTable(valAno, valAgrup);
        chargeTable2(valAno2, valAgrup);
        chargeTable3(valAno, valAgrup);
        chargeTable4(valAno2, valAgrup);
        cbbAgrup.addEventListener('change', (event) => {
            let valAno = parseInt(cbbAno.value);
            let valAno2 = valAno - 1;
            let valAgrup = cbbAgrup.value;
            chargeTable(valAno, valAgrup);
            chargeTable2(valAno2, valAgrup);
            setTimeout(() => {
              chargeTable3(valAno, valAgrup);
              chargeTable4(valAno2, valAgrup);
                chargeGrafica();
                chargeGrafica2();
                chargeGrafica3();
            }, 700);
        });

        cbbAno.addEventListener('change', (event) => {
            let valAno = parseInt(cbbAno.value);
            let valAno2 = valAno - 1;
            let valAgrup = cbbAgrup.value;
            chargeTable(valAno, valAgrup);
            chargeTable2(valAno2, valAgrup);
            chargeTable3(valAno, valAgrup);
            chargeTable4(valAno2, valAgrup);
            setTimeout(() => {
              chargeTable5(valAno, valAgrup);
              chargeTable6(valAno2, valAgrup);
                chargeGrafica();
                chargeGrafica2();
                chargeGrafica3();
            }, 700);
        });

        cbbGrafica.addEventListener('change', (event) => {
            chargeGrafica();
        });
        cbbGrafica2.addEventListener('change', (event) => {
            chargeGrafica2();
        });
        cbbGrafica3.addEventListener('change', (event) => {
            chargeGrafica3();
        });

        setTimeout(() => {
            chargeTable5(valAno, valAgrup);
            chargeTable6(valAno2, valAgrup);
            chart1 = Highcharts.chart('container', {
                chart: {
                    type: 'line',
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
                    text: cbbGrafica.options[cbbGrafica.selectedIndex].text + '<br>' + cbbAgrup
                        .options[cbbAgrup.selectedIndex].text,
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
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true,
                            format: '{point.y}'
                        },
                        enableMouseTracking: false
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
                    data: lineMIN12M1,
                    color: '#20c997'
                }, {
                    name: 'Ano ' + valAno2,
                    data: lineMIN12M2,
                    color: '#ffd700'
                }]
            });
            chart2 = Highcharts.chart('container2', {
                chart: {
                    type: 'line',
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
                    text: cbbGrafica.options[cbbGrafica.selectedIndex].text + '<br>' + cbbAgrup
                        .options[cbbAgrup.selectedIndex].text,
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
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true,
                            format: '{point.y}'
                        },
                        enableMouseTracking: false
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
                    data: lineUNICOM1,
                    color: '#20c997'
                }, {
                    name: 'Ano ' + valAno2,
                    data: lineUNICOM2,
                    color: '#ffd700'
                }]
            });
            chart3 = Highcharts.chart('container3', {
                chart: {
                    type: 'line',
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
                    text: cbbGrafica.options[cbbGrafica.selectedIndex].text + '<br>' + cbbAgrup
                        .options[cbbAgrup.selectedIndex].text,
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
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true,
                            format: '{point.y}'
                        },
                        enableMouseTracking: false
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
                    data: linePRV12M1,
                    color: '#20c997'
                }, {
                    name: 'Ano ' + valAno2,
                    data: linePRV12M2,
                    color: '#ffd700'
                }]
            });
        }, 1500);
    });
    //MESES
    function chargeTable(valAno, valAgrup) {
        //AÑO 1
        linePRV12M1 = [];
        linePVR06M1 = [];
        lineMIN12M1 = [];
        lineMIN06M1 = [];
        var urlList = "http://172.16.15.20/API.LovablePHP/ZLO0028P/List/?anopro=" + valAno + "&cia=" + valAgrup;
        let lblAno1 = document.getElementById('lblano1');
        lblAno1.innerHTML = 'Año ' + valAno;
        const tbDetalle = document.getElementById('tableInventarioDetalle');
        tbDetalle.innerHTML = '';
        fetch(urlList)
            .then(response => response.json())
            .then(data => {
                if (data.code == 200) {
                    responseDataA1 = [...data.data];
                    data.data.forEach((item) => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                  <td class="bg-light border border-dark">${item.MESDES}</td>
                  <td class="bgSkySoft border border-dark">${parseFloat(item.MIN12M) === 0 ? '‎' : parseFloat(item.MIN12M).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                  <td class="bgGoldSoft border border-dark">${parseFloat(item.MIN06M) === 0 ? '‎' : parseFloat(item.MIN06M).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                  `;
                        linePRV12M1.push(parseFloat(item.PRV12M));
                        linePVR06M1.push(parseFloat(item.PRV06M));
                        lineMIN12M1.push(parseFloat(item.MIN12M));
                        lineMIN06M1.push(parseFloat(item.MIN06M));
                        tbDetalle.appendChild(row);
                    });
                } else {
                    const row = document.createElement('tr');
                    row.innerHTML = `<td colspan="5"><span style="font-size:16px; margin:50px;">No hay datos</span></td> `;
                    tbDetalle.appendChild(row);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                const row = document.createElement('tr');
                row.innerHTML = `<td colspan="5">No hay datos</td>`;
                tbDetalle.appendChild(row);
            });
    }
    function chargeTable2(valAno, valAgrup) {
        //AÑO 1
        linePRV12M2 = [];
        linePVR06M2 = [];
        lineMIN12M2 = [];
        lineMIN06M2 = [];
        var urlList = "http://172.16.15.20/API.LovablePHP/ZLO0028P/List/?anopro=" + valAno + "&cia=" + valAgrup;
        let lblAno1 = document.getElementById('lblano2');
        lblAno1.innerHTML = 'Año ' + valAno;
        const tbDetalle = document.getElementById('tableInventarioDetalle2');
        tbDetalle.innerHTML = '';
        fetch(urlList)
            .then(response => response.json())
            .then(data => {
                if (data.code == 200) {
                    responseDataA2 = [...data.data];
                    data.data.forEach((item) => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                  <td class="bg-light border border-dark">${item.MESDES}</td>
                  <td class="bgSkySoft border border-dark">${parseFloat(item.MIN12M) === 0 ? '‎' : parseFloat(item.MIN12M).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                  <td class="bgGoldSoft border border-dark">${parseFloat(item.MIN06M) === 0 ? '‎' : parseFloat(item.MIN06M).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                  `;
                        linePRV12M2.push(parseFloat(item.PRV12M));
                        linePVR06M2.push(parseFloat(item.PRV06M));
                        lineMIN12M2.push(parseFloat(item.MIN12M));
                        lineMIN06M2.push(parseFloat(item.MIN06M));
                        tbDetalle.appendChild(row);
                    });
                } else {
                    const row = document.createElement('tr');
                    row.innerHTML = `<td colspan="5"><span style="font-size:16px; margin:50px;">No hay datos</span></td>`;
                    tbDetalle.appendChild(row);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                const row = document.createElement('tr');
                row.innerHTML = `<td colspan="5">No hay datos</td> `;
                tbDetalle.appendChild(row);
            });
    }
    //UNIDADES
    function chargeTable3(valAno, valAgrup) {
        //AÑO 1
        lineUNICOM1 = [];
        lineUNIVEN1 = [];
        lineUNIEXI1 = [];
        var urlList = "http://172.16.15.20/API.LovablePHP/ZLO0028P/ListUnd/?anopro=" + valAno + "&cia=" + valAgrup;
        let lblAno1 = document.getElementById('lblano3');
        lblAno1.innerHTML = 'Año ' + valAno;
        const tbDetalle = document.getElementById('tableInventarioDetalle3');
        tbDetalle.innerHTML = '';
        fetch(urlList)
            .then(response => response.json())
            .then(data => {
                if (data.code == 200) {
                    responseDataA3 = [...data.data];
                    data.data.forEach((item) => {
                        const row = document.createElement('tr');
                        row.innerHTML = `<td class="bg-light border border-dark">${item.MESDES}</td>`;
                        row.innerHTML+= `<td class="bgSkySoft border border-dark">${parseFloat(item.UNICOM) === 0 ? '‎' : parseFloat(item.UNICOM).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>`;
                        row.innerHTML+= `<td class="bgGoldSoft border border-dark">${parseFloat(item.UNIVEN) === 0 ? '‎' : parseFloat(item.UNIVEN).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>`;
                        let variacion = parseFloat(item.UNIVEN) - parseFloat(item.UNICOM);
                        if (variacion>0) {
                          row.innerHTML+= `<td class="bgGreenSoft text-success fw-bold border border-dark">${parseFloat(variacion) === 0 ? '‎' : parseFloat(variacion).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>`;
                        }else{
                          row.innerHTML+= `<td class="bgGreenSoft text-danger fw-bold border border-dark">${parseFloat(variacion) === 0 ? '‎' : parseFloat(variacion).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>`;
                        }
                         row.innerHTML+= `<td class="bgSeaSoft border border-dark">${parseFloat(item.UNIEXI) === 0 ? '‎' : parseFloat(item.UNIEXI).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>`;
                        lineUNICOM1.push(parseFloat(item.UNICOM));
                        lineUNIVEN1.push(parseFloat(item.UNIVEN));
                        lineUNIEXI1.push(parseFloat(item.UNIEXI));
                        lineVaria1.push(parseFloat(variacion));
                        tbDetalle.appendChild(row);
                    });
                } else {
                    const row = document.createElement('tr');
                    row.innerHTML = `<td colspan="5"><span style="font-size:16px; margin:50px;">No hay datos</span></td> `;
                    tbDetalle.appendChild(row);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                const row = document.createElement('tr');
                row.innerHTML = `<td colspan="5">No hay datos</td>`;
                tbDetalle.appendChild(row);
            });
    }
    function chargeTable4(valAno, valAgrup) {
        //AÑO 1
        lineUNICOM2 = [];
        lineUNIVEN2 = [];
        lineUNIEXI2 = [];
        var urlList = "http://172.16.15.20/API.LovablePHP/ZLO0028P/ListUnd/?anopro=" + valAno + "&cia=" + valAgrup;
        let lblAno1 = document.getElementById('lblano4');
        lblAno1.innerHTML = 'Año ' + valAno;
        const tbDetalle = document.getElementById('tableInventarioDetalle4');
        tbDetalle.innerHTML = '';
        fetch(urlList)
            .then(response => response.json())
            .then(data => {
                if (data.code == 200) {
                    responseDataA3 = [...data.data];
                    data.data.forEach((item) => {
                      const row = document.createElement('tr');
                        row.innerHTML = `<td class="bg-light border border-dark">${item.MESDES}</td>`;
                        row.innerHTML+= `<td class="bgSkySoft border border-dark">${parseFloat(item.UNICOM) === 0 ? '‎' : parseFloat(item.UNICOM).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>`;
                        row.innerHTML+= `<td class="bgGoldSoft border border-dark">${parseFloat(item.UNIVEN) === 0 ? '‎' : parseFloat(item.UNIVEN).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>`;
                        let variacion = parseFloat(item.UNIVEN) - parseFloat(item.UNICOM);
                        if (variacion>0) {
                          row.innerHTML+= `<td class="bgGreenSoft text-success fw-bold border border-dark">${parseFloat(variacion) === 0 ? '‎' : parseFloat(variacion).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>`;
                        }else{
                          row.innerHTML+= `<td class="bgGreenSoft text-danger fw-bold border border-dark">${parseFloat(variacion) === 0 ? '‎' : parseFloat(variacion).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>`;
                        }
                         row.innerHTML+= `<td class="bgSeaSoft border border-dark">${parseFloat(item.UNIEXI) === 0 ? '‎' : parseFloat(item.UNIEXI).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>`;
                        lineUNICOM2.push(parseFloat(item.UNICOM));
                        lineUNIVEN2.push(parseFloat(item.UNIVEN));
                        lineUNIEXI2.push(parseFloat(item.UNIEXI));
                        lineVaria2.push(parseFloat(variacion));
                        tbDetalle.appendChild(row);
                    });
                } else {
                    const row = document.createElement('tr');
                    row.innerHTML = `<td colspan="5"><span style="font-size:16px; margin:50px;">No hay datos</span></td> `;
                    tbDetalle.appendChild(row);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                const row = document.createElement('tr');
                row.innerHTML = `<td colspan="5">No hay datos</td>`;
                tbDetalle.appendChild(row);
            });
    }
    //PROMEDIOS
    function chargeTable5(valAno, valAgrup) {
        let lblAno1 = document.getElementById('lblano5');
        lblAno1.innerHTML = 'Año ' + valAno;
        const tbDetalle = document.getElementById('tableInventarioDetalle5');
        tbDetalle.innerHTML = '';
        if (responseDataA1.length > 0) {
            responseDataA1.forEach((item) => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                          <td class="bg-light border border-dark">${item.MESDES}</td>
                          <td class="bgSkySoft border border-dark">${parseFloat(item.PRV12M) === 0 ? '‎' : parseFloat(item.PRV12M).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                          <td class="bgGoldSoft border border-dark">${parseFloat(item.PRV06M) === 0 ? '‎' : parseFloat(item.PRV06M).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                          `;
                        tbDetalle.appendChild(row);
                    });
                } else {
                    const row = document.createElement('tr');
                    row.innerHTML = `<td colspan="5"><span style="font-size:16px; margin:50px;">No hay datos</span></td> `;
                    tbDetalle.appendChild(row);
                }
    }
    function chargeTable6(valAno, valAgrup) {
        let lblAno1 = document.getElementById('lblano6');
        lblAno1.innerHTML = 'Año ' + valAno;
        const tbDetalle = document.getElementById('tableInventarioDetalle6');
        tbDetalle.innerHTML = '';

                if (responseDataA2.length > 0) {
                    responseDataA2.forEach((item) => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                          <td class="bg-light border border-dark">${item.MESDES}</td>
                          <td class="bgSkySoft border border-dark">${parseFloat(item.PRV12M) === 0 ? '‎' : parseFloat(item.PRV12M).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                          <td class="bgGoldSoft border border-dark">${parseFloat(item.PRV06M) === 0 ? '‎' : parseFloat(item.PRV06M).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                          `;
                        tbDetalle.appendChild(row);
                    });
                } else {
                    const row = document.createElement('tr');
                    row.innerHTML = `<td colspan="5"><span style="font-size:16px; margin:50px;">No hay datos</span></td>`;
                    tbDetalle.appendChild(row);
                }
        }



    function chargeGrafica() {
        const cbbGrafica = document.getElementById('selectGrafica');
        let valGrafica = cbbGrafica.value;

        const cbbAno = document.getElementById('cbbAno');
        let valAno = parseInt(cbbAno.value);
        let valAno2 = valAno - 1;
        let valoresLineal1 = [];
        let valoresLineal2 = [];
        switch (valGrafica) {
            case 'G1':
                valoresLineal1 = lineMIN12M1;
                valoresLineal2 = lineMIN12M2;
                break;
            case 'G2':
                valoresLineal1 = lineMIN06M1;
                valoresLineal2 = lineMIN06M2;
                break;
            default:
                valoresLineal1 = lineMIN12M1;
                valoresLineal2 = lineMIN12M2;
                break;
        }

        chart1.update({
            chart: {
                type: 'line'
            },
            title: {
                text: cbbGrafica.options[cbbGrafica.selectedIndex].text + '<br>' + cbbAgrup.options[cbbAgrup
                    .selectedIndex].text,
                align: 'center'
            },
            xAxis: {
                categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                    'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                ],
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
                name: 'Año ' + valAno,
                data: valoresLineal1,
            }, {
                name: 'Año ' + valAno2,
                data: valoresLineal2,
            }]
        });
    }
    function chargeGrafica2() {
        const cbbGrafica = document.getElementById('selectGrafica2');
        let valGrafica = cbbGrafica.value;

        const cbbAno = document.getElementById('cbbAno');
        let valAno = parseInt(cbbAno.value);
        let valAno2 = valAno - 1;
        let valoresLineal1 = [];
        let valoresLineal2 = [];
        switch (valGrafica) {
            case 'G1':
                valoresLineal1 = lineUNICOM1;
                valoresLineal2 = lineUNICOM2;
                break;
            case 'G2':
                valoresLineal1 = lineUNIVEN1;
                valoresLineal2 = lineUNIVEN2;
                break;
            case 'G3':
                valoresLineal1 = lineUNIEXI1;
                valoresLineal2 = lineUNIEXI2;
                break;
            default:
                valoresLineal1 = lineUNICOM1;
                valoresLineal2 = lineUNICOM2;
                break;
        }
        chart2.update({
            chart: {
                type: 'line'
            },
            title: {
                text: cbbGrafica.options[cbbGrafica.selectedIndex].text + '<br>' + cbbAgrup.options[cbbAgrup
                    .selectedIndex].text,
                align: 'center'
            },
            xAxis: {
                categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                    'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                ],
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
                name: 'Año ' + valAno,
                data: valoresLineal1,
            }, {
                name: 'Año ' + valAno2,
                data: valoresLineal2,
            }]
        });
    }
    function chargeGrafica3() {
        const cbbGrafica = document.getElementById('selectGrafica3');
        let valGrafica = cbbGrafica.value;

        const cbbAno = document.getElementById('cbbAno');
        let valAno = parseInt(cbbAno.value);
        let valAno2 = valAno - 1;
        let valoresLineal1 = [];
        let valoresLineal2 = [];
        switch (valGrafica) {
            case 'G1':
                valoresLineal1 = linePRV12M1;
                valoresLineal2 = linePRV12M2;
                break;
            case 'G2':
                valoresLineal1 = linePVR06M1;
                valoresLineal2 = linePVR06M2;
                break;
            default:
                valoresLineal1 = linePRV12M1;
                valoresLineal2 = linePRV12M2;
                break;
        }

        chart3.update({
            chart: {
                type: 'line'
            },
            title: {
                text: cbbGrafica.options[cbbGrafica.selectedIndex].text + '<br>' + cbbAgrup.options[cbbAgrup
                    .selectedIndex].text,
                align: 'center'
            },
            xAxis: {
                categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                    'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                ],
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
                name: 'Año ' + valAno,
                data: valoresLineal1,
            }, {
                name: 'Año ' + valAno2,
                data: valoresLineal2,
            }]
        });
    }
    </script>
</body>

</html>