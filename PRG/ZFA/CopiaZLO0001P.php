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
              <li class="breadcrumb-item active"><span>ZLO0001P</span></li>
            </ol>
          </nav>
        </div>
      </header>
      <div id="body-div" class="body flex-grow-1">
        <div class="card mb-5">
          <div class="card-header">
          <h1 class="fs-4 mb-1 mt-2 text-center">Consulta de ventas resumidas por compañia.</h1>
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
              <div class="btn-group mt-2 d-flex" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                <label class="btn btn-outline-light" for="btnradio1">Unidades</label>

                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                <label class="btn btn-outline-light" for="btnradio2">Transacciones</label>

                <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                <label class="btn btn-outline-light" for="btnradio3">Valores Dolarizados</label>

                <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off">
                <label class="btn btn-outline-light" for="btnradio4"><b>Moneda Nacional</b></label>
              </div>
          </div>
          </form>
          <hr>   

             
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
        </div>
        
      </div>
      
    </div>
      <div class="footer bg-blck flex-grow-1 d-flex justify-content-center">
      <p class="bggray responsive-font-example"><i>Lovable de Honduras S.A. de C.V</i></p>
      </div>
      <script>
      //sessionStorage.setItem('visited_page', 'true');
      
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
