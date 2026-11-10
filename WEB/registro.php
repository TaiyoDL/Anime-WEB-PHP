<?php
session_start();

include_once "../src/Conexion.php";

if (isset($_SESSION['usuario'])) {
    header("Location: Animes.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $db = conectar();

    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];

    $ps = $db->prepare("SELECT COUNT(*) AS existe FROM Usuario WHERE usuario=?");
    $ps->bindValue(1, $usuario, SQLITE3_TEXT);

    $rs = $ps->execute();
    $fila = $rs->fetchArray(SQLITE3_ASSOC);

    $rs->finalize();

    if ($fila['existe'] > 0) {

        echo "<script>
                alert('Usuario ya existente');
                window.location='index.php';
              </script>";

    } else {

        $ps = $db->prepare("INSERT INTO Usuario(usuario,nombre,contrasenia) VALUES(?,?,?)");
        $ps->bindValue(1, $usuario, SQLITE3_TEXT);
        $ps->bindValue(2, $nombre, SQLITE3_TEXT);
        $ps->bindValue(3, $contrasenia, SQLITE3_TEXT);
        $ps->execute();

        echo "<script>
                alert('Usuario registrado con éxito');
                window.location='index.php';
              </script>";
    }

    $db->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>

</body>
</html>