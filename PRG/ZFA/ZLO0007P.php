<!DOCTYPE html>
<html lang="es">
  <head>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
  <link rel="stylesheet" href="../../assets/vendors/dayrangepicker/index.css">
  <style>
    
  </style>
</head>
<body>
<div class="spinner-wrapper">
    <div class="spinner-border text-danger" role="status">
    </div>
  </div>
<?php
      include '../layout-prg.php';
      $_SESSION['tab'] = isset($_COOKIE['tabselected']) ? $_COOKIE['tabselected'] : "1";
      $mes_actual=date("m");
      $ano_actual=date("Y");
      $dia_actual=date("d");
      $mesFiltro1= isset($_SESSION['mesFiltro1'])? (strlen($_SESSION['mesFiltro1'])==1)? '0'.$_SESSION['mesFiltro1']:$_SESSION['mesFiltro1']: $mes_actual;
      $anoFiltro1= isset($_SESSION['anoFiltro1'])? trim($_SESSION['anoFiltro1']): $ano_actual;
      $diaFiltro1= isset($_SESSION['diaFiltro1'])? (strlen($_SESSION['diaFiltro1'])==1)? '0'.$_SESSION['diaFiltro1']:$_SESSION['diaFiltro1']: "01";
      $mesFiltro2= isset($_SESSION['mesFiltro2'])? (strlen($_SESSION['mesFiltro2'])==1)? '0'.$_SESSION['mesFiltro2']:$_SESSION['mesFiltro2']: $mes_actual;
      $anoFiltro2= isset($_SESSION['anoFiltro2'])? trim($_SESSION['anoFiltro2']): $ano_actual;
      $diaFiltro2= isset($_SESSION['diaFiltro2'])? (strlen($_SESSION['diaFiltro2'])==1)? '0'.$_SESSION['diaFiltro2']:$_SESSION['diaFiltro2']: $dia_actual;


      $ciaFiltro=isset($_SESSION['ciaFiltro'])? $_SESSION['ciaFiltro']:999;
      $paisFiltro=isset($_SESSION['paisFiltro'])? $_SESSION['paisFiltro']:1;
      $cia=" AND CODCIA IN(35,47,50,52,56,57,59,63,64,65,68,70,72,73,74,75,76,78,82,85)";

      if (isset($_SESSION['clickPais']) && isset($_SESSION['clickCia'])) {
        if ($_SESSION['clickCia']==1) {
          if ($ciaFiltro==1 ||$ciaFiltro==35 || $ciaFiltro==47 || $ciaFiltro==50 || $ciaFiltro==52 || $ciaFiltro==56 || $ciaFiltro==57 || $ciaFiltro==59
          || $ciaFiltro==63 || $ciaFiltro==64 || $ciaFiltro==65 || $ciaFiltro==68 || $ciaFiltro==70 || $ciaFiltro==72 || $ciaFiltro==73
          || $ciaFiltro==74 || $ciaFiltro==75 || $ciaFiltro==76 || $ciaFiltro==78 || $ciaFiltro==82 || $ciaFiltro==85) {
            $paisFiltro=1;
          }elseif ($ciaFiltro==20 || $ciaFiltro==21|| $ciaFiltro==22|| $ciaFiltro==23|| $ciaFiltro==24) {
            $paisFiltro=2;
          }elseif ($ciaFiltro==49 || $ciaFiltro==66 || $ciaFiltro==69 || $ciaFiltro==71 || $ciaFiltro==86) {
            $paisFiltro=3;
          }elseif ($ciaFiltro==48 || $ciaFiltro==53 || $ciaFiltro==61 || $ciaFiltro==62|| $ciaFiltro==77) {
            $paisFiltro=4;
          }elseif ($ciaFiltro==60 || $ciaFiltro==80 || $ciaFiltro==54) {
            $paisFiltro=5;
          }elseif ($ciaFiltro==83 || $ciaFiltro==87) {
            $paisFiltro=6;
          }elseif ($ciaFiltro==81) {
            $paisFiltro=7;
          }
          
          if ($ciaFiltro==999) {
            $cia= " AND CODCIA IN(35,47,50,52,56,57,59,63,64,65,68,70,72,73,74,75,76,78,82,85)";
            $paisFiltro=1;
          }else{
            $cia=" AND CODCIA IN(".$ciaFiltro.")";
          }
        }
        if ($_SESSION['clickPais']==1) {
          $ciaFiltro=999;
          if ($paisFiltro==1) {
            $cia=" AND CODCIA IN(35,47,50,52,56,57,59,63,64,65,68,70,72,73,74,75,76,78,82,85)";
          }elseif ($paisFiltro==2) {
            $cia=" AND CODCIA IN(20,22,21,23,24)";
          }elseif ($paisFiltro==3) {
            $cia=" AND CODCIA IN(49,66,69,71,86)";
          }elseif ($paisFiltro==4) {
            $cia=" AND CODCIA IN(48,53,61,62,77)";
          }elseif ($paisFiltro==5) {
            $cia=" AND CODCIA IN(60,80,54)";
          }elseif ($paisFiltro==6) {
            $cia=" AND CODCIA IN(83,87)";
          }elseif ($paisFiltro==7) {
            $cia=" AND CODCIA IN(81)";
          }
         
        }
        
      }
     
      
      

  //VENTAS
    $sqlVentas="SELECT T1.CODVEN, T1.MAENO3, T1.CANTRA, T1.CANTID, T1.VALOR VALOR1, T2.VALOR VALOR2, T3.VALOR VALOR3 FROM                   
    (SELECT CODVEN, MAENO3, SUM(CANTRA) CANTRA,SUM(CANTID)              
    CANTID,SUM(VALOR) VALOR                                             
    FROM LBPRDDAT/LO1617 T1 INNER JOIN LBPRDDAT/MAEA01 T2               
    ON T1.CODCIA=T2.MAEC14 AND T1.CODVEN=T2.MAEC15                      
    WHERE FECPRO BETWEEN ".$anoFiltro1.$mesFiltro1.$diaFiltro1." AND ".$anoFiltro2.$mesFiltro2.$diaFiltro2." ".$cia."                                                                
    GROUP BY CODVEN, MAENO3)T1 left JOIN
    (SELECT CODVEN, SUM(CANTRA) CANTRA,SUM(CANTID)              
    CANTID,SUM(VALOR) VALOR FROM LBPRDDAT/LO1617 T1 WHERE FECPRO BETWEEN ".($anoFiltro1-1).$mesFiltro1.$diaFiltro1." AND ".($anoFiltro2-1).$mesFiltro2.$diaFiltro2." ".$cia."                                                                
    GROUP BY CODVEN)T2 ON T1.CODVEN=T2.CODVEN  left JOIN
    (SELECT CODVEN, SUM(CANTRA) CANTRA,SUM(CANTID)              
    CANTID,SUM(VALOR) VALOR FROM LBPRDDAT/LO1617 T1 WHERE FECPRO BETWEEN ".($anoFiltro1-2).$mesFiltro1.$diaFiltro1." AND ".($anoFiltro2-2).$mesFiltro2.$diaFiltro2." ".$cia."                                                                
    GROUP BY CODVEN)T3 ON T1.CODVEN=T3.CODVEN
    ORDER BY VALOR1 DESC ";
    
    $resultVentas=odbc_exec($connIBM,$sqlVentas);
    
   //COMBOBOX
   $sqlCOMARC = "SELECT T2.CODSEC,LO0705.CODCIA COMCOD, LO0705.NOMCIA COMDES 
   FROM LBPRDDAT/LO0705
   INNER JOIN LBPRDDAT/LO0686 AS T2 ON T2.CODCIA = LO0705.CODCIA
   ORDER BY T2.CODSEC";
   $resultCOMARC=odbc_exec($connIBM,$sqlCOMARC);
?>
     <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <span>Modulo de facturación</span>
              </li>
              <li class="breadcrumb-item active"><span>ZLO0007P</span></li>
            </ol>
          </nav>
        </div>
      </header>
      <div id="body-div" class="body flex-grow-3">
          <div class="card mb-5">
            <div class="card-header">
              <h1 class="fs-4 mb-1 mt-2 text-center">Consulta de ventas por vendedor</h1>
            </div>
            <div class="card-body">
          <div class="position-relative">
              <form id="formFiltros" action="../../assets/php/ZFA/ZLO0007P/filtroLogica.php" method="POST">
                <input class="d-none" id="cbbClick" name="cbbClick"/>
                <div class="row mb-2">
                <div class="col-sm-12 col-lg-4 mt-2">
                        <label>Punto de Venta:</label>
                        <select class="form-select  mt-1" id="cbbCia" name="cbbCia">
                        <option value="999">Todos los puntos de ventas</option>
                          <?php
                          while ($rowCOMARC = odbc_fetch_array($resultCOMARC)) {
                            echo "<option value='" . $rowCOMARC['COMCOD'] . "'>" . rtrim(utf8_encode($rowCOMARC['COMDES'])) . "</option>";
                          }
                          ?>
                        </select>
                      </div>
                      <div class="col-sm-12 col-lg-4 mt-2">
                        <label>País:</label>
                        <select class="form-select  mt-1" id="cbbPais" name="cbbPais">
                          <option value="1">Honduras (Lov. Ecommerce)</option>
                          <option value="2">Honduras (Mod. Íntima)</option>
                          <option value="3">Guatemala</option>
                          <option value="4">El Salvador</option>
                          <option value="5">Costa Rica</option>
                          <option value="6">Nicaragua</option>
                          <option value="7">Rep. Dominicana</option>
                        </select>
                      </div>
                      <div class="col-sm-12 col-lg-4  mt-2">
                      <label>Fecha:</label>
                        <div class="input-group mt-1">
                        <input class="form-control" id="datepicker2" name="datepicker2"/>
                        <span class="input-group-text" id="basic-addon2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                          <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                        </svg></span>
                        </div>
                      </div>
                </div>
              </form>
              </div>
              <hr>
             <div id="grafica1" class="mt-3 mb-4">
             <div id="carouselExampleDark" class="carousel carousel-dark slide"  data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                  <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3" aria-label="Slide 4"></button>
                  <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="4" aria-label="Slide 5"></button>
                </div>
                <div class="carousel-inner">
                <div class="carousel-item active">
                                  <div class="me-5 ms-5">
                                      <figure class="highcharts-figure" >
                                                <div id="container" ></div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                <div class="me-5 ms-5">
                                      <figure class="highcharts-figure" >
                                                <div id="container2" ></div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                <div class="me-5 ms-5">
                                      <figure class="highcharts-figure" >
                                                <div id="container3" ></div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                <div class="me-5 ms-5">
                                      <figure class="highcharts-figure" >
                                                <div id="container4" ></div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                <div class="me-5 ms-5">
                                   
                                      <div id="ventaRadial" class="PaddingRadial">
                                      <h5 class="text-center">Venta y Venta 2 Años Antes </h5>
                                      <h5 class="text-center" id="lblRadial"></h5>
                                          <div class="d-flex justify-content-evenly">
                                          <div>
                                          <label class="responsive-font-example fw-bold">Venta Año Actual</label>
                                          <div class="" style="display:inline-block; width:30px; height:20px; background-color:rgba(25, 170, 222,1);"></div>
                                          </div>
                                          <div >
                                          <label class="responsive-font-example fw-bold">Venta 2 Años Antes</label>
                                          <div class="" style="display:inline-block; width:30px; height:20px; background-color:rgba(125, 58, 193,1);"></div>
                                          </div>
                                        </div>
                                        <div class="" style="height:450px; ">
                                        <canvas id="compRadial" ></canvas>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
             </div>
             <hr>
                    <div class="table-responsive mt-3" style="width:100%">
                          <table id="myTableVendedorVentas" class="table stripe table-hover " style="width:100%">
                            <thead>
                                <tr>
                                    <th class=" text-start">Vendedor</th>
                                    <th  class=" text-end" >Transacciones</th>
                                    <th  class=" text-end" >Unidades</th>
                                    <th  class=" text-end" >Venta</th>
                                    <th  class=" text-end">Promedio de Ventas</th>
                                    <th  class=" text-end">Venta Año Anterior</th>
                                    <th  class=" text-end">Variación</th>
                                    <th  class=" text-end">Crecimiento</th>
                                    <th  class=" text-end">Venta 2 Años Antes</th>
                                    <th  class=" text-end">Variación2</th>
                                    <th  class=" text-end">Crecimiento</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                 $validator1="true";
                                 $vendedoresLabel[]=array();$cont=0;
                                 $v1[]=array();$v2[]=array();$v3[]=array();
                                 $transacciones[]=array();
                                 $vendedoresUnidades[]=array();$vendedoresVentas[]=array();
                                 $vendedoresUnidades2[]=array();$vendedoresVentas2[]=array();
                                 $venano1=0; $venano2=0;
                                  while($rowVen = odbc_fetch_array($resultVentas)){
                                    $validator1="false";
                                    $promVen=($rowVen['CANTRA']!=0)? $rowVen['VALOR1']/$rowVen['CANTRA']:' ';
                                    $docenas=floor($rowVen['CANTID'])*12;
                                    $decimales=($rowVen['CANTID']!=0)?substr($rowVen['CANTID'],strpos($rowVen['CANTID'],".")+1,2):0;
                                    $cantidad=0;
                                    $cantidad=$docenas+$decimales;
                                   

                                    $variacion1=$rowVen['VALOR1']-$rowVen['VALOR2'];
                                    $variacion2=$rowVen['VALOR1']-$rowVen['VALOR3'];
                                    $crecimiento1=0; $crecimiento2=0;
                                    if ($rowVen['VALOR2']!=0 ) {
                                      $crecimiento1 = round((($rowVen['VALOR1']/$rowVen['VALOR2'])-1)*100);
                                    }
                                    if ($rowVen['VALOR3']!=0) {
                                      $crecimiento2 = round((($rowVen['VALOR1']/$rowVen['VALOR3'])-1)*100);
                                    }
                                    
                                    print '<tr>';
                                    print '<td  class=" text-start fw-bold">'.rtrim(utf8_encode($rowVen['MAENO3'])).'</td>';
                                    print '<td  class=" text-end">'.number_format($rowVen['CANTRA'],0).'</td>';
                                    print '<td  class=" text-end">'.$cantidad.'</td>';
                                    print '<td  class=" text-end fw-bold">'.(($rowVen['VALOR1']!=0)? number_format($rowVen['VALOR1'],2):' ').'</td>';
                                    print '<td  class=" text-end fw-bold">'.number_format($promVen,2).'</td>';
                                    print '<td  class=" text-end fw-bold">'.(($rowVen['VALOR2']!=0)? number_format($rowVen['VALOR2'],2):' ').'</td>';
                                    print ($variacion1<0)? '<td  class=" text-end text-danger">'.(($variacion1!=0)? number_format($variacion1,2):' ').'</td>':'<td  class=" text-end text-success">'.(($variacion1!=0)? number_format($variacion1,2):' ').'</td>';
                                    print ($crecimiento1<0)? '<td  class=" text-end text-danger">'.number_format($crecimiento1,0).'%'.'</td>': ($crecimiento1>0)? '<td  class=" text-end text-success">'.number_format($crecimiento1,0).'%'.'</td>':'<td  class=" text-end">'.number_format($crecimiento1,0).'%'.'</td>';
                                    print '<td  class=" text-end fw-bold">'.(($rowVen['VALOR3']!=0)? number_format($rowVen['VALOR3'],2):' ').'</td>';
                                    print ($variacion2<0)? '<td  class=" text-end text-danger">'.(($variacion2!=0)? number_format($variacion2,2):' ').'</td>':'<td  class=" text-end text-success">'.(($variacion2!=0)? number_format($variacion2,2):' ').'</td>';
                                    print ($crecimiento2<0)? '<td  class=" text-end text-danger">'.number_format($crecimiento2,0).'%'.'</td>': ($crecimiento2>0)? '<td  class=" text-end text-success">'.number_format($crecimiento2,0).'%'.'</td>':'<td  class=" text-end">'.number_format($crecimiento2,0).'%'.'</td>';
                                    print '</tr>';
                                    $vendedoresLabel[$cont]=rtrim(utf8_encode($rowVen['MAENO3']));
                                    $v1[$cont]=floatval(($rowVen['VALOR1']!=0)? number_format($rowVen['VALOR1'],2, '.', ''):0);
                                    $v2[$cont]=floatval(($rowVen['VALOR2']!=0)? number_format($rowVen['VALOR2'],2, '.', ''):0);
                                    $v3[$cont]=floatval(($rowVen['VALOR3']!=0)? number_format($rowVen['VALOR3'],2, '.', ''):0);
                                    $transacciones[$cont]=floatval(number_format($rowVen['CANTRA'],0, '.', ''));
                                    $vendedoresUnidades[$cont]=array(rtrim(utf8_encode($rowVen['MAENO3'])) => $cantidad);
                                    $vendedoresUnidades2[$cont]=floatval(number_format($cantidad,2, '.', ''));
                                    $vendedoresVentas[$cont]=array(rtrim(utf8_encode($rowVen['MAENO3'])) => floatval(($rowVen['VALOR1']!=0)? number_format($rowVen['VALOR1'],2, '.', ''):0));
                                    $vendedoresVentas2[$cont]=floatval(($rowVen['VALOR1']!=0)? number_format($rowVen['VALOR1'],2, '.', ''):0);
                                    $venano1+=$rowVen['VALOR1'];
                                    $venano2+=$rowVen['VALOR2'];
                                    $cont++;
                                  }
                                ?>
                              </tbody>
                          </table>
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
      <script>
        var mesFiltro1= "<?php echo $mesFiltro1; ?>";
        var anoFiltro1= "<?php echo $anoFiltro1; ?>";
        var diaFiltro1= "<?php echo $diaFiltro1; ?>";
        var mesFiltro2= "<?php echo $mesFiltro2; ?>";
        var anoFiltro2= "<?php echo $anoFiltro2; ?>";
        var diaFiltro2= "<?php echo $diaFiltro2; ?>";

        var Date1=diaFiltro1+'/'+mesFiltro1+'/'+anoFiltro1;
        var Date2=diaFiltro2+'/'+mesFiltro2+'/'+anoFiltro2;
       
      </script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
      <script src="../../assets/vendors/dayrangepicker/index.umd.min.js"></script>
      <script src="https://code.highcharts.com/stock/highstock.js"></script>
      <script src="https://code.highcharts.com/highcharts-3d.js"></script>
      <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
      <script src="https://code.highcharts.com/stock/modules/accessibility.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
  <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
     <?php include '../../assets/php/ZFA/ZLO0007P/ZLO0007P.php'; ?>
    
</body>
</html>