<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
    <style>
      .bg-factura{
        background-color: #FAFAFA;
      }
    </style>
</head>
<body>
<?php
      include '../layout-prg.php';
      $sqlCorrelativo="SELECT CODCIA,TIPFAC,NUMFAC,CORRELATIVO FROM(
        SELECT CODCIA,TIPFAC,NUMFAC,FACEXT CORRELATIVO FROM(SELECT CODCIA,TIPFAC,NUMFAC,FACEXT FROM LBPRDDAT/LO1070 UNION ALL
        SELECT CODCIA,TIPDOC,NUMDOC,CONCAT('00000000',CONCAT(REPLACE(SERIE, ' ', ''),LPAD(CAST(CORDOC AS VARCHAR(8)), 8, '0'))) AS FACEXT FROM LBPRDDAT/LO1925) AS T1
        UNION ALL
        SELECT CODCIA,0 AS TIPFAC,NUMFAC,FYDUCA CORRELATIVO FROM LBPRDDAT/LO1404)
        WHERE NUMFAC=".$_GET['fac']." AND CODCIA=".$_GET['id']."";
      
      $sqlEnca="SELECT FACCO4,FACNU3,FACCI2,FACCO5,DESCLI,FACTI2,FACNU4,MAENO3,FACFE1, 
      COALESCE(DIAPLN, FACDI1)FACDI1,FACTI3,FACGR2,FACBU2,FACP01,PEDPRE,FACF03,FACLU2,
      FACTR2,FACF02,FACSU2,FACTO2,FACIM1,FACTO3 
      FROM LBPRDDAT/FACAR215 INNER JOIN LBPRDDAT/LO0401 ON FACAR215.FACNU3=LO0401.NUMFAC
      LEFT JOIN LBPRDDAT/LO0907 ON LO0907.CODCIA=FACAR215.FACCO4 AND 
      LO0907.NUMFAC=FACAR215.FACNU3 INNER JOIN LBPRDDAT/MAEA01 ON MAEA01.MAEC14=FACAR215.FACCO4 
      AND MAEA01.MAEC15=FACAR215.FACNU4
      LEFT JOIN LBPRDDAT/LO026101 ON LO026101.PEDFAC=FACAR215.FACP01
      WHERE FACAR215.FACNU3=".$_GET['fac']." AND FACCO4=".$_GET['id']."";

      $resultCorrelativo=odbc_exec($connIBM,$sqlCorrelativo);
      $resultEnca=odbc_exec($connIBM,$sqlEnca);
      $Correlativo="";
      while ($rowCorre = odbc_fetch_array($resultCorrelativo)) {
        $Correlativo=$rowCorre['CORRELATIVO'];
      }
      $facturaRefer="";$Ciudad="";$CodClie="";$DesClie="";$Tipo="";$codVend="";$Vendedor="";$fechaFac="";
      $Pedidos="";$Preventas="";$FechaVen="";$LugarDes="";$Transp="";$FechaEmbar="";
      $TBruto="";$Desc="";$Imp="";$TNeto="";
      $TTDesc="";$Consecu=""; $Clave="";
      $enca2=false;

      while ($rowEnca= odbc_fetch_array($resultEnca)) {
        $facturaRefer=$rowEnca['FACNU3'];
        $Ciudad=$rowEnca['FACCI2'];
        $CodClie=$rowEnca['FACCO5'];
        $DesClie=utf8_encode($rowEnca['DESCLI']);
        $Tipo=$rowEnca['FACTI2'];

        $codVend=$rowEnca['FACNU4'];
        $Vendedor=utf8_encode($rowEnca['MAENO3']);
        if (strlen($rowEnca['FACFE1'])==7) {
          $fechaFac=formatDate('0'.$rowEnca['FACFE1']);
        }else{
          $fechaFac=formatDate($rowEnca['FACFE1']);
        }
        $Plazo=$rowEnca['FACDI1'];
        $Moneda=$rowEnca['FACTI3'];
        $ImpuestoGra=$rowEnca['FACGR2'];
        $Bultos=$rowEnca['FACBU2'];

        $Pedidos=$rowEnca['FACP01'];
        $Preventas=$rowEnca['PEDPRE'];
        if (strlen($rowEnca['FACF03'])==7) {
          $FechaVen=formatDate('0'.$rowEnca['FACF03']);
        }else{
          $FechaVen=formatDate($rowEnca['FACF03']);
        }
        
        $LugarDes=$rowEnca['FACLU2'];
        $Transp=$rowEnca['FACTR2'];
        $FechaEmbar=$rowEnca['FACF02'];

        $TBruto=$rowEnca['FACSU2'];
        $Desc=$rowEnca['FACTO2'];
        $Imp=$rowEnca['FACIM1'];
        $TNeto=$rowEnca['FACTO3'];
      }
      $sqlDetalle="SELECT FACNU5,FACMA1,FACCO7,FACCO8,FACTA1,FACCA1,FACCA2,FACNI1,FACDE1,CASE WHEN FACPR5=0 THEN FACPR1/12 ELSE FACPR5 END FACPR5,FACV01 
      FROM LBPRDDAT/FACAR3 WHERE FACNU5=".$_GET['fac']." AND FACCO6=".$_GET['id']." ORDER BY FACMA1";
    try {
        if(!isset($Plazo)) {
          throw new Exception("La variable Plazo no está definida.");
        }
     } catch(Exception $e) {
      $sqlEnca2="SELECT LO042903.CODCIA FACCO4,LO042903.NUMFAC FACNU3,0 FACCI2,CODCL2
      FACCO5,DESCLI,TIPFAC FACTI2,NUMVEN FACNU4,MAENO3,FECFAC FACFE1,DIAPLA FACDI1,
      TIPMON FACTI3,VALIMP FACGR2,BULNUM FACBU2,NUMP01 FACP01,
      0 PEDPRE,FECVEN FACF03,LUGEMI FACLU2,TRANSP FACTR2,FECEMB FACF02,
     SUBTOT FACSU2,TOTDES FACTO2,TOTCDE,VALIMP FACIM1, TOTFIN FACTO3,RCONCE,RCLANU                                         
     FROM LBPRDDAT/LO042903 INNER JOIN LBPRDDAT/MAEA01 ON MAEA01.MAEC15 =LO042903.NUMVEN         
     LEFT JOIN LBPRDDAT/LO1621 ON LO1621.NUMFAC = LO042903.NUMFAC       
     WHERE LO042903.NUMFAC=".$_GET['fac']." AND LO042903.CODCIA=".$_GET['id']." ";
      $resultEnca2=odbc_exec($connIBM,$sqlEnca2);
      if($rowEnca2= odbc_fetch_array($resultEnca2)){
      $enca2=true;
      while ($rowEnca2= odbc_fetch_array($resultEnca2)) {
        $facturaRefer=$rowEnca2['FACNU3'];
        $Ciudad=$rowEnca2['FACCI2'];
        $CodClie=$rowEnca2['FACCO5'];
        $DesClie=utf8_encode($rowEnca2['DESCLI']);
        $Tipo=$rowEnca2['FACTI2'];

        $codVend=$rowEnca2['FACNU4'];
        $Vendedor=utf8_encode($rowEnca2['MAENO3']);

        
        if (strlen($rowEnca2['FACFE1'])==7) {
          $fechaFac=formatDate('0'.$rowEnca2['FACFE1']);
        }else{
          $fechaFac=formatDate($rowEnca2['FACFE1']);
        }
        $Plazo=$rowEnca2['FACDI1'];
        $Moneda=$rowEnca2['FACTI3'];
        $ImpuestoGra=$rowEnca2['FACGR2'];
        $Bultos=$rowEnca2['FACBU2'];

        $Pedidos=$rowEnca2['FACP01'];
        $Preventas=$rowEnca2['PEDPRE'];
        if (strlen($rowEnca2['FACF03'])==7) {
          $FechaVen=formatDate('0'.$rowEnca2['FACF03']);
        }else{
          $FechaVen=formatDate($rowEnca2['FACF03']);
        }
        
        $LugarDes=$rowEnca2['FACLU2'];
        $Transp=$rowEnca2['FACTR2'];
        $FechaEmbar=$rowEnca2['FACF02'];

        $TBruto=$rowEnca2['FACSU2'];
        $Desc=$rowEnca2['FACTO2'];
        
        $Imp=$rowEnca2['FACIM1'];
        $TNeto=$rowEnca2['FACTO3'];


        $TTDesc=$rowEnca2['TOTCDE'];
        
        $Consecu=$rowEnca2['RCONCE'];
        $Clave=$rowEnca2['RCLANU'];
      }
    }
      // CAMBIE TBruto y TTDesc de lugar
      $sqlDetalle="SELECT NUMFAC FACNU5,MARCA FACMA1,ESTILO FACCO7,COLOR FACCO8,TALLA FACTA1,CALIDA FACCA1,CANTID FACCA2,NIVPRE FACNI1,PORDES FACDE1,CASE WHEN PRED02=0 THEN PRED01/12 ELSE PRED02 END FACPR5,VALCDE FACV01 
      FROM LBPRDDAT/LO0430 WHERE NUMFAC=".$_GET['fac']." AND CODCIA=".$_GET['id']." ORDER BY MARCA";
        try {
          if(!isset($Plazo)) {
            throw new Exception("La variable Plazo no está definida.");
          }
      } catch(Exception $e) {
        echo "<script>window.location = '/LovablePHP/404.html'</script>";
      }
     }
      $resultDetalle=odbc_exec($connIBM,$sqlDetalle);
      function formatDate($date) {
        $day = substr($date, 0, 2);
        $month = substr($date, 2, 2);
        $year = substr($date, 4, 4);
        return $day . '/' . $month . '/' . $year;
    }
?>
 <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
              <span>Modulo de facturacion</span>
              </li>
              <li class="breadcrumb-item active"><span>ZLO0001P</span></li>
            </ol>
          </nav>

    </header>
    <div id="body-div" class="body flex-grow-1">
        <div class="card mb-5">
            <div class="card-header ">
              <h2 class="fs-6 text-start mt-2 mb-2"> <?php echo ($Correlativo!="" ? "Docto. Fiscal <b>".$Correlativo."</b>": ""); ?></h2>
            </div>
            <div class="card-body">
              <div class="bg-factura p-1 rounded">
              <div class="row">
                <div class="col-3">
                  <h4 class="fs-6 text-start mt-2 mb-2">Factura: <b><?php echo $facturaRefer; ?></b></h4>
                </div>
                <div class="col-6">
                <h4 class="fs-6 text-start mt-2 mb-2">Cliente: <b><?php echo $Ciudad.' '.$CodClie.' '.$DesClie; ?></b></h4>
                </div>
                <div class="col-3">
                <h4 class="fs-6 text-start mt-2 mb-2">Tipo: <b><?php echo $Tipo; ?></b></h4>
                </div>
              </div>
              <div class="row">
                <div class="col-8 col-lg-6">
                  <h4 class="fs-6 text-start mb-2">Vendedor: <?php echo $codVend.' '.$Vendedor; ?></h4>
                </div>

                <div class="col-4 col-lg-2">
                <h4 class="fs-6 text-start mb-2">Fecha: <?php echo $fechaFac; ?></h4>
                </div>
              </div>
              <div class="row">
                <div class="col-4 col-lg-3">
                  <h4 class="fs-6 text-start mb-2">Plazo:<b><?php echo ($Plazo!=0 ? $Plazo: ""); ?></b></h4>
                </div>
                <div class="col-4 col-lg-3">
                 <h4 class="fs-6 text-start mb-2">Moneda: <b><?php echo $Moneda; ?></b></h4>
                </div>
                <div class="col-4 col-lg-3">
                  <h4 class="fs-6 text-start mb-2">Impuesto (S/N): <b><?php echo ($ImpuestoGra!=0 ? number_format($ImpuestoGra,2, '.', ','): ""); ?></b></h4>
                </div>
                <div class="col-3 col-lg-3">
                  <h4 class="fs-6 text-start mb-2">No. Bultos: <b><?php echo $Bultos; ?></b></h4>
                </div>
              </div>
              </div>
              <hr>
              <?php
                if ($enca2==true) {
                  echo '<div class="row ">
                  <div class="col-6 ">
                    <h4 class="fs-6 text-start mb-2"><b>Consecutivo</b></h4>
                  </div>
                  <div class="col-6">
                   <h4 class="fs-6 text-start mb-2"><b>Clave</b></h4>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <h4 class="fs-6 text-start mb-2"><b>'.($Consecu!="" ? $Consecu: "").'</b></h4>
                  </div>
                  <div class="col-6">
                   <h4 class="fs-6 text-start mb-2"><b>'.$Clave.'</b></h4>
                  </div>
                </div>';
                }else{
                  echo '<div class="row ">
                  <div class="col-6 ">
                    <h4 class="fs-6 text-start mb-2"><b>P E D I D O S</b></h4>
                  </div>
                  <div class="col-6">
                   <h4 class="fs-6 text-start mb-2"><b>P R E V E N T A S</b></h4>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <h4 class="fs-6 text-start mb-2"><b>'.($Preventas!=0 ? $Preventas: "").'</b></h4>
                  </div>
                  <div class="col-6">
                   <h4 class="fs-6 text-start mb-2"><b>'.$Preventas.'</b></h4>
                  </div>
                </div>';
                }
              ?>
              <hr>
              <div class="bg-factura p-1 rounded">
              <div class="row">
                <div class="col-6">
                  <h4 class="fs-6 text-start mb-2">Fecha Ven: <b><?php echo $FechaVen; ?></b></h4>
                </div>
                <div class="col-6">
                  <h4 class="fs-6 text-start mb-2">Lugar de Destino: <b><?php echo $LugarDes; ?></b></h4>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <h4 class="fs-6 text-start mb-2">Transporte: <b><?php echo $Transp; ?></b></h4>
                </div>
                <div class="col-6">
                  <h4 class="fs-6 text-start mb-2">Fecha Embarque: <b><?php echo $FechaEmbar!=0 ? formatDate($FechaEmbar) : ""; ?></b></h4>
                </div>
              </div>
              <div class="row">
                <div class="col-3">
                  <h4 class="fs-6 text-start mb-2">Total Bruto: <span class="responsive-font-example"><b><?php echo ($TBruto!=0 ? number_format($TBruto,2, '.', ','): ""); ?></b></span></h4>
                </div>
                <div class="col-3">
                  <h4 class="fs-6 text-start mb-2">Desc: <span class="responsive-font-example"><b><?php echo   ($Desc!=0 ? number_format($Desc,2, '.', ','): ""); ?></b></span></h4>
                </div>
                <div class="col-3">
                  <h4 class="fs-6 text-start  mb-2">Imp: <span class="responsive-font-example"><b><?php echo $Imp!=0 ? number_format($Imp,2, '.', ',') : ""; ?></b></span></h4>
                </div>
                <div class="col-3">
                  <h4 class="fs-6 text-start mb-2">Total Neto: <span class="responsive-font-example"><b><?php echo ($TNeto!=0 ?  number_format($TNeto,2, '.', ','): ""); ?></b></span></h4>
                </div>
              </div>
              <?php
                if ($enca2==true){
                    echo '<div class="row">
                    <div class="col-12">
                      <h4 class="fs-6 text-start mb-2">Tot.c/Desc: <span class="responsive-font-example"><b>'. ($TTDesc!=0 ?  number_format($TTDesc,2, '.', ','): "").'</b></span></h4>
                    </div>
                  </div>';
                }?>
              </div>
              <div class="table-responsive">
                        <table id="myTableFactura" class="table stripe table-hover mt-4" style="width:100%" >
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Marca</th>
                                <th class="text-center">Estilo</th>
                                <th class="text-end">Color</th>
                                <th class="text-end">Talla</th>
                                <th class="text-end">CLD</th>
                                <th class="text-end">Cantidad</th>
                                <th class="text-end">NIV%</th>
                                <th class="text-end">Desc</th>
                                <th class="text-end">Precio</th>
                                <th class="text-end">Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                              $enteros=0; $decimales=0; 
                                   if($rowDetalle = odbc_fetch_array($resultDetalle)){
                                    do{
                                      
                                            echo "<tr>
                                                        <td class='text-end'>".$rowDetalle['FACNU5']."</td>

                                                        <td class='text-end'>".$rowDetalle['FACMA1']."</td>
                                                        <td class='text-start'>".$rowDetalle['FACCO7']."</td>
                                                        <td class='text-center'>".$rowDetalle['FACCO8']."</td>
                                                        <td class='text-end'><b>".$rowDetalle['FACTA1']."</b></td>
                                                        <td class='text-end'><b>".$rowDetalle['FACCA1']."</b></td>
                                                        <td class='text-end'><b>".$rowDetalle['FACCA2']."</b></td>
                                                        <td class='text-end'><b>".$rowDetalle['FACNI1']."</b></td>
                                                        <td class='text-end'><b>".($rowDetalle['FACDE1']!=0 ? $rowDetalle['FACDE1']: "")."</b></td>
                                                        <td class='text-end'><b>".number_format($rowDetalle['FACPR5'],2)."</b></td>
                                                        <td class='text-end'><b>".number_format($rowDetalle['FACV01'],2)."</b></td>
                                                    </tr>";
                                                    $numeros = explode(",",number_format( $rowDetalle['FACCA2'],2));
                                                    $suma_enteros = 0;
                                                    foreach ($numeros as $numero) {
                                                      $parte_entera = substr($numero, 0, strpos($numero, "."));
                                                      $enteros += $parte_entera;
                                                    
                                                    }
                                                    $suma_decimales = 0;
                                                    foreach ($numeros as $numero) {
                                                      $parte_decimal = fmod($numero, 1);
                                                      $decimales += $parte_decimal;
                                                    }        
                                        }
                                    while($rowDetalle = odbc_fetch_array($resultDetalle));
                                        $decimales2=number_format($decimales/0.12,2, '.', ',');                                      
                                        $enteros+=substr($decimales2, 0, strpos($decimales2, "."));
                                        if ((substr($decimales2, strpos($decimales2, "."),3))!=0) {
                                          $decimales=round($decimales-(substr($decimales2, 0, strpos($decimales2, ".")) * 0.12),2);
                                        }else{
                                          $decimales=0;
                                        }
                                        //echo (substr($decimales2, strpos($decimales2, "."),3));

                                    echo "<tr>
                                    <td class='text-end'>99999</td>
                                    <td class='text-end'></td>
                                    <td class='text-start'></td>
                                    <td class='text-center'></td>
                                    <td class='text-end'><b></b></td>
                                    <td class='text-end'><b></b></td>
                                    <td class='text-end'><b></b></td>
                                    <td class='text-end'><b></b></td>
                                    <td class='text-end'><b></b></td>
                                    <td class='text-end'><b></b></td>
                                    <td class='text-end'><b></b></td>
                                    </tr>";
                                    if ($enca2==true) {
                                      echo "<tr>
                                      <td class='text-end'>99999</td>
                                      <td class='text-end'></td>
                                      <td class='text-start'></td>
                                      <td class='text-center'></td>
                                      <td class='text-end'><b>Total</b></td>
                                      <td class='text-end'><b></b></td>
                                      <td class='text-end table-active'><b>".($enteros!=0 ? $enteros : "").($decimales!=0 ? (substr($decimales,strpos($decimales, ".")+1,1))==0? substr($decimales,strpos($decimales, "."),3): str_replace('.', '.',substr($decimales,strpos($decimales, "."),3) ) : ".00")."</b></td>
                                      <td class='text-end'><b></b></td>
                                      <td class='text-end'><b></b></td>
                                      <td class='text-end'><b></b></td>
                                      <td class='text-end table-active'><b>".number_format($TTDesc,2, '.', ',')."</b></td>
                                      </tr>";
                                    }else {
                                      echo "<tr>
                                      <td class='text-end'>99999</td>
                                      <td class='text-end'></td>
                                      <td class='text-start'></td>
                                      <td class='text-center'></td>
                                      <td class='text-end'><b>Total</b></td>
                                      <td class='text-end'><b></b></td>
                                      <td class='text-end table-active'><b>".($enteros!=0 ? $enteros : "").($decimales!=0 ? (substr($decimales,strpos($decimales, ".")+1,1))==0? substr($decimales,strpos($decimales, "."),3): str_replace('.', '.',substr($decimales,strpos($decimales, "."),3) ) : ".00")."</b></td>
                                      <td class='text-end'><b></b></td>
                                      <td class='text-end'><b></b></td>
                                      <td class='text-end'><b></b></td>
                                      <td class='text-end table-active'><b>".number_format($TBruto,2, '.', ',')."</b></td>
                                      </tr>";
                                    }
                                   
                                  }
                          ?>
                        </tbody>
                        </table>
              </div>
            </div>
            <div class="card-footer">
            </div>
         </div>
    </div>
    <div class="footer bg-blck flex-grow-1 d-flex justify-content-center">
      <p class="bggray responsive-font-example"><i>Lovable de Honduras S.A. de C.V</i></p>
    </div>
</body>
<div class="spinner-wrapper">
          <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div> 
</html> 