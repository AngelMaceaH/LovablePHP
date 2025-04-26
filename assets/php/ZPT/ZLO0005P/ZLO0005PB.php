<script>
  $(document).ready(function () {
    //BOTONES
    var tab;
    $(".tablist__tab").click(function () {
      $(".tablist__tab").removeClass("is-active");
      $(this).addClass("is-active");
      var activeTab = $(".tablist__tab").filter(".is-active").attr("id");
      tab = (activeTab.substring(3, 4));
      document.cookie = "tabselected=" + tab;
    });

    var tabSeleccionado = <?php echo isset($_SESSION['tab']) ? $_SESSION['tab'] : "false"; ?>;
    if (tabSeleccionado != false) {
      var tabs = $('.tablist__tab'),
        tabPanels = $('.tablist__panel');
      var thisTab = $("#tab" + tabSeleccionado + ""),
        thisTabPanelId = thisTab.attr('aria-controls'),
        thisTabPanel = $('#panel' + tabSeleccionado + '');
      tabs.attr('aria-selected', 'false').removeClass('is-active');
      thisTab.attr('aria-selected', 'true').addClass('is-active');
      tabPanels.attr('aria-hidden', 'true').addClass('is-hidden');
      thisTabPanel.attr('aria-hidden', 'false').removeClass('is-hidden');
    }


    $("#cbbMes").val("<?php echo $mesfiltro; ?>");
    $("#cbbPais").val("<?php echo $paisfiltro; ?>");
    $("#cbbAno").val(<?php echo $anofiltro; ?>);
    $("#cbbOrden").val(<?php echo $ordenFiltro; ?>);

    $("#cbbPais, #cbbAno, #cbbMes, #cbbOrden").change(function () {
      $("#formFiltros").submit();
    });

    $("#myTableInvMeses").DataTable({
      stateSave: true,
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
      },

      columns: [{},
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
      "columnDefs": [{
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
      buttons: [{
        extend: 'excelHtml5',
        text: '<i class="fa-solid fa-file-excel"></i> <b >Enviar a Excel</b>',
        className: "btn btn-success text-light fs-6 ",
        exportOptions: {
          columns: [1, 2, 3, 4, 5, 6, 7]
        },
        title: 'ReporteMeses FABRICA',

        customize: function (xlsx) {
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
          sSh.childNodes[0].childNodes[5].innerHTML += s1 + s2 + s3 + s4 + s5 + s6 + s7 + s8;

          var fourDecPlaces = lastXfIndex + 1;
          var greyBoldCentered = lastXfIndex + 2;
          var twoDecPlacesBold = lastXfIndex + 3;
          var greyBoldWrapText = lastXfIndex + 4;
          var textred1 = lastXfIndex + 5;
          var textgreen1 = lastXfIndex + 6;
          var textred2 = lastXfIndex + 7;
          var textgreen2 = lastXfIndex + 8;

          $('c[r=A1] t', sheet).text('COMPARATIVO MESES DE INVENTARIO EN FABRICA (MESES)');
          $('row:eq(0) c', sheet).attr('s', greyBoldCentered);
          $('row:eq(1) c', sheet).attr('s', 7);

          var tagName = sSh.getElementsByTagName('sz');
          for (i = 0; i < tagName.length; i++) {
            tagName[i].setAttribute("val", "13")
          }
        }
      }]
    });

    $("#myTableInvUnidades").DataTable({
      stateSave: true,
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
      },

      columns: [{},
      {},
      {},
      {},
      {},
      {}
      ],
      "ordering": false,
      "pageLength": 100,
      "columnDefs": [{
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
      buttons: [{
        extend: 'excelHtml5',
        text: '<i class="fa-solid fa-file-excel"></i> <b >Enviar a Excel</b>',
        className: "btn btn-success text-light fs-6 ",
        exportOptions: {
          columns: [1, 2, 3, 4, 5]
        },
        title: 'ReporteDocenas FABRICA',
        messageTop: ' ',
        customize: function (xlsx) {
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
          var n2 = '<numFmt formatCode="#,##0"   numFmtId="200"/>';
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
          sSh.childNodes[0].childNodes[5].innerHTML += s1 + s2 + s3 + s4 + s5 + s6 + s7 + s8;

          var fourDecPlaces = lastXfIndex + 1;
          var greyBoldCentered = lastXfIndex + 2;
          var twoDecPlacesBold = lastXfIndex + 3;
          var greyBoldWrapText = lastXfIndex + 4;
          var textred1 = lastXfIndex + 5;
          var textgreen1 = lastXfIndex + 6;
          var textred2 = lastXfIndex + 7;
          var textgreen2 = lastXfIndex + 8;

          $('c[r=A1] t', sheet).text('COMPARATIVO MESES DE INVENTARIO EN FABRICA (Docenas)');
          $('row:eq(0) c', sheet).attr('s', greyBoldCentered);
          $('row:eq(1) c', sheet).attr('s', 7);

          for (let index = 3; index <= 100; index++) {
            if (($('row:eq(' + index + ') c[r^="D"]', sheet).text() * 1 < 0)) {
              $('row:eq(' + index + ') c[r^="D"]', sheet).attr('s', textred1); //ROJO
            } else {
              $('row:eq(' + index + ') c[r^="D"]', sheet).attr('s', textgreen1); //VERDE
            }
          }

          var tagName = sSh.getElementsByTagName('sz');
          for (i = 0; i < tagName.length; i++) {
            tagName[i].setAttribute("val", "13")
          }


        }

      }]
    });








    //GRAFICAS---------------------------------------------------------------
    //PAISES Docenas COMPRADAS VS Docenas VENDIDAS
    var chart = Highcharts.chart('container2', {

      chart: {
        type: 'column',
        style: {
          color: '#FFFFFF'
        }
      },
      lang: {
        viewFullscreen: "Ver en pantalla completa",
        exitFullscreen: "Salir de pantalla completa",
        downloadJPEG: "Descargar imagen JPEG",
        downloadPDF: "Descargar en PDF",
      },
      exporting: {
        enabled: true,
        filename: 'Inventario-Comparativo FABRICA',
        buttons: {
          contextButton: {
            menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
          }
        },
        plotOptions: {
          series: {
            dataLabels: {
              enabled: true,
              style: {
                color: '#FFFFFF'
              }
            }
          }
        },
        fallbackToExportServer: false
      },
      title: {
        text: 'Ingresado a planta vs. Docenas vendidas (Ultimos 12 meses)',
        margin: 50,
        style: {
          color: '#FFFFFF'
        }
      },
      tooltip: {
        style: {
          color: '#FFFFFF'
        }
      },

      xAxis: {
        categories: <?php echo json_encode($paisesLabel); ?>,
        labels: {
          x: -10,
          style: {
            color: '#FFFFFF'
          }
        }
      },

      yAxis: {
        allowDecimals: false,
        title: {
          text: ' ',
          style: {
            color: '#FFFFFF'
          }
        }
      },
      credits: {
        enabled: false
      },
      legend: {
        itemStyle: {
          color: '#FFFFFF'
        }
      },
      series: [{
        name: 'Docenas ingresadas a planta',
        data: <?php echo json_encode($paisesUndComp); ?>,
        dataLabels: {
          align: "center",
          enabled: true,
          borderColor: "",
          style: {
            fontSize: "12px",
            fontWeight: 'bold',
            fontFamily: "Arial",
            textShadow: false,
            color: '#FFFFFF'
          }
        }
      }, {
        name: 'Docenas vendidas',
        data: <?php echo json_encode($paisesUndVen); ?>,
        dataLabels: {
          align: "center",
          enabled: true,
          borderColor: "",
          style: {
            fontSize: "12px",
            fontWeight: 'bold',
            fontFamily: "Arial",
            textShadow: false,
            color: '#FFFFFF'
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
            tooltip: {
              style: {
                color: '#FFFFFF'
              }
            },
            yAxis: {
              labels: {
                align: 'left',
                x: 0,
                y: -5,
                style: {
                  color: '#FFFFFF'
                }
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
    //PAISES Docenas EXISTENCIAS
    var chart = Highcharts.chart('container3', {

      chart: {
        type: 'column',
        style: {
          color: '#FFFFFF'
        }
      },
      lang: {
        viewFullscreen: "Ver en pantalla completa",
        exitFullscreen: "Salir de pantalla completa",
        downloadJPEG: "Descargar imagen JPEG",
        downloadPDF: "Descargar en PDF",
      },
      exporting: {
        enabled: true,
        filename: 'Docenas-existencias Fabrica',
        buttons: {
          contextButton: {
            menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
          }
        },
        plotOptions: {
          series: {
            dataLabels: {
              enabled: true,
              style: {
                color: '#FFFFFF'
              }
            }
          }
        },
        fallbackToExportServer: false
      },
      title: {
        text: 'Existencias',
        margin: 50,
        style: {
          color: '#FFFFFF'
        }
      },
      tooltip: {
        style: {
          color: '#FFFFFF'
        }
      },
      xAxis: {
        categories: <?php echo json_encode($paisesLabel); ?>,
        labels: {
          x: -10,
          style: {
            color: '#FFFFFF'
          }
        }
      },

      yAxis: {
        allowDecimals: false,
        title: {
          text: ' ',
          style: {
            color: '#FFFFFF'
          }
        }
      },
      credits: {
        enabled: false
      },
      legend: {
        itemStyle: {
          color: '#FFFFFF'
        }
      },
      series: [{
        name: 'Docenas Existencia',
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
            tooltip: {
              style: {
                color: '#FFFFFF'
              }
            },
            yAxis: {
              labels: {
                align: 'left',
                x: 0,
                y: -5,
                style: {
                  color: '#FFFFFF'
                }
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
    /*Highcharts.setOptions({
      colors: [
        "rgba(222, 84, 44,0.6)", "rgba(239, 126, 50,0.6)", "rgba(238, 154, 58,0.6)", "rgba(234, 219, 56,0.6)",
        "rgba(79, 32, 13,0.6)", "rgba(231, 227, 78,0.6)",
        "rgba(20, 36, 89,0.6)", "rgba(23, 107, 160,0.6)", "rgba(25, 170, 222,0.6)", "rgba(26, 201, 230,0.6)",
        "rgba(29, 228, 219,0.6)", "rgba(109, 240, 210,0.6)",
      ]
    });*/
    //PAISES INVENTARIO
    Highcharts.chart('container', {
      chart: {
        type: 'column',
        style: {
          color: '#FFFFFF'
        }
      },
      lang: {
        viewFullscreen: "Ver en pantalla completa",
        exitFullscreen: "Salir de pantalla completa",
        downloadJPEG: "Descargar imagen JPEG",
        downloadPDF: "Descargar en PDF",
      },
      exporting: {
        enabled: true,
        filename: 'Docenas-existencias Fabrica',
        buttons: {
          contextButton: {
            menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
          }
        },
        plotOptions: {
          series: {
            dataLabels: {
              enabled: true,
              style: {
                color: '#FFFFFF'
              }
            }
          }
        },
        fallbackToExportServer: false
      },
      title: {
        text: '',
        margin: 50
      },
      tooltip: {
        style: {
          color: '#FFFFFF'
        }
      },
      xAxis: {
        categories: <?php echo json_encode($paisesLabel); ?>,
        labels: {
          x: -10,
          style: {
            color: '#FFFFFF'
          }
        }
      },

      yAxis: {
        allowDecimals: false,
        title: {
          text: ' ',
          style: {
            color: '#FFFFFF'
          }
        }
      },
      credits: {
        enabled: false
      },
      legend: {
        itemStyle: {
          color: '#FFFFFF'
        }
      },
      series: [{
        name: 'Meses Inv. 6M',
        data: <?php echo json_encode($paisesM1); ?>,
        dataLabels: [{
          enabled: true,
          inside: true,
          style: {
            fontSize: '16px',
            color: '#fff',
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
            fontSize: '16px',
            color: '#fff',
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
            fontSize: '16px',
            color: '#fff',
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
            fontSize: '16px',
            color: '#fff',
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
            fontSize: '16px',
            color: '#fff',
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
            fontSize: '16px',
            color: '#fff',
          }
        }],
      },
      ],
      exporting: {
        buttons: {
          contextButton: {
            menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
          }
        },
        enabled: true,
        filename: 'Inventario-meses Fabrica',
        sourceWidth: (<?php echo $paisfiltro; ?> == 1) ? 1600 : 800,
        sourceHeight: (<?php echo $paisfiltro; ?> == 1) ? 900 : 600,
        chartOptions: {

          title: {
            style: {
              fontSize: (<?php echo $paisfiltro; ?> == 1) ? '30px' : '20px',
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
          tooltip: {
            style: {
              color: '#FFFFFF'
            }
          },
          xAxis: {
            //lineWidth: 1,
            labels: {
              rotate: -45,
              enabled: true,
              //format: "{value:.0f}",
              style: {
                fontSize: "10px",
                fontFamily: "Arial",
                color: '#FFFFFF'
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
                color: '#FFFFFF'
              }
            },
            labels: {
              //rotate: -45,
              enabled: true,
              format: "{value:.0f}",
              style: {
                fontSize: "16px",
                fontFamily: "Arial",
                color: '#FFFFFF'
              }
            },
            gridLineWidth: 0
          },
        },
        fallbackToExportServer: false
      },

    });

    //GRAFICAS HISTORIAL
    if (<?php echo $validator1; ?>) {
      $("#grafica1").addClass("d-none");
      $("#grafica3").addClass("d-none");
    }
    if (<?php echo $validator2; ?>) {
      $("#grafica2").addClass("d-none");
    }

    const url = "http://172.16.15.20/API.LovablePHP/ZLO0005P/ListHis/";
    const dataSend = {
      "cia": 1,
      "ano": $("#cbbAno").val(),
      "mes": $("#cbbMes").val()
    };
    let inven = []; let lblmeses=[];
    let vend = []; let exis=[];
    fetch(url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(dataSend)
    }).then(response => {
      return response.json();
    }).then(data => {
      if (data.code == 200) {
        const dataResponse = data.data;
        vend = dataResponse.map((vend) => {
          return vend.UNIVEN
        })
        inven = dataResponse.map((vend) => {
          return vend.UNICOM
        })
        exis = dataResponse.map((vend) => {
          return vend.UNIEXI
        })
        lblmeses=obtenerUltimosMeses(parseInt($("#cbbMes").val()),parseInt($("#cbbAno").val()))
      }
    }).then(() => {
      Highcharts.chart('container4', {
        chart: {
          type: 'line',

          style: {
            color: '#FFFFFF'
          }
        },
        lang: {
          viewFullscreen: "Ver en pantalla completa",
          exitFullscreen: "Salir de pantalla completa",
          downloadJPEG: "Descargar imagen JPEG",
          downloadPDF: "Descargar en PDF",
        },
        title: {
          text: 'Ingresado a planta vs. Docenas vendidas (Ultimos 12 meses)',
          align: 'center',
          style: {
            color: '#FFFFFF'
          }
        },
        xAxis: {
          categories:lblmeses,
          labels: {
            style: {
              color: '#FFFFFF'
            }
          }
        },
        yAxis: {
          title: {
            text: ' ',
            style: {
              color: '#FFFFFF'
            }
          },
          labels: {
            style: {
              color: '#FFFFFF'
            }
          }
        },
        tooltip: {
          style: {
            color: '#FFFFFF'
          }
        },
        plotOptions: {
          line: {
            dataLabels: {
              enabled: true,
              style: {
                color: '#FFFFFF'
              }
            },
            enableMouseTracking: true
          }
        },
        credits: {
          enabled: false
        },
        legend: {
          itemStyle: {
            color: '#FFFFFF'
          }
        },
        exporting: {
          buttons: {
            contextButton: {
              menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
            },
          },
          enabled: true,
          sourceWidth: 1600,
          sourceHeight: 700,
          chartOptions: {
            chart: {
              backgroundColor: '#303030',
              style: {
                color: '#FFFFFF'
              }
            }
          },
          fallbackToExportServer: false
        },
        series: [{
          "name": "Ingresado a planta",
          "color": "#34d399",
          "data": inven
        },
        {
          "name": "Vendido",
          "color": "#1d4ed8",
          "data": vend
        }
        ],
      });
      Highcharts.chart('container5', {
        chart: {
          type: 'line',

          style: {
            color: '#FFFFFF'
          }
        },
        lang: {
          viewFullscreen: "Ver en pantalla completa",
          exitFullscreen: "Salir de pantalla completa",
          downloadJPEG: "Descargar imagen JPEG",
          downloadPDF: "Descargar en PDF",
        },
        title: {
          text: 'Historial de existencias',
          align: 'center',
          style: {
            color: '#FFFFFF'
          }
        },
        xAxis: {
          categories:lblmeses,
          labels: {
            style: {
              color: '#FFFFFF'
            }
          }
        },
        yAxis: {
          title: {
            text: ' ',
            style: {
              color: '#FFFFFF'
            }
          },
          labels: {
            style: {
              color: '#FFFFFF'
            }
          }
        },
        tooltip: {
          style: {
            color: '#FFFFFF'
          }
        },
        plotOptions: {
          line: {
            dataLabels: {
              enabled: true,
              style: {
                color: '#FFFFFF'
              }
            },
            enableMouseTracking: true
          }
        },
        credits: {
          enabled: false
        },
        legend: {
          itemStyle: {
            color: '#FFFFFF'
          }
        },
        exporting: {
          buttons: {
            contextButton: {
              menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
            },
          },
          enabled: true,
          sourceWidth: 1600,
          sourceHeight: 700,
          chartOptions: {
            chart: {
              backgroundColor: '#303030',
              style: {
                color: '#FFFFFF'
              }
            }
          },
          fallbackToExportServer: false
        },
        series: [{
          "name": "Docenas en existencia",
          "color": "#d946ef",
          "data": exis
        },
        ],
      });
    })
    function obtenerUltimosMeses(mesInicial, anioInicial) {
    const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
        'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
    ];

    const resultado = [];
    let mesActual = mesInicial % 12;
    let anioActual = anioInicial;
    let cambia = false;
    for (let i = 0; i < 12; i++) {
        mesActual = (mesActual + 1) % 12;
        if (mesActual === 0) {
          cambia=true;
        }
    }
    if(cambia){
       anioActual = anioInicial-1;
    }
    for (let i = 0; i < 12; i++) {
        resultado.push(`${meses[mesActual]} ${anioActual}`);
        mesActual = (mesActual + 1) % 12;
        if (mesActual === 0) {
            anioActual += 1;
        }
    }

    return resultado;
}
  });


</script>