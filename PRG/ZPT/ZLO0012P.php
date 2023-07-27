<!DOCTYPE html>
<html lang="es">
  <head>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.6/ladda-themeless.min.css" integrity="sha512-EOY99TUZ7AClCNvbnvrhtMXDuWzxUBXV7SFovruHvYf2dbvRB5ya+jgDPk5bOyTtZDbqFH3PTuTWl/D7+7MGsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.0/spin.min.js" integrity="sha512-fgSmjQtBho/dzDJ+79r/yKH01H/35//QPPvA2LR8hnBTA5bTODFncYfSRuMal78C08vUa93q3jyxPa273cWzqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.0/ladda.min.js" integrity="sha512-hZL8cWjOAFfWZza/p0uD0juwMeIuyLhAd5QDodiK4sBp1sG7BIeE1TbMGIbnUcUgwm3lVSWJzBK6KxqYTiDGkg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <style>
    .table th {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    } 
  </style>
</head>
<body>
  <div class="spinner-wrapper">
    <span class="loader"></span>
  </div> 
  <?php
      include '../layout-prg.php';
      $agrup=isset($_SESSION['agrup'])? $_SESSION['agrup']:'1';
      $ckProductos1 = isset($_SESSION['productosCk1']) ? $_SESSION['productosCk1'] : "0";
      $filtro=isset($_SESSION['filtro'])? $_SESSION['filtro']:'1';
    ?> 
     <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
              <span>Producto Terminado / Clasificación de producto</span>
              </li>
              <li class="breadcrumb-item active"><span>ZLO0012P</span></li>
            </ol>
          </nav>
        </div>
      </header>
      <div id="body-div" class="body flex-grow-1">
        <div class="card mb-5">
            <div class="card-header">
              <h1 class="fs-4 mb-1 mt-2 text-center">Análisis de movimiento de inventario</h1>
            </div>
          <div class="card-body">
          <div class="position-relative">
              <form id="formFiltros" action="../../assets/php/ZPT/ZLO0012P/filtrosLogica.php" method="POST">
                <div class="row mb-2">
                      <div class="col-sm-12 col-md-6 mt-2">
                        <label>Visualizar por:</label>
                        <select class="form-select  mt-1" id="cbbAgrupacion" name="cbbAgrupacion">
                      
                        </select>
                      </div>
                      <div class="col-sm-12 col-md-6 mt-2">
                      <label>Filtrar por:</label>
                        <div class="row">
                          <div class="col-6">
                          <div class="form-check">
                          <input class="form-check-input" value="1" type="radio" name="radioFiltro" id="check1" checked>
                          <label class="form-check-label fs-6" for="check1">
                            Inventario General
                          </label>
                        </div>
                         
                          </div>
                          <div class="col-6">
                          <div class="form-check">
                            <input class="form-check-input" value="3" type="radio" name="radioFiltro" id="check3">
                            <label class="form-check-label fs-6" for="check3">
                              Inventario Descontinuado
                            </label>
                          </div>
                          </div>
                          <div class="col-6">
                          <div class="form-check">
                            <input class="form-check-input" value="2" type="radio" name="radioFiltro" id="check2">
                            <label class="form-check-label fs-6" for="check2">
                             Inventario en Linea
                            </label>
                          </div>
                          </div>
                          <div class="col-6">
                          <div class="form-check">
                            <input class="form-check-input" value="4" type="radio" name="radioFiltro" id="check4">
                            <label class="form-check-label fs-6" for="check4">
                             Inventario Obsoleto
                            </label>
                          </div>
                          </div>
                        </div>
                      </div>
                      <div>
                     <!-- <div class="col-sm-12 col-md-6 mt-3">
                                <input class="me-2" type="checkbox" value="1" id="productosCk1" name="productosCk1">
                                <label class="form-check-label fs-5" for="productosCk1">
                                Mostrar todos los productos
                                </label>
                      </div>-->
                </div>
              </form>
              </div>
              <hr>
              <!--<button class="btn btn-success text-light fs-6 mb-2 ladda-button" data-style="expand-left">
                <i class="fa-solid fa-file-excel"></i> <b >Enviar a Excel</span></b>
              </button>-->
              <div class="table-responsive mt-3" style="width:100%">
                          <table id="myTableSeguimiento" class="table stripe table-hover " style="width:100%">
                            <thead>
                                <tr>
                                    <th  class="responsive-font-example text-start">Estilo</th>
                                    <th  class="responsive-font-example text-end">Und. Vtas. Totales</th>
                                    <th  class="responsive-font-example text-end">Und. Vtas. Mes Proceso</th>
                                    <th  class="responsive-font-example text-end">Und. Vtas. Ult. 12 Meses</th>
                                    <th  class="responsive-font-example text-end">Prom. Mensual</th>
                                    <th  class="responsive-font-example text-end">Existencia Actual</th>
                                    <th  class="responsive-font-example text-end">Rot. Inv</th>
                                    <th  class="responsive-font-example text-end">Meses Inventario</th>
                                    <th  class="responsive-font-example text-end">% Descuento</th>
                                    <th  class="responsive-font-example text-end">Fecha Ingreso</th>
                                    <th  class="responsive-font-example text-end">Fecha Ult/Compra</th>
                                    <th  class="responsive-font-example text-end">Fecha Ult/Venta</th>
                                    <th  class="responsive-font-example text-end">Días antigüedad </th>
                                    <th  class="responsive-font-example text-end">Días Ant. Ult/Compra</th>
                                    <th  class="responsive-font-example text-end">Días Ant. Ult/Venta</th>
                                    <th  class="responsive-font-example text-end">Tipo Inventario</th>
                                    <th  class="responsive-font-example text-start">Marca</th>
                                    <th  class="responsive-font-example text-start">Genero</th>
                                    
                                </tr>
                            </thead>
                            <tbody id="myTableSeguimientoBody">
                              
                              </tbody>
                          </table>
                      </div>
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
      <script>
        var agrupSelect="";
        var filtroP="";
        $( document ).ready(function() {
          var urlAgrupaciones="http://172.16.15.20/API.LOVABLEPHP/ZLO0012P/ListAgrupacion/";
          var responseAgrupaciones=ajaxRequest(urlAgrupaciones);
          if (responseAgrupaciones.code==200) {
            var options="";
            for (let i = 0; i < responseAgrupaciones.data.length; i++) {
              options+="<option value='"+responseAgrupaciones.data[i]['CODIGO']+"'>"+responseAgrupaciones.data[i]['DESCRI']+"</option>";
            }
            $("#cbbAgrupacion").append(options);
          }
          agrupSelect='<?php echo $agrup; ?>';
          $("#cbbAgrupacion").val(agrupSelect);
         
          $("#cbbAgrupacion").on("change",function() {
            $("#formFiltros").submit();
          });
            var productosCk1=<?php echo $ckProductos1;  ?>;
           $('#productosCk1').prop('checked', <?php echo  $ckProductos1 ?>);

            $("#productosCk1").change(function() {
              $("#formFiltros").submit();
            });
            var cond="";
            if (productosCk1==true) {
              cond="1";
            }else{
              cond="0";
            }
            filtroP='<?php echo $filtro; ?>';
            $("#check4, #check3, #check2, #check1").on("change",function() {
              $("#formFiltros").submit();
            });
            $("input[name=radioFiltro][value=" + filtroP + "]").prop('checked', true);
          
         var table= $('#myTableSeguimiento').DataTable({
            language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },
        "pageLength": 15,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "http://172.16.15.20/API.LOVABLEPHP/ZLO0012P/List3/?agrup="+agrupSelect+"&cond=1&filtro="+filtroP+"",
                    "type": "POST"
                },
                "columns": [
                    { "data": "ESTILO"},
                    { "data": "TTOT" },
                    { "data": "MESTOT" },
                    { "data": "UNIVEN" },
                    { "data": "PROMEN" },
                    { "data": "EXIACT" },
                    { "data": "ROTINV" },
                    { "data": "MESINV" },
                    { "data": "PORDES" },
                    { "data": "FECING" },
                    { "data": "FECCOM" },
                    { "data": "FECVEN" },
                    { "data": "DIAANT" },
                    { "data": "DIAANC" },
                    { "data": "DIAANV" },
                    { "data": "TIPINV" },
                    { "data": "MARCA" },
                    { "data": "GENERO" }
                ],
                ordering: true,
                dom: 'Bfrtip',
                buttons: [
                  {
                    text: '<i class="fa-solid fa-file-excel me-1"></i><b>Excel</b>',
                    className: "btn btn-success text-light fs-6 mb-2 ladda-button",
                    action: function ( e, dt, node, config ) {
                    
                    }
                  }
                ]

            });
            table.on('draw.dt', function() {
                  $('.ladda-button').each(function() {
                    var l = Ladda.create(this);
                    $(this).on('click', function() {
                      l.start();
                      var urlExcel = "http://172.16.15.20/API.LOVABLEPHP/ZLO0012P/ExportAll/?agrup="+agrupSelect+"&cond=1&filtro="+filtroP+"";
                     window.location.href = urlExcel;
                      var xhr = new XMLHttpRequest();
                      xhr.open('HEAD', urlExcel);
                      xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                          if (xhr.status === 200) {
                            var procesosTerminados = xhr.getResponseHeader('X-Procesos-Terminados');
                            if (procesosTerminados) {
                              //console.log('Los procesos en segundo plano han terminado.');
                            } else {
                              //console.log('Los procesos en segundo plano están en progreso.');
                            }
                          } else {
                            //console.log('Ocurrió un error al obtener el encabezado.');
                          }
                          l.stop();
                        }
                      };
                      xhr.send();
                    });
                  });
                });
        });
       
      </script>
</body>
</html>
