<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
    <style>
    </style>
</head>

<body>
    <?php
        include '../layout-prg.php';
    ?>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">

            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-3">
        <div class="card mb-5">
            <div class="card-header">
                <h1 class="fs-4 mb-1 mt-2 text-center"></h1>
            </div>
            <div class="card-body">
                <button class="btn btn-primary text-white fw-bold fs-6" onclick="create()">Agregar un
                    usuario&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-plus"></i></button>
                <div class="table-responsive mt-3">
                    <table class="table stripe table-hover" id="tbUsers" style="width:100%">
                        <thead>
                            <tr class="sticky-top bg-white">
                                <th>Usuario</th>
                                <th>Empleado</th>
                                <th width="20%">Contraseña</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    var programasAsignados=[];
    var empleId="";
    var proveId="";

    var programasAsignadosEdit=[];
    var empleIdEdit="";
    var proveIdEdit="";
    $(document).ready(function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                html: true
            })
        });
        var table = $('#tbUsers').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                loadingRecords: `Cargando datos...`
            },
            "ajax": {
                "url": "http://172.16.15.20/API.LovablePHP/Users/GET/",
                "type": "POST",
            },
            "columns": [
                {
                    data: "CODUSU",
                },
                {
                    data: "NOMUSU",
                },
                {
                    data: "CONTRA",
                    render: function(data) {
                        return `<div class="input-group">
                                        <input type="password" class="form-control" value="` + data + `">
                                        <button type="button" class="btn btn-light input-group-text" onclick="togglePass(this)">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </div>
                                    `;
                    }
                },
                {
                    data: "NULL",
                    render: function(data, type, row) {
                        return `<button type="button" class="btn btn-warning" onclick="edit('${row.CODUSU}')"><i class="fas fa-edit text-white"></i></button>
                                <button type="button" class="btn btn-danger" onclick="confirmDel('${row.CODUSU}')"><i class="fas fa-trash-alt text-white"></i></button>`;
                    }
                },
            ],
        });

        var urlModulos = "http://172.16.15.20/API.LovablePHP/Opc/ListMod/";
        var response = ajaxRequest(urlModulos);
        var opcMod = "";
        if (response.code == 200) {
            var opcMod = "<option value='0'>Seleccione un módulo</option>";
            for (let index = 0; index < response.data.length; index++) {
                opcMod +=`<option value="${response.data[index]['CODIGO']}">${response.data[index]['DESCRP']}</option>`;
            }
        }
        document.getElementById("txtModulo").innerHTML = opcMod;
        document.getElementById("txtModuloEdit").innerHTML = opcMod;

        $("#txtModulo").change(function(){
            $("#divProgramas").empty();
            var modulo = $("#txtModulo").val().split("-")[0];
            var urlModulos = "http://172.16.15.20/API.LovablePHP/Opc/ListOpc/?modulo=" + modulo + "";
            var response = ajaxRequest(urlModulos);
            var opcOpc = `<option value="0">Seleccione una opción</option>`;
            if (response.code == 200) {

                for (let index = 0; index < response.data.length; index++) {
                    opcOpc +=
                        `<option value="${response.data[index]['CODIGO']}">${response.data[index]['DESCRP']}</option>`;
                }
            }
            $("#txtOpcion").empty();
            $("#txtOpcion").append(opcOpc);
        });
        $("#txtModuloEdit").change(function(){
            $("#divProgramasEdit").empty();
            var modulo = $("#txtModuloEdit").val().split("-")[0];
            var urlModulos = "http://172.16.15.20/API.LovablePHP/Opc/ListOpc/?modulo=" + modulo + "";
            var response = ajaxRequest(urlModulos);
            var opcOpc = `<option value="0">Seleccione una opción</option>`;
            if (response.code == 200) {

                for (let index = 0; index < response.data.length; index++) {
                    opcOpc +=
                        `<option value="${response.data[index]['CODIGO']}">${response.data[index]['DESCRP']}</option>`;
                }
            }
            $("#txtOpcionEdit").empty();
            $("#txtOpcionEdit").append(opcOpc);
         });
            $("#txtOpcion").change(function(){
                var modulo = $("#txtModulo").val();
                var opcion = $("#txtOpcion").val();
                var urlModulos = "http://172.16.15.20/API.LovablePHP/Opc/ListPrg/?modulo="+modulo+"&opcion="+opcion+"";
                var response = ajaxRequest(urlModulos);
                var row="";
                $("#divProgramas").empty();
                if (response.code==200) {
                    $("#divProgramas").append(` <hr>
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered stripe table-hover" id="tableProgramas" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-left">Programa</th>
                                                <th class="text-center">Código</th>
                                                <th class="text-center">Asignado</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbDetalles">
                                            
                                        </tbody>
                                    </table>
                                </div>`);
                    for (let i = 0; i < response.data.length; i++) {
                            if (programasAsignados.includes(response.data[i]['CODIGO'])) {
                                row+=`<tr>
                                    <td>`+response.data[i]['DESCRP']+`</td>
                                    <td class="text-center">`+response.data[i]['CODIGO']+`</td>
                                    <td class="text-center"> 
                                    <input type="text" class="codInput d-none" value="`+response.data[i]['CODIGO']+`" />
                                    <input type="checkbox" class="form-check-input checkId" checked onclick="asignarPrg(this)" id="`+response.data[i]['CODIGO']+`">
                                    </td>
                                </tr>`;
                            }else{
                                row+=`<tr>
                                    <td>`+response.data[i]['DESCRP']+`</td>
                                    <td class="text-center">`+response.data[i]['CODIGO']+`</td>
                                    <td class="text-center"> 
                                    <input type="text" class="codInput d-none" value="`+response.data[i]['CODIGO']+`" />
                                    <input type="checkbox" class="form-check-input checkId" onclick="asignarPrg(this)" id="`+response.data[i]['CODIGO']+`">
                                    </td>
                                </tr>`;
                            }
                        
                    }
                    $("#tbDetalles").append(row);
                }
            });
            //PROVEEDORES
            $('#tbProveedores thead th').each(function(){
                var title = $(this).text();
                $(this).html(title + '<br /><input type="text" oninput="this.value = this.value.toUpperCase()" class="form-control mt-2"/>');
            });
            var tableProveedor = $('#tbProveedores').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                },
                "pageLength": 10,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "http://172.16.15.20/API.LovablePHP/ZLO0015P/ListProveedoresAsync/",
                    "type": "POST",
                    "complete": function (xhr) {
                            //console.log(xhr.responseJSON);
                        },
                        error: function (xhr, status, error) {
                            console.log(error);
                            requestError = true;
                        }
                },
                "ordering": false,
                "dom": 'rtip',
                "columns": [
                    { "data": "ARCCIU",
                        render: function(data) {
                          return data.padStart(2, '0');
                      } },
                    { "data": "ARCCO1",
                        render: function(data) {
                          return data.padStart(4, '0');
                      }  },
                    { "data": "ARCNOM" },
                ],
                "drawCallback": function() {
                    $('#tbProveedores tbody tr').on('click', function() {
                        sendProveedor(this);
                    });
                }
            });
            $('#tbProveedores thead input').on('keyup', function() {
                var columnIndex = $(this).parent().index();
                var inputValue = $(this).val().trim();
                if (tableProveedor.column(columnIndex).search() !== inputValue) {
                    tableProveedor
                        .column(columnIndex)
                        .search(inputValue)
                        .draw();
                }
            });
            //EMPLEADOS
            $('#tbEmpleados thead th').each(function() {
                var title = $(this).text();
                $(this).html(title + '<br /><input type="text"  oninput="this.value = this.value.toUpperCase()" class="form-control mt-2"/>');
            });
            var tableEmpleado = $('#tbEmpleados').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                },
                "pageLength": 10,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "http://172.16.15.20/API.LovablePHP/ZLO0015P/ListEmpleadosAsync/",
                    "type": "POST",
                    "complete": function (xhr) {
                            //console.log(xhr.responseJSON);
                        },
                        error: function (xhr, status, error) {
                            console.log(error);
                            requestError = true;
                        }
                },
                "ordering": false,
                "dom": 'rtip',
                "columns": [
                    { "data": "MAEAOI",
                        render: function(data) {
                          return data.padStart(2, '0');
                      } },
                    { "data": "MAENUM",
                        render: function(data) {
                          return data.padStart(4, '0');
                      }  },
                    { "data": "MAENO1" },
                ],
                "drawCallback": function() {
                    $('#tbEmpleados tbody tr').on('click', function() {
                        sendEmpleados(this);
                    });
                }
            });
            $('#tbEmpleados thead input').on('keyup', function() {
                var columnIndex = $(this).parent().index();
                var inputValue = $(this).val().trim();

                if (tableEmpleado.column(columnIndex).search() !== inputValue) {
                    tableEmpleado.column(columnIndex)
                        .search(inputValue)
                        .draw();
                }
            });
            //PROVEEDORES EDITAS
            $('#tbProveedoresEdit thead th').each(function(){
                var title = $(this).text();
                $(this).html(title + '<br /><input type="text" oninput="this.value = this.value.toUpperCase()" class="form-control mt-2"/>');
            });
            var tableProveedorEdit = $('#tbProveedoresEdit').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                },
                "pageLength": 10,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "http://172.16.15.20/API.LovablePHP/ZLO0015P/ListProveedoresAsync/",
                    "type": "POST",
                    "complete": function (xhr) {
                            //console.log(xhr.responseJSON);
                        },
                        error: function (xhr, status, error) {
                            console.log(error);
                            requestError = true;
                        }
                },
                "ordering": false,
                "dom": 'rtip',
                "columns": [
                    { "data": "ARCCIU",
                        render: function(data) {
                          return data.padStart(2, '0');
                      } },
                    { "data": "ARCCO1",
                        render: function(data) {
                          return data.padStart(4, '0');
                      }  },
                    { "data": "ARCNOM" },
                ],
                "drawCallback": function() {
                    $('#tbProveedoresEdit tbody tr').on('click', function() {
                        sendProveedorEdit(this);
                    });
                }
            });
            $('#tbProveedoresEdit thead input').on('keyup', function() {
                var columnIndex = $(this).parent().index();
                var inputValue = $(this).val().trim();
                if (tableProveedorEdit.column(columnIndex).search() !== inputValue) {
                    tableProveedorEdit
                        .column(columnIndex)
                        .search(inputValue)
                        .draw();
                }
            });
            //EMPLEADOS EDUTAR
            $('#tbEmpleadosEdit thead th').each(function() {
                var title = $(this).text();
                $(this).html(title + '<br /><input type="text"  oninput="this.value = this.value.toUpperCase()" class="form-control mt-2"/>');
            });
            var tableEmpleadoEdit = $('#tbEmpleadosEdit').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                },
                "pageLength": 10,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "http://172.16.15.20/API.LovablePHP/ZLO0015P/ListEmpleadosAsync/",
                    "type": "POST",
                    "complete": function (xhr) {
                            //console.log(xhr.responseJSON);
                        },
                        error: function (xhr, status, error) {
                            console.log(error);
                            requestError = true;
                        }
                },
                "ordering": false,
                "dom": 'rtip',
                "columns": [
                    { "data": "MAEAOI",
                        render: function(data) {
                          return data.padStart(2, '0');
                      } },
                    { "data": "MAENUM",
                        render: function(data) {
                          return data.padStart(4, '0');
                      }  },
                    { "data": "MAENO1" },
                ],
                "drawCallback": function() {
                    $('#tbEmpleadosEdit tbody tr').on('click', function() {
                        sendEmpleadosEdit(this);
                    });
                }
            });
            $('#tbEmpleadosEdit thead input').on('keyup', function() {
                var columnIndex = $(this).parent().index();
                var inputValue = $(this).val().trim();

                if (tableEmpleadoEdit.column(columnIndex).search() !== inputValue) {
                    tableEmpleadoEdit.column(columnIndex)
                        .search(inputValue)
                        .draw();
                }
            });
            var usuario = '<?php echo $_SESSION["CODUSU"];?>';
            var urlComarc = 'http://172.16.15.20/API.LovablePHP/ZLO0015P/ListComarc/?user=' + usuario + '';
            var responseComarc = ajaxRequest(urlComarc);
            var comarcOptions = "";
            if (responseComarc.code == 200) {
                comarcOptions = '<option value="0">SIN COMPAÑIA</option>';
                for (let i = 0; i < responseComarc.data.length; i++) {
                    comarcOptions += '<option value="' + responseComarc.data[i].COMCOD.padStart(2, '0') + '">'+responseComarc.data[i].COMCOD.padStart(2, '0')+' '+responseComarc.data[i].COMDES + '</option>';
                }
                companiaId.innerHTML = comarcOptions;
                companiaIdEdit.innerHTML = comarcOptions;
            }


    });
    function asignarPrg(check) {
        var codigo = $(check).closest("td").find(".codInput").val();
        if (check.checked) {
            if (!programasAsignados.includes(codigo)) {
                programasAsignados.push(codigo);
            }
        }else{
            if (programasAsignados.includes(codigo)) {
                programasAsignados.splice(programasAsignados.indexOf(codigo),1);
            }
        }
    }
    function togglePass(button) {
        var container = button.closest('.input-group');
        var input = container.querySelector('.form-control');
        if (input) {
            input.type = (input.type === 'password') ? 'text' : 'password';
        }
        if (input.type === 'password') {
            button.innerHTML = '<i class="fa-solid fa-eye"></i>';
        } else {
            button.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
        }
    }
    function create() {
        $('#modal').modal('show');
    }
    function showProveedores() {
        $('#modal').modal('hide');
        $("#modalProveedores").modal('show');
    }
    function sendProveedor(row) {
        var tr = $(row).closest('tr');
        var tds = tr.find('td');
        var desc = tds.eq(2).text();
        var tipo = tds.eq(0).text();
        var id = tds.eq(1).text();
        tipo = tipo.padStart(2, '0');
        id = id.padStart(4, '0');
        proveId = tipo + '-' + id;
        $("#proveedorId").val(proveId + "   " + desc);
        $("#modalProveedores").modal('hide');
        $("#modal").modal('show');
    }
    function closeProveedor() {
        $('#modalProveedores').modal('hide');
        $("#modal").modal('show');
    }
    function showEmpleados() {
            $('#modal').modal('hide');
            $("#modalEmpleados").modal('show');
    }
    function sendEmpleados(row) {
            var tr = $(row).closest('tr');
            var tds = tr.find('td');
            var desc = tds.eq(2).text();
            var tipo = tds.eq(0).text();
            var id = tds.eq(1).text();
            tipo = tipo.padStart(2, '0');
            id = id.padStart(4, '0');
            empleId = tipo + '-' + id;
            $("#empleadoId").val(empleId + "   " + desc);
            $("#modalEmpleados").modal('hide');
            $("#modal").modal('show');
    }
    function closeEmpleados() {
        $('#modalEmpleados').modal('hide');
        $("#modal").modal('show');
    }
    function saveUser() {
        var codusu = $("#txtUser").val();
        var contra = $("#txtPass").val();
        var nomusu = $("#txtName").val();
        if (codusu == "" || contra == "" || nomusu == "" ) {
            $("#lblError").text("Debe llenar todos los campos");
            return;   
        }else{
            var cia = $("#companiaId").val();
            if(programasAsignados.length==0 && cia=="0"){
                $("#lblError").text("Debe una compañia o programas al usuario...");
                return;
            }
            $("#lblError").text(" ");
            var anoing = empleId.split("-")[0];
            var numemp = empleId.split("-")[1];
           
            var nivel = $("#nivel").val();
            var prov1 = proveId.split("-")[0];
            var prov2 = proveId.split("-")[1];
            var peresp = $("#permisosEsp").is(":checked") ? "S" : "N";
            var usugra = '<?php echo $_SESSION["CODUSU"];?>';
            var fecgra = ('<?php echo date("Y-m-d");?>').replace(/-/g, "");
            var programas= programasAsignados;
            var data = {
                'CODUSU': codusu,
                'CONTRA': contra,
                'NOMUSU': nomusu,
                'ANOING': (anoing=="")?"0":anoing,
                'NUMEMP': (numemp==undefined)?"0":numemp,
                'CIA': cia,
                'NIVEL': nivel,
                'PROV1': (prov1=="")?"0":prov1,
                'PROV2': (prov2==undefined)?"0":prov2,
                'PERESP': peresp,
                'PROGRAMAS': programas,
                'USUGRA': usugra,
                'FECGRA': fecgra
            };
            var urlSave ="http://172.16.15.20/API.LovablePHP/Users/CREATE/";
            var responseSave = ajaxRequest(urlSave, data, "POST");
            if (responseSave.code==200) {
                programasAsignados=[];
                empleId="";
                proveId="";
                $("#txtUser").val("");
                $("#txtPass").val("");
                $("#txtName").val("");
                $("#empleadoId").val("Selecciona un empleado");
                $("#companiaId").val("0");
                $("#nivel").val("0");
                $("#proveedorId").val("Selecciona un proveedor");
                $("#permisosEsp").prop("checked",false);
                $("#txtModulo").val("0");
                $("#txtOpcion").val("0");
                $("#divProgramas").empty();

                $("#lblError").text(" ");
                $("#modal").modal('hide');
                $("#tbUsers").DataTable().ajax.reload();
                Swal.fire({
                        title: "Usuario creado exitosamente",
                        icon: "success"
                });
            }else{
                $("#lblError").text("El usuario ya existe...");
            }
        }
    }
    function confirmDel(user) {
        $("#delUsuario").val(user);
        $("#modalDelete").modal('show');
    }
    function delUser() {
        var user = $("#delUsuario").val();
        var urlDel="http://172.16.15.20/API.LovablePHP/Users/DELETE/?codusu="+user;
        var responseDel = ajaxRequest(urlDel);
        if (responseDel.code==200) {
            $("#modalDelete").modal('hide');
            $("#tbUsers").DataTable().ajax.reload();
        }
       
    }
    function edit(codusu) {
        var urlFind="http://172.16.15.20/API.LovablePHP/Users/FIND/?codusu="+codusu;
        var responseFind = ajaxRequest(urlFind);
        if (responseFind.code==200) {
            $("#txtUserEdit").text(responseFind.data[0]['CODUSU']);
            $("#txtPassEdit").val(responseFind.data[0]['CONTRA']);
            $("#txtNameEdit").val(responseFind.data[0]['NOMUSU']);
            if ((parseInt(responseFind.data[0]['ANOING'])!=0 && parseInt(responseFind.data[0]['NUMEMP'])!=0) && 
                (responseFind.data[0]['ANOING']!=undefined && responseFind.data[0]['NUMEMP']!=undefined)) {
                    var anoing = responseFind.data[0]['ANOING'];
                    var numemp = responseFind.data[0]['NUMEMP'];
                    var urlFindEmp="http://172.16.15.20/API.LovablePHP/ZLO0015P/ListEmpleadosFind/?tipo="+anoing+"&proveedor="+numemp.padStart(2, '0')+""
                    console.log(urlFind)
                    var responseFindEmp = ajaxRequest(urlFindEmp);
                    if (responseFindEmp.code==200) {
                        $("#empleadoIdEdit").val(anoing+"-"+numemp+"   "+responseFindEmp.data[0]['MAENO1']);
                    }else{
                        $("#empleadoIdEdit").val("Selecciona un empleado");
                    }
            }else{
                $("#empleadoIdEdit").val("Selecciona un empleado");
            }
            if (responseFind.data[0]['CODCIA']!=undefined && parseInt(responseFind.data[0]['CODCIA'])!=0) {
                $("#companiaIdEdit").val(responseFind.data[0]['CODCIA'].padStart(2, '0'));
            }else{
                $("#companiaIdEdit").val(0);
            }
           
            $("#nivelEdit").val(responseFind.data[0]['NIVEL']);
            if ((responseFind.data[0]['PROVE1']!=undefined && responseFind.data[0]['PROVE2']!=undefined) && 
                (parseInt(responseFind.data[0]['PROVE1'])!=0 && parseInt(responseFind.data[0]['PROVE2'])!=0)) {
                    //AGREGAR UNA CONSULTA DE NOMBRE DE PROVEEDORES Y PANTALLA PARA ASIGNAR USUARIOS APENAS CREADO UN PROGRAMA NUEVO
                    var prov1 = responseFind.data[0]['PROVE1'];
                    var prov2 = responseFind.data[0]['PROVE2'];
                    var urlFindProv="http://172.16.15.20/API.LovablePHP/ZLO0015P/ProveedoresFind/?tipo=" + prov1 +
                        "&proveedor=" + prov2 + "";
                    var responseFindProv = ajaxRequest(urlFindProv);
                    if (responseFindProv.code==200) {
                        $("#proveedorIdEdit").val(prov1+"-"+prov2+"   "+responseFindProv.data[0]['ARCNOM']);
                    }else{
                        $("#proveedorIdEdit").val("Selecciona un proveedor");
                    }
               
            }else{
                $("#proveedorIdEdit").val("Selecciona un proveedor");
            }
            $("#permisosEspEdit").prop("checked",(responseFind.data[0]['PERESP']=="S")?true:false);
            programasAsignadosEdit=responseFind.data[0]['PROGRAMAS'];

            $("#txtOpcionEdit").change(function(){
                var modulo = $("#txtModuloEdit").val();
                var opcion = $("#txtOpcionEdit").val();
                var urlModulos = "http://172.16.15.20/API.LovablePHP/Opc/ListPrg/?modulo="+modulo+"&opcion="+opcion+"";
                var response = ajaxRequest(urlModulos);
                var row="";
                $("#divProgramasEdit").empty();
                if (response.code==200) {
                    $("#divProgramasEdit").append(` <hr>
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered stripe table-hover" id="tableProgramasEdit" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-left">Programa</th>
                                                <th class="text-center">Código</th>
                                                <th class="text-center">Asignado</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbDetallesEdit">
                                            
                                        </tbody>
                                    </table>
                                </div>`);
                    for (let i = 0; i < response.data.length; i++) {
                            if (programasAsignadosEdit.includes(response.data[i]['CODIGO'])) {
                                row+=`<tr>
                                    <td>`+response.data[i]['DESCRP']+`</td>
                                    <td class="text-center">`+response.data[i]['CODIGO']+`</td>
                                    <td class="text-center"> 
                                    <input type="text" class="codInputEdit d-none" value="`+response.data[i]['CODIGO']+`" />
                                    <input type="checkbox" class="form-check-input checkId" checked onclick="asignarPrgEdit(this)" id="`+response.data[i]['CODIGO']+`">
                                    </td>
                                </tr>`;
                            }else{
                                row+=`<tr>
                                    <td>`+response.data[i]['DESCRP']+`</td>
                                    <td class="text-center">`+response.data[i]['CODIGO']+`</td>
                                    <td class="text-center"> 
                                    <input type="text" class="codInputEdit d-none" value="`+response.data[i]['CODIGO']+`" />
                                    <input type="checkbox" class="form-check-input checkId" onclick="asignarPrgEdit(this)" id="`+response.data[i]['CODIGO']+`">
                                    </td>
                                </tr>`;
                            }
                        
                    }
                    $("#tbDetallesEdit").append(row);
                }
            });
            $("#txtModuloEdit").val(0).trigger('change');
            $("#divProgramasEdit").empty();
            $("#modalEdit").modal('show');
        }
    }
    function asignarPrgEdit(check) {
        var codigo = $(check).closest("td").find(".codInputEdit").val();
        if (check.checked) {
            if (!programasAsignadosEdit.includes(codigo)) {
                programasAsignadosEdit.push(codigo);
            }
        }else{
            if (programasAsignadosEdit.includes(codigo)) {
                programasAsignadosEdit.splice(programasAsignadosEdit.indexOf(codigo),1);
            }
        }
    }
    function saveUserEdit() {
        var codusu = $("#txtUserEdit").text();
        var contra = $("#txtPassEdit").val();
        var nomusu = $("#txtNameEdit").val();
        if (codusu == "" || contra == "" || nomusu == "" || programasAsignadosEdit.length==0) {
            $("#lblErrorEdit").text("Debe llenar todos los campos");
            return;   
        }else{
            $("#lblErrorEdit").text(" ");
            var anoing = empleIdEdit.split("-")[0];
            var numemp = empleIdEdit.split("-")[1];
            var cia = $("#companiaIdEdit").val();
            var nivel = $("#nivelEdit").val();
            var prov1 = proveIdEdit.split("-")[0];
            var prov2 = proveIdEdit.split("-")[1];
            var peresp = $("#permisosEspEdit").is(":checked") ? "S" : "N";
            var usugra = '<?php echo $_SESSION["CODUSU"];?>';
            var fecgra = ('<?php echo date("Y-m-d");?>').replace(/-/g, "");
            var programas= programasAsignadosEdit;
            var data = {
                'CODUSU': codusu,
                'CONTRA': contra,
                'NOMUSU': nomusu,
                'ANOING': (anoing=="")?"0":anoing,
                'NUMEMP': (numemp==undefined)?"0":numemp,
                'CIA': cia,
                'NIVEL': nivel,
                'PROV1': (prov1=="")?"0":prov1,
                'PROV2': (prov2==undefined)?"0":prov2,
                'PERESP': peresp,
                'PROGRAMAS': programas,
                'USUGRA': usugra,
                'FECGRA': fecgra
            };
            console.log(data);
            var urlSave ="http://172.16.15.20/API.LovablePHP/Users/EDIT/";
            var responseSave = ajaxRequest(urlSave, data, "POST");
            if (responseSave.code==200) {
                programasAsignadosEdit=[];
                empleIdEdit="";
                proveIdEdit="";
                $("#lblErrorEdit").text(" ");
                $("#modalEdit").modal('hide');
                $("#tbUsers").DataTable().ajax.reload();
                Swal.fire({
                        title: "Usuario actualizado exitosamente",
                        icon: "success"
                });
            }else{
              $("#lblErrorEdit").text("Ha ocurrido un error...");
            }
        }
    }
    //PROVEEDORES EDIT
    function showProveedoresEdit() {
        $('#modalEdit').modal('hide');
        $("#modalProveedoresEdit").modal('show');
    }
    function sendProveedorEdit(row) {
        var tr = $(row).closest('tr');
        var tds = tr.find('td');
        var desc = tds.eq(2).text();
        var tipo = tds.eq(0).text();
        var id = tds.eq(1).text();
        tipo = tipo.padStart(2, '0');
        id = id.padStart(4, '0');
        proveIdEdit = tipo + '-' + id;
        $("#proveedorIdEdit").val(proveIdEdit + "   " + desc);
        $("#modalProveedoresEdit").modal('hide');
        $("#modalEdit").modal('show');
    }
    function closeProveedorEdit() {
        $('#modalProveedoresEdit').modal('hide');
        $("#modalEdit").modal('show');
    }
    //EMPLEADOS EDIT
    function showEmpleadosEdit() {
            $('#modalEdit').modal('hide');
            $("#modalEmpleadosEdit").modal('show');
    }
    function sendEmpleadosEdit(row) {
            var tr = $(row).closest('tr');
            var tds = tr.find('td');
            var desc = tds.eq(2).text();
            var tipo = tds.eq(0).text();
            var id = tds.eq(1).text();
            tipo = tipo.padStart(2, '0');
            id = id.padStart(4, '0');
            empleIdEdit = tipo + '-' + id;
            $("#empleadoIdEdit").val(empleIdEdit + "   " + desc);
            $("#modalEmpleadosEdit").modal('hide');
            $("#modalEdit").modal('show');
    }
    function closeEmpleadosEdit() {
        $('#modalEmpleadosEdit').modal('hide');
        $("#modalEdit").modal('show');
    }
    </script>
    <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg ">
            <div class="modal-content">
                <div class="modal-header  ">
                    <h5 class="modal-title" id="staticBackdropLabel">Creación de usuario</h5>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <label for="txtUser" class="form-label">Usuario del sistema<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" oninput="this.value = this.value.toUpperCase()" id="txtUser" placeholder="Ingrese un usuario">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="txtUser" class="form-label">Contraseña<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="txtPass" placeholder="Ingrese un contraseña">
                        </div>
                        <div class="col-12">
                            <label class="form-label mt-3">Nombre de usuario<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="txtName" placeholder="Ingrese un nombre de usuario">
                        </div>
                        <div class="col-12">
                            <label for="txtPass" class="form-label mt-3">Empleado</label>
                            <span class="" onclick="showEmpleados()">
                                <input type="text" class="text-muted form-select" id="empleadoId" placeholder="Selecciona un empleado" readonly />
                            </span> 
                        </div>
                        <div class="col-9">
                            <label class="form-label mt-3">Compañia</label>
                            <select id="companiaId" class="form-select">
                               
                            </select>
                        </div>
                        <div class="col-3">
                            <label class="form-label mt-3">Nivel de usuario</label>
                            <input type="text" value="0" id="nivel"  oninput="this.value =(parseInt(this.value)>3)?'3':this.value" maxlength="1" class="form-control"  data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="0=(SIN ACCESO A LAS GRAFICAS)<br>1=(ACCESO TODAS LAS GRAFICAS)<br>2=(GRAFICAS DE VENTAS DE TIENDAS)<br>3=(GRAFICAS DE INVENTARIOS TIENDAS)">
                        </div>
                        <div class="col-12">
                            <label for="txtPass" class="form-label mt-3">Proveedor</label>
                            <span class="" onclick="showProveedores()">
                                <input type="text" class="text-muted form-select" id="proveedorId" placeholder="Selecciona un proveedor" readonly />
                            </span> 
                        </div>
                        <div class="col-12">
                            <div class="form-control d-flex mt-4">
                                <label class="form-check-label mt-2 me-3">Permiso para eliminar documentos digitales: </label>
                                <div class="form-check form-switch fs-5 mt-1">
                                    <input class="form-check-input" id="permisosEsp" type="checkbox" role="switch">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="form-label text-danger mt-2 mb-2" id="lblError"></label>
                        </div>
                        <div class="col-12 text-center">
                            <label class="form-control bg-dark text-white mt-2">Accesos del sistema</label>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="form-label mt-3">Módulo</label>
                            <select class="form-select" id="txtModulo">

                            </select>
                        </div>
                        <div class="col-12 col-lg-6" >
                            <label class="form-label mt-3">Opción</label>
                            <select class="form-select" id="txtOpcion">

                            </select>
                        </div>
                        <div class="col-12" id="divProgramas">
                           
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="saveUser()" class="btn btn-primary text-white fw-bold"><i
                            class="fa-solid fa-floppy-disk"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg ">
            <div class="modal-content">
                <div class="modal-header  ">
                    <h5 class="modal-title" id="staticBackdropLabel">Creación de usuario</h5>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <label  class="form-label">Usuario del sistema<span class="text-danger">*</span></label>
                            <label class="form-control" id="txtUserEdit"></label>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="form-label">Contraseña<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="txtPassEdit" placeholder="Ingrese un contraseña">
                        </div>
                        <div class="col-12">
                            <label class="form-label mt-3">Nombre de usuario<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="txtNameEdit" placeholder="Ingrese un nombre de usuario">
                        </div>
                        <div class="col-12">
                            <label  class="form-label mt-3">Empleado</label>
                            <span class="" onclick="showEmpleadosEdit()">
                                <input type="text" class="text-muted form-select" id="empleadoIdEdit" placeholder="Selecciona un empleado" readonly />
                            </span> 
                        </div>
                        <div class="col-9">
                            <label class="form-label mt-3">Compañia</label>
                            <select id="companiaIdEdit" class="form-select">
                               
                            </select>
                        </div>
                        <div class="col-3">
                            <label class="form-label mt-3">Nivel de usuario</label>
                            <input type="text" value="0" id="nivelEdit"  oninput="this.value =(parseInt(this.value)>3)?'3':this.value" maxlength="1" class="form-control"  data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="0=(SIN ACCESO A LAS GRAFICAS)<br>1=(ACCESO TODAS LAS GRAFICAS)<br>2=(GRAFICAS DE VENTAS DE TIENDAS)<br>3=(GRAFICAS DE INVENTARIOS TIENDAS)">
                        </div>
                        <div class="col-12">
                            <label  class="form-label mt-3">Proveedor</label>
                            <span class="" onclick="showProveedoresEdit()">
                                <input type="text" class="text-muted form-select" id="proveedorIdEdit" placeholder="Selecciona un proveedor" readonly />
                            </span> 
                        </div>
                        <div class="col-12">
                            <div class="form-control d-flex mt-4">
                                <label class="form-check-label mt-2 me-3">Permiso para eliminar documentos digitales: </label>
                                <div class="form-check form-switch fs-5 mt-1">
                                    <input class="form-check-input" id="permisosEspEdit" type="checkbox" role="switch">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="form-label text-danger mt-2 mb-2" id="lblErrorEdit"></label>
                        </div>
                        <div class="col-12 text-center">
                            <label class="form-control bg-dark text-white mt-2">Accesos del sistema</label>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="form-label mt-3">Módulo</label>
                            <select class="form-select" id="txtModuloEdit">

                            </select>
                        </div>
                        <div class="col-12 col-lg-6" >
                            <label class="form-label mt-3">Opción</label>
                            <select class="form-select" id="txtOpcionEdit">

                            </select>
                        </div>
                        <div class="col-12" id="divProgramasEdit">
                           
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="saveUserEdit()" class="btn btn-primary text-white fw-bold"><i
                            class="fa-solid fa-floppy-disk"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body" id="contentModal">
                    <div class="row">
                        <div class="col-12 text-center">
                            <i class="fa-solid fa-triangle-exclamation fa-shake text-warning" style="font-size: 200px;"></i>
                            <h1 class="fs-3 mt-2">¿Está seguro de eliminar el usuario?</h1>
                        </div>
                        <div class="col-12 text-center">
                            <h6 class="text-danger fs-6">Esto tambien eliminará los accesos del sistema</h6>
                            <input type="text" id="delUsuario" class="d-none">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary text-white fw-bold"
                        data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger text-white fw-bold" onclick="delUser()"> Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <!--PROVEEDORES-->
    <div class="modal fade" id="modalProveedores" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>

                    <button type="button" class="btn-close" onclick="closeProveedor()"></button>
                </div>
                <div class="modal-body">
                    <div class="table-container mt-3" style="width:100%;">
                        <table id="tbProveedores" class="table stripe table-hover " style="width:100%">
                            <thead>
                                <tr>
                                    <th colspan="10%" class="text-black text-start">Tipo</th>
                                    <th colspan="10%" class="text-black text-start">Proveedor</th>
                                    <th colspan="10%" class="text-black text-start">Descripción</th>
                                </tr>
                            </thead>
                            <tbody id="tbProveedoresBody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--EMPLEADOS-->
    <div class="modal fade" id="modalEmpleados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>

                    <button type="button" class="btn-close" onclick="closeEmpleados()"></button>
                </div>
                <div class="modal-body">
                    <div class="table-container mt-3" style="width:100%;">
                        <table id="tbEmpleados" class="table stripe table-hover " style="width:100%">
                            <thead>
                                <tr>
                                    <th colspan="10%" class="text-black text-start">Año ingreso</th>
                                    <th colspan="10%" class="text-black text-start">Numero empleado</th>
                                    <th colspan="10%" class="text-black text-start">Nombre completo</th>
                                </tr>
                            </thead>
                            <tbody id="tbEmpleadosBody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!--PROVEEDORES EDITAR-->
     <div class="modal fade" id="modalProveedoresEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>

                    <button type="button" class="btn-close" onclick="closeProveedorEdit()"></button>
                </div>
                <div class="modal-body">
                    <div class="table-container mt-3" style="width:100%;">
                        <table id="tbProveedoresEdit" class="table stripe table-hover " style="width:100%">
                            <thead>
                                <tr>
                                    <th colspan="10%" class="text-black text-start">Tipo</th>
                                    <th colspan="10%" class="text-black text-start">Proveedor</th>
                                    <th colspan="10%" class="text-black text-start">Descripción</th>
                                </tr>
                            </thead>
                            <tbody id="tbProveedoresBodyEdit">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!--EMPLEADOS EDITAR-->
     <div class="modal fade" id="modalEmpleadosEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>

                    <button type="button" class="btn-close" onclick="closeEmpleadosEdit()"></button>
                </div>
                <div class="modal-body">
                    <div class="table-container mt-3" style="width:100%;">
                        <table id="tbEmpleadosEdit" class="table stripe table-hover " style="width:100%">
                            <thead>
                                <tr>
                                    <th colspan="10%" class="text-black text-start">Año ingreso</th>
                                    <th colspan="10%" class="text-black text-start">Numero empleado</th>
                                    <th colspan="10%" class="text-black text-start">Nombre completo</th>
                                </tr>
                            </thead>
                            <tbody id="tbEmpleadosBodyEdit">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>