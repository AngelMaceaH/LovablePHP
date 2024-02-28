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
    <script src="../../assets/js/PRG/Admin/Opciones.js"></script>
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