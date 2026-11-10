
<?php
    session_start();

    if(!isset($_SESSION['usuario'])){
header("Location: index.php");
exit();

    }

    include_once "../src/Conexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="casa.css">
</head>
<body>
    

    <header>

        <div class="izquierda">
            <a href="" class="opcion">Buscar anime</a>
            <a href="Animes.php"class="opcion">Ver mis animes</a>
            <a href="Autores.php"class="opcion">Buscar Autor</a>
        </div>
        <div class="derecha">
            <div class="usuario"><?=$_SESSION['usuario']?></div>
            <a href="cerrar_sesion.php"class="sesion">Cerrar Sesión</a>
        </div>
    </header>

    <main>



    </main>
    <footer></footer>

    <?php
        $db=conectar();
        $filas=[];

        $rs=$db->query("Select  Casa_Animadora.nombre,Casa_Animadora.id_casa from Casa_Animadora");
        

        while($fila=$rs->fetchArray(SQLITE3_ASSOC)){
$filas[]=$fila;
 $sql=$db->prepare("Select  Casa_Animadora.id_casa,Anime.nombre from Casa_Animadora left join Anime on Anime.id_casa=Casa_Animadora.id_casa where Anime.id_casa=?");

 $sql->bindValue(1,$fila['id_casa'],SQLITE3_TEXT);
 $rs2=$sql->execute();

 while($fila2=$rs2->fetchArray(SQLITE3_ASSOC)){
$filas[count($filas)-1]['animes'][]=$fila2['nombre'];

 }

        }
    ?>

    <script>


let casas=<?=json_encode($filas)?>;
let main=document.querySelector("main");
console.log(casas);
for(let i=0;i<casas.length;i++){
let div = document.createElement("div");
div.classList.add("casa");

div.innerHTML = `
    <h1 class="nombre">${casas[i].nombre}</h1>
`;

let animes = document.createElement("div");
animes.classList.add("animes");

for (let j = 0; j < casas[i].animes.length; j++) {

    let anime = document.createElement("div");
    anime.classList.add("anime");

    anime.textContent = casas[i].animes[j];

    animes.appendChild(anime);
}

div.appendChild(animes);

main.appendChild(div);
}
    </script>
</body>
</html>