<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
    <link rel="stylesheet" href="../../assets/css/vendors/highcharts.css">
    <style>
    .positionRel {
        position: relative;
        left: 50%;
        transform: translateX(-50%);
    }

    div.dt-buttons {
        float: left;
    }

    @media (max-width: 1199px) {
        .graficasPC {
            display: none;
        }

        .graficasMovil {
            display: flex;

        }
    }

    @media (min-width: 1200px) {

        .graficasPC {
            display: block;
        }

        .graficasMovil {
            display: none;
        }
    }
    </style>
</head>

<body>
    <?php
      include '../layout-prg.php';
?>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <span>Producto Terminado / Inventarios</span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0002P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-3">
        <div class="card mb-5">
            <div class="card-header">

            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row mb-3">
                        <div class="col-6 col-lg-5">
                            <div>
                                <label class="form-control border border-0">Mostrar año:</label>
                            </div>
                            <div>
                                <select id="setYearTab" class="form-select fw-bold">
                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-lg-5">
                            <div>
                                <label class="form-control border border-0">Mostrar mes:</label>
                            </div>
                            <div>
                                <select id="setMesTab" class="form-select fw-bold">
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-2">
                            <div>
                                <label class="form-control border border-0">‎‎‎‎‎</label>
                            </div>
                            <div>
                                <button class="btn btn-danger text-white fw-bold" id="btnSearch" style="width:100%;">
                                    <i class="fa-solid fa-magnifying-glass"></i> Buscar</button>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="filtro1" class=" mt-2" id="">Visualizar gráfica por:</label>
                            <select id="selgra" class="form-select mb-2">
                                <option value="1">Mes vs mes anterior</option>
                                <option value="2">Mes vs mismo mes del año anterior</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="demo">
                    <div class="text-center">
                        <ul class="tablist" role="tablist">
                            <li id="tab1" class="tablist__tab text-center p-3  is-active" aria-controls="panel1"
                                aria-selected="true" role="tab" tabindex="0">Puntos de venta</li>
                            <li id="tab2" class="tablist__tab text-center p-3" aria-controls="panel2"
                                aria-selected="false" role="tab" tabindex="0">Países</li>
                            <li id="tab3" class="tablist__tab text-center p-3" aria-controls="panel3"
                                aria-selected="false" role="tab" tabindex="0">Fabrica</li>
                        </ul>
                    </div>
                    <div id="panel1" class="tablist__panel" aria-labelledby="tab1" aria-hidden="false" role="tabpanel">
                        <div class="card p-3">
                            <h5 class="fs-4 mb-2 mt-2 text-center responsive-font-example">Inventario disponible por
                                punto de venta</h5>
                            <form action="../../assets/php/ZPT/ZLO0002P/ordenLogica1.php" method="POST" id="formOrden"
                                class="mb-3">
                                <div class="row">
                                    <div class="col-12 ">
                                        <div class="row">
                                            <div class="col-12 col-lg-3 mt-2 d-flex  flex-wrap">
                                                <label for="cbbOrden2" class="me-3 mt-2" id="lblcbbOrden2">Organizar
                                                    por: </label>
                                                <select name="cbbOrden2" id="cbbOrden2" class="form-select">
                                                    <option value="1">Punto de venta</option>
                                                    <option value="2">Mayor a Menor</option>
                                                    <option value="3">Menor a Mayor</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-2 d-flex flex-wrap">
                                                <label for="filtro1" class=" mt-2" id="">Puntos de ventas: </label>
                                                <select name="filtro1" id="filtro1" class="form-select">
                                                    <option value="11">Honduras (Lov. Ecommerce)</option>
                                                    <option value="9">Honduras (Mod. Íntima)</option>
                                                    <option value="10">Guatemala</option>
                                                    <option value="12">El Salvador</option>
                                                    <option value="13">Costa Rica</option>
                                                    <option value="16">Nicaragua</option>
                                                    <option value="15">Republica Dominicana</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-lg-3 mt-4">
                                                <div class="form-control mt-2">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="productos" name="productos">
                                                    <label class="form-check-label" for="productos">
                                                        Incluir otros productos
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="graficasPC">
                                <div class="row">
                                    <div class="col-12">
                                        <figure class="highcharts-figure">
                                            <div id="container" class="highcharts-dark text-white Math.rounded"></div>
                                        </figure>
                                    </div>
                                </div>

                            </div>
                            <div class="graficasMovil justify-content-center mt-3 mb-3" style='width:100%;'>
                                <canvas id="miGrafica4"></canvas>
                            </div>
                            <hr class="mt-4 mb-4">

                            <div class="table-responsive">
                                <table id="myTableInventario" class="table stripe table-hover " style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="d-none">ID</th>
                                            <th>Punto de Venta</th>
                                            <th>Docenas <span id="Pv1"></span></th>
                                            <th>Docenas <span id="Pv2"></span></th>
                                            <th>Docenas <span id="Pv3"></span></th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTableInventarioBody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="panel2" class="tablist__panel is-hidden" aria-labelledby="tab2" aria-hidden="true"
                        role="tabpanel">
                        <div class="card p-3">
                            <h5 class="fs-4 mb-4 mt-2 text-center responsive-font-example">Inventario disponible por
                                país</h5>
                            <form action="../../assets/php/ZPT/ZLO0002P/ordenLogica1.php" method="POST" id="formOrden3"
                                class="mb-3">
                                <div class="row">
                                    <div class="col-12 ">
                                        <div class="row">
                                            <div class="col-12 col-lg-3 mt-2 d-flex  flex-wrap">
                                                <label for="cbbOrden3" class="me-3 mt-2" id="lblcbbOrden3">Organizar
                                                    por: </label>
                                                <select name="cbbOrden3" id="cbbOrden3" class="form-select">
                                                    <option value="1">País</option>
                                                    <option value="2">Mayor a Menor</option>
                                                    <option value="3">Menor a Mayor</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-lg-3 mt-4">
                                                <div class="form-control mt-2">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="productos3" name="productos3">
                                                    <label class="form-check-label" for="productos3">
                                                        Incluir otros productos
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-2 d-flex flex-wrap">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="positionRel" style='width:100%'>
                                <div class="graficasPC">
                                    <figure class="highcharts-figure">
                                        <div id="container2"></div>
                                    </figure>
                                </div>
                            </div>
                            <div class="graficasMovil justify-content-center mt-3 mb-3">
                                <canvas id="miGrafica3"></canvas>
                            </div>
                            <hr class="mt-4 mb-4">
                            <div class="table-responsive">
                                <table id="myTableInventarioPaises" class="table stripe table-hover "
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="d-none">ID</th>
                                            <th>Pais</th>
                                            <th>Docenas <span id="Pai1"></span></th>
                                            <th>Docenas <span id="Pai2"></span></th>
                                            <th>Docenas <span id="Pai3"></span></th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTableInventarioPaisesBody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="panel3" class="tablist__panel is-hidden" aria-labelledby="tab3" aria-hidden="true"
                        role="tabpanel">
                        <div class="card p-3">
                            <h5 class="fs-4 mb-4 mt-2 text-center responsive-font-example">Inventario disponible en
                                Fabrica</h5>
                            <form action="../../assets/php/ZPT/ZLO0002P/ordenLogica1.php" method="POST" id="formOrden4"
                                class="mb-3">
                                <div class="row">
                                    <div class="col-12 ">
                                        <div class="row">
                                            <div class="col-12 col-lg-3 mt-2 d-flex  flex-wrap">
                                                <label for="cbbOrden4" class="me-3 mt-2" id="lblcbbOrden4">Organizar
                                                    por: </label>
                                                <select name="cbbOrden4" id="cbbOrden4" class="form-select">
                                                    <option value="2">Mayor a Menor</option>
                                                    <option value="3">Menor a Mayor</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-lg-3 mt-4">
                                                <div class="form-control mt-2">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="productos4" name="productos4">
                                                    <label class="form-check-label" for="productos4">
                                                        Incluir otros productos
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-2 d-flex flex-wrap">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="positionRel" style='width:100%'>
                                <figure class="highcharts-figure">
                                    <div id="container3"></div>
                                </figure>
                            </div>
                            <hr class="mt-4 mb-4">
                            <div class="table-responsive">
                                <table id="myTableInventarioFab" class="table stripe table-hover " style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="d-none">ID</th>
                                            <th>Fabrica</th>
                                            <th>Docenas <span id="Fab1"></span></th>
                                            <th>Docenas <span id="Fab2"></span></th>
                                            <th>Docenas <span id="Fab3"></span></th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTableInventarioFabBody">
                                    </tbody>
                                </table>
                            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
    var gra1 = null;
    var gra2 = null;
    var gra3 = null;
    let selGrafica = null;
    $(document).ready(function() {
        var invArray1 = [];
        var invArray2 = [];
        var invArray3 = [];
        var invPaisArray = [];
        var invPaisArray2 = [];
        var invPaisArray3 = [];
        var invFabArray = [];
        var invFabArray2 = [];
        var invFabArray3 = [];
        var currentDate = new Date();
        var yearSelected = getCookie('yearTab') || currentDate.getFullYear();
        var selectY = document.getElementById('setYearTab');
        var currentYear = new Date().getFullYear();
        selectY.innerHTML = '';
        for (var year = 2021; year <= currentYear; year++) {
            var option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            selectY.appendChild(option);
        }
        selectY.value = yearSelected;
        var monthSelected = getCookie('mesTab') || currentDate.getMonth() + 1;
        var selectM = document.getElementById('setMesTab');
        var currentMonth = new Date().getMonth();
        var meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE',
            'OCTUBRE',
            'NOVIEMBRE', 'DICIEMBRE'
        ];
        selectM.innerHTML = '';
        for (var i = 0; i < meses.length; i++) {
            var option = document.createElement('option');
            option.value = i + 1;
            option.textContent = meses[i];
            selectM.appendChild(option);
        }
        selectM.value = monthSelected;

        <?php
                $ordenFiltro=isset($_SESSION['Orden2']) ? $_SESSION['Orden2'] : 1;
                $ordenFiltro3=isset($_SESSION['Orden3']) ? $_SESSION['Orden3'] : 1;
                $ordenFiltro4=isset($_SESSION['Orden4']) ? $_SESSION['Orden4'] : 2;
                $productos=isset($_SESSION['productos']) ? $_SESSION['productos']:0;
                $filtro1=isset($_SESSION['filtro1']) ? $_SESSION['filtro1']:11;
                $_SESSION['tab3'] = isset($_COOKIE['tabselected3']) ? $_COOKIE['tabselected3'] : "1";
              ?>
        //BOTONES
        var tab;
        $(".tablist__tab").click(function() {
            $(".tablist__tab").removeClass("is-active");
            $(this).addClass("is-active");
            var activeTab = $(".tablist__tab").filter(".is-active").attr("id");
            tab = (activeTab.substring(3, 4));
            document.cookie = "tabselected3=" + tab;
        });
        var tabSeleccionado = <?php echo isset($_SESSION['tab3']) ? $_SESSION['tab3'] : "false"; ?>;
        if (tabSeleccionado != false) {
            var tabs = $('.tablist__tab'),
                tabPanels = $('.tablist__panel');
            var thisTab = $("#tab" + tabSeleccionado + ""),
                thisTabPanelId = thisTab.attr('aria-controls'),
                thisTabPanel = $('#panel' + tabSeleccionado + '');
            tabs.attr('aria-selected', 'false').removeClass('is-active');
            thisTab.attr('aria-selected', 'true').addClass('is-active');
            tabPanels.attr('aria-hidden', 'true').addClass('is-hidden');
            thisTabPanel.attr('aria-hidden', 'false').removeClass('is-hidden');
        }
        $("#cbbOrden2").val(<?php echo $ordenFiltro;  ?>);
        $("#cbbOrden3").val(<?php echo $ordenFiltro3;  ?>);
        $("#cbbOrden4").val(<?php echo $ordenFiltro4;  ?>);
        $("#filtro1").val(<?php echo $filtro1;  ?>);
        $('#productos, #productos3, #productos4').prop('checked', <?php echo $productos;  ?>);
        $("#cbbOrden2, #productos, #filtro1").change(function() {
            $("#formOrden").submit();
        });
        $("#cbbOrden3, #productos3").change(function() {
            $("#formOrden3").submit();
        });
        $("#cbbOrden4, #productos4").change(function() {
            $("#formOrden4").submit();
        });
        //LLENADO TABLA
        var ordenPOV = '<?php echo $ordenFiltro; ?>';
        var otrosProd = '<?php echo $productos; ?>';
        var filtro1 = '<?php echo $filtro1; ?>';
        // var urlPOV='http://172.16.15.20/API.LovablePHP/ZLO0002P/ListPOV/?orden='+ordenPOV+'&otros='+otrosProd+''+'&filtro='+filtro1+'';

        const btn = document.getElementById('btnSearch');
        btn.addEventListener('click', function() {
            const yearSelected = document.getElementById('setYearTab').value;
            const monthSelected = document.getElementById('setMesTab').value;
            document.cookie = "yearTab=" + yearSelected;
            document.cookie = "mesTab=" + monthSelected;
            location.reload();
        });

        var currentMes = monthSelected;
        var currentYear = yearSelected;
        var comparMes = currentMes - 1;
        var comparYear = currentYear;
        if (comparMes == 0) {
            comparMes = 12;
            comparYear = comparYear - 1;
        }
        $("#Pv1").text(currentYear + ' - ' + meses[currentMes - 1]);
        $("#Pv2").text(comparYear + ' - ' + meses[comparMes - 1]);
        $("#Pv3").text(currentYear - 1 + ' - ' + meses[currentMes - 1]);
        $("#Pai1").text(currentYear + ' - ' + meses[currentMes - 1]);
        $("#Pai2").text(comparYear + ' - ' + meses[comparMes - 1]);
        $("#Pai3").text(currentYear - 1 + ' - ' + meses[currentMes - 1]);
        $("#Fab1").text(currentYear + ' - ' + meses[currentMes - 1]);
        $("#Fab2").text(comparYear + ' - ' + meses[comparMes - 1]);
        $("#Fab3").text(currentYear - 1 + ' - ' + meses[currentMes - 1]);

        var urlPOV = 'http://172.16.15.20/API.LovablePHP/ZLO0002P/ListPOV/?orden=' + ordenPOV + '&otros=' +
            otrosProd + '&filtro=' + filtro1 + '&ano=' + currentYear + '&mes=' + currentMes + '';
        console.log(urlPOV);
        var responsePOV = ajaxRequest(urlPOV);
        var ordenFab = '<?php echo $ordenFiltro4; ?>';
        var urlFab = 'http://172.16.15.20/API.LovablePHP/ZLO0002P/ListFabrica/?orden=' + ordenFab +
            '&otros=' + otrosProd + '&ano=' + currentYear + '&mes=' + currentMes + '';
        console.log(urlFab);
        var responseFab = ajaxRequest(urlFab);
        if (responsePOV.code == 200) {
            var cantidadInv = 0;
            var docenas = 0;
            var decimales = 0;
            var ciaArray = [];

            var tableDetalle = document.getElementById('myTableInventarioBody');
            var options = '';
            tableDetalle.innerHTML = '';
            for (let i = 0; i < responsePOV.data.length; i++) {
                options += '<tr>';
                options += '<td class="fw-bold d-none">' + responsePOV.data[i]['CODSEC'] + '</td>';
                options += '<td class="fw-bold">' + responsePOV.data[i]['NOMCIA'] + '</td>';
                options += '<td class="fw-bold">' + parseFloat(responsePOV.data[i]['MAESA2']).toLocaleString(
                    'es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + '</td>';
                options += '<td class="fw-bold">' + parseFloat(responsePOV.data[i]['SACDOC1']).toLocaleString(
                    'es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + '</td>';
                options += '<td class="fw-bold">' + parseFloat(responsePOV.data[i]['SACDOC2']).toLocaleString(
                    'es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + '</td>';
                options += '</tr>';
                ciaArray.push(responsePOV.data[i]['NOMCIA']);
                invArray1.push(parseFloat(responsePOV.data[i]['MAESA2']));
                invArray2.push(parseFloat(responsePOV.data[i]['SACDOC1']));
                invArray3.push(parseFloat(responsePOV.data[i]['SACDOC2']));
            }
            tableDetalle.innerHTML = options;
        }
        var ordenPaises = '<?php echo $ordenFiltro3; ?>';
        var urlPaises = 'http://172.16.15.20/API.LovablePHP/ZLO0002P/ListPais/?orden=' + ordenPaises +
            '&otros=' + otrosProd + '&ano=' + currentYear + '&mes=' + currentMes + '';
        console.log(urlPaises);
        var responsePaises = ajaxRequest(urlPaises);
        if (responsePaises.code == 200) {
            var paisArray = [];

            var tableDetalle = document.getElementById('myTableInventarioPaisesBody');
            var options = '';
            tableDetalle.innerHTML = '';
            for (let i = 0; i < responsePaises.data.length; i++) {
                options += '<tr>';
                options += '<td class="fw-bold d-none">' + responsePaises.data[i]['CODSEC'] + '</td>';
                options += '<td class="fw-bold">' + responsePaises.data[i]['NOMCIA'] + '</td>';
                options += '<td class="fw-bold">' + parseFloat(responsePaises.data[i]['MAESA2']).toLocaleString(
                    'es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + '</td>';
                options += '<td class="fw-bold">' + parseFloat(responsePaises.data[i]['SACDOC1'])
                    .toLocaleString('es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + '</td>';
                options += '<td class="fw-bold">' + parseFloat(responsePaises.data[i]['SACDOC2'])
                    .toLocaleString('es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + '</td>';
                options += '</tr>';
                paisArray.push(responsePaises.data[i]['NOMCIA']);
                invPaisArray.push(parseFloat(responsePaises.data[i]['MAESA2']));
                invPaisArray2.push(parseFloat(responsePaises.data[i]['SACDOC1']));
                invPaisArray3.push(parseFloat(responsePaises.data[i]['SACDOC2']));
            }
            tableDetalle.innerHTML = options;
        }

        if (responseFab.code == 200) {
            var cantidadInv = 0;
            var docenas = 0;
            var decimales = 0;
            var ciaFab = [];
            var tableDetalle = document.getElementById('myTableInventarioFabBody');
            var options = '';
            tableDetalle.innerHTML = '';
            for (let i = 0; i < responseFab.data.length; i++) {
                options += '<tr>';
                options += '<td class="fw-bold d-none">' + responseFab.data[i]['CODSEC'] + '</td>';
                options += '<td class="fw-bold">' + responseFab.data[i]['NOMCIA'] + '</td>';
                options += '<td class="fw-bold">' + parseFloat(responseFab.data[i]['MAESA2']).toLocaleString(
                    'es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + '</td>';
                options += '<td class="fw-bold">' + parseFloat(responseFab.data[i]['SACDOC1']).toLocaleString(
                    'es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + '</td>';
                options += '<td class="fw-bold">' + parseFloat(responseFab.data[i]['SACDOC2']).toLocaleString(
                    'es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + '</td>';
                options += '</tr>';
                ciaFab.push(responseFab.data[i]['NOMCIA']);
                invFabArray.push(parseFloat(responseFab.data[i]['MAESA2']));
                invFabArray2.push(parseFloat(responseFab.data[i]['SACDOC1']));
                invFabArray3.push(parseFloat(responseFab.data[i]['SACDOC2']));
            }
            tableDetalle.innerHTML = options;
        }
        $("#myTableInventario, #myTableInventarioPaises, #myTableInventarioFab").DataTable({
            stateSave: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            },

            columns: [{},
                {},
                {},
                {},
                {},
            ],
            "ordering": false,
            "pageLength": 100,
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excelHtml5',
                text: '<i class="fa-solid fa-file-excel"></i> <b >Enviar a Excel</b>',
                className: "btn btn-success text-light fs-6 mb-2",
                exportOptions: {
                    columns: [1, 2, 3, 4]
                },
                title: 'Reporte de Inventario disponible',
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
                    var n2 = '<numFmt formatCode="#,##0.00"   numFmtId="200"/>';
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
                    sSh.childNodes[0].childNodes[5].innerHTML += s1 + s2 + s3 + s4 + s5 +
                        s6 + s7 + s8;

                    var fourDecPlaces = lastXfIndex + 1;
                    var greyBoldCentered = lastXfIndex + 2;
                    var twoDecPlacesBold = lastXfIndex + 3;
                    var greyBoldWrapText = lastXfIndex + 4;
                    var textred1 = lastXfIndex + 5;
                    var textgreen1 = lastXfIndex + 6;
                    var textred2 = lastXfIndex + 7;
                    var textgreen2 = lastXfIndex + 8;

                    $('c[r=A1] t', sheet).text('REPORTE DE INVENTARIO DISPONIBLE');
                    $('row:eq(0) c', sheet).attr('s', greyBoldCentered);
                    $('row:eq(1) c', sheet).attr('s', 7);

                    var tagName = sSh.getElementsByTagName('sz');
                    for (i = 0; i < tagName.length; i++) {
                        tagName[i].setAttribute("val", "13")
                    }
                }
            }]
        })

        Chart.register(ChartDataLabels);
        //GRAFICA BARRAS
        selGrafica = document.getElementById('selgra');
        chargeChart(ciaArray, paisArray, ciaFab, invArray1, invArray2, invArray3, invPaisArray, invPaisArray2,
            invPaisArray3, invFabArray, invFabArray2, invFabArray3, currentYear, meses, currentMes,
            comparYear, comparMes);
        selGrafica.addEventListener('change', function() {
            chargeChart(ciaArray, paisArray, ciaFab, invArray1, invArray2, invArray3, invPaisArray,
                invPaisArray2, invPaisArray3, invFabArray, invFabArray2, invFabArray3, currentYear,
                meses, currentMes, comparYear, comparMes);
        });

        //GRAFICA DONA
        const ctx3 = document.getElementById('miGrafica3').getContext('2d');
        var myChart3 = new Chart(ctx3, {
            type: 'pie',
            data: {
                labels: paisArray,
                datasets: [{
                    label: 'Docenas',
                    data: invPaisArray,
                    backgroundColor: [
                        "rgba(20, 36, 89,0.6)", "rgba(23, 107, 160,0.6)",
                        "rgba(25, 170, 222,0.6)", "rgba(26, 201, 230,0.6)",
                        "rgba(29, 228, 219,0.6)", "rgba(109, 240, 210,0.6)",
                        "rgba(41, 6, 107,0.6)", "rgba(125, 58, 193,0.6)",
                        "rgba(175, 75, 206,0.6)", "rgba(219, 76, 178,0.6)",
                        "rgba(130, 4, 1,0.6)", "rgba(192, 35, 35,0.6)",
                        "rgba(222, 84, 44,0.6)", "rgba(239, 126, 50,0.6)",
                        "rgba(238, 154, 58,0.6)", "rgba(234, 219, 56,0.6)",
                        "rgba(79, 32, 13,0.6)", "rgba(231, 227, 78,0.6)",
                    ],
                    borderColor: [
                        "rgba(0,0,0,0.2)"
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                "tooltips": {
                    "callbacks": {
                        "label": function(tooltipItem, data) {
                            var label = "prueba";
                            var value = "1";
                            return label + ': ' + value;
                        }
                    }
                },
                maintainAspectRatio: false,
                responsive: false,
                "plugins": {
                    "legend": {
                        "display": false,
                        "position": "bottom",

                    },
                    datalabels: {
                        color: '#fff',
                        offset: -10,
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });
        const ctx4 = document.getElementById('miGrafica4').getContext('2d');
        var myChart4 = new Chart(ctx4, {
            type: 'pie',
            data: {
                labels: ciaArray,
                datasets: [{
                    label: 'Docenas',
                    data: invArray1,
                    backgroundColor: [
                        "rgba(20, 36, 89,0.6)", "rgba(23, 107, 160,0.6)",
                        "rgba(25, 170, 222,0.6)", "rgba(26, 201, 230,0.6)",
                        "rgba(29, 228, 219,0.6)", "rgba(109, 240, 210,0.6)",
                        "rgba(41, 6, 107,0.6)", "rgba(125, 58, 193,0.6)",
                        "rgba(175, 75, 206,0.6)", "rgba(219, 76, 178,0.6)",
                        "rgba(130, 4, 1,0.6)", "rgba(192, 35, 35,0.6)",
                        "rgba(222, 84, 44,0.6)", "rgba(239, 126, 50,0.6)",
                        "rgba(238, 154, 58,0.6)", "rgba(234, 219, 56,0.6)",
                        "rgba(79, 32, 13,0.6)", "rgba(231, 227, 78,0.6)",
                    ],
                    borderColor: [
                        "rgba(0,0,0,0.2)"
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                "tooltips": {
                    "callbacks": {
                        "label": function(tooltipItem, data) {
                            var label = "prueba";
                            var value = "1";
                            return label + ': ' + value;
                        }
                    }
                },
                maintainAspectRatio: false,
                responsive: false,
                "plugins": {
                    "legend": {
                        "display": false,
                        "position": "bottom",

                    },
                    datalabels: {
                        formatter: (value, ctx) => {
                            const datapoints = ctx.chart.data.datasets[0].data
                            const total = datapoints.reduce((total, datapoint) => total + datapoint,
                                0)
                            const percentage = value / total * 100
                            return percentage.toFixed(2) + "%";
                        },
                        color: '#fff',
                        offset: -10,
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });
    });

    function chargeChart(ciaArray, paisArray, ciaFab, invArray1, invArray2, invArray3, invPaisArray, invPaisArray2,
        invPaisArray3, invFabArray, invFabArray2, invFabArray3, currentYear, meses, currentMes, comparYear, comparMes) {
        var valor = selGrafica.value;
        let title = '';
        switch (valor) {
            case '2':
                title = 'Mes vs mismo mes del año anterior';
                gra1 = Highcharts.chart('container', {
                    chart: {
                        type: 'column',
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
                        text: title,
                        align: 'center',
                        style: {
                            color: '#FFFFFF'
                        }
                    },
                    xAxis: {
                        categories: ciaArray,
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
                                format: '{point.y}',
                                color: '#FFFFFF'
                            },
                            enableMouseTracking: false
                        }
                    },
                    tooltip: {
                        style: {
                            color: '#FFFFFF'
                        }
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
                    credits: {
                        enabled: false
                    },
                    series: [{
                            name: currentYear + ' - ' + meses[currentMes - 1],
                            data: invArray1,
                            dataLabels: [{
                                align: "center",
                                inside: false,
                                enabled: true,
                                borderColor: "",
                                style: {
                                    fontSize: "12px",
                                    fontWeight: 'bold',
                                    fontFamily: "Arial",
                                    textShadow: false,
                                    color: '#FFFFFF'
                                }
                            }],
                        },
                        {
                            name: currentYear - 1 + ' - ' + meses[currentMes - 1],
                            data: invArray3,
                            dataLabels: [{
                                align: "center",
                                inside: false,
                                enabled: true,
                                borderColor: "",
                                style: {
                                    fontSize: "12px",
                                    fontWeight: 'bold',
                                    fontFamily: "Arial",
                                    textShadow: false,
                                    color: '#FFFFFF'
                                }
                            }],
                        },
                    ],
                });
                gra2 = Highcharts.chart('container2', {
                    chart: {
                        type: 'column',
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
                        text: title,
                        align: 'center',
                        style: {
                            color: '#FFFFFF'
                        }
                    },
                    xAxis: {
                        categories: paisArray,
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
                                format: '{point.y}',
                                color: '#FFFFFF'
                            },
                            enableMouseTracking: false
                        }
                    },
                    tooltip: {
                        style: {
                            color: '#FFFFFF'
                        }
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
                    credits: {
                        enabled: false
                    },
                    series: [{
                            name: currentYear + ' - ' + meses[currentMes - 1],
                            data: invPaisArray,
                            dataLabels: [{
                                align: "center",
                                inside: false,
                                enabled: true,
                                borderColor: "",
                                style: {
                                    fontSize: "12px",
                                    fontWeight: 'bold',
                                    fontFamily: "Arial",
                                    textShadow: false,
                                    color: '#FFFFFF'
                                }
                            }],
                        },
                        {
                            name: currentYear - 1 + ' - ' + meses[currentMes - 1],
                            data: invPaisArray3,
                            dataLabels: [{
                                align: "center",
                                inside: false,
                                enabled: true,
                                borderColor: "",
                                style: {
                                    fontSize: "12px",
                                    fontWeight: 'bold',
                                    fontFamily: "Arial",
                                    textShadow: false,
                                    color: '#FFFFFF'
                                }
                            }],
                        },
                    ],
                });
                gra3 = Highcharts.chart('container3', {
                    chart: {
                        type: 'column',
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
                        text: title,
                        align: 'center',
                        style: {
                            color: '#FFFFFF'
                        }
                    },
                    xAxis: {
                        categories: ciaFab,
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
                                format: '{point.y}',
                                color: '#FFFFFF'
                            },
                            enableMouseTracking: false
                        }
                    },
                    tooltip: {
                        style: {
                            color: '#FFFFFF'
                        }
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
                    credits: {
                        enabled: false
                    },
                    series: [{
                            name: currentYear + ' - ' + meses[currentMes - 1],
                            data: invFabArray,
                            dataLabels: [{
                                align: "center",
                                inside: false,
                                enabled: true,
                                borderColor: "",
                                style: {
                                    fontSize: "12px",
                                    fontWeight: 'bold',
                                    fontFamily: "Arial",
                                    textShadow: false,
                                    color: '#FFFFFF'
                                }
                            }],
                        },
                        {
                            name: currentYear - 1 + ' - ' + meses[currentMes - 1],
                            data: invFabArray3,
                            dataLabels: [{
                                align: "center",
                                inside: false,
                                enabled: true,
                                borderColor: "",
                                style: {
                                    fontSize: "12px",
                                    fontWeight: 'bold',
                                    fontFamily: "Arial",
                                    textShadow: false,
                                    color: '#FFFFFF'
                                }
                            }],
                        },
                    ],
                });

                break;
            default:
                title = 'Mes vs mes anterior';
                gra1 = Highcharts.chart('container', {
                    chart: {
                        type: 'column',
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
                        text: title,
                        align: 'center',
                        style: {
                            color: '#FFFFFF'
                        }
                    },
                    xAxis: {
                        categories: ciaArray,
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
                                format: '{point.y}',
                                color: '#FFFFFF'
                            },
                            enableMouseTracking: false
                        }
                    },
                    tooltip: {
                        style: {
                            color: '#FFFFFF'
                        }
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
                    credits: {
                        enabled: false
                    },
                    series: [{
                            name: currentYear + ' - ' + meses[currentMes - 1],
                            data: invArray1,
                            dataLabels: [{
                                align: "center",
                                inside: false,
                                enabled: true,
                                borderColor: "",
                                style: {
                                    fontSize: "12px",
                                    fontWeight: 'bold',
                                    fontFamily: "Arial",
                                    textShadow: false,
                                    color: '#FFFFFF'
                                }
                            }],
                        },
                        {
                            name: comparYear + ' - ' + meses[comparMes - 1],
                            data: invArray2,
                            dataLabels: [{
                                align: "center",
                                inside: false,
                                enabled: true,
                                borderColor: "",
                                style: {
                                    fontSize: "12px",
                                    fontWeight: 'bold',
                                    fontFamily: "Arial",
                                    textShadow: false,
                                    color: '#FFFFFF'
                                }
                            }],
                        },
                    ],
                });
                gra2 = Highcharts.chart('container2', {
                    chart: {
                        type: 'column',
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
                        text: title,
                        align: 'center',
                        style: {
                            color: '#FFFFFF'
                        }
                    },
                    xAxis: {
                        categories: paisArray,
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
                                format: '{point.y}',
                                color: '#FFFFFF'
                            },
                            enableMouseTracking: false
                        }
                    },
                    tooltip: {
                        style: {
                            color: '#FFFFFF'
                        }
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
                    credits: {
                        enabled: false
                    },
                    series: [{
                            name: currentYear + ' - ' + meses[currentMes - 1],
                            data: invPaisArray,
                            dataLabels: [{
                                align: "center",
                                inside: false,
                                enabled: true,
                                borderColor: "",
                                style: {
                                    fontSize: "12px",
                                    fontWeight: 'bold',
                                    fontFamily: "Arial",
                                    textShadow: false,
                                    color: '#FFFFFF'
                                }
                            }],
                        },
                        {
                            name: comparYear + ' - ' + meses[comparMes - 1],
                            data: invPaisArray2,
                            dataLabels: [{
                                align: "center",
                                inside: false,
                                enabled: true,
                                borderColor: "",
                                style: {
                                    fontSize: "12px",
                                    fontWeight: 'bold',
                                    fontFamily: "Arial",
                                    textShadow: false,
                                    color: '#FFFFFF'
                                }
                            }],
                        },
                    ],
                });
                gra3 = Highcharts.chart('container3', {
                    chart: {
                        type: 'column',
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
                        text: title,
                        align: 'center',
                        style: {
                            color: '#FFFFFF'
                        }
                    },
                    xAxis: {
                        categories: ciaFab,
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
                                format: '{point.y}',
                                color: '#FFFFFF'
                            },
                            enableMouseTracking: false
                        }
                    },
                    tooltip: {
                        style: {
                            color: '#FFFFFF'
                        }
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
                    credits: {
                        enabled: false
                    },
                    series: [{
                            name: currentYear + ' - ' + meses[currentMes - 1],
                            data: invFabArray,
                            dataLabels: [{
                                align: "center",
                                inside: false,
                                enabled: true,
                                borderColor: "",
                                style: {
                                    fontSize: "12px",
                                    fontWeight: 'bold',
                                    fontFamily: "Arial",
                                    textShadow: false,
                                    color: '#FFFFFF'
                                }
                            }],
                        },
                        {
                            name: comparYear + ' - ' + meses[comparMes - 1],
                            data: invFabArray2,
                            dataLabels: [{
                                align: "center",
                                inside: false,
                                enabled: true,
                                borderColor: "",
                                style: {
                                    fontSize: "12px",
                                    fontWeight: 'bold',
                                    fontFamily: "Arial",
                                    textShadow: false,
                                    color: '#FFFFFF'
                                }
                            }],
                        },
                    ],
                });
                break;
        }
    }
    </script>
</body>

</html>