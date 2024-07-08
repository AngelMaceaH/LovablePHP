<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
    <link rel="stylesheet" href="../../assets/css/flexselect.css">
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
    <script src="../../assets/js/PRG/Admin/Usuarios.js"></script>
    <script src="../../assets/js/liquidmetal.js"></script>
    <script src="../../assets/js/jquery.flexselect.js"></script>
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
                                        <div class="col-12">
                                            <div class="form-control border d-flex mt-4">
                                                <label class="form-check-label mt-2 me-3">Permiso para <span
                                                        class="fw-bold">enviar  documentos
                                                    digitales: correos electrónicos</span> </label>
                                                <div class="form-check form-switch fs-5 mt-1">
                                                    <input class="form-check-input mt-3 text-danger" id="permisosEsp3"
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
                                        <div class="col-12">&nbsp;&nbsp;</div>
                                        <div class="col-12 d-flex">
                                            <label class="form-label mt-3" >Copiar&nbsp;accesos&nbsp;del&nbsp;usuario:</label>
                                            <select class="form-select ms-2" id="usuaAccesos">
                                                <option value="">Seleccione un usuario</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label text-success mt-2" id="lblprogramas"></label>
                                            <hr>
                                        </div>
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
                                            <label class="form-label">Usuario del sistema<span
                                                    class="text-danger">*</span></label>
                                            <label class="form-control" id="txtUserEdit"></label>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label class="form-label">Contraseña<span
                                                    class="text-danger">*</span></label>
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
                                                        <input type="text" class="text-muted form-select"
                                                            id="empleadoIdEdit" placeholder="Selecciona un empleado"
                                                            readonly />
                                                        <input type="text" class="d-none" id="empleadoId2">
                                                    </span>
                                                </div>
                                                <div class="col-1 m-0 p-0">
                                                    <button class="btn btn-secondary text-white"
                                                        onclick="cleanEmpleadosEdit()" style="width:100%;"><i
                                                            class="fa-solid fa-x"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label mt-3">Departamento y Sección</label>
                                            <div class="row">
                                                <div class="col-10">
                                                    <select id="cbbDepartamentosEdit" class="form-select mt-1">
                                                    </select>
                                                    <label class="form-label text-danger mt-2 mb-2"
                                                        id="lblCbbErrorEdit"></label>
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
                                                                    <th class="text-left text-white" style="width:80%;">
                                                                        Departamento
                                                                    </th>
                                                                    <th class="text-center text-white"
                                                                        style="width:20%;"></th>
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
                                                oninput="this.value =(parseInt(this.value)>3)?'3':this.value"
                                                maxlength="1" class="form-control" data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                data-bs-title="0=(SIN ACCESO A LAS GRAFICAS)<br>1=(ACCESO TODAS LAS GRAFICAS)<br>2=(GRAFICAS DE VENTAS DE TIENDAS)<br>3=(GRAFICAS DE INVENTARIOS TIENDAS)">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label mt-3">Proveedor</label>
                                            <div class="row">
                                                <div class="col-11">
                                                    <span class="" onclick="showProveedoresEdit()">
                                                        <input type="text" class="text-muted form-select"
                                                            id="proveedorIdEdit" placeholder="Selecciona un proveedor"
                                                            readonly />
                                                    </span>
                                                </div>
                                                <div class="col-1 m-0 p-0">
                                                    <button class="btn btn-secondary text-white"
                                                        onclick="cleanProveedoresEdit()" style="width:100%;"><i
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
                                                        class="text-danger fw-bold">eliminar</span> documentos
                                                    digitales: </label>
                                                <div class="form-check form-switch fs-5 mt-1">
                                                    <input class="form-check-input mt-3 text-danger"
                                                        id="permisosEsp1Edit" type="checkbox" role="switch">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-control border border-success d-flex mt-4">
                                                <label class="form-check-label mt-2 me-3">Permiso para <span
                                                        class="text-success fw-bold">autorizar</span> documentos
                                                    digitales: </label>
                                                <div class="form-check form-switch fs-5 mt-1">
                                                    <input class="form-check-input mt-3 text-success"
                                                        id="permisosEsp2Edit" type="checkbox" role="switch">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-1">
                                            <label class="form-check-label mt-3 me-3">Tipos de documentos a
                                                visualizar</label>
                                            <div class="row">
                                                <div class="col-10">
                                                    <select id="tiposDocEdit" class="form-select mt-2">
                                                    </select>
                                                    <label class="form-label text-danger mt-2 mb-2"
                                                        id="lbltiposErrorEdit"></label>
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
                                                                    <th class="text-left text-white" style="width:80%;">
                                                                        Tipo de
                                                                        documento</th>
                                                                    <th class="text-center text-white"
                                                                        style="width:20%;"></th>
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
                                        <div class="col-12">&nbsp;&nbsp;</div>
                                        <div class="col-12 d-flex">
                                            <label class="form-label mt-3" >Copiar&nbsp;accesos&nbsp;del&nbsp;usuario:</label>
                                            <select class="form-select ms-2" id="usuaAccesosEdit">
                                                <option value="">Seleccione un usuario</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label text-success mt-2" id="lblprogramasEdit"></label>
                                            <hr>
                                        </div>
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