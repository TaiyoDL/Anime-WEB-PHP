
<?php

session_start();


include_once "../src/Conexion.php";
    if(!isset($_SESSION['usuario'])){

    header("Location: index.php");
    exit();
    }

     $usuario=$_SESSION['usuario'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Catalogo Animes</title>
        <link rel="icon" href="imgs/4043233-anime-away-face-no-nobody-spirited_113254.ico" type="image/x-icon">
        <link rel="stylesheet"  href="Estilos.css">
    </head>
    <body>
        
        

    <header>

    <div class="izquierda">

        <div class="opcion">
            
            <a href="">Buscar Anime</a>
            
            
        </div>
        
        <div class="opcion"><a href="Autores.php">Buscar Autor</a></div>
        
        <div class="opcion"><a href="CasaAnimadora.php">Buscar Casa Animadora</a></div>

        </div>

        <div class="derecha">

        <div class="nombre">

        <?php
            echo $usuario;
        ?>
        </div>

        <div class="opcion">

        <a href="cerrar_sesion.php">Cerrar sesión</a>
        </div>
            </div>
            
        
    </header>
<h2 class="titulo">Catálogo de Animes</h2>
    <main>
        
        <div class="contenedorAnimes">
        
            

                <?php
                    

                   
                    $db=conectar();
                    $query="Select Anime.*, Autor.nombre as nAutor, Casa_Animadora.nombre as nCasa from Anime
LEFT join Casa_Animadora
on Casa_Animadora.id_casa=Anime.id_casa
LEFT join Autor
on Autor.id_autor=Anime.id_autor
left join Relacion_AU
on Anime.id_anime=Relacion_AU.id_anime
LEFT join usuario
on Usuario.usuario=Relacion_AU.usuario
where Usuario.usuario='$usuario';";
                    $rs=$db->query($query);

                    while($fila=$rs->fetchArray(SQLITE3_ASSOC)){

                    
                ?>
    <div class="Anime">

        <div class="cartel"><img src="<?= $fila['cartel'] ?>"></div>

        <div class="datos">

            <div class="foto"><img src="<?= $fila['foto'] ?>"></div>

            <div class="infoPrincipal">
                <p class="nombre"><?=$fila['nombre']?></p>
                <p class="descripcion"><?=$fila['descripcion']?></p>
            </div>

            <div class="contenido">
                <p class="capitulos">Capitulos: <?=$fila['capitulos']?></p>
                <p class="temporadas">Temporadas: <?=$fila['temporadas']?></p>
            </div>

            <div class="creacion">
                <p class="autor">Autor/a: <?=$fila['nAutor']!=null ? $fila['nAutor'] : ""?></p>
                <p class="casa">Casa Animadora: <?=$fila['nCasa']!=null ? $fila['nCasa'] : ""?></p>
            </div>

            <div class="extra">
                <div class="generos">

                <?php
                $id=$fila['id_anime'];
                    $rs2=$db->query("Select Anime.id_anime,Genero.* from Anime left join Relacion_AG on Relacion_AG.id_anime=Anime.id_anime left join Genero on Genero.nombre=Relacion_AG.nombre_genero where Anime.id_anime='$id'");

                    while($fila2=$rs2->fetchArray(SQLITE3_ASSOC)){
                    $nombre=$fila2['nombre'];
                    echo "<p>$nombre</p>";
                    }
                ?>
                    

                       
                </div>
            </div>

            <div class="final">
                <p class="fecha">Fecha de Estreno: <?=$fila['fecha_lanzamiento']?></p>
                <p class="nota"><?=$fila['puntuacion']?><img id="star" src="https://static.vecteezy.com/system/resources/thumbnails/021/508/043/small/black-star-black-shotting-star-transparent-black-bokeh-stars-free-free-png.png"></p>
            </div>

        </div>
    </div>
<?php
                    }
                    $db->close();
                       ?>
</div>
    </main>

    <footer></footer>
</body>
</html>
