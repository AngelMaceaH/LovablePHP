<script>
var usuario = '<?php echo $_SESSION["CODUSU"];?>';
var urlComarc = 'http://172.16.15.20/API.LovablePHP/ZLO0001P/ListComarc/?usuario=' + usuario + '';
var responseComarc = ajaxRequest(urlComarc);


var fechafiltro = '<?php echo $fechafiltro;?>';
var compfiltro = '<?php echo $_SESSION['CompFiltro'];?>';
var case1 = <?php echo $_SESSION['filtro'];?>;
var url1 = "",
    url2 = "",
    url3 = "";

switch (case1) {
    case 1:
        var url1 = 'http://172.16.15.20/API.LovablePHP/ZLO0001P/ListUnidades1/?fechaFiltro=' + fechafiltro +
            '&compFiltro=' + compfiltro + '&usuario=' + usuario + '&case=' + case1 + '&vend=1';
        var url2 = 'http://172.16.15.20/API.LovablePHP/ZLO0001P/ListUnidades2/?fechaFiltro=' + fechafiltro +
            '&compFiltro=' + compfiltro + '&usuario=' + usuario + '&case=' + case1 + '&vend=1';
        var url3 = 'http://172.16.15.20/API.LovablePHP/ZLO0001P/ListUnidades3/?fechaFiltro=' + fechafiltro +
            '&compFiltro=' + compfiltro + '&usuario=' + usuario + '&case=' + case1 + '&vend=1';
        break;
    case 2:
        var url1 = 'http://172.16.15.20/API.LovablePHP/ZLO0001P/ListTransacciones1/?fechaFiltro=' + fechafiltro +
            '&compFiltro=' + compfiltro + '&usuario=' + usuario + '&case=' + case1 + '&vend=1';
        var url2 = 'http://172.16.15.20/API.LovablePHP/ZLO0001P/ListTransacciones2/?fechaFiltro=' + fechafiltro +
            '&compFiltro=' + compfiltro + '&usuario=' + usuario + '&case=' + case1 + '&vend=1';
        break;
    default:
        var url1 = 'http://172.16.15.20/API.LovablePHP/ZLO0001P/ListValores1/?fechaFiltro=' + fechafiltro +
            '&compFiltro=' + compfiltro + '&usuario=' + usuario + '&case=' + case1 + '&vend=1';
        var url2 = 'http://172.16.15.20/API.LovablePHP/ZLO0001P/ListValores2/?fechaFiltro=' + fechafiltro +
            '&compFiltro=' + compfiltro + '&usuario=' + usuario + '&case=' + case1 + '&vend=1';
        var url3 = 'http://172.16.15.20/API.LovablePHP/ZLO0001P/ListValores3/?fechaFiltro=' + fechafiltro +
            '&compFiltro=' + compfiltro + '&usuario=' + usuario + '&case=' + case1 + '&vend=1';
        break;
}
console.log(url2);
var responseDiayMes = ajaxRequest(url1);
var responseAnual = ajaxRequest(url2);
if (case1 != 2) {
    var responsePromedios = ajaxRequest(url3);
}
$(document).ready(function() {
    //LLENADO DE COMARC
    if (responseComarc.code == 200) {
        for (let i = 0; i < responseComarc.data.length; i++) {
            $("#comppro").append(' <option value=' + responseComarc.data[i]['COMCOD'] + ' selected>' +
                responseComarc.data[i]['COMDES'] + '</option>');
        }
    }

    //LLENADO DE TABLA
    console.log(responseDiayMes);
    console.log(responseAnual);
    if (responseDiayMes.code == 200 && responseAnual.code == 200) {
        for (let i = 0; i < responseDiayMes.data.length; i++) {
            let mon = '';
            var filtro
            if (case1 == 3) {
                mon = 'D.';
            } else if (case1 == 4) {
                mon = responseDiayMes.data[i]['MON'] + '.';
            }
            var creciAnual = 0;
            (responseAnual.data[i]['ANO2'] != 0) ? creciAnual = (((responseAnual.data[i]['ANO1'] / responseAnual
                .data[i]['ANO2']) - 1) * 100): creciAnual = 0;
            var creciPromedio = 0,
                varPromedios = 0;
            if (case1 != 2) {
                (responsePromedios.data[i]['PROANO2'] != 0) ? creciPromedio = (((responsePromedios.data[i]['PROANO'] / responsePromedios.data[i]['PROANO2']) - 1) * 100): creciPromedio = 0;
                varPromedios = (responsePromedios.data[i]['PROANO'] - responsePromedios.data[i]['PROANO2']);
            }
            if (responseDiayMes.data[i]['VENDEDOR'] == '1' || responseDiayMes.data[i]['VENDEDOR'] == '2') {
                $("#myTableBody").append(
                    `<tr class="bg-secondary2" id="tr${i}" ondblclick="location.href=\'/<?php echo $_SESSION['DEV']; ?>LovablePHP/PRG/ZFA/ZLO0001PA.php?id=${responseDiayMes.data[i]['ID']}&dat=<?php echo $_SESSION['FechaFiltro'];?>\';">`
                );
            } else {
                $("#myTableBody").append(
                    `<tr id="tr${i}" ondblclick="location.href=\'/<?php echo $_SESSION['DEV']; ?>LovablePHP/PRG/ZFA/ZLO0001PA.php?id=${responseDiayMes.data[i]['ID']}&dat=<?php echo $_SESSION['FechaFiltro'];?>\';">`
                );
            }

            let vendias = "";
            let venmes = "";
            let venmes2 = "";
            let venmes3 = "";
            let tdAnual = "";
            let tdCreciAnual = "";
            if (parseFloat(responseDiayMes.data[i]['SUBDIA']) <= 0) {
                vendias = "<td class='text-end responsive-font-example text-danger' id='tddia1'><b>" + mon +
                    responseDiayMes.data[i]['SUBDIA'].toLocaleString('es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + "</b></td>";
            } else {
                vendias = "<td class='text-end responsive-font-example text-darkblue' id='tddia1'><b>" + mon +
                    responseDiayMes.data[i]['SUBDIA'].toLocaleString('es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + "</b></td>";
            }
            if (parseFloat(responseDiayMes.data[i]['SUBMES']) <= 0) {
                venmes = "<td class='text-end responsive-font-example text-danger' id='tddia2'><b>" + mon +
                    responseDiayMes.data[i]['SUBMES'].toLocaleString('es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + "</b></td>";
            } else {
                venmes = "<td class='text-end responsive-font-example text-pink' id='tddia2'><b>" + mon +
                    responseDiayMes.data[i]['SUBMES'].toLocaleString('es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + "</b></td>";
            }
            if (case1 != 1 && case1 != 2) {
                if (parseFloat(responseDiayMes.data[i]['SUBMES2']) <= 0) {
                    venmes2 = "<td class='text-end responsive-font-example ' id='tddia1'><b>" + mon +
                        responseDiayMes.data[i]['SUBMES2'].toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }) + "</b></td>";
                } else {
                    venmes2 = "<td class='text-end responsive-font-example ' id='tddia1'><b>" + mon +
                        responseDiayMes.data[i]['SUBMES2'].toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }) + "</b></td>";
                }
                if (parseFloat(responseDiayMes.data[i]['SUBMES3']) <= 0) {
                    venmes3 = "<td class='text-end responsive-font-example ' id='tddia2'><b>" + mon +
                        responseDiayMes.data[i]['SUBMES3'].toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }) + "</b></td>";
                } else {
                    venmes3 = "<td class='text-end responsive-font-example ' id='tddia2'><b>" + mon +
                        responseDiayMes.data[i]['SUBMES3'].toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }) + "</b></td>";
                }
            }
            if (parseFloat(responseAnual.data[i]['VARIA']) <= 0) {
                tdAnual = "<td class='text-end responsive-font-example d-none text-danger' id='tdanual3'><b>" +
                    mon + responseAnual.data[i]['VARIA'].toLocaleString('es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + "</b></td>";
            } else {
                tdAnual = "<td class='text-end responsive-font-example d-none text-success' id='tdanual3'><b>" +
                    mon + responseAnual.data[i]['VARIA'].toLocaleString('es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + "</b></td>";
            }
            if (parseFloat(creciAnual) <= 0) {
                tdCreciAnual =
                    "<td class='text-end responsive-font-example d-none text-danger' id='tdanual4'><b>" +
                    parseInt(creciAnual) + "%</b></td>";
            } else {
                tdCreciAnual =
                    "<td class='text-end responsive-font-example d-none text-success' id='tdanual4'><b>" +
                    parseInt(creciAnual) + "%</b></td>";
            }
            $('#tr' + i + '').append("<td class='responsive-font-example d-none'><b>" + responseDiayMes.data[i][
                'CODSEC'
            ] + "</b></td>");
            $('#tr' + i + '').append("<td class='responsive-font-example d-none'><b>" + responseDiayMes.data[i][
                'ID'
            ] + "</b></td>");
            $('#tr' + i + '').append("<td class='text-start responsive-font-example'><b>" + responseDiayMes
                .data[i]['COMDES'] + "</b></td>");
            $('#tr' + i + '').append(vendias);
            $('#tr' + i + '').append(venmes);
            $('#tr' + i + '').append(venmes2);
            $('#tr' + i + '').append(venmes3);
            $('#tr' + i + '').append("<td class='text-end responsive-font-example d-none' id='tdanual1'><b>" +
                mon + responseAnual.data[i]['ANO1'].toLocaleString('es-419', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }) + "</b></td>");
            $('#tr' + i + '').append("<td class='text-end responsive-font-example d-none' id='tdanual2'><b>" +
                mon + responseAnual.data[i]['ANO2'].toLocaleString('es-419', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }) + "</b></td>");
            $('#tr' + i + '').append(tdAnual);
            $('#tr' + i + '').append(tdCreciAnual);
            if (case1 != 2) {
                let prodia = "";
                let tdPromedios = "";
                let tdCrecimiento = "";
                if (parseFloat(responsePromedios.data[i]['PRODIA']) == 0) {
                    prodia =
                        "<td class='text-end responsive-font-example d-none text-danger' id='tdpro1' ><b>" +
                        mon + responsePromedios.data[i]['PRODIA'].toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }) + "</b></td>";
                } else {
                    prodia = "<td class='text-end responsive-font-example d-none' id='tdpro1' ><b>" + mon +
                        responsePromedios.data[i]['PRODIA'].toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }) + "</b></td>";
                }
                if (parseFloat(varPromedios) <= 0) {
                    tdPromedios =
                        "<td class='text-end responsive-font-example d-none text-danger' id='tdpro5' ><b>" +
                        mon + parseFloat(varPromedios).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }) + "</b></td>";
                } else {
                    tdPromedios =
                        "<td class='text-end responsive-font-example d-none text-success' id='tdpro5' ><b>" +
                        mon + parseFloat(varPromedios).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }) + "</b></td>";
                }
                if (parseFloat(creciPromedio) < 0) {
                    tdCrecimiento =
                        "<td class='text-end responsive-font-example d-none text-danger' id='tdpro6' ><b>" +
                        parseInt(creciPromedio.toFixed()) + "%</b></td>";
                } else if (parseFloat(creciPromedio) > 0) {
                    tdCrecimiento =
                        "<td class='text-end responsive-font-example d-none text-success' id='tdpro6' ><b>" +
                        parseInt(creciPromedio.toFixed()) + "%</b></td>";
                } else {
                    tdCrecimiento = "<td class='text-end responsive-font-example d-none' id='tdpro6' ><b>" +
                        parseInt(creciPromedio.toFixed()) + "%</b></td>";
                }
                $('#tr' + i + '').append(prodia);
                $('#tr' + i + '').append(
                    "<td class='text-end responsive-font-example d-none' id='tdpro2' ><b>" + mon +
                    responsePromedios.data[i]['PROMES'].toLocaleString('es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + "</b></td>");
                $('#tr' + i + '').append(
                    "<td class='text-end responsive-font-example d-none' id='tdpro3' ><b>" + mon +
                    responsePromedios.data[i]['PROANO'].toLocaleString('es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + "</b></td>");
                $('#tr' + i + '').append(
                    "<td class='text-end responsive-font-example d-none' id='tdpro4' ><b>" + mon +
                    responsePromedios.data[i]['PROANO2'].toLocaleString('es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + "</b></td>");
                $('#tr' + i + '').append(tdPromedios);
                $('#tr' + i + '').append(tdCrecimiento);
            }
            $("#myTableBody").append('</tr>');
        }
    }

    $("#myTable").DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },
        "ordering": false,
        "responsive": true,
        "pageLength": 100,
        dom: 'Bfrtip',
        buttons: [{
            extend: 'excelHtml5',
            text: '<i class="fa-solid fa-file-excel"></i> <b >Enviar a Excel</b>',
            className: "btn btn-success text-light mt-2 fs-6 ",

            exportOptions: {
                columns: <?php if($_SESSION['filtro']!=2){
                echo "[2,3,4,5,6,7,8,9,10,11,12,13,14],";
              }else{
                echo "[2,3,4,5,6,7,8],";
                }
              ?>
            },

            title: 'ReporteVentas',
            messageTop: ' ',
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

                <?php
                  $title="";
                  switch ($_SESSION['filtro']) {
                    case 1:
                      $title="(UNIDADES)";
                      break;
                      case 2:
                        $title="(TRANSACCIONES)";
                        break;
                        case 3:
                          $title="(DOLARES)";
                          break;
                          case 4:
                            $title="(MONEDA NACIONAL)";
                            break;

                    default:
                      # code...
                      break;
                  }

                ?>
                $('c[r=A1] t', sheet).text('REPORTE DE VENTAS RESUMIDAS POR COMPAÑÍA <?php echo $title; ?> ');
                $('row:eq(0) c', sheet).attr('s', greyBoldCentered);
                $('row:eq(1) c', sheet).attr('s', 7);

                for (let index = 3; index <= 100; index++) {

                    $('row:eq(' + index + ') c[r^="B"]', sheet).attr('s', 52);
                    $('row:eq(' + index + ') c[r^="C"]', sheet).attr('s', 52);
                    $('row:eq(' + index + ') c[r^="D"]', sheet).attr('s', 52);
                    $('row:eq(' + index + ') c[r^="E"]', sheet).attr('s', 52);
                    $('row:eq(' + index + ') c[r^="F"]', sheet).attr('s', 52);
                    $('row:eq(' + index + ') c[r^="G"]', sheet).attr('s', 52);
                    $('row:eq(' + index + ') c[r^="H"]', sheet).attr('s', 52);
                    $('row:eq(' + index + ') c[r^="I"]', sheet).attr('s', 52);
                    $('row:eq(' + index + ') c[r^="J"]', sheet).attr('s', 52);
                    $('row:eq(' + index + ') c[r^="K"]', sheet).attr('s', 52);
                    $('row:eq(' + index + ') c[r^="L"]', sheet).attr('s', 52);
                    $('row:eq(' + index + ') c[r^="M"]', sheet).attr('s', 52);

                    <?php
                    if($_SESSION['filtro']==1 || $_SESSION['filtro']==2){
                  ?>
                    if (parseFloat($('row:eq(' + index + ') c[r^="B"]', sheet).text()) ==
                        0) {
                        $('row:eq(' + index + ') c[r^="B"]', sheet).attr('s',
                            textred1); //ROJO
                    }
                    if (parseFloat($('row:eq(' + index + ') c[r^="F"]', sheet).text()) <
                        0) {
                        $('row:eq(' + index + ') c[r^="F"]', sheet).attr('s',
                            textred1); //ROJO
                    } else {
                        $('row:eq(' + index + ') c[r^="F"]', sheet).attr('s',
                            textgreen1); //VERDE
                    }

                    if (parseFloat($('row:eq(' + index + ') c[r^="M"]', sheet).text()) <
                        0) {
                        $('row:eq(' + index + ') c[r^="M"]', sheet).attr('s',
                            textred2); //ROJO
                    } else {
                        $('row:eq(' + index + ') c[r^="M"]', sheet).attr('s',
                            textgreen2); //VERDE
                    }
                    if (parseFloat($('row:eq(' + index + ') c[r^="L"]', sheet).text()) <
                        0) {
                        $('row:eq(' + index + ') c[r^="L"]', sheet).attr('s',
                            textred1); //ROJO
                    } else {
                        $('row:eq(' + index + ') c[r^="L"]', sheet).attr('s',
                            textgreen1); //VERDE
                    }
                    <?php
                    }else{
                  ?>
                    if (parseFloat(($('row:eq(' + index + ') c[r^="B"]', sheet).text())
                            .slice(2)) == 0) {
                        $('row:eq(' + index + ') c[r^="B"]', sheet).attr('s',
                            textred1); //ROJO
                    }
                    if (parseFloat(($('row:eq(' + index + ') c[r^="F"]', sheet).text())
                            .slice(2)) < 0) {
                        $('row:eq(' + index + ') c[r^="F"]', sheet).attr('s',
                            textred1); //ROJO
                    } else {
                        $('row:eq(' + index + ') c[r^="F"]', sheet).attr('s',
                            textgreen1); //VERDE
                    }
                    if (parseFloat($('row:eq(' + index + ') c[r^="M"]', sheet).text()) <
                        0) {
                        $('row:eq(' + index + ') c[r^="M"]', sheet).attr('s',
                            textred2); //ROJO
                    } else {
                        $('row:eq(' + index + ') c[r^="M"]', sheet).attr('s',
                            textgreen2); //VERDE
                    }
                    if (parseFloat(($('row:eq(' + index + ') c[r^="L"]', sheet).text())
                            .slice(2)) < 0) {
                        $('row:eq(' + index + ') c[r^="L"]', sheet).attr('s',
                            textred1); //ROJO
                    } else {
                        $('row:eq(' + index + ') c[r^="L"]', sheet).attr('s',
                            textgreen1); //VERDE
                    }
                    <?php
                    }
                  ?>


                    if (parseFloat($('row:eq(' + index + ') c[r^="G"]', sheet).text()) <
                        0) {
                        $('row:eq(' + index + ') c[r^="G"]', sheet).attr('s',
                            textred2); //ROJO
                    } else {
                        $('row:eq(' + index + ') c[r^="G"]', sheet).attr('s',
                            textgreen2); //VERDE
                    }
                }

                for (let index = 2; index <= 100; index++) {
                    $('row:eq(' + index + ') c[r^="A"]', sheet).attr('s', 7);
                }
                var tagName = sSh.getElementsByTagName('sz');
                for (i = 0; i < tagName.length; i++) {
                    tagName[i].setAttribute("val", "13");
                }

            }
        }],

    });
    $("#myTable").append(
        '<caption style="caption-side: top" class="fw-bold text-black"><label class="ms-2 fw-bold">**Presione doble clic sobre la factura para ver detalles de la factura**</label></caption>'
    );



    if (<?php echo isset($_SESSION['opcion']) ? $_SESSION['opcion'] : "1"; ?> == 3) {
        $("#btnradio2").addClass("d-none");
        $("#btnnradio2").addClass("d-none");
    } else {
        $("#btnradio2").removeClass("d-none");
        $("#btnnradio2").removeClass("d-none");
    }
    if (<?php echo isset($_SESSION['filtro']) ? $_SESSION['filtro'] : "1"; ?> == 2) {
        $("#tab3").addClass("d-none");
    }


    //BOTONES
    var tab;
    $(".tablist__tab").click(function() {
        $(".tablist__tab").removeClass("is-active");
        $(this).addClass("is-active");
        var activeTab = $(".tablist__tab").filter(".is-active").attr("id");
        tab = (activeTab.substring(3, 4));
    });

    var button = 'btnradio' + <?php echo   $_SESSION['filtro'] ?>;
    $('#' + button + '').prop('checked', true);
    $('input[type="radio"]').click(function() {
        tab = tab != null ? tab : <?php echo isset($_SESSION['opcion']) ? $_SESSION['opcion'] : "1"; ?>;
        window.location.href = "/<?php echo $_SESSION['DEV'] ?>LovablePHP/PRG/ZFA/ZLO0001P.php?opc=" +
            tab + "&fil=" + ($(this).attr('id')).substring(8, 9) + "";
    });

    var tabSeleccionado = <?php echo isset($_SESSION['opcion']) ? $_SESSION['opcion'] : "1"; ?>;
    if (tabSeleccionado != 1) {
        var tabs = $('.tablist__tab'),
            tabPanels = $('.tablist__panel');
        var thisTab = $("#tab" + tabSeleccionado + ""),
            thisTabPanelId = thisTab.attr('aria-controls'),
            thisTabPanel = $('#panel1');
        tabs.attr('aria-selected', 'false').removeClass('is-active');
        thisTab.attr('aria-selected', 'true').addClass('is-active');
        tabPanels.attr('aria-hidden', 'true').addClass('is-hidden');
        thisTabPanel.attr('aria-hidden', 'false').removeClass('is-hidden');

        if (tabSeleccionado == 1) {
            $("#thdia1, #thdia2,#thdia3, #thdia4").removeClass("d-none");
            $("#tddia1, #tddia2,#tddia3, #tddia4").removeClass("d-none");
            $("#thpro1, #thpro2, #thpro3, #thpro4, #thpro5, #thpro6").addClass("d-none");
            $("#tdpro1, #tdpro2, #tdpro3, #tdpro4, #tdpro5, #tdpro6").addClass("d-none");
            $("#thanual1, #thanual2, #thanual3, #thanual4").addClass("d-none");
            $("#tdanual1, #tdanual2, #tdanual3, #tdanual4").addClass("d-none");
        } else if (tabSeleccionado == 2) {
            $("#thanual1, #thanual2, #thanual3, #thanual4").removeClass("d-none");
            $("#tdanual1, #tdanual2, #tdanual3, #tdanual4").removeClass("d-none");
            $("#thdia1, #thdia2,#thdia3, #thdia4").addClass("d-none");
            $("#tddia1, #tddia2,#tddia3, #tddia4").addClass("d-none");
            $("#thpro1, #thpro2, #thpro3, #thpro4, #thpro5, #thpro6").addClass("d-none");
            $("#tdpro1, #tdpro2, #tdpro3, #tdpro4, #tdpro5, #tdpro6").addClass("d-none");
        } else if (tabSeleccionado == 3) {
            $("#thpro1, #thpro2, #thpro3, #thpro4, #thpro5, #thpro6").removeClass("d-none");
            $("#tdpro1, #tdpro2, #tdpro3, #tdpro4, #tdpro5, #tdpro6").removeClass("d-none");
            $("#thanual1, #thanual2, #thanual3, #thanual4").addClass("d-none");
            $("#tdanual1, #tdanual2, #tdanual3, #tdanual4").addClass("d-none");
            $("#thdia1, #thdia2,#thdia3, #thdia4").addClass("d-none");
            $("#tddia1, #tddia2,#tddia3, #tddia4").addClass("d-none");
        }

    }
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
$("#tab1").click(function() {
    $("#btnradio2").removeClass("d-none");
    $("#btnnradio2").removeClass("d-none");

    $("#thdia1, #thdia2,#thdia3, #thdia4").removeClass("d-none");
    $("#tddia1, #tddia2,#tddia3, #tddia4").removeClass("d-none");
    $("#thanual1, #thanual2, #thanual3, #thanual4").addClass("d-none");
    $("#tdanual1, #tdanual2, #tdanual3, #tdanual4").addClass("d-none");
    $("#thpro1, #thpro2, #thpro3, #thpro4, #thpro5, #thpro6").addClass("d-none");
    $("#tdpro1, #tdpro2, #tdpro3, #tdpro4, #tdpro5, #tdpro6").addClass("d-none");
});
$("#tab2").click(function() {
    $("#btnradio2").removeClass("d-none");
    $("#btnnradio2").removeClass("d-none");

    $("#thanual1, #thanual2, #thanual3, #thanual4").removeClass("d-none");
    $("#tdanual1, #tdanual2, #tdanual3, #tdanual4").removeClass("d-none");
    $("#thdia1, #thdia2,#thdia3, #thdia4").addClass("d-none");
    $("#tddia1, #tddia2,#tddia3, #tddia4").addClass("d-none");
    $("#thpro1, #thpro2, #thpro3, #thpro4, #thpro5, #thpro6").addClass("d-none");
    $("#tdpro1, #tdpro2, #tdpro3, #tdpro4, #tdpro5, #tdpro6").addClass("d-none");
});
$("#tab3").click(function() {
    $("#btnradio2").addClass("d-none");
    $("#btnnradio2").addClass("d-none");

    $("#thpro1, #thpro2, #thpro3, #thpro4, #thpro5, #thpro6").removeClass("d-none");
    $("#tdpro1, #tdpro2, #tdpro3, #tdpro4, #tdpro5, #tdpro6").removeClass("d-none");
    $("#thanual1, #thanual2, #thanual3, #thanual4").addClass("d-none");
    $("#tdanual1, #tdanual2, #tdanual3, #tdanual4").addClass("d-none");
    $("#thdia1, #thdia2,#thdia3, #thdia4").addClass("d-none");
    $("#tddia1, #tddia2,#tddia3, #tddia4").addClass("d-none");
});
</script>