<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
  <link rel="stylesheet" href="../../assets/css/flexselect.css">
</head>

<body>
  <?php
      include '../layout-prg.php';
      include '../../assets/php/TBL/ZLO0034P/header.php';
    ?>
  <div class="container-fluid">
    <div class="d-flex justify-content-between w100">
      <div>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2 mt-1">
            <li class="breadcrumb-item">
              <span> Tablero / Casos asignados </span>
            </li>
            <li class="breadcrumb-item active"><span>Módulo de casos web</span></li>
          </ol>
        </nav>
      </div>
      <div>
        <div class="input-group">
          <input class="form-control fw-bold text-black m-0 p-0 p-2 rounded-start"
            style="height:40px !important; width: 350px !important;" id="inputDescrp"
            placeholder="Buscar descripción o número del caso...">
          <div id="descriButton">
            <button class="btn btn-danger text-white fw-bold rounded-end m-0 p-0 p-2"
              style="height:40px !important; margin-right: 120px !important;" onclick="searchDescri()" type="button">
              <i class="fa-solid fa-magnifying-glass"></i>BUSCAR
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  </header>
  <div id="body-div" class="body flex-grow-3 bg-white">
    <div class="card p-0 m-0 ps-4" style="background-color: rgba(61, 11, 13,1);">
      <div class="row mb-2" style="width:100%;">
        <div class="col-3 d-none" id="divPercas">
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
            <label for="cbbUsuario">&nbsp;&nbsp;</label>
            <select class="form-select  fw-bold text-black" name="" id="cbbUsuario">
              <option value="ALL">Todos los usuarios</option>
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
        <input type="text" class="d-none" id="columSearched">
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
  <script src="../../assets/vendors/dayrangepicker/index.umd.min.js"></script>
  <script src="../../assets/js/jquery.flexselect.js"></script>
  <script src="../../assets/js/liquidmetal.js"></script>
  <script>
  let user = '';
  let percas = '';
  let percin = '';
  let nivel = 0;
  const drake = dragula();
  let contador = 1;
  let divHeader = null;
  let divBody = null;
  let divBox = null;
  let divContent = null;
  let urlHeader = "";
  let enca = [];
  let encaEdit = [];
  let desTecnica = [];
  let desTecnicaEdit = [];
  let desFinal = [];
  let optionUsuarios = "";
  let optionCias = "";
  let optionDepas = "";
  let optionAreas = "";
  let objEl;
  let objSour;
  let tipoSearch = "";
  let picker1 = null;
  document.addEventListener("DOMContentLoaded", function() {
    user = "<?php echo isset($_SESSION['CODUSU'])? $_SESSION['CODUSU']: ''; ?>";
    percas = "<?php echo isset($_SESSION['PERCAS'])? $_SESSION['PERCAS']: ''; ?>";
    percin = "<?php echo isset($_SESSION['PERCIN'])? $_SESSION['PERCIN']: ''; ?>";
    let urlFind =
      "http://172.16.15.20/API.LovablePHP/ZLO0034P/FindUsua/?usuario=" + user;
    fetch(urlFind)
      .then((response) => response.json())
      .then((data) => {
        let urlUsuarios =
            "http://172.16.15.20/API.LovablePHP/ZLO0034P/ListUsua/";
          fetch(urlUsuarios)
            .then((response) => response.json())
            .then((data) => {
              if (data.code == 200) {
                let responseData = data.data;
                let cbbUsuario = document.getElementById("cbbUsuario");
                responseData.forEach((usuario) => {
                  let option = document.createElement("option");
                  option.value = usuario.USUARI;
                  option.innerHTML = usuario.USUARI;
                  cbbUsuario.appendChild(option);
                  optionUsuarios += `<option value="${usuario.USUARI}">${usuario.USUARI}</option>`;
                });
                cbbUsuario.value =
                  getCookie("usuaCbb") == "" || getCookie("usuaCbb") == null ?
                  "ALL" :
                  getCookie("usuaCbb");
              } else {
                console.log(data.message);
              }
            });
        if (data.code == 200) {
          let responseData = data.data;
          if (responseData[0].NIVUSR == 1) {
            $(".divUsuario").removeClass("d-none");
            nivel = 1;
            cbbUsuario.addEventListener("change", function() {
              setCookie("usuaCbb", cbbUsuario.value, 1);
              chargeTasks();
            });
          }
        }
      });
    urlHeader = "http://172.16.15.20/API.LovablePHP/ZLO0034P/GetHeaders/?opc=0&usuario=" + user;
    chargeHeader();
    btnColumns.addEventListener("change", function() {
      if (btnColumns.checked) {
        urlHeader =
          "http://172.16.15.20/API.LovablePHP/ZLO0034P/GetHeaders/?opc=1&usuario=" +
          user;
        chargeHeader();
      } else {
        urlHeader =
          "http://172.16.15.20/API.LovablePHP/ZLO0034P/GetHeaders/?opc=0&usuario=" +
          user;
        chargeHeader();
      }
    });
    let urlAreas = "http://172.16.15.20/API.LovablePHP/ZLO0034P/ListAreas/";
    fetch(urlAreas)
      .then((response) => response.json())
      .then((data) => {
        if (data.code == 200) {
          let responseData = data.data;
          let cbbAreas = document.getElementById("cbbAreas");
          let cbbAreas2 = document.getElementById("cbbAreas2");
          let cbbAreas2EditArea = document.getElementById("cbbAreas2EditA");
          let option = '<option value="">Selecciona un area</option>';
          responseData.forEach((area) => {
            option += `<option value="${area.CODARE}">${area.DESCRI}</option>`;
          });
          cbbAreas.innerHTML = option;
          cbbAreas2.innerHTML = option;
          cbbAreas2EditArea.innerHTML = option;
          cbbAreas.value =
            getCookie("areaCbb") == "" || getCookie("areaCbb") == null ?
            "" :
            getCookie("areaCbb");

          if (getCookie("serviCbb") != "" && getCookie("serviCbb") != null) {
            const cbbValue = cbbAreas.value;
            const cbbServi = document.getElementById("cbbServi");
            if (cbbValue == "") {
              cbbServi.classList.add("text-muted");
              cbbServi.innerHTML =
                '<option value="">Escoge un área primero</option>';
            } else {
              let urlServicios = `http://172.16.15.20/API.LovablePHP/ZLO0034P/ListServicios/?area=${cbbValue}`;
              fetch(urlServicios)
                .then((response) => response.json())
                .then((data) => {
                  if (data.code == 200) {
                    let responseData = data.data;
                    cbbServi.classList.remove("text-muted");
                    let option =
                      '<option value="">Selecciona un servicio</option>';
                    responseData.forEach((servicio) => {
                      option += `<option value="${servicio.CODSER}">${servicio.DESCRI}</option>`;
                    });
                    cbbServi.innerHTML = option;
                    cbbServi.value =
                      getCookie("serviCbb") == "" || getCookie("serviCbb") == null ?
                      "" :
                      getCookie("serviCbb");
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
    cbbAreas.addEventListener("change", function() {
      const cbbValue = cbbAreas.value;
      setCookie("areaCbb", cbbValue, 1);
      setCookie("serviCbb", "", 1);
      const cbbServi = document.getElementById("cbbServi");
      if (cbbValue == "") {
        cbbServi.classList.add("text-muted");
        cbbServi.innerHTML = '<option value="">Escoge un área primero</option>';
      } else {
        let urlServicios = `http://172.16.15.20/API.LovablePHP/ZLO0034P/ListServicios/?area=${cbbValue}`;
        fetch(urlServicios)
          .then((response) => response.json())
          .then((data) => {
            if (data.code == 200) {
              let responseData = data.data;
              cbbServi.classList.remove("text-muted");
              let option = '<option value="">Selecciona un servicio</option>';
              responseData.forEach((servicio) => {
                option += `<option value="${servicio.CODSER}">${servicio.DESCRI}</option>`;
              });
              cbbServi.innerHTML = option;
              cbbServi.value =
                getCookie("serviCbb") == "" || getCookie("serviCbb") == null ?
                "" :
                getCookie("serviCbb");
            } else {
              console.log(data.message);
            }
          });
      }
      chargeTasks();
    });
    cbbServi.addEventListener("change", function() {
      const cbbValue = cbbServi.value;
      setCookie("serviCbb", cbbValue, 1);
      chargeTasks();
    });
    cbbAreas2.addEventListener("change", function() {
      const cbbValue = cbbAreas2.value;
      const cbbServi2 = document.getElementById("cbbServi2");
      if (cbbValue == "") {
        cbbServi2.classList.add("text-muted");
        cbbServi2.innerHTML = '<option value="">Escoge un área primero</option>';
      } else {
        let urlServicios = `http://172.16.15.20/API.LovablePHP/ZLO0034P/ListServicios/?area=${cbbValue}`;
        fetch(urlServicios)
          .then((response) => response.json())
          .then((data) => {
            if (data.code == 200) {
              let responseData = data.data;
              cbbServi2.classList.remove("text-muted");
              let option = '<option value="">Selecciona un servicio</option>';
              responseData.forEach((servicio) => {
                option += `<option value="${servicio.CODSER}">${servicio.DESCRI}</option>`;
              });
              cbbServi2.innerHTML = option;
            } else {
              console.log(data.message);
            }
          });
      }
    });
    cbbAreas2EditA.addEventListener("change", function() {
      const cbbValue = cbbAreas2EditA.value;
      const cbbServi2EditA = document.getElementById("cbbServi2EditA");
      if (cbbValue == "") {
        cbbServi2EditA.classList.add("text-muted");
        cbbServi2EditA.innerHTML =
          '<option value="">Escoge un área primero</option>';
      } else {
        const cbbServi2EditA = document.getElementById("cbbServi2EditA");
        let urlServicios = `http://172.16.15.20/API.LovablePHP/ZLO0034P/ListServicios/?area=${cbbValue}`;
        fetch(urlServicios)
          .then((response) => response.json())
          .then((data) => {
            if (data.code == 200) {
              let responseData = data.data;
              cbbServi2EditA.classList.remove("text-muted");
              let option = '<option value="">Selecciona un servicio</option>';
              responseData.forEach((servicio) => {
                option += `<option value="${servicio.CODSER}">${servicio.DESCRI}</option>`;
              });
              cbbServi2EditA.innerHTML = option;
            } else {
              console.log(data.message);
            }
          });
      }
    });
    let urlComarc = "/API.LovablePHP/ZLO0015P/ListComarc2/?user=" + user + "";
    let responseComarc = ajaxRequest(urlComarc);
    optionCias = '<option value=""> </option>';
    if (responseComarc.code == 200) {
      for (let i = 0; i < responseComarc.data.length; i++) {
        optionCias +=
          '<option value="' +
          responseComarc.data[i].COMCOD.padStart(2, "0") +
          '">' +
          responseComarc.data[i].COMDES +
          "</option>";
      }
    }
    const urlDepas = "http://172.16.15.20/API.LovablePHP/ZLO0034P/ListDepas/";
    fetch(urlDepas)
      .then((response) => response.json())
      .then((data) => {
        if (data.code == 200) {
          let responseData = data.data;
          let cbbDepa = document.getElementById("cbbDepa");
          optionDepas = '<option value=""></option>';
          responseData.forEach((depa) => {
            optionDepas += `<option value="${depa.DEPCOD}">${depa.DEPDES}</option>`;
          });
        } else {
          console.log(data.message);
        }
      });

    createModal.addEventListener("show.bs.modal", function() {
      cbbAreas2.value = "";
      cbbServi2.value = "";
      $("#cbbDepaDiv").empty();
      $("#cbbDepaDiv").append(
        `<select class="form-select" name="" id="cbbDepa"></select>`
      );
      $("#cbbDepa").empty();
      $("#cbbDepa").append(optionDepas);
      $("#cbbDepa").flexselect();
      $("#cbbSecDiv").empty();
      $("#cbbSecDiv").append(
        `<select class="form-select" name="" id="cbbSec"></select>`
      );
      $("#cbbDepa").on("change", () => {
        $("#cbbSecDiv").empty();
        $("#cbbSecDiv").append(
          `<select class="form-select" name="" id="cbbSec"></select>`
        );
        if ($("#cbbDepa").val() != "") {
          const urlSeccion =
            "http://172.16.15.20/API.LovablePHP/ZLO0034P/ListSecc/?depa=" +
            $("#cbbDepa").val();
          fetch(urlSeccion)
            .then((response) => response.json())
            .then((data) => {
              if (data.code == 200) {
                let responseData = data.data;
                let cbbSeccion = document.getElementById("cbbSec");
                cbbSeccion.classList.remove("text-muted");
                let option = '<option value=""></option>';
                responseData.forEach((servicio) => {
                  option += `<option value="${servicio.SECCOD}">${servicio.SECDES}</option>`;
                });
                cbbSec.innerHTML = option;
                $("#cbbSec").flexselect();
              } else {
                console.log(data.message);
              }
            });
        }
      });
      $("#cbbCiaDiv").empty();
      $("#cbbCiaDiv").append(
        `<select class="form-select" name="" id="cbbCia"></select>`
      );
      $("#cbbCia").empty();
      $("#cbbCia").append(optionCias);
      $("#cbbCia").flexselect();
      enca = [];
      lblEncas.innerHTML = "";
      inputFecha.value = "";
      inputEnca.disabled = false;
      if(nivel == 0 && percas == "S"){
        $("#txtSoli").val(user);
        $("#txtSoli").prop("disabled",true);
      }else{
        txtSoli.value = "";
      }
      imagenInput.value = "";
    });
    $("#inputEnca").on('input', () => {
      const currentLength = $("#inputEnca").val().length;
      $("#inputEncaCaracteres").text(50 - currentLength);
    });
    inputEnca.addEventListener("keypress", function(e) {
      if (e.key === "Enter") {
        addRow1();
      }
    });
    inputEncaEditA.addEventListener("keypress", function(e) {
      if (e.key === "Enter") {
        addRow4();
      }
    });
    inputDescrip.addEventListener("keypress", function(e) {
      if (e.key === "Enter") {
        addRow2();
      }
    });
    inputDescripB.addEventListener("keypress", function(e) {
      if (e.key === "Enter") {
        addRow5();
      }
    });
    inputProri.addEventListener("input", function() {
      var value = parseInt(this.value, 10); // Convierte el valor del input a un número entero
      if (value < 1) {
        this.value = 1;
      } else if (value > 99) {
        this.value = 99;
      }
    });
    let currentDate = new Date();
    let d1ini = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1).toISOString().split("T")[0].replace(
      /-/g, "");
    let d2fin = currentDate.toISOString().split("T")[0].replace(/-/g, "");
    Date1 = formatFecha(d1ini, 2);
    Date2 = formatFecha(d2fin, 2);
    picker1 = new easepick.create({
      element: "#datepicker1",
      css: ["../../assets/vendors/dayrangepicker/index.css"],
      zIndex: 10,
      plugins: ["RangePlugin"],
    });
    closeButton.addEventListener("click", function() {
      closeAsigModal(objEl, objSour);
    });
    $("#inputDescrp").on("keypress", function(e) {
      if (e.key === "Enter") {
        searchDescri();
      }
    });
    $("#inputSearch").on("keypress", function(e) {
      if (e.key === "Enter") {
        searchNumero();
      }
    });

  });

  function openAsigModal() {
    $("#asigModal").modal("show");
    inputProri.value = "";
    inputfecLimit.value = "";
    inputDescrip.value = "";
    lblDescrip.innerHTML = "";
    desTecnica = [];
    $("#cbbUsuasiDiv").empty();
    $("#cbbUsuasiDiv").append(`<select class="form-select" name="" id="cbbUsuasi">
                                <option value=""></option>
                              </select>`);
    $("#cbbUsuasi").append(optionUsuarios);
    $("#cbbUsuasi").flexselect();
    let cia = 1;
    let caso = inputCaso.value;
    let urlHeader = `http://172.16.15.20/API.LovablePHP/ZLO0034P/FindTask/?cia=${cia}&caso=${caso}`;
    fetch(urlHeader)
      .then((response) => response.json())
      .then((data) => {
        if (data.code == 200) {
          let responseData = data.data;
          idCasoAsig.innerHTML = responseData[0].NUMERO;
          fechaCasoAsig.innerHTML = formatFecha(
            responseData[0].FECENT.toString(),
            2
          );
          fechaEntregaAsig.innerHTML = formatFecha(
            responseData[0].FECEN2.toString(),
            2
          );
          areaCasoAsig.innerHTML = responseData[0].AREA;
          usuarioGraAsig.innerHTML = responseData[0].USUGRA;
          fechaEntregaTecnicaAsig.innerHTML = formatFecha(
            responseData[0].FECENT.toString(),
            2
          );
          servicioCasoAsig.innerHTML = responseData[0].SERVI;
          fechaInicioRevisionAsig.innerHTML = formatFecha(
            responseData[0].FECINI.toString(),
            2
          );
          departamentoCasoAsig.innerHTML = responseData[0].DEPA;
          prioridadCasoAsig.innerHTML = responseData[0].PRIORI;
          horaInicioRevisionAsig.innerHTML = formatHora(responseData[0].HORINI);
          seccionCasoAsig.innerHTML = responseData[0].SEC;
          fechaRevisionTerminadaAsig.innerHTML = formatFecha(
            responseData[0].FECFIN.toString(),
            2
          );
          horaRevisionTerminadaAsig.innerHTML = formatHora(
            responseData[0].HORFIN
          );
          Descrip1Asig.innerHTML = responseData[0].DESCR1;
          Descrip2Asig.innerHTML = responseData[0].DESCR2;
          const file = responseData[0].FILE;
          const exten = responseData[0].EXTEN.trim();
          $("#hasFileAsig").empty();
          if (exten != "") {
            switch (exten) {
              case "pdf":
                $("#hasFileAsig")
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
                $("#hasFileAsig").append(`
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
                $("#hasFileAsig")
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
  }

  function chargeHeader() {
    const tableHeader = document.getElementById("tableHeader");
    const bodyHeader = document.getElementById("bodyHeader");
    tableHeader.innerHTML = "";
    bodyHeader.innerHTML = "";
    fetch(urlHeader)
      .then((response) => response.json())
      .then((data) => {
        let responseData = data.data;
        responseData.forEach((header) => {
          let totalColumn = header.TOTALROWS;
          let widthColumn = 100 / totalColumn;
          divHeader = document.createElement("div");
          divHeader.className =
            "p-2 rounded fw-bold text-title border border-2 shadow text-white d-flex justify-content-center align-items-center";
          divHeader.style.backgroundColor = "rgba(61, 11, 13,1)";
          divHeader.style.width = `${widthColumn - 0.5}%`;
          divHeader.innerHTML = header.DESCRI;
          tableHeader.appendChild(divHeader);
          if (header.ESTADO == "A") {
            let buttonCreate = document.createElement("button");
            buttonCreate.className = "btn btn-light rounded m-0 pt-0 pb-0";
            buttonCreate.innerHTML = '<i class="fa-solid fa-plus"></i>';
            buttonCreate.addEventListener("click", function() {
              lblError.innerHTML = "";
              $("#createModal").modal("show");
            });
            let span = document.createElement("span");
            span.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            divHeader.appendChild(span);
            divHeader.appendChild(buttonCreate);
          } else {
            if (nivel == 1) {
              if (header.ESTADO == "C" || header.ESTADO == "D") {
                const inputs = `<button id="${header.ESTADO}-dropdown" onclick="openModal('${header.ESTADO}')" class="btn btn-secondary bg-transparent border border-0  m-0 p-0 p-2 rounded fw-bold text-title border border-2 shadow text-white dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                ${header.DESCRI}
                                 <span id="${header.ESTADO}-span" ></span>
                                 <input type="text" class="d-none" id="${header.ESTADO}-input1" />
                                 <input type="text" class="d-none" id="${header.ESTADO}-input2" />
                              </button>

                              `;

                divHeader.innerHTML = inputs;
              }
            } else {}
          }
          divBody = document.createElement("div");
          divBody.id = "column-" + contador;
          if (nivel == 0) {
            if (header.ESTADO == "B" || header.ESTADO == "F") {
                divBody.className =
                  header.ESTADO +
                  " " +
                  "columnTable overflow-auto rounded border border-2 shadow drag-" +
                  contador;
              } else {
                //divBody.className = header.ESTADO + ' ' +'columnTable overflow-auto rounded border border-2 shadow done drag-' + contador;
                divBody.className =
                  header.ESTADO +
                  " " +
                  "columnTable overflow-auto rounded border border-2 shadow drag-" +
                  contador;
              }
          } else {
            divBody.className =
              header.ESTADO +
              " " +
              "columnTable overflow-auto rounded border border-2 shadow drag-" +
              contador;
          }
          divBody.style.backgroundColor = "rgba(61, 11, 13,0.1)";
          divBody.style.width = `${widthColumn - 0.5}%`;
          divBody.style.height = "100%";
          bodyHeader.appendChild(divBody);
          drake.containers.push(divBody);
          contador++;
        });
        if (percas == "S" && nivel == 0) {
          let buttonCreate = document.createElement("button");
          buttonCreate.className = "btn btn-light rounded fw-bold";
          buttonCreate.innerHTML =
            'Crear un caso <i class="fa-solid fa-plus"></i>';
          buttonCreate.addEventListener("click", function() {
            lblError.innerHTML = "";
            $("#createModal").modal("show");
          });
          const divPercas = document.getElementById("divPercas");
          divPercas.appendChild(buttonCreate);
          $("#divPercas").removeClass("d-none");
        }
        chargeTasks();
        drake.off("drop").on("drop", function(el, target, source, sibling) {
          changeState(el, target, source, sibling);
        });

        classnames();
      });
  }

  function classnames() {
    for (let i = 1; i < contador; i++) {
      $(`.drag-${i} .box`)
        .attr("class", `box box${i}`)
        .removeClass(function(index, className) {
          return (className.match(/(^|\s)box\S+/g) || []).join(" ");
        });
    }
  }

  function changeState(el, target, source, sibling) {
    let estadoInicial = source.className.split(" ")[0];
    let estadoFinal = target.className.split(" ")[0];
    let id = el.id;
    let fecha = currentDate();
    let hora = currentTime();
    if(percin=='S' || nivel==1){
      switch (estadoInicial) {
      case "A":
        switch (estadoFinal) {
          case "B":
            objEl = el;
            objSour = source;
            lblErrorAsig.innerHTML = "";
            inputCaso.value = id;
            openAsigModal();
            setTimeout(() => {
              document.getElementById("inputfecLimit").value = new Date()
                .toISOString()
                .split("T")[0];
            }, 100);
            break;
          case "E":
            stateTask(id, estadoFinal, fecha, hora);
            break;

          default:
            break;
        }
        break;
      case "F":
        if (estadoFinal == "A") {
          stateTask(id, estadoFinal, fecha, hora);
        } else if (estadoFinal == "C") {
          let urlFichaTecnica = `http://172.16.15.20/API.LovablePHP/ZLO0034P/GetInstructionsF/?cia=1&caso=${id}`;
          fetch(urlFichaTecnica)
            .then((response) => response.json())
            .then((data) => {
              if (data.code == 500) {
                source.appendChild(el);
                Swal.fire({
                  icon: "error",
                  title: "No se ha ingresado la descripción técnica final",
                });
              } else {
                stateTask(id, estadoFinal, fecha, hora);
              }
            })
            .catch((error) => {
              console.error("Error fetching data: ", error);
            });
          source.appendChild(el);
        } else if (estadoFinal == "B") {
          if (nivel == 1) {
            stateTask(id, estadoFinal, fecha, hora);
          } else {
            source.appendChild(el);
          }
        }
        break;
      case "E":
        stateTask(id, estadoFinal, fecha, hora);
        break;
      case "B":
        if (estadoFinal == "C") {
          let urlFichaTecnica = `http://172.16.15.20/API.LovablePHP/ZLO0034P/GetInstructionsF/?cia=1&caso=${id}`;
          fetch(urlFichaTecnica)
            .then((response) => response.json())
            .then((data) => {
              if (data.code == 500) {
                source.appendChild(el);
                Swal.fire({
                  icon: "error",
                  title: "No se ha ingresado la descripción técnica final",
                });
              } else {
                stateTask(id, estadoFinal, fecha, hora);
              }
            })
            .catch((error) => {
              console.error("Error fetching data: ", error);
            });
          source.appendChild(el);
        } else {
          if (estadoFinal != "D") {
            stateTask(id, estadoFinal, fecha, hora);
          }
        }
        break;
      case "C":
        if (estadoFinal == "F" && nivel == 1) {
          stateTask(id, estadoFinal, fecha, hora);
        } else if (estadoFinal == "D" && nivel == 1) {
          stateTask(id, estadoFinal, fecha, hora);
        } else {
          source.appendChild(el);
        }
        break;
      case "D":
        if ((estadoFinal == "C" && nivel == 1) || estadoFinal == "E") {
          stateTask(id, estadoFinal, fecha, hora);
        } else {
          source.appendChild(el);
        }
        break;
      default:
        stateTask(id, estadoFinal, 0, 0);
        break;
    }
            }else{
              source.appendChild(el);
            }
    
  }

  function closeAsigModal(el, source) {
    source.appendChild(el);
    $("#asigModal").modal("hide");
  }

  function chargeTasks() {
    let ano = new Date().getFullYear();
    let mes = new Date().getMonth() + 1;
    let usuario = "";
    let area = "";
    let servi = "";
    let descrp = $("#inputDescrp").val();
    const cookieUsua = getCookie("usuaCbb");
    const cookieArea = getCookie("areaCbb");
    const cookieServi = getCookie("serviCbb");
    const numero = $("#inputSearch").val();
    let dini = 0;
    let dfin = 0;
    if (numero=="") {
      if (tipoSearch != "") {
        if (tipoSearch == "C") {
          dini = $("#C-input1").val();
          dfin = $("#C-input2").val();
        } else if (tipoSearch == "D") {
          dini = $("#D-input1").val();
          dfin = $("#D-input2").val();
        }
      }
    }
    if (nivel == 1) {
      if (cookieUsua != "" && cookieUsua != null) {
        usuario = cookieUsua;
      } else {
        usuario = document.getElementById("cbbUsuario").value;
      }
      if (cookieArea != "" && cookieArea != null) {
        area = cookieArea;
      } else {
        area = document.getElementById("cbbAreas").value;
      }
      if (cookieServi != "" && cookieServi != null) {
        servi = cookieServi;
      } else {
        servi = document.getElementById("cbbServi").value;
      }
    } else {
      usuario =
        "<?php echo isset($_SESSION['CODUSU'])? $_SESSION['CODUSU']: ''; ?>";
    }
    let opcion = 0;
    if (btnColumns.checked) {
      opcion = 1;
    }
    let urlTasks =
      `http://172.16.15.20/API.LovablePHP/ZLO0034P/GetTasksB/?ano=${ano}&mes=${mes}&usuario=${usuario}&area=${area}&servi=${servi}&opc=${opcion}&descri=${user}&descrp=${descrp}&nivel=${tipoSearch}&eori=${dini}&efin=${dfin}&numero=${numero}`;
      const columnTables = document.querySelectorAll(".columnTable");
    columnTables.forEach(function(div) {
      div.innerHTML = `<div class="position-relative" style="height:100% !important; background-color: rgba(255,255,255,0.4)">
                        <div class="position-absolute top-50 start-50 translate-middle">
                        <i class="fa-solid fa-spinner fa-spin" style="font-size:50px !important; color: red;"></i>
                        </div>
                      </div>`;
    });
    fetch(urlTasks)
      .then((response) => response.json())
      .then((data) => {
        const currentDate = new Date(new Date().toISOString().split("T")[0]);
        if (data.code == 200) {
          columnTables.forEach(function(div) {
            div.innerHTML = "";
          });
          let responseData = data.data;
          responseData.forEach((task) => {
            let fechaLimite = "";
            let fecha = new Date(formatFecha(task.FECEN2, 1));
            if (currentDate > fecha) {
              fechaLimite = `<div class="d-flex justify-content-between"><span class="fw-bold text-darkblue">Prioridad: ${task.PRIORI
              }</span>
                            <span class="fw-bold text-darkblue">Creado: ${formatFecha(
                task.FECHA.toString(),
                2
              )}</span></div>
                            <br />
                            <span class="text-danger">Fecha limite: ${formatFecha(
                task.FECEN2.toString(),
                2
              )}</span>`;
            } else {
              fechaLimite = `<div class="d-flex justify-content-between"><span class="fw-bold text-darkblue">Prioridad: ${task.PRIORI
              }</span>
                            <span class="fw-bold text-darkblue">Creado: ${formatFecha(
                task.FECHA.toString(),
                2
              )}</span></div>
                            <br />
                            <span class="text-secondary">Fecha limite: ${formatFecha(
                task.FECEN2.toString(),
                2
              )}</span>`;
            }
            let buttons = "";
            if (nivel == 1) {
              if (task.ESTADO == "A") {
                buttons =
                  `<li><button class="dropdown-item  fw-bold" type="button" onclick="confirmDelete('${task.NUMERO}','E',0,0)">Eliminar <i class="fa-solid fa-trash text-danger"></i></button></li>
                                                  <li><button class="dropdown-item  fw-bold" onclick="editarCasoA('${task.NUMERO}')" type="button">Editar <i class="fa-solid fa-pen-to-square text-warning"></i></button></li>
                                                  <li><button class="dropdown-item  fw-bold" type="button" onclick="openColorModal('${task.NUMERO}')" >Color <i class="fa-solid fa-palette text-primary"></i></button></li>`;
              } else if (task.ESTADO == "B") {
                buttons =
                  `<li><button class="dropdown-item  fw-bold" type="button" onclick="confirmDelete('${task.NUMERO}','E',0,0)">Eliminar <i class="fa-solid fa-trash text-danger"></i></button></li>
                                                  <li><button class="dropdown-item  fw-bold" onclick="editarCasoB('${task.NUMERO}')" type="button">Editar <i class="fa-solid fa-pen-to-square text-warning"></i></button></li>
                                                  <li><button class="dropdown-item  fw-bold" type="button" onclick="openColorModal('${task.NUMERO}')" >Color <i class="fa-solid fa-palette text-primary"></i></button></li>`;
              } else {
                buttons =
                  `<li><button class="dropdown-item  fw-bold" type="button" onclick="confirmDelete('${task.NUMERO}','E',0,0)">Eliminar <i class="fa-solid fa-trash text-danger"></i></button></li>
                                                  <li><button class="dropdown-item  fw-bold" type="button" onclick="openColorModal('${task.NUMERO}')">Color <i class="fa-solid fa-palette text-primary"></i></button></li>`;
              }
            } else {
              //buttons =`<li><button class="dropdown-item  fw-bold" type="button">Color <i class="fa-solid fa-palette text-primary"></i></button></li>`;
            }

            let column = document.getElementsByClassName(task.ESTADO);
            let boxTask = `<div class="box" id="${task.NUMERO}">
                              <div class="card mb-1" style="border: 3px #${task.COLOR} solid; border-radius: 10px;">
                                    <div class="card-header fw-bold " style="font-size:13px;">
                                        <div class="d-flex justify-content-between">
                                            <div class="text-start>
                                                <span class="fw-bold">${task.NUMERO}   ${task.USUASI}</span>
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
            column.innerHTML = "";
            column[0].innerHTML += boxTask;
          });
        } else {
          columnTables.forEach(function(div) {
            div.innerHTML = `<div class="position-relative" style="height:100% !important; background-color: rgba(255,255,255,0.6)">
                                  <div class="position-absolute top-50 start-50 translate-middle">
                                     <p>No se encontraron casos</p>
                                  </div>
                                </div>`;
          });
        }
      });
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
                                      placeholder="Escribe la descripción técnica final" >
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

  function btnBorrar(caso) {
    const url = `http://172.16.15.20/API.LovablePHP/ZLO0034P/DeleteFile/?caso=${caso}`;
    fetch(url)
      .then((response) => response.json())
      .then((data) => {
        if (data.code == 200) {
          $("#fileAdjunto").empty();
          $("#fileAdjunto")
            .append(`<span class="fw-bold text-start">Adjuntar un archivo</span>
                                  <input type="text" id="caseFileUrl" class="d-none">
                                  <input id="caseFile" type="file" class="form-control rounded" style="width:100%;">`);
        } else {
          Swal.fire({
            icon: "error",
            title: "Error al eliminar el archivo",
          });
        }
      });
  }

  function btnBorrarEditar(caso) {
    $("#fileAdjuntoEditA").empty();
    $("#fileAdjuntoEditA").append(
      `<input type="text" id="caseFileUrlEditA" class="d-none" value="">
                                  <span class="fw-bold text-start">Adjuntar un archivo</span>
                                  <input id="imagenInputEditA" type="file" class="form-control rounded" style="width:100%;">`
    );
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
          fecha = fecha.replace(/-/g, "");
          break;
      }

      return fecha;
    } else {
      return "";
    }
  }

  function formatHora(hora) {
    if (hora.length < 6) {
      hora = "0" + hora;
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
    let inputEnca = document.getElementById("inputEnca");
    if (enca.length < 2 && inputEnca.value != "") {
      enca.push(inputEnca.value);
      inputEnca.value = "";
      let span = "";
      enca.forEach((enca, i) => {
        span = `<div class="d-flex" style="width:100%;">
              <label class="border border-0 border-bottom m-1" style="width:100%;">${i + 1
        }. ${enca}</label>
              <button class="btn btn-secondary rounded m-1 text-white fw-bold" onclick="delRow1(${i})"><i class="fa-solid fa-xmark"></i></button>
              </div> `;
      });
      $("#lblEncas").append(span);
      if (enca.length == 2) {
        inputEnca.disabled = true;
      }
      lblError.innerHTML = "";
      $("#inputEncaCaracteres").text(50);
    }
  }

  function delRow1(index) {
    enca.splice(index, 1);
    inputEnca.disabled = false;
    let span = "";
    $("#lblEncas").empty();
    enca.forEach((enca, i) => {
      span = `<div class="d-flex" style="width:100%;">
              <label class="border border-0 border-bottom m-1" style="width:100%;">${i + 1
      }. ${enca}</label>
              <button class="btn btn-secondary rounded m-1 text-white fw-bold" onclick="delRow1(${i})"><i class="fa-solid fa-xmark"></i></button>
              </div> `;
    });
    $("#lblEncas").append(span);
  }

  function addRow2() {
    let inputDescrip = document.getElementById("inputDescrip");
    if (inputDescrip.value != "") {
      desTecnica.push(inputDescrip.value);
      inputDescrip.value = "";
      let span = "";
      desTecnica.forEach((des, i) => {
        span = `<div class="d-flex" style="width:100%;">
                <label class="border border-0 border-bottom m-1" style="width:100%;">${i + 1
        }. ${des}</label>
                <button class="btn btn-secondary rounded m-1 text-white fw-bold" onclick="delRow2(${i})"><i class="fa-solid fa-xmark"></i></button>
                </div> `;
      });
      $("#lblDescrip").append(span);
    }
  }

  function delRow2(index) {
    desTecnica.splice(index, 1);
    let span = "";
    $("#lblDescrip").empty();
    desTecnica.forEach((des, i) => {
      span += `<div class="d-flex" style="width:100%;">
              <label class="border border-0 border-bottom m-1" style="width:100%;">${i + 1
      }. ${des}</label>
              <button class="btn btn-secondary rounded m-1 text-white fw-bold" onclick="delRow2(${i})"><i class="fa-solid fa-xmark"></i></button>
              </div> `;
    });
    $("#lblDescrip").append(span);
  }

  function addRow3() {
    let inputDescripFinal = document.getElementById("inputDescripFinal");
    if (inputDescripFinal.value != "") {
      lblErrorDesFinal.innerHTML = "";
      desFinal.push(inputDescripFinal.value);
      inputDescripFinal.value = "";
      let span = "";
      desFinal.forEach((des, i) => {
        span = `<div class="d-flex" style="width:100%;">
                <label class="border border-0 border-bottom m-1" style="width:100%;">${i + 1
        }. ${des}</label>
                <button class="btn btn-secondary rounded m-1 text-white fw-bold" onclick="delRow3(${i})"><i class="fa-solid fa-xmark"></i></button>
                </div> `;
      });
      $("#lblDescripFinal").append(span);
    }
  }

  function delRow3(index) {
    desFinal.splice(index, 1);
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
  }

  function addRow4() {
    let inputEncaEditA = document.getElementById("inputEncaEditA");
    if (encaEdit.length < 2 && inputEncaEditA.value != "") {
      encaEdit.push(inputEncaEditA.value);
      inputEncaEditA.value = "";
      let span = "";
      encaEdit.forEach((enca, i) => {
        span = `<div class="d-flex" style="width:100%;">
              <label class="border border-0 border-bottom m-1" style="width:100%;">${i + 1
        }. ${enca}</label>
              <button class="btn btn-secondary rounded m-1 text-white fw-bold" onclick="delRow4(${i})"><i class="fa-solid fa-xmark"></i></button>
              </div> `;
      });
      $("#lblEncasEditA").append(span);
      if (encaEdit.length == 2) {
        inputEncaEditA.disabled = true;
      }
      lblErrorEditA.innerHTML = "";
    }
  }

  function delRow4(index) {
    encaEdit.splice(index, 1);
    inputEncaEditA.disabled = false;
    let span = "";
    $("#lblEncasEditA").empty();
    encaEdit.forEach((enca, i) => {
      span = `<div class="d-flex" style="width:100%;">
              <label class="border border-0 border-bottom m-1" style="width:100%;">${i + 1
      }. ${enca}</label>
              <button class="btn btn-secondary rounded m-1 text-white fw-bold" onclick="delRow4(${i})"><i class="fa-solid fa-xmark"></i></button>
              </div> `;
    });
    $("#lblEncasEditA").append(span);
  }

  function addRow5() {
    let input = document.getElementById("inputDescripB");
    if (input.value != "") {
      desTecnicaEdit.push(input.value);

      input.value = "";
      let span = "";
      desTecnicaEdit.forEach((enca, i) => {
        span = `<div class="d-flex" style="width:100%;">
              <label class="border border-0 border-bottom m-1" style="width:100%;">${i + 1
        }. ${enca}</label>
              <button class="btn btn-secondary rounded m-1 text-white fw-bold" onclick="delRow5(${i})"><i class="fa-solid fa-xmark"></i></button>
              </div> `;
      });
      $("#lblDescripB").append(span);
      lblErrorAsigB.innerHTML = "";
    }
  }

  function delRow5(index) {
    desTecnicaEdit.splice(index, 1);
    inputDescripB.disabled = false;
    $("#lblDescripB").empty();
    desTecnicaEdit.forEach((enca, i) => {
      $("#lblDescripB").append(`<div class="d-flex" style="width:100%;">
              <label class="border border-0 border-bottom m-1" style="width:100%;">${i + 1
      }. ${enca}</label>
              <button class="btn btn-secondary rounded m-1 text-white fw-bold" onclick="delRow5(${i})"><i class="fa-solid fa-xmark"></i></button>
              </div> `);
    });

  }

  function createCase() {
    let area = cbbAreas2.value;
    let servi = cbbServi2.value;
    let depa = cbbDepa.value;
    let secc = cbbSec.value;
    let enca1 = enca[0];
    let enca2 = enca[1];
    let fecha = inputFecha.value;
    let soli = txtSoli.value;
    let cia = cbbCia.value;
    let imagen = document.getElementById("imagenInput").files[0];
    if (
      cia == "" ||
      area == "" ||
      servi == "" ||
      depa == "" ||
      secc == "" ||
      soli == "" ||
      cia == null ||
      area == null ||
      servi == null ||
      depa == null ||
      secc == null ||
      soli == null
    ) {
      lblError.innerHTML = "Todos los campos son obligatorios";
    } else {
      if ((enca1 == "" && enca2 == "") || (enca1 == null && enca2 == null)) {
        lblError.innerHTML = "Al menos un encabezado es obligatorio";
      } else {
        lblError.innerHTML = "";
        const dataSave = {
          CIA: cia,
          AREA: area,
          SERVI: servi,
          DEPA: depa,
          SECC: secc,
          ENCA1: enca1,
          ENCA2: enca2,
          FECHA: formatFecha(fecha, 3),
          SOLI: soli,
          ESTADO: "A",
          USUGRA: user,
          FECGRA: currentDate(),
          HORGRA: currentTime(),
          FILE: "",
          EXTEN: "",
        };
        let url = "http://172.16.15.20/API.LovablePHP/ZLO0034P/CreateTask/";
        if (imagen) {
          dataSave.EXTEN = imagen.type.split("/")[1];
          if(dataSave.EXTEN.length>5){
            dataSave.EXTEN= imagen.name.split(".")[1];
          }
          blobToBase64(imagen, (base64) => {
            dataSave.FILE = base64;
            fetchData(url, dataSave);
          });
        } else {
          fetchData(url, dataSave);
        }
      }
    }
  }

  function editCasoA() {
    const caso = document.getElementById("lblEditarA").innerText;
    let area = cbbAreas2EditA.value;
    let servi = cbbServi2EditA.value;
    let depa = cbbDepaEditA.value;
    let secc = cbbSecEditA.value;
    let enca1 = encaEdit[0];
    let enca2 = encaEdit[1];
    let fecha = inputFechaEditA.value;
    let soli = txtSoliEditA.value;
    let cia = cbbCiaEditA.value;
    let urlImage = document.getElementById("caseFileUrlEditA").value;
    if (
      cia == "" ||
      area == "" ||
      servi == "" ||
      depa == "" ||
      secc == "" ||
      soli == "" ||
      cia == null ||
      area == null ||
      servi == null ||
      depa == null ||
      secc == null ||
      soli == null
    ) {
      lblError.innerHTML = "Todos los campos son obligatorios";
    } else {
      if ((enca1 == "" && enca2 == "") || (enca1 == null && enca2 == null)) {
        lblError.innerHTML = "Al menos un encabezado es obligatorio";
      } else {
        lblError.innerHTML = "";
        const dataSave = {
          CIA: cia,
          CASO: caso,
          AREA: area,
          SERVI: servi,
          DEPA: depa,
          SECC: secc,
          ENCA1: enca1,
          ENCA2: enca2,
          FECHA: formatFecha(fecha, 3),
          SOLI: soli,
          ESTADO: "A",
          USUGRA: user,
          FECGRA: currentDate(),
          HORGRA: currentTime(),
          ISNEW: "",
          FILE: "",
          EXTEN: "",
        };
        let url = "http://172.16.15.20/API.LovablePHP/ZLO0034P/EditarTask/";
        if (urlImage != "") {
          dataSave.ISNEW = "N";
          fetchDataU(url, dataSave);
        } else {
          dataSave.ISNEW = "S";
          let imagen = document.getElementById("imagenInputEditA");
          if (imagen === null) {
            return;
          }
          if (imagen.files && imagen.files.length > 0) {
            imagen = imagen.files[0];
            dataSave.EXTEN = imagen.type.split("/")[1];
            blobToBase64(imagen, (base64) => {
              dataSave.FILE = base64;
              fetchDataU(url, dataSave);
            });
          } else {
            imagen = null;
            fetchDataU(url, dataSave);
          }
        }
      }
    }
  }

  function editCasoB() {
    let usuasi = cbbUsuasiEditB.value;
    let priori = inputProriB.value;
    let fecLimit = inputfecLimitB.value;
    let descrip = desTecnicaEdit;
    let caso = document.getElementById("lblEditarB").innerText;
    if (usuasi == "" || priori == "" || fecLimit == "" || descrip == "") {
      lblErrorAsigB.innerHTML = "Todos los campos son obligatorios";
    } else {
      lblErrorAsigB.innerHTML = "";
      const dataSave = {
        CIA: 1,
        CASO: caso,
        USUASI: usuasi,
        PRIORI: priori,
        FECLIM: fecLimit.replace(/-/g, ""),
        DESCR: descrip,
        ESTADO: "B",
        USUGRA: user,
        FECGRA: currentDate(),
        HORGRA: currentTime(),
      };
      let url = "http://172.16.15.20/API.LovablePHP/ZLO0034P/AsignTask/";
      fetch(url, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(dataSave),
        })
        .then((response) => {
          return response.json();
        })
        .then((data) => {
          if (data.code == 200) {
            $("#asigModal").modal("hide");
            Swal.fire({
              icon: "success",
              title: "Caso actualizado correctamente",
              showConfirmButton: false,
              timer: 1500,
            });
            chargeTasks();
            $("#editarBModal").modal("hide");
          } else {
            console.log(data.message);
          }
        });
    }
  }

  function editarCasoA(caso) {
    $("#cbbDepaDivEditA").empty();
    $("#cbbDepaDivEditA").append(
      `<select class="form-select" name="" id="cbbDepaEditA"></select>`
    );
    $("#cbbDepaEditA").empty();
    $("#cbbDepaEditA").append(optionDepas);
    $("#cbbDepaEditA").flexselect();
    $("#cbbSecDivEditA").empty();
    $("#cbbSecDivEditA").append(
      `<select class="form-select" name="" id="cbbSecEditA"></select>`
    );
    $("#cbbDepaEditA").on("change", () => {
      $("#cbbSecDivEditA").empty();
      $("#cbbSecDivEditA").append(
        `<select class="form-select" name="" id="cbbSecEditA"></select>`
      );
      if ($("#cbbDepaEditA").val() != "") {
        const urlSeccion =
          "http://172.16.15.20/API.LovablePHP/ZLO0034P/ListSecc/?depa=" +
          $("#cbbDepaEditA").val();
        fetch(urlSeccion)
          .then((response) => response.json())
          .then((data) => {
            if (data.code == 200) {
              let responseData = data.data;
              let cbbSeccion = document.getElementById("cbbSecEditA");
              cbbSeccion.classList.remove("text-muted");
              let option = '<option value=""></option>';
              responseData.forEach((servicio) => {
                option += `<option value="${servicio.SECCOD}">${servicio.SECDES}</option>`;
              });
              cbbSeccion.innerHTML = option;
              $("#cbbSecEditA").flexselect();
            } else {
              console.log(data.message);
            }
          });
      }
    });
    $("#cbbCiaDivEditA").empty();
    $("#cbbCiaDivEditA").append(
      `<select class="form-select" name="" id="cbbCiaEditA"></select>`
    );
    $("#cbbCiaEditA").empty();
    $("#cbbCiaEditA").append(optionCias);
    $("#cbbCiaEditA").flexselect();
    let cia = 1;
    let urlHeader = `http://172.16.15.20/API.LovablePHP/ZLO0034P/FindTask/?cia=${cia}&caso=${caso}`;
    fetch(urlHeader)
      .then((response) => response.json())
      .then((data) => {
        if (data.code == 200) {
          $("#lblEditarA").text(caso);
          let responseData = data.data[0];
          cbbAreas2EditA.value = responseData.CODARE;
          const cbbServi2EditA = document.getElementById("cbbServi2EditA");
          let urlServicios = `http://172.16.15.20/API.LovablePHP/ZLO0034P/ListServicios/?area=${responseData.CODARE}`;
          fetch(urlServicios)
            .then((response) => response.json())
            .then((data) => {
              if (data.code == 200) {
                let responseData2 = data.data;
                cbbServi2EditA.classList.remove("text-muted");
                let option = '<option value="">Selecciona un servicio</option>';
                responseData2.forEach((servicio) => {
                  option += `<option value="${servicio.CODSER}">${servicio.DESCRI}</option>`;
                });
                cbbServi2EditA.innerHTML = option;
                cbbServi2EditA.value = responseData.CODSER;
              } else {
                console.log(data.message);
              }
            });
          encaEdit = [];
          encaEdit.push(responseData.DESCR1);
          encaEdit.push(responseData.DESCR2);
          let span = "";
          encaEdit.forEach((enca, i) => {
            span += `<div class="d-flex" style="width:100%;">
                    <label class="border border-0 border-bottom m-1" style="width:100%;">${i + 1
            }. ${enca}</label>
                    <button class="btn btn-secondary rounded m-1 text-white fw-bold" onclick="delRow4(${i})"><i class="fa-solid fa-xmark"></i></button>
                    </div> `;
          });
          $("#lblEncasEditA").empty();
          $("#lblEncasEditA").append(span);
          if (encaEdit.length == 2) {
            inputEncaEditA.disabled = true;
          }
          lblErrorEditA.innerHTML = "";
          const codcia = responseData.CODCIA.toString().padStart(2, "0");
          $("#cbbCiaEditA").val(codcia).trigger("change");
          $("#cbbDepaEditA").val(responseData.CODDEP).trigger("change");
          setTimeout(() => {
            $("#cbbSecEditA").val(responseData.CODSEC).trigger("change");
          }, 500);
          inputFechaEditA.value = formatFecha(responseData.FECENT.toString(), 1);
          txtSoliEditA.value = responseData.USUARI;
          let divFile = "";
          if (responseData.EXTEN != "") {
            switch (responseData.EXTEN.trim()) {
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
                                          <button onclick="btnBorrarEditar('${caso}')" class="btn btn-danger fw-bold text-white rounded-start rounded-end mb-2 mt-2 me-2">Borrar adjunto</button>
                                          </div>
                                          <div class="col-12">
                                          <embed src="${responseData.FILE}" style="width:100%; height: 70vh !important;" alt="pdf">
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
                                       <button onclick="btnBorrarEditar('${caso}')" class="btn btn-danger fw-bold text-white rounded-start rounded-end mb-2 mt-2 me-2">Borrar adjunto</button>
                                      </div>
                                      <div class="col-12">
                                        <img src="${responseData.FILE}" class="img-fluid" alt="Imagen">
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
                                        <button onclick="btnBorrarEditar('${caso}')" class="btn btn-danger fw-bold text-white rounded-start rounded-end mb-2 mt-2 me-2">Borrar adjunto</button>
                                        </div>
                                        <div class="col-12">
                                        <p class="Mulifont p-0 m-1 mt-3">Este caso tiene un archivo de ejemplo adjunto.
                                        <a href="${responseData.FILE}" download class="fw-bold">
                                          Descargalo aquí <i class="fa-solid fa-download text-darkblue"></i>
                                        </a>
                                        </p>
                                        </div>
                                      </div>`;
                break;
            }
          } else {
            divFile =
              `<input id="imagenInputEditA" type="file" class="form-control rounded-start rounded-end m-0 w100">`;
          }
          divFile += `<input type="text" id="caseFileUrlEditA" class="d-none" value="${responseData.FILE}">`;
          $("#fileAdjuntoEditA").empty();
          $("#fileAdjuntoEditA").append(divFile);
          $("#editarAModal").modal("show");
        } else {
          console.log(data.message);
        }
      });
  }

  function editarCasoB(caso) {
    desTecnicaEdit = [];
    $("#cbbUsuasiDivB").empty();
    $("#cbbUsuasiDivB").append(`<select class="form-select" name="" id="cbbUsuasiEditB">
                                <option value=""></option>
                              </select>`);
    $("#cbbUsuasiEditB").append(optionUsuarios);
    $("#cbbUsuasiEditB").flexselect();
    $("#lblEditarB").text(caso);
    let urlFicha = `http://172.16.15.20/API.LovablePHP/ZLO0034P/GetInstructions/?cia=1&caso=${caso}`;
    fetch(urlFicha)
      .then((response) => response.json())
      .then((data) => {
        if (data.code == 200) {
          $("#lblDescripB").empty();
          const response = data.data;
          response.forEach((ficha, i) => {
            desTecnicaEdit.push(ficha.DESCRI);
            $("#lblDescripB").append(`<div class="d-flex" style="width:100%;">
                      <label class="border border-0 border-bottom m-1" style="width:100%;">${i + 1}. ${ficha.DESCRI}</label>
                      <button class="btn btn-secondary rounded m-1 text-white fw-bold" onclick="delRow5(${i})"><i class="fa-solid fa-xmark"></i></button>
                      </div> `);
          });
        }
      });
    let urlHeader = `http://172.16.15.20/API.LovablePHP/ZLO0034P/FindTask/?cia=1&caso=${caso}`;
    fetch(urlHeader)
      .then((response) => response.json())
      .then((data) => {
        if (data.code == 200) {
          let responseData = data.data;
          idCasoAsigB.innerHTML = responseData[0].NUMERO;
          fechaCasoAsigB.innerHTML = formatFecha(
            responseData[0].FECENT.toString(), 2);
          fechaEntregaAsigB.innerHTML = formatFecha(
            responseData[0].FECEN2.toString(), 2);
          areaCasoAsigB.innerHTML = responseData[0].AREA;
          usuarioGraAsigB.innerHTML = responseData[0].USUGRA;
          fechaEntregaTecnicaAsigB.innerHTML = formatFecha(
            responseData[0].FECENT.toString(),
            2
          );
          $("#cbbUsuasiEditB").val(responseData[0].USUASI).trigger("change");
          $("#inputProriB").val(responseData[0].PRIORI);
          $("#inputfecLimitB").val(formatFecha(responseData[0].FECEN2.toString(), 1));
          servicioCasoAsigB.innerHTML = responseData[0].SERVI;
          fechaInicioRevisionAsigB.innerHTML = formatFecha(
            responseData[0].FECINI.toString(),
            2
          );
          departamentoCasoAsigB.innerHTML = responseData[0].DEPA;
          prioridadCasoAsigB.innerHTML = responseData[0].PRIORI;
          horaInicioRevisionAsigB.innerHTML = formatHora(responseData[0].HORINI);
          seccionCasoAsigB.innerHTML = responseData[0].SEC;
          fechaRevisionTerminadaAsigB.innerHTML = formatFecha(
            responseData[0].FECFIN.toString(),
            2
          );
          horaRevisionTerminadaAsigB.innerHTML = formatHora(
            responseData[0].HORFIN
          );
          Descrip1AsigB.innerHTML = responseData[0].DESCR1;
          Descrip2AsigB.innerHTML = responseData[0].DESCR2;
          const file = responseData[0].FILE;
          const exten = responseData[0].EXTEN.trim();
          $("#hasFileAsigB").empty();
          if (exten != "") {
            switch (exten) {
              case "pdf":
                $("#hasFileAsigB")
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
                $("#hasFileAsigB").append(`
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
                $("#hasFileAsigB")
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
    $("#editarBModal").modal("show");
    /*inputProri.value = "";
    inputfecLimit.value = "";
    inputDescrip.value = "";
    lblDescrip.innerHTML = "";
    desTecnica = [];
    $("#cbbUsuasiDiv").empty();
    $("#cbbUsuasiDiv").append(`<select class="form-select" name="" id="cbbUsuasi">
                                  <option value=""></option>
                                </select>`);
    $("#cbbUsuasi").append(optionUsuarios);
    $("#cbbUsuasi").flexselect();
    */
  }

  function blobToBase64(blob, callback) {
    const reader = new FileReader();
    reader.onload = function() {
      const dataUrl = reader.result;
      const base64String = dataUrl.split(",")[1];
      callback(base64String);
    };
    reader.readAsDataURL(blob);
  }

  function fetchDataU(url, dataSave) {
    let numero = "";
    fetch(url, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(dataSave),
      })
      .then((response) => {
        return response.json();
      })
      .then((data) => {
        if (data.code == 200) {
          numero = data.correlativo;
          if (nivel == 1) {
            Swal.fire({
              icon: "success",
              title: "Caso actualizado",
              text: "El caso " + numero + " se ha actualizado correctamente",
              showConfirmButton: false,
              timer: 1500,
            });
            chargeTasks();
            $("#editarAModal").modal("hide");
          }
        } else {
          Swal.fire({
            icon: "error",
            title: "Hubo uno error al actualizar el caso",
          });
        }
      });
  }

  function fetchData(url, dataSave) {
    let numero = "";
    fetch(url, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(dataSave),
      })
      .then((response) => {
        return response.json();
      })
      .then((data) => {
        if (data.code == 200) {
          numero = data.correlativo;
          if (nivel == 1) {
            Swal.fire({
              icon: "success",
              title: "Caso creado",
              text: "El caso " + numero + " se ha creado correctamente",
              showConfirmButton: false,
              timer: 1500,
            });
            $("#createModal").modal("hide");
            chargeTasks();
          } else {
            if (percas == "S") {
              inputCaso.value = numero;
              lblErrorAsig.innerHTML = "";
              $("#createModal").modal("hide");
              openAsigModal();
            }
          }
        } else {
          Swal.fire({
            icon: "error",
            title: "Hubo uno error al crear el caso",
          });
        }
      });
  }

  function asignarCase() {
    let usuasi = cbbUsuasi.value;
    let priori = inputProri.value;
    let fecLimit = inputfecLimit.value;
    let descrip = desTecnica;
    let caso = inputCaso.value;
    if (usuasi == "" || priori == "" || fecLimit == "" || descrip == "") {
      lblErrorAsig.innerHTML = "Todos los campos son obligatorios";
    } else {
      lblErrorAsig.innerHTML = "";
      const dataSave = {
        CIA: 1,
        CASO: caso,
        USUASI: usuasi,
        PRIORI: priori,
        FECLIM: fecLimit.replace(/-/g, ""),
        DESCR: descrip,
        ESTADO: "B",
        USUGRA: user,
        FECGRA: currentDate(),
        HORGRA: currentTime(),
      };
      let url = "http://172.16.15.20/API.LovablePHP/ZLO0034P/AsignTask/";
      fetch(url, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(dataSave),
        })
        .then((response) => {
          return response.json();
        })
        .then((data) => {
          if (data.code == 200) {
            $("#asigModal").modal("hide");
            Swal.fire({
              icon: "success",
              title: "Caso asignado correctamente",
              text: "El caso se ha asignado a " + usuasi,
              showConfirmButton: false,
              timer: 1500,
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
                              <div class="col-2"></div>
                                <div class="col-8">
                                  <span class="fw-bold text-start">Descripción Técnica Final</span>
                                </div>
                              <div class="col-2"></div>
                              <div class="col-2"></div>
                                <div class="col-8">
                                  <div class="input-group ">
                                    <input id="inputDescripFinal" maxlength="60" type="text" class="form-control rounded-start"
                                      placeholder="Escribe la descripción técnica final" >
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
                                  <hr>
                                  <span class="fw-bold text-start">Adjuntar un archivo</span>
                                  <input type="text" id="caseFileUrl" class="d-none">
                                  <input id="caseFile" type="file" class="form-control rounded" style="width:100%;">
                                </div>
                                <div class="col-2"></div>
                              </div>
                            </div>`;
    footerCase.innerHTML =
      `<button type="button" class="btn btn-secondary rounded text-white fw-bold" data-bs-dismiss="modal">CANCELAR</button>
                            <button type="button" class="btn btn-primary rounded text-white fw-bold" onclick="saveDesFinal(${caso},'${usuasi}')"><i class="fa-solid fa-save"></i> GUARDAR</button>`;

    inputDescripFinal.addEventListener("keypress", function(e) {
      if (e.key === "Enter") {
        addRow3();
      }
    });
  }

  function validateInput(event) {
    /*const regex = /^[a-zA-Z0-9 ]*$/;
      if (!regex.test(event.key)) {
        event.preventDefault();
      }*/
  }

  function saveDesFinal(caso, usuasi) {
    let descrip = desFinal;
    let inputFile = document.getElementById("caseFile");
    let file = "";
    if (inputFile) {
      file = inputFile.files[0];
    }
    if (descrip.length == 0) {
      lblErrorDesFinal.innerHTML =
        "Ingresar la descripción técnica final es obligatorio";
    } else {
      lblErrorDesFinal.innerHTML = "";
      let url = "http://172.16.15.20/API.LovablePHP/ZLO0034P/SaveDesfinal/";
      const dataSave = {
        CASO: caso,
        USUASI: usuasi,
        DESCR: descrip,
        ESTADO: "C",
        USUGRA: user,
        FECGRA: currentDate(),
        HORGRA: currentTime(),
        FILE: "",
        EXTE: "",
      };
      if (file) {
        blobToBase64(file, (base64) => {
          dataSave.FILE = base64;
          dataSave.EXTE = file.name.split(".")[1];
          fetch(url, {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
              },
              body: JSON.stringify(dataSave),
            })
            .then((response) => {
              return response.json();
            })
            .then((data) => {
              if (data.code == 200) {
                $("#detaModal").modal("hide");
                chargeTasks();
              } else {
                console.log(data.message);
              }
            });
        });
      } else {
        fetch(url, {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(dataSave),
          })
          .then((response) => {
            return response.json();
          })
          .then((data) => {
            if (data.code == 200) {
              $("#detaModal").modal("hide");
              chargeTasks();
            } else {
              console.log(data.message);
            }
          });
      }
    }
  }

  function confirmDelete(caso, estado, fecha, hora) {
    Swal.fire({
      title: "¿Estás seguro de eliminar este caso?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Eliminar",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        stateTask(caso, estado, fecha, hora);
      }
    });
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
    fetch(url, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(dataSave),
      })
      .then((response) => {
        return response.json();
      })
      .then((data) => {
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
      const base64String = dataUrl.split(",")[1];
      callback(base64String);
    };
    reader.readAsDataURL(blob);
  }

  function sendForm() {
    $("#inputDescrp").val("");
    const rangeDocumento = $("#datepicker1").val();
    const d1ini = rangeDocumento.split(" - ")[0].split("/").reverse().join("");
    const d2fin = rangeDocumento.split(" - ")[1].split("/").reverse().join("");
    switch (tipoSearch) {
      case "C":
        let cSpanElement = document.getElementById("C-span");
        cSpanElement.innerHTML = "";
        let cdateText = document.createTextNode(formatFecha(d1ini, 2) + " - " + formatFecha(d2fin, 2));
        let cbrElement = document.createElement("br");
        cSpanElement.appendChild(cbrElement);
        cSpanElement.appendChild(cdateText);
        $("#C-input1").val(d1ini);
        $("#C-input2").val(d2fin);
        chargeTasks();
        break;
      case "D":
        let dSpanElement = document.getElementById("D-span");
        dSpanElement.innerHTML = "";
        let ddateText = document.createTextNode(formatFecha(d1ini, 2) + " - " + formatFecha(d2fin, 2));
        let dbrElement = document.createElement("br");
        dSpanElement.appendChild(dbrElement);
        dSpanElement.appendChild(ddateText);
        $("#D-input1").val(d1ini);
        $("#D-input2").val(d2fin);
        chargeTasks();
        break;
      default:
        break;
    }
    $("#fechasButton").empty();
    $("#fechasButton").append(
      `<button class="btn btn-danger text-white rounded-end" onclick="vaciarRangos()"><i class="fa-solid fa-xmark"></i></button>`
    );
  }

  function vaciarRangos() {
    let currentDate = new Date();
    let d1ini = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1).toISOString().split("T")[0].replace(/-/g,
      "");
    let d2fin = currentDate.toISOString().split("T")[0].replace(/-/g, "");
    Date1 = formatFecha(d1ini, 2);
    Date2 = formatFecha(d2fin, 2);
    picker1.setDateRange(Date1, Date2);
    switch (tipoSearch) {
      case "C":
        let cSpanElement = document.getElementById("C-span");
        cSpanElement.innerHTML = "";
        $("#C-input1").val("");
        $("#C-input2").val("");
        chargeTasks();
        break;
      case "D":
        let dSpanElement = document.getElementById("D-span");
        dSpanElement.innerHTML = "";
        $("#D-input1").val("");
        $("#D-input2").val("");
        chargeTasks();
        break;
      default:
        break;
    }
    $("#fechasButton").empty();
    $("#fechasButton").append(
      `<button class="btn btn-light text-white fw-bold rounded-end" type="button" disabled><i class="fa-solid fa-calendar text-black"></i></button>`
    );
  }

  function vaciarNumero() {
    $("#inputSearch").val("");
    switch (tipoSearch) {
      case "C":
        let cSpanElement = document.getElementById("C-span");
        cSpanElement.innerHTML = "";
        chargeTasks();
        break;
      case "D":
        let dSpanElement = document.getElementById("D-span");
        dSpanElement.innerHTML = "";
        chargeTasks();
        break;
      default:
        break;
    }
    $("#numeroButton").empty();
    $("#numeroButton").append(`<button class="btn btn-danger text-white fw-bold rounded-end" type="button" onclick="searchNumero()">
                                <i class="fa-solid fa-magnifying-glass"></i> Buscar
                              </button>`);
  }

  function searchDescri() {
    chargeTasks();
    $("#descriButton").empty();
    $("#descriButton").append(
      `<button class="btn btn-danger m-0 text-white rounded-end" style="height:40px !important; margin-right: 120px !important;" onclick="vaciarDescri()"><i class="fa-solid fa-xmark"></i></button>`
    );
  }

  function vaciarDescri() {
    $("#inputDescrp").val("");
    $("#descriButton").empty();
    $("#descriButton").append(`<button class="btn btn-danger m-0 text-white fw-bold rounded-end" style="height:40px !important; margin-right: 120px !important;" type="button" onclick="searchDescri()">
                                <i class="fa-solid fa-magnifying-glass"></i> BUSCAR
                              </button>`);
    chargeTasks();
  }

  function openModal(tipo) {
    if (tipo == "C") {
      $("#titleHeader").text("Buscar caso - Revisión terminada");
    } else {
      $("#titleHeader").text("Buscar caso - Cerrado");
    }
    tipoSearch = tipo;
    $("#inputSearch").val("");
    $("#searchModal").modal("show");
  }

  function openColorModal(caso) {
    $("#casoEtiqueta").val(caso);
    $("#colorModal").modal("show");
    chargeColors();
  }

  function searchNumero() {
    $("#inputDescrp").val("");
    const numero = $("#inputSearch").val();
    $("#searchModal").modal("hide");
    if (numero == "") {
      switch (tipoSearch) {
        case "C":
          let cSpanElement = document.getElementById("C-span");
          cSpanElement.innerHTML = "";
          chargeTasks();
          break;
        case "D":
          let dSpanElement = document.getElementById("D-span");
          dSpanElement.innerHTML = "";
          chargeTasks();
          break;
        default:
          break;
      }
    } else {
      switch (tipoSearch) {
        case "C":
          let cSpanElement = document.getElementById("C-span");
          cSpanElement.innerHTML = "";
          let cdateText = document.createTextNode(numero);
          let cbrElement = document.createElement("br");
          cSpanElement.appendChild(cbrElement);
          cSpanElement.appendChild(cdateText);
          chargeTasks();
          break;
        case "D":
          let dSpanElement = document.getElementById("D-span");
          dSpanElement.innerHTML = "";
          let ddateText = document.createTextNode(numero);
          let dbrElement = document.createElement("br");
          dSpanElement.appendChild(dbrElement);
          dSpanElement.appendChild(ddateText);
          chargeTasks();
          break;
        default:
          break;
      }
    }
    /*$("#numeroButton").empty();
    $("#numeroButton").append(
      `<button class="btn btn-danger text-white rounded-end" onclick="vaciarNumero()"><i class="fa-solid fa-xmark"></i></button>`
      );*/
  }

  function chargeColors() {
    const numero = $("#casoEtiqueta").val();
    const urlColor = `http://172.16.15.20/API.LovablePHP/ZLO0034P/FindColor/?caso=${numero}`;
    let tipo = "";
    fetch(urlColor)
      .then((response) => response.json())
      .then((data) => {
        if (data.code == 200) {
          tipo = data.data;
        }
      })
      .then(() => {
        const url = "http://172.16.15.20/API.LovablePHP/ZLO0034P/GetColors";
        fetch(url)
          .then((response) => response.json())
          .then((data) => {
            $("#colorsBody").empty();
            if (data.code == 200) {
              let responseData = data.data;
              let span = "";
              responseData.forEach((color, i) => {
                span += `<tr id="tr-${color.CORREL}">
                    <td>
                     <input class="form-check-input border border-2 rounded m-0 mt-2 fs-20 checkColor" name="checkColor" type="checkbox" value="${color.CORREL}">
                    </td>
                    <td>
                      <label class="w100 p-2 border rounded m-0" style="background-color: #${color.COLOR} !important;">${color.DESCRI}</label>
                    </td>
                    <td class="d-flex">
                      <button class="btn btn-light border rounded m-0 p-0 pe-2 ps-2 pt-1 pb-1" onclick="editColor('${color.CORREL}','${color.COLOR}')">
                        <i class="fa-solid fa-pen"></i>
                      </button>
                    </td>
                  </tr>`;
              });
              $("#colorsBody").append(span);
              const checkboxes = document.querySelectorAll(".checkColor");
              checkboxes.forEach((checkbox) => {
                if (tipo == checkbox.value) {
                  checkbox.checked = true;
                }
              });
              $(".checkColor").click(function() {
                const numero = $("#casoEtiqueta").val();
                const correl = $(this).val();
                const urlDes = `http://172.16.15.20/API.LovablePHP/ZLO0034P/DesasignarColor/?caso=${numero}`;
                fetch(urlDes)
                  .then((response) => response.json())
                  .then((data) => {
                    if (data.code == 200) {
                      if ($(this).is(":checked")) {
                        $(".checkColor").not(this).prop("checked", false);
                        const urlAsig =
                          `http://172.16.15.20/API.LovablePHP/ZLO0034P/AsignarColor/?caso=${numero}&nivel=${correl}&usuario=${user}`;
                        fetch(urlAsig)
                          .then((response) => response.json())
                          .then((data) => {
                            if (data.code == 200) {
                              chargeTasks();
                            } else {
                              console.log(data.message);
                            }
                          });
                      } else {
                        chargeTasks();
                      }
                    }
                  });
              });
            } else {
              $("#colorsBody").append(`<tr>
                  <td class="w100 text-center">
                      <span class="ms-5">No hay etiquetas que mostrar.</span>
                  </td>
                </tr>`);
            }
          });
      });
  }

  function editColor(id, color) {
    // Selecciona el tr correspondiente
    var tr = document.getElementById("tr-" + id);

    // Selecciona el label existente y sus propiedades
    var label = tr.querySelector("label");
    var labelText = label.textContent;
    var labelClasses = label.className;

    // Crear un nuevo input con las mismas propiedades que el label
    var input = document.createElement("input");
    input.type = "text";
    input.value = labelText;
    input.className = labelClasses;
    input.style.backgroundColor = "#" + color;

    // Reemplazar el label con el input
    label.parentNode.replaceChild(input, label);

    // Selecciona el td que contiene el botón y lo limpia
    var buttonTd = tr.children[2];
    buttonTd.innerHTML = "";

    // Crear botón de guardar
    var saveButton = document.createElement("button");
    saveButton.className =
      "btn btn-success border rounded m-0 p-0 pe-2 ps-2 pt-1 pb-1 w50 text-white fw-bold";
    saveButton.innerHTML = '<i class="fa-solid fa-check"></i>';
    saveButton.onclick = function() {
      // Lógica para guardar el valor del input
      var newValue = input.value;
      const urlEdit =
        `http://172.16.15.20/API.LovablePHP/ZLO0034P/EditarColor/?nivel=${id}&descri=${newValue}&color=${color}&usuario=${user}`;
      fetch(urlEdit)
        .then((response) => response.json())
        .then((data) => {
          if (data.code == 200) {
            chargeColors();
          } else {
            console.log(data.message);
          }
        });
      /*// Reemplazar input por label de nuevo
        var newLabel = document.createElement('label');
        newLabel.className = labelClasses;
        newLabel.textContent = newValue;
        input.parentNode.replaceChild(newLabel, input);

        // Reemplazar botones con el botón de editar
        buttonTd.innerHTML = '';
        var editButton = document.createElement('button');
        editButton.className = 'btn btn-light border rounded m-0 p-0 pe-2 ps-2 pt-1 pb-1';
        editButton.innerHTML = '<i class="fa-solid fa-pen"></i>';
        editButton.setAttribute('onclick', "editColor('" + id + "','" + color + "')");
        buttonTd.appendChild(editButton);*/
    };

    // Crear botón de eliminar
    var cancelButton = document.createElement("button");
    cancelButton.className =
      "btn btn-danger border rounded m-0 p-0 pe-2 ps-2 pt-1 pb-1 w50 text-white fw-bold";
    cancelButton.innerHTML = '<i class="fa-solid fa-times"></i>';
    cancelButton.onclick = function() {
      const urlDel =
        "http://172.16.15.20/API.LovablePHP/ZLO0034P/DeleteColor/?nivel=" +
        id +
        "";
      fetch(urlDel)
        .then((response) => response.json())
        .then((data) => {
          if (data.code == 200) {
            chargeColors();
          } else {
            console.log(data.message);
          }
        });
      // Lógica para cancelar y revertir los cambios
      /*input.parentNode.replaceChild(label, input);
        buttonTd.innerHTML = '';
        var editButton = document.createElement('button');
        editButton.className = 'btn btn-light border rounded m-0 p-0 pe-2 ps-2 pt-1 pb-1';
        editButton.innerHTML = '<i class="fa-solid fa-pen"></i>';
        editButton.setAttribute('onclick', "editColor('" + id + "','" + color + "')");
        buttonTd.appendChild(editButton);*/
    };

    // Añadir los botones de guardar y eliminar
    buttonTd.appendChild(cancelButton);
    buttonTd.appendChild(saveButton);
  }

  function creaColor(footer) {
    const td = footer.parentNode.parentNode;
    td.innerHTML = `<td colspan="3">
                    <div class="row border shadow-lg w100 p-1 m-1">
                        <div class="col-12">
                            <label class="form-control border border-0 m-0 mt-2" >Descripción</label>
                            <input type="text" class="form-control border rounded w100 m-0" id="colorDesc" placeholder="Ingrese la descripción" />
                        </div>
                        <div class="col-12">
                            <label for="" class="form-control border border-0 m-0 mt-2" >Color</label>
                            <input type="color" class="form-control border rounded p-0 w100 m-0" id="colorInput" />
                        </div>
                        <div class="col-12">
                          <hr />
                        </div>
                        <div class="col-6">
                          <button class="btn btn-danger border rounded text-white fw-bold w100" onclick="cancelColor(this)">Cancelar</button>
                        </div>
                        <div class="col-6">
                          <button class="btn btn-primary border rounded text-white fw-bold w100" onclick="saveColor(this)">Guardar</button>
                        </div>
                      </div>
                  </td> `;
  }

  function cancelColor(form) {
    const td = form.parentNode.parentNode.parentNode;
    td.innerHTML = `<td colspan="3">
                    <button class="btn btn-light border rounded fw-bold w100" onclick="creaColor(this)">Agregar una etiqueta <i class="fa-solid fa-tag"></i></button>
                  </td>`;
  }

  function saveColor(form) {
    const descripcion = document.getElementById("colorDesc").value;
    const color = document.getElementById("colorInput").value.substring(1);
    const url =
      `http://172.16.15.20/API.LovablePHP/ZLO0034P/CreateColor/?descri=${descripcion}&color=${color}&usuario=${user}`;
    fetch(url)
      .then((response) => response.json())
      .then((data) => {
        if (data.code == 200) {
          chargeColors();
          const td = form.parentNode.parentNode.parentNode;
          td.innerHTML = `<td colspan="3">
                    <button class="btn btn-light border rounded fw-bold w100" onclick="creaColor(this)">Agregar una etiqueta <i class="fa-solid fa-tag"></i></button>
                  </td>`;
        } else {
          console.log(data.message);
        }
      });
  }
  </script>
  <div class="modal fade" id="editarAModal" data-bs-keyboard="true" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-body overflow-auto">
          <div class="container rounded shadow-lg p-4">
            <div id="">
              <div class="row">
                <div class="col-12">
                  <div class="modal-header">
                    <h1 class="modal-title fs-6 fw-bold" style="letter-spacing:0.2rem;">EDITAR ENCABEZADO DEL CASO <span
                        class="ms-3" id="lblEditarA"></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                </div>
                <div class="col-12">
                  <label id="lblErrorEditA" class="text-danger fw-bold border border-0 mb-3"></label>
                </div>
                <div class="col-6">
                  <label class="fw-bold mb-2 ms-1">Área</label>
                  <select class="form-select" name="" id="cbbAreas2EditA">
                  </select>
                </div>
                <div class="col-6">
                  <label class="fw-bold mb-2 ms-1">Servicio</label>
                  <select class="form-select text-muted" name="" id="cbbServi2EditA">
                    <option value="">Escoge un área primero</option>
                  </select>
                </div>
                <div class="col-12">
                  <label class="fw-bold mb-1 ms-1 mt-3">Encabezado</label>
                  <div class="input-group">
                    <input id="inputEncaEditA" maxlength="50" type="text" class="form-control rounded-start"
                      placeholder="Escribe el encabezado">
                    <button class="btn btn-danger text-white fw-bold rounded-end" onclick="addRow4()"><i
                        class="fa-solid fa-square-plus fs-4"></i></button>
                  </div>
                  <div class="form-control rounded border border-0 m-0" id="lblEncasEditA" style="width:100%;">
                  </div>
                </div>
                <div class="col-12">
                  <label class="fw-bold mb-2 ms-1">Compañía</label>
                  <div class="w100" id="cbbCiaDivEditA">

                  </div>
                </div>
                <div class="col-6">
                  <label class="fw-bold mt-4 mb-1 ms-1">Departamento</label>
                  <div class="w100" id="cbbDepaDivEditA">

                  </div>
                </div>
                <div class="col-6">
                  <label class="fw-bold mt-4 mb-1 ms-1">Sección</label>
                  <div class="w100" id="cbbSecDivEditA">

                  </div>
                </div>
                <div class="col-4  mb-3">
                  <label class="fw-bold mt-4 mb-1 ms-1">Fecha Entrega Técnica</label>
                  <input type="date" id="inputFechaEditA" class="form-control rounded m-0" style="width:100%;">
                </div>
                <div class="col-8  mb-3">
                  <label class="fw-bold mt-4 mb-1 ms-1">Usuario solicitante</label>
                  <input type="text" id="txtSoliEditA" class="form-control rounded m-0"
                    placeholder="Ingrese el usuario solicitante" style="width:100%;" maxlength="10"
                    >
                </div>
                <div class="col-12">
                  <hr>
                </div>
                <div class="col-12">
                  <div id="fileAdjuntoEditA">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="container rounded bg-white shadow-lg p-4 mt-3 text-end">
            <button type="button" class="btn btn-warning rounded text-white fw-bold m-0" onclick="editCasoA()"></i>
              <i class="fa-solid fa-pen"></i> EDITAR</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="editarBModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-body overflow-auto">
          <div class="container bg-white shadow">
            <div class="row">
              <div class="col-12">
                <div class="modal-header">
                  <h1 class="modal-title fs-6 fw-bold" style="letter-spacing:0.2rem;">EDITAR UN CASO ASIGNADO <span
                      class="ms-3" id="lblEditarB"></span></h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
              </div>
              <div class="col-12">
                <div class="form-control border border-0 border-bottom" style="width:100%;">
                  <div class="row">
                    <div class="col-2">
                      Numero:
                    </div>
                    <div class="col-2 text-darkblue">
                      <span id="idCasoAsigB"></span>
                    </div>
                    <div class="col-2 text-end">
                      Fecha Caso:
                    </div>
                    <div class="col-2">
                      <span id="fechaCasoAsigB"></span>
                    </div>
                    <div class="col-2 text-end">
                      Fecha Entrega:
                    </div>
                    <div class="col-2">
                      <span id="fechaEntregaAsigB"></span>
                    </div>
                    <div class="col-2">
                      Area:
                    </div>
                    <div class="col-2">
                      <span id="areaCasoAsigB"></span>
                    </div>
                    <div class="col-2 text-end">
                      Usuario Gabación:
                    </div>
                    <div class="col-2">
                      <span id="usuarioGraAsigB"></span>
                    </div>
                    <div class="col-2 text-end">
                      Fecha Entrega Tecnica:
                    </div>
                    <div class="col-2">
                      <span id="fechaEntregaTecnicaAsigB"></span>
                    </div>
                    <div class="col-2">
                      Servicio:
                    </div>
                    <div class="col-2">
                      <span id="servicioCasoAsigB"></span>
                    </div>
                    <div class="col-4">

                    </div>
                    <div class="col-2 text-end">
                      Fecha Inicio Revisión:
                    </div>
                    <div class="col-2">
                      <span id="fechaInicioRevisionAsigB"></span>
                    </div>
                    <div class="col-2">
                      Departamento:
                    </div>
                    <div class="col-2">
                      <span id="departamentoCasoAsigB"></span>
                    </div>
                    <div class="col-2 text-end">
                      Prioridad:
                    </div>
                    <div class="col-1">
                      <span id="prioridadCasoAsigB"></span>
                    </div>
                    <div class="col-3 text-end">
                      Hora Inicio Revisión:
                    </div>
                    <div class="col-2">
                      <span id="horaInicioRevisionAsigB"></span>
                    </div>
                    <div class="col-2">
                      Sección:
                    </div>
                    <div class="col-5">
                      <span id="seccionCasoAsigB"></span>
                    </div>
                    <div class="col-3 text-end">
                      Fecha Revisión Terminada:
                    </div>
                    <div class="col-2">
                      <span id="fechaRevisionTerminadaAsigB"></span>
                    </div>
                    <div class="col-7">
                      <span id="Descrip1AsigB"></span><br>
                      <span id="Descrip2AsigB"></span>
                    </div>
                    <div class="col-3 text-end">
                      Hora Revisión Terminada:
                    </div>
                    <div class="col-2">
                      <span id="horaRevisionTerminadaAsigB"></span>
                    </div>
                    <div class="col-12" id="hasFileAsigB">

                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="form-control border border-0" style="width:100%;">
                  <div id="asigDiv">
                    <div class="row">
                      <div class="col-12">
                        <label id="lblErrorAsigB" class="text-danger fw-bold border border-0 mb-3"></label>
                        <input type="text" id="inputCasoB" class="d-none">
                      </div>
                      <div class="col-2"></div>
                      <div class="col-8">
                        <label class="fw-bold mb-2 ms-1">Asignar a usuario:</label>
                        <div class="w100" id="cbbUsuasiDivB">

                        </div>
                      </div>
                      <div class="col-2"></div>
                      <div class="col-2"></div>
                      <div class="col-4 mb-3">
                        <label class="fw-bold mt-4 mb-1 ms-1">Prioridad</label>
                        <input type="number" id="inputProriB" class="form-control rounded m-0" style="width:100%;"
                          placeholder="1 más alta, 99 más baja" maxlength="2" min="1" max="99">
                      </div>
                      <div class="col-4 mb-3">
                        <label class="fw-bold mt-4 mb-1 ms-1">Fecha Límite</label>
                        <input type="date" id="inputfecLimitB" class="form-control rounded m-0" style="width:100%;">
                      </div>
                      <div class="col-2"></div>
                      <div class="col-2"></div>
                      <div class="col-8">
                        <label class="fw-bold mb-1 ms-1 mt-3">Descripción técnica</label>
                        <div class="input-group">
                          <input id="inputDescripB" maxlength="60" type="text" class="form-control rounded-start"
                            placeholder="Escribe la descripción técnica"
                            >
                          <button class="btn btn-danger text-white fw-bold rounded-end" onclick="addRow5()"><i
                              class="fa-solid fa-square-plus fs-4"></i></button>
                        </div>
                        <div class="container ms-0" style="width:100%;">
                          <div class="form-control rounded border border-0 m-0" id="lblDescripB" style="width:100%;">
                          </div>
                        </div>
                      </div>
                      <div class="col-2"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="container rounded bg-white shadow-lg p-4 mt-3 text-end">
            <button type="button" class="btn btn-warning rounded text-white fw-bold m-0" onclick="editCasoB()"></i>
              <i class="fa-solid fa-pen"></i> EDITAR</button>
          </div>
        </div>
      </div>
    </div>
  </div>
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
                        DETALLES
                        DEL CASO
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
  <div class="modal fade" id="createModal" data-bs-keyboard="true" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-body overflow-auto">
          <div class="container rounded shadow-lg p-4">
            <div id="createDiv">
              <div class="row">
                <div class="col-12">
                  <div class="modal-header">
                    <h1 class="modal-title fs-6 fw-bold" id="detaModalLabel" style="letter-spacing:0.2rem;">CREAR UN
                      CASO</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                </div>
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
                  <div class="d-flex justify-content-between">
                    <div>
                      <label class="fw-bold mb-1 ms-1 mt-3">Encabezado</label>
                    </div>
                    <div class="mb-1 me-5 mt-3">
                      <span>Caracteres restantes: (<span id="inputEncaCaracteres">50</span>)</span>
                    </div>
                  </div>
                  <div class="input-group">
                    <input id="inputEnca" maxlength="50" type="text" class="form-control rounded-start"
                      placeholder="Escribe el encabezado" >
                    <button class="btn btn-danger text-white fw-bold rounded-end" onclick="addRow1()"><i
                        class="fa-solid fa-square-plus fs-4"></i></button>
                  </div>
                  <div class="form-control rounded border border-0 m-0" id="lblEncas" style="width:100%;">
                  </div>
                </div>
                <div class="col-12">
                  <label class="fw-bold mb-2 ms-1">Compañía</label>
                  <div class="w100" id="cbbCiaDiv">

                  </div>
                </div>
                <div class="col-6">
                  <label class="fw-bold mt-4 mb-1 ms-1">Departamento</label>
                  <div class="w100" id="cbbDepaDiv">

                  </div>
                </div>
                <div class="col-6">
                  <label class="fw-bold mt-4 mb-1 ms-1">Sección</label>
                  <div class="w100" id="cbbSecDiv">

                  </div>
                </div>
                <div class="col-4  mb-3">
                  <label class="fw-bold mt-4 mb-1 ms-1">Fecha Entrega Técnica</label>
                  <input type="date" id="inputFecha" class="form-control rounded m-0" style="width:100%;">
                </div>
                <div class="col-8  mb-3">
                  <label class="fw-bold mt-4 mb-1 ms-1">Usuario solicitante</label>
                  <input type="text" id="txtSoli" class="form-control rounded m-0"
                    placeholder="Ingrese el usuario solicitante" style="width:100%;" maxlength="10"
                    >
                </div>
                <div class="col-12">
                  <hr>
                </div>
                <div class="col-12">
                  <label for="imagenInput" class="fw-bold mb-2 ms-1">Archivo</label>
                  <input id="imagenInput" type="file" class="form-control rounded-start rounded-end m-0 w100">
                </div>
              </div>
            </div>
          </div>
          <div class="container rounded bg-white shadow-lg p-4 mt-3 text-end">
            <button type="button" class="btn btn-primary rounded text-white fw-bold m-0" onclick="createCase()"></i>
              <i class="fa-solid fa-save"></i> GUARDAR
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="asigModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-body overflow-auto">
          <div class="container bg-white shadow">
            <div class="row">
              <div class="col-12">
                <div class="modal-header">
                  <h1 class="modal-title fs-6 fw-bold" id="detaModalLabel" style="letter-spacing:0.2rem;">ASIGNAR UN
                    CASO</h1>
                  <button type="button" class="btn-close" id="closeButton"></button>
                </div>
              </div>
              <div class="col-12">
                <div class="form-control border border-0 border-bottom" style="width:100%;">
                  <div class="row">
                    <div class="col-2">
                      Numero:
                    </div>
                    <div class="col-2 text-darkblue">
                      <span id="idCasoAsig"></span>
                    </div>
                    <div class="col-2 text-end">
                      Fecha Caso:
                    </div>
                    <div class="col-2">
                      <span id="fechaCasoAsig"></span>
                    </div>
                    <div class="col-2 text-end">
                      Fecha Entrega:
                    </div>
                    <div class="col-2">
                      <span id="fechaEntregaAsig"></span>
                    </div>
                    <div class="col-2">
                      Area:
                    </div>
                    <div class="col-2">
                      <span id="areaCasoAsig"></span>
                    </div>
                    <div class="col-2 text-end">
                      Usuario Gabación:
                    </div>
                    <div class="col-2">
                      <span id="usuarioGraAsig"></span>
                    </div>
                    <div class="col-2 text-end">
                      Fecha Entrega Tecnica:
                    </div>
                    <div class="col-2">
                      <span id="fechaEntregaTecnicaAsig"></span>
                    </div>
                    <div class="col-2">
                      Servicio:
                    </div>
                    <div class="col-2">
                      <span id="servicioCasoAsig"></span>
                    </div>
                    <div class="col-4">

                    </div>
                    <div class="col-2 text-end">
                      Fecha Inicio Revisión:
                    </div>
                    <div class="col-2">
                      <span id="fechaInicioRevisionAsig"></span>
                    </div>
                    <div class="col-2">
                      Departamento:
                    </div>
                    <div class="col-2">
                      <span id="departamentoCasoAsig"></span>
                    </div>
                    <div class="col-2 text-end">
                      Prioridad:
                    </div>
                    <div class="col-1">
                      <span id="prioridadCasoAsig"></span>
                    </div>
                    <div class="col-3 text-end">
                      Hora Inicio Revisión:
                    </div>
                    <div class="col-2">
                      <span id="horaInicioRevisionAsig"></span>
                    </div>
                    <div class="col-2">
                      Sección:
                    </div>
                    <div class="col-5">
                      <span id="seccionCasoAsig"></span>
                    </div>
                    <div class="col-3 text-end">
                      Fecha Revisión Terminada:
                    </div>
                    <div class="col-2">
                      <span id="fechaRevisionTerminadaAsig"></span>
                    </div>
                    <div class="col-7">
                      <span id="Descrip1Asig"></span><br>
                      <span id="Descrip2Asig"></span>
                    </div>
                    <div class="col-3 text-end">
                      Hora Revisión Terminada:
                    </div>
                    <div class="col-2">
                      <span id="horaRevisionTerminadaAsig"></span>
                    </div>
                    <div class="col-12" id="hasFileAsig">

                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="form-control border border-0" style="width:100%;">
                  <div id="asigDiv">
                    <div class="row">
                      <div class="col-12">
                        <label id="lblErrorAsig" class="text-danger fw-bold border border-0 mb-3"></label>
                        <input type="text" id="inputCaso" class="d-none">
                      </div>
                      <div class="col-2"></div>
                      <div class="col-8">
                        <label class="fw-bold mb-2 ms-1">Asignar a usuario:</label>
                        <div class="w100" id="cbbUsuasiDiv">

                        </div>
                      </div>
                      <div class="col-2"></div>
                      <div class="col-2"></div>
                      <div class="col-4 mb-3">
                        <label class="fw-bold mt-4 mb-1 ms-1">Prioridad</label>
                        <input type="number" id="inputProri" class="form-control rounded m-0" style="width:100%;"
                          placeholder="1 más alta, 99 más baja" maxlength="2" min="1" max="99">
                      </div>
                      <div class="col-4 mb-3">
                        <label class="fw-bold mt-4 mb-1 ms-1">Fecha Límite</label>
                        <input type="date" id="inputfecLimit" class="form-control rounded m-0" style="width:100%;">
                      </div>
                      <div class="col-2"></div>
                      <div class="col-2"></div>
                      <div class="col-8">
                        <label class="fw-bold mb-1 ms-1 mt-3">Descripción técnica</label>
                        <div class="input-group">
                          <input id="inputDescrip" maxlength="60" type="text" class="form-control rounded-start"
                            placeholder="Escribe la descripción técnica"
                            >
                          <button class="btn btn-danger text-white fw-bold rounded-end" onclick="addRow2()"><i
                              class="fa-solid fa-square-plus fs-4"></i></button>
                        </div>
                        <div class="container ms-0" style="width:100%;">
                          <div class="form-control rounded border border-0 m-0" id="lblDescrip" style="width:100%;">
                          </div>
                        </div>
                      </div>
                      <div class="col-2"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="container rounded bg-white shadow-lg p-4 mt-3 text-end">
            <button type="button" class="btn btn-primary rounded text-white fw-bold m-0" onclick="asignarCase()">
              <i class="fa-solid fa-save"></i> GUARDAR
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="searchModal" data-bs-keyboard="true" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="titleHeader"></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="demo">
              <ul class="tablist" role="tablist">
                <li id="tab1" class="tablist__tab text-center p-3  is-active" aria-controls="panel1"
                  aria-selected="true" role="tab" tabindex="0">Rango de fechas</li>
                <li id="tab2" class="tablist__tab text-center p-3" aria-controls="panel2" aria-selected="false"
                  role="tab" tabindex="0">Número de caso</li>
              </ul>
              <div id="panel1" class="tablist__panel p-3 border" aria-labelledby="tab1" aria-hidden="false"
                role="tabpanel">
                <span class="mt-2">Rango de fechas:</span>
                <div class="input-group m-0 mb-4">
                  <input class="form-control fw-bold text-black rounded-start" id="datepicker1" name="datepicker1">
                  <div id="fechasButton">
                    <button class="btn btn-light text-white fw-bold rounded-end" type="button" disabled><i
                        class="fa-solid fa-calendar text-black"></i></button>
                  </div>
                </div>
              </div>
              <div id="panel2" class="tablist__panel is-hidden p-3 border" aria-labelledby="tab2" aria-hidden="true"
                role="tabpanel">
                <div class="input-group mt-2 mb-4">
                  <input type="number" class="form-control fw-bold text-black" id="inputSearch"
                    placeholder="Escribe el número de caso">
                  <div id="numeroButton">
                    <button class="btn btn-danger text-white fw-bold rounded-end" type="button"
                      onclick="searchNumero()">
                      <i class="fa-solid fa-magnifying-glass"></i> Buscar
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="colorModal" data-bs-keyboard="true" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-6 fw-bold" id="detaModalLabel" style="letter-spacing:0.2rem;">Etiquetas</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body overflow-auto">
          <div class="container rounded shadow-lg p-3">
            <input type="text" id="casoEtiqueta" class="d-none">
            <table class="table table-borderless w100 m-0">
              <thead>
                <tr>
                  <th style="width:2%"></th>
                  <th style="width:95%"></th>
                  <th style="width:5%"></th>
                </tr>
              </thead>
              <tbody id="colorsBody">

              </tbody>
              <tfoot>
                <tr>
                  <td colspan="3">
                    <div class="mt-3"></div>
                  </td>
                </tr>
                <tr class="border border-0 border-top">
                  <td colspan="3">
                    <button class="btn btn-light border rounded w100" onclick="creaColor(this)">Agregar una etiqueta <i
                        class="fa-solid fa-tag"></i></button>
                  </td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
        <div class="modal-footer m-0 p-0 p-3">
        </div>
      </div>
    </div>
  </div>
</body>

</html>