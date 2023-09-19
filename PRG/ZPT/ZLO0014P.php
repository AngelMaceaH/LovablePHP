<!DOCTYPE html>
<html lang="es">
  <head>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.6/ladda-themeless.min.css" integrity="sha512-EOY99TUZ7AClCNvbnvrhtMXDuWzxUBXV7SFovruHvYf2dbvRB5ya+jgDPk5bOyTtZDbqFH3PTuTWl/D7+7MGsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.0/spin.min.js" integrity="sha512-fgSmjQtBho/dzDJ+79r/yKH01H/35//QPPvA2LR8hnBTA5bTODFncYfSRuMal78C08vUa93q3jyxPa273cWzqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.0/ladda.min.js" integrity="sha512-hZL8cWjOAFfWZza/p0uD0juwMeIuyLhAd5QDodiK4sBp1sG7BIeE1TbMGIbnUcUgwm3lVSWJzBK6KxqYTiDGkg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
  <?php
      include '../layout-prg.php';
      include '../../assets/php/ZPT/ZLO0014P/header.php';
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
              <li class="breadcrumb-item active"><span>ZLO0014P</span></li>
            </ol>
          </nav>
        </div>
      </header>
      <div id="body-div" class="body flex-grow-1">
        <div class="card mb-5">
            <div class="card-header">
              <h1 class="fs-4 mb-1 mt-2 text-center">Análisis de rotación de inventario</h1>
            </div>
          <div class="card-body">
          <div class="position-relative">
              <form id="formFiltros" action="../../assets/php/ZPT/ZLO0014P/filtrosLogica.php" method="POST">
                <div class="row mb-2">
                      <div class="col-sm-12 col-md-12 mt-2">
                        <label>Visualizar por:</label>
                        <select class="form-select  mt-1" id="cbbAgrupacion" name="cbbAgrupacion">
                      
                        </select>
                      </div>
                </div>
              </form>
              </div>
              <hr>
              <div class="table-container mt-3" style="width:100%;">
                          <table id="myTableSeguimiento" class="table stripe table-hover " style="width:100%">
                            <thead>
                            <tr >
                                <th colspan="20" id="thProcessing" style="height:100px;"></th>
                            </tr>
                                <tr class="sticky-top bg-white">
                                    <th  class="responsive-font-example text-start text-black">Marca</th>
                                    <th  class="responsive-font-example text-end text-black">Estilo</th>
                                    <th  class="responsive-font-example text-end text-black">Color</th>
                                    <th  class="responsive-font-example text-end text-black">Talla</th>
                                    <th  class="responsive-font-example text-end text-black">Tipo Invent.</th>
                                    <th  class="responsive-font-example text-end text-black">Unidades Vtas 12 Meses</th>
                                    <th  class="responsive-font-example text-end text-black">Promedio Mensual 12 Meses</th>
                                    <th  class="responsive-font-example text-end text-black"># Meses 12 Meses</th>
                                    <th  class="responsive-font-example text-end text-black">Existencia Actual</th>
                                    <th  class="responsive-font-example text-end text-black">Rotación Inventario</th>
                                    <th  class="responsive-font-example text-end text-black">Meses Inventario 12 Meses</th>
                                    <th  class="responsive-font-example text-end text-black">% Descuento</th>
                                    <th  class="responsive-font-example text-end text-black">Fecha Ingreso</th>
                                    <th  class="responsive-font-example text-end text-black">Fecha Ult. Ing. Bod</th>
                                    <th  class="responsive-font-example text-end text-black">Fecha Ult. Compra</th>
                                    <th  class="responsive-font-example text-end text-black">Fecha Ult. Venta</th>
                                    <th  class="responsive-font-example text-end text-black">Días Antiguedad</th>
                                    <th  class="responsive-font-example text-end text-black">Días Ant. Ult. Compra</th>
                                    <th  class="responsive-font-example text-start text-black">Marca</th>
                                    <th  class="responsive-font-example text-start text-black">Genero</th>
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
        "pageLength": 50,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "http://172.16.15.20/API.LOVABLEPHP/ZLO0014P/ListS/?agrup="+agrupSelect,
                    "type": "POST",
                    "complete": function (xhr) {
                      $("#thProcessing").addClass('d-none');
                        },
                        error: function (xhr, status, error) {
                            console.log(error);
                            requestError = true;
                        }
                },
                "columns": [
                    { "data": "MARCA"},
                    { "data": "ESTILO" },
                    { "data": "COLOR" },
                    { "data": "TALLA" },
                    { "data": "TIPINV" },
                    { "data": "UNIVEN", className: "text-primary",
                        render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                    { "data": "PROMEN", className: "text-lila",
                        render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                    { "data": "NUMM12", className: "text-primary", },
                    { "data": "EXIACT", className: "text-green",
                        render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                    { "data": "ROTINV", className: "text-success",  },
                    { "data": "MESINV", className: "text-brown", 
                        render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                    { "data": "PORDES",
                        render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                    { "data": "FECING",
                      render: function (data, type, row) {
                        if (data!="") {
                          const fechaOriginal = data;
                        const year = fechaOriginal.slice(0, 4);
                        const month = fechaOriginal.slice(4, 6);
                        const day = fechaOriginal.slice(6, 8);
                        const fechaConvertida = `${day}/${month}/${year}`;
                        return fechaConvertida;
                        }else{
                          return " ";
                        }
            } },
            { "data": "FECULT",
                      render: function (data, type, row) {
                        if (data!="") {
                          const fechaOriginal = data;
                        const year = fechaOriginal.slice(0, 4);
                        const month = fechaOriginal.slice(4, 6);
                        const day = fechaOriginal.slice(6, 8);
                        const fechaConvertida = `${day}/${month}/${year}`;
                        return fechaConvertida;
                        }else{
                          return " ";
                        }
            } },
                    { "data": "FECCOM", className: "text-success",
                      render: function (data, type, row) {
                        if (data!="") {
                          const fechaOriginal = data;
                        const year = fechaOriginal.slice(0, 4);
                        const month = fechaOriginal.slice(4, 6);
                        const day = fechaOriginal.slice(6, 8);
                        const fechaConvertida = `${day}/${month}/${year}`;
                        return fechaConvertida;
                        }else{
                          return " ";
                        }
            } },
                    { "data": "FECVEN",
                      render: function (data, type, row) {
                        if (data!="") {
                          const fechaOriginal = data;
                        const year = fechaOriginal.slice(0, 4);
                        const month = fechaOriginal.slice(4, 6);
                        const day = fechaOriginal.slice(6, 8);
                        const fechaConvertida = `${day}/${month}/${year}`;
                        return fechaConvertida;
                        }else{
                          return " ";
                        }
              
            } },
                    { "data": "DIAANT"},
                    { "data": "DIAANC"},
                    { "data": "DESDES", className: "text-darkblue", },
                    { "data": "ARCD07", className: "text-darkblue", },
                ],
                ordering: false,
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
                      var urlExcel = "http://172.16.15.20/API.LOVABLEPHP/ZLO0014P/ExportAll/?agrup="+agrupSelect+"&title="+($("#cbbAgrupacion option:selected").text()).toUpperCase()+"";
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
