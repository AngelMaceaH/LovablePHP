<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
    <link href="../../assets/vendors/uppyjs/uppy.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/flexselect.css">
</head>
<body>
    <?php include '../layout-prg.php'; ?>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <span>Digitalización de documentos / Subir</span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0015P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-1">
        <div class="card mb-5">
            <div class="card-header">
                <h1 class="fs-4 mb-1 mt-2 text-center">Subir documentos</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-xl-8 mt-2">
                        <div class="table-responsive">
                        <div id="uppy"></div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-4 mt-2" >
                        <div class="card overflow-auto" style="height: 550px;">
                            <div class="card-header">
                                <h5 class="mb-1 mt-2">Información del documento</h5>
                            </div>
                            <div class="card-body text-center">
                            <label class="text-danger d-none" id="lblError">Rellene todos los campos.</label>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <h6 class="mb-3 text-start">Tipo de documento</h6>
                                        <select class="form-select" id="tiposDoc">
                                           <option value="1" selected disabled>Selecciona un tipo</option>
                                    
                                        </select>
                                        <input id="tipDocs" class="d-none"/>
                                    </div>
                                    <div class="col-12" id="inputs">                   
                                    </div>
                                    <div class="col-12">
                                        <h6 class="mb-3 mt-4 text-start">Fecha de documento</h6>
                                        <input type="date" class="form-control" id="fechaDoc">
                                    </div>
                                    <div class="col-6">
                                        <h6 class="mb-1 mt-4 text-start">Fecha de digitalización</h6>
                                        <label  class="form-control" id="fechaDigit"></label>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="mb-1 mt-4 text-start">Hora de digitalización</h6>
                                        <label  class="form-control" id="horaDigit"></label>
                                    </div>
                                    <div class="col-12">
                                        <h6 class="mb-3 mt-4 text-start">Descripcion</h6>
                                        <textarea id="descrpDoc" placeholder="Ingrese una descripcion del documento" class="form-control" rows="5" style="height:150px; resize: none;"></textarea>
                                    </div>  
                                </div>
                            </div>      
                        </div>
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
    <script>
       document.getElementById("descrpDoc").addEventListener("input", function(event) {
        var input = event.target;
        var newValue = input.value.replace(/[^\w\sáéíóúÁÉÍÓÚñÑ]/g, "");
        input.value = newValue;
        });
        var codusu; var anoing; var numemp; var codsec=0; var coddep=0;
        var codigo="";
        var comarcOptions="";
    $(document).ready(function(){
         codusu="<?php echo isset($_SESSION['CODUSU'])? $_SESSION['CODUSU']: ''; ?>";
         anoing="<?php echo isset($_SESSION['ANOING'])? $_SESSION['ANOING']: ''; ?>";
         numemp="<?php echo isset($_SESSION['NUMEMP'])? $_SESSION['NUMEMP']: ''; ?>";

            const currentUrl = window.location.href;
            var url = new URL(currentUrl);
            var user= url.searchParams.get("user");
            var cia= url.searchParams.get("cia");
            var prv= url.searchParams.get("prv");
            var tip= url.searchParams.get("tip");
            var doc= url.searchParams.get("doc");
            var apl= url.searchParams.get("apl");

         console.log('user: '+user+' cia: '+cia+ ' prv: '+prv+' tip: '+tip+' doc: '+doc+' apl: '+apl);
         var usuario='<?php echo $_SESSION["CODUSU"];?>';
         var urlComarc='http://172.16.15.20/API.LovablePHP/ZLO0001P/ListComarc/?usuario='+usuario+'';
         var responseComarc = ajaxRequest(urlComarc);
            if (responseComarc.code==200) {
                for (let i = 0; i < responseComarc.data.length; i++) {
                   comarcOptions+='<option value="'+responseComarc.data[i].COMCOD+'">'+responseComarc.data[i].COMDES+'</option>';
                }
            }

        var urlTipos="http://172.16.15.20/API.LovablePHP/ZLO0015P/ListTipos/";
        var responseTipos = ajaxRequest(urlTipos);
        if (responseTipos.code==200) {
            const tipos= $("#tiposDoc");
            for (let i = 0; i < responseTipos.data.length; i++) {
                tipos.append(`<option value="`+responseTipos.data[i].TIPDOC+`">`+responseTipos.data[i].DESCRP+`</option>`);
            }
        }
        var currentDate = new Date().toISOString().split('T')[0];
        $('#fechaDigit').text(currentDate);
        $('#fechaDoc').val(currentDate);
        var urlProveedores="http://172.16.15.20/API.LovablePHP/ZLO0015P/ListProveedores/";
        var responseProveedores = ajaxRequest(urlProveedores);
        options="";
        if (responseProveedores.code==200) {
            for (let j = 0; j < responseProveedores.data.length; j++) {
                options+='<tr onclick="sendProveedor(this)"><td style="width:10%;" class="TipProveedor">'+responseProveedores.data[j]['ARCCIU']+'</td><td style="width:10%;" class="IDProveedor">'+responseProveedores.data[j]['ARCCO1']+'</td><td class="descProveedor">'+responseProveedores.data[j]['ARCNOM']+'</td></tr>';
            }
            $("#tbProveedoresBody").append(options);
            $('#tbProveedores thead th').each(function () {
            var title = $(this).text();
            $(this).html(title + '<br /><input type="text" class="form-control mt-2"/>');
            });
            var table= $('#tbProveedores').DataTable( {
                    language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                },
                "pageLength": 10,
                "ordering": false,
                "dom": 'rtip',
                
            });

            $('#tbProveedores thead input').on('keyup', function () {
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
      $("#tiposDoc").on('change',function() {
        const inputs=$("#inputs");
        inputs.empty();
        var selectedTipo= $("#tiposDoc").val();
        var urlCampos="http://172.16.15.20/API.LovablePHP/ZLO0015P/ListTiposFind/?tipo="+selectedTipo;
        var responseCampos = ajaxRequest(urlCampos);
        if (responseCampos.code==200) {
            $("#tipDocs").val(responseCampos.data[0]['TIPDOC']);
            var camposDes=responseCampos.data[0].CAMPOS.split("/"); 
            for (let i = 0; i < camposDes.length; i++) {
                if (camposDes[i].toLowerCase()=="proveedor") {
                    var select='<span class="" onclick="showProveedores()"><input type="text" class="text-muted form-select inputsDoc" id="'+responseCampos.data[0]['TIPDOC']+i+'" placeholder="Selecciona un proveedor" readonly /></span>';
                    inputs.append(`<label class=" text-start" style="width:100%; margin-top: 15px;">`+camposDes[i]+`: `+select+`</label>`);
                    //$(".selectProveedores").flexselect();
                }else if(camposDes[i].toLowerCase()=="tienda"){
                    var select=`<label class=" text-start" style="width:100%; margin-top: 15px;">`+camposDes[i]+`:<select class="form-select inputsDoc" id="`+responseCampos.data[0]['TIPDOC']+i+`" placeholder="Selecciona un proveedor"  /></select></label>`;
                    inputs.append(select);
                    $("#"+responseCampos.data[0]['TIPDOC']+i).append(comarcOptions);
                }else{
                    inputs.append(`<label class=" text-start" style="width:100%; margin-top: 15px;">`+camposDes[i]+`: <input type="text" class="form-control inputsDoc" id="`+responseCampos.data[0]['TIPDOC']+i+`" /></label>`);   
                }
                
            }}
      });


     // $("#tiposDoc").val('R01').trigger('change');
    });
        function showProveedores() {
            $("#modalProveedores").modal('show');
        }

        function sendProveedor(row){
            var tr=$(row).closest('tr');
            var tds=tr.find('td');
            var tipo=tds.eq(0).text();
            var id=tds.eq(1).text();
            var desc=tds.eq(2).text();
            codigo=tipo+'-'+id;
            $("#FAC0").val(tipo+' '+id+' '+desc);
            $("#modalProveedores").modal('hide');
        }
    function selectDepa() {
    var value=$("#cbbDepartamentos").val();
    var secdep=value.split("-")[0];
    var seccod=value.split("-")[1];
        codsec=seccod;
        coddep=secdep;
        $(".btnSend").click();
        $("#departModal").modal('hide');
    }
   </script>
    <script type="module">
        
    import { Uppy, Dashboard } from "../../assets/vendors/uppyjs/uppy.min.js"
    const uppy = new Uppy()
    uppy.use(Dashboard, { target: '#uppy', inline: true })
    function handleComplete(result) {
        if ((numemp!=0 && anoing!=0) || (codsec!=0 && coddep!=0)) {
                var fecgra=currentDate();
                var horgra=currentTime();
                var codeResponse = 0;
                var promises = [];
                result.successful.forEach(file => {
                var promise = new Promise((resolve, reject) => {
                    blobToBase64(file.data, (base64) => {
                        var fileExtension = file.name.split('.').pop();
                        var campos = {"CAM0": "","CAM1": "", "CAM2": "","CAM3": "","CAM4": "","CAM5": "","CAM6": "","CAM7": "","CAM8": "","CAM9": ""};
                        const inputs=$(".inputsDoc");
                        var tipo=$("#tipDocs").val();
                        var length=inputs.length;
                        for (let i = 0; i < length; i++) {
                            if (tipo+"0"=="FAC0") {
                                if (campos["CAM0"]=="" && campos["CAM1"]=="") {
                                    var proveedor=codigo.split("-");
                                    campos["CAM0"]=proveedor[0];
                                    campos["CAM1"]=proveedor[1];
                                    length=length+2;
                                    i=2;
                                }else{
                                    campos["CAM"+(i-1)]=$("#"+tipo+(i-2)+"").val();
                                }
                                
                            }else{
                                campos["CAM"+i]=$("#"+tipo+i+"").val();
                            }   
                               
                        }

                        var nameFile=file.name;
                        nameFile = nameFile.normalize('NFD').replace(/[\u0300-\u036f]/g, "");
                        var fecha=$("#fechaDoc").val();
                        var descrip=$("#descrpDoc").val();
                        var dataSave={
                        "NOMDOC": nameFile,
                        "EXTDOC": fileExtension,
                        "ANOING": anoing,
                        "NUMEMP": numemp,
                        "CODSEC": codsec,
                        "CODDEP": coddep,
                        "USUGRA": codusu,
                        "FECGRA": fecgra,
                        "HORGRA": horgra,
                        "ARCHIVO":base64,
                        "TIPDOC":tipo,
                        "DESCRP":descrip,
                        "FECHA":fecha.replace(/-/g, ''),
                        "CAM1":campos['CAM0'],
                        "CAM2":campos['CAM1'],
                        "CAM3":campos['CAM2'],
                        "CAM4":campos['CAM3'],
                        "CAM5":campos['CAM4'],
                        "CAM6":campos['CAM5'],
                        "CAM7":campos['CAM6'],
                        "CAM8":campos['CAM7'],
                        "CAM9":campos['CAM8'],
                        "CAM10":campos['CAM9']
                    };
                        var urlSave="http://172.16.15.20/API.LovablePHP/ZLO0015P/SaveDocument/";
                        var responseSave = ajaxRequest(urlSave, dataSave, "POST");
                        if (responseSave.code == 200) {
                            resolve(responseSave.code);
                        } else {
                            reject(responseSave.code);
                        }
                        /*console.log(dataSave);
                        resolve(200);*/
                    });
                    });
                    promises.push(promise);
                });
                Promise.all(promises)
                .then((responses) => {
                    Swal.fire(
                        'Realizado',
                        'Archivos subidos correctamente.',
                        'success'
                    ).then((result) => {
                        if (result.isConfirmed) {
                            uppy.cancelAll(); 
                            $("#tiposDoc").val(1).trigger('change');
                            $("#descrpDoc").val("").trigger('change');
                            var isOut='<?php echo isset($_SESSION['VALIDATE'])? $_SESSION['VALIDATE']:"0"; ?>';
                            if (isOut=='1') {
                                <?php
                                    $sql="DELETE from LBDESDAT/LO2294 where USUARI='".$_SESSION['CODUSU']."'";
                                    $result=odbc_exec($connIBM, $sql);
                                ?>
                            }
                        }
                    });
                })
                .catch((errorCode) => {
                    console.log(errorCode);
                    Swal.fire({
                        icon: 'error',
                        title: 'Ha ocurrido un error.',
                        text: 'Porfavor notifiquelo al administrador del sistema.',
                    });
                });
        }else{
                var urlDepas="http://172.16.15.20/API.LOVABLEPHP/ZLO0015P/ListDepas/";
                var responseDepas = ajaxRequest(urlDepas);
                if (responseDepas.code==200) {
                    const departamentos= $("#cbbDepartamentos");
                    departamentos.empty();
                    departamentos.append(`<option value="0"> </option>`);
                    for (let i = 0; i < responseDepas.data.length; i++) {
                        departamentos.append(`<option value="`+responseDepas.data[i].SECDEP+`-`+responseDepas.data[i].SECCOD+`">`+responseDepas.data[i].SECDES+`</option>`);
                        
                    }
                    $("#cbbDepartamentos").flexselect();
                }
                $("#departModal").modal('show');
        }
}

function closeWindow() {
		let new_window =
			open(location, '_self');
		new_window.close();
		return false;
	}
function blobToBase64(blob, callback) {
    const reader = new FileReader();
    reader.onload = function() {
        const dataUrl = reader.result;
        const base64String = dataUrl.split(',')[1];
        callback(base64String);
    };
    reader.readAsDataURL(blob);
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
            uppy.on('complete', handleComplete);
         function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const timeString = `${hours}:${minutes}:${seconds}`;
            
            document.getElementById('horaDigit').innerText = timeString;
        }
        setInterval(updateClock, 1000);
       
    </script>
    <script src="../../assets/js/jquery.flexselect.js"></script>
    <script src="../../assets/js/liquidmetal.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="modal fade" id="departModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
            <button type="button" class="btn-close" onclick="$('#departModal').modal('hide')"></button>
        </div>
        <div class="modal-body">
           <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h6 class="mb-3 mt-4 text-start">Departamento</h6>
                    </div>
                    <select id="cbbDepartamentos" class="form-select" data-placeholder="Selecciona una departamento">
                    </select>
                </div>
           </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="selectDepa()">Aceptar</button>
        </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="modalProveedores" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>

            <button type="button" class="btn-close" onclick="$('#modalProveedores').modal('hide')"></button>
        </div>
            <div class="modal-body">
                <div class="table-container mt-3" style="width:100%;">
                    <table id="tbProveedores" class="table stripe table-hover "style="width:100%">
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
</body>

</html>