<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
</head>

<body>
  <?php
    include '../layout-prg.php';
    include '../../assets/php/TBL/ZLO0035P/header.php';
  ?>
  <div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item">
          <span> Tablero / Cronograma de tareas </span>
        </li>
        <li class="breadcrumb-item active"><span>ZLO0035P</span></li>
      </ol>
    </nav>
  </div>
  </header>
  <div id="body-div" class="body flex-grow-3">
    <div class="card p-0 m-0 ps-4" style="background-color:#6B1816;">
      <div class="row mb-2" style="width:100%;">
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
            <label for="cbbUsuario">&nbsp;&nbsp;</label>
            <select class="form-select  fw-bold text-black" name="" id="cbbUsuario">
              <option value="ALL">Todos los usuarios</option>
            </select>
          </div>
        </div>
      </div>
    </div>
    <div id='calendar' class="custom-calendar"></div>
  </div>
  </div>

  </div>
  <div class="footer bg-blck flex-grow-1 d-flex justify-content-center">
    <p class="bggray responsive-font-example"><i>Lovable de Honduras S.A. de C.V</i></p>
  </div>
  <script src="../../assets/vendors/fullcalendar/core.min.js"></script>
  <script src="../../assets/vendors/fullcalendar/daygrid.min.js"></script>
  <script src="../../assets/vendors/fullcalendar/timegrid.min.js"></script>
  <script src="../../assets/vendors/fullcalendar/list.min.js"></script>
  <script>
  let user = '';
  let nivel = 0;
  var calendar;
  let ano = 0;
  let mes = 0;
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
      }).then(() => {
        calendar.render();
        chargeTasks();

      }).then(() => {
        /* setTimeout(() => {
           countVisibleTasks();
         }, 1000);
         var prevButton = document.querySelector('.fc-prev-button');
         prevButton.addEventListener('click', function() {
           setTimeout(countVisibleTasks, 100);
         });

         var nextButton = document.querySelector('.fc-next-button');
         nextButton.addEventListener('click', function() {
           setTimeout(countVisibleTasks, 100);
         });*/
      });
    let urlAreas = "http://172.16.15.20/API.LovablePHP/ZLO0034P/ListAreas/";
    fetch(urlAreas)
      .then(response => response.json())
      .then(data => {
        if (data.code == 200) {
          let responseData = data.data;
          let cbbAreas = document.getElementById('cbbAreas');
          let option = '<option value="">Selecciona un area</option>';
          responseData.forEach(area => {
            option += `<option value="${area.CODARE}">${area.DESCRI}</option>`;
          });
          cbbAreas.innerHTML = option;
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
    //INICIANDO CALENDARIO
    var calendarEl = document.getElementById('calendar');
    calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: 'es',
      headerToolbar: {
        left: 'today,invisible1,invisible2,invisible3',
        center: 'prev,title,next',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },
      views: {
        listWeek: {
          buttonText: 'Lista'
        }
      },
      dayHeaderFormat: {
        weekday: 'long'
      },
      customButtons: {
        invisible1: {
          text: ' ',
          click: function() {}
        },
        invisible2: {
          text: ' ',
          click: function() {}
        },
        invisible3: {
          text: ' ',
          click: function() {}
        }
      },
      showNonCurrentDates: false,
      events: [],
      datesSet: function(info) {
        let currentDate = info.view.currentStart;
        ano = currentDate.getFullYear();
        mes = currentDate.getMonth() +1;
        chargeTasks();
      },
      eventDidMount: function(info) {
        // Agregar evento de doble clic
        info.el.addEventListener('dblclick', function() {
          showDetalles(info.event.extendedProps['cia'], info.event.extendedProps['caso']);
        });
      }
    });
  });

  function chargeTasks() {
    let today = new Date();
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
    let urlTasks =`http://172.16.15.20/API.LovablePHP/ZLO0034P/GetTasks/?ano=${ano}&mes=${mes}&usuario=${usuario}&area=${area}&servi=${servi}&opc=${opcion}`;
    console.log(urlTasks);
    const columnTables = document.querySelectorAll('.columnTable');
    columnTables.forEach(function(div) {
      div.innerHTML = '';
    });
    const tasks = [];
    fetch(urlTasks)
      .then(response => response.json())
      .then(data => {
        calendar.removeAllEvents();
        const currentDate = new Date();
        currentDate.setDate(currentDate.getDate() + 1);
        const currentDateStr = currentDate.toISOString().split('T')[0];
        if (data.code == 200) {
          let responseData = data.data;
          const counterTasks=responseData.length;
          responseData.forEach(task => {
            let colorTask = '#c2c2c2'; // Color por defecto
            let fechaDateFECEN2 = new Date(formatDate(task.FECEN2));
            fechaDateFECEN2.setDate(fechaDateFECEN2.getDate() + 1);
            let fechaTask = fechaDateFECEN2.toISOString().split('T')[0];
            switch (task.ESTADO) {
              case 'F':
                colorTask = isExpired(task.FECEN2, today) ? '#a1d797' : '#d79797';
                fechaTask = currentDateStr;
                break;
              case 'C':
                colorTask = isExpired(task.FECFIN, fechaDateFECEN2) ? '#a1d797' : '#d79797';
                fechaTask = formatFinalDate(task.FECFIN);
                break;
              case 'D':
                colorTask = '#c2c2c2';
                fechaTask = formatFinalDate(task.FECFIN);
                break;
                // Omitir el caso 'B' ya que no parece estar en uso, pero mantener un valor por defecto
              default:
                // Valores por defecto ya están asignados al inicio
                break;
            }
            tasks.push({
              title: `${task.NUMERO} ${task.DESCR1}`,
              start: formatDate(task.FECHA),
              end: fechaTask,
              color: colorTask,
              extendedProps: {
                cia: task.CODCIA,
                caso: task.NUMERO
              }
            });
          });
          let heightCase=90;
          if(counterTasks>=50){
            heightCase=60;
          }else if(counterTasks<=10){
            heightCase=200;
          }
          calendar.setOption('height', (counterTasks * heightCase));
          console.log('Tareas:', counterTasks,' ','Height:', counterTasks * heightCase,'Año:', ano, ' ', 'Mes:', mes);
        } else {

        }
      }).then(() => {
        calendar.addEventSource(tasks);
        countVisibleTasks();
      });
  }

  function formatDate(inputDate) {
    let dateStr = inputDate.toString();
    let year = dateStr.substring(0, 4);
    let month = dateStr.substring(4, 6);
    let day = dateStr.substring(6, 8);
    return `${year}-${month}-${day}`;
  }

  function formatFinalDate(inputDate) {
    let dateStr = inputDate.toString();
    let year = parseInt(dateStr.substring(0, 4));
    let month = parseInt(dateStr.substring(4, 6)) - 1;
    let day = parseInt(dateStr.substring(6, 8));
    let date = new Date(year, month, day);
    date.setDate(date.getDate() + 1);
    let newYear = date.getFullYear();
    let newMonth = String(date.getMonth() + 1).padStart(2, '0');
    let newDay = String(date.getDate()).padStart(2, '0');

    return `${newYear}-${newMonth}-${newDay}`;
  }

  function isExpired(inputDate, today) {
    let dateStr = inputDate.toString();
    let year = parseInt(dateStr.substring(0, 4));
    let month = parseInt(dateStr.substring(4, 6)) - 1;
    let day = parseInt(dateStr.substring(6, 8));
    let inputDateObj = new Date(year, month, day);
    today.setHours(0, 0, 0, 0);
    return inputDateObj >= today;
  }
  /* function countVisibleTasks() {
      var visibleEvents = calendar.getEvents();
      var currentView = calendar.view;
      var startDate = currentView.activeStart;
      var endDate = currentView.activeEnd;

      // Variables para rastrear las semanas con tareas
      let hasTasksInLastWeek = false;
      let hasTasksInThirdWeek = false;

      visibleEvents.forEach(event => {
      var eventStart = new Date(event.start);
      var eventEnd = new Date(event.end);

      if (!eventEnd || eventEnd <= eventStart) {
          eventEnd = new Date(eventStart);
      }

      if (
          (eventStart >= startDate && eventStart < endDate) ||
          (eventEnd > startDate && eventEnd <= endDate) ||
          (eventStart < startDate && eventEnd > endDate)
      ) {
          // Determinar la semana en la que se encuentra el evento
          let weekNumber = Math.floor((eventStart - startDate) / (7 * 24 * 60 * 60 * 1000));
          console.log('Semana:', weekNumber);
          if (weekNumber >= 3) {
          hasTasksInLastWeek = true;
          } else if (weekNumber >= 2) {
          hasTasksInThirdWeek = true;
          }
      }
      });

      // Ajustar la altura del calendario según las semanas con tareas
      if (hasTasksInLastWeek) {
      setCalendarHeight(2400);
      } else if (hasTasksInThirdWeek) {
      setCalendarHeight(1800);
      } else {
      setCalendarHeight(1100);
      }
   }

      function setCalendarHeight(newHeight) {
      if (calendar) {
      calendar.setOption('height', newHeight);
      }
      console.log('Altura del calendario ajustada a:', newHeight, 'px');
      }
  */
  function countVisibleTasks() {
    var visibleEvents = calendar.getEvents();
    var currentView = calendar.view;
    var startDate = currentView.activeStart;
    var endDate = currentView.activeEnd;
    var count = 0;
    visibleEvents.forEach(event => {
      var eventStart = new Date(event.start);
      var eventEnd = new Date(event.end);
      if (!eventEnd || eventEnd <= eventStart) {
        eventEnd = new Date(eventStart);
      }
      if (
        (eventStart >= startDate && eventStart < endDate) ||
        (eventEnd > startDate && eventEnd <= endDate) ||
        (eventStart < startDate && eventEnd > endDate)
      ) {
        count++;
      }
    });
    if (count==0) {
      calendar.setOption('height', 1000);
    }

  }

  function setCalendarHeight(countTasks) {
    const baseHeightPerTask = 150;
    const minHeight = 1150;
    const calculatedHeight = Math.max(minHeight, countTasks * baseHeightPerTask);
    if (calendar) {
      calendar.setOption('height', calculatedHeight);
    }
  }

  function showDetalles(cia, caso) {
    let urlHeader = `http://172.16.15.20/API.LovablePHP/ZLO0034P/FindTask/?cia=${cia}&caso=${caso}`;
    fetch(urlHeader)
      .then((response) => response.json())
      .then((data) => {
        if (data.code == 200) {
          let responseData = data.data;
          idCaso.innerHTML = responseData[0].NUMERO;
          fechaCaso.innerHTML = formatFecha(responseData[0].FECENT.toString(), 2);
          fechaEntrega.innerHTML = formatFecha(
            responseData[0].FECEN2.toString(),
            2
          );
          areaCaso.innerHTML = responseData[0].AREA;
          usuarioGra.innerHTML = responseData[0].USUGRA;
          fechaEntregaTecnica.innerHTML = formatFecha(
            responseData[0].FECENT.toString(),
            2
          );
          servicioCaso.innerHTML = responseData[0].SERVI;
          fechaInicioRevision.innerHTML = formatFecha(
            responseData[0].FECINI.toString(),
            2
          );
          departamentoCaso.innerHTML = responseData[0].DEPA;
          prioridadCaso.innerHTML = responseData[0].PRIORI;
          horaInicioRevision.innerHTML = formatHora(responseData[0].HORINI);
          seccionCaso.innerHTML = responseData[0].SEC;
          fechaRevisionTerminada.innerHTML = formatFecha(
            responseData[0].FECFIN.toString(),
            2
          );
          horaRevisionTerminada.innerHTML = formatHora(responseData[0].HORFIN);
          Descrip1.innerHTML = responseData[0].DESCR1;
          Descrip2.innerHTML = responseData[0].DESCR2;
          lblUsuasi.innerHTML = responseData[0].USUASI;
          $("#colorCaso").empty();
          $("#colorCaso").append(
            `<label class="form-control border border-0 w100 m-0 text-white fw-bold tex-center fs-14" style="background-color: #${responseData[0].COLOR} !important; border-radius:10px;">${responseData[0].COLORD}</label>`
          );
          const file = responseData[0].FILE;
          const exten = responseData[0].EXTEN.trim();
          $("#hasFile").empty();
          if (exten != "") {
            switch (exten) {
              case "pdf":
                $("#hasFile")
                  .append(`<div class="accordion accordion-flush mt-2 border border-1 rounded shadow" id="accordionImageFinal">
                                  <div class="accordion-item">
                                    <h2 class="accordion-header">
                                      <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseOneFinal" aria-expanded="false"
                                        aria-controls="flush-collapseOneFinal">
                                        Archivo PDF adjunto
                                      </button>
                                    </h2>
                                    <div id="flush-collapseOneFinal" class="accordion-collapse collapse"
                                      data-bs-parent="#accordionImageFinal">
                                      <div class="accordion-body">
                                        <embed src="${file}" style="width:100%; height: 70vh !important;" alt="pdf">
                                      </div>
                                    </div>
                                  </div>
                                </div>`);
                break;
              case "png":
              case "jpg":
              case "jpeg":
              case "gif":
                $("#hasFile").append(`
                    <div class="accordion accordion-flush mt-2 border border-1 rounded shadow" id="accordionImage">
                          <div class="accordion-item">
                            <h2 class="accordion-header">
                              <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne" aria-expanded="false"
                                aria-controls="flush-collapseOne">
                              Imagen adjunto
                              </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                              data-bs-parent="#accordionImage">
                              <div class="accordion-body">
                                <img src="${file}" class="img-fluid" alt="Imagen">
                              </div>
                            </div>
                          </div>
                        </div>`);
                break;
              default:
                $("#hasFile")
                  .append(`<p class="Mulifont p-0 m-1 mt-3">Este caso tiene un archivo de ejemplo adjunto.
                      <a href="${file}" download class="fw-bold">
                        Descargalo aquí <i class="fa-solid fa-download text-darkblue"></i>
                      </a>
                      </p>`);
                break;
            }
          }
        } else {
          console.log(data.message);
        }
      });

    let urlFicha = `http://172.16.15.20/API.LovablePHP/ZLO0034P/GetInstructions/?cia=${cia}&caso=${caso}`;
    fetch(urlFicha)
      .then((response) => response.json())
      .then((data) => {
        if (data.code == 200) {
          reviDiv.classList.remove("d-none");
          descpDiv.classList.remove("d-none");
          let responseData = data.data;
          let descripcion = "";
          responseData.forEach((ficha) => {
            descripcion += `<p class="Mulifont p-0 m-1">${ficha.DESCRI}</p>`;
          });
          descrpTecnica.innerHTML = descripcion;
          switch (responseData[0].ESTADO) {
            case "A":
            case "B":
              isRevision.innerHTML = ``;
              break;
            case "F":
              let urlFichaTecnica2 =
                `http://172.16.15.20/API.LovablePHP/ZLO0034P/GetInstructionsF/?cia=${cia}&caso=${caso}`;
              fetch(urlFichaTecnica2)
                .then((response) => response.json())
                .then((data) => {
                  if (data.code == 200) {
                    let responseData = data.data;
                    desFinal = [];
                    responseData.forEach((ficha) => {
                      desFinal.push(ficha.DESCRI);
                    });

                    let divFile = "";
                    if (data.extenP != "") {
                      switch (data.extenP) {
                        case "pdf":
                          divFile = `<div class="accordion accordion-flush mt-2 border border-1 rounded shadow" id="accordionImageFinal">
                                  <div class="accordion-item">
                                    <h2 class="accordion-header">
                                      <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseOneFinal" aria-expanded="false"
                                        aria-controls="flush-collapseOneFinal">
                                        Archivo PDF adjunto
                                      </button>
                                    </h2>
                                    <div id="flush-collapseOneFinal" class="accordion-collapse collapse"
                                      data-bs-parent="#accordionImageFinal">
                                      <div class="accordion-body">
                                       <div class="row">
                                          <div class="col-12 text-end p-0 m-0">
                                          <button onclick="btnBorrar('${caso}')" class="btn btn-danger fw-bold text-white rounded-start rounded-end mb-2 mt-2 me-2">Borrar adjunto</button>
                                          </div>
                                          <div class="col-12">
                                          <embed src="${data.fileP}" style="width:100%; height: 70vh !important;" alt="pdf">
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>`;
                          break;
                        case "png":
                        case "jpg":
                        case "jpeg":
                        case "gif":
                          divFile = `<div class="accordion accordion-flush mt-2 border border-1 rounded shadow" id="accordionImageFinal">
                              <div class="accordion-item">
                                <h2 class="accordion-header">
                                  <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOneFinal" aria-expanded="false"
                                    aria-controls="flush-collapseOneFinal">
                                  Imagen adjunta
                                  </button>
                                </h2>
                                <div id="flush-collapseOneFinal" class="accordion-collapse collapse"
                                  data-bs-parent="#accordionImageFinal">
                                  <div class="accordion-body">
                                    <div class="row">
                                      <div class="col-12 text-end p-0 m-0">
                                       <button onclick="btnBorrar('${caso}')" class="btn btn-danger fw-bold text-white rounded-start rounded-end mb-2 mt-2 me-2">Borrar adjunto</button>
                                      </div>
                                      <div class="col-12">
                                        <img src="${data.fileP}" class="img-fluid" alt="Imagen">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>`;
                          break;
                        default:
                          divFile = `<div class="row">
                                        <div class="col-12 text-end p-0 m-0">
                                        <button onclick="btnBorrar('${caso}')" class="btn btn-danger fw-bold text-white rounded-start rounded-end mb-2 mt-2 me-2">Borrar adjunto</button>
                                        </div>
                                        <div class="col-12">
                                        <p class="Mulifont p-0 m-1 mt-3">Este caso tiene un archivo de ejemplo adjunto.
                                        <a href="${data.fileP}" download class="fw-bold">
                                          Descargalo aquí <i class="fa-solid fa-download text-darkblue"></i>
                                        </a>
                                        </p>
                                        </div>
                                      </div>`;
                          break;
                      }
                    } else {
                      divFile = `<span class="fw-bold text-start">Adjuntar un archivo</span>
                                  <input type="text" id="caseFileUrl" class="d-none">
                                  <input id="caseFile" type="file" class="form-control rounded" style="width:100%;">`;
                    }

                    isRevision.innerHTML = `<div class="form-control border border-0" style="width:100%;">
                              <div class="row">
                              <div class="col-2"></div>
                                <div class="col-8">
                                  <span class="fw-bold text-start">Descripción Técnica Final</span>
                                </div>
                              <div class="col-2"></div>
                              <div class="col-2"></div>
                                <div class="col-8">
                                  <div class="input-group ">
                                    <input id="inputDescripFinal" maxlength="60" type="text" class="form-control rounded-start"
                                      placeholder="Escribe la descripción técnica final" oninput="this.value = this.value.toUpperCase();">
                                    <button class="btn btn-danger text-white fw-bold rounded-end" onclick="addRow3()"><i
                                        class="fa-solid fa-square-plus fs-4"></i></button>
                                  </div>
                                  <div class="container ms-0" style="width:100%;">
                                    <div class="form-control rounded border border-0 m-0" id="lblDescripFinal" style="width:100%;">
                                    </div>
                                  </div>
                                </div>
                              <div class="col-2"></div>
                              <div class="col-2"></div>
                                <div class="col-8">
                                  <span id="lblErrorDesFinal" class="fw-bold text-danger text-center mt-2"></span>
                                   <div id="fileAdjunto">
                                    ${divFile}
                                   </div>
                                </div>
                                <div class="col-2"></div>
                              </div>
                            </div>`;
                    let span = "";
                    $("#lblDescripFinal").empty();
                    desFinal.forEach((des, i) => {
                      span += `<div class="d-flex" style="width:100%;">
                              <label class="border border-0 border-bottom m-1" style="width:100%;">${i + 1
                      }. ${des}</label>
                              <button class="btn btn-secondary rounded m-1 text-white fw-bold" onclick="delRow3(${i})"><i class="fa-solid fa-xmark"></i></button>
                              </div> `;
                    });
                    $("#lblDescripFinal").append(span);
                    footerCase.innerHTML =
                      `<button type="button" class="btn btn-secondary rounded text-white fw-bold" data-bs-dismiss="modal">CANCELAR</button>
                                              <button type="button" class="btn btn-primary rounded text-white fw-bold" onclick="saveDesFinal(${caso},'${responseData[0].USUARI}')"><i class="fa-solid fa-save"></i> GUARDAR</button>`;

                    inputDescripFinal.addEventListener("keypress", function(e) {
                      if (e.key === "Enter") {
                        addRow3();
                      }
                    });
                  } else {
                    isRevision.innerHTML =
                      `<button type="button" class="btn btn-light rounded fw-bold" onclick="addDesFinal(${caso},'${responseData[0].USUARI}')">Ingresar Descripcion Tecnica final <i class="fa-solid fa-pen-to-square  text-darkblue"></i></button>`;
                  }
                });
              break;
            case "C":
            case "D":
              isRevision.innerHTML = `<div class="form-control border border-0" style="width:100%;">
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
                .then((response) => response.json())
                .then((data) => {
                  if (data.code == 200) {
                    let responseData = data.data;
                    let descripcion = "";
                    responseData.forEach((ficha) => {
                      descripcion += `<p class="Mulifont p-0 m-1">${ficha.DESCRI}</p>`;
                    });
                    $("#descrpTecnicaFinal").empty();
                    $("#descrpTecnicaFinal").append(descripcion);
                    //Verificando si tiene archivo
                    let divFile = "";
                    if (data.extenP != "") {
                      switch (data.extenP) {
                        case "pdf":
                          divFile = `<div class="accordion accordion-flush mt-2 border border-1 rounded shadow" id="accordionImageFinal">
                                  <div class="accordion-item">
                                    <h2 class="accordion-header">
                                      <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseOneFinal" aria-expanded="false"
                                        aria-controls="flush-collapseOneFinal">
                                        Archivo PDF adjunto
                                      </button>
                                    </h2>
                                    <div id="flush-collapseOneFinal" class="accordion-collapse collapse"
                                      data-bs-parent="#accordionImageFinal">
                                      <div class="accordion-body">
                                       <div class="row">
                                          <div class="col-12">
                                          <embed src="${data.fileP}" style="width:100%; height: 70vh !important;" alt="pdf">
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>`;
                          break;
                        case "png":
                        case "jpg":
                        case "jpeg":
                        case "gif":
                          divFile = `<div class="accordion accordion-flush mt-2 border border-1 rounded shadow" id="accordionImageFinal">
                              <div class="accordion-item">
                                <h2 class="accordion-header">
                                  <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOneFinal" aria-expanded="false"
                                    aria-controls="flush-collapseOneFinal">
                                  Imagen adjunta
                                  </button>
                                </h2>
                                <div id="flush-collapseOneFinal" class="accordion-collapse collapse"
                                  data-bs-parent="#accordionImageFinal">
                                  <div class="accordion-body">
                                    <div class="row">
                                      <div class="col-12">
                                        <img src="${data.fileP}" class="img-fluid" alt="Imagen">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>`;
                          break;
                        default:
                          divFile = `<div class="row">
                                        <div class="col-12">
                                        <p class="Mulifont p-0 m-1 mt-3">Este caso tiene un archivo de ejemplo adjunto.
                                        <a href="${data.fileP}" download class="fw-bold">
                                          Descargalo aquí <i class="fa-solid fa-download text-darkblue"></i>
                                        </a>
                                        </p>
                                        </div>
                                      </div>`;
                          break;
                      }
                    }
                    isRevision.innerHTML += divFile;
                  } else {
                    console.log(data.message);
                  }
                })
                .catch((error) => {
                  console.error("Error fetching data: ", error);
                });
              break;
            default:
              isRevision.innerHTML = ``;
              break;
          }
        } else {
          descpDiv.classList.add("d-none");
          reviDiv.classList.add("d-none");
        }
      });
    footerCase.innerHTML =
      `<button type="button" class="btn btn-secondary rounded text-white fw-bold" data-bs-dismiss="modal">ACEPTAR</button>`;
    isRevision.innerHTML = ``;
    $("#detaModal").modal("show");
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
  </script>

<div class="modal fade" id="detaModal" data-bs-keyboard="true" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-body overflow-auto ">
          <div class="container bg-white shadow">
            <div class="row ">
              <div class="col-12 ">
                <div class="modal-header">
                  <div class="row w100 p-0">
                    <div class="col-3">
                      <h1 class="modal-title fs-6 fw-bold" id="detaModalLabel" style="letter-spacing:0.2rem;">
                        DETALLES DEL CASO
                      </h1>
                    </div>
                    <div class="col-4 text-end">

                    </div>
                    <div class="col-4">
                      <div class="row m-0 p-0">
                        <div id="colorCaso" class="col-9 m-0 p-0"></div>
                        <div class="col-3 text-end m-0 p-0 mt-2">
                          <span id="lblUsuasi" class="fw-bold text-uppercase text-center m-0 p-0 mt-2"></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-1 text-end"> <button type="button" class="btn-close mt-1" data-bs-dismiss="modal"
                        aria-label="Close"></button></div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="form-control border border-0 border-bottom " style="width:100%;">
                  <div class="row p-2">

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
                    <div class="col-2 text-end">
                      Usuario Gabación:
                    </div>
                    <div class="col-2">
                      <span id="usuarioGra"></span>
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
                    <div class="col-12" id="hasFile">

                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12" id="descpDiv">
                <div class="form-control border border-0 border-bottom" style="width:100%;">
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
              <div class="col-12 p-2" id="reviDiv">
                <div id="isRevision">

                </div>
              </div>
            </div>
          </div>
          <div class="container rounded bg-white shadow-lg p-4 mt-3 text-end" id="footerCase">
            <button type="button" class="btn btn-secondary rounded text-white fw-bold m-0"
              data-bs-dismiss="modal">ACEPTAR</button>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>