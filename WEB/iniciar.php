<?php
session_start();

include_once "../src/Conexion.php";

if (isset($_SESSION['usuario'])) {
    header("Location: Animes.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $db = conectar();

    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];

    $ps = $db->prepare("SELECT contrasenia FROM Usuario WHERE usuario=?");
    $ps->bindValue(1, $usuario, SQLITE3_TEXT);

    $rs = $ps->execute();
    $fila = $rs->fetchArray(SQLITE3_ASSOC);

    $rs->finalize();

    if (!$fila) {

        echo "<script>
                alert('Usuario no registrado');
                window.location='index.php';
              </script>";

    } else if ($fila['contrasenia'] != $contrasenia) {

        echo "<script>
                alert('Contraseña incorrecta');
                window.location='index.php';
              </script>";

    } else {

        $_SESSION['usuario'] = $usuario;

        echo "<script>
                alert('Inicio de sesión correcto');
                window.location='Animes.php';
              </script>";
    }

    $db->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inicio de sesión</title>
</head>
<body>

</body>
</html>