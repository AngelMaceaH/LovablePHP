<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
</head>
  <body>
    <?php
      include 'layout.php';
      $fecha_actual = date("Ymd");
      $mes_actual=date("m");
      $ano_actual=date("Y");
      
      $fechaGraficas=isset($_GET['d'])? $_GET['d']:$fecha_actual;
      $mesGraficas=isset($_GET['m'])? $_GET['m']:$mes_actual;
      $anoGraficas=isset($_GET['y'])? $_GET['y']:$ano_actual;
      $sqlGraficasDias="SELECT T2.CODCIA,T2.NOMCIA NOMCIA, SUM(TOTAL) TOTAL FROM (SELECT CODCIA,VENDIA AS TOTAL FROM LBPRDDAT/LO2132
      WHERE FECFAC=".$fechaGraficas." UNION ALL
      SELECT CODCIA as CODCIA,SUBTOT AS TOTAL FROM LBPRDDAT/LO0849 WHERE FECPRO=".$fechaGraficas."
      UNION ALL SELECT codcia,0 AS TOTAL FROM LBPRDDAT/LO0849	
      WHERE NOT EXISTS ( SELECT 1 FROM LBDESDAT/LO0849 WHERE fecpro = ".$fechaGraficas.")  GROUP BY CODCIA) AS T1 
      INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA
      INNER JOIN LBPRDDAT/DETA1699 AS T3 ON T3.DETC90=T1.CODCIA WHERE T3.DETUSU='MARVIN' AND T3.DETPR1 = 'LO1512P' GROUP BY T2.CODCIA,T2.NOMCIA ORDER BY CODCIA";
      $resultG=odbc_exec($connIBM,$sqlGraficasDias);
      $compHonduras=array();$vendiaHonduras=array(); $compGuatemala=array(); $vendiaGuatemala=array();$compElSalvador=array(); $vendiaElSalvador=array();
      $compNicaragua=array(); $vendiaNicaragua=array();$compCostaRica=array(); $vendiaCostaRica=array();$compRepDomi=array(); $vendiaRepDomi=array();
      while ($rowG= odbc_fetch_array($resultG)) {
        $codcia=$rowG['CODCIA'];
        $vendia=$rowG['TOTAL'];
        if ((float)$vendia !=0) {
        if (in_array($codcia, array(1, 35, 47,57,52,63,64,72,74,20,22,56,59,65,68,75,76,85,70,73,78,82))) {
            $compHonduras[]=$rowG['NOMCIA'];
            $vendiaHonduras[] = (float)$vendia;
        }
        if (in_array($codcia, array(49,66,69,71,86))) {
            $compGuatemala[]=$rowG['NOMCIA'];
            $vendiaGuatemala[] = (float)$vendia;
        }
        if (in_array($codcia, array(48,53,62,61))) {
            $compElSalvador[]=$rowG['NOMCIA'];
            $vendiaElSalvador[] = (float)$vendia;
        }
        if (in_array($codcia, array(83,87))) {
            $compNicaragua[]=$rowG['NOMCIA'];
            $vendiaNicaragua[] = (float)$vendia;
        }
        if (in_array($codcia, array(60,80))) {
            $compCostaRica[]=$rowG['NOMCIA'];
            $vendiaCostaRica[] = (float)$vendia;
        }
          if (in_array($codcia, array(81))) {
              $compRepDomi[]=$rowG['NOMCIA'];
              $vendiaRepDomi[] = (float)$vendia;
          }
        }
      }

      $compMesHonduras=array(); $venmesHonduras=array();$compMesGuatemala=array(); $venmesGuatemala=array();$compMesElSalvador=array(); $venmesElSalvador=array();
      $compMesNicaragua=array(); $venmesNicaragua=array(); $compMesCostaRica=array(); $venmesCostaRica=array();$compMesRepDom=array(); $venmesRepDom=array();
      $sqlGraficasMes="SELECT T2.CODCIA CODCIA, T2.NOMCIA NOMCIA, SUM(SUBTOT) SUBTOT FROM(
        SELECT codcia, subtot FROM LBPRDDAT/LO0850 
        WHERE MESPRO = ".$mesGraficas." AND ANOPRO =".$anoGraficas." UNION ALL SELECT codcia, 0 AS subtot FROM LBPRDDAT/LO0850 
        WHERE NOT EXISTS (SELECT 1 FROM LBDESDAT/LO0850 WHERE MESPRO= ".$mesGraficas." AND ANOPRO=".$anoGraficas." )GROUP BY CODCIA) AS T1
        INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA
        INNER JOIN LBPRDDAT/DETA1699 AS T3 ON T3.DETC90=T1.CODCIA WHERE T3.DETUSU='MARVIN' AND T3.DETPR1 = 'LO1512P' GROUP BY T2.CODCIA,T2.NOMCIA ORDER BY CODCIA";
      $resultM=odbc_exec($connIBM,$sqlGraficasMes); 
      while ($rowM= odbc_fetch_array($resultM)) { 
        $codMes=$rowM['CODCIA'];
        $venmes=$rowM['SUBTOT'];
        if ((float)$venmes !=0) {
        if (in_array($codMes, array(1, 35, 47,57,52,63,64,72,74,20,22,56,59,65,68,75,76,85,70,73,78,82))) {
            $compMesHonduras[]=$rowM['NOMCIA'];
            $venmesHonduras[] = (float)$venmes;
        }
        if (in_array($codMes, array(49,66,69,71,86))) {
            $compMesGuatemala[]=$rowM['NOMCIA'];
            $venmesGuatemala[] = (float)$venmes;
        }
        if (in_array($codMes, array(48,53,62,61))) {
          $compMesElSalvador[]=$rowM['NOMCIA'];
          $venmesElSalvador[] = (float)$venmes;
      }
      if (in_array($codMes, array(83,87))) {
          $compMesNicaragua[]=$rowM['NOMCIA'];
          $venmesNicaragua[] = (float)$venmes;
      }
      if (in_array($codMes, array(60,80))) {
          $compMesCostaRica[]=$rowM['NOMCIA'];
          $venmesCostaRica[] = (float)$venmes;
      }
        if (in_array($codMes, array(81))) {
            $compMesRepDom[]=$rowM['NOMCIA'];
            $venmesRepDom[] = (float)$venmes;
        }
       }
      }
    ?>
        <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><span>Inicio</span>
              </li>
              <li class="breadcrumb-item active"><span>Pagina Principal</span></li>
            </ol>
          </nav>
        </div>
      </header>
      <div class="body flex-grow-1 px-3">
        <div class="container-lg">
      <!--  <div class="d-flex justify-content-center">
            <div>
              <div class="card mb-4 text-white bg-primary me-1">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">Lunes</div>
                    <div>Users</div>
                  </div>
                </div>
              </div>
            </div>

            <div>
              <div class="card mb-4 text-white bg-primary  me-1">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">Martes</div>
                    <div>Users</div>
                  </div>
                </div>
              </div>
            </div>
    
            <div>
              <div class="card mb-4 text-white bg-primary  me-1">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">Miércoles</div>
                    <div>Users</div>
                  </div>
                </div>
              </div>
            </div>
         
            <div>
              <div class="card mb-4 text-white bg-primary  me-1">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">Jueves</div>
                    <div>Users</div>
                  </div>
                </div>
              </div>
            </div>
         
            <div>
              <div class="card mb-4 text-white bg-primary  me-1">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">Viernes</div>
                    <div>Users</div>
                  </div>
                </div>
              </div>
            </div>
      
            <div>
              <div class="card mb-4 text-white bg-primary  me-1">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">Sábado</div>
                    <div>Users</div>
                  </div>
                </div>
              </div>
            </div>
         
            <div>
              <div class="card mb-4 text-white bg-primary  me-1">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">Domingo</div>
                    <div>Users</div>
                  </div>
                </div>
              </div>
            </div>
      
          </div>-->
          <!-- /.row-->
          
        <div class="card">
          <div class="card-body">
          <form id="formGraficas" action="grafica-filtro.php" method="POST">
          <div class="row mb-2">
              <div class="col-sm-12 col-lg-6 mt-2">
                <label>Fecha:</label>
                <input type="date" class="form-control" name="fechagra" id="fechagra" data-date-format="dd/mm/yyyy" onfocus="(this.type='date')" onkeydown="return false;">
              </div>
              <div class="col-sm-12 col-lg-6 mt-2">
                <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <label>Mes:</label>
                    <select class="form-control" id="cbbMesgra" name="cbbMesgra">
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
                  <div class="col-sm-12 col-lg-6">
                  <label>Año:</label>
                    <select class="form-control" id="cbbAnogra" name="cbbAnogra">
                      <?php
                        $anio_actual = date('Y');
                            for ($i = $anio_actual; $i >= 1990; $i--) {
                                 echo "<option value='$i'>$i</option>";
                                  }
                        ?>
                  </select>
                  </div>
                  </div>
              </div>
          </div>
          </form>
          </div>
        </div>
        <div class="card mt-2">
          <div class="card-header"></div>
          <div class="card-body"><canvas id="GraficaBarra" class="mt-2 mb-2"></canvas></div>
          <div class="card-footer"></div>
        </div>
        
        <div class="padding-graficas mb-4">
        <div class="row mt-1">
          <!--HONDURAS-->
          <div class="col-12 col-md-6" >
          <div class="row">
            <div class="col-12 col-md-12" >
           <!--<div class="card bg-blck">
              <h2 class="text-center mt-2 text-light">Honduras</h2>
              <hr class="text-light">
             </div>-->
             <div class="card">
              <div class="card-header">
              <h4 class="text-center fw-bold">Honduras</h4>
              </div>
              <div class="card-body">
             <div id="HonRow">
                <?php
                if (count($vendiaHonduras)>0) {
                  echo '<div id="colHonDia"  class="justify-content-center">
                  <h5 class="mt-2 mb-1 text-center">Ventas del día</h5>
                <canvas  id="HonDia" class="mt-3 mb-3" ></canvas>
                </div>';
                echo "<script>  $('#HonRow').addClass('row'); $('#colHonDia').addClass('col-12 col-md-6');</script>";
                }else{
                  echo "<script> $('#HonRow').removeClass(); $('#colHonMes').removeClass();  $('#HonRow').addClass('d-flex justify-content-center'); </script>";
                }
                if (count($venmesHonduras)>0) {
                  echo '<div id="colHonMes" class="col-12 col-md-6">
                  <h5 class="mt-2 mb-1 text-center">Ventas del Mes</h5>
                  <canvas  id="HonMes" class="mt-3 mb-3" ></canvas>
                  </div>';
                  echo "<script>  $('#HonRow').addClass('row'); $('#colHonMes').addClass('col-12 col-md-6');</script>";
                }else{
                  echo "<script> $('#HonRow').removeClass(); $('#colHonDia').removeClass();  $('#HonRow').addClass('d-flex justify-content-center'); </script>";
                }
                ?>
                </div>
             </div>
            <!-- <div class="card-footer"></div>-->
             </div>
            </div>
            </div>
          </div>
          <!--GUATEMALA-->
          <div class="col-12 col-md-6" >
          <div class="row">
          <div class="col-12 col-md-12" >
          <div class="card">
              <div class="card-header">
              <h4 class="text-center fw-bold">Guatemala</h4>
              </div>
              <div class="card-body">
             <div id="GuaRow">
              <?php
               if (count($vendiaGuatemala)>0) {
                echo '<div id="colGuaDia">
                <h5 class="mt-2 mb-1 text-center">Ventas del día</h5>
              <canvas id="GuaDia" class="mt-3 mb-3" ></canvas>
              </div>';
                echo "<script>  $('#GuaRow').addClass('row'); $('#colGuaDia').addClass('col-12 col-md-6');</script>";
              }else{
                echo "<script> $('#GuaRow').removeClass(); $('#colGuaMes').removeClass();  $('#GuaRow').addClass('d-flex justify-content-center'); </script>";
              }
              if (count($venmesGuatemala)>0) {
                echo ' <div id="colGuaMes">
                <h5 class="mt-2 mb-1 text-center">Ventas del Mes</h5>
                <canvas id="GuaMes" class="mt-3 mb-3" ></canvas>
                </div>';
                echo "<script>  $('#GuaRow').addClass('row'); $('#colGuaMes').addClass('col-12 col-md-6');</script>";
              }else{
                echo "<script> $('#GuaRow').removeClass(); $('#colGuaDia').removeClass();  $('#GuaRow').addClass('d-flex justify-content-center'); </script>";
              }
              ?>
             </div>
             </div>
             </div>
            </div>
            </div>
            </div>
            <!--EL SALVADOR-->
            <div class="col-12 col-md-6" >
            <div class="row">
            <div class="col-12 col-md-12" >
            <div class="card mt-2">
              <div class="card-header">
              <h4 class="text-center fw-bold">El Salvador</h4>
              </div>
              <div class="card-body">
             <div id="SalRow">
             <?php
               if (count($vendiaElSalvador)>0) {
                echo '<div id="colSalDia">
                <h5 class="mt-2 mb-1 text-center">Ventas del día</h5>
              <canvas id="SalDia" class="mt-3 mb-3" ></canvas>
              </div>';
              echo "<script>  $('#SalRow').addClass('row'); $('#colSalDia').addClass('col-12 col-md-6');</script>";
               }else{
                echo "<script> $('#SalRow').removeClass(); $('#colSalDia').removeClass();  $('#SalRow').addClass('d-flex justify-content-center'); </script>";
              }
              if (count($venmesElSalvador)>0) {
                echo '<div id="colSalMes">
                <h5 class="mt-2 mb-1 text-center">Ventas del Mes</h5>
                <canvas id="SalMes" class="mt-3 mb-3" ></canvas>
                </div>';
                echo "<script>  $('#SalRow').addClass('row'); $('#colSalMes').addClass('col-12 col-md-6');</script>";
              }else{
                echo "<script> $('#SalRow').removeClass(); $('#colSalMes').removeClass();  $('#SalRow').addClass('d-flex justify-content-center'); </script>";
              }
              ?>

             </div>
             </div>
             </div>
             </div>
             </div>
            </div>
               <!--COSTA RICA-->
               <div class="col-12 col-md-6" >
               <div class="row">
               <div class="col-12 col-md-12" >
               <div class="card mt-2">
              <div class="card-header">
              <h4 class="text-center fw-bold">Costa Rica</h4>
              </div>
              <div class="card-body">
              <div id="CosRow">
              <?php
               if (count($vendiaCostaRica)>0) {
               echo '<div id="colCosDia">
                  <h5 class="mt-2 mb-1 text-center">Ventas del día</h5>
                <canvas id="CosDia" class="mt-3 mb-3" ></canvas>
                </div>';
                echo "<script>  $('#CosRow').addClass('row'); $('#colCosDia').addClass('col-12 col-md-6');</script>";
              }else{
               echo "<script> $('#CosRow').removeClass(); $('#colCosDia').removeClass();  $('#CosRow').addClass('d-flex justify-content-center'); </script>";
             }
             if (count($venmesCostaRica)>0) { 
                echo '<div id="colCosMes">
                <h5 class="mt-2 mb-1 text-center">Ventas del Mes</h5>
                <canvas id="CosMes" class="mt-3 mb-3" ></canvas>
                </div>';
                echo "<script>  $('#CosRow').addClass('row'); $('#colCosMes').addClass('col-12 col-md-6');</script>";
              }else{
                echo "<script> $('#CosRow').removeClass(); $('#colCosMes').removeClass();  $('#CosRow').addClass('d-flex justify-content-center'); </script>";
              }
                ?>
             </div>
            </div>
            </div>
            </div>
            </div>
            </div>
               <!--REP. DOMINICANA-->
               <div class="col-12 col-md-6" >
               <div class="row">
               <div class="col-12 col-md-12" >
               <div class="card mt-2">
              <div class="card-header">
              <h4 class="text-center fw-bold">Rep. Dominicana</h4>
              </div>
              <div class="card-body">
             <div id="RepRow">
             <?php
               if (count($vendiaRepDomi)>0) {
                echo '<div id="colRepDia">
                  <h5 class="mt-2 mb-1 text-center">Ventas del día</h5>
                <canvas id="DomDia" class="mt-3 mb-3" ></canvas>
                </div>';
                echo "<script>  $('#RepRow').addClass('row'); $('#colRepDia').addClass('col-12 col-md-6');</script>";
              }else{
               echo "<script> $('#RepRow').removeClass(); $('#colRepDia').removeClass();  $('#RepRow').addClass('d-flex justify-content-center'); </script>";
             }
             if (count($venmesRepDom)>0) { 
                echo '<div id="colRepMes">
                <h5 class="mt-2 mb-1 text-center">Ventas del Mes</h5>
                <canvas id="DomMes" class="mt-3 mb-3" ></canvas>
                </div>';
                echo "<script>  $('#RepRow').addClass('row'); $('#colRepMes').addClass('col-12 col-md-6');</script>";
              }else{
                echo "<script> $('#RepRow').removeClass(); $('#colRepMes').removeClass();  $('#RepRow').addClass('d-flex justify-content-center'); </script>";
              }
                ?>
             </div>
            </div>
            </div>
            </div>
            </div>
            </div>
               <!--NICARAGUA-->
               <div class="col-12 col-md-6" >
               <div class="row">
               <div class="col-12 col-md-12" >
               <div class="card mt-2">
              <div class="card-header">
              <h4 class="text-center fw-bold">Nicaragua</h4>
              </div>
              <div class="card-body">
              <div id="NicaRow">
             <?php
               if (count($vendiaNicaragua)>0) {
                echo '<div id=colNicaDia>
                  <h5 class="mt-2 mb-1 text-center">Ventas del día</h5>
                <canvas id="NicaDia" class="mt-3 mb-3" ></canvas>
                </div>';
                echo "<script>  $('#NicaRow').addClass('row'); $('#colNicaDia').addClass('col-12 col-md-6');</script>";
              }else{
               echo "<script> $('#NicaRow').removeClass(); $('#colNicaDia').removeClass();  $('#NicaRow').addClass('d-flex justify-content-center'); </script>";
             }
             if (count($venmesNicaragua)>0) { 
                echo '<div id=colNicaMes>
                <h5 class="mt-2 mb-1 text-center">Ventas del Mes</h5>
                <canvas id="NicaMes" class="mt-3 mb-3" ></canvas>
                </div>';
                echo "<script>  $('#NicaRow').addClass('row'); $('#colNicaMes').addClass('col-12 col-md-6');</script>";
              }else{
                echo "<script> $('#NicaRow').removeClass(); $('#colNicaMes').removeClass();  $('#NicaRow').addClass('d-flex justify-content-center'); </script>";
              }
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
         <!--ROW-->
     
       </div>
         <!--CONTAINER LG-->
    </div>
    <!--BODY-->
    <div class="footer bg-blck flex-grow-1 d-flex justify-content-center">
      <p class="bggray"><i>Lovable de Honduras S.A. de C.V</i></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>

    <?php include 'graficas.php';?>
    <script>
        $( document ).ready(function() {
            $("#fechagra").val(formatoFecha("<?php echo $fechaGraficas; ?>"));
            $("#cbbMesgra").val("<?php echo $mesGraficas; ?>"); 
            $("#cbbAnogra").val(<?php echo $anoGraficas;  ?>); 

        });
        function formatoFecha(fecha) {
                        let year = fecha.substring(0, 4);
                        let month = fecha.substring(4, 6);
                        let day = fecha.substring(6, 8);
                        return year + "-" + month + "-" + day;
                        }
    </script>
  </body>
  <div class="spinner-wrapper">
          <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
</html>