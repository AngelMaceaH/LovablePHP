<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
    <link rel="stylesheet" href="../../assets/vendors/monthpicker/material.css">
    <link href="../../assets/vendors/monthpicker/picker.css" rel="stylesheet">
</head>
<body>
  <div class="spinner-wrapper">
    <div class="spinner-border text-danger" role="status">
    </div>
  </div>
  <?php
      include '../layout-prg.php';
      include 'ZLO0003Psql.php';
      
?>
  <div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item">
          <span>Modulo de facturación</span>
        </li>
        <li class="breadcrumb-item active"><span>ZLO0003P</span></li>
      </ol>
    </nav>
  </div>
  </header>
  <div id="body-div" class="body flex-grow-3">
    <div class="card mb-5">
      <div class="card-header">
        <h1 class="fs-4 mb-1 mt-2 text-center">Consulta Comp. tiendas por marca, pais y meses</h1>
      </div>
      <div class="card-body">
       
            <div class="position-relative">
              <form id="formFiltros" action="../../assets/php/ZFA/ZLO0003P/filtrosLogica.php" method="POST">
                <div class="row mb-2">
                <div class="col-sm-12 col-lg-6 mt-2">
                        <label>Marca:</label>
                        <select class="form-select  mt-1" id="cbbMarca" name="cbbMarca">
                        <option value="0">TODAS LAS MARCAS</option>
                          <?php
                           while($rowDesc = odbc_fetch_array($resultDescripcion)){
                            echo "<option value='".$rowDesc['DESCO1']."'>".$rowDesc['DESDES']."</option>";
                           }
                            ?>
                        </select>
                      </div>
                      <div class="col-sm-12 col-lg-6 mt-2">
                          <label>Rango de meses:</label>
                            <div id="wrapper">
                            <input id="daterangepicker" class="fs-6 p-2 fw-bold"  type="text" placeholder="Selecciona un rango de meses" onclick="this.blur();" oninput="this.value = this.value.replace(/[^0-9\/\s-]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0'); if(!(/^(0[1-9]|1[0-2])\/\d{4}\s-\s(0[1-9]|1[0-2])\/\d{4}$/.test(this.value))) this.value = '';">
                            <input class="d-none" id="startdate" name="startdate">
                            <input class="d-none" id="enddate" name="enddate">
                          </div>
                      </div>
                </div>
              </form>
              </div>
              <hr>
              <div class="row" id="grafica">
                      <div class="col-12 col-lg-12">
                        <figure class="highcharts-figure" >
                                <div id="container2" ></div>
                        </figure>
                      </div>
              </div>
              <div class="table-responsive">
              <table id="myTableMarcas" class="table stripe table-hover " style="width:100%">
                <thead>
                    <tr>
                        <th class="d-none">ID</th>
                        <th>Paises</th>
                        <th>Unidades Año <?php echo $ano2;?></th>
                        <th>Valor Año <?php echo $ano2;?></th>
                        <th>Unidades Año <?php echo $ano2-1;?></th>
                        <th>Valor Año <?php echo $ano2-1;?></th>
                        <th>Variación</th>
                        <th>Crecimiento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $ano1hon=0;$ano2hon=0;$varhon=0;$crehon=0;$can1hon=0;$can2hon=0;
                    $ano1gua=0;$ano2gua=0;$vargua=0;$cregua=0;$can1gua=0;$can2gua=0;
                    $ano1sal=0;$ano2sal=0;$varsal=0;$cresal=0;$can1sal=0;$can2sal=0;
                    $ano1cos=0;$ano2cos=0;$varcos=0;$crecos=0;$can1cos=0;$can2cos=0;
                    $ano1nic=0;$ano2nic=0;$varnic=0;$crenic=0;$can1nic=0;$can2nic=0;
                    $ano1rep=0;$ano2rep=0;$varrep=0;$crerep=0;$can1rep=0;$can2rep=0;
                    $ano1tot=0;$ano2tot=0;$vartot=0;$cretot=0;$can1tot=0;$can2tot=0;
                    $paisesLabel=['Honduras','Guatemala','El Salvador','Costa Rica','Nicaragua','Rep. Dominicana']; 
                    $valorAno1[]=array(); $valorAno2[]=array();
                    $validator="true";
                    while($rowMarcas = odbc_fetch_array($resultMarcas)){
                      $validator="false";
                        //HONDURAS
                        $ano1hon=($rowMarcas['HONVALANO1']!=0)?($rowMarcas['HONVALANO1']):0;$ano2hon=($rowMarcas['HONVALANO2']!=0)?($rowMarcas['HONVALANO2']):0;
                        $can1hon=($rowMarcas['HONCANANO1']!=0)?($rowMarcas['HONCANANO1']):0;$can2hon=($rowMarcas['HONCANANO2']!=0)?($rowMarcas['HONCANANO2']):0;
                        $varhon=$ano1hon-$ano2hon;$crehon=($ano1hon!=0 && $ano2hon!=0)? round((($ano1hon/$ano2hon)-1)*100):0;
                        //GUATEMALA
                        $ano1gua=($rowMarcas['GUAVALANO1']!=0)?($rowMarcas['GUAVALANO1']):0;$ano2gua=($rowMarcas['GUAVALANO2']!=0)?($rowMarcas['GUAVALANO2']):0;
                        $can1gua=($rowMarcas['GUACANANO1']!=0)?($rowMarcas['GUACANANO1']):0;$can2gua=($rowMarcas['GUACANANO2']!=0)?($rowMarcas['GUACANANO2']):0;
                        $vargua=$ano1gua-$ano2gua; $cregua=($ano1gua!=0 && $ano2gua!=0)? round((($ano1gua/$ano2gua)-1)*100):0;
                        //EL SALVADOR
                        $ano1sal=($rowMarcas['SALVALANO1']!=0)?($rowMarcas['SALVALANO1']):0; $ano2sal=($rowMarcas['SALVALANO2']!=0)?($rowMarcas['SALVALANO2']):0;
                        $can1sal=($rowMarcas['SALCANANO1']!=0)?($rowMarcas['SALCANANO1']):0;$can2sal=($rowMarcas['SALCANANO2']!=0)?($rowMarcas['SALCANANO2']):0;
                        $varsal=$ano1sal-$ano2sal;$cresal=($ano1sal!=0 && $ano2sal!=0)? round((($ano1sal/$ano2sal)-1)*100):0;
                        //COSTA RICA
                        $ano1cos=($rowMarcas['COSVALANO1']!=0)?($rowMarcas['COSVALANO1']):0; $ano2cos=($rowMarcas['COSVALANO2']!=0)?($rowMarcas['COSVALANO2']):0;
                        $can1cos=($rowMarcas['COSCANANO1']!=0)?($rowMarcas['COSCANANO1']):0;$can2cos=($rowMarcas['COSCANANO2']!=0)?($rowMarcas['COSCANANO2']):0;
                        $varcos=$ano1cos-$ano2cos;$crecos=($ano1cos!=0 && $ano2cos!=0)? round((($ano1cos/$ano2cos)-1)*100):0;
                        //NICARAGUA
                        $ano1nic=($rowMarcas['NICVALANO1']!=0)?($rowMarcas['NICVALANO1']):0; $ano2nic=($rowMarcas['NICVALANO2']!=0)?($rowMarcas['NICVALANO2']):0;
                        $can1nic=($rowMarcas['NICCANANO1']!=0)?($rowMarcas['NICCANANO1']):0;$can2nic=($rowMarcas['NICCANANO2']!=0)?($rowMarcas['NICCANANO2']):0;
                        $varnic=$ano1nic-$ano2nic;$crenic=($ano1nic!=0 && $ano2nic!=0)? round((($ano1nic/$ano2nic)-1)*100):0;
                        //REP. DOMINICANA
                        $ano1rep=($rowMarcas['REPVALANO1']!=0)?($rowMarcas['REPVALANO1']):0; $ano2rep=($rowMarcas['REPVALANO2']!=0)?($rowMarcas['REPVALANO2']):0;
                        $can1rep=($rowMarcas['REPCANANO1']!=0)?($rowMarcas['REPCANANO1']):0;$can2rep=($rowMarcas['REPCANANO2']!=0)?($rowMarcas['REPCANANO2']):0;
                        $varrep=$ano1rep-$ano2rep;$crerep=($ano1rep!=0 && $ano2rep!=0)? round((($ano1rep/$ano2rep)-1)*100):0;
                        //TOTALES
                        $ano1tot=$ano1hon+$ano1gua+$ano1sal+$ano1cos+$ano1nic+$ano1rep;$ano2tot=$ano2hon+$ano2gua+$ano2sal+$ano2cos+$ano2nic+$ano2rep;
                        $can1tot=$can1hon+$can1gua+$can1sal+$can1cos+$can1nic+$can1rep;$can2tot=$can2hon+$can2gua+$can2sal+$can2cos+$can2nic+$can2rep;
                        $vartot=$ano1tot-$ano2tot;$cretot=($ano1tot!=0 && $ano2tot!=0)? round((($ano1tot/$ano2tot)-1)*100):0;

                        print '<tr>';
                        print '<td class="fw-bold d-none">1</td>';
                        print '<td class="fw-bold">Honduras</td>';
                        print '<td class="fw-bold text-center">'.(($can1hon==0)?' ':number_format( $can1hon,0)).'</td>';
                        print '<td>'.(($ano1hon==0)?' ':"D.".number_format( $ano1hon,2)).'</td>';
                        print '<td class="fw-bold text-center">'.(($can2hon==0)?' ':number_format( $can2hon,0)).'</td>';
                        print '<td>'.(($ano2hon==0)?' ':"D.".number_format( $ano2hon,2)).'</td>';  
                        if ($varhon<0) {print '<td class="text-danger fw-bold">D.'.number_format(($varhon),2).'</td>';}else{if ($varhon>0) {print '<td class="text-success fw-bold">D.'.number_format(($varhon),2).'</td>';}else{print '<td class="fw-bold">'.(($varhon==0)?' ':number_format( $varhon,2)).'</td>';}}
                        if ($crehon<0) {print '<td class="text-danger fw-bold">'.number_format(($crehon),0).'%</td>';}else{if ($crehon>0) {print '<td class="text-success fw-bold">'.number_format(($crehon),0).'%</td>';}else{print '<td class="fw-bold">'.(($crehon==0)?' ':number_format( $crehon,0)).'</td>';}}
                        print '</tr>';

                        print '<tr>';
                        print '<td class="fw-bold d-none">2</td>';
                        print '<td class="fw-bold">Guatemala</td>';
                        print '<td class="fw-bold text-center">'.(($can1gua==0)?' ':number_format( $can1gua,0)).'</td>';
                        print '<td>'.(($ano1gua==0)?' ':"D.".number_format( $ano1gua,2)).'</td>';
                        print '<td class="fw-bold text-center">'.(($can2gua==0)?' ':number_format( $can2gua,0)).'</td>';
                        print '<td>'.(($ano2gua==0)?' ':"D.".number_format( $ano2gua,2)).'</td>'; 
                        if ($vargua<0) {print '<td class="text-danger fw-bold">D.'.number_format(($vargua),2).'</td>';}else{if ($vargua>0) {print '<td class="text-success fw-bold">D.'.number_format(($vargua),2).'</td>';}else{print '<td class="fw-bold">'.(($vargua==0)?' ':number_format( $vargua,2)).'</td>';}}
                        if ($cregua<0) {print '<td class="text-danger fw-bold">'.number_format(($cregua),0).'%</td>';}else{if ($cregua>0) {print '<td class="text-success fw-bold">'.number_format(($cregua),0).'%</td>';}else{print '<td class="fw-bold">'.(($cregua==0)?' ':number_format( $cregua,0)).'</td>';}}
                        print '</tr>';

                        print '<tr>';
                        print '<td class="fw-bold d-none">3</td>';
                        print '<td class="fw-bold">El Salvador</td>';
                        print '<td class="fw-bold text-center">'.(($can1sal==0)?' ':number_format( $can1sal,0)).'</td>';
                        print '<td>'.(($ano1sal==0)?' ':"D.".number_format( $ano1sal,2)).'</td>';
                        print '<td class="fw-bold text-center">'.(($can2sal==0)?' ':number_format( $can2sal,0)).'</td>';
                        print '<td>'.(($ano2sal==0)?' ':"D.".number_format( $ano2sal,2)).'</td>';
                        if ($varsal<0) {print '<td class="text-danger fw-bold">D.'.number_format(($varsal),2).'</td>';}else{if ($varsal>0) {print '<td class="text-success fw-bold">D.'.number_format(($varsal),2).'</td>';}else{print '<td class="fw-bold">'.(($varsal==0)?' ':number_format( $varsal,2)).'</td>';}}
                        if ($cresal<0) {print '<td class="text-danger fw-bold">'.number_format(($cresal),0).'%</td>';}else{if ($cresal>0) {print '<td class="text-success fw-bold">'.number_format(($cresal),0).'%</td>';}else{print '<td class="fw-bold">'.(($cresal==0)?' ':number_format( $cresal,0)).'</td>';}}
                        print '</tr>';

                        print '<tr>';
                        print '<td class="fw-bold d-none">4</td>';
                        print '<td class="fw-bold">Costa Rica</td>';
                        print '<td class="fw-bold text-center">'.(($can1cos==0)?' ':number_format( $can1cos,0)).'</td>';
                        print '<td>'.(($ano1cos==0)?' ':"D.".number_format( $ano1cos,2)).'</td>';
                        print '<td class="fw-bold text-center">'.(($can2cos==0)?' ':number_format( $can2cos,0)).'</td>';
                        print '<td>'.(($ano2cos==0)?' ':"D.".number_format( $ano2cos,2)).'</td>';
                        if ($varcos<0) {print '<td class="text-danger fw-bold">D.'.number_format(($varcos),2).'</td>';}else{if ($varcos>0) {print '<td class="text-success fw-bold">D.'.number_format(($varcos),2).'</td>';}else{print '<td class="fw-bold">'.(($varcos==0)?' ':number_format( $varcos,2)).'</td>';}}
                        if ($crecos<0) {print '<td class="text-danger fw-bold">'.number_format(($crecos),0).'%</td>';}else{if ($crecos>0) {print '<td class="text-success fw-bold">'.number_format(($crecos),0).'%</td>';}else{print '<td class="fw-bold">'.(($crecos==0)?' ':number_format( $crecos,0)).'</td>';}}
                        print '</tr>';

                        print '<tr>';
                        print '<td class="fw-bold d-none">5</td>';
                        print '<td class="fw-bold">Nicaragua</td>';
                        print '<td class="fw-bold text-center">'.(($can1nic==0)?' ':number_format( $can1nic,0)).'</td>';
                        print '<td>'.(($ano1nic==0)?' ':"D.".number_format( $ano1nic,2)).'</td>';
                        print '<td class="fw-bold text-center">'.(($can2nic==0)?' ':number_format( $can2nic,0)).'</td>';
                        print '<td>'.(($ano2nic==0)?' ':"D.".number_format( $ano2nic,2)).'</td>';
                        if ($varnic<0) {print '<td class="text-danger fw-bold">D.'.number_format(($varnic),2).'</td>';}else{if ($varnic>0) {print '<td class="text-success fw-bold">D.'.number_format(($varnic),2).'</td>';}else{print '<td class="fw-bold">'.(($varnic==0)?' ':number_format( $varnic,2)).'</td>';}}
                        if ($crenic<0) {print '<td class="text-danger fw-bold">'.number_format(($crenic),0).'%</td>';}else{if ($crenic>0) {print '<td class="text-success fw-bold">'.number_format(($crenic),0).'%</td>';}else{print '<td class="fw-bold">'.(($crenic==0)?' ':number_format( $crenic,0)).'</td>';}}
                        print '</tr>';

                        print '<tr>';
                        print '<td class="fw-bold d-none">6</td>';
                        print '<td class="fw-bold">Rep. Dominicana</td>';
                        print '<td class="fw-bold text-center">'.(($can1rep==0)?' ':number_format( $can1rep,0)).'</td>';
                        print '<td>'.(($ano1rep==0)?' ':"D.".number_format( $ano1rep,2)).'</td>';
                        print '<td class="fw-bold text-center">'.(($can2rep==0)?' ':number_format( $can2rep,0)).'</td>';
                        print '<td>'.(($ano2rep==0)?' ':"D.".number_format( $ano2rep,2)).'</td>';
                        if ($varrep<0) {print '<td class="text-danger fw-bold">D.'.number_format(($varrep),2).'</td>';}else{if ($varrep>0) {print '<td class="text-success fw-bold">D.'.number_format(($varrep),2).'</td>';}else{print '<td class="fw-bold">'.(($varrep==0)?' ':number_format( $varrep,2)).'</td>';}}
                        if ($crerep<0) {print '<td class="text-danger fw-bold">'.number_format(($crerep),0).'%</td>';}else{if ($crerep>0) {print '<td class="text-success fw-bold">'.number_format(($crerep),0).'%</td>';}else{print '<td class="fw-bold">'.(($crerep==0)?' ':number_format( $crerep,0)).'</td>';}}
                        print '</tr>';
                        $valorAno1=[round($ano1hon,2),round($ano1gua,2),round($ano1sal,2),round($ano1cos,2),round($ano1nic,2),round($ano1rep,2)];  
                        $valorAno2=[round($ano2hon,2),round($ano2gua,2),round($ano2sal,2),round($ano2cos,2),round($ano2nic,2),round($ano2rep,2)];
                    }
                        if ( $validator!="true") {
                          print '<tr>';
                          print '<td class="fw-bold d-none">99999</td>';
                          print '<td class="fw-bold">TOTAL FINAL</td>';
                          print '<td class="fw-bold text-center">'.(($can1tot==0)?' ':number_format( $can1tot,0)).'</td>';
                          print '<td>'.(($ano1tot==0)?' ':"D.".number_format( $ano1tot,2)).'</td>';
                          print '<td class="fw-bold text-center">'.(($can2tot==0)?' ':number_format( $can2tot,0)).'</td>';
                          print '<td>'.(($ano2tot==0)?' ':"D.".number_format( $ano2tot,2)).'</td>';
                          if ($vartot<0) {print '<td class="text-danger fw-bold">D.'.number_format(($vartot),2).'</td>';}else{if ($vartot>0) {print '<td class="text-success fw-bold">D.'.number_format(($vartot),2).'</td>';}else{print '<td class="fw-bold">'.(($vartot==0)?' ':number_format( $vartot,2)).'</td>';}}
                          if ($cretot<0) {print '<td class="text-danger fw-bold">'.number_format(($cretot),0).'%</td>';}else{if ($cretot>0) {print '<td class="text-success fw-bold">'.number_format(($cretot),0).'%</td>';}else{print '<td class="fw-bold">'.(($cretot==0)?' ':number_format( $cretot,2)).'</td>';}}
                          print '</tr>';
                        }               
                    ?>
                    
                </tbody>                
              </table>
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
        if (<?php echo $marcaFiltro;?>==0) {
         <?php  echo 'window.location.replace("/'.$_SESSION['DEV'].'LovablePHP/PRG/ZFA/ZLO0003PA.php")';  ?>
        }
        $("#cbbMes").val("<?php echo $mesfiltro; ?>");
        $("#cbbMarca").val(<?php echo $marcaFiltro;  ?>); 
        $("#cbbAno").val(<?php echo $anofiltro;  ?>); 
        $("#daterangepicker").val("<?php echo $labelSelect;  ?>"); 
        
          $("#cbbMarca, #cbbAno, #cbbMes").change(function() {
              $("#formFiltros").submit();
          });
            
    $("#myTableMarcas").DataTable( {
        stateSave: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },

        columns: [
            {},
            {},
            {},
            {},
            {},
            {},
            {},
            {}
        ],
        "ordering": false,
        "pageLength": 100,
        "columnDefs": [
            {
                target: 0,
                visible: false,
                searchable: true,
            },
            {
                target: 1,
                visible: true,
                searchable: true,
            },
            {
                target: 2,
                visible: true,
                searchable: false,
            },
            {
                target: 3,
                visible: true,
                searchable: false,
            },
            {
                target: 4,
                visible: true,
                searchable: false,
            },
            {
                target: 5,
                visible: true,
                searchable: false,
            },
            ],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fa-solid fa-file-excel"></i> <b >Enviar a Excel</b>',
                className: "btn btn-success text-light fs-6 ",
                exportOptions: {
                    columns: [1,2,3,4,5,6,7]
                },
                title: 'ReporteMarcas',
                messageTop:'MARCA: '+$('#cbbMarca option:selected').text()+'                                                                                                                                                                                                                   <?php echo $labelSelect; ?>',
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
                    
                    $('c[r=A1] t', sheet).text( 'COMPARATIVO VENTAS DE MARCAS POR PAÍS' );
                    $('row:eq(0) c', sheet).attr( 's', greyBoldCentered );
                    $('row:eq(1) c', sheet).attr( 's', 7 );
                    for (let index = 3; index <= 9; index++) {
                      
                      if (($('row:eq('+index+') c[r^="G"]', sheet).text()*1<0)) {
                        $('row:eq('+index+') c[r^="G"]', sheet).attr( 's', textred2 );  //ROJO
                      }else{
                        $('row:eq('+index+') c[r^="G"]', sheet).attr( 's', textgreen2 );  //VERDE
                      }
                    }
                    for (let index = 3; index <= 9; index++) {
                     
                      if (parseFloat(($('row:eq('+index+') c[r^="F"]', sheet).text()).slice(2))<0) {
                        $('row:eq('+index+') c[r^="F"]', sheet).attr( 's', textred1 );  //ROJO
                      }else{
                        $('row:eq('+index+') c[r^="F"]', sheet).attr( 's', textgreen1 );  //VERDE
                      }
                    }

                    var tagName = sSh.getElementsByTagName('sz');
                    for (i = 0; i < tagName.length; i++) {
                      tagName[i].setAttribute("val", "13");
                    }
                    
 
                  }
                  
            }
        ]
    });


            //GRAFICAS---------------------------------------------------------------       
             //PAISES AÑO1 VS AÑO2
          var chart = Highcharts.chart('container2', {

        chart: {
            type: 'column'
        },
        lang: {      
              viewFullscreen:"Ver en pantalla completa",
              exitFullscreen:"Salir de pantalla completa",
              downloadJPEG:"Descargar imagen JPEG",
              downloadPDF:"Descargar en PDF",
          },
          exporting: {
              buttons: {
                  contextButton: {
                      menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
                  }
              }
          },
        title: {
            text: 'Año <?php echo $anofiltro; ?> vs Año <?php echo $anofiltro-1; ?>',
            margin: 50
        },

        xAxis: {
            categories: <?php echo json_encode($paisesLabel); ?>,
            labels: {
                x: -10
            }
        },

        yAxis: {
            allowDecimals: false,
            title: {
                text: ' '
            }
        },
        credits: {
          enabled: false
        },
        series: [{
            name: 'Año <?php echo $anofiltro; ?>',
            data: <?php echo json_encode($valorAno1); ?>,
        }, {
          name: 'Año <?php echo $anofiltro-1; ?>',
            data: <?php echo json_encode($valorAno2); ?>, 
        },],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        align: 'center',
                        verticalAlign: 'bottom',
                        layout: 'horizontal'
                    },
                    yAxis: {
                        labels: {
                            align: 'left',
                            x: 0,
                            y: -5
                        },
                        title: {
                            text: null
                        }
                    },
                    subtitle: {
                        text: null
                    },
                    credits: {
                        enabled: false
                    }
                }
            }]
        }
        });

        if (<?php echo $validator;?>==true) {
           $("#grafica").addClass("d-none");
        }

    });
  </script>
  <script src="../../assets/vendors/monthpicker/picker.js"></script>
    <script src="../../assets/vendors/monthpicker/calendars.min.js"></script>
  </body>

</html>