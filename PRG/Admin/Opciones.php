<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
    <style>
    .total-row {
        background-color: rgba(0, 0, 0, 0.7) !important;
        color: white !important;
        font-weight: bold !important;
        font-size: 16px !important;
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

            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-3">
        <div class="card mb-5">
            <div class="card-header">
                <h1 class="fs-4 mb-1 mt-2 text-center">Administración del menú</h1>
            </div>
            <div class="card-body">

                <div class="demo">
                    <ul class="tablist" role="tablist">
                        <li id="tab1" class="tablist__tab text-center p-3  is-active" aria-controls="panel1"
                            aria-selected="true" role="tab" tabindex="0">Módulos</li>
                        <li id="tab2" class="tablist__tab text-center p-3" aria-controls="panel2" aria-selected="false"
                            role="tab" tabindex="0">Opciones</li>
                        <li id="tab3" class="tablist__tab text-center p-3" aria-controls="panel3" aria-selected="false"
                            role="tab" tabindex="0">Programas</li>
                    </ul>
                    <div id="panel1" class="tablist__panel p-3" aria-labelledby="tab1" aria-hidden="false"
                        role="tabpanel">
                        <button class="btn btn-primary text-white fw-bold fs-6" onclick="createModules()">Agregar un
                            módulo&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-plus"></i></button>
                        <div class="table-responsive mt-3" id="divModules">

                        </div>
                    </div>
                    <div id="panel2" class="tablist__panel is-hidden p-3" aria-labelledby="tab2" aria-hidden="true"
                        role="tabpanel">
                        <button class="btn btn-primary text-white fw-bold fs-6" onclick="createOpciones()">Agregar una
                            opción&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-plus"></i></button>
                        <div class="table-responsive mt-3" id="divOpciones">

                        </div>
                    </div>
                    <div id="panel3" class="tablist__panel is-hidden p-3" aria-labelledby="tab3" aria-hidden="true"
                        role="tabpanel">

                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-primary text-white fw-bold fs-6"
                                    onclick="createProgramas()">Agregar un programa&nbsp;&nbsp;&nbsp;<i
                                        class="fa-solid fa-plus"></i></button>
                            </div>
                            <div class="col-12 col-lg-5 text-center mt-2 mb-2">
                                <label class="mb-2">Módulo</label>
                                <select class="form-select" id="srcModulo">
                                    <option value="0" >TODOS</option>
                                </select>
                            </div>
                            <div class="col-12 col-lg-5 text-center mt-2 mb-2">
                                <label class="mb-2">Opción</label>
                                <select class="form-select" id="srcOpcion">

                                </select>
                            </div>
                            <div class="col-12 col-lg-2 mt-2 mb-2">
                                <button class="btn btn-danger mt-4 text-white fw-bold" onclick="chargeProgramas();" style="width:100%">
                                    <i class="fa-solid fa-magnifying-glass"></i> Buscar
                                </button>
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive mt-3" id="divProgramas">

                        </div>

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
    <script>
         var usuarios=[];
         var tableUsuarios = null;
    $(document).ready(function() {
        chargeModules();
        chargeOpciones();
        chargeProgramas();
      $("#tab3").on("click", function() {
        var urlModulos = "http://172.16.15.20/API.LovablePHP/Opc/ListMod/";
        var response = ajaxRequest(urlModulos);
        var opcMod = "";
        if (response.code == 200) {
            opcMod +='<option value="0" >TODOS</option>';
            for (let index = 0; index < response.data.length; index++) {
                opcMod +=
                `<option value="${response.data[index]['CODIGO']}-${response.data[index]['ABRMOD']}">${response.data[index]['DESCRP']}</option>`;
            }
            $("#srcModulo").empty();
            $("#srcModulo").append(opcMod);
        }
        $("#srcModulo").on("change",function() {
            var modulo = $("#srcModulo").val().split("-")[0];
            var urlModulos = "http://172.16.15.20/API.LovablePHP/Opc/ListOpc/?modulo=" + modulo + "";
            var response = ajaxRequest(urlModulos);
            var opcOpc = ``;
            if (response.code == 200) {

                for (let index = 0; index < response.data.length; index++) {
                    opcOpc +=
                        `<option value="${response.data[index]['CODIGO']}">${response.data[index]['DESCRP']}</option>`;
                }
            }
            $("#srcOpcion").empty();
            $("#srcOpcion").append(opcOpc);
        });
      });

             tableUsuarios = $('#tbUsuarios').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                },
                "pageLength": 10,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "http://172.16.15.20/API.LovablePHP/Users/GETAsync/",
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
                    {
                    data: "CODUSU",
                    },
                    {
                        data: "NOMUSU",
                    },
                ],
                "drawCallback": function() {
                    $('#tbUsuarios tbody tr').on('click', function() {
                        sendUsuarios(this);
                    });
                }
            });
            $('#tbUsuarios thead input').on('keyup', function() {
                var columnIndex = $(this).parent().index();
                var inputValue = $(this).val().trim();
                if (tableUsuarios.column(columnIndex).search() !== inputValue) {
                    tableUsuarios
                        .column(columnIndex)
                        .search(inputValue)
                        .draw();
                }
            });
            $(document).on('keyup', function(e) {
                if ($('#modalUsuarios').hasClass('show')) {
                    if (e.key.length === 1 && e.key.match(/[a-z]/i)) {
                        e.preventDefault();
                        /*var currentVal = $("#inputSearch1").val();
                        currentVal = currentVal + e.key;
                        $("#inputSearch1").val(currentVal);*/
                        $("#inputSearch1").trigger('focus');
                    }
                }
            });

    });
    function chargeModules() {
        $("#divModules").empty();
        $("#divModules").append(`<table class="table stripe table-hover" id="tableModulos"  style="width:100%">
                                        <thead>
                                        <tr class="sticky-top bg-white">
                                                <th class="d-none">Código</th>
                                                <th>Descripción</th>
                                                <th>Abrv.</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>`);

        var table = $('#tableModulos').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                loadingRecords: `<button class="btn btn-danger " type="button" >
                                    <span class="spinner-border text-white" style="width: 1.5rem; height: 1.5rem;"
                                        aria-hidden="true"></span>
                                    <span role="status" class="ms-2 text-white fs-4">Cargando...</span>
                                </button>`
            },
            "pageLength": 50,
            "ordering": false,
            "ajax": {
                "url": "http://172.16.15.20/API.LovablePHP/Opc/Mod/",
                "type": "POST",
                error: function(xhr, status, error) {
                    console.log(error);
                    requestError = true;
                }
            },
            "columns": [{
                    data: "CODIGO",
                    className: "d-none",
                },
                {
                    data: "DESCRP",
                },
                {
                    data: "ABRMOD",
                },
                {
                    data: "ESTADO",
                    render: function(data, type, row) {
                        if (data == 1) {
                            return `<form action="#">
                                        <div class="form-check form-switch fs-4">
                                            <input type="text" class="codInput d-none" value="${row.CODIGO}" />
                                            <input class="form-check-input checkState" type="checkbox" onchange="stateModules(this)" role="switch" checked>
                                        </div>
                                    </form>
                                `;
                        } else {
                            return `<form action="#">
                                        <div class="form-check form-switch fs-4">
                                            <input type="text" class="codInput d-none" value="${row.CODIGO}" />
                                            <input class="form-check-input checkState" type="checkbox" onchange="stateModules(this)" role="switch">
                                        </div>
                                    </form>
                                `;
                        }

                    }
                },
                {
                    data: "NULL",
                    render: function(data, type, row) {
                        return `<button type="button" class="btn btn-warning" onclick="editModule('${row.CODIGO}')"><i class="fas fa-edit text-white"></i></button>
                                    <button type="button" class="btn btn-danger" onclick="delModule('${row.CODIGO}')"><i class="fas fa-trash-alt text-white"></i></button>
                                    `;
                    }
                },
            ],
        });
        //<button type="button" class="btn btn-secondary" onclick=""><i class="fa-solid fa-circle-info text-white"></i></button>
    }
    function stateModules(check) {
        var modulo = $(check).closest("td").find(".codInput").val();
        var estadoactual = 0;
        if ($(check).is(':checked')) {
            estadoactual = 1;
        }
        var urlchange = "http://172.16.15.20/API.LovablePHP/Opc/changeMod/?code=" + modulo + "&estad=" + estadoactual +
            "";
        var response = ajaxRequest(urlchange);
        if (response.code == 200) {
            chargeModules();
            chargeOpciones();
            chargeProgramas();
        }
    }
    function createModules() {
        $("#titleModal").text("Agregar un módulo");
        $("#contentModal").empty();
        $("#contentModal").append(`<div class="row">
                        <div class="col-12 col-lg-6">
                                <label class="form-label mt-3">Descripción</label>
                                <input type="text" class="form-control" id="txtDescrp" maxlength="35" oninput="this.value = this.value.toUpperCase()" placeholder="Ingrese la descripción del módulo">
                        </div>
                        <div class="col-12 col-lg-6">
                                <label class="form-label mt-3">Abreviación</label>
                                <input type="text" class="form-control" id="txtAbrv" maxlength="3" oninput="this.value = this.value.toUpperCase()" placeholder="Ingrese la abreviatura">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="form-label text-danger mt-2" id="lblError"></label>
                        </div>
                    </div>`);
        $("#contentFooter").empty();
        $("#contentFooter").append(`<button type="button" class="btn btn-primary text-white fw-bold" onclick="saveModule()">
                                        <i class="fa-solid fa-floppy-disk"></i> Guardar</button>`);
        $("#modal").modal("show");
    }
    function saveModule() {
        var descrp = $("#txtDescrp").val();
        var abrv = $("#txtAbrv").val();
        if (descrp == "" || abrv == "") {
            $("#lblError").text('Rellene la información solicitada');
        } else {
            $("#lblError").text('');
            var urlsave = "http://172.16.15.20/API.LovablePHP/Opc/createMod/?desc=" + descrp + "&abrv=" + abrv + "";
            var response = ajaxRequest(urlsave);
            if (response.code == 200) {
                $("#lblError").text('');
                chargeModules();
                chargeOpciones();
                $("#modal").modal("hide");
            } else {
                $("#lblError").text('El módulo ya existe');
            }
        }
    }
    function delModule(id) {
        var deleteUrl = "http://172.16.15.20/API.LovablePHP/Opc/deleteMod/?code=" + id + "";
        var response = ajaxRequest(deleteUrl);
        if (response.code == 200) {
            chargeModules();
            chargeOpciones();
            chargeProgramas();
        }
    }
    function editModule(id) {
        var urlFind = "http://172.16.15.20/API.LovablePHP/Opc/findMod/?code=" + id + "";
        var response = ajaxRequest(urlFind);
        if (response.code == 200) {
            $("#titleModal").text("Editar un módulo");
            $("#contentModal").empty();
            $("#contentModal").append(`<div class="row">
                            <div class="col-12 col-lg-6 d-none">
                                    <label class="form-label">Código</label>
                                    <input type="text" class="form-control" id="txtModuloEdit" value="` + response
                .data[0]['CODIGO'] + `" maxlength="5" oninput="this.value = this.value.toUpperCase()" placeholder="Ingrese el identificador del módulo">
                            </div>
                            <div class="col-12">
                                    <label class="form-label">Descripción</label>
                                    <input type="text" class="form-control" id="txtDescrpEdit" value="` + response
                .data[0]['DESCRP'] + `" maxlength="35" oninput="this.value = this.value.toUpperCase()" placeholder="Ingrese la descripción del módulo">
                            </div>
                            <div class="col-12 col-lg-6">
                                <label class="form-label text-danger mt-2" id="lblErrorEdit"></label>
                            </div>
                        </div>`);
            $("#contentFooter").empty();
            $("#contentFooter").append(`<button type="button" class="btn btn-warning text-white fw-bold" onclick="saveEditModule()">
                <i class="fas fa-edit text-white"></i> Actualizar</button>`);
            $("#modal").modal("show");
        }
    }
    function saveEditModule() {
        var modulo = $("#txtModuloEdit").val();
        var descrp = $("#txtDescrpEdit").val();
        if (descrp == "") {
            $("#lblErrorEdit").text('Rellene la información solicitada');
        } else {
            $("#lblErrorEdit").text('');
            var urlsave = "http://172.16.15.20/API.LovablePHP/Opc/EditMod/?code=" + modulo + "&desc=" + descrp + "";
            var response = ajaxRequest(urlsave);
            if (response.code == 200) {
                $("#lblErrorEdit").text('');
                chargeModules();
                chargeOpciones();
                chargeProgramas();
                $("#modal").modal("hide");
            } else {
                $("#lblErrorEdit").text('El módulo ya existe');
            }
        }
    }
    //OPCIONES
    function chargeOpciones() {
        $("#divOpciones").empty();
        $("#divOpciones").append(`<table class="table stripe table-hover" id="tableOpciones"  style="width:100%">
                                        <thead>
                                        <tr class=" bg-white">
                                                <th class="d-none">Código</th>
                                                <th class="d-none">Módulo</th>
                                                <th>Descripción</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>`);

        var table = $('#tableOpciones').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                loadingRecords: `<button class="btn btn-danger " type="button" >
                                    <span class="spinner-border text-white" style="width: 1.5rem; height: 1.5rem;"
                                        aria-hidden="true"></span>
                                    <span role="status" class="ms-2 text-white fs-4">Cargando...</span>
                                </button>`
            },
            "pageLength": 50,
            "ordering": false,
            order: [
                [1, 'asc']
            ],
            "ajax": {
                "url": "http://172.16.15.20/API.LovablePHP/Opc/Opc/",
                "type": "POST",
                error: function(xhr, status, error) {
                    console.log(error);
                    requestError = true;
                }
            },
            "columns": [{
                    data: "CODIGO",
                    className: "d-none",
                },
                {
                    data: "MODULO",
                    className: "d-none",
                },
                {
                    data: "DESCRP",
                },
                {
                    data: "ESTADO",
                    render: function(data, type, row) {
                        if (row.CODIGO == 0) {
                            return '';
                        } else {
                            if (data == 1) {
                                return `<form action="#">
                                        <div class="form-check form-switch fs-4">
                                            <input type="text" class="opcInput d-none" value="${row.CODIGO}" />
                                            <input class="form-check-input checkState" type="checkbox" onchange="stateOpcion(this)" role="switch" checked>
                                        </div>
                                    </form>
                                `;
                            } else {
                                return `<form action="#">
                                            <div class="form-check form-switch fs-4">
                                                <input type="text" class="opcInput d-none" value="${row.CODIGO}" />
                                                <input class="form-check-input checkState" type="checkbox" onchange="stateOpcion(this)" role="switch">
                                            </div>
                                        </form>
                                    `;
                            }
                        }
                    }
                },
                {
                    data: "NULL",
                    render: function(data, type, row) {
                        if (row.CODIGO == 0) {
                            return '';
                        } else {
                            return `<button type="button" class="btn btn-warning" onclick="editOpcion('${row.CODIGO}')"><i class="fas fa-edit text-white"></i></button>
                                        <button type="button" class="btn btn-danger" onclick="delOpcion('${row.CODIGO}')"><i class="fas fa-trash-alt text-white"></i></button>
                                        `;
                        }

                    }
                },
            ],
            rowCallback: function(row, data) {
                if (data.CODIGO == 0) {
                    row.classList.add('total-row');
                }
            }
        });
    }
    function createOpciones() {
        var urlModulos = "http://172.16.15.20/API.LovablePHP/Opc/ListMod/";
        var response = ajaxRequest(urlModulos);
        var opcMod = "";
        if (response.code == 200) {

            for (let index = 0; index < response.data.length; index++) {
                opcMod +=
                `<option value="${response.data[index]['CODIGO']}">${response.data[index]['DESCRP']}</option>`;
            }

        }
        $("#titleModal").text("Agregar una opción de menú");
        $("#contentModal").empty();
        $("#contentModal").append(`<div class="row">
                        <div class="col-12 col-lg-6 d-none">
                                <label class="form-label">Código</label>
                                <input type="text" class="form-control" id="txtOpcion" maxlength="5" oninput="this.value = this.value.toUpperCase()" placeholder="Ingrese el identificador del módulo">
                        </div>
                        <div class="col-12 col-lg-6">
                                <label class="form-label">Módulo</label>
                                <select class="form-select" id="txtModulo">
                                    ` + opcMod + `
                                </select>
                        </div>
                        <div class="col-12 col-lg-6">
                                <label class="form-label">Descripción</label>
                                <input type="text" class="form-control" id="txtDescrp" maxlength="35" oninput="this.value = this.value.toUpperCase()" placeholder="Ingrese la descripción del módulo">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="form-label text-danger mt-2" id="lblError"></label>
                        </div>
                    </div>`);
        $("#contentFooter").empty();
        $("#contentFooter").append(`<button type="button" class="btn btn-primary text-white fw-bold" onclick="saveOpcion()">
                                        <i class="fa-solid fa-floppy-disk"></i> Guardar</button>`);
        $("#txtModulo").trigger("focus");
        $("#modal").modal("show");
    }
    function saveOpcion() {
        var modulo = $("#txtModulo").val().split("-")[0];
        var descrp = $("#txtDescrp").val();
        if (modulo == 0 || descrp == "") {
            $("#lblError").text('Rellene la información solicitada');
        } else {
            $("#lblError").text('');
            var urlsave = "http://172.16.15.20/API.LovablePHP/Opc/createOpc/?modulo=" + modulo + "&desc=" + descrp + "";
            var response = ajaxRequest(urlsave);
            if (response.code == 200) {
                $("#lblError").text('');
                chargeOpciones();
                $("#modal").modal("hide");
            } else {
                $("#lblError").text('La opción ya existe');
            }
        }
    }
    function stateOpcion(check) {
        var modulo = $(check).closest("td").find(".opcInput").val();
        var estadoactual = 0;
        if ($(check).is(':checked')) {
            estadoactual = 1;
        }
        var urlchange = "http://172.16.15.20/API.LovablePHP/Opc/changeOpc/?code=" + modulo + "&estad=" + estadoactual +
            "";
        var response = ajaxRequest(urlchange);
        if (response.code == 200) {
            chargeOpciones();
            chargeProgramas();
        }
    }
    function delOpcion(id) {
        var deleteUrl = "http://172.16.15.20/API.LovablePHP/Opc/deleteOpc/?code=" + id + "";
        var response = ajaxRequest(deleteUrl);
        if (response.code == 200) {
            chargeOpciones();
            chargeProgramas();
        }
    }
    function editOpcion(id) {
        var urlModulos = "http://172.16.15.20/API.LovablePHP/Opc/ListMod/";
        var response = ajaxRequest(urlModulos);
        var opcMod = "";
        if (response.code == 200) {

            for (let index = 0; index < response.data.length; index++) {
                opcMod +=
                `<option value="${response.data[index]['CODIGO']}">${response.data[index]['DESCRP']}</option>`;
            }
        }
        var urlFind = "http://172.16.15.20/API.LovablePHP/Opc/findOpcion/?code=" + id + "";
        var response = ajaxRequest(urlFind);
        if (response.code == 200) {
            $("#titleModal").text("Editar una opción");
            $("#contentModal").empty();
            $("#contentModal").append(`<div class="row">
                <div class="col-12 col-lg-6 d-none">
                                <label class="form-label">Código</label>
                                <input type="text" class="form-control" id="txtOpcionEdit" value="` + response.data[0][
                'CODIGO'
            ] + `" maxlength="5" oninput="this.value = this.value.toUpperCase()" placeholder="Ingrese el identificador del módulo">
                        </div>
                        <div class="col-12 col-lg-6">
                                <label class="form-label">Módulo</label>
                                <select class="form-select" id="txtModuloEdit">
                                    ` + opcMod + `
                                </select>
                        </div>
                        <div class="col-12 col-lg-6">
                                <label class="form-label">Descripción</label>
                                <input type="text" class="form-control" id="txtDescrpEdit" value="` + response.data[0][
                'DESCRP'
            ] + `" maxlength="35" oninput="this.value = this.value.toUpperCase()" placeholder="Ingrese la descripción del módulo">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="form-label text-danger mt-2" id="lblErrorEdit"></label>
                        </div>
                        </div>`);
            $("#contentFooter").empty();
            $("#contentFooter").append(`<button type="button" class="btn btn-warning text-white fw-bold" onclick="saveEditOpcion()">
                <i class="fas fa-edit text-white"></i> Actualizar</button>`);
            $("#txtModuloEdit").val(response.data[0]['MODULO']);
            $("#modal").modal("show");
        }
    }
    function saveEditOpcion() {
        var opcion = $("#txtOpcionEdit").val();
        var modulo = $("#txtModuloEdit").val();
        var descrp = $("#txtDescrpEdit").val();
        if (descrp == "" || modulo == 0) {
            $("#lblErrorEdit").text('Rellene la información solicitada');
        } else {
            $("#lblErrorEdit").text('');
            var urlsave = "http://172.16.15.20/API.LovablePHP/Opc/EditOpc/?code=" + opcion + "&modulo=" + modulo +
                "&desc=" + descrp + "";
            var response = ajaxRequest(urlsave);
            if (response.code == 200) {
                $("#lblErrorEdit").text('');
                chargeOpciones();
                chargeProgramas();
                $("#modal").modal("hide");
            } else {
                $("#lblErrorEdit").text('El módulo ya existe');
            }
        }
    }
    //PROGRAMAS
    function chargeProgramas() {
        var modulo=$("#srcModulo").val().split("-")[0];
        var opcion=$("#srcOpcion").val();
        $("#divProgramas").empty();
        $("#divProgramas").append(`<table class="table stripe table-hover" id="tableProgramas"  style="width:100%">
                                        <thead>
                                        <tr class= bg-white">
                                                <th>Descripción</th>
                                                <th class="d-none">Modulo</th>
                                                <th class="d-none">Opcion</th>
                                                <th class="">Código</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>`);
        var table = $('#tableProgramas').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                loadingRecords: `<button class="btn btn-danger " type="button" >
                                    <span class="spinner-border text-white" style="width: 1.5rem; height: 1.5rem;"
                                        aria-hidden="true"></span>
                                    <span role="status" class="ms-2 text-white fs-4">Cargando...</span>
                                </button>`
            },
            "pageLength": 50,
            "ordering": false,
            order: [
                [1, 'asc']
            ],
            "ajax": {
                "url": "http://172.16.15.20/API.LovablePHP/Opc/Prg/?modulo="+modulo+"&opcion="+opcion+"",
                "type": "POST",
                error: function(xhr, status, error) {
                    console.log(error);
                    requestError = true;
                }
            },
            "columns": [{
                    data: "NULL",
                    render: function(data, type, row) {
                        if (row.MODULODESC != '') {
                            return row.MODULODESC + " - " + row.DESCRP;
                        } else {
                            return row.DESCRP;
                        }
                    }
                },
                {
                    data: "MODULO",
                    className: "d-none",
                },
                {
                    data: "OPCION",
                    className: "d-none",
                },
                {
                    data: "CODIGO",
                    render: function(data, type, row) {
                        if (row.CODIGO == 0) {
                            return '';
                        } else {
                            return data;
                        }
                    }
                },
                {
                    data: "ESTADO",
                    render: function(data, type, row) {
                        if (row.CODIGO == 0) {
                            return '';
                        } else {
                            if (data == 1) {
                                return `<form action="#">
                                        <div class="form-check form-switch fs-4">
                                            <input type="text" class="prgInput d-none" value="${row.CODIGO}" />
                                            <input class="form-check-input checkState" type="checkbox" onchange="stateProgramas(this)" role="switch" checked>
                                        </div>
                                    </form>
                                `;
                            } else {
                                return `<form action="#">
                                            <div class="form-check form-switch fs-4">
                                                <input type="text" class="prgInput d-none" value="${row.CODIGO}" />
                                                <input class="form-check-input checkState" type="checkbox" onchange="stateProgramas(this)" role="switch">
                                            </div>
                                        </form>
                                    `;
                            }
                        }
                    }
                },
                {
                    data: "NULL",
                    render: function(data, type, row) {
                        if (row.CODIGO == 0) {
                            return '';
                        } else {
                            return `<button type="button" class="btn btn-warning" onclick="editProgramas('${row.CODIGO}')"><i class="fas fa-edit text-white"></i></button>
                                    <button type="button" class="btn btn-danger" onclick="delProgramas('${row.CODIGO}')"><i class="fas fa-trash-alt text-white"></i></button>
                                    <button type="button" class="btn btn-secondary" onclick="asignarPrograma('${row.CODIGO}')"><i class="fa-solid fa-users text-white"></i></button>`;
                        }

                    }
                },
            ],
            rowCallback: function(row, data) {
                if (data.CODIGO == 0) {
                    row.classList.add('total-row');
                }
            }
        });
    }
    function createProgramas() {
        var urlModulos = "http://172.16.15.20/API.LovablePHP/Opc/ListMod/";
        var response = ajaxRequest(urlModulos);
        var opcMod = "";
        if (response.code == 200) {
            var opcMod = "<option value='0'>Seleccione un módulo</option>";
            for (let index = 0; index < response.data.length; index++) {
                opcMod +=`<option value="${response.data[index]['CODIGO']}-${response.data[index]['ABRMOD']}">${response.data[index]['DESCRP']}</option>`;
            }

        }
        $("#titleModal").text("Agregar un programa");
        $("#contentModal").empty();
        $("#contentModal").append(`<div class="row">
                        <div class="col-12 col-lg-6">
                                <label class="form-label">Módulo</label>
                                <select class="form-select" id="txtModulo">
                                    ` + opcMod + `
                                </select>
                        </div>
                        <div class="col-12 col-lg-6" id="divOpcion">
                        <label class="form-label">Opción</label>
                                                <select class="form-select" id="txtOpcion">

                                                </select>
                        </div>
                        <div class="col-12 col-lg-4 d-none">
                                <label class="form-label mt-3">Código</label>
                                <input type="text" class="form-control" id="txtCodigo" maxlength="8" oninput="this.value = this.value.toUpperCase()" placeholder="Código del programa">
                        </div>
                        <div class="col-12">
                                <label class="form-label mt-3">Descripción</label>
                                <input type="text" class="form-control" id="txtDescrp" maxlength="50" oninput="this.value = this.value.toUpperCase()" placeholder="Ingrese la descripción del programa">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="form-label text-danger mt-2" id="lblError"></label>
                        </div>
                    </div>`);
        $("#contentFooter").empty();
        $("#contentFooter").append(`<button type="button" class="btn btn-primary text-white fw-bold" onclick="saveProgramas()">
                                        <i class="fa-solid fa-floppy-disk"></i> Guardar</button>`);
        $("#txtModulo").change(function(){
            var modulo = $("#txtModulo").val().split("-")[0];
            var urlModulos = "http://172.16.15.20/API.LovablePHP/Opc/ListOpc/?modulo=" + modulo + "";
            var response = ajaxRequest(urlModulos);
            var opcOpc = ``;
            $("#divOpcion").empty();
            if (response.code == 200) {

                for (let index = 0; index < response.data.length; index++) {
                    opcOpc +=
                        `<option value="${response.data[index]['CODIGO']}">${response.data[index]['DESCRP']}</option>`;
                }
            }
            $("#divOpcion").append(`<label class="form-label">Opción</label>
                                                <select class="form-select" id="txtOpcion">
                                                    ` + opcOpc + `
                                                </select>`);
        });
        $("#txtModulo").val($("#srcModulo").val()).trigger("change");
        $("#txtOpcion").val($("#srcOpcion").val());
        $("#modal").modal("show");
    }
    function saveProgramas() {
        var modulo = $("#txtModulo").val().split("-")[0];
        var abrv= $("#txtModulo").val().split("-")[1];
        var opcion = $("#txtOpcion").val();
        var descrp = $("#txtDescrp").val();
        if (modulo == 0 || descrp == "" || opcion == 0) {
            $("#lblError").text('Rellene la información solicitada');
        } else {
            $("#lblError").text('');
            var urlsave = "http://172.16.15.20/API.LovablePHP/Opc/createPrg/?code=" + codigo + "&modulo=" + modulo +
                "&opcion=" + opcion + "&desc=" + descrp + "&abrv=" + abrv + "";
            var response = ajaxRequest(urlsave);
            if (response.code == 200) {
                $("#lblError").text('');
                chargeProgramas();
                var codigo = response.data;
                console.log(codigo);
                $("#modal").modal("hide");
                asignarPrograma(codigo);
            } else {
                $("#lblError").text('La opción ya existe');
            }
        }
    }
    function stateProgramas(check) {
        var modulo = $(check).closest("td").find(".prgInput").val();
        var estadoactual = 0;
        if ($(check).is(':checked')) {
            estadoactual = 1;
        }
        var urlchange = "http://172.16.15.20/API.LovablePHP/Opc/changePrg/?code=" + modulo + "&estad=" + estadoactual +
            "";
        var response = ajaxRequest(urlchange);
        if (response.code == 200) {
            chargeProgramas();
        }
    }
    function delProgramas(id) {
        var deleteUrl = "http://172.16.15.20/API.LovablePHP/Opc/deletePrg/?code=" + id + "";
        var response = ajaxRequest(deleteUrl);
        if (response.code == 200) {
            chargeProgramas();
        }
    }
    function editProgramas(id) {
        var urlModulos = "http://172.16.15.20/API.LovablePHP/Opc/ListMod/";
        var response = ajaxRequest(urlModulos);
        var opcMod = "";
        if (response.code == 200) {

            for (let index = 0; index < response.data.length; index++) {
                opcMod +=
                `<option value="${response.data[index]['CODIGO']}">${response.data[index]['DESCRP']}</option>`;
            }
        }
        var urlFind = "http://172.16.15.20/API.LovablePHP/Opc/findPrg/?code=" + id + "";
        var responseFind = ajaxRequest(urlFind);
        if (responseFind.code == 200) {
            $("#titleModal").text("Editar un programa");
            $("#contentModal").empty();
            $("#contentModal").append(`<div class="row">
                        <div class="col-12 col-lg-6">
                                <label class="form-label">Módulo</label>
                                <select class="form-select" id="txtModuloEdit">
                                    ` + opcMod + `
                                </select>
                        </div>
                        <div class="col-12 col-lg-6" id="divOpcionEdit">
                        <label class="form-label">Opción</label>
                                                <select class="form-select" id="txtOpcionEdit">

                                                </select>
                        </div>
                        <div class="col-12 col-lg-4 d-none">
                                <label class="form-label mt-3">Código</label>
                                <input type="text" class="form-control" id="txtCodigoEdit" value="` + responseFind
                .data[0]['CODIGO'] + `" maxlength="8" oninput="this.value = this.value.toUpperCase()" placeholder="Código del programa">
                                <input type="text" class="form-control d-none" id="txtCodigoEdit2" value="` +
                responseFind.data[0]['CODIGO'] + `">
                        </div>
                        <div class="col-12">
                                <label class="form-label mt-3">Descripción</label>
                                <input type="text" class="form-control" id="txtDescrpEdit" value="` + responseFind
                .data[0]['DESCRP'] + `" maxlength="50" oninput="this.value = this.value.toUpperCase()" placeholder="Ingrese la descripción del módulo">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label class="form-label text-danger mt-2" id="lblErrorEdit"></label>
                        </div>
                        </div>`);
            $("#contentFooter").empty();
            $("#contentFooter").append(`<button type="button" class="btn btn-warning text-white fw-bold" onclick="saveEditProgramas()">
                <i class="fas fa-edit text-white"></i> Actualizar</button>`);
            $("#txtModuloEdit").val(responseFind.data[0]['MODULO']);
            var urlModulos = "http://172.16.15.20/API.LovablePHP/Opc/ListOpc/?modulo=" + responseFind.data[0][
                'MODULO'] + "";
            var response = ajaxRequest(urlModulos);
            var opcOpc = ``;
            $("#divOpcionEdit").empty();
            if (response.code == 200) {

                for (let index = 0; index < response.data.length; index++) {
                    opcOpc +=
                        `<option value="${response.data[index]['CODIGO']}">${response.data[index]['DESCRP']}</option>`;
                }
            }
            $("#divOpcionEdit").append(`<label class="form-label">Opción</label>
                                                <select class="form-select" id="txtOpcionEdit">
                                                    ` + opcOpc + `
                                                </select>`);
            $("#txtOpcionEdit").val(responseFind.data[0]['OPCION']);
            $("#modal").modal("show");

            $("#txtModuloEdit").change(function() {
                var modulo = $("#txtModuloEdit").val();
                var urlModulos = "http://172.16.15.20/API.LovablePHP/Opc/ListOpc/?modulo=" + modulo + "";
                var response = ajaxRequest(urlModulos);
                var opcOpc = ``;
                $("#divOpcionEdit").empty();
                if (response.code == 200) {
                    for (let index = 0; index < response.data.length; index++) {
                        opcOpc +=
                            `<option value="${response.data[index]['CODIGO']}">${response.data[index]['DESCRP']}</option>`;
                    }
                }
                $("#divOpcionEdit").append(`<label class="form-label">Opción</label>
                                                <select class="form-select" id="txtOpcionEdit">
                                                    ` + opcOpc + `
                                                </select>`);
            });
        }
    }
    function saveEditProgramas() {
        var codigo2 = $("#txtCodigoEdit2").val();
        var codigo = $("#txtCodigoEdit").val();
        var opcion = $("#txtOpcionEdit").val();
        var modulo = $("#txtModuloEdit").val();
        var descrp = $("#txtDescrpEdit").val();
        if (descrp == "" || modulo == 0 || opcion == 0) {
            $("#lblErrorEdit").text('Rellene la información solicitada');
        } else {
            $("#lblErrorEdit").text('');
            var urlsave = "http://172.16.15.20/API.LovablePHP/Opc/EditPrg/?code=" + codigo + "&modulo=" + modulo +
                "&opcion=" + opcion + "&desc=" + descrp + "&code2=" + codigo2 + "";
            var response = ajaxRequest(urlsave);
            if (response.code == 200) {
                $("#lblErrorEdit").text('');
                chargeOpciones();
                chargeProgramas();
                $("#modal").modal("hide");
            } else {
                $("#lblErrorEdit").text('El módulo ya existe');
            }
        }
    }
    function asignarPrograma(code) {
        var urlFind="http://172.16.15.20/API.LovablePHP/Opc/FindUsua/?code="+code+"";
        var responseFind = ajaxRequest(urlFind);
        usuarios=[];
        var row="";
        $("#prgCode").text(code);
        $("#tableUsuariosBody").empty();
        if (responseFind.code==200) {
            for (let i = 0; i < responseFind.data.length; i++) {
                usuarios.push(responseFind.data[i]['USUARI']);
                row+=`<tr>
                        <td>${responseFind.data[i]['USUARI']}</td>
                        <td><button type="button" class="btn btn-danger" onclick="delAsignado('${responseFind.data[i]['USUARI']}','${code}')"><i class="fas fa-trash-alt text-white"></i></button></td>
                    </tr>`;
            }
            $("#tableUsuariosBody").append(row);
        }else{
            $("#tableUsuariosBody").append(`<tr>
                        <td colspan="2">No hay usuarios asignados</td>
                    </tr>`);
        }
        $("#modalPrograma").modal("show");
    }
    function saveAsignados() {
        var urlFind="http://172.16.15.20/API.LovablePHP/Opc/AsignarUsua/";
        var code=$("#prgCode").text();
        var responseFind = ajaxRequest(urlFind,{"code":code,"codusu":usuarios},"POST");
        if (responseFind.code==200) {
            $("#modalPrograma").modal("hide");
        }
    }
    function delAsignado(usuario,code) {
        var urlFind="http://172.16.15.20/API.LovablePHP/Opc/DelAsigUsua/?modulo="+usuario+"&code="+code+"";
        var responseFind = ajaxRequest(urlFind);
        usuarios.splice(usuarios.indexOf(usuario),1);
        $("#tableUsuariosBody").empty();
        if (responseFind.code==200) {
            var row="";
            if (usuarios.length==0) {
                $("#tableUsuariosBody").append(`<tr>
                        <td colspan="2">No hay usuarios asignados</td>
                    </tr>`);

            }else{
                for (let i = 0; i < usuarios.length; i++) {
                    row+=`<tr>
                            <td>${usuarios[i]}</td>
                            <td><button type="button" class="btn btn-danger" onclick="delAsignado('${usuarios[i]}','${code}')"><i class="fas fa-trash-alt text-white"></i></button></td>
                        </tr>`;
                }
                $("#tableUsuariosBody").append(row);
            }
        }
    }
    function showUsuarios() {
        $('#tbUsuarios thead th input').each(function(){
            $(this).val('');
        });
        tableUsuarios.columns().every(function () {
            this.search('');
        });
        tableUsuarios.draw();
        $('#modalPrograma').modal('hide');
        $("#modalUsuarios").modal('show');
    }
    function sendUsuarios(row) {
        var tr = $(row).closest('tr');
        var tds = tr.find('td');
        var codusu = tds.eq(0).text();
        var code=$("#prgCode").text();
        if (!usuarios.includes(codusu)) {
            usuarios.push(codusu);
        }
        $("#tableUsuariosBody").empty();
        var row="";
            if (usuarios.length==0) {
                $("#tableUsuariosBody").append(`<tr>
                        <td colspan="2">No hay usuarios asignados</td>
                    </tr>`);

            }else{
                for (let i = 0; i < usuarios.length; i++) {
                    row+=`<tr>
                            <td>${usuarios[i]}</td>
                            <td><button type="button" class="btn btn-danger" onclick="delAsignado('${usuarios[i]}','${code}')"><i class="fas fa-trash-alt text-white"></i></button></td>
                        </tr>`;
                }
                $("#tableUsuariosBody").append(row);
            }
        $("#modalUsuarios").modal('hide');
        $("#modalPrograma").modal('show');
    }
    function closeUsuarios() {
        $('#modalUsuarios').modal('hide');
        $("#modalPrograma").modal('show');
    }
    </script>
    <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="titleModal" class=""></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="contentModal">

                </div>
                <div class="modal-footer" id="contentFooter">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalPrograma" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> Asignar programa <span id="prgCode"></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" >
                     <div class="row">
                     <div class="col-12 ">
                            <label  class="form-label mt-3">Usuarios</label>
                            <span class="" onclick="showUsuarios()">
                                <input type="text" class="text-muted form-select" id="usuarioId" placeholder="Agrega un usuario" readonly />
                            </span>
                        <hr>
                    </div>
                        <div class="col-12 ">
                            <div style="margin-left: 150px; margin-right:150px;">
                                <table class="table stripe table-hover" id="tableUsuarios"  style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="width:95%">Usuario</th>
                                            <th style="width:5%">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableUsuariosBody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                     </div>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-primary text-white fw-bold" onclick="saveAsignados()">
                        <i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalUsuarios" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>

                    <button type="button" class="btn-close" onclick="closeUsuarios()"></button>
                </div>
                <div class="modal-body">
                    <div class="table-container mt-3" style="width:100%;">
                        <table id="tbUsuarios" class="table stripe table-hover " style="width:100%">
                            <thead>
                            <tr>
                                <th class="text-black text-start sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Usuario<br>
                                <input type="text" id="inputSearch1" class="form-control mt-2" style="witdh:300px;"></th>
                                <th class="text-black text-start sorting_disabled mb-3" rowspan="1" colspan="1" style="width: 0px;">Nombre<br>
                            </tr>
                            </thead>
                            <tbody id="tbUsuariosBody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>