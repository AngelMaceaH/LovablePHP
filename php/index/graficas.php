<script>
            $("#fechagra , #cbbMesgra, #fechaCk, #dolaresCk").change(function() {
              var state = $("#fechaCk").is(":checked");
              $("#fechaCk10").val(state);
               

              $("#formGraficas").submit();
            });

            function formatoFecha(fecha) {
              let year = fecha.substring(0, 4);
              let month = fecha.substring(4, 6);
              let day = fecha.substring(6, 8);
              return year + "-" + month + "-" + day;
            }

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

            
        Chart.register(ChartDataLabels);
        //GRAFICOS VENTAS
        <?php
    if (array_sum($vendiaHonduras)>0) {
    ?>
      
         var ctx = document.getElementById('HonDia').getContext('2d');
         var myChart1 = new Chart(ctx, {
              type: 'doughnut',
              data: {
                  labels: <?php echo json_encode($compHonduras); ?>,
                  datasets: [{
                      label: 'Ventas del día '+"<?php echo isset($_SESSION['MONE']) ?  $_SESSION['MONE']: " ";  ?>"+'',
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
    }else {
    ?>
    var ctx = document.getElementById('HonDia').getContext('2d');
         var myChart1 = new Chart(ctx, {
              type: 'doughnut',
              data: {
                  labels: [""],
                  datasets: [{
                      data: [-1],
                      backgroundColor: [
                        "rgba(20, 36, 89,0.2)"
                      ],
                      borderColor: [
                        "#fff"
                      ],
                      borderWidth: 1
                  }]
              },
              options: {
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
              return "0%";
            },
            color: '#fff',
            offset: -10,
          }
        },
        }
    });
    <?php
    }
    if (array_sum($venmesHonduras)>0) {
    ?>
    var ctx20 = document.getElementById('HonMes1').getContext('2d');
         var myChart1 = new Chart(ctx20, {
              type: 'doughnut',
              data: {
                  labels: <?php echo json_encode($compMesHonduras); ?>,
                  datasets: [{
                      label: 'Ventas del mes '+"<?php echo isset($_SESSION['MONE']) ?  $_SESSION['MONE']: " ";  ?>"+'',
                      data: <?php echo json_encode($ventasMesGrafica); ?>,
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
    }else{
      ?>
        var ctx = document.getElementById('HonMes1').getContext('2d');
         var myChart1 = new Chart(ctx, {
              type: 'doughnut',
              data: {
                  labels: [""],
                  datasets: [{
                      data: [-1],
                      backgroundColor: [
                        "rgba(20, 36, 89,0.2)"
                      ],
                      borderColor: [
                        "#fff"
                      ],
                      borderWidth: 1
                  }]
              },
              options: {
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
              return "0%";
            },
            color: '#fff',
            offset: -10,
          }
        },
        }
    });
      <?php
    }
 
    if ($venmes1Honduras>0 || $venmes2Honduras>0) {
    ?>
    const ventas1 = <?php echo $venmes1Honduras; ?>;
    const ventas2 = <?php echo $venmes2Honduras; ?>;
    const totalVentas = ventas2 + ventas1;
    var gradient1 = ctx.createLinearGradient(0, 0, 0, 400);
      gradient1.addColorStop(0, 'rgba(25, 170, 222,1)');   
      gradient1.addColorStop(1, 'rgba(24, 57, 70,1)');
        var gradient2 = ctx.createLinearGradient(0, 0, 0, 400);
      gradient2.addColorStop(0, 'rgba(125, 58, 193,1)');   
      gradient2.addColorStop(1, 'rgba(38, 17, 59,1)');
    const data = {
                
                datasets: [{
                  label: [<?php echo json_encode($_SESSION['MONE']); ?>],
                  data: [ventas1, totalVentas],
                  backgroundColor: [gradient1, "rgba(20, 36, 89,0.6)"],
                  borderColor: ["#fff"],
                  borderWidth: 1
                }, {
                  label: [<?php echo json_encode($_SESSION['MONE']); ?>],
                  data: [ventas2, totalVentas],
                  backgroundColor: [gradient2, "rgba(20, 36, 89,0.6)"],
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
           const yCoor2 = yCoor -0.19 * (height / 2);
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
            },
            rotation: -90,
            circumference: 180,
        },
      plugins: [gaugeChartText] 
    };
    // render init block
    const ctx2 = new Chart(
      document.getElementById('HonMes2'),
      config
    );
    <?php
    }else if($venmes2Honduras==0 && $venmes1Honduras==0){
      ?>
          const data = {
                datasets: [{
                  data: [-1],
                  backgroundColor: ["rgba(20, 36, 89,0.6)"],
                  borderColor: ["#fff"],
                  borderWidth: 1
                }, {
                  data: [-1],
                  backgroundColor: [ "rgba(20, 36, 89,0.6)"],
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
           ctx.fillText(0,xCoor ,yCoor - yCoor3);

           
           ctx.textAlign='center';
           const yCoor2 = yCoor -0.19 * (height / 2);
           ctx.fillText(0,xCoor ,yCoor - yCoor2);
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
            },
            rotation: -90,
            circumference: 180,
        },
      plugins: [gaugeChartText] 
    };
    // render init block
    const ctx2 = new Chart(
      document.getElementById('HonMes2'),
      config
    );
      <?php
    }
      ?>
          
    <?php
    if ($venmes3Honduras>0 || $venmes1Honduras>0) {
    ?>
      const ventas3 = <?php echo $venmes1Honduras; ?>;
      const ventas4 = <?php echo $venmes3Honduras; ?>;
      const totalVentas1 = ventas3 + ventas4;
 var ctx21 = document.getElementById('HonMes3').getContext('2d');
 const data2 = {};
 const gaugeChartText2={
        id:'gaugeChartText2',
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
           // ctx.fillText(abreviarNumero(totalVentas1),right - 15,yCoor + 20);
           ctx.class='responsive-font-example';
           // ctx.font = '20px sans-serif';
            ctx.textAlign='center';
            const yCoor3 = yCoor - 1.6 * (height / 2);
           ctx.fillText(abreviarNumero(ventas4),xCoor ,yCoor - yCoor3);

           
           ctx.textAlign='center';
           const yCoor2 = yCoor -0.19 * (height / 2);
           ctx.fillText(abreviarNumero(ventas3),xCoor ,yCoor - yCoor2);
           /* ctx.font = '150px sans-serif';
            ctx.textAlign='center';
            ctx.textBaseLine = 'bottom';
            ctx.fillText('Fair',xCoor,yCoor - 35);*/
        }
    }
    var gradient1 = ctx.createLinearGradient(0, 0, 0, 400);
      gradient1.addColorStop(0, 'rgba(25, 170, 222,1)');   
      gradient1.addColorStop(1, 'rgba(24, 57, 70,1)');
        var gradient2 = ctx.createLinearGradient(0, 0, 0, 400);
      gradient2.addColorStop(0, 'rgba(125, 58, 193,1)');   
      gradient2.addColorStop(1, 'rgba(38, 17, 59,1)');
var myChart1 = new Chart(ctx21, {
      type: 'doughnut',
      data: {
        datasets: [{
          label: [<?php echo json_encode($_SESSION['MONE']); ?>],
                  data: [ventas3, totalVentas1],
                  backgroundColor: [gradient1, "rgba(20, 36, 89,0.6)"],
                  borderColor: ["#fff"],
                  borderWidth: 1
                }, {
                  label: [<?php echo json_encode($_SESSION['MONE']); ?>],
                  data: [ventas4, totalVentas1],
                  backgroundColor: [gradient2, "rgba(20, 36, 89,0.6)"],
                  borderColor: ["#fff"],
                  borderWidth: 1
                }],
      },
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
            },
            rotation: -90,
            circumference: 180,
        },
      plugins: [gaugeChartText2] 
    });


    <?php
    }else{
      ?>
       var ctx21 = document.getElementById('HonMes3').getContext('2d');

const data2 = {
              
             };
const gaugeChartText2={
       id:'gaugeChartText2',
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
          // ctx.fillText(abreviarNumero(totalVentas1),right - 15,yCoor + 20);

           ctx.class='responsive-font-example';
           ctx.textAlign='center';
           const yCoor3 = yCoor - 1.6 * (height / 2);
           ctx.fillText(0,xCoor ,yCoor - yCoor3);

           
           ctx.textAlign='center';
           const yCoor2 = yCoor -0.19 * (height / 2);
           ctx.fillText(0,xCoor ,yCoor - yCoor2);
          /* ctx.font = '150px sans-serif';
           ctx.textAlign='center';
           ctx.textBaseLine = 'bottom';
           ctx.fillText('Fair',xCoor,yCoor - 35);*/
       }
   }

var myChart1 = new Chart(ctx21, {
     type: 'doughnut',
     data: {
       datasets: [{

                 data: [-1],
                 backgroundColor: [ "rgba(20, 36, 89,0.6)"],
                 borderColor: ["#fff"],
                 borderWidth: 1
               }, {
                 data: [-1],
                 backgroundColor: [ "rgba(20, 36, 89,0.6)"],
                 borderColor: ["#fff"],
                 borderWidth: 1
               }],
     },
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
           },
           rotation: -90,
           circumference: 180,
       },
     plugins: [gaugeChartText2] 
   });

      <?php
    }
    if ($venAnual2>0 || $venAnual1>0) {
      ?>
      const ventas5 = <?php echo $venAnual1; ?>;
      const ventas6 = <?php echo $venAnual2; ?>;
      const totalVentasAnuales = ventas5 + ventas6;
      var ctx30 = document.getElementById('AnualGrafica').getContext('2d');
const data3 = {};
const gaugeChartText3={
       id:'gaugeChartText2',
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

           ctx.font = '14px sans-serif';
           ctx.fillStyle='#666';
           ctx.textBaseLine = 'top';
           ctx.textAlign='left';

           ctx.textAlign='right';
           ctx.class='responsive-font-example';
           ctx.textAlign='center';
           const yCoor3 = yCoor - 1.6 * (height / 2);
           ctx.fillText(abreviarNumero(ventas6),xCoor ,yCoor - yCoor3);

           
           ctx.textAlign='center';
           const yCoor2 = yCoor -0.20 * (height / 2);
           ctx.fillText(abreviarNumero(ventas5),xCoor ,yCoor - yCoor2);
       }
   }
  
   var gradient1 = ctx.createLinearGradient(0, 0, 0, 400);
      gradient1.addColorStop(0, 'rgba(25, 170, 222,1)');   
      gradient1.addColorStop(1, 'rgba(24, 57, 70,1)');
        var gradient2 = ctx.createLinearGradient(0, 0, 0, 400);
      gradient2.addColorStop(0, 'rgba(125, 58, 193,1)');   
      gradient2.addColorStop(1, 'rgba(38, 17, 59,1)');
var myChart1 = new Chart(ctx30, {
      type: 'doughnut',
      data: {
        datasets: [{
          label: [<?php echo json_encode($_SESSION['MONE']); ?>],
                  data: [ventas5, totalVentasAnuales],
                  backgroundColor: [gradient1, "rgba(20, 36, 89,0.6)"],
                  borderColor: ["#fff"],
                  borderWidth: 1
                }, {
                  label: [<?php echo json_encode($_SESSION['MONE']); ?>],
                  data: [ventas6, totalVentasAnuales],
                  backgroundColor: [gradient2, "rgba(20, 36, 89,0.6)"],
                  borderColor: ["#fff"],
                  borderWidth: 1
                }],
      },
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
            formatter: (value, ctx30) => {
              const datapoints = ctx30.chart.data.datasets[0].data
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
      plugins: [gaugeChartText3] 
    });
      <?php
    }else{
    ?>
       var ctx30 = document.getElementById('AnualGrafica').getContext('2d');
const data3 = {};
const gaugeChartText3={
       id:'gaugeChartText2',
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

           ctx.font = '14px sans-serif';
           ctx.fillStyle='#666';
           ctx.textBaseLine = 'top';
           ctx.textAlign='left';

           ctx.textAlign='right';
           ctx.class='responsive-font-example';
           ctx.textAlign='center';
           const yCoor3 = yCoor - 1.6 * (height / 2);
           ctx.fillText(0,xCoor ,yCoor - yCoor3);

           
           ctx.textAlign='center';
           const yCoor2 = yCoor -0.19 * (height / 2);
           ctx.fillText(0,xCoor ,yCoor - yCoor2);
       }
   }

var myChart1 = new Chart(ctx30, {
     type: 'doughnut',
     data: {
       datasets: [{

                 data: [-1],
                 backgroundColor: [ "rgba(20, 36, 89,0.6)"],
                 borderColor: ["#fff"],
                 borderWidth: 1
               }, {
                 data: [-1],
                 backgroundColor: [ "rgba(20, 36, 89,0.6)"],
                 borderColor: ["#fff"],
                 borderWidth: 1
               }],
     },
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
            },
            rotation: -90,
            circumference: 180,
        },
      plugins: [gaugeChartText3] 
    });
    <?php
    }
    ?>
      
    /*          function GraficoFuncion($ctxId, $label, $datos, $labels) {
                  echo "var ctx = document.getElementById('" . $ctxId . "').getContext('2d');";
                  echo 'var chart = new Chart(ctx, {
                    type: "doughnut",
                    data: {
                      labels: ' . $labels . ',
                      datasets: [{
                        label: "' . $label . '",
                        data: ' . $datos . ',
                        backgroundColor: [
                          "rgba(20, 36, 89,0.6)","rgba(23, 107, 160,0.6)","rgba(25, 170, 222,0.6)","rgba(26, 201, 230,0.6)","rgba(29, 228, 219,0.6)","rgba(109, 240, 210,0.6)",
                          "rgba(41, 6, 107,0.6)","rgba(125, 58, 193,0.6)","rgba(175, 75, 206,0.6)","rgba(219, 76, 178,0.6)","rgba(130, 4, 1,0.6)","rgba(192, 35, 35,0.6)",
                          "rgba(222, 84, 44,0.6)","rgba(239, 126, 50,0.6)","rgba(238, 154, 58,0.6)","rgba(234, 219, 56,0.6)","rgba(79, 32, 13,0.6)","rgba(231, 227, 78,0.6)", 
                        ],
                        borderColor: "#fff",
                        borderWidth: 1
                      }]
                    },
                    options: {
                      tooltips: {
                        callbacks:{
                          label: function(tooltipItem, data) {
                            var label = "prueba";
                            var value = "1";
                            return label + ": " + value;
                          }
                        }
                      },
                      responsive: true,
                      plugins: {
                        legend: {
                          display: false,
                          position: "bottom",
                        },
                        datalabels: {
                          formatter: function(value, ctx) {
                            var datapoints = ctx.chart.data.datasets[0].data;
                            var total = datapoints.reduce(function(total, datapoint) { return total + datapoint; }, 0);
                            var percentage = value / total * 100;
                            return percentage.toFixed(2) + "%";
                          },
                          color: "#fff",
                          offset: -10,
                        }
                      },
                      animation: {
                        animateScale: true,
                        animateRotate: true
                      }
                    }
                  });';
                }
*/
   
  </script>

  