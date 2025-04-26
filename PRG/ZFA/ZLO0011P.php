<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
</head>
<body>
    <?php
      include '../layout-prg.php';
      $anopro=isset($_SESSION['anofiltro'])? $_SESSION['anofiltro']:date("Y");
      $mespro=isset($_SESSION['mesfiltro'])? $_SESSION['mesfiltro']:date("m");
      $cia=isset($_SESSION['cia'])? $_SESSION['cia']:'';
      include '../../assets/js/PRG/ZFA/ZLO0011P/ZLO0011P.php';
    ?>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <span>Módulo de facturación / Consultas</span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0011P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-1">
        <div class="card mb-5">
            <div class="card-header">
                <h1 class="fs-4 mb-1 mt-2 text-center">Ventas por Clasificación de Productos Tiendas</h1>
            </div>
            <div class="card-body">
                <div class="position-relative">
                    <form id="formFiltros" action="../../assets/php/ZFA/ZLO0011P/filtrosLogica.php" method="POST">
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-6 mt-2">
                                <label>Año:</label>
                                <select class="form-select  mt-1" id="cbbAno" name="cbbAno">
                                    <?php
                                        $anio_actual = date('Y');
                                        for ($i = $anio_actual; $i >= 2021; $i--) {
                                        echo "<option value='$i'>$i</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-6 mt-2">
                                <label>Mes:</label>
                                <select class="form-select mt-1" id="cbbMes" name="cbbMes">
                                    <option value="01">Enero</option>
                                    <option value="02">Febrero</option>
                                    <option value="03">Marzo</option>
                                    <option value="04">Abril</option>
                                    <option value="05">Mayo</option>
                                    <option value="06">Junio</option>
                                    <option value="07">Julio</option>
                                    <option value="08">Agosto</option>
                                    <option value="09">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <hr>
                <div id="grafica1" class="mt-5">
                    <figure class="highcharts-figure">
                        <div id="container"></div>
                    </figure>
                </div>
                <div class="table-responsive mt-3" style="width:100%">
                    <table id="myTableInvDesc" class="table stripe table-hover " style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th class="responsive-font-example text-start">Punto de Venta</th>
                                <th class="responsive-font-example text-end">Sin descuento</th>
                                <th class="responsive-font-example text-end">10 %</th>
                                <th class="responsive-font-example text-end">20 %</th>
                                <th class="responsive-font-example text-end">30 %</th>
                                <th class="responsive-font-example text-end">40 %</th>
                                <th class="responsive-font-example text-end">50 %</th>
                                <th class="responsive-font-example text-end">60 %</th>
                                <th class="responsive-font-example text-end">70 %</th>
                                <th class="responsive-font-example text-end">80 %</th>
                                <th class="responsive-font-example text-end">Z1</th>
                                <th class="responsive-font-example text-end">Z2</th>
                                <th class="responsive-font-example text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
</body>

</html>