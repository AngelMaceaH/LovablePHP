<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
  <link rel="stylesheet" href="../../assets/css/vendors/highcharts.css">
  <style>
  .bg-secondary2 {
    background-color: #E7E7E7 !important;
  }

  .bg-secondary3 {
    background-color: rgba(0, 0, 0, 0.3) !important;
  }
  </style>
</head>

<body>
  <?php
      include '../layout-prg.php';
  ?>
  <div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item">
          <span>Módulo de facturación / Consultas</span>
        </li>
        <li class="breadcrumb-item active"><span>ZLO0036P</span></li>
      </ol>
    </nav>
  </div>
  </header>
  <div id="body-div" class="body flex-grow-3">
    <div class="card mb-5">
      <div class="card-header">
        <h1 class="fs-4 mb-1 mt-2 text-center">Comparativo de ventas por rango de fechas</h1>
      </div>
      <div class="card-body" id="body-page">
        <div class="container">
          <div class="row">
            <div class="col-sm-12 col-lg-6 mt-2">
              <label>Rango de fecha 1</label>
              <div class="input-group mt-1">
                <input class="form-control" id="datepicker1" name="datepicker1" />
                <span class="input-group-text" id="basic-addon2"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                    height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                    <path
                      d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                  </svg></span>
              </div>
            </div>
            <div class="col-sm-12 col-lg-6 mt-2">
              <label>Rango de fecha 2</label>
              <div class="input-group mt-1">
                <input class="form-control" id="datepicker2" name="datepicker2" />
                <span class="input-group-text" id="basic-addon2"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                    height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                    <path
                      d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                  </svg></span>
              </div>
            </div>
            <div class="col-12">
              <div class="btn-group mt-3 d-flex justify-content-center justify-content-md-start" role="group"
                aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off">
                <label class="btn btn-outline-secondary responsive-font-example pt-3 pb-3" for="btnradio1">
                  <b>Unidades</b>
                </label>

                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                <label class="btn btn-outline-secondary responsive-font-example pt-3 pb-3" for="btnradio2">
                  <b>Transacciones</b>
                </label>

                <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                <label class="btn btn-outline-secondary responsive-font-example pt-3 pb-3" for="btnradio3">
                  <b>Valores Dólarizados</b>
                </label>

                <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off">
                <label class="btn btn-outline-secondary responsive-font-example pt-3 pb-3" for="btnradio4">
                  <b>Moneda Nacional</b>
                </label>
              </div>
            </div>
            <div class="col-12">
              <label class=" mt-3">Visualizar por:</label>
              <select class="form-select  mt-1" id="cbbPais" name="cbbPais">

              </select>
            </div>
            <!--<div class="col-12">
              <div class="form-check mt-3 mb-2 me-3">
                <input class="form-check-input" type="checkbox" value="" id="isOtros">
                <label class="form-check-label" for="isOtros">
                  Incluir otros recibidos
                </label>
              </div>
            </div>-->
          </div>
        </div>
        <div class="row">
          <div class="col-12 mt-3">
            <div id="carouselExample" class="carousel slide">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <figure class="highcharts-figure">
                    <div id="container" class="highcharts-dark text-white Math.rounded"
                      style="height:500px !important;">
                    </div>
                  </figure>
                </div>
                <div class="carousel-item">
                  <figure class="highcharts-figure">
                    <div id="container2" class="highcharts-dark text-white Math.rounded"
                      style="height:500px !important;">
                    </div>
                  </figure>
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>

          </div>
          <div class="col-12 mt-1">
            <div class="table-responsive">
              <table id="table-data" class="table stripe table-hover mt-2 fw-bold text-black" style="width:100%">
                <thead>
                  <tr>
                    <th scope="col">Punto de venta</th>
                    <th scope="col" class="text-end">Moneda</th>
                    <th scope="col" class="text-end"><span class="textSpan"></span> Rango 1</th>
                    <th scope="col" class="text-end"><span class="textSpan"></span> Rango 2</th>
                    <th scope="col" class="text-end">Diferencia</th>
                    <th scope="col" class="text-end">% Crecimiento</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                  <tr>
                    <th>TOTALES</th>
                    <th></th>
                    <th class="text-end"></th>
                    <th class="text-end"></th>
                    <th class="text-end"></th>
                    <th class="text-end"></th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
      </div>
    </div>
  </div>
  </div>

  </div>
  <div class="footer bg-blck flex-grow-1 d-flex justify-content-center">
    <p class="bggray responsive-font-example"><i>Lovable de Honduras S.A. de C.V</i></p>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendors/dayrangepicker/index.umd.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/offline-exporting.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>
  <script>
  let table = null;
  let urlTable = "";
  const usuario = '<?php echo $_SESSION["CODUSU"];?>';
  let chart1 = null;
  let chart2 = null;
  let labelsData = [];
  let data1 = [];
  let data2 = [];
  let data3 = [];
  let data4 = [];
  let cias = 0;
  $(document).ready(() => {
    const buttons = document.querySelectorAll('.btn-check');
    buttons.forEach(button => {
      button.addEventListener('click', () => {
        buttons.forEach(otherButton => {
          if (otherButton !== button) {
            otherButton.checked = false;
          }
        });
        setCookie("tabSelected-range", button.id, 1);
        sendForm();
      });
    });
    const tabSelected = getCookie("tabSelected-range");
    let tab = 3;
    if (tabSelected) {
      $(`#${tabSelected}`).prop("checked", true);
      tab = tabSelected.replace('btnradio', '');
    } else {
      $("#btnradio3").prop("checked", true);
    }
    let d1ini = getCookie("d1ini");
    let d1fin = getCookie("d1fin");
    let d2ini = getCookie("d2ini");
    let d2fin = getCookie("d2fin");
    let currentDate = new Date();
    let currentDateString = currentDate.toISOString().split('T')[0];
    let pastYearDate = new Date();
    pastYearDate.setFullYear(currentDate.getFullYear() - 1);
    let pastYearDateString = pastYearDate.toISOString().split('T')[0];

    if (!d1ini || !d1fin) {
      d1ini = pastYearDateString.replace(/-/g, '').slice(0, -2) + "01";
      d1fin = pastYearDateString.replace(/-/g, '');
    }

    if (!d2ini || !d2fin) {
      d2ini = currentDateString.replace(/-/g, '').slice(0, -2) + "01";
      d2fin = currentDateString.replace(/-/g, '');
    }
    Date1 = formatFecha(d1ini);
    Date2 = formatFecha(d1fin);
    const picker1 = new easepick.create({
      element: "#datepicker1",
      css: ["../../assets/vendors/dayrangepicker/index.css"],
      zIndex: 10,
      plugins: ["RangePlugin"]
    });
    Date1 = formatFecha(d2ini);
    Date2 = formatFecha(d2fin);
    const picker2 = new easepick.create({
      element: "#datepicker2",
      css: ["../../assets/vendors/dayrangepicker/index.css"],
      zIndex: 10,
      plugins: ["RangePlugin"]
    });
    let optgroups = ``;
    let usuario = '<?php echo $_SESSION["CODUSU"];?>';
    const urlVal = "http://172.16.15.20/API.LovablePHP/Users/FindAgrupP/?codusu=" + usuario + "";
    fetch(urlVal).then(response => response.json()).then(data => {
      if (data.code == 200) {
        optgroups += `<optgroup><option class="fw-bold" value="0" disabled>País</option>`;
        const dataResponse = data.data;
        let count = 0;
        if (dataResponse.length > 0) {
          dataResponse.forEach(element => {
            if (element.DESCRI.includes("honduras")) {
              count++;
              optgroups += `<option value="1">Honduras (Lov. Ecommerce)</option>
                                                    <option value="2">Honduras (Mod. Íntima)</option>`;
            } else if (element.DESCRI.includes("guatemala")) {
              count++;
              optgroups += '<option value="3">Guatemala</option>';
            } else if (element.DESCRI.includes("salvador")) {
              count++;
              optgroups += '<option value="4">El Salvador</option>';
            } else if (element.DESCRI.includes("costa rica")) {
              count++;
              optgroups += '<option value="5">Costa Rica</option>';
            } else if (element.DESCRI.includes("nicaragua")) {
              count++;
              optgroups += '<option value="6">Nicaragua</option>';
            } else if (element.DESCRI.includes("republica dominicana")) {
              count++;
              optgroups += '<option value="7">Republica Dominicana</option>';
            }
          });
          optgroups += `</optgroup>`;
        }
        if (count == 6) {
          optgroups += `<optgroup>
                            <option class="fw-bold" value="ALL">Mostrar todos</option>
                            </optgroup>
                            <optgroup>
                                        <option class="fw-bold" value="0" disabled>Fabrica</option>
                                        <option class="fw-bold" value="9">Lovable Honduras</option>
                                    </optgroup>`;
          cias = 1;
        }
        $("#cbbPais").append(optgroups);
        cias = getCookie("paises");
        if (!cias) {
          if (count == 6) {
            cias = 1;
          } else {
            let optioncia = dataResponse[0].CODIGO;
            switch (optioncia) {
              case '10':
                cias = 3;
                break;
              case '11':
                cias = 1;
                break;
              case '12':
                cias = 4;
                break;
              case '13':
                cias = 5;
                break;
              case '15':
                cias = 7;
                break;
              case '16':
                cias = 6;
                break;
              default:
                cias = 1;
                break;
            }
          }
        }

        $("#cbbPais").val(cias);
        if (data.acceso == 0) {
          $("#body-page").empty();
          $("#body-page").append(
            '<div class="text-center p-5 fs-3 m-5" style="height:600px;"><div class="border border-1 rounded p-5 m-5"><i class="fa-solid fa-question fa-fade fa-2xl mb-4"></i><br /> No hay contenido para mostrar.</div></div>'
          );
        }
        $("#cbbPais").change(function() {
          sendForm();
        });
      }
      chargeTable(d1ini, d1fin, d2ini, d2fin, usuario, tab);
    });
  });

  function chargeTable(d1ini, d1fin, d2ini, d2fin, usuario, option) {
    let endpoint = "";
    switch (option) {
      case "1":
        endpoint = "ListUnidades"
        $(".textSpan").text("Unidades");
        break;
      case "2":
        $(".textSpan").text("Transacciones");
        endpoint = "ListTransacciones"
        break;
      default:
        endpoint = "List"
        $(".textSpan").text("Ventas");
        break;
    }
    cias = $("#cbbPais").val();
    urlTable =
      `/API.LovablePHP/ZLO0035P/${endpoint}/?d1ini=${d1ini}&d1fin=${d1fin}&d2ini=${d2ini}&d2fin=${d2fin}&usuario=${usuario}&case=${option}&cia=${cias}`;
    console.log(urlTable);
      const columns = [{
        "data": "COMDES"
      },
      {
        "data": "MON",
        "class": "text-end",
        "visible": option !== "1" && option !== "2"
      },
      {
        "data": "R1",
        "class": "text-end",
        "render": function(data, type, row) {
          var formattedData;
          if (option === "1" || option === "2") {
            formattedData = parseFloat(data).toLocaleString('es-419', {
              minimumFractionDigits: 0,
              maximumFractionDigits: 0
            });
          } else {
            formattedData = parseFloat(data).toLocaleString('es-419', {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2
            });
          }
          var className = data === 0 ? 'text-danger' : 'text-darkblue';
          return '<span class="' + className + '">' + formattedData + '</span>';
        }
      },
      {
        "data": "R2",
        "class": "text-end",
        "render": function(data, type, row) {
          var formattedData;
          if (option === "1" || option === "2") {
            formattedData = parseFloat(data).toLocaleString('es-419', {
              minimumFractionDigits: 0,
              maximumFractionDigits: 0
            });
          } else {
            formattedData = parseFloat(data).toLocaleString('es-419', {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2
            });
          }
          var className = data === 0 ? 'text-danger' : 'text-pink';
          return '<span class="' + className + '">' + formattedData + '</span>';
        }
      },
      {
        "data": null,
        "class": "text-end",
        "render": function(data, type, row) {
          var difference = row.R2 - row.R1;
          var formattedDifference;
          if (option === "1" || option === "2") {
            formattedDifference = parseFloat(difference).toLocaleString('es-419', {
              minimumFractionDigits: 0,
              maximumFractionDigits: 0
            });
          } else {
            formattedDifference = parseFloat(difference).toLocaleString('es-419', {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2
            });
          }
          var className = parseFloat(difference) <= 0 ? 'text-danger' : 'text-success';
          return '<span class="' + className + '">' + formattedDifference + '</span>';
        }
      },
      {
        "data": null,
        "class": "text-end",
        "render": function(data, type, row) {
          var growthPercentage = 0;
          if (row.R1 !== 0) {
            growthPercentage = ((row.R2 / row.R1) - 1) * 100;
          }
          var formattedGrowth = growthPercentage.toLocaleString('es-419', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
          });
          var className = growthPercentage <= 0 ? 'text-danger' : 'text-success';
          return '<span class="' + className + '">' + formattedGrowth + '</span>';
        }
      }
    ];

    table = $("#table-data").DataTable({
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
      },
      "ordering": false,
      "processing": true,
      "pageLength": 100,
      "ajax": {
        "url": urlTable,
        "type": "POST",
        "dataSrc": function(json) {
          if (json.data) {
            return json.data;
          } else {
            console.error(json);
            return [];
          }
        },
      },
      columns: columns,
      dom: 'Bfrtip',
      buttons: [{
        extend: 'excelHtml5',
        text: '<i class="fa-solid fa-file-excel"></i> <b>Enviar a Excel</b>',
        className: "btn btn-success text-light mt-2 fs-6",
        title: 'ReporteVentas',
        messageTop: ' ',
        exportOptions: {
          columns: (option == 1 || option == 2) ? [0, 2, 3, 4, 5] : [0, 1, 2, 3, 4, 5]
        },
        customize: function(xlsx) {
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

          var n1 = '<numFmt formatCode="##0%" numFmtId="300"/>';
          var n2 = '<numFmt formatCode="#,##0.00" numFmtId="200" />';
          var s1 =
            '<xf numFmtId="300" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>';
          var s2 =
            '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
            '<alignment horizontal="center"/></xf>';
          var s3 =
            '<xf numFmtId="4" fontId="2" fillId="0" borderId="0" applyFont="1" applyFill="1" xfId="0" applyNumberFormat="1"/>'
          var s4 =
            '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" xfId="0" applyAlignment="1">' +
            '<alignment horizontal="center" wrapText="1"/></xf>'
          var s5 = '<xf numFmtId="200" fontId="' + (lastFontIndex + 1) +
            '" fillId="0" borderId="0" applyFont="1" applyFill="1" xfId="0" applyAlignment="1">' +
            '<alignment horizontal="right"/></xf>';
          var s6 = '<xf numFmtId="200" fontId="' + (lastFontIndex + 2) +
            '" fillId="0" borderId="0" applyFont="1" applyFill="1" xfId="0" applyAlignment="1">' +
            '<alignment horizontal="right"/></xf>';
          var s7 = '<xf numFmtId="300" fontId="' + (lastFontIndex + 1) +
            '" fillId="0" borderId="0" applyFont="1" applyFill="1" xfId="0" applyAlignment="1">' +
            '<alignment horizontal="right"/></xf>';
          var s8 = '<xf numFmtId="300" fontId="' + (lastFontIndex + 2) +
            '" fillId="0" borderId="0" applyFont="1" applyFill="1" xfId="0" applyAlignment="1">' +
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

          let titleText = "";
          switch (option) {
            case "1":
              titleText = "(UNIDADES)";
              break;
            case "2":
              titleText = "(TRANSACCIONES)";
              break;
            case "3":
              titleText = "(DOLARES)";
              break;
            case "4":
              titleText = "(MONEDA NACIONAL)";
              break;
          }
          $('c[r=A1] t', sheet).text(`REPORTE DE VENTAS RESUMIDAS POR COMPAÑÍA ${titleText}`);
          $('row:eq(0) c', sheet).attr('s', greyBoldCentered);
          $('row:eq(1) c', sheet).attr('s', 7);

          for (let index = 3; index <= 100; index++) {

            $('row:eq(' + index + ') c[r^="B"]', sheet).attr('s', 52);
            $('row:eq(' + index + ') c[r^="C"]', sheet).attr('s', 52);
            $('row:eq(' + index + ') c[r^="D"]', sheet).attr('s', 52);
            $('row:eq(' + index + ') c[r^="E"]', sheet).attr('s', 52);
            $('row:eq(' + index + ') c[r^="F"]', sheet).attr('s', 52);
            $('row:eq(' + index + ') c[r^="G"]', sheet).attr('s', 52);
            $('row:eq(' + index + ') c[r^="H"]', sheet).attr('s', 52);
            $('row:eq(' + index + ') c[r^="I"]', sheet).attr('s', 52);
            $('row:eq(' + index + ') c[r^="J"]', sheet).attr('s', 52);
            $('row:eq(' + index + ') c[r^="K"]', sheet).attr('s', 52);
            $('row:eq(' + index + ') c[r^="L"]', sheet).attr('s', 52);
            $('row:eq(' + index + ') c[r^="M"]', sheet).attr('s', 52);

            if (parseFloat($('row:eq(' + index + ') c[r^="E"]', sheet).text()) < 0) {
              $('row:eq(' + index + ') c[r^="E"]', sheet).attr('s', textred1); //ROJO
            } else {
              $('row:eq(' + index + ') c[r^="E"]', sheet).attr('s', textgreen1); //VERDE
            }
            if (parseFloat($('row:eq(' + index + ') c[r^="F"]', sheet).text()) < 0) {
              $('row:eq(' + index + ') c[r^="F"]', sheet).attr('s', textred1); //ROJO
            } else {
              $('row:eq(' + index + ') c[r^="F"]', sheet).attr('s', textgreen1); //VERDE
            }
          }

          for (let index = 2; index <= 100; index++) {
            $('row:eq(' + index + ') c[r^="A"]', sheet).attr('s', 7);
          }

          var tagName = sSh.getElementsByTagName('sz');
          for (i = 0; i < tagName.length; i++) {
            tagName[i].setAttribute("val", "13");
          }
        }
      }],
      createdRow: function(row, data, dataIndex) {
        if (data.VENDEDOR === '1' || data.VENDEDOR === '2') {
          $(row).addClass('bg-secondary2');
        }
      },
      footerCallback: function(row, data, start, end, display) {
          setTimeout(() => {
            var api = this.api();
              var intVal = function(i) {
                return typeof i === 'string' ?
                  i.replace(/[\$,]/g, '') * 1 :
                  typeof i === 'number' ?
                  i : 0;
              };
              var filteredData = data.filter(function(d, i) {
                var rowNode = api.row(i).node();
                return d.VENDEDOR === '0' && !$(rowNode).hasClass('bg-secondary2');
              });

              var total1 = filteredData
                .map(function(d) {
                  return intVal(d.R1);
                })
                .reduce(function(a, b) {
                  return a + b;
                }, 0);
              var total2 = filteredData
                .map(function(d) {
                  return intVal(d.R2);
                })
                .reduce(function(a, b) {
                  return a + b;
                }, 0);
              $(api.column(1).footer()).html('D');
              $(api.column(2).footer()).html(parseFloat(total1).toLocaleString('es-419', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
              }));
              $(api.column(3).footer()).html(parseFloat(total2).toLocaleString('es-419', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
              }));
              const difference = total2 - total1;
              const growthPercentage = (isNaN(((total2 / total1) - 1) * 100))? 0:((total2 / total1) - 1) * 100;
              $(api.column(4).footer()).html(parseFloat(difference).toLocaleString('es-419', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
              }));
              if (parseInt(difference) >= 0) {
                $(api.column(4).footer()).removeClass('text-danger');
                $(api.column(4).footer()).addClass('text-success');
              } else {
                $(api.column(4).footer()).removeClass('text-success');
                $(api.column(4).footer()).addClass('text-danger');
              }
              $(api.column(5).footer()).html(parseFloat(growthPercentage).toLocaleString('es-419', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
              }));
              if (parseInt(growthPercentage) >= 0) {
                $(api.column(5).footer()).removeClass('text-danger');
                $(api.column(5).footer()).addClass('text-success');
              } else {
                $(api.column(5).footer()).removeClass('text-success');
                $(api.column(5).footer()).addClass('text-danger');
              }
              $('#table-data tfoot').addClass('bg-secondary3 text-white');
              $('#table-data tfoot').removeClass('d-none');

          }, 500);
      }

    });
    chargeChart(d1ini, d1fin, d2ini, d2fin, usuario, option)
  }

  function rechargeTable(d1ini, d1fin, d2ini, d2fin, usuario, option) {
    let endpoint = "";
    switch (option) {
      case "1":
        endpoint = "ListUnidades";
        $(".textSpan").text("Unidades");
        break;
      case "2":
        $(".textSpan").text("Transacciones");
        endpoint = "ListTransacciones";
        break;
      default:
        endpoint = "List";
        $(".textSpan").text("Ventas");
        break;
    }
    cias = $("#cbbPais").val();
    let urlTable =
      `/API.LovablePHP/ZLO0035P/${endpoint}/?d1ini=${d1ini}&d1fin=${d1fin}&d2ini=${d2ini}&d2fin=${d2fin}&usuario=${usuario}&case=${option}&cia=${cias}`;

    const columns = [{
        "data": "COMDES"
      },
      {
        "data": "MON",
        "class": "text-end",
        "visible": option !== "1" && option !== "2"
      },
      {
        "data": "R1",
        "class": "text-end",
        "render": function(data, type, row) {
          var formattedData;
          if (option === "1" || option === "2") {
            formattedData = parseFloat(data).toLocaleString('es-419', {
              minimumFractionDigits: 0,
              maximumFractionDigits: 0
            });
          } else {
            formattedData = parseFloat(data).toLocaleString('es-419', {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2
            });
          }
          var className = data === 0 ? 'text-danger' : 'text-darkblue';
          return '<span class="' + className + '">' + formattedData + '</span>';
        }
      },
      {
        "data": "R2",
        "class": "text-end",
        "render": function(data, type, row) {
          var formattedData;
          if (option === "1" || option === "2") {
            formattedData = parseFloat(data).toLocaleString('es-419', {
              minimumFractionDigits: 0,
              maximumFractionDigits: 0
            });
          } else {
            formattedData = parseFloat(data).toLocaleString('es-419', {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2
            });
          }
          var className = data === 0 ? 'text-danger' : 'text-pink';
          return '<span class="' + className + '">' + formattedData + '</span>';
        }
      },
      {
        "data": null,
        "class": "text-end",
        "render": function(data, type, row) {
          var difference = row.R2 - row.R1;
          var formattedDifference;
          if (option === "1" || option === "2") {
            formattedDifference = parseFloat(difference).toLocaleString('es-419', {
              minimumFractionDigits: 0,
              maximumFractionDigits: 0
            });
          } else {
            formattedDifference = parseFloat(difference).toLocaleString('es-419', {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2
            });
          }
          var className = parseFloat(difference) <= 0 ? 'text-danger' : 'text-success';
          return '<span class="' + className + '">' + formattedDifference + '</span>';
        }
      },
      {
        "data": null,
        "class": "text-end",
        "render": function(data, type, row) {
          var growthPercentage = 0;
          if (row.R1 !== 0) {
            growthPercentage = ((row.R2 / row.R1) - 1) * 100;
          }
          var formattedGrowth = growthPercentage.toLocaleString('es-419', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
          });
          var className = growthPercentage <= 0 ? 'text-danger' : 'text-success';
          return '<span class="' + className + '">' + formattedGrowth + '</span>';
        }
      }
    ];

    // Destroy the existing table
    if ($.fn.DataTable.isDataTable('#table-data')) {
      $('#table-data').DataTable().clear().destroy();
    }

    // Initialize the table again with new settings
    table = $('#table-data').DataTable({
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
      },
      ordering: false,
      processing: true,
      pageLength: 100,
      ajax: {
        url: urlTable,
        type: "POST",
        dataSrc: function(json) {
          if (json.data) {
            return json.data;
          } else {
            console.error(json);
            return [];
          }
        }
      },
      columns: columns,
      dom: 'Bfrtip',
      buttons: [{
        extend: 'excelHtml5',
        text: '<i class="fa-solid fa-file-excel"></i> <b>Enviar a Excel</b>',
        className: "btn btn-success text-light mt-2 fs-6",
        title: 'ReporteVentas',
        messageTop: ' ',
        exportOptions: {
          columns: (option == 1 || option == 2) ? [0, 2, 3, 4, 5] : [0, 1, 2, 3, 4, 5]
        },
        customize: function(xlsx) {
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

          var n1 = '<numFmt formatCode="##0%" numFmtId="300"/>';
          var n2 = '<numFmt formatCode="#,##0.00" numFmtId="200" />';
          var s1 =
            '<xf numFmtId="300" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>';
          var s2 =
            '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
            '<alignment horizontal="center"/></xf>';
          var s3 =
            '<xf numFmtId="4" fontId="2" fillId="0" borderId="0" applyFont="1" applyFill="1" xfId="0" applyNumberFormat="1"/>'
          var s4 =
            '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" xfId="0" applyAlignment="1">' +
            '<alignment horizontal="center" wrapText="1"/></xf>'
          var s5 = '<xf numFmtId="200" fontId="' + (lastFontIndex + 1) +
            '" fillId="0" borderId="0" applyFont="1" applyFill="1" xfId="0" applyAlignment="1">' +
            '<alignment horizontal="right"/></xf>';
          var s6 = '<xf numFmtId="200" fontId="' + (lastFontIndex + 2) +
            '" fillId="0" borderId="0" applyFont="1" applyFill="1" xfId="0" applyAlignment="1">' +
            '<alignment horizontal="right"/></xf>';
          var s7 = '<xf numFmtId="300" fontId="' + (lastFontIndex + 1) +
            '" fillId="0" borderId="0" applyFont="1" applyFill="1" xfId="0" applyAlignment="1">' +
            '<alignment horizontal="right"/></xf>';
          var s8 = '<xf numFmtId="300" fontId="' + (lastFontIndex + 2) +
            '" fillId="0" borderId="0" applyFont="1" applyFill="1" xfId="0" applyAlignment="1">' +
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

          let titleText = "";
          switch (option) {
            case "1":
              titleText = "(UNIDADES)";
              break;
            case "2":
              titleText = "(TRANSACCIONES)";
              break;
            case "3":
              titleText = "(DOLARES)";
              break;
            case "4":
              titleText = "(MONEDA NACIONAL)";
              break;
          }
          $('c[r=A1] t', sheet).text(`REPORTE DE VENTAS RESUMIDAS POR COMPAÑÍA ${titleText}`);
          $('row:eq(0) c', sheet).attr('s', greyBoldCentered);
          $('row:eq(1) c', sheet).attr('s', 7);

          for (let index = 3; index <= 100; index++) {

            $('row:eq(' + index + ') c[r^="B"]', sheet).attr('s', 52);
            $('row:eq(' + index + ') c[r^="C"]', sheet).attr('s', 52);
            $('row:eq(' + index + ') c[r^="D"]', sheet).attr('s', 52);
            $('row:eq(' + index + ') c[r^="E"]', sheet).attr('s', 52);
            $('row:eq(' + index + ') c[r^="F"]', sheet).attr('s', 52);
            $('row:eq(' + index + ') c[r^="G"]', sheet).attr('s', 52);
            $('row:eq(' + index + ') c[r^="H"]', sheet).attr('s', 52);
            $('row:eq(' + index + ') c[r^="I"]', sheet).attr('s', 52);
            $('row:eq(' + index + ') c[r^="J"]', sheet).attr('s', 52);
            $('row:eq(' + index + ') c[r^="K"]', sheet).attr('s', 52);
            $('row:eq(' + index + ') c[r^="L"]', sheet).attr('s', 52);
            $('row:eq(' + index + ') c[r^="M"]', sheet).attr('s', 52);

            if (parseFloat($('row:eq(' + index + ') c[r^="E"]', sheet).text()) < 0) {
              $('row:eq(' + index + ') c[r^="E"]', sheet).attr('s', textred1); //ROJO
            } else {
              $('row:eq(' + index + ') c[r^="E"]', sheet).attr('s', textgreen1); //VERDE
            }
            if (parseFloat($('row:eq(' + index + ') c[r^="F"]', sheet).text()) < 0) {
              $('row:eq(' + index + ') c[r^="F"]', sheet).attr('s', textred1); //ROJO
            } else {
              $('row:eq(' + index + ') c[r^="F"]', sheet).attr('s', textgreen1); //VERDE
            }
          }

          for (let index = 2; index <= 100; index++) {
            $('row:eq(' + index + ') c[r^="A"]', sheet).attr('s', 7);
          }

          var tagName = sSh.getElementsByTagName('sz');
          for (i = 0; i < tagName.length; i++) {
            tagName[i].setAttribute("val", "13");
          }
        }
      }],
      createdRow: function(row, data, dataIndex) {
        if (data.VENDEDOR === '1' || data.VENDEDOR === '2') {
          $(row).addClass('bg-secondary2');
        }
      },
      footerCallback: function(row, data, start, end, display) {
          setTimeout(() => {
            /*if (option == '3') {

            } else {
              $('#table-data tfoot').addClass('d-none');
            }*/
            var api = this.api();
              var intVal = function(i) {
                return typeof i === 'string' ?
                  i.replace(/[\$,]/g, '') * 1 :
                  typeof i === 'number' ?
                  i : 0;
              };
              var filteredData = data.filter(function(d, i) {
                var rowNode = api.row(i).node();
                return d.VENDEDOR === '0' && !$(rowNode).hasClass('bg-secondary2');
              });

              var total1 = filteredData
                .map(function(d) {
                  return intVal(d.R1);
                })
                .reduce(function(a, b) {
                  return a + b;
                }, 0);
              var total2 = filteredData
                .map(function(d) {
                  return intVal(d.R2);
                })
                .reduce(function(a, b) {
                  return a + b;
                }, 0);
              $(api.column(1).footer()).html('D');
              $(api.column(2).footer()).html(parseFloat(total1).toLocaleString('es-419', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
              }));
              $(api.column(3).footer()).html(parseFloat(total2).toLocaleString('es-419', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
              }));
              const difference = total2 - total1;
              const growthPercentage = (isNaN(((total2 / total1) - 1) * 100))? 0:((total2 / total1) - 1) * 100;
              $(api.column(4).footer()).html(parseFloat(difference).toLocaleString('es-419', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
              }));
              if (parseInt(difference) >= 0) {
                $(api.column(4).footer()).removeClass('text-danger');
                $(api.column(4).footer()).addClass('text-success');
              } else {
                $(api.column(4).footer()).removeClass('text-success');
                $(api.column(4).footer()).addClass('text-danger');
              }
              $(api.column(5).footer()).html(parseFloat(growthPercentage).toLocaleString('es-419', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
              }));
              if (parseInt(growthPercentage) >= 0) {
                $(api.column(5).footer()).removeClass('text-danger');
                $(api.column(5).footer()).addClass('text-success');
              } else {
                $(api.column(5).footer()).removeClass('text-success');
                $(api.column(5).footer()).addClass('text-danger');
              }
              $('#table-data tfoot').addClass('bg-secondary3 text-white');
              $('#table-data tfoot').removeClass('d-none');
          }, 500);
      }
    });
    chargeChart(d1ini, d1fin, d2ini, d2fin, usuario, option)


  }

  function sendForm() {
    const rangeDocumento = $('#datepicker1').val();
    const rangeDocumento2 = $('#datepicker2').val();
    const d1ini = rangeDocumento.split(' - ')[0].split('/').reverse().join('');
    const d1fin = rangeDocumento.split(' - ')[1].split('/').reverse().join('');
    const d2ini = rangeDocumento2.split(' - ')[0].split('/').reverse().join('');
    const d2fin = rangeDocumento2.split(' - ')[1].split('/').reverse().join('');
    setCookie("d1ini", d1ini, 1);
    setCookie("d1fin", d1fin, 1);
    setCookie("d2ini", d2ini, 1);
    setCookie("d2fin", d2fin, 1);
    setCookie("paises", $("#cbbPais").val(), 1);
    const option = document.querySelector('input[name="btnradio"]:checked').id;
    rechargeTable(d1ini, d1fin, d2ini, d2fin, usuario, option.replace('btnradio', ''));
  }

  function formatFecha(inputDate) {
    var year = inputDate.substring(0, 4);
    var month = inputDate.substring(4, 6);
    var day = inputDate.substring(6, 8);
    var formattedDate = day + "-" + month + "-" + year;
    return formattedDate;
  }

  function chargeChart(d1ini, d1fin, d2ini, d2fin, usuario, option) {
    let endpoint = "";
    switch (option) {
      case "1":
        endpoint = "ListUnidades"
        $(".textSpan").text("Unidades");
        break;
      case "2":
        $(".textSpan").text("Transacciones");
        endpoint = "ListTransacciones"
        break;
      default:
        endpoint = "List"
        $(".textSpan").text("Ventas");
        break;
    }
    cias = $("#cbbPais").val();
    urlTable =
      `/API.LovablePHP/ZLO0035P/${endpoint}/?d1ini=${d1ini}&d1fin=${d1fin}&d2ini=${d2ini}&d2fin=${d2fin}&usuario=${usuario}&case=${option}&cia=${cias}`;
    fetch(urlTable)
      .then(response => response.json())
      .then(data => {
        if (data.code == 200) {
          labelsData = [];
          data1 = [];
          data2 = [];
          data3 = [];
          data4 = [];

          if (data && Array.isArray(data.data)) {
            data.data.forEach(element => {
              if (element.VENDEDOR === '0' && element.ID !== '1') {
                labelsData.push(element.COMDES);
                data1.push(parseFloat(element.R1));
                data2.push(parseFloat(element.R2));

                if (parseFloat(element.R1) !== 0) {
                  data3.push((((parseFloat(element.R2) / parseFloat(element.R1)) - 1) * 100).toFixed(2));
                } else {
                  data3.push(0);
                }
              } else {
                if (cias == 9) {
                  if (element.VENDEDOR === '0' && element.ID === '1') {
                    labelsData.push(element.COMDES);
                    data1.push(parseFloat(element.R1));
                    data2.push(parseFloat(element.R2));

                    if (parseFloat(element.R1) !== 0) {
                      data3.push((((parseFloat(element.R2) / parseFloat(element.R1)) - 1) * 100).toFixed(2));
                    } else {
                      data3.push(0);
                    }
                  }
                }
              }
            });
          } else {
            console.error("Data is either null or not an array");
          }
          data3.forEach((value) => {
            data4.push(parseFloat(value));
          });

          chart1 = Highcharts.chart('container', {
            chart: {
              type: 'column',
              style: {
                color: '#FFFFFF'
              },
              events: {
                load: function() {
                  // Usar setTimeout para esperar a que los elementos SVG del botón de exportación estén disponibles
                  setTimeout(() => {
                    const exportButton = this.exportSVGElements[0].element;
                    exportButton.setAttribute('transform', 'translate(1515, 10)');
                    exportButton.classList.add('custom-export-button');
                  }, 0);
                }
              }
            },
            lang: {
              viewFullscreen: "Ver en pantalla completa",
              exitFullscreen: "Salir de pantalla completa",
              downloadJPEG: "Descargar imagen JPEG",
              downloadPDF: "Descargar en PDF",
            },
            title: {
              text: 'Comparativo de ventas por rango de fechas',
              align: 'center',
              style: {
                color: '#FFFFFF'
              }
            },
            xAxis: {
              categories: labelsData,
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
                  menuItems: ["viewFullscreen", "separator", "downloadJPEG",
                    "downloadPDF"
                  ]
                }
              },
              enabled: true,
              sourceWidth: 1600,
              sourceHeight: 700,
              chartOptions: {
                chart: {
                  backgroundColor: '#303030'
                }
              },
              fallbackToExportServer: false
            },
            tooltip: {
              style: {
                color: '#FFFFFF'
              }
            },
            series: [{
                name: 'Rango 1',
                data: data1,
                color: '#005CBD'
              },
              {
                name: 'Rango 2',
                data: data2,
                color: '#F2ACBF'
              }
            ]
          });
          chart2 = Highcharts.chart('container2', {
            chart: {
              type: 'line',
              height: 500,
              style: {
                color: '#FFFFFF'
              },
              events: {
                load: function() {
                  // Usar setTimeout para esperar a que los elementos SVG del botón de exportación estén disponibles
                  setTimeout(() => {
                    const exportButton = this.exportSVGElements[0].element;
                    exportButton.setAttribute('transform', 'translate(1515, 10)');
                    exportButton.classList.add('custom-export-button');
                  }, 0);
                }
              }
            },
            lang: {
              viewFullscreen: "Ver en pantalla completa",
              exitFullscreen: "Salir de pantalla completa",
              downloadJPEG: "Descargar imagen JPEG",
              downloadPDF: "Descargar en PDF"
            },
            title: {
              text: 'Comparativo de crecimiento por compañía',
              align: 'center',
              style: {
                color: '#FFFFFF'
              }
            },
            xAxis: {
              categories: labelsData,
              labels: {
                style: {
                  color: '#FFFFFF'
                }
              }
            },
            yAxis: {
              title: {
                text: 'Porcentaje de Crecimiento (%)',
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
                  format: '{y} %',
                  style: {
                    color: '#FFFFFF'
                  }
                },
                enableMouseTracking: true
              },
              series: {
                lineWidth: 5,
                states: {
                  hover: {
                    enabled: true,
                    lineWidth: 5
                  }
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
                  menuItems: ["viewFullscreen", "separator", "downloadJPEG",
                    "downloadPDF"
                  ]
                }
              },
              enabled: true,
              sourceWidth: 1600,
              sourceHeight: 700,
              chartOptions: {
                chart: {
                  backgroundColor: '#303030'
                }
              },
              fallbackToExportServer: false
            },
            series: [{
              name: 'Porcentaje de Crecimiento',
              data: data4,
              color: '#007bff' // Puedes cambiar el color de la línea aquí
            }]
          });

        }
      });
  }
  </script>
</body>

</html>