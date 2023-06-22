<script>
    $( document ).ready(function() {
var fac='<?php echo $_GET['fac'];?>';
var id='<?php echo $_GET['id'];?>';
var enca2bool=false;
//CORRELATIVO
  var corre='http://172.16.15.20/API.LovablePHP/ZLO0001P/ListCorre/?fac='+fac+'&compFiltro='+id+'';
  var responseCorre = ajaxRequest(corre);
//ENCABEZADO
  var enca='http://172.16.15.20/API.LovablePHP/ZLO0001P/ListEnca/?fac='+fac+'&compFiltro='+id+'';
  var responseEnca = ajaxRequest(enca);
  $("#enca2, #enca22").addClass("d-none");
  if (responseEnca.code==500) {
    $("#enca2 , #enca22").removeClass("d-none");
    $("#enca1").addClass("d-none");
    var enca2bool=true;
    var enca='http://172.16.15.20/API.LovablePHP/ZLO0001P/ListEnca2/?fac='+fac+'&compFiltro='+id+'';
    var responseEnca = ajaxRequest(enca);
  }
 //DETALLES
 var deta='http://172.16.15.20/API.LovablePHP/ZLO0001P/ListDeta/?fac='+fac+'&compFiltro='+id+'';
 var responseDeta = ajaxRequest(deta);
 if (responseDeta.code==500) {
    var deta='http://172.16.15.20/API.LovablePHP/ZLO0001P/ListDeta2/?fac='+fac+'&compFiltro='+id+'';
 var responseDeta = ajaxRequest(deta);
  }


  //LLENADO CORRELATIVO
  if (responseCorre.code==200) {
    for (let i = 0; i < responseCorre.data.length; i++) {
        $("#lblCorre").text("Docto. Fiscal " + responseCorre.data[i]['CORRELATIVO']);
    }
  }
  //LLENADO ENCABEZADO
  if (responseEnca.code==200) {
    for (let i = 0; i < responseEnca.data.length; i++) {
        $("#lblFactura").text(responseEnca.data[i]['FACNU3']);
        $("#lblCliente").text(responseEnca.data[i]['FACCI2']+''+responseEnca.data[i]['FACCO5']+' '+responseEnca.data[i]['DESCLI']);
        $("#lblTipo").text(responseEnca.data[i]['FACTI2']);
        $("#lblVendedor").text("Vendedor: "+responseEnca.data[i]['FACNU4']+' '+responseEnca.data[i]['MAENO3']);
        if (responseEnca.data[i]['FACFE1'].length==7) {
            $("#lblFecha").text("Fecha: "+"0"+responseEnca.data[i]['FACFE1']);
        }else{
            $("#lblFecha").text("Fecha: "+responseEnca.data[i]['FACFE1']);
        }
        if (responseEnca.data[i]['FACDI1']!=0) {
            $("#lblPlazo").text(responseEnca.data[i]['FACDI1']);
        }
        
        $("#lblMoneda").text(responseEnca.data[i]['FACTI3']);
        $("#lblImpuesto").text(responseEnca.data[i]['FACGR2']);
       
        $("#lblBultos").text(responseEnca.data[i]['FACBU2']);
        
        if (enca2bool) {
            $("#lblConsecu").text(responseEnca.data[i]['RCONCE']);
            $("#lblClave").text(responseEnca.data[i]['RCLANU']);
            $("#lblTDesc").text(responseEnca.data[i]['TOTCDE']);
        }else{
            if (responseEnca.data[i]['FACP01']!=0) {
                $("#lblPedidos").text(responseEnca.data[i]['FACP01']);
            }
            $("#lblPreventas").text(responseEnca.data[i]['PEDPRE']);
        }
        var fecha="";
        if (responseEnca.data[i]['FACF03'].length==7) {
           fecha= "0"+responseEnca.data[i]['FACF03'];
        }else{
            fecha= responseEnca.data[i]['FACF03'];
        }
        var dia = fecha.substr(0,2);var mes = fecha.substr(2,2);var ano = fecha.substr(4,4);
        $("#lblFechaVen").text(dia+'/'+mes+'/'+ano);
        $("#lblLugarDes").text(responseEnca.data[i]['FACLU2']);
        $("#lblTransp").text(responseEnca.data[i]['FACTR2']);
        $("#lblFechaEmbar").text(responseEnca.data[i]['FACF02']);
        $("#lblTBruto").text(responseEnca.data[i]['FACSU2']);
        $("#lblDesc").text(responseEnca.data[i]['FACTO2']);
        $("#lblImp").text(responseEnca.data[i]['FACIM1']);
        $("#lblTNeto").text(responseEnca.data[i]['FACTO3']);
      
    }
  }
  //LLENADO DETALLE
  if (responseDeta.code==200) {
    var unidades=0;  var tBruto=0;
    for (let i = 0; i < responseDeta.data.length; i++) {
        $("#myTableBody").append(`<tr id="tr${i}">`);
                $('#tr'+i+'').append("<td class='text-end'><b>"+responseDeta.data[i]['FACNU5']+"</b></td>");
                $('#tr'+i+'').append("<td class='text-end'><b>"+responseDeta.data[i]['FACMA1']+"</b></td>");
                $('#tr'+i+'').append("<td class='text-start'><b>"+responseDeta.data[i]['FACCO7']+"</b></td>");
                $('#tr'+i+'').append("<td class='text-center'><b>"+responseDeta.data[i]['FACCO8']+"</b></td>");
                $('#tr'+i+'').append("<td class='text-end'><b>"+responseDeta.data[i]['FACTA1']+"</b></td>");
                $('#tr'+i+'').append("<td class='text-end'><b>"+responseDeta.data[i]['FACCA1']+"</b></td>");
                $('#tr'+i+'').append("<td class='text-end'><b>"+responseDeta.data[i]['FACCA2']+"</b></td>");
                $('#tr'+i+'').append("<td class='text-end'><b>"+responseDeta.data[i]['FACNI1']+"</b></td>");
                $('#tr'+i+'').append("<td class='text-end'><b>"+responseDeta.data[i]['FACDE1']+"</b></td>");
                $('#tr'+i+'').append("<td class='text-end'><b>"+parseFloat(responseDeta.data[i]['FACPR5']).toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+"</b></td>");
                $('#tr'+i+'').append("<td class='text-end'><b>"+responseDeta.data[i]['FACV01']+"</b></td>");
        $("#myTableBody").append('</tr>');
        unidades= unidades+parseFloat(responseDeta.data[i]['FACCA2']);
        tBruto= tBruto + parseFloat(responseDeta.data[i]['FACV01']);
    }
    var docenas= Math.floor(unidades);
    var decimales=unidades.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2}).toString().substr((unidades.toString().indexOf("."))+1,2)/12; 
    docenas2=Math.floor(decimales);
    decimales= ((decimales*12)-(docenas2*12))/100;
    docenas= docenas+docenas2;
    if (decimales==0) {
         unidades = docenas+".00";
    }else{
        unidades = docenas+decimales;
    }
    
    $("#myTableBody").append(`<tr>
                                <td class='text-end'>99999</td>
                                <td class='text-end'></td>
                                <td class='text-start'></td>
                                <td class='text-center'></td>
                                <td class='text-end'><b></b></td>
                                <td class='text-end'><b></b></td>
                                <td class='text-end'><b></b></td>
                                <td class='text-end'><b></b></td>
                                <td class='text-end'><b></b></td>
                                <td class='text-end'><b></b></td>
                                <td class='text-end'><b></b></td>
                                </tr>
                            `);
                            $("#myTableBody").append(`<tr>
                                      <td class='text-end'>99999</td>
                                      <td class='text-end'></td>
                                      <td class='text-start'></td>
                                      <td class='text-center'></td>
                                      <td class='text-end'><b>Total</b></td>
                                      <td class='text-end'><b></b></td>
                                      <td class='text-end table-active'><b>`+unidades+`</b></td>
                                      <td class='text-end'><b></b></td>
                                      <td class='text-end'><b></b></td>
                                      <td class='text-end'><b></b></td>
                                      <td class='text-end table-active'><b>`+tBruto.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+`</b></td>
                                      </tr>
                            `);
  }
  var tableFac = $('#myTableFactura').DataTable( {
                "searching": false,
                "paging": false,
                "lengthChange": false,
                "bInfo" : false,
                "ordering": false,
                "pageLength": 100,
                "language": {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                },
                "columnDefs": [
                {
                    target: 0,
                    visible: false,
                    searchable: false,
                },
              ],
              } );

});


</script>