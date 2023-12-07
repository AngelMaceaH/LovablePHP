<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.6/ladda-themeless.min.css" integrity="sha512-EOY99TUZ7AClCNvbnvrhtMXDuWzxUBXV7SFovruHvYf2dbvRB5ya+jgDPk5bOyTtZDbqFH3PTuTWl/D7+7MGsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.0/spin.min.js" integrity="sha512-fgSmjQtBho/dzDJ+79r/yKH01H/35//QPPvA2LR8hnBTA5bTODFncYfSRuMal78C08vUa93q3jyxPa273cWzqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.0/ladda.min.js" integrity="sha512-hZL8cWjOAFfWZza/p0uD0juwMeIuyLhAd5QDodiK4sBp1sG7BIeE1TbMGIbnUcUgwm3lVSWJzBK6KxqYTiDGkg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
    .table th {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .imgButtons {
        width: 50px;
    }
    .menuMarca{
        width: 5%;
    }
    .round1 {
        border-radius: 20px;
    }
    .total-row {
        background-color: rgba(0, 0, 0, 0.2) !important;
        color: white !important;
    }
    .gray-letters{
        color: transparent !important;
    }
    #isPhone {
        display: none;
    }
    @media only screen and (max-width: 1450px) {
        #isPhone {
            display: block;
        }
        #isComputer {
            display: none;
        }
    }
    #myTablePlaneacion_filter input[type="search"] {
        display: none;
    }
    
   .table-responsive {
        overflow-x: auto;
    }
    
    .table-container {
        width: 100%;
        height:450px;
        overflow-x: auto;
        position: relative;
        z-index: 1;
        top: 0;
    }
    .table-container2 {
        width: 100%;
        height:350px;
        overflow-x: auto;
        position: relative;
        z-index: 1;
        top: 0;
    }
    @media screen and (min-width: 1650px) {
        .table-container {
            width: 100%;
            height:700px;
            overflow-x: auto;
            position: relative;
            z-index: 1;
            top: 0;
        } 
        .table-container2{
            width: 100%;
            height:500px;
            overflow-x: auto;
            position: relative;
            z-index: 1;
            top: 0; 
        }
    }
    .text-brown {
        color: #5B2503;
    }
    .text-darkblue {
        color: #003C97;
    }
    .text-violet {
        color: #C18BFF;
    }
    .text-lightGreen {
        color: #00D30A;
    }
    .text-orange{
        color: #E8B000;
    }
    .bg-pink{
        background-color: rgba(238, 183, 255,0.6)!important;
    }
    .bg-yellow{
        background-color: rgba(243, 249, 69,0.4) !important;
    }
.btn.btn-success,
.btn.btn-primary {
    display: inline-flex;
    align-items: center;
    width:260px;
    justify-content: center;
}

.btn.btn-success .btn-inner,
.btn.btn-primary .btn-inner {
    
    display: inline-block;
    vertical-align: middle;
    line-height: normal;
    justify-content: center;
}
.fixed-scrollbar {
    overflow:auto;
    }
  

.text-transparent{
    color: transparent !important;
}

div.selectBox {
    position:relative;
    display:inline-block;
    cursor:default;
    text-align:left;
    width: 100%;
    line-height:35px;
    clear:both;
    color:rgba(0,0,0,0.6);
}
span.selected {
    width:100%;
    text-indent:20px;
    border:1px solid #ccc;
//    border-right:none;
    border-radius:5px;
    background:#fff;
    overflow:hidden;
}
span.selectArrow {
    width:30px;
    border:1px solid color:rgba(0,0,0,0.6);
    border-top-right-radius:5px;
    border-bottom-right-radius:5px;
    text-align:center;
    font-size:10px;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -o-user-select: none;
    user-select: none;
    background:#fff;
}
 
span.selectArrow,span.selected {
    position:relative;
    float:left;
    height:37px;
    z-index:1;
}
div.selectOptions {
    position:absolute;
    top:35px;
    left:0;
    width:100%;
    border:1px solid #ccc;
    border-bottom-right-radius:5px;
    border-bottom-left-radius:5px;
    overflow:hidden;
    background:#fff;
    padding-top:2px;
    display:none;
}
     
span.selectOption {
    display:block;
    width:100%;
    line-height:20px;
    padding:5px 4%;
}
.dataTables_wrapper .dataTable thead th {
    background-color: white !important;
}
.sorting_disabled {
    z-index: 9999 !important;
    background-color: white !important;
}
.detaHead{
    z-index: 9999 !important;
}
.dtfc-fixed-left{
    width: 40px !important;
}
span.selectOption:hover {
    color:#f6f6f6;
    background:#000; 
/*     opacity:0.5; */
}       
</style>
</head>
<body>

</body>
</html>