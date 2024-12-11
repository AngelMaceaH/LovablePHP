<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../assets/css/vendors/highcharts.css">
    <style>
        /*COLORES*/
        :root {
            --colorSky: rgb(189, 215, 238);
            --colorGold: rgb(255, 217, 102);
            --colorSea: rgb(47, 117, 181);
            --colorGreen: rgb(169, 208, 142);
            --colorRed: rgb(255, 0, 0);
            --colorOrange: rgb(255, 153, 51);
            --colorYellow: rgb(255, 255, 0);

            --colorSkySoft: rgba(189, 215, 238, 0.5);
            --colorGoldSoft: rgba(255, 217, 102, 0.5);
            --colorSeaSoft: rgba(47, 117, 181, 0.2);
            --colorGreenSoft: rgba(169, 208, 142, 0.2);
            --colorRedSoft: rgba(255, 0, 0, 0.5);
            --colorOrangeSoft: rgba(255, 153, 51, 0.2);
            --colorYellowSoft: rgba(255, 255, 0, 0.2);

            --colorSkyDark: rgba(105, 135, 167, 0.5);
            --colorGoldDark: rgba(204, 173, 82, 0.5);
            --colorSeaDark: rgba(23, 69, 104, 0.5);
            --colorGreenDark: rgba(85, 138, 71, 0.5);
            --colorRedDark: rgba(153, 0, 0, 0.5);
            --colorOrangeDark: rgba(153, 92, 30, 0.5);
            --colorYellowDark: rgba(153, 153, 0, 0.5);

            --colorGreyDark: rgba(128, 128, 128, 0.5);
        }

        .bgSky {
            background-color: var(--colorSky) !important;
        }
        .bgGold {
            background-color: var(--colorGold) !important;
        }
        .bgSea {
            background-color: var(--colorSea) !important;
        }
        .bgGreen {
            background-color: var(--colorGreen) !important;
        }
        .bgRed {
            background-color: var(--colorRed) !important;
        }
        .bgOrange {
            background-color: var(--colorOrange) !important;
        }
        .bgYellow {
            background-color: var(--colorYellow) !important;
        }

        .bgSkySoft {
            background-color: var(--colorSkySoft) !important;
        }
        .bgGoldSoft {
            background-color: var(--colorGoldSoft) !important;
        }
        .bgSeaSoft {
            background-color: var(--colorSeaSoft) !important;
        }
        .bgGreenSoft {
            background-color: var(--colorGreenSoft) !important;
        }
        .bgRedSoft {
            background-color: var(--colorRedSoft) !important;
        }
        .bgOrangeSoft {
            background-color: var(--colorOrangeSoft) !important;
        }
        .bgYellowSoft {
            background-color: var(--colorYellowSoft) !important;
        }

        .bgSkyDark {
            background-color: var(--colorSkyDark) !important;
        }
        .bgGoldDark {
            background-color: var(--colorGoldDark) !important;
        }
        .bgSeaDark {
            background-color: var(--colorSeaDark) !important;
        }
        .bgGreenDark {
            background-color: var(--colorGreenDark) !important;
        }
        .bgRedDark {
            background-color: var(--colorRedDark) !important;
        }
        .bgOrangeDark {
            background-color: var(--colorOrangeDark) !important;
        }
        .bgYellowDark {
            background-color: var(--colorYellowDark) !important;
        }

        .bgGreyDark {
            background-color: var(--colorGreyDark) !important;
        }

        .w20{
            width: 20% !important;
        }
        .w16{
            width: 16% !important;
        }
        .w14{
            width: 14% !important;
        }
        .w12 {
            width: 12% !important;
        }
        .w9{
            width: 9% !important;
        }
        .w8{
            width: 8% !important;
        }
        .w6-5{
            width: 6.5% !important;
        }
        .fs10{
            font-size: 10px !important;
        }
        .fs12{
            font-size: 12px !important;
        }
        .fnumber{
            font-family: Cambria, sans-serif;
            font-weight: bold;
            font-size: 14px !important;
            text-align: right;
        }
        .table-container {
            width: 100%;
            height:500px;
            overflow-x: auto;
            position: relative;
            z-index: 1;
            top: 0;
        }
        body{
            overflow: hidden;
        }

        @media screen and (min-width: 1300px) {
            .table-container {
                width: 100%;
                height:700px;
                overflow-x: auto;
                position: relative;
                z-index: 1;
                top: 0;
            }
        }
        @media screen and (min-width: 1400px) {
            .table-container {
                width: 100%;
                height:555px;
                overflow-x: auto;
                position: relative;
                z-index: 1;
                top: 0;
            }
        }

        @media screen and (min-width: 1540px) {
            .table-container {
                width: 100%;
                height:630px;
                overflow-x: auto;
                position: relative;
                z-index: 1;
                top: 0;
            }
        }
        @media screen and (min-width: 1600px) {
        .table-container {
            width: 100%;
            height:740px;
            overflow-x: auto;
            position: relative;
            z-index: 1;
            top: 0;
        }
    }
    .sticky-col {
            position: sticky;
            left: 0;
            background-color: white;
            z-index: 1;
        }
    </style>
</head>
<body>
</body>
</html>