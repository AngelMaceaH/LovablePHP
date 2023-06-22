<script>
        $( document ).ready(function() {
            <?php
              $ordenFiltro=isset($_SESSION['Orden2']) ? $_SESSION['Orden2'] : 1;
              $ordenFiltro3=isset($_SESSION['Orden3']) ? $_SESSION['Orden3'] : 1;
              $ordenFiltro4=isset($_SESSION['Orden4']) ? $_SESSION['Orden4'] : 2;
              $productos=isset($_SESSION['productos']) ? $_SESSION['productos']:0;
              $filtro1=isset($_SESSION['filtro1']) ? $_SESSION['filtro1']:1;
              $_SESSION['tab3'] = isset($_COOKIE['tabselected3']) ? $_COOKIE['tabselected3'] : "1";
            ?>
          //BOTONES
            var tab;
                $(".tablist__tab").click(function() {
                  $(".tablist__tab").removeClass("is-active");
                  $(this).addClass("is-active");
                  var activeTab = $(".tablist__tab").filter(".is-active").attr("id");
                  tab=(activeTab.substring(3,4));
                  document.cookie="tabselected3="+tab;
                });
                var tabSeleccionado=<?php echo isset($_SESSION['tab3']) ? $_SESSION['tab3'] : "false"; ?>;
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
          $("#cbbOrden2").val(<?php echo $ordenFiltro;  ?>); 
          $("#cbbOrden3").val(<?php echo $ordenFiltro3;  ?>); 
          $("#cbbOrden4").val(<?php echo $ordenFiltro4;  ?>); 
          $("#filtro1").val(<?php echo $filtro1;  ?>); 
          $('#productos, #productos3, #productos4').prop('checked',<?php echo $productos;  ?>);
          $("#cbbOrden2, #productos, #filtro1").change(function() {
            $("#formOrden").submit();
          });
          $("#cbbOrden3, #productos3").change(function() {
            $("#formOrden3").submit();
          });
          $("#cbbOrden4, #productos4").change(function() {
            $("#formOrden4").submit();
          });



           //LLENADO TABLA
            var ordenPOV = '<?php echo $ordenFiltro; ?>';       
            var otrosProd = '<?php echo $productos; ?>';  
            var filtro1= '<?php echo $filtro1; ?>';  
            var urlPOV='http://172.16.15.20/API.LovablePHP/ZLO0002P/ListPOV/?orden='+ordenPOV+'&otros='+otrosProd+''+'&filtro='+filtro1+'';
            var responsePOV = ajaxRequest(urlPOV);
            var ordenFab = '<?php echo $ordenFiltro4; ?>';   
            var urlFab='http://172.16.15.20/API.LovablePHP/ZLO0002P/ListFabrica/?orden='+ordenFab+'&otros='+otrosProd+'';
            var responseFab= ajaxRequest(urlFab);
            console.log(responseFab.data);
          if (responsePOV.code==200) {
            var cantidadInv=0; var docenas=0; var decimales=0;
            var ciaArray=[]; var invArray=[];
            for (let i = 0; i < responsePOV.data.length; i++) {
                docenas=Math.floor(parseFloat(responsePOV.data[i]['MAESA2'])/12);
                decimales=(parseFloat(responsePOV.data[i]['MAESA2'])-(docenas*12));
                decimales=decimales.toString();
                if (decimales.length==1) {
                decimales="0.0"+decimales;
                }else{
                decimales="0."+decimales;
                }
                cantidadInv=docenas+parseFloat(decimales);
                $("#myTableInventarioBody").append(`<tr id="tr${i}">`);
                    $('#tr'+i+'').append("<td class='fw-bold'>"+responsePOV.data[i]['CODSEC']+"</td>");
                    $('#tr'+i+'').append("<td class='fw-bold'>"+responsePOV.data[i]['NOMCIA']+"</td>");
                    $('#tr'+i+'').append("<td class='fw-bold'>"+cantidadInv.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+"</td>");
                $("#myTableInventarioBody").append(`</tr>`);
                ciaArray.push(responsePOV.data[i]['NOMCIA']);
                invArray.push(parseFloat(cantidadInv));
            }
           }
           var ordenPaises = '<?php echo $ordenFiltro3; ?>'; 
           var urlPaises='http://172.16.15.20/API.LovablePHP/ZLO0002P/ListPais/?orden='+ordenPaises+'&otros='+otrosProd+'';
           var responsePaises = ajaxRequest(urlPaises);
           if (responsePaises.code==200) {
            var paisArray=[]; var invPaisArray=[];
            for (let i = 0; i < responsePaises.data.length; i++) {
                $("#myTableInventarioPaises").append(`<tr> 
                <td class='fw-bold'>1</td>
                <td class='fw-bold'>`+responsePaises.data[i]['Pais']+`</td>
                <td class='fw-bold'>`+responsePaises.data[i]['MAESA2'].toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+`</td>
                </tr>`);
                paisArray.push(responsePaises.data[i]['Pais']);
                invPaisArray.push(parseFloat(responsePaises.data[i]['MAESA2']));
            }
        }

        if (responseFab.code==200) {
            var cantidadInv=0; var docenas=0; var decimales=0;
            var ciaFab=[]; var invFab=[];
            for (let i = 0; i < responseFab.data.length; i++) {
                docenas=Math.floor(parseFloat(responseFab.data[i]['MAESA2'])/12);
                decimales=(parseFloat(responseFab.data[i]['MAESA2'])-(docenas*12));
                decimales=decimales.toString();
                if (decimales.length==1) {
                decimales="0.0"+decimales;
                }else{
                decimales="0."+decimales;
                }
                cantidadInv=docenas+parseFloat(decimales);
                $("#myTableInventarioFabBody").append(`<tr id="tl${i}">`);
                    $('#tl'+i+'').append("<td class='fw-bold'>"+responseFab.data[i]['CODSEC']+"</td>");
                    $('#tl'+i+'').append("<td class='fw-bold'>"+responseFab.data[i]['NOMCIA']+"</td>");
                    $('#tl'+i+'').append("<td class='fw-bold'>"+cantidadInv.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+"</td>");
                $("#myTableInventarioFabBody").append(`</tr>`);
                ciaFab.push(responseFab.data[i]['NOMCIA']);
                invFab.push(parseFloat(cantidadInv));
            }
           }
          $("#myTableInventario, #myTableInventarioPaises, #myTableInventarioFab").DataTable( {
            stateSave: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },

        columns: [
            {},
            {},
            {},
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
            ],
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fa-solid fa-file-excel"></i> <b >Enviar a Excel</b>',
                className: "btn btn-success text-light fs-6 mb-2",
                exportOptions: {
                    columns: [1,2]
                },
                title: 'ReporteInventario Tiendas',
                
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
                    
                    $('c[r=A1] t', sheet).text( 'REPORTE DE INVENTARIO DISPONIBLE' );
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
   
          Chart.register(ChartDataLabels);
          //GRAFICA PAISES BARRA    
          

              Highcharts.chart('container2', {
    lang: {      
          viewFullscreen:"Ver en pantalla completa",
          exitFullscreen:"Salir de pantalla completa",
          downloadJPEG:"Descargar imagen JPEG",
          downloadPDF:"Descargar en PDF",
      },
      chart: {
        height: 500,
        type: 'column'
      },
      title: {
          text: '',
      },
      xAxis: {
        className: 'fw-bold',
          categories: paisArray,
      },
      yAxis: {
      min: 0,
      endOnTick: false,
      tickInterval: 2600.01,
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
          name: 'Inventario Disponible',
          data: invPaisArray,
          dataLabels: [{
            align: "center",
            inside: false,
            enabled: true,
            borderColor: "",
            style: {
              fontSize: "12px",
              fontWeight: 'bold',
              fontFamily: "Arial",
              textShadow: false
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
        filename: 'Inventario-disponible Países',
        sourceWidth: 1600,
        sourceHeight: 900,
        chartOptions: {
        
          title: {
            style: {
                fontSize: '20px',
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
          },
          
      });
            //GRAFICA PAISES DONA
            const ctx3 = document.getElementById('miGrafica3').getContext('2d');
            var myChart3 = new Chart(ctx3, {
              type: 'pie',
              data: {
                  labels:  paisArray,
                  datasets: [{
                    label: 'Docenas',
                    data: invPaisArray,
                      backgroundColor: [
                        "rgba(20, 36, 89,0.6)","rgba(23, 107, 160,0.6)","rgba(25, 170, 222,0.6)","rgba(26, 201, 230,0.6)","rgba(29, 228, 219,0.6)","rgba(109, 240, 210,0.6)",
                        "rgba(41, 6, 107,0.6)","rgba(125, 58, 193,0.6)","rgba(175, 75, 206,0.6)","rgba(219, 76, 178,0.6)","rgba(130, 4, 1,0.6)","rgba(192, 35, 35,0.6)",
                        "rgba(222, 84, 44,0.6)","rgba(239, 126, 50,0.6)","rgba(238, 154, 58,0.6)","rgba(234, 219, 56,0.6)","rgba(79, 32, 13,0.6)","rgba(231, 227, 78,0.6)",
                      ],
                      borderColor: [
                        "rgba(0,0,0,0.2)"
                      ],
                      borderWidth: 1
                  }]
              },
                      options: {
                        "tooltips": {
                          "callbacks":{
                            "label": function(tooltipItem, data) {
                              var label = "prueba";
                              var value = "1";
                              return label + ': ' + value;
                            }
                          }
                        },
                        maintainAspectRatio:false,
                    responsive: false,
                    "plugins": {
                  "legend": {
                    "display": false,
                    "position": "bottom",
                    
                  },
                  datalabels: {   
                    color: '#fff',
                    offset: -10,
                  }
                },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            });

            //GRAFICA PUNTO DE VENTAS

            //PAISES INVENTARIO
  Highcharts.chart('container', {
    lang: {      
          viewFullscreen:"Ver en pantalla completa",
          exitFullscreen:"Salir de pantalla completa",
          downloadJPEG:"Descargar imagen JPEG",
          downloadPDF:"Descargar en PDF",
      },
      chart: {
        height: 500,
        type: 'column'
      },
      title: {
          text: '',
      },
      xAxis: {
        className: 'fw-bold',
          categories: ciaArray,
      },
      yAxis: {
      min: 0,
      endOnTick: false,
      tickInterval: 500,
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
          name: 'Inventario Disponible',
          data: invArray,
          dataLabels: [{
            align: "center",
            inside: false,
            enabled: true,
            borderColor: "",
            style: {
              fontSize: "12px",
              fontWeight: 'bold',
              fontFamily: "Arial",
              textShadow: false
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
        filename: 'Inventario-disponible Tiendas',
        sourceWidth: 1600,
        sourceHeight: 900,
        chartOptions: {
        
          title: {
            style: {
                fontSize: '20px',
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
          },
          
      });
              //GRAFICA PUNTO DE VENTA DONA
            const ctx4 = document.getElementById('miGrafica4').getContext('2d');

            var myChart4 = new Chart(ctx4, {
              type: 'pie',
              data: {
                  labels: ciaArray,
                  datasets: [{
                    label: 'Docenas',
                      data:invArray,
                      backgroundColor: [
                        "rgba(20, 36, 89,0.6)","rgba(23, 107, 160,0.6)","rgba(25, 170, 222,0.6)","rgba(26, 201, 230,0.6)","rgba(29, 228, 219,0.6)","rgba(109, 240, 210,0.6)",
                        "rgba(41, 6, 107,0.6)","rgba(125, 58, 193,0.6)","rgba(175, 75, 206,0.6)","rgba(219, 76, 178,0.6)","rgba(130, 4, 1,0.6)","rgba(192, 35, 35,0.6)",
                        "rgba(222, 84, 44,0.6)","rgba(239, 126, 50,0.6)","rgba(238, 154, 58,0.6)","rgba(234, 219, 56,0.6)","rgba(79, 32, 13,0.6)","rgba(231, 227, 78,0.6)",
                      ],
                      borderColor: [
                        "rgba(0,0,0,0.2)"
                      ],
                      borderWidth: 1
                  }]
              },
                      options: {
                        "tooltips": {
                          "callbacks":{
                            "label": function(tooltipItem, data) {
                              var label = "prueba";
                              var value = "1";
                              return label + ': ' + value;
                            }
                          }
                        },
                        maintainAspectRatio:false,
                    responsive: false,
                    "plugins": {
                  "legend": {
                    "display": false,
                    "position": "bottom",
                    
                  },
                  datalabels: {
                    formatter: (value, ctx) => {
                      const datapoints = ctx.chart.data.datasets[0].data
                      const total = datapoints.reduce((total, datapoint) => total + datapoint, 0)
                      const percentage = value / total * 100
                      return percentage.toFixed(2) + "%";
                    },
                    color: '#fff',
                    offset: -10,
                  }
                },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            });

             //GRAFICA FABRICA BARRA    
          

             Highcharts.chart('container3', {
    lang: {      
          viewFullscreen:"Ver en pantalla completa",
          exitFullscreen:"Salir de pantalla completa",
          downloadJPEG:"Descargar imagen JPEG",
          downloadPDF:"Descargar en PDF",
      },
      chart: {
        height: 500,
        type: 'column'
      },
      title: {
          text: '',
      },
      xAxis: {
        className: 'fw-bold',
          categories: ciaFab,
      },
      yAxis: {
      min: 0,
      endOnTick: false,
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
          name: 'Inventario Disponible',
          data: invFab,
          dataLabels: [{
            align: "center",
            inside: false,
            enabled: true,
            borderColor: "",
            style: {
              fontSize: "12px",
              fontWeight: 'bold',
              fontFamily: "Arial",
              textShadow: false
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
        filename: 'Inventario-disponible Fabrica',
        sourceWidth: 1600,
        sourceHeight: 900,
        chartOptions: {
        
          title: {
            style: {
                fontSize: '20px',
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
          },
          
      });
        });
         
           
      </script>