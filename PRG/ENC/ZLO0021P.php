<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
</head>

<body>
    <?php
      include '../layout-prg.php';
?>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
              <span>Envios correo electronicos / Pedidos web</span>
              </li>
              <li class="breadcrumb-item active"><span>ZLO0021P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-3">
        <div class="card mb-5">
            <div class="card-header">
                <h1 class="fs-4 mb-1 mt-2 text-center">Envío de correos electronicos de pedidos web</h1>
            </div>
            <div class="card-body">
                <div class="container p-5">
                    <div class="row mt-2">
                        <div class="col-2 text-center">
                            <label class="form-control">Número de pedido:</label>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control fw-bold" id="numPedido"  placeholder="Eje: 4011651771477" required>
                        </div>
                        <div class="col-2 text-center">
                            <button type="button" class="btn btn-danger text-white fw-bold" style="width:100%;" onclick="sendCupon()"><i class="fa-solid fa-paper-plane"></i> Envíar</button>
                        </div>
                        <div class="col-12">
                            <label class="text-danger d-none" id="lblError">Ingrese un numero de cupón</label>
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
            var value = numPedido.value;
            if (value == "") {
                document.getElementById("lblError").classList.remove("d-none");
            } else {
                document.getElementById("lblError").classList.add("d-none");
                let url="http://172.16.15.20/API.LovablePHP/ZLO0021P/SEND/?numped="+value;
                var response=ajaxRequest(url);
                if (response.code==200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Correo enviado',
                        text: 'El correo se envió correctamente',
                    });
                    numPedido.value="";
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'El correo no se envió correctamente',
                    });
                }
            }


        }
    </script>
</body>
</html>