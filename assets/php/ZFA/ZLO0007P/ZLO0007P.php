<script>

            const picker2 = new easepick.create({
            element: "#datepicker2",
            css: ["../../assets/vendors/dayrangepicker/index.css"],
            zIndex: 10,
            plugins: ["RangePlugin"]});
            $( document ).ready(function() {
              $('#cbbCia').select2();
              var compfiltro = ("<?php echo $arrayConversion;?>").split(",")
                                                                  .filter(item => item) 
                                                                  .map(item => Number(item));
              if (compfiltro.length==0) {
                compfiltro.push(999);
              }
              if (compfiltro.length > 1) {
                  let index = compfiltro.indexOf(999);
                  if (index !== -1) { 
                    compfiltro.splice(index, 1); 
                  }
              }
              var paisfiltro = "<?php echo $paisFiltro; ?>";
              $("#cbbCia").val(compfiltro).trigger('change');
              $("#cbbPais").val(paisfiltro);
            $("#cbbCia, #cbbPais").on( "change", function() {
             
              var selectId = event.target.id;
              if (selectId === "cbbPais") {
               $("#cbbClick").val("cbbPais");
              } else{
                $("#cbbClick").val("cbbCia");
              }
                // $("#formFiltros").submit();
              });
            
           

            if (<?php echo $validator1;?>) {
              $("#grafica1").addClass("d-none");
            }
            var labelActual="";
        /*if (<?php echo isset($_SESSION['clickCia'])? $_SESSION['clickCia']:0;?>==1) {
            if ($("#cbbCia").val()==999) {
                labelActual=$('#cbbCia').find(":selected").text()+' '+$('#cbbPais').find(":selected").text()+'';
            }else{
                labelActual=$('#cbbCia').find(":selected").text();
            }
          
        }
        if (<?php echo isset($_SESSION['clickPais'])? $_SESSION['clickPais']:0;?>==1) {
            labelActual=$('#cbbCia').find(":selected").text()+'     '+$('#cbbPais').find(":selected").text()+'';
        }
        $("#lblRadial").text(labelActual);*/

            $("#myTableVendedorVentas").DataTable( {
           
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },
        "ordering": false,
        "pageLength": 100,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fa-solid fa-file-excel"></i> <b >Enviar a Excel</b>',
                className: "btn btn-success text-light fs-6 ",
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10]
                },
                title: 'ReportesVentas Vendedor',
                
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
                    
                    $('c[r=A1] t', sheet).text( 'REPORTE DE VENTAS POR VENDEDOR' );
                    $('row:eq(0) c', sheet).attr( 's', greyBoldCentered );
                    $('row:eq(1) c', sheet).attr( 's', 7 );
                    for (let index = 2; index <= 100; index++) {
                      
                      if (($('row:eq('+index+') c[r^="H"]', sheet).text()*1<0)) {
                        $('row:eq('+index+') c[r^="H"]', sheet).attr( 's', textred2 );  //ROJO
                      }else{
                        $('row:eq('+index+') c[r^="H"]', sheet).attr( 's', textgreen2 );  //VERDE
                      }
                    }
                    for (let index = 2; index <= 100; index++) {
                     
                      if ($('row:eq('+index+') c[r^="G"]', sheet).text()<0) {
                        $('row:eq('+index+') c[r^="G"]', sheet).attr( 's', textred1 );  //ROJO
                      }else{
                        $('row:eq('+index+') c[r^="G"]', sheet).attr( 's', textgreen1 );  //VERDE
                      }
                    }

                    for (let index = 2; index <= 100; index++) {
                      
                      if (($('row:eq('+index+') c[r^="K"]', sheet).text()*1<0)) {
                        $('row:eq('+index+') c[r^="K"]', sheet).attr( 's', textred2 );  //ROJO
                      }else{
                        $('row:eq('+index+') c[r^="K"]', sheet).attr( 's', textgreen2 );  //VERDE
                      }
                    }
                    for (let index = 2; index <= 100; index++) {
                     
                      if ($('row:eq('+index+') c[r^="J"]', sheet).text()<0) {
                        $('row:eq('+index+') c[r^="J"]', sheet).attr( 's', textred1 );  //ROJO
                      }else{
                        $('row:eq('+index+') c[r^="J"]', sheet).attr( 's', textgreen1 );  //VERDE
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

          //GRAFICA PIE
          
          if (compfiltro[0]==999 && <?php echo $paisFiltro; ?>==1) {
            Highcharts.chart('container4', {
    lang: {      
          viewFullscreen:"Ver en pantalla completa",
          exitFullscreen:"Salir de pantalla completa",
          downloadJPEG:"Descargar imagen JPEG",
          downloadPDF:"Descargar en PDF",
      },
      chart: {
        height: (compfiltro[0]==999 && <?php echo $paisFiltro;?>==1)? 1000:800,
          type: 'bar'
      },
      title: {
          text: 'Ventas por Vendedor',
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
        min: 0,
        max: <?php echo (count($vendedoresLabel)>10)? 10: count($vendedoresLabel)-1;?>,
        scrollbar: {
            enabled: true
        },
        className: 'fw-bold',
          categories:<?php echo json_encode($vendedoresLabel);?>,
      },
      yAxis: {
        scrollbar: {
            enabled: true
        },
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
          name: 'Ventas',
          data: <?php echo json_encode($vendedoresVentas2);?>,
          dataLabels: [{
            enabled: true,
            inside: true,
            style: {
                fontSize:'16px',
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
            filename: 'Reporte de ventas - Vendedores',
            sourceWidth: (compfiltro[0]==999 && <?php echo $paisFiltro;?>==1)? 800:1600,
            sourceHeight:(compfiltro[0]==999 && <?php echo $paisFiltro;?>==1)? 2500:900,
            chartOptions: {
            
              title: {
                style: {
                    fontSize: (<?php echo $paisFiltro;?>==1)? '30px':'20px',
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
                min: 0,
                max: 20,
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
          }else{
            var boolVal=(window.screen.width<900)? false:true;
            //ELSE===============================================================================
            Highcharts.chart('container4', {
            lang: {      
                  viewFullscreen:"Ver en pantalla completa",
                  exitFullscreen:"Salir de pantalla completa",
                  downloadJPEG:"Descargar imagen JPEG",
                  downloadPDF:"Descargar en PDF",
              },
    chart: {
      height: (compfiltro[0]==999 && <?php echo $paisFiltro;?>==1)? 1000:600,
        type: 'pie',
       /* options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }*/
    },
    title: {
      text: 'Ventas por Vendedor',
       margin: 50
      },
      subtitle: {
        style: {
                fontSize:'16px',
                color: '#000',
            },
        text: labelActual,
        align: 'center'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
          enabled: true,
        
          color: '#333333',
          formatter: function() {
            return '<b>' + this.point.name + '</b>: <br/> <span class="fw-bold fs-6">' + this.point.y.toLocaleString('en-ES')+'</span>';
          }
        },
        },
    },
   
    credits: {
      enabled: false
    },
    series: [{
                  name: 'Ventas',
                  data: [
                      <?php
                        for ($i=0; $i < count($vendedoresVentas) ; $i++) { 
                          foreach($vendedoresVentas[$i] as $x=>$x_value)
                          {
                          echo "['". $x . "'," . $x_value."],";
                          }
                        }

                      ?>
                  ],
                  dataLabels: {
                    enabled: boolVal,
                 }
              }],
              exporting: {
          buttons: {
              contextButton: {
                  menuItems: ["viewFullscreen", "separator","downloadJPEG", "downloadPDF"]
              }
          },
           enabled: true,
            filename: 'Reporte de ventas - Vendedores',
            sourceWidth: (compfiltro[0]==999 && <?php echo $paisFiltro;?>==1)? 3000:1600,
            sourceHeight:(compfiltro[0]==999 && <?php echo $paisFiltro;?>==1)? 3000:900,
            chartOptions: {
            
              title: {
                style: {
                    fontSize: (<?php echo $paisFiltro;?>==1)? '30px':'20px',
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
          }
          
     //GRAFICA DE DONA
    if (compfiltro[0]==999 && <?php echo $paisFiltro; ?>==1) {
      
        Highcharts.chart('container3', {
    lang: {      
          viewFullscreen:"Ver en pantalla completa",
          exitFullscreen:"Salir de pantalla completa",
          downloadJPEG:"Descargar imagen JPEG",
          downloadPDF:"Descargar en PDF",
      },
      chart: {
        height: (compfiltro[0]==999 && <?php echo $paisFiltro;?>==1)? 1000:800,
          type: 'bar'
      },
      title: {
          text: 'Unidades por Vendedor',
          margin: 50
      },
      subtitle: {
        style: {
                fontSize:'16px',
                color: '#000',
            },
        text: labelActual,
        align: 'center'
    },
      xAxis: {
        min: 0,
        max: <?php echo (count($vendedoresLabel)>10)? 10: count($vendedoresLabel)-1;?>,
        scrollbar: {
            enabled: true
        },
        className: 'fw-bold',
          categories:<?php echo json_encode($vendedoresLabel);?>,
      },
      yAxis: {
        scrollbar: {
            enabled: true
        },
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
          name: 'Unidades',
          data: <?php echo json_encode($vendedoresUnidades2);?>,
          dataLabels: [{
            enabled: true,
            inside: true,
            style: {
                fontSize:'16px',
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
            filename: 'Reporte de unidades - Vendedores',
            sourceWidth: (compfiltro[0]==999 && <?php echo $paisFiltro;?>==1)? 800:1600,
            sourceHeight:(compfiltro[0]==999 && <?php echo $paisFiltro;?>==1)? 2500:900,
            chartOptions: {
            
              title: {
                style: {
                    fontSize: (<?php echo $paisFiltro;?>==1)? '30px':'20px',
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
                min: 0,
                max: <?php echo count($vendedoresLabel)-1; ?>,
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
    }else{
        //ELSE---------------------------------------------------
        var boolVal=(window.screen.width<900)? false:true;
        Highcharts.chart('container3', {
                  lang: {      
                  viewFullscreen:"Ver en pantalla completa",
                  exitFullscreen:"Salir de pantalla completa",
                  downloadJPEG:"Descargar imagen JPEG",
                  downloadPDF:"Descargar en PDF",
              },
              chart: {
                height: (compfiltro[0]==999 && <?php echo $paisFiltro;?>==1)? 1000:600,
                  type: 'pie',
                 /* options3d: {
                      enabled: true,
                      alpha: 45
                  }*/
              },
              title: {
                  text: 'Unidades por Vendedor',
                  margin: 50
              },
              subtitle: {
                style: {
                fontSize:'16px',
                color: '#000',
            },
        text: labelActual,
        align: 'center'
    },
    plotOptions: {
      pie: {
        size: '100%',
        center: ['50%', '50%'],
        borderWidth: 0,
        dataLabels: {
          enabled: true,
        
          color: '#333333',
          formatter: function() {
            return '<b>' + this.point.name + '</b>: <br/> <span class="fw-bold fs-6">' + this.point.y.toLocaleString('en-ES')+' Und.</span>';
          }
        },
      }
    },
              credits: {
      enabled: false
    },
              series: [{
                  name: 'Unidades',
                  data: [
                      <?php
                        for ($i=0; $i < count($vendedoresUnidades) ; $i++) { 
                          foreach($vendedoresUnidades[$i] as $x=>$x_value)
                          {
                          echo "['". $x . "'," . $x_value."],";
                          }
                        }

                      ?>
                  ],
                  dataLabels: {
                    enabled: boolVal,
                    inside: true,
                 }
                  
              }],
              exporting: {
          buttons: {
              contextButton: {
                  menuItems: ["viewFullscreen", "separator","downloadJPEG", "downloadPDF"]
              }
          },
           enabled: true,
            filename: 'Reporte de transacciones - Vendedores',
            sourceWidth: (compfiltro[0]==999 && <?php echo $paisFiltro;?>==1)? 800:1600,
            sourceHeight:(compfiltro[0]==999 && <?php echo $paisFiltro;?>==1)? 2500:900,
            chartOptions: {
            
              title: {
                style: {
                    fontSize: (<?php echo $paisFiltro;?>==1)? '30px':'20px',
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
    }   
      //GRAFICA TRANSACCIONES
      Highcharts.setOptions({
    colors: [
        "rgba(231, 227, 78,0.6)",

    ]
  });
       Highcharts.chart('container2', {
    lang: {      
          viewFullscreen:"Ver en pantalla completa",
          exitFullscreen:"Salir de pantalla completa",
          downloadJPEG:"Descargar imagen JPEG",
          downloadPDF:"Descargar en PDF",
      },
      chart: {
        height: (compfiltro[0]==999 && <?php echo $paisFiltro;?>==1)? 1000:800,
          type: 'bar'
      },
      title: {
          text: 'Transacciones por Vendedor',
          margin: 50
      },
      subtitle: {
        style: {
                fontSize:'16px',
                color: '#000',
            },
        text: labelActual,
        align: 'center'
    },
      xAxis: {
        min: 0,
        max: <?php echo (count($vendedoresLabel)>10)? 10: count($vendedoresLabel)-1;?>,
        scrollbar: {
            enabled: true
        },
        className: 'fw-bold',
          categories:<?php echo json_encode($vendedoresLabel);?>,
      },
      yAxis: {
        scrollbar: {
            enabled: true
        },
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
          name: 'Transacciones',
          data: <?php echo json_encode($transacciones);?>,
          dataLabels: [{
            enabled: true,
            inside: true,
            style: {
                fontSize:'16px',
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
            filename: 'Reporte de transacciones - Vendedores',
            sourceWidth: (compfiltro[0]==999 && <?php echo $paisFiltro;?>==1)? 800:1600,
            sourceHeight:(compfiltro[0]==999 && <?php echo $paisFiltro;?>==1)? 2500:900,
            chartOptions: {
            
              title: {
                style: {
                    fontSize: (<?php echo $paisFiltro;?>==1)? '30px':'20px',
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
                min: 0,
                max: <?php echo count($vendedoresLabel)-1; ?>,
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
          Highcharts.setOptions({
    colors: [
       "rgba(222, 84, 44,0.6)","rgba(238, 154, 58,0.6)","rgba(234, 219, 56,0.6)", 
      "rgba(23, 107, 160,0.6)","rgba(25, 170, 222,0.6)","rgba(26, 201, 230,0.6)","rgba(29, 228, 219,0.6)","rgba(109, 240, 210,0.6)",
    ]
  });

  //GRAFICA STACKED VENTAS
          Highcharts.chart('container', {
    lang: {      
          viewFullscreen:"Ver en pantalla completa",
          exitFullscreen:"Salir de pantalla completa",
          downloadJPEG:"Descargar imagen JPEG",
          downloadPDF:"Descargar en PDF",
      },
      chart: {
        height: (compfiltro[0]==999 && <?php echo $paisFiltro;?>==1)? 1000:800,
          type: 'bar'
      },
      title: {
          text: 'Venta 2 Años Antes, Venta Año Anterior y Venta por Vendedor (Dolares)',
          margin: 50
      },
      subtitle: {
        style: {
                fontSize:'16px',
                color: '#000',
            },
        text: labelActual,
        align: 'center'
    },
      xAxis: {
        min: 0,
        max: <?php echo (count($vendedoresLabel)>10)? 10: count($vendedoresLabel)-1;?>,
        scrollbar: {
            enabled: true
        },
        className: 'fw-bold',
          categories:<?php echo json_encode($vendedoresLabel);?>,
      },
      yAxis: {
        scrollbar: {
            enabled: true
        },
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
          name: 'Venta',
          data: <?php echo json_encode($v1);?>,
          dataLabels: [{
            enabled: true,
            inside: true,
            style: {
                fontSize:'16px',
                color: '#000',
            },
            formatter: function() {
                return abreviarNumero(this.y);
             },
        }],
        }, 
        {
          name: 'Venta Año Anterior',
          data: <?php echo json_encode($v2);?>,
          dataLabels: [{
            enabled: true,
            inside: true,
            style: {
                fontSize:'16px',
                color: '#000',
            },
            formatter: function() {
                return abreviarNumero(this.y);
             },
        }],
        }, 
        {
          name: 'Venta 2 Años Antes',
          data: <?php echo json_encode($v3);?>,
          dataLabels: [{
            enabled: true,
            inside: true,
            style: {
                fontSize:'16px',
                color: '#000',
            },
            formatter: function() {
                return abreviarNumero(this.y);
             },
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
            filename: 'Reporte de ventas - Vendedores',
            sourceWidth: (compfiltro[0]==999 && <?php echo $paisFiltro;?>==1)? 800:1600,
            sourceHeight:(compfiltro[0]==999 && <?php echo $paisFiltro;?>==1)? 2500:900,
            chartOptions: {
            
              title: {
                style: {
                    fontSize: (<?php echo $paisFiltro;?>==1)? '30px':'20px',
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
                min: 0,
                max: <?php echo count($vendedoresLabel)-1; ?>,
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

            function abreviarNumero(numero) {
              if (numero >= 1000000000) {
                return (numero / 1000000000).toFixed(1) + ' MMill.';
              }
              if (numero >= 1000000) {
                return (numero / 1000000).toFixed(1) + ' Mill.';
              }
              if (numero >= 1000) {
                return (numero / 1000).toFixed(1) + ' Mil';
              }
              return numero.toString();
            }
    <?php
    if (true) {
    ?>
    const ventas1 = <?php echo $venano1; ?>;
    const ventas2 = <?php echo $venano2; ?>;
    const totalVentas = ventas2 + ventas1;

    const data = {
                
                datasets: [{
                  label: ["Venta"],
                  data: [ventas1, totalVentas],
                  backgroundColor: ["rgba(25, 170, 222,1)", "rgba(20, 36, 89,0.6)"],
                  borderColor: ["#fff"],
                  borderWidth: 1
                }, {
                  label: ["Venta 2 Años antes"],
                  data: [ventas2, totalVentas],
                  backgroundColor: ["rgba(125, 58, 193,1)", "rgba(20, 36, 89,0.6)"],
                  borderColor: ["#fff"],
                  borderWidth: 1
                }]
              };
               //gaugeChartText plugin block
    const gaugeChartText={
        id:'gaugeChartText',
        afterDatasetsDraw(chart, args, pluginOptions){
            const { ctx, data, chartArea: {top, bottom, left, right, width, height
            }, scales: {r}}=chart;

            ctx.save();
            const xCoor= chart.getDatasetMeta(0).data[0].x;
            const yCoor= chart.getDatasetMeta(0).data[0].y;
            const score = data.datasets[0].data[0];
            let rating;

            if (score<600) {
                rating= ''
            }
            //ctx.fillRect(xCoor, yCoor, 400, 5);
            ctx.font = '14px sans-serif';
            ctx.fillStyle='#666';
            ctx.textBaseLine = 'top';
            ctx.textAlign='left';
            //ctx.fillText('0.00 mill.',left + 15,yCoor + 20);

            ctx.textAlign='right';
            //ctx.fillText(abreviarNumero(totalVentas),right - 15,yCoor + 20);
            ctx.class='responsive-font-example';
            //ctx.font = '20px sans-serif';
            ctx.textAlign='center';
            const yCoor3 = yCoor - 1.6 * (height / 2);
           ctx.fillText(abreviarNumero(ventas2),xCoor ,yCoor - yCoor3);

           
           ctx.textAlign='center';
           const yCoor2 = yCoor - ((window.screen.width<900)? 0.50:0.05) * (height / 2);
           ctx.fillText(abreviarNumero(ventas1),xCoor ,yCoor - yCoor2);
           /* ctx.font = '150px sans-serif';
            ctx.textAlign='center';
            ctx.textBaseLine = 'bottom';
            ctx.fillText('Fair',xCoor,yCoor - 35);*/
        }
    }
     // config 
     const config = {
      type: 'doughnut',
      data,
      options: {
        
        layout: {
            padding: {
              top: 20
            }
          },
                cutout: '50%',
                tooltips: {
          enabled: false
        },
        maintainAspectRatio:false,
            responsive: true,
            "plugins": {
          "legend": {
            "display": false,
            "position": "bottom",
          },
          datalabels: { "display": false,
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
            },
            rotation: -90,
            circumference: 180,
        },
      plugins: [gaugeChartText] 
    };
    // render init block
    const ctx = new Chart(
      document.getElementById('compRadial'),
      config
    );
    <?php
    }
    ?>

function searchF() {
               $("#formFiltros").submit();
            }

      </script>