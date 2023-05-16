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
    $_SESSION['NIVEL'] = $row['NIVEL'];
 }
 if ($name!='' && $ps!='') {
   if ($_SESSION['val']=="1") {
     //setcookie("user", "Angel", time() + 3600);
     if ($_SESSION['NIVEL']==1) {
      header('Location: /'.$_SESSION['DEV'].'LovablePHP/');
      $_SESSION['INDEX']="index.php";
     }elseif ($_SESSION['NIVEL']==2) {
      header('Location: /'.$_SESSION['DEV'].'LovablePHP/homepage.php');
      $_SESSION['INDEX']="homepage.php";
     }elseif ($_SESSION['NIVEL']==3) {
      header('Location: /'.$_SESSION['DEV'].'LovablePHP/');
     }
      
   }else{
     $_SESSION['val'] = "2";
      header('Location: /'.$_SESSION['DEV'].'LovablePHP/login.php');
   }
 }else{
   header('Location: /'.$_SESSION['DEV'].'LovablePHP/login.php');
   
}
?>