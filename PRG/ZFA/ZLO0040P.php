<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
</head>

<body>
    <?php
    include '../layout-prg.php';
    ?>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <span>Módulo de facturación / Consultas </span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0040P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-3">
        <div class="card mb-5">
            <div class="card-header">
                <h1 class="fs-4 mb-1 mt-2 text-center">Comp. Ventas por genero en unidades</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="position-relative">
                            <form>
                                <div class="row mb-2">
                                    <div class="col-0 col-lg-3">

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
                                    <div class="col-12 col-lg-3">
                                        <label class="mt-2">Mes:</label>
                                        <select class="form-select  mt-1" id="cbbMes" name="cbbMes">
                                            <option value="1">Enero</option>
                                            <option value="2">Febrero</option>
                                            <option value="3">Marzo</option>
                                            <option value="4">Abril</option>
                                            <option value="5">Mayo</option>
                                            <option value="6">Junio</option>
                                            <option value="7">Julio</option>
                                            <option value="8">Agosto</option>
                                            <option value="9">Septiembre</option>
                                            <option value="10">Octubre</option>
                                            <option value="11">Noviembre</option>
                                            <option value="12">Diciembre</option>
                                        </select>
                                    </div>
                                    <div class="col-0 col-lg-3">

                                    </div>
                                    <div class="col-0 col-lg-3">

                                    </div>
                                    <div class="col-12 col-lg-6 py-2">
                                        <label class="mt-2">Punto de venta:</label>
                                        <select class="form-select  mt-1" id="cbbAgrup" name="cbbAgrup">

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
                    <div class="col-12">
                        <div class="demo">
                            <div class="text-center">
                                <ul class="tablist" role="tablist">
                                    <li id="tab1" class="tablist__tab text-center p-3  is-active" aria-controls="panel1"
                                        aria-selected="true" role="tab" tabindex="0">Mes anterior</li>
                                    <li id="tab2" class="tablist__tab text-center p-3" aria-controls="panel2"
                                        aria-selected="false" role="tab" tabindex="0">Mismo mes del año anterior</li>
                                    <li id="tab3" class="tablist__tab text-center p-3" aria-controls="panel3"
                                        aria-selected="false" role="tab" tabindex="0">Año actual vs Año anterior</li>
                                </ul>
                            </div>
                            <div id="panel1" class="tablist__panel" aria-labelledby="tab1" aria-hidden="false"
                                role="tabpanel">
                                <div class="card p-3">
                                    <figure class="highcharts-figure">
                                        <div id="container1">
                                        </div>
                                    </figure>
                                    <div class="table-responsive">
                                        <table id="table-data1" class="table stripe table-hover" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Punto de venta</th>
                                                    <th scope="col" class="text-end">Mes actual</th>
                                                    <th scope="col" class="text-end">Mes anterior</th>
                                                    <th scope="col" class="text-end">Diferencia</th>
                                                    <th scope="col" class="text-end">Crecimiento</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr class="bg-secondary text-white">
                                                    <th>TOTALES</th>
                                                    <th class="text-end"></th>
                                                    <th class="text-end"></th>
                                                    <th class="text-end"></th>
                                                    <th class="text-end"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="panel2" class="tablist__panel is-hidden" aria-labelledby="tab2" aria-hidden="true"
                                role="tabpanel">
                                <div class="card p-3">
                                    <figure class="highcharts-figure">
                                        <div id="container2">
                                        </div>
                                    </figure>
                                    <div class="table-responsive">
                                        <table id="table-data2" class="table stripe table-hover" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Punto de venta</th>
                                                    <th scope="col" class="text-end">Mes actual</th>
                                                    <th scope="col" class="text-end">Mes anterior</th>
                                                    <th scope="col" class="text-end">Diferencia</th>
                                                    <th scope="col" class="text-end">Crecimiento</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr class="bg-secondary text-white">
                                                    <th>TOTALES</th>
                                                    <th class="text-end"></th>
                                                    <th class="text-end"></th>
                                                    <th class="text-end"></th>
                                                    <th class="text-end"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="panel3" class="tablist__panel is-hidden" aria-labelledby="tab3" aria-hidden="true"
                                role="tabpanel">
                                <div class="card p-3">
                                    <figure class="highcharts-figure">
                                        <div id="container3">
                                        </div>
                                    </figure>
                                    <div class="table-responsive">
                                        <table id="table-data3" class="table stripe table-hover" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Punto de venta</th>
                                                    <th scope="col" class="text-end">Mes actual</th>
                                                    <th scope="col" class="text-end">Mes anterior</th>
                                                    <th scope="col" class="text-end">Diferencia</th>
                                                    <th scope="col" class="text-end">Crecimiento</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr class="bg-secondary text-white">
                                                    <th>TOTALES</th>
                                                    <th class="text-end"></th>
                                                    <th class="text-end"></th>
                                                    <th class="text-end"></th>
                                                    <th class="text-end"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/offline-exporting.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", (event) => {
            const currentMonth = new Date().getMonth() + 1;
            const cbbMes = document.getElementById('cbbMes');
            cbbMes.value = currentMonth;
            const cbbAgrup = document.getElementById('cbbAgrup');
            let usuario = '<?php echo $_SESSION["CODUSU"]; ?>';
            let urlTiendas = '/API.LovablePHP/Users/FindAgrupT/?codusu=' + usuario + '';
            let responseTiendas = ajaxRequest(urlTiendas);
            let tiendasOptions = '';
            if (responseTiendas.code == 200) {
                tiendasOptions += '<option value="0">Todos los puntos de venta</option>';
                for (let i = 0; i < responseTiendas.data.length; i++) {
                    if (responseTiendas.data[i].COMCOD != 1 && responseTiendas.data[i].COMCOD != 35) {
                        tiendasOptions += '<option value="' + responseTiendas.data[i].COMCOD.padStart(2, '0') +
                            '">' +
                            responseTiendas.data[
                                i].COMDES + '</option>';
                    }
                }
            }
            cbbAgrup.innerHTML = tiendasOptions;


            const table1 = $("#table-data1").DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                },
                ordering: false,
                processing: true,
                pageLength: 100,
                data: [],
                columns: [
                    { data: "GENERO", title: "Genero" },
                    { data: "MES1", title: "Mes actual", class: "text-end" },
                    { data: "MES2", title: "Mes anterior", class: "text-end" },
                    {
                        data: "VARIA", title: "Diferencia", class: "text-end",
                        render: function (data, type, row) {
                            const span = document.createElement("span");
                            span.textContent = data;
                            span.classList.add("text-end");
                            span.classList.add("fw-bold");
                            if (data < 0) {
                                span.classList.add("text-danger");
                            } else if (data > 0) {
                                span.classList.add("text-success");
                            }
                            return span.outerHTML;
                        }
                    },
                    {
                        data: null,
                        title: "% Crecimiento",
                        class: "text-end",
                        render: function (data, type, row) {
                            const growth = row.MES2 != 0 ? ((row.MES1 / row.MES2) - 1) * 100 : 0;
                            const span = document.createElement("span");
                            span.textContent = (growth).toFixed(2);
                            span.classList.add("text-end");
                            span.classList.add("fw-bold");
                            if (growth < 0) {
                                span.classList.add("text-danger");
                            } else if (growth > 0) {
                                span.classList.add("text-success");
                            }
                            return span.outerHTML;
                        }
                    },
                ],
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fa-solid fa-file-excel"></i> <b>Enviar a Excel</b>',
                    className: "btn btn-success text-light mt-2 fs-6",
                    title: 'ReporteVentasUnidades - Mes anterior',
                    messageTop: ' ',
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

                        var n1 = '<numFmt formatCode="##0%" numFmtId="300"/>';
                        var n2 = '<numFmt formatCode="#,##0.00" numFmtId="200" />';
                        var s1 =
                            '<xf numFmtId="300" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>';
                        var s2 =
                            '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="center"/></xf>';
                        var s3 =
                            '<xf numFmtId="4" fontId="2" fillId="0" borderId="0" applyFont="1" applyFill="1" xfId="0" applyNumberFormat="1"/>'
                        var s4 =
                            '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="center" wrapText="1"/></xf>'
                        var s5 = '<xf numFmtId="200" fontId="' + (lastFontIndex + 1) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s6 = '<xf numFmtId="200" fontId="' + (lastFontIndex + 2) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s7 = '<xf numFmtId="300" fontId="' + (lastFontIndex + 1) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s8 = '<xf numFmtId="300" fontId="' + (lastFontIndex + 2) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        sSh.childNodes[0].childNodes[0].innerHTML += n1 + n2;
                        sSh.childNodes[0].childNodes[1].innerHTML += f1 + f2;
                        sSh.childNodes[0].childNodes[5].innerHTML += s1 + s2 + s3 + s4 + s5 + s6 + s7 + s8;

                        var fourDecPlaces = lastXfIndex + 1;
                        var greyBoldCentered = lastXfIndex + 2;
                        var twoDecPlacesBold = lastXfIndex + 3;
                        var greyBoldWrapText = lastXfIndex + 4;
                        var textred1 = lastXfIndex + 5;
                        var textgreen1 = lastXfIndex + 6;
                        var textred2 = lastXfIndex + 7;
                        var textgreen2 = lastXfIndex + 8;


                        $('c[r=A1] t', sheet).text(`REPORTE DE VENTAS EN UNIDADES POR GENERO - MES ANTERIOR`);
                        $('c[r=A2] t', sheet).text($("#cbbAgrup option:selected").text().toUpperCase());
                        $('row:eq(0) c', sheet).attr('s', greyBoldCentered);
                        $('row:eq(1) c', sheet).attr('s', 7);

                        for (let index = 3; index <= 100; index++) {
                            if (parseFloat($('row:eq(' + index + ') c[r^="D"]', sheet).text()) < 0) {
                                $('row:eq(' + index + ') c[r^="D"]', sheet).attr('s', textred1); //ROJO
                            } else {
                                $('row:eq(' + index + ') c[r^="D"]', sheet).attr('s', textgreen1); //VERDE
                            }
                            if (parseFloat($('row:eq(' + index + ') c[r^="E"]', sheet).text()) < 0) {
                                $('row:eq(' + index + ') c[r^="E"]', sheet).attr('s', textred1); //ROJO
                            } else {
                                $('row:eq(' + index + ') c[r^="E"]', sheet).attr('s', textgreen1); //VERDE
                            }
                        }

                        for (let index = 2; index <= 100; index++) {
                            $('row:eq(' + index + ') c[r^="A"]', sheet).attr('s', 7);
                        }

                        var tagName = sSh.getElementsByTagName('sz');
                        for (i = 0; i < tagName.length; i++) {
                            tagName[i].setAttribute("val", "13");
                        }
                    }

                }],
                footerCallback: function (row, data, start, end, display) {
                    const api = this.api();
                    const getColumnTotal = (index) => {
                        return api
                            .column(index, { page: "current" })
                            .data()
                            .reduce((a, b) => a + parseFloat(b || 0), 0);
                    };
                    const totalMesActual = getColumnTotal(1);
                    const totalMesAnterior = getColumnTotal(2);
                    const totalDiferencia = getColumnTotal(3);
                    const totalGrowth = totalMesAnterior != 0 ? ((totalMesActual / totalMesAnterior) - 1) * 100 : 0;
                    $(api.column(1).footer()).html(totalMesActual.toLocaleString('en-EN'));
                    $(api.column(2).footer()).html(totalMesAnterior.toLocaleString('en-EN'));
                    $(api.column(3).footer()).html(totalDiferencia.toLocaleString('en-EN'));
                    $(api.column(4).footer()).html((totalGrowth).toFixed(2));
                    if (totalDiferencia < 0) {
                        $(api.column(3).footer()).addClass("text-danger");
                    } else if (totalDiferencia > 0) {
                        $(api.column(3).footer()).addClass("text-success");
                    }
                    if (totalGrowth < 0) {
                        $(api.column(4).footer()).addClass("text-danger");
                    } else if (totalGrowth > 0) {
                        $(api.column(4).footer()).addClass("text-success");
                    };
                }
            });
            const table2 = $("#table-data2").DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                },
                ordering: false,
                processing: true,
                pageLength: 100,
                data: [],
                columns: [
                    { data: "GENERO", title: "Genero" },
                    { data: "MES1", title: "Mes actual", class: "text-end" },
                    { data: "MES2", title: "Mes anterior", class: "text-end" },
                    {
                        data: "VARIA", title: "Diferencia", class: "text-end",
                        render: function (data, type, row) {
                            const span = document.createElement("span");
                            span.textContent = data;
                            span.classList.add("text-end");
                            span.classList.add("fw-bold");
                            if (data < 0) {
                                span.classList.add("text-danger");
                            } else if (data > 0) {
                                span.classList.add("text-success");
                            }
                            return span.outerHTML;
                        }
                    },
                    {
                        data: null,
                        title: "% Crecimiento",
                        class: "text-end",
                        render: function (data, type, row) {
                            const growth = row.MES2 != 0 ? ((row.MES1 / row.MES2) - 1) * 100 : 0;
                            const span = document.createElement("span");
                            span.textContent = (growth).toFixed(2);
                            span.classList.add("text-end");
                            span.classList.add("fw-bold");
                            if (growth < 0) {
                                span.classList.add("text-danger");
                            } else if (growth > 0) {
                                span.classList.add("text-success");
                            }
                            return span.outerHTML;
                        }
                    },
                ],
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fa-solid fa-file-excel"></i> <b>Enviar a Excel</b>',
                    className: "btn btn-success text-light mt-2 fs-6",
                    title: 'ReporteVentasUnidades - Mismo mes del año anterior',
                    messageTop: ' ',
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

                        var n1 = '<numFmt formatCode="##0%" numFmtId="300"/>';
                        var n2 = '<numFmt formatCode="#,##0.00" numFmtId="200" />';
                        var s1 =
                            '<xf numFmtId="300" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>';
                        var s2 =
                            '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="center"/></xf>';
                        var s3 =
                            '<xf numFmtId="4" fontId="2" fillId="0" borderId="0" applyFont="1" applyFill="1" xfId="0" applyNumberFormat="1"/>'
                        var s4 =
                            '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="center" wrapText="1"/></xf>'
                        var s5 = '<xf numFmtId="200" fontId="' + (lastFontIndex + 1) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s6 = '<xf numFmtId="200" fontId="' + (lastFontIndex + 2) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s7 = '<xf numFmtId="300" fontId="' + (lastFontIndex + 1) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s8 = '<xf numFmtId="300" fontId="' + (lastFontIndex + 2) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        sSh.childNodes[0].childNodes[0].innerHTML += n1 + n2;
                        sSh.childNodes[0].childNodes[1].innerHTML += f1 + f2;
                        sSh.childNodes[0].childNodes[5].innerHTML += s1 + s2 + s3 + s4 + s5 + s6 + s7 + s8;

                        var fourDecPlaces = lastXfIndex + 1;
                        var greyBoldCentered = lastXfIndex + 2;
                        var twoDecPlacesBold = lastXfIndex + 3;
                        var greyBoldWrapText = lastXfIndex + 4;
                        var textred1 = lastXfIndex + 5;
                        var textgreen1 = lastXfIndex + 6;
                        var textred2 = lastXfIndex + 7;
                        var textgreen2 = lastXfIndex + 8;


                        $('c[r=A1] t', sheet).text(`REPORTE DE VENTAS EN UNIDADES POR GENERO - MISMO MES DEL AÑO ANTERIOR`);
                        $('c[r=A2] t', sheet).text($("#cbbAgrup option:selected").text().toUpperCase());
                        $('row:eq(0) c', sheet).attr('s', greyBoldCentered);
                        $('row:eq(1) c', sheet).attr('s', 7);

                        for (let index = 3; index <= 100; index++) {
                            if (parseFloat($('row:eq(' + index + ') c[r^="D"]', sheet).text()) < 0) {
                                $('row:eq(' + index + ') c[r^="D"]', sheet).attr('s', textred1); //ROJO
                            } else {
                                $('row:eq(' + index + ') c[r^="D"]', sheet).attr('s', textgreen1); //VERDE
                            }
                            if (parseFloat($('row:eq(' + index + ') c[r^="E"]', sheet).text()) < 0) {
                                $('row:eq(' + index + ') c[r^="E"]', sheet).attr('s', textred1); //ROJO
                            } else {
                                $('row:eq(' + index + ') c[r^="E"]', sheet).attr('s', textgreen1); //VERDE
                            }
                        }

                        for (let index = 2; index <= 100; index++) {
                            $('row:eq(' + index + ') c[r^="A"]', sheet).attr('s', 7);
                        }

                        var tagName = sSh.getElementsByTagName('sz');
                        for (i = 0; i < tagName.length; i++) {
                            tagName[i].setAttribute("val", "13");
                        }
                    }

                }],
                footerCallback: function (row, data, start, end, display) {
                    const api = this.api();
                    const getColumnTotal = (index) => {
                        return api
                            .column(index, { page: "current" })
                            .data()
                            .reduce((a, b) => a + parseFloat(b || 0), 0);
                    };
                    const totalMesActual = getColumnTotal(1);
                    const totalMesAnterior = getColumnTotal(2);
                    const totalDiferencia = getColumnTotal(3);
                    const totalGrowth = totalMesAnterior != 0 ? ((totalMesActual / totalMesAnterior) - 1) * 100 : 0;
                    $(api.column(1).footer()).html(totalMesActual.toLocaleString('en-EN'));
                    $(api.column(2).footer()).html(totalMesAnterior.toLocaleString('en-EN'));
                    $(api.column(3).footer()).html(totalDiferencia.toLocaleString('en-EN'));
                    $(api.column(4).footer()).html((totalGrowth).toFixed(2));
                    if (totalDiferencia < 0) {
                        $(api.column(3).footer()).addClass("text-danger");
                    } else if (totalDiferencia > 0) {
                        $(api.column(3).footer()).addClass("text-success");
                    }
                    if (totalGrowth < 0) {
                        $(api.column(4).footer()).addClass("text-danger");
                    } else if (totalGrowth > 0) {
                        $(api.column(4).footer()).addClass("text-success");
                    };
                }
            });
            const table3 = $("#table-data3").DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                },
                ordering: false,
                processing: true,
                pageLength: 100,
                data: [],
                columns: [
                    { data: "GENERO", title: "Genero" },
                    { data: "MES1", title: "Mes actual", class: "text-end" },
                    { data: "MES2", title: "Mes anterior", class: "text-end" },
                    {
                        data: "VARIA", title: "Diferencia", class: "text-end",
                        render: function (data, type, row) {
                            const span = document.createElement("span");
                            span.textContent = data;
                            span.classList.add("text-end");
                            span.classList.add("fw-bold");
                            if (data < 0) {
                                span.classList.add("text-danger");
                            } else if (data > 0) {
                                span.classList.add("text-success");
                            }
                            return span.outerHTML;
                        }
                    },
                    {
                        data: null,
                        title: "% Crecimiento",
                        class: "text-end",
                        render: function (data, type, row) {
                            const growth = row.MES2 != 0 ? ((row.MES1 / row.MES2) - 1) * 100 : 0;
                            const span = document.createElement("span");
                            span.textContent = (growth).toFixed(2);
                            span.classList.add("text-end");
                            span.classList.add("fw-bold");
                            if (growth < 0) {
                                span.classList.add("text-danger");
                            } else if (growth > 0) {
                                span.classList.add("text-success");
                            }
                            return span.outerHTML;
                        }
                    },
                ],
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fa-solid fa-file-excel"></i> <b>Enviar a Excel</b>',
                    className: "btn btn-success text-light mt-2 fs-6",
                    title: 'ReporteVentasUnidades - Año actual vs Año anterior',
                    messageTop: ' ',
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

                        var n1 = '<numFmt formatCode="##0%" numFmtId="300"/>';
                        var n2 = '<numFmt formatCode="#,##0.00" numFmtId="200" />';
                        var s1 =
                            '<xf numFmtId="300" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>';
                        var s2 =
                            '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="center"/></xf>';
                        var s3 =
                            '<xf numFmtId="4" fontId="2" fillId="0" borderId="0" applyFont="1" applyFill="1" xfId="0" applyNumberFormat="1"/>'
                        var s4 =
                            '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="center" wrapText="1"/></xf>'
                        var s5 = '<xf numFmtId="200" fontId="' + (lastFontIndex + 1) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s6 = '<xf numFmtId="200" fontId="' + (lastFontIndex + 2) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s7 = '<xf numFmtId="300" fontId="' + (lastFontIndex + 1) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s8 = '<xf numFmtId="300" fontId="' + (lastFontIndex + 2) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        sSh.childNodes[0].childNodes[0].innerHTML += n1 + n2;
                        sSh.childNodes[0].childNodes[1].innerHTML += f1 + f2;
                        sSh.childNodes[0].childNodes[5].innerHTML += s1 + s2 + s3 + s4 + s5 + s6 + s7 + s8;

                        var fourDecPlaces = lastXfIndex + 1;
                        var greyBoldCentered = lastXfIndex + 2;
                        var twoDecPlacesBold = lastXfIndex + 3;
                        var greyBoldWrapText = lastXfIndex + 4;
                        var textred1 = lastXfIndex + 5;
                        var textgreen1 = lastXfIndex + 6;
                        var textred2 = lastXfIndex + 7;
                        var textgreen2 = lastXfIndex + 8;


                        $('c[r=A1] t', sheet).text(`REPORTE DE VENTAS EN UNIDADES POR GENERO - AÑO ACTUAL VS AÑO ANTERIOR `);
                        $('c[r=A2] t', sheet).text($("#cbbAgrup option:selected").text().toUpperCase());
                        $('row:eq(0) c', sheet).attr('s', greyBoldCentered);
                        $('row:eq(1) c', sheet).attr('s', 7);
                        $()

                        for (let index = 3; index <= 100; index++) {
                            if (parseFloat($('row:eq(' + index + ') c[r^="D"]', sheet).text()) < 0) {
                                $('row:eq(' + index + ') c[r^="D"]', sheet).attr('s', textred1); //ROJO
                            } else {
                                $('row:eq(' + index + ') c[r^="D"]', sheet).attr('s', textgreen1); //VERDE
                            }
                            if (parseFloat($('row:eq(' + index + ') c[r^="E"]', sheet).text()) < 0) {
                                $('row:eq(' + index + ') c[r^="E"]', sheet).attr('s', textred1); //ROJO
                            } else {
                                $('row:eq(' + index + ') c[r^="E"]', sheet).attr('s', textgreen1); //VERDE
                            }
                        }

                        for (let index = 2; index <= 100; index++) {
                            $('row:eq(' + index + ') c[r^="A"]', sheet).attr('s', 7);
                        }

                        var tagName = sSh.getElementsByTagName('sz');
                        for (i = 0; i < tagName.length; i++) {
                            tagName[i].setAttribute("val", "13");
                        }
                    }

                }],
                footerCallback: function (row, data, start, end, display) {
                    const api = this.api();
                    const getColumnTotal = (index) => {
                        return api
                            .column(index, { page: "current" })
                            .data()
                            .reduce((a, b) => a + parseFloat(b || 0), 0);
                    };
                    const totalMesActual = getColumnTotal(1);
                    const totalMesAnterior = getColumnTotal(2);
                    const totalDiferencia = getColumnTotal(3);
                    const totalGrowth = totalMesAnterior != 0 ? ((totalMesActual / totalMesAnterior) - 1) * 100 : 0;
                    $(api.column(1).footer()).html(totalMesActual.toLocaleString('en-EN'));
                    $(api.column(2).footer()).html(totalMesAnterior.toLocaleString('en-EN'));
                    $(api.column(3).footer()).html(totalDiferencia.toLocaleString('en-EN'));
                    $(api.column(4).footer()).html((totalGrowth).toFixed(2));
                    if (totalDiferencia < 0) {
                        $(api.column(3).footer()).addClass("text-danger");
                    } else if (totalDiferencia > 0) {
                        $(api.column(3).footer()).addClass("text-success");
                    }
                    if (totalGrowth < 0) {
                        $(api.column(4).footer()).addClass("text-danger");
                    } else if (totalGrowth > 0) {
                        $(api.column(4).footer()).addClass("text-success");
                    };
                }
            });
            chargeTab1(table1)
            chargeTab2(table2);
            chargeTab3(table3);
            $("#cbbAno, #cbbMes, #cbbAgrup").on("change", function () {
                chargeTab1(table1);
                chargeTab2(table2);
                chargeTab3(table3);
            });
        });
        function chargeTab1(table) {
            const sendData = {
                "usuario": "<?php echo $_SESSION['CODUSU']; ?>",
                "anoFiltro": $("#cbbAno").val(),
                "mesFiltro": $("#cbbMes").val(),
                "codigo": $("#cbbAgrup").val(),
            }
            const currentMonth = sendData.mesFiltro;
            const currentYear = sendData.anoFiltro;
            let yearUtil = currentYear;
            let monthBefore = currentMonth - 1;
            if (monthBefore == 0) {
                monthBefore = 12;
                yearUtil = currentYear - 1;
            }
            fetch("http://172.16.15.20/API.LovablePHP/ZLO0040P/List1/", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(sendData),
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.code == 200) {
                        table.clear();
                        table.column(1).header().innerHTML = `${getMonthName(currentMonth)} ${currentYear}`;
                        table.column(2).header().innerHTML = `${getMonthName(monthBefore)} ${yearUtil}`;
                        table.rows.add(data.data);
                        table.draw();
                        const categories = data.data.map((item) => item.GENERO);
                        const series = [{
                            name: `${getMonthName(currentMonth)} ${currentYear}`,
                            data: data.data.map((item) => parseInt(item.MES1)),
                        }, {
                            name: `${getMonthName(monthBefore)} ${yearUtil}`,
                            data: data.data.map((item) => parseInt(item.MES2)),
                        }];
                        Highcharts.chart('container1', {
                            chart: {
                                type: 'column',
                                height: 500,
                            },
                            lang: {
                                viewFullscreen: "Ver en pantalla completa",
                                exitFullscreen: "Salir de pantalla completa",
                                downloadJPEG: "Descargar imagen JPEG",
                                downloadPDF: "Descargar en PDF"
                            },
                            title: {
                                text: "Comparativo con mes anterior",
                                align: 'center',
                            },
                            xAxis: {
                                categories: categories,
                                crosshair: true,
                                accessibility: {
                                    description: 'Sin categorías'
                                }
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: ''
                                }
                            },
                            tooltip: {
                                valueSuffix: ''
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
                            series: series,
                            exporting: {
                                buttons: {
                                    contextButton: {
                                        menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
                                    }
                                },
                                enabled: true,
                                sourceWidth: 1600,
                                sourceHeight: 700,
                                fallbackToExportServer: false
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error("Error en la solicitud:", error);
                });
        }
        function chargeTab2(table) {
            const sendData = {
                "usuario": "<?php echo $_SESSION['CODUSU']; ?>",
                "anoFiltro": $("#cbbAno").val(),
                "mesFiltro": $("#cbbMes").val(),
                "codigo": $("#cbbAgrup").val(),
            }
            const currentMonth = sendData.mesFiltro;
            const currentYear = sendData.anoFiltro;
            const yearBefore = currentYear - 1;

            fetch("http://172.16.15.20/API.LovablePHP/ZLO0040P/List2/", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(sendData),
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.code == 200) {
                        table.clear();
                        table.column(1).header().innerHTML = `${getMonthName(currentMonth)} ${currentYear}`;
                        table.column(2).header().innerHTML = `${getMonthName(currentMonth)} ${yearBefore}`;
                        table.rows.add(data.data);
                        table.draw();
                        const categories = data.data.map((item) => item.GENERO);
                        const series = [{
                            name: `${getMonthName(currentMonth)} ${currentYear}`,
                            data: data.data.map((item) => parseInt(item.MES1)),
                        }, {
                            name: `${getMonthName(currentMonth)} ${yearBefore}`,
                            data: data.data.map((item) => parseInt(item.MES2)),
                        }];
                        Highcharts.chart('container2', {
                            chart: {
                                type: 'column',
                                height: 500,
                            },
                            lang: {
                                viewFullscreen: "Ver en pantalla completa",
                                exitFullscreen: "Salir de pantalla completa",
                                downloadJPEG: "Descargar imagen JPEG",
                                downloadPDF: "Descargar en PDF"
                            },
                            title: {
                                text: "Comparativo con mismo mes del año anterior",
                                align: 'center',
                            },
                            xAxis: {
                                categories: categories,
                                crosshair: true,
                                accessibility: {
                                    description: 'Sin categorías'
                                }
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: ''
                                }
                            },
                            tooltip: {
                                valueSuffix: ''
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
                            series: series,
                            exporting: {
                                buttons: {
                                    contextButton: {
                                        menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
                                    }
                                },
                                enabled: true,
                                sourceWidth: 1600,
                                sourceHeight: 700,
                                fallbackToExportServer: false
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error("Error en la solicitud:", error);
                });
        }
        function chargeTab3(table) {
            const sendData = {
                "usuario": "<?php echo $_SESSION['CODUSU']; ?>",
                "anoFiltro": $("#cbbAno").val(),
                "mesFiltro": $("#cbbMes").val(),
                "codigo": $("#cbbAgrup").val(),
            }
            const currentYear = sendData.anoFiltro;
            const yearBefore = currentYear - 1;

            fetch("http://172.16.15.20/API.LovablePHP/ZLO0040P/List3/", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(sendData),
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.code == 200) {
                        table.clear();
                        table.column(1).header().innerHTML = `Año ${currentYear}`;
                        table.column(2).header().innerHTML = `Año ${yearBefore}`;
                        table.rows.add(data.data);
                        table.draw();
                        const categories = data.data.map((item) => item.GENERO);
                        const series = [{
                            name: `Año ${currentYear}`,
                            data: data.data.map((item) => parseInt(item.MES1)),
                        }, {
                            name: `Año ${yearBefore}`,
                            data: data.data.map((item) => parseInt(item.MES2)),
                        }];
                        Highcharts.chart('container3', {
                            chart: {
                                type: 'column',
                                height: 500,
                            },
                            lang: {
                                viewFullscreen: "Ver en pantalla completa",
                                exitFullscreen: "Salir de pantalla completa",
                                downloadJPEG: "Descargar imagen JPEG",
                                downloadPDF: "Descargar en PDF"
                            },
                            title: {
                                text: "Comparativo Año actual vs Año anterior",
                                align: 'center',
                            },
                            xAxis: {
                                categories: categories,
                                crosshair: true,
                                accessibility: {
                                    description: 'Sin categorías'
                                }
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: ''
                                }
                            },
                            tooltip: {
                                valueSuffix: ''
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
                            series: series,
                            exporting: {
                                buttons: {
                                    contextButton: {
                                        menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
                                    }
                                },
                                enabled: true,
                                sourceWidth: 1600,
                                sourceHeight: 700,
                                fallbackToExportServer: false
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error("Error en la solicitud:", error);
                });
        }

        function getMonthName(month) {
            const months = [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre",
            ];
            return months[month - 1];
        }
    </script>
</body>

</html>