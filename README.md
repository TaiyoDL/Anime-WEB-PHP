# My Anime List (PHP)

Aplicación web en **PHP y SQLite** para gestionar una lista personal de animes. Cada usuario se registra, inicia sesión y consulta su propio catálogo, además de explorar autores y casas animadoras.

> 🚧 **Proyecto en curso.** Empezó como una práctica en JSP y lo he migrado a PHP, ampliándolo poco a poco.

## Funcionalidades

- **Registro e inicio de sesión** con sesiones de PHP. Un usuario con la sesión iniciada no vuelve a ver el login, y las páginas privadas redirigen al inicio si no hay sesión.
- **Catálogo personal de animes:** cada usuario ve solo los animes de su lista, con cartel, foto, descripción, capítulos, temporadas, autor, casa animadora, géneros, fecha de estreno y puntuación.
- **Buscador de autores:** listado con las obras de cada uno y filtrado en tiempo real mientras se escribe (JavaScript).
- **Casas animadoras:** listado con los animes de cada casa.
- **Cierre de sesión.**
- Tres temas de color/estilos independientes por página (`Estilos.css`, `autor.css`, `casa.css`) y cambio de fondo en la pantalla de acceso.

## Tecnologías

| Parte | Tecnología |
|---|---|
| Backend | PHP (extensión `SQLite3`) |
| Base de datos | SQLite |
| Frontend | HTML5, CSS3 y JavaScript |
| Control de versiones | Git y GitHub |

## Base de datos

Archivo: `BD/Anime.bd`. Modelo relacional con 7 tablas:

| Tabla | Descripción |
|---|---|
| `Usuario` | Usuarios registrados |
| `Anime` | Datos de cada anime, con claves foráneas a autor y casa animadora |
| `Autor` | Autores/as y su edad |
| `Casa_Animadora` | Estudios de animación |
| `Genero` | Géneros disponibles |
| `Relacion_AG` | Relación N:M entre animes y géneros |
| `Relacion_AU` | Relación N:M entre usuarios y animes (la lista de cada usuario) |

## Estructura del proyecto

```
Anime WEB PHP/
├── BD/
│   └── Anime.bd            # Base de datos SQLite
├── src/
│   └── Conexion.php        # Función conectar() a la base de datos
└── WEB/
    ├── index.php           # Login y registro
    ├── iniciar.php         # Validación del inicio de sesión
    ├── registro.php        # Alta de usuarios
    ├── cerrar_sesion.php   # Cierre de sesión
    ├── Animes.php          # Catálogo del usuario
    ├── Autores.php         # Autores y buscador
    ├── CasaAnimadora.php   # Casas animadoras
    ├── Script.js           # Lógica del formulario de acceso
    ├── *.css               # Estilos
    └── imgs/               # Imágenes e iconos
```

## Cómo ejecutarlo

**Requisitos:** PHP 8 o superior con la extensión `sqlite3` activada.

```bash
git clone https://github.com/TaiyoDL/Anime-WEB-PHP.git
cd "Anime-WEB-PHP/WEB"
php -S localhost:8000
```

Después abre <http://localhost:8000> en el navegador y crea un usuario desde **Registrarse**.

> Hay que lanzar el servidor desde la carpeta `WEB`, porque `Conexion.php` accede a la base de datos con la ruta relativa `../BD/Anime.bd`. También funciona con XAMPP copiando el proyecto en `htdocs`.

## Próximos pasos

- [ ] Buscador de animes (el enlace ya está en el menú).
- [ ] Añadir y quitar animes de la lista personal desde la web.
- [ ] Guardar las contraseñas cifradas con `password_hash()` y `password_verify()`.
- [ ] Usar consultas preparadas en todas las páginas.
- [ ] Mejorar el diseño responsive.

## Autor

**TaiyoDL** · [github.com/TaiyoDL](https://github.com/TaiyoDL)
