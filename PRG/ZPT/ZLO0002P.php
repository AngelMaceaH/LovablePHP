<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
  <style>
    .positionRel{
      position: relative; 
      left: 50%;
      transform: translateX(-50%);
    }
    div.dt-buttons {
            float: left;
          }
    @media (max-width: 1199px) {
      .graficasPC {
        display: none;
      }
      .graficasMovil {
        display: flex;
        
      }
    }
    @media (min-width: 1200px) {

      .graficasPC {
        display: block;
      }
      .graficasMovil {
        display: none;
      }
    }
  </style>
</head>
<body>
<div class="spinner-wrapper">
    <div class="spinner-border text-danger" role="status">
    </div>
  </div>
<?php
      include '../layout-prg.php';
      $ordenFiltro=isset($_SESSION['Orden2']) ? $_SESSION['Orden2'] : 1;
      $ordenFiltro3=isset($_SESSION['Orden3']) ? $_SESSION['Orden3'] : 1;
      $_SESSION['tab3'] = isset($_COOKIE['tabselected3']) ? $_COOKIE['tabselected3'] : "1";

      if ($ordenFiltro==1) {
        $sqlOrden="CODSEC";
      }else if($ordenFiltro==2){
        $sqlOrden="MAESA2 DESC";
      }else{
        $sqlOrden="MAESA2 ASC";
      }
    
      

      //punto de venta
      $sqlInv=" SELECT CODSEC,MAEC12,NOMCIA,(FLOOR(((FLOOR(MAESA2)*12) +ROUND((MAESA2 - FLOOR(MAESA2)) * 100))) -
                          FLOOR(((FLOOR(MAECA3)*12) +ROUND((MAECA3 - FLOOR(MAECA3)) * 100)))) MAESA2 
      FROM( SELECT CODSEC,MAEC12,NOMCIA, sum(maesa2)MAESA2, sum(maeca3) MAECA3
      FROM lbprddat/MAEAR280 
      INNER JOIN LBPRDDAT/DETA16 ON DETA16.DETC90 = MAEAR280.MAEC12
      INNER JOIN LBPRDDAT/LO0705 ON LO0705.CODCIA = MAEAR280.MAEC12
      INNER JOIN LBPRDDAT/LO0686 ON LO0686.CODCIA = MAEAR280.MAEC12
      WHERE DETA16.DETUSU ='".$_SESSION["CODUSU"]."' AND DETA16.DETPR1 = 'LO1512P' and MAEC12<>1
      GROUP BY CODSEC,MAEC12,NOMCIA)ORDER BY ".$sqlOrden."";
       $resultInv=odbc_exec($connIBM,$sqlInv); 
      $ciaArray=array();$invArray=array();
       //HONDURAS
       $sqlInvHon="SELECT '1' CON,(SUM(FLOOR(((FLOOR(MAESA2)*12) +ROUND((MAESA2 - FLOOR(MAESA2)) * 100)))) -
                                          SUM(FLOOR(((FLOOR(MAECA3)*12) +ROUND((MAECA3 - FLOOR(MAECA3)) * 100))))) MAESA2 
      FROM( SELECT CODSEC,MAEC12,NOMCIA, sum(maesa2)MAESA2, sum(maeca3) MAECA3
      FROM lbprddat/MAEAR280 
      INNER JOIN LBPRDDAT/DETA16 ON DETA16.DETC90 = MAEAR280.MAEC12
      INNER JOIN LBPRDDAT/LO0705 ON LO0705.CODCIA = MAEAR280.MAEC12
      INNER JOIN LBPRDDAT/LO0686 ON LO0686.CODCIA = MAEAR280.MAEC12
      WHERE DETA16.DETUSU ='".$_SESSION["CODUSU"]."' AND DETA16.DETPR1 = 'LO1512P' and MAEC12 IN (35,47,57,64,63,72,52,74,75,68,56,76,59,85,65,70,73,78,82,20,22)
      GROUP BY CODSEC,MAEC12,NOMCIA)";
        $resultInvHon=odbc_exec($connIBM,$sqlInvHon); 
        //GUATEMALA
       
       $sqlInvGua="SELECT '1' CON,(SUM(FLOOR(((FLOOR(MAESA2)*12) +ROUND((MAESA2 - FLOOR(MAESA2)) * 100)))) -
                SUM(FLOOR(((FLOOR(MAECA3)*12) +ROUND((MAECA3 - FLOOR(MAECA3)) * 100))))) MAESA2 
          FROM( SELECT CODSEC,MAEC12,NOMCIA, sum(maesa2)MAESA2, sum(maeca3) MAECA3
          FROM lbprddat/MAEAR280 
          INNER JOIN LBPRDDAT/DETA16 ON DETA16.DETC90 = MAEAR280.MAEC12
          INNER JOIN LBPRDDAT/LO0705 ON LO0705.CODCIA = MAEAR280.MAEC12
          INNER JOIN LBPRDDAT/LO0686 ON LO0686.CODCIA = MAEAR280.MAEC12
          WHERE DETA16.DETUSU ='".$_SESSION["CODUSU"]."' AND DETA16.DETPR1 = 'LO1512P' and MAEC12 IN (49,66,69,71,86)
          GROUP BY CODSEC,MAEC12,NOMCIA)";
        $resultInvGua=odbc_exec($connIBM,$sqlInvGua); 
        //EL SALVADOR
       $sqlInvSal="SELECT '1' CON,(SUM(FLOOR(((FLOOR(MAESA2)*12) +ROUND((MAESA2 - FLOOR(MAESA2)) * 100)))) -
                        SUM(FLOOR(((FLOOR(MAECA3)*12) +ROUND((MAECA3 - FLOOR(MAECA3)) * 100))))) MAESA2 
                  FROM( SELECT CODSEC,MAEC12,NOMCIA, sum(maesa2)MAESA2, sum(maeca3) MAECA3
                  FROM lbprddat/MAEAR280 
                  INNER JOIN LBPRDDAT/DETA16 ON DETA16.DETC90 = MAEAR280.MAEC12
                  INNER JOIN LBPRDDAT/LO0705 ON LO0705.CODCIA = MAEAR280.MAEC12
                  INNER JOIN LBPRDDAT/LO0686 ON LO0686.CODCIA = MAEAR280.MAEC12
                  WHERE DETA16.DETUSU ='".$_SESSION["CODUSU"]."' AND DETA16.DETPR1 = 'LO1512P' and MAEC12 IN(48,53,61,62)
                  GROUP BY CODSEC,MAEC12,NOMCIA)";

        $resultInvSal=odbc_exec($connIBM,$sqlInvSal); 
         //COSTA RICA
       $sqlInvCos="SELECT '1' CON,(SUM(FLOOR(((FLOOR(MAESA2)*12) +ROUND((MAESA2 - FLOOR(MAESA2)) * 100)))) -
                      SUM(FLOOR(((FLOOR(MAECA3)*12) +ROUND((MAECA3 - FLOOR(MAECA3)) * 100))))) MAESA2 
                FROM( SELECT CODSEC,MAEC12,NOMCIA, sum(maesa2)MAESA2, sum(maeca3) MAECA3
                FROM lbprddat/MAEAR280 
                INNER JOIN LBPRDDAT/DETA16 ON DETA16.DETC90 = MAEAR280.MAEC12
                INNER JOIN LBPRDDAT/LO0705 ON LO0705.CODCIA = MAEAR280.MAEC12
                INNER JOIN LBPRDDAT/LO0686 ON LO0686.CODCIA = MAEAR280.MAEC12
                WHERE DETA16.DETUSU ='".$_SESSION["CODUSU"]."' AND DETA16.DETPR1 = 'LO1512P' and MAEC12 IN(60,80)
                GROUP BY CODSEC,MAEC12,NOMCIA)";
        $resultInvCos=odbc_exec($connIBM,$sqlInvCos); 
         //NICARAGUA
       $sqlInvNic="SELECT '1' CON,(SUM(FLOOR(((FLOOR(MAESA2)*12) +ROUND((MAESA2 - FLOOR(MAESA2)) * 100)))) -
                        SUM(FLOOR(((FLOOR(MAECA3)*12) +ROUND((MAECA3 - FLOOR(MAECA3)) * 100))))) MAESA2 
                  FROM( SELECT CODSEC,MAEC12,NOMCIA, sum(maesa2)MAESA2, sum(maeca3) MAECA3
                  FROM lbprddat/MAEAR280 
                  INNER JOIN LBPRDDAT/DETA16 ON DETA16.DETC90 = MAEAR280.MAEC12
                  INNER JOIN LBPRDDAT/LO0705 ON LO0705.CODCIA = MAEAR280.MAEC12
                  INNER JOIN LBPRDDAT/LO0686 ON LO0686.CODCIA = MAEAR280.MAEC12
                  WHERE DETA16.DETUSU ='".$_SESSION["CODUSU"]."' AND DETA16.DETPR1 = 'LO1512P' and MAEC12 IN(83,87)
                  GROUP BY CODSEC,MAEC12,NOMCIA)";
        $resultInvNic=odbc_exec($connIBM,$sqlInvNic); 
         //REP DOMINICANA
       $sqlInvRep="SELECT '1' CON,(SUM(FLOOR(((FLOOR(MAESA2)*12) +ROUND((MAESA2 - FLOOR(MAESA2)) * 100)))) -
                        SUM(FLOOR(((FLOOR(MAECA3)*12) +ROUND((MAECA3 - FLOOR(MAECA3)) * 100))))) MAESA2 
                  FROM( SELECT CODSEC,MAEC12,NOMCIA, sum(maesa2)MAESA2, sum(maeca3) MAECA3
                  FROM lbprddat/MAEAR280 
                  INNER JOIN LBPRDDAT/DETA16 ON DETA16.DETC90 = MAEAR280.MAEC12
                  INNER JOIN LBPRDDAT/LO0705 ON LO0705.CODCIA = MAEAR280.MAEC12
                  INNER JOIN LBPRDDAT/LO0686 ON LO0686.CODCIA = MAEAR280.MAEC12
                  WHERE DETA16.DETUSU ='".$_SESSION["CODUSU"]."' AND DETA16.DETPR1 = 'LO1512P' and MAEC12 IN(81)
                  GROUP BY CODSEC,MAEC12,NOMCIA)";
        $resultInvRep=odbc_exec($connIBM,$sqlInvRep); 
           
           $invHonduras=0;$invGuatemala=0; $invElSalvador=0;$invCostaRica=0;$invRepDominicana=0; 0;
                  while($rowHon = odbc_fetch_array($resultInvHon)){
                    while($rowGua = odbc_fetch_array($resultInvGua)){
                      while($rowSal= odbc_fetch_array($resultInvSal)){
                        while($rowCos= odbc_fetch_array($resultInvCos)){
                          while($rowRep= odbc_fetch_array($resultInvRep)){
                            while($rowNic= odbc_fetch_array($resultInvNic)){
                              $invHonduras=$rowHon['MAESA2'];
                              $invGuatemala= $rowGua['MAESA2']; 
                              $invElSalvador=$rowSal['MAESA2'];
                              $invCostaRica=$rowCos['MAESA2'];
                              $invRepDominicana=$rowRep['MAESA2'];
                              $invNicaragua=$rowNic['MAESA2'];
                              $invPaises=array("Honduras" => $rowHon['MAESA2'],
                                               "Guatemala"=>$rowGua['MAESA2'],
                                               "El Salvador"=>$rowSal['MAESA2'],
                                               "Costa Rica"=>$rowCos['MAESA2'],
                                               "Rep. Dominicana"=>$rowRep['MAESA2'],
                                               "Nicaragua"=>$rowNic['MAESA2']); 
                            }
                          }
                        }
                      }                    
                    }
                  }

                  if ( $ordenFiltro3=="2") {
                    $invPaises[]=arsort($invPaises);
                  }else if ( $ordenFiltro3=="3"){
                    $invPaises[]=asort($invPaises);
                  }
                  $removed = array_pop($invPaises);  
                  

  
?>
     <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><span>Producto Terminado</span>
              </li>
              <li class="breadcrumb-item active"><span>ZLO0002P</span></li>
            </ol>
          </nav>
        </div>
      </header>
      <div id="body-div" class="body flex-grow-3">
          <div class="card mb-5">
            <div class="card-header">
              
            </div>
            <div class="card-body">
            <div class="demo">
                <ul class="tablist" role="tablist">
                    <li id="tab1" class="tablist__tab text-center p-3  is-active" aria-controls="panel1" aria-selected="true" role="tab" tabindex="0">Puntos de venta</li>
                    <li id="tab2" class="tablist__tab text-center p-3" aria-controls="panel2" aria-selected="false" role="tab" tabindex="0">Países</li>
                </ul>

                <div id="panel1" class="tablist__panel" aria-labelledby="tab1" aria-hidden="false" role="tabpanel">
                <div class="card p-3">
                <h5 class="fs-4 mb-4 mt-2 text-center responsive-font-example">Inventario disponible por <u>punto de venta</u></h5>
                  <div class="positionRel" style='width:100%;'>
                    <div class="graficasPC">
                      <canvas id="miGrafica2" height="500px"></canvas>
                    </div>
                  </div>
                  <div class="graficasMovil justify-content-center mt-3 mb-3" style='width:100%;'>
                      <canvas id="miGrafica4"></canvas>
                  </div>
                  <hr class="mt-2 mb-5">
                    <form action="../../assets/php/ZPT/ZLO0002P/ordenLogica1.php" method="POST" id="formOrden"  class="mb-3">
                      <div class="row">
                      <div class="col-12 mt-2 d-flex">
                        <label for="cbbOrden2" class="me-3 mt-2" id="lblcbbOrden2">Organizar por: </label>
                        <select name="cbbOrden2" id="cbbOrden2" class="form-select" style="width: 170px">
                          <option value="1">Compañia</option>
                          <option value="2">Mayor a Menor</option>
                          <option value="3">Menor a Mayor</option>
                        </select>
                      </div>
                      </div>
                    </form>
                <table id="myTableInventario" class="table stripe table-hover " style="width:100%">
                  <thead>
                      <tr>
                          <th class="d-none">ID</th>
                          <th >Punto de Venta</th>
                          <th >Total en Docenas</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php 
                        $cantidadInv=0; $cantidadTot=0;$con=0;
                        while($rowInv = odbc_fetch_array($resultInv)){
                          $cantidadInv=$rowInv['MAESA2'];
                          $cantidadInv=($cantidadInv<0)? 0:$cantidadInv/12;
                          $cantidadTot+=$cantidadInv;
                                print '<tr>';
                                print '<td>'.$rowInv['CODSEC'].'</td>';
                                print '<td class="fw-bold">'.$rowInv['NOMCIA'].'</td>';
                                print '<td class="fw-bold">'.number_format($cantidadInv,0).'</td>';
                                print '</tr>';
                                $ciaArray[$con]=$rowInv['NOMCIA'];
                                $invArray[$con]=$cantidadInv;
                                $con++;
                        }
                        print '<tr>';
                        print '<td>9999</td>';
                        print '<td class="fw-bold">TOTAL</td>';
                        print '<td class="fw-bold">'.number_format($cantidadTot,0).' docenas</td>';
                        print '</tr>';
                      ?>
                  </tbody>
                  </table>
                  </div>
                </div>
                <div id="panel2" class="tablist__panel is-hidden" aria-labelledby="tab2" aria-hidden="true" role="tabpanel">
                <div class="card p-3">
                <h5 class="fs-4 mb-4 mt-2 text-center responsive-font-example">Inventario disponible por <u>país</u></h5>
                  <div class="positionRel" style='width:70%'>
                    <div class="graficasPC">
                      <canvas id="miGrafica"></canvas>
                    </div>
                  </div>
                  <div class="graficasMovil justify-content-center mt-3 mb-3" >
                      <canvas id="miGrafica3" ></canvas>
                  </div>
                  <hr class="mt-2 mb-5">
                  <form action="../../assets/php/ZPT/ZLO0002P/ordenLogica1.php" method="POST" id="formOrden3"  class="mb-3">
                      <div class="row">
                      <div class="col-12 mt-2 d-flex">
                        <label for="cbbOrden3" class="me-3 mt-2" id="lblcbbOrden3">Organizar por: </label>
                        <select name="cbbOrden3" id="cbbOrden3" class="form-select" style="width: 170px">
                          <option value="1">Compañia</option>
                          <option value="2">Mayor a Menor</option>
                          <option value="3">Menor a Mayor</option>
                        </select>
                      </div>
                      </div>
                    </form>
                <table id="myTableInventarioPaises" class="table stripe table-hover " style="width:100%" >
                  <thead>
                      <tr>
                          <th class="d-none">ID</th>
                          <th >Pais</th>
                          <th>Total en Docenas</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php 
                      $InvPaisTot=0;$cont=1;
                        
                       foreach($invPaises as $x => $x_value) {
                        $valor=($x_value<0)? 0:$x_value/12;
                        print '<tr>';
                        print '<td>'.$cont.'</td>';
                        print '<td class="fw-bold">'.$x.'</td>';
                        print '<td class="fw-bold">'.number_format($valor,0).'</td>';
                        print '</tr>';
                        $InvPaisTot+=$valor;
                        $cont++;
                      }
                        
                        print '<tr>';
                        print '<td>9999</td>';
                        print '<td class="fw-bold">TOTAL</td>';
                        print '<td class="fw-bold">'.number_format($InvPaisTot,0).' docenas</td>';
                        print '</tr>';
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
      <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1"></script>
      <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
      <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
      <script>
        $( document ).ready(function() {

          //BOTONES
            var tab;
                $(".tablist__tab").click(function() {
                  $(".tablist__tab").removeClass("is-active");
                  $(this).addClass("is-active");
                  var activeTab = $(".tablist__tab").filter(".is-active").attr("id");
                  tab=(activeTab.substring(3,4));
                  document.cookie="tabselected3="+tab;
                });
              
                var tabSeleccionado=<?php echo isset($_SESSION['tab3']) ? $_SESSION['tab3'] : "false"; ?>;
                if (tabSeleccionado != false) {
                        var tabs = $('.tablist__tab'),
                                    tabPanels = $('.tablist__panel');
                                var thisTab = $("#tab"+tabSeleccionado+""),
                                        thisTabPanelId = thisTab.attr('aria-controls'),
                                        thisTabPanel = $('#panel'+tabSeleccionado+'');
                        tabs.attr('aria-selected', 'false').removeClass('is-active');
                        thisTab.attr('aria-selected', 'true').addClass('is-active');
                        tabPanels.attr('aria-hidden', 'true').addClass('is-hidden');
                        thisTabPanel.attr('aria-hidden', 'false').removeClass('is-hidden');
                    }


          $("#cbbOrden2").val(<?php echo $ordenFiltro;  ?>); 
          $("#cbbOrden3").val(<?php echo $ordenFiltro3;  ?>); 
          
          $("#cbbOrden2").change(function() {
            $("#formOrden").submit();
          });
          $("#cbbOrden3").change(function() {
            $("#formOrden3").submit();
          });
          
          $("#myTableInventario, #myTableInventarioPaises").DataTable( {
            stateSave: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },

        columns: [
            {},
            {},
            {},
        ],
        "ordering": false,
        "pageLength": 100,
        "columnDefs": [
            {
                target: 0,
                visible: false,
                searchable: true,
            },
            {
                target: 1,
                visible: true,
                searchable: true,
            },
            {
                target: 2,
                visible: true,
                searchable: false,
            },
            ],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fa-solid fa-file-excel"></i> <b >Enviar a Excel</b>',
                className: "btn btn-success text-light fs-6 ",
                exportOptions: {
                    columns: [1,2]
                },
                title: 'ReporteInventario Tiendas',
                
                customize: function (xlsx) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    var sSh = xlsx.xl['styles.xml'];
                    var lastXfIndex = $('cellXfs xf', sSh).length - 1;
                    var lastFontIndex = $('fonts font', sSh).length - 1;
                    var i; var y;
                    var f1 = '<font>'+
                     '<sz val="11" />'+
                     '<name val="Calibri" />'+
                     '<color rgb="FF0000" />'+ // color rojo en la fuente
                   '</font>';
                   var f2 = '<font>'+
                     '<sz val="11" />'+
                     '<name val="Calibri" />'+
                     '<color rgb="007800" />'+ // color verde en la fuente
                   '</font>';
                    var n1 = '<numFmt formatCode="##0%"   numFmtId="300"/>';
                    var n2 = '<numFmt formatCode="#,##0.00"   numFmtId="200"/>';
                    var s1 = '<xf numFmtId="300" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>';
                    var s2 = '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">'+
                                '<alignment horizontal="center"/></xf>';
                    var s3 = '<xf numFmtId="4" fontId="2" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>'
                    var s4 = '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">'+
                                '<alignment horizontal="center" wrapText="1"/></xf>'
                    var s5 = '<xf  numFmtId="200" fontId="'+(lastFontIndex+1)+'" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">'+
                     '<alignment horizontal="right"/></xf>';  
                     var s6 = '<xf  numFmtId="200" fontId="'+(lastFontIndex+2)+'" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">'+
                     '<alignment horizontal="right"/></xf>';  
                     var s7 = '<xf  numFmtId="300" fontId="'+(lastFontIndex+1)+'" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">'+
                     '<alignment horizontal="right"/></xf>';  
                     var s8 = '<xf  numFmtId="300" fontId="'+(lastFontIndex+2)+'" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">'+
                     '<alignment horizontal="right"/></xf>';
                    sSh.childNodes[0].childNodes[0].innerHTML += n1 + n2;
                    sSh.childNodes[0].childNodes[1].innerHTML += f1 + f2;
                    sSh.childNodes[0].childNodes[5].innerHTML += s1 + s2 + s3 + s4 + s5 + s6 + s7 + s8; 
                     
                    var fourDecPlaces    = lastXfIndex + 1;
                    var greyBoldCentered = lastXfIndex + 2;
                    var twoDecPlacesBold = lastXfIndex + 3;
                    var greyBoldWrapText = lastXfIndex + 4;
                    var textred1 = lastXfIndex + 5;
                    var textgreen1 = lastXfIndex + 6;
                    var textred2 = lastXfIndex + 7;
                    var textgreen2 = lastXfIndex + 8;
                    
                    $('c[r=A1] t', sheet).text( 'REPORTE DE INVENTARIO DISPONIBLE' );
                    $('row:eq(0) c', sheet).attr( 's', greyBoldCentered );
                    $('row:eq(1) c', sheet).attr( 's', 7 );

                    var tagName = sSh.getElementsByTagName('sz');
                    for (i = 0; i < tagName.length; i++) {
                      tagName[i].setAttribute("val", "13")
                    }
                  }
            }
           ]
          });
    
          Chart.register(ChartDataLabels);
          //GRAFICA PAISES BARRA     
            const ctx = document.getElementById('miGrafica').getContext('2d');
              const data = {
                labels: [<?php foreach($invPaises as $x => $x_value) { echo "'".$x."',"; }?>],
                datasets: [
                  {
                    label: 'Docenas',
                    data: [<?php foreach($invPaises as $x => $x_value) {$valor=($x_value<0)? 0:$x_value/12; echo "'".round($valor)."',"; }?>],
                    backgroundColor: [
                                      "rgba(20, 36, 89,0.6)","rgba(23, 107, 160,0.6)","rgba(25, 170, 222,0.6)","rgba(26, 201, 230,0.6)","rgba(29, 228, 219,0.6)","rgba(109, 240, 210,0.6)",
                                      "rgba(41, 6, 107,0.6)","rgba(125, 58, 193,0.6)","rgba(175, 75, 206,0.6)","rgba(219, 76, 178,0.6)","rgba(130, 4, 1,0.6)","rgba(192, 35, 35,0.6)",
                                      "rgba(222, 84, 44,0.6)","rgba(239, 126, 50,0.6)","rgba(238, 154, 58,0.6)","rgba(234, 219, 56,0.6)","rgba(79, 32, 13,0.6)","rgba(231, 227, 78,0.6)",
                                    ],
                    borderWidth: 1,
                  },
                ],
              };
              const options1 = {
                "maintainAspectRatio":true,
                    "responsive": true,
                  plugins: {
                    "legend": {
                          "display": false,
                          "position": "bottom",   
                          },
                      "datalabels": {
                        "color": "rgba(0,0,0,0.8)",
                        "font": {
                          "weight": 'bold',
                          "size": 16,
                        }
                      }
                    }
                };
              



              const myChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: options1,
              });
            //GRAFICA PAISES DONA
            const ctx3 = document.getElementById('miGrafica3').getContext('2d');
            var myChart3 = new Chart(ctx3, {
              type: 'pie',
              data: {
                  labels:  [<?php foreach($invPaises as $x => $x_value) { echo "'".$x."',"; }?>],
                  datasets: [{
                    label: 'Docenas',
                    data: [<?php foreach($invPaises as $x => $x_value) {$valor=($x_value<0)? 0:$x_value/12; echo "'".round($valor)."',"; }?>],
                      backgroundColor: [
                        "rgba(20, 36, 89,0.6)","rgba(23, 107, 160,0.6)","rgba(25, 170, 222,0.6)","rgba(26, 201, 230,0.6)","rgba(29, 228, 219,0.6)","rgba(109, 240, 210,0.6)",
                        "rgba(41, 6, 107,0.6)","rgba(125, 58, 193,0.6)","rgba(175, 75, 206,0.6)","rgba(219, 76, 178,0.6)","rgba(130, 4, 1,0.6)","rgba(192, 35, 35,0.6)",
                        "rgba(222, 84, 44,0.6)","rgba(239, 126, 50,0.6)","rgba(238, 154, 58,0.6)","rgba(234, 219, 56,0.6)","rgba(79, 32, 13,0.6)","rgba(231, 227, 78,0.6)",
                      ],
                      borderColor: [
                        "rgba(0,0,0,0.2)"
                      ],
                      borderWidth: 1
                  }]
              },
                      options: {
                        "tooltips": {
                          "callbacks":{
                            "label": function(tooltipItem, data) {
                              var label = "prueba";
                              var value = "1";
                              return label + ': ' + value;
                            }
                          }
                        },
                        maintainAspectRatio:false,
                    responsive: false,
                    "plugins": {
                  "legend": {
                    "display": false,
                    "position": "bottom",
                    
                  },
                  datalabels: {   
                    color: '#fff',
                    offset: -10,
                  }
                },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            });

            //GRAFICA PUNTO DE VENTAS

            var arrayValores = <?php echo json_encode($invArray); ?>;
            var invArray=[];
            for (let index = 0; index < arrayValores.length; index++) {
              const element = arrayValores[index];
              invArray.push(Math.round(element));
            }

            const ctx2 = document.getElementById('miGrafica2').getContext('2d');
              const data2 = {
                labels: <?php echo json_encode($ciaArray); ?>,
                datasets: [
                  {
                    label: 'Docenas',
                    data: invArray,
                    backgroundColor: [
                                      "rgba(20, 36, 89,0.6)","rgba(23, 107, 160,0.6)","rgba(25, 170, 222,0.6)","rgba(26, 201, 230,0.6)","rgba(29, 228, 219,0.6)","rgba(109, 240, 210,0.6)",
                                      "rgba(41, 6, 107,0.6)","rgba(125, 58, 193,0.6)","rgba(175, 75, 206,0.6)","rgba(219, 76, 178,0.6)","rgba(130, 4, 1,0.6)","rgba(192, 35, 35,0.6)",
                                      "rgba(222, 84, 44,0.6)","rgba(239, 126, 50,0.6)","rgba(238, 154, 58,0.6)","rgba(234, 219, 56,0.6)","rgba(79, 32, 13,0.6)","rgba(231, 227, 78,0.6)",
                                    ],
                    borderWidth: 1,
                  },
                ],
              };

              const options = {
                "maintainAspectRatio":false,
                    "responsive": true,
                  plugins: {
                    "legend": {
                          "display": false,
                          "position": "bottom",   
                          },
                      "datalabels": {
                        "color": "rgba(0,0,0,0.8)",
                        "font": {
                          "weight": 'bold',
                          "size": 16,
                        }
                      }
                    }
                };
              
              const myChart2 = new Chart(ctx2, {
                type: 'bar',
                data: data2,
                options: options,
              });
              //GRAFICA PUNTO DE VENTA DONA
            const ctx4 = document.getElementById('miGrafica4').getContext('2d');

            var myChart4 = new Chart(ctx4, {
              type: 'pie',
              data: {
                  labels: <?php echo json_encode($ciaArray); ?>,
                  datasets: [{
                    label: 'Docenas',
                      data:invArray,
                      backgroundColor: [
                        "rgba(20, 36, 89,0.6)","rgba(23, 107, 160,0.6)","rgba(25, 170, 222,0.6)","rgba(26, 201, 230,0.6)","rgba(29, 228, 219,0.6)","rgba(109, 240, 210,0.6)",
                        "rgba(41, 6, 107,0.6)","rgba(125, 58, 193,0.6)","rgba(175, 75, 206,0.6)","rgba(219, 76, 178,0.6)","rgba(130, 4, 1,0.6)","rgba(192, 35, 35,0.6)",
                        "rgba(222, 84, 44,0.6)","rgba(239, 126, 50,0.6)","rgba(238, 154, 58,0.6)","rgba(234, 219, 56,0.6)","rgba(79, 32, 13,0.6)","rgba(231, 227, 78,0.6)",
                      ],
                      borderColor: [
                        "rgba(0,0,0,0.2)"
                      ],
                      borderWidth: 1
                  }]
              },
                      options: {
                        "tooltips": {
                          "callbacks":{
                            "label": function(tooltipItem, data) {
                              var label = "prueba";
                              var value = "1";
                              return label + ': ' + value;
                            }
                          }
                        },
                        maintainAspectRatio:false,
                    responsive: false,
                    "plugins": {
                  "legend": {
                    "display": false,
                    "position": "bottom",
                    
                  },
                  datalabels: {
                    formatter: (value, ctx) => {
                      const datapoints = ctx.chart.data.datasets[0].data
                      const total = datapoints.reduce((total, datapoint) => total + datapoint, 0)
                      const percentage = value / total * 100
                      return percentage.toFixed(2) + "%";
                    },
                    color: '#fff',
                    offset: -10,
                  }
                },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            });
        });
         
        
      </script>

</body>
      
</html>