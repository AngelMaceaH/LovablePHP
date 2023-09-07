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
  <div class="spinner-wrapper">
    <span class="loader"></span>
  </div> 
  <?php
      include '../layout-prg.php';
      include '../../assets/php/ZPT/ZLO0012P/header.php';
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
              <div class="table-container mt-3" style="width:100%;">
                          <table id="myTableSeguimiento" class="table stripe table-hover " style="width:100%">
                            <thead>
                            <tr >
                                <th colspan="20" id="thProcessing" style="height:100px;"></th>
                            </tr>
                            <tr class="sticky-top bg-white">
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
        "pageLength": 20,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "http://172.16.15.20/API.LOVABLEPHP/ZLO0012P/List3/?agrup="+agrupSelect+"&cond=1&filtro="+filtroP+"",
                    "type": "POST",
                    "complete": function (xhr) {
                      $("#thProcessing").addClass('d-none');
                        //console.log(xhr.responseJSON);
                        var registrosMismoEstilo = [];
                        var table = $('#myTableSeguimiento').DataTable();
                            table.rows().every(function (rowIdx, tableLoop, rowLoop) {
                                var data = this.data();
                                var rowNode = this.node();
                                if (rowIdx < table.rows().count() - 1){
                                  $(rowNode).addClass('clickable-row');
                                  $(rowNode).attr('data-estilo', data.ESTILO);
                                  registrosMismoEstilo.push(data);
                                }
                            });
                        $('#myTableSeguimiento').on('click', '.clickable-row', function () {
                                var estiloValue = $(this).data('estilo'); 
                                var registrosFiltrados = registrosMismoEstilo.filter(function (registro) {
                                    if (registro.ESTILO == estiloValue) {
                                        return  registro ;
                                    }
                                });       
                                openModalDetalles(estiloValue);
                            });
                        },
                        error: function (xhr, status, error) {
                            console.log(error);
                            requestError = true;
                        }
                },
                "columns": [
                    { "data": "ESTILO" ,className:"text-start"},
                    { "data": "TTOT"   ,className:"text-end"},
                    { "data": "MESTOT" ,className:"text-end"},
                    { "data": "UNIVEN" ,className:"text-end", render: function(data) {
                            var valor=parseFloat(data);
                            if (isNaN(valor)) {valor='';}                       
        return  valor.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }},
                    { "data": "PROMEN" ,className:"text-end", render: function(data) {
                            var valor=parseFloat(data);
                            if (isNaN(valor)) {valor='';}                       
        return  valor.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }},
                    { "data": "EXIACT" ,className:"text-end", render: function(data) {
                            var valor=parseFloat(data);
                            if (isNaN(valor)) {valor='';}                       
        return  valor.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }},
                    { "data": "ROTINV" ,className:"text-end", render: function(data) {
                            var valor=parseFloat(data);
                            if (isNaN(valor)) {valor='';}                       
        return  valor.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }},
                    { "data": "MESINV" ,className:"text-end", render: function(data) {
                            var valor=parseFloat(data);
                            if (isNaN(valor)) {valor='';}                       
        return  valor.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }},
                    { "data": "PORDES" ,className:"text-end"},
                    { "data": "FECING",
                      render: function (data, type, row) {
              const fechaOriginal = data;
             if (fechaOriginal=="") {
               return ""; 
             }else{
              const year = fechaOriginal.slice(0, 4);
              const month = fechaOriginal.slice(4, 6);
              const day = fechaOriginal.slice(6, 8);
              const fechaConvertida = `${day}/${month}/${year}`;
              return fechaConvertida;
             }
            } ,className:"text-end"},
                    { "data": "FECCOM",
                      render: function (data, type, row) {
              const fechaOriginal = data;
              if (fechaOriginal=="") {
               return ""; 
             }else{
              const year = fechaOriginal.slice(0, 4);
              const month = fechaOriginal.slice(4, 6);
              const day = fechaOriginal.slice(6, 8);
              const fechaConvertida = `${day}/${month}/${year}`;
              return fechaConvertida;
             }
            } ,className:"text-end"},
                    { "data": "FECVEN",
                      render: function (data, type, row) {
              const fechaOriginal = data;
              if (fechaOriginal=="") {
               return ""; 
             }else{
              const year = fechaOriginal.slice(0, 4);
              const month = fechaOriginal.slice(4, 6);
              const day = fechaOriginal.slice(6, 8);
              const fechaConvertida = `${day}/${month}/${year}`;
              return fechaConvertida;
             }
            } ,className:"text-end"},
                    { "data": "DIAANT" ,className:"text-end"},
                    { "data": "DIAANC" ,className:"text-end"},
                    { "data": "DIAANV" ,className:"text-end"},
                    { "data": "TIPINV" ,className:"text-end"},
                    { "data": "MARCA"  ,className:"text-start"},
                    { "data": "GENERO" ,className:"text-start"}
                ],
                ordering: true,
                dom: 'Bfrtip',
                buttons: [
                  {
                    text: '<i class="fa-solid fa-file-excel me-1"></i><b>Enviar a Excel</b>',
                    className: "btn btn-success text-light fs-6 mb-2 ladda-button",
                    action: function ( e, dt, node, config ) {
                    
                    }
                  }
                ]

            });
            $("#myTableSeguimiento").append('<caption style="caption-side: top" class="fw-bold text-black"><label class="ms-2 fw-bold">**Presione clic para ver detalles por estilo color y talla**</label></caption>'); 

            table.on('draw.dt', function() {
                  $('.ladda-button').each(function() {
                    var l = Ladda.create(this);
                    $(this).on('click', function() {
                      l.start();
                      var urlExcel = "http://172.16.15.20/API.LOVABLEPHP/ZLO0012P/ExportAll/?agrup="+agrupSelect+"&cond=1&filtro="+filtroP+"&title="+($("#cbbAgrupacion option:selected").text()).toUpperCase()+"";
                     window.location.href = urlExcel;
                      var xhr = new XMLHttpRequest();
                      xhr.open('HEAD', urlExcel);
                      xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                          if (xhr.status === 200) {
                            var procesosTerminados = xhr.getResponseHeader('X-Procesos-Terminados');
                            if (procesosTerminados) {
                            } else {
                              l.stop();
                            }
                          } else {
                          }
                        }
                      };
                      xhr.send();
                    });
                  });
                });
        });
        function openModalDetalles(estilo){ 
          var agrup=$("#cbbAgrupacion").val();
          var urlDeta="http://172.16.15.20/API.LOVABLEPHP/ZLO0012P/GetDeta/?agrup="+agrup+"&estilo="+estilo+"";
          var responseDeta=ajaxRequest(urlDeta);
          if (responseDeta.code==200) {
            var tableDetalles= $('#myTableDetallesBody');
                tableDetalles.empty();
                var options="";
                for (let i = 0; i < responseDeta.data.length; i++) {
                  if (responseDeta.data[i]['ISTOT']=='TOTAL') {
                    options+="<tr class='total-row'>";
                  }else{
                    options+="<tr>";
                  }
                  options+="<td class='text-start'>"+responseDeta.data[i]['ESTILO']+"</td>";
                  options+="<td class='text-start'>"+responseDeta.data[i]['COLOR']+"</td>";
                  options+="<td class='text-start'>"+responseDeta.data[i]['TALLA']+"</td>";
                  options+="<td class='text-end'>"+ returnBlank(responseDeta.data[i]['UNITOT'])+"</td>";
                  options+="<td class='text-end text-primary'>"+ returnBlank(responseDeta.data[i]['VTAMES'])+"</td>";
                  options+="<td class='text-end text-primary'>"+ returnBlank(responseDeta.data[i]['UNIVEN'])+"</td>";
                  options+="<td class='text-end text-success'>"+ returnBlank(responseDeta.data[i]['EXIACT'])+"</td>";
                  options+="<td class='text-end'>"+ returnBlank(responseDeta.data[i]['ROTINV'])+"</td>";
                  options+="<td class='text-end text-danger'>"+ returnBlank(responseDeta.data[i]['MESINV'])+"</td>";
                  options+="<td class='text-end'>"+ returnBlank(responseDeta.data[i]['PORDES'])+"</td>";
                  options+="<td class='text-end'>"+formatFecha(responseDeta.data[i]['FECING'])+"</td>";
                  options+="<td class='text-end'>"+formatFecha(responseDeta.data[i]['FECCOM'])+"</td>";
                  options+="<td class='text-end'>"+formatFecha(responseDeta.data[i]['FECVEN'])+"</td>";
                  options+="<td class='text-end'>"+ returnBlank(responseDeta.data[i]['DIAANT'])+"</td>";
                  options+="<td class='text-end'>"+ returnBlank(responseDeta.data[i]['DIAANC'])+"</td>";
                  options+="<td class='text-end'>"+ returnBlank(responseDeta.data[i]['DIAANV'])+"</td>";
                  options+="<td class='text-end'>"+responseDeta.data[i]['TIPINV']+"</td>";
                  options+="<td class='text-start'>"+responseDeta.data[i]['MARCA']+"</td>";
                  options+="<td class='text-start'>"+responseDeta.data[i]['GENERO']+"</td>";
                  options+="</tr>";
                }
                
                tableDetalles.append(options);
            $('#detallesModal').modal('show');
          }
        }
        function returnBlank(value){
          if (value=="" || value==null) {
            return "";
          }else{
            return value.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
          }
        }

        function formatFecha(fechaOriginal){
          if (fechaOriginal=="" || fechaOriginal==0) {
               return ""; 
             }else{
              const year = fechaOriginal.slice(0, 4);
              const month = fechaOriginal.slice(4, 6);
              const day = fechaOriginal.slice(6, 8);
              const fechaConvertida = `${day}/${month}/${year}`;
              return fechaConvertida;
             }
        }
      </script>

<div class="modal fade" id="detallesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" onclick="$('#detallesModal').modal('hide')"></button>
      </div>
      <div class="modal-body">
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">
                    <h5 class="text-center">Estilo, color y talla</h5>
                    <div class="overflow-auto mt-3  rounded" style="width:100%; height: 400px;">
                    <table id="myTableDetalles" class="table stripe"style="width:100%">
                        <thead>
                            <tr class="sticky-top bg-white">
                                <th class="d-none">rownum</th>
                                <th class="text-black text-start">ESTILO</th>
                                <th class="text-black text-start">COLOR</th>
                                <th class="text-black text-start">TALLA</th>
                                <th class="text-black text-start">UNIDADES VTAS TOTALES</th>
                                <th class="text-black text-end">UNIDADES VTAS MES PROCESO</th>
                                <th class="text-black text-end">PROMEDIO MENSUAL</th>
                                <th class="text-black text-end">EXISTENCIA ACTUAL</th>
                                <th class="text-black text-end">ROT. INV.</th>
                                <th class="text-black text-end">MESES INVENTARIO</th>
                                <th class="text-black text-end">% DESCUENTO</th>
                                <th class="text-black text-end">FECHA INGRESO</th>
                                <th class="text-black text-end">FECHA ULT/COMPRA</th>
                                <th class="text-black text-end">FECHA ULT/VENTA</th>
                                <th class="text-black text-end">DIAS ANTIGUEDAD</th>
                                <th class="text-black text-end">DIAS ANT. ULT/COMPRA</th>
                                <th class="text-black text-end">DIAS ANT. ULT/VENTA</th>
                                <th class="text-black text-end">TIPO INVENTARIO</th>
                                <th class="text-black text-end">MARCA</th>
                                <th class="text-black text-end">GENERO</th>
                            </tr>
                        </thead>
                        <tbody id="myTableDetallesBody">
                                
                        </tbody>
                    </table>
                        </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
