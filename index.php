<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
  <style type='text/css'>
   
    @media (min-width: 1200px) {
    <?php
    $FiltroDiv=(float)(isset($_GET['c'])? $_GET['c']:1);
    if($FiltroDiv==2||$FiltroDiv==3||$FiltroDiv==4||$FiltroDiv==5||$FiltroDiv==6)
    {
    echo '#colHonMes3,#colHonMes2 {margin-top:11%; margin-bottom:13%;}';
    }
  ?>
  }
  @media (min-width: 1600px) {
    <?php
    $FiltroDiv=(float)(isset($_GET['c'])? $_GET['c']:1);
    if($FiltroDiv==2||$FiltroDiv==3||$FiltroDiv==4||$FiltroDiv==5||$FiltroDiv==6)
    {
    echo '#colHonMes3,#colHonMes2 {margin-top:11%; margin-bottom:15%;}';
    }
  ?>
  }
  
  
</style>
</head>

<body>
<div class="spinner-wrapper">
  <div class="spinner-border text-danger" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>
  <?php
      include 'layout.php';
      include 'php/index/phpindex.php';
    ?>
  <div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item">
              <span>Inicio</span>
        </li>
        <li class="breadcrumb-item active"><span>Pagina Principal</span></li>
      </ol>
    </nav>
  </div>
  </header>
  <div class="body flex-grow-1 px-3">
      <div class="card mb-3">
        <div class="card-body">
          <form id="formGraficas" action="php/index/grafica-filtro.php" method="POST">
            <div class="row mb-2">
              <div class="col-sm-12 col-lg-6 mt-2">
                <label>Fecha:</label>
                <input type="date" class="form-control" name="fechagra" id="fechagra" data-date-format="dd/mm/yyyy"
                  onfocus="(this.type='date')" onkeydown="return false;">
              </div>
              <div class="col-sm-12 col-lg-6 mt-2">
                <label>Vista por:</label>
                <select class="form-control" id="cbbMesgra" name="cbbMesgra">
                      <option class="fw-bold" value="1">Lovable de Honduras</option>
                      <option class="fw-bold" value="2">Tiendas Honduras</option>
                      <option class="fw-bold" value="3">Tiendas Guatemala</option>
                        <option class="fw-bold" value="4">Tiendas El Salvador</option>
                        <option class="fw-bold" value="5">Tiendas Nicaragua</option>
                        <option class="fw-bold" value="6">Tiendas Costa Rica</option>
                        <option class="fw-bold" value="7">Tiendas Republica Dominicana</option>
                        <?php
                      while ($rowCOMARCIndex = odbc_fetch_array($resultCOMARCIndex)) {
                        echo "<option value='" . $rowCOMARCIndex['COMCOD'] . "'>" . rtrim(utf8_encode($rowCOMARCIndex['COMDES'])) . "</option>";
                      }
                      ?>
                        </select>  
                <input type="text" id="fechaCk10" name="fechaCk10" class="d-none"> 
              </div>
            </div>
          </form>
        </div>
        <div class="card-footer"></div>
      </div>
 
      <div class="padding-graficas mb-4">
                <div class="card">
                    <div class="card-body">
                    <h4 class="text-center fw-bold" id="tituloGraficasVentas"> </h4>
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col-12">
                    <div class="row">
                      <div class="col-12 col-lg-8 d-flex flex-column" id="caja1">
                      <div class="col-12" >
                          <div class="card pb-4 pt-3">
                              <div class="card-body">
                              <div class="row justify-content-evenly">
                              <?php
                                    if ( $compFiltroP==2 ||$compFiltroP==3||$compFiltroP==4 ||$compFiltroP==5||$compFiltroP==6) {
                                        echo '<div id="colHonDia"  class=" col-12 col-lg-4">
                                        <h5 class="mt-2 mb-1 text-center">Ventas del día</h5>
                                        <canvas  id="HonDia" class="mt-3 mb-3" ></canvas>
                                        </div>';
                                    }else{
                                      echo '<div id="colHonDia"  class="col-12 col-lg-6">
                                      <h5 class="mt-2 mb-1 text-center">Ventas del día</h5>
                                      <canvas  id="HonDia" class="mt-3 mb-3" ></canvas>
                                      <label class="form-control text-primary responsive-font-example fw-bold fs-3 text-center mt-3 pt-2 pb-2">'.$_SESSION['MONE'].'.'.number_format($ventasdeldia,2, '.', ',').'</label>
                                      </div>';
                                      echo '<script> $("#HonDia").hide()</script>';
                                    }

                                    if ( $compFiltroP==2 ||$compFiltroP==3||$compFiltroP==4 ||$compFiltroP==5||$compFiltroP==6) {
                                      echo '<div id="colHonMes" class="col-12 col-lg-4">
                                      <h5 class="mt-2 mb-1 text-center">Ventas del Mes</h5>                            
                                      <canvas  id="HonMes1" class="mt-3 mb-3" ></canvas>
                                      </div>';
                                    }else{
                                      echo '<div id="colHonMes" class="col-12 col-lg-6">
                                      <h5 class="mt-2 mb-1 text-center">Ventas del Mes</h5>
                                      <canvas  id="HonMes1" class="mt-3 mb-3" ></canvas>
                                      <label class="form-control text-primary responsive-font-example fw-bold fs-3 text-center mt-3 pt-2 pb-2">'.$_SESSION['MONE'].'.'.number_format($ventasdelmes,2, '.', ',').'</label>
                                      </div>';
                                        echo '<script> $("#HonMes1").hide()</script>';
                                    }
                                ?>
                              </div>
                            </div>
                          </div>
                          </div>
                          <div class="col-12">
                                  <div class="card mt-2 mb-2 pb-5 pt-4">
                                    <div class="card-body justify-content-center">
                                      <?php
                                        echo '
                                        <div class="d-flex justify-content-center">
                                        <div id="" class="col-12 col-lg-4">
                                          <h5 class="text-center fw-bold">Comparativo Anual</h5>
                                         
                                          <div class="position-relative">
                                          <canvas id="AnualGrafica" height="230px" ></canvas>
                                          </div>
                                          <div class="d-flex justify-content-around">
                                          <div>
                                          <label class="responsive-font-example fw-bold">Año '.$anoGraficas1.'</label>
                                          <div class="" style="display:inline-block; width:30px; height:20px; background-color:rgba(25, 170, 222,1);"></div>
                                          </div>
                                          <div >
                                          <label class="responsive-font-example fw-bold">Año '.$anoGraficas2.'</label>
                                          <div class="" style="display:inline-block; width:30px; height:20px; background-color:rgba(125, 58, 193,1);"></div>
                                          </div>
                                        </div>
                                        </div>
                                        </div>';
                                        
                                      ?>
                                    </div>
                                  </div>
                                  <div class="card mb-2 pb-4 pt-3">
                                    <div class="card-body">
                                      <div class="row">
                                      <?php
                                        print '<div id="colHonDia"  class="col-12 col-md-6">';
                                        print '<h5 class="mt-md-2 text-center">Variación Anual</h5>';
                                        if ($variacion<0) {
                                          print '<label class="form-control text-danger responsive-font-example fw-bold fs-3 text-center mt-2 pt-2 pb-2">'.$_SESSION['MONE'].'.'.number_format($variacion,2, '.', ',').'</label>';
                                        }else{
                                          print '<label class="form-control text-success responsive-font-example fw-bold fs-3 text-center mt-2 pt-2 pb-2">'.$_SESSION['MONE'].'.'.number_format($variacion,2, '.', ',').'</label>';
                                        }
                                        print '</div>';

                                        print '<div id="colHonDia"  class="col-12 col-md-6">';
                                        print '<h5 class="mt-2 text-center">Crecimiento Anual</h5>';
                                        if ($crecimiento<0) {
                                          print'<label class="form-control text-danger responsive-font-example fw-bold fs-3 text-center mt-2 pt-2 pb-2">'.$crecimiento.'%</label>';
                                        }else{
                                          print'<label class="form-control text-success responsive-font-example fw-bold fs-3 text-center mt-2 pt-2 pb-2">'.$crecimiento.'%</label>';
                                        }
                                        print '</div>';
                                    
                                      ?>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card mb-2 ">
                                    <div class="card-body">
                                        <h5 class="text-center mb-4 pb-4 pt-3">Promedios por transacción</h5>
                                      <div class="row">
                                      <?php
                                        print '<div id="colHonDia"  class="col-12 col-md-2">';
                                        print '<h6 class="mt-2 text-center ">Dia</h6>';
                                        print '<p class=" fs-6  fw-bold  text-center mt-2 pt-2 ">'.$_SESSION['MONE'].'.'.number_format($prodia,2, '.', ',').'</p>';
                                        print '</div>';

                                        print '<div id="colHonDia"  class="col-12 col-md-2">';
                                        print '<h6 class="mt-md-2 text-center ">Mes</h6>';
                                        print'<p class="  fs-6  fw-bold text-center mt-2 pt-2 pb-2">'.$_SESSION['MONE'].'.'.number_format($promes,2, '.', ',').'</p>';
                                        print '</div>';
                                        print '<div id="colHonDia"  class="col-12 col-md-2">';
                                        print '<h6 class="mt-md-2 text-center ">Año '.$anoGraficas1.'</h6>';
                                        print '<p class=" fs-6 fw-bold  text-center mt-2 pt-2 pb-2">'.$_SESSION['MONE'].'.'.number_format($proano,2, '.', ',').'</p>';
                                        print '</div>';

                                        print '<div id="colHonDia"  class="col-12 col-md-2">';
                                        print '<h6 class="mt-md-2 text-center ">Año '.$anoGraficas2.'</h6>';
                                        print'<p class=" fs-6 fw-bold  text-center mt-2 pt-2 pb-2">'.$_SESSION['MONE'].'.'.number_format($proano2,2, '.', ',').'</p>';
                                        print '</div>';
                                        print '<div id="colHonDia"  class="col-12 col-md-2">';
                                        print '<h6 class="mt-md-2 text-center ">Variación</h6>';
                                        if ($variacionpro<0) {
                                          print '<p class=" text-danger fs-6 fw-bold text-center mt-2 pt-2 pb-2">'.$_SESSION['MONE'].'.'.number_format($variacionpro,2, '.', ',').'</p>';
                                        }else{
                                          print '<p class=" text-success fs-6  fw-bold  text-center mt-2 pt-2 pb-2">'.$_SESSION['MONE'].'.'.number_format($variacionpro,2, '.', ',').'</p>';
                                        }
                                        print '</div>';

                                        print '<div id="colHonDia"  class="col-12 col-md-2">';
                                        print '<h6 class="mt-md-2 text-center ">Crecimiento</h6>';
                                        if ($crecimientopro<0) {
                                          print'<p class=" text-danger fs-6 fw-bold  text-center mt-2 pt-2 pb-2">'.$crecimientopro.'%</p>';
                                        }else{
                                          print'<p class=" text-success fs-6 fw-bold  text-center mt-2 pt-2 pb-2">'.$crecimientopro.'%</p>';
                                        }
                                        print '</div>';
                                      ?>
                                      </div>
                                    </div>
                                  </div>
                          </div>
                      </div>
                      <div class="col-12 col-lg-4 " id="caja2">
                        <!-- Contenido de la caja2 -->
                        <div class="col-12">
                            <div class="card mb-2 ">
                              <div class="card-body">
                                <div class="input-group ">
                                <input class="me-2" type="checkbox" value="1" id="fechaCk" name="fechaCk">
                                  <label for="productosCk">Mostrar valores hasta <b>final de mes</b></label>
                                </div>
                              </div>
                            </div>
                        </div>
                <div class="card ">
                    <div class="card-body  ">
                      <h5 class="text-center fw-bold">Comparativo Mensual</h5>
                      <div class="row justify-content-center ">
                        <?php
                        if ($mesGraficas2==12) {
                          echo '
                          <div id="colHonMes2" class="col-12 col-lg-9">
                          <div class="d-flex justify-content-evenly">
                          <div>
                          <label class="responsive-font-example fw-bold">'.obtenerNombreMes($mesGraficas1).' '.$anoGraficas1.'</label>
                          <div class="" style="display:inline-block; width:30px; height:20px; background-color:rgba(25, 170, 222,1);"></div>
                          </div>
                          <div >
                          <label class="responsive-font-example fw-bold">'.obtenerNombreMes($mesGraficas2).' '.$anoGraficas2.'</label>
                          <div class="" style="display:inline-block; width:30px; height:20px; background-color:rgba(125, 58, 193,1);"></div>
                          </div>
                        </div>
                        <div class="position-relative">
                         <canvas id="HonMes2" height="230px" ></canvas>
                         </div>
                         <label for="productosCk">Mostrar valores hasta <b>final de mes</b></label>
                      </div>';
                        }else{
                          echo '
                          <div id="colHonMes2" class="col-12 col-lg-9">
                          <div class="d-flex justify-content-evenly">
                          <div>
                          <label class="responsive-font-example fw-bold">'.obtenerNombreMes($mesGraficas1).' '.$anoGraficas1.'</label>
                          <div class="" style="display:inline-block; width:30px; height:20px; background-color:rgba(25, 170, 222,1);"></div>
                          </div>
                          <div >
                          <label class="responsive-font-example fw-bold">'.obtenerNombreMes($mesGraficas2).' '.$anoGraficas1.'</label>
                          <div class="" style="display:inline-block; width:30px; height:20px; background-color:rgba(125, 58, 193,1);"></div>
                          </div>
                        </div>
                        <div class="position-relative">
                         <canvas id="HonMes2" height="230px" ></canvas>
                         </div>
                         <label class="fs-6">Valores hasta: <b>'.(($fechacheck=="true")? 'Final del mes': 'Fecha Actual').'</b></label>
                      </div>';
                        }
                        ?>
                      </div>
                  </div>
                </div><div class="card mt-2">
                          <div class="card-body">
                          <div class="row justify-content-center ">
                            <?php
                            print ' <div class="col-7">';
                            print'<h6 class="text-center">Variación</h6>';
                            if ($variacionmes2<0) {
                              print '<p class=" text-danger fs-5 fw-bold text-center">'.$_SESSION['MONE'].'.'.number_format($variacionmes2,2, '.', ',').'</p>';
                            }elseif ($variacionmes2>0) {
                              print '<p class=" text-success fs-5 fw-bold text-center">'.$_SESSION['MONE'].'.'.number_format($variacionmes2,2, '.', ',').'</p>';
                            }else{
                              print '<p class=" fs-5 fw-bold text-center">'.$_SESSION['MONE'].'.'.number_format($variacionmes2,2, '.', ',').'</p>';
                            }
                            print '</div>';
                            print '<div class="col-5">';
                            print '<h6 class="text-center">Crecimiento</h6>';
                            if ($crecimientomes2<0) {
                              print '<p class=" text-danger fs-5 fw-bold text-center">'.number_format($crecimientomes2,0, '.', ',').'%</p>';
                            }elseif ($crecimientomes2>0) {
                              print '<p class=" text-success fs-5 fw-bold text-center">'.number_format($crecimientomes2,0, '.', ',').'%</p>';
                            }else{
                              print '<p class="fs-5 fw-bold text-center">'.number_format($crecimientomes2,0, '.', ',').'%</p>';
                            }
                          
                            print '</div>';
                            ?>
                            </div>
                          </div>
                        </div>
                        <div class="card mt-2">
                          <div class="card-body">
                          <h5 class="text-center fw-bold">Comparativo Mensual</h5>
                          <div class="row justify-content-center ">
                            <?php
                            echo ' <div id="colHonMes3" class="col-12  col-lg-9">
                                <div class="d-flex justify-content-evenly">
                                  <div>
                                  <label class="responsive-font-example fw-bold" >'.obtenerNombreMes($mesGraficas1).' '.$anoGraficas1.'</label>
                                  <div class="" style="display:inline-block; width:30px; height:20px; background-color:rgba(25, 170, 222,1);"></div>
                                  </div>
                                  <div >
                                  <label class="responsive-font-example fw-bold">'.obtenerNombreMes($mesGraficas1).' '.$anoGraficas2.'</label>
                                  <div class="" style="display:inline-block; width:30px; height:20px; background-color:rgba(125, 58, 193,1);"></div>
                                  </div>
                                 
                                </div>
                                <div class="position-relative">
                                <canvas id="HonMes3" height="230px" ></canvas>
                                </div>
                                <label class="fs-6">Valores hasta: <b>'.(($fechacheck=="true")? 'Final del mes': 'Fecha Actual').'</b></label>
                            </div>';
                            ?>
                            </div>
                          </div>
                        </div>
                        <div class="card mt-2">
                          <div class="card-body">
                          <div class="row justify-content-center ">
                          <?php
                            print ' <div class="col-7">';
                            print'<h6 class="text-center">Variación</h6>';
                            if ($variacionmes3<0) {
                              print '<p class=" text-danger fs-5 fw-bold text-center">'.$_SESSION['MONE'].'.'.number_format($variacionmes3,2, '.', ',').'</p>';
                            }elseif ($variacionmes3>0) {
                              print '<p class=" text-success fs-5 fw-bold text-center">'.$_SESSION['MONE'].'.'.number_format($variacionmes3,2, '.', ',').'</p>';
                            }else{
                              print '<p class=" fs-5 fw-bold text-center">'.$_SESSION['MONE'].'.'.number_format($variacionmes3,2, '.', ',').'</p>';
                            }
                            print '</div>';
                            print '<div class="col-5">';
                            print '<h6 class="text-center">Crecimiento</h6>';
                            if ($crecimientomes3<0) {
                              print '<p class=" text-danger fs-5 fw-bold text-center">'.number_format($crecimientomes3,0, '.', ',').'%</p>';
                            }elseif ($crecimientomes3>0) {
                              print '<p class=" text-success fs-5 fw-bold text-center">'.number_format($crecimientomes3,0, '.', ',').'%</p>';
                            }else{
                              print '<p class="fs-5 fw-bold text-center">'.number_format($crecimientomes3,0, '.', ',').'%</p>';
                            }
                          
                            print '</div>';
                            ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
        </div>
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

  <?php include 'php/index/graficas.php';?>
  <script>
    function obtenerNombreMes(numeroMes) {
              const nombresMes = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
              return nombresMes[numeroMes - 1];
            }
            var Mes1 = obtenerNombreMes(<?php echo $mesGraficas1; ?>);
            var Mes2 = obtenerNombreMes(<?php echo $mesGraficas2; ?>);
            var Anio1 = <?php echo $anoGraficas1; ?>;
            var Anio2 = <?php echo $anoGraficas2; ?>;
            var compFiltro = <?php echo $compFiltroP; ?>;

    $(document).ready(function () {
      $('#fechaCk').prop('checked', <?php echo  $fechacheck ?>);
      $("#cbbMesgra").val(compFiltro);
      $("#tituloGraficasVentas").empty();
      $("#tituloGraficasVentas").append($( "#cbbMesgra option:selected" ).text());
      $("#fechagra").val(formatoFecha("<?php echo $fechaGraficas; ?>"));

    });
    function formatoFecha(fecha) {
      let year = fecha.substring(0, 4);
      let month = fecha.substring(4, 6);
      let day = fecha.substring(6, 8);
      return year + "-" + month + "-" + day;
    }
  </script>
</body>


</html>