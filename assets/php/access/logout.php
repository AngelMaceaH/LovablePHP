<?php
  // Redirige al usuario a la página de inicio
  header('Location: /'.$_SESSION['DEV'].'LovablePHP/');
  // Destruye la sesión actual
  session_destroy();
?>