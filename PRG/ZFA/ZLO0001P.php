<!DOCTYPE html>
<html lang="es">
  <head>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
</head>
<body>
<div class="spinner-wrapper">
<div class="spinner-border text-danger" role="status">
    
</div>
</div> 
  <?php
      include '../layout-prg.php';
      $fecha_actual = date("Ymd");
      $mes_actual=date("m");
      $ano_actual=date("Y");
      $_SESSION['FechaFiltro'] = isset($_SESSION['fechapro']) && !empty($_SESSION['fechapro']) ? $_SESSION['fechapro'] : $fecha_actual;
      $_SESSION['MesFiltro'] = isset($_SESSION['mespro']) && !empty($_SESSION['mespro']) ? $_SESSION['mespro'] : $mes_actual;
      $_SESSION['AnoFiltro'] = isset($_SESSION['anopro']) && !empty($_SESSION['anopro']) ? $_SESSION['anopro'] : $ano_actual;
      $_SESSION['CompFiltro'] = isset($_SESSION['comppro']) && !empty($_SESSION['comppro']) ? "AND T1.CODCIA = ".$_SESSION['comppro'] : "AND T1.CODCIA > "."0";
      //VALIDACIONES JS
        $ckProductos = isset($_SESSION['productosCk']) ? $_SESSION['productosCk'] : "";
        $fechafiltro = isset($_SESSION['FechaFiltro']) ? $_SESSION['FechaFiltro'] : "";
        $compfiltro = isset($_SESSION['comppro']) && !empty($_SESSION['comppro']) ? $_SESSION['comppro'] : 0;
        $_SESSION['filtro'] = isset($_GET['fil']) ? $_GET['fil'] : "3";
        $_SESSION['opcion'] = isset($_GET['opc']) ? $_GET['opc'] : "1";
        $tablaDIA="";$tablaMES="";
       $sqlquery_zlo0001p = isset($_SESSION['logicSql']) ? $_SESSION['logicSql'] : " ";  
    ?> 
     <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
              <span>Modulo de facturación</span>
              </li>
              <li class="breadcrumb-item active"><span>ZLO0001P</span></li>
            </ol>
          </nav>
        </div>
      </header>
      <div id="body-div" class="body flex-grow-1">
        <div class="card mb-5">
          <div class="card-header">
          <h1 class="fs-4 mb-1 mt-2 text-center">Consulta de ventas resumidas</h1>
          </div>
          <div class="card-body">
            <form id="formFiltros" action="../../assets/php/ZFA/ZLO0001P/logic.php" method="POST">
          <div class="row mb-2">
              <div class="col-sm-12 col-lg-6 mt-2">
                <label>Compañía:</label>
                <select class="form-select" id="comppro" name="comppro" >
                    <option value="0" selected>Todas las compañías</option>
                  </select>
              </div>
              <div class="col-sm-12 col-lg-6 mt-2">
              <label>Fecha:</label>
               <input type="date" class="form-control" name="fechapro" id="fechapro" data-date-format="dd/mm/yyyy" onfocus="(this.type='date')" onkeydown="return false;">
              </div>
              <div class="btn-group mt-3 d-flex justify-content-center justify-content-md-start" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check " name="btnradio1" id="btnradio1" autocomplete="off">
                <label class="btn btn-outline-secondary responsive-font-example pt-3 pb-3" for="btnradio1"><b>Unidades</b></label>

                <input type="radio" class="btn-check" name="btnradio2"  id="btnradio2" autocomplete="off">
                <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3" for="btnradio2" id="btnnradio2"><b>Transacciones</b></label>

                <input type="radio" class="btn-check" name="btnradio3" id="btnradio3" autocomplete="off">
                <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3" for="btnradio3"><b>Valores Dólarizados</b></label>

                <input type="radio" class="btn-check" name="btnradio4" id="btnradio4" autocomplete="off" >
                <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3" for="btnradio4"><b>Moneda Nacional</b></label>
            </div>

          </div>
          </form>
          <hr>   
          <div class="demo">
                <ul class="tablist" role="tablist">
                    <li id="tab1" class="tablist__tab text-center p-3 is-active" aria-controls="panel1" aria-selected="true" role="tab" tabindex="0">Día y Mes</li>
                    <li id="tab2" class="tablist__tab text-center p-3 " aria-controls="panel1" aria-selected="true" role="tab" tabindex="0">Anual</li>
                    <li id="tab3" class="tablist__tab text-center p-3 " aria-controls="panel1" aria-selected="true" role="tab" tabindex="0">Promedio por Transacción</li>
                </ul>
                <div id="panel1" class="tablist__panel p-2" aria-labelledby="tab1" aria-hidden="false" role="tabpanel">
                 
                  
                  <div class="table-responsive">
                    
                    <table id="myTable" class="table stripe table-hover mt-2" style="width:100%" >
                   
                    <?php
                   
                    $label1="";$label2="";$label3="";$label4="";
                          switch ($_SESSION['filtro']) {
                            case 1:
                              $label1="Unidades día"; $label2="Unidades mes";
                              $label3="Unidades Anual"; $label4="Unidades Año Comparación";
                              break;
                              case 2:
                                $label1="Trans. día"; $label2="Trans. mes";
                                $label3="Trans. Anual"; $label4="Trans. Año Comparación";
                                break;
                            default:
                                 $label1="Ventas día"; $label2="Ventas mes";
                                 $label3="Venta Anual"; $label4="Venta Año Comparación";
                              break;
                          }                    
                       print ' <thead>';
                       print '         <tr>';
                       print '             <th class="text-start responsive-font-example d-none"></th>';
                       print '             <th class="text-start responsive-font-example d-none">ID</th>';
                       print '             <th class="text-start responsive-font-example" width="20%">Punto de venta</th>';
                       print '             <th id="thdia1" class="text-end responsive-font-example">'. $label1.'</th>';
                       print '             <th id="thdia2" class="text-end responsive-font-example">'. $label2.'</th>';
                       print '             <th id="thanual1" class="text-end responsive-font-example d-none">'.$label3.'</th>';
                       print '             <th id="thanual2" class="text-end responsive-font-example d-none">'.$label4.'</th>';
                       print '             <th id="thanual3" class="text-end responsive-font-example d-none">Variación</th>';
                       print '             <th id="thanual4" class="text-end responsive-font-example d-none">Crecimiento</th>';
                       if($_SESSION['filtro']!=2 ){ print '             <th id="thpro1" class="text-end responsive-font-example d-none">Promedio día</th>';
                       print '             <th id="thpro2" class="text-end responsive-font-example d-none">Promedio Mes</th>';
                       print '             <th id="thpro3"  class="text-end responsive-font-example d-none">Año '.$_SESSION['AnoFiltro'].'</th>';
                       print '             <th id="thpro4" class="text-end responsive-font-example d-none">Año '.($_SESSION['AnoFiltro']-1).'</th>';
                       print '             <th id="thpro5" class="text-end responsive-font-example d-none">Variación</th>';
                       print '             <th id="thpro6" class="text-end responsive-font-example d-none">Crecimiento</th>';}
                       print '         </tr>';
                       print '     </thead>';
                       print '     <tbody id="myTableBody">';
                          ?>
                        </tbody>
                        </table>
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
      <?php include '../../assets/js/PRG/ZFA/ZLO0001P.php'; ?>
</body>

</html>
