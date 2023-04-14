<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
</head>
<body>
<?php
      include '../layout-prg.php';
      include 'ZLO0001Psql.php';
    ?> 
     <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
              <span>Modulo de facturacion</span>
              </li>
              <li class="breadcrumb-item active"><span>VLO0119P</span></li>
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
            <form id="formFiltros" action="../../php/ZFA/ZLO0001P/logic.php" method="POST">
          <div class="row mb-2">
              <div class="col-sm-12 col-lg-6 mt-2">
                <label>Compañía:</label>
                <select class="form-control" id="comppro" name="comppro" >
                    <option value="0" selected>Todas las compañías</option>
                    <?php
                    while ($rowCOMARC = odbc_fetch_array($resultCOMARC)) {
                      echo "<option value='" . $rowCOMARC['COMCOD'] . "'>" . ucfirst(strtolower(rtrim(utf8_encode($rowCOMARC['COMDES'])))) . "</option>";
                     }
                    ?>
                  </select>
              </div>
              <div class="col-sm-12 col-lg-6 mt-2">
              <label>Fecha:</label>
               <input type="date" class="form-control" name="fechapro" id="fechapro" data-date-format="dd/mm/yyyy" onfocus="(this.type='date')" onkeydown="return false;">
              </div>
              <div class="btn-group mt-3 d-flex justify-content-center justify-content-md-start" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check " name="btnradio" id="btnradio1" autocomplete="off">
                <label class="btn btn-outline-secondary responsive-font-example pt-3 pb-3" for="btnradio1"><b>Unidades</b></label>

                <input type="radio" class="btn-check" name="btnradio" autocomplete="off" id="btnradio2">
                <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3" for="btnradio2" id="btnnradio2"><b>Transacciones</b></label>

                <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3" for="btnradio3"><b>Valores Dolarizados</b></label>

                <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off" checked>
                <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3" for="btnradio4"><b>Moneda Nacional</b></label>
            </div>

          </div>
          </form>
          <hr>   
          <div class="demo">
                <ul class="tablist" role="tablist">
                    <li id="tab1" class="tablist__tab text-center p-3 is-active" aria-controls="panel1" aria-selected="true" role="tab" tabindex="0">Dia y Mes</li>
                    <li id="tab2" class="tablist__tab text-center p-3 " aria-controls="panel2" aria-selected="false" role="tab" tabindex="0">Anual</li>
                    <li id="tab3" class="tablist__tab text-center p-3 " aria-controls="panel3" aria-selected="false" role="tab" tabindex="0">Promedios</li>
                </ul>
                <div id="panel1" class="tablist__panel p-2" aria-labelledby="tab1" aria-hidden="false" role="tabpanel">
                  <div class="position-relative">
                    <table id="myTable" class="table stripe table-hover mt-2" style="width:100%" >
                        <thead>
                            <tr>
                                <th class="text-center"></th>
                                <th class="text-center">ID</th>
                                <th class="text-start">Punto de venta</th>
                                <th class="text-end">Ventas dia</th>
                                <th class="text-end">Ventas mes</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        
                              if($row_zlo0001p = odbc_fetch_array($result_zlo0001p)){
                                  
                                  do{
                                    $compañia = rtrim(utf8_encode($row_zlo0001p['COMDES']));
                                    $mon = rtrim(utf8_encode($row_zlo0001p['MON']));
                                    $subdia = $mon.'.'.number_format(rtrim(utf8_encode($row_zlo0001p['SUBDIA'])),2, '.', ',');
                                    $submes = $mon.'.'.number_format(rtrim(utf8_encode($row_zlo0001p['SUBMES'])),2, '.', ',');
                                  
                                  
                                      if($row_zlo0001p['ID'] != "")
                                      {
                                          print '<tr  onclick="location.href=\'/LovablePHP/PRG/ZFA/ZLO0001PA.php?id='.$row_zlo0001p['ID'].'&dat='.$_SESSION['FechaFiltro'].'\';">';
                                          print   '<td class="responsive-font-example" ><b>' .$row_zlo0001p['CODSEC'].'</b></td>';
                                          print   '<td class="responsive-font-example" ><b>' .$row_zlo0001p['ID'].'</b></td>';
                                          print   '<td class="responsive-font-example"><b>' .$compañia.'</b></td>';
                                          print   '<td class="responsive-font-example text-darkblue text-end"><b>'.$subdia.'</b></td>';
                                          print   '<td class="responsive-font-example text-pink text-end"><b>' .$submes.'</b></td>';
                                          print '</tr>';
                                          
                                      }
                                  }
                                  while($row_zlo0001p = odbc_fetch_array($result_zlo0001p));
                              
                              }else{
                                echo "<script>window.location = '/LovablePHP/404.html'</script>";
                              }
                              
                          ?>
                        </tbody>
                        </table>
                      </div>
                    </div>
                 
              
               <div id="panel2" class="tablist__panel is-hidden p-2" aria-labelledby="tab2" aria-hidden="true" role="tabpanel">
                  <div class="position-relative">
                  <div class="table-responsive">
                    <table id="myTableAnual" class="table stripe table-hover mt-2" style="width:100%" >
                        <thead>
                            <tr>
                                <th class="text-center responsive-font-example"></th>
                                <th class="text-center responsive-font-example">ID</th>
                                <th class="text-start responsive-font-example">Punto de venta</th>
                                <th class="text-end responsive-font-example">Venta Anual</th>
                                <th class="text-end responsive-font-example">Venta Año Comparación</th>
                                <th class="text-end responsive-font-example">Variación</th>
                                <th class="text-end responsive-font-example">%Crecimiento</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        
                        if($row_compAnual = odbc_fetch_array($result_compAnual)){
                            
                            do{
                              $compañiaAnual = rtrim(utf8_encode($row_compAnual['COMDES']));
                              $monAnual = rtrim(utf8_encode($row_compAnual['MON']));
                              $ano1 = $monAnual.'.'.number_format(rtrim(utf8_encode($row_compAnual['ANO1'])),2, '.', ',');
                              $ano2 = $monAnual.'.'.number_format(rtrim(utf8_encode($row_compAnual['ANO2'])),2, '.', ',');
                              $varia = $monAnual.'.'.number_format(rtrim(utf8_encode($row_compAnual['VARIA'])),2, '.', ',');
                              $crecimiento =0;
                              if ($row_compAnual['ANO1']!=0 && $row_compAnual['ANO2']!=0) {
                                $crecimiento = round((($row_compAnual['ANO1']/$row_compAnual['ANO2'])-1)*100);
                              }
                             
                            
                                if($row_compAnual['ID'] != "")
                                {
                                    print '<tr  onclick="location.href=\'/LovablePHP/PRG/ZFA/ZLO0001PA.php?id='.$row_compAnual['ID'].'&dat='.$_SESSION['FechaFiltro'].'\';">';
                                    print   '<td class="responsive-font-example" ><b>' .$row_compAnual['CODSEC'].'</b></td>';
                                    print   '<td class="responsive-font-example" ><b>' .$row_compAnual['ID'].'</b></td>';
                                    print   '<td class="responsive-font-example"><b>' .$compañiaAnual.'</b></td>';
                                    print   '<td class="responsive-font-example text-end"><b>'.$ano1.'</b></td>';
                                    print   '<td class="responsive-font-example text-end"><b>' .$ano2.'</b></td>';
                                    print   '<td class="responsive-font-example text-end"><b>' .$varia.'</b></td>';
                                    print   '<td class="responsive-font-example text-end"><b>'.$crecimiento.'</b></td>';
                                    print '</tr>';
                                    
                                }
                            }
                            while($row_compAnual = odbc_fetch_array($result_compAnual));
                        
                        }else{
                          echo "<script>window.location = '/LovablePHP/404.html'</script>";
                        }
                        
                    ?>
                        </tbody>
                        </table>
                            </div>
                      </div>
                    </div>
                    <div id="panel3" class="tablist__panel is-hidden p-2" aria-labelledby="tab3" aria-hidden="true" role="tabpanel">
                    <div class="position-relative">
                    <table id="myTableTransacciones" class="table stripe table-hover mt-2" style="width:100%" >
                        <thead>
                            <tr>
                                <th class="text-center responsive-font-example"></th>
                                <th class="text-center responsive-font-example">ID</th>
                                <th class="text-start responsive-font-example">Punto de venta</th>
                                <th class="text-end responsive-font-example">Trans. Mes</th>
                                <th class="text-end responsive-font-example">Trans. Año</th>
                                <th class="text-end responsive-font-example">Trans. Año Comparación</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        
                       
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
                $("#tab3").click(function () {
                    $("#btnradio2").addClass("d-none");
                    $("#btnnradio2").addClass("d-none");
                });
                $("#tab1, #tab2").click(function () {
                    $("#btnradio2").removeClass("d-none");
                    $("#btnnradio2").removeClass("d-none");
                });
           $( document ).ready(function() {
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
    </script>
  
</body>
<div class="spinner-wrapper">
          <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div> 
</html>
