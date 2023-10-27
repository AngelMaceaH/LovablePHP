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
    @media only screen and (max-width: 1200px) {
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
    @media screen and (min-width: 1650px) {
        .table-container {
        width: 100%;
        height:700px;
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
        color: #03225B;
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
</style>
</head>
<body>

</body>
</html>