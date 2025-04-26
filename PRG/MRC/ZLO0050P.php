<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
    <style>
        .mx400 {
            max-height: 400px;
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
                    <span> Consumo / Generación de orden </span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0050P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-3">
        <div class="card mb-5">
            <div class="card-header">
                <h1 class="fs-4 mb-1 mt-2 text-center">Generación de orden de producción</h1>
            </div>
            <div class="card-body">
                <div id="loaderScreen">
                    <div class="position-absolute top-50 start-50">
                        <i class="fa-solid fa-gear fa-spin text-white" style="font-size:200px;"></i>
                    </div>
                </div>
                <div class="container py-4">
                    <div class="row">
                        <div class="col-12 col-lg-3 py-2">
                            <label for="transa">Transacción</label>
                            <input type="text" class="form-control mt-2" id="transa" disabled>
                        </div>
                        <div class="d-none d-md-block col-lg-5"></div>
                        <div class="col-6 col-lg-2 py-2">
                            <label for="ano">Año proceso</label>
                            <input type="text" class="form-control mt-2" id="ano" disabled>
                        </div>
                        <div class="col-6 col-lg-2 py-2">
                            <label for="mes">Mes proceso</label>
                            <input type="text" class="form-control mt-2" id="mes" disabled>
                        </div>
                        <div class="col-12 col-lg-6 py-2">
                            <label for="fectra">Fecha de transacción</label>
                            <input type="date" class="form-control mt-2" id="fectra">
                        </div>
                        <div class="col-12 col-lg-6 py-2">
                            <label for="fecent">Fecha de entrega</label>
                            <input type="date" class="form-control mt-2" id="fecent">
                        </div>
                        <div class="col-12 py-2">
                            <label>Tipo de impresión</label>
                            <div class="w-100 d-flex flex-column flex-lg-row justify-content-around form-control mt-2">
                                <div class="form-check">
                                    <input class="form-check-input ckTipo" name="ckTipo" value="C" type="radio"
                                        id="ckTipo1" checked>
                                    <label class="form-check-label" for="ckTipo1">
                                        Distribuidores
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input ckTipo" name="ckTipo" value="T" type="radio"
                                        id="ckTipo2">
                                    <label class="form-check-label" for="ckTipo2">
                                        Trabajo interno
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input ckTipo" name="ckTipo" value="V" type="radio"
                                        id="ckTipo3">
                                    <label class="form-check-label" for="ckTipo3">
                                        Vitrina
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input ckTipo" name="ckTipo" value="P" type="radio"
                                        id="ckTipo4">
                                    <label class="form-check-label" for="ckTipo4">
                                        Prueba
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input ckTipo" name="ckTipo" value="I" type="radio"
                                        id="ckTipo5">
                                    <label class="form-check-label" for="ckTipo5">
                                        Cambio de imagen
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input ckTipo" name="ckTipo" value="A" type="radio"
                                        id="ckTipo6">
                                    <label class="form-check-label" for="ckTipo6">
                                        Varios
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-8 py-2">
                            <label for="cliente">Cliente</label>
                            <span class="" onclick="showClientes()">
                                <input type="text" placeholder="Seleccione el cliente" class=" form-select mt-2"
                                    id="cliente" readonly>
                            </span>
                            <input type="text" id="clieId" class="d-none">
                        </div>
                        <div class="col-8 col-lg-3 py-2 ">
                            <label for="ciudad">Ciudad</label>
                            <input type="text" class="form-control mt-2" id="ciudad" disabled>
                            <input type="text" id="ciuId" class="d-none">
                        </div>
                        <div class="col-4 col-lg-1 py-2">
                            <button id="btnLimpiar1" class="btn btn-danger w-100 fw-bold text-white mt-4 fs-4 p-0"><i
                                    class="fa-solid fa-delete-left"></i></button>
                        </div>
                        <div class="col-12 my-3">
                            <label class="w-100 bg-light p-2 fs-5 fw-bold">Detalle</label>
                        </div>
                        <div class="col-12 py-2">
                            <label>Orientación</label>
                            <div class="w-100 d-flex justify-content-around form-control mt-2">
                                <div class="form-check">
                                    <input class="form-check-input ckOri" name="ckOri" value="H" type="radio"
                                        id="ckOri1" checked>
                                    <label class="form-check-label" for="ckOri1">
                                        Horizontal
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input ckOri" name="ckOri" value="V" type="radio"
                                        id="ckOri2">
                                    <label class="form-check-label" for="ckOri2">
                                        Vertical
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-10 col-lg-11 py-2 pe-0">
                            <label for="material">Material</label>
                            <span class="" onclick="showMaterial()">
                                <input type="text" placeholder="Seleccione el material" class=" form-select mt-2"
                                    id="material" readonly>
                            </span>
                            <input type="text" id="matId" class="d-none">
                        </div>
                        <div class="col-2 col-lg-1 py-2">
                            <button id="btnLimpiar2" class="btn btn-danger w-100 fw-bold text-white mt-4 fs-4 p-0"><i
                                    class="fa-solid fa-delete-left"></i></button>
                        </div>
                        <div class="col-12 col-lg-6 py-2">
                            <label class="mb-2">Area Visible</label>
                            <div class="d-flex gap-4 mt-3 form-control bg-light">
                                <div class="w-100">
                                    <label for=""> Ancho (Pulg.)</label>
                                    <input type="number" placeholder="Ingrese el ancho del margen"
                                        class="form-control mt-2" id="arViAncho">
                                </div>
                                <div class="w-100">
                                    <label for=""> Largo/Alto (Pulg.)</label>
                                    <input type="number" placeholder="Ingrese el largo del margen"
                                        class="form-control mt-2" id="arViLargo">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 py-2">
                            <label class="mb-2">Area Margen</label>
                            <div class="d-flex gap-4 mt-3 form-control bg-light">
                                <div class="w-100">
                                    <label for=""> Ancho (Pulg.)</label>
                                    <input type="number" placeholder="Ingrese el ancho del margen"
                                        class="form-control mt-2" id="arMaAncho">
                                </div>
                                <div class="w-100">
                                    <label for=""> Largo/Alto (Pulg.)</label>
                                    <input type="number" placeholder="Ingrese el largo del margen"
                                        class="form-control mt-2" id="arMaLargo">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 py-2">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" placeholder="Ingrese la cantidad" class="form-control mt-2"
                                id="cantidad">
                        </div>
                        <div class="col-12 py-2">
                            <div class="w-100 d-flex justify-content-between">
                                <div>
                                    <label for="descrp">Descripción</label>
                                </div>
                                <div>
                                    <span>(<span id="spnDescrp">300</span>) caracteres restantes.</span>
                                </div>
                            </div>

                            <textarea id="descrp" placeholder="Ingrese la descripcion" class="form-control mt-2"
                                maxlength="300"></textarea>
                        </div>
                        <div class="col-12 py-2 mb-3">
                            <label for="inputFile">Fotografía</label>
                            <div class="w-100 d-flex justify-content-center" id="divFoto">
                                <input type="file" class="form-control mt-2" id="inputFile" accept="image/*">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="d-flex gap-3 justify-content-between d-none" id="divButtons">
                                <button
                                    class="btn btn-secondary w-100 mt-3 d-flex justify-content-center gap-2 text-white fw-bold"
                                    id="btnNuevo">
                                    <div><i class="fa-solid fa-pen"></i></div>
                                    <div><span>Nuevo</span></div>
                                </button>
                                <button
                                    class="btn btn-danger w-100 mt-3 d-flex justify-content-center gap-2 text-white fw-bold"
                                    id="btnEliminar">
                                    <div><i class="fa-solid fa-trash"></i></div>
                                    <div><span>Eliminar</span></div>
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-4"></div>
                        <div class="col-12 col-lg-4 d-flex gap-3 justify-content-between">
                            <button id="btnGrabar"
                                class="btn btn-primary w-100 mt-3 d-flex justify-content-center gap-2 text-white fw-bold">
                                <div><i class="fa-solid fa-floppy-disk"></i></div>
                                <div><span>Grabar</span></div>
                            </button>
                            <button onclick="showOrdenes()"
                                class="btn btn-dark w-100 mt-3 d-flex justify-content-center gap-2 text-white fw-bold">
                                <div><i class="fa-solid fa-clipboard-list"></i></div>
                                <div><span>Llamar orden</span></div>
                            </button>
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
    <div class="modal fade" id="modalClientes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>

                    <button type="button" class="btn-close" onclick="$('#modalClientes').modal('hide')"></button>
                </div>
                <div class="modal-body">
                    <div class="table-container mt-3">
                        <table id="tbClientes" class="table stripe table-hover " style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-black text-start">Tipo</th>
                                    <th class="text-black text-start">Código</th>
                                    <th class="text-black text-start">Cliente</th>
                                    <th class="text-black text-start">Ciudad</th>
                                    <th class="d-none">Codpai</th>
                                    <th class="d-none">Codciu</th>
                                </tr>
                            </thead>
                            <tbody id="tbClientesBody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalMaterial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>

                    <button type="button" class="btn-close" onclick="$('#modalMaterial').modal('hide')"></button>
                </div>
                <div class="modal-body">
                    <div class="table-container mt-3">
                        <table id="tbMaterial" class="table stripe table-hover " style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-black text-start">Código</th>
                                    <th class="text-black text-start">Descripción</th>
                                </tr>
                            </thead>
                            <tbody id="tbMaterialBody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalOrdenes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>

                    <button type="button" class="btn-close" onclick="$('#modalOrdenes').modal('hide')"></button>
                </div>
                <div class="modal-body">
                    <div class="table-container mt-3">
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
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const usuario = '<?php echo $_SESSION["CODUSU"]; ?>';
        let tableOrder = null;
        let anocierre = 0;
        let mescierre = 0;
        document.addEventListener('DOMContentLoaded', function () {
            $("#loaderScreen").fadeOut("fast", function () { });
            //CLIENTE
            $('#tbClientes thead th').each(function () {
                var title = $(this).text();
                $(this).html(title +
                    '<br /><input type="text"  oninput="this.value = this.value.toUpperCase()" class="form-control mt-2"/>'
                );
            });
            const tableClie = $('#tbClientes').DataTable({
                "language": {
                    "url": 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                },
                "pageLength": 15,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "/API.LovablePHP/ZLO0050P/ListClientes",
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
                    error: function (xhr, status, error) {
                        console.log(error);
                        requestError = true;
                    }
                },
                "ordering": false,
                "dom": 'rtip',
                "autoWidth": false,
                "columnDefs": [
                    { "width": "10%", "targets": 0, "orderable": false },
                    { "width": "10%", "targets": 1, "orderable": false },
                    { "width": "50%", "targets": 2, "orderable": false },
                    { "width": "30%", "targets": 3, "orderable": false },
                    { "width": "1%", "targets": 4, "orderable": false, "class": "d-none" },
                    { "width": "1%", "targets": 5, "orderable": false, "class": "d-none" },
                ],
                "columns": [
                    {
                        "data": "MAEC19",
                    },
                    {
                        "data": "MAENU3",
                    },
                    {
                        "data": "MAENO4"
                    },
                    {
                        "data": "CIUDES"
                    },
                    {
                        "data": "MAE003"
                    },
                    {
                        "data": "CIUDAD"
                    }
                ],

                "drawCallback": function () {
                    $('#tbClientes tbody tr').on('click', function () {
                        sendCliente(this);
                    });
                }
            });
            $('#tbClientes thead input').on('keyup', function () {
                var columnIndex = $(this).parent().index();
                var inputValue = $(this).val().trim();

                if (tableClie.column(columnIndex).search() !== inputValue) {
                    tableClie
                        .column(columnIndex)
                        .search(inputValue)
                        .draw();
                }
            });
            $("#btnLimpiar1").click(function () {
                $("#cliente").val("");
                $("#ciudad").val("");
                $("#clieId").val("");
                $("#ciuId").val("");
            });
            //MATERIAL
            $('#tbMaterial thead th').each(function () {
                var title = $(this).text();
                $(this).html(title +
                    '<br /><input type="text"  oninput="this.value = this.value.toUpperCase()" class="form-control mt-2"/>'
                );
            });
            const tableMat = $('#tbMaterial').DataTable({
                "language": {
                    "url": 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                },
                "pageLength": 15,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "/API.LovablePHP/ZLO0050P/ListMaterial",
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
                    error: function (xhr, status, error) {
                        console.log(error);
                        requestError = true;
                    }
                },
                "ordering": false,
                "dom": 'rtip',
                "autoWidth": false,
                "columnDefs": [
                    { "width": "10%", "targets": 0, "orderable": false },
                    { "width": "90%", "targets": 1, "orderable": false }
                ],
                "columns": [
                    {
                        "data": "CODTIP",
                    },
                    {
                        "data": "DESTIP",
                    }
                ],

                "drawCallback": function () {
                    $('#tbMaterial tbody tr').on('click', function () {
                        sendMaterial(this);
                    });
                }
            });
            $('#tbMaterial thead input').on('keyup', function () {
                var columnIndex = $(this).parent().index();
                var inputValue = $(this).val().trim();

                if (tableMat.column(columnIndex).search() !== inputValue) {
                    tableMat
                        .column(columnIndex)
                        .search(inputValue)
                        .draw();
                }
            });
            $("#btnLimpiar2").click(function () {
                $("#material").val("");
                $("#matId").val("");
            });
            //ORDENES ACTIVAS
            fetch('/API.LovablePHP/ZLO0050P/FechaProceso')
                .then(response => response.json())
                .then(data => {
                    if (data.code == 200) {
                        $("#ano").val(data.data[0].ANOPRO);
                        $("#mes").val(data.data[0].MESPRO);
                        anocierre = data.data[0].ANOPRO;
                        mescierre = data.data[0].MESPRO;
                        $("#fectra").val(`${data.data[0].ANOPRO}-${data.data[0].MESPRO}-01`);
                        $("#fecent").val(`${data.data[0].ANOPRO}-${data.data[0].MESPRO}-01`);
                    }
                }).then(() => {
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
                        "pageLength": 15,
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            "url": "/API.LovablePHP/ZLO0050P/ListOrdenes",
                            "type": "POST",
                            "contentType": "application/json",
                            "data": function (d) {
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
                            $('#tbOrdenes tbody tr').on('click', function () {
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

                })
                .catch(error => console.error(error));
            $("#descrp").on('input', function () {
                var maxLength = 300;
                var length = $(this).val().length;
                var length = maxLength - length;
                $('#spnDescrp').text(length);
            });
            $("#btnGrabar").click(function () {
                //validar
                const ano = document.getElementById("ano").value;
                const mes = document.getElementById("mes").value;
                const transa = document.getElementById("transa").value;
                const fectra = document.getElementById("fectra").value;
                const fecent = document.getElementById("fecent").value;
                const cliente = document.getElementById("clieId").value;
                const ciudad = document.getElementById("ciuId").value;
                const material = document.getElementById("matId").value;
                const cantidad = document.getElementById("cantidad").value;
                const descrp = document.getElementById("descrp").value;
                const arViAncho = document.getElementById("arViAncho").value;
                const arViLargo = document.getElementById("arViLargo").value;
                const arMaAncho = document.getElementById("arMaAncho").value;
                const arMaLargo = document.getElementById("arMaLargo").value;
                const ckTipo = document.querySelector('input[name="ckTipo"]:checked').value;
                const ckOri = document.querySelector('input[name="ckOri"]:checked').value;
                const file = document.getElementById("inputFile").files[0] || "";
                if (ano == "" || mes == "" || fectra == "" || fecent == "" || material == "" || cantidad == "" || arViAncho == "" || arViLargo == "" || arMaAncho == "" || arMaLargo == "" || ckTipo == "" || ckOri == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Todos los campos son requeridos',
                        confirmButtonText: 'Aceptar'
                    });
                } else {
                    const formData = new FormData();
                    formData.append("anopro", ano);
                    formData.append("mespro", mes);
                    formData.append("transa", transa);
                    formData.append("fectra", fectra);
                    formData.append("fecent", fecent);
                    formData.append("codcli", cliente);
                    formData.append("ciudad", ciudad);
                    formData.append("codmat", material);
                    formData.append("cantid", cantidad);
                    formData.append("descrp", descrp);
                    formData.append("arvian", arViAncho);
                    formData.append("arvila", arViLargo);
                    formData.append("armaan", arMaAncho);
                    formData.append("armala", arMaLargo);
                    formData.append("codtip", ckTipo);
                    formData.append("codhor", ckOri);
                    formData.append("imagen", file);
                    formData.append("usugra", usuario);

                    /*formData.forEach((value, key) => {
                        if (key === "file" && value instanceof File) {
                            console.log(key + ": " + value.name);  
                            console.log("File size: " + value.size + " bytes");  
                            console.log("File type: " + value.type);
                        } else {
                            console.log(key + ": " + value);  
                        }
                    });*/
                    $("#loaderScreen").fadeIn("fast", function () { });
                    fetch('/API.LovablePHP/ZLO0050P/SaveOrder', {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            $("#loaderScreen").fadeOut("fast", function () { });
                            if (data.code == 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Éxito',
                                    text: 'Orden guardada correctamente',
                                    confirmButtonText: 'Aceptar'
                                });
                                limpiar();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Ocurrió un error al guardar la orden',
                                    confirmButtonText: 'Aceptar'
                                });
                            }
                        })
                        .catch(error => {
                            console.error("Hubo un error con la solicitud:", error);
                        });
                }
            });
            $("#btnNuevo").click(limpiar)
            $("#btnEliminar").click(function () {
                Swal.fire({
                    title: "¿Estás seguro de eliminar esta orden?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Eliminar",
                    cancelButtonText: "Cancelar",
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch("/API.LovablePHP/ZLO0050P/DelOrder", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                "anopro": $("#ano").val(),
                                "mespro": $("#mes").val(),
                                "numtra": parseInt($("#transa").val().substring(4, 9))
                            })
                        }).then(response => response.json())
                            .then(data => {
                                if (data.code == 200) {
                                    limpiar();
                                }
                            });
                    }
                });

            })
        });
        function limpiar() {
            $("#transa").val("");
            $("#fectra").val(`${anocierre}-${mescierre}-01`);
            $("#fecent").val(`${anocierre}-${mescierre}-01`);

            $("#cliente").val("");
            $("#clieId").val("");
            $("#ciudad").val("");
            $("#ciuId").val("");
            $("#material").val("");
            $("#matId").val("");
            $("#arViAncho").val("");
            $("#arViLargo").val("");
            $("#arMaAncho").val("");
            $("#arMaLargo").val("");
            $("#cantidad").val("");
            $("#descrp").val("");
            $("#divFoto").empty();
            $("#divFoto").append('<input type="file" class="form-control mt-2" id="inputFile" accept="image/*">');
            $(".ckTipo").each(function () {
                $(this).prop('checked', false);
            });
            $(".ckOri").each(function () {
                $(this).prop('checked', false);
            });
            $("#divButtons").addClass('d-none');
        }
        function showClientes() {
            $("#modalClientes").modal('show');
        }
        function sendCliente(row) {
            const tr = $(row).closest('tr');
            const tds = tr.find('td');
            const tipclie = tds.eq(0).text();
            const codclie = tds.eq(1).text();
            const descli = tds.eq(2).text();
            const codpai = tds.eq(4).text();
            const codciu = tds.eq(5).text();
            const desciud = tds.eq(3).text();
            $("#clieId").val(`${tipclie}-${codclie}`);
            $("#ciuId").val(`${codpai}-${codciu}`);
            $("#cliente").val(`${tipclie} ${codclie}  ${descli}`);
            $("#ciudad").val(desciud);
            $("#modalClientes").modal('hide');
        }
        function showMaterial() {
            $("#modalMaterial").modal('show');
        }
        function sendMaterial(row) {
            const tr = $(row).closest('tr');
            const tds = tr.find('td');
            const matId = tds.eq(0).text();
            const matDes = tds.eq(1).text();
            $("#matId").val(matId);
            $("#material").val(`${matId} ${matDes}`);
            $("#modalMaterial").modal('hide');
        }
        function showOrdenes() {
            tableOrder.ajax.reload();
            $("#modalOrdenes").modal('show');
        }
        function sendOrden(row) {
            const tr = $(row).closest('tr');
            const tds = tr.find('td');
            const ano = tds.eq(4).text();
            const mes = tds.eq(5).text();
            const numtra = tds.eq(6).text();
            if (ano != "" && mes != "" && numtra != "") {
                limpiar()
                fetch('/API.LovablePHP/ZLO0050P/FindOrder', {
                    "method": 'POST',
                    "headers": {
                        'Content-Type': 'application/json'
                    },
                    'body': JSON.stringify({
                        "ano": ano,
                        'mes': mes,
                        'numtra': numtra
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.code == 200) {
                            const dataOrder = data.data[0];
                            $("#transa").val(dataOrder.ORDEN);
                            $("#fectra").val(formatFecha2(dataOrder.FECTRA));
                            $("#fecent").val(formatFecha2(dataOrder.FECEN1));
                            $("#cliente").val(`${dataOrder.CLIENTE}`);
                            $("#clieId").val(`${dataOrder.CODCL1}-${dataOrder.CODCL2}`);
                            $("#ciudad").val(dataOrder.CIUDES);
                            $("#ciuId").val(`${dataOrder.CODPAI}-${dataOrder.CODCIU}`);
                            $(".ckTipo").each(function () {
                                if ($(this).val() == dataOrder.TIPIMP) {
                                    $(this).prop('checked', true);
                                }
                            });
                            $(".ckOri").each(function () {
                                if ($(this).val() == dataOrder.ORIEVH) {
                                    $(this).prop('checked', true);
                                }
                            });

                            $("#material").val(`${dataOrder.MATERIAL}`);
                            $("#matId").val(dataOrder.TIPMAT);
                            $("#arViAncho").val(dataOrder.ANCVIS);
                            $("#arViLargo").val(dataOrder.LARVIS);
                            $("#arMaAncho").val(dataOrder.ANCMAR);
                            $("#arMaLargo").val(dataOrder.LARMAR);
                            $("#cantidad").val(dataOrder.CANTID);
                            $("#descrp").val(dataOrder.DESCRLRG);
                            $("#divFoto").empty();
                            if (dataOrder.PATHFO != "") {
                                $("#divFoto").append(`<img src="${dataOrder.PATHFO}" class="img-fluid mx400" alt="Foto">`);
                                $("#divFoto").append('<input type="file" class="form-control mt-2 d-none" id="inputFile" accept="image/*">');
                            } else {
                                $("#divFoto").append('<input type="file" class="form-control mt-2" id="inputFile" accept="image/*">');
                            }

                        }
                    })
                $("#divButtons").removeClass('d-none');
                $("#modalOrdenes").modal('hide');
            }
        }
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
    </script>
</body>

</html>