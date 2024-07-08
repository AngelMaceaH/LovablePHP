<?php

// Función para obtener el nombre del mes dado su número
function obtenerNombreMes($numeroMes) {
    $nombresMes = array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');
    return $nombresMes[$numeroMes - 1];
}

// Función para obtener el nombre abreviado del mes dado su número
function obtenerNombreMesAbr($numeroMes) {
    $nombresMes = array('Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic');
    return $nombresMes[$numeroMes - 1];
}

// Función para obtener el número del mes dado su nombre
function obtenerNumeroMes($nombre_mes) {
    $nombres_mes = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
    $numero_mes = array_search($nombre_mes, $nombres_mes) + 1;
    return $numero_mes;
}

// Obteniendo el mes y año actual
$mes_actual=date("m");
$ano_actual=date("Y");

// Obteniendo los nombres de los meses y los números de los meses
$mesLabel1 = (isset($_SESSION['mes1']) && $_SESSION['mes1']!='')? obtenerNombreMesAbr(obtenerNumeroMes($_SESSION['mes1'])):  obtenerNombreMesAbr(1);
$mesLabel2 = (isset($_SESSION['mes2']) && $_SESSION['mes2']!=' ')? obtenerNombreMesAbr(obtenerNumeroMes($_SESSION['mes2'])):  obtenerNombreMesAbr($mes_actual);
$mesNum1=(isset($_SESSION['mes1']) && $_SESSION['mes1']!='')? obtenerNumeroMes($_SESSION['mes1']):  '01';
$mesNum2=(isset($_SESSION['mes2']) && $_SESSION['mes2']!='')? obtenerNumeroMes($_SESSION['mes2']):  $mes_actual;

// Obteniendo los años
$ano1 = (isset($_SESSION['ano1']) && $_SESSION['ano1']!='')? $_SESSION['ano1']:  $ano_actual;
$ano2 = (isset($_SESSION['ano2']) && $_SESSION['ano2']!='')? $_SESSION['ano2']:  $ano_actual;

// Creando la etiqueta de selección
$labelSelect= "$mesLabel1 $ano1 - $mesLabel2 $ano2";

// Obteniendo el mes y año del filtro
$mesfiltro=$mesNum2;
$anofiltro=isset($_SESSION['anofiltro'])? $_SESSION['anofiltro']: $ano_actual;

// Obteniendo la marca del filtro
$marcaFiltro=isset($_SESSION['marcaFiltro'])? $_SESSION['marcaFiltro']: 100;

// Asegurándose de que el mes del filtro tenga dos dígitos
if (strlen($mesfiltro)==1) {
    $mesfiltro="0".$mesfiltro;
}
?>
<script>
$(document).ready(function() {
  var urlComarc = '/API.LovablePHP/ZLO0003P/ListComarc/';
  var responseComarc = ajaxRequest(urlComarc);

  //LLENADO DE MARCAS
  if (responseComarc.code == 200) {
    for (let i = 0; i < responseComarc.data.length; i++) {
      $("#cbbMarca").append(' <option value=' + responseComarc.data[i]['DESCO1'] + ' selected>' +
        responseComarc.data[i]['DESDES'] + '</option>');
    }
  }
  if (<?php echo $marcaFiltro;?> == 0) {
    <?php  echo 'window.location.replace("/'.$_SESSION['DEV'].'LovablePHP/PRG/ZFA/ZLO0003PA.php")';  ?>
  }
  $("#cbbMes").val("<?php echo $mesfiltro; ?>");
  $("#cbbMarca").val(<?php echo $marcaFiltro;  ?>);
  $("#cbbAno").val(<?php echo $anofiltro;  ?>);
  $("#daterangepicker").val("<?php echo $labelSelect;  ?>");

  $("#cbbMarca, #cbbAno, #cbbMes").change(function() {
    $("#formFiltros").submit();
  });
  //LLENADO TABLA
  var ano2 = '<?php echo $ano2; ?>';
  var mesNum1 = '<?php echo $mesNum1; ?>';
  var mesNum2 = '<?php echo $mesNum2; ?>';
  var marcaFiltro = '<?php echo $marcaFiltro; ?>';
  var urlMarcas = '/API.LovablePHP/ZLO0003P/ListMarcas/?ano=' + ano2 + '&mes=' + mesNum1 +
    '&mes2=' + mesNum2 + '&marca=' + marcaFiltro + '';
  var responseMarcas = ajaxRequest(urlMarcas);
  const paisesAsig = [];
  const paisesLabel = [];
  let usuario = '<?php echo $_SESSION["CODUSU"];?>';
  const urlVal = "http://172.16.15.20/API.LovablePHP/Users/FindAgrupP/?codusu=" + usuario + "";
  var responsePaises = ajaxRequest(urlVal);
  if (responsePaises.code == 200) {
    responsePaises.data.forEach(element => {
      paisesAsig.push(element['CODIGO']);
      paisesLabel.push(element['DESCRI']);
    });
    if (responsePaises.acceso==0) {
                    $("#body-page").empty();
                    $("#body-page").append('<div class="text-center p-5 fs-3 m-5" style="height:600px;"><div class="border border-1 rounded p-5 m-5"><i class="fa-solid fa-question fa-fade fa-2xl mb-4"></i><br /> No hay contenido para mostrar.</div></div>');
    }
  }
  //var paisesLabel = ['Honduras', 'Guatemala', 'El Salvador', 'Nicaragua', 'Costa Rica', 'Rep. Dominicana'];
  var valorAno1 = [];
  var valorAno2 = [];
  var validator = true;
  if (responseMarcas.code == 200) {
    validator = false;
    ano1hon = 0;
    ano2hon = 0;
    varhon = 0;
    crehon = 0;
    can1hon = 0;
    can2hon = 0;
    ano1gua = 0;
    ano2gua = 0;
    vargua = 0;
    cregua = 0;
    can1gua = 0;
    can2gua = 0;
    ano1sal = 0;
    ano2sal = 0;
    varsal = 0;
    cresal = 0;
    can1sal = 0;
    can2sal = 0;
    ano1cos = 0;
    ano2cos = 0;
    varcos = 0;
    crecos = 0;
    can1cos = 0;
    can2cos = 0;
    ano1nic = 0;
    ano2nic = 0;
    varnic = 0;
    crenic = 0;
    can1nic = 0;
    can2nic = 0;
    ano1rep = 0;
    ano2rep = 0;
    varrep = 0;
    crerep = 0;
    can1rep = 0;
    can2rep = 0;
    ano1tot = 0;
    ano2tot = 0;
    vartot = 0;
    cretot = 0;
    can1tot = 0;
    can2tot = 0;
    for (let i = 0; i < responseMarcas.data.length; i++) {
      //HONDURAS
      if (paisesAsig.includes('11')) {
        ano1hon = (responseMarcas.data[i]['HONVALANO1'] != 0) ? (responseMarcas.data[i]['HONVALANO1']) : 0;
        ano2hon = (responseMarcas.data[i]['HONVALANO2'] != 0) ? (responseMarcas.data[i]['HONVALANO2']) : 0;
        can1hon = (responseMarcas.data[i]['HONCANANO1'] != 0) ? (responseMarcas.data[i]['HONCANANO1']) : 0;
        can2hon = (responseMarcas.data[i]['HONCANANO2'] != 0) ? (responseMarcas.data[i]['HONCANANO2']) : 0;
        varhon = ano1hon - ano2hon;
        crehon = (ano1hon != 0 && ano2hon != 0) ? parseFloat(((ano1hon / ano2hon) - 1) * 100) : 0;
      }
      if (paisesAsig.includes('10')) {
        //GUATEMALA
        ano1gua = (responseMarcas.data[i]['GUAVALANO1'] != 0) ? (responseMarcas.data[i]['GUAVALANO1']) : 0;
        ano2gua = (responseMarcas.data[i]['GUAVALANO2'] != 0) ? (responseMarcas.data[i]['GUAVALANO2']) : 0;
        can1gua = (responseMarcas.data[i]['GUACANANO1'] != 0) ? (responseMarcas.data[i]['GUACANANO1']) : 0;
        can2gua = (responseMarcas.data[i]['GUACANANO2'] != 0) ? (responseMarcas.data[i]['GUACANANO2']) : 0;
        vargua = ano1gua - ano2gua;
        cregua = (ano1gua != 0 && ano2gua != 0) ? parseFloat(((ano1gua / ano2gua) - 1) * 100) : 0;
      }
      if (paisesAsig.includes('12')) {
        //EL SALVADOR
        ano1sal = (responseMarcas.data[i]['SALVALANO1'] != 0) ? (responseMarcas.data[i]['SALVALANO1']) : 0;
        ano2sal = (responseMarcas.data[i]['SALVALANO2'] != 0) ? (responseMarcas.data[i]['SALVALANO2']) : 0;
        can1sal = (responseMarcas.data[i]['SALCANANO1'] != 0) ? (responseMarcas.data[i]['SALCANANO1']) : 0;
        can2sal = (responseMarcas.data[i]['SALCANANO2'] != 0) ? (responseMarcas.data[i]['SALCANANO2']) : 0;
        varsal = ano1sal - ano2sal;
        cresal = (ano1sal != 0 && ano2sal != 0) ? parseFloat(((ano1sal / ano2sal) - 1) * 100) : 0;
      }
      if (paisesAsig.includes('13')) {
        //COSTA RICA
        ano1cos = (responseMarcas.data[i]['COSVALANO1'] != 0) ? (responseMarcas.data[i]['COSVALANO1']) : 0;
        ano2cos = (responseMarcas.data[i]['COSVALANO2'] != 0) ? (responseMarcas.data[i]['COSVALANO2']) : 0;
        can1cos = (responseMarcas.data[i]['COSCANANO1'] != 0) ? (responseMarcas.data[i]['COSCANANO1']) : 0;
        can2cos = (responseMarcas.data[i]['COSCANANO2'] != 0) ? (responseMarcas.data[i]['COSCANANO2']) : 0;
        varcos = ano1cos - ano2cos;
        crecos = (ano1cos != 0 && ano2cos != 0) ? parseFloat(((ano1cos / ano2cos) - 1) * 100) : 0;
      }
      if (paisesAsig.includes('16')) {
        //NICARAGUA
        ano1nic = (responseMarcas.data[i]['NICVALANO1'] != 0) ? (responseMarcas.data[i]['NICVALANO1']) : 0;
        ano2nic = (responseMarcas.data[i]['NICVALANO2'] != 0) ? (responseMarcas.data[i]['NICVALANO2']) : 0;
        can1nic = (responseMarcas.data[i]['NICCANANO1'] != 0) ? (responseMarcas.data[i]['NICCANANO1']) : 0;
        can2nic = (responseMarcas.data[i]['NICCANANO2'] != 0) ? (responseMarcas.data[i]['NICCANANO2']) : 0;
        varnic = ano1nic - ano2nic;
        crenic = (ano1nic != 0 && ano2nic != 0) ? parseFloat(((ano1nic / ano2nic) - 1) * 100) : 0;
      }
      if (paisesAsig.includes('15')) {
        //REP. DOMINICANA
        ano1rep = (responseMarcas.data[i]['REPVALANO1'] != 0) ? (responseMarcas.data[i]['REPVALANO1']) : 0;
        ano2rep = (responseMarcas.data[i]['REPVALANO2'] != 0) ? (responseMarcas.data[i]['REPVALANO2']) : 0;
        can1rep = (responseMarcas.data[i]['REPCANANO1'] != 0) ? (responseMarcas.data[i]['REPCANANO1']) : 0;
        can2rep = (responseMarcas.data[i]['REPCANANO2'] != 0) ? (responseMarcas.data[i]['REPCANANO2']) : 0;
        varrep = ano1rep - ano2rep;
        crerep = (ano1rep != 0 && ano2rep != 0) ? parseFloat(((ano1rep / ano2rep) - 1) * 100) : 0;
      }

      //TOTALES
      ano1tot = parseFloat(ano1hon) + parseFloat(ano1gua) + parseFloat(ano1sal) + parseFloat(ano1cos) +
        parseFloat(ano1nic) + parseFloat(ano1rep);
      ano2tot = parseFloat(ano2hon) + parseFloat(ano2gua) + parseFloat(ano2sal) + parseFloat(ano2cos) +
        parseFloat(ano2nic) + parseFloat(ano2rep);
      can1tot = parseFloat(can1hon) + parseFloat(can1gua) + parseFloat(can1sal) + parseFloat(can1cos) +
        parseFloat(can1nic) + parseFloat(can1rep);
      can2tot = parseFloat(can2hon) + parseFloat(can2gua) + parseFloat(can2sal) + parseFloat(can2cos) +
        parseFloat(can2nic) + parseFloat(can2rep);
      vartot = parseFloat(ano1tot) - parseFloat(ano2tot);
      cretot = (parseFloat(ano1tot) != 0 && parseFloat(ano2tot) != 0) ? parseFloat(((parseFloat(ano1tot) /
        parseFloat(ano2tot)) - 1) * 100) : 0;

      paisesAsig.forEach(element => {
        if (element == '11') {
          valorAno1.push(parseFloat(ano1hon));
          valorAno2.push(parseFloat(ano2hon));
        }
        if (element == '10') {
          valorAno1.push(parseFloat(ano1gua));
          valorAno2.push(parseFloat(ano2gua));
        }
        if (element == '12') {
          valorAno1.push(parseFloat(ano1sal));
          valorAno2.push(parseFloat(ano2sal));
        }
        if (element == '13') {
          valorAno1.push(parseFloat(ano1cos));
          valorAno2.push(parseFloat(ano2cos));
        }
        if (element == '16') {
          valorAno1.push(parseFloat(ano1nic));
          valorAno2.push(parseFloat(ano2nic));
        }
        if (element == '15') {
          valorAno1.push(parseFloat(ano1rep));
          valorAno2.push(parseFloat(ano2rep));
        }
      });
      if (paisesAsig.includes('11')) {
        $("#myTableMarcasPaisesBody").append(`<tr id="tr${i}">`);
        //HONDURAS
        if (parseFloat(varhon) < 0) {
          varhon = "<td class='fw-bold  text-danger text-end'>D." + varhon.toLocaleString('es-419', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
          }) + "</td>";
        } else {
          varhon = "<td class='fw-bold  text-success text-end'>D." + varhon.toLocaleString('es-419', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
          }) + "</td>";
        }
        if (parseFloat(crehon) < 0) {
          crehon = "<td class='fw-bold  text-danger text-end'>" + crehon.toLocaleString('es-419', {
            maximumFractionDigits: 0
          }) + "%</td>";
        } else {
          crehon = "<td class='fw-bold  text-success text-end'>" + crehon.toLocaleString('es-419', {
            maximumFractionDigits: 0
          }) + "%</td>";
        }
        $('#tr' + i + '').append("<td class='fw-bold'>1</td>");
        $('#tr' + i + '').append("<td class='fw-bold text-start'>Honduras</td>");
        $('#tr' + i + '').append("<td class='fw-bold text-end'>" + parseFloat(can1hon).toLocaleString(
          'es-419') + "</td>");
        $('#tr' + i + '').append("<td class='text-end'>D." + parseFloat(ano1hon).toLocaleString('es-419', {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2
        }) + "</td>");
        $('#tr' + i + '').append("<td class='fw-bold text-end'>" + parseFloat(can2hon).toLocaleString(
          'es-419') + "</td>");
        $('#tr' + i + '').append("<td class='text-end'>D." + parseFloat(ano2hon).toLocaleString('es-419', {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2
        }) + "</td>");
        $('#tr' + i + '').append(varhon);
        $('#tr' + i + '').append(crehon);
        $("#myTableMarcasPaisesBody").append(`</tr>`);
      }
      if (paisesAsig.includes('10')) {
        $("#myTableMarcasPaisesBody").append(`<tr id="ta${i}">`);
        //GUATEMALA
        if (parseFloat(vargua) < 0) {
          vargua = "<td class='fw-bold  text-danger text-end'>D." + vargua.toLocaleString('es-419', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
          }) + "</td>";
        } else {
          vargua = "<td class='fw-bold  text-success text-end'>D." + vargua.toLocaleString('es-419', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
          }) + "</td>";
        }
        if (parseFloat(cregua) < 0) {
          cregua = "<td class='fw-bold  text-danger text-end'>" + cregua.toLocaleString('es-419', {
            maximumFractionDigits: 0
          }) + "%</td>";
        } else {
          cregua = "<td class='fw-bold  text-success text-end'>" + cregua.toLocaleString('es-419', {
            maximumFractionDigits: 0
          }) + "%</td>";
        }
        $('#ta' + i + '').append("<td class='fw-bold'>1</td>");
        $('#ta' + i + '').append("<td class='fw-bold text-start'>Guatemala</td>");
        $('#ta' + i + '').append("<td class='fw-bold text-end'>" + parseFloat(can1gua).toLocaleString(
          'es-419') + "</td>");
        $('#ta' + i + '').append("<td class='text-end'>D." + parseFloat(ano1gua).toLocaleString('es-419', {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2
        }) + "</td>");
        $('#ta' + i + '').append("<td class='fw-bold text-end'>" + parseFloat(can2gua).toLocaleString(
          'es-419') + "</td>");
        $('#ta' + i + '').append("<td class='text-end'>D." + parseFloat(ano2gua).toLocaleString('es-419', {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2
        }) + "</td>");
        $('#ta' + i + '').append(vargua);
        $('#ta' + i + '').append(cregua);
        $("#myTableMarcasPaisesBody").append(`</tr>`);
      }
      if (paisesAsig.includes('12')) {
        $("#myTableMarcasPaisesBody").append(`<tr id="tb${i}">`);
        //EL SALVADOR
        if (parseFloat(varsal) < 0) {
          varsal = "<td class='fw-bold  text-danger text-end'>D." + varsal.toLocaleString('es-419', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
          }) + "</td>";
        } else {
          varsal = "<td class='fw-bold  text-success text-end'>D." + varsal.toLocaleString('es-419', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
          }) + "</td>";
        }
        if (parseFloat(cresal) < 0) {
          cresal = "<td class='fw-bold  text-danger text-end'>" + cresal.toLocaleString('es-419', {
            maximumFractionDigits: 0
          }) + "%</td>";
        } else {
          cresal = "<td class='fw-bold  text-success text-end'>" + cresal.toLocaleString('es-419', {
            maximumFractionDigits: 0
          }) + "%</td>";
        }
        $('#tb' + i + '').append("<td class='fw-bold'>1</td>");
        $('#tb' + i + '').append("<td class='fw-bold text-start'>El Salvador</td>");
        $('#tb' + i + '').append("<td class='fw-bold text-end'>" + parseFloat(can1sal).toLocaleString(
          'es-419') + "</td>");
        $('#tb' + i + '').append("<td class='text-end'>D." + parseFloat(ano1sal).toLocaleString('es-419', {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2
        }) + "</td>");
        $('#tb' + i + '').append("<td class='fw-bold text-end'>" + parseFloat(can2sal).toLocaleString(
          'es-419') + "</td>");
        $('#tb' + i + '').append("<td class='text-end'>D." + parseFloat(ano2sal).toLocaleString('es-419', {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2
        }) + "</td>");
        $('#tb' + i + '').append(varsal);
        $('#tb' + i + '').append(cresal);
        $("#myTableMarcasPaisesBody").append(`</tr>`);
      }
      if (paisesAsig.includes('13')) {
        $("#myTableMarcasPaisesBody").append(`<tr id="tc${i}">`);
        //COSTA RICA
        if (parseFloat(varcos) < 0) {
          varcos = "<td class='fw-bold  text-danger text-end'>D." + varcos.toLocaleString('es-419', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
          }) + "</td>";
        } else {
          varcos = "<td class='fw-bold  text-success text-end'>D." + varcos.toLocaleString('es-419', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
          }) + "</td>";
        }
        if (parseFloat(crecos) < 0) {
          crecos = "<td class='fw-bold  text-danger text-end'>" + crecos.toLocaleString('es-419', {
            maximumFractionDigits: 0
          }) + "%</td>";
        } else {
          crecos = "<td class='fw-bold  text-success text-end'>" + crecos.toLocaleString('es-419', {
            maximumFractionDigits: 0
          }) + "%</td>";
        }
        $('#tc' + i + '').append("<td class='fw-bold'>1</td>");
        $('#tc' + i + '').append("<td class='fw-bold text-start'>Costa Rica</td>");
        $('#tc' + i + '').append("<td class='fw-bold text-end'>" + parseFloat(can1cos).toLocaleString(
          'es-419') + "</td>");
        $('#tc' + i + '').append("<td class='text-end'>D." + parseFloat(ano1cos).toLocaleString('es-419', {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2
        }) + "</td>");
        $('#tc' + i + '').append("<td class='fw-bold text-end'>" + parseFloat(can2cos).toLocaleString(
          'es-419') + "</td>");
        $('#tc' + i + '').append("<td class='text-end'>D." + parseFloat(ano2cos).toLocaleString('es-419', {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2
        }) + "</td>");
        $('#tc' + i + '').append(varcos);
        $('#tc' + i + '').append(crecos);
        $("#myTableMarcasPaisesBody").append(`</tr>`);
      }
      if (paisesAsig.includes('16')) {
        $("#myTableMarcasPaisesBody").append(`<tr id="tf${i}">`);
        //NICARAGUA
        if (parseFloat(varnic) < 0) {
          varnic = "<td class='fw-bold  text-danger text-end'>D." + varnic.toLocaleString('es-419', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
          }) + "</td>";
        } else {
          varnic = "<td class='fw-bold  text-success text-end'>D." + varnic.toLocaleString('es-419', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
          }) + "</td>";
        }
        if (parseFloat(crenic) < 0) {
          crenic = "<td class='fw-bold  text-danger text-end'>" + crenic.toLocaleString('es-419', {
            maximumFractionDigits: 0
          }) + "%</td>";
        } else {
          crenic = "<td class='fw-bold  text-success text-end'>" + crenic.toLocaleString('es-419', {
            maximumFractionDigits: 0
          }) + "%</td>";
        }
        $('#tf' + i + '').append("<td class='fw-bold'>1</td>");
        $('#tf' + i + '').append("<td class='fw-bold text-start'>Nicaragua</td>");
        $('#tf' + i + '').append("<td class='fw-bold text-end'>" + parseFloat(can1nic).toLocaleString(
          'es-419') + "</td>");
        $('#tf' + i + '').append("<td class='text-end'>D." + parseFloat(ano1nic).toLocaleString('es-419', {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2
        }) + "</td>");
        $('#tf' + i + '').append("<td class='fw-bold text-end'>" + parseFloat(can2nic).toLocaleString(
          'es-419') + "</td>");
        $('#tf' + i + '').append("<td class='text-end'>D." + parseFloat(ano2nic).toLocaleString('es-419', {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2
        }) + "</td>");
        $('#tf' + i + '').append(varnic);
        $('#tf' + i + '').append(crenic);
        $("#myTableMarcasPaisesBody").append(`</tr>`);
      }
      if (paisesAsig.includes('15')) {
        $("#myTableMarcasPaisesBody").append(`<tr id="tg${i}">`);
        //REP DOMINICANA
        if (parseFloat(varrep) < 0) {
          varrep = "<td class='fw-bold  text-danger text-end'>D." + varrep.toLocaleString('es-419', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
          }) + "</td>";
        } else {
          varrep = "<td class='fw-bold  text-success text-end'>D." + varrep.toLocaleString('es-419', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
          }) + "</td>";
        }
        if (parseFloat(crerep) < 0) {
          crerep = "<td class='fw-bold  text-danger text-end'>" + crerep.toLocaleString('es-419', {
            maximumFractionDigits: 0
          }) + "%</td>";
        } else {
          crerep = "<td class='fw-bold  text-success text-end'>" + crerep.toLocaleString('es-419', {
            maximumFractionDigits: 0
          }) + "%</td>";
        }
        $('#tg' + i + '').append("<td class='fw-bold'>1</td>");
        $('#tg' + i + '').append("<td class='fw-bold text-start'>Rep. Dominicana</td>");
        $('#tg' + i + '').append("<td class='fw-bold text-end'>" + parseFloat(can1rep).toLocaleString(
          'es-419') + "</td>");
        $('#tg' + i + '').append("<td class='text-end'>D." + parseFloat(ano1rep).toLocaleString('es-419', {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2
        }) + "</td>");
        $('#tg' + i + '').append("<td class='fw-bold text-end'>" + parseFloat(can2rep).toLocaleString(
          'es-419') + "</td>");
        $('#tg' + i + '').append("<td class='text-end'>D." + parseFloat(ano2rep).toLocaleString('es-419', {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2
        }) + "</td>");
        $('#tg' + i + '').append(varrep);
        $('#tg' + i + '').append(crerep);
        $("#myTableMarcasPaisesBody").append(`</tr>`);
      }
      $("#myTableMarcasPaisesBody").append(`<tr id="tj${i}">`);
      //TOTALES
      if (parseFloat(vartot) < 0) {
        vartot = "<td class='fw-bold  text-danger text-end'>D." + vartot.toLocaleString('es-419', {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2
        }) + "</td>";
      } else {
        vartot = "<td class='fw-bold  text-success text-end'>D." + vartot.toLocaleString('es-419', {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2
        }) + "</td>";
      }
      if (parseFloat(cretot) < 0) {
        cretot = "<td class='fw-bold  text-danger text-end'>" + cretot.toLocaleString('es-419', {
          maximumFractionDigits: 0
        }) + "%</td>";
      } else {
        cretot = "<td class='fw-bold  text-success text-end'>" + cretot.toLocaleString('es-419', {
          maximumFractionDigits: 0
        }) + "%</td>";
      }
      $('#tj' + i + '').append("<td class='fw-bold'>1</td>");
      $('#tj' + i + '').append("<td class='fw-bold text-start'>TOTAL FINAL</td>");
      $('#tj' + i + '').append("<td class='fw-bold text-end'>" + parseFloat(can1tot).toLocaleString(
        'es-419') + "</td>");
      $('#tj' + i + '').append("<td class='text-end'>D." + parseFloat(ano1tot).toLocaleString('es-419', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      }) + "</td>");
      $('#tj' + i + '').append("<td class='fw-bold text-end'>" + parseFloat(can2tot).toLocaleString(
        'es-419') + "</td>");
      $('#tj' + i + '').append("<td class='text-end'>D." + parseFloat(ano2tot).toLocaleString('es-419', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      }) + "</td>");
      $('#tj' + i + '').append(vartot);
      $('#tj' + i + '').append(cretot);
      $("#myTableMarcasPaisesBody").append(`</tr>`);
    }
  }

  $("#myTableMarcasPaises").DataTable({
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
    },

    "ordering": false,
    "pageLength": 100,
    "columnDefs": [{
      target: 0,
      visible: false,
      searchable: true,
    }, ],
    dom: 'Bfrtip',
    buttons: [{
      extend: 'excelHtml5',
      text: '<i class="fa-solid fa-file-excel"></i> <b >Enviar a Excel</b>',
      className: "btn btn-success text-light fs-6 ",
      exportOptions: {
        columns: [1, 2, 3, 4, 5, 6, 7]
      },
      title: 'ReporteMarcas',
      messageTop: 'MARCA: ' + $('#cbbMarca option:selected').text() +
        '                                                                            <?php echo $labelSelect; ?>                                                                        Moneda: Dólares',
      customizeData: function(data) {
        data.body.forEach(function(row, index) {
          if (row[2] && row[2].startsWith('D.')) {
            row[2] = row[2].substring(2);
          }
          if (row[4] && row[4].startsWith('D.')) {
            row[4] = row[4].substring(2);
          }
          if (row[5] && row[5].startsWith('D.')) {
            row[5] = row[5].substring(2);
          }
        });
      },
      customize: function(xlsx) {
        var sheet = xlsx.xl.worksheets['sheet1.xml'];
        var sSh = xlsx.xl['styles.xml'];
        var lastXfIndex = $('cellXfs xf', sSh).length - 1;
        var lastFontIndex = $('fonts font', sSh).length - 1;
        var i;
        var y;
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
        sSh.childNodes[0].childNodes[0].innerHTML += n1 + n2;
        sSh.childNodes[0].childNodes[1].innerHTML += f1 + f2;
        sSh.childNodes[0].childNodes[5].innerHTML += s1 + s2 + s3 + s4 + s5 + s6 +
          s7 + s8;

        var fourDecPlaces = lastXfIndex + 1;
        var greyBoldCentered = lastXfIndex + 2;
        var twoDecPlacesBold = lastXfIndex + 3;
        var greyBoldWrapText = lastXfIndex + 4;
        var textred1 = lastXfIndex + 5;
        var textgreen1 = lastXfIndex + 6;
        var textred2 = lastXfIndex + 7;
        var textgreen2 = lastXfIndex + 8;

        $('c[r=A1] t', sheet).text('COMPARATIVO VENTAS DE MARCAS POR PAÍS');
        $('row:eq(0) c', sheet).attr('s', greyBoldCentered);
        $('row:eq(1) c', sheet).attr('s', 7);
        for (let index = 3; index <= 9; index++) {

          if (($('row:eq(' + index + ') c[r^="G"]', sheet).text() * 1 < 0)) {
            $('row:eq(' + index + ') c[r^="G"]', sheet).attr('s', textred2); //ROJO
          } else {
            $('row:eq(' + index + ') c[r^="G"]', sheet).attr('s',
              textgreen2); //VERDE
          }
        }
        for (let index = 3; index <= 9; index++) {

          if (parseFloat($('row:eq(' + index + ') c[r^="F"]', sheet).text()) < 0) {
            $('row:eq(' + index + ') c[r^="F"]', sheet).attr('s', textred1); //ROJO
          } else {
            $('row:eq(' + index + ') c[r^="F"]', sheet).attr('s', textgreen1); //VERDE
          }
        }
        var tagName = sSh.getElementsByTagName('sz');
        for (i = 0; i < tagName.length; i++) {
          tagName[i].setAttribute("val", "13");
        }


      }

    }]
  });

  //LLENADO DE TABLA TIENDAS
  var urlMarcas2 = '/API.LovablePHP/ZLO0003P/ListMarcasTiendas/?ano=' + ano2 + '&mes=' +
    mesNum1 + '&mes2=' + mesNum2 + '&marca=' + marcaFiltro + '';
  var responseTiendas = ajaxRequest(urlMarcas2);
  var rows = "";
  var tiendasBody = $("#myTableMarcasTiendasBody");
  var tiendasValores = []
  var tiendasLabel = [];
  var tiendasAno1 = [];
  var tiendasAno2 = [];
  var validator2 = true;
  if (responseTiendas.code == 200) {
    let urlTiendas = '/API.LovablePHP/Users/FindAgrupT/?codusu=' + usuario + '';
    let responseTiendasAsig = ajaxRequest(urlTiendas);
    var comcods = responseTiendasAsig.data.map(element => element.COMCOD);
    var filteredData = responseTiendas.data.filter(element => comcods.includes(element.CODCIA));
    responseTiendas.data = filteredData;
    validator2 = false;
    let totund1 = 0;
    let totund2 = 0;
    let totval1 = 0;
    let totval2 = 0;
    for (let i = 0; i < responseTiendas.data.length; i++) {
      ano1hon = (responseTiendas.data[i]['HONVALANO1'] != 0) ? (responseTiendas.data[i]['HONVALANO1']) : 0;
      ano2hon = (responseTiendas.data[i]['HONVALANO2'] != 0) ? (responseTiendas.data[i]['HONVALANO2']) : 0;
      can1hon = (responseTiendas.data[i]['HONCANANO1'] != 0) ? (responseTiendas.data[i]['HONCANANO1']) : 0;
      can2hon = (responseTiendas.data[i]['HONCANANO2'] != 0) ? (responseTiendas.data[i]['HONCANANO2']) : 0;
      varhon = ano1hon - ano2hon;
      crehon = (ano1hon != 0 && ano2hon != 0) ? parseFloat(((ano1hon / ano2hon) - 1) * 100) : 0;
      if (parseFloat(varhon) < 0) {
        varhon = "<td class='fw-bold  text-danger text-end'>D." + varhon.toLocaleString('es-419', {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2
        }) + "</td>";
      } else {
        varhon = "<td class='fw-bold  text-success text-end'>D." + varhon.toLocaleString('es-419', {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2
        }) + "</td>";
      }
      if (parseFloat(crehon) < 0) {
        crehon = "<td class='fw-bold  text-danger text-end'>" + crehon.toLocaleString('es-419', {
          maximumFractionDigits: 0
        }) + "%</td>";
      } else {
        crehon = "<td class='fw-bold  text-success text-end'>" + crehon.toLocaleString('es-419', {
          maximumFractionDigits: 0
        }) + "%</td>";
      }
      tiendasValores.push({
        "CIA": responseTiendas.data[i]['NOMCIA'],
        "ANO1": parseFloat(ano1hon),
        "ANO2": parseFloat(ano2hon)
      });
      totund1 += parseFloat(can1hon);
      totund2 += parseFloat(can2hon);
      totval1 += parseFloat(ano1hon);
      totval2 += parseFloat(ano2hon);
      rows += "<tr>";
      rows += "<td>" + responseTiendas.data[i]['CODCIA'] + "</td>";
      rows += "<td class='text-start'>" + responseTiendas.data[i]['NOMCIA'] + "</td>";
      rows += "<td class='text-end'>" + parseFloat(can1hon).toLocaleString('es-419') + "</td>";
      rows += "<td class='text-end'>D." + parseFloat(ano1hon).toLocaleString('es-419', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      }) + "</td>";
      rows += "<td class='text-end'>" + parseFloat(can2hon).toLocaleString('es-419') + "</td>";
      rows += "<td class='text-end'>D." + parseFloat(ano2hon).toLocaleString('es-419', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      }) + "</td>";
      rows += varhon;
      rows += crehon;
      rows += "</tr>";
    }
    //TOTALES
    rows += `<td class='fw-bold'>1</td>`;
    rows += `<td class='fw-bold text-start'>TOTAL FINAL</td>`;
    rows += "<td class='text-end'>" + parseFloat(totund1).toLocaleString('es-419') + "</td>";
    rows += "<td class='text-end'>D." + parseFloat(totval1).toLocaleString('es-419', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }) + "</td>";
    rows += "<td class='text-end'>" + parseFloat(totund2).toLocaleString('es-419') + "</td>";
    rows += "<td class='text-end'>D." + parseFloat(totval2).toLocaleString('es-419', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }) + "</td>";
    varhon = totval1 - totval2;
    crehon = (totval1 != 0 && totval2 != 0) ? parseFloat(((totval1 / totval2) - 1) * 100) : 0;
    if (parseFloat(varhon) < 0) {
      varhon = "<td class='fw-bold  text-danger text-end'>D." + varhon.toLocaleString('es-419', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      }) + "</td>";
    } else {
      varhon = "<td class='fw-bold  text-success text-end'>D." + varhon.toLocaleString('es-419', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      }) + "</td>";
    }
    if (parseFloat(crehon) < 0) {
      crehon = "<td class='fw-bold  text-danger text-end'>" + crehon.toLocaleString('es-419', {
        maximumFractionDigits: 0
      }) + "%</td>";
    } else {
      crehon = "<td class='fw-bold  text-success text-end'>" + crehon.toLocaleString('es-419', {
        maximumFractionDigits: 0
      }) + "%</td>";
    }
    rows += varhon;
    rows += crehon;
    tiendasBody.append(rows);

  }
  tiendasValores.sort((a, b) => b.ANO1 - a.ANO1);
  for (let i = 0; i < tiendasValores.length; i++) {
    tiendasLabel.push(tiendasValores[i]['CIA']);
    tiendasAno1.push(parseFloat(tiendasValores[i]['ANO1']));
    tiendasAno2.push(parseFloat(tiendasValores[i]['ANO2']));
  }
  $("#myTableMarcasTiendas").DataTable({
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
    },

    "ordering": false,
    "pageLength": 100,
    "columnDefs": [{
      target: 0,
      visible: false,
      searchable: true,
    }, ],
    dom: 'Bfrtip',
    buttons: [{
      extend: 'excelHtml5',
      text: '<i class="fa-solid fa-file-excel"></i> <b >Enviar a Excel</b>',
      className: "btn btn-success text-light fs-6 ",
      exportOptions: {
        columns: [1, 2, 3, 4, 5, 6, 7]
      },
      title: 'ReporteMarcas',
      messageTop: 'MARCA: ' + $('#cbbMarca option:selected').text() +
        '                                                                            <?php echo $labelSelect; ?>                                                                        Moneda: Dólares',
      customizeData: function(data) {
        data.body.forEach(function(row, index) {
          if (row[2] && row[2].startsWith('D.')) {
            row[2] = row[2].substring(2);
          }
          if (row[4] && row[4].startsWith('D.')) {
            row[4] = row[4].substring(2);
          }
          if (row[5] && row[5].startsWith('D.')) {
            row[5] = row[5].substring(2);
          }
        });
      },
      customize: function(xlsx) {
        var sheet = xlsx.xl.worksheets['sheet1.xml'];
        var sSh = xlsx.xl['styles.xml'];
        var lastXfIndex = $('cellXfs xf', sSh).length - 1;
        var lastFontIndex = $('fonts font', sSh).length - 1;
        var i;
        var y;
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
        sSh.childNodes[0].childNodes[0].innerHTML += n1 + n2;
        sSh.childNodes[0].childNodes[1].innerHTML += f1 + f2;
        sSh.childNodes[0].childNodes[5].innerHTML += s1 + s2 + s3 + s4 + s5 + s6 +
          s7 + s8;

        var fourDecPlaces = lastXfIndex + 1;
        var greyBoldCentered = lastXfIndex + 2;
        var twoDecPlacesBold = lastXfIndex + 3;
        var greyBoldWrapText = lastXfIndex + 4;
        var textred1 = lastXfIndex + 5;
        var textgreen1 = lastXfIndex + 6;
        var textred2 = lastXfIndex + 7;
        var textgreen2 = lastXfIndex + 8;

        $('c[r=A1] t', sheet).text('COMPARATIVO VENTAS DE MARCAS POR TIENDAS');
        $('row:eq(0) c', sheet).attr('s', greyBoldCentered);
        $('row:eq(1) c', sheet).attr('s', 7);
        for (let index = 3; index <= 40; index++) {

          if (($('row:eq(' + index + ') c[r^="G"]', sheet).text() * 1 < 0)) {
            $('row:eq(' + index + ') c[r^="G"]', sheet).attr('s',
              textred2); //ROJO
          } else {
            $('row:eq(' + index + ') c[r^="G"]', sheet).attr('s',
              textgreen2); //VERDE
          }
        }
        for (let index = 3; index <= 40; index++) {

          if (parseFloat($('row:eq(' + index + ') c[r^="F"]', sheet).text()) < 0) {
            $('row:eq(' + index + ') c[r^="F"]', sheet).attr('s',
              textred1); //ROJO
          } else {
            $('row:eq(' + index + ') c[r^="F"]', sheet).attr('s',
              textgreen1); //VERDE
          }
        }

        var tagName = sSh.getElementsByTagName('sz');
        for (i = 0; i < tagName.length; i++) {
          tagName[i].setAttribute("val", "13");
        }


      }

    }]
  });

  //GRAFICAS---------------------------------------------------------------
  //PAISES AÑO1 VS AÑO2
  var chart = Highcharts.chart('container2', {

    chart: {
      height: 400,
      type: 'column'
    },
    lang: {
      viewFullscreen: "Ver en pantalla completa",
      exitFullscreen: "Salir de pantalla completa",
      downloadJPEG: "Descargar imagen JPEG",
      downloadPDF: "Descargar en PDF",
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
      categories: paisesLabel,
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
    plotOptions: {
      column: {
        depth: 25
      },
      series: {
        dataLabels: [{
          enabled: true,
          formatter: function() {
            return 'D.' + Highcharts.numberFormat(this.point.y, 2,
                '.', ',') +
              '</b>';
          },
        }]
      }
    },
    series: [{
      name: 'Año <?php echo $anofiltro; ?>',
      data: valorAno1,
    }, {
      name: 'Año <?php echo $anofiltro-1; ?>',
      data: valorAno2,
    }, ],

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
  //TIENDAS AÑO1 VS AÑO2
  var chart = Highcharts.chart('container3', {

    chart: {
      height: 400,
      type: 'column'
    },
    lang: {
      viewFullscreen: "Ver en pantalla completa",
      exitFullscreen: "Salir de pantalla completa",
      downloadJPEG: "Descargar imagen JPEG",
      downloadPDF: "Descargar en PDF",
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
      categories: tiendasLabel,
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
      data: tiendasAno1,
    }, {
      name: 'Año <?php echo $anofiltro-1; ?>',
      data: tiendasAno2,
    }, ],

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
  if (validator) {
    $("#grafica").addClass("d-none");
  }
  if (validator2) {
    $("#grafica2").addClass("d-none");
  }

});
</script>