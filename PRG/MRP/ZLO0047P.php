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

        .align-middle {
            align-items: center !important;
        }

        .fs-10 {
            font-size: 12px;
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
                    <span>Consultas / Trazabilidad de ordenes</span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0047P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="flex-grow-1 bg-white">
        <div id="loaderScreen">
            <div class="position-absolute top-50 start-50">
                <i class="fa-solid fa-gear fa-spin text-white" style="font-size:200px;"></i>
            </div>
        </div>
        <div class="mx-h bg-white table-responsive px-3">
            <div class="d-flex justify-content-between">
                <div>
                    <h6 class="mt-3"><b>**Clic sobre la flecha para ver el detalle**</b></h6>
                </div>
                <div>
                    <button data-bs-toggle="modal" data-bs-target="#filterModal"
                        class="btn btn-secondary text-white fw-bold mt-2" style="width: 150px;">
                        <i class="fa-solid fa-sliders"></i>
                        Filtro</button>
                </div>
            </div>
            <table class="table stripe table-hover" id="table">
                <thead class="sticky-top bg-white">
                    <tr>
                        <th></th>
                        <th>Orden</th>
                        <th>Incoterm</th>
                        <th>Proveedor</th>
                        <th>País</th>
                        <th>Fecha</th>
                        <th>Valor</th>
                        <th>Días pend. entrega</th>
                        <th>Lead time Real</th>
                        <th>% Recibido</th>
                        <th>Pagos Realizados</th>
                        <th>% Pagado</th>
                        <th>Días demora</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    </div>
    <div class="footer bg-blck flex-grow-1 d-flex justify-content-center mt-2">
        <p class="bggray responsive-font-example"><i>Lovable de Honduras S.A. de C.V</i></p>
    </div>
    </div>
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="filterModalLabel">Filtro</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <div class="row align-middle">
                                <div class="col-12 col-lg-3">
                                    <label class="py-1">Aplicación</label>
                                </div>
                                <div class="col-12 col-lg-9">
                                    <select class="form-select" id="cbbApl">
                                        <option value="T">Todos</option>
                                        <option value="MRP" selected>MRP</option>
                                        <option value="INC">INC</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="row align-middle">
                                <div class="col-12 col-lg-3">
                                    <label class="py-1">Año</label>
                                </div>
                                <div class="col-12 col-lg-9">
                                    <select id="cbbAno" class="form-select">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="row align-middle">
                                <div class="col-12 col-lg-3">
                                    <label class="py-1">Proveedor</label>
                                </div>
                                <div class="col-12 col-lg-9">
                                    <select class="form-select" id="cbbProv">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="row align-middle">
                                <div class="col-12 col-lg-3">
                                    <label class="py-1" for="ckLeadti">Leadtime negativo</label>
                                </div>
                                <div class="col-12 col-lg-9">
                                    <div class="form-check form-switch fs-4">
                                        <input class="form-check-input" type="checkbox" role="switch" id="ckLeadti">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="row align-middle">
                                <div class="col-12 col-lg-3">
                                    <label class="py-1">Días Credito >=</label>
                                </div>
                                <div class="col-12 col-lg-9">
                                    <input id="txtDiCre" type="number" class="form-control"
                                        placeholder="Escribe los días de credito">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="row align-middle">
                                <div class="col-12 col-lg-3">
                                    <label class="py-1">Estado</label>
                                </div>
                                <div class="col-12 col-lg-9">
                                    <select class="form-select" id="cbbEstado">
                                        <option value="T">Todos</option>
                                        <option value="A">Activas</option>
                                        <option value="E">Anuladas</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="row align-middle">
                                <div class="col-12 col-lg-3">
                                    <label class="py-1">País</label>
                                </div>
                                <div class="col-12 col-lg-9">
                                    <select class="form-select" id="cbbPais">
                                        <option value="0">Todos</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="row align-middle">
                                <div class="col-12 col-lg-3">
                                    <label class="py-1">Incoterm</label>
                                </div>
                                <div class="col-12 col-lg-9">
                                    <select class="form-select" id="cbbIncoterm">
                                        <option value="T">Todos</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 py-2">
                            <hr>
                        </div>
                        <div class="col-12 col-lg-6 mb-2">
                            <div class="row">
                                <div class="col-12 d-flex gap-3 mb-4">
                                    <label class="py-1">Buscar Factura</label>
                                    <input type="text" class="form-control" placeholder="Escribe una factura"
                                        id="txtFactura">
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <label class="form-check-label mt-1" for="ck1">
                                            Ordenes No Digitalizadas
                                        </label>
                                        <input class="form-check-input" type="checkbox" value="" id="ck1">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <label class="form-check-label mt-1" for="ck2">
                                            Ordenes Pendientes Grabar Factura
                                        </label>
                                        <input class="form-check-input" type="checkbox" value="" id="ck2">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <label class="form-check-label mt-1" for="ck3">
                                            Ordenes Factura Grabadas sin Digitalizar
                                        </label>
                                        <input class="form-check-input" type="checkbox" value="" id="ck3">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <label class="form-check-label mt-1" for="ck4">
                                            Ordenes Facturas Grabadas sin Aprobar
                                        </label>
                                        <input class="form-check-input" type="checkbox" value="" id="ck4">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <label class="form-check-label mt-1" for="ck5">
                                            Ordenes Facturas sin Aprobacion Finanzas
                                        </label>
                                        <input class="form-check-input" type="checkbox" value="" id="ck5">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <label class="form-check-label mt-1" for="ck6">
                                            Ordenes Facturas sin Coordinacion
                                        </label>
                                        <input class="form-check-input" type="checkbox" value="" id="ck6">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mb-2">
                            <div class="row">
                                <div class="col-12 d-flex gap-3 mb-4">
                                    <label class="py-1">Ordenes con Nacionalización</label>
                                    <select class="form-select" id="cbbNacio">
                                        <option value="T">Todos</option>
                                        <option value="1">Solo estimadas</option>
                                        <option value="2">Real</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <label class="form-check-label mt-1" for="ck7">
                                            Ordenes Proveedor sin Dias LeadTime
                                        </label>
                                        <input class="form-check-input" type="checkbox" value="" id="ck7">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <label class="form-check-label mt-1" for="ck8">
                                            Ordenes con Pagos Pendientes
                                        </label>
                                        <input class="form-check-input" type="checkbox" value="" id="ck8">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <label class="form-check-label mt-1" for="ck9">
                                            Ordenes con Pagos Vencidos
                                        </label>
                                        <input class="form-check-input" type="checkbox" value="" id="ck9">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <label class="form-check-label mt-1" for="ck10">
                                            Ordenes Digitalizadas
                                        </label>
                                        <input class="form-check-input" type="checkbox" value="" id="ck10">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <label class="form-check-label mt-1" for="ck11">
                                            Ordenes con Factura Digitalizada
                                        </label>
                                        <input class="form-check-input" type="checkbox" value="" id="ck11">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <label class="form-check-label mt-1" for="ck12">
                                            Ordenes Pendientes de Venir
                                        </label>
                                        <input class="form-check-input" type="checkbox" value="" id="ck12">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close"
                        id="btnAplicar">Aplicar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        const cbbAno = document.getElementById('cbbAno');
        const cbbApl = document.getElementById('cbbApl');
        const cbbProv = document.getElementById('cbbProv');
        const ckLeadti = document.getElementById('ckLeadti');
        const txtDiCre = document.getElementById('txtDiCre');
        const cbbEstado = document.getElementById('cbbEstado');
        const cbbPais = document.getElementById('cbbPais');
        const cbbIncoterm = document.getElementById('cbbIncoterm');
        const txtFactura = document.getElementById('txtFactura');
        const ck1 = document.getElementById('ck1');
        const ck2 = document.getElementById('ck2');
        const ck3 = document.getElementById('ck3');
        const ck4 = document.getElementById('ck4');
        const ck5 = document.getElementById('ck5');
        const ck6 = document.getElementById('ck6');
        const ck7 = document.getElementById('ck7');
        const ck8 = document.getElementById('ck8');
        const ck9 = document.getElementById('ck9');
        const ck10 = document.getElementById('ck10');
        const ck11 = document.getElementById('ck11');
        const ck12 = document.getElementById('ck12');
        const cbbNacio = document.getElementById('cbbNacio');
        const currentYear = new Date().getFullYear();
        let cont = 0;
        let retryRequest = false;
        let dStart = 0;
        cbbAno.innerHTML = '<option value="0" selected>Todos los años</option>';
        for (var year = currentYear; year >= currentYear - 4; year--) {
            var option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            cbbAno.appendChild(option);
        }
        cbbAno.value = currentYear;
        document.getElementById('btnAplicar').addEventListener('click', function () {
            retryRequest = false;
            cont = 0;
            table.ajax.reload();
        });
        async function format(d) {
            const dig = (d.FECDIG != '' && d.FECDIG != 0) ? ` <td class="text-center">${formatFecha(d.FECDIG)}</td>
                                    <td class="text-center">${diferenciaDias(d.FECORD, d.FECDIG)}</td>`
                : `<td colspan="2" class="text-center">No hay digitalización</td>`;
            const fac = (d.FECAPRFAC != '' && d.FECAPRFAC != 0) ? ` <td class="text-center">${formatFecha(d.FECAPRFAC)}</td>
                                    <td class="text-center">${diferenciaDias(d.FECORD, d.FECAPRFAC)}</td>`
                : `<td colspan="2" class="text-center">No hay aprobación de factura</td>`;
            const fin = (d.FECAPRFIN != '' && d.FECAPRFIN != 0) != '' ? ` <td class="text-center">${formatFecha(d.FECAPRFIN)}</td>
                                    <td class="text-center">${diferenciaDias(d.FECORD, d.FECAPRFIN)}</td>`
                : `<td colspan="2" class="text-center">No hay aprobación de finanzas</td>`;

            const encabezados = `<div class="col-4">
                            <h5 class="text-center">Digitalización</h5>
                            <table class="table table-bordered bg-white">
                                <thead>
                                    <tr>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Días</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>${dig}</tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-4">
                            <h5 class="text-center">Aprobación Factura</h5>
                            <table class="table table-bordered bg-white">
                                <thead>
                                    <tr>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Días</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>${fac}</tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-4">
                            <h5 class="text-center">Aprobación Finanzas</h5>
                            <table class="table table-bordered bg-white">
                                <thead>
                                    <tr>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Días</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>${fin}</tr>
                                </tbody>
                            </table>
                        </div>`;

            try {
                const response = await fetch('/API.LovablePHP/ZLO0047P/ListNac', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ "ord": d.ORDCOM })
                });

                const data = await response.json();

                if (data.code == 200) {

                    let table = '';
                    data.data.forEach((row) => {
                        const dataRes = row;
                        const difDiasSal = diferenciaDias(dataRes.FECORI, dataRes.FECOR1);
                        const difDiasLle = diferenciaDias(dataRes.FECLLE, dataRes.FECLL1);
                        const difDiasLov = diferenciaDias(dataRes.FECARR, dataRes.FECAR1);
                        const difDiasCoo = parseInt(dataRes.DIACOR) - parseInt(dataRes.DIACO1);
                        const difDiasTran = parseInt(dataRes.DIATRA) - parseInt(dataRes.DIATR1);
                        const difDiasPuer = parseInt(dataRes.DIAPUE) - parseInt(dataRes.DIAPU1);
                        const difDiasImp = parseInt(dataRes.LEADTI) - parseInt(dataRes.LEADT1);
                        table += `<table class="table border bg-white">
                                    <thead>
                                        <tr style="border: 0px solid transparent !important;">
                                            <th style="width:16%; padding: 0px;"></th>
                                            <th style="width:28%; padding: 0px;"></th>
                                            <th style="width:28%; padding: 0px;"></th>
                                            <th style="width:28%; padding: 0px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td colspan="1" class="text-start fw-bold">Factura:</td><td colspan="3"><div><span class="me-4">${dataRes.FACTUR}</span><span class="text-darkblue text-uppercase">${dataRes.TIPFAC == 2 ? 'Factura final' : 'Proforma'}</span></div></td></tr>
                                        <tr><td colspan="1" class="text-start fw-bold">Tipo Embarque:</td><td colspan="3" class="text-start">${dataRes.TIPEMB} ${dataRes.EMBDESC}</td></tr>
                                        <tr><td colspan="1" class="text-start fw-bold">Via Embarque:</td><td colspan="3" class="text-start">${dataRes.VIA} ${dataRes.VIADESC}</td></tr>
                                        <tr><td colspan="1" class="text-start fw-bold">Naviera:</td><td colspan="3" class="text-start">${dataRes.NAVIER} ${dataRes.NAVIERDESC}</td></tr>
                                    <tr>
                                                 <td colspan="1"></td>
                                                 <td colspan="1" class="text-center fw-bold text-uppercase" style="border-right: 1px solid black;" >e s t i m a d o</td>
                                                 <td colspan="1" class="text-center fw-bold text-uppercase" style="border-right: 1px solid black;"> r e a l</td>
                                                 <td colspan="1" class="text-center fw-bold text-uppercase"> d i f e r e n c i a</td>
                                         </tr>
                                         <tr>
                                                 <td colspan="1" class="text-start fw-bold py-3 align-middle" >Fecha Salida Origen:</td>
                                                 <td colspan="1" class="text-center fw-bold py-3 align-middle" style="border-right: 1px solid black;">${formatFecha(dataRes.FECORI)}</td>  
                                                 <td colspan="1" class="text-center fw-bold py-3 align-middle" style="border-right: 1px solid black;">${formatFecha(dataRes.FECOR1)}</td>             
                                                 <td colspan="1" class="text-center fw-bold py-3 align-middle">${difDiasSal == 0 ? "" : difDiasSal}</span></td>   
                                         </tr>
                                         <tr>
                                                 <td colspan="1" class="text-start fw-bold py-3 align-middle">Fecha Llegada Puerto:</td>
                                                 <td colspan="1" class="text-center fw-bold py-3 align-middle" style="border-right: 1px solid black;">${formatFecha(dataRes.FECLLE)}</td>  
                                                 <td colspan="1" class="text-center fw-bold py-3 align-middle" style="border-right: 1px solid black;">${formatFecha(dataRes.FECLL1)}</td>    
                                                 <td colspan="1" class="text-center fw-bold py-3 align-middle">${difDiasLle == 0 ? "" : difDiasLle}</td>             
                                         </tr>
                                         <tr>
                                                 <td colspan="1" class="text-start fw-bold py-3 align-middle">Fecha Llegada Lovable:</td>
                                                 <td colspan="1" class="text-center fw-bold py-3 align-middle" style="border-right: 1px solid black;">${formatFecha(dataRes.FECARR)}</td>  
                                                 <td colspan="1" class="text-center fw-bold py-3 align-middle" style="border-right: 1px solid black;">${formatFecha(dataRes.FECAR1)}</td>  
                                                 <td colspan="1" class="text-center fw-bold py-3 align-middle">${difDiasLov == 0 ? "" : difDiasLov}</td>                  
                                         </tr>
                                         <tr>
                                                 <td colspan="1" class="text-start fw-bold py-3 align-middle">Coord. y Embarque:</td>
                                                 <td colspan="1" class="text-center fw-bold py-3 align-middle" style="border-right: 1px solid black;">${dataRes.DIACOR}</td>  
                                                 <td colspan="1" class="text-center fw-bold py-3 align-middle" style="border-right: 1px solid black;">${dataRes.DIACO1 == 0 ? "" : dataRes.DIACO1}</td>  
                                                 <td colspan="1" class="text-center fw-bold py-3 align-middle"><span class="fs-6 ${difDiasCoo < 0 ? "badge bg-danger" : ""}">${difDiasCoo == 0 ? "" : difDiasCoo}</span></td>                
                                         </tr>
                                         <tr>
                                                 <td colspan="1" class="text-start fw-bold py-3 align-middle">Dias Transito:</td>
                                                 <td colspan="1" class="text-center fw-bold py-3 align-middle" style="border-right: 1px solid black;">${dataRes.DIATRA}</td>  
                                                 <td colspan="1" class="text-center fw-bold py-3 align-middle" style="border-right: 1px solid black;">${dataRes.DIATR1 == 0 ? "" : dataRes.DIATR1}</td>    
                                                 <td colspan="1" class="text-center fw-bold py-3 align-middle"><span class="fs-6 ${difDiasTran < 0 ? "badge bg-danger" : ""}">${difDiasTran == 0 ? "" : difDiasTran}</span></td>            
                                         </tr>
                                         <tr>
                                                 <td colspan="1" class="text-start fw-bold py-3 align-middle">Dias Puerto:</td>
                                                 <td colspan="1" class="text-center fw-bold py-3 align-middle" style="border-right: 1px solid black;">${dataRes.DIAPUE}</td>  
                                                 <td colspan="1" class="text-center fw-bold py-3 align-middle" style="border-right: 1px solid black;">${dataRes.DIAPU1 == 0 ? "" : dataRes.DIAPU1}</td>    
                                                 <td colspan="1" class="text-center fw-bold py-3 align-middle"><span class="fs-6 ${difDiasPuer < 0 ? "badge bg-danger" : ""}">${difDiasPuer == 0 ? "" : difDiasPuer}</span></td>           
                                         </tr>
                                         <tr>
                                                 <td colspan="1" class="text-start fw-bold py-3 align-middle">Leadtime Importacion:</td>
                                                 <td colspan="1" class="text-center fw-bold py-3 align-middle" style="border-right: 1px solid black;">${dataRes.LEADTI}</td>  
                                                 <td colspan="1" class="text-center fw-bold py-3 align-middle" style="border-right: 1px solid black;">${dataRes.LEADT1 == 0 ? "" : dataRes.LEADT1}</td>   
                                                 <td colspan="1" class="text-center fw-bold py-3 align-middle"><span class="fs-6 ${difDiasImp < 0 ? "badge bg-danger" : ""}">${difDiasImp == 0 ? "" : difDiasImp}</span></td>             
                                         </tr>
                                        </tbody>
                                </table>`
                    })
                    return `<div class="row p-3 bg-light">
                        ${encabezados}
                        <div class="col-12"><hr></div>
                        <div class="col-12">
                            <h5 class="text-center my-2">Nacionalización</h5>
                            <div class="table-responsive" id="divNac">
                                ${table}
                            </div>
                        </div>
                    </div>`;
                } else {
                    return `<div class="row p-3 bg-light">
                        ${encabezados}
                        <div class="col-12"><hr></div>
                        <div class="col-12">
                            <h5 class="text-center my-2">Nacionalización</h5>
                            <div id="divNac">
                                <h6 class="text-center bg-white py-3 border">No hay información de nacionalización</h6>
                            </div>
                        </div>
                    </div>`;
                }
            } catch (error) {
                console.error("Error en la petición:", error);
                return `<div class="row p-3 bg-light">
                    ${encabezados}
                    <div class="col-12"><hr></div>
                    <div class="col-12">
                        <h5 class="text-center my-2">Nacionalización</h5>
                        <div id="divNac">
                            <h6 class="text-center bg-white py-3 border">Error al obtener información</h6>
                        </div>
                    </div>
                </div>`;
            }
        }
        let table = $('#table').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                loadingRecords: `<button class="btn btn-danger " type="button" disabled>
                                                <span class="spinner-border text-white" style="width: 1.5rem; height: 1.5rem;"
                                                    aria-hidden="true"></span>
                                                <span role="status" class="ms-2 text-white fs-4">Cargando...</span>
                                            </button>`
            },
            "pageLength": 1000,
            "processing": true,
            "serverSide": true,
            "deferRender": true,
            "ajax": {
                "url": "/API.LovablePHP/ZLO0047P/List",
                "type": "POST",
                "contentType": "application/json",
                "data": function (d) {
                    return JSON.stringify({
                        "draw": d.draw,
                        "start": retryRequest ? dStart : d.start,
                        "length": d.length,
                        "search": d.search.value,
                        "columns": d.columns,
                        "year": cbbAno.value,
                        "apl": cbbApl.value,
                        "prov": cbbProv.value,
                        "leadti": ckLeadti.checked ? 1 : 0,
                        "dicre": txtDiCre.value,
                        "estado": cbbEstado.value,
                        "pais": cbbPais.value,
                        "incoterm": cbbIncoterm.value,
                        "factura": txtFactura.value,
                        "ck1": ck1.checked ? 1 : 0,
                        "ck2": ck2.checked ? 1 : 0,
                        "ck3": ck3.checked ? 1 : 0,
                        "ck4": ck4.checked ? 1 : 0,
                        "ck5": ck5.checked ? 1 : 0,
                        "ck6": ck6.checked ? 1 : 0,
                        "ck7": ck7.checked ? 1 : 0,
                        "ck8": ck8.checked ? 1 : 0,
                        "ck9": ck9.checked ? 1 : 0,
                        "ck10": ck10.checked ? 1 : 0,
                        "ck11": ck11.checked ? 1 : 0,
                        "ck12": ck12.checked ? 1 : 0,
                        "nacio": cbbNacio.value
                    });
                },
                "beforeSend": function () {
                    $("#loaderScreen").fadeIn("fast", function () { });
                },
                "complete": function (response) {
                    if (response.responseJSON && response.responseJSON.code == 500) {
                        if (cont < 1) {
                            cont++;
                            setTimeout(() => {
                                table.ajax.reload();
                                retryRequest = true;
                            }, 1000);
                        }
                    } else {
                        dStart = table.page.info().start;
                    }
                    if (ck12.checked || ckLeadti.checked) {
                        $("#table_info").addClass("d-none");
                        $("#table_paginate").addClass("d-none");
                    } else {
                        $("#table_info").removeClass("d-none");
                        $("#table_paginate").removeClass("d-none");
                    }
                    $("#loaderScreen").fadeOut("fast", function () { });
                },
                "error": function (xhr, status, error) {
                    console.log("Error en la petición:", error);
                }
            },
            "ordering": false,
            "dom": 'Brtip',
            "buttons": [
                {
                    "extend": "excelHtml5",
                    "text": '<i class="fa-solid fa-file-excel"></i> <b >Enviar a Excel</b>',
                    "className": "btn btn-success text-light fs-6 my-2",
                    "title": "Trazabilidad de ordenes",
                },
            ],
            "columnDefs": [
                { "width": "1%", "targets": 0, "class": "align-middle" },
                { "width": "7.4%", "targets": 1, "class": "align-middle" },
                { "width": "1%", "targets": 2, "class": "align-middle" },
                { "width": "16.6%", "targets": 3, "class": "align-middle" },
                { "width": "10.25%", "targets": 4, "class": "align-middle" },
                { "width": "14.6%", "targets": 5, "class": "align-middle" },
                { "width": "10.75%", "targets": 6, "class": "align-middle" },
                { "width": "6.7%", "targets": 7, "class": "text-center align-middle" },
                { "width": "6.7%", "targets": 8, "class": "text-center align-middle" },
                { "width": "6.7%", "targets": 9, "class": "text-center align-middle" },
                { "width": "6.7%", "targets": 10, "class": "text-center align-middle" },
                { "width": "6.7%", "targets": 11, "class": "text-center align-middle" },
                { "width": "6.7%", "targets": 12, "class": "text-center align-middle" },
                { "width": "1%", "targets": 13, "class": "text-center align-middle" },
            ],
            "autoWidth": false,
            "columns": [
                { "className": 'dt-control', "orderable": false, "data": null, "defaultContent": '' },
                { "data": "ORDCOM" },
                { "data": "EXPIMP" },
                { "data": null, "render": function (data, type, row) { return `<span class="text-darkblue">${row.ARCNOM}</span>`; } },
                { "data": null, "render": function (data, type, row) { return `<span class="text-pink">${row.PAIDES}</span>`; } },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return formatFecha(row.FECORD);
                    }
                },
                { "data": null, "render": function (data, type, row) { return row.VALORD == '0' ? '' : row.ARCC15 + '.&nbsp;' + row.VALORD; } },
                {
                    "data": null, "render": function (data, type, row) {
                        const prom = parseFloat(row.PEDREC) / parseFloat(row.PEDTOT) * 100;
                        let hoy = new Date();
                        const fec = `${hoy.getFullYear()}${String(hoy.getMonth() + 1).padStart(2, '0')}${String(hoy.getDate()).padStart(2, '0')}`;
                        const ent = calcFecha(row.FECORD, row.LEADTI, 1);
                        const fecme = prom <= 100 ? fec : fec < ent ? fec : ent
                        const dif = diferenciaDias(row.FECORD, fecme);
                        const dias = diferenciaDias(row.FECORD, ent);
                        const pend = dias - dif;
                        if (row.ESTADO == 'A' || prom >= 100) {
                            return ' ';
                        } else {
                            if (pend < 0) {
                                return `<span class="fs-6 badge bg-danger">${pend}</span>`;
                            } else {
                                return pend == 0 ? ' ' : pend;
                            }
                        }
                    }
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        let prom = 0
                        if (row.PEDTOT != "") {
                            prom = parseFloat(row.PEDREC) / parseFloat(row.PEDTOT) * 100;
                        }
                        let hoy = new Date();
                        const fec = `${hoy.getFullYear()}${String(hoy.getMonth() + 1).padStart(2, '0')}${String(hoy.getDate()).padStart(2, '0')}`;
                        const ent = calcFecha(row.FECORD, row.LEADTI, 1);
                        const fecme = prom <= 100 ? fec : fec < ent ? fec : ent
                        if (prom >= 100) {
                            return diasTranscurridos(row.FECORD, row.FECUFA);
                        } else {
                            return diasTranscurridos(row.FECORD, fecme);
                        }

                    }
                },
                {
                    "data": null, "render": function (data, type, row) {
                        let prom = 0;
                        if (parseFloat(row.PEDTOT) != 0) {
                            prom = parseFloat(row.PEDREC) / parseFloat(row.PEDTOT) * 100;
                        }
                        if (isNaN(prom) || prom == 0) {
                            return ' ';
                        } else {
                            return `${prom.toFixed(0)}%`;
                        }
                    }
                },
                {
                    "data": null, "render": function (data, type, row) {
                        const prom = parseFloat(row.VALDIS) / parseFloat(row.VALORD) * 100;
                        let classes = '';
                        if (prom >= 100) {
                            classes = 'bg-success';
                        } else {
                            classes = 'bg-info';
                        }
                        if (row.TOT == 0) {
                            return ' ';
                        }
                        return `<div class="fs-10 py-1">${row.PAG} / ${row.TOT}</div>
                                <div class="progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar ${classes}" style="width: ${prom}%"></div>
                                </div>`;
                    }
                },
                {
                    "data": null, "render": function (data, type, row) {
                        const prom = parseFloat(row.VALDIS) / parseFloat(row.VALORD) * 100;
                        if (isNaN(prom) || prom == 0) {
                            return ' ';
                        } else {
                            return `${prom.toFixed(0)}%`;
                        }


                    }
                },
                { "data": null, "render": function (data, type, row) { return diferenciaDias(row.FECPRO, row.FECULT) } },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        if (row.ESTADO == 'A') {
                            return '<span class="badge bg-danger">Anulado</span>';
                        } else {
                            return '';
                        }
                    },
                }
            ],
            "rowCallback": function (row, data, index) {
                $(row).css("height", "50px");
            },
            initComplete: function () {
                $("#table thead th").each(function (index) {
                    var title = $(this).text();
                    if (index == 1 || index == 3 || index == 4) {
                        $(this).html(
                            title +
                            '<br><input type="text" class="form-control mt-2 column-search" placeholder="Buscar..." />'
                        );
                    } else if (index == 5) {
                        $(this).html(
                            title +
                            '<br><input type="date" class="form-control mt-2 column-search" />'
                        );
                    } else {
                        $(this).html(
                            title +
                            '<br><label class="form-control border border-0">&nbsp;</label>'
                        );
                    }
                });

                $("#table thead").on("input", ".column-search", function () {
                    var columnIndex = $(this).parent().index();
                    table.column(columnIndex).search(this.value).draw();
                });
            },
        });
        table.on('click', 'td.dt-control', async function (e) {
            let tr = e.target.closest('tr');
            let row = table.row(tr);

            if (row.child.isShown()) {
                row.child.hide();
            } else {
                try {
                    const content = await format(row.data());
                    row.child(content).show();
                } catch (error) {
                    console.error("Error al obtener detalles:", error);
                }
            }
        });
        table.on('draw.dt', function () {
            retryRequest = false;
        });
        fetch('/API.LovablePHP/ZLO0047P/ListPaises')
            .then(response => response.json())
            .then(data => {
                data.data.forEach((row) => {
                    const option = document.createElement('option');
                    option.value = row.PAICOD;
                    option.textContent = row.PAIDES;
                    cbbPais.appendChild(option);
                });
            })
        fetch('/API.LovablePHP/ZLO0047P/ListIncoterm')
            .then(response => response.json())
            .then(data => {
                data.data.forEach((row) => {
                    const option = document.createElement('option');
                    option.value = row.CODIGO;
                    option.textContent = row.DESCRI;
                    cbbIncoterm.appendChild(option);
                });
            })
        function formatFecha(fechaStr) {
            if (fechaStr === '0' || fechaStr === ' ' || fechaStr === '') {
                return ' ';
            }

            let año = fechaStr.substring(0, 4);
            let mes = parseInt(fechaStr.substring(4, 6), 10) - 1;
            let dia = parseInt(fechaStr.substring(6, 8), 10);
            let meses = [
                "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
            ];
            return `${dia}, ${meses[mes]} ${año}`;
        }
        function calcFecha(fechaStr, leadti, cond) {
            let year = parseInt(fechaStr.substring(0, 4));
            let month = parseInt(fechaStr.substring(4, 6)) - 1;
            let day = parseInt(fechaStr.substring(6, 8));
            let fecha = new Date(year, month, day);

            cond = parseInt(cond);

            if (cond === 1) {
                fecha.setDate(fecha.getDate() + parseInt(leadti));
            } else {
                fecha.setDate(fecha.getDate() - parseInt(leadti));
            }

            let newYear = fecha.getFullYear();
            let newMonth = (fecha.getMonth() + 1).toString().padStart(2, '0');
            let newDay = fecha.getDate().toString().padStart(2, '0');

            return `${newYear}${newMonth}${newDay}`;
        }
        function diasActuales() {
            let hoy = new Date();
            let inicioAño = new Date(hoy.getFullYear(), 0, 1);
            let diferenciaDias = Math.floor((hoy - inicioAño) / (1000 * 60 * 60 * 24)) + 1;

            return diferenciaDias;
        }
        function diasTranscurridos(fecha1, fecha2) {
            let year1 = parseInt(fecha1.substring(0, 4));
            let month1 = parseInt(fecha1.substring(4, 6)) - 1;
            let day1 = parseInt(fecha1.substring(6, 8));
            let date1 = new Date(year1, month1, day1);

            let date2;
            if (fecha2 === "0") {
                date2 = new Date();
            } else {
                let year2 = parseInt(fecha2.substring(0, 4));
                let month2 = parseInt(fecha2.substring(4, 6)) - 1;
                let day2 = parseInt(fecha2.substring(6, 8));
                date2 = new Date(year2, month2, day2);
            }
            let diferenciaMilisegundos = date2 - date1;
            let diferenciaDias = Math.floor(diferenciaMilisegundos / (1000 * 60 * 60 * 24));
            return diferenciaDias;
        }
        function diferenciaDias(fecha1, fecha2) {
            if (fecha2 == '0' || fecha1 == '0' || fecha2 == ' ' || fecha1 == ' ' || fecha1 == '' || fecha2 == '') {
                return ' ';
            }
            let date1 = new Date(fecha1.substring(0, 4), fecha1.substring(4, 6) - 1, fecha1.substring(6, 8));
            let date2 = new Date(fecha2.substring(0, 4), fecha2.substring(4, 6) - 1, fecha2.substring(6, 8));
            if (date1 > date2) {
                return ' ';
            }
            let diferenciaMilisegundos = date2 - date1;
            let diferenciaDias = diferenciaMilisegundos / (1000 * 60 * 60 * 24);

            return Math.abs(diferenciaDias);
        }
    </script>
</body>

</html>