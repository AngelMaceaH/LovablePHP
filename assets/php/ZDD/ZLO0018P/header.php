<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
 .maxbox {
        height: 450px !important;
    }

    @media screen and (min-width: 1590px) {
        .maxbox {
            height: 690px !important;
        }
    }

    .bgred {
        background-color: rgba(220, 53, 69, 0.5) !important;
    }

    .bggreen {
        background-color: rgba(40, 167, 69, 0.5) !important;
    }

    .bgred:hover {
        background-color: rgba(220, 53, 69, 1) !important;
    }

    .bggreen:hover {
        background-color: rgba(40, 167, 69, 1) !important;
    }

    .textInfo {
        font-size: 15px;
        font-weight: 100 !important;
    }
    .textDate {
        font-size: 12px;
        font-weight: 100 !important;
    }
    .spinner-background {
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: white;
    z-index: 10; 
}

.spinner-border {
    top: 50%;
    left: 50%;
}
a{
    text-decoration: none;
    cursor: auto;
    color: black;
}
.bgClick{
    background-color: rgba(0, 0, 0, 0.2) !important;
}
.dropdown-menu {
    display: none;
    position: absolute;
    top: 40px;
    left: 0;
    right: 0;
    z-index: 1050;
    background-color: white;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    border: 1px solid #ddd;
}

.dropdown-menu.show {
    display: block;
}
.card-index{
    z-index: 1000;
}
@media screen and (max-width: 990px) {
    #searchDiv{
        display: none;
    }
}


.search-btn-clear {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translate(-180%, -45%);
    border: none;
    background-color: #fff;
    z-index: 10;
}



    </style>
</head>
<body>
    
</body>
</html>