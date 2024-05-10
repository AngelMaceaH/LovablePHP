<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
</head>

<body>
  <?php
      include '../layout-prg.php';
      include '../../assets/php/TBL/ZLO0034P/header.php';
    ?>
  <div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item">
          <span> Tablero / Casos asignados </span>
        </li>
        <li class="breadcrumb-item active"><span>Módulo de casos web</span></li>
      </ol>
    </nav>
  </div>
  </header>
  <div id="body-div" class="body flex-grow-3 bg-white">
    <div class="card p-0 m-0 ps-4" style="background-color:#6B1816;">
      <div class="row mb-2" style="width:100%;">
        <div class="col-3">
          <div class="divUsuario d-none">
            <label for="cbbUsuario">&nbsp;&nbsp;</label>
            <select class="form-select  fw-bold text-black" name="" id="cbbUsuario">
              <option value="ALL">Todos los usuarios</option>
            </select>
          </div>
        </div>
        <div class="col-3">
          <div class="divUsuario d-none">
            <label>&nbsp;&nbsp;</label>
            <select class="form-select  fw-bold text-black" name="" id="cbbAreas">
            </select>
          </div>
        </div>
        <div class="col-3">
          <div class="divUsuario d-none">
            <label>&nbsp;&nbsp;</label>
            <select class="form-select fw-bold text-black text-muted" name="" id="cbbServi">
              <option value="" class="text-muted">Escoge un área primero</option>
            </select>
          </div>
        </div>
        <div class="col-3">
          <div class="divUsuario d-none">
            <div class="form-control rounded nowrap text-center" style="font-size:15px;">
              <input class="form-check-input border border-2" type="checkbox" value="" id="btnColumns">
              <label class="form-check-label" for="btnColumns">
                Mostrar columnas extras
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-white" style="height: 62vh;">
      <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between text-center" id="tableHeader">
        </div>
      </div>
      <div class="container-fluid mt-2" style="height:100%;">
        <div class="d-flex justify-content-between text-center" style="height:100%;" id="bodyHeader">

        </div>
      </div>
    </div>
    <div class="container-fluid mb-4 bg-white" style="height:3.8vh;">

    </div>
  </div>
  </div>
  </div>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.6.6/dragula.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
  let user = '';
  let nivel = 0;
  const drake = dragula();
  let contador = 1;
  let divHeader = null;
  let divBody = null;
  let divBox = null;
  let divContent = null;
  let urlHeader = "";
  let enca = [];
  let desTecnica = [];
  let desFinal = [];
  document.addEventListener('DOMContentLoaded', function() {

    user = "<?php echo isset($_SESSION['CODUSU'])? $_SESSION['CODUSU']: ''; ?>";

    let urlFind = "http://172.16.15.20/API.LovablePHP/ZLO0034P/FindUsua/?usuario=" + user;
    fetch(urlFind)
      .then(response => response.json())
      .then(data => {
        if (data.code == 200) {
          let responseData = data.data;
          if (responseData[0].NIVUSR == 1) {
            $(".divUsuario").removeClass('d-none');
            nivel = 1;
            let urlUsuarios = "http://172.16.15.20/API.LovablePHP/ZLO0034P/ListUsua/";
            fetch(urlUsuarios)
              .then(response => response.json())
              .then(data => {
                if (data.code == 200) {
                  let responseData = data.data;
                  let cbbUsuario = document.getElementById('cbbUsuario');
                  responseData.forEach(usuario => {
                    let option = document.createElement('option');
                    option.value = usuario.USUARI;
                    option.innerHTML = usuario.USUARI;
                    cbbUsuario.appendChild(option);
                    cbbSoli.appendChild(option.cloneNode(true));
                    cbbUsuasi.appendChild(option.cloneNode(true));
                    cbbSoli.value = user;
                  });
                  cbbUsuario.value = (getCookie('usuaCbb') == '' || getCookie('usuaCbb') == null) ? 'ALL' :
                    getCookie('usuaCbb');
                } else {
                  console.log(data.message);
                }
              });
            cbbUsuario.addEventListener('change', function() {
              setCookie('usuaCbb', cbbUsuario.value, 1);
              chargeTasks();
            });
          }
        }
      });
    urlHeader = "http://172.16.15.20/API.LovablePHP/ZLO0034P/GetHeaders/?opc=0&usuario=" + user;
    chargeHeader();
    btnColumns.addEventListener('change', function() {
      if (btnColumns.checked) {
        urlHeader = "http://172.16.15.20/API.LovablePHP/ZLO0034P/GetHeaders/?opc=1&usuario=" + user;
        chargeHeader();
      } else {
        urlHeader = "http://172.16.15.20/API.LovablePHP/ZLO0034P/GetHeaders/?opc=0&usuario=" + user;
        chargeHeader();
      }
    });

    let urlAreas = "http://172.16.15.20/API.LovablePHP/ZLO0034P/ListAreas/";
    fetch(urlAreas)
      .then(response => response.json())
      .then(data => {
        if (data.code == 200) {
          let responseData = data.data;
          let cbbAreas = document.getElementById('cbbAreas');
          let cbbAreas2 = document.getElementById('cbbAreas2');
          let option = '<option value="">Selecciona un area</option>';
          responseData.forEach(area => {
            option += `<option value="${area.CODARE}">${area.DESCRI}</option>`;
          });
          cbbAreas.innerHTML = option;
          cbbAreas2.innerHTML = option;

          cbbAreas.value = (getCookie('areaCbb') == '' || getCookie('areaCbb') == null) ? '' : getCookie(
            'areaCbb');

          if (getCookie('serviCbb') != '' && getCookie('serviCbb') != null) {
            const cbbValue = cbbAreas.value;
            const cbbServi = document.getElementById('cbbServi');
            if (cbbValue == '') {
              cbbServi.classList.add('text-muted');
              cbbServi.innerHTML = '<option value="">Escoge un área primero</option>';
            } else {
              let urlServicios = `http://172.16.15.20/API.LovablePHP/ZLO0034P/ListServicios/?area=${cbbValue}`;
              fetch(urlServicios)
                .then(response => response.json())
                .then(data => {
                  if (data.code == 200) {
                    let responseData = data.data;
                    cbbServi.classList.remove('text-muted');
                    let option = '<option value="">Selecciona un servicio</option>';
                    responseData.forEach(servicio => {
                      option += `<option value="${servicio.CODSER}">${servicio.DESCRI}</option>`;
                    });
                    cbbServi.innerHTML = option;
                    cbbServi.value = (getCookie('serviCbb') == '' || getCookie('serviCbb') == null) ? '' :
                      getCookie('serviCbb');
                  } else {
                    console.log(data.message);
                  }
                });
            }
          }
        } else {
          console.log(data.message);
        }
      });
    cbbAreas.addEventListener('change', function() {
      const cbbValue = cbbAreas.value;
      setCookie('areaCbb', cbbValue, 1);
      setCookie('serviCbb', '', 1);
      const cbbServi = document.getElementById('cbbServi');
      if (cbbValue == '') {
        cbbServi.classList.add('text-muted');
        cbbServi.innerHTML = '<option value="">Escoge un área primero</option>';
      } else {
        let urlServicios =
          `http://172.16.15.20/API.LovablePHP/ZLO0034P/ListServicios/?area=${cbbValue}`;
        fetch(urlServicios)
          .then(response => response.json())
          .then(data => {
            if (data.code == 200) {
              let responseData = data.data;
              cbbServi.classList.remove('text-muted');
              let option = '<option value="">Selecciona un servicio</option>';
              responseData.forEach(servicio => {
                option += `<option value="${servicio.CODSER}">${servicio.DESCRI}</option>`;
              });
              cbbServi.innerHTML = option;
              cbbServi.value = (getCookie('serviCbb') == '' || getCookie('serviCbb') == null) ? '' :
                getCookie('serviCbb');
            } else {
              console.log(data.message);
            }
          });
      }
      chargeTasks();
    });

    cbbServi.addEventListener('change', function() {
      const cbbValue = cbbServi.value;
      setCookie('serviCbb', cbbValue, 1);
      chargeTasks();
    });

    cbbAreas2.addEventListener('change', function() {
      const cbbValue = cbbAreas2.value;
      const cbbServi2 = document.getElementById('cbbServi2');
      if (cbbValue == '') {
        cbbServi2.classList.add('text-muted');
        cbbServi2.innerHTML = '<option value="">Escoge un área primero</option>';
      } else {
        let urlServicios =
          `http://172.16.15.20/API.LovablePHP/ZLO0034P/ListServicios/?area=${cbbValue}`;
        fetch(urlServicios)
          .then(response => response.json())
          .then(data => {
            if (data.code == 200) {
              let responseData = data.data;
              cbbServi2.classList.remove('text-muted');
              let option = '<option value="">Selecciona un servicio</option>';
              responseData.forEach(servicio => {
                option += `<option value="${servicio.CODSER}">${servicio.DESCRI}</option>`;
              });
              cbbServi2.innerHTML = option;
            } else {
              console.log(data.message);
            }
          });
      }
    });

    let urlComarc = '/API.LovablePHP/ZLO0015P/ListComarc2/?user=' + user + '';
    let responseComarc = ajaxRequest(urlComarc);
    let comarcOptions = '<option value="">Selecciona una compañía</option>';
    if (responseComarc.code == 200) {
      for (let i = 0; i < responseComarc.data.length; i++) {
        comarcOptions += '<option value="' + responseComarc.data[i].COMCOD.padStart(2, '0') + '">' +
          responseComarc.data[i].COMDES + '</option>';
      }
      cbbCia.innerHTML = comarcOptions;
      cbbCia.value = '01';
    }

    const urlDepas = 'http://172.16.15.20/API.LovablePHP/ZLO0034P/ListDepas/';
    fetch(urlDepas)
      .then(response => response.json())
      .then(data => {
        if (data.code == 200) {
          let responseData = data.data;
          let cbbDepa = document.getElementById('cbbDepa');
          let option = '<option value="">Selecciona un departamento</option>';
          responseData.forEach(depa => {
            option += `<option value="${depa.DEPCOD}">${depa.DEPDES}</option>`;
          });
          cbbDepa.innerHTML = option;
        } else {
          console.log(data.message);
        }
      });

    cbbDepa.addEventListener('change', function() {
      const cbbValue = cbbDepa.value;
      if (cbbValue == '') {
        const cbbSeccion = document.getElementById('cbbSec');
        cbbSeccion.classList.add('text-muted');
        cbbSeccion.innerHTML = '<option value="">Escoge el departamento primero</option>';
      } else {
        const urlSeccion = 'http://172.16.15.20/API.LovablePHP/ZLO0034P/ListSecc/?depa=' + cbbValue;
        fetch(urlSeccion)
          .then(response => response.json())
          .then(data => {
            if (data.code == 200) {
              let responseData = data.data;
              let cbbSeccion = document.getElementById('cbbSec');
              cbbSeccion.classList.remove('text-muted');
              let option = '<option value="">Selecciona una sección</option>';
              responseData.forEach(servicio => {
                option += `<option value="${servicio.SECCOD}">${servicio.SECDES}</option>`;
              });
              cbbSec.innerHTML = option;
            } else {
              console.log(data.message);
            }
          });
      }
    });
    createModal.addEventListener('show.bs.modal', function() {
      cbbAreas2.value = '';
      cbbServi2.value = '';
      cbbDepa.value = '';
      cbbSec.value = '';
      cbbCia.value = '01';
      enca = [];
      lblEncas.innerHTML = '';
      inputFecha.value = '';
      inputEnca.disabled = false;
      cbbSoli.value = user;
    });

    asigModal.addEventListener('show.bs.modal', function() {
      inputProri.value = '';
      inputfecLimit.value = '';
      inputDescrip.value = '';
      lblDescrip.innerHTML = '';
      desTecnica = [];
      cbbUsuasi.value = '';
    });
    inputEnca.addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
        addRow1();
      }
    });
    inputDescrip.addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
        addRow2();
      }
    });
    inputProri.addEventListener('input', function() {
      var value = parseInt(this.value, 10); // Convierte el valor del input a un número entero
      if (value < 1) {
        this.value = 1;
      } else if (value > 99) {
        this.value = 99;
      }
    });

  });

  function chargeHeader() {
    const tableHeader = document.getElementById('tableHeader');
    const bodyHeader = document.getElementById('bodyHeader');
    tableHeader.innerHTML = '';
    bodyHeader.innerHTML = '';
    fetch(urlHeader)
      .then(response => response.json())
      .then(data => {
        let responseData = data.data;
        responseData.forEach(header => {
          let totalColumn = header.TOTALROWS;
          let widthColumn = 100 / totalColumn;
          divHeader = document.createElement('div');
          divHeader.className = 'p-2 rounded fw-bold text-title border border-2 shadow text-white';
          divHeader.style.backgroundColor = '#6B1816';
          divHeader.style.width = `${widthColumn - 0.5}%`;
          divHeader.innerHTML = header.DESCRI;
          tableHeader.appendChild(divHeader);
          if (header.ESTADO == 'A') {
            let buttonCreate = document.createElement('button');
            buttonCreate.className = 'btn btn-light rounded m-0 pt-0 pb-0';
            buttonCreate.innerHTML = '<i class="fa-solid fa-plus"></i>';
            buttonCreate.addEventListener('click', function() {
              lblError.innerHTML = '';
              $("#createModal").modal('show');
            });
            let span = document.createElement('span');
            span.innerHTML = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            divHeader.appendChild(span);
            divHeader.appendChild(buttonCreate);
          }
          divBody = document.createElement('div');
          divBody.id = 'column-' + contador;
          if (nivel == 0) {
            if (header.ESTADO == 'B' || header.ESTADO == 'F') {
              divBody.className = header.ESTADO + ' ' +
                'columnTable overflow-auto rounded border border-2 shadow drag-' + contador;
            } else {
              //divBody.className = header.ESTADO + ' ' +'columnTable overflow-auto rounded border border-2 shadow done drag-' + contador;
              divBody.className = header.ESTADO + ' ' +
                'columnTable overflow-auto rounded border border-2 shadow drag-' + contador;
            }
          } else {
            divBody.className = header.ESTADO + ' ' +
              'columnTable overflow-auto rounded border border-2 shadow drag-' + contador;
          }
          divBody.style.backgroundColor = 'rgba(61, 11, 13,0.3)';
          divBody.style.width = `${widthColumn - 0.5}%`;
          divBody.style.height = '100%';
          bodyHeader.appendChild(divBody);
          drake.containers.push(divBody);
          contador++;
        });
        chargeTasks();
        drake.off('drop').on('drop', function(el, target, source, sibling) {
          changeState(el, target, source, sibling);
        });

        classnames();
      });
  }

  function classnames() {
    for (let i = 1; i < contador; i++) {
      $(`.drag-${i} .box`).attr('class', `box box${i}`).removeClass(function(index, className) {
        return (className.match(/(^|\s)box\S+/g) || []).join(' ');
      });
    }
  }

  function changeState(el, target, source, sibling) {
    let estadoInicial = source.className.split(' ')[0];
    let estadoFinal = target.className.split(' ')[0];
    let id = el.id;
    let fecha = currentDate();
    let hora = currentTime();
    switch (estadoInicial) {
      case 'A':
        switch (estadoFinal) {
          case 'B':
            document.getElementById('closeButton').addEventListener('click', function() {
              closeAsigModal(el, target, source, sibling);
            });
            lblErrorAsig.innerHTML = '';
            inputCaso.value = id;
            $("#asigModal").modal('show');
            setTimeout(() => {
              document.getElementById('inputfecLimit').value = new Date().toISOString().split('T')[0];
            }, 100);
            break;
          case 'E':
            stateTask(id, estadoFinal, fecha, hora);
            break;

          default:
            break;
        }
        break;
      case 'F':
        if (estadoFinal == 'A') {
          stateTask(id, estadoFinal, fecha, hora);
        } else if (estadoFinal == 'C') {
          let urlFichaTecnica = `http://172.16.15.20/API.LovablePHP/ZLO0034P/GetInstructionsF/?cia=1&caso=${id}`;
          fetch(urlFichaTecnica)
            .then(response => response.json())
            .then(data => {
              if (data.code == 500) {
                source.appendChild(el);
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'No se ha ingresado la descripción técnica final',
                });
              }
            }).catch(error => {
              console.error('Error fetching data: ', error);
            });
          source.appendChild(el);
        } else if (estadoFinal == 'B') {
          if (nivel==1) {
            stateTask(id, estadoFinal, fecha, hora);
          }else{
            source.appendChild(el);
          }
        }
        break;
      case 'E':
        stateTask(id, estadoFinal, fecha, hora);
        break;
      case 'B':
        stateTask(id, estadoFinal, fecha, hora);
       break;
      case 'C':
        if (estadoFinal == 'F' && nivel == 1) {
          stateTask(id, estadoFinal, fecha, hora);
        }else if (estadoFinal == 'D' && nivel == 1) {
          stateTask(id, estadoFinal, fecha, hora);
        } else {
          source.appendChild(el);
        }
        break;
      case 'D':
        if (estadoFinal == 'C' && nivel == 1 || estadoFinal == 'E') {
          stateTask(id, estadoFinal, fecha, hora);
        } else {
          source.appendChild(el);
        }
      break;
      default:
        console.log('CAMBIAA');
        stateTask(id, estadoFinal, 0, 0);
        break;
    }
  }

  function closeAsigModal(el, target, source, sibling) {
    source.appendChild(el);
    $("#asigModal").modal('hide');
  }

  function chargeTasks() {
    let ano = new Date().getFullYear();
    let mes = new Date().getMonth() + 1;
    let usuario = "";
    let area = "";
    let servi = "";
    const cookieUsua = getCookie('usuaCbb');
    const cookieArea = getCookie('areaCbb');
    const cookieServi = getCookie('serviCbb');
    if (nivel == 1) {
      if (cookieUsua != '' && cookieUsua != null) {
        usuario = cookieUsua;
      } else {
        usuario = document.getElementById('cbbUsuario').value;
      }
      if (cookieArea != '' && cookieArea != null) {
        area = cookieArea;
      } else {
        area = document.getElementById('cbbAreas').value;
      }
      if (cookieServi != '' && cookieServi != null) {
        servi = cookieServi;
      } else {
        servi = document.getElementById('cbbServi').value;
      }
    } else {
      usuario = "<?php echo isset($_SESSION['CODUSU'])? $_SESSION['CODUSU']: ''; ?>";
    }
    let opcion = 0;
    if (btnColumns.checked) {
      opcion = 1
    }
    let urlTasks =
      `http://172.16.15.20/API.LovablePHP/ZLO0034P/GetTasks/?ano=${ano}&mes=${mes}&usuario=${usuario}&area=${area}&servi=${servi}&opc=${opcion}`;
    const columnTables = document.querySelectorAll('.columnTable');
    columnTables.forEach(function(div) {
      div.innerHTML = '';
    });
    fetch(urlTasks)
      .then(response => response.json())
      .then(data => {
        const currentDate = new Date(new Date().toISOString().split('T')[0]);
        if (data.code == 200) {
          let responseData = data.data;
          responseData.forEach(task => {
            let fechaLimite = '';
            let fecha = new Date(formatFecha(task.FECEN2, 1));
            if (currentDate > fecha) {
              fechaLimite =
                `<span class="text-danger">Fecha limite: ${formatFecha((task.FECEN2).toString(),2)}</span>`;
            } else {
              fechaLimite =
                `<span class="text-secondary">Fecha limite: ${formatFecha((task.FECEN2).toString(),2)}</span>`;
            }
            let buttons = '';
            if (nivel == 1) {
              if (task.ESTADO=='A' || task.ESTADO=='B') {
                buttons = `<li><button class="dropdown-item  fw-bold" type="button" onclick="stateTask('${task.NUMERO}','E',0,0)">Eliminar <i class="fa-solid fa-trash text-danger"></i></button></li>
                                                  <li><button class="dropdown-item  fw-bold" type="button">Editar <i class="fa-solid fa-pen-to-square text-warning"></i></button></li>
                                                  <li><button class="dropdown-item  fw-bold" type="button">Color <i class="fa-solid fa-palette text-primary"></i></button></li>`;
              }else{
                buttons = `<li><button class="dropdown-item  fw-bold" type="button" onclick="stateTask('${task.NUMERO}','E',0,0)">Eliminar <i class="fa-solid fa-trash text-danger"></i></button></li>
                                                  <li><button class="dropdown-item  fw-bold" type="button">Color <i class="fa-solid fa-palette text-primary"></i></button></li>`;
              }
               } else {
              buttons =
              `<li><button class="dropdown-item  fw-bold" type="button">Color <i class="fa-solid fa-palette text-primary"></i></button></li>`;
            }

            let column = document.getElementsByClassName(task.ESTADO);
            let boxTask = `<div class="box" id="${task.NUMERO}">
                              <div class="card mb-1" >
                                    <div class="card-header fw-bold " style="font-size:13px;">
                                        <div class="d-flex justify-content-between">
                                            <div class="text-start>
                                                <span class="fw-bold">${task.USUASI}</span>
                                            </div>
                                            <div class="text-end">
                                              <div class="dropdown">
                                              <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                              <i class="fa-solid fa-bars"></i>
                                              </a>
                                                <ul class="dropdown-menu">
                                                ${buttons}
                                                  </ul>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body  bg-white rounded p-0" style="height:75px;" onclick="showDetalles('${task.CODCIA}','${task.NUMERO}')">
                                        <div style="font-size:14.5px; text-align:left; ">
                                            <p class="Mulifont p-0 m-1">${task.DESCR1} ${task.DESCR2}</p>
                                        </div>
                                      </div>
                                      <div class="card-footer fw-bold text-start " style="font-size:13px;">
                                            ${fechaLimite}
                                      </div>
                                </div>
                            </div>`;
            column.innerHTML = '';
            column[0].innerHTML += boxTask;
          });
        } else {

        }
      });
  }

  function showDetalles(cia, caso) {
    let urlHeader = `http://172.16.15.20/API.LovablePHP/ZLO0034P/FindTask/?cia=${cia}&caso=${caso}`;
    fetch(urlHeader)
      .then(response => response.json())
      .then(data => {
        if (data.code == 200) {
          let responseData = data.data;
          idCaso.innerHTML = responseData[0].NUMERO;
          fechaCaso.innerHTML = formatFecha(responseData[0].FECENT.toString(), 2);
          fechaEntrega.innerHTML = formatFecha(responseData[0].FECEN2.toString(), 2);
          areaCaso.innerHTML = responseData[0].AREA;
          fechaEntregaTecnica.innerHTML = formatFecha(responseData[0].FECENT.toString(), 2);
          servicioCaso.innerHTML = responseData[0].SERVI;
          fechaInicioRevision.innerHTML = formatFecha(responseData[0].FECINI.toString(), 2);
          departamentoCaso.innerHTML = responseData[0].DEPA;
          prioridadCaso.innerHTML = responseData[0].PRIORI;
          horaInicioRevision.innerHTML = formatHora(responseData[0].HORINI);
          seccionCaso.innerHTML = responseData[0].SEC;
          fechaRevisionTerminada.innerHTML = formatFecha(responseData[0].FECFIN.toString(), 2);
          horaRevisionTerminada.innerHTML = formatHora(responseData[0].HORFIN);
          Descrip1.innerHTML = responseData[0].DESCR1;
          Descrip2.innerHTML = responseData[0].DESCR2;
        } else {
          console.log(data.message);
        }
      });

    let urlFicha = `http://172.16.15.20/API.LovablePHP/ZLO0034P/GetInstructions/?cia=${cia}&caso=${caso}`;
    fetch(urlFicha)
      .then(response => response.json())
      .then(data => {
        if (data.code == 200) {
          reviDiv.classList.remove('d-none');
          descpDiv.classList.remove('d-none');
          let responseData = data.data;
          let descripcion = '';
          responseData.forEach(ficha => {
            descripcion += `<p class="Mulifont p-0 m-1">${ficha.DESCRI}</p>`;
          });
          descrpTecnica.innerHTML = descripcion;
          console.log(responseData[0].ESTADO)
          switch (responseData[0].ESTADO) {
            case 'A':
            case 'B':
              isRevision.innerHTML = ``;
              break;
            case 'F':
              isRevision.innerHTML =`<button type="button" class="btn btn-light rounded fw-bold" onclick="addDesFinal(${caso},'${responseData[0].USUARI}')">Ingresar Descripcion Tecnica final <i class="fa-solid fa-pen-to-square  text-darkblue"></i></button>`;
              break;
            case 'C':
              isRevision.innerHTML = `<div class="form-control border border-0 border-bottom shadow" style="width:100%;">
                                        <div class="row">
                                          <div class="col-12">
                                            <span class="fw-bold text-start">Descripción Técnica Final</span>
                                          </div>
                                          <div class="col-12">
                                            <span id="descrpTecnicaFinal"></span>
                                          </div>
                                        </div>
                                      </div>`;
              let urlFichaTecnica =
                `http://172.16.15.20/API.LovablePHP/ZLO0034P/GetInstructionsF/?cia=${cia}&caso=${caso}`;
              fetch(urlFichaTecnica)
                .then(response => response.json())
                .then(data => {
                  if (data.code == 200) {
                    let responseData = data.data;
                    let descripcion = '';
                    responseData.forEach(ficha => {
                      descripcion += `<p class="Mulifont p-0 m-1">${ficha.DESCRI}</p>`;
                    });
                    descrpTecnicaFinal.innerHTML = descripcion;
                    //Verificando si tiene archivo
                    const urlFile = data.fileP;
                    if (urlFile != '') {
                      isRevision.innerHTML += `<p class="Mulifont p-0 m-1 mt-3">Este caso tiene un archivo adjunto.
                      <a href="${urlFile}" download class="fw-bold">
                        Descargalo aquí <i class="fa-solid fa-download text-darkblue"></i>
                      </a>
                      </p>`;
                    }

                  } else {
                    console.log(data.message);
                  }
                }).catch(error => {
                  console.error('Error fetching data: ', error);
                });
              break
            default:
              isRevision.innerHTML = ``;
              break;
          }
        } else {
          descpDiv.classList.add('d-none');
          reviDiv.classList.add('d-none');
          console.log(data.message);
        }
      });
      footerCase.innerHTML = `<button type="button" class="btn btn-secondary rounded text-white fw-bold" data-bs-dismiss="modal">ACEPTAR</button>`;
      isRevision.innerHTML = ``;
      $('#detaModal').modal('show');
  }

  function formatFecha(fecha, formato) {
    if (fecha != 0) {
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
    } else {
      return '';
    }
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

  function addRow1() {
    let inputEnca = document.getElementById('inputEnca');
    if (enca.length < 2 && inputEnca.value != '') {
      enca.push(inputEnca.value);
      inputEnca.value = '';
      let span = '';
      enca.forEach((enca, i) => {
        span = `<div class="d-flex" style="width:100%;">
              <label class="border border-0 border-bottom m-1" style="width:100%;">${(i+1)}. ${enca}</label>
              <button class="btn btn-secondary rounded m-1 text-white fw-bold" onclick="delRow1(${i})"><i class="fa-solid fa-xmark"></i></button>
              </div> `
      });
      $("#lblEncas").append(span);
      if (enca.length == 2) {
        inputEnca.disabled = true;
      }
      lblError.innerHTML = '';
    }
  }

  function delRow1(index) {
    enca.splice(index, 1);
    inputEnca.disabled = false;
    let span = '';
    $("#lblEncas").empty();
    enca.forEach((enca, i) => {
      span = `<div class="d-flex" style="width:100%;">
              <label class="border border-0 border-bottom m-1" style="width:100%;">${(i+1)}. ${enca}</label>
              <button class="btn btn-secondary rounded m-1 text-white fw-bold" onclick="delRow1(${i})"><i class="fa-solid fa-xmark"></i></button>
              </div> `
    });
    $("#lblEncas").append(span);
  }

  function addRow2() {
    let inputDescrip = document.getElementById('inputDescrip');
    if (inputDescrip.value != '') {
      desTecnica.push(inputDescrip.value);
      inputDescrip.value = '';
      let span = '';
      desTecnica.forEach((des, i) => {
        span = `<div class="d-flex" style="width:100%;">
                <label class="border border-0 border-bottom m-1" style="width:100%;">${(i+1)}. ${des}</label>
                <button class="btn btn-secondary rounded m-1 text-white fw-bold" onclick="delRow2(${i})"><i class="fa-solid fa-xmark"></i></button>
                </div> `
      });
      $("#lblDescrip").append(span);
    }

  }

  function delRow2(index) {
    desTecnica.splice(index, 1);
    let span = '';
    $("#lblDescrip").empty();
    desTecnica.forEach((des, i) => {
      span += `<div class="d-flex" style="width:100%;">
              <label class="border border-0 border-bottom m-1" style="width:100%;">${(i+1)}. ${des}</label>
              <button class="btn btn-secondary rounded m-1 text-white fw-bold" onclick="delRow2(${i})"><i class="fa-solid fa-xmark"></i></button>
              </div> `
    });
    $("#lblDescrip").append(span);
  }

  function addRow3() {
    let inputDescripFinal = document.getElementById('inputDescripFinal');
    if (inputDescripFinal.value != '') {
      lblErrorDesFinal.innerHTML = '';
      desFinal.push(inputDescripFinal.value);
      inputDescripFinal.value = '';
      let span = '';
      desFinal.forEach((des, i) => {
        span = `<div class="d-flex" style="width:100%;">
                <label class="border border-0 border-bottom m-1" style="width:100%;">${(i+1)}. ${des}</label>
                <button class="btn btn-secondary rounded m-1 text-white fw-bold" onclick="delRow3(${i})"><i class="fa-solid fa-xmark"></i></button>
                </div> `
      });
      $("#lblDescripFinal").append(span);
    }
  }

  function delRow3(index) {
    desFinal.splice(index, 1);
    let span = '';
    $("#lblDescripFinal").empty();
    desFinal.forEach((des, i) => {
      span += `<div class="d-flex" style="width:100%;">
              <label class="border border-0 border-bottom m-1" style="width:100%;">${(i+1)}. ${des}</label>
              <button class="btn btn-secondary rounded m-1 text-white fw-bold" onclick="delRow3(${i})"><i class="fa-solid fa-xmark"></i></button>
              </div> `
    });
    $("#lblDescripFinal").append(span);
  }

  function createCase() {
    let area = cbbAreas2.value;
    let servi = cbbServi2.value;
    let depa = cbbDepa.value;
    let secc = cbbSec.value;
    let enca1 = enca[0];
    let enca2 = enca[1];
    let fecha = inputFecha.value;
    let soli = cbbSoli.value;
    let cia = cbbCia.value;
    if (cia == '' || area == '' || servi == '' || depa == '' || secc == '' || soli == '' ||
      cia == null || area == null || servi == null || depa == null || secc == null || soli == null) {
      lblError.innerHTML = 'Todos los campos son obligatorios';
    } else {
      if ((enca1 == '' && enca2 == '') || (enca1 == null && enca2 == null)) {
        lblError.innerHTML = 'Al menos un encabezado es obligatorio';
      } else {
        lblError.innerHTML = '';
        const dataSave = {
          CIA: cia,
          AREA: area,
          SERVI: servi,
          DEPA: depa,
          SECC: secc,
          ENCA1: enca1,
          ENCA2: enca2,
          FECHA: fecha,
          SOLI: soli,
          ESTADO: 'A',
          USUGRA: user,
          FECGRA: currentDate(),
          HORGRA: currentTime(),
        };
        let url = "http://172.16.15.20/API.LovablePHP/ZLO0034P/CreateTask/";
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
            const numero = data.correlativo;
            Swal.fire({
              icon: 'success',
              title: 'Caso creado',
              text: 'El caso ' + numero + ' se ha creado correctamente',
              showConfirmButton: false,
              timer: 1500
            });
            $("#createModal").modal('hide');
            chargeTasks();
          } else {
            console.log(data.message);
          }
        });
      }
    }
  }

  function asignarCase() {
    let usuasi = cbbUsuasi.value;
    let priori = inputProri.value;
    let fecLimit = inputfecLimit.value;
    let descrip = desTecnica;
    let cia = cbbCia.value;
    let caso = inputCaso.value;
    if (usuasi == '' || priori == '' || fecLimit == '' || descrip == '') {
      lblErrorAsig.innerHTML = 'Todos los campos son obligatorios';
    } else {
      lblErrorAsig.innerHTML = '';
      const dataSave = {
        CIA: cia,
        CASO: caso,
        USUASI: usuasi,
        PRIORI: priori,
        FECLIM: fecLimit.replace(/-/g, ''),
        DESCR: descrip,
        ESTADO: 'B',
        USUGRA: user,
        FECGRA: currentDate(),
        HORGRA: currentTime(),
      };
      let url = "http://172.16.15.20/API.LovablePHP/ZLO0034P/AsignTask/";
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
          $("#asigModal").modal('hide');
          Swal.fire({
            icon: 'success',
            title: 'Caso asignado correctamente',
            text: 'El caso se ha asignado a ' + usuasi,
            showConfirmButton: false,
            timer: 1500
          });
          chargeTasks();
        } else {
          console.log(data.message);
        }
      });
    }
  }

  function addDesFinal(caso, usuasi) {
    desFinal = [];
    isRevision.innerHTML = `<div class="form-control border border-0 border-bottom shadow" style="width:100%;">
                              <div class="row">
                                <div class="col-12">
                                  <span class="fw-bold text-start">Descripción Técnica Final</span>
                                </div>
                                <div class="col-12">
                                  <div class="input-group rounded">
                                    <input id="inputDescripFinal" maxlength="50" type="text" class="form-control rounded"
                                      placeholder="Escribe la descripción técnica final" onkeypress="validateInput(event)">
                                    <button class="btn btn-danger text-white fw-bold" onclick="addRow3()"><i
                                        class="fa-solid fa-square-plus fs-4"></i></button>
                                  </div>
                                  <div class="container ms-0" style="width:65%;">
                                    <div class="form-control rounded border border-0 m-0" id="lblDescripFinal" style="width:100%;">
                                    </div>
                                  </div>
                                </div>
                                <div class="col-12">
                                  <span id="lblErrorDesFinal" class="fw-bold text-danger text-center mt-2"></span>
                                  <hr>
                                  <span class="fw-bold text-start">Adjuntar un archivo</span>
                                  <input type="text" id="caseFileUrl" class="d-none">
                                  <input id="caseFile" type="file" class="form-control rounded" style="width:100%;">
                                </div>
                              </div>
                            </div>`;
    footerCase.innerHTML =
      `<button type="button" class="btn btn-secondary rounded text-white fw-bold" data-bs-dismiss="modal">CANCELAR</button>
                            <button type="button" class="btn btn-primary rounded text-white fw-bold" onclick="saveDesFinal(${caso},'${usuasi}')"><i class="fa-solid fa-save"></i> GUARDAR</button>`;

    inputDescripFinal.addEventListener('keypress', function(e) {
      if (e.key === 'Enter') {
        addRow3();
      }
    });
  }
  function validateInput(event) {
    const regex = /^[a-zA-Z0-9 ]*$/;
    if (!regex.test(event.key)) {
      event.preventDefault();
    }
  }
  function saveDesFinal(caso, usuasi) {
    let descrip = desFinal;
    let file = document.getElementById('caseFile').files[0];
    if (descrip.length == 0) {
      lblErrorDesFinal.innerHTML = 'Ingresar la descripción técnica final es obligatorio';
    } else {
      lblErrorDesFinal.innerHTML = '';
      let url = "http://172.16.15.20/API.LovablePHP/ZLO0034P/SaveDesfinal/";
      const dataSave = {
        CASO: caso,
        USUASI: usuasi,
        DESCR: descrip,
        ESTADO: 'C',
        USUGRA: user,
        FECGRA: currentDate(),
        HORGRA: currentTime(),
        FILE: '',
        EXTE: ''
      };
      if (file) {
        blobToBase64(file, (base64) => {
          dataSave.FILE = base64;
          dataSave.EXTE = file.name.split('.')[1];
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
              $("#detaModal").modal('hide');
              chargeTasks();
            } else {
              console.log(data.message);
            }
          });
        });
      } else {
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
            $("#detaModal").modal('hide');
            chargeTasks();
          } else {
            console.log(data.message);
          }
        });
      }

    }
  }

  function stateTask(caso, estado, fecha, hora) {
    const dataSave = {
      CASO: caso,
      ESTADO: estado,
      USUGRA: user,
      FECGRA: fecha,
      HORGRA: hora,
    };
    let url = `http://172.16.15.20/API.LovablePHP/ZLO0034P/ChangeStateTask/`;
    console.log(dataSave);
    console.log(url);
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
        chargeTasks();
        return;
      } else {
        console.log(data.message);
      }
    });
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

  function blobToBase64(blob, callback) {
    const reader = new FileReader();
    reader.onload = function() {
      const dataUrl = reader.result;
      const base64String = dataUrl.split(',')[1];
      callback(base64String);
    };
    reader.readAsDataURL(blob);
  }
  </script>
  <div class="modal fade" id="detaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-6 fw-bold" id="detaModalLabel" style="letter-spacing:0.2rem;">DETALLES DEL CASO</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body overflow-auto" style="height:60vh;">
          <div class="container p-0 m-0">
            <div class="row">
              <div class="col-12">
                <div class="form-control border border-0 border-bottom shadow" style="width:100%;">
                  <div class="row">
                    <div class="col-2">
                      Numero:
                    </div>
                    <div class="col-2 text-darkblue">
                      <span id="idCaso"></span>
                    </div>
                    <div class="col-2 text-end">
                      Fecha Caso:
                    </div>
                    <div class="col-2">
                      <span id="fechaCaso"></span>
                    </div>
                    <div class="col-2 text-end">
                      Fecha Entrega:
                    </div>
                    <div class="col-2">
                      <span id="fechaEntrega"></span>
                    </div>
                    <div class="col-2">
                      Area:
                    </div>
                    <div class="col-2">
                      <span id="areaCaso"></span>
                    </div>
                    <div class="col-4">

                    </div>
                    <div class="col-2 text-end">
                      Fecha Entrega Tecnica:
                    </div>
                    <div class="col-2">
                      <span id="fechaEntregaTecnica"></span>
                    </div>
                    <div class="col-2">
                      Servicio:
                    </div>
                    <div class="col-2">
                      <span id="servicioCaso"></span>
                    </div>
                    <div class="col-4">

                    </div>
                    <div class="col-2 text-end">
                      Fecha Inicio Revisión:
                    </div>
                    <div class="col-2">
                      <span id="fechaInicioRevision"></span>
                    </div>
                    <div class="col-2">
                      Departamento:
                    </div>
                    <div class="col-2">
                      <span id="departamentoCaso"></span>
                    </div>
                    <div class="col-2 text-end">
                      Prioridad:
                    </div>
                    <div class="col-1">
                      <span id="prioridadCaso"></span>
                    </div>
                    <div class="col-3 text-end">
                      Hora Inicio Revisión:
                    </div>
                    <div class="col-2">
                      <span id="horaInicioRevision"></span>
                    </div>
                    <div class="col-2">
                      Sección:
                    </div>
                    <div class="col-5">
                      <span id="seccionCaso"></span>
                    </div>
                    <div class="col-3 text-end">
                      Fecha Revisión Terminada:
                    </div>
                    <div class="col-2">
                      <span id="fechaRevisionTerminada"></span>
                    </div>
                    <div class="col-7">
                      <span id="Descrip1"></span><br>
                      <span id="Descrip2"></span>
                    </div>
                    <div class="col-3 text-end">
                      Hora Revisión Terminada:
                    </div>
                    <div class="col-2">
                      <span id="horaRevisionTerminada"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12" id="descpDiv">
                <div class="form-control border border-0 border-bottom shadow" style="width:100%;">
                  <div class="row">
                    <div class="col-12">
                      <span class="fw-bold text-start">Descripción Técnica</span>
                    </div>
                    <div class="col-12">
                      <span id="descrpTecnica"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12" id="reviDiv">
                <div id="isRevision">

                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer" id="footerCase">
          <button type="button" class="btn btn-secondary rounded text-white fw-bold" data-bs-dismiss="modal">ACEPTAR</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="createModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-6 fw-bold" id="detaModalLabel" style="letter-spacing:0.2rem;">CREAR UN CASO</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body overflow-auto">
          <div class="container p-0 m-0">
            <div id="createDiv">
              <div class="row">
                <div class="col-12">
                  <label id="lblError" class="text-danger fw-bold border border-0 mb-3"></label>
                </div>
                <div class="col-6">
                  <label class="fw-bold mb-2 ms-1">Área</label>
                  <select class="form-select" name="" id="cbbAreas2">
                  </select>
                </div>
                <div class="col-6">
                  <label class="fw-bold mb-2 ms-1">Servicio</label>
                  <select class="form-select text-muted" name="" id="cbbServi2">
                    <option value="">Escoge un área primero</option>
                  </select>
                </div>
                <div class="col-12">
                  <label class="fw-bold mb-1 ms-1 mt-3">Encabezado</label>
                  <div class="input-group rounded">
                    <input id="inputEnca" maxlength="50" type="text" class="form-control rounded"
                      placeholder="Escribe el encabezado" onkeypress="validateInput(event)">
                    <button class="btn btn-danger text-white fw-bold" onclick="addRow1()"><i
                        class="fa-solid fa-square-plus fs-4"></i></button>
                  </div>
                  <div class="form-control rounded border border-0 m-0" id="lblEncas" style="width:100%;">
                  </div>
                </div>
                <div class="col-12">
                  <label class="fw-bold mb-2 ms-1">Compañía</label>
                  <select class="form-select" name="" id="cbbCia">
                    <option value="">Selecciona una compañía</option>
                  </select>
                </div>
                <div class="col-6">
                  <label class="fw-bold mt-4 mb-1 ms-1">Departamento</label>
                  <select class="form-select" name="" id="cbbDepa">
                    <option value="">Selecciona el departamento</option>
                  </select>
                </div>
                <div class="col-6">
                  <label class="fw-bold mt-4 mb-1 ms-1">Sección</label>
                  <select class="form-select text-muted" name="" id="cbbSec">
                    <option value="">Escoge el departamento primero</option>
                  </select>
                </div>
                <div class="col-4  mb-3">
                  <label class="fw-bold mt-4 mb-1 ms-1">Fecha Límite</label>
                  <input type="date" id="inputFecha" class="form-control rounded m-0" style="width:100%;">
                </div>
                <div class="col-8  mb-3">
                  <label class="fw-bold mt-4 mb-1 ms-1">Usuario solicitante</label>
                  <select class="form-select" name="" id="cbbSoli">
                    <option value="">Selecciona un usuario</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer m-0 p-0 p-3">
          <button type="button" class="btn btn-primary rounded text-white fw-bold m-0" onclick="createCase()"></i>
            <i class="fa-solid fa-save"></i> GUARDAR</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="asigModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-6 fw-bold" id="detaModalLabel" style="letter-spacing:0.2rem;">ASIGNAR UN CASO</h1>
          <button type="button" class="btn-close" id="closeButton"></button>
        </div>
        <div class="modal-body overflow-auto">
          <div class="container p-0 m-0">
            <div class="mt-2" id="asigDiv">
              <div class="row">
                <div class="col-12">
                  <label id="lblErrorAsig" class="text-danger fw-bold border border-0 mb-3"></label>
                  <input type="text" id="inputCaso" class="d-none">
                </div>
                <div class="col-12">
                  <label class="fw-bold mb-2 ms-1">Asignar a usuario:</label>
                  <select class="form-select" name="" id="cbbUsuasi">
                    <option value="">Selecciona un usuario</option>
                  </select>
                </div>
                <div class="col-6 mb-3">
                  <label class="fw-bold mt-4 mb-1 ms-1">Prioridad</label>
                  <input type="number" id="inputProri" class="form-control rounded m-0" style="width:100%;"
                    placeholder="1 más alta, 99 más baja" maxlength="2" min="1" max="99">
                </div>
                <div class="col-6 mb-3">
                  <label class="fw-bold mt-4 mb-1 ms-1">Fecha Límite</label>
                  <input type="date" id="inputfecLimit" class="form-control rounded m-0" style="width:100%;">
                </div>
                <div class="col-12">
                  <label class="fw-bold mb-1 ms-1 mt-3">Descripción técnica</label>
                  <div class="input-group rounded">
                    <input id="inputDescrip" maxlength="50" type="text" class="form-control rounded"
                      placeholder="Escribe la descripción técnica" onkeypress="validateInput(event)">
                    <button class="btn btn-danger text-white fw-bold" onclick="addRow2()"><i
                        class="fa-solid fa-square-plus fs-4"></i></button>
                  </div>
                  <div class="container ms-0" style="width:65%;">
                    <div class="form-control rounded border border-0 m-0" id="lblDescrip" style="width:100%;">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer m-0 p-0 p-3">
          <button type="button" class="btn btn-primary rounded text-white fw-bold m-0" onclick="asignarCase()">
            <i class="fa-solid fa-save"></i> GUARDAR</button>
        </div>
      </div>
    </div>
  </div>
</body>

</html>