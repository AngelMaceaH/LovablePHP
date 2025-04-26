<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
  <link rel="stylesheet" href="../../assets/vendors/dayrangepicker/index.css">
  <link rel="stylesheet" href="../../assets/css/flexselect.css">
  <style>
    .bg-adver {
      background-color: rgba(144, 0, 0, 0.1) !important;
      border: 2px solid rgb(144, 0, 0) !important;
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
          <span>Digitalización de documentos / Entregas</span>
        </li>
        <li class="breadcrumb-item active"><span>ZLO0033P</span></li>
      </ol>
    </nav>
  </div>
  </header>
  <div id="body-div" class="body flex-grow-3">
    <div class="card">
      <div class="card-header">
        <div class="row w-100">
          <div class="col-12">
            <h4 class="card-title text-center">Entrega de facturas</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="table-responsive bg-white p-3" style="height:100%">
      <div class="row mb-2">
        <div class="col-12 col-lg-7">
          <div class='d-flex justify-content-between'>
            <div class="form-check mt-2 mb-2 me-3">
              <input class="form-check-input" type="checkbox" value="" id="isRecib">
              <label class="form-check-label" for="isRecib">
                Mostrar recibidos
              </label>
            </div>
            <div class="form-check mt-2 mb-2">
              <input class="form-check-input" type="checkbox" value="" id="isAdmin">
              <label class="form-check-label" for="isAdmin">
                Mostrar solo facturas repetitivas
              </label>
            </div>
            <div class="form-check mt-2 mb-2">
              <input class="form-check-input" type="checkbox" value="" id="isUsuario">
              <label class="form-check-label" for="isUsuario">
                Mostrar solo facturas asignadas al usuario
              </label>
            </div>
          </div>
        </div>
        <div class="col-lg-3"></div>
        <div id="displaDiv" class="col-12 col-lg-2 d-none mt-2 mb-2">
          <button id="btnNuevo" class="btn btn-danger fw-bold text-white" style="width:100%"> Nuevo <i
              class="fa-solid fa-square-plus ms-2"></i></button>
        </div>
      </div>
      <table id="mainTable" class="table border border-1 shadow mt-3" style="width:100%">
        <thead class="table-light fw-semibold">
          <tr>
            <th style="width:10%;">No. Factura</th>
            <th>No. Orden</th>
            <th style="width:16%;">Fecha entregado</th>
            <th>Descripcion</th>
            <th>Entregado por</th>
            <th>Recibido por</th>
            <th style="width:1%;" class="text-end">Acciones</th>
            <th style="width:1%;">Estado</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
      <div class="mb-5"></div>
    </div>

  </div>
  </div>

  </div>
  <div class="footer bg-blck flex-grow-1 d-flex justify-content-center">
    <p class="bggray responsive-font-example"><i>Lovable de Honduras S.A. de C.V</i></p>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../../assets/vendors/dayrangepicker/index.umd.min.js"></script>
  <script src="../../assets/js/liquidmetal.js"></script>
  <script src="../../assets/js/jquery.flexselect.js"></script>
  <script>
    let table = null;
    let table2 = null;
    let proveedores = [];
    let optionUsuarios = "";
    let optionTiendas = "";
    let optionRepe = "";
    let user = '';
    let perfac = '';
    let isnew = 0;
    let ck = 0;
    let options = "";
    let urlTable = "";
    document.addEventListener('DOMContentLoaded', function () {
      user = "<?php echo isset($_SESSION['CODUSU']) ? $_SESSION['CODUSU'] : ''; ?>";
      perfac = "<?php echo isset($_SESSION['PERFAC']) ? $_SESSION['PERFAC'] : ''; ?>";
      if (perfac == 'S') {
        displaDiv.classList.remove('d-none');
      }
      isRecib.addEventListener('change', function () {
        ck1 = (isAdmin.checked) ? 1 : 0;
        ck2 = (this.checked) ? 1 : 0;
        ck3 = (isUsuario.checked) ? 1 : 0;
        urlTable = "/API.LovablePHP/ZLO0033P/ListDEV/?hora=" + ck1 + "&fecha=" + ck2 + "&horgra=" + ck3 + "&usua=" + user;
        table.ajax.url(urlTable).load();
      });
      isAdmin.addEventListener('change', function () {
        ck1 = (this.checked) ? 1 : 0;
        ck2 = (isRecib.checked) ? 1 : 0;
        ck3 = (isUsuario.checked) ? 1 : 0;
        urlTable = "/API.LovablePHP/ZLO0033P/ListDEV/?hora=" + ck1 + "&fecha=" + ck2 + "&horgra=" + ck3 + "&usua=" + user;
        table.ajax.url(urlTable).load();
      });
      isUsuario.addEventListener('change', function () {
        ck1 = (isAdmin.checked) ? 1 : 0;
        ck2 = (isRecib.checked) ? 1 : 0;
        ck3 = (this.checked) ? 1 : 0;
        urlTable = "/API.LovablePHP/ZLO0033P/ListDEV/?hora=" + ck1 + "&fecha=" + ck2 + "&horgra=" + ck3 + "&usua=" + user;
        table.ajax.url(urlTable).load();
      });
      btnNuevo.addEventListener('click', function () {
        $("#isrepet").prop("disabled", false);
        $("#btnEditar").addClass("d-none");
        reqModalLabel.innerHTML = 'Agregar una Factura';
        footerModal.innerHTML =
          `<button type="button" class="btn btn-secondary text-white fw-bold" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="button" id="btnSend" class="btn btn-primary text-white fw-bold" onclick="saveReq()">Guardar</button>
                                    <button type="button" id="btnLoad" class="btn btn-primary text-white fw-bold d-none" style="width:100px !important;"><i class="fa-solid fa-spinner fa-spin"></i></button>`;
        box1.innerHTML =
          `<input id="imagen" type="file" class="form-control" >`;
        document.getElementById('nreq').value = '';
        document.getElementById('orden').value = '';
        document.getElementById('fecha').value = new Date().toISOString().split('T')[0];
        document.getElementById('descrp').value = '';
        document.getElementById('entrega').value = "<?php echo isset($_SESSION['NOMUSU']) ? $_SESSION['NOMUSU'] : ''; ?>";
        document.getElementById('recibi').value = '';
        document.getElementById('imagen').value = '';
        document.getElementById('isrepet').checked = false;
        $("#recibi_flexselect").val('')
        $("#facturaDiv").empty();
        $("#facturaDiv").append(` <label for="descrp" class="form-control border border-0">Descripción <span
                  class="text-danger">(*)</span></label>
              <textarea id="descrp" placeholder="Ingrese una descripcion de la Factura" class="form-control" rows="5"
                style="height:150px; resize: none;"></textarea>`);
        $("#btnAgregar").addClass("d-none");

        $('#reqModal').modal('show');
      });
      $("#btnAgregar").on('click', () => {
        const btn = $("#btnAgregar");
        if (btn.text().trim().includes('Agregar')) {
          btn.text("Cancelar");
          btn.removeClass('btn-info');
          btn.addClass('btn-danger');
          isnew = 1;
        } else {
          btn.text("Agregar una nueva");
          btn.removeClass('btn-danger');
          btn.addClass('btn-info');
          isnew = 0;
        }
        $("#cbbDescrip").toggleClass('d-none');
        $("#cbbDescrip_flexselect").toggleClass('d-none');
        $("#descrp").toggleClass('d-none');
      });
      $("#btnEditar").on('click', () => {
        const btn = $("#btnEditar");
        if (btn.text().trim().includes('Editar')) {
          btn.text("Cancelar");
          btn.removeClass('btn-warning');
          btn.addClass('btn-danger');
        } else {
          btn.text("Editar");
          btn.removeClass('btn-danger');
          btn.addClass('btn-warning');
        }
        $("#cbbDescrip").toggleClass('d-none');
        $("#cbbDescrip_flexselect").toggleClass('d-none');
        $("#descrp").toggleClass('d-none');
        $("#descrp").val($("#txtEditar").val());
      });

      isrepet.addEventListener('change', () => {
        let urlRepe = "http://172.16.15.20/API.LovablePHP/ZLO0033P/ListRepe/";
        fetch(urlRepe)
          .then((response) => response.json())
          .then((data) => {
            if (data.code == 200) {
              let responseData = data.data;
              optionRepe = `<option value="" disabled selected></option>`;
              responseData.forEach((usuario) => {
                optionRepe += `<option value="${usuario.DESCRP}">${usuario.DESCRP}</option>`;
              });
            } else {
              console.log(data.message);
            }
          }).then(() => {
            let check = document.getElementById('isrepet');
            $("#facturaDiv").empty();
            if (check.checked) {
              const btn = $("#btnAgregar");
              btn.text("Agregar una nueva");
              btn.removeClass('btn-danger');
              btn.addClass('btn-info');
              isnew = 0;
              $("#facturaDiv").append(`<div class="row">
                <div class="col-6">
                  <label  class="form-control border border-0">Descripcion 1</label>
                  <select class="form-select" id="cbbDescrip">
                      ${optionRepe}
                  </select>
                  <input type="text" id="descrp" class="form-control d-none" placeholder=""/>
                </div>
                <div class="col-6">
                  <label for="valor" class="form-control border border-0">Descripción 2</label>
                  <input id="valor" type="text" maxlength="30" class="form-control"
                    placeholder="Ingrese la descripción del valor">
                </div>
              </div>`);
              $("#cbbDescrip").flexselect();
              $("#btnAgregar").removeClass("d-none");
            } else {
              $("#facturaDiv").append(` <label for="descrp" class="form-control border border-0">Descripción 2<span
                  class="text-danger">(*)</span></label>
              <textarea id="descrp" placeholder="Ingrese una descripcion 2" class="form-control" rows="5"
                style="height:150px; resize: none;"></textarea>`);
              $("#btnAgregar").addClass("d-none");
            }
            $("#facturaDiv").append(`<input type="input" class="d-none" placeholder="descripcion de edicion" id="txtEditar" />`)
          })


      })
      $('#mainTable thead th').each(function () {
        var title = $(this).text();
        if (title != 'Acciones' && title != 'Estado' && title != 'Proveedor' && title != 'Fecha entregado') {
          $(this).html(title + '<br /><input type="text" placeholder="Buscar..." class="form-control mt-2"/>');
        } else {
          if (title == 'Fecha entregado') {
            $(this).html(title +
              `<br /> <input type="text" placeholder="Buscar..." class="form-control mt-2"  id="FechasDocs" onclick="showRange()"/>`
            );
          } else {
            $(this).html('');
          }
        }
      });
      let urlTiendas = "http://172.16.15.20/API.LovablePHP/ZLO0033P/ListTiendas/";
      fetch(urlTiendas)
        .then((response) => response.json())
        .then((data) => {
          if (data.code == 200) {
            let responseData = data.data;
            optionTiendas = `<option value=""></option>`;
            responseData.forEach((usuario) => {
              optionTiendas += `<option value="${usuario.COMCOD}">${usuario.COMDES}</option>`;
            });
          } else {
            console.log(data.message);
          }
        });


      let urlUsuarios =
        "http://172.16.15.20/API.LovablePHP/ZLO0033P/ListUsua/";
      fetch(urlUsuarios)
        .then((response) => response.json())
        .then((data) => {
          if (data.code == 200) {
            let responseData = data.data;
            optionUsuarios = `<option value=""></option>`;
            responseData.forEach((usuario) => {
              optionUsuarios += `<option value="${usuario.CODUSU}">${usuario.CODUSU}</option>`;
            });
            $("#recibi").empty();
            $("#recibi").append(optionUsuarios);
            $("#recibi").flexselect();
          } else {
            console.log(data.message);
          }
        });
      setTimeout(() => {
        ck1 = (isAdmin.checked) ? 1 : 0;
        ck2 = (isRecib.checked) ? 1 : 0;
        ck3 = (isUsuario.checked) ? 1 : 0;
        urlTable = "/API.LovablePHP/ZLO0033P/ListDEV/?hora=" + ck1 + "&fecha=" + ck2 + "&horgra=" + ck3 + "&usua=" + user;
        console.log(urlTable);
        table = $('#mainTable').DataTable({
          language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
          },
          "ordering": false,
          "processing": true,
          "serverSide": true,
          "pageLength": 50,
          "ajax": {
            "url": urlTable,
            "type": "POST",
            "dataSrc": function (json) {
              if (json.data) {
                console.log(json);
                return json.data;
              } else {
                console.error(json);
                return [];
              }
            },
            "data": function (d) {
              d.columns = [];
              $('#mainTable thead th input').each(function (i) {
                d.columns.push({
                  'search': {
                    'value': $(this).val()
                  }
                });
              });
            },
          },
          "columns": [{
            "data": "NUMREQ"
          },
          {
            "data": null,
            "render": function (data, type, row) {
              if (row.NUMORD == 0) {
                return '';
              } else {
                return row.NUMORD;
              }
            },
          },
          {
            "data": null,
            "render": function (data, type, row) {
              return formatFecha(data.FECREQ, 2) + '&nbsp;&nbsp;' + formatHora(data.HORGRA);
            },
          },
          {
            "data": "DESCRP"
          },
          {
            "data": "ENTREG"
          },
          {
            "data": null,
            "render": function (data, type, row) {
              return data.USUREC + '<br>' + formatFecha(data.FECREC, 2) + ' ' + formatHora(data.HORREC);
            },
          },
          {
            "data": null,
            className: 'text-center',
            "render": function (data, type, row) {
              let buttons = '';
              if (data.ADVER != 1) {
                switch (user) {
                  case 'MARVIN':
                    if (row.IMAGEN == '') {

                      buttons = `<div class="dropdown text-end">
                                        <button class="btn btn-light p-1" type="button" data-coreui-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical fs-5"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                            <a class="dropdown-item fw-bold" onclick="checkReq('${data.NUMREQ}','${data.FECGRA}','${data.HORGRA}')">Marcar recibido &nbsp;&nbsp;<i class="fa-solid fa-square-check"></i></a>
                                            <a class="dropdown-item fw-bold" onclick="findReq('${data.NUMREQ}','${data.FECGRA}','${data.HORGRA}')">Editar <i class="fa-solid fa-pen-to-square"></i></a>
                                            <a class="dropdown-item fw-bold text-danger" onclick="deleteConfirm('${data.NUMREQ}','${data.FECGRA}','${data.HORGRA}')">Eliminar <i class="fa-solid fa-trash"></i></a>
                                        </div>
                                    </div>`;
                    } else {
                      buttons = `<div class="dropdown text-end">
                                        <button class="btn btn-light p-1" type="button" data-coreui-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical fs-5"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                            <a class="dropdown-item fw-bold" onclick="checkReq('${data.NUMREQ}','${data.FECGRA}','${data.HORGRA}')">Marcar recibido &nbsp;&nbsp;<i class="fa-solid fa-square-check"></i></a>
                                            <a class="dropdown-item fw-bold" onclick="showImg('${data.IMAGEN}','${data.FECGRA}','${data.HORGRA}','${data.USUREC}','${data.FECREC}','${data.HORREC}','${data.ESTADO}')">Ver imagen <i class="fa-solid fa-images"></i></a>
                                            <a class="dropdown-item fw-bold" onclick="findReq('${data.NUMREQ}','${data.FECGRA}','${data.HORGRA}')">Editar <i class="fa-solid fa-pen-to-square"></i></a>
                                            <a class="dropdown-item fw-bold text-danger" onclick="deleteConfirm('${data.NUMREQ}','${data.FECGRA}','${data.HORGRA}')">Eliminar <i class="fa-solid fa-trash"></i></a>
                                        </div>
                                    </div>`;
                    }
                    break;
                  default:
                    if (perfac == 'S') {
                      let buttonsMarcar2 = '';
                      if (data.RECIBI.toLowerCase().includes(user.toLowerCase())) {
                        buttonsMarcar2 = `<a class="dropdown-item fw-bold" onclick="checkReq('${data.NUMREQ}','${data.FECGRA}','${data.HORGRA}')">Marcar recibido &nbsp;&nbsp;<i class="fa-solid fa-square-check"></i></a>`;
                      }
                      let buttonsEliminar = '';
                      if (data.ENTREG.toLowerCase().includes(user.toLowerCase())) {
                        buttonsEliminar = `<a class="dropdown-item fw-bold" onclick="findReq('${data.NUMREQ}','${data.FECGRA}','${data.HORGRA}')">Editar <i class="fa-solid fa-pen-to-square"></i></a>
                                  <a class="dropdown-item fw-bold text-danger" onclick="deleteConfirm('${data.NUMREQ}','${data.FECGRA}','${data.HORGRA}')">Eliminar <i class="fa-solid fa-trash"></i></a>`
                      }
                      if (row.IMAGEN == '') {

                        buttons = `<div class="dropdown text-end">
                                              <button class="btn btn-light p-1" type="button" data-coreui-toggle="dropdown" aria-haspopup="true"
                                                  aria-expanded="false">
                                                  <i class="fa-solid fa-ellipsis-vertical fs-5"></i>
                                              </button>
                                              <div class="dropdown-menu dropdown-menu-end" style="">
                                                  ${buttonsMarcar2}
                                                  ${buttonsEliminar}
                                              </div>
                                          </div>`;
                      } else {
                        buttons = `<div class="dropdown text-end">
                                              <button class="btn btn-light p-1" type="button" data-coreui-toggle="dropdown" aria-haspopup="true"
                                                  aria-expanded="false">
                                                  <i class="fa-solid fa-ellipsis-vertical fs-5"></i>
                                              </button>
                                              <div class="dropdown-menu dropdown-menu-end" style="">
                                                  ${buttonsMarcar2}
                                                  <a class="dropdown-item fw-bold" onclick="showImg('${data.IMAGEN}','${data.FECGRA}','${data.HORGRA}','${data.USUREC}','${data.FECREC}','${data.HORREC}','${data.ESTADO}')">Ver imagen <i class="fa-solid fa-images"></i></a>
                                                  ${buttonsEliminar}
                                              </div>
                                          </div>`;
                      }
                    } else {
                      let buttonsMarcar = '';
                      if (row.IMAGEN == '') {
                        if (row.ESTADO == 0) {
                          if (data.RECIBI.toLowerCase().includes(user.toLowerCase())) {
                            buttons = `<div class="dropdown text-end">
                                              <button class="btn btn-light p-1" type="button" data-coreui-toggle="dropdown" aria-haspopup="true"
                                                  aria-expanded="false">
                                                  <i class="fa-solid fa-ellipsis-vertical fs-5"></i>
                                              </button>
                                              <div class="dropdown-menu dropdown-menu-end" style="">
                                                  <a class="dropdown-item fw-bold" onclick="checkReq('${data.NUMREQ}','${data.FECGRA}','${data.HORGRA}')">Marcar recibido &nbsp;&nbsp;<i class="fa-solid fa-square-check"></i></a>
                                              </div>
                                          </div>`;
                          }


                        }
                      } else {
                        if (data.RECIBI.toLowerCase().includes(user.toLowerCase())) {
                          buttonsMarcar = ` <a class="dropdown-item fw-bold" onclick="checkReq('${data.NUMREQ}','${data.FECGRA}','${data.HORGRA}')">Marcar recibido &nbsp;&nbsp;<i class="fa-solid fa-square-check"></i></a>`;
                        }
                        if (row.ESTADO == 0) {
                          buttons = `<div class="dropdown text-end">
                                            <button class="btn btn-light p-1" type="button" data-coreui-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical fs-5"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" style="">
                                                ${buttonsMarcar}
                                                <a class="dropdown-item fw-bold" onclick="showImg('${data.IMAGEN}','${data.FECGRA}','${data.HORGRA}','${data.USUREC}','${data.FECREC}','${data.HORREC}','${data.ESTADO}')">Ver imagen <i class="fa-solid fa-images"></i></a>
                                            </div>
                                        </div>`;
                        } else {
                          buttons = `<div class="dropdown text-end">
                                            <button class="btn btn-light p-1" type="button" data-coreui-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical fs-5"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" style="">
                                                <a class="dropdown-item fw-bold" onclick="showImg('${data.IMAGEN}','${data.FECGRA}','${data.HORGRA}','${data.USUREC}','${data.FECREC}','${data.HORREC}','${data.ESTADO}')">Ver imagen <i class="fa-solid fa-images"></i></a>
                                            </div>
                                        </div>`;
                        }
                      }
                    }


                    break;
                }
              }
              return buttons;
            },
          },
          {
            "data": null,
            "render": function (data, type, row) {
              if (data.ESTADO == 1) {
                return `<span class="badge bg-success mb-2" style="width:100%;">Recibido</span>`;
              }
              return ` `;
            },
          }],
          "rowCallback": function (row, data, index) {
            if (data.ADVER == 1) {
              $(row).addClass('bg-adver');
            }
          },
          dom: 'tip',
        });
      }, 50);
      $('#mainTable thead input').on('keyup', function () {
        var columnIndex = $(this).parent().index();
        var inputValue = $(this).val().trim();
        if (table.column(columnIndex).search() !== inputValue) {
          table
            .column(columnIndex)
            .search(inputValue)
            .draw();
        }
      });
      setTimeout(() => {
        const fechaActual = new Date();
        const añoActual = fechaActual.getFullYear();
        const mesActual = fechaActual.getMonth();
        const primerDia = new Date(añoActual, mesActual, 1);
        const ultimoDia = new Date(añoActual, mesActual + 1, 0);

        const formatoFecha = (fecha) => {
          const dia = String(fecha.getDate()).padStart(2, '0');
          const mes = String(fecha.getMonth() + 1).padStart(2, '0'); // mes + 1 porque está en base 0
          const año = fecha.getFullYear();
          return `${dia}/${mes}/${año}`;
        };
        const fechaInicial = formatoFecha(primerDia);
        const fechaFinal = formatoFecha(ultimoDia);
        const rangeFecha = `${fechaInicial} - ${fechaFinal}`;
        $("#FechasDocs").val(rangeFecha);
        table
          .column(1)
          .search(rangeFecha)
          .draw();
      }, 150);
    });

    function sendForm() {
      var rangeDocumento = $('#datepicker2').val();
      $("#FechasDocs").val(rangeDocumento);
      table
        .column(1)
        .search(rangeDocumento)
        .draw();
    }

    function deleteDate() {
      $('#modalRangeDocumento').modal('hide')
      $("#FechasDocs").val("");
      table
        .column(1)
        .search('')
        .draw();
    }

    function showRange() {
      $("#dayRange").empty();
      var currentDate = new Date().toISOString().split('T')[0];
      Date1 = currentDate.substr(0, 10);
      Date2 = currentDate.substr(13, 10);
      var fechasActual = $("#FechasDocs").val();
      if (fechasActual != "") {

        Date1 = fechasActual.substr(0, 10);
        Date2 = fechasActual.substr(13, 10);
      }
      $("#dayRange").append(`<div class="input-group mt-1">
                                            <input class="form-control" id="datepicker2" name="datepicker2"/>
                                            <span class="input-group-text" id="basic-addon2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                            </svg></span>
                                            </div>`);
      const picker2 = new easepick.create({
        element: "#datepicker2",
        css: ["../../assets/vendors/dayrangepicker/index.css"],
        zIndex: 10,
        plugins: ["RangePlugin"]
      });

      $("#modalRangeDocumento").modal('show');
    }

    function saveReq() {
      let nreq = document.getElementById('nreq').value;
      let nord = document.getElementById('orden').value;
      let fecha = document.getElementById('fecha').value;
      let descrp = document.getElementById('descrp').value;
      let entrega = document.getElementById('entrega').value;
      let recibi = document.getElementById('recibi').value;
      let imagen = document.getElementById('imagen').files[0];
      let check = document.getElementById('isrepet');
      let cia = 1; let valor = 0;
      let isrepet = (check.checked) ? 1 : 0;
      if (isrepet == 1) {
        if (isnew == 0) {
          //const cbb = document.getElementById('cbbDescrip');
          //descrp = cbb.options[cbb.selectedIndex].text;
          descrp = $("#cbbDescrip_flexselect").val();
        }
        valor = document.getElementById('valor').value;
      }
      if (nreq == '' || fecha == '' || entrega == '') {
        lblError.classList.remove('d-none');
      } else {
        lblError.classList.add('d-none');
        let dataSave = {
          nreq: nreq,
          nord: (nord == '') ? 0 : nord,
          fecha: formatFecha(fecha, 0),
          descrp: descrp,
          cia: cia,
          valor: valor,
          isrepet: isrepet,
          isnew: isnew,
          prove1: 0,
          prove2: 0,
          entrega: entrega,
          recibi: recibi,
          base64: "",
          exten: "",
          fecgra: currentDate(),
          horgra: currentTime(),
        };
        let url = "/API.LovablePHP/ZLO0033P/SaveDocument/";
        if (imagen) {
          dataSave.exten = imagen.type.split('/')[1];
          blobToBase64(imagen, (base64) => {
            dataSave.base64 = base64;
            fetchData(url, dataSave);
          });
        } else {
          fetchData(url, dataSave);
        }
      }
    }

    function deleteConfirm(numreq, fecgra, horgra) {
      Swal.fire({
        title: '¿Está seguro de eliminar la Factura?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          deleteReq(numreq, fecgra, horgra);
        }
      });
    }

    function deleteReq(numreq, fecgra, horgra) {
      let url = `/API.LovablePHP/ZLO0033P/Del/?numreq=${numreq}&fecgra=${fecgra}&horgra=${horgra}`;
      fetch(url, {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json'
        }
      }).then(response => {
        return response.json();
      }).then(data => {
        if (data.code == 200) {
          $('#mainTable').DataTable().ajax.reload();
        } else {
          console.log(data.message);
        }
      });
    }

    function findReq(numreq, fecgra, horgra) {
      const btn = $("#btnEditar");
      btn.text("Editar");
      btn.removeClass('btn-danger');
      btn.addClass('btn-warning');
      btn.addClass('d-none');
      $("#facturaDiv").empty();
      $("#facturaDiv").append(` <label for="descrp" class="form-control border border-0">Descripción <span
                  class="text-danger">(*)</span></label>
              <textarea id="descrp" placeholder="Ingrese una descripcion de la Factura" class="form-control" rows="5"
                style="height:150px; resize: none;"></textarea>`);
      reqModalLabel.innerHTML = 'Actualizar una Factura';
      footerModal.innerHTML =
        `<button type="button" class="btn btn-secondary text-white fw-bold" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="button" id="btnSend" class="btn btn-primary text-white fw-bold" onclick="updateReq()">Actualizar</button>
                                    <button type="button" id="btnLoad" class="btn btn-primary text-white fw-bold d-none" style="width:100px !important;"><i class="fa-solid fa-spinner fa-spin"></i></button>`;
      box1.innerHTML = ``;
      /*ENCONTRANDO*/
      let url = `/API.LovablePHP/ZLO0033P/Find/?numreq=${numreq}&fecgra=${fecgra}&horgra=${horgra}`;
      fetch(url, {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json'
        }
      }).then(response => {
        return response.json();
      }).then(data => {
        if (data.code == 200) {
          let req = data.data[0];
          document.getElementById('nreq1').value = req.NUMREQ;
          document.getElementById('orden').value = req.NUMORD;
          document.getElementById('fecgra1').value = req.FECGRA;
          document.getElementById('horgra1').value = req.HORGRA;
          document.getElementById('nreq').value = req.NUMREQ;
          document.getElementById('fecha').value = formatFecha(req.FECREQ, 1);
          document.getElementById('descrp').value = req.DESCRP;
          document.getElementById('entrega').value = req.ENTREG;
          $("#recibi").val(req.RECIBI).trigger('change');
          $("#isrepet").prop("disabled", false);
          document.getElementById('isrepet').checked = false;
          if (req.ESREPE == 1) {
            $("#isrepet").trigger("click")
            $("#btnEditar").removeClass("d-none");
            setTimeout(() => {
              $("#cbbDescrip").val(req.DESCRP2);
              $("#cbbDescrip_flexselect").val(req.DESCRP2);
              $("#valor").val(req.VALOR);
              $("#txtEditar").val(req.DESCRP2);
            }, 1000);
          }
          $("#isrepet").prop("disabled", true);
          if (req.IMAGEN != '') {
            if (req.IMAGEN.includes('pdf')) {
              let pdf = document.createElement('embed');
              pdf.src = `http://172.16.15.20${req.IMAGEN}`;
              pdf.style.width = '100%';
              pdf.style.height = '70vh';
              box1.innerHTML = '';
              box1.innerHTML = `<div class="row mb-1">
                                    <div class="col-12 text-end">
                                        <button class="btn btn-danger text-white" onclick="deleteImg()">Eliminar <i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>`;
              box1.appendChild(pdf);
              imgUrl.value = req.IMAGEN;
            } else {
              let img = document.createElement('img');
              img.src = `http://172.16.15.20${req.IMAGEN}`;
              img.style.width = '100%';
              img.style.height = '100%';
              box1.innerHTML = '';
              box1.innerHTML = `<div class="row mb-1">
                                    <div class="col-12 text-end">
                                        <button class="btn btn-danger text-white" onclick="deleteImg()">Eliminar <i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </div>`;
              box1.appendChild(img);
              imgUrl.value = req.IMAGEN;
            }
          } else {
            box1.innerHTML =
              `<input id="imagen" type="file" class="form-control" >`;
          }
          setTimeout(() => {
            $("#btnAgregar").addClass("d-none");
          }, 300);
          $('#reqModal').modal('show');
        } else {
          console.log(data.message);
        }
      });
    }

    function checkReq(numreq, fecgra, horgra) {
      let fecha = currentDate();
      let hora = currentTime();
      let url = `/API.LovablePHP/ZLO0033P/Check/?numreq=${numreq}&fecgra=${fecgra}&horgra=${horgra}&usua=${user}&fecha=${fecha}&hora=${hora}`;
      fetch(url, {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json'
        }
      }).then(response => {
        return response.json();
      }).then(data => {
        if (data.code == 200) {
          $('#mainTable').DataTable().ajax.reload();
        }
      });
    }

    function updateReq() {
      const nreq1 = document.getElementById('nreq1').value;
      const fecgra1 = document.getElementById('fecgra1').value;
      const horgra1 = document.getElementById('horgra1').value;
      let nord = document.getElementById('orden').value;
      let nreq = document.getElementById('nreq').value;
      let fecha = document.getElementById('fecha').value;
      let descrp = document.getElementById('descrp').value;
      let entrega = document.getElementById('entrega').value;
      let recibi = document.getElementById('recibi').value;
      let imagenUrl = document.getElementById('imgUrl').value;
      let imagen = ""
      if (imagenUrl == '') {
        imagen = document.getElementById('imagen').files[0];
      }
      let check = document.getElementById('isrepet');
      let isrepet = (check.checked) ? 1 : 0;
      let cia = 1; let valor = 0; let descrpOriginal = "";
      if (isrepet == 1) {
        valor = document.getElementById('valor').value;
        descrpOriginal = document.getElementById('txtEditar').value;
        if (descrp == "") {
          //const cbb = document.getElementById('cbbDescrip');
          //descrp = cbb.options[cbb.selectedIndex].text;
          descrp = $("#cbbDescrip_flexselect").val();
        }
      }
      if (nreq == '' || fecha == '' || entrega == '') {
        lblError.classList.remove('d-none');
      } else {
        lblError.classList.add('d-none');
        let dataSave2 = {
          nreq1: nreq1,
          fecgra1: fecgra1,
          horgra1: horgra1,
          nreq: nreq,
          nord: (nord == '') ? 0 : nord,
          fecha: formatFecha(fecha, 0),
          descrp: descrp,
          descrpOriginal: descrpOriginal,
          cia: cia,
          valor: valor,
          isrepet: isrepet,
          prove1: 0,
          prove2: 0,
          entrega: entrega,
          recibi: recibi,
          imgUrl: imagenUrl,
          base64: "",
          exten: "",
          fecgra: currentDate(),
          horgra: currentTime(),
        };
        let url = "/API.LovablePHP/ZLO0033P/UpdateDocument/";
        if (imagen) {
          dataSave2.exten = imagen.type.split('/')[1];
          blobToBase64(imagen, (base64) => {
            dataSave2.base64 = base64;
            fetchData(url, dataSave2);
          });
        } else {
          fetchData(url, dataSave2);
        }
      }
    }

    function fetchData(url, dataSave) {
      $("#btnSend").addClass("d-none");
      $("#btnLoad").removeClass("d-none");
      setTimeout(() => {
        fetch(url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(dataSave)
        }).then(response => {
          return response.json();
        }).then(data => {
          if (data.code == 200) {
            $("#btnSend").removeClass("d-none");
            $("#btnLoad").addClass("d-none");
            $('#reqModal').modal('hide');
            $('#mainTable').DataTable().ajax.reload();
          } else {
            console.log(data.message);
          }
        });
      }, 500);
    }

    function blobToBase64(blob, callback) {
      const reader = new FileReader();
      reader.onload = function () {
        const dataUrl = reader.result;
        const base64String = dataUrl.split(',')[1];
        callback(base64String);
      };
      reader.readAsDataURL(blob);
    }

    function deleteImg() {
      Swal.fire({
        title: '¿Está seguro de eliminar la imagen?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          box1.innerHTML =
            `<input id="imagen" type="file" class="form-control" >`;
          imgUrl.value = '';
        }
      });
    }

    function formatFecha(fecha, formato) {
      if (fecha == '' || fecha == null || fecha == 0) {
        return '';
      } else {
        let year = fecha.substring(0, 4);
        let month = fecha.substring(4, 6);
        let day = fecha.substring(6, 8);
        switch (formato) {
          case 1:
            fecha = year + "-" + month + "-" + day;
            break;
          case 2:
            fecha = day + "/" + month + "/" + year;
            break;
          default:
            fecha = fecha.replace(/-/g, '');
            break;
        }
        return fecha;
      }
    }

    function showImg(imagen, fecgra, horgra, usurec, fecrecibido, horrecibido, estado) {
      let fecha = formatFecha(fecgra.toString(), 2);
      let hora = formatHora(horgra);
      if (estado == '0') {
        divRecibido.classList.add('d-none');
      } else {
        divRecibido.classList.remove('d-none');
        let fecha = formatFecha(fecrecibido.toString(), 2);
        let hora = horrecibido.substring(0, 2) + ':' + horrecibido.substring(2, 4) + ':' + horrecibido.substring(4, 6);
        usuaRec.innerHTML = usurec;
        fechaRec.innerHTML = fecha;
        horaRec.innerHTML = hora;
      }
      fechaGra.innerHTML = fecha;
      horaGra.innerHTML = hora;
      if (imagen.includes('pdf')) {
        if (/Mobi|Android/i.test(navigator.userAgent)) {
          window.open(`http://172.16.15.20${imagen}`, '_blank');
        } else {
          let pdf = document.createElement('embed');
          pdf.src = `http://172.16.15.20${imagen}#zoom=125`;
          pdf.style.width = '100%';
          pdf.style.height = '85vh';
          box2.innerHTML = '';
          box2.appendChild(pdf);
        }
      } else {
        let img = document.createElement('img');
        img.src = `http://172.16.15.20${imagen}`;
        img.style.width = '100%';
        img.style.height = '85vh';
        box2.innerHTML = '';
        box2.appendChild(img);
      }
      $('#imgModal').modal('show');
    }

    function currentTime() {
      const fecha = new Date();
      const horas = fecha.getHours().toString().padStart(2, "0");
      const minutos = fecha.getMinutes().toString().padStart(2, "0");
      const segundos = fecha.getSeconds().toString().padStart(2, "0");
      const horaActual = horas + minutos + segundos;
      return horaActual;
    }

    function currentDate() {
      const fecha = new Date();
      const año = fecha.getFullYear();
      const mes = (fecha.getMonth() + 1).toString().padStart(2, "0");
      const dia = fecha.getDate().toString().padStart(2, "0");
      const fechaActual = año.toString() + mes + dia;
      return fechaActual;
    }

    function formatHora(hora) {
      if (hora.length < 6) {
        hora = '0' + hora;
      }
      const hour24 = parseInt(hora.substring(0, 2), 10);
      const minute = hora.substring(2, 4);
      const ampm = hour24 < 12 ? "AM" : "PM";
      let hour12 = hour24 % 12;
      if (hour12 === 0) hour12 = 12;
      if (hora != 0) {
        return `${hour12}:${minute} ${ampm}`;
      } else {
        return "";
      }
    }
  </script>
  <div class="modal fade" id="reqModal" tabindex="-1" aria-labelledby="reqModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="reqModalLabel"></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 col-lg-6">
              <label for="nreq" class="form-control border border-0">N. Factura <span class="text-danger">(*)</span>
              </label>
              <input id="nreq1" type="text" class="d-none">
              <input id="fecgra1" type="text" class="d-none">
              <input id="horgra1" type="text" class="d-none">
              <input id="nreq" type="text" maxlength="10" class="form-control" placeholder="Ingrese la Factura">
            </div>
            <div class="col-12 col-lg-6">
              <label for="nreq" class="form-control border border-0">N. Orden <span class="text-danger">(*)</span>
              </label>
              <input id="orden" type="text" maxlength="10" class="form-control" placeholder="Ingrese la orden">
            </div>
            <div class="col-12 col-lg-12">
              <label for="fecha" class="form-control border border-0">Fecha de entrega <span
                  class="text-danger">(*)</span></label>
              <input id="fecha" type="date" class="form-control">
            </div>
            <div class="col-12 mt-4">
              <div class="row">
                <div class="col-9">
                  <div class="form-check ">
                    <input class="form-check-input" type="checkbox" value="" id="isrepet">
                    <label class="form-check-label" for="isrepet">
                      Es una factura repetitiva
                    </label>
                  </div>
                </div>
                <div class="col-3 d-flex justify-content-end">
                  <button class="btn btn-info fw-bold text-white w-100 d-none" id="btnAgregar">Agregar una
                    nueva</button>
                  <button class="btn btn-warning fw-bold text-white w-100 d-none" id="btnEditar">Editar</button>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-12 mt-2" id="facturaDiv">
              <label for="descrp" class="form-control border border-0">Descripción <span
                  class="text-danger">(*)</span></label>
              <textarea id="descrp" placeholder="Ingrese una descripcion de la Factura" class="form-control" rows="5"
                style="height:150px; resize: none;"></textarea>
            </div>
            <div class="col-12 col-lg-12 mt-2">
              <label for="entrega" class="form-control border border-0">Entregado por <span
                  class="text-danger">(*)</span></label>
              <input id="entrega" type="text" maxlength="30" class="form-control"
                placeholder="Ingrese el entregado por">
            </div>
            <div class="col-12 col-lg-12 mt-2">
              <label for="recibi" class="form-control border border-0">Asignado por<span
                  class="text-danger">(*)</span></label>
              <select class="form-select" name="" id="recibi">
                <option value=""></option>
              </select>
            </div>
            <div class="col-12 col-lg-12 mt-2 text-center">
              <span id="lblError" class="fw-bold text-danger text-center mt-2 d-none">Rellene todos los campos</span>
              <hr>
              <label for="imagen" class="form-control border border-0 text-start">Imagen</label>
              <input type="text" id="imgUrl" class="d-none">
              <div id="box1">

              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer" id="footerModal">

        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="imgModal" tabindex="-1" aria-labelledby="reqModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-6">
            Fecha grabado: <span id="fechaGra"></span> <br>
            Hora grabado: <span id="horaGra"></span>
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="height:95vh;">
          <div class="row">
            <div class="col-12 text-center" id="box2">

            </div>
            <div class="col-12" id="divRecibido">
              <div class="row mt-3">
                <div class="col-12 mb-2">
                  <label class="form-control">Usuario recibido: <span id="usuaRec"></span></label>
                </div>
                <div class="col-12">
                  <label class="form-control">Fecha recibido: <span id="fechaRec"></span> <span
                      id="horaRec"></span></label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modalRangeDocumento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Selecciona un rango de fechas</h1>

          <button type="button" class="btn-close" onclick="$('#modalRangeDocumento').modal('hide')"></button>
        </div>
        <div class="modal-body">
          <label class="me-3">Fecha de Factura</label>
          <div id="dayRange">

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger fw-bold text-white" onclick="deleteDate()">Cancelar</button>
          <button type="button" class="btn btn-primary fw-bold text-white"
            onclick="$('#modalRangeDocumento').modal('hide')">Aceptar</button>
        </div>
      </div>
    </div>
  </div>
</body>

</html>