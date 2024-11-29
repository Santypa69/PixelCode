<!DOCTYPE html>
<html lang="en">
<?php
session_start();

// Verificar si el usuario está logueado y si la sesión contiene los valores necesarios
if (!isset($_SESSION['email'])) {
    // Si no está logueado o la sesión no contiene los datos esperados, retornar un error
    echo json_encode(['status' => 'error', 'message' => 'No estás logueado o la sesión ha expirado.']);
    exit;
}

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixel Code - Innovación en Programación</title>
    <link rel="stylesheet" href="/estilos/nosotros.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<style>
    /* Reset de estilos */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Estilos generales */
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #1e1e1e;
        color: #e0e0e0;
    }

    /* Header */
    .main-header {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem 2rem;
        background: linear-gradient(135deg, #007acc, #00bfae);
        /* Gradiente azul y verde */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .btn-nav {
        display: none;
        cursor: pointer;
        font-size: 1.5rem;
        color: #fff;
        transition: transform 0.3s ease;
    }

    .btn-nav:hover {
        transform: scale(1.1);
    }

    @media screen and (max-width: 768px) {
        .btn-nav {
            display: block;
        }

        .main-header nav {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background-color: #333;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            z-index: 1000;
        }

        #btn-nav:checked~nav {
            display: block;
        }
    }

    nav {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .navigation {
        display: flex;
        align-items: center;
    }

    .navigation li {
        margin-right: 2rem;
        position: relative;
    }

    .navigation li a {
        text-decoration: none;
        color: #e0e0e0;
        font-weight: 700;
        font-size: 1.1rem;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .navigation li a:hover {
        color: #00bfae;
        /* Color verde agua */
        transform: translateY(-3px);
    }

    /* Hero Section */
    .hero {
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #2a2a2a, #4e4e4e);
        /* Gradiente gris oscuro */
        color: #fff;
        padding: 6rem 2rem;
        text-align: center;
        position: relative;
        height: 400px;
    }

    .hero-content {
        z-index: 2;
    }

    .hero h1 {
        font-size: 4rem;
        margin-bottom: 1rem;
        font-weight: 700;
    }

    .hero p {
        font-size: 1.6rem;
        margin-bottom: 2rem;
    }

    .btn-primary {
        background-color: #00bfae;
        /* Verde agua */
        color: #fff;
        padding: 0.75rem 2rem;
        border: none;
        border-radius: 25px;
        font-size: 1.1rem;
        font-weight: 700;
        text-decoration: none;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #007acc;
        /* Azul oscuro */
        transform: scale(1.05);
    }

    /* Sección Acerca */
    .acerca {
        text-align: center;
        padding: 4rem 2rem;
        background: #2a2a2a;
        /* Gris oscuro */
        color: #e0e0e0;
        border-radius: 15px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        margin: 2rem auto;
        max-width: 1200px;
    }

    .acerca h2 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: #00bfae;
        /* Verde agua */
    }

    .acerca img {
        width: 80%;
        max-width: 300px;
        border-radius: 10px;
        margin: 1rem 0;
        transition: transform 0.3s ease;
    }

    .acerca img:hover {
        transform: scale(1.1);
    }

    .acerca p {
        font-size: 1.2rem;
    }

    /* Sección Misión */
    .mision {
        display: flex;
        align-items: center;
        padding: 4rem 2rem;
        background: #1e1e1e;
        /* Gris oscuro */
        color: #e0e0e0;
        border-radius: 15px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        margin: 2rem auto;
        max-width: 1200px;
    }

    .ima {
        flex: 1;
        padding: 1rem;
    }

    .ima img {
        width: 100%;
        max-width: 400px;
        border-radius: 8px;
        transition: transform 0.3s ease;
    }

    .ima img:hover {
        transform: scale(1.05);
    }

    .misi {
        flex: 1;
        padding: 1rem;
        font-size: 1.2rem;
    }

    .misi h2 {
        font-size: 2rem;
        color: #00bfae;
        /* Verde agua */
        margin-bottom: 1rem;
    }

    .misi p {
        text-align: justify;
    }

    /* Sección Valores */
    .valores {
        display: flex;
        align-items: center;
        padding: 4rem 2rem;
        background: #ffd54f;
        /* Amarillo claro */
        color: #333;
        border-radius: 15px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        margin: 2rem auto;
        max-width: 1200px;
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }

    .valores.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .valo {
        flex: 1;
        padding: 1rem;
        font-size: 1.2rem;
        font-weight: 700;
        text-align: justify;
    }

    .image {
        flex: 1;
        padding: 1rem;
    }

    .image img {
        width: 100%;
        max-width: 400px;
        border-radius: 8px;
        transition: transform 0.3s ease;
    }

    .image img:hover {
        transform: scale(1.05);
    }

    /* Footer */
    .footer {
        background-color: #0d47a1;
        /* Azul oscuro */
        color: #fff;
        text-align: center;
        padding: 1rem;
        position: relative;
        bottom: 0;
        width: 100%;
        font-size: 0.9rem;
    }
</style>

<body>
    <header class="main-header">
        <label for="btn-nav" class="btn-nav"><i class="fas fa-bars"></i></label>

        <nav>
            <ul class="navigation">
            <li><a href="http://localhost/my%20project/nosotros/nosotros.php" style="color: #fff;">Nosotros</a></li>
                <li><a href="http://localhost/my%20project/pagina_inicio/pagina_inicio.html" style="color: #fff;">Cursos</a></li>
                <li><a href="http://localhost/my%20project/ejercicios/index.php" style="color: #fff;">Ejercicios</a></li>
                <li><a href="https://api.whatsapp.com/send/?phone=573132680067&text&type=phone_number&app_absent=0" style="color: #fff;">Contacto</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>Bienvenido a Pixel Code</h1>
            <p>¡Transforma tu futuro con nuestros cursos de programación innovadores y accesibles!</p>
            <a href="http://localhost/my%20project/pagina_inicio/pagina_inicio.html" class="btn-primary">Explora Nuestros Cursos</a>
        </div>
    </section>

    <section class="acerca">
        <h2>¿Quiénes Somos?</h2>
        <img src="http://localhost/my project/imagenes/iconoPHP.jpg" alt="Equipo de Pixel Code">
        <p>
            En Pixel Code, fundado en 2024, nuestra misión es empoderar a los aspirantes a programadores con el
            conocimiento y las herramientas necesarias para tener éxito en el mundo tecnológico. Nos enorgullece ser más
            que una simple plataforma de aprendizaje; somos tu socio en el camino hacia el éxito en la programación.
        </p>
    </section>

    <section class="mision">
        <div class="ima">
        <img src="http://localhost/my project/imagenes/phpmorado.png" alt="Nuestra Misión">
    </div>
        <div class="misi">
            <h2>Nuestra Misión</h2>
            <p>
                En Pixel Code, nuestra misión es democratizar la educación en programación. Ofrecemos recursos y apoyo
                para estudiantes de todos los niveles, brindando una experiencia de aprendizaje enriquecedora que los
                prepare para el mundo real.
            </p>
        </div>
    </section>

    <section class="valores">
        <div class="valo">
            <h2>Valores que Definimos</h2>
            <p>
                En Pixel Code, creemos en el poder del conocimiento y la colaboración. Nuestros valores fundamentales
                incluyen la integridad, la innovación y el compromiso con la excelencia. Estos principios guían nuestro
                trabajo y nuestra dedicación a cada estudiante.
            </p>
        </div>
        <div class="image">
            <img src="http://localhost/my project/imagenes/iconito.jpg" alt="Valores de Pixel Code">
        </div>
    </section>

    <footer class="footer">
        <p>&copy; 2024 Pixel Code. Todos los derechos reservados.</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const elements = document.querySelectorAll('.mision, .valores');

            function checkVisibility() {
                elements.forEach(el => {
                    const rect = el.getBoundingClientRect();
                    if (rect.top < window.innerHeight && rect.bottom >= 0) {
                        el.classList.add('visible');
                    }
                });
            }

            window.addEventListener('scroll', checkVisibility);
            checkVisibility(); // Para la carga inicial
        });
    </script>
</body>

</html>
