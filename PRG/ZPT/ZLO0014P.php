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
              <div class="table-container mt-3 position-relative" style="width:100%;">
              <div id="loaderTable" class="d-none">
                <button class="btn btn-success position-absolute top-50 start-50 translate-middle p-4" style="z-index: 9999;" type="button" disabled>
                    <i class="fa-solid fa-file-excel fa-flip text-white" style="font-size:70px;"></i>
                </button>
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-secondary bg-opacity-50 rounded" style="z-index: 9998;"></div>
              </div>
              <div>
                          <table id="myTableSeguimiento" class="table stripe table-hover " style="width:100%">
                            <thead>
                                <tr class="sticky-top bg-white" style="font-size: 14px;">
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
                            <tbody id="myTableSeguimientoBody" style="font-size: 13px;">
                              
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
      <script src="https://code.highcharts.com/highcharts.js"></script>
      <script src="https://code.highcharts.com/modules/exporting.js"></script>
      <script src="https://code.highcharts.com/modules/export-data.js"></script>
      <script src="https://code.highcharts.com/modules/accessibility.js"></script>
      <script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>
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
          console.log("http://172.16.15.20/API.LOVABLEPHP/ZLO0014P/List/?agrup="+agrupSelect);
         var table= $('#myTableSeguimiento').DataTable({
            language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            loadingRecords:`<button class="btn btn-danger " type="button" disabled>
                                    <span class="spinner-border text-white" style="width: 1.5rem; height: 1.5rem;"
                                        aria-hidden="true"></span>
                                    <span role="status" class="ms-2 text-white fs-4">Cargando...</span>
                                </button>`
        },
        fixedColumns: {
                    left: 5,},
        "pageLength": 20,
                "ajax": {
                    "url": "http://172.16.15.20/API.LOVABLEPHP/ZLO0014P/List/?agrup="+agrupSelect,
                    "type": "POST",
                    "complete": function (xhr) {
                        },
                        error: function (xhr, status, error) {
                            console.log(error);
                            requestError = true;
                        }
                },
                "columns": [
                    { "data": "MARCA"},
                    { "data": "ESTILO","searchable": false },
                    { "data": "COLOR","searchable": false },
                    { "data": "TALLA","searchable": false },
                    { "data": "TIPINV","searchable": false },
                    { "data": "UNIVEN","searchable": false, className: "text-primary",
                        render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                    { "data": "PROMEN","searchable": false, className: "text-lila",
                        render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                    { "data": "NUMM12","searchable": false, className: "text-primary", },
                    { "data": "EXIACT","searchable": false, className: "text-green",
                        render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                    { "data": "ROTINV","searchable": false, className: "text-success",  },
                    { "data": "MESINV","searchable": false, className: "text-brown", 
                        render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                    { "data": "PORDES","searchable": false,
                        render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                    { "data": "FECING","searchable": false,
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
            { "data": "FECULT","searchable": false,
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
                    { "data": "FECCOM","searchable": false, className: "text-success",
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
                    { "data": "FECVEN","searchable": false,
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
              
            }},
                    { "data": "DIAANT","searchable": false},
                    { "data": "DIAANC","searchable": false},
                    { "data": "DESDES","searchable": false, className: "text-darkblue", },
                    { "data": "ARCD07","searchable": false, className: "text-darkblue", },
                ],
                ordering: true,
                dom: 'Bfrtip',
                buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fa-solid fa-file-excel"></i> <b >Enviar a Excel</b>',
                className: "btn btn-success text-light fs-6 ",
                action: function (e, dt, button, config) {
                      document.getElementById('loaderTable').classList.remove('d-none');
                      setTimeout(() => {
                          $.fn.dataTable.ext.buttons.excelHtml5.action.call(this, e, dt, button, config);
                          document.getElementById('loaderTable').classList.add('d-none');
                      }, 100);
                  },
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19]
                },
                title: 'Analis-MovimientoInventario',
                customize: function (xlsx) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    var sSh = xlsx.xl['styles.xml'];
                    var lastXfIndex = $('cellXfs xf', sSh).length - 1;
                    var lastFontIndex = $('fonts font', sSh).length - 1;
                    var i; var y;
                    var f1 = '<font>' +
                            '<sz val="11" />' +
                            '<name val="Calibri" />' +
                            '<color rgb="FF0000" />' + // color rojo en la fuente
                            '</font>';
                        var f2 = '<font>' +
                            '<sz val="11" />' +
                            '<name val="Calibri" />' +
                            '<color rgb="007800" />' + // color verde en la fuente
                            '</font>';
                        var f3 = '<font>' +
                            '<sz val="11" />' +
                            '<name val="Calibri" />' +
                            '<color rgb="9F6CFF" />' + // color cyan de la fuente
                            '</font>';
                        var f4 = '<font>' +
                            '<sz val="11" />' +
                            '<name val="Calibri" />' +
                            '<color rgb="7E5006" />' + // color cyan de la fuente
                            '</font>';
                        var f5 = '<font>' +
                            '<sz val="11" />' +
                            '<name val="Calibri" />' +
                            '<color rgb="00377D" />' + // color azul oscuro de la fuente
                            '</font>';
                        var f6 = '<font>' +
                            '<sz val="11" />' +
                            '<name val="Calibri" />' +
                            '<color rgb="0F8900" />' + // color verde oscuro de la fuente
                            '</font>';
                        var f7 = '<font>' +
                            '<sz val="11" />' +
                            '<name val="Calibri" />' +
                            '<color rgb="C1C100" />' + // color amarillo de la fuente
                            '</font>';
                        var f8 = '<font>' +
                            '<sz val="11" />' +
                            '<name val="Calibri" />' +
                            '<color rgb="FFB202" />' + // color naranja de la fuente
                            '</font>';
                        var n1 = '<numFmt formatCode="##0%"   numFmtId="300"/>';
                        var n2 = '<numFmt formatCode="#,##0.00"   numFmtId="200" />';
                        var s1 =
                            '<xf numFmtId="300" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>';
                        var s2 =
                            '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="center"/></xf>';
                        var s3 =
                            '<xf numFmtId="4" fontId="2" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>'
                        var s4 =
                            '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="center" wrapText="1"/></xf>'
                        var s5 = '<xf  numFmtId="200" fontId="' + (lastFontIndex + 1) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s6 = '<xf  numFmtId="200" fontId="' + (lastFontIndex + 2) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s7 = '<xf  numFmtId="300" fontId="' + (lastFontIndex + 1) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s8 = '<xf  numFmtId="300" fontId="' + (lastFontIndex + 2) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s9 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 3) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s10 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 4) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s11 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 5) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s12 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 6) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s13 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 7) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        var s14 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 8) +
                            '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                            '<alignment horizontal="right"/></xf>';
                        sSh.childNodes[0].childNodes[0].innerHTML += n1 + n2;
                        sSh.childNodes[0].childNodes[1].innerHTML += f1 + f2 + f3 + f4 + f5 +
                            f6 + f7 + f8;
                        sSh.childNodes[0].childNodes[5].innerHTML += s1 + s2 + s3 + s4 + s5 +
                            s6 + s7 + s8 + s9 + s10 + s11 + s12 + s13 + s14;
                        var fourDecPlaces = lastXfIndex + 1;
                        var greyBoldCentered = lastXfIndex + 2;
                        var twoDecPlacesBold = lastXfIndex + 3;
                        var greyBoldWrapText = lastXfIndex + 4;
                        var textred1 = lastXfIndex + 5;
                        var textgreen1 = lastXfIndex + 6;
                        var textred2 = lastXfIndex + 7;
                        var textgreen2 = lastXfIndex + 8;
                        var textCyan = lastXfIndex + 9;
                        var textBrown = lastXfIndex + 10;
                        var textDarkblue = lastXfIndex + 11;
                        var textDarkGreen = lastXfIndex + 12;
                        var textYellow = lastXfIndex + 13;
                        var textNaranja = lastXfIndex + 14;
                    $('c[r=A1] t', sheet).text( 'REPORTE DE ANALISIS DE MOVIMIENTO DE INVENTARIO '+($("#cbbAgrupacion option:selected").text()).toUpperCase() );
                    $('row:eq(0) c', sheet).attr( 's', greyBoldCentered );
                    $('row:eq(1) c', sheet).attr( 's', 7 );
                        $('row', sheet).each(function() {
                            var row = $(this);
                            if (row.index() < 2) {
                                return;
                            }
                            $('c[r^="F"], c[r^="H"], c[r^="S"], c[r^="T"]', row).attr('s', textDarkblue);
                            $('c[r^="G"]', row).attr('s', textCyan);
                            $('c[r^="I"]', row).attr('s', textDarkGreen);
                            $('c[r^="J"]', row).attr('s', textgreen1);
                            $('c[r^="K"]', row).attr('s', textBrown);
                            
                        });
                    var tagName = sSh.getElementsByTagName('sz');
                    for (i = 0; i < tagName.length; i++) {
                      tagName[i].setAttribute("val", "13")
                    }
                  }
            }
                ]

            });
        });
       
      </script>
</body>
</html>
