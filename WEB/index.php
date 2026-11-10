<?php

session_start();
    include_once "../src/Conexion.php";
    if(isset($_SESSION['usuario'])){

    header("Location: Animes.php");
    exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Login Anime</title>
            <link rel="stylesheet" href="styles.css">
            <link rel="icon" href="imgs/icono.ico">

    </head>
    <body>

    <header>

<div class="fondos">


        <img id="azul" src="imgs/azul.png" onclick="cambiarFondoAzul()">
        <img id="rosa" src="imgs/rosa.png" onclick="cambiarFondoRosa()">

</div>

    </header>

    <main>

        <div class="inicio visible">
            <form id="login" method="post" action="iniciar.php">

        <div class="imageL"></div>

        <div class="cajaL">
<h1>Inicia Sesión</h1>
        


  <div class="mover">      
<h2>Usuario</h2>
        <input type="text" placeholder="Nombre de usuario" name="usuario" required>
        </div> 
<div > 
       <h2>Contraseña</h2>
        <input type="password" placeholder="Contraseña" name="contrasenia" required> 
        </div> 
      <div class="cajaBoton">
<input class="boton" type="submit" value="Inciar">  


</div>  
<p class="cambiar" onclick="mostrarRegistro()">Registrarse</p>
</div>

        
    </form>
    </div>
<div class="registrarse oculto">
    <form id="register" method="post" action="registro.php">

<div class="imageR"></div>

        <div class="cajaR">
<h1>Registro</h1>
      <div > 
       <h2>Nombre Completo</h2>
        <input type="text" placeholder="Nombre" name="nombre" required> 
        </div>  

       <div>  
<h2>Usuario</h2>
        <input type="text" placeholder="Nombre de usuario" name="usuario" required>
        </div> 
<div> 
       <h2>Contraseña</h2>
        <input type="password" placeholder="Contraseña" name="contrasenia" id="contrasenia" required oninput ="comprobarContrasenia()"> 
</div> 
<div> 
        <h2>Repetir Contraseña</h2>
        <input type="password" placeholder="Repetir Contraseña" name="contrasenia2" id="contrasenia2" required oninput ="comprobarContrasenia()"> 
        </div> 

        <div class="cajaBoton">
<input class="boton" id="BotonR" type="submit" value="Registro" name="Registro">   
</div>
<p class="cambiar" onclick="mostrarInicio()">Inciar Sesión</p>
</div>
        
    </form>
    </div>
</main>
<footer></footer>
<script src="Script.js"></script>
</body>
</html>