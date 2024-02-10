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
    var programasAsignados = [];
    var empleId = "";
    var proveId = "";

    var programasAsignadosEdit = [];
    var empleIdEdit = "";
    var proveIdEdit = "";

    var todasAgrupaciones = [];
    var agrupacionesAsignadas = [];
    var agrupacionesAsignadasEdit = [];

    var departamentosUsuario = [0];
    var departamentosUsuarioEdit = [0];
    var tiposDocs = [];
    var tiposDocsEdit = [];

    var ciasAsignados=[];
    var ciasAsignadosEdit=[];

    var tableEmpleado = null;
    var tableProveedor = null;
    var tableEmpleadoEdit = null;
    var tableProveedorEdit = null;
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
            "columns": [{
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
                opcMod +=
                    `<option value="${response.data[index]['CODIGO']}">${response.data[index]['DESCRP']}</option>`;
            }
        }
        document.getElementById("txtModulo").innerHTML = opcMod;
        document.getElementById("txtModuloEdit").innerHTML = opcMod;

        $("#txtModulo").change(function() {
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
        $("#txtModuloEdit").change(function() {
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
        $("#txtOpcion").change(function() {
            var modulo = $("#txtModulo").val();
            var opcion = $("#txtOpcion").val();
            var urlModulos = "http://172.16.15.20/API.LovablePHP/Opc/ListPrg/?modulo=" + modulo +
                "&opcion=" + opcion + "";
            var response = ajaxRequest(urlModulos);
            var row = "";
            $("#divProgramas").empty();
            if (response.code == 200) {
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
                        row += `<tr>
                                    <td>` + response.data[i]['DESCRP'] + `</td>
                                    <td class="text-center">` + response.data[i]['CODIGO'] + `</td>
                                    <td class="text-center">
                                    <input type="text" class="codInput d-none" value="` + response.data[i]['CODIGO'] +
                            `" />
                                    <input type="checkbox" class="form-check-input checkId" checked onclick="asignarPrg(this)" id="` +
                            response.data[i]['CODIGO'] + `">
                                    </td>
                                </tr>`;
                    } else {
                        row += `<tr>
                                    <td>` + response.data[i]['DESCRP'] + `</td>
                                    <td class="text-center">` + response.data[i]['CODIGO'] + `</td>
                                    <td class="text-center">
                                    <input type="text" class="codInput d-none" value="` + response.data[i]['CODIGO'] +
                            `" />
                                    <input type="checkbox" class="form-check-input checkId" onclick="asignarPrg(this)" id="` +
                            response.data[i]['CODIGO'] + `">
                                    </td>
                                </tr>`;
                    }

                }
                $("#tbDetalles").append(row);
            }
        });
        //PROVEEDORES
        $('#tbProveedores thead th').each(function() {
            var title = $(this).text();
            $(this).html(title +
                '<br /><input type="text" oninput="this.value = this.value.toUpperCase()" class="form-control mt-2"/>'
            );
        });
        tableProveedor = $('#tbProveedores').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            },
            "pageLength": 10,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "http://172.16.15.20/API.LovablePHP/ZLO0015P/ListProveedoresAsync/",
                "type": "POST",
                "complete": function(xhr) {
                    //console.log(xhr.responseJSON);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    requestError = true;
                }
            },
            "ordering": false,
            "dom": 'rtip',
            "columns": [{
                    "data": "ARCCIU",
                    render: function(data) {
                        return data.padStart(2, '0');
                    }
                },
                {
                    "data": "ARCCO1",
                    render: function(data) {
                        return data.padStart(4, '0');
                    }
                },
                {
                    "data": "ARCNOM"
                },
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
            $(this).html(title +
                '<br /><input type="text"  oninput="this.value = this.value.toUpperCase()" class="form-control mt-2"/>'
            );
        });
        tableEmpleado = $('#tbEmpleados').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            },
            "pageLength": 10,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "http://172.16.15.20/API.LovablePHP/ZLO0015P/ListEmpleadosAsync/",
                "type": "POST",
                "complete": function(xhr) {
                    //console.log(xhr.responseJSON);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    requestError = true;
                }
            },
            "ordering": false,
            "dom": 'rtip',
            "columns": [{
                    "data": "MAEAOI",
                    render: function(data) {
                        return data.padStart(2, '0');
                    }
                },
                {
                    "data": "NULL",
                    "render": function(data, type, row) {
                        return '<span style="float: left;">' + row.MAENUM.padStart(4, '0') +
                            '</span>' +
                            '<span style="float: right;">' + ' (' + row.NOMCIA + ')' +
                            '</span>';
                    },

                },
                {
                    "data": "NULL",
                    render: function(data, type, row) {
                        return row.MAENO1;
                    },
                },
                {
                    "data": "NULL",
                    render: function(data, type, row) {
                        return row.MAEC01 + '-' + row.MAEC02;
                    },
                    className: "d-none"
                }
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
        $('#tbProveedoresEdit thead th').each(function() {
            var title = $(this).text();
            $(this).html(title +
                '<br /><input type="text" oninput="this.value = this.value.toUpperCase()" class="form-control mt-2"/>'
            );
        });
        tableProveedorEdit = $('#tbProveedoresEdit').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            },
            "pageLength": 10,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "http://172.16.15.20/API.LovablePHP/ZLO0015P/ListProveedoresAsync/",
                "type": "POST",
                "complete": function(xhr) {
                    //console.log(xhr.responseJSON);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    requestError = true;
                }
            },
            "ordering": false,
            "dom": 'rtip',
            "columns": [{
                    "data": "ARCCIU",
                    render: function(data) {
                        return data.padStart(2, '0');
                    }
                },
                {
                    "data": "ARCCO1",
                    render: function(data) {
                        return data.padStart(4, '0');
                    }
                },
                {
                    "data": "ARCNOM"
                },
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
        //EMPLEADOS EDITAR
        $('#tbEmpleadosEdit thead th').each(function() {
            var title = $(this).text();
            $(this).html(title +
                '<br /><input type="text"  oninput="this.value = this.value.toUpperCase()" class="form-control mt-2"/>'
            );
        });
        tableEmpleadoEdit = $('#tbEmpleadosEdit').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            },
            "pageLength": 10,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "http://172.16.15.20/API.LovablePHP/ZLO0015P/ListEmpleadosAsync/",
                "type": "POST",
                "complete": function(xhr) {
                    //console.log(xhr.responseJSON);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    requestError = true;
                }
            },
            "ordering": false,
            "dom": 'rtip',
            "columns": [{
                    "data": "MAEAOI",
                    render: function(data) {
                        return data.padStart(2, '0');
                    }
                },
                {
                    "data": "NULL",
                    "render": function(data, type, row) {
                        return '<span style="float: left;">' + row.MAENUM.padStart(4, '0') +
                            '</span>' +
                            '<span style="float: right;">' + ' (' + row.NOMCIA + ')' +
                            '</span>';
                    },

                },
                {
                    "data": "NULL",
                    render: function(data, type, row) {
                        return row.MAENO1;
                    },
                },
                {
                    "data": "NULL",
                    render: function(data, type, row) {
                        return row.MAEC01 + '-' + row.MAEC02;
                    },
                    className: "d-none"
                }
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
        var urlComarc = 'http://172.16.15.20/API.LovablePHP/ZLO0015P/ListComarc2/?user=' + usuario + '';
        var responseComarc = ajaxRequest(urlComarc);
        var comarcOptions = "";
        if (responseComarc.code == 200) {
            comarcOptions = '<option value="0">SIN COMPAÑIA</option>';
           var ciasOptions='';
            for (let i = 0; i < responseComarc.data.length; i++) {
                comarcOptions += '<option value="' + responseComarc.data[i].COMCOD.padStart(2, '0') + '">' +
                    responseComarc.data[i].COMCOD.padStart(2, '0') + ' ' + responseComarc.data[i].COMDES +
                    '</option>';
                    ciasOptions+= '<option value="' + responseComarc.data[i].COMCOD.padStart(2, '0') + '">' +
                    responseComarc.data[i].COMCOD.padStart(2, '0') + ' ' + responseComarc.data[i].COMDES +
                    '</option>';
            }
            companiaId.innerHTML = comarcOptions;
            companiaIdEdit.innerHTML = comarcOptions;
            ciasSelect.innerHTML = ciasOptions;
            ciasSelectEdit.innerHTML = ciasOptions;
        }
        var urlDepas = "http://172.16.15.20/API.LOVABLEPHP/ZLO0015P/ListDepas/";
        var responseDepas = ajaxRequest(urlDepas);
        if (responseDepas.code == 200) {
            const departamentos = $("#cbbDepartamentos");
            const departamentosEdit = $("#cbbDepartamentosEdit");
            departamentos.empty();
            departamentos.append(
                `<option value="0-0" class="text-muted" selected>Agrega un departamento al usuario</option>`
            );
            for (let i = 0; i < responseDepas.data.length; i++) {
                departamentos.append(`<option value="` + responseDepas.data[i].SECDEP + `-` + responseDepas
                    .data[i].SECCOD + `">` + responseDepas.data[i].SECDES + `</option>`);
            }
            departamentosEdit.empty();
            departamentosEdit.append(
                `<option value="0-0" class="text-muted" selected>Agrega un departamento al usuario</option>`
            );
            for (let i = 0; i < responseDepas.data.length; i++) {
                departamentosEdit.append(`<option value="` + responseDepas.data[i].SECDEP + `-` + responseDepas
                    .data[i].SECCOD + `">` + responseDepas.data[i].SECDES + `</option>`);
            }
        }
        var urlTipos = "http://172.16.15.20/API.LovablePHP/ZLO0015P/ListTipos/";
        var responseTipos = ajaxRequest(urlTipos);
        if (responseTipos.code == 200) {
            const tipos = $("#tiposDoc");
            const tiposEdit = $("#tiposDocEdit");
            tipos.empty();
            tiposEdit.empty();
            tipos.append(
                `<option value="0" class="text-muted" selected>Agrega un tipo de documento al usuario</option>`
            );
            tiposEdit.append(
                `<option value="0" class="text-muted" selected>Agrega un tipo de documento al usuario</option>`
            );
            for (let i = 0; i < responseTipos.data.length; i++) {
                tipos.append(`<option value="` + responseTipos.data[i].TIPDOC + `">` + responseTipos.data[i]
                    .DESCRP + `</option>`);
                tiposEdit.append(`<option value="` + responseTipos.data[i].TIPDOC + `">` + responseTipos.data[i]
                    .DESCRP + `</option>`);
            }
        }

        var urlAgrup = "http://172.16.15.20/API.LovablePHP/Users/ListAgrup/";
        var responseAgrup = ajaxRequest(urlAgrup);
        if (responseAgrup.code == 200) {
            const agrupacion = $("#tbAgrupacion");
            const agrupacionesEdit = $("#tbAgrupacionEdit");
            agrupacion.empty();
            agrupacionesEdit.empty();
            var rowTr = '';
            var rowTrEdit = '';
            for (let i = 0; i < responseAgrup.data.length; i++) {
                todasAgrupaciones.push(responseAgrup.data[i]['CODIGO']);
                rowTr += '<tr>';
                rowTr += '<td class="text-center">' + responseAgrup.data[i]['DESCRI'] + '</td>';
                rowTr += '<td class="text-center">';
                rowTr += '<input type="checkbox" class="form-check-input checkAgrup" value="' + responseAgrup
                    .data[i]['CODIGO'] + '">';
                rowTr += '</td>';
                rowTr += '</tr>';

                rowTrEdit += '<tr>';
                rowTrEdit += '<td class="text-center">' + responseAgrup.data[i]['DESCRI'] + '</td>';
                rowTrEdit += '<td class="text-center">';
                rowTrEdit += '<input type="checkbox" class="form-check-input checkAgrupEdit" value="' + responseAgrup
                    .data[i]['CODIGO'] + '">';
                    rowTrEdit += '</td>';
                    rowTrEdit += '</tr>';
            }
            agrupacion.append(rowTr);
            agrupacionesEdit.append(rowTrEdit);
        }
        $(".checkAgrup").on("click", function() {
            var codigo = $(this).val();
            if ($(this).is(":checked")) {
                agrupacionesAsignadas.push(codigo);
            } else {
                agrupacionesAsignadas.splice(agrupacionesAsignadas.indexOf(codigo), 1);
            }
        });
        $("#Allck").on("click", function() {
            if ($(this).is(":checked")) {
                $(".checkAgrup").prop("checked", true);
                agrupacionesAsignadas = todasAgrupaciones;
            } else {
                $(".checkAgrup").prop("checked", false);
                agrupacionesAsignadas = [];
            }
        });

        $(".checkAgrupEdit").on("click", function() {
            var codigo = $(this).val();
            if ($(this).is(":checked")) {
                agrupacionesAsignadasEdit.push(codigo);
            } else {
                agrupacionesAsignadasEdit.splice(agrupacionesAsignadasEdit.indexOf(codigo), 1);
            }
        });
        $("#AllckEdit").on("click", function() {
            if ($(this).is(":checked")) {
                $(".checkAgrupEdit").prop("checked", true);
                agrupacionesAsignadasEdit = todasAgrupaciones;
            } else {
                $(".checkAgrupEdit").prop("checked", false);
                agrupacionesAsignadasEdit = [];
            }
        });
    });

    function addRow() {
        const departamentos = $("#cbbDepartamentos");
        if (departamentos.val() == "0-0" || departamentos.val() == null) {
            $("#lblCbbError").text("Debe seleccionar un departamento");
        } else {
            $("#lblCbbError").text("");
            var splitDepa = departamentos.val().split("-");
            var depa = splitDepa[0];
            var cod = splitDepa[1];
            if (!departamentosUsuario.includes(depa + "-" + cod)) {
                departamentosUsuario.push(depa + "-" + cod);
                var row = `<tr>
                                <td class="p-0 p-1 m-0">` + $("#cbbDepartamentos option:selected").text() + `</td>
                                <td class="text-center p-0 p-1 m-0">
                                    <input type="text" class="d-none" value="` + depa + '-' + cod + `" />
                                    <button type="button" class="btn btn-danger" onclick="delRow(this)"><i class="fas fa-trash-alt text-white"></i></button>
                                </td>
                            </tr>`;
                $("#tableDepartamentos").append(row);
                $("#divDepartamentos").removeClass("d-none");
                $("#cbbDepartamentos").val("0-0");
            } else {
                $("#lblCbbError").text("El departamento ya fue agregado");
            }
        }
    }

    function delRow(button) {
        var container = button.closest('tr');
        var input = $(button).siblings('input');
        var inputVal = input.val().split("-");
        var depa = inputVal[0];
        var cod = inputVal[1];
        departamentosUsuario.splice(departamentosUsuario.indexOf(depa + "-" + cod), 1);
        container.remove();
        if (departamentosUsuario.length == 1 && $("#depaFixed").text() == "") {
            $("#divDepartamentos").addClass("d-none");
        }
    }

    function addRowEdit() {
        const departamentos = $("#cbbDepartamentosEdit");
        if (departamentos.val() == "0-0" || departamentos.val() == null) {
            $("#lblCbbErrorEdit").text("Debe seleccionar un departamento");
        } else {
            $("#lblCbbErrorEdit").text("");
            var splitDepa = departamentos.val().split("-");
            var depa = splitDepa[0];
            var cod = splitDepa[1];
            if (!departamentosUsuarioEdit.includes(depa + "-" + cod)) {
                departamentosUsuarioEdit.push(depa + "-" + cod);
                var row = `<tr>
                                <td class="p-0 p-1 m-0">` + $("#cbbDepartamentosEdit option:selected").text() + `</td>
                                <td class="text-center p-0 p-1 m-0">
                                    <input type="text" class="d-none" value="` + depa + '-' + cod + `" />
                                    <button type="button" class="btn btn-danger" onclick="delRowEdit(this)"><i class="fas fa-trash-alt text-white"></i></button>
                                </td>
                            </tr>`;
                $("#tableDepartamentosEdit").append(row);
                $("#divDepartamentosEdit").removeClass("d-none");
                $("#cbbDepartamentosEdit").val("0-0");
            } else {
                $("#lblCbbErrorEdit").text("El departamento ya fue agregado");
            }
        }
    }

    function delRowEdit(button) {
        var container = button.closest('tr');
        var input = $(button).siblings('input');
        var inputVal = input.val().split("-");
        var depa = inputVal[0];
        var cod = inputVal[1];
        departamentosUsuarioEdit.splice(departamentosUsuarioEdit.indexOf(depa + "-" + cod), 1);
        container.remove();
        if (departamentosUsuarioEdit.length == 1 && $("#depaFixedEdit").text() == "") {
            $("#divDepartamentosEdit").addClass("d-none");
        }
    }

    function addRowTipos() {
        const tiposDoc = $("#tiposDoc");
        if (tiposDoc.val() == "0") {
            $("#lblTiposError").text("Debe seleccionar un tipo de documento");
        } else {
            $("#lblTiposError").text("");
            var tipo = tiposDoc.val();
            if (!tiposDocs.includes(tipo)) {
                tiposDocs.push(tipo);
                var row = `<tr>
                                <td class="p-0 p-1 m-0">` + $("#tiposDoc option:selected").text() + `</td>
                                <td class="text-center p-0 p-1 m-0">
                                    <input type="text" class="d-none" value="` + tipo + `" />
                                    <button type="button" class="btn btn-danger" onclick="delRowTipos(this)"><i class="fas fa-trash-alt text-white"></i></button>
                                </td>
                            </tr>`;
                $("#tableTiposDoc").append(row);
                $("#divTiposDoc").removeClass("d-none");
                $("#tiposDoc").val("0");
            } else {
                $("#lblTiposError").text("El tipo de documento ya fue agregado");
            }
        }
    }

    function delRowTipos(button) {
        var container = button.closest('tr');
        var input = $(button).siblings('input');
        var inputVal = input.val();
        tiposDocs.splice(tiposDocs.indexOf(inputVal), 1);
        container.remove();
        if (tiposDocs.length == 0) {
            $("#divTiposDoc").addClass("d-none");
        }
    }

    function addRowTiposEdit() {
        const tiposDoc = $("#tiposDocEdit");
        if (tiposDoc.val() == "0") {
            $("#lblTiposErrorEdit").text("Debe seleccionar un tipo de documento");
        } else {
            $("#lblTiposErrorEdit").text("");
            var tipo = tiposDoc.val();
            if (!tiposDocsEdit.includes(tipo)) {
                tiposDocsEdit.push(tipo);
                var row = `<tr>
                                <td class="p-0 p-1 m-0">` + $("#tiposDocEdit option:selected").text() + `</td>
                                <td class="text-center p-0 p-1 m-0">
                                    <input type="text" class="d-none" value="` + tipo + `" />
                                    <button type="button" class="btn btn-danger" onclick="delRowTiposEdit(this)"><i class="fas fa-trash-alt text-white"></i></button>
                                </td>
                            </tr>`;
                $("#tableTiposDocEdit").append(row);
                $("#divTiposDocEdit").removeClass("d-none");
                $("#tiposDocEdit").val("0");
            } else {
                $("#lblTiposErrorEdit").text("El tipo de documento ya fue agregado");
            }
        }
    }

    function delRowTiposEdit(button) {
        var container = button.closest('tr');
        var input = $(button).siblings('input');
        var inputVal = input.val();
        tiposDocsEdit.splice(tiposDocs.indexOf(inputVal), 1);
        container.remove();
        if (tiposDocsEdit.length == 0) {
            $("#divTiposDocEdit").addClass("d-none");
        }
    }

    function addRowCias() {
        const cia = $("#ciasSelect");
        if (cia.val() == "0" || cia.val() == null) {
            $("#lblCiasError").text("Debe seleccionar una compañía");
        } else {
            $("#lblCiasError").text("");
            var cod =  cia.val();
            if (!ciasAsignados.includes(cod)) {
                ciasAsignados.push(cod);
                var row = `<tr>
                                <td class="p-0 p-1 m-0">` + $("#ciasSelect option:selected").text() + `</td>
                                <td class="text-center p-0 p-1 m-0">
                                    <input type="text" class="d-none" value="` + cod + `" />
                                    <button type="button" class="btn btn-danger" onclick="delRowCias(this)"><i class="fas fa-trash-alt text-white"></i></button>
                                </td>
                            </tr>`;
                $("#tableCias").append(row);
                $("#divCias").removeClass("d-none");
                $("#ciasSelect").val("01");
            } else {
                $("#lblCiasError").text("La compañía ya fue agregada");
            }
        }
    }
    function delRowCias(button) {
        var container = button.closest('tr');
        var input = $(button).siblings('input');
        var cod = input.val()
        ciasAsignados.splice(ciasAsignados.indexOf(cod), 1);
        container.remove();
        if (ciasAsignados.length == 0) {
            $("#divCias").addClass("d-none");
        }
    }
    function addRowCiasEdit() {
        const cia = $("#ciasSelectEdit");
        if (cia.val() == "0" || cia.val() == null) {
            $("#lblCiasErrorEdit").text("Debe seleccionar una compañía");
        } else {
            $("#lblCiasErrorEdit").text("");
            var cod =  cia.val();
            if (!ciasAsignadosEdit.includes(cod)) {
                ciasAsignadosEdit.push(cod);
                var row = `<tr>
                                <td class="p-0 p-1 m-0">` + $("#ciasSelectEdit option:selected").text() + `</td>
                                <td class="text-center p-0 p-1 m-0">
                                    <input type="text" class="d-none" value="` + cod + `" />
                                    <button type="button" class="btn btn-danger" onclick="delRowCiasEdit(this)"><i class="fas fa-trash-alt text-white"></i></button>
                                </td>
                            </tr>`;
                $("#tableCiasEdit").append(row);
                $("#divCiasEdit").removeClass("d-none");
                $("#ciasSelectEdit").val("01");
            } else {
                $("#lblCiasErrorEdit").text("La compañía ya fue agregada");
            }
        }
    }
    function delRowCiasEdit(button) {
        var container = button.closest('tr');
        var input = $(button).siblings('input');
        var cod = input.val()
        ciasAsignadosEdit.splice(ciasAsignadosEdit.indexOf(cod), 1);
        container.remove();
        if (ciasAsignadosEdit.length == 0) {
            $("#divCiasEdit").addClass("d-none");
        }
    }
    function asignarPrg(check) {
        var codigo = $(check).closest("td").find(".codInput").val();
        if (check.checked) {
            if (!programasAsignados.includes(codigo)) {
                programasAsignados.push(codigo);
            }
        } else {
            if (programasAsignados.includes(codigo)) {
                programasAsignados.splice(programasAsignados.indexOf(codigo), 1);
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
        $("#txtUser").val("");
        $("#txtPass").val("");
        $("#txtName").val("");
        $("#empleadoId").val("Selecciona un empleado");
        $("#companiaId").val("0");
        $("#nivel").val("0");
        $("#proveedorId").val("Selecciona un proveedor");
        $("#permisosEsp1").prop("checked", false);
        $("#permisosEsp2").prop("checked", false);
        $("#txtModulo").val("0");
        $("#txtOpcion").val("0");
        $("#divProgramas").empty();
        $("#lblError").text(" ");
        $("#tbDetallesDepa").empty();
        $("#tbDetallesDepa").append(`<tr>
                                                        <td class="p-0 p-2 m-0" colspan="2">
                                                            <span id="depaFixed"></span>
                                                        </td>
                                                    </tr>`);
        $("#divDepartamentos").addClass("d-none");
        departamentosUsuario = [0];
        //
        const menuUsuario = $("#menuUsuario");
        if (menuUsuario.css("display") == "none") {
            menuUsuario.animate({
                height: 'toggle'
            });
            let icon = $("#iconArrow1");
            icon.removeClass("fa-angles-down");
            icon.addClass("fa-angles-up");
        }
        //
        const menuDigitalizacion = $("#menuDigitalizacion");
        if (menuDigitalizacion.css("display") != "none") {
            menuDigitalizacion.animate({
                height: 'toggle'
            });
            let icon = $("#iconArrow3");
            icon.removeClass("fa-angles-up");
            icon.addClass("fa-angles-down");
        }
        //
        const menuAgrupaciones = $("#menuAgrupaciones");
        if (menuAgrupaciones.css("display") != "none") {
            menuAgrupaciones.animate({
                height: 'toggle'
            });
            let icon = $("#iconArrow4");
            icon.removeClass("fa-angles-up");
            icon.addClass("fa-angles-down");
        }
        //
        const menuAccesos = $("#menuAccesos");
        if (menuAccesos.css("display") != "none") {
            menuAccesos.animate({
                height: 'toggle'
            });
            let icon = $("#iconArrow5");
            icon.removeClass("fa-angles-up");
            icon.addClass("fa-angles-down");
        }
        //
        $("#Allck").prop("checked", false);
        $(".checkAgrup").prop("checked", false);
        agrupacionesAsignadas = [];

        ciasAsignados = [];
        $("#tbCiasDetalles").empty();
        $("#divCias").addClass("d-none");

        tiposDocs = [];
        $("#tbTiposDetalles").empty();
        $("#divTiposDoc").addClass("d-none");
        setTimeout(() => {
            $('#modal').modal('show');
        }, 500);
    }

    function showProveedores() {
        $('#modal').modal('hide');
        $('#tbProveedores thead input').val('').keyup();
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

    function cleanProveedores() {
        $("#proveedorId").val('Selecciona un proveedor');
        proveId = "";
    }

    function closeProveedor() {
        $('#modalProveedores').modal('hide');
        $("#modal").modal('show');
    }

    function showEmpleados() {
        $('#modal').modal('hide');
        $('#tbEmpleados thead input').val('').keyup();
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
        var dep = tds.eq(3).text();
        var splitDepa = dep.split("-");
        var depa = splitDepa[0];
        var cod = splitDepa[1];
        var desc = $("#cbbDepartamentos option[value='" + depa + "-" + cod + "']").text();
        departamentosUsuario[0] = depa + "-" + cod;
        $("#depaFixed").text(desc);
        $("#divDepartamentos").removeClass("d-none");
        $("#modalEmpleados").modal('hide');
        $("#modal").modal('show');
    }

    function cleanEmpleados() {
        $("#empleadoId").val('Selecciona un empleado');
        $("#depaFixed").text('');
        $("#divDepartamentos").addClass("d-none");
        empleId = "";
        departamentosUsuario = [0];
    }

    function closeEmpleados() {
        $('#modalEmpleados').modal('hide');
        $("#modal").modal('show');
    }

    function saveUser() {
        var codusu = $("#txtUser").val();
        var contra = $("#txtPass").val();
        var nomusu = $("#txtName").val();
        if (codusu == "" || contra == "" || nomusu == "") {
            $("#lblError").text("**Debe llenar todos los campos**");
            return;
        } else {
            var cia = $("#companiaId").val();
            if (programasAsignados.length == 0 && cia == "0") {
                $("#lblError").text("Debe agregar una compañia o programas al usuario...");
                return;
            }
            $("#lblError").text(" ");
            var anoing = empleId.split("-")[0];
            var numemp = empleId.split("-")[1];

            var nivel = $("#nivel").val();
            var prov1 = proveId.split("-")[0];
            var prov2 = proveId.split("-")[1];
            var peresp = [];
            if ($("#permisosEsp1").is(":checked") || $("#permisosEsp2").is(":checked")) {
                if ($("#permisosEsp1").is(":checked")) {
                    peresp.push("S-E");
                }
                if ($("#permisosEsp2").is(":checked")) {
                    peresp.push("S-A");
                }
            } else {
                peresp[0] = 'N';
            }
            var usugra = '<?php echo $_SESSION["CODUSU"];?>';
            var fecgra = ('<?php echo date("Y-m-d");?>').replace(/-/g, "");
            var data = {
                'CODUSU': codusu,
                'CONTRA': contra,
                'NOMUSU': nomusu,
                'ANOING': (anoing == "") ? "0" : anoing,
                'NUMEMP': (numemp == undefined) ? "0" : numemp.substring(0, 4),
                'CIA': cia,
                'NIVEL': nivel,
                'PROV1': (prov1 == "") ? "0" : prov1,
                'PROV2': (prov2 == undefined) ? "0" : prov2,
                'PERESP': peresp,
                'PROGRAMAS': programasAsignados,
                'USUGRA': usugra,
                'FECGRA': fecgra,
                'AREAS': departamentosUsuario,
                'TIPOSDOC': tiposDocs,
                'AGRUPA': agrupacionesAsignadas,
                'CIAS': ciasAsignados
            };
            var urlSave = "http://172.16.15.20/API.LovablePHP/Users/CREATE/";
            var responseSave = ajaxRequest(urlSave, data, "POST");
            if (responseSave.code == 200) {
                programasAsignados = [];
                empleId = "";
                proveId = "";
                $("#txtUser").val("");
                $("#txtPass").val("");
                $("#txtName").val("");
                $("#empleadoId").val("Selecciona un empleado");
                $("#companiaId").val("0");
                $("#nivel").val("0");
                $("#proveedorId").val("Selecciona un proveedor");
                $("#permisosEsp1").prop("checked", false);
                $("#permisosEsp2").prop("checked", false);
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
            } else {
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
        var urlDel = "http://172.16.15.20/API.LovablePHP/Users/DELETE/?codusu=" + user;
        var responseDel = ajaxRequest(urlDel);
        if (responseDel.code == 200) {
            $("#modalDelete").modal('hide');
            $("#tbUsers").DataTable().ajax.reload();
        }

    }

    function edit(codusu) {
        var urlFind = "http://172.16.15.20/API.LovablePHP/Users/FIND/?codusu=" + codusu;
        var responseFind = ajaxRequest(urlFind);
        $("#permisosEsp1Edit").prop("checked", false);
        $("#permisosEsp2Edit").prop("checked", false);
        if (responseFind.code == 200) {
            $("#txtUserEdit").text(responseFind.data[0]['CODUSU']);
            $("#txtPassEdit").val(responseFind.data[0]['CONTRA']);
            $("#txtNameEdit").val(responseFind.data[0]['NOMUSU']);
            if ((parseInt(responseFind.data[0]['ANOING']) != 0 && parseInt(responseFind.data[0]['NUMEMP']) != 0) &&
                (responseFind.data[0]['ANOING'] != undefined && responseFind.data[0]['NUMEMP'] != undefined)) {
                var anoing = responseFind.data[0]['ANOING'];
                var numemp = responseFind.data[0]['NUMEMP'];
                var urlFindEmp = "http://172.16.15.20/API.LovablePHP/ZLO0015P/ListEmpleadosFind/?tipo=" + anoing +
                    "&proveedor=" + numemp.padStart(2, '0') + ""
                var responseFindEmp = ajaxRequest(urlFindEmp);
                if (responseFindEmp.code == 200) {
                    $("#empleadoIdEdit").val(anoing + "-" + numemp + "   " + responseFindEmp.data[0]['MAENO1']);
                    $("#empleadoId2").val(anoing + "-" + numemp + "");
                } else {
                    $("#empleadoIdEdit").val("Selecciona un empleado");
                }
            } else {
                $("#empleadoIdEdit").val("Selecciona un empleado");
            }
            if (responseFind.data[0]['CODCIA'] != undefined && parseInt(responseFind.data[0]['CODCIA']) != 0) {
                $("#companiaIdEdit").val(responseFind.data[0]['CODCIA'].padStart(2, '0'));
            } else {
                $("#companiaIdEdit").val(0);
            }
            $("#nivelEdit").val(responseFind.data[0]['NIVEL']);
            if ((responseFind.data[0]['PROVE1'] != undefined && responseFind.data[0]['PROVE2'] != undefined) &&
                (parseInt(responseFind.data[0]['PROVE1']) != 0 && parseInt(responseFind.data[0]['PROVE2']) != 0)) {
                //AGREGAR UNA CONSULTA DE NOMBRE DE PROVEEDORES Y PANTALLA PARA ASIGNAR USUARIOS APENAS CREADO UN PROGRAMA NUEVO
                var prov1 = responseFind.data[0]['PROVE1'];
                var prov2 = responseFind.data[0]['PROVE2'];
                var urlFindProv = "http://172.16.15.20/API.LovablePHP/ZLO0015P/ProveedoresFind/?tipo=" + prov1 +
                    "&proveedor=" + prov2 + "";
                var responseFindProv = ajaxRequest(urlFindProv);
                if (responseFindProv.code == 200) {
                    $("#proveedorIdEdit").val(prov1 + "-" + prov2 + "   " + responseFindProv.data[0]['ARCNOM']);
                } else {
                    $("#proveedorIdEdit").val("Selecciona un proveedor");
                }

            } else {
                $("#proveedorIdEdit").val("Selecciona un proveedor");
            }
            var permisos = responseFind.data[0]['PERESP'];
            if (permisos.includes("E")) {
                $("#permisosEsp1Edit").prop("checked", true);
            }
            if (permisos.includes("A")) {
                $("#permisosEsp2Edit").prop("checked", true);
            }
            programasAsignadosEdit = responseFind.data[0]['PROGRAMAS'];
            departamentosUsuarioEdit = responseFind.data[0]['AREAS'];
            agrupacionesAsignadasEdit = responseFind.data[0]['AGRUPA'];
            $("#tbDetallesDepaEdit").empty();
            $("#tbDetallesDepaEdit").append(
                `<tr><td class="p-0 p-2 m-0" colspan="2"><span id="depaFixedEdit"></span></td></tr>`);
            if (departamentosUsuarioEdit.length > 0) {
                var splitDepa = departamentosUsuarioEdit[0].split("-");
                var depa = splitDepa[0];
                var cod = splitDepa[1];
                var desc = $("#cbbDepartamentosEdit option[value='" + depa + "-" + cod + "']").text();
                $("#depaFixedEdit").text(desc);
                if (departamentosUsuarioEdit.length > 1) {
                    $("#divDepartamentosEdit").removeClass("d-none");
                    for (let i = 1; i < departamentosUsuarioEdit.length; i++) {
                        var splitDepa = departamentosUsuarioEdit[i].split("-");
                        var depa = splitDepa[0];
                        var cod = splitDepa[1];
                        var desc = $("#cbbDepartamentosEdit option[value='" + depa + "-" + cod + "']").text();
                        var row = `<tr>
                                <td class="p-0 p-2 m-0">` + desc + `</td>
                                <td class="text-center p-0 p-2 m-0">
                                    <input type="text" class="d-none" value="` + depa + '-' + cod + `" />
                                    <button type="button" class="btn btn-danger" onclick="delRowEdit(this)"><i class="fas fa-trash-alt text-white"></i></button>
                                </td>
                            </tr>`;
                        $("#tableDepartamentosEdit").append(row);
                    }
                }
            }
            tiposDocsEdit = responseFind.data[0]['TIPOSDOC'];
            $("#tbTiposDetallesEdit").empty();
            $("#divTiposDocEdit").addClass("d-none");
            if (tiposDocsEdit.length > 0) {
                $("#divTiposDocEdit").removeClass("d-none");
                for (let i = 0; i < tiposDocsEdit.length; i++) {
                    var valTipoDoc = tiposDocsEdit[i];
                    var desc = $("#tiposDocEdit option[value='" + valTipoDoc + "']").text();
                    var row = `<tr>
                                <td class="p-0 p-2 m-0">` + desc + `</td>
                                <td class="text-center p-0 p-2 m-0">
                                    <input type="text" class="d-none" value="` + valTipoDoc + `" />
                                    <button type="button" class="btn btn-danger" onclick="delRowTiposEdit(this)"><i class="fas fa-trash-alt text-white"></i></button>
                                </td>
                            </tr>`;
                    $("#tableTiposDocEdit").append(row);
                }
            }
            ciasAsignadosEdit = responseFind.data[0]['CIAS'];
            $("#tbCiasDetallesEdit").empty();
            $("#divCiasEdit").addClass("d-none");
            if (ciasAsignadosEdit.length > 0) {
                $("#divCiasEdit").removeClass("d-none");
                for (let i = 0; i < ciasAsignadosEdit.length; i++) {
                    var valCia = ciasAsignadosEdit[i];
                    var desc = $("#ciasSelectEdit option[value='" + valCia + "']").text();
                    var row = `<tr>
                                <td class="p-0 p-2 m-0">` + desc + `</td>
                                <td class="text-center p-0 p-2 m-0">
                                    <input type="text" class="d-none" value="` + valCia + `" />
                                    <button type="button" class="btn btn-danger" onclick="delRowCiasEdit(this)"><i class="fas fa-trash-alt text-white"></i></button>
                                </td>
                            </tr>`;
                    $("#tableCiasEdit").append(row);
                }
            }
            $("#txtOpcionEdit").change(function() {
                var modulo = $("#txtModuloEdit").val();
                var opcion = $("#txtOpcionEdit").val();
                var urlModulos = "http://172.16.15.20/API.LovablePHP/Opc/ListPrg/?modulo=" + modulo +
                    "&opcion=" + opcion + "";
                var response = ajaxRequest(urlModulos);
                var row = "";
                $("#divProgramasEdit").empty();
                if (response.code == 200) {
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
                            row += `<tr>
                                        <td>` + response.data[i]['DESCRP'] + `</td>
                                        <td class="text-center">` + response.data[i]['CODIGO'] + `</td>
                                        <td class="text-center">
                                        <input type="text" class="codInputEdit d-none" value="` + response.data[i][
                                    'CODIGO'
                                ] +
                                `" />
                                        <input type="checkbox" class="form-check-input checkId" checked onclick="asignarPrgEdit(this)" id="` +
                                response.data[i]['CODIGO'] + `">
                                        </td>
                                    </tr>`;
                        } else {
                            row += `<tr>
                                        <td>` + response.data[i]['DESCRP'] + `</td>
                                        <td class="text-center">` + response.data[i]['CODIGO'] + `</td>
                                        <td class="text-center">
                                        <input type="text" class="codInputEdit d-none" value="` + response.data[i][
                                    'CODIGO'
                                ] +
                                `" />
                                        <input type="checkbox" class="form-check-input checkId" onclick="asignarPrgEdit(this)" id="` +
                                response.data[i]['CODIGO'] + `">
                                        </td>
                                    </tr>`;
                        }

                    }
                    $("#tbDetallesEdit").append(row);
                }
            });
            $("#txtModuloEdit").val(0).trigger('change');
            $("#divProgramasEdit").empty();
             //
        const menuUsuario = $("#menuUsuarioEdit");
        if (menuUsuario.css("display") == "none") {
            menuUsuario.animate({
                height: 'toggle'
            });
            let icon = $("#iconArrow6");
            icon.removeClass("fa-angles-down");
            icon.addClass("fa-angles-up");
        }
        //
        const menuDigitalizacion = $("#menuDigitalizacionEdit");
        if (menuDigitalizacion.css("display") != "none") {
            menuDigitalizacion.animate({
                height: 'toggle'
            });
            let icon = $("#iconArrow7");
            icon.removeClass("fa-angles-up");
            icon.addClass("fa-angles-down");
        }
        //
        const menuAgrupaciones = $("#menuAgrupacionesEdit");
        if (menuAgrupaciones.css("display") != "none") {
            menuAgrupaciones.animate({
                height: 'toggle'
            });
            let icon = $("#iconArrow8");
            icon.removeClass("fa-angles-up");
            icon.addClass("fa-angles-down");
        }
        //
        const menuAccesos = $("#menuAccesosEdit");
        if (menuAccesos.css("display") != "none") {
            menuAccesos.animate({
                height: 'toggle'
            });
            let icon = $("#iconArrow9");
            icon.removeClass("fa-angles-up");
            icon.addClass("fa-angles-down");
        }
        //
        $("#AllckEdit").prop("checked", false);
        $(".checkAgrupEdit").prop("checked", false);
            setTimeout(() => {
                $("#modalEdit").modal('show');
                if (agrupacionesAsignadasEdit.length>0) {
                for (let k = 0; k < agrupacionesAsignadasEdit.length; k++) {
                        $(".checkAgrupEdit[value='" + agrupacionesAsignadasEdit[k] + "']").prop("checked", true);
                    }
                }
            }, 300);
        }
    }

    function asignarPrgEdit(check) {
        var codigo = $(check).closest("td").find(".codInputEdit").val();
        if (check.checked) {
            if (!programasAsignadosEdit.includes(codigo)) {
                programasAsignadosEdit.push(codigo);
            }
        } else {
            if (programasAsignadosEdit.includes(codigo)) {
                programasAsignadosEdit.splice(programasAsignadosEdit.indexOf(codigo), 1);
            }
        }
    }

    function saveUserEdit() {
        var codusu = $("#txtUserEdit").text();
        var contra = $("#txtPassEdit").val();
        var nomusu = $("#txtNameEdit").val();
        var empleIdEdit = $("#empleadoId2").val();
        if (codusu == "" || contra == "" || nomusu == "") {
            $("#lblErrorEdit").text("**Debe llenar todos los campos**");
            return;
        } else {
            $("#lblErrorEdit").text(" ");
            var anoing = empleIdEdit.split("-")[0];
            var numemp = empleIdEdit.split("-")[1];
            var cia = $("#companiaIdEdit").val();
            var nivel = $("#nivelEdit").val();
            var prov1 = proveIdEdit.split("-")[0];
            var prov2 = proveIdEdit.split("-")[1];
            var peresp = [];
            if ($("#permisosEsp1Edit").is(":checked") || $("#permisosEsp2Edit").is(":checked")) {
                if ($("#permisosEsp1Edit").is(":checked")) {
                    peresp.push("S-E");
                }
                if ($("#permisosEsp2Edit").is(":checked")) {
                    peresp.push("S-A");
                }
            } else {
                peresp[0] = 'N';
            }
            var usugra = '<?php echo $_SESSION["CODUSU"];?>';
            var fecgra = ('<?php echo date("Y-m-d");?>').replace(/-/g, "");
            var data = {
                'CODUSU': codusu,
                'CONTRA': contra,
                'NOMUSU': nomusu,
                'ANOING': (anoing == "") ? "0" : anoing,
                'NUMEMP': (numemp == undefined) ? "0" : numemp.substring(0, 4),
                'CIA': cia,
                'NIVEL': nivel,
                'PROV1': (prov1 == "") ? "0" : prov1,
                'PROV2': (prov2 == undefined) ? "0" : prov2,
                'PERESP': peresp,
                'PROGRAMAS': programasAsignadosEdit,
                'USUGRA': usugra,
                'FECGRA': fecgra,
                'AREAS': departamentosUsuarioEdit,
                'TIPOSDOC': tiposDocsEdit,
                'AGRUPA': agrupacionesAsignadasEdit,
                'CIAS': ciasAsignadosEdit
            };
            var urlSave = "http://172.16.15.20/API.LovablePHP/Users/EDIT/";
            var responseSave = ajaxRequest(urlSave, data, "POST");
            if (responseSave.code == 200) {
                programasAsignadosEdit = [];
                empleIdEdit = "";
                proveIdEdit = "";
                $("#lblErrorEdit").text(" ");
                $("#modalEdit").modal('hide');
                $("#tbUsers").DataTable().ajax.reload();
                Swal.fire({
                    title: "Usuario actualizado exitosamente",
                    icon: "success"
                });
            } else {
                $("#lblErrorEdit").text("Ha ocurrido un error...");
            }
        }
    }

    function cleanProveedoresEdit() {
        $("#proveedorIdEdit").val('Selecciona un proveedor');
        proveIdEdit = "";
    }

    function cleanEmpleadosEdit() {
        $("#empleadoIdEdit").val('Selecciona un empleado');
        $("#depaFixedEdit").text('');
        $("#divDepartamentosEdit").addClass("d-none");
        empleIdEdit = "";
        departamentosUsuarioEdit = [0];
    }
    //PROVEEDORES EDIT
    function showProveedoresEdit() {
        $('#modalEdit').modal('hide');
        $('#tbProveedoresEdit thead input').val('').keyup();
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
        $('#tbEmpleadosEdit thead input').val('').keyup();
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

        var dep = tds.eq(3).text();
        var splitDepa = dep.split("-");
        var depa = splitDepa[0];
        var cod = splitDepa[1];
        var descDepa = $("#cbbDepartamentosEdit option[value='" + depa + "-" + cod + "']").text();
        departamentosUsuarioEdit[0] = depa + "-" + cod;
        $("#depaFixedEdit").text(descDepa);
        $("#divDepartamentosEdit").removeClass("d-none");

        $("#empleadoIdEdit").val(empleIdEdit + "   " + desc);
        $("#empleadoId2").val(empleIdEdit);
        $("#modalEmpleadosEdit").modal('hide');
        $("#modalEdit").modal('show');
    }

    function closeEmpleadosEdit() {
        $('#modalEmpleadosEdit').modal('hide');
        $("#modalEdit").modal('show');
    }

    function animateMenu1() {
        let icon = $("#iconArrow1");
        if (icon.hasClass("fa-angles-up")) {
            icon.removeClass("fa-angles-up");
            icon.addClass("fa-angles-down");
        } else {
            icon.removeClass("fa-angles-down");
            icon.addClass("fa-angles-up");
        }
        $("#menuUsuario").animate({
            height: 'toggle'
        });
    }

    function animateMenu3() {
        let icon = $("#iconArrow3");
        if (icon.hasClass("fa-angles-up")) {
            icon.removeClass("fa-angles-up");
            icon.addClass("fa-angles-down");
        } else {
            icon.removeClass("fa-angles-down");
            icon.addClass("fa-angles-up");
        }
        $("#menuDigitalizacion").animate({
            height: 'toggle'
        });
    }

    function animateMenu4() {
        let icon = $("#iconArrow4");
        if (icon.hasClass("fa-angles-up")) {
            icon.removeClass("fa-angles-up");
            icon.addClass("fa-angles-down");
        } else {
            icon.removeClass("fa-angles-down");
            icon.addClass("fa-angles-up");
        }
        $("#menuAgrupaciones").animate({
            height: 'toggle'
        });
    }

    function animateMenu5() {
        let icon = $("#iconArrow5");
        if (icon.hasClass("fa-angles-up")) {
            icon.removeClass("fa-angles-up");
            icon.addClass("fa-angles-down");
        } else {
            icon.removeClass("fa-angles-down");
            icon.addClass("fa-angles-up");
        }
        $("#menuAccesos").animate({
            height: 'toggle'
        });
    }
    function animateMenu6() {
        let icon = $("#iconArrow6");
        if (icon.hasClass("fa-angles-up")) {
            icon.removeClass("fa-angles-up");
            icon.addClass("fa-angles-down");
        } else {
            icon.removeClass("fa-angles-down");
            icon.addClass("fa-angles-up");
        }
        $("#menuUsuarioEdit").animate({
            height: 'toggle'
        });
    }
    function animateMenu7() {
        let icon = $("#iconArrow7");
        if (icon.hasClass("fa-angles-up")) {
            icon.removeClass("fa-angles-up");
            icon.addClass("fa-angles-down");
        } else {
            icon.removeClass("fa-angles-down");
            icon.addClass("fa-angles-up");
        }
        $("#menuDigitalizacionEdit").animate({
            height: 'toggle'
        });
    }
    function animateMenu8() {
        let icon = $("#iconArrow8");
        if (icon.hasClass("fa-angles-up")) {
            icon.removeClass("fa-angles-up");
            icon.addClass("fa-angles-down");
        } else {
            icon.removeClass("fa-angles-down");
            icon.addClass("fa-angles-up");
        }
        $("#menuAgrupacionesEdit").animate({
            height: 'toggle'
        });
    }
    function animateMenu9() {
        let icon = $("#iconArrow9");
        if (icon.hasClass("fa-angles-up")) {
            icon.removeClass("fa-angles-up");
            icon.addClass("fa-angles-down");
        } else {
            icon.removeClass("fa-angles-down");
            icon.addClass("fa-angles-up");
        }
        $("#menuAccesosEdit").animate({
            height: 'toggle'
        });
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
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-2">
                                <label class="form-label text-danger fs-6" id="lblError"></label>
                            </div>
                            <div class="col-12 text-center mt-2 mb-2">
                                <div class="form-control bg-dark text-white mt-2">
                                    <div class="row">
                                        <div class="col-9 text-center">
                                            <label class="form-control bg-dark text-white mt-2  border border-0 p-0">
                                                Información del usuario
                                            </label>
                                        </div>
                                        <div class="col-3 text-end">
                                            <button type="button" class="btn btn-secondary"
                                                style="width:70px; margin-right:15px;" onclick="animateMenu1()"> <i
                                                    id="iconArrow1"
                                                    class="fa-solid fa-angles-up text-white"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div id='menuUsuario'>
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <label for="txtUser" class="form-label">Usuario del sistema<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                oninput="this.value = this.value.toUpperCase()" id="txtUser"
                                                placeholder="Ingrese un usuario">
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="txtUser" class="form-label">Contraseña<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="txtPass"
                                                placeholder="Ingrese un contraseña">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label mt-3">Nombre de usuario<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="txtName"
                                                placeholder="Ingrese un nombre de usuario">
                                        </div>
                                        <div class="col-12">
                                            <label for="txtPass" class="form-label mt-3">Empleado</label>
                                            <div class="row">
                                                <div class="col-10">
                                                    <span class="" onclick="showEmpleados()">
                                                        <input type="text" class="text-muted form-select"
                                                            id="empleadoId" placeholder="Selecciona un empleado"
                                                            readonly />
                                                    </span>
                                                </div>
                                                <div class="col-2 m-0 p-0">
                                                    <button class="btn btn-secondary text-white"
                                                        onclick="cleanEmpleados()" style="width:90%;"><i
                                                            class="fa-solid fa-x"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label mt-3">Departamento y Sección</label>
                                            <div class="row">
                                                <div class="col-10">
                                                    <select id="cbbDepartamentos" class="form-select mt-1">
                                                    </select>
                                                    <label class="form-label text-danger mt-2 mb-2"
                                                        id="lblCbbError"></label>
                                                </div>
                                                <div class="col-2 mt-1">
                                                    <button type="button" class="btn btn-success" style="width:100%"
                                                        onclick="addRow()">
                                                        <i class="fa-solid fa-square-plus text-white"></i> </button>
                                                </div>
                                                <div class="col-12 d-none" id="divDepartamentos">
                                                    <div class="table-responsive mt-3">
                                                        <table class="table table-bordered stripe table-hover"
                                                            id="tableDepartamentos" style="width:100%">
                                                            <thead>
                                                                <tr class="bg-dark">
                                                                    <th class="text-left text-white" style="width:80%;">
                                                                        Departamento
                                                                    </th>
                                                                    <th class="text-center text-white"
                                                                        style="width:20%;"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbDetallesDepa">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <label class="form-label mt-2">Compañia</label>
                                            <select id="companiaId" class="form-select">

                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label mt-2">Nivel de usuario</label>
                                            <input type="text" value="0" id="nivel"
                                                oninput="this.value =(parseInt(this.value)>3)?'3':this.value"
                                                maxlength="1" class="form-control" data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                data-bs-title="0=(SIN ACCESO A LAS GRAFICAS)<br>1=(ACCESO TODAS LAS GRAFICAS)<br>2=(GRAFICAS DE VENTAS DE TIENDAS)<br>3=(GRAFICAS DE INVENTARIOS TIENDAS)">
                                        </div>
                                        <div class="col-12">
                                            <label for="txtPass" class="form-label mt-3">Proveedor</label>
                                            <div class="row">
                                                <div class="col-10">
                                                    <span class="" onclick="showProveedores()">
                                                        <input type="text" class="text-muted form-select"
                                                            id="proveedorId" placeholder="Selecciona un proveedor"
                                                            readonly />
                                                    </span>
                                                </div>
                                                <div class="col-2 m-0 p-0">
                                                    <button class="btn btn-secondary text-white"
                                                        onclick="cleanProveedores()" style="width:90%;"><i
                                                            class="fa-solid fa-x"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center mt-2 mb-2">
                                <div class="form-control bg-dark text-white mt-2">
                                    <div class="row">
                                        <div class="col-9 text-center">
                                            <label class="form-control bg-dark text-white mt-2  border border-0 p-0">
                                                Digitalización de documentos
                                            </label>
                                        </div>
                                        <div class="col-3 text-end">
                                            <button type="button" class="btn btn-secondary"
                                                style="width:70px; margin-right:15px;" onclick="animateMenu3()"> <i
                                                    id="iconArrow3"
                                                    class="fa-solid fa-angles-down text-white"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div id='menuDigitalizacion'>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-control border border-danger d-flex mt-4">
                                                <label class="form-check-label mt-2 me-3">Permiso para <span
                                                        class="text-danger fw-bold">eliminar</span> documentos
                                                    digitales: </label>
                                                <div class="form-check form-switch fs-5 mt-1">
                                                    <input class="form-check-input mt-3 text-danger" id="permisosEsp1"
                                                        type="checkbox" role="switch">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-control border border-success d-flex mt-4">
                                                <label class="form-check-label mt-2 me-3">Permiso para <span
                                                        class="text-success fw-bold">autorizar</span> documentos
                                                    digitales: </label>
                                                <div class="form-check form-switch fs-5 mt-1">
                                                    <input class="form-check-input mt-3 text-success" id="permisosEsp2"
                                                        type="checkbox" role="switch">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-1">
                                            <label class="form-check-label mt-3 me-3">Tipos de documentos a
                                                visualizar</label>
                                            <div class="row">
                                                <div class="col-10">
                                                    <select id="tiposDoc" class="form-select mt-2">
                                                    </select>
                                                    <label class="form-label text-danger mt-2 mb-2"
                                                        id="lbltiposError"></label>
                                                </div>
                                                <div class="col-2 mt-1">
                                                    <button type="button" class="btn btn-success" style="width:100%"
                                                        onclick="addRowTipos()">
                                                        <i class="fa-solid fa-square-plus text-white"></i> </button>
                                                </div>
                                                <div class="col-12 d-none" id="divTiposDoc">
                                                    <div class="table-responsive mt-3">
                                                        <table class="table table-bordered stripe table-hover"
                                                            id="tableTiposDoc" style="width:100%">
                                                            <thead>
                                                                <tr class="bg-dark">
                                                                    <th class="text-left text-white" style="width:80%;">
                                                                        Tipo de documento</th>
                                                                    <th class="text-center text-white"
                                                                        style="width:20%;"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbTiposDetalles">

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-1">
                                            <label class="form-check-label mt-3 me-3">Compañías a visualizar</label>
                                            <div class="row">
                                                <div class="col-10">
                                                    <select id="ciasSelect" class="form-select mt-2">
                                                    </select>
                                                    <label class="form-label text-danger mt-2 mb-2"
                                                        id="lblCiasError"></label>
                                                </div>
                                                <div class="col-2 mt-1">
                                                    <button type="button" class="btn btn-success" style="width:100%"
                                                        onclick="addRowCias()">
                                                        <i class="fa-solid fa-square-plus text-white"></i> </button>
                                                </div>
                                                <div class="col-12 d-none" id="divCias">
                                                    <div class="table-responsive mt-3">
                                                        <table class="table table-bordered stripe table-hover"
                                                            id="tableCias" style="width:100%">
                                                            <thead>
                                                                <tr class="bg-dark">
                                                                    <th class="text-left text-white" style="width:80%;">
                                                                        Compañía</th>
                                                                    <th class="text-center text-white"
                                                                        style="width:20%;"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbCiasDetalles">

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center mt-2 mb-2">
                                <div class="form-control bg-dark text-white mt-2">
                                    <div class="row">
                                        <div class="col-9 text-center">
                                            <label class="form-control bg-dark text-white mt-2  border border-0 p-0">
                                                Acceso a agrupaciones de companías
                                            </label>
                                        </div>
                                        <div class="col-3 text-end">
                                            <button type="button" class="btn btn-secondary"
                                                style="width:70px; margin-right:15px;" onclick="animateMenu4()"> <i
                                                    id="iconArrow4"
                                                    class="fa-solid fa-angles-down text-white"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div id='menuAgrupaciones' class="overflow-auto" style="height:300px;">
                                    <table class="table stripe table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-start ms-1 p-3" style="width:80%;">Selecciona las
                                                    agrupaciones a visualizar: </th>
                                                <th class="text-start" style="width:20%;">
                                                    <span class="mt-1">Todos</span> <input type="checkbox"
                                                        class="form-check-input ms-1 mb-2" id="Allck">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbAgrupacion">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12 text-center mt-2 mb-2">
                                <div class="form-control bg-dark text-white mt-2">
                                    <div class="row">
                                        <div class="col-9 text-center">
                                            <label class="form-control bg-dark text-white mt-2  border border-0 p-0">
                                                Accesos del sistema
                                            </label>
                                        </div>
                                        <div class="col-3 text-end">
                                            <button type="button" class="btn btn-secondary"
                                                style="width:70px; margin-right:15px;" onclick="animateMenu5()"> <i
                                                    id="iconArrow5"
                                                    class="fa-solid fa-angles-down text-white"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div id='menuAccesos' class="overflow-auto" style="height:300px;">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <label class="form-label mt-3">Módulo</label>
                                            <select class="form-select" id="txtModulo">

                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label class="form-label mt-3">Opción</label>
                                            <select class="form-select" id="txtOpcion">

                                            </select>
                                        </div>
                                        <div class="col-12" id="divProgramas">

                                        </div>
                                    </div>
                                </div>
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
                    <h5 class="modal-title" id="staticBackdropLabel">Editar un usuario</h5>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label text-danger fs-6" id="lblErrorEdit"></label>
                            </div>
                            <div class="col-12 text-center mt-2 mb-2">
                                <div class="form-control bg-dark text-white mt-2">
                                    <div class="row">
                                        <div class="col-9 text-center">
                                            <label class="form-control bg-dark text-white mt-2  border border-0 p-0">
                                                Información del usuario
                                            </label>
                                        </div>
                                        <div class="col-3 text-end">
                                            <button type="button" class="btn btn-secondary"
                                                style="width:70px; margin-right:15px;" onclick="animateMenu6()"> <i
                                                    id="iconArrow6"
                                                    class="fa-solid fa-angles-up text-white"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div id='menuUsuarioEdit'>
                                    <div class="row">
                                    <div class="col-12 col-lg-6">
                                <label class="form-label">Usuario del sistema<span class="text-danger">*</span></label>
                                <label class="form-control" id="txtUserEdit"></label>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label class="form-label">Contraseña<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="txtPassEdit"
                                    placeholder="Ingrese un contraseña">
                            </div>
                            <div class="col-12">
                                <label class="form-label mt-3">Nombre de usuario<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="txtNameEdit"
                                    placeholder="Ingrese un nombre de usuario">
                            </div>
                            <div class="col-12">
                                <label class="form-label mt-3">Empleado</label>
                                <div class="row">
                                    <div class="col-11">
                                        <span class="" onclick="showEmpleadosEdit()">
                                            <input type="text" class="text-muted form-select" id="empleadoIdEdit"
                                                placeholder="Selecciona un empleado" readonly />
                                            <input type="text" class="d-none" id="empleadoId2">
                                        </span>
                                    </div>
                                    <div class="col-1 m-0 p-0">
                                        <button class="btn btn-secondary text-white" onclick="cleanEmpleadosEdit()"
                                            style="width:100%;"><i class="fa-solid fa-x"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label mt-3">Departamento y Sección</label>
                                <div class="row">
                                    <div class="col-10">
                                        <select id="cbbDepartamentosEdit" class="form-select mt-1">
                                        </select>
                                        <label class="form-label text-danger mt-2 mb-2" id="lblCbbErrorEdit"></label>
                                    </div>
                                    <div class="col-2 mt-1">
                                        <button type="button" class="btn btn-success" style="width:100%"
                                            onclick="addRowEdit()">
                                            <i class="fa-solid fa-square-plus text-white"></i> </button>
                                    </div>
                                    <div class="col-12 d-none" id="divDepartamentosEdit">
                                        <div class="table-responsive mt-3">
                                            <table class="table table-bordered stripe table-hover"
                                                id="tableDepartamentosEdit" style="width:100%">
                                                <thead>
                                                    <tr class="bg-dark">
                                                        <th class="text-left text-white" style="width:80%;">Departamento
                                                        </th>
                                                        <th class="text-center text-white" style="width:20%;"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbDetallesDepaEdit">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-9">
                                <label class="form-label mt-3">Compañia</label>
                                <select id="companiaIdEdit" class="form-select">

                                </select>
                            </div>
                            <div class="col-3">
                                <label class="form-label mt-3">Nivel de usuario</label>
                                <input type="text" value="0" id="nivelEdit"
                                    oninput="this.value =(parseInt(this.value)>3)?'3':this.value" maxlength="1"
                                    class="form-control" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="0=(SIN ACCESO A LAS GRAFICAS)<br>1=(ACCESO TODAS LAS GRAFICAS)<br>2=(GRAFICAS DE VENTAS DE TIENDAS)<br>3=(GRAFICAS DE INVENTARIOS TIENDAS)">
                            </div>
                            <div class="col-12">
                                <label class="form-label mt-3">Proveedor</label>
                                <div class="row">
                                    <div class="col-11">
                                        <span class="" onclick="showProveedoresEdit()">
                                            <input type="text" class="text-muted form-select" id="proveedorIdEdit"
                                                placeholder="Selecciona un proveedor" readonly />
                                        </span>
                                    </div>
                                    <div class="col-1 m-0 p-0">
                                        <button class="btn btn-secondary text-white" onclick="cleanProveedoresEdit()"
                                            style="width:100%;"><i class="fa-solid fa-x"></i></button>
                                    </div>
                                </div>

                            </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-12 text-center mt-2 mb-2">
                                <div class="form-control bg-dark text-white mt-2">
                                    <div class="row">
                                        <div class="col-9 text-center">
                                            <label class="form-control bg-dark text-white mt-2  border border-0 p-0">
                                                Digitalización de documentos
                                            </label>
                                        </div>
                                        <div class="col-3 text-end">
                                            <button type="button" class="btn btn-secondary"
                                                style="width:70px; margin-right:15px;" onclick="animateMenu7()"> <i
                                                    id="iconArrow7"
                                                    class="fa-solid fa-angles-down text-white"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div id='menuDigitalizacionEdit'>
                                    <div class="row">
                                     <div class="col-6">
                                            <div class="form-control border border-danger d-flex mt-4">
                                                <label class="form-check-label mt-2 me-3">Permiso para <span
                                                        class="text-danger fw-bold">eliminar</span> documentos digitales: </label>
                                                <div class="form-check form-switch fs-5 mt-1">
                                                    <input class="form-check-input mt-3 text-danger" id="permisosEsp1Edit"
                                                        type="checkbox" role="switch">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-control border border-success d-flex mt-4">
                                                <label class="form-check-label mt-2 me-3">Permiso para <span
                                                        class="text-success fw-bold">autorizar</span> documentos digitales: </label>
                                                <div class="form-check form-switch fs-5 mt-1">
                                                    <input class="form-check-input mt-3 text-success" id="permisosEsp2Edit"
                                                        type="checkbox" role="switch">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-1">
                                            <label class="form-check-label mt-3 me-3">Tipos de documentos a visualizar</label>
                                            <div class="row">
                                                <div class="col-10">
                                                    <select id="tiposDocEdit" class="form-select mt-2">
                                                    </select>
                                                    <label class="form-label text-danger mt-2 mb-2" id="lbltiposErrorEdit"></label>
                                                </div>
                                                <div class="col-2 mt-1">
                                                    <button type="button" class="btn btn-success" style="width:100%"
                                                        onclick="addRowTiposEdit()">
                                                        <i class="fa-solid fa-square-plus text-white"></i> </button>
                                                </div>
                                                <div class="col-12 d-none" id="divTiposDocEdit">
                                                    <div class="table-responsive mt-3">
                                                        <table class="table table-bordered stripe table-hover"
                                                            id="tableTiposDocEdit" style="width:100%">
                                                            <thead>
                                                                <tr class="bg-dark">
                                                                    <th class="text-left text-white" style="width:80%;">Tipo de
                                                                        documento</th>
                                                                    <th class="text-center text-white" style="width:20%;"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbTiposDetallesEdit">

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-1">
                                            <label class="form-check-label mt-3 me-3">Compañías a visualizar</label>
                                            <div class="row">
                                                <div class="col-10">
                                                    <select id="ciasSelectEdit" class="form-select mt-2">
                                                    </select>
                                                    <label class="form-label text-danger mt-2 mb-2"
                                                        id="lblCiasErrorEdit"></label>
                                                </div>
                                                <div class="col-2 mt-1">
                                                    <button type="button" class="btn btn-success" style="width:100%"
                                                        onclick="addRowCiasEdit()">
                                                        <i class="fa-solid fa-square-plus text-white"></i> </button>
                                                </div>
                                                <div class="col-12 d-none" id="divCiasEdit">
                                                    <div class="table-responsive mt-3">
                                                        <table class="table table-bordered stripe table-hover"
                                                            id="tableCiasEdit" style="width:100%">
                                                            <thead>
                                                                <tr class="bg-dark">
                                                                    <th class="text-left text-white" style="width:80%;">
                                                                        Compañía</th>
                                                                    <th class="text-center text-white"
                                                                        style="width:20%;"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbCiasDetallesEdit">

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center mt-2 mb-2">
                                <div class="form-control bg-dark text-white mt-2">
                                    <div class="row">
                                        <div class="col-9 text-center">
                                            <label class="form-control bg-dark text-white mt-2  border border-0 p-0">
                                                 Acceso a agrupaciones de companías
                                            </label>
                                        </div>
                                        <div class="col-3 text-end">
                                            <button type="button" class="btn btn-secondary"
                                                style="width:70px; margin-right:15px;" onclick="animateMenu8()"> <i
                                                    id="iconArrow8"
                                                    class="fa-solid fa-angles-down text-white"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div id='menuAgrupacionesEdit' class="overflow-auto" style="height:300px;">
                                    <table class="table stripe table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-start ms-1 p-3" style="width:80%;">Selecciona las
                                                    agrupaciones a visualizar: </th>
                                                <th class="text-start" style="width:20%;">
                                                    <span class="mt-1">Todos</span> <input type="checkbox"
                                                        class="form-check-input ms-1 mb-2" id="AllckEdit">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbAgrupacionEdit">

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-12 text-center mt-2 mb-2">
                                <div class="form-control bg-dark text-white mt-2">
                                    <div class="row">
                                        <div class="col-9 text-center">
                                            <label class="form-control bg-dark text-white mt-2  border border-0 p-0">
                                                Accesos del sistema
                                            </label>
                                        </div>
                                        <div class="col-3 text-end">
                                            <button type="button" class="btn btn-secondary"
                                                style="width:70px; margin-right:15px;" onclick="animateMenu9()"> <i
                                                    id="iconArrow9"
                                                    class="fa-solid fa-angles-down text-white"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div id='menuAccesosEdit' class="overflow-auto" style="height:300px;">
                                    <div class="row">
                                    <div class="col-12 col-lg-6">
                                            <label class="form-label mt-3">Módulo</label>
                                            <select class="form-select" id="txtModuloEdit">

                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label class="form-label mt-3">Opción</label>
                                            <select class="form-select" id="txtOpcionEdit">

                                            </select>
                                        </div>
                                        <div class="col-12" id="divProgramasEdit"></div>
                                    </div>
                                </div>
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
                            <i class="fa-solid fa-triangle-exclamation fa-shake text-warning"
                                style="font-size: 100px;"></i>
                            <h1 class="fs-2 mt-2">¿Está seguro de eliminar el usuario?</h1>
                        </div>
                        <div class="col-12 text-center">
                            <h6 class="text-danger fs-4">Esto tambien eliminará los accesos del sistema</h6>
                            <input type="text" id="delUsuario" class="d-none">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary text-white fw-bold"
                        data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger text-white fw-bold" onclick="delUser()">
                        Aceptar</button>
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
                                    <th class="text-black text-start d-none">Departamento</th>
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
    <div class="modal fade" id="modalProveedoresEdit" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
    <div class="modal fade" id="modalEmpleadosEdit" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                                    <th class="text-black text-start d-none">Departamento</th>
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