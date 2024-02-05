<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
</head>

<body>
    <?php
      include '../layout-prg.php';
      include '../../assets/php/ENC/ZLO0021P/header.php';
?>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
              <span>Envios correo electronicos / Inscripciones</span>
              </li>
              <li class="breadcrumb-item active"><span>ZLO0022P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-3">
        <div class="card mb-5" style="height: 400px;">
        <div id="bgLoader" class="d-none" style="position: fixed; z-index: 9999; height: 400px; width: 100%; background-color:rgba(108, 117, 125,0.6);"></div>
            <div id="sendingEmail" class="d-none" style="position: fixed; z-index: 9999; top: 30%; left: 50%; ">
                <div class="position-absolute p-4 bg-light p-5 rounded" style="z-index: 9999;">
                    <div class="ps-4 pe-4 pt-3">
                        <span class="loaderEmail"></span>
                    </div>
                </div>
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-opacity-50 rounded" style="z-index: 9998;"></div>
            </div>
            <div class="card-header">
                <h1 class="fs-4 mb-1 mt-2 text-center">Envío de correos electronicos de reactivación o inscripción</h1>
            </div>
            <div class="card-body " >
                <div class="container p-5">
                    <div class="row mt-5">
                        <div class="col-2 text-center">
                            <label class="form-control border border-0">Número de pedido:</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control fw-bold" id="numPedido"  placeholder="Ingrese el número de pedido" required>
                            <div class="form-check mt-1">
                            <input class="form-check-input" type="checkbox" value="" id="sendCliente">
                                <label class="form-check-label mt-1" for="flexCheckDefault">
                                    Incluír cliente
                                </label>
                            </div>
                            <label class="text-danger d-none mt-2" id="lblError">Ingrese un numero de cupón</label>
                        </div>
                        <div class="col-2 text-center">
                            <button type="button" class="btn btn-danger text-white fw-bold" style="width:100%;" onclick="sendCupon()"><i class="fa-solid fa-paper-plane"></i> Envíar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
            </div>
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
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function sendCupon() {
            var numPedido = document.getElementById("numPedido");
            var clienteck = document.getElementById("sendCliente");
            var valueCk=0;
            if (clienteck.checked) {
                valueCk=1;
            }
            var value = numPedido.value;
            if (value == "") {
                document.getElementById("lblError").classList.remove("d-none");
            } else {
                document.getElementById("lblError").classList.add("d-none");
                bgLoader.classList.remove("d-none");
                sendingEmail.classList.remove("d-none");
                let url="http://172.16.15.20/API.LovablePHP/ZLO0022P/SEND/?numped="+value+"&sendclie="+valueCk;
                fetch(url)
                    .then(() => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Correo enviado',
                            text: 'El correo se envió correctamente',
                        });
                        numPedido.value = "";
                        clienteck.checked = false;
                        bgLoader.classList.add("d-none");
                        sendingEmail.classList.add("d-none");
                    })
                    .catch(() => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'El correo no se envió correctamente',
                        });
                    });
            }
        }
    </script>
</body>
</html>