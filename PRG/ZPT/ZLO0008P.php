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
              $cia="CODCIA IN (35,47,50,52,56,57,59,63,64,65,68,70,72,73,74,75,76,78,82,85,88)";
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
            $cia="CODCIA IN (".$paisfiltro.")";
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

     $sqlmeses="SELECT T1.MARCA,PRV12M,PRV06M,MIN12M,M1,M2,M3,M4,M5,M6 FROM( 
       SELECT M1.MARCA, M1.PRV12M,M1.PRV06M, M1.MIN12M,M1.MIN06M M1, M2.MIN06M M2, M3.MIN06M M3,M4.MIN06M M4,M5.MIN06M M5, M6.MIN06M M6 FROM (
       SELECT MARCA,SUM(PRV12M) PRV12M,SUM(PRV06M) PRV06M,SUM(MIN12M) MIN12M,SUM(MIN06M) MIN06M
   FROM LBPRDDAT/LO2241 WHERE ".$cia." and ANOPRO=".$anoConsulta[0]." AND MESPRO=".$mesConsulta[0]." GROUP BY MARCA ) AS M1
       LEFT JOIN (
      SELECT MARCA,SUM(MIN06M) MIN06M
      FROM LBPRDDAT/LO2241 WHERE ".$cia." and ANOPRO=".$anoConsulta[1]." AND MESPRO=".$mesConsulta[1]." GROUP BY MARCA ) AS M2 ON M1.MARCA=M2.MARCA  
       LEFT JOIN (
        SELECT MARCA,SUM(MIN06M) MIN06M
      FROM LBPRDDAT/LO2241 WHERE ".$cia." and ANOPRO=".$anoConsulta[2]." AND MESPRO=".$mesConsulta[2]." GROUP BY MARCA ) AS M3 ON M1.MARCA=M3.MARCA 
       LEFT JOIN (
          SELECT MARCA,SUM(MIN06M) MIN06M
      FROM LBPRDDAT/LO2241 WHERE ".$cia." and ANOPRO=".$anoConsulta[3]." AND MESPRO=".$mesConsulta[3]." GROUP BY MARCA ) AS M4 ON M1.MARCA=M4.MARCA 
         LEFT JOIN (
            SELECT MARCA,SUM(MIN06M) MIN06M
      FROM LBPRDDAT/LO2241 WHERE ".$cia." and ANOPRO=".$anoConsulta[4]." AND MESPRO=".$mesConsulta[4]." GROUP BY MARCA ) AS M5 ON M1.MARCA=M5.MARCA 
           LEFT JOIN (
             SELECT MARCA,SUM(MIN06M) MIN06M
      FROM LBPRDDAT/LO2241 WHERE ".$cia." and ANOPRO=".$anoConsulta[5]." AND MESPRO=".$mesConsulta[5]." GROUP BY MARCA ) AS M6 ON M1.MARCA=M6.MARCA)AS T1 ORDER BY MARCA";

      $resultMeses=odbc_exec($connIBM,$sqlmeses); 

      $sqlUnidades="SELECT MARCA,SUM(UNICOM) UNICOM,SUM(UNIVEN) UNIVEN,SUM(UNIEXI) UNIEXI FROM   
      LBPRDDAT/LO2241 AS T1 WHERE T1.".$cia." AND ANOPRO=".$anofiltro." AND MESPRO=".$mesfiltro."
      GROUP BY MARCA ORDER BY MARCA";
      $resultUnidades=odbc_exec($connIBM,$sqlUnidades); 

      $sqlMarcas="SELECT DESCO1,DESDES FROM LBPRDDAT/DESARC WHERE DESCOD=1 order by desco1";
      $resultMarcas=odbc_exec($connIBM,$sqlMarcas); 

      $marcasLabel[]=array();  $cont=0;
      while($rowMarcas = odbc_fetch_array($resultMarcas)){
        $marcasId[$cont]=$rowMarcas['DESCO1'];
        $marcasLabel[$cont]=$rowMarcas['DESDES'];
        $cont++;
      }
       //COMBOBOX
   $sqlCOMARC = "SELECT T2.CODSEC,LO0705.CODCIA COMCOD, LO0705.NOMCIA COMDES 
   FROM LBPRDDAT/LO0705
   INNER JOIN LBPRDDAT/LO0686 AS T2 ON T2.CODCIA = LO0705.CODCIA 
   WHERE LO0705.CODCIA<>1
   ORDER BY T2.CODSEC";
   $resultCOMARC=odbc_exec($connIBM,$sqlCOMARC);

   
   $lblDocenas="";
   if ($paisfiltro==="01") {
    $lblDocenas="(Docenas)";
   }
?>
     <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
              <span>Producto Terminado / Meses de inventarios</span>
              </li>
              <li class="breadcrumb-item active"><span>ZLO0008P</span></li>
            </ol>
          </nav>
        </div>
      </header>
      <div id="body-div" class="body flex-grow-3">
          <div class="card mb-5">
            <div class="card-header">
              <h1 class="fs-4 mb-1 mt-2 text-center">Meses de inventario por Línea</h1>
            </div>
            <div class="card-body">
          <div class="position-relative">
              <form id="formFiltros" action="../../assets/php/ZPT/ZLO0008P/filtrosLogica.php" method="POST">
                <div class="row mb-2">
                <div class="col-sm-12 col-lg-6 mt-2">
                        <label>País:</label>
                        <select class="form-select  mt-1" id="cbbPais" name="cbbPais">
                          <!--<option class="fw-bold" value="8">Todos los países</option>-->
                          <optgroup>
                          <option class="fw-bold" value="0" disabled>País</option>
                          <option class="fw-bold" value="1">Honduras (Lov. Ecommerce)</option>
                          <option class="fw-bold" value="2">Honduras (Mod. Íntima)</option>
                          <option class="fw-bold" value="3">Guatemala</option>
                          <option class="fw-bold" value="4">El Salvador</option>
                          <option class="fw-bold" value="5">Costa Rica</option>
                          <option class="fw-bold" value="6">Nicaragua</option>
                          <option class="fw-bold" value="7">Rep. Dominicana</option>
                          </optgroup>
                          <optgroup>
                          <option class="fw-bold" value="0" disabled>Fabrica</option>
                          <option class="fw-bold" value="01">Lovable Honduras</option>
                          </optgroup>
                          <optgroup>
                          <option class="fw-bold" value="0" disabled>Punto de Venta</option>
                          <?php
                          while ($rowCOMARC = odbc_fetch_array($resultCOMARC)) {
                            echo "<option value='" . $rowCOMARC['COMCOD'] . "'>" . rtrim(utf8_encode($rowCOMARC['COMDES'])) . "</option>";
                          }
                          ?>
                          </optgroup>
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
                </div>
              </form>
              </div>
              <hr>
                <div class="demo">
                    <ul class="tablist" role="tablist">
                        <li id="tab1" class="tablist__tab text-center p-3  is-active" aria-controls="panel1" aria-selected="true" role="tab" tabindex="0">Meses</li>
                        <li id="tab2" class="tablist__tab text-center p-3" aria-controls="panel2" aria-selected="false" role="tab" tabindex="0"><?php if ($paisfiltro==="01") { echo "Docenas";}else{echo "Unidades";}  ?></li>
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
                                    <th  class="responsive-font-example text-start" >Línea</th>
                                    <th  class="responsive-font-example text-end">Prom. Vta 12M <?php echo  $lblDocenas; ?></th>
                                    <th  class="responsive-font-example text-end">Prom. Vta 6M <?php echo  $lblDocenas; ?></th>
                                    <th  class="responsive-font-example text-end">Meses Inv.12M</th>
                                    <th  class="responsive-font-example text-end">Mes Actual</th>
                                    <th  class="responsive-font-example text-end">Mes anterior</th>
                                    <th  class="responsive-font-example text-end">2 Meses anterior</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $paisesLabel1[]=array();  $cont=0;
                                $paisesM1[]=array();
                                $paisesM2[]=array();
                                $paisesM3[]=array();
                                $paisesM4[]=array();
                                $paisesM5[]=array();
                                $paisesM6[]=array();
                                $validator1="true";
                                $firstvalue=0;$i=0;
                                   while($rowMeses = odbc_fetch_array($resultMeses)){
                                    for ($i; $i <=1; $i++) { 
                                      $firstvalue=number_format($rowMeses['PRV12M'],2);
                                    }
                                    $i=5;
                                    if ($firstvalue!=0) {
                                    $validator1="false";
                                    $PRV12M=$rowMeses['PRV12M'];
                                    $PRV06M=$rowMeses['PRV06M'];
                                    if ($paisfiltro==="01") {
                                      $docenas=floor($rowMeses['PRV12M']/12);
                                      $decimales=($rowMeses['PRV12M']-($docenas*12));
                                      if (strlen($decimales)==1) {
                                        $decimales= "0.0".$decimales;
                                      }else{
                                        $decimales="0.".$decimales;
                                      }
                                      $PRV12M=$docenas+$decimales;

                                      $docenas=floor($rowMeses['PRV06M']/12);
                                      $decimales=($rowMeses['PRV06M']-($docenas*12));
                                      if (strlen($decimales)==1) {
                                        $decimales= "0.0".$decimales;
                                      }else{
                                        $decimales="0.".$decimales;
                                      }
                                      $PRV06M=$docenas+$decimales;
                                     }
                                    
                                    print '<tr>';
                                      print '<td>1</td>';
                                      for ($i=0; $i < count($marcasId); $i++) { 
                                        if ($marcasId[$i]==$rowMeses['MARCA']) {
                                             print '<td class="responsive-font-example fw-bold text-start">'.$marcasLabel[$i].'</td>';
                                          $paisesLabel1[$cont]=$marcasLabel[$i];
                                        }
                                      }
                                      switch ($paisfiltro) {
                                        case 1:
                                         $MIN12M=$rowMeses['MIN12M']/20;
                                         $M1=$rowMeses['M1']/20;
                                          $M2=$rowMeses['M2']/20;
                                          $M3=$rowMeses['M3']/20;
                                          $M4=$rowMeses['M4']/20;
                                          $M5=$rowMeses['M5']/20;
                                          $M6=$rowMeses['M6']/20;
                                          break;
                                          case 2:
                                            $MIN12M=$rowMeses['MIN12M']/2;
                                            $M1=$rowMeses['M1']/2;
                                             $M2=$rowMeses['M2']/2;
                                             $M3=$rowMeses['M3']/2;
                                             $M4=$rowMeses['M4']/2;
                                             $M5=$rowMeses['M5']/2;
                                             $M6=$rowMeses['M6']/2;
                                            break;
                                          case 3:
                                            $MIN12M=$rowMeses['MIN12M']/5;
                                            $M1=$rowMeses['M1']/5;
                                              $M2=$rowMeses['M2']/5;
                                              $M3=$rowMeses['M3']/5;
                                              $M4=$rowMeses['M4']/5;
                                              $M5=$rowMeses['M5']/5;
                                              $M6=$rowMeses['M6']/5;
                                            break;
                                            case 4:
                                              $MIN12M=$rowMeses['MIN12M']/4;
                                              $M1=$rowMeses['M1']/4;
                                                $M2=$rowMeses['M2']/4;
                                                $M3=$rowMeses['M3']/4;
                                                $M4=$rowMeses['M4']/4;
                                                $M5=$rowMeses['M5']/4;
                                                $M6=$rowMeses['M6']/4;
                                              break;
                                              case 5:
                                                $MIN12M=$rowMeses['MIN12M']/2;
                                                  $M1=$rowMeses['M1']/2;
                                                    $M2=$rowMeses['M2']/2;
                                                    $M3=$rowMeses['M3']/2;
                                                    $M4=$rowMeses['M4']/2;
                                                    $M5=$rowMeses['M5']/2;
                                                    $M6=$rowMeses['M6']/2;
                                                break;
                                                case 6:
                                                  $MIN12M=$rowMeses['MIN12M']/2;
                                                  $M1=$rowMeses['M1']/2;
                                                   $M2=$rowMeses['M2']/2;
                                                   $M3=$rowMeses['M3']/2;
                                                   $M4=$rowMeses['M4']/2;
                                                   $M5=$rowMeses['M5']/2;
                                                   $M6=$rowMeses['M6']/2;
                                                  break;
                                                    default:
                                                    $MIN12M=$rowMeses['MIN12M']/1;
                                                    $M1=$rowMeses['M1']/1;
                                                     $M2=$rowMeses['M2']/1;
                                                     $M3=$rowMeses['M3']/1;
                                                     $M4=$rowMeses['M4']/1;
                                                     $M5=$rowMeses['M5']/1;
                                                     $M6=$rowMeses['M6']/1;
                                              break;
                                          }
                                      if($PRV12M==0){print '<td class="responsive-font-example fw-bold text-end"> </td>';}else{print '<td class="responsive-font-example fw-bold text-end">'.number_format($PRV12M,2).'</td>';}
                                      if($PRV06M==0){print '<td class="responsive-font-example fw-bold text-end"> </td>';}else{print '<td class="responsive-font-example fw-bold text-end">'.number_format($PRV06M,2).'</td>';}
                                      if($rowMeses['MIN12M']==0){print '<td class="responsive-font-example fw-bold text-end"> </td>';}else{print '<td class="responsive-font-example fw-bold text-end">'.number_format($MIN12M,2).'</td>';}
                                      if($rowMeses['M1']==0){print '<td class="responsive-font-example fw-bold text-end"> </td>';}else{print '<td class="responsive-font-example fw-bold text-end">'.number_format($M1,2).'</td>';}
                                      if($rowMeses['M2']==0){print '<td class="responsive-font-example fw-bold text-end"> </td>';}else{print '<td class="responsive-font-example fw-bold text-end">'.number_format($M2,2).'</td>';}
                                      if($rowMeses['M3']==0){print '<td class="responsive-font-example fw-bold text-end"> </td>';}else{print '<td class="responsive-font-example fw-bold text-end">'.number_format($M3,2).'</td>';}
                                    print '</tr>';
                                    $paisesM1[$cont]=round($M1,2);
                                    $paisesM2[$cont]=round($M2,2);
                                    $paisesM3[$cont]=round($M3,2);
                                    $paisesM4[$cont]=round($M4,2);
                                    $paisesM5[$cont]=round($M5,2);
                                    $paisesM6[$cont]=round($M6,2);
                                    $cont++;
                                   }}

                                ?>
                              </tbody>
                          </table>
                      </div>
                    </div>
                    <div id="panel2" class="tablist__panel is-hidden p-3" aria-labelledby="tab2" aria-hidden="true" role="tabpanel">
                    <div id="grafica2" class="row">
                    <div id="carouselExampleDark" class="carousel carousel-dark slide"  data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                </div>
                    <div class="carousel-inner">
                              <div class="carousel-item active">
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
                    <div class="table-responsive mt-3">
                          <table id="myTableInvUnidades" class="table stripe table-hover " style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th class="responsive-font-example fw-bold text-start">Línea</th>
                                    <th class="responsive-font-example fw-bold text-end"><?php if ($paisfiltro==="01") { echo "Docenas";}else{echo "Unidades";}  ?> Compradas  12M</th>
                                    <th class="responsive-font-example fw-bold text-end"><?php if ($paisfiltro==="01") { echo "Docenas";}else{echo "Unidades";}  ?> Vendidas  12M</th>
                                    <th class="responsive-font-example fw-bold text-end">Variación</th>
                                    <th class="responsive-font-example fw-bold text-end"><?php if ($paisfiltro==="01") { echo "Docenas";}else{echo "Unidades";}  ?> Existencia</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                 $paisesUndComp[]=array();  $paisesUndVen[]=array(); $paisesUndExi[]=array();$cont1=0;
                                 $paisesLabel2[]=array();
                                 $validator2="true";
                                 $firstvalue=0;$i=0;
                                   while($rowUni = odbc_fetch_array($resultUnidades)){
                                    
                                    for ($i; $i <=1; $i++) { 
                                      $firstvalue=number_format($rowUni['UNICOM'],2);
                                    }
                                    $i=5;
                                    if ($firstvalue!=0) {
                                    $validator2="false";
                                    $variacion=$rowUni['UNIVEN'] - $rowUni['UNICOM'];
                                    $UNICOM=$rowUni['UNICOM'];
                                    $UNIVEN=$rowUni['UNIVEN'];
                                    $UNIEXI=$rowUni['UNIEXI'];
                                    if ($paisfiltro==="01") {
                                      $docenas=floor($rowUni['UNICOM']/12);
                                      $decimales=($rowUni['UNICOM']-($docenas*12));
                                      if (strlen($decimales)==1) {
                                        $decimales= "0.0".$decimales;
                                      }else{
                                        $decimales="0.".$decimales;
                                      }
                                      $UNICOM=$docenas+$decimales;
                                      //
                                      $docenas=floor($rowUni['UNIVEN']/12);
                                      $decimales=($rowUni['UNIVEN']-($docenas*12));
                                      if (strlen($decimales)==1) {
                                        $decimales= "0.0".$decimales;
                                      }else{
                                        $decimales="0.".$decimales;
                                      }
                                      $UNIVEN=$docenas+$decimales;
                                      //
                                      $docenas=floor($rowUni['UNIEXI']/12);
                                      $decimales=($rowUni['UNIEXI']-($docenas*12));
                                      if (strlen($decimales)==1) {
                                        $decimales= "0.0".$decimales;
                                      }else{
                                        $decimales="0.".$decimales;
                                      }
                                      $UNIEXI=$docenas+$decimales;
                                     }
                                    
                                    print '<tr>';
                                      print '<td>'.$rowUni['MARCA'].'</td>';
                                      for ($i=0; $i < count($marcasId); $i++) { 
                                        if ($marcasId[$i]==$rowUni['MARCA']) {
                                             print '<td class="responsive-font-example fw-bold text-start">'.$marcasLabel[$i].'</td>';
                                             $paisesLabel2[$cont1]=$marcasLabel[$i];
                                        }
                                      }
                                      if($UNICOM==0){print '<td class="responsive-font-example fw-bold text-end"> </td>';}else{print '<td class="responsive-font-example fw-bold text-end">'.number_format($UNICOM,2).'</td>';}
                                      if($UNIVEN==0){print '<td class="responsive-font-example fw-bold text-end"> </td>';}else{print '<td class="responsive-font-example fw-bold text-end">'.number_format($UNIVEN,2).'</td>';}
                                      if ($variacion<0) {print '<td class="text-danger responsive-font-example fw-bold text-end">'.number_format(($variacion),0).'</td>';}else{if ($variacion>0) {print '<td class="text-success responsive-font-example fw-bold text-end">'.number_format(($variacion),0).'</td>';}else{print '<td class="fw-bold responsive-font-example text-end">'.(($variacion==0)?' ':number_format( $variacion,0)).'</td>';}}
                                      if($UNIEXI==0){print '<td class="responsive-font-example fw-bold text-end"> </td>';}else{print '<td class="responsive-font-example fw-bold text-end">'.number_format($UNIEXI,2).'</td>';}
                                    print '</tr>';
                                    $paisesUndComp[$cont1]=round($UNICOM,2);
                                    $paisesUndVen[$cont1]=round($UNIVEN,2);
                                    $paisesUndExi[$cont1]=round($UNIEXI,2);
                                    $cont1++;
                                   }}
                                
                                 
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
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
      <script src="https://code.highcharts.com/highcharts.js"></script>
      <script src="https://code.highcharts.com/modules/exporting.js"></script>
      <script src="https://code.highcharts.com/modules/export-data.js"></script>
      <script src="https://code.highcharts.com/modules/accessibility.js"></script>
      <?php include '../../assets/php/ZPT/ZLO0008P/ZLO0008P.php';?>
      
    
</body>
</html>