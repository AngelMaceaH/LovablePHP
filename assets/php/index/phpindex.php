<?php
 function obtenerNombreMes($numeroMes) {
    $nombresMes = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
    return $nombresMes[$numeroMes - 1];
  }
  
  $dolarescheck=isset($_SESSION['dolaresCk'])? $_SESSION['dolaresCk']:"1";
  $fechacheck=isset($_SESSION['fechack'])? $_SESSION['fechack']:"false";
  $fecha_actual = date("Ymd");
  $mes_actual=date("m");
  $ano_actual=date("Y");
  $compFiltroP=(float)(isset($_SESSION['$compFiltro'])? $_SESSION['$compFiltro']:1);
  $fechaGraficas=isset($_SESSION['FechaGraficas'])? $_SESSION['FechaGraficas']:$fecha_actual;
 
  $aniografica=substr($fechaGraficas,0,4);
  $mesgrafica=substr($fechaGraficas,4,2);
  $diacbb = substr($fechaGraficas,6,2);
  if ($fechacheck=="true") {
    $diagrafica="31";
  }else{
    $diagrafica=substr($fechaGraficas,6,2);
  }
  $mesGraficas1=(float)(isset($mesgrafica)? $mesgrafica:$mes_actual);
  $mesGraficas2=(float)(isset($mesgrafica)? $mesgrafica:$mes_actual) - 1;
  if ($mesGraficas2==0) {
      $mesGraficas2=12;
  }
  if (strlen($mesGraficas1)==1) {
    $mesGraficas1 = "0".$mesGraficas1;
  }
  if (strlen($mesGraficas2)==1) {
    $mesGraficas2 = "0".$mesGraficas2;
  }
  $anoGraficas1=(float)(isset($aniografica)? $aniografica:$ano_actual);
  $anoGraficas2=(float)(isset($aniografica)? $aniografica:$ano_actual) - 1;

  if ($_SESSION['NIVEL']==1) {
    $_SESSION['INDEX']="index.php";
   }elseif ($_SESSION['NIVEL']==2) {
    echo "<script>location.href='".'/'.$_SESSION['DEV'].'LovablePHP/homepage.php'."';</script>";
    $_SESSION['INDEX']="homepage.php";
   }elseif ($_SESSION['NIVEL']==3) {
    echo "<script>location.href='".'/'.$_SESSION['DEV'].'LovablePHP/homepag.php'."';</script>";
   }
?>
<script>
    function obtenerNombreMes(numeroMes) {
      const nombresMes = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
      return nombresMes[numeroMes - 1];
    }
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
     function array_sum(arr){
        var sum = 0;
      for(var i = 0; i < arr.length; i++){
            sum=sum+parseFloat(arr[i]);
        }
        return sum;
    }
   
    var Mes1 = obtenerNombreMes(<?php echo $mesGraficas1; ?>);
    var Mes2 = obtenerNombreMes(<?php echo $mesGraficas2; ?>);
    var Anio1 = <?php echo $anoGraficas1; ?>;
    var Anio2 = <?php echo $anoGraficas2; ?>;
    var compFiltro = <?php echo $compFiltroP; ?>;
    var dolaresck = <?php echo $dolarescheck; ?>;
    var fechasGraficas = <?php echo $fechaGraficas; ?>;
    var Mes1Num = <?php echo $mesGraficas1; ?>;
    var Mes2Num = <?php echo $mesGraficas2; ?>;
    var diagrafica = <?php echo $diagrafica; ?>;

    $(document).ready(function() {
      $("#fechagra , #cbbMesgra, #fechaCk, #dolaresCk").change(function() {
              var state = $("#fechaCk").is(":checked");
              $("#fechaCk10").val(state);
              $("#formGraficas").submit();
            });

      var usuario='<?php echo $_SESSION["CODUSU"];?>';
      var urlComarc='http://172.16.15.20/API.LovablePHP/Index/CompDes/?user='+usuario+'';
      var responseComarc = ajaxRequest(urlComarc);
        //LLENADO DE COMARC
        if (responseComarc.code==200) { 
              for (let i = 0; i < responseComarc.data.length; i++) {
               $("#cbbMesgra").append(' <option value='+responseComarc.data[i]['COMCOD']+' selected>'+responseComarc.data[i]['COMDES']+'</option>');
              }
            }
      //VENTAS DIA
      var urlDia="http://172.16.15.20/API.LovablePHP/Index/ValorDia/?fechaGraficas="+fechasGraficas+"&compFiltro="+compFiltro+"&dck="+dolaresck+"";
      var responseDia = ajaxRequest(urlDia);
      //VENTAS MES
      var urlMes="http://172.16.15.20/API.LovablePHP/Index/ValorMes/?mesGraficas1="+Mes1Num+"&anoGraficas1="+Anio1+"&compFiltro="+compFiltro+"&dck="+dolaresck+"";
      var responseMes = ajaxRequest(urlMes);
      //VENTAS COMPARATIVO1
      var urlComp1="http://172.16.15.20/API.LovablePHP/Index/comp1/?mesGraficas1="+Mes1Num+"&anoGraficas1="+Anio1+"&diagrafica="+diagrafica+"&compFiltro="+compFiltro+"&mesGraficas2="+Mes2Num+"&anoGraficas2="+Anio2+"&dck="+dolaresck+"";
      var responseComp1 = ajaxRequest(urlComp1);
      //VENTAS COMPARATIVO2
      var urlComp2="http://172.16.15.20/API.LovablePHP/Index/comp2/?mesGraficas1="+Mes1Num+"&anoGraficas1="+Anio1+"&compFiltro="+compFiltro+"&mesGraficas2="+Mes2Num+"&anoGraficas2="+Anio2+"&dck="+dolaresck+"";
      var responseComp2 = ajaxRequest(urlComp2);
      //VENTAS ANUAL
      var urlAnual="http://172.16.15.20/API.LovablePHP/Index/compAnual/?mesGraficas1="+Mes1Num+"&anoGraficas1="+Anio1+"&compFiltro="+compFiltro+"&anoGraficas2="+Anio2+"&dck="+dolaresck+"";
      var responseAnual = ajaxRequest(urlAnual);
      //PROMEDIO
      var urlPromedios="http://172.16.15.20/API.LovablePHP/Index/promedios/?fechaGraficas="+fechasGraficas+"&compFiltro="+compFiltro+"&dck="+dolaresck+"&mesGraficas1="+Mes1Num+"&anoGraficas1="+Anio1+"&mesGraficas2="+Mes2Num+"&anoGraficas2="+Anio2+"";
      var responsePromedios = ajaxRequest(urlPromedios);


      var mon = "";
      if (responsePromedios.code==200) {
            var prodia=0;var promes=0;var proano=0;var proano2=0;var provar=0; var procre=0;
            for (let i = 0; i < responsePromedios.data.length; i++) { 
              if (dolaresck==1) {
                mon = "D";
              }else{
                mon = responsePromedios.data[i]['MON'];
              }
              var dia=parseFloat(responsePromedios.data[i]['PRODIA']);
                if (isNaN(dia)) {
                  dia=0;
                }
                prodia= prodia+dia;

                var mes=parseFloat(responsePromedios.data[i]['PROMES']);
                if (isNaN(mes)) {
                  mes=0;
                }
                promes= promes+mes;

                
                var ano=parseFloat(responsePromedios.data[i]['PROANO']);
                if (isNaN(ano)) {
                  ano=0;
                }
                proano= proano+ano;

                var ano2=parseFloat(responsePromedios.data[i]['PROANO2']);
                if (isNaN(ano2)) {
                  ano2=0;
                }
                proano2= proano2+ano2;
            }
            var variacionA=proano-proano2;
          if (proano2!=0) {
            var crecimientoA= parseFloat(((proano/proano2)-1)*100);}

          $("#promediosVal").append(`<div id="colHonDia"  class="col-12 col-md-2">
                                      <h6 class="mt-2 text-center ">Dia</h6>
                                      <p class=" fs-6  fw-bold  text-center mt-2 pt-2 ">`+mon+"."+prodia.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+`</p>
                                      </div>

                                      <div id="colHonDia"  class="col-12 col-md-2">
                                      <h6 class="mt-md-2 text-center ">Mes</h6>
                                      <p class="  fs-6  fw-bold text-center mt-2 pt-2 pb-2">`+mon+"."+promes.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+`</p>
                                      </div>

                                      <div id="colHonDia"  class="col-12 col-md-2"> 
                                      <h6 class="mt-md-2 text-center ">Año `+Anio1+`</h6>
                                      <p class=" fs-6 fw-bold  text-center mt-2 pt-2 pb-2">`+mon+"."+proano.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+`</p>
                                      </div>

                                      <div id="colHonDia"  class="col-12 col-md-2"> 
                                      <h6 class="mt-md-2 text-center ">Año `+Anio2+`</h6>
                                      <p class=" fs-6 fw-bold  text-center mt-2 pt-2 pb-2">`+mon+"."+proano2.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+`</p>
                                      </div>
                                      `);
            if (variacionA<=0) {
              $("#promediosVal").append(`<div id="colHonDia"  class="col-12 col-md-2"> 
                                        <h6 class="mt-md-2 text-center">Variacion</h6>
                                        <p class=" fs-6 fw-bold  text-center mt-2 pt-2 pb-2 text-danger">`+mon+"."+variacionA.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+`</p>
                                        </div>`);
            }else{
              $("#promediosVal").append(`<div id="colHonDia"  class="col-12 col-md-2"> 
                                        <h6 class="mt-md-2 text-center ">Variacion</h6>
                                        <p class=" fs-6 fw-bold  text-center mt-2 pt-2 pb-2 text-success">`+mon+"."+variacionA.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+`</p>
                                        </div>`);
            }
            if (crecimientoA==null) {
              crecimientoA=0;
            }
          if (crecimientoA<=0) {
            $("#promediosVal").append(` <div id="colHonDia"  class="col-12 col-md-2"> 
                                        <h6 class="mt-md-2 text-center ">Crecimiento</h6>
                                        <p class=" fs-6 fw-bold  text-center mt-2 pt-2 pb-2 text-danger">`+crecimientoA.toLocaleString('es-419', {minimumFractionDigits: 0,maximumFractionDigits: 0})+`%</p>
                                        </div>`);
          }else{
            $("#promediosVal").append(` <div id="colHonDia"  class="col-12 col-md-2"> 
                                        <h6 class="mt-md-2 text-center ">Crecimiento</h6>
                                        <p class=" fs-6 fw-bold  text-center mt-2 pt-2 pb-2 text-success">`+crecimientoA.toLocaleString('es-419', {minimumFractionDigits: 0,maximumFractionDigits: 0})+`%</p>
                                        </div>`);
            }
          }
          

        var valDia=parseFloat(responseDia.data[0]['TOTAL']);
        var valMes=parseFloat(responseMes.data[0]['MES1']);
        if (isNaN(valDia)) {
          valDia=0;
        }
        if (isNaN(valMes)) {
          valMes=0;
        }
      if (compFiltro!=2 && compFiltro!=3 && compFiltro!=4 && compFiltro!=5 && compFiltro!=6 && compFiltro!=7) {
        $("#colHonDia").append(' <label id="valDia" class="form-control text-darkblue responsive-font-example fw-bold fs-3 text-center mt-3 pt-2 pb-2">'+mon+"."+valDia.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+'</label>');
        $("#colHonMes").append('<label id="valMes" class="form-control text-pink responsive-font-example fw-bold fs-3 text-center mt-3 pt-2 pb-2">'+mon+"."+valMes.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+'</label>');
      }
      if (responseDia.code==200) {
          var ciadiaArray=[]; var diaArray=[];
            for (let i = 0; i < responseDia.data.length; i++) { 
              var valDia=parseFloat(responseDia.data[i]['TOTAL']);
                if (isNaN(valDia)) {
                  valDia=0;
                }
              ciadiaArray.push(responseDia.data[i]['NOMCIA']);
              diaArray.push(parseFloat(valDia));
            } 
          }
          if (responseMes.code==200) {
          var ciaMesArray=[]; var mesArray=[];
            for (let i = 0; i < responseMes.data.length; i++) { 
              var valMes=parseFloat(responseMes.data[i]['MES1']);
                if (isNaN(valMes)) {
                  valMes=0;
                }
                ciaMesArray.push(responseMes.data[i]['NOMCIA']);
                mesArray.push(parseFloat(valMes));
            } 
          }

          if (responseComp1.code==200) {
          var mes1Comp1=0;var mes2Comp1=0;var mes3Comp1=0;
            for (let i = 0; i < responseComp1.data.length; i++) { 
              var valMes1=parseFloat(responseComp1.data[i]['MES1']);
                if (isNaN(valMes1)) {
                  valMes1=0;
                }
                mes1Comp1= mes1Comp1+valMes1;
              var valMes2=parseFloat(responseComp1.data[i]['MES2']);
                if (isNaN(valMes2)) {
                  valMes2=0;
                }
                mes2Comp1= mes2Comp1+valMes2;
                var valMes3=parseFloat(responseComp1.data[i]['MES3']);
                if (isNaN(valMes3)) {
                  valMes3=0;
                }
                mes3Comp1= mes3Comp1+valMes3;
            } 
          }
          var var1=mes1Comp1-mes2Comp1;
          if (var1<=0) {
            $("#var1").append('<p class=" text-danger fs-5 fw-bold text-center">'+mon+'.'+var1.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+'</p>');
          }else{
            $("#var1").append('<p class=" text-success fs-5 fw-bold text-center">'+mon+'.'+var1.toLocaleString('es-419', {minimumFractionDigits:2,maximumFractionDigits: 2})+'</p>');
          }
          if (mes2Comp1!=0) {
            var cre1= parseFloat(((mes1Comp1/mes2Comp1)-1)*100)};
            if (cre1==null) {
              cre1= 0;
            }
           if (cre1<=0) {
            $("#cre1").append('<p class=" text-danger fs-5 fw-bold text-center">'+cre1.toLocaleString('es-419', {minimumFractionDigits: 0,maximumFractionDigits: 0})+'%</p>');
          }else{
            $("#cre1").append('<p class=" text-success fs-5 fw-bold text-center">'+cre1.toLocaleString('es-419', {minimumFractionDigits: 0,maximumFractionDigits: 0})+'%</p>');
          } 
          
          var var2=mes1Comp1-mes3Comp1;
          if (var2<=0) {
            $("#var2").append('<p class=" text-danger fs-5 fw-bold text-center">'+mon+'.'+var2.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+'</p>');
          }else{
            $("#var2").append('<p class=" text-success fs-5 fw-bold text-center">'+mon+'.'+var2.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+'</p>');
          }
          if (mes3Comp1!=0) {
            var cre2= parseFloat(((mes1Comp1/mes3Comp1)-1)*100)};
          
            if (cre2==null) {
              cre2= 0;
            }
           if (cre2<=0) {
            $("#cre2").append('<p class=" text-danger fs-5 fw-bold text-center">'+cre2.toLocaleString('es-419', {minimumFractionDigits: 0,maximumFractionDigits: 0})+'%</p>');
          }else{
            $("#cre2").append('<p class=" text-success fs-5 fw-bold text-center">'+cre2.toLocaleString('es-419', {minimumFractionDigits: 0,maximumFractionDigits: 0})+'%</p>');
          } 
          

          var ano1Comp3=0;var ano2Comp3=0;
          if (responseAnual.code==200) {
            for (let i = 0; i < responseAnual.data.length; i++) { 
              var valAno1=parseFloat(responseAnual.data[i]['ANO1']);
                if (isNaN(valAno1)) {
                  valAno1=0;
                }
                ano1Comp3= ano1Comp3+valAno1;
              var valAno2=parseFloat(responseAnual.data[i]['ANO2']);
                if (isNaN(valAno2)) {
                  valAno2=0;
                }
                ano2Comp3= ano2Comp3+valAno2;   
            } 
          }                          
          var variacionAnual=ano1Comp3-ano2Comp3;
          if (ano2Comp3!=0) {
            var crecimientoAnual1= parseFloat(((ano1Comp3/ano2Comp3)-1)*100);
          }else{
            var crecimientoAnual1=0;
          }
        
          if (variacionAnual <= 0) {
            $("#varAnual1").append('<label class="form-control text-danger responsive-font-example fw-bold fs-3 text-center mt-2 pt-2 pb-2">'+mon+"."+variacionAnual.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+'</label>');
          }else{
            $("#varAnual1").append('<label class="form-control text-success responsive-font-example fw-bold fs-3 text-center mt-2 pt-2 pb-2">'+mon+"."+variacionAnual.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+'</label>');
          }
          if (crecimientoAnual1 <= 0) {
            $("#varAnual2").append('<label class="form-control text-danger responsive-font-example fw-bold fs-3 text-center mt-2 pt-2 pb-2">'+parseInt(crecimientoAnual1).toLocaleString('es-419')+'%</label>');
          }else{
            $("#varAnual2").append('<label class="form-control text-success responsive-font-example fw-bold fs-3 text-center mt-2 pt-2 pb-2">'+parseInt(crecimientoAnual1).toLocaleString('es-419')+'%</label>');
          }

            


      $('#dolaresCk').prop('checked', <?php echo $dolarescheck; ?>);
      $('#fechaCk').prop('checked', <?php echo  $fechacheck ?>);
      $("#cbbMesgra").val(compFiltro);
      $("#tituloGraficasVentas").empty();
      $("#tituloGraficasVentas").append($("#cbbMesgra option:selected").text());
      $("#fechagra").val(formatoFecha("<?php echo $fechaGraficas; ?>"));

        Chart.register(ChartDataLabels);
        //GRAFICOS VENTAS
        if (array_sum(diaArray)>0) {
          var ctx = document.getElementById('HonDia').getContext('2d');
         var myChart1 = new Chart(ctx, {
              type: 'doughnut',
              data: {
                  labels: ciadiaArray,
                  datasets: [{
                      label: 'Ventas del día '+mon+':',
                      data: diaArray,
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
        }else{
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
        }
      
      if (array_sum(mesArray)>0) {
        var ctx20 = document.getElementById('HonMes1').getContext('2d');
         var myChart1 = new Chart(ctx20, {
              type: 'doughnut',
              data: {
                  labels: ciaMesArray,
                  datasets: [{
                      label: 'Ventas del mes '+mon+':',
                      data: mesArray,
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
      }else{
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
      }

if (mes1Comp1>0 || mes2Comp1>0) {
    var ventas1 = mes1Comp1;
    var ventas2 = mes2Comp1;
    var totalVentas = ventas2 + ventas1;
    var gradient1 = ctx.createLinearGradient(0, 0, 0, 400);
      gradient1.addColorStop(0, 'rgba(25, 170, 222,1)');   
      gradient1.addColorStop(1, 'rgba(24, 57, 70,1)');
        var gradient2 = ctx.createLinearGradient(0, 0, 0, 400);
      gradient2.addColorStop(0, 'rgba(125, 58, 193,1)');   
      gradient2.addColorStop(1, 'rgba(38, 17, 59,1)');
    var data = {
                
                datasets: [{
                  label: [mon],
                  data: [ventas1, totalVentas],
                  backgroundColor: [gradient1, "rgba(20, 36, 89,0.6)"],
                  borderColor: ["#fff"],
                  borderWidth: 1
                }, {
                  label: [mon],
                  data: [ventas2, totalVentas],
                  backgroundColor: [gradient2, "rgba(20, 36, 89,0.6)"],
                  borderColor: ["#fff"],
                  borderWidth: 1
                }]
              };
               //gaugeChartText plugin block
    var gaugeChartText={
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
     var config = {
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
    var ctx2 = new Chart(
      document.getElementById('HonMes2'),
      config
    );
  }else if (mes1Comp1==0 && mes2Comp1==0) {
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
    var ctx2 = new Chart(
      document.getElementById('HonMes2'),
      config
    );
  }
    




  if (mes1Comp1>0 || mes3Comp1>0) {

  const ventas3 = mes1Comp1;
      const ventas4 = mes3Comp1;
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
          label: [mon],
                  data: [ventas3, totalVentas1],
                  backgroundColor: [gradient1, "rgba(20, 36, 89,0.6)"],
                  borderColor: ["#fff"],
                  borderWidth: 1
                }, {
                  label: [mon],
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


  }else if (mes1Comp1==0 && mes3Comp1==0) {
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
  }



  if (ano2Comp3>0 || ano1Comp3>0) {
      const ventas5 = ano1Comp3;
      const ventas6 = ano2Comp3;
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
          label: [mon],
                  data: [ventas5, totalVentasAnuales],
                  backgroundColor: [gradient1, "rgba(20, 36, 89,0.6)"],
                  borderColor: ["#fff"],
                  borderWidth: 1
                }, {
                  label: [mon],
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
  }else{
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
  }

    });
  </script>