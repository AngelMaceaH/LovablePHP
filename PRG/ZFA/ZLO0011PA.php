<!DOCTYPE html>
<html lang="es">
  <head>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
</head>
<body>
<div class="spinner-wrapper">
<span class="loader"></span>
</div> 
  <?php
      include '../layout-prg.php';
      $anopro=isset($_SESSION['anofiltro'])? $_SESSION['anofiltro']:date("Y");
      $mespro=isset($_SESSION['mesfiltro'])? $_SESSION['mesfiltro']:date("m");
      $cia="";
      if (isset($_GET['id'])) {
        $_SESSION['cia']=$_GET['id'];
      }else{
        $_SESSION['cia']=isset($_SESSION['cia'])? $_SESSION['cia']:1;
      }
      if ($_SESSION['cia']==1) {
        $cia=" AND LO2261.CODCIA IN(35,47,50,52,56,57,59,63,64,65,68,70,72,73,74,75,76,78,82,85,88)";
      }elseif ($_SESSION['cia']==2) {
        $cia=" AND LO2261.CODCIA IN(20,22,21,23,24)";
      }elseif ($_SESSION['cia']==3) {
       $cia=" AND LO2261.CODCIA IN(49,66,69,71,86)";
      }elseif ($_SESSION['cia']==4) {
       $cia=" AND LO2261.CODCIA IN(48,53,61,62,77)";
      }elseif ($_SESSION['cia']==5) {
       $cia=" AND LO2261.CODCIA IN(60,80,54)";
      }elseif ($_SESSION['cia']==6) {
       $cia=" AND LO2261.CODCIA IN(83,87)";
      }elseif ($_SESSION['cia']==7) {
       $cia=" AND LO2261.CODCIA IN(81)";
      }
    ?> 
     <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
              <span>Producto Terminado / Clasificación de producto</span>
              </li>
              <li class="breadcrumb-item active"><span>ZLO0011PA</span></li>
            </ol>
          </nav>
        </div>
      </header>
      <div id="body-div" class="body flex-grow-1">
        <div class="card mb-5">
            <div class="card-header">
              <h1 class="fs-4 mb-1 mt-2 text-center">Inventario por Clasificación de Productos Tiendas</h1>
            </div>
          <div class="card-body">
          <div class="position-relative">
              <form id="formFiltros" action="../../assets/php/ZFA/ZLO0011P/filtrosLogicaA.php" method="POST">
                <div class="row mb-2">
                      <div class="col-12 col-md-4 mt-2 d-flex flex-wrap">
                        <label for="filtro1" class=" mt-2" id="">Visualizar por: </label>
                        <select name="filtro1" id="filtro1" class="form-select">
                          <option class="fw-bold" value="1">Honduras (Lov. Ecommerce)</option>
                          <option class="fw-bold" value="2">Honduras (Mod. Íntima)</option>
                          <option class="fw-bold" value="3">Guatemala</option>
                          <option class="fw-bold" value="4">El Salvador</option>
                          <option class="fw-bold" value="5">Costa Rica</option>
                          <option class="fw-bold" value="6">Nicaragua</option>
                          <option class="fw-bold" value="7">Rep. Dominicana</option>
                        </select>
                      </div>
                      <div class="col-sm-12 col-md-4 mt-2">
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
                      <div class="col-sm-12 col-md-4 mt-2">
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
              <div id="grafica1" class="mt-5">
                      <figure class="highcharts-figure" >
                                <div id="container" ></div>
                        </figure>
              </div>
              <div class="table-responsive mt-3" style="width:100%">
                          <table id="myTableInvDesc" class="table stripe table-hover " style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th  class="responsive-font-example text-start" >Punto de Venta</th>
                                    <th  class="responsive-font-example text-end">Sin descuento</th>
                                    <th  class="responsive-font-example text-end">10 %</th>
                                    <th  class="responsive-font-example text-end">20 %</th>
                                    <th  class="responsive-font-example text-end">30 %</th>
                                    <th  class="responsive-font-example text-end">40 %</th>
                                    <th  class="responsive-font-example text-end">50 %</th>
                                    <th  class="responsive-font-example text-end">60 %</th>
                                    <th  class="responsive-font-example text-end">70 %</th>
                                    <th  class="responsive-font-example text-end">80 %</th>
                                    <th  class="responsive-font-example text-end">Z1</th>
                                    <th  class="responsive-font-example text-end">Z2</th>
                                    <th  class="responsive-font-example text-end">Total</th>
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
   
      <div class="footer bg-blck flex-grow-1 d-flex justify-content-center">
      <p class="bggray responsive-font-example"><i>Lovable de Honduras S.A. de C.V</i></p>
      </div>
      <script src="https://code.highcharts.com/highcharts.js"></script>
      <script src="https://code.highcharts.com/modules/exporting.js"></script>
      <script src="https://code.highcharts.com/modules/export-data.js"></script>
      <script src="https://code.highcharts.com/modules/accessibility.js"></script>
      <script>
        $( document ).ready(function() {
          var mespro='<?php echo $mespro; ?>';
          var anopro='<?php echo $anopro; ?>';
          var ciaSelect='<?php echo $_SESSION['cia']; ?>';
          var cia='<?php echo $cia; ?>';
          $("#cbbAno").val(anopro);
          $("#cbbMes").val(mespro);
          $("#filtro1").val(ciaSelect);
          var urlList="http://172.16.15.20/API.LovablePHP/ZLO0011P/List/?anopro="+anopro+"&mespro="+mespro+"&cia="+cia+"";
          var options="";
          var responseList=ajaxRequest(urlList);
          console.log(urlList);
          var arrayList=[];
          var isEmpty=false;
          if (responseList.code==200) {
           for (let i = 0; i < responseList.data.length; i++) {
            var sidesc=responseList.data[i]['SIDESC'];
            var por10=responseList.data[i]['POR10'];
            var por20=responseList.data[i]['POR20'];
            var por30=responseList.data[i]['POR30'];
            var por40=responseList.data[i]['POR40'];
            var por50=responseList.data[i]['POR50'];
            var por60=responseList.data[i]['POR60'];
            var por70=responseList.data[i]['POR70'];
            var por80=responseList.data[i]['POR80'];
            var porz1=responseList.data[i]['PORZ1'];
            var porz2=responseList.data[i]['PORZ2'];
            var total=responseList.data[i]['PORTOT'];
            arrayList[i] = {
              name: responseList.data[i]['NOMCIA'],
              data: [parseInt(sidesc), parseInt(por10), parseInt(por20), parseInt(por30), parseInt(por40), parseInt(por50), parseInt(por60), 
              parseInt(por70), parseInt(por80), parseInt(porz1), parseInt(porz2)]
            };
            options+='<tr>';
            options+='<td>'+responseList.data[i]['CODCIA']+'</td>';
            options+='<td class="fw-bold">'+responseList.data[i]['NOMCIA']+'</td>';
            if (sidesc==0)
            options+='<td></td>';
            else
            options+='<td class="text-end">'+sidesc+'</td>';
            if (por10==0)
            options+='<td></td>';
            else
            options+='<td class="text-end">'+por10+'</td>';
            if (por20==0)
            options+='<td></td>';
            else
            options+='<td class="text-end">'+por20+'</td>';
            if (por30==0)
            options+='<td></td>';
            else
            options+='<td class="text-end">'+por30+'</td>';
            if (por40==0)
            options+='<td></td>';
            else
            options+='<td class="text-end">'+por40+'</td>';
            if (por50==0)
            options+='<td></td>';
            else
            options+='<td class="text-end">'+por50+'</td>';
            if (por60==0)
            options+='<td></td>';
            else
            options+='<td class="text-end">'+por60+'</td>';
            if (por70==0)
            options+='<td></td>';
            else
            options+='<td class="text-end">'+por70+'</td>';
            if (por80==0)
            options+='<td></td>';
            else
            options+='<td class="text-end">'+por80+'</td>';
            if (porz1==0)
            options+='<td></td>';
            else
            options+='<td class="text-end">'+porz1+'</td>';
            if (porz2==0)
            options+='<td></td>';
            else
            options+='<td class="text-end">'+porz2+'</td>';
            if (total==0)
            options+='<td></td>';
            else
            options+='<td class="text-end">'+total+'</td>';
            options+='</tr>';
           }
            $("#myTableInvDesc tbody").html(options);
          }else{
            isEmpty=true;
          }
          if (isEmpty) {
            $("#grafica1").addClass("d-none");
          }
          $("#cbbAno, #cbbMes, #filtro1").on("change",function() {
            $("#formFiltros").submit();
          });
          console.log(arrayList);
              $("#myTableInvDesc").DataTable( {
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },
        "ordering": false,
        "pageLength": 100,
        "columnDefs": [
            {
                target: 0,
                visible: false,
                searchable: true,
            },
            ],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fa-solid fa-file-excel"></i> <b >Enviar a Excel</b>',
                className: "btn btn-success text-light fs-6 ",
                exportOptions: {
                    columns: [1,2,3,4,5,6,7,8,9,10,11,12]
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
                    
                    $('c[r=A1] t', sheet).text( 'INVENTARIO POR CLASIFICACIÓN DE PRODUCTOS TIENDAS' );
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


          Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: ' '
    },
    xAxis: {
      categories: ['Sin descuento','10%','20%','30%', '40%', '50%', '60%', '70%', '80%', 'Z1', 'Z2'],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: ''
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td><b>{point.y:.0f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: arrayList
});
        });
      </script>
</body>
</html>
