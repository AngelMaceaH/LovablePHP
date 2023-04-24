<script>
            $("#fechagra, #cbbMesgra, #cbbAnogra").change(function() {
              $("#formGraficas").submit();
            });

            function formatoFecha(fecha) {
              let year = fecha.substring(0, 4);
              let month = fecha.substring(4, 6);
              let day = fecha.substring(6, 8);
              return year + "-" + month + "-" + day;
            }
        Chart.register(ChartDataLabels);
            //GRAFICO DE BARRA
          // Obtener el contexto del canvas
          var ctx27 = document.getElementById('GraficaBarra').getContext('2d');

          var miGrafico = new Chart(ctx27, {
              type: 'bar',
              data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                datasets: [{
                  label: 'Ventas hace 2 años',
                  data: [100,100,100,100,100,100,100,100,100,100,100,100],
                  backgroundColor: "rgba(20, 36, 89,0.6)",
                  borderColor: '#fff',
                  borderWidth: 1
                },
                {
                  label: 'Ventas hace 1 año',
                  data: [200,200,200,200,200,200,150,200,200,200,200,200],
                  backgroundColor: "rgba(23, 107, 160,0.6)",
                  borderColor: '#fff',
                  borderWidth: 1
                },
                {
                  label: 'Ventas este año',
                  data: [300,300,300,300,300,300,300,300,300,350,300,30,],
                  backgroundColor: "rgba(25, 170, 222,0.6)",
                  borderColor: '#fff',
                  borderWidth: 1
                }]
              },
              options: {
                responsive: true,
                    maintainAspectRatio: false,
                  scales: {
                    y: {
                      beginAtZero: true
                    }
                  }
                }
            });















        //HONDURAS GRAFICOS
        <?php
    if (count($vendiaHonduras)>0) {
    ?>
         var ctx = document.getElementById('HonDia').getContext('2d');
         var myChart1 = new Chart(ctx, {
              type: 'doughnut',
              data: {
                  labels: <?php echo json_encode($compHonduras); ?>,
                  datasets: [{
                      label: 'Ventas del día L',
                      data: <?php echo json_encode($vendiaHonduras); ?>,
                      backgroundColor: [
                        "rgba(20, 36, 89,0.6)","rgba(23, 107, 160,0.6)","rgba(25, 170, 222,0.6)","rgba(26, 201, 230,0.6)","rgba(29, 228, 219,0.6)","rgba(109, 240, 210,0.6)",
                        "rgba(41, 6, 107,0.6)","rgba(125, 58, 193,0.6)","rgba(175, 75, 206,0.6)","rgba(219, 76, 178,0.6)","rgba(130, 4, 1,0.6)","rgba(192, 35, 35,0.6)",
                        "rgba(222, 84, 44,0.6)","rgba(239, 126, 50,0.6)","rgba(238, 154, 58,0.6)","rgba(234, 219, 56,0.6)","rgba(79, 32, 13,0.6)","rgba(231, 227, 78,0.6)",
                      ],
                      borderColor: [
                        "#fff"
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
            responsive: true,
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
    <?php
    }
    ?>
    <?php
    if (count($venmesHonduras)>0) {
    ?>
    var ctx20 = document.getElementById('HonMes').getContext('2d');
         var myChart1 = new Chart(ctx20, {
              type: 'doughnut',
              data: {
                  labels: <?php echo json_encode($compMesHonduras); ?>,
                  datasets: [{
                      label: 'Ventas del mes L',
                      data: <?php echo json_encode($venmesHonduras); ?>,
                      backgroundColor: [
                        "rgba(20, 36, 89,0.6)","rgba(23, 107, 160,0.6)","rgba(25, 170, 222,0.6)","rgba(26, 201, 230,0.6)","rgba(29, 228, 219,0.6)","rgba(109, 240, 210,0.6)",
                        "rgba(41, 6, 107,0.6)","rgba(125, 58, 193,0.6)","rgba(175, 75, 206,0.6)","rgba(219, 76, 178,0.6)","rgba(130, 4, 1,0.6)","rgba(192, 35, 35,0.6)",
                        "rgba(222, 84, 44,0.6)","rgba(239, 126, 50,0.6)","rgba(238, 154, 58,0.6)","rgba(234, 219, 56,0.6)","rgba(79, 32, 13,0.6)","rgba(231, 227, 78,0.6)", 
                      ],
                      borderColor: [
                        "#fff"
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
            responsive: true,
            "plugins": {
          "legend": {
            "display": false,
            "position": "chartArea",
            
          },
          datalabels: {
            formatter: (value, ctx20) => {
              const datapoints = ctx20.chart.data.datasets[0].data
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
    <?php
    }
    ?>
    //GUATEMALA GRAFICOS
    <?php
    if (count($vendiaGuatemala)>0) {
    ?>
    var ctx2 = document.getElementById('GuaDia').getContext('2d');
         var myChart2 = new Chart(ctx2, {
              type: 'doughnut',
              data: {
                  labels: <?php echo json_encode($compGuatemala); ?>,
                  datasets: [{
                      label: 'Ventas del día Q.',
                      data: <?php echo json_encode($vendiaGuatemala); ?>,
                      backgroundColor: [
                        
                        "rgba(20, 36, 89,0.6)","rgba(23, 107, 160,0.6)","rgba(25, 170, 222,0.6)","rgba(26, 201, 230,0.6)","rgba(29, 228, 219,0.6)","rgba(109, 240, 210,0.6)",
                        "rgba(41, 6, 107,0.6)","rgba(125, 58, 193,0.6)","rgba(175, 75, 206,0.6)","rgba(219, 76, 178,0.6)","rgba(130, 4, 1,0.6)","rgba(192, 35, 35,0.6)",
                        "rgba(222, 84, 44,0.6)","rgba(239, 126, 50,0.6)","rgba(238, 154, 58,0.6)","rgba(234, 219, 56,0.6)","rgba(79, 32, 13,0.6)","rgba(231, 227, 78,0.6)",
                      ],
                      borderColor: [
                        "#fff"
                      ],
                      borderWidth: 1
                  }]
              },
              options: {
                tooltips: {
          enabled: false
        },
            responsive: true,
            "plugins": {
          "legend": {
            "display": false,
            "position": "bottom",
          },
          datalabels: {
            formatter: (value, ctx2) => {
              const datapoints = ctx2.chart.data.datasets[0].data
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
    <?php
    }
    ?>
     <?php
    if (count($venmesGuatemala)>0) {
    ?>
    var ctx21 = document.getElementById('GuaMes').getContext('2d');
         var myChart1 = new Chart(ctx21, {
              type: 'doughnut',
              data: {
                  labels: <?php echo json_encode($compMesGuatemala); ?>,
                  datasets: [{
                      label: 'Ventas del mes Q.',
                      data: <?php echo json_encode($venmesGuatemala); ?>,
                      backgroundColor: [
                        "rgba(20, 36, 89,0.6)","rgba(23, 107, 160,0.6)","rgba(25, 170, 222,0.6)","rgba(26, 201, 230,0.6)","rgba(29, 228, 219,0.6)","rgba(109, 240, 210,0.6)",
                        "rgba(41, 6, 107,0.6)","rgba(125, 58, 193,0.6)","rgba(175, 75, 206,0.6)","rgba(219, 76, 178,0.6)","rgba(130, 4, 1,0.6)","rgba(192, 35, 35,0.6)",
                        "rgba(222, 84, 44,0.6)","rgba(239, 126, 50,0.6)","rgba(238, 154, 58,0.6)","rgba(234, 219, 56,0.6)","rgba(79, 32, 13,0.6)","rgba(231, 227, 78,0.6)",
                      ],
                      borderColor: [
                        "#fff"
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
            responsive: true,
            "plugins": {
          "legend": {
            "display": false,
            "position": "bottom",
            
          },
          datalabels: {
            formatter: (value, ctx21) => {
              const datapoints = ctx21.chart.data.datasets[0].data
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
    <?php
    }
    //EL SALVADOR GRAFICAS
    if (count($vendiaElSalvador)>0) {
    ?>
    var ctx3 = document.getElementById('SalDia').getContext('2d');
         var myChart3 = new Chart(ctx3, {
              type: 'doughnut',
              data: {
                  labels: <?php echo json_encode($compElSalvador); ?>,
                  datasets: [{
                      label: 'Ventas del día D.',
                      data: <?php echo json_encode($vendiaElSalvador); ?>,
                      backgroundColor: [
                        "rgba(20, 36, 89,0.6)","rgba(23, 107, 160,0.6)","rgba(25, 170, 222,0.6)","rgba(26, 201, 230,0.6)","rgba(29, 228, 219,0.6)","rgba(109, 240, 210,0.6)",
                        "rgba(41, 6, 107,0.6)","rgba(125, 58, 193,0.6)","rgba(175, 75, 206,0.6)","rgba(219, 76, 178,0.6)","rgba(130, 4, 1,0.6)","rgba(192, 35, 35,0.6)",
                        "rgba(222, 84, 44,0.6)","rgba(239, 126, 50,0.6)","rgba(238, 154, 58,0.6)","rgba(234, 219, 56,0.6)","rgba(79, 32, 13,0.6)","rgba(231, 227, 78,0.6)",  
                      ],
                      borderColor: [
                        "#fff"
                      ],
                      borderWidth: 1
                  }]
              },
              options: {
                tooltips: {
          enabled: false
        },
            responsive: true,
            "plugins": {
          "legend": {
            "display": false,
            "position": "bottom",
          },
          datalabels: {
            formatter: (value, ctx3) => {
              const datapoints = ctx3.chart.data.datasets[0].data
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
    <?php
    }
    if (count($venmesElSalvador)>0) {
    ?>
    var ctx22 = document.getElementById('SalMes').getContext('2d');
         var myChart1 = new Chart(ctx22, {
              type: 'doughnut',
              data: {
                  labels: <?php echo json_encode($compMesElSalvador); ?>,
                  datasets: [{
                      label: 'Venta del mes D.',
                      data: <?php echo json_encode($venmesElSalvador); ?>,
                      backgroundColor: [
                        "rgba(20, 36, 89,0.6)","rgba(23, 107, 160,0.6)","rgba(25, 170, 222,0.6)","rgba(26, 201, 230,0.6)","rgba(29, 228, 219,0.6)","rgba(109, 240, 210,0.6)",
                        "rgba(41, 6, 107,0.6)","rgba(125, 58, 193,0.6)","rgba(175, 75, 206,0.6)","rgba(219, 76, 178,0.6)","rgba(130, 4, 1,0.6)","rgba(192, 35, 35,0.6)",
                        "rgba(222, 84, 44,0.6)","rgba(239, 126, 50,0.6)","rgba(238, 154, 58,0.6)","rgba(234, 219, 56,0.6)","rgba(79, 32, 13,0.6)","rgba(231, 227, 78,0.6)",  
                      ],
                      borderColor: [
                        "#fff"
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
            responsive: true,
            "plugins": {
          "legend": {
            "display": false,
            "position": "bottom",
            
          },
          datalabels: {
            formatter: (value, ctx22) => {
              const datapoints = ctx22.chart.data.datasets[0].data
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
    <?php
    }
 //NICARAGUA GRAFICAS
    if (count($vendiaNicaragua)>0) {
    ?>
    var ctx4 = document.getElementById('NicaDia').getContext('2d');
         var myChart4 = new Chart(ctx4, {
              type: 'doughnut',
              data: {
                  labels: <?php echo json_encode($compNicaragua); ?>,
                  datasets: [{
                      label: 'Ventas del día D.',
                      data: <?php echo json_encode($vendiaNicaragua); ?>,
                      backgroundColor: [
                        "rgba(20, 36, 89,0.6)","rgba(23, 107, 160,0.6)","rgba(25, 170, 222,0.6)","rgba(26, 201, 230,0.6)","rgba(29, 228, 219,0.6)","rgba(109, 240, 210,0.6)",
                        "rgba(41, 6, 107,0.6)","rgba(125, 58, 193,0.6)","rgba(175, 75, 206,0.6)","rgba(219, 76, 178,0.6)","rgba(130, 4, 1,0.6)","rgba(192, 35, 35,0.6)",
                        "rgba(222, 84, 44,0.6)","rgba(239, 126, 50,0.6)","rgba(238, 154, 58,0.6)","rgba(234, 219, 56,0.6)","rgba(79, 32, 13,0.6)","rgba(231, 227, 78,0.6)",    
                      ],
                      borderColor: [
                        "#fff"
                      ],
                      borderWidth: 1
                  }]
              },
              options: {
                tooltips: {
          enabled: false
        },
            responsive: true,
            "plugins": {
          "legend": {
            "display": false,
            "position": "bottom",
          },
          datalabels: {
            formatter: (value, ctx4) => {
              const datapoints = ctx4.chart.data.datasets[0].data
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
    <?php
    }
    if (count($venmesNicaragua)>0) {
    ?>
    var ctx23 = document.getElementById('NicaMes').getContext('2d');
         var myChart1 = new Chart(ctx23, {
              type: 'doughnut',
              data: {
                  labels: <?php echo json_encode($compMesNicaragua); ?>,
                  datasets: [{
                      label: 'Venta del mes D.',
                      data: <?php echo json_encode($venmesNicaragua); ?>,
                      backgroundColor: [
                        "rgba(20, 36, 89,0.6)","rgba(23, 107, 160,0.6)","rgba(25, 170, 222,0.6)","rgba(26, 201, 230,0.6)","rgba(29, 228, 219,0.6)","rgba(109, 240, 210,0.6)",
                        "rgba(41, 6, 107,0.6)","rgba(125, 58, 193,0.6)","rgba(175, 75, 206,0.6)","rgba(219, 76, 178,0.6)","rgba(130, 4, 1,0.6)","rgba(192, 35, 35,0.6)",
                        "rgba(222, 84, 44,0.6)","rgba(239, 126, 50,0.6)","rgba(238, 154, 58,0.6)","rgba(234, 219, 56,0.6)","rgba(79, 32, 13,0.6)","rgba(231, 227, 78,0.6)",  
                      ],
                      borderColor: [
                        "#fff"
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
            responsive: true,
            "plugins": {
          "legend": {
            "display": false,
            "position": "bottom",
            
          },
          datalabels: {
            formatter: (value, ctx23) => {
              const datapoints = ctx23.chart.data.datasets[0].data
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
    <?php
    }
    if (count($vendiaCostaRica)>0) {
    ?>
    //COSTA RICA GRAFICAS
    var ctx5 = document.getElementById('CosDia').getContext('2d');
         var myChart5 = new Chart(ctx5, {
              type: 'doughnut',
              data: {
                  labels: <?php echo json_encode($compCostaRica); ?>,
                  datasets: [{
                      label: 'Ventas del día C.',
                      data: <?php echo json_encode($vendiaCostaRica); ?>,
                      backgroundColor: [
                        "rgba(20, 36, 89,0.6)","rgba(23, 107, 160,0.6)","rgba(25, 170, 222,0.6)","rgba(26, 201, 230,0.6)","rgba(29, 228, 219,0.6)","rgba(109, 240, 210,0.6)",
                        "rgba(41, 6, 107,0.6)","rgba(125, 58, 193,0.6)","rgba(175, 75, 206,0.6)","rgba(219, 76, 178,0.6)","rgba(130, 4, 1,0.6)","rgba(192, 35, 35,0.6)",
                        "rgba(222, 84, 44,0.6)","rgba(239, 126, 50,0.6)","rgba(238, 154, 58,0.6)","rgba(234, 219, 56,0.6)","rgba(79, 32, 13,0.6)","rgba(231, 227, 78,0.6)",   
                      ],
                      borderColor: [
                        "#fff"
                      ],
                      borderWidth: 1
                  }]
              },
              options: {
                tooltips: {
          enabled: false
        },
            responsive: true,
            "plugins": {
          "legend": {
            "display": false,
            "position": "bottom",
          },
          datalabels: {
            formatter: (value, ctx5) => {
              const datapoints = ctx5.chart.data.datasets[0].data
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
    <?php
    }
    if (count($venmesCostaRica)>0) {
    ?>
    var ctx24 = document.getElementById('CosMes').getContext('2d');
         var myChart1 = new Chart(ctx24, {
              type: 'doughnut',
              data: {
                  labels: <?php echo json_encode($compMesCostaRica); ?>,
                  datasets: [{
                      label: 'Venta del mes C.',
                      data: <?php echo json_encode($venmesCostaRica); ?>,
                      backgroundColor: [
                        "rgba(20, 36, 89,0.6)","rgba(23, 107, 160,0.6)","rgba(25, 170, 222,0.6)","rgba(26, 201, 230,0.6)","rgba(29, 228, 219,0.6)","rgba(109, 240, 210,0.6)",
                        "rgba(41, 6, 107,0.6)","rgba(125, 58, 193,0.6)","rgba(175, 75, 206,0.6)","rgba(219, 76, 178,0.6)","rgba(130, 4, 1,0.6)","rgba(192, 35, 35,0.6)",
                        "rgba(222, 84, 44,0.6)","rgba(239, 126, 50,0.6)","rgba(238, 154, 58,0.6)","rgba(234, 219, 56,0.6)","rgba(79, 32, 13,0.6)","rgba(231, 227, 78,0.6)",  
                      ],
                      borderColor: [
                        "#fff"
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
            responsive: true,
            "plugins": {
          "legend": {
            "display": false,
            "position": "bottom",
            
          },
          datalabels: {
            formatter: (value, ctx24) => {
              const datapoints = ctx24.chart.data.datasets[0].data
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
    <?php
    }
    if (count($vendiaRepDomi)>0) {
    ?>
    //REP DOMINICANA GRAFICAS
    var ctx6 = document.getElementById('DomDia').getContext('2d');
         var myChart6 = new Chart(ctx6, {
              type: 'doughnut',
              data: {
                  labels: <?php echo json_encode($compRepDomi); ?>,
                  datasets: [{
                      label: 'Ventas del día P.',
                      data: <?php echo json_encode($vendiaRepDomi); ?>,
                      backgroundColor: [
                        "rgba(20, 36, 89,0.6)","rgba(23, 107, 160,0.6)","rgba(25, 170, 222,0.6)","rgba(26, 201, 230,0.6)","rgba(29, 228, 219,0.6)","rgba(109, 240, 210,0.6)",
                        "rgba(41, 6, 107,0.6)","rgba(125, 58, 193,0.6)","rgba(175, 75, 206,0.6)","rgba(219, 76, 178,0.6)","rgba(130, 4, 1,0.6)","rgba(192, 35, 35,0.6)",
                        "rgba(222, 84, 44,0.6)","rgba(239, 126, 50,0.6)","rgba(238, 154, 58,0.6)","rgba(234, 219, 56,0.6)","rgba(79, 32, 13,0.6)","rgba(231, 227, 78,0.6)",  
                      ],
                      borderColor: [
                        "#fff"
                      ],
                      borderWidth: 1
                  }]
              },
              options: {
                tooltips: {
          enabled: false
        },
            responsive: true,
            "plugins": {
          "legend": {
            "display": false,
            "position": "bottom",
          },
          datalabels: {
            formatter: (value, ctx6) => {
              const datapoints = ctx6.chart.data.datasets[0].data
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
    <?php
    }
    if (count($venmesRepDom)>0) {
    ?>
    var ctx25 = document.getElementById('DomMes').getContext('2d');
         var myChart1 = new Chart(ctx25, {
              type: 'doughnut',
              data: {
                  labels: <?php echo json_encode($compMesRepDom); ?>,
                  datasets: [{
                      label: 'Venta del mes P.',
                      data: <?php echo json_encode($venmesRepDom); ?>,
                      backgroundColor: [
                        "rgba(20, 36, 89,0.6)","rgba(23, 107, 160,0.6)","rgba(25, 170, 222,0.6)","rgba(26, 201, 230,0.6)","rgba(29, 228, 219,0.6)","rgba(109, 240, 210,0.6)",
                        "rgba(41, 6, 107,0.6)","rgba(125, 58, 193,0.6)","rgba(175, 75, 206,0.6)","rgba(219, 76, 178,0.6)","rgba(130, 4, 1,0.6)","rgba(192, 35, 35,0.6)",
                        "rgba(222, 84, 44,0.6)","rgba(239, 126, 50,0.6)","rgba(238, 154, 58,0.6)","rgba(234, 219, 56,0.6)","rgba(79, 32, 13,0.6)","rgba(231, 227, 78,0.6)",  
                      ],
                      borderColor: [
                        "#fff"
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
            responsive: true,
            "plugins": {
          "legend": {
            "display": false,
            "position": "bottom",
            
          },
          datalabels: {
            formatter: (value, ctx25) => {
              const datapoints = ctx25.chart.data.datasets[0].data
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
    <?php
    }
    ?>
  </script>