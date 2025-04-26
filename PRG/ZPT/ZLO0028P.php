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

                <figure class="highcharts-figure">
                    <div id="container" class="highcharts-dark text-white Math.rounded">
                    </div>
                </figure>
                <div class="table-responsive container-fluid p-3" style="width:100%">
                    <button type="button" id="btnExport" class="btn btn-success text-light fs-6 text-center mb-3"
                        style="width:280px;">
                        <i class="fa-solid fa-file-excel me-1"></i><b>Enviar a Excel</b>
                    </button>
                    <table id="tableInventario" class="table stripe table-hover text-center "
                        style="width:100%; font-size:15px; color:#000;">
                        <thead>
                            <tr>
                                <th colspan="6" class=" border border-dark bg-secondary align-middle fs-5">
                                    Meses inventario 6 meses
                                </th>
                            </tr>
                            <tr>
                                <th class=" border border-dark bg-secondary align-middle fs-5">
                                    Mes
                                </th>
                                <th class=" border border-dark bg-secondary align-middle">
                                    <span id="lblano1" class="fs-5"></span>
                                </th>
                                <th class=" border border-dark bg-secondary align-middle">
                                    <span id="lblano2" class="fs-5"></span>
                                </th>
                                <th class=" border border-dark bg-secondary align-middle">
                                    <span id="lblano3" class="fs-5"></span>
                                </th>
                                <th class=" border border-dark bg-secondary align-middle">
                                    <span id="lblano4" class="fs-5"></span>
                                </th>
                                <th class=" border border-dark bg-secondary align-middle">
                                    <span id="lblano5" class="fs-5"></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tableInventarioDetalle">
                            <tr id="tr1">
                                <td>Enero</td>
                            </tr>
                            <tr id="tr2">
                                <td>Febrero</td>
                            </tr>
                            <tr id="tr3">
                                <td>Marzo</td>
                            </tr>
                            <tr id="tr4">
                                <td>Abril</td>
                            </tr>
                            <tr id="tr5">
                                <td>Mayo</td>
                            </tr>
                            <tr id="tr6">
                                <td>Junio</td>
                            </tr>
                            <tr id="tr7">
                                <td>Julio</td>
                            </tr>
                            <tr id="tr8">
                                <td>Agosto</td>
                            </tr>
                            <tr id="tr9">
                                <td>Septiembre</td>
                            </tr>
                            <tr id="tr10">
                                <td>Octubre</td>
                            </tr>
                            <tr id="tr11">
                                <td>Noviembre</td>
                            </tr>
                            <tr id="tr12">
                                <td>Diciembre</td>
                            </tr>
                        </tbody>
                    </table>
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
    <script src="https://code.highcharts.com/modules/offline-exporting.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        let lineMIN06M1 = [];
        let lineMIN06M2 = [];
        let lineMIN06M3 = [];
        let lineMIN06M4 = [];
        let lineMIN06M5 = [];

        let chart1 = null;
        window.addEventListener('DOMContentLoaded', (event) => {
            const cbbAgrup = document.getElementById('cbbAgrup');
            let usuario = '<?php echo $_SESSION["CODUSU"]; ?>';
            const cbbAno = document.getElementById('cbbAno');
            cbbAgrup.addEventListener('change', (event) => {
                chargeTable();
            });
            cbbAno.addEventListener('change', (event) => {
                chargeTable();
            });

            const btnExport = document.getElementById('btnExport');
            btnExport.addEventListener("click", async () => {
                let valAno = parseInt(cbbAno.value);
                let valAgrup = cbbAgrup.value;
                const url = `/API.LovablePHP/ZLO0028P/Export/?anopro=${valAno}&cia=${valAgrup}`;

                try {
                    const response = await fetch(url);

                    if (!response.ok) {
                        throw new Error(`Error en la descarga: ${response.statusText}`);
                    }

                    const blob = await response.blob();
                    const fileUrl = window.URL.createObjectURL(blob);
                    const a = document.createElement("a");

                    a.href = fileUrl;
                    a.download = `MesesInventario_${valAno}.xlsx`;
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                    window.URL.revokeObjectURL(fileUrl);

                } catch (error) {
                    console.error("Error al descargar el archivo:", error);
                }
            });

            chargeTable();
        });
        async function chargeTable() {
            lineMIN06M1 = []; lineMIN06M2 = []; lineMIN06M3 = []; lineMIN06M4 = []; lineMIN06M5 = [];
            let valAno = parseInt(cbbAno.value);
            let valAgrup = cbbAgrup.value;
            let cont = 1;
            const responseData = [];
            const tbody = document.getElementById('tableInventarioDetalle');
            tbody.innerHTML = `<tr id="tr1" class="bg-light border border-dark"><td>Enero</td></tr><tr id="tr2" class="bg-light border border-dark"><td>Febrero</td></tr><tr id="tr3" class="bg-light border border-dark"><td>Marzo</td></tr><tr id="tr4" class="bg-light border border-dark"><td>Abril</td></tr><tr id="tr5" class="bg-light border border-dark"><td>Mayo</td></tr><tr id="tr6" class="bg-light border border-dark"><td>Junio</td></tr><tr id="tr7" class="bg-light border border-dark"><td>Julio</td></tr><tr id="tr8" class="bg-light border border-dark"><td>Agosto</td></tr><tr id="tr9" class="bg-light border border-dark"><td>Septiembre</td></tr><tr id="tr10" class="bg-light border border-dark"><td>Octubre</td></tr><tr id="tr11" class="bg-light border border-dark"><td>Noviembre</td></tr><tr id="tr12" class="bg-light border border-dark"><td>Diciembre</td></tr>`;
            for (let index = (valAno - 4); index <= valAno; index++) {
                document.getElementById(`lblano${cont}`).innerHTML = 'Año ' + index;
                cont++;
                const urlList = `/API.LovablePHP/ZLO0028P/List/?anopro=${index}&cia=${valAgrup}`;
                try {
                    const response = await fetch(urlList);
                    const data = await response.json();

                    if (data.code == 200) {
                        responseData.push(data.data);
                    }
                } catch (error) {
                    console.error(`Error en el año ${index}:`, error);
                }
            }
            let anoCont = 1;
            responseData.forEach((data) => {
                cont = 1
                data.forEach((item) => {
                    const tdRow = document.getElementById(`tr${cont}`);
                    const td2 = document.createElement('td');
                    td2.classList.add('bgGoldSoft', 'border', 'border-dark');
                    td2.innerHTML = parseFloat(item.MIN06M) === 0 ? '‎' : parseFloat(item.MIN06M).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                    tdRow.appendChild(td2);
                    cont++
                })
                data.forEach((item) => {
                    switch (anoCont) {
                        case 1:
                            lineMIN06M1.push(parseFloat(item.MIN06M));
                            break;
                        case 2:
                            lineMIN06M2.push(parseFloat(item.MIN06M));
                            break;
                        case 3:
                            lineMIN06M3.push(parseFloat(item.MIN06M));
                            break;
                        case 4:
                            lineMIN06M4.push(parseFloat(item.MIN06M));
                            break;
                        case 5:
                            lineMIN06M5.push(parseFloat(item.MIN06M));
                            break;
                        default:
                            break;
                    }
                })
                anoCont++
            });
            chart1 = Highcharts.chart('container', {
                chart: {
                    type: 'line',
                    height: 500,
                    style: {
                        color: '#FFFFFF' // Aplica color blanco a todos los textos
                    }
                },
                lang: {
                    viewFullscreen: "Ver en pantalla completa",
                    exitFullscreen: "Salir de pantalla completa",
                    downloadJPEG: "Descargar imagen JPEG",
                    downloadPDF: "Descargar en PDF",
                },
                title: {
                    text: 'Meses inventario 6 meses <br>' + cbbAgrup
                        .options[cbbAgrup.selectedIndex].text,
                    align: 'center',
                    style: {
                        color: '#FFFFFF' // Color blanco para el título
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
                            color: '#FFFFFF' // Color blanco para el título del eje Y
                        }
                    },
                    labels: {
                        style: {
                            color: '#FFFFFF' // Color blanco para etiquetas del eje Y
                        }
                    }
                },
                legend: {
                    itemStyle: {
                        color: '#FFFFFF' // Color blanco para los nombres de las series
                    }
                },
                tooltip: {
                    style: {
                        color: '#FFFFFF' // Color blanco para el texto del tooltip
                    },
                    backgroundColor: '#000000', // Fondo negro para mejor visibilidad
                    borderColor: '#FFFFFF' // Borde blanco
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true,
                            formatter: function () {
                                return this.y.toLocaleString('es-ES').replace('.', ',');
                            },
                            style: {
                                color: '#FFFFFF', // Color blanco para etiquetas en líneas
                                fontWeight: 'bold'
                            }
                        },
                        enableMouseTracking: true
                    },
                    series: {
                        lineWidth: 4,
                        states: {
                            hover: {
                                enabled: true,
                                lineWidth: 4
                            }
                        }
                    }
                },
                credits: {
                    enabled: false
                },
                exporting: {
                    buttons: {
                        contextButton: {
                            menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"],
                            theme: {
                                fill: '#000000',
                                stroke: '#FFFFFF',
                                style: {
                                    color: '#FFFFFF' // Color blanco para los botones de exportación
                                }
                            }
                        },
                        showAllButton: {
                            text: 'Mostrar todos',
                            onclick: function () {
                                this.series.forEach(function (series) {
                                    series.setVisible(true, false);
                                });
                                this.redraw();
                            },
                            theme: {
                                fill: '#000000',
                                stroke: 'silver',
                                style: {
                                    color: '#FFFFFF' // Texto blanco en el botón "Mostrar todos"
                                }
                            }
                        },
                        removeAllButton: {
                            text: 'Quitar todos',
                            onclick: function () {
                                this.series.forEach(function (series) {
                                    series.setVisible(false, false);
                                });
                                this.redraw();
                            },
                            theme: {
                                fill: '#000000',
                                stroke: 'silver',
                                style: {
                                    color: '#FFFFFF' // Texto blanco en el botón "Quitar todos"
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
                    },
                    fallbackToExportServer: false
                },
                series: [
                    {
                        name: 'Año ' + (valAno - 4),
                        data: lineMIN06M1
                    },
                    {
                        name: 'Año ' + (valAno - 3),
                        data: lineMIN06M2
                    },
                    {
                        name: 'Año ' + (valAno - 2),
                        data: lineMIN06M3
                    },
                    {
                        name: 'Año ' + (valAno - 1),
                        data: lineMIN06M4
                    },
                    {
                        name: 'Año ' + valAno,
                        data: lineMIN06M5
                    }
                ]
            });
        }
    </script>
</body>

</html>