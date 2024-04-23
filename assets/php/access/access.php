<?php
// Establecer la duración de la sesión a 86400 segundos (1 día)
session_set_cookie_params(604800);
// Iniciar la sesión
session_start();
// Inicializar la variable de sesión 'DEV' a vacío
$_SESSION['DEV'] ="";

// Recoger los datos del usuario y la contraseña del formulario
$name = $_POST['user'];
$ps = $_POST['password'];

// Construir la URL para la petición a la API
$url = "http:/172.16.15.20/API.LovablePHP/Access/GetAccess/?user=".$name."&ps=".$ps."";

// Inicializar cURL
$ch = curl_init();
$registros = array();

// Configurar las opciones de cURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Ejecutar la petición a la API
$reponse = curl_exec($ch);

// Comprobar si hay errores en la petición
if ($e = curl_error($ch)){
  echo $e;
} else {
  // Decodificar la respuesta JSON
  $registros[0] = json_decode($reponse, true);
}

// Recoger el código de respuesta
$code = $registros[0]['code'];

// Comprobar si el código de respuesta es 200 (éxito)
if ($code == 200) {
  // Establecer las variables de sesión con los datos del usuario
  $_SESSION['val'] = "1";
  $_SESSION['CODUSU'] = $registros[0]['data'][0]['CODUSU'];
  $_SESSION['NOMUSU'] = $registros[0]['data'][0]['NOMUSU'];
  $_SESSION['NIVEL'] = $registros[0]['data'][0]['NIVEL'];
  $_SESSION['ANOING'] = $registros[0]['data'][0]['ANOING'];
  $_SESSION['NUMEMP'] = $registros[0]['data'][0]['NUMEMP'];
  $_SESSION['PERESP'] = $registros[0]['data'][0]['PERESP'];
  $_SESSION['PROVE1'] = $registros[0]['data'][0]['PROVE1'];
  $_SESSION['PROVE2'] = $registros[0]['data'][0]['PROVE2'];
}

// Cerrar la conexión cURL
curl_close($ch);

// Comprobar si el usuario y la contraseña no están vacíos
if ($name != '' && $ps != '') {
  // Comprobar si las variables de sesión 'PROVE1' y 'PROVE2' no son 0
  if ($_SESSION['PROVE1'] != 0 && $_SESSION['PROVE2'] != 0) {
    // Si es así, establecer las cookies y redirigir al usuario
    ?>
    <script>
      // Establecer las cookies con los datos del usuario
      var prove1 = "<?php echo isset($_SESSION['PROVE1'])? $_SESSION['PROVE1']: ''; ?>";
      var prove2 = "<?php echo isset($_SESSION['PROVE2'])? $_SESSION['PROVE2']: ''; ?>";
      var user = "<?php echo isset($_SESSION['CODUSU'])? $_SESSION['CODUSU']: ''; ?>";
      var fechaExpiracion = new Date();
      fechaExpiracion.setTime(fechaExpiracion.getTime() + 1 * 24 * 60 * 60 * 1000);
      var cookie1 = "prove1" + "=" + encodeURIComponent(prove1) + ";expires=" + fechaExpiracion.toUTCString() + ";path=/";
      document.cookie = cookie1;
      var cookie2 = "prove2" + "=" + encodeURIComponent(prove2) + ";expires=" + fechaExpiracion.toUTCString() + ";path=/";
      document.cookie = cookie2;
      var cookie3 = "codusu" + "=" + encodeURIComponent(user) + ";expires=" + fechaExpiracion.toUTCString() + ";path=/";
      document.cookie = cookie3;
      // Redirigir al usuario
      location.href ="/Lovablehn.proveedores/";
     </script>
    <?php
  } else {
    // Si 'PROVE1' y 'PROVE2' son 0, comprobar el valor de la variable de sesión 'val'
    if ($_SESSION['val'] == "1") {
      // Si 'val' es 1, comprobar el nivel del usuario y redirigirlo en consecuencia
      if ($_SESSION['NIVEL'] == 1) {
        $_SESSION['INDEX'] = 'index.php';
        header('Location: /'.$_SESSION['DEV'].'LovablePHP/');
        $_SESSION['INDEX'] = "index.php";
      } elseif ($_SESSION['NIVEL'] == 2){
        $_SESSION['INDEX'] = 'homepage.php';
        header('Location: /'.$_SESSION['DEV'].'LovablePHP/homepage.php');
        $_SESSION['INDEX'] = "homepage.php";
      } elseif ($_SESSION['NIVEL'] == 3){
        $_SESSION['INDEX'] = 'homepag.php';
        header('Location: /'.$_SESSION['DEV'].'LovablePHP/homepag.php');
      } elseif ($_SESSION['NIVEL'] == 0){
        $_SESSION['INDEX'] = 'home.php';
        header('Location: /'.$_SESSION['DEV'].'LovablePHP/home.php');
      }
    } else {
      // Si 'val' no es 1, redirigir al usuario a la página de login
      $_SESSION['val'] = "2";
        header('Location: /'.$_SESSION['DEV'].'LovablePHP/login.php');
    }
  }
} else {
  // Si el usuario o la contraseña están vacíos, redirigir al usuario a la página de login
      header('Location: /'.$_SESSION['DEV'].'LovablePHP/login.php');
}
?>
