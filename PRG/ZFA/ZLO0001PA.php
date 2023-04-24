<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
</head>
<body>
<div class="spinner-wrapper">
<div class="spinner-border text-danger" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
        </div> 
<?php

      include '../layout-prg.php';
      include 'ZLO0001PAsql.php';
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
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">
                <div class="demo">
                <ul class="tablist" role="tablist">
                    <li id="tab1" class="tablist__tab text-center p-3  is-active" aria-controls="panel1" aria-selected="true" role="tab" tabindex="0">Detalle por factura</li>
                    <li id="tab2" class="tablist__tab text-center p-3" aria-controls="panel2" aria-selected="false" role="tab" tabindex="0">Resumen por días</li>
                </ul>

                <div id="panel1" class="tablist__panel" aria-labelledby="tab1" aria-hidden="false" role="tabpanel">
                   <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-9 col-lg-10 col-xl-10 col-xxl-11 col-8 " >
                            <h2 class="fs-4 mb-1 mt-4 text-center">Detalle de ventas por <b>factura</b>.</h2>
                        </div>
                        <div class="col-1 ">
                        <a class='btn btn-light mt-2' href="/<?php echo $_SESSION['DEV'] ?>LovablePHP/PRG/ZFA/ZLO0001P.php"><b>Regresar</b></a>
                        </div>
                    </div>
                        
                        <form id="formFiltros" action="../../php/ZFA/ZLO0001P/logic2.php" method="POST">
                        <div class="row mb-2">
                            <div class="col-sm-12 col-lg-6 mt-2">
                                <label>Compañía:</label>
                                <select class="form-control" id="comppro1" name="comppro1" >
                                    <?php
                                    while ($rowCOMARC = odbc_fetch_array($resultCOMARC)) {
                                    echo "<option  value='" . $rowCOMARC['COMCOD'] . "'>" . rtrim(utf8_encode($rowCOMARC['COMDES'])) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-6 mt-2 mb-3">
                            <label>Fecha:</label>
                            <input type="date" class="form-control" name="fechapro" id="fechapro" data-date-format="dd/mm/yyyy" onfocus="(this.type='date')" onkeydown="return false;">
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-2">
                                <div class="input-group">
                                <input class="me-2" type="checkbox" value="1" id="productosCk1" name="productosCk1">
                                 <label for="productosCk1"><b>Incluir otros productos</b></label>
                                </div>
                             </div>
                            
                        </div>
                        </form>
                        <hr> 
                        
                        <div class="table-responsive">
                        <table id="myTable2" class="table stripe table-hover mt-4" style="width:100%" >
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Día</th>
                                <th class="text-center">Factura</th>
                                <th class="text-end">Descuento</th>
                                <th class="text-end">Valor total</th>
                                <th class="text-end">Impuesto</th>
                                <th class="text-end">Neto</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $descuentoTotal=0;
                        $valorTotal=0;
                        $impuestoTotal=0;
                        $netoTotal=0; 
                        $descuentoSuma=0;
                        $valorSuma=0;
                        $impuestoSuma=0;
                        $netoSuma=0; 
                        $fechaAnterior = 0;
                    if($rowFacturaDia = odbc_fetch_array($resultFacturaDia)){
                        
                        do{
                            
                            if (strlen($rowFacturaDia['FACFE1']) == 7) {
                            $diaFicha = substr($rowFacturaDia['FACFE1'], 0, 1);
                            } else {
                            $diaFicha = substr($rowFacturaDia['FACFE1'], 0, 2);
                            }
                            $_SESSION['MON'] =substr($rowFacturaDia['FACTI3'],0,1);
                            if ($_SESSION['MON']=="U" && $rowFacturaDia['FACCO4']==1) {
                                $_SESSION['MON']="L";
                            }
                            if ($_SESSION['MON']=="U") {
                                $_SESSION['MON']="D";
                            }
                            if ($_SESSION['MON']=="G") {
                                $_SESSION['MON']="Q";
                            }
                            if ($_SESSION['MON']=="R") {
                                $_SESSION['MON']="P";
                            }
                            if($rowFacturaDia['FACCO4'] != "" )
                            {
                                if (number_format($rowFacturaDia['FACTO2'],2, '.', ',')==0 && 
                                    number_format($rowFacturaDia['FACSU3'],2, '.', ',')==0 && 
                                    number_format($rowFacturaDia['FACIM1'],2, '.', ',')==0 && 
                                    number_format($rowFacturaDia['FACTO3'],2, '.', ',')==0) {
                                    $_SESSION['FACTOT3']='<span class="text-danger"></span>';
                                }else {
                                    $_SESSION['FACTOT3']=$_SESSION['MON'].'.'.number_format($rowFacturaDia['FACTO3'],2, '.', ',');
                                }
                                $diaprev=$diaFicha;
                                if ($rowFacturaDia['FACFE1'] != $fechaAnterior  && $fechaAnterior!=0) { 
                                    print '<tr>';
                                    print   '<td >' .$rowFacturaDia['FACCO4'].'</td>';
                                    print   '<td class=" text-center"></td>';
                                    print   '<td class="text-center"><b></b></td>';
                                    print   '<td class=" text-end"><b></b></td>';
                                    print   '<td class=" text-end"><b></b></td>';
                                    print   '<td class="text-end"><b></b></td>';
                                    print   '<td class=" text-end"><b></b></td>';
                                    print '</tr>';
                                    print '<tr>';
                                    print   '<td class="" >' .$rowFacturaDia['FACCO4'].'</td>';
                                    print   '<td class="text-center"> </td>';
                                    print   '<td class="text-center"><b></b></td>';
                                    print   '<td class=" text-end"><b>'.$_SESSION['MON'].'.'.number_format($descuentoSuma,2, '.', ',').'</b></td>';
                                    print   '<td class=" text-end"><b>'.$_SESSION['MON'].'.'.number_format($valorSuma,2, '.', ',').'</b></td>';
                                    print   '<td class=" text-end"><b>'.$_SESSION['MON'].'.'.number_format($impuestoSuma,2, '.', ',').'</b></td>';
                                    print   '<td class=" text-end"><b>'.$_SESSION['MON'].'.'.number_format($netoSuma,2, '.', ',').'</b></td>';
                                    print '</tr>';
                                    print '<tr>';
                                    print   '<td >' .$rowFacturaDia['FACCO4'].'</td>';
                                    print   '<td class=" text-center"></td>';
                                    print   '<td class="text-center"><b></b></td>';
                                    print   '<td class=" text-end"><b></b></td>';
                                    print   '<td class=" text-end"><b></b></td>';
                                    print   '<td class="text-end"><b></b></td>';
                                    print   '<td class=" text-end"><b></b></td>';
                                    print '</tr>';
                                    $descuentoSuma=0;
                                    $valorSuma=0;
                                    $impuestoSuma=0;
                                    $netoSuma=0; 
                                }
                                print '<tr onclick="location.href=\'/'.$_SESSION['DEV'].'LovablePHP/PRG/ZFA/ZLO0001PRT.php?id='.$rowFacturaDia['FACCO4'].'&fac='.$rowFacturaDia['FACNU3'].'\';">';
                                print   '<td >' .$rowFacturaDia['FACCO4'].'</td>';
                                print   '<td class="text-center">' .$diaFicha.'</td>';
                                print   '<td class="text-center"><b>'.$rowFacturaDia['FACNU3'].'</b></td>';
                                print   '<td class="text-end"><b>' . ($rowFacturaDia['FACTO2']!=0 ? $_SESSION['MON'].'.'.number_format($rowFacturaDia['FACTO2'],2, '.', ','): "").'</b></td>';
                                print   '<td class="text-end"><b>' .($rowFacturaDia['FACSU3']!=0 ? $_SESSION['MON'].'.'.number_format($rowFacturaDia['FACSU3'],2, '.', ','): "").'</b></td>';
                                print   '<td class="text-end"><b>'.(substr($rowFacturaDia['FACIM1'],0,5)!=0 ? $_SESSION['MON'].'.'.number_format($rowFacturaDia['FACIM1'],2, '.', ','): "").'</b></td>';
                                print   '<td class="text-end"><b>' .$_SESSION['FACTOT3'].'</b></td>';
                                print '</tr>';
                                $descuentoTotal+=$rowFacturaDia['FACTO2'];
                                $valorTotal+=$rowFacturaDia['FACSU3'];
                                $impuestoTotal+=$rowFacturaDia['FACIM1'];
                                $netoTotal+=$rowFacturaDia['FACTO3']; 
                                $descuentoSuma+=$rowFacturaDia['FACTO2'];
                                $valorSuma+=$rowFacturaDia['FACSU3'];
                                $impuestoSuma+=$rowFacturaDia['FACIM1'];
                                $netoSuma+=$rowFacturaDia['FACTO3'];   

                                $fechaAnterior = $rowFacturaDia['FACFE1'];
                            }
                        }
                        while($rowFacturaDia = odbc_fetch_array($resultFacturaDia));
                        $_SESSION['MON']= isset($_SESSION['MON']) ?  $_SESSION['MON']: " "; 
                        print '<tr>';
                        print   '<td class="" >9998</td>';
                        print   '<td class=" text-center"></td>';
                        print   '<td class="text-center"><b></b></td>';
                        print   '<td class=" text-end"><b></b></td>';
                        print   '<td class=" text-end"><b></b></td>';
                        print   '<td class="text-end"><b></b></td>';
                        print   '<td class=" text-end"><b></b></td>';
                        print '</tr>';
                        print '<tr>';
                        print   '<td class="" >9999</td>';
                        print   '<td class="text-center">Total:  </td>';
                        print   '<td class="text-center"><b></b></td>';
                        print   '<td class=" text-end"><b>'.$_SESSION['MON'].'.'.number_format($descuentoTotal,2, '.', ',').'</b></td>';
                        print   '<td class=" text-end"><b>'.$_SESSION['MON'].'.'.number_format($valorTotal,2, '.', ',').'</b></td>';
                        print   '<td class=" text-end"><b>'.$_SESSION['MON'].'.'.number_format($impuestoTotal,2, '.', ',').'</b></td>';
                        print   '<td class=" text-end"><b>'.$_SESSION['MON'].'.'.number_format($netoTotal,2, '.', ',').'</b></td>';
                        print '</tr>';
                    }else{
                        //echo "<script>window.location = '/".$_SESSION['DEV']."LovablePHP/404.html'</script>";
                      }
                    
                    ?>
                        </tbody>
                        </table>
                        </div>
                        
                    </div>
                </div>
                <div id="panel2" class="tablist__panel is-hidden" aria-labelledby="tab2" aria-hidden="true" role="tabpanel">
                   <div class="container-fluid">
                   <div class="row">
                        <div class="col-md-9 col-lg-10 col-xl-10 col-xxl-11 col-8 " >
                        <h2 class="fs-4 mb-1 mt-4 text-center">Resumen de ventas por <b>días</b>.</h2>
                        </div>
                        <div class="col-1 ">
                        <a class='btn btn-light mt-2' href="/<?php echo $_SESSION['DEV'] ?>LovablePHP/PRG/ZFA/ZLO0001P.php"><b>Regresar</b></a>
                        </div>
                    </div>
                       
                        <form id="formFiltros2" action="../../php/ZFA/ZLO0001P/logic3.php" method="POST">
                        <div class="row mb-2">
                            <div class="col-sm-12 col-lg-6 mt-2">
                                <label>Compañía:</label>
                                <select class="form-control" id="comppro2" name="comppro2" >
                                    <?php
                                    while ($rowCOMARC = odbc_fetch_array($resultCOMARC2)) {
                                        echo "<option  value='" . $rowCOMARC['COMCOD'] . "'>" . ucfirst(strtolower(rtrim(utf8_encode($rowCOMARC['COMDES'])))) . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-6 mt-2 mb-3">
                                <div class="row">
                                    <div class="col-sm-12 col-lg-6" >
                                    <label>Mes:</label>
                                    <select class="form-control" id="cbbMes" name="cbbMes">
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
                                        <select class="form-control" id="cbbAno" name="cbbAno">
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
                            <div class="col-sm-12 col-lg-6 mb-2">
                                <div class="input-group">
                                <input class="me-2" type="checkbox" value="1" id="productosCk2" name="productosCk2">
                                 <label for="productosCk2"><b>Incluir otros productos</b></label>
                                </div>
                             </div>
                        </div>
                        </form>
                        <hr> 
                        <div class="table-responsive">
                        <table id="myTable2" class="table stripe table-hover mt-4" style="width:100%" >
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center"></th>
                                <th class="text-center">Día</th>
                                <th class="text-end">Tra</th>
                                <th class="text-end">Descuento</th>
                                <th class="text-end">Valor total</th>
                                <th class="text-end">Impuesto</th>
                                <th class="text-end">Neto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $fecha_inicio = '2023-03-01';
                                $fecha_actual = $fecha_inicio;
                                $traTotal=0;
                                $descuentoMes=0;
                                $valorMes=0;
                                $impuestoMes=0;
                                $netoMes=0;
                                if($rowFacturaMes = odbc_fetch_array($resultFacturaMes)){
                        
                                    do{
                                        if (strlen($rowFacturaMes['FACFE1'])==7) {
                                            $fecha_actual= '0'.$rowFacturaMes['FACFE1'];
                                        }else{
                                            $fecha_actual= $rowFacturaMes['FACFE1'];
                                        }
                                        $fecha_actual= substr($fecha_actual,4,4)."-".substr($fecha_actual,2,2)."-".substr($fecha_actual,0,2);
                                        $nombre_dia = obtenerNombreDia($fecha_actual);
                                        if($rowFacturaMes['FACCO4'] != "")
                                        {
                                        $_SESSION['MON2'] =substr($rowFacturaMes['FACTI3'],0,1);
                                        if ($_SESSION['MON2']=="U" && $rowFacturaMes['FACCO4']==1) {
                                            $_SESSION['MON2']="L";
                                        }
                                        if ($_SESSION['MON2']=="U") {
                                            $_SESSION['MON2']="D";
                                        }
                                        if ($_SESSION['MON2']=="G") {
                                            $_SESSION['MON2']="Q";
                                        }
                                        if ($_SESSION['MON2']=="R") {
                                            $_SESSION['MON2']="P";
                                        }
                                            echo "<tr>
                                                        <td class='text-end'>".substr($fecha_actual,8,10)."</td>
                                                        <td class='text-end'>".substr($fecha_actual,8,10)."</td>
                                                        <td class='text-start'><b>$nombre_dia</b></td>
                                                        <td class='text-center'>".$rowFacturaMes['FACTRA']."</td>
                                                        <td class='text-end'><b>".$_SESSION['MON2'].'.'.number_format($rowFacturaMes['FACTO2'],2, '.', ',')."</b></td>
                                                        <td class='text-end'><b>".$_SESSION['MON2'].'.'.number_format($rowFacturaMes['FACSU3'],2, '.', ',')."</b></td>
                                                        <td class='text-end'><b>".$_SESSION['MON2'].'.'.number_format($rowFacturaMes['FACIM1'],2, '.', ',')."</b></td>
                                                        <td class='text-end'><b>".$_SESSION['MON2'].'.'.number_format($rowFacturaMes['FACTO3'],2, '.', ',')."</b></td>
                                                    </tr>";
                                            $traTotal+=$rowFacturaMes['FACTRA'];       
                                            $descuentoMes+=$rowFacturaMes['FACTO2'];
                                            $valorMes+=$rowFacturaMes['FACSU3'];
                                            $impuestoMes+=$rowFacturaMes['FACIM1'];
                                            $netoMes+=$rowFacturaMes['FACTO3'];  
                                        }
                                    }
                                    while($rowFacturaMes = odbc_fetch_array($resultFacturaMes));
                                    $_SESSION['MON2']= isset($_SESSION['MON2']) ?  $_SESSION['MON2']: " "; 
                                    print '<tr>';
                                    print   '<td class="" >9998</td>';
                                    print   '<td class="" ></td>';
                                    print   '<td class="text-start"><b></b></td>';
                                    print   '<td class=" text-center"><b></b></td>';
                                    print   '<td class=" text-end"><b></b></td>';
                                    print   '<td class="text-end"><b></b></td>';
                                    print   '<td class=" text-end"><b></b></td>';
                                    print   '<td class=" text-end"><b></b></td>';
                                    print '</tr>';
                                    print '<tr>';
                                    print   '<td class="" >9999</td>';
                                    print   '<td class="" ></td>';
                                    print   '<td class="text-start">Total:  </td>';
                                    print   '<td class=" text-center"><b>'.$traTotal.'</b></td>';
                                    print   '<td class=" text-end"><b>'.$_SESSION['MON2'].'.'.number_format($descuentoMes,2, '.', ',').'</b></td>';
                                    print   '<td class=" text-end"><b>'.$_SESSION['MON2'].'.'.number_format($valorMes,2, '.', ',').'</b></td>';
                                    print   '<td class=" text-end"><b>'.$_SESSION['MON2'].'.'.number_format($impuestoMes,2, '.', ',').'</b></td>';
                                    print   '<td class="text-end"><b>'.$_SESSION['MON2'].'.'.number_format($netoMes,2, '.', ',').'</b></td>';
                                    print '</tr>';
                    
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
            <div class="card-footer">
          
            </div>
        </div>
    </div>
    <div class="footer bg-blck flex-grow-1 d-flex justify-content-center">
      <p class="bggray responsive-font-example"><i>Lovable de Honduras S.A. de C.V</i></p>
    </div>
    <script>

             $( document ).ready(function() {
                $('#productosCk1').prop('checked', <?php echo  $ckProductos1 ?>);
                $('#productosCk2').prop('checked', <?php echo  $ckProductos2 ?>);
                if (<?php echo isset($_SESSION['SelectionTab']) ? $_SESSION['SelectionTab'] : "false"; ?> == true) {
                    var tabs = $('.tablist__tab'),
                                tabPanels = $('.tablist__panel');
                            var thisTab = $("#tab2"),
                                    thisTabPanelId = thisTab.attr('aria-controls'),
                                    thisTabPanel = $('#panel2');
                    tabs.attr('aria-selected', 'false').removeClass('is-active');
                    thisTab.attr('aria-selected', 'true').addClass('is-active');
                    tabPanels.attr('aria-hidden', 'true').addClass('is-hidden');
                    thisTabPanel.attr('aria-hidden', 'false').removeClass('is-hidden');
                }else{
                    $("#tab1, #tab2").attr('aria-selected', 'false').removeClass('is-active');
                    $("#tab1").attr('aria-selected', 'true').addClass('is-active');
                }

                <?php
              $fechafiltro = isset($_SESSION['FechaFiltro2']) ? $_SESSION['FechaFiltro2'] : "";
              $compfiltro = isset($_SESSION['comppro2']) && !empty($_SESSION['comppro2']) ? $_SESSION['comppro2'] : 0;
              $mesficha= ($mes!=0)? $mes : $_SESSION['mesanterior'];
              $anioficha= ($anio!=0)? $anio : $_SESSION['anioanterior'];
                ?>
            var fechafiltro = "<?php echo $_SESSION['FechaFiltro2'] ?>";
            var compfiltro = "<?php echo $compfiltro ?>";
            $("#fechapro, #fechapro2").val(formatoFecha(fechafiltro));
            $("#comppro1, #comppro2").val(compfiltro);
            $("#cbbMes").val("<?php echo $mesficha; ?>"); 
            $("#cbbAno").val(<?php echo $anioficha;  ?>); 
              
           });

           $("#fechapro, #comppro1, #productosCk1").change(function() {
              $("#formFiltros").submit();
            });

           $("#cbbMes, #cbbAno,#comppro2, #productosCk2").change(function() {
              $("#formFiltros2").submit();
            });
                    function formatoFecha(fecha) {
                        let year = fecha.substring(0, 4);
                        let month = fecha.substring(4, 6);
                        let day = fecha.substring(6, 8);
                        return year + "-" + month + "-" + day;
                        }
           
                        $(function() {
  
                            // Cache selectors
                            var tabs = $('.tablist__tab'),
                                tabPanels = $('.tablist__panel');

                            
                            tabs.on('click', function() {
                            
                                // Cache selectors
                                var thisTab = $(this),
                                    thisTabPanelId = thisTab.attr('aria-controls'),
                                    thisTabPanel = $('#' + thisTabPanelId);

                                // De-select all the tabs
                                tabs.attr('aria-selected', 'false').removeClass('is-active');

                                // Select this tab
                                thisTab.attr('aria-selected', 'true').addClass('is-active');

                                // Hide all the tab panels
                                tabPanels.attr('aria-hidden', 'true').addClass('is-hidden');

                                // Show this tab panel
                                thisTabPanel.attr('aria-hidden', 'false').removeClass('is-hidden');

                            });
                            
                            // Add enter key to the basic click event
                            tabs.on('keydown', function(e) {
                                
                                var thisTab = $(this);
                                
                                if(e.which == 13) {
                                thisTab.click();
                                }
                                
                            });
                            
                            });
    </script>
</body>

</html>