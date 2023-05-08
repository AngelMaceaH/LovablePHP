$("#fechapro").change(function() {
    $("#formGraficas").submit();
  });

  function formatoFecha(fecha) {
    let year = fecha.substring(0, 4);
    let month = fecha.substring(4, 6);
    let day = fecha.substring(6, 8);
    return year + "-" + month + "-" + day;
  }


Chart.register(ChartDataLabels);
var ctx = document.getElementById('myChart1').getContext('2d');
var myChart1 = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: <?php echo json_encode($compHonduras); ?>,
        datasets: [{
            label: 'Ventas',
            data: <?php echo json_encode($vendiaHonduras); ?>,
            backgroundColor: [
                "#827728","#4e4413","#5e5545","#897a6c","#c2b694","#543a5a","#764667","#ae5e76",
                "#d9888b","#dcb28c","#212006","#352828","#4e4413","#171511","#051d26","#13313f","#60607b","#9e91ac","#d6b6d7","#443c34",  
            ],
            borderColor: [
              "#827728","#352828","#5e5545","#897a6c","#c2b694","#543a5a","#764667","#ae5e76",
                "#d9888b","#dcb28c","#212006","#4e4413","#171511","#051d26","#13313f","#60607b","#9e91ac","#d6b6d7","#443c34", 
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
// Agregar un listener al evento resize de la ventana
window.addEventListener('resize', function() {
// Llamar al método resize() de Chart.js
myChart1.resize();
});