<script>
   function obtenerNombreDia(fecha) {
    if (fecha.length==7) {
        fecha= '0'+fecha;
    }
  var dia = parseInt(fecha.substr(0, 2));
  var mes = parseInt(fecha.substr(2, 2)) - 1; // Restamos 1 porque los meses en JavaScript se indexan desde 0 (enero = 0, febrero = 1, etc.)
  var anio = parseInt(fecha.substr(4, 4));
  
  var dias_semana = ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
  var fechaObj = new Date(anio, mes, dia);
  var indice_dia = fechaObj.getDay();
  
  return dias_semana[indice_dia];
   }

      $( document ).ready(function() {
        var usuario='<?php echo $_SESSION["CODUSU"];?>';
        var urlComarc='http://172.16.15.20/API.LovablePHP/ZLO0001P/ListComarc/?usuario='+usuario+'';
        var responseComarc = ajaxRequest(urlComarc);


            //LLENADO DE COMARC
            if (responseComarc.code==200) { 
              for (let i = 0; i < responseComarc.data.length; i++) {
               $("#comppro1").append(' <option value='+responseComarc.data[i]['COMCOD']+' selected>'+responseComarc.data[i]['COMDES']+'</option>');
               $("#comppro2").append(' <option value='+responseComarc.data[i]['COMCOD']+' selected>'+responseComarc.data[i]['COMDES']+'</option>');
              }
            }

            var productosCk1=<?php echo $ckProductos1;  ?>;
            var productosCk2=<?php echo $ckProductos2;  ?>;
        $('#productosCk1').prop('checked', <?php echo  $ckProductos1 ?>);
                $('#productosCk2').prop('checked', <?php echo  $ckProductos2 ?>);
                if (<?php echo isset($_SESSION['SelectionTab']) ? $_SESSION['SelectionTab'] : "false"; ?> == true) {
                    var tabs = $('.tablist__tab'),
                                tabPanels = $('.tablist__panel');
                            var thisTab = $("#tab2"),
                                    thisTabPanelId = thisTab.attr('aria-controls'),
                                    thisTabPanel = $('#panel2');
                    tabs.attr('aria-selected', 'false').removeClass('is-active');
                    thisTab.attr('aria-selected', 'true').addClass('is-active');
                    tabPanels.attr('aria-hidden', 'true').addClass('is-hidden');
                    thisTabPanel.attr('aria-hidden', 'false').removeClass('is-hidden');
                }else{
                    $("#tab1, #tab2").attr('aria-selected', 'false').removeClass('is-active');
                    $("#tab1").attr('aria-selected', 'true').addClass('is-active');
                }
            var fechafiltro = "<?php echo $_SESSION['FechaFiltro2'] ?>";
            var compfiltro = "<?php echo $compfiltro ?>";
            $("#fechapro, #fechapro2").val(formatoFecha(fechafiltro));
            $("#comppro1, #comppro2").val(compfiltro);
            $("#cbbMes").val("<?php echo $mesficha; ?>"); 
            $("#cbbAno").val(<?php echo $anioficha;  ?>); 

            $("#fechapro, #comppro1, #productosCk1").change(function() {
              $("#formFiltros").submit();
            });

           $("#cbbMes, #cbbAno,#comppro2, #productosCk2").change(function() {
              $("#formFiltros2").submit();
            });
                    function formatoFecha(fecha) {
                        let year = fecha.substring(0, 4);
                        let month = fecha.substring(4, 6);
                        let day = fecha.substring(6, 8);
                        return year + "-" + month + "-" + day;
                        }
           
                        $(function() {
                            var tabs = $('.tablist__tab'),
                                tabPanels = $('.tablist__panel');
                    
                            tabs.on('click', function() {
                                var thisTab = $(this),
                                    thisTabPanelId = thisTab.attr('aria-controls'),
                                    thisTabPanel = $('#' + thisTabPanelId);
                                tabs.attr('aria-selected', 'false').removeClass('is-active');
                                thisTab.attr('aria-selected', 'true').addClass('is-active');
                                tabPanels.attr('aria-hidden', 'true').addClass('is-hidden');
                                thisTabPanel.attr('aria-hidden', 'false').removeClass('is-hidden');
                            });
                            tabs.on('keydown', function(e) {
                                var thisTab = $(this);
                                if(e.which == 13) {
                                thisTab.click();
                                }
                                
                            });
                        });



            //FACTURA DETALLES
            
            var fechafiltro='<?php echo $fechaFiltro;?>';
            var compfiltro='<?php echo $_SESSION['comppro2'];?>';
            var nofiltro='<?php echo $_GET['dat'];?>';
            var ck1='<?php echo $ckProductos1;?>';  
            if (fechafiltro=='000') {
                fechafiltro='00'+'<?php echo $_SESSION['mesanterior'].$_SESSION['anioanterior'];?>';
            }
            if (nofiltro=='') {
                nofiltro='0';
            }

            var urlFactura='http://172.16.15.20/API.LovablePHP/ZLO0001P/ListFacturas/?fechaFiltro='+fechafiltro+'&compFiltro='+compfiltro+'&ck1='+ck1+'&noFiltro='+nofiltro+'';
            var responseFactura = ajaxRequest(urlFactura);
            var Facto2Tot=0; var Facsu3Tot=0; var Facim1Tot=0; var Facto3Tot=0;
            if (responseFactura.code==200) { 
                let mon='';
              for (let i = 0; i < responseFactura.data.length; i++) {
                mon=responseFactura.data[i]['FACTI3'];
                mon=mon.substr(0,1)+'.';
                if (mon=="U" && responseFactura.data[i]['FACCO4']==1) {
                                mon="L.";
                            }
                            if (mon=="U") {
                                mon="D.";
                            }
                            if (mon=="G") {
                                mon="Q.";
                            }
                            if (mon=="R") {
                                mon="P.";
                            }
                var fecha=responseFactura.data[i]['FACFE1'];
                if (fecha.length==7) {
                    fecha='0'+fecha;
                }
                var Facto2=isNaN(parseFloat(responseFactura.data[i]['FACTO2']))? 0:parseFloat(responseFactura.data[i]['FACTO2']);
                var Facsu3=isNaN(parseFloat(responseFactura.data[i]['FACSU3']))? 0:parseFloat(responseFactura.data[i]['FACSU3']);
                var Facim1=isNaN(parseFloat(responseFactura.data[i]['FACIM1']))? 0:parseFloat(responseFactura.data[i]['FACIM1']);
                var Facto3=isNaN(parseFloat(responseFactura.data[i]['FACTO3']))? 0:parseFloat(responseFactura.data[i]['FACTO3']);

                Facto2Tot=Facto2Tot+Facto2;
                Facsu3Tot=Facsu3Tot+Facsu3;
                Facim1Tot=Facim1Tot+Facim1;
                Facto3Tot=Facto3Tot+Facto3;

                $("#myTable2").append(`<tr id="tr${i}" onclick="location.href=\'/<?php echo $_SESSION['DEV']; ?>LovablePHP/PRG/ZFA/ZLO0001PRT.php?id=${responseFactura.data[i]['FACCO4']}&fac=${responseFactura.data[i]['FACNU3']}\';">`);
                $('#tr'+i+'').append("<td class='text-center'><b>"+responseFactura.data[i]['FACCO4']+"</b></td>");
                $('#tr'+i+'').append("<td class='text-center'>"+fecha.substr(0,2)+"</td>");
                $('#tr'+i+'').append("<td class='text-center'><b>"+responseFactura.data[i]['FACNU3']+"</b></td>");
                if (parseFloat(responseFactura.data[i]['FACTO2'])==0) {
                    $('#tr'+i+'').append("<td class='text-end'><b></b></td>");
                }else{
                    $('#tr'+i+'').append("<td class='text-end'><b>"+mon+Facto2.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+"</b></td>");
                }
                $('#tr'+i+'').append("<td class='text-end'><b>"+mon+Facsu3.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+"</b></td>");
                $('#tr'+i+'').append("<td class='text-end'><b>"+mon+Facim1.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+"</b></td>");
                $('#tr'+i+'').append("<td class='text-end'><b>"+mon+Facto3.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+"</b></td>");
                $("#myTable2").append('</tr>');
              }
              $("#myTable2").append(`<tr>
                                        <td class="" >9998</td>
                                        <td class=" text-center"></td>
                                        <td class="text-center"><b></b></td>
                                        <td class=" text-end"><b></b></td>
                                        <td class=" text-end"><b></b></td>
                                        <td class="text-end"><b></b></td>
                                        <td class=" text-end"><b></b></td>
                                    </tr>
                                    <tr>
                                        <td class="" >9999</td>
                                        <td class=" text-center">Total: </td>
                                        <td class="text-center"><b></b></td>
                                        <td class=" text-end fw-bold">`+mon+Facto2Tot.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+`<b></b></td>
                                        <td class=" text-end fw-bold">`+mon+Facsu3Tot.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+`<b></b></td>
                                        <td class="text-end fw-bold">`+mon+Facim1Tot.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+`<b></b></td>
                                        <td class=" text-end fw-bold">`+mon+Facto3Tot.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+`<b></b></td>
                                    </tr>`);

            }

            var nofiltro2='<?php echo $_GET['dat'];?>';
            var ck2='<?php echo $ckProductos2;?>'; 
            var mes2='<?php echo  $mesficha; ?>';
            var ano2='<?php echo  $anioficha; ?>';
            var urlDias='http://172.16.15.20/API.LovablePHP/ZLO0001P/ListDias/?mes='+mes2+'&anio='+ano2+'&compFiltro='+compfiltro+'&ck2='+ck2+'&noFiltro2='+nofiltro2+'';
            var responseDias = ajaxRequest(urlDias);
            var traTot=0;
            if (responseDias.code==200) { 
                let mon='';
              for (let i = 0; i < responseDias.data.length; i++) {
                mon=responseDias.data[i]['FACTI3'];
                mon=mon.substr(0,1)+'.';
                if (mon=="U" && responseDias.data[i]['FACCO4']==1) {
                                mon="L.";
                            }
                            if (mon=="U") {
                                mon="D.";
                            }
                            if (mon=="G") {
                                mon="Q.";
                            }
                            if (mon=="R") {
                                mon="P.";
                            }
                var fecha=responseDias.data[i]['FACFE1'];
                if (fecha.length==7) {
                    fecha='0'+fecha;
                }
                var Facto2=isNaN(parseFloat(responseDias.data[i]['FACTO2']))? 0:parseFloat(responseDias.data[i]['FACTO2']);
                var Facsu3=isNaN(parseFloat(responseDias.data[i]['FACSU3']))? 0:parseFloat(responseDias.data[i]['FACSU3']);
                var Facim1=isNaN(parseFloat(responseDias.data[i]['FACIM1']))? 0:parseFloat(responseDias.data[i]['FACIM1']);
                var Facto3=isNaN(parseFloat(responseDias.data[i]['FACTO3']))? 0:parseFloat(responseDias.data[i]['FACTO3']);
                var tra=isNaN(parseFloat(responseDias.data[i]['FACTRA']))? 0:parseFloat(responseDias.data[i]['FACTRA']);
                Facto2Tot=Facto2Tot+Facto2;
                Facsu3Tot=Facsu3Tot+Facsu3;
                Facim1Tot=Facim1Tot+Facim1;
                Facto3Tot=Facto3Tot+Facto3;
                traTot=traTot+tra;

                $("#myTable3").append(`<tr id="td${i}"`);
                $('#td'+i+'').append("<td class='text-end'><b>"+fecha+"</b></td>");
                $('#td'+i+'').append("<td class='text-end'>"+fecha.substr(0,2)+"</td>");
                $('#td'+i+'').append("<td class='text-start'><b>"+obtenerNombreDia(responseDias.data[i]['FACFE1'])+"</b></td>");
                $('#td'+i+'').append("<td class='text-center'>"+tra+"</td>");
                
                if (parseFloat(responseDias.data[i]['FACTO2'])==0) {
                    $('#td'+i+'').append("<td class='text-end'><b></b></td>");
                }else{
                    $('#td'+i+'').append("<td class='text-end'><b>"+mon+Facto2.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+"</b></td>");
                }
                $('#td'+i+'').append("<td class='text-end'><b>"+mon+Facsu3.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+"</b></td>");
                $('#td'+i+'').append("<td class='text-end'><b>"+mon+Facim1.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+"</b></td>");
                $('#td'+i+'').append("<td class='text-end'><b>"+mon+Facto3.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+"</b></td>");
                $("#myTable3").append('</tr>');

              }
              $("#myTable3").append(`<tr>
                                        <td class="" >9998</td>
                                        <td class=" text-center"></td>
                                        <td class=" text-center"></td>
                                        <td class="text-center"><b></b></td>
                                        <td class=" text-end"><b></b></td>
                                        <td class=" text-end"><b></b></td>
                                        <td class="text-end"><b></b></td>
                                        <td class=" text-end"><b></b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-end" >9999</td>
                                        <td class=" text-end"></td>
                                        <td class=" text-start">Total: </td>
                                        <td class="text-center"><b>`+traTot.toLocaleString('es-419')+`</b></td>
                                        <td class=" text-end fw-bold">`+mon+Facto2Tot.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+`<b></b></td>
                                        <td class=" text-end fw-bold">`+mon+Facsu3Tot.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+`<b></b></td>
                                        <td class="text-end fw-bold">`+mon+Facim1Tot.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+`<b></b></td>
                                        <td class=" text-end fw-bold">`+mon+Facto3Tot.toLocaleString('es-419', {minimumFractionDigits: 2,maximumFractionDigits: 2})+`<b></b></td>
                                    </tr>`);
            }
            

            var table2 = $('#myTable2').DataTable( {
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
            var table3 =  $('#myTable3').DataTable( {
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