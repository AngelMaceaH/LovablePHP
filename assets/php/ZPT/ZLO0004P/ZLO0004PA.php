<script>
    $( document ).ready(function() {

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
    $("#cbbOrden").val(<?php echo $ordenFiltro;  ?>); 
    
      $("#cbbPais, #cbbAno, #cbbMes, #cbbOrden").change(function() {
        $("#formFiltros").submit();
       });
       
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
                title: 'ReporteMeses Países',
                
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
                    
                    $('c[r=A1] t', sheet).text( 'COMPARATIVO MESES DE INVENTARIO PAÍSES (MESES)' );
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
                title: 'ReporteUnidades Países',
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
                    
                    $('c[r=A1] t', sheet).text( 'COMPARATIVO MESES DE INVENTARIO PAÍSES (UNIDADES)');
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
    filename: 'Inventario-Comparativo Países',
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
            }
      },
    title: {
        text: 'Unidades Compradas vs. Unidades vendidas',
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
    filename: 'Unidades-existencias Países',
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
            }
      },
    title: {
        text: 'Unidades Existencias',
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
        height: (<?php echo $paisfiltro;?>==8)? 1000:500,
          type: 'bar'
      },
      title: {
          text: 'Comparativo meses de inventario Países',
          margin: 50
      },
      xAxis: {
        className: 'fw-bold',
          categories: <?php echo json_encode($paisesLabel); ?>,
          
      },
      yAxis: {
      min: 0,
      endOnTick: false,
      tickInterval: 100,
        lineWidth: 1,
        labels: {
            enabled: false
        },
        title: {
            text: ' '

        },
    },
      legend: {
          reversed: true
      },
       tooltip: {
            formatter: function() {
                if(tooltipShow) {
                    return false;
                } else {
                    return false; // now you don't
                }
            }
        },
      plotOptions: {
          series: {
            stacking: 'normal',
          }
        },
      credits: {
      enabled: false
    },
      series: [
              {
          name: 'Meses Inv. 6M',
          data: <?php if ($firstvalue!=0) {echo "[".$paisesM1[0].",".($paisesM1[1]*2).",".($paisesM1[2]*2).",".($paisesM1[3]*4).",".($paisesM1[4]*4).",".($paisesM1[5]*4).","."]"; }else{ echo "[0,0,0,0,0,0]";} ?>,
          dataLabels: {
            enabled: true,
            inside: true,
            formatter: function() {
              if (this.point.index === 0) {
                if (this.y != 0) {
                  return this.y;
                }else{
                  return null;
                }
              } else if (this.point.index === 1 || this.point.index === 2) {
                if (this.y != 0) {
                  return this.y / 2;
                }else{
                  return null;
                }
              }else{
                if (this.y != 0) {
                  return this.y / 4;
                }else{
                  return null;
                }
              }
            },
            style: {
              fontSize: '16px',
              color: '#000'
            }
          }
        },
        {
          name: 'Meses Inv. 6M (Mes Anterior)',
          data: <?php if ($firstvalue!=0) {echo "[".$paisesM2[0].",".($paisesM2[1]*2).",".($paisesM2[2]*2).",".($paisesM2[3]*4).",".($paisesM2[4]*4).",".($paisesM2[5]*4).","."]";}else{ echo "[0,0,0,0,0,0]";} ?>,
          dataLabels: {
            enabled: true,
            inside: true,
            formatter: function() {
              if (this.point.index === 0) {
                if (this.y != 0) {
                  return this.y;
                }else{
                  return null;
                }
              }else if (this.point.index === 1 || this.point.index === 2) {
                if (this.y != 0) {
                  return this.y / 2;
                }else{
                  return null;
                }
              } else {
                if (this.y != 0) {
                  return this.y / 4;
                }else{
                  return null;
                }
              }
            },
            style: {
              fontSize: '16px',
              color: '#000'
            }
          }
        }, 
        {
          name: 'Meses Inv. 6M (2 Meses Anterior)',
          data: <?php if ($firstvalue!=0) {echo "[".$paisesM3[0].",".($paisesM3[1]*2).",".($paisesM3[2]*2).",".($paisesM3[3]*4).",".($paisesM3[4]*4).",".($paisesM3[5]*4).","."]";}else{ echo "[0,0,0,0,0,0]";} ?>,
          dataLabels: {
            enabled: true,
            inside: true,
            formatter: function() {
              if (this.point.index === 0) {
                if (this.y != 0) {
                  return this.y;
                }else{
                  return null;
                }
              }else if (this.point.index === 1 || this.point.index === 2) {
                if (this.y != 0) {
                  return this.y / 2;
                }else{
                  return null;
                }
              } else {
                if (this.y != 0) {
                  return this.y / 4;
                }else{
                  return null;
                }
              }
            },
            style: {
              fontSize: '16px',
              color: '#000'
            }
          }
        }, 
        {
          name: 'Meses Inv. 6M (4 Meses Anterior)',
          data: <?php if ($firstvalue!=0) {echo "[".$paisesM4[0].",".($paisesM4[1]*2).",".($paisesM4[2]*2).",".($paisesM4[3]*4).",".($paisesM4[4]*4).",".($paisesM4[5]*4).","."]";}else{ echo "[0,0,0,0,0,0]";} ?>,
          dataLabels: {
            enabled: true,
            inside: true,
            formatter: function() {
              if (this.point.index === 0) {
                if (this.y != 0) {
                  return this.y;
                }else{
                  return null;
                }
              }else if (this.point.index === 1 || this.point.index === 2) {
                if (this.y != 0) {
                  return this.y / 2;
                }else{
                  return null;
                }
              } else {
                if (this.y != 0) {
                  return this.y / 4;
                }else{
                  return null;
                }
              }
            },
            style: {
              fontSize: '16px',
              color: '#000'
            }
          }
        }, 
        {
          name: 'Meses Inv. 6M (4 Meses Anterior)',
          data: <?php if ($firstvalue!=0) {echo "[".$paisesM5[0].",".($paisesM5[1]*2).",".($paisesM5[2]*2).",".($paisesM5[3]*4).",".($paisesM5[4]*4).",".($paisesM5[5]*4).","."]";}else{ echo "[0,0,0,0,0,0]";} ?>,
          dataLabels: {
            enabled: true,
            inside: true,
            formatter: function() {
              if (this.point.index === 0) {
                if (this.y != 0) {
                  return this.y;
                }else{
                  return null;
                }
              }else if (this.point.index === 1 || this.point.index === 2) {
                if (this.y != 0) {
                  return this.y / 2;
                }else{
                  return null;
                }
              } else {
                if (this.y != 0) {
                  return this.y / 4;
                }else{
                  return null;
                }
              }
            },
            style: {
              fontSize: '16px',
              color: '#000'
            }
          }
        }, 
        {
          name: 'Meses Inv. 6M (5 Meses Anterior)',
          data: <?php if ($firstvalue!=0) {echo "[".$paisesM6[0].",".($paisesM6[1]*2).",".($paisesM6[2]*2).",".($paisesM6[3]*4).",".($paisesM6[4]*4).",".($paisesM6[5]*4).","."]";}else{ echo "[0,0,0,0,0,0]";} ?>,
          dataLabels: {
            enabled: true,
            inside: true,
            formatter: function() {
              if (this.point.index === 0) {
                if (this.y != 0) {
                  return this.y;
                }else{
                  return null;
                }
              } else {
                if (this.y != 0) {
                  return this.y / 4;
                }else{
                  return null;
                }
              }
            },
            style: {
              fontSize: '16px',
              color: '#000'
            }
          }
        }, 
    ],
    exporting: {
          buttons: {
              contextButton: {
                  menuItems: ["viewFullscreen", "separator","downloadJPEG", "downloadPDF"]
              }
          },
           enabled: true,
    filename: 'Inventario-meses Países',
    sourceWidth: (<?php echo $paisfiltro;?>==8)? 1600:800,
    sourceHeight:(<?php echo $paisfiltro;?>==8)? 900:600,
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
          enabled: false,
          format: "{value:.0f}",
          style: {
            fontSize: "16px",
            fontFamily: "Arial"
          }
        },
        gridLineWidth: 0
      },
    },
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