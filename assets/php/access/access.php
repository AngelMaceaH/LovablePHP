
<?php
 include '../conn.php';
 session_set_cookie_params(86400);
 session_start();
 $_SESSION['DEV']="";
 $connIBM=conexionIBM();
 $name=$_POST['user']; 
 $ps=$_POST['password']; 

$url = "http://172.16.15.20/API.LovablePHP/Access/GetAccess/?user=".$name."&ps=".$ps."";
$ch = curl_init();
$registros=array();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
$reponse= curl_exec($ch);
if ($e = curl_error($ch)) {
    echo $e;
}else{                 
  $registros[0]=json_decode($reponse,true);                  
}
  $code=$registros[0]['code'];
  if ($code==200) {
    $_SESSION['val']="1";
    $_SESSION['CODUSU'] = $registros[0]['data'][0]['CODUSU'];
    $_SESSION['NOMUSU'] = $registros[0]['data'][0]['NOMUSU'];
    $_SESSION['NIVEL'] = $registros[0]['data'][0]['NIVEL'];
    $_SESSION['ANOING'] = $registros[0]['data'][0]['ANOING'];
    $_SESSION['NUMEMP'] = $registros[0]['data'][0]['NUMEMP'];
  }
curl_close($ch);
if ($name!='' && $ps!='') {
  if ($_SESSION['val']=="1") {
    //setcookie("user", "Angel", time() + 3600);
    if ($_SESSION['NIVEL']==1) {
      $_SESSION['INDEX']='index.php';
     header('Location: /'.$_SESSION['DEV'].'LovablePHP/');
     $_SESSION['INDEX']="index.php";
    }elseif ($_SESSION['NIVEL']==2) {
      $_SESSION['INDEX']='homepage.php';
     header('Location: /'.$_SESSION['DEV'].'LovablePHP/homepage.php');
     $_SESSION['INDEX']="homepage.php";
    }elseif ($_SESSION['NIVEL']==3) {
      $_SESSION['INDEX']='homepag.php';
     header('Location: /'.$_SESSION['DEV'].'LovablePHP/homepag.php');
    }
  }else{
    $_SESSION['val'] = "2";
     header('Location: /'.$_SESSION['DEV'].'LovablePHP/login.php');
  }
}else{
  header('Location: /'.$_SESSION['DEV'].'LovablePHP/login.php');
}
?>
