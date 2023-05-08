<?php
 include '../conn.php';
 session_set_cookie_params(86400);
 session_start();
 $_SESSION['DEV']="";
 $connIBM=conexionIBM();
 $name=$_POST['user']; 
 $ps=$_POST['password']; 

 $sqlIBM= "SELECT * FROM LBPRDDAT/LO2207 WHERE CODUSU='".$name."'AND CONTRA='".$ps."'";

 $resultIBM= odbc_exec($connIBM,$sqlIBM);
 $_SESSION['val'] = "0";
 
 while($row= odbc_fetch_array($resultIBM)){
    $_SESSION['val']="1";
    $_SESSION['CODUSU'] = $row['CODUSU'];
    $_SESSION['NOMUSU'] = $row['NOMUSU'];
 }
 if ($name!='' && $ps!='') {
   if ($_SESSION['val']=="1") {
     //setcookie("user", "Angel", time() + 3600);
      header('Location: /'.$_SESSION['DEV'].'LovablePHP/');
   }else{
     $_SESSION['val'] = "2";
      header('Location: /'.$_SESSION['DEV'].'LovablePHP/login.php');
   }
 }else{
   header('Location: /'.$_SESSION['DEV'].'LovablePHP/login.php');
   
}
?>