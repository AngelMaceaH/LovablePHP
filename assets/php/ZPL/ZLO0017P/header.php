<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../../assets/vendors/@coreui/chartjs/css/coreui-chartjs.css" rel="stylesheet">
    <style>
        .highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}
        .bgpurple{
            background-color: rbga(101, 0, 255,0.5);
            rgba (101, 0, 255,0.5);
        }
        .fontS{
            font-size: 15px;
            text-align: justify;
            text-justify: inter-word;
        }
        .fontM{
            font-size: 14px;
        }
        .table-container {
            width: 100%;
            height:500px;
            overflow-x: auto;
            position: relative;
            z-index: 1;
            top: 0;
        }
        @media screen and (min-width: 1300px) {
            .table-container {
                width: 100%;
                height:550px;
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
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

</body>
</html>