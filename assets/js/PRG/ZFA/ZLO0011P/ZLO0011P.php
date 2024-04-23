<script>
        $(document).ready(function() {
            var mespro = '<?php echo $mespro; ?>';
            var anopro = '<?php echo $anopro; ?>';
            var ciaSelect = '<?php echo $cia; ?>';
            var ciaHon1 =
                '<?php echo "AND LO2261.CODCIA IN(35,47,50,52,56,57,59,63,64,65,68,70,72,73,74,75,76,78,82,85,88)"; ?>';
            var ciaHon2 = '<?php echo "AND LO2261.CODCIA IN(20,22,21,23,24)"; ?>';
            var ciaGua = '<?php echo "AND LO2261.CODCIA IN(49,66,69,71,86)"; ?>';
            var ciaSal = '<?php echo "AND LO2261.CODCIA IN(48,53,61,62,77)"; ?>';
            var ciaCos = '<?php echo "AND LO2261.CODCIA IN(60,80,54)"; ?>';
            var ciaNic = '<?php echo "AND LO2261.CODCIA IN(83,87)"; ?>';
            var ciaRep = '<?php echo "AND LO2261.CODCIA IN(81)"; ?>';
            $("#cbbAno").val(anopro);
            $("#cbbMes").val(mespro);
            $("#filtro1").val(ciaSelect);
            var paises = ['Honduras (Lov. Eccommerce)', 'Honduras (Mod. Íntima)', 'Guatemala', 'El Salvador',
                'Costa Rica', 'Nicaragua', 'Rep. Dominicana'
            ]
            var cias = [ciaHon1, ciaHon2, ciaGua, ciaSal, ciaCos, ciaNic, ciaRep];
            var options = "";
            var arrayList = [];
            var isEmpty = false;
            for (let j = 0; j < cias.length; j++) {
                var urlList = "/API.LovablePHP/ZLO0011P/List/?anopro=" + anopro + "&mespro=" +
                    mespro + "&cia=" + cias[j] + "";
                var responseList = ajaxRequest(urlList);
                if (responseList.code == 200) {
                    var sidesc = 0;
                    var por10 = 0;
                    var por20 = 0;
                    var por30 = 0;
                    var por40 = 0;
                    var por50 = 0;
                    var por60 = 0;
                    var por70 = 0;
                    var por80 = 0;
                    var porz1 = 0;
                    var porz2 = 0;
                    var total = 0;
                    for (let i = 0; i < responseList.data.length; i++) {
                        sidesc = sidesc + parseInt(responseList.data[i]['SIDESC']);
                        por10 = por10 + parseInt(responseList.data[i]['POR10']);
                        por20 = por20 + parseInt(responseList.data[i]['POR20']);
                        por30 = por30 + parseInt(responseList.data[i]['POR30']);
                        por40 = por40 + parseInt(responseList.data[i]['POR40']);
                        por50 = por50 + parseInt(responseList.data[i]['POR50']);
                        por60 = por60 + parseInt(responseList.data[i]['POR60']);
                        por70 = por70 + parseInt(responseList.data[i]['POR70']);
                        por80 = por80 + parseInt(responseList.data[i]['POR80']);
                        porz1 = porz1 + parseInt(responseList.data[i]['PORZ1']);
                        porz2 = porz2 + parseInt(responseList.data[i]['PORZ2']);
                        total = total + parseInt(responseList.data[i]['PORTOT']);
                    }
                    arrayList[j] = {
                        name: paises[j],
                        data: [parseInt(sidesc), parseInt(por10), parseInt(por20), parseInt(por30), parseInt(
                                por40), parseInt(por50), parseInt(por60),
                            parseInt(por70), parseInt(por80), parseInt(porz1), parseInt(porz2)
                        ]
                    };
                    options +=
                        '<tr onclick="location.href=\'/<?php echo $_SESSION['DEV']; ?>LovablePHP/PRG/ZFA/ZLO0011PA.php?id=' +
                        (j + 1) + '\'">';
                    options += '<td>' + 1 + '</td>';
                    options += '<td class="fw-bold">' + paises[j] + '</td>';
                    if (sidesc == 0)
                        options += '<td></td>';
                    else
                        options += '<td class="text-end">' + sidesc + '</td>';
                    if (por10 == 0)
                        options += '<td></td>';
                    else
                        options += '<td class="text-end">' + por10 + '</td>';
                    if (por20 == 0)
                        options += '<td></td>';
                    else
                        options += '<td class="text-end">' + por20 + '</td>';
                    if (por30 == 0)
                        options += '<td></td>';
                    else
                        options += '<td class="text-end">' + por30 + '</td>';
                    if (por40 == 0)
                        options += '<td></td>';
                    else
                        options += '<td class="text-end">' + por40 + '</td>';
                    if (por50 == 0)
                        options += '<td></td>';
                    else
                        options += '<td class="text-end">' + por50 + '</td>';
                    if (por60 == 0)
                        options += '<td></td>';
                    else
                        options += '<td class="text-end">' + por60 + '</td>';
                    if (por70 == 0)
                        options += '<td></td>';
                    else
                        options += '<td class="text-end">' + por70 + '</td>';
                    if (por80 == 0)
                        options += '<td></td>';
                    else
                        options += '<td class="text-end">' + por80 + '</td>';
                    if (porz1 == 0)
                        options += '<td></td>';
                    else
                        options += '<td class="text-end">' + porz1 + '</td>';
                    if (porz2 == 0)
                        options += '<td></td>';
                    else
                        options += '<td class="text-end">' + porz2 + '</td>';
                    if (total == 0)
                        options += '<td></td>';
                    else
                        options += '<td class="text-end">' + total + '</td>';
                    options += '</tr>';
                    $("#myTableInvDesc tbody").html(options);
                } else {
                    //isEmpty=true;
                }
            }
            if (arrayList.length == 0) {
                $("#grafica1").addClass("d-none");
            }
            $("#cbbAno, #cbbMes, #filtro1").on("change", function() {
                $("#formFiltros").submit();
            });
            $("#myTableInvDesc").DataTable({
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
                        columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                    },
                    title: 'ReporteInv Descuentos',

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
                        var n2 = '<numFmt formatCode="#,##0.00"   numFmtId="200"/>';
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
                        sSh.childNodes[0].childNodes[5].innerHTML += s1 + s2 + s3 + s4 + s5 +
                            s6 + s7 + s8;

                        var fourDecPlaces = lastXfIndex + 1;
                        var greyBoldCentered = lastXfIndex + 2;
                        var twoDecPlacesBold = lastXfIndex + 3;
                        var greyBoldWrapText = lastXfIndex + 4;
                        var textred1 = lastXfIndex + 5;
                        var textgreen1 = lastXfIndex + 6;
                        var textred2 = lastXfIndex + 7;
                        var textgreen2 = lastXfIndex + 8;

                        $('c[r=A1] t', sheet).text(
                            'INVENTARIO POR CLASIFICACIÓN DE PRODUCTOS TIENDAS');
                        $('row:eq(0) c', sheet).attr('s', greyBoldCentered);
                        $('row:eq(1) c', sheet).attr('s', 7);

                        var tagName = sSh.getElementsByTagName('sz');
                        for (i = 0; i < tagName.length; i++) {
                            tagName[i].setAttribute("val", "13")
                        }
                    }
                }]
            });
            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: ' '
                },
                xAxis: {
                    categories: ['Sin descuento', '10%', '20%', '30%', '40%', '50%', '60%', '70%', '80%',
                        'Z1', 'Z2'
                    ],
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
                series: arrayList.filter(elemento => elemento !== undefined)
            });
        });
    </script>