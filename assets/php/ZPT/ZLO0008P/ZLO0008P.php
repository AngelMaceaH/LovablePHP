<script>
    $( document ).ready(function() {
        let optgroups=``;
        let usuario = '<?php echo $_SESSION["CODUSU"];?>';
        const urlVal="http://172.16.15.20/API.LovablePHP/Users/FindAgrupP/?codusu="+usuario+"";
        fetch(urlVal).then(response => response.json()).then(data => {
                if(data.code==200){
                  optgroups+=`<optgroup>
                              <option class="fw-bold" value="0" disabled>País</option>`;
                    const dataResponse= data.data;
                    let count=0;
                    if (dataResponse.length>0) {
                        dataResponse.forEach(element => {
                            if (element.DESCRI.includes("honduras")) {
                                count++;
                                optgroups+= `<option value="1">Honduras (Lov. Ecommerce)</option>
                                                    <option value="2">Honduras (Mod. Íntima)</option>`;
                            }else if (element.DESCRI.includes("guatemala")) {
                                count++;
                                optgroups+= '<option value="3">Guatemala</option>';
                            }else if (element.DESCRI.includes("salvador")) {
                                count++;
                                optgroups+= '<option value="4">El Salvador</option>';
                            }else if(element.DESCRI.includes("costa rica")){
                                count++;
                                optgroups+= '<option value="5">Costa Rica</option>';
                            }else if(element.DESCRI.includes("nicaragua")){
                                count++;
                                optgroups+= '<option value="6">Nicaragua</option>';
                            }else if(element.DESCRI.includes("republica dominicana")){
                                count++;
                                optgroups+= '<option value="7">Republica Dominicana</option>';
                            }
                    });
                     optgroups+=`</optgroup>`;
                    }
                    if (count==6) {
                      optgroups+=`<optgroup>
                                        <option class="fw-bold" value="0" disabled>Fabrica</option>
                                        <option class="fw-bold" value="01">Lovable Honduras</option>
                                    </optgroup>`;
                    }
                    let urlTiendas = '/API.LovablePHP/Users/FindAgrupT/?codusu=' + usuario + '';
                    let responseTiendas = ajaxRequest(urlTiendas);
                    if (responseTiendas.code == 200) {
                      optgroups+=`<optgroup>
                      <option class="fw-bold" value="0" disabled>Punto de Venta</option>`;
                        for (let i = 0; i < responseTiendas.data.length; i++) {
                            if (responseTiendas.data[i].COMCOD != 1 && responseTiendas.data[i].COMCOD != 35) {
                              optgroups += '<option value="' + responseTiendas.data[i].COMCOD.padStart(2, '0') +'">' +responseTiendas.data[i].COMDES + '</option>';
                            }
                        }
                        optgroups+=`</optgroup>`;
                    }
                    $("#cbbPais").append(optgroups);
                    const valInput="<?php echo $paisfiltro;?>";
                    const ischange=getCookie("changeSel");
                    if (count==6) {
                      $("#cbbPais").val("1");
                    }
                    if (ischange==1) {
                      $("#cbbPais").val(valInput);
                    }
                    if (data.acceso==0) {
                    $("#body-page").empty();
                    $("#body-page").append('<div class="text-center p-5 fs-3 m-5" style="height:600px;"><div class="border border-1 rounded p-5 m-5"><i class="fa-solid fa-question fa-fade fa-2xl mb-4"></i><br /> No hay contenido para mostrar.</div></div>');
                     }
                }
            });

//BOTONES
var tab;
    $(".tablist__tab").click(function() {
      $(".tablist__tab").removeClass("is-active");
      $(this).addClass("is-active");
      var activeTab = $(".tablist__tab").filter(".is-active").attr("id");
      tab=(activeTab.substring(3,4));
      document.cookie="tabselected="+tab;
    });

    var tabSeleccionado=<?php echo isset($_SESSION['tab']) ? $_SESSION['tab'] : "false"; ?>;
    if (tabSeleccionado != false) {
            var tabs = $('.tablist__tab'),
                        tabPanels = $('.tablist__panel');
                    var thisTab = $("#tab"+tabSeleccionado+""),
                            thisTabPanelId = thisTab.attr('aria-controls'),
                            thisTabPanel = $('#panel'+tabSeleccionado+'');
            tabs.attr('aria-selected', 'false').removeClass('is-active');
            thisTab.attr('aria-selected', 'true').addClass('is-active');
            tabPanels.attr('aria-hidden', 'true').addClass('is-hidden');
            thisTabPanel.attr('aria-hidden', 'false').removeClass('is-hidden');
        }

    $("#cbbMes").val("<?php echo $mesfiltro; ?>");
    $("#cbbPais").val("<?php echo $paisfiltro;?>");
    $("#cbbAno").val(<?php echo $anofiltro;  ?>);


      $("#cbbPais, #cbbAno, #cbbMes, #cbbOrden").change(function() {
        $("#formFiltros").submit();
        setCookie("changeSel",1,1);
       });

       var labelActual="";
      labelActual=$('#cbbPais').find(":selected").text();

        $("#myTableInvMeses").DataTable( {
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
                title: 'ReporteMeses Lineas',

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

                    $('c[r=A1] t', sheet).text( 'COMPARATIVO MESES DE INVENTARIO POR LÍNEA '+labelActual.toUpperCase()+' (MESES)' );
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

          $("#myTableInvUnidades").DataTable( {
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
                    columns: [1,2,3,4,5]
                },
                title: 'ReporteUnidades Líneas',
                messageTop:' ',
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
                    var n2 = '<numFmt formatCode="#,##0"   numFmtId="200"/>';
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

                    $('c[r=A1] t', sheet).text( 'COMPARATIVO MESES DE INVENTARIO POR LINEA '+labelActual.toUpperCase()+' (<?php if ($paisfiltro==="01") { echo "DOCENAS";}else{echo "UNIDADES";}  ?>)');
                    $('row:eq(0) c', sheet).attr( 's', greyBoldCentered );
                    $('row:eq(1) c', sheet).attr( 's', 7 );

                    for (let index = 3; index <= 100; index++) {
                      if (($('row:eq('+index+') c[r^="D"]', sheet).text()*1<0)) {
                        $('row:eq('+index+') c[r^="D"]', sheet).attr( 's', textred1 );  //ROJO
                      }else{
                        $('row:eq('+index+') c[r^="D"]', sheet).attr( 's', textgreen1 );  //VERDE
                      }
                    }

                    var tagName = sSh.getElementsByTagName('sz');
                    for (i = 0; i < tagName.length; i++) {
                      tagName[i].setAttribute("val", "13")
                    }


                  }

            }
        ]
          });








  //GRAFICAS---------------------------------------------------------------
  //PAISES UNIDADES COMPRADAS VS UNIDADES VENDIDAS
    var chart = Highcharts.chart('container2', {

    chart: {
      height:600,
        type: 'column'
    },
    lang: {
          viewFullscreen:"Ver en pantalla completa",
          exitFullscreen:"Salir de pantalla completa",
          downloadJPEG:"Descargar imagen JPEG",
          downloadPDF:"Descargar en PDF",
      },
      exporting: {
        enabled: true,
    filename: 'Inventario-Comparativo Lineas',
    sourceWidth: 1600,
    sourceHeight: 900,
          buttons: {
              contextButton: {
                  menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
              }
          },
          plotOptions: {
                series: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            fallbackToExportServer: false
      },
    title: {
        text: '<?php if ($paisfiltro==="01") { echo "Docenas";}else{echo "Unidades";}  ?> Compradas vs. <?php if ($paisfiltro==="01") { echo "Docenas";}else{echo "Unidades";}  ?> vendidas',
        margin: 50
    },
    subtitle: {
        text: labelActual,
        align: 'center',
        style: {
                fontSize:'16px',
                color: '#000',
            },
    },
    xAxis: {
        categories: <?php echo json_encode($paisesLabel2); ?>,
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
        name: 'Und. Compradas',
        data: <?php echo json_encode($paisesUndComp); ?>,
        dataLabels: {
      align: "center",
      enabled: true,
      borderColor: "",
      style: {
        fontSize: "12px",
        fontWeight: 'bold',
        fontFamily: "Arial",
        textShadow: false
      }
    }
    }, {
      name: 'Und. Vendidas',
        data: <?php echo json_encode($paisesUndVen); ?>,
        dataLabels: {
      align: "center",
      enabled: true,
      borderColor: "",
      style: {
        fontSize: "12px",
        fontWeight: 'bold',
        fontFamily: "Arial",
        textShadow: false
      }
    }
    },
    ],


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
    //PAISES UNIDADES EXISTENCIAS
    var chart = Highcharts.chart('container3', {

    chart: {
      height:600,
        type: 'column'
    },
    lang: {
          viewFullscreen:"Ver en pantalla completa",
          exitFullscreen:"Salir de pantalla completa",
          downloadJPEG:"Descargar imagen JPEG",
          downloadPDF:"Descargar en PDF",
      },
      exporting: {
        enabled: true,
    filename: '<?php if ($paisfiltro==="01") { echo "Docenas";}else{echo "Unidades";}  ?>-existencias Lineas',
    sourceWidth: 1600,
    sourceHeight: 900,
          buttons: {
              contextButton: {
                  menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
              }
          },
          plotOptions: {
                series: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            fallbackToExportServer: false
      },
    title: {
        text: '<?php if ($paisfiltro==="01") { echo "Docenas";}else{echo "Unidades";}  ?> Existencias',
        margin: 50
    },
    subtitle: {
        text: labelActual,
        align: 'center',
        style: {
                fontSize:'16px',
                color: '#000',
            },
    },
    xAxis: {
        categories: <?php echo json_encode($paisesLabel2); ?>,
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
        name: 'Und. Existencia',
        data: <?php echo json_encode($paisesUndExi); ?>,
        dataLabels: {
      align: "center",
      enabled: true,
      borderColor: "",
      style: {
        fontSize: "12px",
        fontWeight: 'bold',
        fontFamily: "Arial",
        textShadow: false
      }
    }
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
    Highcharts.setOptions({
    colors: [
      "rgba(222, 84, 44,0.6)","rgba(239, 126, 50,0.6)","rgba(238, 154, 58,0.6)","rgba(234, 219, 56,0.6)","rgba(79, 32, 13,0.6)","rgba(231, 227, 78,0.6)",
      "rgba(20, 36, 89,0.6)","rgba(23, 107, 160,0.6)","rgba(25, 170, 222,0.6)","rgba(26, 201, 230,0.6)","rgba(29, 228, 219,0.6)","rgba(109, 240, 210,0.6)",
    ]
  });
  //PAISES INVENTARIO
  Highcharts.chart('container', {
    lang: {
          viewFullscreen:"Ver en pantalla completa",
          exitFullscreen:"Salir de pantalla completa",
          downloadJPEG:"Descargar imagen JPEG",
          downloadPDF:"Descargar en PDF",
      },
      chart: {
        height:2500,
          type: 'bar'
      },
      title: {
          text: 'Comparativo meses de inventario por Línea',
          margin: 50
      },
      subtitle: {
        text: labelActual,
        align: 'center',
        style: {
                fontSize:'16px',
                color: '#000',
            },
    },
      xAxis: {
        className: 'fw-bold',
          categories: <?php echo json_encode($paisesLabel1); ?>,
      },
      yAxis: {
      min: 0,
      endOnTick: false,
      tickInterval: 20,
        lineWidth: 1,
        title: {
            text: ' '

        },
    },
      legend: {
          reversed: true
      },
      plotOptions: {
          series: {
              stacking: 'normal',
              dataLabels: {
                  enabled: true
              }
          }
      },
      credits: {
      enabled: false
    },
      series: [
        {
          name: 'Meses Inv. 6M',
          data: <?php echo json_encode($paisesM1); ?>,
          dataLabels: [{
            enabled: true,
            inside: true,
            style: {
                fontSize:'14px',
                color: '#000',
            }
        }],
        },
        {
          name: 'Meses Inv. 6M (Mes Anterior)',
          data: <?php echo json_encode($paisesM2); ?>,
          dataLabels: [{
            enabled: true,
            inside: true,
            style: {
                fontSize:'14px',
                color: '#000',
            }
        }],
        },
        {
          name: 'Meses Inv. 6M (2 Meses Anterior)',
          data: <?php echo json_encode($paisesM3); ?>,
          dataLabels: [{
            enabled: true,
            inside: true,
            style: {
                fontSize:'14px',
                color: '#000',
            }
        }],
        },
        {
          name: 'Meses Inv. 6M (3 Meses Anterior)',
          data: <?php echo json_encode($paisesM4); ?>,
          dataLabels: [{
            enabled: true,
            inside: true,
            style: {
                fontSize:'14px',
                color: '#000',
            }
        }],
        },
        {
          name: 'Meses Inv. 6M (4 Meses Anterior)',
          data: <?php echo json_encode($paisesM5); ?>,
          dataLabels: [{
            enabled: true,
            inside: true,
            style: {
                fontSize:'14px',
                color: '#000',
            }
        }],
        },
        {
          name: 'Meses Inv. 6M (5 Meses Anterior)',
          data: <?php echo json_encode($paisesM6); ?>,
          dataLabels: [{
            enabled: true,
            inside: true,
            style: {
                fontSize:'14px',
                color: '#000',
            }
        }],
        },
    ],
    exporting: {
          buttons: {
              contextButton: {
                  menuItems: ["viewFullscreen", "separator","downloadJPEG", "downloadPDF"]
              }
          },
           enabled: true,
    filename: 'Inventario-meses Líneas',
    sourceWidth: 900,
    sourceHeight: 2500,
    chartOptions: {

      title: {
        style: {
            fontSize: (<?php echo $paisfiltro;?>==1)? '30px':'20px',
                }
         },
      series: [{
        dataLabels: {
          style: {
            fontSize: "16px",
            fontWeight: "normal"
          }
        }
      }],

      xAxis: {
        //lineWidth: 1,
        labels: {
          rotate: -45,
          enabled: true,
          //format: "{value:.0f}",
          style: {
            fontSize: "10px",
            fontFamily: "Arial"
          }
        },
      },
      yAxis: {
        lineWidth: 1,
        title: {
          text: " ",
          style: {
            fontFamily: "Arial",
            fontSize: "16px",
          }
        },
        labels: {
          //rotate: -45,
          enabled: true,
          format: "{value:.0f}",
          style: {
            fontSize: "16px",
            fontFamily: "Arial"
          }
        },
        gridLineWidth: 0
      },
    },
    fallbackToExportServer: false
      },

  });

  if (<?php echo $validator1;?>) {
    $("#grafica1").addClass("d-none");
  }
  if (<?php echo $validator2;?>) {
    $("#grafica2").addClass("d-none");
  }
});
</script>