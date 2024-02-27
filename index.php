<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
    <style type='text/css'>
    @media (min-width: 1200px) {
        <?php $FiltroDiv=(float)(isset($_GET['c']) ? $_GET['c'] : 1);

        if ($FiltroDiv==2 || $FiltroDiv==3 || $FiltroDiv==4 || $FiltroDiv==5 || $FiltroDiv==6 || $FiltroDiv==7) {
            echo '#colHonMes3,#colHonMes2 {margin-top:11%; margin-bottom:13%;}';
        }

        ?>
    }

    @media (min-width: 1600px) {
        <?php $FiltroDiv=(float)(isset($_GET['c']) ? $_GET['c'] : 1);

        if ($FiltroDiv==2 || $FiltroDiv==3 || $FiltroDiv==4 || $FiltroDiv==5 || $FiltroDiv==6 || $FiltroDiv==7) {
            echo '#colHonMes3,#colHonMes2 {margin-top:11%; margin-bottom:15%;}';
        }

        ?>
    }
    </style>
</head>

<body>
    <?php
  include 'layout.php';
  include 'assets/php/index/phpindex.php';
  ?>

    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <span>Inicio</span>
                </li>
                <li class="breadcrumb-item active"><span>Página principal</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div class="body flex-grow-1 px-3">
        <div class="card mb-3">
            <div class="card-body">
                <form id="formGraficas" action="assets/php/index/grafica-filtro.php" method="POST">
                    <div class="row mb-2">
                        <div class="col-sm-12 col-lg-6 mt-2">
                            <label>Fecha:</label>
                            <input type="date" class="form-control" name="fechagra" id="fechagra"
                                data-date-format="dd/mm/yyyy" onfocus="(this.type='date')" onkeydown="return false;">
                        </div>
                        <div class="col-sm-12 col-lg-6 mt-2">
                            <label>Vista por:</label>
                            <select class="form-select" id="cbbMesgra" name="cbbMesgra">
                                <option class="fw-bold" value="1">Lovable de Honduras</option>
                                <option class="fw-bold" value="2">Tiendas Honduras (Lov. Ecommerce)</option>
                                <option class="fw-bold" value="3">Tiendas Honduras (Mod. Íntima)</option>
                                <option class="fw-bold" value="4">Tiendas Guatemala</option>
                                <option class="fw-bold" value="5">Tiendas El Salvador</option>
                                <option class="fw-bold" value="6">Tiendas Nicaragua</option>
                                <option class="fw-bold" value="7">Tiendas Costa Rica</option>
                                <option class="fw-bold" value="8">Tiendas Republica Dominicana</option>
                            </select>
                            <input type="text" id="fechaCk10" name="fechaCk10" class="d-none">
                        </div>
                        <div class="col-12 mt-3">
                            <div class="form-check form-switch ms-2">
                                <input class="form-check-input fs-5 " type="checkbox" role="switch" id="dolaresCk"
                                    name="dolaresChk">
                                <label class="form-check-label fs-5 fw-bold " for="dolaresCk">Valores en dólares</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--GRAFICAS-->
        <div class="mb-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center fw-bold" id="tituloGraficasVentas"> </h4>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-8 d-flex flex-column" id="caja1">
                            <div class="card " style="height:100%;">
                                <div class="card-body row align-items-center">
                                    <div class="row justify-content-evenly">
                                        <?php
                                            if ($compFiltroP == 2 || $compFiltroP == 3 || $compFiltroP == 4 || $compFiltroP == 5 || $compFiltroP == 6 || $compFiltroP == 7) {
                                              echo '<div id="colHonDia"  class=" col-12 col-lg-4">
                                                              <h5 class="mt-2 mb-1 text-center">Ventas del día</h5>
                                                              <canvas  id="HonDia" class="mt-3 mb-3" ></canvas>
                                                              </div>';
                                            } else {
                                              echo '<div id="colHonDia"  class="col-12">
                                                            <h5 class="mt-2 mb-4 text-center">Ventas del día</h5>
                                                            <canvas  id="HonDia" class="mt-3 mb-5" ></canvas>

                                                            </div>';
                                              echo '<script> $("#HonDia").hide()</script>';
                                            }

                                            if ($compFiltroP == 2 || $compFiltroP == 3 || $compFiltroP == 4 || $compFiltroP == 5 || $compFiltroP == 6 || $compFiltroP == 7) {
                                              echo '<div id="colHonMes" class="col-12 col-lg-4">
                                                            <h5 class="mt-2 mb-1 text-center">Ventas del Mes</h5>
                                                            <canvas  id="HonMes1" class="mt-3 mb-3" ></canvas>
                                                            </div>';
                                            } else {
                                              echo '<div id="colHonMes" class="col-12">
                                                            <h5 class="mt-5 mb-4 text-center">Ventas del Mes</h5>
                                                            <canvas  id="HonMes1" class="mt-3 mb-3" ></canvas>

                                                            </div>';
                                              echo '<script> $("#HonMes1").hide()</script>';
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="card mb-2 ">
                                <div class="card-body">
                                    <div class="input-group ">
                                        <input class="me-2" type="checkbox" value="1" id="fechaCk" name="fechaCk">
                                        <label for="productosCk">Mostrar valores hasta <b>final de mes</b></label>
                                    </div>
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-body  ">
                                    <h5 class="text-center fw-bold">Comparativo Mensual</h5>
                                    <div class="row justify-content-center ">
                                        <?php
                        if ($mesGraficas2 == 12) {
                          echo '
                              <div id="colHonMes2" class="col-12 col-lg-9">
                              <div class="d-flex justify-content-evenly">
                              <div>
                              <label class="responsive-font-example fw-bold">' . obtenerNombreMes($mesGraficas1) . ' ' . $anoGraficas1 . '</label>
                              <div class="" style="display:inline-block; width:30px; height:20px; background-color:rgba(25, 170, 222,1);"></div>
                              </div>
                              <div >
                              <label class="responsive-font-example fw-bold">' . obtenerNombreMes($mesGraficas2) . ' ' . $anoGraficas2 . '</label>
                              <div class="" style="display:inline-block; width:30px; height:20px; background-color:rgba(125, 58, 193,1);"></div>
                              </div>
                            </div>
                            <div class="position-relative">
                            <canvas id="HonMes2" height="230px" ></canvas>
                            </div>
                            <label for="productosCk">Mostrar valores hasta <b>final de mes</b></label>
                          </div>';
                        } else {
                          echo '
                              <div id="colHonMes2" class="col-12 col-lg-9">
                              <div class="d-flex justify-content-evenly">
                              <div>
                              <label class="responsive-font-example fw-bold">' . obtenerNombreMes($mesGraficas1) . ' ' . $anoGraficas1 . '</label>
                              <div class="" style="display:inline-block; width:30px; height:20px; background-color:rgba(25, 170, 222,1);"></div>
                              </div>
                              <div >
                              <label class="responsive-font-example fw-bold">' . obtenerNombreMes($mesGraficas2) . ' ' . $anoGraficas1 . '</label>
                              <div class="" style="display:inline-block; width:30px; height:20px; background-color:rgba(125, 58, 193,1);"></div>
                              </div>
                            </div>
                            <div class="position-relative">
                            <canvas id="HonMes2" height="230px" ></canvas>
                            </div>
                            <label class="fs-6">Valores hasta: <b>' . (($fechacheck == "true") ? 'Final del mes' : 'Fecha Actual') . '</b></label>
                          </div>';
                        }
                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-2">
                                <div class="card-body">
                                    <div class="row justify-content-center ">
                                        <div class="col-7" id="var1">
                                            <h6 class="text-center">Variación</h6>
                                        </div>
                                        <div class="col-5" id="cre1">
                                            <h6 class="text-center">Crecimiento</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-8 d-flex flex-column">
                            <div class="card mt-2" style="height:100%;">
                                <div class="card-body justify-content-center">
                                    <?php
                      echo '
                                          <div class="d-flex justify-content-center">
                                          <div id="" class="col-12 col-lg-4">
                                            <h5 class="text-center fw-bold mt-1 mb-2">Comparativo Anual</h5>

                                            <div class="position-relative">
                                            <canvas id="AnualGrafica" height="250px" ></canvas>
                                            </div>
                                            <div class="d-flex justify-content-around">
                                            <div>
                                            <label class="responsive-font-example fw-bold">Año ' . $anoGraficas1 . '</label>
                                            <div class="" style="display:inline-block; width:30px; height:20px; background-color:rgba(25, 170, 222,1);"></div>
                                            </div>
                                            <div >
                                            <label class="responsive-font-example fw-bold">Año ' . $anoGraficas2 . '</label>
                                            <div class="" style="display:inline-block; width:30px; height:20px; background-color:rgba(125, 58, 193,1);"></div>
                                            </div>
                                          </div>
                                          </div>
                                          </div>';
                      ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 d-flex flex-column">
                            <div class="card mt-2" style="height:100%;">
                                <div class="card-body">
                                    <h5 class="text-center fw-bold">Comparativo Mensual</h5>
                                    <div class="row justify-content-center ">
                                        <?php
                                    echo ' <div id="colHonMes3" class="col-12  col-lg-9">
                                                <div class="d-flex justify-content-evenly">
                                                  <div>
                                                  <label class="responsive-font-example fw-bold" >' . obtenerNombreMes($mesGraficas1) . ' ' . $anoGraficas1 . '</label>
                                                  <div class="" style="display:inline-block; width:30px; height:20px; background-color:rgba(25, 170, 222,1);"></div>
                                                  </div>
                                                  <div >
                                                  <label class="responsive-font-example fw-bold">' . obtenerNombreMes($mesGraficas1) . ' ' . $anoGraficas2 . '</label>
                                                  <div class="" style="display:inline-block; width:30px; height:20px; background-color:rgba(125, 58, 193,1);"></div>
                                                  </div>

                                                </div>
                                                <div class="position-relative">
                                                <canvas id="HonMes3" height="230px" ></canvas>
                                                </div>
                                                <label class="fs-6">Valores hasta: <b>' . (($fechacheck == "true") ? 'Final del mes' : 'Fecha Actual') . '</b></label>
                                            </div>';
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-8 d-flex flex-column">
                            <div class="card mt-2">
                                <div class="card-body">
                                    <div class="row">
                                        <?php
                                      print '<div id="varAnual1"  class="col-12 col-md-6">';
                                      print '<h5 class="mt-md-2 text-center">Variación Anual</h5>';
                                      print '</div>';

                                      print '<div id="varAnual2"  class="col-12 col-md-6">';
                                      print '<h5 class="mt-2 text-center">Crecimiento Anual</h5>';
                                      print '</div>';

                                      ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4 d-flex flex-column">
                            <div class="card mt-2">
                                <div class="card-body p-4">
                                    <div class="row justify-content-center ">
                                        <div class="col-7 mt-2" id="var2">
                                            <h6 class="text-center">Variación</h6>
                                        </div>
                                        <div class="col-5 mt-2" id="cre2">
                                            <h6 class="text-center">Crecimiento</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card mt-2 ">
                        <div class="card-body">
                            <h5 class="text-center mb-4 pt-3">Promedios por transacción</h5>
                            <div id="promediosVal" class="row border">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/GRAFICAS-->
    </div>
    </div>
    <!--BODY-->
    <div class="footer bg-blck flex-grow-1 d-flex justify-content-center">
        <p class="bggray responsive-font-example"><i>Lovable de Honduras S.A. de C.V</i></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>

    <?php //include 'assets/php/index/graficas.php'; ?>

</body>


</html>