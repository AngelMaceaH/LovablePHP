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
      include 'ZLO0001Psql.php';
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
                    <?php
                    while ($rowCOMARC = odbc_fetch_array($resultCOMARC)) {
                      echo "<option value='" . $rowCOMARC['COMCOD'] . "'>" . rtrim(utf8_encode($rowCOMARC['COMDES'])) . "</option>";
                     }
                    ?>
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
                       print '     <tbody>';
                       
                              if($row_zlo0001p = odbc_fetch_array($result_zlo0001p)){
                                $cont=0;
                                  do{
                                    $compañia = rtrim(utf8_encode($row_zlo0001p['COMDES']));
                                    if ($_SESSION['filtro']==3) {
                                      $mon='D';
                                    }else{
                                      $mon = rtrim(utf8_encode($row_zlo0001p['MON']));
                                    }
                                    $subdia = $mon.'.'.number_format(rtrim(utf8_encode($row_zlo0001p['SUBDIA'])),2, '.', ',');
                                    $submes = $mon.'.'.number_format(rtrim(utf8_encode($row_zlo0001p['SUBMES'])),2, '.', ',');
                                    $ano1=$mon.'.'.$registrosAnual[$cont]['ANO1'];
                                    $ano2=$mon.'.'.$registrosAnual[$cont]['ANO2'];
                                    $varia=$mon.'.'.$registrosAnual[$cont]['VARIA'];
                                    $creci=$registrosAnual[$cont]['CRECI'];
                                    if($_SESSION['filtro']!=2 ){ $prodia=$mon.'.'.$registrosPromedios[$cont]['PRODIA'];
                                    $promes=$mon.'.'.$registrosPromedios[$cont]['PROMES'];
                                    $proano=$mon.'.'.$registrosPromedios[$cont]['PROANO'];  
                                    $proano2=$mon.'.'.$registrosPromedios[$cont]['PROANO2'];
                                    $variaP=$mon.'.'.$registrosPromedios[$cont]['VARIA'];
                                    $creciP=$registrosPromedios[$cont]['CRECI'];}


                                    if ($_SESSION['filtro']==1 || $_SESSION['filtro']==2) {
                                      $subdia = number_format(rtrim(utf8_encode($row_zlo0001p['SUBDIA'])),0);
                                      $submes = number_format(rtrim(utf8_encode($row_zlo0001p['SUBMES'])),0);
                                      $ano1=$registrosAnual[$cont]['ANO1'];
                                      $ano2=$registrosAnual[$cont]['ANO2'];
                                      $varia=$registrosAnual[$cont]['VARIA'];
                                      $creci=number_format((float)$registrosAnual[$cont]['CRECI'],0);
                                      if($_SESSION['filtro']!=2 ){
                                      $prodia=number_format((float)$registrosPromedios[$cont]['PRODIA'],2);
                                      $promes=number_format((float)$registrosPromedios[$cont]['PROMES'],2);
                                      $proano=number_format((float)$registrosPromedios[$cont]['PROANO'],2);
                                      $proano2=number_format((float)$registrosPromedios[$cont]['PROANO2'],2);
                                      $variaP=number_format((float)$registrosPromedios[$cont]['VARIA'],2);
                                      $creciP=number_format((float)$registrosPromedios[$cont]['CRECI'],0);}
                                    }
                                      if($row_zlo0001p['ID'] != "")
                                      {
                                          print '<tr  onclick="location.href=\'/'.$_SESSION['DEV'].'LovablePHP/PRG/ZFA/ZLO0001PA.php?id='.$row_zlo0001p['ID'].'&dat='.$_SESSION['FechaFiltro'].'\';">';
                                          print   '<td class="responsive-font-example d-none" ><b>' .$row_zlo0001p['CODSEC'].'</b></td>';
                                          print   '<td class="responsive-font-example d-none" ><b>' .$row_zlo0001p['ID'].'</b></td>';
                                          print   '<td class="text-start responsive-font-example"><b>' .$compañia.'</b></td>';
                                          if ($row_zlo0001p['SUBDIA']==0) {print '<td id="tddia1" class="text-end responsive-font-example text-danger text-end"><b>'.$subdia.'</b></td>';}else{print '<td id="tddia1" class="text-end responsive-font-example text-darkblue text-end"><b>'.$subdia.'</b></td>';}
                                          if ($row_zlo0001p['SUBMES']==0) {print '<td id="tddia2" class="text-end responsive-font-example text-danger  text-end"><b>' .$submes.'</b></td>';}else{print '<td id="tddia2" class="text-end responsive-font-example text-pink text-end"><b>' .$submes.'</b></td>';}
                                          if ($registrosAnual[$cont]['ANO1']==0) {print   '<td id="tdanual1" class="text-end responsive-font-example d-none  text-danger"><b>'.$ano1.'</b></td>';}else{print   '<td id="tdanual1" class="text-end responsive-font-example d-none "><b>'.$ano1.'</b></td>';}
                                          if ($registrosAnual[$cont]['ANO2']==0) {print   '<td id="tdanual2" class="text-end responsive-font-example d-none  text-danger"><b>'.$ano2.'</b></td>';}else{print   '<td id="tdanual2" class="text-end responsive-font-example d-none "><b>'.$ano2.'</b></td>';} 
                                          if ($registrosAnual[$cont]['VARIA']<0) {
                                            print   '<td id="tdanual3" class="text-end responsive-font-example d-none "><b><span class="text-danger">'.$varia.'</b></td>';
                                          }elseif ($registrosAnual[$cont]['VARIA']>0) {
                                            print   '<td id="tdanual3" class="text-end responsive-font-example d-none "><b><span class="text-success">'.$varia.'</b></td>';
                                          }else{
                                            print   '<td id="tdanual3" class="text-end responsive-font-example d-none "><b><span>'.$varia.'</b></td>';
                                          }   
      
                                          if ($registrosAnual[$cont]['CRECI']<0) {
                                            print   '<td id="tdanual4" class="text-end responsive-font-example d-none  text-danger"><b>'.$creci.'%</b></td>';
                                          }elseif ($registrosAnual[$cont]['CRECI']>0) {
                                            print   '<td id="tdanual4" class="text-end responsive-font-example d-none  text-success"><b>'.$creci.'%</b></td>';
                                          }else {
                                            print   '<td id="tdanual4" class="text-end responsive-font-example d-none "><b>'.$creci.'%</b></td>';
                                          }  
                                          if($_SESSION['filtro']!=2 ){ if ($registrosPromedios[$cont]['PRODIA']==0) {print '<td id="tdpro1" class="text-end responsive-font-example text-danger d-none"><b>'.$prodia.'</b></td>';}else{print '<td id="tdpro1" class="text-end responsive-font-example  d-none"><b>'.$prodia.'</b></td>';} 
                                          if ($registrosPromedios[$cont]['PROMES']==0) {print '<td id="tdpro2" class="text-end responsive-font-example d-none text-danger"><b>' .$promes.'</b></td>';}else{print '<td id="tdpro2" class="text-end responsive-font-example  d-none"><b>' .$promes.'</b></td>';} 
                                          if ($registrosPromedios[$cont]['PROANO']==0) {print  '<td id="tdpro3" class="text-end responsive-font-example d-none text-danger"><b>'.$proano.'</b></td>';}else{print '<td id="tdpro3" class="text-end responsive-font-example d-none "><b>'.$proano.'</b></td>';}
                                          if ($registrosPromedios[$cont]['PROANO2']==0) {print   '<td id="tdpro4" class="text-end responsive-font-example d-none  text-danger"><b>' .$proano2.'</b></td>';}else{print  '<td id="tdpro4" class="text-end responsive-font-example d-none "><b>' .$proano2.'</b></td>';}
                                          if ($registrosPromedios[$cont]['VARIA']<0) {
                                            print   '<td id="tdpro5" class="text-end responsive-font-example d-none  text-danger"><b>'.$variaP.'</b></td>';
                                          }elseif ($registrosPromedios[$cont]['VARIA']>0){
                                            print   '<td id="tdpro5" class="text-end responsive-font-example d-none  text-success"><b>'.$variaP.'</b></td>';
                                          }else{
                                            print   '<td id="tdpro5" class="text-end responsive-font-example d-none "><b>'.$variaP.'</b></td>';
                                          }
                                          if ($registrosPromedios[$cont]['CRECI']<0) {
                                            print   '<td id="tdpro6" class="text-end responsive-font-example d-none  text-danger"><b>'.$creciP.'%</b></td>';
                                          }elseif ($registrosPromedios[$cont]['CRECI']>0){
                                            print   '<td id="tdpro6" class="text-end responsive-font-example d-none  text-success"><b>'.$creciP.'%</b></td>';
                                          }else{
                                            print   '<td id="tdpro6" class="text-end responsive-font-example d-none"><b>'.$creciP.'%</b></td>';
                                          }}
                                          print '</tr>';
                                          $cont++;
                                      }
                                  }
                                  while($row_zlo0001p = odbc_fetch_array($result_zlo0001p));
                              
                              }else{
                               //echo "<script>window.location = '/".$_SESSION['DEV']."LovablePHP/404.html'</script>";
                              }
                              
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
      <script>
 
           $( document ).ready(function() {


            $("#myTable").DataTable( {
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            },
            "ordering": false,
            "responsive": true,
            "pageLength": 100,
            dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fa-solid fa-file-excel"></i> <b >Enviar a Excel</b>',
                className: "btn btn-success text-light mt-2 fs-6 ",
                
                exportOptions: {
                  <?php if($_SESSION['filtro']!=2){?>
                    columns: [2,3,4,5,6,7,8,9,10,11,12,13,14]
                    <?php
                }else{
                ?>
                    columns: [2,3,4,5,6,7,8]
                <?php
                }
                ?>
                },
                
                title: 'ReporteVentas',
                messageTop:' ',                                                                                                                                                                                                               
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
                    var n2 = '<numFmt formatCode="#,##0.00"   numFmtId="200" />';
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
                    
                    <?php
                      $title="";
                      switch ($_SESSION['filtro']) {
                        case 1:
                          $title="(UNIDADES)";
                          break;
                          case 2:
                            $title="(TRANSACCIONES)";
                            break;
                            case 3:
                              $title="(DOLARES)";
                              break;
                              case 4:
                                $title="(MONEDA NACIONAL)";
                                break;
                        
                        default:
                          # code...
                          break;
                      }
                    
                    ?>
                    $('c[r=A1] t', sheet).text( 'REPORTE DE VENTAS RESUMIDAS POR COMPAÑÍA <?php echo $title; ?> ');
                    $('row:eq(0) c', sheet).attr( 's', greyBoldCentered );
                    $('row:eq(1) c', sheet).attr( 's', 7 );
                  
                    for (let index = 3; index <= 100; index++) {

                      $('row:eq('+index+') c[r^="B"]', sheet).attr( 's', 52 );
                      $('row:eq('+index+') c[r^="C"]', sheet).attr( 's', 52 );  
                      $('row:eq('+index+') c[r^="D"]', sheet).attr( 's', 52 );  
                      $('row:eq('+index+') c[r^="E"]', sheet).attr( 's', 52 );  
                      $('row:eq('+index+') c[r^="F"]', sheet).attr( 's', 52 );  
                      $('row:eq('+index+') c[r^="G"]', sheet).attr( 's', 52 );  
                      $('row:eq('+index+') c[r^="H"]', sheet).attr( 's', 52 );  
                      $('row:eq('+index+') c[r^="I"]', sheet).attr( 's', 52 );  
                      $('row:eq('+index+') c[r^="J"]', sheet).attr( 's', 52 );  
                      $('row:eq('+index+') c[r^="K"]', sheet).attr( 's', 52 ); 
                      $('row:eq('+index+') c[r^="L"]', sheet).attr( 's', 52 ); 
                      $('row:eq('+index+') c[r^="M"]', sheet).attr( 's', 52 );   

                      <?php
                        if($_SESSION['filtro']==1 || $_SESSION['filtro']==2){
                      ?>
                         if (parseFloat($('row:eq('+index+') c[r^="B"]', sheet).text())==0) {
                          $('row:eq('+index+') c[r^="B"]', sheet).attr( 's', textred1 );  //ROJO
                        }
                        if (parseFloat($('row:eq('+index+') c[r^="F"]', sheet).text())<0) {
                        $('row:eq('+index+') c[r^="F"]', sheet).attr( 's', textred1 );  //ROJO
                        }else{
                          $('row:eq('+index+') c[r^="F"]', sheet).attr( 's', textgreen1 );  //VERDE
                        }
                        if (parseFloat($('row:eq('+index+') c[r^="F"]', sheet).text())<0) {
                        $('row:eq('+index+') c[r^="M"]', sheet).attr( 's', textred2 );  //ROJO
                        }else{
                          $('row:eq('+index+') c[r^="M"]', sheet).attr( 's', textgreen2 );  //VERDE
                        }
                        if (parseFloat($('row:eq('+index+') c[r^="F"]', sheet).text())<0) {
                       $('row:eq('+index+') c[r^="L"]', sheet).attr( 's', textred1 );  //ROJO
                        }else{
                          $('row:eq('+index+') c[r^="L"]', sheet).attr( 's', textgreen1 );  //VERDE
                        }
                      <?php  
                        }else{
                      ?>
                        if (parseFloat(($('row:eq('+index+') c[r^="B"]', sheet).text()).slice(2))==0) {
                          $('row:eq('+index+') c[r^="B"]', sheet).attr( 's', textred1 );  //ROJO
                        }
                        if (parseFloat(($('row:eq('+index+') c[r^="F"]', sheet).text()).slice(2))<0) {
                        $('row:eq('+index+') c[r^="F"]', sheet).attr( 's', textred1 );  //ROJO
                        }else{
                          $('row:eq('+index+') c[r^="F"]', sheet).attr( 's', textgreen1 );  //VERDE
                        }
                        if (parseFloat(($('row:eq('+index+') c[r^="F"]', sheet).text()).slice(2))<0) {
                          $('row:eq('+index+') c[r^="M"]', sheet).attr( 's', textred2 );  //ROJO
                        }else{
                          $('row:eq('+index+') c[r^="M"]', sheet).attr( 's', textgreen2 );  //VERDE
                        }
                        if (parseFloat(($('row:eq('+index+') c[r^="F"]', sheet).text()).slice(2))<0) {
                          $('row:eq('+index+') c[r^="L"]', sheet).attr( 's', textred1 );  //ROJO
                        }else{
                          $('row:eq('+index+') c[r^="L"]', sheet).attr( 's', textgreen1 );  //VERDE
                        }
                      <?php     
                        }
                      ?>
                     
                     
                      if (($('row:eq('+index+') c[r^="G"]', sheet).text()*1<0)) {
                        $('row:eq('+index+') c[r^="G"]', sheet).attr( 's', textred2 );  //ROJO
                      }else{
                        $('row:eq('+index+') c[r^="G"]', sheet).attr( 's', textgreen2 );  //VERDE
                      }

                      

                    

                    
                   }
                  
                   for (let index = 2; index <= 100; index++) {
                      
                    $('row:eq('+index+') c[r^="A"]', sheet).attr( 's', 7 );  
                    }
                    var tagName = sSh.getElementsByTagName('sz');
                    for (i = 0; i < tagName.length; i++) {
                      tagName[i].setAttribute("val", "13");
                    }
                    
 
                  }
                  
            }
        ],
            
          });
          $('#myTable').append('<caption style="caption-side: top" class="fw-bold text-black"><label class="ms-2 fw-bold">**Presione doble clic sobre la factura para ver detalles de la factura**</label></caption>');


             if (<?php echo isset($_SESSION['opcion']) ? $_SESSION['opcion'] : "1"; ?>==3) {
                  $("#btnradio2").addClass("d-none");
                    $("#btnnradio2").addClass("d-none");
                }else{
                  $("#btnradio2").removeClass("d-none");
                    $("#btnnradio2").removeClass("d-none");
                }
                if(<?php echo isset($_SESSION['filtro']) ? $_SESSION['filtro'] : "1"; ?>==2){
                  $("#tab3").addClass("d-none");
                }
                
               
            //BOTONES
            var tab;
            $(".tablist__tab").click(function() {
              $(".tablist__tab").removeClass("is-active");
              $(this).addClass("is-active");
              var activeTab = $(".tablist__tab").filter(".is-active").attr("id");
              tab=(activeTab.substring(3,4));
            });

            var button = 'btnradio'+<?php echo   $_SESSION['filtro'] ?>;
            $('#'+button+'').prop('checked',true);
            $('input[type="radio"]').click(function() {
              tab= tab!=null? tab: <?php echo isset($_SESSION['opcion']) ? $_SESSION['opcion'] : "1"; ?>;
              window.location.href="/<?php echo $_SESSION['DEV'] ?>LovablePHP/PRG/ZFA/ZLO0001P.php?opc="+tab+"&fil="+($(this).attr('id')).substring(8,9)+"";
            });

            var tabSeleccionado=<?php echo isset($_SESSION['opcion']) ? $_SESSION['opcion'] : "1"; ?>;
            if (tabSeleccionado != 1) {
                    var tabs = $('.tablist__tab'),
                                tabPanels = $('.tablist__panel');
                            var thisTab = $("#tab"+tabSeleccionado+""),
                                    thisTabPanelId = thisTab.attr('aria-controls'),
                                    thisTabPanel = $('#panel1');
                    tabs.attr('aria-selected', 'false').removeClass('is-active');
                    thisTab.attr('aria-selected', 'true').addClass('is-active');
                    tabPanels.attr('aria-hidden', 'true').addClass('is-hidden');
                    thisTabPanel.attr('aria-hidden', 'false').removeClass('is-hidden');

                    if (tabSeleccionado==1) {
                      $("#thdia1, #thdia2").removeClass("d-none");$("#tddia1, #tddia2").removeClass("d-none");    
                      $("#thpro1, #thpro2, #thpro3, #thpro4, #thpro5, #thpro6").addClass("d-none");$("#tdpro1, #tdpro2, #tdpro3, #tdpro4, #tdpro5, #tdpro6").addClass("d-none");     
                      $("#thanual1, #thanual2, #thanual3, #thanual4").addClass("d-none");$("#tdanual1, #tdanual2, #tdanual3, #tdanual4").addClass("d-none");
                    }else if(tabSeleccionado==2){
                      $("#thanual1, #thanual2, #thanual3, #thanual4").removeClass("d-none");$("#tdanual1, #tdanual2, #tdanual3, #tdanual4").removeClass("d-none");
                      $("#thdia1, #thdia2").addClass("d-none");$("#tddia1, #tddia2").addClass("d-none");        
                      $("#thpro1, #thpro2, #thpro3, #thpro4, #thpro5, #thpro6").addClass("d-none");$("#tdpro1, #tdpro2, #tdpro3, #tdpro4, #tdpro5, #tdpro6").addClass("d-none");
                    }else if (tabSeleccionado==3) {
                      $("#thpro1, #thpro2, #thpro3, #thpro4, #thpro5, #thpro6").removeClass("d-none");$("#tdpro1, #tdpro2, #tdpro3, #tdpro4, #tdpro5, #tdpro6").removeClass("d-none");     
                      $("#thanual1, #thanual2, #thanual3, #thanual4").addClass("d-none");$("#tdanual1, #tdanual2, #tdanual3, #tdanual4").addClass("d-none");
                      $("#thdia1, #thdia2").addClass("d-none");$("#tddia1, #tddia2").addClass("d-none");
                    }
                   
            }
            $('#productosCk').prop('checked', <?php echo  $ckProductos ?>);
            var fechafiltro = "<?php echo $fechafiltro ?>";
            var compfiltro = "<?php echo $compfiltro ?>";
            $("#fechapro").val(formatoFecha(fechafiltro));
            $("#comppro").val(compfiltro);

           });
           
            $("#fechapro, #comppro, #productosCk").change(function() {
              $("#formFiltros").submit();
            });

            function formatoFecha(fecha) {
              let year = fecha.substring(0, 4);
              let month = fecha.substring(4, 6);
              let day = fecha.substring(6, 8);
              return year + "-" + month + "-" + day;
            }


            
           
            $("#tab1").click(function() {
                  $("#btnradio2").removeClass("d-none");
                    $("#btnnradio2").removeClass("d-none");

            $("#thdia1, #thdia2").removeClass("d-none");$("#tddia1, #tddia2").removeClass("d-none");        
            $("#thanual1, #thanual2, #thanual3, #thanual4").addClass("d-none");$("#tdanual1, #tdanual2, #tdanual3, #tdanual4").addClass("d-none");
            $("#thpro1, #thpro2, #thpro3, #thpro4, #thpro5, #thpro6").addClass("d-none");$("#tdpro1, #tdpro2, #tdpro3, #tdpro4, #tdpro5, #tdpro6").addClass("d-none");
                });
            $("#tab2").click(function() {
                  $("#btnradio2").removeClass("d-none");
                    $("#btnnradio2").removeClass("d-none");
            
            $("#thanual1, #thanual2, #thanual3, #thanual4").removeClass("d-none");$("#tdanual1, #tdanual2, #tdanual3, #tdanual4").removeClass("d-none");
            $("#thdia1, #thdia2").addClass("d-none");$("#tddia1, #tddia2").addClass("d-none");        
            $("#thpro1, #thpro2, #thpro3, #thpro4, #thpro5, #thpro6").addClass("d-none");$("#tdpro1, #tdpro2, #tdpro3, #tdpro4, #tdpro5, #tdpro6").addClass("d-none");
                });
            $("#tab3").click(function() {
                  $("#btnradio2").addClass("d-none");
                    $("#btnnradio2").addClass("d-none");
              
              $("#thpro1, #thpro2, #thpro3, #thpro4, #thpro5, #thpro6").removeClass("d-none");$("#tdpro1, #tdpro2, #tdpro3, #tdpro4, #tdpro5, #tdpro6").removeClass("d-none");     
              $("#thanual1, #thanual2, #thanual3, #thanual4").addClass("d-none");$("#tdanual1, #tdanual2, #tdanual3, #tdanual4").addClass("d-none");
              $("#thdia1, #thdia2").addClass("d-none");$("#tddia1, #tddia2").addClass("d-none");        
            });


    </script>

</body>

</html>
