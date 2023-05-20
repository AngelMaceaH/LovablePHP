<!DOCTYPE html>
<html lang="es">
  <head>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
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
      $ordenFiltro=isset($_SESSION['Orden']) ? $_SESSION['Orden'] : 1;
      $mes_actual=date("m")-1;
      $ano_actual=date("Y");
           $mesfiltro=isset($_SESSION['mesfiltro3'])? $_SESSION['mesfiltro3']: $mes_actual; 
           $anofiltro=isset($_SESSION['anofiltro2'])? $_SESSION['anofiltro2']: $ano_actual; 
           $paisfiltro=isset($_SESSION['paisfiltro2'])? $_SESSION['paisfiltro2']: 1; 
           if ($paisfiltro==8) {
            $paisfiltro=1;
           }
           $cia="";
           switch ($paisfiltro) {
            case 1:
              $cia="CODCIA IN (35,47,50,52,56,57,59,63,64,65,68,70,72,73,74,75,76,78,82,85)";
              break;
              case 2:
                $cia="CODCIA IN (20,22)";
                break;
              case 3:
                $cia="CODCIA IN (49,66,69,71,86)";
                break;
                case 4:
                  $cia="CODCIA IN (48,53,61,62)";
                  break;
                  case 5:
                    $cia="CODCIA IN (60,80)";
                    break;
                    case 6:
                      $cia="CODCIA IN (83,87)";
                      break;
                      case 7:
                        $cia="CODCIA IN (81)";
                        break;
                      
            
            default:
              # code...
              break;
           }
           $anoConsulta=array();
           $mesConsulta=array();
           for ($i = 0; $i < 6; $i++) {
            $fecha = date("Y-m-d", strtotime("-$i months", strtotime("$anofiltro-$mesfiltro-01")));
            $ano = date("Y", strtotime($fecha));
            $mes = date("m", strtotime($fecha));
            $anoConsulta[$i]=$ano;
            $mesConsulta[$i]=$mes;
        }
        if ($ordenFiltro==1) {
          $sqlOrden=" ORDER BY T4.CODSEC";
        }else if($ordenFiltro==2){
          $sqlOrden=" ORDER BY Orden DESC";
        }else{
          $sqlOrden=" ORDER BY Orden ASC";
        }
      

     $sqlmeses="SELECT T4.CODSEC,T1.CODCIA,NOMCIA,PRV12M,PRV06M,MIN12M,M1,M2,M3,M4,M5,M6,(M1+M2+M3+M4+M5+M6)Orden FROM( 
      SELECT M1.CODCIA, M1.PRV12M,M1.PRV06M, M1.MIN12M,M1.MIN06M M1, M2.MIN06M M2, M3.MIN06M M3,M4.MIN06M M4,M5.MIN06M M5, M6.MIN06M M6 FROM (
      SELECT CODCIA,PRV12M,PRV06M,MIN12M,MIN06M FROM lbprddat/LO1960 WHERE
      ".$cia." and ANOPRO=".$anoConsulta[0]." AND MESPRO=".$mesConsulta[0].") AS M1
      INNER JOIN (
      SELECT CODCIA,MIN06M FROM lbprddat/LO1960 WHERE
      ".$cia." and ANOPRO=".$anoConsulta[1]." AND MESPRO=".($mesConsulta[1]).") AS M2 ON M1.CODCIA=M2.CODCIA  
      INNER JOIN (
      SELECT CODCIA,MIN06M FROM lbprddat/LO1960 WHERE
      ".$cia." and ANOPRO=".$anoConsulta[2]." AND MESPRO=".($mesConsulta[2]).") AS M3 ON M1.CODCIA=M3.CODCIA 
      INNER JOIN (
        SELECT CODCIA,MIN06M FROM lbprddat/LO1960 WHERE
        ".$cia." and ANOPRO=".$anoConsulta[3]." AND MESPRO=".($mesConsulta[3]).") AS M4 ON M1.CODCIA=M4.CODCIA 
        INNER JOIN (
          SELECT CODCIA,MIN06M FROM lbprddat/LO1960 WHERE
          ".$cia." and ANOPRO=".$anoConsulta[4]." AND MESPRO=".($mesConsulta[4]).") AS M5 ON M1.CODCIA=M5.CODCIA 
          INNER JOIN (
            SELECT CODCIA,MIN06M FROM lbprddat/LO1960 WHERE
            ".$cia." and ANOPRO=".$anoConsulta[5]." AND MESPRO=".($mesConsulta[5]).") AS M6 ON M1.CODCIA=M6.CODCIA 
      )AS T1
      INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA
      INNER JOIN LBPRDDAT/LO0686 AS T4 ON T4.CODCIA = T1.CODCIA ".$sqlOrden."";
      
      $resultMeses=odbc_exec($connIBM,$sqlmeses); 

      $sqlUnidades="SELECT T4.CODSEC,T1.CODCIA,T2.NOMCIA,UNICOM,UNIVEN, UNIEXI FROM LBPRDDAT/LO1960 AS T1
      INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA
      INNER JOIN LBPRDDAT/LO0686 AS T4 ON T4.CODCIA = T1.CODCIA
      WHERE T1.".$cia." AND ANOPRO=".$anofiltro." AND MESPRO=".$mesfiltro."
      ORDER BY T4.CODSEC";
      $resultUnidades=odbc_exec($connIBM,$sqlUnidades); 
?>
     <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><span>Producto Terminado</span>
              </li>
              <li class="breadcrumb-item active"><span>ZLO0004P</span></li>
            </ol>
          </nav>
        </div>
      </header>
      <div id="body-div" class="body flex-grow-3">
          <div class="card mb-5">
            <div class="card-header">
              <h1 class="fs-4 mb-1 mt-2 text-center">Meses de inventario Tiendas</h1>
            </div>
            <div class="card-body">
          <div class="position-relative">
              <form id="formFiltros" action="../../assets/php/ZPT/ZLO0004P/filtrosLogica.php" method="POST">
                <div class="row mb-2">
                <div class="col-sm-12 col-lg-6 mt-2">
                        <label>País:</label>
                        <select class="form-select  mt-1" id="cbbPais" name="cbbPais">
                          <option value="8">Todos los países</option>
                          <option value="1">Honduras (Lov. Ecommerce)</option>
                          <option value="2">Honduras (Mod. Íntima)</option>
                          <option value="3">Guatemala</option>
                          <option value="4">El Salvador</option>
                          <option value="5">Costa Rica</option>
                          <option value="6">Nicaragua</option>
                          <option value="7">Rep. Dominicana</option>
                        </select>
                      </div>
                      <div class="col-sm-12 col-lg-3 mt-2">
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
                      <div class="col-sm-12 col-lg-3 mt-2">
                        <label>Mes:</label>
                        <select class="form-select mt-1" id="cbbMes" name="cbbMes">
                          <option value="1">Enero</option>
                          <option value="2">Febrero</option>
                          <option value="3">Marzo</option>
                          <option value="4">Abril</option>
                          <option value="5">Mayo</option>
                          <option value="6">Junio</option>
                          <option value="7">Julio</option>
                          <option value="8">Agosto</option>
                          <option value="9">Septiembre</option>
                          <option value="10">Octubre</option>
                          <option value="11">Noviembre</option>
                          <option value="12">Diciembre</option>
                        </select>
                      </div>
                      <div class="col-12 mt-2 d-flex">
                        <label for="cbbOrden" class="me-3 mt-2" id="lblcbbOrden">Organizar por: </label>
                        <select name="cbbOrden" id="cbbOrden" class="form-select" style="width: 170px">
                          <option value="1">Compañia</option>
                          <option value="2">Mayor a Menor</option>
                          <option value="3">Menor a Mayor</option>
                        </select>
                      </div>
                </div>
              </form>
              </div>
              <hr>
                <div class="demo">
                    <ul class="tablist" role="tablist">
                        <li id="tab1" class="tablist__tab text-center p-3  is-active" aria-controls="panel1" aria-selected="true" role="tab" tabindex="0">Meses</li>
                        <li id="tab2" class="tablist__tab text-center p-3" aria-controls="panel2" aria-selected="false" role="tab" tabindex="0">Unidades</li>
                    </ul>
                    <div id="panel1" class="tablist__panel p-3" aria-labelledby="tab1" aria-hidden="false" role="tabpanel">
                    <div id="grafica1">
                      <figure class="highcharts-figure" >
                                <div id="container" ></div>
                        </figure>
                    </div>    
                    
                    <div class="table-responsive mt-3" style="width:100%">
                          <table id="myTableInvMeses" class="table stripe table-hover " style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th  class="responsive-font-example text-start" >Punto de Venta</th>
                                    <th  class="responsive-font-example text-end">Prom. Vta 12M</th>
                                    <th  class="responsive-font-example text-end">Prom. Vta 6M</th>
                                    <th  class="responsive-font-example text-end">Meses Inv.12M</th>
                                    <th  class="responsive-font-example text-end">Mes Actual</th>
                                    <th  class="responsive-font-example text-end">Mes anterior</th>
                                    <th  class="responsive-font-example text-end">2 Meses anterior</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $paisesLabel[]=array();  $cont=0;
                                $paisesM1[]=array();
                                $paisesM2[]=array();
                                $paisesM3[]=array();
                                $paisesM4[]=array();
                                $paisesM5[]=array();
                                $paisesM6[]=array();
                                $validator1="true";
                                   while($rowMeses = odbc_fetch_array($resultMeses)){
                                    $validator1="false";
                                    print '<tr>';
                                      print '<td>'.$rowMeses['CODSEC'].'</td>';
                                      print '<td class="responsive-font-example fw-bold text-start">'.$rowMeses['NOMCIA'].'</td>';
                                      print '<td class="responsive-font-example fw-bold text-end">'.number_format($rowMeses['PRV12M'],2).'</td>';
                                      print '<td class="responsive-font-example fw-bold text-end">'.number_format($rowMeses['PRV06M'],2).'</td>';
                                      print '<td class="responsive-font-example fw-bold text-end">'.number_format($rowMeses['MIN12M'],2).'</td>';
                                      print '<td class="responsive-font-example fw-bold text-end">'.number_format($rowMeses['M1'],2).'</td>';
                                      print '<td class="responsive-font-example fw-bold text-end">'.number_format($rowMeses['M2'],2).'</td>';
                                      print '<td class="responsive-font-example fw-bold text-end">'.number_format($rowMeses['M3'],2).'</td>';
                                    print '</tr>';
                                    $paisesLabel[$cont]=$rowMeses['NOMCIA'];
                                    $paisesM1[$cont]=round($rowMeses['M1'],2);
                                    $paisesM2[$cont]=round($rowMeses['M2'],2);
                                    $paisesM3[$cont]=round($rowMeses['M3'],2);
                                    $paisesM4[$cont]=round($rowMeses['M4'],2);
                                    $paisesM5[$cont]=round($rowMeses['M5'],2);
                                    $paisesM6[$cont]=round($rowMeses['M6'],2);
                                    $cont++;
                                   }
                                ?>
                              </tbody>
                          </table>
                      </div>
                    </div>
                    <div id="panel2" class="tablist__panel is-hidden p-3" aria-labelledby="tab2" aria-hidden="true" role="tabpanel">
                    <div id="grafica2" class="row">
                      <div class="col-12 col-lg-6">
                        <figure class="highcharts-figure" >
                                <div id="container2" ></div>
                        </figure>
                      </div>
                      <div class="col-12 col-lg-6">
                      <figure class="highcharts-figure" >
                                <div id="container3" ></div>
                        </figure>
                      </div>
                    </div>
                    <div class="table-responsive mt-3">
                          <table id="myTableInvUnidades" class="table stripe table-hover " style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th class="responsive-font-example fw-bold text-start">Punto de Venta</th>
                                    <th class="responsive-font-example fw-bold text-end">Unidades Compradas  12M</th>
                                    <th class="responsive-font-example fw-bold text-end">Unidades Vendidas  12M</th>
                                    <th class="responsive-font-example fw-bold text-end">Variación</th>
                                    <th class="responsive-font-example fw-bold text-end">Unidades Existencia</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                 $paisesUndComp[]=array();  $paisesUndVen[]=array(); $paisesUndExi[]=array();$cont1=0;
                                 $validator2="true";
                                   while($rowUni = odbc_fetch_array($resultUnidades)){
                                    $validator2="false";
                                    $variacion=$rowUni['UNIVEN'] - $rowUni['UNICOM'];
                                    print '<tr>';
                                      print '<td>'.$rowUni['CODSEC'].'</td>';
                                      print '<td class="responsive-font-example fw-bold text-start">'.$rowUni['NOMCIA'].'</td>';
                                      print '<td class="responsive-font-example fw-bold text-end">'.number_format($rowUni['UNICOM'],2).'</td>';
                                      print '<td class="responsive-font-example fw-bold text-end">'.number_format($rowUni['UNIVEN'],2).'</td>';
                                      if ($variacion<0) {print '<td class="text-danger responsive-font-example fw-bold text-end">'.number_format(($variacion),0).'</td>';}else{if ($variacion>0) {print '<td class="text-success responsive-font-example fw-bold text-end">'.number_format(($variacion),0).'</td>';}else{print '<td class="fw-bold responsive-font-example text-end">'.(($variacion==0)?' ':number_format( $variacion,0)).'</td>';}}
                                      print '<td class="responsive-font-example fw-bold text-end">'.number_format($rowUni['UNIEXI'],2).'</td>';
                                    print '</tr>';
                                    $paisesUndComp[$cont1]=round($rowUni['UNICOM'],0);
                                    $paisesUndVen[$cont1]=round($rowUni['UNIVEN'],0);
                                    $paisesUndExi[$cont1]=round($rowUni['UNIEXI'],0);
                                    $cont1++;
                                   }
                                ?>
                              </tbody>
                          </table>
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
      <script src="https://code.highcharts.com/highcharts.js"></script>
      <script src="https://code.highcharts.com/modules/exporting.js"></script>
      <script src="https://code.highcharts.com/modules/export-data.js"></script>
      <script src="https://code.highcharts.com/modules/accessibility.js"></script>
      <?php include '../../assets/php/ZPT/ZLO0004P/ZLO0004P.php';?>
      
    
</body>
</html>