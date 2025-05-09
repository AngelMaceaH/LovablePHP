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
                    <span>Consumo / Consulta </span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0056P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-3">
        <div class="card mb-5">
            <div class="card-header">
                <h1 class="fs-4 mb-1 mt-2 text-center">Consulta de ordenes de producción de impresiones gráficas</h1>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <span class="fw-bold">**Haga doble clic para ver el detalle**</span>
                    <table id="tbOrdenes" class="table stripe table-hover " style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-black text-start">Orden</th>
                                <th class="text-black text-start">Fecha Transacción</th>
                                <th class="text-black text-start">Fecha Entrega</th>
                                <th class="text-black text-start">Cliente</th>
                                <th class="d-none">Año</th>
                                <th class="d-none">Mes</th>
                                <th class="d-none">Numtra</th>
                            </tr>
                        </thead>
                        <tbody id="tbOrdenesBody">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="modalOrdenes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="exampleModalLabel">Detalle de orden <span id="txtOrden"></span>
                    </h2>

                    <button type="button" class="btn-close" onclick="$('#modalOrdenes').modal('hide')"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-lg-3 py-2">
                            <label for="transa">Transacción</label>
                            <label class="form-control mt-2" id="transa">
                        </div>
                        <div class="d-none d-md-block col-lg-5"></div>
                        <div class="col-6 col-lg-2 py-2">
                            <label for="ano">Año proceso</label>
                            <label class="form-control mt-2" id="ano">
                        </div>
                        <div class="col-6 col-lg-2 py-2">
                            <label for="mes">Mes proceso</label>
                            <label class="form-control mt-2" id="mes">
                        </div>
                        <div class="col-12 col-lg-3 py-2">
                            <label for="fectra">Fecha de transacción</label>
                            <label class="form-control mt-2" id="fectra">
                        </div>
                        <div class="col-8 col-lg-9 py-2">
                            <label for="numord">Orden de producción</label>
                            <label class="form-control mt-2" id="numord">
                        </div>
                        <div class="col-12 py-2">
                            <label>Tipo de impresión</label>
                            <div class="w-100 d-flex flex-column flex-lg-row justify-content-around form-control mt-2">
                                <div class="form-check">
                                    <input class="form-check-input ckTipo" name="ckTipo" value="C" type="radio"
                                        id="ckTipo1" disabled>
                                    <label class="form-check-label" for="ckTipo1">
                                        Distribuidores
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input ckTipo" name="ckTipo" value="T" type="radio"
                                        id="ckTipo2" disabled>
                                    <label class="form-check-label" for="ckTipo2">
                                        Trabajo interno
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input ckTipo" name="ckTipo" value="V" type="radio"
                                        id="ckTipo3" disabled>
                                    <label class="form-check-label" for="ckTipo3">
                                        Vitrina
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input ckTipo" name="ckTipo" value="P" type="radio"
                                        id="ckTipo4" disabled>
                                    <label class="form-check-label" for="ckTipo4">
                                        Prueba
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input ckTipo" name="ckTipo" value="I" type="radio"
                                        id="ckTipo5" disabled>
                                    <label class="form-check-label" for="ckTipo5">
                                        Cambio de imagen
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input ckTipo" name="ckTipo" value="A" type="radio"
                                        id="ckTipo6" disabled>
                                    <label class="form-check-label" for="ckTipo6">
                                        Varios
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-8 py-2">
                            <label for="cliente">Cliente</label>
                            <label class=" form-control mt-2" id="cliente" for=""></label>
                        </div>
                        <div class="col-8 col-lg-4 py-2">
                            <label for="ciudad">Ciudad</label>
                            <label class="form-control mt-2" id="ciudad"></label>
                        </div>
                        <div class="col-12 py-2">
                            <label for="cantidad">Cantidad</label>
                            <label for="" class="form-control mt-2" id="cantidad"></label>
                        </div>
                        <div class="col-12 py-2">
                            <div class="row">
                                <div class="col-12 my-3">
                                    <label class="w-100 bg-light p-2 fs-5 fw-bold">Detalle</label>
                                </div>
                                <div class="col-12 py-2 pe-0">
                                    <label for="material">Material</label>
                                    <label class=" form-control mt-2" id="material"></label>
                                </div>
                                <div class="col-12 py-2">
                                    <label class="mb-2">Area Impresión</label>
                                    <div class="gap-4 mt-3">
                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <label for=""> Ancho (Pulg.)</label>
                                                <label for="" class="form-control mt-2" id="arImAncho1"></label>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label for=""> Largo/Alto (Pulg.)</label>
                                                <label for="" class="form-control mt-2" id="arImLargo1"></label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 py-2">
                                    <label class="mb-2">Area sobrante</label>
                                    <div class="gap-4 mt-3">
                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <label for=""> Ancho (Pulg.)</label>
                                                <label for="" class="form-control mt-2" id="arSoAncho1"></label>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label for=""> Largo/Alto (Pulg.)</label>
                                                <label for="" class="form-control mt-2" id="arSoLargo1"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 py-2">
                                    <label class="mb-2">Area desperdicio</label>
                                    <div class="gap-4 mt-3">
                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <label for=""> Ancho (Pulg.)</label>
                                                <label for="" class="form-control mt-2" id="arDesAncho1"></label>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label for=""> Largo/Alto (Pulg.)</label>
                                                <label for="" class="form-control mt-2" id="arDesLargo1"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 py-2">
                            <label for="descrp">Descripción</label>
                            <label for="" id="descrp" class="form-control mt-2"></label>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>
    <script>
        $('#tbOrdenes thead th').each(function (index) {
            var title = $(this).text();

            if (index == 1 || index == 2) {
                $(this).html(
                    title +
                    '<br><input type="date" class="form-control mt-2 column-search" />'
                );
            } else {
                $(this).html(
                    title +
                    '<br /><input type="text" oninput="this.value = this.value.toUpperCase()" class="form-control mt-2 column-search" />'
                );
            }
        });
        tableOrder = $('#tbOrdenes').DataTable({
            "language": {
                "url": 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            },
            "pageLength": 50,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "/API.LovablePHP/ZLO0056P/List",
                "type": "POST",
                "contentType": "application/json",
                "data": function (d) {
                    console.log(JSON.stringify({
                        "anopro": $("#ano").val(),
                        "mespro": $("#mes").val(),
                        "draw": d.draw,
                        "start": d.start,
                        "length": d.length,
                        "search": d.search.value,
                        "columns": d.columns,
                        "order": d.order
                    }))
                    return JSON.stringify({
                        "anopro": $("#ano").val(),
                        "mespro": $("#mes").val(),
                        "draw": d.draw,
                        "start": d.start,
                        "length": d.length,
                        "search": d.search.value,
                        "columns": d.columns,
                        "order": d.order
                    });
                },
                error: function (xhr, status, error) {
                    console.log(error);
                    requestError = true;
                }
            },
            "ordering": false,
            "dom": 'rtip',
            "autoWidth": false,
            "columnDefs": [
                { "width": "25%", "targets": 0, "orderable": false },
                { "width": "10%", "targets": 1, "orderable": false },
                { "width": "10%", "targets": 1, "orderable": false },
                { "width": "55%", "targets": 1, "orderable": false },
            ],
            "columns": [
                {
                    "data": "ORDEN",
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return formatFecha(row.FECTRA);
                    }
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return formatFecha(row.FECEN1);
                    }
                },
                {
                    "data": "CLIENTE",
                },
                {
                    "data": "ANOPRO",
                    "class": "d-none"
                },
                {
                    "data": "MESPRO",
                    "class": "d-none"
                },
                {
                    "data": "NUMTRA",
                    "class": "d-none"
                }
            ],

            "drawCallback": function () {
                $('#tbOrdenes tbody tr').on('dblclick', function () {
                    sendOrden(this);
                });
            }
        });
        $('#tbOrdenes thead').on('keyup change', 'input.column-search', function () {
            var columnIndex = $(this).parent().index();
            var inputValue = $(this).val().trim();

            if (tableOrder.column(columnIndex).search() !== inputValue) {
                tableOrder
                    .column(columnIndex)
                    .search(inputValue)
                    .draw();
            }
        });
        function formatFecha(fechaStr) {
            if (fechaStr === '0' || fechaStr === ' ' || fechaStr === '') {
                return ' ';
            }
            fechaStr = fechaStr.padStart(8, '0');

            let año = fechaStr.substring(0, 4);
            let mes = fechaStr.substring(4, 6);
            let dia = fechaStr.substring(6, 8);

            return `${dia}/${mes}/${año}`;
        }
        function formatFecha2(fechaStr) {
            if (fechaStr === '0' || fechaStr === ' ' || fechaStr === '') {
                return ' ';
            }
            fechaStr = fechaStr.padStart(8, '0');

            let año = fechaStr.substring(0, 4);
            let mes = fechaStr.substring(4, 6);
            let dia = fechaStr.substring(6, 8);

            return `${año}-${mes}-${dia}`;
        }
        function sendOrden(row) {
            const tr = $(row).closest('tr');
            const tds = tr.find('td');
            const ano = tds.eq(4).text();
            const mes = tds.eq(5).text();
            const numtra = $("#transa").val();
            const orden = tds.eq(0).text();
            fetch('http://172.16.15.20/API.LovablePHP/ZLO0056P/Find', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    "ano": ano,
                    "mes": mes,
                    "orden": orden
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.code == 200) {
                        const dataOrden = data.data[0];
                        $("#transa").text(dataOrden.NUMTRA);
                        $("#ano").text(dataOrden.ANOPRO);
                        $("#mes").text(dataOrden.MESPRO);
                        $("#fectra").text(formatFecha2(dataOrden.FECTRA));
                        $("#numord").text(dataOrden.ORDEN);
                        $("#cliente").text(dataOrden.CLIENTE);
                        $("#ciudad").text(dataOrden.CIUDES);
                        $("#cantidad").text(dataOrden.CANTID);
                        $("#arImAncho1").text(dataOrden.ANCVIS);
                        $("#arImLargo1").text(dataOrden.LARVIS);
                        $("#arSoAncho1").text(dataOrden.ANCMAR);
                        $("#arSoLargo1").text(dataOrden.LARMAR);
                        $("#arDesAncho1").text(dataOrden.ANCMAR);
                        $("#arDesLargo1").text(dataOrden.LARMAR);
                        $("#cosImpresion1").text(dataOrden.COSIMP);
                        $("#cosTotImpresion1").text(dataOrden.COSTOTIMP);
                        $("#cosSobrante1").text(dataOrden.COSSOB);
                        $("#cosTotSobrante1").text(dataOrden.COSTOTSOB);
                        $("#cosDesperdicio1").text(dataOrden.COSDES);
                        $("#cosTotDesperdicio1").text(dataOrden.COSTOTDES);
                        $("#cosTotGeneral1").text(dataOrden.COSTOTGEN);
                        $("#cosTinta1").text(dataOrden.COSTINTA);
                        $("#cosMaterial").text(dataOrden.COSMAT);
                        $("#descrp").text(dataOrden.DESCR1);
                        $(".ckTipo").each(function () {
                            if ($(this).val() == dataOrden.TIPIMP) {
                                $(this).prop("checked", true);
                            } else {
                                $(this).prop("checked", false);
                            }
                        });

                        $("#matId").text(dataOrden.TIPMAT);
                        $("#material").text(dataOrden.MATERIAL);
                    }
                })
                .catch(error => console.error('Error:', error));

            $("#txtOrden").text(orden);
            $("#modalOrdenes").modal('show');
        }
    </script>
</body>

</html>