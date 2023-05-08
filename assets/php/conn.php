<?php
//Conexion con IBM I
    function conexionIBM(){
             $connIBM=odbc_connect('as400','PHPUSER','lova202303');//DSN, usuario, password
        if (!$connIBM){
            exit("Falló conexion con AS400: " . $connIBM);
        }
        return($connIBM);
    }

?>
   
