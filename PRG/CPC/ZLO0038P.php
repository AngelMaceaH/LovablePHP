<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
</head>

<body>
  <?php
  include '../layout-prg.php';
  include '../../assets/php/CPC/ZLO0038P/header.php';
  ?>
  <div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item">
          <span>Cuentas por cobrar / Consultas</span>
        </li>
        <li class="breadcrumb-item active"><span>ZLO0038P</span></li>
      </ol>
    </nav>
  </div>
  </header>
  <div id="body-div" class="body ">
    <div class="card border border-0 m-0 p-3" id="body-page">
      <div class="card-body border border-0  m-0 p-0 overflow-auto table-container">
        <div class="row mb-2">
          <div class="col-0 col-lg-3"></div>
          <div class="col-12 col-lg-3">
            <label class="mt-2">Agrupación:</label>
            <select class="form-select mt-1 fw-bold" id="cbbAgrup">

            </select>
          </div>
          <div class="col-12 col-lg-3">
            <label class="mt-2">Año:</label>
            <select class="form-select  mt-1" id="cbbAno" name="cbbAno">
              <?php
              $anio_actual = date('Y');
              for ($i = $anio_actual; $i >= 2011; $i--) {
                echo "<option value='$i'>$i</option>";
              }
              ?>
            </select>
          </div>
          <div class="col-0 col-lg-3"></div>
          <div class="col-0 col-lg-3"></div>
          <div class="col-0 col-lg-3"></div>
          <div class="col-12">
            <hr>
          </div>
          <div class="col-12">
            <div id="loaderData" class="d-none">
              <button class="btn btn-light position-absolute top-50 start-50 translate-middle p-4"
                style="z-index: 9999;" type="button" disabled>
                <i class="fa-solid fa-spinner fa-spin fa-2xl" style="font-size:120px;"></i>
              </button>
              <div class="position-absolute top-0 start-0 w-100  bg-light  rounded"
                style="z-index: 9998; height:1500px !important; margin-top:150px;"></div>
            </div>
            <div class="demo">
              <ul class="tablist" role="tablist">
                <li id="tab1" class="tablist__tab text-center p-3  is-active" aria-controls="panel1"
                  aria-selected="true" role="tab" tabindex="0">Facturación</li>
                <li id="tab2" class="tablist__tab text-center p-3" aria-controls="panel2" aria-selected="false"
                  role="tab" tabindex="0">Cuentas por cobrar</li>
              </ul>
              <div id="panel1" class="tablist__panel p-3 border border-0" aria-labelledby="tab1" aria-hidden="false"
                role="tabpanel">
                <div id="loaderExcel" class="d-none" style="margin-top: 100px !important;">
                  <button class="btn btn-success position-absolute top-50 start-50 translate-middle p-4"
                    style="z-index: 9999; margin-top: 750px !important;" type="button" disabled>
                    <i class="fa-solid fa-file-excel fa-flip text-white" style="font-size:70px;"></i>
                  </button>
                  <div class="position-absolute top-0 start-0 w-100  bg-secondary bg-opacity-50 rounded"
                    style="z-index: 9998; height: 1800px; !important; width:100%  !important;"></div>
                </div>
                <div class="card border border-0">
                  <div class="card-body border border-0">
                    <div class="row ">
                      <div class="col-12 text-center fw-bold my-3"><h4>COMPARATIVO POR AGRUPACIÓN</h4></div>
                      <div class="col-12">
                        <figure class="highcharts-figure">
                          <div id="container10" class="highcharts-dark text-white Math.rounded"></div>
                        </figure>
                      </div>
                      <div class="col-12">
                        <div class="row w-100 my-5">
                          <div class="col-12 text-center fw-bold"><h4>COMPARATIVO POR TIENDA</h4></div>
                          <div class="col-4"></div>
                          <div class="col-4">
                          <select class="form-select mt-1 fw-bold" id="cbbAgrupTienda">

                          </select>
                          </div>
                          <div class="col-4"></div>
                        </div>
                      </div>
                      <div class="col-12">
                        <figure class="highcharts-figure">
                          <div id="container1" class="highcharts-dark text-white Math.rounded"></div>
                        </figure>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="tablesFacturacion">

                </div>
              </div>
              <div id="panel2" class="tablist__panel is-hidden p-3 border border-0" aria-labelledby="tab2"
                aria-hidden="true" role="tabpanel">
                <div id="loaderExcel2" class="d-none" style="margin-top: 100px !important;">
                  <button class="btn btn-success position-absolute top-50 start-50 translate-middle p-4"
                    style="z-index: 9999; margin-top: 750px !important;" type="button" disabled>
                    <i class="fa-solid fa-file-excel fa-flip text-white" style="font-size:70px;"></i>
                  </button>
                  <div class="position-absolute top-0 start-0 w-100  bg-secondary bg-opacity-50 rounded"
                    style="z-index: 9998; height: 1800px; !important; width:100%  !important;"></div>
                </div>
                <div class="card border border-0">
                  <div class="card-body border border-0">
                    <div class="row ">
                      <div class="col-12 mb-3">
                        <label class="form-control border border-0 fw-bold ">Visualizar gráfica:</label>
                        <select id="selectGrafica" class="form-select fw-bold">
                          <option value="G1">Compras consolidadas</option>
                          <option value="G3">Retenciones</option>
                          <option value="G4">Nota de débito</option>
                          <option value="G5">Abonos a cuentas por cobrar</option>
                          <option value="G6">Nota de crédito</option>
                          <option value="G7">Saldos cuentas por cobrar</option>
                        </select>
                      </div>
                      <div class="col-12">
                        <figure class="highcharts-figure">
                          <div id="container2" class="highcharts-dark text-white Math.rounded"></div>
                        </figure>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="tablesCuentas">

                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 d-flex justify-content-end">
              <div class="d-none" id="divCXP">
              <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle text-white fw-bold" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-gear"></i> Configuraciones
                </button>
                <ul class="dropdown-menu">
                  <li><button type="button" class="btn btn-light fs-6 text-center mb-3 me-3" onclick="showClients()" ;
                  style="width:100%;">
                      <i class="fa-solid fa-user me-1"></i><b>Otros clientes</b>
                    </button></li>
                  <li><button type="button" class="btn btn-light fs-6 text-center mb-3" style="width:250px;" onclick="showDocs()">
                      <i class="fa-solid fa-book me-1"></i><b>Tipo de documentos</b>
                    </button></li>
                </ul>
              </div>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    let compras = []; let retenciones = []; let notaDebito = []; let abonoCuentas = []; let notaCredito = []; let saldoCuentas = [];
    var table =null; var table2 =null; let optgroupstiendas="";
    document.addEventListener('DOMContentLoaded', function () {
      const percxp= '<?php echo isset($_SESSION['PERCXP'])? $_SESSION['PERCXP']:''; ?>';
      if(percxp=='S'){
        $("#divCXP").removeClass('d-none');
      }

      let optgroups = ``;
      let usuario = '<?php echo $_SESSION["CODUSU"]; ?>';
      const urlVal = "http://172.16.15.20/API.LovablePHP/Users/FindAgrupP/?codusu=" + usuario + "";
      fetch(urlVal).then(response => response.json())
        .then(data => {
          if (data.code == 200) {
            const dataResponse = data.data;
            let count = 0;
            if (dataResponse.length > 0) {
              dataResponse.forEach(element => {
                if (element.DESCRI.includes("honduras")) {
                  count++;
                  optgroups +=
                    `<option value="11">LOVABLE E- COMMERCE DIVISION S.A.</option>
                <option value="9">MODA INTIMA S.A.</option>`;
                } else if (element.DESCRI.includes("guatemala")) {
                  count++;
                  optgroups += '<option value="10">TIENDAS LOVABLE GUATEMALA</option>';
                } else if (element.DESCRI.includes("salvador")) {
                  count++;
                  optgroups += '<option value="12">TIENDAS LOVABLE EL SALVADOR</option>';
                } else if (element.DESCRI.includes("costa rica")) {
                  count++;
                  optgroups += '<option value="13">TIENDAS LOVABLE COSTA RICA</option>';
                } else if (element.DESCRI.includes("nicaragua")) {
                  count++;
                  optgroups += '<option value="16">TIENDAS LOVABLE NICARAGUA</option>';
                } else if (element.DESCRI.includes("republica dominicana")) {
                  count++;
                  optgroups += '<option value="15">REPÚBLICA DOMINICANA</option>';
                }
              });
              optgroups += `</optgroup>`;
            }
            $("#cbbAgrup").append(optgroups);
            if (count == 6) {
              $("#cbbAgrup").val(11);
            }
          }
        }).then(() => {
          const agrup = $("#cbbAgrup").val();
          const ano = $("#cbbAno").val();
          chargeTable1(agrup, ano);
          chargeTable2(agrup, ano);
        });
      $("#cbbAgrup").change(function () {
        const agrup = $("#cbbAgrup").val();
        const ano = $("#cbbAno").val();
        chargeTable1(agrup, ano);
        chargeTable2(agrup, ano);
      });
      $("#cbbAgrupTienda").change(function () {
        const agrup = $("#cbbAgrupTienda").val();
        const ano = $("#cbbAno").val();
        chargeChartComp(agrup, ano);
      });
      $("#cbbAno").change(function () {
        const agrup = $("#cbbAgrup").val();
        const ano = $("#cbbAno").val();
        chargeTable1(agrup, ano);
        chargeTable2(agrup, ano);
      });
      $("#selectGrafica").change(function () {
        chargeChart2();
      });


        $('#tbClientesList thead th').each(function() {
            var title = $(this).text();
            $(this).html(title +
                '<br /><input type="text"  oninput="this.value = this.value.toUpperCase()" class="form-control mt-2"/>'
                );
        });
         table = $('#tbClientesList').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            },
            "pageLength": 10,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "/API.LovablePHP/ZLO0038PB/GetClientsList/",
                "type": "POST",
                "complete": function(xhr) {
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    requestError = true;
                }
            },
            "ordering": false,
            "dom": 'rtip',
            "columns": [{
                    "data": "MAEC19",
                    render: function(data) {
                        return data.padStart(2, '0');
                    }
                },
                {
                    "data": "MAENU3",
                    render: function(data) {
                        return data.padStart(4, '0');
                    }
                },
                {
                    "data": "MAENO4"
                },
            ],
            "drawCallback": function() {
                $('#tbClientesList tbody tr').on('click', function() {
                    sendClientes(this);
                });
            }
        });
        $('#tbClientesList thead input').on('keyup', function() {
            var columnIndex = $(this).parent().index();
            var inputValue = $(this).val().trim();

            if (table.column(columnIndex).search() !== inputValue) {
                table
                    .column(columnIndex)
                    .search(inputValue)
                    .draw();
            }
        });


        $('#tbDocumentosList thead th').each(function() {
            var title = $(this).text();
            $(this).html(title +
                '<br /><input type="text"  oninput="this.value = this.value.toUpperCase()" class="form-control mt-2"/>'
                );
        });
         table2 = $('#tbDocumentosList').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            },
            "pageLength": 10,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "/API.LovablePHP/ZLO0038PB/GetDocumentosList/",
                "type": "POST",
                "complete": function(xhr) {
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    requestError = true;
                }
            },
            "ordering": false,
            "dom": 'rtip',
            "columns": [
                {
                    "data": "TIPTI1"
                },
                {
                    "data": "TIPDE3"
                },
            ],
            "drawCallback": function() {
                $('#tbDocumentosList tbody tr').on('click', function() {
                  sendDocumentos(this);
                });
            }
        });
        $('#tbDocumentosList thead input').on('keyup', function() {
            var columnIndex = $(this).parent().index();
            var inputValue = $(this).val().trim();

            if (table2.column(columnIndex).search() !== inputValue) {
                table2
                    .column(columnIndex)
                    .search(inputValue)
                    .draw();
            }
        });

    });
    function exportExcel1 (agrup,ano){
        document.getElementById('loaderExcel').classList.remove('d-none');
        var url = `/API.LovablePHP/ZLO0038PB/ExportExcel1/?agrup=${agrup}&ano=${ano}`;
        fetch(url)
          .then(response => response.blob())
          .then(blob => {
            var tempUrl = window.URL.createObjectURL(blob);
            var a = document.createElement('a');
            a.href = tempUrl;
            a.download =
              `Reporte-Facturacion-${ano}.xlsx`;
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(tempUrl);
            a.remove();
            document.getElementById('loaderExcel').classList.add('d-none');
          })
          .catch(error => {
            console.error('Hubo un problema con la petición Fetch:', error);
          });
    }
    function exportExcel2(agrup,ano){
        document.getElementById('loaderExcel').classList.remove('d-none');
        var url = `/API.LovablePHP/ZLO0038PB/ExportExcel2/?agrup=${agrup}&ano=${ano}`;
        fetch(url)
          .then(response => response.blob())
          .then(blob => {
            var tempUrl = window.URL.createObjectURL(blob);
            var a = document.createElement('a');
            a.href = tempUrl;
            a.download =
              `Reporte-SaldosCXC-${ano}.xlsx`;
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(tempUrl);
            a.remove();
            document.getElementById('loaderExcel').classList.add('d-none');
          })
          .catch(error => {
            console.error('Hubo un problema con la petición Fetch:', error);
          });
    }
    function sendClientes(row) {
        var tr = $(row).closest('tr');
        var tds = tr.find('td');
        var desc = tds.eq(2).text();
        var tipo = tds.eq(0).text();
        var id = tds.eq(1).text();
        tipo = tipo.padStart(2, '0');
        id = id.padStart(4, '0');
        codigo = tipo + '-' + id;
        $("#clienteId").val(codigo);
        $("#clienteInput").val(tipo + ' ' + id + ' ' + desc);
        $("#modalClientes").modal('hide');
        $("#clientsModal").modal('show');
        saveClients();
    }
    function sendDocumentos(row) {
        var tr = $(row).closest('tr');
        var tds = tr.find('td');
        var desc = tds.eq(1).text();
        var tipo = tds.eq(0).text();
        $("#docuId").val(tipo);
        $("#modalDocumentos").modal('hide');
        $("#documentsModal").modal('show');
        saveDocuments();
    }

    function showClientes() {
      $('#tbClientesList thead input').val('');
      table.columns().search('').draw();
      $("#clientsModal").modal('hide');
      $("#modalClientes").modal('show');
    }
    function showDocumentos() {
      $('#tbDocumentosList thead input').val('');
      table2.columns().search('').draw();
      $("#documentsModal").modal('hide');
      $("#modalDocumentos").modal('show');
    }
    function chargeTable1(agrup, ano) {
      $("#loaderData").removeClass('d-none');
      $("#tablesFacturacion").empty();
      let valorMon="";
      switch (agrup) {
        case '11':
        case '9':
          valorMon="LEMPIRAS";
          break;
        default:
          valorMon="DÓLARES";
          break;
      }
      const urlTiendas=`http://172.16.15.20/API.LovablePHP/ZLO0038PB/ListTiendas/?agrup=${agrup}`;
      fetch(urlTiendas)
        .then(response => response.json())
        .then(data => {
          if (data.code == 200) {
            optgroupstiendas="";
            data.data.map((tienda)=>{
              optgroupstiendas +=
                    `<option value="${tienda.CODCIA}">${tienda.NOMCIA}</option>`;
            });
            $("#cbbAgrupTienda").empty();
            $("#cbbAgrupTienda").append(optgroupstiendas);
          }
        }
      );

      for (let j = ano; j >= (ano - 5); j--) {
      $("#tablesFacturacion").append(`
                 <div class="row">
                  <div class="col-12 col-lg-6">
                    <button type="button" onclick="exportExcel1('${agrup}','${j}')" class="btn btn-success text-light fs-6 text-center mb-3"
                      style="width:280px;">
                      <i class="fa-solid fa-file-excel me-1"></i><b>Enviar REPORTE ${j} a Excel</b>
                    </button>
                  </div>
                  <div class="col-12 col-lg-6 d-flex justify-content-end">

                  </div>
                </div>
            <table id="tableFacturacion${j}" class="table stripe table-hover " style="width:100% ;">
                  <thead class="border-lg sticky-top bg-white">
                    <tr>
                      <th colspan="1" class="border border-dark border-bottom-0 bgYellow"></th>
                      <th colspan="14" class=" border border-dark align-middle text-center">
                        <span class="fs-4">FACTURACIÓN <span id="lblCia${j}"></span> AÑO <span id="lblano${j}"></span></span>
                      </th>
                    </tr>
                    <tr>
                      <th colspan="1"
                        class="border border-dark border-top-0 border-bottom-0 bgYellow text-darkblue fw-bold fs-3">
                        <span>TIENDAS</span>
                      </th>
                      <th colspan="14" class=" border border-dark text-center">
                        <span class="fs-6">EXPRESADO EN <span">${valorMon}</span></span>
                      </th>
                    </tr>
                    <tr>
                      <th colspan="1" class="border border-dark border-top-0 bgYellow"></th>
                      <th class=" border border-dark bg-light text-darkblue">ENERO</th>
                      <th class=" border border-dark bg-light text-darkblue">FEBRERO</th>
                      <th class=" border border-dark bg-light text-darkblue">MARZO</th>
                      <th class=" border border-dark bg-light text-darkblue">ABRIL</th>
                      <th class=" border border-dark bg-light text-darkblue">MAYO</th>
                      <th class=" border border-dark bg-light text-darkblue">JUNIO</th>
                      <th class=" border border-dark bg-light text-darkblue">JULIO</th>
                      <th class=" border border-dark bg-light text-darkblue">AGOSTO</th>
                      <th class=" border border-dark bg-light text-darkblue">SEPTIEMBRE</th>
                      <th class=" border border-dark bg-light text-darkblue">OCTUBRE</th>
                      <th class=" border border-dark bg-light text-darkblue">NOVIEMBRE</th>
                      <th class=" border border-dark bg-light text-darkblue">DICIEMBRE</th>
                      <th class=" border border-dark bg-light">TOTAL A DIC.</th>
                      <th class=" border border-dark bg-light text-darkblue">PROM. MENSUAL</th>
                    </tr>
                  </thead>
                  <tbody id="tableFacturacion${j}Detalle">

                  </tbody>
                </table>`);
      let response1 = [];
      const url = `http://172.16.15.20/API.LovablePHP/ZLO0038PB/ListFac1/?agrup=${agrup}&ano=${j}`;
      fetch(url)
        .then(response => response.json())
        .then(data => {
          if (data.code == 200 || data.code==500) {
            $(`#lblCia${j}`).text($("#cbbAgrup").find('option:selected').text());
            $(`#lblano${j}`).text(j);
            const responseData = data.data;
            response1 = responseData;
            const table1 = $(`#tableFacturacion${j}Detalle`);
            table1.empty();
            const anoActual = new Date().getFullYear();
            const mesActual = new Date().getMonth();
            let mesprom = 0;
            if (anoActual != ano) {
              mesprom = 12;
            } else {
              mesprom = mesActual + 1;
            }
            const totales = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            responseData.forEach(element => {
              let total = 0;
              let promedio = 0;
              total = parseFloat(element.ENE) + parseFloat(element.FEB) + parseFloat(element.MAR) + parseFloat(
                element.ABR) + parseFloat(element.MAY) + parseFloat(element.JUN) + parseFloat(element.JUL) +
                parseFloat(element.AGO) + parseFloat(element.SEP) + parseFloat(element.OCT) + parseFloat(element
                  .NOV) + parseFloat(element.DIC);
              promedio = total / mesprom;
              totales[0] += parseFloat(element.ENE);
              totales[1] += parseFloat(element.FEB);
              totales[2] += parseFloat(element.MAR);
              totales[3] += parseFloat(element.ABR);
              totales[4] += parseFloat(element.MAY);
              totales[5] += parseFloat(element.JUN);
              totales[6] += parseFloat(element.JUL);
              totales[7] += parseFloat(element.AGO);
              totales[8] += parseFloat(element.SEP);
              totales[9] += parseFloat(element.OCT);
              totales[10] += parseFloat(element.NOV);
              totales[11] += parseFloat(element.DIC);
              totales[12] += total;
              table1.append(`<tr>
                    <td class="sticky-col border border-dark bgYellow text-darkblue fw-bold"><span>${element.NOMCIA}<br> </span><span>${element.CODCL1.padStart(2, "0")}&nbsp;-&nbsp;${element.CODCL2.padStart(4, "0")} </span></td>
                    <td class="border border-dark bgYellowSoft text-darkblue fnumber">${(element.ENE == 0) ? "" : parseFloat(element.ENE).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td class="border border-dark bgYellowSoft text-darkblue fnumber">${(element.FEB == 0) ? "" : parseFloat(element.FEB).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td class="border border-dark bgYellowSoft text-darkblue fnumber">${(element.MAR == 0) ? "" : parseFloat(element.MAR).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td class="border border-dark bgYellowSoft text-darkblue fnumber">${(element.ABR == 0) ? "" : parseFloat(element.ABR).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td class="border border-dark bgYellowSoft text-darkblue fnumber">${(element.MAY == 0) ? "" : parseFloat(element.MAY).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td class="border border-dark bgYellowSoft text-darkblue fnumber">${(element.JUN == 0) ? "" : parseFloat(element.JUN).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td class="border border-dark bgYellowSoft text-darkblue fnumber">${(element.JUL == 0) ? "" : parseFloat(element.JUL).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td class="border border-dark bgYellowSoft text-darkblue fnumber">${(element.AGO == 0) ? "" : parseFloat(element.AGO).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td class="border border-dark bgYellowSoft text-darkblue fnumber">${(element.SEP == 0) ? "" : parseFloat(element.SEP).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td class="border border-dark bgYellowSoft text-darkblue fnumber">${(element.OCT == 0) ? "" : parseFloat(element.OCT).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td class="border border-dark bgYellowSoft text-darkblue fnumber">${(element.NOV == 0) ? "" : parseFloat(element.NOV).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td class="border border-dark bgYellowSoft text-darkblue fnumber">${(element.DIC == 0) ? "" : parseFloat(element.DIC).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td class="border border-dark text-darkblue fnumber">${(total == 0) ? "" : parseFloat(total).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td class="border border-dark bgOrangeSoft text-darkblue fnumber">${(promedio == 0) ? "" : parseFloat(promedio).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                  </tr>`);
            });
            totales[13] = totales[12] / mesprom;
            table1.append(`<tr>
                    <td class="sticky-col border border-dark bgGreen text-darkblue fw-bold">TOTALES</td>
                    <td class="border border-dark bgGreenSoft text-darkblue fnumber">${(totales[0] == 0) ? "" : parseFloat(totales[0]).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td class="border border-dark bgGreenSoft text-darkblue fnumber">${(totales[1] == 0) ? "" : parseFloat(totales[1]).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td class="border border-dark bgGreenSoft text-darkblue fnumber">${(totales[2] == 0) ? "" : parseFloat(totales[2]).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td class="border border-dark bgGreenSoft text-darkblue fnumber">${(totales[3] == 0) ? "" : parseFloat(totales[3]).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td class="border border-dark bgGreenSoft text-darkblue fnumber">${(totales[4] == 0) ? "" : parseFloat(totales[4]).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td class="border border-dark bgGreenSoft text-darkblue fnumber">${(totales[5] == 0) ? "" : parseFloat(totales[5]).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td class="border border-dark bgGreenSoft text-darkblue fnumber">${(totales[6] == 0) ? "" : parseFloat(totales[6]).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td class="border border-dark bgGreenSoft text-darkblue fnumber">${(totales[7] == 0) ? "" : parseFloat(totales[7]).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td class="border border-dark bgGreenSoft text-darkblue fnumber">${(totales[8] == 0) ? "" : parseFloat(totales[8]).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td class="border border-dark bgGreenSoft text-darkblue fnumber">${(totales[9] == 0) ? "" : parseFloat(totales[9]).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td class="border border-dark bgGreenSoft text-darkblue fnumber">${(totales[10] == 0) ? "" : parseFloat(totales[10]).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td class="border border-dark bgGreenSoft text-darkblue fnumber">${(totales[11] == 0) ? "" : parseFloat(totales[11]).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td class="border border-dark text-darkblue fnumber">${(totales[12] == 0) ? "" : parseFloat(totales[12]).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td class="border border-dark bgOrangeSoft text-darkblue fnumber">${(totales[13] == 0) ? "" : parseFloat(totales[13]).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                  </tr>`);
          }
        })
      }
      chargeChart1(agrup, ano);
      setTimeout(() => {
        chargeChartComp($("#cbbAgrupTienda").val(),ano);
      }, 2000);
    }
    function chargeChartComp(agrup,ano){
      let seriesData=[];
      const url=`http://172.16.15.20/API.LovablePHP/ZLO0038PB/ListCompara2/?agrup=${agrup}&ano=${ano}`;

      fetch(url)
        .then(response => response.json())
        .then(data => {
          if (data.code == 200) {
            seriesData = data.data.map(item => {
              return {
                name: item.NOMCIA,
                data: [
                  parseFloat(item.ENE),
                  parseFloat(item.FEB),
                  parseFloat(item.MAR),
                  parseFloat(item.ABR),
                  parseFloat(item.MAY),
                  parseFloat(item.JUN),
                  parseFloat(item.JUL),
                  parseFloat(item.AGO),
                  parseFloat(item.SEP),
                  parseFloat(item.OCT),
                  parseFloat(item.NOV),
                  parseFloat(item.DIC)
                ]
              };
            });
          }
        }
      ).then(()=>{
        Highcharts.chart('container1', {
        chart: {
          type: 'line',
          height: 500,
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
          text: "FACTURACIÓN " + $("#cbbAgrupTienda").find('option:selected').text() + " 5 AÑOS ANTERIORES",
          align: 'center',
          style: {
            color: '#FFFFFF'
          }
        },
        xAxis: {
          categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
            'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
          ],
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
              format: '{y}',
              style: {
                color: '#FFFFFF'
              }
            },
            enableMouseTracking: true
          }
        },
        series: seriesData,
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
            showAllButton: {
              text: 'Mostrar todos',
              onclick: function () {
                this.series.forEach(function (series) {
                  series.setVisible(true, false);
                });
                this.redraw();
              },
              theme: {
                fill: 'white',
                stroke: 'silver',
                r: 0,
                style: {
                  color: '#FFFFFF'
                },
                states: {
                  hover: {
                    fill: '#a4edba'
                  },
                  select: {
                    stroke: '#039',
                    fill: '#a4edba'
                  }
                }
              }
            },
            removeAllButton: {
              text: 'Quitar todos',
              onclick: function () {
                this.series.forEach(function (series) {
                  series.setVisible(false, false);
                });
                this.redraw();
              },
              theme: {
                fill: 'white',
                stroke: 'silver',
                r: 0,
                style: {
                  color: '#FFFFFF'
                },
                states: {
                  hover: {
                    fill: '#a4edba'
                  },
                  select: {
                    stroke: '#039',
                    fill: '#a4edba'
                  }
                }
              }
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
        }
      });
      });
    }
    function chargeChart1(agrup, ano) {
      let seriesData=[];
      const url = `http://172.16.15.20/API.LovablePHP/ZLO0038PB/ListCompara1/?agrup=${agrup}&ano=${ano}`;
      fetch(url)
        .then(response => response.json())
        .then(data => {
          if (data.code == 200) {
            seriesData = data.data.map(item => {
              return {
                name: item.NOMCIA,
                data: [
                  parseFloat(item.ENE),
                  parseFloat(item.FEB),
                  parseFloat(item.MAR),
                  parseFloat(item.ABR),
                  parseFloat(item.MAY),
                  parseFloat(item.JUN),
                  parseFloat(item.JUL),
                  parseFloat(item.AGO),
                  parseFloat(item.SEP),
                  parseFloat(item.OCT),
                  parseFloat(item.NOV),
                  parseFloat(item.DIC)
                ]
              };
            });
          }
        }
      ).then(()=>{
        Highcharts.chart('container10', {
        chart: {
          type: 'line',
          height: 500,
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
          text: "FACTURACIÓN " + $("#cbbAgrup").find('option:selected').text() + " 5 AÑOS ANTERIORES",
          align: 'center',
          style: {
            color: '#FFFFFF'
          }
        },
        xAxis: {
          categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
            'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
          ],
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
              format: '{y}',
              style: {
                color: '#FFFFFF'
              }
            },
            enableMouseTracking: true
          }
        },
        series: seriesData,
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
            showAllButton: {
              text: 'Mostrar todos',
              onclick: function () {
                this.series.forEach(function (series) {
                  series.setVisible(true, false);
                });
                this.redraw();
              },
              theme: {
                fill: 'white',
                stroke: 'silver',
                r: 0,
                style: {
                  color: '#FFFFFF'
                },
                states: {
                  hover: {
                    fill: '#a4edba'
                  },
                  select: {
                    stroke: '#039',
                    fill: '#a4edba'
                  }
                }
              }
            },
            removeAllButton: {
              text: 'Quitar todos',
              onclick: function () {
                this.series.forEach(function (series) {
                  series.setVisible(false, false);
                });
                this.redraw();
              },
              theme: {
                fill: 'white',
                stroke: 'silver',
                r: 0,
                style: {
                  color: '#FFFFFF'
                },
                states: {
                  hover: {
                    fill: '#a4edba'
                  },
                  select: {
                    stroke: '#039',
                    fill: '#a4edba'
                  }
                }
              }
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
        }
      });
      });
     }

    function chargeTable2(agrup, ano) {
      $("#tablesCuentas").empty();
      compras=[]; retenciones=[]; notaDebito=[];abonoCuentas=[];notaCredito=[];saldoCuentas=[];
      for (let k = ano; k >= (ano - 5); k--) {
        let response2 = [];
      const url = `http://172.16.15.20/API.LovablePHP/ZLO0038PB/ListFac2/?agrup=${agrup}&ano=${k}`;
      $("#tablesCuentas").append(`<div class="row">
                  <div class="col-12 col-lg-6">
                    <button type="button" onclick="exportExcel2('${agrup}','${k}')" class="btn btn-success text-light fs-6 text-center mb-3"
                      style="width:280px;">
                      <i class="fa-solid fa-file-excel me-1"></i><b>Enviar REPORTE ${k} a Excel</b>
                    </button>
                  </div>
                  <div class="col-12 col-lg-6 d-flex justify-content-end">

                  </div>
                </div>
                <table id="tableCuentas${k}" class="table stripe table-hover " style="width:100% ;">
                  <thead class="border-lg sticky-top bg-white">
                    <tr>
                      <th colspan="1" class="border border-0 bg-white"></th>
                      <th colspan="7" class=" border border-dark align-middle bgYellow text-center">
                        <span class="fs-4"><span id="lblCia2${k}"></span> AÑO <span>${k}</span></span>
                      </th>
                      <th colspan="1" class="border border-0"></th>
                    </tr>
                    <tr>
                      <th colspan="1" class="border border-0 bg-white"></th>
                      <th colspan="5" class=" border border-dark align-middle bgGreen">
                        <span class="fs-6 ">SALDO INICIAL "CUENTAS POR COBRAR" A LOVABLE DE HONDURAS</span>
                      </th>
                      <th colspan="2"
                        class=" border border-dark align-middle bgOrange text-darkblue fw-bold text-center">
                        <span class="fs-6" id="saldoIni${k}"></span>
                      </th>
                      <th colspan="1" class="border border-0"></th>
                    </tr>
                    <tr>
                      <th></th>
                      <th class=" border border-dark bg-light w12">MES</th>
                      <th class=" border border-3 border-dark bgGreenSoft text-darkblue w12">COMPRAS <br> CONSOLIDADAS
                      </th>
                      <th class=" border border-3 border-dark bg-light  w12">RETENCIONES</th>
                      <th class=" border border-3 border-dark bg-light  w12">NOTA DE DÉBITO</th>
                      <th class=" border border-3 border-dark bg-light  w12">ABONO A <br> CUENTAS POR COBRAR</th>
                      <th class=" border border-3 border-dark bg-light  w12">NOTA DE CRÉDITO</th>
                      <th class=" border border-3 border-dark bg-light  w12">SALDO <br> CUENTAS POR COBRAR</th>
                      <th class=" border border-0 w16"></th>
                    </tr>
                  </thead>
                  <tbody id="tableCuentas${k}Detalle">

                  </tbody>
                </table>`);
      let mesesCompras = []; let mesesRetenciones = []; let mesesNotaDebito = []; let mesesAbonoCuentas = []; let mesesNotaCredito = []; let mesesSaldoCuentas = [];
        fetch(url)
        .then(response => response.json())
        .then(data => {
          if (data.code == 200) {
            $(`#lblCia2${k}`).text($("#cbbAgrup").find('option:selected').text());
            const responseData = data.data;
            response2 = responseData;
            const table2 = $(`#tableCuentas${k}Detalle`);
            table2.empty();
            $(`#saldoIni${k}`).text(parseFloat(responseData.SALDO).toLocaleString('es-419', {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2
            }));
            const meses = ["ENE", "FEB", "MAR", "ABR", "MAY", "JUN", "JUL", "AGO", "SEP", "OCT", "NOV", "DIC"];
            let cont = 1;
            meses.forEach(mes => {
              let msg = "";
              if (parseFloat(responseData[mes][6]) < 0) {
                msg = "SALDO&nbsp;A&nbsp;FAVOR&nbsp;PARA&nbsp;E-COMMERCE";
              }
              mesesCompras.push(parseFloat(responseData[mes][1]));
              mesesRetenciones.push(parseFloat(responseData[mes][2]));
              mesesNotaDebito.push(parseFloat(responseData[mes][3]));
              mesesAbonoCuentas.push(parseFloat(responseData[mes][4]));
              mesesNotaCredito.push(parseFloat(responseData[mes][5]));
              mesesSaldoCuentas.push(parseFloat(responseData[mes][6]));
              table2.append(`<tr>
                            <td> <button class="btn btn-light" onclick="showHistorial(this,'row-${cont}-${k}','${agrup}','${k}')" ><i class="fa-solid fa-caret-right"></i></button> </td>
                            <td class="border border-dark bg-light text-darkblue fw-bold">${responseData[mes][0]}</td>
                            <td class="border border-dark bgGreenSoft text-darkblue">${(parseFloat(responseData[mes][1]) == 0) ? " " : parseFloat(responseData[mes][1]).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                            <td class="border border-dark bgSeaSoft text-darkblue">${(parseFloat(responseData[mes][2]) == 0) ? " " : parseFloat(responseData[mes][2]).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                            <td class="border border-dark bgOrangeSoft text-darkblue">${(parseFloat(responseData[mes][3]) == 0) ? " " : parseFloat(responseData[mes][3]).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                            <td class="border border-dark bg-light text-darkblue">${(parseFloat(responseData[mes][4]) == 0) ? " " : parseFloat(responseData[mes][4]).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                            <td class="border border-dark bg-light text-darkblue">${(parseFloat(responseData[mes][5]) == 0) ? " " : parseFloat(responseData[mes][5]).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                            <td class="border border-dark bg-light text-darkblue">${(parseFloat(responseData[mes][6]) == 0) ? " " : parseFloat(responseData[mes][6]).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                            <td class="border border-0 text-start fs12 ">${msg}</td>
                          </tr>
                          <tr id="row-${cont}-${k}">
                          </tr>
                          `);
              cont++;
            });
            const totales = ['TOTALES', compras.reduce((a, b) => a + b, 0), retenciones.reduce((a, b) => a + b, 0), notaDebito.reduce((a, b) => a + b, 0), abonoCuentas.reduce((a, b) => a + b, 0), notaCredito.reduce((a, b) => a + b, 0), saldoCuentas.reduce((a, b) => a + b, 0)];
            table2.append(`<tr>
                            <td></td>
                            <td class="border border-dark bg-white text-darkblue fw-bold">${totales[0]}</td>
                            <td class="border border-dark bg-white text-darkblue">${(parseFloat(totales[1]) == 0) ? " " : parseFloat(totales[1]).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                            <td class="border border-dark bg-white text-darkblue">${(parseFloat(totales[2]) == 0) ? " " : parseFloat(totales[2]).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                            <td class="border border-dark bg-white text-darkblue">${(parseFloat(totales[3]) == 0) ? " " : parseFloat(totales[3]).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                            <td class="border border-dark bg-white text-darkblue">${(parseFloat(totales[4]) == 0) ? " " : parseFloat(totales[4]).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                            <td class="border border-dark bg-white text-darkblue">${(parseFloat(totales[5]) == 0) ? " " : parseFloat(totales[5]).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                            <td class="border border-dark bg-white text-darkblue"></td>
                            <td class="border border-0 text-start fs12 "></td>
                          </tr>
                          <tr id="row-${cont}-${k}">
                          </tr>
                          `);
          }
        })
            compras.push({
                name: `AÑO ${k}`,
                data: mesesCompras
              });
              retenciones.push({
                name: `AÑO ${k}`,
                data: mesesRetenciones
              });
              notaDebito.push({
                name: `AÑO ${k}`,
                data: mesesNotaDebito
              })
              abonoCuentas.push({
                name: `AÑO ${k}`,
                data: mesesAbonoCuentas
              })
              notaCredito.push({
                name: `AÑO ${k}`,
                data: mesesNotaCredito
              })
              saldoCuentas.push({
                name: `AÑO ${k}`,
                data: mesesSaldoCuentas
              })
      }
      setTimeout(() => {
        chargeChart2();
        $("#loaderData").addClass('d-none');
      }, 2000);
    }

    function chargeChart2() {
      let arrayData =[];
      const graficaSelected = $("#selectGrafica").val();
      switch (graficaSelected) {
        case 'G1':
          arrayData = compras;
          break;
        case 'G3':
          arrayData = retenciones;
          break;
        case 'G4':
          arrayData = notaDebito;
          break;
        case 'G5':
          arrayData = abonoCuentas;
          break;
        case 'G6':
          arrayData = notaCredito;
          break;
        case 'G7':
          arrayData = saldoCuentas;
          break;
      }
      setTimeout(() => {
        chart2 = Highcharts.chart('container2', {
        chart: {
          type: 'line',
          height: 500,
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
            text: ($("#selectGrafica").find('option:selected').text() + " " + $("#cbbAgrup").find('option:selected').text() + " 5 AÑOS ANTERIORES"),
            align: 'center',
            style: {
              color: '#FFFFFF'
            }
        },
        xAxis: {
          categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
            'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
          ],
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
              format: '{y}',
              style: {
                color: '#FFFFFF'
              }
            },
            enableMouseTracking: true
          }
        },
        series: arrayData,
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
            showAllButton: {
              text: 'Mostrar todos',
              onclick: function () {
                this.series.forEach(function (series) {
                  series.setVisible(true, false);
                });
                this.redraw();
              },
              theme: {
                fill: 'white',
                stroke: 'silver',
                r: 0,
                style: {
                  color: '#FFFFFF'
                },
                states: {
                  hover: {
                    fill: '#a4edba'
                  },
                  select: {
                    stroke: '#039',
                    fill: '#a4edba'
                  }
                }
              }
            },
            removeAllButton: {
              text: 'Quitar todos',
              onclick: function () {
                this.series.forEach(function (series) {
                  series.setVisible(false, false);
                });
                this.redraw();
              },
              theme: {
                fill: 'white',
                stroke: 'silver',
                r: 0,
                style: {
                  color: '#FFFFFF'
                },
                states: {
                  hover: {
                    fill: '#a4edba'
                  },
                  select: {
                    stroke: '#039',
                    fill: '#a4edba'
                  }
                }
              }
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
        }
      });
      ;
      }, 1500);
    }

    function showHistorial(button, id,agrup,ano) {
      const icon = $(button).find('svg');
      if (icon.length > 0) {
        if (icon.hasClass('fa-caret-right')) {
          let mes = id.split('-')[1].padStart(2, '0');
          $(`#${id}`).empty();
          $(`#${id}`).append(`<td colspan="1" class="bg-white" ></td>
                            <td colspan="7" class="text-center bg-light" >
                             <i class="fa-solid fa-spinner fa-spin fa-2xl" style="font-size:60px;"></i>
                            </td>
                            <td colspan="1" class="bg-white" ></td>`);

          const url = `http://172.16.15.20/API.LovablePHP/ZLO0038PB/FindMes/?agrup=${agrup}&ano=${ano}&mes=${mes}`;
          fetch(url)
            .then(response => response.json())
            .then(data => {
              if (data.code == 200) {
                icon.removeClass('fa-caret-right');
                icon.addClass('fa-caret-down');
                $(`#${id}`).empty();
                $(`#${id}`).append(`<td colspan="9" class="p-0" >
                                    <table class="table stripe" style="width:1560px !important; margin-left:36px !important;">
                                          <thead class="border-lg sticky-top bg-white">
                                          </thead>
                                          <tbody id="table${id}Detalle">

                                          </tbody>
                                        </table>
                                  </td>
                                  `);
                const responseData = data.data;

                responseData.forEach(element => {
                  $(`#table${id}Detalle`).append(`<tr> <td colspan="1" class="border border-0"></td>
                          <td class="border border-dark bgYellowSoft text-darkblue fw-bold w12 fs12"><span>${element['NOMCIA']}</span><br /><span>${element['CODCL1']} - ${element['CODCL2']}</span></td>
                          <td class="border border-dark bgGreenSoft text-darkblue w12">${(parseFloat(element['COMPRAS']) == 0) ? " " : parseFloat(element['COMPRAS']).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                          <td class="border border-dark bgSeaSoft text-darkblue w12">${(parseFloat(element['RETENCION']) == 0) ? " " : parseFloat(element['RETENCION']).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                          <td class="border border-dark bgOrangeSoft text-darkblue w12">${(parseFloat(element['DEBITO']) == 0) ? " " : parseFloat(element['DEBITO']).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                          <td class="border border-dark bgGreySoft text-darkblue w12">${(parseFloat(element['CXP']) == 0) ? " " : parseFloat(element['CXP']).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                          <td class="border border-dark bgGreySoft text-darkblue w12">${(parseFloat(element['CREDITO']) == 0) ? " " : parseFloat(element['CREDITO']).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                          <td class="border border-dark bgGreySoft text-darkblue w12">${(parseFloat(element['SALDO']) == 0) ? " " : parseFloat(element['SALDO']).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                          <td class="border border-0 text-start fs12 w16"></td></tr>`);
                });
              }
            });
        } else {
          $(`#${id}`).empty();
          icon.removeClass('fa-caret-down');
          icon.addClass('fa-caret-right');
        }
      } else {
      }
    }

    async function showClients() {
      $("#txtTipo").val('');
      $("#txtNumero").val('');
      await chargeClients();
      $('#clientsModal').modal('show');
    }
    function chargeClients() {
      const agrup = $("#cbbAgrup").val();
      const url = `http://172.16.15.20/API.LovablePHP/ZLO0038PB/GetClients/?agrup=${agrup}`;
      fetch(url)
        .then(response => response.json())
        .then(data => {
          const tbbodyClientes = $("#tbbodyClientes");
          tbbodyClientes.empty();
          if (data.code == 200) {
            const responseData = data.data;
            responseData.forEach(element => {
              tbbodyClientes.append(`<tr>
                    <td class="text-center">${element.CODCL1.padStart(2, "0")}-${element.CODCL2.padStart(4, "0")}</td>
                    <td>${element.MAENO4}</td>
                    <td class="text-center"><button class="btn btn-danger" onclick="deleteClients('${element.CODCL1.padStart(2, "0")}','${element.CODCL2.padStart(4, "0")}')"><i class="fa-solid fa-trash text-white"></i></button></td>
                  </tr>`);
            });
          } else {
            tbbodyClientes.append(`<tr>
                    <td class="text-center" colspan="3">No se han agregado clientes</td>
                  </tr>`);
          }
        }).then(() => {
          $("#clientsModalLabel").text("Clientes " + $("#cbbAgrup").find('option:selected').text());
          $('#clientsModal').modal('show');
        });
    }
    function deleteClients(tipo, numero) {
      const agrup = $("#cbbAgrup").val();
      const url = `http://172.16.15.20/API.LovablePHP/ZLO0038PB/DeleteClients/?agrup=${agrup}&ano=${tipo}&mes=${numero}`;
      fetch(url)
        .then(response => response.json())
        .then(data => {
          if (data.code == 200) {
            chargeClients();
            const agrup = $("#cbbAgrup").val();
            const ano = $("#cbbAno").val();
            chargeTable1(agrup, ano);
            chargeTable2(agrup, ano);
          } else if (data.code == 501) {
            Swal.fire({
              icon: 'warning',
              title: 'Error',
              text: 'Este código de cliente no existe',
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Ha sucedido un error',
            });
          }
        });
    }

    function saveClients() {
      const value=$("#clienteId").val();
      if(value!=""){
        const tipo=value.split('-')[0];
      const numero=value.split('-')[1];
      const agrup = $("#cbbAgrup").val();
      const url = `http://172.16.15.20/API.LovablePHP/ZLO0038PB/CreateClients/?agrup=${agrup}&ano=${tipo}&mes=${numero}`;
      fetch(url)
        .then(response => response.json())
        .then(data => {
          if (data.code == 200) {
            chargeClients();
            const agrup = $("#cbbAgrup").val();
            const ano = $("#cbbAno").val();
            $("#clienteId").val(' ');
            $("#clienteInput").val('');
            chargeTable1(agrup, ano);
            chargeTable2(agrup, ano);
          } else if (data.code == 501) {
            Swal.fire({
              icon: 'warning',
              title: 'Error',
              text: 'Este código de cliente no existe',
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Ha sucedido un error',
            });
          }
        });

      }else{
        Swal.fire({
              icon: 'warning',
              title: 'Error',
              text: 'El campo no puede estar vacío',
            });
      }
      }

    async function showDocs(){
      $("#txtDoc").val('');
      await chargeDocuments();
      $('#documentsModal').modal('show');
    }
    function chargeDocuments() {
      const agrup = $("#cbbAgrup").val();
      const url = `http://172.16.15.20/API.LovablePHP/ZLO0038PB/GetDocuments/?agrup=${agrup}`;
      fetch(url)
        .then(response => response.json())
        .then(data => {
          const tbbodyDocuments = $("#tbbodyDocuments");
          tbbodyDocuments.empty();
          if (data.code == 200) {
            const responseData = data.data;
            responseData.forEach(element => {
              tbbodyDocuments.append(`<tr>
                    <td class="text-center">${element.CODDOC}</td>
                    <td>${element.DOCDES}</td>
                    <td class="text-center"><button class="btn btn-danger" onclick="deleteDocuments('${element.CODDOC}')"><i class="fa-solid fa-trash text-white"></i></button></td>
                  </tr>`);
            });
          } else {
            tbbodyDocuments.append(`<tr>
                    <td class="text-center" colspan="3">No se han agregado documentos</td>
                  </tr>`);
          }
        }).then(() => {
          $("#documentsModalLabel").text("Documentos " + $("#cbbAgrup").find('option:selected').text());
          $('#documentsModal').modal('show');
        });
    }

    function saveDocuments() {
      const agrup = $("#cbbAgrup").val();
      const tipo = $("#docuId").val().toUpperCase();
      const url = `http://172.16.15.20/API.LovablePHP/ZLO0038PB/CreateDocuments/?agrup=${agrup}&ano=${tipo}`;
      fetch(url)
        .then(response => response.json())
        .then(data => {
          if (data.code == 200) {
            chargeDocuments();
            const agrup = $("#cbbAgrup").val();
            const ano = $("#cbbAno").val();
            chargeTable1(agrup, ano);
            chargeTable2(agrup, ano);
          } else if (data.code == 501) {
            Swal.fire({
              icon: 'warning',
              title: 'Error',
              text: 'Este tipo de documento no existe',
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Ha sucedido un error',
            });
          }
        });
    }

    function deleteDocuments(tipo) {
      const agrup = $("#cbbAgrup").val();
      const url = `http://172.16.15.20/API.LovablePHP/ZLO0038PB/DeleteDocuments/?agrup=${agrup}&ano=${tipo}`;
      fetch(url)
        .then(response => response.json())
        .then(data => {
          if (data.code == 200) {
            chargeDocuments();
            const agrup = $("#cbbAgrup").val();
            const ano = $("#cbbAno").val();
            chargeTable1(agrup, ano);
            chargeTable2(agrup, ano);
          } else if (data.code == 501) {
            Swal.fire({
              icon: 'warning',
              title: 'Error',
              text: 'Este tipo de documento no existe',
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Ha sucedido un error',
            });
          }
        });
    }
  </script>
</body>
<!-- Modal -->
<div class="modal fade" id="clientsModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="clientsModalLabel"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body m-0">
        <div class="row container">
          <div class="col-12 mb-4">
            <!--<div class="row">
              <div class="col-12 col-md-9">
                <div class="row">
                  <div class="col-6">
                    <label for="txtTipo">Tipo</label>
                    <input id="txtTipo" class="form-control mt-1"
                      oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                      type="number" maxlength="2">
                  </div>
                  <div class="col-6">
                    <label for="txtNumero">Numero</label>
                    <input id="txtNumero" class="form-control mt-1"
                      oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                      type="number" maxlength="4">
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-3">
                <button type="button" class="btn btn-success text-white w100 mt-3" onclick="saveClients()">
                  <i class="fa-solid fa-user-plus me-1"></i>Agregar
                </button>
              </div>
            </div>-->
            <div class="row">
              <div class="col-12">
                  <span class="" onclick="showClientes()">
                    <input type="text" class="text-muted form-select mt-3" id="clienteInput" placeholder="Selecciona un cliente" readonly />
                  </span>
                  <input class="d-none" id="clienteId"  />
              </div>
              <div class="col-12 col-md-3 d-none">
                <button type="button" class="btn btn-success text-white w100 mt-3" onclick="saveClients()">
                    <i class="fa-solid fa-user-plus me-1"></i>Agregar
                  </button>
              </div>
            </div>
          </div>
          <div class="col-12">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th style="width:20% !important;">Num.</th>
                  <th style="width:70% !important;">Nombre</th>
                  <th style="width:10% !important;"></th>
                </tr>
              </thead>
              <tbody id="tbbodyClientes">

              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer p-2">
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="documentsModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="documentsModalLabel"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body m-0">
        <div class="container">
          <!--<div class="row mb-4">
            <div class="col-12 col-md-9">
              <label for="txtDoc">Tipo de documento</label>
              <input id="txtDoc" class="form-control mt-1" type="text" maxlength="2" style="text-transform: uppercase;">
            </div>
            <div class="col-12 col-md-3">
              <button type="button" class="btn btn-success text-white w-100 mt-3" onclick="saveDocuments()">
                <i class="fa-solid fa-book-medical me-1"></i>Agregar
              </button>
            </div>
          </div>-->
          <div class="row mb-3">
            <div class="col-12">
            <span class="" onclick="showDocumentos()">
                    <input type="text" class="text-muted form-select mt-3" id="documentosInput" placeholder="Selecciona un documento" readonly />
                  </span>
                  <input class="d-none" id="docuId"  />

            </div>
          </div>
          <div class="col-12">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th style="width:20% !important;">Tipo</th>
                  <th style="width:70% !important;">Nombre</th>
                  <th style="width:10% !important;"></th>
                </tr>
              </thead>
              <tbody id="tbbodyDocuments">
                <!-- Table content goes here -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer p-2">
        <!-- Footer content goes here -->
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalClientes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>

                    <button type="button" class="btn-close" onclick="$('#modalClientes').modal('hide')"></button>
                </div>
                <div class="modal-body">
                <table id="tbClientesList" class="table stripe table-hover " style="width:100%">
                            <thead>
                                <tr>
                                    <th colspan="10%" class="text-black text-start">Tipo</th>
                                    <th colspan="10%" class="text-black text-start">Numero</th>
                                    <th colspan="10%" class="text-black text-start">Cliente</th>
                                </tr>
                            </thead>
                            <tbody id="tbClientesListBody">

                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalDocumentos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>

                    <button type="button" class="btn-close" onclick="$('#modalDocumentos').modal('hide')"></button>
                </div>
                <div class="modal-body">
                <table id="tbDocumentosList" class="table stripe table-hover " style="width:100%">
                            <thead>
                                <tr>
                                    <th colspan="10%" class="text-black text-start">Tipo</th>
                                    <th colspan="10%" class="text-black text-start">Documento</th>
                                </tr>
                            </thead>
                            <tbody id="tbDocumentosListBody">

                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</html>