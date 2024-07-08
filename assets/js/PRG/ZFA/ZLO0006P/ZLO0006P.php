<script>
        $(document).ready(function() {
            // Establecer el valor de "#cbbMes" al valor de "$mesfiltro"
            $("#cbbMes").val("<?php echo $mesfiltro; ?>");
            // Establecer el valor de "#cbbAno" al valor de "$anofiltro"
            $("#cbbAno").val(<?php echo $anofiltro;  ?>);
            // Si "$ckfiltro" es igual a 1
            if ((<?php echo $ckfiltro;  ?>) == 1) {
            // Marcar "#flexRadioDefault1" como seleccionado
            $("#flexRadioDefault1").prop("checked", true);
            // Desmarcar "#flexRadioDefault2"
            $("#flexRadioDefault2").prop("checked", false);
            } else {
            // Desmarcar "#flexRadioDefault1"
            $("#flexRadioDefault1").prop("checked", false);
            // Marcar "#flexRadioDefault2" como seleccionado
            $("#flexRadioDefault2").prop("checked", true);
            }

            // Cuando el valor de "#cbbMes", "#cbbAno", "#flexRadioDefault1", "#flexRadioDefault2", o "#cbbMarca" cambie
            $("#cbbMes, #cbbAno, #flexRadioDefault1, #flexRadioDefault2, #cbbMarca", ).change(function() {
            // Enviar el formulario "#formFiltros"
            $("#formFiltros").submit();
            });

            $('#guatd1, #guatd2, #guatd3, #guatd4').addClass('d-none');
            $('#saltd1, #saltd2, #saltd3, #saltd4').addClass('d-none');
            $('#costd1, #costd2, #costd3, #costd4').addClass('d-none');
            $('#reptd1, #reptd2, #reptd3, #reptd4').addClass('d-none');
            $('#nictd1, #nictd2, #nictd3, #nictd4').addClass('d-none');
            $('#tottd1, #tottd2, #tottd3, #tottd4').addClass('d-none');
            $('#btncolHon').click(function() {
                $('#Enca').text('Honduras');
                $('#honth1, #honth2, #honth3, #honth4').removeClass('d-none');
                $('#hontd1, #hontd2, #hontd3, #hontd4').removeClass('d-none');
                $('#guath1, #guath2, #guath3, #guath4').addClass('d-none');
                $('#guatd1, #guatd2, #guatd3, #guatd4').addClass('d-none');
                $('#salth1, #salth2, #salth3, #salth4').addClass('d-none');
                $('#saltd1, #saltd2, #saltd3, #saltd4').addClass('d-none');
                $('#costh1, #costh2, #costh3, #costh4').addClass('d-none');
                $('#costd1, #costd2, #costd3, #costd4').addClass('d-none');
                $('#repth1, #repth2, #repth3, #repth4').addClass('d-none');
                $('#reptd1, #reptd2, #reptd3, #reptd4').addClass('d-none');
                $('#nicth1, #nicth2, #nicth3, #nicth4').addClass('d-none');
                $('#nictd1, #nictd2, #nictd3, #nictd4').addClass('d-none');
                $('#tottd1, #tottd2, #tottd3, #tottd4').addClass('d-none');
                $('#totth1, #totth2, #totth3, #totth4').addClass('d-none');
            });
            $('#btncolGua').click(function() {
                $('#Enca').text('Guatemala');
                $('#honth1, #honth2, #honth3, #honth4').removeClass('d-none');
                $('#hontd1, #hontd2, #hontd3, #hontd4').addClass('d-none');
                $('#guatd1, #guatd2, #guatd3, #guatd4').removeClass('d-none');
                $('#guath1, #guath2, #guath3, #guath4').addClass('d-none');
                $('#costd1, #costd2, #costd3, #costd4').addClass('d-none');
                $('#costh1, #costh2, #costh3, #costh4').addClass('d-none');
                $('#salth1, #salth2, #salth3, #salth4').addClass('d-none');
                $('#saltd1, #saltd2, #saltd3, #saltd4').addClass('d-none');
                $('#nictd1, #nictd2, #nictd3, #nictd4').addClass('d-none');
                $('#nicth1, #nicth2, #nicth3, #nicth4').addClass('d-none');
                $('#reptd1, #reptd2, #reptd3, #reptd4').addClass('d-none');
                $('#repth1, #repth2, #repth3, #repth4').addClass('d-none');
                $('#tottd1, #tottd2, #tottd3, #tottd4').addClass('d-none');
                $('#totth1, #totth2, #totth3, #totth4').addClass('d-none');
            });
            $('#btncolSal').click(function() {
                $('#Enca').text('El Salvador');
                $('#honth1, #honth2, #honth3, #honth4').addClass('d-none');
                $('#hontd1, #hontd2, #hontd3, #hontd4').addClass('d-none');
                $('#guatd1, #guatd2, #guatd3, #guatd4').addClass('d-none');
                $('#guath1, #guath2, #guath3, #guath4').addClass('d-none');
                $('#costd1, #costd2, #costd3, #costd4').addClass('d-none');
                $('#costh1, #costh2, #costh3, #costh4').addClass('d-none');
                $('#nictd1, #nictd2, #nictd3, #nictd4').addClass('d-none');
                $('#nicth1, #nicth2, #nicth3, #nicth4').addClass('d-none');
                $('#reptd1, #reptd2, #reptd3, #reptd4').addClass('d-none');
                $('#repth1, #repth2, #repth3, #repth4').addClass('d-none');
                $('#tottd1, #tottd2, #tottd3, #tottd4').addClass('d-none');
                $('#totth1, #totth2, #totth3, #totth4').addClass('d-none');
                $('#salth1, #salth2, #salth3, #salth4').removeClass('d-none');
                $('#saltd1, #saltd2, #saltd3, #saltd4').removeClass('d-none');
            });
            $('#btncolCos').click(function() {
                $('#Enca').text('Costa Rica');
                $('#honth1, #honth2, #honth3, #honth4').addClass('d-none');
                $('#hontd1, #hontd2, #hontd3, #hontd4').addClass('d-none');
                $('#guatd1, #guatd2, #guatd3, #guatd4').addClass('d-none');
                $('#guath1, #guath2, #guath3, #guath4').addClass('d-none');
                $('#salth1, #salth2, #salth3, #salth4').addClass('d-none');
                $('#saltd1, #saltd2, #saltd3, #saltd4').addClass('d-none');
                $('#nictd1, #nictd2, #nictd3, #nictd4').addClass('d-none');
                $('#nicth1, #nicth2, #nicth3, #nicth4').addClass('d-none');
                $('#reptd1, #reptd2, #reptd3, #reptd4').addClass('d-none');
                $('#repth1, #repth2, #repth3, #repth4').addClass('d-none');
                $('#tottd1, #tottd2, #tottd3, #tottd4').addClass('d-none');
                $('#totth1, #totth2, #totth3, #totth4').addClass('d-none');
                $('#costd1, #costd2, #costd3, #costd4').removeClass('d-none');
                $('#costh1, #costh2, #costh3, #costh4').removeClass('d-none');
            });
            $('#btncolNic').click(function() {
                $('#Enca').text('Nicaragua');
                $('#honth1, #honth2, #honth3, #honth4').addClass('d-none');
                $('#hontd1, #hontd2, #hontd3, #hontd4').addClass('d-none');
                $('#guatd1, #guatd2, #guatd3, #guatd4').addClass('d-none');
                $('#guath1, #guath2, #guath3, #guath4').addClass('d-none');
                $('#salth1, #salth2, #salth3, #salth4').addClass('d-none');
                $('#saltd1, #saltd2, #saltd3, #saltd4').addClass('d-none');
                $('#costd1, #costd2, #costd3, #costd4').addClass('d-none');
                $('#costh1, #costh2, #costh3, #costh4').addClass('d-none');
                $('#reptd1, #reptd2, #reptd3, #reptd4').addClass('d-none');
                $('#repth1, #repth2, #repth3, #repth4').addClass('d-none');
                $('#tottd1, #tottd2, #tottd3, #tottd4').addClass('d-none');
                $('#totth1, #totth2, #totth3, #totth4').addClass('d-none');
                $('#nictd1, #nictd2, #nictd3, #nictd4').removeClass('d-none');
                $('#nicth1, #nicth2, #nicth3, #nicth4').removeClass('d-none');
            });
            $('#btncolRep').click(function() {
                $('#Enca').text('República Dominicana');
                $('#honth1, #honth2, #honth3, #honth4').addClass('d-none');
                $('#hontd1, #hontd2, #hontd3, #hontd4').addClass('d-none');
                $('#guatd1, #guatd2, #guatd3, #guatd4').addClass('d-none');
                $('#guath1, #guath2, #guath3, #guath4').addClass('d-none');
                $('#salth1, #salth2, #salth3, #salth4').addClass('d-none');
                $('#saltd1, #saltd2, #saltd3, #saltd4').addClass('d-none');
                $('#costd1, #costd2, #costd3, #costd4').addClass('d-none');
                $('#costh1, #costh2, #costh3, #costh4').addClass('d-none');
                $('#nictd1, #nictd2, #nictd3, #nictd4').addClass('d-none');
                $('#nicth1, #nicth2, #nicth3, #nicth4').addClass('d-none');
                $('#tottd1, #tottd2, #tottd3, #tottd4').addClass('d-none');
                $('#totth1, #totth2, #totth3, #totth4').addClass('d-none');
                $('#reptd1, #reptd2, #reptd3, #reptd4').removeClass('d-none');
                $('#repth1, #repth2, #repth3, #repth4').removeClass('d-none');
            });
            $('#btncolTot').click(function() {
                $('#Enca').text('Total');
                $('#honth1, #honth2, #honth3, #honth4').addClass('d-none');
                $('#hontd1, #hontd2, #hontd3, #hontd4').addClass('d-none');
                $('#guatd1, #guatd2, #guatd3, #guatd4').addClass('d-none');
                $('#guath1, #guath2, #guath3, #guath4').addClass('d-none');
                $('#salth1, #salth2, #salth3, #salth4').addClass('d-none');
                $('#saltd1, #saltd2, #saltd3, #saltd4').addClass('d-none');
                $('#costd1, #costd2, #costd3, #costd4').addClass('d-none');
                $('#costh1, #costh2, #costh3, #costh4').addClass('d-none');
                $('#nictd1, #nictd2, #nictd3, #nictd4').addClass('d-none');
                $('#nicth1, #nicth2, #nicth3, #nicth4').addClass('d-none');
                $('#reptd1, #reptd2, #reptd3, #reptd4').addClass('d-none');
                $('#repth1, #repth2, #repth3, #repth4').addClass('d-none');
                $('#tottd1, #tottd2, #tottd3, #tottd4').removeClass('d-none');
                $('#totth1, #totth2, #totth3, #totth4').removeClass('d-none');
            });
            var usuario = '<?php echo $_SESSION["CODUSU"];?>';
            const urlVal="http://172.16.15.20/API.LovablePHP/Users/FindAgrupP/?codusu="+usuario+"";
            fetch(urlVal).then(response => response.json()).then(data => {
                if(data.code==200){
                    let count=0;
                    if (data.data.length>1) {
                        data.data.forEach(element => {
                       if (element.DESCRI.includes("honduras")) {
                            $("#lblHon").removeClass("d-none");
                            count++;
                       }else if (element.DESCRI.includes("guatemala")) {
                            $("#lblGua").removeClass("d-none");
                            count++;
                       }else if (element.DESCRI.includes("salvador")) {
                            $("#lblSal").removeClass("d-none");
                            count++;
                       }else if(element.DESCRI.includes("costa rica")){
                            $("#lblCos").removeClass("d-none");
                            count++;
                       }else if(element.DESCRI.includes("nicaragua")){
                            $("#lblNic").removeClass("d-none");
                            count++;
                       }else if(element.DESCRI.includes("republica dominicana")){
                            $("#lblRep").removeClass("d-none");
                            count++;
                      }
                    });
                    }
                    let columnasExcel=[1];
                    let titleExcel='';
                    const firstCountry = data.data[0].DESCRI;
                    if(count==6){
                     $("#lblTot").removeClass("d-none");
                     $('#btncolHon').click();
                     columnasExcel.push(2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29);
                     titleExcel+='                                                                            HONDURAS';
                     titleExcel+='                                                             GUATEMALA';
                     titleExcel+='                                                        EL SALVADOR';
                     titleExcel+='                                                                        COSTA RICA';
                     titleExcel+='                                                              REP. DOMINICANA';
                     titleExcel+='                                                    NICARAGUA';
                     titleExcel+='                                                       TOTAL      ';
                    }else{
                        if(firstCountry.includes("honduras")){
                        $('#btncolHon').click();
                        columnasExcel.push(2,3,4,5);
                        titleExcel+='                                                                            HONDURAS';
                        }else if(firstCountry.includes("guatemala")){
                            $('#btncolGua').click();
                            columnasExcel.push(6,7,8,9);
                            titleExcel+='                                                             GUATEMALA';
                        }else if(firstCountry.includes("salvador")){
                            $('#btncolSal').click();
                            columnasExcel.push(10,11,12,13);
                            titleExcel='                                                        EL SALVADOR';
                        } else if(firstCountry.includes("costa rica")){
                            $('#btncolCos').click();
                            columnasExcel.push(14,15,16,17);
                            titleExcel+='                                                                        COSTA RICA';
                        } else if(firstCountry.includes("nicaragua")){
                            $('#btncolNic').click();
                            columnasExcel.push(22,23,24,25);
                            titleExcel+='                                                    NICARAGUA';
                        } else if(firstCountry.includes("republica dominicana")){
                            $('#btncolRep').click();
                            columnasExcel.push(18,19,20,21);
                            titleExcel+='                                                              REP. DOMINICANA';
                        }
                    }


                    setTimeout(() => {
                        var table5 = $('#myTableMarcas').DataTable({
                        autoWidth: false,
                        stateSave: true,
                        "ordering": false,
                        "pageLength": 100,
                        "language": {
                            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                        },
                        columns: [{}, {}, {}, {}, {}, {}, {}, {}, {}, {},
                            {}, {}, {}, {}, {}, {}, {}, {}, {}, {},
                            {}, {}, {}, {}, {}, {}, {}, {}, {}, {},
                        ],
                        "columnDefs": [{
                            target: 0,
                            visible: false,
                            searchable: true,
                        }, ],
                        dom: 'Bfrtip',
                        buttons: [{
                            extend: 'excelHtml5',
                            text: '<i class="fa-solid fa-file-excel"></i> <b >Enviar a Excel</b>',
                            className: "btn btn-success text-light fs-6 ",
                            exportOptions: {
                                columns: columnasExcel
                            },
                            createEmptyCells: true,
                            messageTop: 'a',
                            title: 'Comparativo marcas y país',
                            customize: function(xlsx) {
                                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                var sSh = xlsx.xl['styles.xml'];
                                var lastXfIndex = $('cellXfs xf', sSh).length - 1;
                                var i;
                                var y;

                                var n1 = '<numFmt formatCode="##0.0000%" numFmtId="300"/>';
                                var s1 =
                                    '<xf numFmtId="300" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>';
                                var s2 =
                                    '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                    '<alignment horizontal="center"/></xf>';
                                var s3 =
                                    '<xf numFmtId="4" fontId="2" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>'
                                var s4 =
                                    '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                    '<alignment horizontal="center" wrapText="1"/></xf>'
                                sSh.childNodes[0].childNodes[0].innerHTML += n1;
                                sSh.childNodes[0].childNodes[5].innerHTML += s1 + s2 + s3 + s4;

                                var fourDecPlaces = lastXfIndex + 1;
                                var greyBoldCentered = lastXfIndex + 2;
                                var twoDecPlacesBold = lastXfIndex + 3;
                                var greyBoldWrapText = lastXfIndex + 4;
                                if ((<?php echo $ckfiltro;  ?>) == 1) {
                                    $('c[r=A1] t', sheet).text(
                                        'COMPARATIVO DE VENTAS MARCAS Y PAIS'
                                        );
                                } else {
                                    $('c[r=A1] t', sheet).text(
                                        'COMPARATIVO DE VENTAS MARCAS Y PAIS   DESDE:  <?php echo obtenerNombreMes(1); ?>   HASTA:  <?php echo obtenerNombreMes($mesfiltro); ?>'
                                        );
                                }

                                $('c[r=A2] t', sheet).text(titleExcel);
                                $('row:eq(0) c', sheet).attr('s', greyBoldCentered);
                                $('row:eq(1) c', sheet).attr('s', 7);
                                $('row:eq(2) c', sheet).attr('s', greyBoldCentered);
                                var tagName = sSh.getElementsByTagName('sz');

                                for (i = 0; i < tagName.length; i++) {
                                    tagName[i].setAttribute("val", "13")
                                }

                                }

                            }],
                            paging: false,
                        });

                    }, 200);
                    if (data.acceso==0) {
                    $("#body-page").empty();
                    $("#body-page").append('<div class="text-center p-5 fs-3 m-5" style="height:600px;"><div class="border border-1 rounded p-5 m-5"><i class="fa-solid fa-question fa-fade fa-2xl mb-4"></i><br /> No hay contenido para mostrar.</div></div>');
                     }
                }

            });

        });
    </script>