<!DOCTYPE html>
<html lang="es">
  <head>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
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
<div class="spinner-border text-danger" role="status">
    
</div>
</div> 
  <?php
      include '../layout-prg.php';
    ?> 
     <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
              <span>Producto Terminado / Clasificación de producto</span>
              </li>
              <li class="breadcrumb-item active"><span>ZLO0011P</span></li>
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
              <form id="formFiltros" action="../../assets/php/ZPT/ZLO0010P/filtrosLogica.php" method="POST">
                <div class="row mb-2">
                      <div class="col-sm-12 col-md-6 mt-2">
                        <label>Año:</label>
                        <select class="form-select  mt-1" id="cbbAno" name="cbbAno">
                          <?php
                                $anio_actual = date('Y');
                                for ($i = $anio_actual; $i >= 2021; $i--) {
                                echo "<option value='$i'>$i</option>";
                                }
                            ?>
                        </select>
                      </div>
                      <div class="col-sm-12 col-md-6 mt-2">
                        <label>Mes:</label>
                        <select class="form-select mt-1" id="cbbMes" name="cbbMes">
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
                </div>
              </form>
              </div>
              <hr>
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
        $( document ).ready(function() {
          var urlData="http://172.16.15.20/API.LOVABLEPHP/ZLO0012P/List/";
          var urlMarca="http://172.16.15.20/API.LOVABLEPHP/ZLO0012P/List2/";
          var responseData=ajaxRequest(urlData);
          var responseMarca=ajaxRequest(urlMarca);
          console.log(responseData.data);
          console.log(responseMarca.data);
          var options="";
          for (let i = 0; i < responseData.data.length; i++) {
            options+="<tr>";
            options+="<td>"+responseData.data[i]['ESTILO']+"</td>";
            options+="<td>"+responseData.data[i]['TTOT']+"</td>";
            options+="<td>"+responseData.data[i]['MESTOT']+"</td>";  
            options+="<td>"+responseData.data[i]['UNIVEN']+"</td>";
            options+="<td>"+responseData.data[i]['PROMEN']+"</td>";
            options+="<td>"+responseData.data[i]['EXIACT']+"</td>";
            options+="<td>"+responseData.data[i]['ROTINV']+"</td>";
            options+="<td>"+responseData.data[i]['MESINV']+"</td>";
            options+="<td>"+responseData.data[i]['PORDES']+"</td>";
            options+="<td>"+responseData.data[i]['FECING']+"</td>";
            options+="<td>"+responseData.data[i]['FECCOM']+"</td>";
            options+="<td>"+responseData.data[i]['FECVEN']+"</td>";
            options+="<td>"+responseData.data[i]['DIAANT']+"</td>";
            options+="<td>"+responseData.data[i]['DIAANC']+"</td>";
            options+="<td>"+responseData.data[i]['DIAANV']+"</td>";
            options+="<td>"+responseData.data[i]['TIPINV']+"</td>";
            options+="</tr>";
          }
          $("#myTableSeguimientoBody").append(options);

              $("#myTableSeguimiento").DataTable( {
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },
        "pageLength": 10,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fa-solid fa-file-excel"></i> <b >Enviar a Excel</b>',
                className: "btn btn-success text-light fs-6 ",
                exportOptions: {
                    columns: [1,2,3,4,5,6,7,8,9,10,11,12,13]
                },
                title: 'ReporteInv Descuentos',
                
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
                    
                    $('c[r=A1] t', sheet).text( 'INVENTARIO POR CLASIFICACIÓN DE PRODUCTOS FABRICA' );
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
        });
      </script>
</body>
</html>
