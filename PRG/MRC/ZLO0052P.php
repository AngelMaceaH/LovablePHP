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
                    <span>Consumo / Captura</span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0052P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-3">
        <div class="card mb-5">
            <div class="card-header">
                <h1 class="fs-4 mb-1 mt-2 text-center">Captura de consumo de impresiones</h1>
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
                        <div class="col-12 col-lg-3 py-2">
                            <label for="fectra">Fecha de transacción</label>
                            <input type="date" class="form-control mt-2" id="fectra">
                        </div>
                        <div class="col-8 col-lg-7 py-2">
                            <label for="numord">Orden de producción</label>
                            <input type="text" class="form-control mt-2" id="numord" maxlength="9">
                        </div>
                        <div class="col-4 col-lg-2 py-2">
                            <button id="btnBuscar" onclick="showOrdenes()"
                                class="btn btn-danger w-100 fw-bold text-white mt-4 py-1 fs-5 p-0">
                                <i class="fa-solid fa-magnifying-glass me-2"></i> <span>Buscar</span> </button>
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
                        <div class="col-8 col-lg-3 py-2 px-0">
                            <label for="ciudad">Ciudad</label>
                            <input type="text" class="form-control mt-2" id="ciudad" disabled>
                            <input type="text" id="ciuId" class="d-none">
                        </div>
                        <div class="col-4 col-lg-1 py-2">
                            <button id="btnLimpiar1" class="btn btn-danger w-100 fw-bold text-white mt-4 fs-4 p-0"><i
                                    class="fa-solid fa-delete-left"></i></button>
                        </div>
                        <div class="col-12 py-2">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" placeholder="Ingrese la cantidad" class="form-control mt-2"
                                id="cantidad">
                        </div>
                        <div class="col-12 py-2">
                            <div class="demo">
                                <ul class="tablist" role="tablist">
                                    <li id="tab1" class="tablist__tab text-center p-3  is-active" aria-controls="panel1"
                                        aria-selected="true" role="tab" tabindex="0">Inventarios</li>
                                    <li id="tab2" class="tablist__tab text-center p-3" aria-controls="panel2"
                                        aria-selected="false" role="tab" tabindex="0">Costos</li>
                                </ul>
                                <div id="panel1" class="tablist__panel p-3 border border-0 border-top bg-light rounded"
                                    aria-labelledby="tab1" aria-hidden="false" role="tabpanel">
                                    <div class="row">
                                        <div class="col-12 my-3">
                                            <label class="w-100 bg-light p-2 fs-5 fw-bold">Detalle</label>
                                        </div>
                                        <div class="col-10 col-lg-7 py-2 pe-0">
                                            <label for="material">Material</label>
                                            <span class="" onclick="showMaterial()">
                                                <input type="text" placeholder="Seleccione el material"
                                                    class="material form-select mt-2" readonly>
                                            </span>
                                            <input type="text" class="matId d-none">
                                        </div>
                                        <div class="col-2 col-lg-1 py-2">
                                            <button id="btnLimpiar2"
                                                class="btn btn-danger w-100 fw-bold text-white mt-4 fs-4 p-0"><i
                                                    class="fa-solid fa-delete-left"></i></button>
                                        </div>
                                        <div class="col-12 col-lg-4 py-2">
                                            <label for="cosMaterial">Costo Pie Cuadrado</label>
                                            <input type="number" id="cosMaterial" class="form-control mt-2" disabled>
                                        </div>
                                        <div class="col-12 py-2">
                                            <label class="mb-2">Area Impresión</label>
                                            <div class="gap-4 mt-3 form-control  ">
                                                <div class="row">
                                                    <div class="col-12 col-lg-4">
                                                        <label for=""> Ancho (Pulg.)</label>
                                                        <input type="number" placeholder="Ingrese el ancho del margen"
                                                            class="form-control mt-2" id="arImAncho1">
                                                    </div>
                                                    <div class="col-12 col-lg-4">
                                                        <label for=""> Largo/Alto (Pulg.)</label>
                                                        <input type="number" placeholder="Ingrese el largo del margen"
                                                            class="form-control mt-2" id="arImLargo1">
                                                    </div>
                                                    <div class="col-12 col-lg-2">
                                                        <label for="cosImpresion">Costo Pie Cuadrado</label>
                                                        <input type="number" id="cosImpresion1"
                                                            class="form-control mt-2" disabled>
                                                    </div>
                                                    <div class="col-12 col-lg-2">
                                                        <label for="cosTotImpresion">Costo Total</label>
                                                        <input type="number" id="cosTotImpresion1"
                                                            class="form-control mt-2" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-none d-lg-block col-lg-8"></div>
                                        <div class="col-12 col-lg-4">
                                            <label for="cosTinta">Costo Tinta</label>
                                            <input type="text" id="cosTinta1" class="form-control mt-2" disabled>
                                        </div>
                                        <div class="col-12 py-2">
                                            <label class="mb-2">Area sobrante</label>
                                            <div class="gap-4 mt-3 form-control">
                                                <div class="row">
                                                    <div class="col-12 col-lg-4">
                                                        <label for=""> Ancho (Pulg.)</label>
                                                        <input type="number" placeholder="Ingrese el ancho del margen"
                                                            class="form-control mt-2" id="arSoAncho1">
                                                    </div>
                                                    <div class="col-12 col-lg-4">
                                                        <label for=""> Largo/Alto (Pulg.)</label>
                                                        <input type="number" placeholder="Ingrese el largo del margen"
                                                            class="form-control mt-2" id="arSoLargo1">
                                                    </div>
                                                    <div class="col-12 col-lg-2">
                                                        <label for="cosImpresion">Costo Pie Cuadrado</label>
                                                        <input type="text" id="cosSobrante1" class="form-control mt-2"
                                                            disabled>
                                                    </div>
                                                    <div class="col-12 col-lg-2">
                                                        <label for="cosTotImpresion">Costo Total</label>
                                                        <input type="text" id="cosTotSobrante1"
                                                            class="form-control mt-2" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 py-2">
                                            <label class="mb-2">Area desperdicio</label>
                                            <div class="gap-4 mt-3 form-control  ">
                                                <div class="row">
                                                    <div class="col-12 col-lg-4">
                                                        <label for=""> Ancho (Pulg.)</label>
                                                        <input type="number" placeholder="Ingrese el ancho del margen"
                                                            class="form-control mt-2" id="arDesAncho1">
                                                    </div>
                                                    <div class="col-12 col-lg-4">
                                                        <label for=""> Largo/Alto (Pulg.)</label>
                                                        <input type="number" placeholder="Ingrese el largo del margen"
                                                            class="form-control mt-2" id="arDesLargo1">
                                                    </div>
                                                    <div class="col-12 col-lg-2">
                                                        <label for="cosImpresion">Costo Pie Cuadrado</label>
                                                        <input type="text" id="cosDesperdicio1"
                                                            class="form-control mt-2" disabled>
                                                    </div>
                                                    <div class="col-12 col-lg-2">
                                                        <label for="cosTotImpresion">Costo Total</label>
                                                        <input type="text" id="cosTotDesperdicio1"
                                                            class="form-control mt-2" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-none d-lg-block col-lg-8"></div>
                                        <div class="col-12 col-lg-4">
                                            <label for="cosTinta">Costo total general</label>
                                            <input type="text" id="cosTotGeneral1" class="form-control mt-2" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div id="panel2"
                                    class="tablist__panel is-hidden p-3 border border-0 border-top bg-light rounded"
                                    aria-labelledby="tab2" aria-hidden="false" role="tabpanel">
                                    <div class="row">
                                        <div class="col-12 my-3">
                                            <label class="w-100 bg-light p-2 fs-5 fw-bold">Detalle</label>
                                        </div>
                                        <div class="col-10 col-lg-11 py-2 pe-0">
                                            <label for="material">Material</label>
                                            <span class="" onclick="showMaterial()">
                                                <input type="text" placeholder="Seleccione el material"
                                                    class="material form-select mt-2" readonly>
                                            </span>
                                            <input type="text" class="matId d-none">
                                        </div>
                                        <div class="col-2 col-lg-1 py-2">
                                            <button id="btnLimpiar2"
                                                class="btn btn-danger w-100 fw-bold text-white mt-4 fs-4 p-0"><i
                                                    class="fa-solid fa-delete-left"></i></button>
                                        </div>
                                        <div class="col-12 py-2">
                                            <label class="mb-2">Area Impresión</label>
                                            <div class="gap-4 mt-3 form-control  ">
                                                <div class="row">
                                                    <div class="col-12 col-lg-4">
                                                        <label for=""> Ancho (Pulg.)</label>
                                                        <input type="number" placeholder="Ingrese el ancho del margen"
                                                            class="form-control mt-2" id="arImAncho2">
                                                    </div>
                                                    <div class="col-12 col-lg-4">
                                                        <label for=""> Largo/Alto (Pulg.)</label>
                                                        <input type="number" placeholder="Ingrese el largo del margen"
                                                            class="form-control mt-2" id="arImLargo2">
                                                    </div>
                                                    <div class="col-12 col-lg-4">
                                                        <label for="cosTotImpresion">Costo Total</label>
                                                        <input type="text" id="cosTotImpresion2"
                                                            class="form-control mt-2">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
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
                            <label for="inputFile" class="d-none" id="lblFoto">Fotografía</label>
                            <div class="w-100 d-flex justify-content-center" id="divFoto">

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="d-flex gap-3 justify-content-between d-none" id="divButtons">
                                <button
                                    class="btn btn-secondary w-100 mt-3 d-flex justify-content-center gap-2 text-white fw-bold"
                                    onclick="limpiar()">
                                    <div><i class="fa-solid fa-pen"></i></div>
                                    <div><span>Limpiar</span></div>
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
                            <button onclick="saveConsumo()"
                                class="btn btn-primary w-100 mt-3 d-flex justify-content-center gap-2 text-white fw-bold">
                                <div><i class="fa-solid fa-floppy-disk"></i></div>
                                <div><span>Grabar</span></div>
                            </button>
                            <button onclick="showConsumos()"
                                class="btn btn-dark w-100 mt-3 d-flex justify-content-center gap-2 text-white fw-bold">
                                <div><i class="fa-solid fa-clipboard-list"></i></div>
                                <div><span>Llamar consumo</span></div>
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
                                    <th class="text-black text-start">Tipo</th>
                                    <th class="text-black text-start">Código</th>
                                    <th class="text-black text-start">Descripción</th>
                                    <th class="text-black text-start">Fecha</th>
                                    <th class="text-black text-start">Existencia</th>
                                    <th class="text-black text-start">Cost./Unit.</th>
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
    <div class="modal fade" id="modalConsumos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>

                    <button type="button" class="btn-close" onclick="$('#modalConsumos').modal('hide')"></button>
                </div>
                <div class="modal-body">
                    <div class="table-container mt-3">
                        <table id="tbConsumo" class="table stripe table-hover " style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-black text-start">Transacción</th>
                                    <th class="text-black text-start">Cliente</th>
                                    <th class="text-black text-end">Pies cuadrados</th>
                                    <th class="text-black text-end">Costo total</th>
                                    <th class="d-none"></th>
                                </tr>
                            </thead>
                            <tbody id="tbConsumoBody">
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
        let tableConsu = null;
        let ccostot;
        document.addEventListener('DOMContentLoaded', function () {
            fetch('/API.LovablePHP/ZLO0052P/CostTinta')
                .then(response => response.json())
                .then(data => {
                    if (data.code == 200) {
                        ccostot = parseFloat(data.data[0].COSTOT) / parseFloat(data.data[0].PCULIT);
                    }
                })

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

            //ORDENES ACTIVAS
            fetch('/API.LovablePHP/ZLO0050P/FechaProceso')
                .then(response => response.json())
                .then(data => {
                    if (data.code == 200) {
                        $("#ano").val(data.data[0].ANOPRO);
                        $("#mes").val(data.data[0].MESPRO);
                        $("#fectra").val(`${data.data[0].ANOPRO}-${data.data[0].MESPRO}-01`);
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
                            "url": "/API.LovablePHP/ZLO0052P/ListOrdenes",
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
                    //MATERIAL
                    $('#tbMaterial thead th').each(function (index) {
                        var title = $(this).text();

                        if (index == 3) {
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
                    const tableMat = $('#tbMaterial').DataTable({
                        "language": {
                            "url": 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                        },
                        "pageLength": 10,
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            "url": "/API.LovablePHP/ZLO0052P/ListMaterial",
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
                            { "width": "10%", "targets": 0, "orderable": false },
                            { "width": "10%", "targets": 1, "orderable": false },
                            { "width": "30.2%", "targets": 2, "orderable": false },
                            { "width": "16.6%", "targets": 3, "orderable": false },
                            { "width": "16.6%", "targets": 4, "orderable": false },
                            { "width": "16.6%", "targets": 5, "orderable": false }
                        ],
                        "columns": [
                            {
                                "data": "TIPMAT",
                            },
                            {
                                "data": "NUMMAT",
                            },
                            {
                                "data": "MAED48",
                            },
                            {
                                "data": null,
                                "render": function (data, type, row) {
                                    return formatFecha(row.FECMAT);
                                }
                            },
                            {
                                "data": null,
                                "render": function (data, type, row) {
                                    return row.SALPCU == 0 ? " " : parseFloat(row.SALPCU);
                                }
                            },
                            {
                                "data": null,
                                "render": function (data, type, row) {
                                    return row.PREPCU == 0 ? " " : parseFloat(row.PREPCU);
                                }
                            },
                        ],

                        "drawCallback": function () {
                            $('#tbMaterial tbody tr').on('click', function () {
                                sendMaterial(this);
                            });
                        }
                    });
                    $('#tbMaterial thead').on('keyup change', 'input.column-search', function () {
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
                        $(".material").val("");
                        $("#matId").val("");
                        $("#cosMaterial").val("");
                        $("#cosTotImpresion1").val("").trigger('change');
                        $("#cosTotSobrante1").val("").trigger('change');
                        $("#cosTotDesperdicio1").val("").trigger('change');
                    });

                    //CONSUMOS

                    $('#tbConsumo thead th').each(function () {
                        var title = $(this).text();
                        $(this).html(title +
                            '<br /><input type="text"  oninput="this.value = this.value.toUpperCase()" class="form-control mt-2"/>'
                        );
                    });
                    tableConsu = $('#tbConsumo').DataTable({
                        "language": {
                            "url": 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                        },
                        "pageLength": 15,
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            "url": "/API.LovablePHP/ZLO0052P/ListConsumo",
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
                                    "order": d.order,

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
                            { "width": "50%", "targets": 1, "orderable": false },
                            { "width": "20%", "targets": 2, "orderable": false, "class": "text-end" },
                            { "width": "20%", "targets": 3, "orderable": false, "class": "text-end" },
                            { "width": "0%", "targets": 4, "orderable": false, "class": "d-none" },
                        ],
                        "columns": [
                            {
                                "data": "NUMTRA",
                            },
                            {
                                "data": "MAENO4",
                            },
                            {
                                "data": "PCUAIM"
                            },
                            {
                                "data": "COSAIM"
                            },
                            {
                                "data": "NUMORD"
                            }
                        ],

                        "drawCallback": function () {
                            $('#tbConsumo tbody tr').on('click', function () {
                                sendConsumo(this);
                            });
                        }
                    });
                    $('#tbConsumo thead input').on('keyup', function () {
                        var columnIndex = $(this).parent().index();
                        var inputValue = $(this).val().trim();

                        if (tableConsu.column(columnIndex).search() !== inputValue) {
                            tableConsu
                                .column(columnIndex)
                                .search(inputValue)
                                .draw();
                        }
                    });


                })
                .catch(error => console.error(error));
            $("#numord").on('input', function () {
                limpiar()
                if (($(this).val()).length == 9) {
                    const ano = $(this).val().substring(0, 2);
                    const mes = $(this).val().substring(2, 4);
                    fetchConsumo({
                        'anopro': `20${ano}`,
                        'mespro': mes,
                        'numtra': $("#transa").val(),
                        'orden': $(this).val()
                    })
                }
            });
            $("#arImAncho1, #arImLargo1").on('input', function () {
                if ($("#arImAncho1").val() != "" && $("#arImLargo1").val() != "") {
                    const ancho = parseFloat($("#arImAncho1").val());
                    const largo = parseFloat($("#arImLargo1").val());
                    const total = (Math.floor(((ancho * largo) / 144) * 100) / 100).toFixed(2);
                    const costo = $("#cosMaterial").val() == "" ? 0 : parseFloat($("#cosMaterial").val());
                    const costoTotal = parseFloat(total) * costo;
                    $("#cosImpresion1").val(total);
                    const costinta = parseFloat(ccostot) * parseFloat(total);
                    $("#cosTinta1").val(costinta.toFixed(6));
                    if (costo != "") {
                        $("#cosTotImpresion1").val(costoTotal.toFixed(6)).trigger('change');
                    } else {
                        $("#cosTotImpresion1").val("").trigger('change');
                    }
                } else {
                    $("#cosImpresion1").val("");
                    $("#cosTotImpresion1").val("").trigger('change');
                }
            });
            $("#arSoAncho1, #arSoLargo1").on('input', function () {
                if ($("#arSoAncho1").val() != "" && $("#arSoLargo1").val() != "") {
                    const ancho = parseFloat($("#arSoAncho1").val());
                    const largo = parseFloat($("#arSoLargo1").val());
                    const total = (Math.floor(((ancho * largo) / 144) * 100) / 100).toFixed(2);
                    const costo = $("#cosMaterial").val() == "" ? 0 : parseFloat($("#cosMaterial").val());
                    const costoTotal = parseFloat(total) * costo;
                    $("#cosSobrante1").val(total);
                    if (costo != "") {
                        $("#cosTotSobrante1").val(costoTotal.toFixed(6)).trigger('change');
                    } else {
                        $("#cosTotSobrante1").val("").trigger('change');
                    }
                } else {
                    $("#cosSobrante1").val("");
                    $("#cosTotSobrante1").val("").trigger('change');
                }
            });
            $("#arDesAncho1, #arDesLargo1").on('input', function () {
                if ($("#arDesAncho1").val() != "" && $("#arDesLargo1").val() != "") {
                    const ancho = parseFloat($("#arDesAncho1").val());
                    const largo = parseFloat($("#arDesLargo1").val());
                    const total = (Math.floor(((ancho * largo) / 144) * 100) / 100).toFixed(2);
                    const costo = $("#cosMaterial").val() == "" ? 0 : parseFloat($("#cosMaterial").val());
                    const costoTotal = parseFloat(total) * costo;
                    $("#cosDesperdicio1").val(total);
                    if (costo != "") {
                        $("#cosTotDesperdicio1").val(costoTotal.toFixed(6)).trigger('change');
                    } else {
                        $("#cosTotDesperdicio1").val("").trigger('change');
                    }
                } else {
                    $("#cosDesperdicio1").val("");
                    $("#cosTotDesperdicio1").val("").trigger('change');
                }
            });

            $("#cantidad, #cosTotImpresion1, #cosTinta1,#cosTotDesperdicio1").on('input change', function () {
                const costImpresion = $("#cosTotImpresion1").val() == "" ? 0 : parseFloat($("#cosTotImpresion1").val());
                const costTinta = $("#cosTinta1").val() == "" ? 0 : parseFloat($("#cosTinta1").val());
                const costDesperdicio = $("#cosTotDesperdicio1").val() == "" ? 0 : parseFloat($("#cosTotDesperdicio1").val());
                const cantidad = $("#cantidad").val() == "" ? 0 : parseFloat($("#cantidad").val());
                const total = (
                    costImpresion + costTinta + costDesperdicio
                ) * cantidad;
                if (cantidad != 0 && total != 0) {
                    $("#cosTotGeneral1").val(total.toFixed(6));
                } else {
                    $("#cosTotGeneral1").val("");
                }

            });
            $("#btnEliminar").on('click', () => {
                const ano = $("#ano").val();
                const mes = $("#mes").val();
                const numtra = $("#transa").val();
                Swal.fire({
                    title: '¿Está seguro de eliminar el consumo?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('/API.LovablePHP/ZLO0052P/DeleteConsumo', {
                            "method": 'POST',
                            "headers": {
                                'Content-Type': 'application/json'
                            },
                            'body': JSON.stringify({
                                'anopro': ano,
                                'mespro': mes,
                                'numtra': numtra
                            })
                        })
                            .then(response => response.json())
                            .then(data => {
                                limpiar();
                                tableConsu.ajax.reload();
                                Swal.fire(
                                    'Realizado',
                                    'El consumo ha sido eliminado.',
                                    'success'
                                )
                            })
                    }
                })
            });
        });
        function limpiar() {
            $("#transa").val("");
            //$("#numord").val("");
            const t = new Date();
            const y = t.getFullYear();
            const m = (t.getMonth() + 1).toString().padStart(2, '0');
            const d = t.getDate().toString().padStart(2, '0');
            $("#fectra").val(`${y}-${m}-${d}`);

            $("#cliente").val("");
            $("#clieId").val("");
            $("#ciudad").val("");
            $("#ciuId").val("");
            $(".material").val("");
            $(".matId").val("");
            $("#arImAncho1").val("");
            $("#arImAncho2").val("");
            $("#arImLargo1").val("");
            $("#arImLargo2").val("");
            $("#cosMaterial").val("");
            $("#cosImpresion1").val("");
            $("#cosTotImpresion1").val("").trigger('change');
            $("#cosTotImpresion2").val("").trigger('change');
            $("#cosSobrante1").val("");
            $("#cosTotSobrante1").val("").trigger('change');
            $("#cosDesperdicio1").val("");
            $("#cosTotDesperdicio1").val("").trigger('change');
            $("#arSoAncho1").val("");
            $("#arSoLargo1").val("");
            $("#arDesAncho1").val("");
            $("#arDesLargo1").val("");
            $("#cosTinta1").val("");
            $("#cantidad").val("").trigger('change');
            $("#descrp").val("");
            $("#lblFoto").addClass('d-none');
            $("#divFoto").empty();
            $(".ckTipo").each(function () {
                $(this).prop('checked', false);
            });
            $("#divButtons").addClass('d-none');
        }
        function showConsumos() {
            $("#modalConsumos").modal('show');
        }
        function sendConsumo(row) {
            const tr = $(row).closest('tr');
            const tds = tr.find('td');
            const transa = tds.eq(0).text();
            const orden = tds.eq(4).text();
            const ano = $("#ano").val();
            const mes = $("#mes").val();
            limpiar()
            fetchConsumo({
                'anopro': ano,
                'mespro': mes,
                'numtra': transa,
                'orden': orden
            })
            $("#transa").val(transa);

            $("#modalConsumos").modal('hide');
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
            const matTip = tds.eq(0).text();
            const matId = tds.eq(1).text();
            const matDes = tds.eq(2).text();
            const costo = tds.eq(5).text();
            $(".matId").val(matId);
            $(".material").val(`${matTip} ${matId}  ${matDes}`);
            $("#cosMaterial").val(costo);
            if ($("#arImAncho1").val() != "" && $("#arImLargo1").val() != "") {
                const ancho = parseFloat($("#arImAncho1").val());
                const largo = parseFloat($("#arImLargo1").val());
                const total = (Math.floor(((ancho * largo) / 144) * 100) / 100).toFixed(2);
                const costoTotal = parseFloat(total) * costo;
                $("#cosImpresion1").val(total);
                if (costo != "") {
                    $("#cosTotImpresion1").val(costoTotal.toFixed(6)).trigger('change');
                } else {
                    $("#cosTotImpresion1").val("").trigger('change');
                }
            } else {
                $("#cosImpresion1").val("");
                $("#cosTotImpresion1").val("").trigger('change');
            }
            if ($("#arSoAncho1").val() != "" && $("#arSoLargo1").val() != "") {
                const ancho = parseFloat($("#arSoAncho1").val());
                const largo = parseFloat($("#arSoLargo1").val());
                const total = (Math.floor(((ancho * largo) / 144) * 100) / 100).toFixed(2);
                const costoTotal = parseFloat(total) * costo;
                $("#cosSobrante1").val(total);
                if (costo != "") {
                    $("#cosTotSobrante1").val(costoTotal.toFixed(6)).trigger('change');
                } else {
                    $("#cosTotSobrante1").val("").trigger('change');
                }
            } else {
                $("#cosSobrante1").val("");
                $("#cosTotSobrante1").val("").trigger('change');
            }

            if ($("#arDesAncho1").val() != "" && $("#arDesLargo1").val() != "") {
                const ancho = parseFloat($("#arDesAncho1").val());
                const largo = parseFloat($("#arDesLargo1").val());
                const total = (Math.floor(((ancho * largo) / 144) * 100) / 100).toFixed(2);
                const costoTotal = parseFloat(total) * costo;
                $("#cosDesperdicio1").val(total);
                if (costo != "") {
                    $("#cosTotDesperdicio1").val(costoTotal.toFixed(6)).trigger('change');
                } else {
                    $("#cosTotDesperdicio1").val("").trigger('change');
                }
            } else {
                $("#cosDesperdicio1").val("");
                $("#cosTotDesperdicio1").val("").trigger('change');
            }
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
            const numtra = $("#transa").val();
            const orden = tds.eq(0).text();
            if (ano != "" && mes != "") {
                fetchConsumo({
                    'anopro': ano,
                    'mespro': mes,
                    'numtra': numtra,
                    'orden': orden
                })
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
        function fetchConsumo(sendData) {
            fetch('/API.LovablePHP/ZLO0052P/FindConsumo', {
                "method": 'POST',
                "headers": {
                    'Content-Type': 'application/json'
                },
                'body': JSON.stringify(sendData)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.code == 200) {
                        $("#divButtons").removeClass('d-none');
                        const dataOrder = data.data[0];
                        $("#fectra").val(formatFecha2(dataOrder.FECTRA));
                        $("#numord").val(dataOrder.ORDEN);
                        $("#cliente").val(`${dataOrder.CLIENTE}`);
                        $("#clieId").val(`${dataOrder.CODCL1}-${dataOrder.CODCL2}`);
                        $("#ciudad").val(dataOrder.CIUDES);
                        $("#ciuId").val(`${dataOrder.CODPAI}-${dataOrder.CODCIU}`);
                        $(".ckTipo").each(function () {
                            if ($(this).val() == dataOrder.TIPIMP) {
                                $(this).prop('checked', true);
                            }
                        });
                        $("#cantidad").val(dataOrder.CANTID).trigger('change');
                        $("#divFoto").empty();
                        $("#lblFoto").addClass('d-none');
                        $("#numord").val(dataOrder.NUMORD);
                        $("#descrp").val(dataOrder.DESCRLRG);
                        $(".material").val(`${dataOrder.MATERIAL}`);
                        $(".matId").val(dataOrder.NUMMAT);
                        $("#cosMaterial").val(dataOrder.PPCAIM);
                        $("#arImAncho1").val(dataOrder.ANCAIM);
                        $("#arImLargo1").val(dataOrder.LARAIM);
                        $("#arImAncho2").val(dataOrder.ANCAIM);
                        $("#arImLargo2").val(dataOrder.LARAIM);
                        $("#cosImpresion1").val(dataOrder.PCUAIM);
                        $("#cosTotImpresion1").val(dataOrder.COSAIM);
                        $("#cosTotImpresion2").val(dataOrder.COSAIM);
                        $("#cosTinta1").val(dataOrder.COSTIN);
                        $("#arSoAncho1").val(dataOrder.ANCASO);
                        $("#arSoLargo1").val(dataOrder.LARASO);
                        $("#cosSobrante1").val(dataOrder.PCUASO);
                        $("#cosTotSobrante1").val(dataOrder.COSASO);
                        $("#arDesAncho1").val(dataOrder.ANCADE);
                        $("#arDesLargo1").val(dataOrder.LARADE);
                        $("#cosDesperdicio1").val(dataOrder.PCUADE);
                        $("#cosTotDesperdicio1").val(dataOrder.COSADE);
                        $("#cantidad").val(dataOrder.CANTID).trigger('change');
                        if (dataOrder.PCUAIM == 0 && dataOrder.COSAIM != 0) {
                            $("#tab2").click();
                        } else {
                            $("#tab1").click();
                        }
                    }
                })
        }
        function saveConsumo() {
            const ano = $("#ano").val();
            const mes = $("#mes").val();
            const numtra = $("#transa").val();
            const orden = $("#numord").val();
            const fectra = $("#fectra").val();
            const tipimp = $(".ckTipo:checked").val();
            const clieId = $("#clieId").val();
            const ciudad = $("#ciuId").val();
            const material = $(".matId").val();
            const cantidad = $("#cantidad").val();
            const descrp = $("#descrp").val();
            const arImAncho2 = $("#arImAncho2").val();
            const arImLargo2 = $("#arImLargo2").val();
            const cosTotImpresion2 = $("#cosTotImpresion2").val();
            const arImAncho1 = $("#arImAncho1").val();
            const arImLargo1 = $("#arImLargo1").val();
            const arSoAncho1 = $("#arSoAncho1").val();
            const arSoLargo1 = $("#arSoLargo1").val();
            const arDesAncho1 = $("#arDesAncho1").val();
            const arDesLargo1 = $("#arDesLargo1").val();
            const cosMaterial = $("#cosMaterial").val();
            const cosImpresion1 = $("#cosImpresion1").val();
            const cosTotImpresion1 = $("#cosTotImpresion1").val();
            const cosTinta = $("#cosTinta1").val();
            const cosSobrante1 = $("#cosSobrante1").val();
            const cosTotSobrante1 = $("#cosTotSobrante1").val();
            const cosDesperdicio1 = $("#cosDesperdicio1").val();
            const cosTotDesperdicio1 = $("#cosTotDesperdicio1").val();
            const cosTotGeneral1 = $("#cosTotGeneral1").val();
            const anoval = parseInt(fectra.substring(0, 4))
            const mesval = parseInt(fectra.substring(7, 5))
            if (parseInt(ano) != anoval && parseInt(mes) != mesval) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "La fecha es inválida.",
                });
            } else if (ano == "" || mes == "" || fectra == "" || tipimp == "" || clieId == "" || ciudad == "" || material == "" || cantidad == "") {
                console.log(anoval, mesval)
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "Faltan campos por llenar.",
                });
                return;
            }
            let sendData = [];
            $(".tablist__tab").each(function () {
                if ($(this).attr("aria-selected") === "true") {
                    const activeTab = $(this).attr("id");
                    if (activeTab === "tab1") {
                        sendData = {
                            'anopro': ano,
                            'mespro': mes,
                            'numtra': numtra,
                            'orden': orden,
                            'fectra': fectra,
                            'tipimp': tipimp,
                            'codcli': clieId,
                            'ciudad': ciudad,
                            'material': material,
                            'cantidad': cantidad,
                            'descrp': descrp,
                            'arImAncho1': arImAncho1,
                            'arImLargo1': arImLargo1,
                            'arSoAncho1': arSoAncho1,
                            'arSoLargo1': arSoLargo1,
                            'arDesAncho1': arDesAncho1,
                            'arDesLargo1': arDesLargo1,
                            'cosMaterial': cosMaterial,
                            'cosImpresion1': cosImpresion1,
                            'cosTotImpresion1': cosTotImpresion1,
                            'cosTinta': cosTinta,
                            'cosSobrante1': cosSobrante1,
                            'cosTotSobrante1': cosTotSobrante1,
                            'cosDesperdicio1': cosDesperdicio1,
                            'cosTotDesperdicio1': cosTotDesperdicio1,
                            'cosTotGeneral1': cosTotGeneral1,
                            'usugra': usuario
                        };
                    } else if (activeTab === "tab2") {
                        sendData = {
                            'anopro': ano,
                            'mespro': mes,
                            'numtra': numtra,
                            'orden': orden,
                            'fectra': fectra,
                            'tipimp': tipimp,
                            'codcli': clieId,
                            'ciudad': ciudad,
                            'material': material,
                            'cantidad': cantidad,
                            'descrp': descrp,
                            'arImAncho2': arImAncho2,
                            'arImLargo2': arImLargo2,
                            'cosTotImpresion2': cosTotImpresion2,
                            'usugra': usuario
                        };
                    }
                }
            });
            console.log(JSON.stringify(sendData))
            fetch('/API.LovablePHP/ZLO0052P/SaveConsumo', {
                "method": 'POST',
                "headers": {
                    'Content-Type': 'application/json'
                },
                'body': JSON.stringify(sendData)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.code == 200) {
                        tableConsu.ajax.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Guardado',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        limpiar()
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message,
                        });
                    }
                })
        }
    </script>
</body>

</html>