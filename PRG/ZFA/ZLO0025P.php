<!DOCTYPE html>
<html lang="es">
  <head>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
</head>
<body>
  <?php
      include '../layout-prg.php';
      include '../../assets/php/ZPT/ZLO0024P/header.php';
  ?>
     <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
              <span>Facturación / Ventas por clasificación de producto</span>
              </li>
              <li class="breadcrumb-item active"><span>ZLO0025P</span></li>
            </ol>
          </nav>
        </div>
      </header>
      <div id="body-div" class="body flex-grow-1">
        <div class="card mb-5">
          <div class="card mb-5">
            <div class="card-header">
              <h1 class="fs-4 mb-1 mt-2 text-center">Análisis de ventas por clasificación de productos por fábrica</h1>
            </div>
          <div class="card-body">
          <div class="card border border-0">
                <div class="card-body">
                <div class="row">
                <div class="col-12">
                            <div class="position-relative">
                              <form>
                                <div class="row mb-2">
                                <div class="col-0 col-lg-3">

                                    </div>
                                    <div class="col-12 col-lg-3">
                                      <label class="mt-2">Fábrica:</label>
                                      <select class="form-select mt-1 fw-bold" id="cbbAgrup" >
                                        <option  value="1">Lovable de Honduras</option>
                                      </select>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                      <label class="mt-2">Año:</label>
                                      <select class="form-select  mt-1" id="cbbAno" name="cbbAno">
                                        <?php
                                              $anio_actual = date('Y');
                                              for ($i = $anio_actual; $i >= 2021; $i--) {
                                              echo "<option value='$i'>$i</option>";
                                              }
                                          ?>
                                      </select>
                                    </div>
                                    <div class="col-0 col-lg-3">

                                    </div>
                                      <div class="col-12">
                                        <hr>
                                      </div>
                                      <div class="col-12">
                                        <figure class="highcharts-figure">
                                          <div id="container"  class="highcharts-dark text-white Math.rounded"></div>
                                        </figure>
                                      </div>
                                </div>
                              </form>
                              </div>
                          </div>
                </div>
                </div>
              </div>

                    <div class="table-responsive" style="width:100%">
                          <table id="tableInventario" class="table stripe table-hover text-center " style="width:100%; font-size:15px; color:#000;">
                            <thead>
                                <tr>
                                  <th colspan="2" class=" border border-dark bg-secondary  border-bottom-0"></th>
                                  <th colspan="14" class=" border border-dark bg-secondary align-middle">
                                  <span id="lblano1" class="fs-5"></span>
                                  </th>
                                </tr>
                                <tr>
                                  <th colspan="2" class=" border border-dark bg-secondary border-bottom-0 border-top-0 boder-end-0 "></th>
                                  <th colspan="2" class=" border border-dark bg-secondary align-middle">Ventas Precio Regular</th>
                                  <th colspan="8"class=" border border-dark bg-secondary align-middle">Ventas Con Descuento</th>
                                  <th colspan="4" class=" border border-dark bg-secondary align-middle">Segundas</th>
                                </tr>
                                <tr>
                                  <th colspan="2" class=" border border-dark bg-secondary border-bottom-0 border-top-0 boder-end-0 "></th>
                                  <th colspan="2" class=" border border-dark bgSky">Sin Descuento</th>
                                  <th colspan="2"class=" border border-dark bgGold">20%</th>
                                  <th colspan="2"class=" border border-dark bgSea">30%</th>
                                  <th colspan="2"class=" border border-dark bgGreen">40%</th>
                                  <th colspan="2"class=" border border-dark bgRed">50%</th>
                                  <th colspan="2"class=" border border-dark bgOrange">Segunda Nivel 1</th>
                                  <th colspan="2"class=" border border-dark bgYellow">Segunda Nivel 2</th>
                                </tr>
                                <tr>
                                    <th  class=" border border-dark bg-secondary">Mes</th>
                                    <th  class=" border border-dark bg-secondary">Total</th>
                                    <th  class=" border border-dark bgSky">Unidades</th>
                                    <th  class=" border border-dark bgSky">Porcentaje</th>
                                    <th  class=" border border-dark bgGold">Unidades</th>
                                    <th  class=" border border-dark bgGold">Porcentaje</th>
                                    <th  class=" border border-dark bgSea">Unidades</th>
                                    <th  class=" border border-dark bgSea">Porcentaje</th>
                                    <th  class=" border border-dark bgGreen">Unidades</th>
                                    <th  class=" border border-dark bgGreen">Porcentaje</th>
                                    <th  class=" border border-dark bgRed">Unidades</th>
                                    <th  class=" border border-dark bgRed">Porcentaje</th>
                                    <th  class=" border border-dark bgOrange">Unidades</th>
                                    <th  class=" border border-dark bgOrange">Porcentaje</th>
                                    <th  class=" border border-dark bgYellow">Unidades</th>
                                    <th  class=" border border-dark bgYellow">Porcentaje</th>
                                </tr>
                            </thead>
                            <tbody id="tableInventarioDetalle">
                            </tbody>
                          </table>
                    </div>
                    <div class="table-responsive mt-4" style="width:100%">
                          <table id="tableInventario2" class="table stripe table-hover text-center " style="width:100%; font-size:15px; color:#000;">
                            <thead>
                                <tr>
                                  <th colspan="2" class=" border border-dark bg-secondary  border-bottom-0"></th>
                                  <th colspan="14" class=" border border-dark bg-secondary align-middle">
                                   <span id="lblano2" class="fs-5"></span>
                                  </th>
                                </tr>
                                <tr>
                                  <th colspan="2" class=" border border-dark bg-secondary border-bottom-0 border-top-0 boder-end-0"></th>
                                  <th colspan="2" class=" border border-dark bg-secondary align-middle">Ventas Precio Regular</th>
                                  <th colspan="8"class=" border border-dark bg-secondary align-middle">Ventas Con Descuento</th>
                                  <th colspan="4" class=" border border-dark bg-secondary align-middle">Segundas</th>
                                </tr>
                                <tr>
                                  <th colspan="2" class=" border border-dark bg-secondary border-bottom-0 border-top-0 boder-end-0"></th>
                                  <th colspan="2" class=" border border-dark bgSky">Sin Descuento</th>
                                  <th colspan="2"class=" border border-dark bgGold">20%</th>
                                  <th colspan="2"class=" border border-dark bgSea">30%</th>
                                  <th colspan="2"class=" border border-dark bgGreen">40%</th>
                                  <th colspan="2"class=" border border-dark bgRed">50%</th>
                                  <th colspan="2"class=" border border-dark bgOrange">Segunda Nivel 1</th>
                                  <th colspan="2"class=" border border-dark bgYellow">Segunda Nivel 2</th>
                                </tr>
                                <tr>
                                    <th  class=" border border-dark bg-secondary">Mes</th>
                                    <th  class=" border border-dark bg-secondary">Total</th>
                                    <th  class=" border border-dark bgSky">Unidades</th>
                                    <th  class=" border border-dark bgSky">Porcentaje</th>
                                    <th  class=" border border-dark bgGold">Unidades</th>
                                    <th  class=" border border-dark bgGold">Porcentaje</th>
                                    <th  class=" border border-dark bgSea">Unidades</th>
                                    <th  class=" border border-dark bgSea">Porcentaje</th>
                                    <th  class=" border border-dark bgGreen">Unidades</th>
                                    <th  class=" border border-dark bgGreen">Porcentaje</th>
                                    <th  class=" border border-dark bgRed">Unidades</th>
                                    <th  class=" border border-dark bgRed">Porcentaje</th>
                                    <th  class=" border border-dark bgOrange">Unidades</th>
                                    <th  class=" border border-dark bgOrange">Porcentaje</th>
                                    <th  class=" border border-dark bgYellow">Unidades</th>
                                    <th  class=" border border-dark bgYellow">Porcentaje</th>
                                </tr>
                            </thead>
                            <tbody id="tableInventarioDetalle2">
                            </tbody>
                          </table>
                    </div>
                    </div>
                    <div class="card border border-0">
                      <div class="card-body ">
                        <div class="row ">
                            <div class="col-12">
                              <label class="form-control border border-0 fw-bold">Visualizar gráfica:</label>
                              <select id="selectGrafica" class="form-select fw-bold">
                                <option value="G1">Promedio histórico de ventas Sin descuento</option>
                                <option value="G2">Promedio histórico de ventas Con 20% descuento</option>
                                <option value="G3">Promedio histórico de ventas Con 30% descuento</option>
                                <option value="G4">Promedio histórico de ventas Con 40% descuento</option>
                                <option value="G5">Promedio histórico de ventas Con 50% descuento</option>
                                <option value="G6">Promedio histórico de ventas Segundas Nivel 1</option>
                                <option value="G7">Promedio histórico de ventas Segundas Nivel 2</option>
                              </select>
                            </div>
                          <div class="col-12">
                            <div class="mt-4">
                                    <figure class="highcharts-figure">
                                        <div id="container2"  class="highcharts-dark text-white Math.rounded"></div>
                                      </figure>
                            </div>
                          </div>
                        </div>
                      </div>
              </div>
          </div>
        </div>
      </div>
    </div>

      <div class="footer bg-blck flex-grow-1 d-flex justify-content-center">
      <p class="bggray responsive-font-example"><i>Lovable de Honduras S.A. de C.V</i></p>
      </div>
      <script src="https://code.highcharts.com/highcharts.js"></script>
      <script src="https://code.highcharts.com/modules/exporting.js"></script>
      <script src="https://code.highcharts.com/modules/export-data.js"></script>
      <script src="https://code.highcharts.com/modules/accessibility.js"></script>
      <script>
        let responseDataA1=[];
        let responseDataA2=[];

        let barGra1=[];
        let barGra2=[];

        let lineSinDesc1=[];
        let lineSinDesc2=[];

        let lineSinDescSecure1=[];
        let lineSinDescSecure2=[];

        let line20Desc1=[];
        let line20Desc2=[];
        let line30Desc1=[];
        let line30Desc2=[];
        let line40Desc1=[];
        let line40Desc2=[];
        let line50Desc1=[];
        let line50Desc2=[];
        let lineZ1Desc1=[];
        let lineZ1Desc2=[];
        let lineZ2Desc1=[];
        let lineZ2Desc2=[];

        let chart1=null;
        let chart2=null;
        window.addEventListener('DOMContentLoaded', (event) => {
          const cbbAgrup = document.getElementById('cbbAgrup');
          const cbbAno = document.getElementById('cbbAno');
          const cbbGrafica = document.getElementById('selectGrafica');
            let valAno=parseInt(cbbAno.value);
            let valAno2=valAno-1;
            let valAgrup=cbbAgrup.value;
            chargeTable(valAno,valAgrup);
            chargeTable2(valAno2,valAgrup);
          cbbAgrup.addEventListener('change', (event) => {
            let valAno=parseInt(cbbAno.value);
            let valAno2=valAno-1;
            let valAgrup=cbbAgrup.value;
            chargeTable(valAno,valAgrup);
            chargeTable2(valAno2,valAgrup);
            setTimeout(() => {
              chargeGrafica();
            }, 700);
          });
          cbbAno.addEventListener('change', (event) => {
            let valAno=parseInt(cbbAno.value);
            let valAno2=valAno-1;
            let valAgrup=cbbAgrup.value;
            chargeTable(valAno,valAgrup);
            chargeTable2(valAno2,valAgrup);
            setTimeout(() => {
              chargeGrafica();
            }, 700);
          });
          cbbGrafica.addEventListener('change', (event) => {
            chargeGrafica();
          });
          setTimeout(() => {
          chart1=Highcharts.chart('container', {
                  chart: {
                          type: 'column',
                          style: {
                              color: '#FFFFFF'
                          }
                      },
                      title: {
                          text: 'Promedio histórico por tipo de descuento <br>'+ cbbAgrup.options[cbbAgrup.selectedIndex].text,
                          align: 'center',
                          style: {
                              color: '#FFFFFF',
                          }
                      },
                      lang: {
                        viewFullscreen:"Ver en pantalla completa",
                        exitFullscreen:"Salir de pantalla completa",
                        downloadJPEG:"Descargar imagen JPEG",
                        downloadPDF:"Descargar en PDF",
                    },
                  xAxis: {
                      categories: ['Prendas Sin Dscto.', 'Prendas 20%', 'Prendas 30%', 'Prendas 40%', 'Prendas 50%', 'Segundas Nivel 1', 'Segundas Nivel 2'],
                      crosshair: true,
                      accessibility: {
                          description: 'Countries'
                      },
                      labels: {
                          style: {
                              color: '#FFFFFF'
                          }
                      }
                  },
                  yAxis: {
                      min: 0,
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
                      valueSuffix: ' %',
                      style: {
                          color: '#FFFFFF'
                      }
                  },
                  plotOptions: {
                      column: {
                          pointPadding: 0.2,
                          borderWidth: 0
                      },
                      series: {
                          borderWidth: 0,
                          dataLabels: {
                              enabled: true,
                              format: '{point.y:.2f}%'
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
                  exporting: {
                    buttons: {
                      contextButton: {
                        menuItems: ["viewFullscreen", "separator","downloadJPEG", "downloadPDF"]
                      }
                    },
                    enabled: true,
                    sourceWidth: 1600,
                    sourceHeight: 700,
                    chartOptions: {
                      chart: {
                        backgroundColor: '#303030'
                      }
                    }
                  },
                  series: [
                      {
                          name: 'Ano '+valAno,
                          data: barGra1,
                          color: '#20c997'
                      },
                      {
                          name: 'Ano '+valAno2,
                          data: barGra2,
                          color: '#ffd700'
                      }
                  ]
          });
          chart2=Highcharts.chart('container2', {
              chart: {
                  type: 'line',
                  style: {
                              color: '#FFFFFF'
                          }
              },
              lang: {
                  viewFullscreen:"Ver en pantalla completa",
                  exitFullscreen:"Salir de pantalla completa",
                  downloadJPEG:"Descargar imagen JPEG",
                  downloadPDF:"Descargar en PDF",
              },
              title: {
                      text: cbbGrafica.options[cbbGrafica.selectedIndex].text + '<br>' + cbbAgrup.options[cbbAgrup.selectedIndex].text,
                      align: 'center',
                      style: {
                              color: '#FFFFFF'
                          }
                  },
              xAxis: {
                categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
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
              plotOptions: {
                line: {
                  dataLabels: {
                    enabled: true,
                    format: '{y} %'
                  },
                  enableMouseTracking: false
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
                        menuItems: ["viewFullscreen", "separator","downloadJPEG", "downloadPDF"]
                      }
                    },
                    enabled: true,
                    sourceWidth: 1600,
                    sourceHeight: 700,
                    chartOptions: {
                      chart: {
                        backgroundColor: '#303030'
                      }
                    }
                  },
              series: [{
                  name: 'Ano '+valAno,
                  data: lineSinDesc1,
                  color: '#20c997'
              }, {
                  name: 'Ano '+valAno2,
                  data: lineSinDesc2,
                  color: '#ffd700'
              }]
          });
          lineSinDescSecure1=[...lineSinDesc1];
          lineSinDescSecure2=[...lineSinDesc2];
          }, 1500);
        });

        function chargeTable(valAno,valAgrup) {
          //AÑO 1
          lineSinDesc1=[]; line20Desc1=[]; line30Desc1=[]; line40Desc1=[]; line50Desc1=[]; lineZ1Desc1=[]; lineZ2Desc1=[];
          var urlList="http://172.16.15.20/API.LovablePHP/ZLO0025P/List/?anopro="+valAno+"&agrup="+valAgrup;
          let lblAno1=document.getElementById('lblano1');
          lblAno1.innerHTML='Año '+valAno;
          const tbDetalle = document.getElementById('tableInventarioDetalle');
          tbDetalle.innerHTML = '';
          fetch(urlList)
          .then(response => response.json())
          .then(data => {
            if (data.code==200) {
              let coun1ttot=0; let coun1tdes=0; let coun1t20=0; let coun1t30=0; let coun1t40=0; let coun1t50=0; let coun1tz1=0; let coun1tz2=0;
              let total=0; let totdes=0; let tot20=0; let tot30=0; let tot40=0; let tot50=0; let totz1=0; let totz2=0;
              responseDataA1=[...data.data];
              data.data.forEach((item) => {
                if (item.UNITOT!=0) {
                  coun1ttot++;
                }
                if (item.SIDESC!=0) {
                  coun1tdes++;
                }
                if (item.UNI20!=0) {
                  coun1t20++;
                }
                if (item.UNI30!=0) {
                  coun1t30++;
                }
                if (item.UNI40!=0) {
                  coun1t40++;
                }
                if (item.UNI50!=0) {
                  coun1t50++;
                }
                if (item.UNIZ1!=0) {
                  coun1tz1++;
                }
                if (item.UNIZ2!=0) {
                  coun1tz2++;
                }
                const row = document.createElement('tr');
                row.innerHTML = `
                  <td class="bg-light border border-dark">${item.MESDES}</td>
                  <td class="bg-light border border-dark">${parseFloat(item.UNITOT) === 0 ? '‎' : parseFloat(item.UNITOT).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgSkySoft border border-dark">${parseFloat(item.SIDESC) === 0 ? '‎' : parseFloat(item.SIDESC).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgSkySoft border border-dark">${parseFloat(item.PORDESC) === 0 ? '‎' : parseFloat(item.PORDESC).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgGoldSoft border border-dark">${parseFloat(item.UNI20) === 0 ? '‎' : parseFloat(item.UNI20).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgGoldSoft border border-dark">${parseFloat(item.POR20) === 0 ? '‎' : parseFloat(item.POR20).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgSeaSoft border border-dark">${parseFloat(item.UNI30) === 0 ? '‎' : parseFloat(item.UNI30).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgSeaSoft border border-dark">${parseFloat(item.POR30) === 0 ? '‎' : parseFloat(item.POR30).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgGreenSoft border border-dark">${parseFloat(item.UNI40) === 0 ? '‎' : parseFloat(item.UNI40).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgGreenSoft border border-dark">${parseFloat(item.POR40) === 0 ? '‎' : parseFloat(item.POR40).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgRedSoft border border-dark">${parseFloat(item.UNI50) === 0 ? '‎' : parseFloat(item.UNI50).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgRedSoft border border-dark">${parseFloat(item.POR50) === 0 ? '‎' : parseFloat(item.POR50).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgOrangeSoft border border-dark">${parseFloat(item.UNIZ1) === 0 ? '‎' : parseFloat(item.UNIZ1).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgOrangeSoft border border-dark">${parseFloat(item.PORZ1) === 0 ? '‎' : parseFloat(item.PORZ1).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgYellowSoft border border-dark">${parseFloat(item.UNIZ2) === 0 ? '‎' : parseFloat(item.UNIZ2).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgYellowSoft border border-dark">${parseFloat(item.PORZ2) === 0 ? '‎' : parseFloat(item.PORZ2).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                `;
                tbDetalle.appendChild(row);
                total+=parseFloat(item.UNITOT);
                totdes+=parseFloat(item.SIDESC);
                tot20+=parseFloat(item.UNI20);
                tot30+=parseFloat(item.UNI30);
                tot40+=parseFloat(item.UNI40);
                tot50+=parseFloat(item.UNI50);
                totz1+=parseFloat(item.UNIZ1);
                totz2+=parseFloat(item.UNIZ2);
                lineSinDesc1.push( Math.round(parseFloat(item.PORDESC) * 100) / 100);
                lineSinDescSecure1=[...lineSinDesc1];
                line20Desc1.push( Math.round(parseFloat(item.POR20) * 100) / 100);
                line30Desc1.push( Math.round(parseFloat(item.POR30) * 100) / 100);
                line40Desc1.push( Math.round(parseFloat(item.POR40) * 100) / 100);
                line50Desc1.push( Math.round(parseFloat(item.POR50) * 100) / 100);
                lineZ1Desc1.push( Math.round(parseFloat(item.PORZ1) * 100) / 100);
                lineZ2Desc1.push( Math.round(parseFloat(item.PORZ2) * 100) / 100);
              });
              const count=data.data.length;
              let unitot=0; let unides=0; let uni20=0; let uni30=0; let uni40=0; let uni50=0; let uniz1=0; let uniz2=0;
              let protot=0; let prodes=0; let pro20=0; let pro30=0; let pro40=0; let pro50=0; let proz1=0; let proz2=0;
                unitot= (coun1ttot!=0) ? total/coun1ttot : 0;
                unides= (coun1tdes!=0) ? totdes/coun1tdes : 0;
                uni20= (coun1t20!=0) ? tot20/coun1t20 : 0;
                uni30= (coun1t30!=0) ? tot30/coun1t30 : 0;
                uni40= (coun1t40!=0) ? tot40/coun1t40 : 0;
                uni50= (coun1t50!=0) ? tot50/coun1t50 : 0;
                uniz1= (coun1tz1!=0) ? totz1/coun1tz1 : 0;
                uniz2= (coun1tz2!=0) ? totz2/coun1tz2 : 0;
                let filtDes = lineSinDescSecure1.filter(value => value !== 0);
                let sumDes = filtDes.reduce((a, b) => a + b, 0);

                if (filtDes.length > 0) {
                  prodes = sumDes / filtDes.length;
                }
                let filt20 = line20Desc1.filter(value => value !== 0);
                let sum20 = filt20.reduce((a, b) => a + b, 0);

                if (filt20.length > 0) {
                  pro20 = sum20 / filt20.length;
                }
                let filt30 = line30Desc1.filter(value => value !== 0);
                let sum30 = filt30.reduce((a, b) => a + b, 0);

                if (filt30.length > 0) {
                  pro30 = sum30 / filt30.length;
                }
                let filt40 = line40Desc1.filter(value => value !== 0);
                let sum40 = filt40.reduce((a, b) => a + b, 0);

                if (filt40.length > 0) {
                  pro40 = sum40 / filt40.length;
                }
                let filt50 = line50Desc1.filter(value => value !== 0);
                let sum50 = filt50.reduce((a, b) => a + b, 0);

                if (filt50.length > 0) {
                  pro50 = sum50 / filt50.length;
                }
                let filtZ1 = lineZ1Desc1.filter(value => value !== 0);
                let sumZ1 = filtZ1.reduce((a, b) => a + b, 0);

                if (filtZ1.length > 0) {
                  proz1 = sumZ1 / filtZ1.length;
                }
                let filtZ2 = lineZ2Desc1.filter(value => value !== 0);
                let sumZ2 = filtZ2.reduce((a, b) => a + b, 0);
                if (filtZ2.length > 0) {
                  proz2 = sumZ2 / filtZ2.length;
                }
              barGra1=[
                Math.round(prodes * 100) / 100,
                Math.round(pro20 * 100) / 100,
                Math.round(pro30 * 100) / 100,
                Math.round(pro40 * 100) / 100,
                Math.round(pro50 * 100) / 100,
                Math.round(proz1 * 100) / 100,
                Math.round(proz2 * 100) / 100
              ];
              const row = document.createElement('tr');
              row.innerHTML = `
                  <td class="bg-secondary border border-dark">Promedio</td>
                  <td class="bg-secondary border border-dark">${parseFloat(unitot) === 0 ? '‎' : parseFloat(unitot).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(unides) === 0 ? '‎' : parseFloat(unides).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(prodes) === 0 ? '‎' : parseFloat(prodes).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uni20) === 0 ? '‎' : parseFloat(uni20).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(pro20) === 0 ? '‎' : parseFloat(pro20).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uni30) === 0 ? '‎' : parseFloat(uni30).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(pro30) === 0 ? '‎' : parseFloat(pro30).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uni40) === 0 ? '‎' : parseFloat(uni40).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(pro40) === 0 ? '‎' : parseFloat(pro40).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uni50) === 0 ? '‎' : parseFloat(uni50).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(pro50) === 0 ? '‎' : parseFloat(pro50).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uniz1) === 0 ? '‎' : parseFloat(uniz1).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(proz1) === 0 ? '‎' : parseFloat(proz1).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uniz2) === 0 ? '‎' : parseFloat(uniz2).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(proz2) === 0 ? '‎' : parseFloat(proz2).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                `;
                tbDetalle.appendChild(row);
            }else{
              const row = document.createElement('tr');
              row.innerHTML = `
              <td colspan="16"><span style="font-size:16px; margin:50px;">No hay datos</span></td>
              `;
              tbDetalle.appendChild(row);
            }
          })
          .catch(error => {
            console.error('Error:', error);
            const row = document.createElement('tr');
              row.innerHTML = `
              <td colspan="16">No hay datos</td>
              `;
              tbDetalle.appendChild(row);
          });
        }
        function chargeTable2(valAno,valAgrup) {
          //AÑO 2
          lineSinDesc2=[]; line20Desc2=[]; line30Desc2=[]; line40Desc2=[]; line50Desc2=[]; lineZ1Desc2=[]; lineZ2Desc2=[];
          var urlList="http://172.16.15.20/API.LovablePHP/ZLO0025P/List/?anopro="+valAno+"&agrup="+valAgrup;
          let lblAno2=document.getElementById('lblano2');
          lblAno2.innerHTML='Año '+valAno;
          const tbDetalle = document.getElementById('tableInventarioDetalle2');
          tbDetalle.innerHTML = '';
          fetch(urlList)
          .then(response => response.json())
          .then(data => {
           let coun2ttot=0; let coun2tdes=0; let coun2t20=0; let coun2t30=0; let coun2t40=0; let coun2t50=0; let coun2tz1=0; let coun2tz2=0;
            if (data.code==200) {
              let total=0; let totdes=0; let tot20=0; let tot30=0; let tot40=0; let tot50=0; let totz1=0; let totz2=0;
              responseDataA2=[...data.data];
              responseDataA2.forEach((item) => {
                if (item.UNITOT!=0) {
                  coun2ttot++;
                }
                if (item.SIDESC!=0) {
                  coun2tdes++;
                }
                if (item.UNI20!=0) {
                  coun2t20++;
                }
                if (item.UNI30!=0) {
                  coun2t30++;
                }
                if (item.UNI40!=0) {
                  coun2t40++;
                }
                if (item.UNI50!=0) {
                  coun2t50++;
                }
                if (item.UNIZ1!=0) {
                  coun2tz1++;
                }
                if (item.UNIZ2!=0) {
                  coun2tz2++;
                }
                const row = document.createElement('tr');
                row.innerHTML = `
                  <td class="bg-light border border-dark">${item.MESDES}</td>
                  <td class="bg-light border border-dark">${parseFloat(item.UNITOT) === 0 ? '‎' : parseFloat(item.UNITOT).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgSkySoft border border-dark">${parseFloat(item.SIDESC) === 0 ? '‎' : parseFloat(item.SIDESC).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgSkySoft border border-dark">${parseFloat(item.PORDESC) === 0 ? '‎' : parseFloat(item.PORDESC).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgGoldSoft border border-dark">${parseFloat(item.UNI20) === 0 ? '‎' : parseFloat(item.UNI20).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgGoldSoft border border-dark">${parseFloat(item.POR20) === 0 ? '‎' : parseFloat(item.POR20).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgSeaSoft border border-dark">${parseFloat(item.UNI30) === 0 ? '‎' : parseFloat(item.UNI30).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgSeaSoft border border-dark">${parseFloat(item.POR30) === 0 ? '‎' : parseFloat(item.POR30).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgGreenSoft border border-dark">${parseFloat(item.UNI40) === 0 ? '‎' : parseFloat(item.UNI40).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgGreenSoft border border-dark">${parseFloat(item.POR40) === 0 ? '‎' : parseFloat(item.POR40).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgRedSoft border border-dark">${parseFloat(item.UNI50) === 0 ? '‎' : parseFloat(item.UNI50).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgRedSoft border border-dark">${parseFloat(item.POR50) === 0 ? '‎' : parseFloat(item.POR50).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgOrangeSoft border border-dark">${parseFloat(item.UNIZ1) === 0 ? '‎' : parseFloat(item.UNIZ1).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgOrangeSoft border border-dark">${parseFloat(item.PORZ1) === 0 ? '‎' : parseFloat(item.PORZ1).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bgYellowSoft border border-dark">${parseFloat(item.UNIZ2) === 0 ? '‎' : parseFloat(item.UNIZ2).toLocaleString('es-419', {minimumFractionDigits: 0, maximumFractionDigits: 0})}</td>
                  <td class="bgYellowSoft border border-dark">${parseFloat(item.PORZ2) === 0 ? '‎' : parseFloat(item.PORZ2).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                `;
                tbDetalle.appendChild(row);
                total+=parseFloat(item.UNITOT);
                totdes+=parseFloat(item.SIDESC);
                tot20+=parseFloat(item.UNI20);
                tot30+=parseFloat(item.UNI30);
                tot40+=parseFloat(item.UNI40);
                tot50+=parseFloat(item.UNI50);
                totz1+=parseFloat(item.UNIZ1);
                totz2+=parseFloat(item.UNIZ2);

                lineSinDesc2.push( Math.round(parseFloat(item.PORDESC) * 100) / 100);
                lineSinDescSecure2=[...lineSinDesc2];
                line20Desc2.push( Math.round(parseFloat(item.POR20) * 100) / 100);
                line30Desc2.push( Math.round(parseFloat(item.POR30) * 100) / 100);
                line40Desc2.push( Math.round(parseFloat(item.POR40) * 100) / 100);
                line50Desc2.push( Math.round(parseFloat(item.POR50) * 100) / 100);
                lineZ1Desc2.push( Math.round(parseFloat(item.PORZ1) * 100) / 100);
                lineZ2Desc2.push( Math.round(parseFloat(item.PORZ2) * 100) / 100);
              });
              let unitot=0; let unides=0; let uni20=0; let uni30=0; let uni40=0; let uni50=0; let uniz1=0; let uniz2=0;
              let protot=0; let prodes=0; let pro20=0; let pro30=0; let pro40=0; let pro50=0; let proz1=0; let proz2=0;
                unitot= (coun2ttot!=0) ? total/coun2ttot : 0;
                unides= (coun2tdes!=0) ? totdes/coun2tdes : 0;
                uni20= (coun2t20!=0) ? tot20/coun2t20 : 0;
                uni30= (coun2t30!=0) ? tot30/coun2t30 : 0;
                uni40= (coun2t40!=0) ? tot40/coun2t40 : 0;
                uni50= (coun2t50!=0) ? tot50/coun2t50 : 0;
                uniz1= (coun2tz1!=0) ? totz1/coun2tz1 : 0;
                uniz2= (coun2tz2!=0) ? totz2/coun2tz2 : 0;
                let filtDes = lineSinDescSecure2.filter(value => value !== 0);
                let sumDes = filtDes.reduce((a, b) => a + b, 0);

                if (filtDes.length > 0) {
                  prodes = sumDes / filtDes.length;
                }
                let filt20 = line20Desc2.filter(value => value !== 0);
                let sum20 = filt20.reduce((a, b) => a + b, 0);

                if (filt20.length > 0) {
                  pro20 = sum20 / filt20.length;
                }
                let filt30 = line30Desc2.filter(value => value !== 0);
                let sum30 = filt30.reduce((a, b) => a + b, 0);

                if (filt30.length > 0) {
                  pro30 = sum30 / filt30.length;
                }
                let filt40 = line40Desc2.filter(value => value !== 0);
                let sum40 = filt40.reduce((a, b) => a + b, 0);

                if (filt40.length > 0) {
                  pro40 = sum40 / filt40.length;
                }
                let filt50 = line50Desc2.filter(value => value !== 0);
                let sum50 = filt50.reduce((a, b) => a + b, 0);

                if (filt50.length > 0) {
                  pro50 = sum50 / filt50.length;
                }
                let filtZ1 = lineZ1Desc2.filter(value => value !== 0);
                let sumZ1 = filtZ1.reduce((a, b) => a + b, 0);

                if (filtZ1.length > 0) {
                  proz1 = sumZ1 / filtZ1.length;
                }
                let filtZ2 = lineZ2Desc2.filter(value => value !== 0);
                let sumZ2 = filtZ2.reduce((a, b) => a + b, 0);
                if (filtZ2.length > 0) {
                  proz2 = sumZ2 / filtZ2.length;
                }
              /*  if(total>0){
                  prodes=(totdes/total)*100;
                  pro20=(tot20/total)*100;
                  pro30=(tot30/total)*100;
                  pro40=(tot40/total)*100;
                  pro50=(tot50/total)*100;
                  proz1=(totz1/total)*100;
                  proz2=(totz2/total)*100;
                }*/
              barGra2=[
                Math.round(prodes * 100) / 100,
                Math.round(pro20 * 100) / 100,
                Math.round(pro30 * 100) / 100,
                Math.round(pro40 * 100) / 100,
                Math.round(pro50 * 100) / 100,
                Math.round(proz1 * 100) / 100,
                Math.round(proz2 * 100) / 100
              ];
              const row = document.createElement('tr');
              row.innerHTML = `
                  <td class="bg-secondary border border-dark">Promedio</td>
                  <td class="bg-secondary border border-dark">${parseFloat(unitot) === 0 ? '‎' : parseFloat(unitot).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(unides) === 0 ? '‎' : parseFloat(unides).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(prodes) === 0 ? '‎' : parseFloat(prodes).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uni20) === 0 ? '‎' : parseFloat(uni20).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(pro20) === 0 ? '‎' : parseFloat(pro20).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uni30) === 0 ? '‎' : parseFloat(uni30).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(pro30) === 0 ? '‎' : parseFloat(pro30).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uni40) === 0 ? '‎' : parseFloat(uni40).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(pro40) === 0 ? '‎' : parseFloat(pro40).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uni50) === 0 ? '‎' : parseFloat(uni50).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(pro50) === 0 ? '‎' : parseFloat(pro50).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uniz1) === 0 ? '‎' : parseFloat(uniz1).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(proz1) === 0 ? '‎' : parseFloat(proz1).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(uniz2) === 0 ? '‎' : parseFloat(uniz2).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
                  <td class="bg-secondary border border-dark">${parseFloat(proz2) === 0 ? '‎' : parseFloat(proz2).toLocaleString('es-419', {minimumFractionDigits: 2, maximumFractionDigits: 2})+'%'}</td>
                `;
                tbDetalle.appendChild(row);
            }else{
              const row = document.createElement('tr');
              row.innerHTML = `
              <td colspan="16"><span style="font-size:16px; margin:50px;">No hay datos</span></td>
              `;
              tbDetalle.appendChild(row);
            }
          })
          .catch(error => {
            console.error('Error:', error);
            const row = document.createElement('tr');
              row.innerHTML = `
              <td colspan="16">No hay datos</td>
              `;
              tbDetalle.appendChild(row);
          });
        }

        function chargeGrafica() {
          const cbbGrafica = document.getElementById('selectGrafica');
          let valGrafica=cbbGrafica.value;

          const cbbAno = document.getElementById('cbbAno');
            let valAno=parseInt(cbbAno.value);
            let valAno2=valAno-1;
          chart1.update({
              chart: {
                  type: 'column'
              },
              title: {
                  text: 'Promedio histórico por tipo de descuento <br>'+ cbbAgrup.options[cbbAgrup.selectedIndex].text,
                  align: 'center'
              },
              xAxis: {
                  categories: ['Prendas Sin Dscto.', 'Prendas 20%', 'Prendas 30%', 'Prendas 40%', 'Prendas 50%', 'Segundas Nivel 1', 'Segundas Nivel 2']
              },
              yAxis: {
                  min: 0,
                  title: {
                      text: ' ',
                  }
              },
              tooltip: {
                  valueSuffix: '%'
              },
              plotOptions: {
                  column: {
                      pointPadding: 0.2,
                      borderWidth: 0
                  }
              },
              credits: {
                  enabled: false
              },
              series: [
                  {
                      name: 'Año '+valAno,
                      data: barGra1
                  },
                  {
                      name: 'Año '+valAno2,
                      data: barGra2
                  },
              ]
          });

          let valoresLineal1=[];
          let valoresLineal2=[];
          switch (valGrafica) {
            case 'G2':
              valoresLineal1=line20Desc1;
              valoresLineal2=line20Desc2;
              break;
            case 'G3':
              valoresLineal1=line30Desc1;
              valoresLineal2=line30Desc2;
              break;
            case 'G4':
              valoresLineal1=line40Desc1;
              valoresLineal2=line40Desc2;
              break;
            case 'G5':
              valoresLineal1=line50Desc1;
              valoresLineal2=line50Desc2;
              break;
            case 'G6':
              valoresLineal1=lineZ1Desc1;
              valoresLineal2=lineZ1Desc2;
              break;
            case 'G7':
              valoresLineal1=lineZ2Desc1;
              valoresLineal2=lineZ2Desc2;
              break;
            default:
              valoresLineal1=lineSinDescSecure1;
              valoresLineal2=lineSinDescSecure2;
              break;
          }

          chart2.update({
              chart: {
                  type: 'line'
              },
              title: {
                      text: cbbGrafica.options[cbbGrafica.selectedIndex].text + '<br>' + cbbAgrup.options[cbbAgrup.selectedIndex].text,
                      align: 'center'
                  },
              xAxis: {
                  categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
              },
              plotOptions: {
                  line: {
                      dataLabels: {
                          enabled: true
                      },
                      enableMouseTracking: false
                  }
              },
              credits: {
                      enabled: false
                  },
              series: [{
                name: 'Año '+valAno,
                data: valoresLineal1,
              }, {
                name: 'Año '+valAno2,
                data: valoresLineal2,
              }]
          });
        }
      </script>
</body>
</html>
