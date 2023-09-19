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
</head>

<body>
    <?php
      include '../layout-prg.php';
      include '../../assets/php/ZPL/ZLO0017P/header.php';
      
    ?>
    <script>
        var usuario = '<?php echo $_SESSION["CODUSU"];?>';
    </script>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <span>Programa Lealtad / Estádistica</span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0017P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-1">
        <div class="card mb-5">
            <div class="card-header mb-4 ">
                <h1 class="fs-4 mb-1 mt-2 text-center">Historial de total clientes viejos y nuevos</h1>
            </div>
            <div class="demo overflow-auto" style="height:700px">
                <ul class="tablist d-flex justify-content-center sticky-top bg-white" role="tablist">
                    <li id="tab1" class="tablist__tab text-center p-3  is-active" aria-controls="panel1"
                        aria-selected="true" role="tab" tabindex="0">Gráficas</li>
                    <li id="tab2" class="tablist__tab text-center p-3" aria-controls="panel2" aria-selected="false"
                        role="tab" tabindex="0">Valores</li>
                </ul>
                <div id="panel1" class="tablist__panel p-3" aria-labelledby="tab1" aria-hidden="false" role="tabpanel">
                    <!--DATOS GENERALES-->
                    <div class="card-body">
                        <!--CARTAS-->
                        <div class="row mt-1">
                            <div class="col-12 rounded mb-2 p-1 text-white" style="background-color: #000;">
                                <h3 class="ms-3">General</h3>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="card mb-4 text-white" style="background-color:#F3B609;">
                                    <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="fs-3 fw-semibold"><span id="usuaActuales"></span> (<span
                                                    class="fs-6 fw-normal" id="usuaDiferencia"></span>)
                                            </div>
                                            <div><span class="fs-5">Clientes</span></div>
                                        </div>
                                    </div>
                                    <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                        <canvas class="chart" id="card-chart1" height="70"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col-->
                            <div class="col-sm-6 col-lg-3">
                                <div class="card mb-4 text-white" style="background-color:#F8760A;">
                                    <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="fs-3 fw-semibold"><span id="emailActuales"></span> (<span
                                                    class="fs-6 fw-normal" id="emailDiferencia"></span>)
                                            </div>
                                            <div><span class="fs-5">Correos electrónicos</span></div>
                                        </div>
                                    </div>
                                    <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                        <canvas class="chart" id="card-chart2" height="70"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col-->
                            <div class="col-sm-6 col-lg-3">
                                <div class="card mb-4 text-white" style="background-color:#574E46;">
                                    <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="fs-3 fw-semibold"><span id="telefActuales"></span> (<span
                                                    class="fs-6 fw-normal" id="telefDiferencia"></span>)
                                            </div>
                                            <div><span class="fs-5">Teléfonos</span></div>
                                        </div>
                                    </div>
                                    <div class="c-chart-wrapper mt-3" style="height:70px;">
                                        <canvas class="chart" id="card-chart3" height="70"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col-->
                            <div class="col-sm-6 col-lg-3">
                                <div class="card mb-4 text-white " style="background-color:#EF5442;">
                                    <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="fs-3 fw-semibold"><span id="transActuales"></span> (<span
                                                    class="fs-6 fw-normal" id="transDiferencia"></span>)
                                            </div>
                                            <div><span class="fs-5">Transacciones</span></div>
                                        </div>
                                    </div>
                                    <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                        <canvas class="chart" id="card-chart4" height="70"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col-->
                        </div>
                        <!--/CARTAS-->
                        <div id="carouselExampleDark" class="carousel carousel-dark slide">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner pe-5 ps-5">
                                <div class="carousel-item active">
                                    <div id="container " class=" mb-5">
                                        <div class="card mb-4 p-3 table-responsive">
                                            <figure class="chart highcharts-figure p-0 m-0" >
                                                <div id="container1" style="height:100%; width=100%; min-height: 50vh; min-width: 150vh;"></div>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div id="container " class=" mb-5">
                                    <div class="card mb-4 p-3 table-responsive">
                                            <figure class="chart highcharts-figure p-0 m-0" >
                                                <div id="container2" style="height:100%; width=100%; min-height: 50vh; min-width: 150vh;"></div>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div id="container " class=" mb-5">
                                        <div class="card mb-4 p-3 table-responsive">
                                            <figure class="chart highcharts-figure p-0 m-0" >
                                                <div id="container3" style="height:100%; width=100%; min-height: 50vh; min-width: 150vh;"></div>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <!--//DATOS GENERALES-->
                    <!--DATOS PAISES-->

                    <div class="card-body">
                        <!--CARTAS-->
                        <div class="row mt-1">
                        <div class="col-12 rounded mb-2 p-1 text-white" style="background-color: #000;">
                                <h3 class="ms-3">País</h3>
                            </div>
                            <div class="col-12 rounded mb-2 p-1 ">
                                <select class="form-select  mt-1" id="cbbPais" style="width: 100%;">
                                    <option value="1">Honduras</option>
                                    <option value="3">Guatemala</option>
                                    <option value="4">El Salvador</option>
                                    <option value="5">Costa Rica</option>
                                    <option value="6">Nicaragua</option>
                                </select>
                                <hr class="mb-2">
                            </div>
                        </div>
                        <div id="paisesDiv">

                        </div>
                    </div>
                    
                    <!--//DATOS PAISES-->
                    <!--DATOS TIENDAS-->
                    <div class="card-body">
                        <!--CARTAS-->
                        <div class="row mt-1">
                        <div class="col-12 rounded mb-2 p-1 text-white" style="background-color: #000;">
                                <h3 class="ms-3">Punto de venta</h3>
                            </div>
                            <div class="col-12 rounded mb-2 p-1 ">
                                <select class="form-select  mt-1" id="cbbCia" style="width: 100%;">
                                </select>
                                <hr class="mb-2">
                            </div>
                        </div>
                        <div id="tiendasDiv">

                        </div>
                    </div>
                    <!--//DATOS TIENDAS-->
                </div>


                <div id="panel2" class="tablist__panel is-hidden p-3" aria-labelledby="tab2" aria-hidden="true"
                    role="tabpanel">
                    <div class="card-body">
                        <!--CARTAS-->
                        <div class="row mt-1">
                            <div class="col-12 rounded mb-2 p-1 text-white" style="background-color:#000;">
                                <h3 class="ms-3">Datos generales</h3>
                            </div>
                            <div class="col-12 rounded mb-2 p-1 ">
                                <div class="table-responsive">
                                    <table  id="tableGenerales" class="table stripe table-hover " style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-start">Mes</th>     
                                                <th class="text-end">Clientes Viejos</th>
                                                <th class="text-end">%</th>
                                                <th class="text-end">Clientes Nuevos</th>
                                                <th class="text-end">%</th>
                                                <th class="text-end">Total Clientes</th>
                                                <th class="text-end">Correos electrónicos</th>
                                                <th class="text-end">%</th>
                                                <th class="text-end">Teléfonos</th>
                                                <th class="text-end">%</th>
                                                <th class="text-end">Total Contactos</th>
                                                <th class="text-end">Transacciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyGenerales">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--CARTAS-->
                        <div class="row mt-1">
                            <div class="col-12 rounded mb-2 p-1 text-white" style="background-color: #000;">
                                    <h3 class="ms-3">País</h3>
                            </div>
                            <div class="col-12 rounded mb-2 p-1 ">
                                <select class="form-select  mt-1" id="cbbPais2" style="width: 100%;">
                                    <option value="1">Honduras</option>
                                    <option value="3">Guatemala</option>
                                    <option value="4">El Salvador</option>
                                    <option value="5">Costa Rica</option>
                                    <option value="6">Nicaragua</option>
                                </select>
                                <hr class="mb-2">
                            </div>
                            <div id="tablePaisesDiv">                           

                            </div>
                        </div> 
                    </div>
                    <div class="card-body">
                        <!--CARTAS-->
                        <div class="row mt-1">
                            <div class="col-12 rounded mb-2 p-1 text-white" style="background-color: #000;">
                                    <h3 class="ms-3">Punto de venta</h3>
                            </div>
                            <div class="col-12 rounded mb-2 p-1 ">
                                <select class="form-select  mt-1" id="cbbCia2" style="width: 100%;">
                                </select>
                                <hr class="mb-2">
                            </div>
                            <div id="tableTiendasDiv">                           

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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../assets/vendors/@coreui/chartjs/js/coreui-chartjs.js"></script>
    <script src="../../assets/vendors/@coreui/utils/js/coreui-utils.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../../assets/js/PRG/ZPL/ZLO0017P.js"></script>
</body>

</html>