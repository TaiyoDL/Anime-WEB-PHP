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
    <link rel="stylesheet" href="autor.css">
    <link rel="shortcut icon" href="imgs/4043233-anime-away-face-no-nobody-spirited_113254.ico" type="image/x-icon">
</head>
<body>
    
<header>

   <div class="izquierda"> <a href="Animes.php"><button>Ver mis animes</button></a> <a href=""><button>Buscar casa animadora</button></a><a href=""><button>Buscar Anime</button></a></div>

   <div class="derecha"><?=$_SESSION['usuario']?>  <a class='sesion' href="cerrar_sesion.php">Cerrar sesión</a></div>
</header>

<div class="buscar">
 <img src="imgs/lupa.svg" alt="Buscador" id="lupa" width="20px">
<input type="search" id="buscador" oninput="filtrar()" placeholder="ej:Akira Toriyama">

</div>
<main>

<?php
    
$db=conectar();

$rs=$db->query("Select * from Autor;");

while($fila=$rs->fetchArray(SQLITE3_ASSOC)){
    $autores[]=$fila;

?>

<?php
   $sql= $db->prepare("Select Anime.nombre,Autor.id_autor from Anime left join Autor on Autor.id_autor=Anime.id_autor where Anime.id_autor=?");
    $sql->bindValue(1,$fila['id_autor'],SQLITE3_TEXT);

    $rs2=$sql->execute();

    while ($fila2=$rs2->fetchArray(SQLITE3_ASSOC)){


?>



<?php
$autores[count($autores)-1]['obras'][]=$fila2['nombre'];

    } 
?>

   


</div>
 </div>

<?php
    }
    $db->close();
?>


<script>

    const autores=<?= json_encode($autores)?>;


    let buscador=document.querySelector("#buscador");
    let main = document.querySelector("main");

    let buscar="";

    if(buscador.value!=null){buscar=buscador.value.trim();}

    

    for(let i=0;i<autores.length;i++){

    if(buscar.trim()==""){
let div=document.createElement("div");
div.classList.add("autor");

div.innerHTML=`
<div class='info'>
<h2 class='nombreAutor'>${autores[i].nombre}</h2>;

<p class="edad">Edad:${autores[i].edad}</p>

</div>

<div class="animes">
`;

 for(let j=0;j<autores[i].obras.length;j++){

 div.innerHTML+=`

 <a class="anime">
${autores[i].obras[j]}
</a>
 </div>`;
 }


    
    main.appendChild(div);
    }

    else{
        if(autores[i].nombre.toLowerCase().includes(buscar.toLowerCase())){
let div=document.createElement("div");
div.classList.add("autor");
let main = document.querySelector("main");
let edad=autores[i].edad;
if(edad==null || edad==undefined || !edad){

edad="";
}
div.innerHTML=`
<div class='info'>
<h2 class='nombreAutor'>${autores[i].nombre}</h2>;

<p class="edad">Edad:${edad}</p>

</div>

<div class="animes">
`;

 for(let j=0;j<autores[i].obras.length;j++){

 div.innerHTML+=`

 <a class="anime">
${autores[i].obras[j]}
</a>
 </div>`;
 }


    
    main.appendChild(div);
    }
    }
    
    }

    function filtrar(){
 
    main.innerHTML="";

    buscar="";

    if(buscador.value!=null){buscar=buscador.value.trim();}

    

    for(let i=0;i<autores.length;i++){

    if(buscar.trim()==""){
let div=document.createElement("div");
div.classList.add("autor");
let main = document.querySelector("main");
div.innerHTML=`
<div class='info'>
<h2 class='nombreAutor'>${autores[i].nombre}</h2>;

<p class="edad">Edad:${autores[i].edad}</p>

</div>

<div class="animes">
`;

 for(let j=0;j<autores[i].obras.length;j++){

 div.innerHTML+=`

 <a class="anime">
${autores[i].obras[j]}
</a>
 </div>`;
 }


    
    main.appendChild(div);
    }

    else{
         if(autores[i].nombre.toLowerCase().includes(buscar.toLowerCase())){
let div=document.createElement("div");
div.classList.add("autor");
let main = document.querySelector("main");
div.innerHTML=`
<div class='info'>
<h2 class='nombreAutor'>${autores[i].nombre}</h2>;

<p class="edad">Edad:${autores[i].edad}</p>

</div>

<div class="animes">
`;

 for(let j=0;j<autores[i].obras.length;j++){

 div.innerHTML+=`

 <a class="anime">
${autores[i].obras[j]}
</a>
 </div>`;
 }


    
    main.appendChild(div);
    }
    }
    
    }

    }
</script>


</main>
<footer></footer>
</body>
</html>