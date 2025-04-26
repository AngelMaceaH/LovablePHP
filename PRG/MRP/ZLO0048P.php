<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
    <style>
        body {
            overflow: hidden !important;
        }

        .mx-h {
            height: 100%;
            max-height: 75vh;
        }

        @media (min-width: 768px) {
            .mx-h {
                max-height: 77vh !important;
            }
        }

        @media (min-width: 1400px) {
            .mx-h {
                max-height: 82vh !important;
            }
        }

        #body-div {
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        #loaderScreen {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1040;
            background-color: rgba(100, 100, 100, 0.9);
        }

        #loaderExcel {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1040;
            background-color: rgba(100, 100, 100, 0.5);
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
                    <span>Planificación de materiales / Explosión de materiales </span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0048P</span></li>
            </ol>
        </nav>
        <button class="btn btn-success text-light m-0 fs-6 " id="exportExcel"><i class="fa-solid fa-file-excel"></i>
            <b>Enviar a Excel</b></button>
    </div>
    </header>
    <div id="body-div" class="flex-grow-1 bg-white">
        <div id="loaderScreen">
            <div class="position-absolute top-50 start-50">
                <i class="fa-solid fa-gear fa-spin text-white" style="font-size:200px;"></i>
            </div>
        </div>
        <div id="loaderExcel" class="d-none">
            <div class="position-absolute top-50 start-50">
                <i class="fa-solid fa-file-excel fa-flip text-success" style="font-size:200px;"></i>
            </div>
        </div>
        <div class="mx-h bg-white table-responsive p-2">
            <table class="table table-hover" id="table" style="width: 2500px;">
                <thead class="sticky-top bg-white">
                    <tr>
                        <th class="d-none"></th>
                        <th>Orden</th>
                        <th>Fecha Orden Prod.</th>
                        <th>Marca</th>
                        <th>Estilo</th>
                        <th>Color</th>
                        <th>Talla</th>
                        <th>Docenas</th>

                        <th>Núm. Material</th>
                        <th>Ancho</th>
                        <th>Color</th>
                        <th>Unidad</th>
                        <th>Proveedor</th>


                        <th>Tipo Mat.</th>
                        <th>Descripcion</th>
                        <th>Consumo Material</th>
                        <th>Total Material</th>
                        <th>Costo Unitario</th>
                        <th>Costo Total</th>
                        <th>Existencia</th>
                        <th>Fecha Ult. Ingreso</th>
                        <th>Transito</th>
                        <th>Cantidad Ordenes</th>
                        <th>Fecha Ult. Orden</th>
                        <th>Fecha Prim. Entrega</th>
                        <th>País</th>
                        <th>Cod. Catalogo</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
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
    <script>
        let table = null
        document.addEventListener("DOMContentLoaded", function () {
            table = $('#table').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                    loadingRecords: `<button class="btn btn-danger " type="button" disabled>
                                                <span class="spinner-border text-white" style="width: 1.5rem; height: 1.5rem;"
                                                    aria-hidden="true"></span>
                                                <span role="status" class="ms-2 text-white fs-4">Cargando...</span>
                                            </button>`
                },
                "pageLength": 50,
                "processing": true,
                "serverSide": true,
                "deferRender": true,
                "ajax": {
                    "url": "/API.LovablePHP/ZLO0048P/List",
                    "type": "POST",
                    "contentType": "application/json",
                    "data": function (d) {
                        return JSON.stringify({
                            "draw": d.draw,
                            "start": d.start,
                            "length": d.length,
                            "search": d.search.value,
                            "columns": d.columns,
                            "order": d.order
                        });
                    },
                    "beforeSend": function () {
                        $("#loaderScreen").fadeIn("fast", function () { });
                    },
                    "complete": function (response) {
                        $("#loaderScreen").fadeOut("fast", function () { });
                    },
                    "error": function (xhr, status, error) {
                        console.log("Error en la petición:", error);
                    }
                },
                "ordering": true,
                "dom": 'rtip',
                "autoWidth": true,
                "columnDefs": [
                    { "targets": 0, "orderable": false, "class": "d-none" },
                    { "width": "5%", "targets": 1, "orderable": false },
                    { "targets": 2, "orderable": false },
                    { "targets": 3, "orderable": false },
                    { "targets": 4, "orderable": false },
                    { "targets": 5, "orderable": false },
                    { "targets": 6, "orderable": false },
                    { "targets": 7, "orderable": true, "class": "text-end" },
                    { "targets": 8, "orderable": false },
                    { "targets": 9, "orderable": false },
                    { "targets": 10, "orderable": false },
                    { "targets": 11, "orderable": false },
                    { "targets": 12, "orderable": false },
                    { "targets": 13, "orderable": false },
                    { "targets": 14, "orderable": false },
                    { "targets": 15, "orderable": true, "class": "text-end" },
                    { "targets": 16, "orderable": true, "class": "text-end" },
                    { "targets": 17, "orderable": true, "class": "text-end" },
                    { "targets": 18, "orderable": true, "class": "text-end" },
                    { "targets": 19, "orderable": true, "class": "text-end" },
                    { "targets": 20, "orderable": false },
                    { "targets": 21, "orderable": false, "class": "text-end" },
                    { "targets": 22, "orderable": false, "class": "text-end" },
                    { "targets": 23, "orderable": false },
                    { "targets": 24, "orderable": false },
                    { "targets": 25, "orderable": false },
                    { "targets": 26, "orderable": false },
                ],
                "columns": [
                    { "data": "ROWNUMBER" },
                    { "data": "ORDEN" },
                    {
                        "data": null, "render": function (data, type, row) {
                            return formatFecha(row.FECORD);
                        }
                    },
                    { "data": "MARCA" },
                    { "data": "ESTILO" },
                    { "data": "COLOR" },
                    { "data": "TALLA" },
                    { "data": "DOCENA" },
                    /*{
                        "data": null, "render": function (data, type, row) {
                            return `<table style="width: 500px;">
                                    <tr class="bg-light border border-1 rounded">
                                        <td class="text-start" style="width:25%">${row.NUMMAT}</td>
                                        <td class="text-start"  style="width:15%">${row.ANCHO1}</td>
                                        <td class="text-start"  style="width:10%">${row.ANCHO2}</td>
                                        <td class="text-start"  style="width:10%">${row.ANCHO3}</td>
                                        <td class="text-start"  style="width:10%">${row.COLMAT}</td>
                                        <td class="text-start"  style="width:10%">${row.UNIMED}</td>
                                        <td class="text-start"  style="width:10%">${row.PROVE1}</td>
                                        <td class="text-start"  style="width:10%">${row.PROVE2}</td>
                                    </tr>
                                </table>`;
                        }
                    },*/

                    { "data": "NUMMAT" },
                    {
                        "data": null, "render": function (data, type, row) {
                            return `${row.ANCHO1}   ${row.ANCHO2}   ${row.ANCHO3}`;
                        }
                    },
                    { "data": "COLMAT" },
                    { "data": "UNIMED" },
                    {
                        "data": null, "render": function (data, type, row) {
                            return `${row.PROVE1}   ${row.PROVE2}`;
                        }
                    },
                    { "data": "TIPMAT" },
                    { "data": "DESMAT" },
                    {
                        "data": null, "render": function (data, type, row) {
                            return parseFloat(row.CONMAT).toLocaleString('en-US', { minimumFractionDigits: 2 });
                        }
                    },
                    {
                        "data": null, "render": function (data, type, row) {
                            return parseFloat(row.TOTMAT).toLocaleString('en-US', { minimumFractionDigits: 2 });
                        }
                    },
                    {
                        "data": null, "render": function (data, type, row) {
                            return parseFloat(row.COSUNI).toLocaleString('en-US', { minimumFractionDigits: 2 });
                        }
                    },
                    {
                        "data": null, "render": function (data, type, row) {
                            return parseFloat(row.TOTCOS).toLocaleString('en-US', { minimumFractionDigits: 2 });
                        }
                    },
                    {
                        "data": null, "render": function (data, type, row) {
                            return parseFloat(row.EXISTE).toLocaleString('en-US', { minimumFractionDigits: 2 });
                        }
                    },
                    {
                        "data": null, "render": function (data, type, row) {
                            return formatFecha(row.FULTIN);
                        }
                    },
                    {
                        "data": null, "render": function (data, type, row) {
                            return parseFloat(row.TRANSI).toLocaleString('en-US', { minimumFractionDigits: 2 });
                        }
                    },
                    {
                        "data": null, "render": function (data, type, row) {
                            return row.CANORD == 0 ? ' ' : row.CANORD;
                        }
                    },
                    {
                        "data": null, "render": function (data, type, row) {
                            return formatFecha(row.FULTOR);
                        }
                    },
                    {
                        "data": null, "render": function (data, type, row) {
                            return formatFecha(row.FPRIEN);
                        }
                    },
                    { "data": "PAISPR" },
                    { "data": "CODCAT" }
                ],
                "rowCallback": function (row, data, index) {
                    $(row).css("height", "50px");
                },
                initComplete: function () {
                    $("#table thead th").each(function (index) {
                        var title = $(this).text();
                        if (index == 1) {
                            $(this).html(
                                title +
                                '<br><input type="text" class="form-control mt-2 column-search" placeholder="Buscar..." />'
                            );
                        }
                    });

                    $("#table thead").on("input", ".column-search", function () {
                        var columnIndex = $(this).parent().index();
                        table.column(columnIndex).search(this.value).draw();
                    });
                },
            });
            const exportExcel = document.getElementById('exportExcel');
            exportExcel.addEventListener('click', (event) => {
                document.getElementById('loaderExcel').classList.remove('d-none');
                fetch('http://172.16.15.20/API.LovablePHP/ZLO0048P/Export')
                    .then(response => response.blob())
                    .then(blob => {
                        var tempUrl = window.URL.createObjectURL(blob);
                        var a = document.createElement('a');
                        a.href = tempUrl;
                        a.download =
                            'ExplosionMateriales.xlsx';
                        document.body.appendChild(a);
                        a.click();
                        window.URL.revokeObjectURL(tempUrl);
                        a.remove();
                        document.getElementById('loaderExcel').classList.add(
                            'd-none');
                    })
                    .catch(error => {
                        console.error('Hubo un problema con la petición Fetch:', error);
                        document.getElementById('loaderExcel').classList.add(
                            'd-none');
                    });
            });
        });

        function formatFecha(fechaStr) {
            if (fechaStr === '0' || fechaStr === ' ' || fechaStr === '') {
                return ' ';
            }
            fechaStr = fechaStr.padStart(8, '0');
            let año = fechaStr.substring(4, 8);
            let mes = fechaStr.substring(2, 4);
            let dia = fechaStr.substring(0, 2);
            return `${dia}/${mes}/${año}`;
        }

    </script>
</body>

</html>