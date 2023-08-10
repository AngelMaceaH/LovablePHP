
var boolZona = false;
var clienteDes="";
function sendFiltro() {
  clie = $("#cliente").val();
  setCookie("cliente", clie, 1);
  window.location.href = "/pages/1.html";
}
var count = 0;
function showModal() {
  if (count == 0) {
    $("#IsComeback").empty();
    $("#IsComeback").append('<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>');
    count = 1;
  }

  $("#modalFiltro").modal("show");
}
function showModalCiudad() {
  boolZona = false;
  $("#modalCreate").modal("show");
  $("#isZona").empty();
  $("#isZona").append(`
           <label class="form-label">Ciudad Destino</label>
           <select  id="ciuddes" class="form-select">
            <option value="0"></option>
           </select>
           <div class="invalid-tooltip">
            Selecciona una ciudad
         </div>`);
  var storeduserCia = getCookie("userCia");
  var urlFind = "http://190.4.62.141/UEAPI/Ciudades/CiudadesList/?cia=" + storeduserCia + "";
  var responseCiudades = ajaxRequest(urlFind);
  var cont = 0;
  if (responseCiudades.code == 200) {
    var options = "";
    for (let i = 0; i < responseCiudades.data.length; i++) {
      options += `<option value="${responseCiudades.data[i]['CODCIU']}">${responseCiudades.data[i]['DESCIU']}</option>`;
    }
    if (cont == 0) {
      $("#ciuddes").append(options);
      cont = 1;
    }
  }
  $("#ciuddes").flexselect();
}
function showModalZona() {
  boolZona = true;
  $("#modalCreate").modal("show");
  $("#isZona").empty();
  $("#isZona").append(`
           <label class="form-label">Zona</label>
           <select  id="zona" class="form-select">
            
           </select>
           <div class="invalid-tooltip">
            Selecciona una zona
         </div>`);
}
function sendCiudadCreate() {
  var storeduserCia = getCookie("userCia");
  var clie = $("#clienteCreate").val();
  var ciudori = $("#ciudori").val();
  var ciudfin = $("#ciuddes").val();
  var encomienda = $("#encomienda").val();
  var undfac = $("#facturar").val();
  var cobpre = $('input[name="cobrar"]:checked').val();
  if (cobpre == 1) {
    cobpre = "S";
  } else {
    cobpre = "N";
  }
  var preenv = $("#preenv").val();
  var canstd = $("#cantidad").val();
  var preenv1 = $("#preenv1").val();
  if (canstd == null) {
    canstd = "null";
  }
  if (preenv1 == null) {
    preenv1 = "null";
  }
  var urlCreate = "http://190.4.62.141/UEAPI/Tarifas/TarifasCiudad/?clie=" + clie + "&cia=" + storeduserCia + "&desori=" + ciudori + "&desfin=" + ciudfin + "&codenv=" + encomienda + "&undfac=" + undfac + "&cobpre=" + cobpre + "&preenv=" + preenv + "&canstd=" + canstd + "&preenv1=" + preenv1 + "";
  var responseCreate = ajaxRequest(urlCreate);
  if (responseCreate.code == 200) {
    location.reload();
  }
}
function sendZonaCreate() {
  var storeduserCia = getCookie("userCia");
  var clie = $("#clienteCreate").val();
  var ciudori = $("#ciudori").val();
  var codzon = $("#zona").val();
  var encomienda = $("#encomienda").val();
  var undfac = $("#facturar").val();
  var cobpre = $('input[name="cobrar"]:checked').val();
  if (cobpre == 1) {
    cobpre = "S";
  } else {
    cobpre = "N";
  }
  var preenv = $("#preenv").val();
  var canstd = $("#cantidad").val();
  var preenv1 = $("#preenv1").val();
  if (canstd == null) {
    canstd = "null";
  }
  if (preenv1 == null) {
    preenv1 = "null";
  }
  var urlCreate = "http://190.4.62.141/UEAPI/Tarifas/TarifasZona/?clie=" + clie + "&cia=" + storeduserCia + "&desori=" + ciudori + "&codzon=" + codzon + "&codenv=" + encomienda + "&undfac=" + undfac + "&cobpre=" + cobpre + "&preenv=" + preenv + "&canstd=" + canstd + "&preenv1=" + preenv1 + "";
  var responseCreate = ajaxRequest(urlCreate);
  if (responseCreate.code == 200) {
    location.reload();
  }
}
var storeduserCia;
var cliente;
$(document).ready(function () {
  var storeduser = getCookie("user");
  var storeduserName = getCookie("userName");
  var storeduserRole = getCookie("userRole");
  var roleDescripcion = getCookie("roleDescripcion");
  storeduserCia = getCookie("userCia");
  var storeduserCode = getCookie("userCode");
  var currentpage = 1;
  var storeuserClie = getCookie("userClie");
  cliente = getCookie("cliente");
  if (storeduser == null && storeduserName == null && storeduserRole == null && storeduserCia == null && storeduserCode == null && roleDescripcion == null) {
    window.location.href = "/login.html";
  }
  $("#userName").text(storeduserName);
  $("#userRole").text(roleDescripcion);
  if (storeduserRole == 4) {
    $("#userName").text(storeduserName);
    $("#userRole").text(storeuserClie);
  }

  var descripcionPrograma = "";
  var urlGet = "http://190.4.62.141/UEAPI/Users/UserRolesMenu/?user=" + storeduser + "";
  var responseMenu = ajaxRequest(urlGet);
  if (responseMenu.code == 200) {
    const menuDisplay=$("#menu-display");
              for (let i = 0; i < responseMenu.data.length; i++) {
                  if (responseMenu.data[i]['OPCPGM'] == currentpage) {
                    menuDisplay.append(`
                    <a class="nav-link mt-1 px-0 active" style="height:50px;" aria-current="page" href="/pages/` + responseMenu.data[i]['OPCPGM'] + `.html"  data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="` + responseMenu.data[i]['DESPGM'] + `" >
                      <i class="icon ms-2 me-2 text-start" style="font-size:20px; width: 10px;">
                      ` + responseMenu.data[i]['ICON'] + `
                      </i>
                      <span class="item-name" style=" word-wrap: break-word; white-space: normal; text-align: start;">` + responseMenu.data[i]['DESPGM'] + `</span>
                    </a>
                `);
                    descripcionPrograma = responseMenu.data[i]['DESPGM'];
                  } else {
                    menuDisplay.append(`
                  <a class="nav-link mt-1 px-0" style="height:50px;" aria-current="page" href="/pages/` + responseMenu.data[i]['OPCPGM'] + `.html"  data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="` + responseMenu.data[i]['DESPGM'] + `">
                      <i class="icon ms-2 me-2 text-start" style="font-size:20px; width: 10px;" >
                      ` + responseMenu.data[i]['ICON'] + `
                      </i>
                      <span class="item-name" style=" word-wrap: break-word; white-space: normal; text-align: start;">` + responseMenu.data[i]['DESPGM'] + `</span>
                  </a>
                `);
                $('.nav-link').tooltip();
                  }
                }
                $(".sidebar-toggle").on("click",function() {
                  var asideElement = document.querySelector('aside');
                  if (asideElement.classList.contains('sidebar-mini')) {
                    $('.nav-link').tooltip();
                  } else {
                    $('.nav-link').tooltip('dispose');
                  }
                });
    if (storeduserRole == 1) {
      $("#isAdmin").append(`
                  <li><a class="dropdown-item" href="admin/perfiles.html">Perfiles</a></li>
                    <li><a class="dropdown-item " href="admin/opciones.html">Opciones</a></li>
                    <li><a class="dropdown-item" href="admin/users.html">Usuarios</a></li> `
      );
    } else {
      $("#isAdmin").append(`
                     <li><a class="dropdown-item " href="ajustes.html">Cambiar contraseña</a></li>
                     `);
    }
    if (storeduserRole != 4) {
      $("#isCliente").append(`<button type="button" class="btn btn-secondary mb-4 mt-4" style="width: 100%;" onclick="showModal()">
                    <i class="fa-solid fa-filter"></i> Filtrar por: <span id="clienteActual"></span>
                </button>`);
    }
    $("#descPGM").text(descripcionPrograma);
  }
  var storeduserCia = getCookie("userCia");
  var urlFind = "http://190.4.62.141/UEAPI/Clientes/ClientesList/?cia=" + storeduserCia + "";
  var responseClie = ajaxRequest(urlFind);
  var cont = 0;
  if (responseClie.code == 200) {
    let documentFragment = document.createDocumentFragment();

    for (let i = 0; i < responseClie.data.length; i++) {
        let option = document.createElement('option');
        option.value = responseClie.data[i]['CODCLI'];
        option.textContent = responseClie.data[i]['NOMCLI'];
        documentFragment.appendChild(option);
    }

    if (cont == 0) {
        document.getElementById("cliente").appendChild(documentFragment.cloneNode(true));
        document.getElementById("clienteCreate").appendChild(documentFragment.cloneNode(true));
        cont = 1;
    }
}

  if (cliente != null) {
    $("#cliente").val(cliente);
    $("#clienteActual").text($("#cliente option:selected").text());
    clienteDes=$("#cliente option:selected").text();
  }
  var storeduserCia = getCookie("userCia");
  var urlFind = "http://190.4.62.141/UEAPI/Ciudades/CiudadesList/?cia=" + storeduserCia + "";
  var responseCiudades = ajaxRequest(urlFind);
  var cont = 0;
  if (responseCiudades.code == 200) {
    var options = "";
    for (let i = 0; i < responseCiudades.data.length; i++) {
      options += `<option value="${responseCiudades.data[i]['CODCIU']}">${responseCiudades.data[i]['DESCIU']}</option>`;
    }
    if (cont == 0) {
      $("#ciudori").append(options);
      cont = 1;
    }
  }
  var urlFind = "http://190.4.62.141/UEAPI/Encomiendas/EncomiendasList/?cia=" + storeduserCia + "";
  var responseEncomiendas = ajaxRequest(urlFind);
  var cont = 0;
  if (responseEncomiendas.code == 200) {
    var options = "";
    for (let i = 0; i < responseEncomiendas.data.length; i++) {
      options += `<option value="${responseEncomiendas.data[i]['CODENV']}">${responseEncomiendas.data[i]['DESENV']}</option>`;
    }
    if (cont == 0) {
      $("#encomienda").append(options);
      cont = 1;
    }
  }
  $("#cliente").flexselect();
  $("#clienteCreate").flexselect();
  $("#ciudori").flexselect();
  $("#encomienda").flexselect();

  $("#ciudori").change(function () {
    $("#zona").empty();
    var storeduserCia = getCookie("userCia");
    var ciudadOrigen = $("#ciudori").val();
    var urlZonas = "http://190.4.62.141/UEAPI/Zonas/ZonasList/?cia=" + storeduserCia + "&ciu=" + ciudadOrigen + "";
    var responseZonas = ajaxRequest(urlZonas);
    var cont = 0;
    if (responseZonas.code == 200) {
      var options = "";
      for (let i = 0; i < responseZonas.data.length; i++) {
        options += `<option value="${responseZonas.data[i]['CODZON']}">${responseZonas.data[i]['DESZON']}</option>`;
      }
      if (cont == 0) {
        $("#zona").append(options);
        cont = 1;
      }
    }
  });
  if (storeduserRole == 4) {
    cliente = storeduserCode;
  }

  
  if (cliente == null) {
    $("#IsComeback").empty();
    $("#IsComeback").append('<a class="btn btn-danger" href="../index.html">Cancelar</a>');
    $("#modalFiltro").modal("show");
  } else {
    $('#tableTarifas thead th').each(function () {
      var title = $(this).text();
      $(this).html(title + '<br /><input type="text" class="form-control mt-2"/>');
    });
    var fechaActual = new Date();
    var dia = fechaActual.getDate();
    var mes = fechaActual.getMonth() + 1;
    var anio = fechaActual.getFullYear();
  
    var fechaFormateada = dia + '/' + mes + '/' + anio;
   var table =  $('#tableTarifas').DataTable({
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
    },
    "ordering": false,
    "pageLength": 15,
                  "processing": true,
                  "serverSide": true,
                  "ajax": {
                    "url": "http://190.4.62.141/UEAPI/Tarifas/TarifasListS/?cia=" + storeduserCia + "&clie=" + cliente,
                    "type": "POST",
                    "dataSrc": function (json) {
                        return json.data;
                    },
                    "data": function (d) {
                      d.columns = [];
                      $('#tableTarifas thead th input').each(function (i) {
                          d.columns.push({ 'search': { 'value': $(this).val() } });
                      });
                  },
                },
                
                  "columns": [
                      { "data": "ENCOMIENDA" },
                      { "data": "CIUDADORIGEN" },
                      { "data": "CIUDADDESTINO" },
                      { "data": "ZONADESTINO" },
                      { 
                        "data": "UNIDAD",
                        "render": function(data, type, row) {
                          if (data == 1) {
                            return "Cantidad";
                          } else if (data == 2) {
                            return "Peso";
                          } else {
                            return "";
                          }
                        }
                      },
                      { "data": "COBRO" },
                      { "data": "PREENV" },
                      { "data": "CANSTD" },
                      { "data": "PREENV1" },
                  ],
                  dom: 'Bfrtip',
      buttons: [
        {
          extend: 'print',
          text: '<i class="fa-solid fa-print"></i> <b>Imprimir</b>',
          className: "btn btn-light fs-6 mb-2",
          exportOptions: {
            columns: ':visible',
          },
          customize: function (win) {
            $(win.document.body).find('table').addClass('display').css('font-size', '14px');
            $(win.document.body).find('tr:nth-child(odd) td').each(function (index) {
              $(this).css('background-color', '#D0D0D0');
            });
  
          }
        },
        {
          text: '<i class="fa-solid fa-file-excel me-1"></i><b>Excel</b>',
          className: "btn btn-success text-light fs-6 mb-2 ladda-button",
          action: function ( e, dt, node, config ) {
           
          }
        }
      ]
                });
                table.on('draw.dt', function() {
                  $('.ladda-button').each(function() {
                    var l = Ladda.create(this);
                    $(this).on('click', function() {
                      l.start();
                      var urlExcel = "http://190.4.62.141/UEAPI/Tarifas/TarifasList/?cia=" + storeduserCia + "&clie=" + cliente + "&cliedes="+clienteDes+"";
                      window.location.href = urlExcel;
                      var xhr = new XMLHttpRequest();
                      xhr.open('HEAD', urlExcel);
                      xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                          if (xhr.status === 200) {
                            var procesosTerminados = xhr.getResponseHeader('X-Procesos-Terminados');
                            if (procesosTerminados) {
                              //console.log('Los procesos en segundo plano han terminado.');
                            } else {
                              //console.log('Los procesos en segundo plano están en progreso.');
                            }
                          } else {
                            //console.log('Ocurrió un error al obtener el encabezado.');
                          }
                          l.stop();
                        }
                      };
                      xhr.send();
                    });
                  });
                });
                $('#tableTarifas thead input').on('keyup', function () {
                  var columnIndex = $(this).parent().index();
                  var inputValue = $(this).val().trim();
              
                  if (table.column(columnIndex).search() !== inputValue) {
                      table
                          .column(columnIndex)
                          .search(inputValue)
                          .draw();
                  }
              });
  }
 
  $("#facturar").change(function () {
    if ($("#facturar").val() == 1) {
      $("#cantidad").prop('disabled', true);
      $("#preenv1").prop('disabled', true);
      $("#cantidad").val('0');
      $("#preenv1").val('0');
    } else {
      $("#cantidad").prop('disabled', false);
      $("#preenv1").prop('disabled', false);
    }
  });

  document.querySelector('form.needs-validation').addEventListener('submit', function (event) {
    if (this.checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
    } else {
      event.preventDefault();
      if (boolZona == true) {
        sendZonaCreate();
      } else {
        sendCiudadCreate();
      }

    }
    this.classList.add('was-validated');
  });

});


