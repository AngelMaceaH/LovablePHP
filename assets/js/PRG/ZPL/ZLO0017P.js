var fechaActual;
var mesActual;
var anioActual;
var mes;
var labelMeses;
var responseGenerales=[];
$(document).ready(function () {
 fechaActual = new Date();
 mesActual = fechaActual.getMonth() + 1;
 anioActual = fechaActual.getFullYear();
var urlGenerales = "http://172.16.15.20/API.LovablePHP/ZLO0017P/Generales/?anio=" + anioActual;
 responseGenerales = ajaxRequest(urlGenerales);

 mes = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
 labelMeses = [];
 
var rows=" ";
for (let i = 0; i < responseGenerales.data.length; i++) {
  labelMeses[i] = mes[responseGenerales.data[i]['MESPRO'] - 1];
  rows += `<tr>`;
  rows += `<td class="text-start">${mes[responseGenerales.data[i]['MESPRO'] - 1]} ${responseGenerales.data[i]['ANOPRO']}</td>`;
  rows += `<td class="text-end">${parseFloat(responseGenerales.data[i]['CLIVIE']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
  rows += `<td class="text-end">${parseFloat(responseGenerales.data[i]['PORCE1']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
  rows += `<td class="text-end">${parseFloat(responseGenerales.data[i]['CLINUE']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
  rows += `<td class="text-end">${parseFloat(responseGenerales.data[i]['PORCE2']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
  rows += `<td class="text-end">${parseFloat(responseGenerales.data[i]['TOTCLI']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
  rows += `<td class="text-end">${parseFloat(responseGenerales.data[i]['EMAIL']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
  rows += `<td class="text-end">${parseFloat(responseGenerales.data[i]['PORCE3']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
  rows += `<td class="text-end">${parseFloat(responseGenerales.data[i]['TELEFO']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
  rows += `<td class="text-end">${parseFloat(responseGenerales.data[i]['PORCE5']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
  rows += `<td class="text-end">${parseFloat(responseGenerales.data[i]['MAILTE']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
  rows += `<td class="text-end">${parseFloat(responseGenerales.data[i]['TRANSA']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
  rows += `</tr>`;
}
$("#tbodyGenerales").append(rows);
  
//TABLA
$("#tableGenerales").DataTable( {   
  language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
  },
  "ordering": false,
  "pageLength": 50,
  dom: 'Bfrtip',
  buttons: [
      {
          extend: 'excelHtml5',
          text: '<i class="fa-solid fa-file-excel"></i> <b >Enviar a Excel</b>',
          className: "btn btn-success text-light fs-6 ",
          title: 'Estadisticas generales - programa lealtad',
          
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
              
              $('c[r=A1] t', sheet).text( 'ESTÁDISTICAS GENERALES - PROGRAMA LEALTAD ' );
              $('row:eq(0) c', sheet).attr( 's', greyBoldCentered );
              $('row:eq(1) c', sheet).attr( 's', 7 ); 

              var tagName = sSh.getElementsByTagName('sz');
              for (i = 0; i < tagName.length; i++) {
                tagName[i].setAttribute("val", "13");
              }
              

            }
      }
  ]
    });

var urlComarc = 'http://172.16.15.20/API.LovablePHP/ZLO0001P/ListComarc/?usuario=' + usuario + '';
var responseComarc = ajaxRequest(urlComarc);
console.log(responseComarc.data);
if (responseComarc.code == 200) {

for (let i = 0; i < responseComarc.data.length; i++) {
    if (responseComarc.data[i]['COMCOD'] != 1 && responseComarc.data[i]['COMCOD'] != 35) {
    $("#cbbCia").append(' <option value=' + responseComarc.data[i]['COMCOD'] + '>&nbsp;&nbsp;' + responseComarc.data[i]['COMDES'] + '&nbsp;&nbsp;</option>');
    $("#cbbCia2").append(' <option value=' + responseComarc.data[i]['COMCOD'] + '>&nbsp;&nbsp;' + responseComarc.data[i]['COMDES'] + '&nbsp;&nbsp;</option>');
    }
}
}
//Valores CARTAS
var usuariosActual; var usuariosAnterior;
var emailActual; var emailAnterior;
var telefonoActual; var telefonoAnterior;
var transActual; var transAnterior;
var histUsuarios = []; var histEmail = []; var histTelefono = []; var histTrans = [];

var clieNuevosActual; var clieViejosActual;
var nuevosPorcenActual; var viejosPorcenActual;
var histClientesNuevos = []; var histClientesViejos = [];

var telefonosActual; var emailActual;
var telefonosPorcenActual; var emailsPorcenActual;
if (responseGenerales.code == 200) {
  var data = responseGenerales.data;
  for (let i = 0; i < data.length; i++) {
    if (data[i]['MESPRO'] == mesActual) {
      usuariosActual = data[i]['TOTCLI'];
      emailActual = data[i]['EMAIL'];
      telefonoActual = data[i]['TELEFO'];
      transActual = data[i]['TRANSA'];
      clieNuevosActual = data[i]['CLINUE'];
      clieViejosActual = data[i]['CLIVIE'];
      nuevosPorcenActual = data[i]['PORCE2'];
      viejosPorcenActual = data[i]['PORCE1'];

      emailActual = data[i]['EMAIL'];
      telefonosActual = data[i]['TELEFO'];
      telefonosPorcenActual = data[i]['PORCE5'];
      emailsPorcenActual = data[i]['PORCE4'];
    }
    if (data[i]['MESPRO'] == (mesActual - 1)) {
      usuariosAnterior = data[i]['TOTCLI'];
      emailAnterior = data[i]['EMAIL'];
      telefonoAnterior = data[i]['TELEFO'];
      transAnterior = data[i]['TRANSA'];
    }
    histUsuarios[i] = parseFloat(data[i]['TOTCLI']);
    histEmail[i] = parseFloat(data[i]['EMAIL']);
    histTelefono[i] = parseFloat(data[i]['TELEFO']);
    histTrans[i] = parseFloat(data[i]['TRANSA']);
    histClientesNuevos[i] = parseFloat(data[i]['CLINUE']);
    histClientesViejos[i] = parseFloat(data[i]['CLIVIE']);
  }
}
var creci1 = 0; var creci2 = 0; var creci3 = 0; var creci4 = 0;
//CARTA CLIENTES
$("#usuaActuales").text(parseFloat(usuariosActual).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 }));
if (usuariosAnterior != 0) { creci1 = parseFloat(((usuariosActual / usuariosAnterior) - 1) * 100); }
$("#usuaDiferencia").text(creci1.toFixed(2) + "%");
if (creci1 <= 0) {
  $("#usuaDiferencia").append(`<svg class="icon">
  <use xlink:href="../../assets/vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
</svg>`);
} else {
  $("#usuaDiferencia").append(`<svg class="icon">
  <use xlink:href="../../assets/vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
</svg>`);
}
//CARTA EMAILS
$("#emailActuales").text(parseFloat(emailActual).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 }));
if (emailAnterior != 0) { creci2 = parseFloat(((emailActual / emailAnterior) - 1) * 100); }
$("#emailDiferencia").text(creci2.toFixed(2) + "%");
if (creci2 <= 0) {
  $("#emailDiferencia").append(`<svg class="icon">
  <use xlink:href="../../assets/vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
</svg>`);
} else {
  $("#emailDiferencia").append(`<svg class="icon">
  <use xlink:href="../../assets/vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
</svg>`);
}
//CARTA TELEFONOS
$("#telefActuales").text(parseFloat(telefonoActual).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 }));
if (telefonoAnterior != 0) { creci3 = parseFloat(((telefonoActual / telefonoAnterior) - 1) * 100); }
$("#telefDiferencia").text(creci3.toFixed(2) + "%");
if (creci3 <= 0) {
  $("#telefDiferencia").append(`<svg class="icon">
  <use xlink:href="../../assets/vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
</svg>`);
} else {
  $("#telefDiferencia").append(`<svg class="icon">
  <use xlink:href="../../assets/vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
</svg>`);
}
//CARTA TRANSACCIONES
$("#transActuales").text(parseFloat(transActual).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 }));
if (transAnterior != 0) { creci4 = parseFloat(((transActual / transAnterior) - 1) * 100); }
$("#transDiferencia").text(creci4.toFixed(2) + "%");
if (creci4 <= 0) {
  $("#transDiferencia").append(`<svg class="icon">
  <use xlink:href="../../assets/vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
</svg>`);
} else {
  $("#transDiferencia").append(`<svg class="icon">
  <use xlink:href="../../assets/vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
</svg>`);
}

//GRAFICAS--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------  
// Disable the on-canvas tooltip
Chart.defaults.pointHitDetectionRadius = 1;
Chart.defaults.plugins.tooltip.enabled = false;
Chart.defaults.plugins.tooltip.mode = 'index';
Chart.defaults.plugins.tooltip.position = 'nearest';
Chart.defaults.plugins.tooltip.external = coreui.ChartJS.customTooltips;
Chart.defaults.defaultFontColor = '#646470';
const random = (min, max) =>
  // eslint-disable-next-line no-mixed-operators
  Math.floor(Math.random() * (max - min + 1) + min);

// eslint-disable-next-line no-unused-vars
const cardChart1 = new Chart(document.getElementById('card-chart1'), {
  type: 'line',
  data: {
    labels: labelMeses,
    datasets: [
      {
        label: 'Clientes',
        backgroundColor: 'rgba(255,255,255,.2)',
        borderColor: 'rgba(255,255,255,.55)',
        data: histUsuarios,
        fill: true
      }
    ]
  },
  options: {
    plugins: {
      legend: {
        display: false
      }
    },
    maintainAspectRatio: false,
    scales: {
      x: {
        display: false
      },
      y: {
        display: false
      }
    },
    elements: {
      line: {
        borderWidth: 2,
        tension: 0.4
      },
      point: {
        radius: 0,
        hitRadius: 10,
        hoverRadius: 4
      }
    }
  }
});
// eslint-disable-next-line no-unused-vars
const cardChart2 = new Chart(document.getElementById('card-chart2'), {
  type: 'line',
  data: {
    labels: labelMeses,
    datasets: [
      {
        label: 'Registrados',
        backgroundColor: 'rgba(255,255,255,.2)',
        borderColor: 'rgba(255,255,255,.55)',
        data: histEmail,
        fill: true
      }
    ]
  },
  options: {
    plugins: {
      legend: {
        display: false
      }
    },
    maintainAspectRatio: false,
    scales: {
      x: {
        display: false
      },
      y: {
        display: false
      }
    },
    elements: {
      line: {
        borderWidth: 2,
        tension: 0.4
      },
      point: {
        radius: 0,
        hitRadius: 10,
        hoverRadius: 4
      }
    }
  }
})

// eslint-disable-next-line no-unused-vars
const cardChart3 = new Chart(document.getElementById('card-chart3'), {
  type: 'line',
  data: {
    labels: labelMeses,
    datasets: [
      {
        label: 'Registrados',
        backgroundColor: 'rgba(255,255,255,.2)',
        borderColor: 'rgba(255,255,255,.55)',
        data: histTelefono,
        fill: true
      }
    ]
  },
  options: {
    plugins: {
      legend: {
        display: false
      }
    },
    maintainAspectRatio: false,
    scales: {
      x: {
        display: false
      },
      y: {
        display: false
      }
    },
    elements: {
      line: {
        borderWidth: 2,
        tension: 0.4
      },
      point: {
        radius: 0,
        hitRadius: 10,
        hoverRadius: 4
      }
    }
  }
})

// eslint-disable-next-line no-unused-vars
const cardChart4 = new Chart(document.getElementById('card-chart4'), {
  type: 'line',
  data: {
    labels: labelMeses,
    datasets: [
      {
        label: 'Transacciones',
        backgroundColor: 'rgba(255,255,255,.2)',
        borderColor: 'rgba(255,255,255,.55)',
        data: histTrans,
        fill: true
      }
    ]
  },
  options: {
    plugins: {
      legend: {
        display: false
      }
    },
    maintainAspectRatio: false,
    scales: {
      x: {
        display: false
      },
      y: {
        display: false
      }
    },
    elements: {
      line: {
        borderWidth: 2,
        tension: 0.4
      },
      point: {
        radius: 0,
        hitRadius: 10,
        hoverRadius: 4
      }
    }
  }
})
//LLENADO MAIN GRAFICA

Highcharts.chart('container1', {
  chart: {
    type: 'spline' 
},
lang: {
  viewFullscreen: "Ver en pantalla completa",
  exitFullscreen: "Salir de pantalla completa",
  downloadJPEG: "Descargar imagen JPEG",
  downloadPDF: "Descargar en PDF",
},
exporting: {
  buttons: {
      contextButton: {
          menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
      }
  },
  enabled: true,
  filename: 'Total clientes - General',
  sourceWidth: 1600,
  sourceHeight: 800,
},
  title: {
      text: '<h2 class="fs-4">Historial total de clientes</h2>',
      align: 'left',
      y: 10 
  },
  subtitle: {
    text: '<div class="fs-6"><span>'+obtenerNombreMesActual(responseGenerales.data[0]['MESPRO']) + " " + responseGenerales.data[0]['ANOPRO']+' - '+obtenerNombreMesActual(responseGenerales.data[responseGenerales.data.length-1]['MESPRO']) + " " + responseGenerales.data[responseGenerales.data.length-1]['ANOPRO']+'</span></div>',
    align: 'left',
    y: 35 
},
  yAxis: {
      title: {
          text: ' '
      }},
      xAxis: {
        categories: labelMeses,
        accessibility: {
            rangeDescription: ' '
        }
    }, 
  legend: {
    enabled:true
  },
  credits: {
    enabled: false},
  series: [{
      name: 'Clientes nuevos',
      data: histClientesNuevos
  }, {
      name: 'Clientes viejos',
      data: histClientesViejos,
      type: 'areaspline',  
      fillColor: 'rgba(0,0,0,.1)'
  }],
});


Highcharts.chart('container2', {
  chart: {
    type: 'spline' 
},
lang: {
  viewFullscreen: "Ver en pantalla completa",
  exitFullscreen: "Salir de pantalla completa",
  downloadJPEG: "Descargar imagen JPEG",
  downloadPDF: "Descargar en PDF",
},
exporting: {
  buttons: {
      contextButton: {
          menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
      }
  },
  enabled: true,
  filename: 'Total contactos - General',
  sourceWidth: 1600,
  sourceHeight: 800,
},
  title: {
      text: '<h2 class="fs-4">Historial total de contactos</h2>',
      align: 'left',
      y: 10 
  },
  subtitle: {
    text: '<div class="fs-6"><span>'+obtenerNombreMesActual(responseGenerales.data[0]['MESPRO']) + " " + responseGenerales.data[0]['ANOPRO']+' - '+obtenerNombreMesActual(responseGenerales.data[responseGenerales.data.length-1]['MESPRO']) + " " + responseGenerales.data[responseGenerales.data.length-1]['ANOPRO']+'</span></div>',
    align: 'left',
    y: 35 
},
  yAxis: {
      title: {
          text: ' '
      }},
      xAxis: {
        categories: labelMeses,
        accessibility: {
            rangeDescription: ' '
        }
    }, 
  legend: {
    enabled:true
  },
  credits: {
    enabled: false},
  series: [{
      name: 'Telefonos',
      data: histTelefono,
      type: 'areaspline',  
      fillColor: 'rgba(0,0,0,.1)'
  }, {
      name: 'Correos electronicos',
      data: histEmail,
  }],
});



Highcharts.chart('container3', {
  chart: {
    type: 'column' 
},
lang: {
  viewFullscreen: "Ver en pantalla completa",
  exitFullscreen: "Salir de pantalla completa",
  downloadJPEG: "Descargar imagen JPEG",
  downloadPDF: "Descargar en PDF",
},
exporting: {
  buttons: {
      contextButton: {
          menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
      }
  },
  enabled: true,
  filename: 'Total transacciones - General',
  sourceWidth: 1600,
  sourceHeight: 800,
},
  title: {
      text: '<h2 class="fs-4">Historial total de transacciones</h2>',
      align: 'left',
      y: 10 
  },
  subtitle: {
    text: '<div class="fs-6"><span>'+obtenerNombreMesActual(responseGenerales.data[0]['MESPRO']) + " " + responseGenerales.data[0]['ANOPRO']+' - '+obtenerNombreMesActual(responseGenerales.data[responseGenerales.data.length-1]['MESPRO']) + " " + responseGenerales.data[responseGenerales.data.length-1]['ANOPRO']+'</span></div>',
    align: 'left',
    y: 35 
},
  yAxis: {
      title: {
          text: ' '
      }},
      xAxis: {
        categories: labelMeses,
        accessibility: {
            rangeDescription: ' '
        }
    }, 
  legend: {
    enabled:true
  },
  credits: {
    enabled: false},
  series: [{
      name: 'Transacciones',
      data: histTrans,
  },],
});


//PAISES
  chargePaises();
  $("#cbbPais").on("change", function(){
    var valor=$("#cbbPais").val();
    $("#cbbPais2").val(valor);
    chargePaises();
  });
  $("#cbbPais2").on("change", function(){
    var valor=$("#cbbPais2").val();
    $("#cbbPais").val(valor).trigger("change");
  });
  //Tiendas
  chargeTiendas();
  $("#cbbCia").on("change", function(){
    var valor=$("#cbbCia").val();
    $("#cbbCia2").val(valor);
    chargeTiendas();
  });
  $("#cbbCia2").on("change", function(){
    var valor=$("#cbbCia2").val();
    $("#cbbCia").val(valor).trigger("change");
  });
});

function obtenerNombreMesActual(mesActual) {
  const meses = [
    "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
    "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
  ];
  return meses[mesActual - 1];
}

//PAISES--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------  
function chargeTableP(response) {
  var div=$("#tablePaisesDiv");
  div.empty();
      div.append(` <div class="col-12 rounded mb-2 p-1 ">
      <div class="table-responsive">
          <table  id="tablePaises" class="table stripe table-hover " style="width:100%">
              <thead>
                  <tr>
                      <th class="text-start">Mes</th>     
                      <th class="text-end">Clientes Viejos</th>
                      <th class="text-end">%</th>
                      <th class="text-end">Clientes Nuevos</th>
                      <th class="text-end">%</th>
                      <th class="text-end">Total Clientes</th>
                      <th class="text-end">Correos electrónicos</th>
                      <th class="text-end">%</th>
                      <th class="text-end">Teléfonos</th>
                      <th class="text-end">%</th>
                      <th class="text-end">Total Contactos</th>
                      <th class="text-end">Transacciones</th>
                  </tr>
              </thead>
              <tbody id="tbodyPaises">

              </tbody>
          </table>
      </div>
    </div>`);
    var rows="";
    for (let i = 0; i < response.length; i++) {
      rows += `<tr>`;
      rows += `<td class="text-start">${mes[response[i]['MESPRO'] - 1]} ${response[i]['ANOPRO']}</td>`;
      rows += `<td class="text-end">${parseFloat(response[i]['CLIVIE']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
      rows += `<td class="text-end">${parseFloat(response[i]['PORCE1']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
      rows += `<td class="text-end">${parseFloat(response[i]['CLINUE']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
      rows += `<td class="text-end">${parseFloat(response[i]['PORCE2']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
      rows += `<td class="text-end">${parseFloat(response[i]['TOTCLI']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
      rows += `<td class="text-end">${parseFloat(response[i]['EMAIL']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
      rows += `<td class="text-end">${parseFloat(response[i]['PORCE3']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
      rows += `<td class="text-end">${parseFloat(response[i]['TELEFO']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
      rows += `<td class="text-end">${parseFloat(response[i]['PORCE5']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
      rows += `<td class="text-end">${parseFloat(response[i]['MAILTE']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
      rows += `<td class="text-end">${parseFloat(response[i]['TRANSA']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
      rows += `</tr>`;
    }
    $("#tbodyPaises").append(rows);

    $("#tablePaises").DataTable( {   
      language: {url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',},
      "ordering": false,
      "pageLength": 50,
      dom: 'Bfrtip',
      buttons: [
                {
              extend: 'excelHtml5',
              text: '<i class="fa-solid fa-file-excel"></i> <b >Enviar a Excel</b>',
              className: "btn btn-success text-light fs-6 ",
              title: 'Estadisticas '+$("#cbbPais2 option:selected").text()+' - programa lealtad',
              
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
                  
                  $('c[r=A1] t', sheet).text( 'ESTÁDISTICAS '+$("#cbbPais2 option:selected").text()+' - PROGRAMA LEALTAD ' );
                  $('row:eq(0) c', sheet).attr( 's', greyBoldCentered );
                  $('row:eq(1) c', sheet).attr( 's', 7 ); 
    
                  var tagName = sSh.getElementsByTagName('sz');
                  for (i = 0; i < tagName.length; i++) {
                    tagName[i].setAttribute("val", "13");
                    }
                  }
              }
          ]
        });
}

function chargePaises() {
  const paisesDiv = $("#paisesDiv");
  paisesDiv.empty();

  var paises = $("#cbbPais").val();
  var urlPaises = "http://172.16.15.20/API.LovablePHP/ZLO0017P/Paises/?anio=" + anioActual+"&paises="+paises+"";
  var responsePaises = ajaxRequest(urlPaises);

  if (responsePaises.code==200) {
    chargeTableP(responsePaises.data);
    paisesDiv.append(`<div class="row mt-1">
              <div class="col-sm-6 col-lg-3">
                  <div class="card mb-4 text-white" style="background-color:#F3B609;">
                      <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                          <div>
                              <div class="fs-3 fw-semibold"><span id="usuaActuales4"></span> (<span
                                      class="fs-6 fw-normal" id="usuaDiferencia4"></span>)
                              </div>
                              <div><span class="fs-5">Clientes</span></div>
                          </div>
                      </div>
                      <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                          <canvas class="chart" id="card-chart5" height="70"></canvas>
                      </div>
                  </div>
              </div>
              <!-- /.col-->
              <div class="col-sm-6 col-lg-3">
                  <div class="card mb-4 text-white" style="background-color:#F8760A;">
                      <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                          <div>
                              <div class="fs-3 fw-semibold"><span id="emailActuales5"></span> (<span
                                      class="fs-6 fw-normal" id="emailDiferencia5"></span>)
                              </div>
                              <div><span class="fs-5">Correos electrónicos</span></div>
                          </div>
                      </div>
                      <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                          <canvas class="chart" id="card-chart6" height="70"></canvas>
                      </div>
                  </div>
              </div>
              <!-- /.col-->
              <div class="col-sm-6 col-lg-3">
                  <div class="card mb-4 text-white" style="background-color:#574E46;">
                      <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                          <div>
                              <div class="fs-3 fw-semibold"><span id="telefActuales6"></span> (<span
                                      class="fs-6 fw-normal" id="telefDiferencia6"></span>)
                              </div>
                              <div><span class="fs-5">Teléfonos</span></div>
                          </div>
                      </div>
                      <div class="c-chart-wrapper mt-3" style="height:70px;">
                          <canvas class="chart" id="card-chart7" height="70"></canvas>
                      </div>
                  </div>
              </div>
              <!-- /.col-->
              <div class="col-sm-6 col-lg-3">
                  <div class="card mb-4 text-white " style="background-color:#EF5442;">
                      <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                          <div>
                              <div class="fs-3 fw-semibold"><span id="transActuales7"></span> (<span
                                      class="fs-6 fw-normal" id="transDiferencia7"></span>)
                              </div>
                              <div><span class="fs-5">Transacciones</span></div>
                          </div>
                      </div>
                      <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                          <canvas class="chart" id="card-chart8" height="70"></canvas>
                      </div>
                  </div>
              </div>
              <!-- /.col-->
          </div>
          <!--/CARTAS-->
          <div id="carouselExampleDark2" class="carousel carousel-dark slide">
              <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleDark2" data-bs-slide-to="0"
                      class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleDark2" data-bs-slide-to="1"
                      aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleDark2" data-bs-slide-to="2"
                      aria-label="Slide 3"></button>
              </div>
              <div class="carousel-inner pe-5 ps-5">
                  <div class="carousel-item active">
                      <div id="container " class=" mb-5">
                          <div class="card mb-4">
                              <div class="card-body table-responsive">
                                <figure class="chart highcharts-figure p-0 m-0" >
                                    <div id="container4" style="height:100%; width=100%; min-height: 50vh; min-width: 150vh;"></div>
                                </figure>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="carousel-item">
                      <div id="container " class=" mb-5">
                            <div class="card mb-4">
                            <div class="card-body table-responsive">
                              <figure class="chart highcharts-figure p-0 m-0" >
                                  <div id="container5" style="height:100%; width=100%; min-height: 50vh; min-width: 150vh;"></div>
                              </figure>
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="carousel-item">
                      <div id="container " class=" mb-5">
                              <div class="card mb-4">
                              <div class="card-body table-responsive">
                                <figure class="chart highcharts-figure p-0 m-0" >
                                    <div id="container6" style="height:100%; width=100%; min-height: 50vh; min-width: 150vh;"></div>
                                </figure>
                              </div>
                          </div>
                          </div>
                      </div>
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark2"
                      data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark2"
                      data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                  </button>
              </div>`);
            

  var data=responsePaises.data;
  //Valores CARTAS
var usuariosActual; var usuariosAnterior;
var emailActual; var emailAnterior;
var telefonoActual; var telefonoAnterior;
var transActual; var transAnterior;
var histUsuarios = []; var histEmail = []; var histTelefono = []; var histTrans = [];

var clieNuevosActual; var clieViejosActual;
var nuevosPorcenActual; var viejosPorcenActual;
var histClientesNuevos = []; var histClientesViejos = [];

      var telefonosActual; var emailActual;
      var telefonosPorcenActual; var emailsPorcenActual;
        for (let i = 0; i < data.length; i++) {
          if (data[i]['MESPRO'] == mesActual) {
            usuariosActual = data[i]['TOTCLI'];
            emailActual = data[i]['EMAIL'];
            telefonoActual = data[i]['TELEFO'];
            transActual = data[i]['TRANSA'];
            clieNuevosActual = data[i]['CLINUE'];
            clieViejosActual = data[i]['CLIVIE'];
            nuevosPorcenActual = data[i]['PORCE2'];
            viejosPorcenActual = data[i]['PORCE1'];

            emailActual = data[i]['EMAIL'];
            telefonosActual = data[i]['TELEFO'];
            telefonosPorcenActual = data[i]['PORCE5'];
            emailsPorcenActual = data[i]['PORCE4'];
          }
          if (data[i]['MESPRO'] == (mesActual - 1)) {
            usuariosAnterior = data[i]['TOTCLI'];
            emailAnterior = data[i]['EMAIL'];
            telefonoAnterior = data[i]['TELEFO'];
            transAnterior = data[i]['TRANSA'];
          }
          histUsuarios[i] = parseFloat(data[i]['TOTCLI']);
          histEmail[i] = parseFloat(data[i]['EMAIL']);
          histTelefono[i] = parseFloat(data[i]['TELEFO']);
          histTrans[i] = parseFloat(data[i]['TRANSA']);
          histClientesNuevos[i] = parseFloat(data[i]['CLINUE']);
          histClientesViejos[i] = parseFloat(data[i]['CLIVIE']);
        }
        var paisSelected=$("#cbbPais option:selected").text();
        var creci1 = 0; var creci2 = 0; var creci3 = 0; var creci4 = 0;
        //CARTA CLIENTES
        $("#usuaActuales4").text(parseFloat(usuariosActual).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 }));
        if (usuariosAnterior != 0) { creci1 = parseFloat(((usuariosActual / usuariosAnterior) - 1) * 100); }
        $("#usuaDiferencia4").text(creci1.toFixed(2) + "%");
        if (creci1 <= 0) {
          $("#usuaDiferencia4").append(`<svg class="icon">
          <use xlink:href="../../assets/vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
        </svg>`);
        } else {
          $("#usuaDiferencia4").append(`<svg class="icon">
          <use xlink:href="../../assets/vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
        </svg>`);
        }
        //CARTA EMAILS
        $("#emailActuales5").text(parseFloat(emailActual).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 }));
        if (emailAnterior != 0) { creci2 = parseFloat(((emailActual / emailAnterior) - 1) * 100); }
        $("#emailDiferencia5").text(creci2.toFixed(2) + "%");
        if (creci2 <= 0) {
          $("#emailDiferencia5").append(`<svg class="icon">
          <use xlink:href="../../assets/vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
        </svg>`);
        } else {
          $("#emailDiferencia5").append(`<svg class="icon">
          <use xlink:href="../../assets/vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
        </svg>`);
        }
        //CARTA TELEFONOS
        $("#telefActuales6").text(parseFloat(telefonoActual).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 }));
        if (telefonoAnterior != 0) { creci3 = parseFloat(((telefonoActual / telefonoAnterior) - 1) * 100); }
        $("#telefDiferencia6").text(creci3.toFixed(2) + "%");
        if (creci3 <= 0) {
          $("#telefDiferencia6").append(`<svg class="icon">
          <use xlink:href="../../assets/vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
        </svg>`);
        } else {
          $("#telefDiferencia6").append(`<svg class="icon">
          <use xlink:href="../../assets/vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
        </svg>`);
        }
        //CARTA TRANSACCIONES
        $("#transActuales7").text(parseFloat(transActual).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 }));
        if (transAnterior != 0) { creci4 = parseFloat(((transActual / transAnterior) - 1) * 100); }
        $("#transDiferencia7").text(creci4.toFixed(2) + "%");
        if (creci4 <= 0) {
          $("#transDiferencia7").append(`<svg class="icon">
          <use xlink:href="../../assets/vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
        </svg>`);
        } else {
          $("#transDiferencia7").append(`<svg class="icon">
          <use xlink:href="../../assets/vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
        </svg>`);
        }
        var cardChart1 = new Chart(document.getElementById('card-chart5'), {
          type: 'line',
          data: {
            labels: labelMeses,
            datasets: [
              {
                label: 'Clientes',
                backgroundColor: 'rgba(255,255,255,.2)',
                borderColor: 'rgba(255,255,255,.55)',
                data: histUsuarios,
                fill: true
              }
            ]
          },
          options: {
            plugins: {
              legend: {
                display: false
              }
            },
            maintainAspectRatio: false,
            scales: {
              x: {
                display: false
              },
              y: {
                display: false
              }
            },
            elements: {
              line: {
                borderWidth: 2,
                tension: 0.4
              },
              point: {
                radius: 0,
                hitRadius: 10,
                hoverRadius: 4
              }
            }
          }
        });
        var cardChart2 = new Chart(document.getElementById('card-chart6'), {
          type: 'line',
          data: {
            labels: labelMeses,
            datasets: [
              {
                label: 'Registrados',
                backgroundColor: 'rgba(255,255,255,.2)',
                borderColor: 'rgba(255,255,255,.55)',
                data: histEmail,
                fill: true
              }
            ]
          },
          options: {
            plugins: {
              legend: {
                display: false
              }
            },
            maintainAspectRatio: false,
            scales: {
              x: {
                display: false
              },
              y: {
                display: false
              }
            },
            elements: {
              line: {
                borderWidth: 2,
                tension: 0.4
              },
              point: {
                radius: 0,
                hitRadius: 10,
                hoverRadius: 4
              }
            }
          }
        });
        var cardChart3 = new Chart(document.getElementById('card-chart7'), {
          type: 'line',
          data: {
            labels: labelMeses,
            datasets: [
              {
                label: 'Registrados',
                backgroundColor: 'rgba(255,255,255,.2)',
                borderColor: 'rgba(255,255,255,.55)',
                data: histTelefono,
                fill: true
              }
            ]
          },
          options: {
            plugins: {
              legend: {
                display: false
              }
            },
            maintainAspectRatio: false,
            scales: {
              x: {
                display: false
              },
              y: {
                display: false
              }
            },
            elements: {
              line: {
                borderWidth: 2,
                tension: 0.4
              },
              point: {
                radius: 0,
                hitRadius: 10,
                hoverRadius: 4
              }
            }
          }
        });
        var cardChart4 = new Chart(document.getElementById('card-chart8'), {
          type: 'line',
          data: {
            labels: labelMeses,
            datasets: [
              {
                label: 'Transacciones',
                backgroundColor: 'rgba(255,255,255,.2)',
                borderColor: 'rgba(255,255,255,.55)',
                data: histTrans,
                fill: true
              }
            ]
          },
          options: {
            plugins: {
              legend: {
                display: false
              }
            },
            maintainAspectRatio: false,
            scales: {
              x: {
                display: false
              },
              y: {
                display: false
              }
            },
            elements: {
              line: {
                borderWidth: 2,
                tension: 0.4
              },
              point: {
                radius: 0,
                hitRadius: 10,
                hoverRadius: 4
              }
            }
          }
        });
              Highcharts.chart('container4', {
                chart: {
                  type: 'spline' 
              },
              lang: {
                viewFullscreen: "Ver en pantalla completa",
                exitFullscreen: "Salir de pantalla completa",
                downloadJPEG: "Descargar imagen JPEG",
                downloadPDF: "Descargar en PDF",
            },
            exporting: {
                buttons: {
                    contextButton: {
                        menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
                    }
                },
                enabled: true,
                filename: 'Total clientes - '+paisSelected+'',
                sourceWidth: 1600,
                sourceHeight: 800,
            },
                title: {
                    text: '<h2 class="fs-4">Historial total de clientes - '+paisSelected+'</h2>',
                    align: 'left',
                    y: 10 
                },
                subtitle: {
                  text: '<div class="fs-6"><span>'+obtenerNombreMesActual(data[0]['MESPRO']) + " " + data[0]['ANOPRO']+' - '+obtenerNombreMesActual(data[data.length-1]['MESPRO']) + " " + data[data.length-1]['ANOPRO']+'</span></div>',
                  align: 'left',
                  y: 35 
              },
                yAxis: {
                    title: {
                        text: ' '
                    }},
                    xAxis: {
                      categories: labelMeses,
                      accessibility: {
                          rangeDescription: ' '
                      }
                  }, 
                legend: {
                  enabled:false
                },
                credits: {
                  enabled: false},
                series: [{
                    name: 'Clientes nuevos',
                    data: histClientesNuevos
                }, {
                    name: 'Clientes viejos',
                    data: histClientesViejos,
                    type: 'areaspline',  
                    fillColor: 'rgba(0,0,0,.1)'
                }],
            
            });
            
            Highcharts.chart('container5', {
              chart: {
                type: 'spline' 
            },
            lang: {
              viewFullscreen: "Ver en pantalla completa",
              exitFullscreen: "Salir de pantalla completa",
              downloadJPEG: "Descargar imagen JPEG",
              downloadPDF: "Descargar en PDF",
            },
            exporting: {
              buttons: {
                  contextButton: {
                      menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
                  }
              },
              enabled: true,
              filename: 'Total contactos - '+paisSelected+'',
              sourceWidth: 1600,
              sourceHeight: 800,
            },
              title: {
                  text: '<h2 class="fs-4">Historial total de contactos - '+paisSelected+'</h2>',
                  align: 'left',
                  y: 10 
              },
              subtitle: {
                text: '<div class="fs-6"><span>'+obtenerNombreMesActual(data[0]['MESPRO']) + " " + data[0]['ANOPRO']+' - '+obtenerNombreMesActual(data[data.length-1]['MESPRO']) + " " + data[data.length-1]['ANOPRO']+'</span></div>',
                align: 'left',
                y: 35 
            },
              yAxis: {
                  title: {
                      text: ' '
                  }},
                  xAxis: {
                    categories: labelMeses,
                    accessibility: {
                        rangeDescription: ' '
                    }
                }, 
              legend: {
                enabled:true
              },
              credits: {
                enabled: false},
              series: [{
                  name: 'Telefonos',
                  data: histTelefono,
                  type: 'areaspline',  
                  fillColor: 'rgba(0,0,0,.1)'
              }, {
                  name: 'Correos electronicos',
                  data: histEmail,
              }],
            });
          
            

Highcharts.chart('container6', {
  chart: {
    type: 'column' 
},
lang: {
  viewFullscreen: "Ver en pantalla completa",
  exitFullscreen: "Salir de pantalla completa",
  downloadJPEG: "Descargar imagen JPEG",
  downloadPDF: "Descargar en PDF",
},
exporting: {
  buttons: {
      contextButton: {
          menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
      }
  },
  enabled: true,
  filename: 'Total transacciones - '+paisSelected+'',
  sourceWidth: 1600,
  sourceHeight: 800,
},
  title: {
      text: '<h2 class="fs-4">Historial total de transacciones - '+paisSelected+'</h2>',
      align: 'left',
      y: 10 
  },
  subtitle: {
    text: '<div class="fs-6"><span>'+obtenerNombreMesActual(data[0]['MESPRO']) + " " + data[0]['ANOPRO']+' - '+obtenerNombreMesActual(data[data.length-1]['MESPRO']) + " " + data[data.length-1]['ANOPRO']+'</span></div>',
    align: 'left',
    y: 35 
},
  yAxis: {
      title: {
          text: ' '
      }},
      xAxis: {
        categories: labelMeses,
        accessibility: {
            rangeDescription: ' '
        }
    }, 
  legend: {
    enabled:true
  },
  credits: {
    enabled: false},
  series: [{
      name: 'Transacciones',
      data: histTrans,
  },],
});
  }
}



//TIENDAS--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------  
function chargeTableT(response) {
  var div=$("#tableTiendasDiv");
  div.empty();
      div.append(` <div class="col-12 rounded mb-2 p-1 ">
      <div class="table-responsive">
          <table  id="tableTiendas" class="table stripe table-hover " style="width:100%">
              <thead>
                  <tr>
                      <th class="text-start">Mes</th>     
                      <th class="text-end">Clientes Viejos</th>
                      <th class="text-end">%</th>
                      <th class="text-end">Clientes Nuevos</th>
                      <th class="text-end">%</th>
                      <th class="text-end">Total Clientes</th>
                      <th class="text-end">Correos electrónicos</th>
                      <th class="text-end">%</th>
                      <th class="text-end">Teléfonos</th>
                      <th class="text-end">%</th>
                      <th class="text-end">Total Contactos</th>
                      <th class="text-end">Transacciones</th>
                  </tr>
              </thead>
              <tbody id="tbodyTiendas">

              </tbody>
          </table>
      </div>
    </div>`);
    var rows="";
    for (let i = 0; i < response.length; i++) {
      rows += `<tr>`;
      rows += `<td class="text-start">${mes[response[i]['MESPRO'] - 1]} ${response[i]['ANOPRO']}</td>`;
      rows += `<td class="text-end">${parseFloat(response[i]['CLIVIE']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
      rows += `<td class="text-end">${parseFloat(response[i]['PORCE1']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
      rows += `<td class="text-end">${parseFloat(response[i]['CLINUE']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
      rows += `<td class="text-end">${parseFloat(response[i]['PORCE2']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
      rows += `<td class="text-end">${parseFloat(response[i]['TOTCLI']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
      rows += `<td class="text-end">${parseFloat(response[i]['EMAIL']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
      rows += `<td class="text-end">${parseFloat(response[i]['PORCE3']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
      rows += `<td class="text-end">${parseFloat(response[i]['TELEFO']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
      rows += `<td class="text-end">${parseFloat(response[i]['PORCE5']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
      rows += `<td class="text-end">${parseFloat(response[i]['MAILTE']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
      rows += `<td class="text-end">${parseFloat(response[i]['TRANSA']).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}</td>`;
      rows += `</tr>`;
    }
    $("#tbodyTiendas").append(rows);

    $("#tableTiendas").DataTable( {   
      language: {url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',},
      "ordering": false,
      "pageLength": 50,
      dom: 'Bfrtip',
      buttons: [
                {
              extend: 'excelHtml5',
              text: '<i class="fa-solid fa-file-excel"></i> <b >Enviar a Excel</b>',
              className: "btn btn-success text-light fs-6 ",
              title: 'Estadisticas '+$("#cbbCia2 option:selected").text()+' - programa lealtad',
              
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
                  
                  $('c[r=A1] t', sheet).text( 'ESTÁDISTICAS '+$("#cbbCia2 option:selected").text()+' - PROGRAMA LEALTAD ' );
                  $('row:eq(0) c', sheet).attr( 's', greyBoldCentered );
                  $('row:eq(1) c', sheet).attr( 's', 7 ); 
    
                  var tagName = sSh.getElementsByTagName('sz');
                  for (i = 0; i < tagName.length; i++) {
                    tagName[i].setAttribute("val", "13");
                    }
                  }
              }
          ]
        });
}

function chargeTiendas() {
  const tiendasDiv = $("#tiendasDiv");
  tiendasDiv.empty();

  var tienda = $("#cbbCia").val();
  var urlTiendas = "http://172.16.15.20/API.LovablePHP/ZLO0017P/Tiendas/?anio="+anioActual+"&tiendas="+tienda+"";
  var responseTiendas = ajaxRequest(urlTiendas);
    chargeTableT(responseTiendas.data);
    tiendasDiv.append(`<div class="row mt-1">
              <div class="col-sm-6 col-lg-3">
                  <div class="card mb-4 text-white" style="background-color:#F3B609;">
                      <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                          <div>
                              <div class="fs-3 fw-semibold"><span id="usuaActuales9"></span> (<span
                                      class="fs-6 fw-normal" id="usuaDiferencia9"></span>)
                              </div>
                              <div><span class="fs-5">Clientes</span></div>
                          </div>
                      </div>
                      <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                          <canvas class="chart" id="card-chart9" height="70"></canvas>
                      </div>
                  </div>
              </div>
              <!-- /.col-->
              <div class="col-sm-6 col-lg-3">
                  <div class="card mb-4 text-white" style="background-color:#F8760A;">
                      <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                          <div>
                              <div class="fs-3 fw-semibold"><span id="emailActuales10"></span> (<span
                                      class="fs-6 fw-normal" id="emailDiferencia10"></span>)
                              </div>
                              <div><span class="fs-5">Correos electrónicos</span></div>
                          </div>
                      </div>
                      <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                          <canvas class="chart" id="card-chart10" height="70"></canvas>
                      </div>
                  </div>
              </div>
              <!-- /.col-->
              <div class="col-sm-6 col-lg-3">
                  <div class="card mb-4 text-white" style="background-color:#574E46;">
                      <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                          <div>
                              <div class="fs-3 fw-semibold"><span id="telefActuales11"></span> (<span
                                      class="fs-6 fw-normal" id="telefDiferencia11"></span>)
                              </div>
                              <div><span class="fs-5">Teléfonos</span></div>
                          </div>
                      </div>
                      <div class="c-chart-wrapper mt-3" style="height:70px;">
                          <canvas class="chart" id="card-chart11" height="70"></canvas>
                      </div>
                  </div>
              </div>
              <!-- /.col-->
              <div class="col-sm-6 col-lg-3">
                  <div class="card mb-4 text-white " style="background-color:#EF5442;">
                      <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                          <div>
                              <div class="fs-3 fw-semibold"><span id="transActuales12"></span> (<span
                                      class="fs-6 fw-normal" id="transDiferencia12"></span>)
                              </div>
                              <div><span class="fs-5">Transacciones</span></div>
                          </div>
                      </div>
                      <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                          <canvas class="chart" id="card-chart12" height="70"></canvas>
                      </div>
                  </div>
              </div>
              <!-- /.col-->
          </div>
          <!--/CARTAS-->
          <div id="carouselExampleDark3" class="carousel carousel-dark slide">
              <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleDark3" data-bs-slide-to="0"
                      class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleDark3" data-bs-slide-to="1"
                      aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleDark3" data-bs-slide-to="2"
                      aria-label="Slide 3"></button>
              </div>
              <div class="carousel-inner pe-5 ps-5">
                  <div class="carousel-item active">
                      <div id="container " class=" mb-5">
                          <div class="card mb-4">
                              <div class="card-body table-responsive">
                                <figure class="chart highcharts-figure p-0 m-0" >
                                    <div id="container7" style="height:100%; width=100%; min-height: 50vh; min-width: 150vh;"></div>
                                </figure>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="carousel-item">
                      <div id="container " class=" mb-5">
                            <div class="card mb-4">
                            <div class="card-body table-responsive">
                              <figure class="chart highcharts-figure p-0 m-0" >
                                  <div id="container8" style="height:100%; width=100%; min-height: 50vh; min-width: 150vh;"></div>
                              </figure>
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="carousel-item">
                      <div id="container " class=" mb-5">
                              <div class="card mb-4">
                              <div class="card-body table-responsive">
                                <figure class="chart highcharts-figure p-0 m-0" >
                                    <div id="container9" style="height:100%; width=100%; min-height: 50vh; min-width: 150vh;"></div>
                                </figure>
                              </div>
                          </div>
                          </div>
                      </div>
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark3"
                      data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark3"
                      data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                  </button>
              </div>`);
            

  var data=[];
  if (responseTiendas.code==200) {
    data=responseTiendas.data;
  }
  //Valores CARTAS
var usuariosActual=0; var usuariosAnterior=0;
var emailActual=0; var emailAnterior=0;
var telefonoActual=0; var telefonoAnterior=0;
var transActual=0; var transAnterior=0;
var clieNuevosActual=0; var clieViejosActual=0;
var nuevosPorcenActual=0; var viejosPorcenActual=0;
var histUsuarios = []; var histEmail = []; var histTelefono = []; var histTrans = [];
var histClientesNuevos = []; var histClientesViejos = [];
for (let j = 0; j < labelMeses.length; j++) {
   histUsuarios[j] = 0;
   histEmail[j] = 0;  
   histTelefono[j] = 0;  
   histTrans[j] = 0;
  
}
      var telefonosActual=0; var emailActual=0;
      var telefonosPorcenActual=0; var emailsPorcenActual=0;
        if (data.length!=0) {
          for (let i = 0; i < data.length; i++) {
            if (data[i]['MESPRO'] == mesActual) {
              usuariosActual = data[i]['TOTCLI'];
              emailActual = data[i]['EMAIL'];
              telefonoActual = data[i]['TELEFO'];
              transActual = data[i]['TRANSA'];
              clieNuevosActual = data[i]['CLINUE'];
              clieViejosActual = data[i]['CLIVIE'];
              nuevosPorcenActual = data[i]['PORCE2'];
              viejosPorcenActual = data[i]['PORCE1'];
  
              emailActual = data[i]['EMAIL'];
              telefonosActual = data[i]['TELEFO'];
              telefonosPorcenActual = data[i]['PORCE5'];
              emailsPorcenActual = data[i]['PORCE4'];
            }
            if (data[i]['MESPRO'] == (mesActual - 1)) {
              usuariosAnterior = data[i]['TOTCLI'];
              emailAnterior = data[i]['EMAIL'];
              telefonoAnterior = data[i]['TELEFO'];
              transAnterior = data[i]['TRANSA'];
            }
            histUsuarios[i] = parseFloat(data[i]['TOTCLI']);
            histEmail[i] = parseFloat(data[i]['EMAIL']);
            histTelefono[i] = parseFloat(data[i]['TELEFO']);
            histTrans[i] = parseFloat(data[i]['TRANSA']);
            histClientesNuevos[i] = parseFloat(data[i]['CLINUE']);
            histClientesViejos[i] = parseFloat(data[i]['CLIVIE']);
          }
        }
        var tiendaSelected=$("#cbbCia option:selected").text();
        var creci1 = 0; var creci2 = 0; var creci3 = 0; var creci4 = 0;
        //CARTA CLIENTES
        $("#usuaActuales9").text(parseFloat(usuariosActual).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 }));
        if (usuariosAnterior != 0) { creci1 = parseFloat(((usuariosActual / usuariosAnterior) - 1) * 100); }
        $("#usuaDiferencia9").text(creci1.toFixed(2) + "%");
        if (creci1 <= 0) {
          $("#usuaDiferencia9").append(`<svg class="icon">
          <use xlink:href="../../assets/vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
        </svg>`);
        } else {
          $("#usuaDiferencia9").append(`<svg class="icon">
          <use xlink:href="../../assets/vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
        </svg>`);
        }
        //CARTA EMAILS
        $("#emailActuales10").text(parseFloat(emailActual).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 }));
        if (emailAnterior != 0) { creci2 = parseFloat(((emailActual / emailAnterior) - 1) * 100); }
        $("#emailDiferencia10").text(creci2.toFixed(2) + "%");
        if (creci2 <= 0) {
          $("#emailDiferencia10").append(`<svg class="icon">
          <use xlink:href="../../assets/vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
        </svg>`);
        } else {
          $("#emailDiferencia10").append(`<svg class="icon">
          <use xlink:href="../../assets/vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
        </svg>`);
        }
        //CARTA TELEFONOS
        $("#telefActuales11").text(parseFloat(telefonoActual).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 }));
        if (telefonoAnterior != 0) { creci3 = parseFloat(((telefonoActual / telefonoAnterior) - 1) * 100); }
        $("#telefDiferencia11").text(creci3.toFixed(2) + "%");
        if (creci3 <= 0) {
          $("#telefDiferencia11").append(`<svg class="icon">
          <use xlink:href="../../assets/vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
        </svg>`);
        } else {
          $("#telefDiferencia11").append(`<svg class="icon">
          <use xlink:href="../../assets/vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
        </svg>`);
        }
        //CARTA TRANSACCIONES
        $("#transActuales12").text(parseFloat(transActual).toLocaleString('es-419', { minimumFractionDigits: 0, maximumFractionDigits: 0 }));
        if (transAnterior != 0) { creci4 = parseFloat(((transActual / transAnterior) - 1) * 100); }
        $("#transDiferencia12").text(creci4.toFixed(2) + "%");
        if (creci4 <= 0) {
          $("#transDiferencia12").append(`<svg class="icon">
          <use xlink:href="../../assets/vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
        </svg>`);
        } else {
          $("#transDiferencia12").append(`<svg class="icon">
          <use xlink:href="../../assets/vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
        </svg>`);
        }
        var cardChart1 = new Chart(document.getElementById('card-chart9'), {
          type: 'line',
          data: {
            labels: labelMeses,
            datasets: [
              {
                label: 'Clientes',
                backgroundColor: 'rgba(255,255,255,.2)',
                borderColor: 'rgba(255,255,255,.55)',
                data: histUsuarios,
                fill: true
              }
            ]
          },
          options: {
            plugins: {
              legend: {
                display: false
              }
            },
            maintainAspectRatio: false,
            scales: {
              x: {
                display: false
              },
              y: {
                display: false
              }
            },
            elements: {
              line: {
                borderWidth: 2,
                tension: 0.4
              },
              point: {
                radius: 0,
                hitRadius: 10,
                hoverRadius: 4
              }
            }
          }
        });
        // eslint-disable-next-line no-unused-vars
        var cardChart2 = new Chart(document.getElementById('card-chart10'), {
          type: 'line',
          data: {
            labels: labelMeses,
            datasets: [
              {
                label: 'Registrados',
                backgroundColor: 'rgba(255,255,255,.2)',
                borderColor: 'rgba(255,255,255,.55)',
                data: histEmail,
                fill: true
              }
            ]
          },
          options: {
            plugins: {
              legend: {
                display: false
              }
            },
            maintainAspectRatio: false,
            scales: {
              x: {
                display: false
              },
              y: {
                display: false
              }
            },
            elements: {
              line: {
                borderWidth: 2,
                tension: 0.4
              },
              point: {
                radius: 0,
                hitRadius: 10,
                hoverRadius: 4
              }
            }
          }
        })
        
        // eslint-disable-next-line no-unused-vars
        var cardChart3 = new Chart(document.getElementById('card-chart11'), {
          type: 'line',
          data: {
            labels: labelMeses,
            datasets: [
              {
                label: 'Registrados',
                backgroundColor: 'rgba(255,255,255,.2)',
                borderColor: 'rgba(255,255,255,.55)',
                data: histTelefono,
                fill: true
              }
            ]
          },
          options: {
            plugins: {
              legend: {
                display: false
              }
            },
            maintainAspectRatio: false,
            scales: {
              x: {
                display: false
              },
              y: {
                display: false
              }
            },
            elements: {
              line: {
                borderWidth: 2,
                tension: 0.4
              },
              point: {
                radius: 0,
                hitRadius: 10,
                hoverRadius: 4
              }
            }
          }
        })
        
        // eslint-disable-next-line no-unused-vars
        var cardChart4 = new Chart(document.getElementById('card-chart12'), {
          type: 'line',
          data: {
            labels: labelMeses,
            datasets: [
              {
                label: 'Transacciones',
                backgroundColor: 'rgba(255,255,255,.2)',
                borderColor: 'rgba(255,255,255,.55)',
                data: histTrans,
                fill: true
              }
            ]
          },
          options: {
            plugins: {
              legend: {
                display: false
              }
            },
            maintainAspectRatio: false,
            scales: {
              x: {
                display: false
              },
              y: {
                display: false
              }
            },
            elements: {
              line: {
                borderWidth: 2,
                tension: 0.4
              },
              point: {
                radius: 0,
                hitRadius: 10,
                hoverRadius: 4
              }
            }
          }
        })

              Highcharts.chart('container7', {
                chart: {
                  type: 'spline' 
              },
              lang: {
                viewFullscreen: "Ver en pantalla completa",
                exitFullscreen: "Salir de pantalla completa",
                downloadJPEG: "Descargar imagen JPEG",
                downloadPDF: "Descargar en PDF",
            },
            exporting: {
                buttons: {
                    contextButton: {
                        menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
                    }
                },
                enabled: true,
                filename: 'Total clientes - '+tiendaSelected+'',
                sourceWidth: 1600,
                sourceHeight: 800,
            },
                title: {
                    text: '<h2 class="fs-4">Historial total de clientes - '+tiendaSelected+'</h2>',
                    align: 'left',
                    y: 10 
                },
                subtitle: {
                  text: '<div class="fs-6"><span>'+obtenerNombreMesActual(data[0]['MESPRO']) + " " + data[0]['ANOPRO']+' - '+obtenerNombreMesActual(data[data.length-1]['MESPRO']) + " " + data[data.length-1]['ANOPRO']+'</span></div>',
                  align: 'left',
                  y: 35 
              },
                yAxis: {
                    title: {
                        text: ' '
                    }},
                    xAxis: {
                      categories: labelMeses,
                      accessibility: {
                          rangeDescription: ' '
                      }
                  }, 
                legend: {
                  enabled:false
                },
                credits: {
                  enabled: false},
                series: [{
                    name: 'Clientes nuevos',
                    data: histClientesNuevos
                }, {
                    name: 'Clientes viejos',
                    data: histClientesViejos,
                    type: 'areaspline',  
                    fillColor: 'rgba(0,0,0,.1)'
                }],
            
            });
            
            Highcharts.chart('container8', {
              chart: {
                type: 'spline' 
            },
            lang: {
              viewFullscreen: "Ver en pantalla completa",
              exitFullscreen: "Salir de pantalla completa",
              downloadJPEG: "Descargar imagen JPEG",
              downloadPDF: "Descargar en PDF",
            },
            exporting: {
              buttons: {
                  contextButton: {
                      menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
                  }
              },
              enabled: true,
              filename: 'Total contactos - '+tiendaSelected+'',
              sourceWidth: 1600,
              sourceHeight: 800,
            },
              title: {
                  text: '<h2 class="fs-4">Historial total de contactos - '+tiendaSelected+'</h2>',
                  align: 'left',
                  y: 10 
              },
              subtitle: {
                text: '<div class="fs-6"><span>'+obtenerNombreMesActual(data[0]['MESPRO']) + " " + data[0]['ANOPRO']+' - '+obtenerNombreMesActual(data[data.length-1]['MESPRO']) + " " + data[data.length-1]['ANOPRO']+'</span></div>',
                align: 'left',
                y: 35 
            },
              yAxis: {
                  title: {
                      text: ' '
                  }},
                  xAxis: {
                    categories: labelMeses,
                    accessibility: {
                        rangeDescription: ' '
                    }
                }, 
              legend: {
                enabled:true
              },
              credits: {
                enabled: false},
              series: [{
                  name: 'Telefonos',
                  data: histTelefono,
                  type: 'areaspline',  
                  fillColor: 'rgba(0,0,0,.1)'
              }, {
                  name: 'Correos electronicos',
                  data: histEmail,
              }],
            });
          
            

Highcharts.chart('container9', {
  chart: {
    type: 'column' 
},
lang: {
  viewFullscreen: "Ver en pantalla completa",
  exitFullscreen: "Salir de pantalla completa",
  downloadJPEG: "Descargar imagen JPEG",
  downloadPDF: "Descargar en PDF",
},
exporting: {
  buttons: {
      contextButton: {
          menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
      }
  },
  enabled: true,
  filename: 'Total transacciones - '+tiendaSelected+'',
  sourceWidth: 1600,
  sourceHeight: 800,
},
  title: {
      text: '<h2 class="fs-4">Historial total de transacciones - '+tiendaSelected+'</h2>',
      align: 'left',
      y: 10 
  },
  subtitle: {
    text: '<div class="fs-6"><span>'+obtenerNombreMesActual(data[0]['MESPRO']) + " " + data[0]['ANOPRO']+' - '+obtenerNombreMesActual(data[data.length-1]['MESPRO']) + " " + data[data.length-1]['ANOPRO']+'</span></div>',
    align: 'left',
    y: 35 
},
  yAxis: {
      title: {
          text: ' '
      }},
      xAxis: {
        categories: labelMeses,
        accessibility: {
            rangeDescription: ' '
        }
    }, 
  legend: {
    enabled:true
  },
  credits: {
    enabled: false},
  series: [{
      name: 'Transacciones',
      data: histTrans,
  },],
});
  

  
}