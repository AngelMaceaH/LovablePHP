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
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.3.0/css/fixedColumns.dataTables.min.css">
</head>

<body>
    <?php
    include '../layout-prg.php';
    include '../../assets/php/ZPT/ZLO0012P/header.php';
    $valAgrup = isset($_SESSION['agrup']) ? "true" : "false";
    $agrup = isset($_SESSION['agrup']) ? $_SESSION['agrup'] : '1';
    $ckProductos1 = isset($_SESSION['productosCk1']) ? $_SESSION['productosCk1'] : "0";
    $filtro = isset($_SESSION['filtro']) ? $_SESSION['filtro'] : '1';
    ?>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <span>Producto Terminado / Clasificación de producto</span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0012P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-1">
        <div class="card mb-5">
            <div class="card-header">
                <h1 class="fs-4 mb-1 mt-2 text-center">Análisis de movimiento de estilos <br> <b>(UNIDADES)</b> </h1>
            </div>
            <div class="card-body">
                <div class="position-relative">
                    <form id="formFiltros" action="../../assets/php/ZPT/ZLO0012P/filtrosLogica.php" method="POST">
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-6 mt-2">
                                <label>Visualizar por:</label>
                                <select class="form-select  mt-1" id="cbbAgrupacion" name="cbbAgrupacion">

                                </select>
                            </div>
                            <div class="col-sm-12 col-md-6 mt-2">
                                <label>Filtrar por:</label>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" value="1" type="radio" name="radioFiltro"
                                                id="check1" checked>
                                            <label class="form-check-label fs-6" for="check1">
                                                Inventario General
                                            </label>
                                        </div>

                                    </div>
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" value="3" type="radio" name="radioFiltro"
                                                id="check3">
                                            <label class="form-check-label fs-6" for="check3">
                                                Inventario Descontinuado
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" value="2" type="radio" name="radioFiltro"
                                                id="check2">
                                            <label class="form-check-label fs-6" for="check2">
                                                Inventario en Linea
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" value="4" type="radio" name="radioFiltro"
                                                id="check4">
                                            <label class="form-check-label fs-6" for="check4">
                                                Inventario Obsoleto
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                            </div>
                    </form>
                </div>
                <hr>
                <div class="table-container mt-3 position-relative" style="width:100%;">
                    <div id="loaderTable" class="d-none">
                        <button class="btn btn-success position-absolute top-50 start-50 translate-middle p-4"
                            style="z-index: 9999;" type="button" disabled>
                            <i class="fa-solid fa-file-excel fa-flip text-white" style="font-size:70px;"></i>
                        </button>
                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-secondary bg-opacity-50 rounded"
                            style="z-index: 9998;"></div>
                    </div>
                    <div>
                        <label class="ms-2 fw-bold  mb-3">**Presione doble clic para ver detalles por estilo color y
                            talla**</label>
                        <table id="myTableSeguimiento" class="table stripe table-hover " style="width:100%">
                            <thead>
                                <tr class="sticky-top bg-white" style="font-size: 14px;">
                                    <th class="responsive-font-example text-center text-black">Estilo</th>
                                    <th class="responsive-font-example text-center">N.</th>
                                    <th class="responsive-font-example text-center text-black">Und. Vtas.<br>Totales
                                    </th>
                                    <th class="responsive-font-example text-center text-black">Und. Vtas.<br>Mes Proceso
                                    </th>
                                    <th class="responsive-font-example text-center text-black">Und. Vtas.<br>Ult. 12
                                        Meses</th>
                                    <th class="responsive-font-example text-center text-black">Prom.<br>Mensual</th>
                                    <th class="responsive-font-example text-center text-black">Existencia<br>Actual</th>
                                    <th class="responsive-font-example text-center text-black">Rot. Inv</th>
                                    <th class="responsive-font-example text-center text-black">Meses<br>Inventario</th>
                                    <th class="responsive-font-example text-center text-black">%<br>Descuento</th>
                                    <th class="responsive-font-example text-center text-black">Fecha Ingreso</th>
                                    <th class="responsive-font-example text-center text-black">Fecha<br>Ult/Compra</th>
                                    <th class="responsive-font-example text-center text-black">Fecha<br>Ult/Venta</th>
                                    <th class="responsive-font-example text-center text-black">Días<br>antigüedad </th>
                                    <th class="responsive-font-example text-center text-black">Días Ant.<br>Ult/Compra
                                    </th>
                                    <th class="responsive-font-example text-center text-black">Días Ant.<br>Ult/Venta
                                    </th>
                                    <th class="responsive-font-example text-center text-black">Tipo<br>Inventario</th>
                                    <th class="responsive-font-example text-center text-black">Marca</th>
                                    <th class="responsive-font-example text-center text-black">Genero</th>

                                </tr>
                            </thead>
                            <tbody id="myTableSeguimientoBody" style="font-size: 13px;">

                            </tbody>
                        </table>
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
    <script src="https://code.highcharts.com/modules/offline-exporting.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>
    <script>
        var agrupSelect = "";
        var filtroP = "";
        document.addEventListener('DOMContentLoaded', function () {
            var usuario = '<?php echo $_SESSION['CODUSU']; ?>';
            var urlAgrupaciones = "/API.LOVABLEPHP/ZLO0012P/ListAgrupacion/?user=" + usuario + "";
            var responseAgrupaciones = ajaxRequest(urlAgrupaciones);
            if (responseAgrupaciones && responseAgrupaciones.code == 200) {
                var options = "";
                responseAgrupaciones.data.forEach(item => {
                    options += "<option value='" + item['CODIGO'] + "'>" + item['DESCRI'] + "</option>";
                });
                document.getElementById('cbbAgrupacion').innerHTML += options;
                const validator = '<?php echo $valAgrup; ?>';
                if (validator == "false") {
                    agrupSelect = responseAgrupaciones.data[0]['CODIGO'];
                } else {
                    agrupSelect = '<?php echo $agrup; ?>';
                }
                if (agrupSelect == "0") {
                    agrupSelect = responseAgrupaciones.data[0]['CODIGO'];
                }
                document.getElementById('cbbAgrupacion').value = agrupSelect;

                document.getElementById('cbbAgrupacion').addEventListener('change', function () {
                    document.getElementById('formFiltros').submit();
                });


                var productosCk1 = <?php echo $ckProductos1; ?>;
                $('#productosCk1').prop('checked', productosCk1);

                $("#productosCk1").change(function () {
                    $("#formFiltros").submit();
                });
                var cond = productosCk1 ? "1" : "0";
                var filtroP = '<?php echo $filtro; ?>';
                ['check4', 'check3', 'check2', 'check1'].forEach(checkId => {
                    document.getElementById(checkId).addEventListener('change', function () {
                        document.getElementById('formFiltros').submit();
                    });
                });
                $("input[name=radioFiltro][value=" + filtroP + "]").prop('checked', true);
                var table = $('#myTableSeguimiento').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                        loadingRecords: `<button class="btn btn-danger " type="button" disabled>
                                                <span class="spinner-border text-white" style="width: 1.5rem; height: 1.5rem;"
                                                    aria-hidden="true"></span>
                                                <span role="status" class="ms-2 text-white fs-4">Cargando...</span>
                                            </button>`
                    },
                    fixedColumns: {
                        left: 1,
                    },
                    "pageLength": 20,
                    "ajax": {
                        "url": "/API.LOVABLEPHP/ZLO0012P/List/?agrup=" + agrupSelect +
                            "&cond=1&filtro=" + filtroP + "",
                        "type": "POST",
                        "complete": function (xhr) {
                            $("#thProcessing").addClass('d-none');
                            var registrosMismoEstilo = [];
                            var table = $('#myTableSeguimiento').DataTable();
                            table.rows().every(function (rowIdx, tableLoop, rowLoop) {
                                var data = this.data();
                                var rowNode = this.node();
                                if (rowIdx < table.rows().count() - 1) {
                                    $(rowNode).addClass('clickable-row');
                                    $(rowNode).attr('data-estilo', data.ESTILO);
                                    registrosMismoEstilo.push(data);
                                }
                            });
                            $('#myTableSeguimiento').on('dblclick', '.clickable-row', function () {
                                var estiloValue = $(this).data('estilo');
                                var registrosFiltrados = registrosMismoEstilo.filter(function (
                                    registro) {
                                    if (registro.ESTILO == estiloValue) {
                                        return registro;
                                    }
                                });
                                openModalDetalles(estiloValue);
                            });
                        },
                        error: function (xhr, status, error) {
                            console.log(error);
                            requestError = true;
                        }
                    },
                    "columns": [{
                        "data": "ESTILO",
                        className: "text-start"
                    },
                    {
                        "data": "ROWNUM",
                        className: "text-start",
                        visible: false,
                        "searchable": false
                    },
                    {
                        "data": "TTOT",
                        className: "text-end",
                        "searchable": false
                    },
                    {
                        "data": "MESTOT",
                        className: "text-end",
                        "searchable": false
                    },
                    {
                        "data": "UNIVEN",
                        className: "text-end text-cyan",
                        "searchable": false,
                        render: function (data) {
                            var valor = parseFloat(data);
                            if (isNaN(valor)) {
                                valor = '';
                            }
                            return valor.toLocaleString('es-419', {
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            });
                        }
                    },
                    {
                        "data": "PROMEN",
                        className: "text-end text-cyan",
                        "searchable": false,
                        render: function (data) {
                            var valor = parseFloat(data);
                            if (isNaN(valor)) {
                                valor = '';
                            }
                            return valor.toLocaleString('es-419', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            });
                        }
                    },
                    {
                        "data": "EXIACT",
                        className: "text-end text-green",
                        "searchable": false,
                        render: function (data) {
                            var valor = parseFloat(data);
                            if (isNaN(valor)) {
                                valor = '';
                            }
                            return valor.toLocaleString('es-419', {
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 0
                            });
                        }
                    },
                    {
                        "data": "ROTINV",
                        className: "text-end",
                        "searchable": false,
                        render: function (data) {
                            var valor = parseFloat(data);
                            if (isNaN(valor)) {
                                valor = '';
                            }
                            return valor.toLocaleString('es-419', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            });
                        }
                    },
                    {
                        "data": "MESINV",
                        className: "text-end text-warning",
                        "searchable": false,
                        render: function (data) {
                            var valor = parseFloat(data);
                            if (isNaN(valor)) {
                                valor = '';
                            }
                            return valor.toLocaleString('es-419', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            });
                        }
                    },
                    {
                        "data": "PORDES",
                        "searchable": false,
                        className: "text-end"
                    },
                    {
                        "data": "FECING",
                        "searchable": false,
                        render: function (data, type, row) {
                            const fechaOriginal = data;
                            if (fechaOriginal == "") {
                                return "";
                            } else {
                                const year = fechaOriginal.slice(0, 4);
                                const month = fechaOriginal.slice(4, 6);
                                const day = fechaOriginal.slice(6, 8);
                                const fechaConvertida = `${day}/${month}/${year}`;
                                return fechaConvertida;
                            }
                        },
                        className: "text-end"
                    },
                    {
                        "data": "FECCOM",
                        "searchable": false,
                        render: function (data, type, row) {
                            const fechaOriginal = data;
                            if (fechaOriginal == "") {
                                return "";
                            } else {
                                const year = fechaOriginal.slice(0, 4);
                                const month = fechaOriginal.slice(4, 6);
                                const day = fechaOriginal.slice(6, 8);
                                const fechaConvertida = `${day}/${month}/${year}`;
                                return fechaConvertida;
                            }
                        },
                        className: "text-end"
                    },
                    {
                        "data": "FECVEN",
                        "searchable": false,
                        render: function (data, type, row) {
                            const fechaOriginal = data;
                            if (fechaOriginal == "") {
                                return "";
                            } else {
                                const year = fechaOriginal.slice(0, 4);
                                const month = fechaOriginal.slice(4, 6);
                                const day = fechaOriginal.slice(6, 8);
                                const fechaConvertida = `${day}/${month}/${year}`;
                                return fechaConvertida;
                            }
                        },
                        className: "text-end"
                    },
                    {
                        "data": "DIAANT",
                        "searchable": false,
                        className: "text-end"
                    },
                    {
                        "data": "DIAANC",
                        "searchable": false,
                        className: "text-end"
                    },
                    {
                        "data": "DIAANV",
                        "searchable": false,
                        className: "text-end"
                    },
                    {
                        "data": "TIPINV",
                        "searchable": false,
                        "render": function (data, type, row) {
                            switch (data) {
                                case "L":
                                    return '<span class="text-success">' + data + '</span>';
                                    break;
                                case "O":
                                    return '<span class="text-danger">' + data + '</span>';
                                    break;
                                case "ND":
                                case "D":
                                    return '<span class="text-warning">' + data + '</span>';
                                    break;
                                default:
                                    return data;
                                    break;
                            }
                        },
                        "className": "text-end"
                    },
                    {
                        "data": "MARCA",
                        "searchable": false,
                        className: "text-start"
                    },
                    {
                        "data": "GENERO",
                        "searchable": false,
                        className: "text-start"
                    }
                    ],
                    ordering: true,
                    order: [
                        [1, 'asc']
                    ],
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'excelHtml5',
                        text: '<i class="fa-solid fa-file-excel"></i> <b >Enviar a Excel</b>',
                        className: "btn btn-success text-light fs-6 ",
                        action: function (e, dt, button, config) {
                            document.getElementById('loaderTable').classList.remove('d-none');
                            setTimeout(() => {
                                $.fn.dataTable.ext.buttons.excelHtml5.action.call(this,
                                    e, dt, button, config);
                                document.getElementById('loaderTable').classList.add(
                                    'd-none');
                            }, 100);
                        },
                        exportOptions: {
                            columns: [0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18]
                        },
                        title: 'Analis-MovimientoEstilos',
                        customize: function (xlsx) {
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
                            var f3 = '<font>' +
                                '<sz val="11" />' +
                                '<name val="Calibri" />' +
                                '<color rgb="00BBCD" />' + // color cyan de la fuente
                                '</font>';
                            var f4 = '<font>' +
                                '<sz val="11" />' +
                                '<name val="Calibri" />' +
                                '<color rgb="7E5006" />' + // color cyan de la fuente
                                '</font>';
                            var f5 = '<font>' +
                                '<sz val="11" />' +
                                '<name val="Calibri" />' +
                                '<color rgb="2A81F1" />' + // color azul oscuro de la fuente
                                '</font>';
                            var f6 = '<font>' +
                                '<sz val="11" />' +
                                '<name val="Calibri" />' +
                                '<color rgb="0F8900" />' + // color verde oscuro de la fuente
                                '</font>';
                            var f7 = '<font>' +
                                '<sz val="11" />' +
                                '<name val="Calibri" />' +
                                '<color rgb="C1C100" />' + // color amarillo de la fuente
                                '</font>';
                            var f8 = '<font>' +
                                '<sz val="11" />' +
                                '<name val="Calibri" />' +
                                '<color rgb="FFB202" />' + // color naranja de la fuente
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
                            var s9 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 3) +
                                '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s10 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 4) +
                                '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s11 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 5) +
                                '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s12 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 6) +
                                '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s13 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 7) +
                                '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s14 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 8) +
                                '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            sSh.childNodes[0].childNodes[0].innerHTML += n1 + n2;
                            sSh.childNodes[0].childNodes[1].innerHTML += f1 + f2 + f3 + f4 +
                                f5 +
                                f6 + f7 + f8;
                            sSh.childNodes[0].childNodes[5].innerHTML += s1 + s2 + s3 + s4 +
                                s5 +
                                s6 + s7 + s8 + s9 + s10 + s11 + s12 + s13 + s14;
                            var fourDecPlaces = lastXfIndex + 1;
                            var greyBoldCentered = lastXfIndex + 2;
                            var twoDecPlacesBold = lastXfIndex + 3;
                            var greyBoldWrapText = lastXfIndex + 4;
                            var textred1 = lastXfIndex + 5;
                            var textgreen1 = lastXfIndex + 6;
                            var textred2 = lastXfIndex + 7;
                            var textgreen2 = lastXfIndex + 8;
                            var textCyan = lastXfIndex + 9;
                            var textBrown = lastXfIndex + 10;
                            var textDarkblue = lastXfIndex + 11;
                            var textDarkGreen = lastXfIndex + 12;
                            var textYellow = lastXfIndex + 13;
                            var textNaranja = lastXfIndex + 14;
                            $('c[r=A1] t', sheet).text(
                                'REPORTE DE ANALISIS DE MOVIMIENTO DE ESTILOS (UNIDADES) ' + ($(
                                    "#cbbAgrupacion option:selected").text()).toUpperCase());
                            $('row:eq(0) c', sheet).attr('s', greyBoldCentered);
                            $('row:eq(1) c', sheet).attr('s', 7);
                            $('row', sheet).each(function () {
                                var row = $(this);
                                if (row.index() < 2) {
                                    return;
                                }
                                $('c[r^="D"], c[r^="E"]', row).attr('s', textCyan);
                                $('c[r^="F"]', row).attr('s', textgreen1);
                                $('c[r^="H"]', row).attr('s', textYellow);
                                var cellE = $('c[r^="P"]', row);
                                switch (cellE.text()) {
                                    case "L":
                                        $('c[r^="P"]', row).attr('s', textgreen1);
                                        break;
                                    case "O":
                                        $('c[r^="P"]', row).attr('s', textred1);
                                        break;
                                    case "ND":
                                    case "D":
                                        $('c[r^="P"]', row).attr('s', textYellow);
                                        break;
                                    default:
                                        $('c[r^="P"]', row).attr('s', 52);
                                        break;
                                }
                                if (cellE.text() === "TOTAL" || cellE.text() ===
                                    "TOTALM") {
                                    $('c[r^="A"], c[r^="B"], c[r^="C"], c[r^="D"], c[r^="E"], c[r^="F"], c[r^="G"], c[r^="H"], c[r^="I"], c[r^="J"], c[r^="K"], c[r^="L"], c[r^="M"], c[r^="N"], c[r^="O"], c[r^="P"], c[r^="Q"], c[r^="R"], c[r^="S"], c[r^="T"], c[r^="U"], c[r^="V"], c[r^="W"], c[r^="X"], c[r^="Y"], c[r^="Z"], c[r^="AA"], c[r^="AB"], c[r^="AC"], c[r^="AD"], c[r^="AE"], c[r^="AF"], c[r^="AG"]',
                                        row).attr('s', 7);
                                    $('c[r^="A"], c[r^="B"], c[r^="C"], c[r^="D"], c[r^="E"]',
                                        row).text('s', ' ');
                                }
                            });
                            var tagName = sSh.getElementsByTagName('sz');
                            for (i = 0; i < tagName.length; i++) {
                                tagName[i].setAttribute("val", "13")
                            }
                        }
                    }]
                });
                table.on('search.dt', function () {
                    var searchTerm = table.search();
                    $('#myTableSeguimiento_filter input').val(searchTerm.toUpperCase())
                });
            } else {
                var table = $('#myTableSeguimiento').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                        loadingRecords: `<button class="btn btn-danger " type="button" disabled>
                                                <span class="spinner-border text-white" style="width: 1.5rem; height: 1.5rem;"
                                                    aria-hidden="true"></span>
                                                <span role="status" class="ms-2 text-white fs-4">Cargando...</span>
                                            </button>`
                    },
                    ordering: true,
                    order: [
                        [1, 'asc']
                    ],
                    dom: 'Bfrtip',
                    buttons: []
                });

            }
        });

        function openModalDetalles(estilo) {
            $("#tableAppend").empty();
            $("#tableAppend").append(`<table id="myTableDetalles" class="table stripe"style="width:100%;">
                        <thead>
                            <tr class="sticky-top bg-white" style="font-size: 14px;">
                                <th class="text-black text-center">ESTILO</th>
                                <th class="text-black text-center">COLOR</th>
                                <th class="text-black text-center">TALLA</th>
                                <th class="text-black text-center">UNIDADES VTAS<br>TOTALES</th>
                                <th class="text-black text-center">UNIDADES VTAS <br>MES PROCESO</th>
                                <th class="text-black text-center">UNIDADES VTAS <br>ULT 12 MESES</th>
                                <th class="text-black text-center">PROMEDIO<br>MENSUAL</th>
                                <th class="text-black text-center">EXISTENCIA<br>ACTUAL</th>
                                <th class="text-black text-center">ROT. INV.</th>
                                <th class="text-black text-center">MESES<br>INVENTARIO</th>
                                <th class="text-black text-center">%<br>DESCUENTO</th>
                                <th class="text-black text-center">FECHA INGRESO</th>
                                <th class="text-black text-center">FECHA<br>ULT/COMPRA</th>
                                <th class="text-black text-center">FECHA<br>ULT/VENTA</th>
                                <th class="text-black text-center">DIAS<br>ANTIGUEDAD</th>
                                <th class="text-black text-center">DIAS ANT.<br>ULT/COMPRA</th>
                                <th class="text-black text-center">DIAS ANT.<br>ULT/VENTA</th>
                                <th class="text-black text-center">TIPO<br>INVENTARIO</th>
                                <th class="text-black text-center">MARCA</th>
                                <th class="text-black text-center">GENERO</th>
                                <th class=" d-none text-black text-center">ISTOT</th>
                            </tr>
                        </thead>
                        <tbody id="myTableDetallesBody" style="font-size: 13px;">

                        </tbody>
                    </table>`)

            var agrup = $("#cbbAgrupacion").val();
            var urlDeta = "/API.LOVABLEPHP/ZLO0012P/GetDeta/?agrup=" + agrup + "&estilo=" + estilo + "";
            var responseDeta = ajaxRequest(urlDeta);
            var lastcolor = null;
            var color = ' ';
            var count = 0;
            if (responseDeta.code == 200) {
                var tableDetalles = $('#myTableDetallesBody');
                tableDetalles.empty();
                var options = "";
                for (let i = 0; i < responseDeta.data.length; i++) {
                    color = responseDeta.data[i]['COLOR'];
                    if (lastcolor == null) {
                        lastcolor = color;
                        count++;
                    } else if (lastcolor == color) {
                        if (responseDeta.data[i]['ISTOT'] == 'TOTALC') {
                            responseDeta.data[i]['ROTINV'] = responseDeta.data[i]['ROTINV'] / count;
                        }
                        count++;
                    } else {
                        count = 1;
                        lastcolor = color;
                    }
                    if (responseDeta.data[i]['ISTOT'] == 'TOTAL' || responseDeta.data[i]['ISTOT'] == 'TOTALC') {
                        options += "<tr class='total-row'>";
                    } else {
                        options += "<tr>";
                    }
                    options += "<td class='text-start'>" + responseDeta.data[i]['ESTILO'] + "</td>";
                    options += "<td class='text-start'>" + returnBlank(responseDeta.data[i]['COLOR']) + "</td>";
                    options += "<td class='text-start'>" + returnBlank(responseDeta.data[i]['TALLA']) + "</td>";
                    options += "<td class='text-end'>" + returnBlank(responseDeta.data[i]['UNITOT']) + "</td>";
                    options += "<td class='text-end '>" + returnBlank(responseDeta.data[i]['VTAMES']) + "</td>";
                    options += "<td class='text-end text-cyan'>" + returnBlank(responseDeta.data[i]['UNIVEN']) + "</td>";
                    options += "<td class='text-end  text-cyan'>" + returnBlank(responseDeta.data[i]['PROMEN']) + "</td>";
                    options += "<td class='text-end text-success text-success'>" + returnBlank(responseDeta.data[i][
                        'EXIACT']) + "</td>";
                    options += "<td class='text-end'>" + returnBlank(responseDeta.data[i]['ROTINV']) + "</td>";
                    options += "<td class='text-end text-warning'>" + returnBlank(responseDeta.data[i]['MESINV']) + "</td>";
                    options += "<td class='text-end'>" + returnBlank(responseDeta.data[i]['PORDES']) + "</td>";
                    options += "<td class='text-end'>" + formatFecha(responseDeta.data[i]['FECING']) + "</td>";
                    options += "<td class='text-end'>" + formatFecha(responseDeta.data[i]['FECCOM']) + "</td>";
                    options += "<td class='text-end'>" + formatFecha(responseDeta.data[i]['FECVEN']) + "</td>";
                    options += "<td class='text-end'>" + returnBlank(responseDeta.data[i]['DIAANT']) + "</td>";
                    options += "<td class='text-end'>" + returnBlank(responseDeta.data[i]['DIAANC']) + "</td>";
                    options += "<td class='text-end'>" + returnBlank(responseDeta.data[i]['DIAANV']) + "</td>";
                    switch (responseDeta.data[i]['TIPINV']) {
                        case "L":
                            options += "<td class='text-end text-success'>" + returnBlank(responseDeta.data[i]['TIPINV']) +
                                "</td>";
                            break;
                        case "O":
                            options += "<td class='text-end text-danger'>" + returnBlank(responseDeta.data[i]['TIPINV']) +
                                "</td>";
                            break;
                        case "ND":
                        case "D":
                            options += "<td class='text-end text-warning'>" + returnBlank(responseDeta.data[i]['TIPINV']) +
                                "</td>";
                            break;
                        default:
                            options += "<td class='text-end'>" + returnBlank(responseDeta.data[i]['TIPINV']) + "</td>";
                            break;
                    }

                    options += "<td class='text-start'>" + returnBlank(responseDeta.data[i]['MARCA']) + "</td>";
                    options += "<td class='text-start'>" + returnBlank(responseDeta.data[i]['GENERO']) + "</td>";
                    options += "<td class=' d-none text-start'>" + returnBlank(responseDeta.data[i]['ISTOT']) + "</td>";
                    options += "</tr>";
                }
                tableDetalles.append(options);
                $("#myTableDetalles").DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                    },
                    "ordering": false,
                    "responsive": true,
                    "pageLength": 100,
                    fixedColumns: {
                        left: 1,
                    },
                    dom: 'Bfrtip',
                    buttons: [{
                        extend: 'excelHtml5',
                        text: '<i class="fa-solid fa-file-excel"></i> <b >Enviar a Excel</b>',
                        className: "btn btn-success text-light mt-2 fs-6 ",
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19,
                                20
                            ],
                        },
                        title: 'Analisis-MovimientoEstilos-' + estilo + '',
                        customize: function (xlsx) {
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
                            var f3 = '<font>' +
                                '<sz val="11" />' +
                                '<name val="Calibri" />' +
                                '<color rgb="00BBCD" />' + // color cyan de la fuente
                                '</font>';
                            var f4 = '<font>' +
                                '<sz val="11" />' +
                                '<name val="Calibri" />' +
                                '<color rgb="7E5006" />' + // color cyan de la fuente
                                '</font>';
                            var f5 = '<font>' +
                                '<sz val="11" />' +
                                '<name val="Calibri" />' +
                                '<color rgb="2A81F1" />' + // color azul oscuro de la fuente
                                '</font>';
                            var f6 = '<font>' +
                                '<sz val="11" />' +
                                '<name val="Calibri" />' +
                                '<color rgb="0F8900" />' + // color verde oscuro de la fuente
                                '</font>';
                            var f7 = '<font>' +
                                '<sz val="11" />' +
                                '<name val="Calibri" />' +
                                '<color rgb="C1C100" />' + // color amarillo de la fuente
                                '</font>';
                            var f8 = '<font>' +
                                '<sz val="11" />' +
                                '<name val="Calibri" />' +
                                '<color rgb="FFB202" />' + // color naranja de la fuente
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
                            var s9 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 3) +
                                '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s10 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 4) +
                                '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s11 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 5) +
                                '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s12 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 6) +
                                '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s13 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 7) +
                                '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s14 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 8) +
                                '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            sSh.childNodes[0].childNodes[0].innerHTML += n1 + n2;
                            sSh.childNodes[0].childNodes[1].innerHTML += f1 + f2 + f3 + f4 + f5 +
                                f6 + f7 + f8;
                            sSh.childNodes[0].childNodes[5].innerHTML += s1 + s2 + s3 + s4 + s5 +
                                s6 + s7 + s8 + s9 + s10 + s11 + s12 + s13 + s14;
                            var fourDecPlaces = lastXfIndex + 1;
                            var greyBoldCentered = lastXfIndex + 2;
                            var twoDecPlacesBold = lastXfIndex + 3;
                            var greyBoldWrapText = lastXfIndex + 4;
                            var textred1 = lastXfIndex + 5;
                            var textgreen1 = lastXfIndex + 6;
                            var textred2 = lastXfIndex + 7;
                            var textgreen2 = lastXfIndex + 8;
                            var textCyan = lastXfIndex + 9;
                            var textBrown = lastXfIndex + 10;
                            var textDarkblue = lastXfIndex + 11;
                            var textDarkGreen = lastXfIndex + 12;
                            var textYellow = lastXfIndex + 13;
                            var textNaranja = lastXfIndex + 14;
                            $('c[r=A1] t', sheet).text('REPORTE DE ANALISIS DE MOVIMIENTO DE ESTILOS (UNIDADES) ' +
                                estilo.toString().toUpperCase());
                            $('row:eq(0) c', sheet).attr('s', greyBoldCentered);
                            $('row:eq(1) c', sheet).attr('s', 7);
                            $('row', sheet).each(function () {
                                var row = $(this);
                                if (row.index() < 2) {
                                    return;
                                }
                                $('c[r^="F"], c[r^="G"]', row).attr('s', textCyan);
                                $('c[r^="H"]', row).attr('s', textgreen1);
                                $('c[r^="J"]', row).attr('s', textYellow);
                                var cellE = $('c[r^="R"]', row);
                                switch (cellE.text()) {
                                    case "L":
                                        $('c[r^="R"]', row).attr('s', textgreen1);
                                        break;
                                    case "O":
                                        $('c[r^="R"]', row).attr('s', textred1);
                                        break;
                                    case "ND":
                                    case "D":
                                        $('c[r^="R"]', row).attr('s', textYellow);
                                        break;
                                    default:
                                        $('c[r^="R"]', row).attr('s', 52);
                                        break;
                                }
                            });
                            $('c[r=U3] t', sheet).text(' ');
                            $('row c[r*="U"]', sheet).each(function () {
                                if ($('is t', this).text() === 'TOTALC' || $('is t', this)
                                    .text() === 'TOTAL') {
                                    var rowIndex = $(this).parent().index();
                                    $('row:eq(' + rowIndex + ') c', sheet).attr('s', '7');
                                    $('is t', this).text(' ');
                                }
                            });
                            var tagName = sSh.getElementsByTagName('sz');
                            for (i = 0; i < tagName.length; i++) {
                                tagName[i].setAttribute("val", "13")
                            }
                        }
                    }],

                });
                $('#detallesModal').modal('show');
            }
        }

        function returnBlank(value) {
            if (value == " " || value == null) {
                return "&nbsp;";
            } else {
                return value.toLocaleString('es-419', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }
        }

        function formatFecha(fechaOriginal) {
            if (fechaOriginal == " " || fechaOriginal == 0) {
                return "&nbsp;";
            } else {
                const year = fechaOriginal.slice(0, 4);
                const month = fechaOriginal.slice(4, 6);
                const day = fechaOriginal.slice(6, 8);
                const fechaConvertida = `${day}/${month}/${year}`;
                return fechaConvertida;
            }
        }
        function cantidadesByStyle(button, vend, total, lbl) {
            document.getElementById("lblModo").textContent = lbl;
            const row = button.closest("tr");
            const cells = row.querySelectorAll("td");
            const Marca = cells[0].textContent.trim();
            const Estilo = cells[1].textContent.trim();
            const Color = cells[2].textContent.trim();
            const Talla = cells[3].textContent.trim();
            const sendData = {
                marca: Marca,
                estilo: Estilo,
                color: Color,
                talla: Talla,
                vend: vend,
            };
            fetch("/API.LovablePHP/ZLO0013P/CantidadApar", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(sendData),
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then((data) => {
                    document.getElementById("spnMarca").textContent = Marca;
                    document.getElementById("spnEstilo").textContent = Estilo;
                    document.getElementById("spnColor").textContent = Color;
                    document.getElementById("spnTalla").textContent = Talla;
                    const tableCantidadesBody = document.getElementById(
                        "tableCantidadesBody"
                    );
                    tableCantidadesBody.innerHTML = "";
                    if (data.code == 200) {
                        let hoy = new Date();
                        const fec = `${hoy.getFullYear()}${String(hoy.getMonth() + 1).padStart(
                            2,
                            "0"
                        )}${String(hoy.getDate()).padStart(2, "0")}`;
                        data.data.forEach((apartado) => {
                            const dias = diasTranscurridos(apartado.FECTRA, fec);
                            tableCantidadesBody.innerHTML += `<tr>
                                            <td class="text-center fw-light">${apartado.NUMPED
                                }</td>
                                            <td class="text-end fw-light">${parseFloat(
                                    apartado.CANAPA
                                ).toFixed(2)}</td>
                                            <td class="text-start fw-light">${apartado.CODVEN
                                } ${apartado.MAENO3}</td>
                                            <td class="text-start fw-light">${apartado.CODCL1
                                } ${apartado.CODCL2} ${apartado.MAENO4
                                }</td>
                                            <td class="text-start fw-light">${formatFecha(
                                    apartado.FECTRA
                                )}</td>
                                            <td class="text-end fw-light">${dias}</td>
                                            <td class="text-end fw-light">${apartado.TIPMON
                                }</td>
                                            <td class="text-end fw-light">${parseFloat(
                                    apartado.VALNET
                                ).toLocaleString("en-US", {
                                    minimumFractionDigits: 2,
                                })}</td>
                                            
                                          </tr>`;
                        });
                        tableCantidadesBody.innerHTML += `<tr class="bg-light">
                                          <td class="text-center">TOTAL: </td>
                                          <td class="text-end">${parseFloat(
                            total
                        ).toFixed(2)}</td>
                                          <td colspan="6"></td>             
                                        </tr>`;
                    } else {
                        tableCantidadesBody.innerHTML = `<tr>
                                          <td colspan="8" class="text-center">
                                              No se encontraron apartados para este estilo
                                          </td>  
                                        </tr>`;
                    }
                })
                .then(() => {
                    $("#cantidadesModal").modal("show");
                })
                .catch((error) => {
                    console.error("Error en la petición:", error);
                });
        }
    </script>

    <div class="modal fade" id="detallesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-end">
                    <div class="">
                        <button type="button" class="btn btn-dark text-white fw-bold"
                            onclick="$('#detallesModal').modal('hide')">Regresar</button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            <h5 class="text-center breakMargin">Estilo, color y talla</h5>
                            <div class="overflow-auto mt-3  rounded" style="width:100%; height:600px;">
                                <div id="tableAppend">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="cantidadesModal" tabindex="-1" aria-labelledby="cantidadesModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" style="max-width: 3000px !important;">
            <div class="modal-content" style="width:100%px;">
                <div class="modal-header">
                    <div class="row w-100">
                        <div class="col-12">
                            <h1 class="modal-title fs-4 fw-bold text-center" id="cantidadesModalLabel">Detalle de
                                cantidades apartadas para <span id="lblModo"></span> </h1>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 py-2">
                                    <th class="text-start">Marca: </th>
                                    <th class="text-start"><span id="spnMarca"></span></th>
                                    <th class="text-start">Estilo: </th>
                                    <th class="text-start"><span id="spnEstilo"></span></th>
                                </div>
                                <div class="col-12 py-2">
                                    <th class="text-start">Color: </th>
                                    <th class="text-start"><span id="spnColor"></span></th>
                                    <th class="text-start">Talla: </th>
                                    <th class="text-start"><span id="spnTalla"></span></th>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12 fw-bold text-center py-3 table-responsive">
                        <table class="table table-hover border fs-6">
                            <thead>
                                <tr>
                                    <th style="width:6.5%;" class="text-center">Num. Preventa</th>
                                    <th style="width:6.5%;" class="text-end">Docenas apartadas</th>
                                    <th style="width:24.5%;" class="text-start">Vendedor</th>
                                    <th style="width:24.5%;" class="text-start">Cliente</th>
                                    <th style="width:8.5%;" class="text-start">Fecha Preventa</th>
                                    <th style="width:8.5%;" class="text-end">Días transcurridos</th>
                                    <th style="width:3.5%;" class="text-end">Moneda</th>
                                    <th style="width:9.5%;" class="text-end">Valor neto</th>

                                </tr>
                            </thead>
                            <tbody id="tableCantidadesBody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>