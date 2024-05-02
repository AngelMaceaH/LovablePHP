<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
  <link rel="stylesheet" href="../../assets/vendors/dayrangepicker/index.css">
  <link rel="stylesheet" href="../../assets/css/flexselect.css">
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
        <li class="breadcrumb-item active"><span>ZLO0032P</span></li>
      </ol>
    </nav>
  </div>
  </header>
  <div id="body-div" class="body flex-grow-3">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title text-center">Entrega de requisiciones</h4>
      </div>
    </div>
    <div class="table-responsive bg-white p-3" style="height:100%">
      <div class="row mb-2">
        <div class="col-12 col-lg-10">
          <div class="form-check mt-2 mb-2 d-none">
            <input class="form-check-input" type="checkbox" value="" id="isAdmin">
            <label class="form-check-label" for="isAdmin">
              Mostrar solo facturas repetitivas
            </label>
          </div>
        </div>
        <div id="displaDiv" class="col-12 col-lg-2 d-none mt-2 mb-2">
          <button id="btnNuevo" class="btn btn-danger fw-bold text-white" style="width:100%"> Nuevo <i
              class="fa-solid fa-square-plus ms-2"></i></button>
        </div>
      </div>
      <table id="mainTable" class="table border border-1 shadow mt-3" style="width:100%">
        <thead class="table-light fw-semibold">
          <tr>
            <th style="width:9%;">No. Requisición</th>
            <th style="width:11%;">Fecha</th>
            <th style="width:18%;">Descripcion</th>
            <th style="width:14%;">Solicitante</th>
            <th style="width:17%;">Departamento</th>
            <th style="width:14%;">Entregado por</th>
            <th style="width:15%;">Recibido por</th>
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
  let departamentos = [];
  let user = '';
  let ck = 0;
  let options = "";
  let urlTable = "";
  document.addEventListener('DOMContentLoaded', function() {
    user = "<?php echo isset($_SESSION['CODUSU'])? $_SESSION['CODUSU']: ''; ?>";
    if (user == 'MARVIN') {
      displaDiv.classList.remove('d-none');
    }
    isAdmin.addEventListener('change', function() {
      ck = (this.checked) ? 1 : 0;
      console.log(ck);
      urlTable = "/API.LovablePHP/ZLO0032P/List/?hora=" + ck;
      table.ajax.url(urlTable).load();
    });
    btnNuevo.addEventListener('click', function() {
      reqModalLabel.innerHTML = 'Agregar una requisición';
      footerModal.innerHTML =
        `<button type="button" class="btn btn-secondary text-white fw-bold" data-bs-dismiss="modal">Cerrar</button>
                                 <button type="button" class="btn btn-primary text-white fw-bold" onclick="saveReq()">Guardar</button>`;
      box1.innerHTML =
        `<input id="imagen" type="file" class="form-control" accept="image/png, image/jpeg, image/gif">`;
      document.getElementById('nreq').value = '';
      document.getElementById('fecha').value = '';
      document.getElementById('descrp').value = '';
      document.getElementById('soli').value = '';
      document.getElementById('depa').value = '';
      document.getElementById('entrega').value = '';
      document.getElementById('recibi').value = '';
      document.getElementById('imagen').value = '';
      document.getElementById('isrepet').checked = false;
      $('#reqModal').modal('show');
    });
    const urlDepas = "/API.LOVABLEPHP/ZLO0015P/ListDepas/";
    let responseDepas = ajaxRequest(urlDepas);
    if (responseDepas.code == 200) {
      departamentos = responseDepas.data;
      departamentos.forEach(depa => {
        options += `<option value="${depa.SECDEP + '-' + depa.SECCOD}">${depa.SECDES}</option>`;
      });
      $("#depa").append(options);
      $("#depa").flexselect();
    } else {
      console.log(responseDepas.message);
    }


    $('#mainTable thead th').each(function() {
      var title = $(this).text();
      if (title != 'Acciones' && title != 'Estado' && title != 'Departamento' && title != 'Fecha') {
        $(this).html(title + '<br /><input type="text" placeholder="Buscar..." class="form-control mt-2"/>');
      } else {
        if (title == 'Fecha') {
          $(this).html(title +
            `<br /> <input type="text" placeholder="Buscar..." class="form-control mt-2"  id="FechasDocs" onclick="showRange()"/>`
          );
        } else if (title == 'Departamento') {
          $(this).html(title + `<br />  <select id="srcDepa" class="form-select mt-1">
                                            <option value=""></option>
                                        </select>
                                       `);
          /* <input type="text" id="srcDepatxt" class="d-none"/>*/
          $("#srcDepa").append(options);
          $("#srcDepa").flexselect();
          $("#srcDepa").on('change', function() {
            table.column(5).search(this.value).draw();
          });

        } else {
          $(this).html('');
        }
      }
    });
    setTimeout(() => {
      urlTable = "/API.LovablePHP/ZLO0032P/List/?hora=" + ck;
      table = $('#mainTable').DataTable({
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },
        "ordering": false,
        "processing": true,
        "serverSide": true,
        "pageLength": 15,
        "ajax": {
          "url": urlTable,
          "type": "POST",
          "dataSrc": function(json) {
            if (json.data) {
              console.log(json);
              return json.data;
            } else {
              console.error(json);
              return [];
            }
          },
          "data": function(d) {
            d.columns = [];
            $('#mainTable thead th input').each(function(i) {
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
            "render": function(data, type, row) {
              return formatFecha(data.FECREQ, 2);
            },
          },
          {
            "data": "DESCRP"
          },
          {
            "data": "USUARI"
          },
          {
            "data": null,
            "render": function(data, type, row) {
              let descripcion = departamentos.find(depa => depa.SECDEP + '-' + depa.SECCOD == data
                .CODDEP +
                '-' + data.CODSEC).SECDES;
              return descripcion;
            },
          },
          {
            "data": "ENTREG"
          },
          {
            "data": "USUREC"
          },
          {
            "data": null,
            className: 'text-center',
            "render": function(data, type, row) {
              let buttons = '';
              switch (user) {
                case 'MARVIN':
                  if (row.IMAGEN == '') {
                    buttons = `<div class="dropdown text-end">
                                    <button class="btn btn-light p-1" type="button" data-coreui-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical fs-5"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" style="">
                                        <a class="dropdown-item fw-bold" onclick="checkReq('${data.NUMREQ}')">Marcar recibido &nbsp;&nbsp;<i class="fa-solid fa-square-check"></i></a>
                                        <a class="dropdown-item fw-bold" onclick="findReq('${data.NUMREQ}')">Editar <i class="fa-solid fa-pen-to-square"></i></a>
                                        <a class="dropdown-item fw-bold text-danger" onclick="deleteConfirm('${data.NUMREQ}')">Eliminar <i class="fa-solid fa-trash"></i></a>
                                    </div>
                                </div>`;
                  } else {
                    buttons = `<div class="dropdown text-end">
                                    <button class="btn btn-light p-1" type="button" data-coreui-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical fs-5"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" style="">
                                        <a class="dropdown-item fw-bold" onclick="checkReq('${data.NUMREQ}')">Marcar recibido &nbsp;&nbsp;<i class="fa-solid fa-square-check"></i></a>
                                        <a class="dropdown-item fw-bold" onclick="showImg('${data.IMAGEN}','${data.FECGRA}','${data.HORGRA}','${data.USUREC}','${data.FECREC}','${data.HORREC}','${data.ESTADO}')">Ver imagen <i class="fa-solid fa-images"></i></a>
                                        <a class="dropdown-item fw-bold" onclick="findReq('${data.NUMREQ}')">Editar <i class="fa-solid fa-pen-to-square"></i></a>
                                        <a class="dropdown-item fw-bold text-danger" onclick="deleteConfirm('${data.NUMREQ}')">Eliminar <i class="fa-solid fa-trash"></i></a>
                                    </div>
                                </div>`;
                  }
                  break;
                default:
                  if (row.IMAGEN == '') {
                    buttons = `<div class="dropdown text-end">
                                    <button class="btn btn-light p-1" type="button" data-coreui-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical fs-5"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" style="">
                                        <a class="dropdown-item fw-bold" onclick="checkReq('${data.NUMREQ}')">Marcar recibido &nbsp;&nbsp;<i class="fa-solid fa-square-check"></i></a>
                                    </div>
                                </div>`;
                  } else {
                    buttons = `<div class="dropdown text-end">
                                    <button class="btn btn-light p-1" type="button" data-coreui-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical fs-5"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" style="">
                                        <a class="dropdown-item fw-bold" onclick="checkReq('${data.NUMREQ}')">Marcar recibido &nbsp;&nbsp;<i class="fa-solid fa-square-check"></i></a>
                                        <a class="dropdown-item fw-bold" onclick="showImg('${data.IMAGEN}','${data.FECGRA}','${data.HORGRA}','${data.USUREC}','${data.FECREC}','${data.HORREC}','${data.ESTADO}')">Ver imagen <i class="fa-solid fa-images"></i></a>
                                    </div>
                                </div>`;
                  }

                  break;
              }

              return buttons;
            },
          },
          {
            "data": null,
            "render": function(data, type, row) {
              if (data.ESTADO == 1) {
                return `<span class="badge bg-success mb-2" style="width:100%;">Recibido</span>`;
              }
              return ` `;
            },
          },

        ],
        dom: 'tip',
      });
    }, 50);
    $('#mainTable thead input').not('#srcDepa_flexselect').on('keyup', function() {
      var columnIndex = $(this).parent().index();
      var inputValue = $(this).val().trim();
      if (table.column(columnIndex).search() !== inputValue) {
        table
          .column(columnIndex)
          .search(inputValue)
          .draw();
      }
    });

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
    let fecha = document.getElementById('fecha').value;
    let descrp = document.getElementById('descrp').value;
    let soli = document.getElementById('soli').value;
    let depa = document.getElementById('depa').value;
    let entrega = document.getElementById('entrega').value;
    let recibi = document.getElementById('recibi').value;
    let imagen = document.getElementById('imagen').files[0];
    let check = document.getElementById('isrepet');
    let isrepet = (check.checked) ? 1 : 0;

    if (nreq == '' || fecha == '' || depa == '' || descrp == '' || entrega == '') {
      lblError.classList.remove('d-none');
    } else {
      lblError.classList.add('d-none');
      let dataSave = {
        nreq: nreq,
        fecha: formatFecha(fecha, 0),
        descrp: descrp,
        soli: soli,
        depa: depa,
        entrega: entrega,
        recibi: recibi,
        isrepet: isrepet,
        base64: "",
        exten: "",
        fecgra: currentDate(),
        horgra: currentTime(),
      };
      let url = "/API.LovablePHP/ZLO0032P/SaveDocument/";
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

  function deleteConfirm(numreq) {
    Swal.fire({
      title: '¿Está seguro de eliminar la requisición?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Sí, eliminar!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        deleteReq(numreq);
      }
    });
  }

  function deleteReq(numreq) {
    let url = `/API.LovablePHP/ZLO0032P/Del/?numreq=${numreq}`;
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

  function findReq(numreq) {
    reqModalLabel.innerHTML = 'Actualizar una requisición';
    footerModal.innerHTML =
      `<button type="button" class="btn btn-secondary text-white fw-bold" data-bs-dismiss="modal">Cerrar</button>
                                 <button type="button" class="btn btn-primary text-white fw-bold" onclick="updateReq()">Actualizar</button>`;
    box1.innerHTML = ``;
    /*ENCONTRANDO*/
    let url = `/API.LovablePHP/ZLO0032P/Find/?numreq=${numreq}`;
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
        document.getElementById('nreq').value = req.NUMREQ;
        document.getElementById('fecha').value = formatFecha(req.FECREQ, 1);
        document.getElementById('descrp').value = req.DESCRP;
        document.getElementById('soli').value = req.USUARI;
        document.getElementById('depa').value = req.CODDEP + '-' + req.CODSEC;
        document.getElementById('entrega').value = req.ENTREG;
        document.getElementById('recibi').value = req.USUREC;
        document.getElementById('isrepet').checked = (req.ESREPE == 1) ? true : false;
        if (req.IMAGEN != '') {
          let img = document.createElement('img');
          img.src = `http://172.16.15.20${req.IMAGEN}`;
          img.style.width = '100%';
          img.style.height = '100%';
          box1.innerHTML = `<div class="row mb-1">
                                <div class="col-12 text-end">
                                    <button class="btn btn-danger text-white" onclick="deleteImg()">Eliminar <i class="fa-solid fa-trash"></i></button>
                                </div>
                            </div>`;
          box1.appendChild(img);
          imgUrl.value = req.IMAGEN;
        } else {
          box1.innerHTML =
            `<input id="imagen" type="file" class="form-control" accept="image/png, image/jpeg, image/gif">`;
        }
        $('#reqModal').modal('show');
      } else {
        console.log(data.message);
      }
    });
  }

  function checkReq(numreq) {
    let fecha = currentDate();
    let hora = currentTime();
    let url = `/API.LovablePHP/ZLO0032P/Check/?numreq=${numreq}&usua=${user}&fecha=${fecha}&hora=${hora}`;
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
    let nreq1 = document.getElementById('nreq1').value;
    let nreq = document.getElementById('nreq').value;
    let fecha = document.getElementById('fecha').value;
    let descrp = document.getElementById('descrp').value;
    let soli = document.getElementById('soli').value;
    let depa = document.getElementById('depa').value;
    let entrega = document.getElementById('entrega').value;
    let recibi = document.getElementById('recibi').value;
    let imagenUrl = document.getElementById('imgUrl').value;
    let imagen = ""
    if (imagenUrl == '') {
      imagen = document.getElementById('imagen').files[0];
    }
    let check = document.getElementById('isrepet');
    let isrepet = (check.checked) ? 1 : 0;

    if (nreq == '' || fecha == '' || depa == '' || descrp == '' || entrega == '') {
      lblError.classList.remove('d-none');
    } else {
      lblError.classList.add('d-none');
      let dataSave2 = {
        nreq1: nreq1,
        nreq: nreq,
        fecha: formatFecha(fecha, 0),
        descrp: descrp,
        soli: soli,
        depa: depa,
        entrega: entrega,
        recibi: recibi,
        isrepet: isrepet,
        imgUrl: imagenUrl,
        base64: "",
        exten: "",
        fecgra: currentDate(),
        horgra: currentTime(),
      };
      let url = "/API.LovablePHP/ZLO0032P/UpdateDocument/";
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
        $('#reqModal').modal('hide');
        $('#mainTable').DataTable().ajax.reload();
      } else {
        console.log(data.message);
      }
    });
  }

  function blobToBase64(blob, callback) {
    const reader = new FileReader();
    reader.onload = function() {
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
          `<input id="imagen" type="file" class="form-control" accept="image/png, image/jpeg, image/gif">`;
      }
    });
  }

  function formatFecha(fecha, formato) {
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

  function showImg(imagen, fecgra, horgra, usurec, fecrecibido, horrecibido, estado) {
    let fecha = formatFecha(fecgra.toString(), 2);
    let hora = horgra.substring(0, 2) + ':' + horgra.substring(2, 4) + ':' + horgra.substring(4, 6);
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
    imgFrame.src = `http://172.16.15.20/` + imagen;
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
              <label for="nreq" class="form-control border border-0">N. Requisición <span class="text-danger">(*)</span>
              </label>
              <input id="nreq1" type="text" class="d-none">
              <input id="nreq" type="text" maxlength="10" class="form-control" placeholder="Ingrese la requisición">
            </div>
            <div class="col-12 col-lg-6">
              <label for="fecha" class="form-control border border-0">Fecha <span class="text-danger">(*)</span></label>
              <input id="fecha" type="date" class="form-control">
            </div>
            <div class="col-12 col-lg-12 mt-2">
              <label for="descrp" class="form-control border border-0">Descripción <span
                  class="text-danger">(*)</span></label>
              <textarea id="descrp" placeholder="Ingrese una descripcion de la requisición" class="form-control"
                rows="5" style="height:150px; resize: none;"></textarea>
            </div>
            <div class="col-12 col-lg-6 mt-2">
              <label for="soli" class="form-control border border-0">Solicitante <span
                  class="text-danger">(*)</span></label>
              <input id="soli" type="text" maxlength="30" class="form-control" placeholder="Ingrese el solicitante">
            </div>
            <div class="col-12 col-lg-6 mt-2">
              <label for="depa" class="form-control border border-0">Departamento <span
                  class="text-danger">(*)</span></label>
              <select id="depa" class="form-select mt-1">
                <option value=""></option>
              </select>
            </div>
            <div class="col-12 col-lg-12 mt-2">
              <label for="entrega" class="form-control border border-0">Entregado por <span
                  class="text-danger">(*)</span></label>
              <input id="entrega" type="text" maxlength="30" class="form-control"
                placeholder="Ingrese el entregado por">
            </div>
            <div class="col-12 col-lg-6 mt-2">
              <label for="recibi" class="form-control border border-0 d-none">Recibido por <span
                  class="text-danger">(*)</span></label>
              <input id="recibi" type="text" maxlength="30" class="form-control d-none"
                placeholder="Ingrese el recibido por">
            </div>
            <div class="col-12 mt-3 d-none">
              <div class="form-check ">
                <input class="form-check-input" type="checkbox" value="" id="isrepet">
                <label class="form-check-label" for="isrepet">
                  Tarea repetitiva
                </label>
              </div>
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
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-6">
            Fecha grabado: <span id="fechaGra"></span> <br>
            Hora grabado: <span id="horaGra"></span>
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 text-center">
              <img id="imgFrame" src="" style="width:100%; height:100%;">
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
          <label class="me-3">Fecha de requisición</label>
          <div id="dayRange">

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger fw-bold text-white" onclick="deleteDate()">Borrar</button>
          <button type="button" class="btn btn-primary fw-bold text-white"
            onclick="$('#modalRangeDocumento').modal('hide')">Aceptar</button>
        </div>
      </div>
    </div>
  </div>
</body>

</html>