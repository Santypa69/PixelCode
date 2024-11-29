<?php
// Conexión a la base de datos
$host = "localhost";
$dbname = "my_project_db";
$username = "root";
$password = ""; // Cambia esto según tu configuración de la base de datos

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// Simulamos algunas preguntas sobre if y else en PHP
$questions = [
    1 => ['question' => '¿Cómo se escribe una estructura básica if/else en PHP?', 'answer' => 'if (condición) { /* código */ } else { /* código */ }'],
    2 => ['question' => '¿Cuál es la forma correcta de usar un if sin else en PHP?', 'answer' => 'if (condición) { /* código */ }'],
    3 => ['question' => '¿Qué operador se utiliza para comparar igualdad en un if en PHP?', 'answer' => '=='],
    4 => ['question' => '¿Cuál es la sintaxis para un if con más de dos condiciones en PHP?', 'answer' => 'if (condición1 && condición2) { /* código */ }'],
    5 => ['question' => '¿Cómo escribir un if/else con múltiples condiciones usando or en PHP?', 'answer' => 'if (condición1 || condición2) { /* código */ } else { /* código */ }'],
];

$responses = [];
$correct_count = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = 1; // Este es el ID del usuario, lo puedes obtener con sesión o login real
    foreach ($_POST['answers'] as $question_id => $user_answer) {
        $correct_answer = $questions[$question_id]['answer'];
        $is_correct = (strtolower(trim($user_answer)) == strtolower(trim($correct_answer))) ? 1 : 0;

        $stmt = $pdo->prepare("INSERT INTO user_answer (user_id, question_id, is_correct) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $question_id, $is_correct]);

        $responses[$question_id] = [
            'user_answer' => $user_answer,
            'correct_answer' => $correct_answer,
            'is_correct' => $is_correct,
        ];

        if ($is_correct) {
            $correct_count++;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios de PHP - Estructuras if/else</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #eef2f7;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h1, h2 {
            font-weight: bold;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        /* Navigation Bar */
        nav {
            background-color: #66b3ff;
            padding: 15px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            font-size: 18px;
            font-weight: bold;
            padding: 8px 16px;
            transition: background-color 0.3s ease;
            border-radius: 5px;
        }

        nav ul li a:hover {
            background-color: #3399ff;
        }

        /* Header Styles */
        h1 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 20px;
        }

        h2 {
            text-align: center;
            font-size: 24px;
            color: #555;
            margin-bottom: 40px;
        }

        /* Form Styles */
        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        form input[type="text"] {
            width: 100%;
            padding: 14px;
            margin-top: 10px;
            margin-bottom: 20px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 18px;
            background-color: #f9f9f9;
            transition: border 0.3s ease;
        }

        form input[type="text"]:focus {
            border: 2px solid #66b3ff;
            background-color: #f1faff;
        }

        form button {
            background-color: #66b3ff;
            color: white;
            padding: 14px 28px;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        form button:hover {
            background-color: #3399ff;
        }

        .question-item {
            margin-bottom: 20px;
        }

        .question-item strong {
            font-size: 18px;
            color: #333;
        }

        /* Result Styles */
        .result {
            background-color: #fff;
            padding: 30px;
            margin-top: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .result ul {
            list-style-type: none;
            padding: 0;
        }

        .result li {
            margin-bottom: 25px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 8px;
            border-left: 5px solid #66b3ff;
        }

        .result li span {
            font-weight: bold;
            font-size: 16px;
        }

        .result .correct {
            color: #4CAF50;
            font-weight: bold;
        }

        .result .incorrect {
            color: #FF6347;
            font-weight: bold;
        }

        /* Score Section */
        .score {
            font-size: 22px;
            margin-top: 25px;
            font-weight: bold;
            color: #333;
            text-align: center;
        }

        .score span {
            color: #66b3ff;
        }

        .retry-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #66b3ff;
            font-weight: bold;
            font-size: 18px;
            transition: color 0.3s;
            text-align: center;
            padding: 10px 20px;
            border: 2px solid #66b3ff;
            border-radius: 8px;
        }

        .retry-link:hover {
            color: white;
            background-color: #66b3ff;
        }

        /* Botón para redirigir a otra página */
        .next-page-btn {
            display: inline-block;
            margin-top: 30px;
            padding: 15px 30px;
            background-color: #3399ff;
            color: white;
            font-weight: bold;
            font-size: 18px;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s;
            text-align: center;
        }

        .next-page-btn:hover {
            background-color: #66b3ff;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 90%;
            }

            form {
                padding: 25px;
            }

            form button {
                width: 100%;
                padding: 15px;
            }

            .retry-link, .next-page-btn {
                width: 100%;
                padding: 15px;
            }

            nav ul {
                flex-direction: column;
                align-items: center;
            }

            nav ul li {
                margin: 10px 0;
            }
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <nav>
        <ul>
                <li><a href="http://localhost/my%20project/nosotros/nosotros.php" style="color: #fff;">Nosotros</a></li>
                <li><a href="http://localhost/my%20project/pagina_inicio/pagina_inicio.html" style="color: #fff;">Cursos</a></li>
                <li><a href="http://localhost/my%20project/ejercicios/index.php" style="color: #fff;">Ejercicios</a></li>
                <li><a href="https://api.whatsapp.com/send/?phone=573132680067&text&type=phone_number&app_absent=0" style="color: #fff;">Contacto</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>Ejercicios sobre Estructuras If/Else en PHP</h1>
        <h2>Recuerda que las estructuras if/else se utilizan para tomar decisiones en función de condiciones</h2>

        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
            <h2>Resultados de tus respuestas</h2>
            <div class="result">
                <ul>
                    <?php foreach ($responses as $question_id => $response): ?>
                        <li>
                            <strong>Pregunta:</strong> <?php echo $questions[$question_id]['question']; ?><br>
                            <strong>Tu respuesta:</strong> <?php echo htmlspecialchars($response['user_answer']); ?><br>
                            <strong>Respuesta correcta:</strong> <?php echo $response['correct_answer']; ?><br>
                            <strong>Resultado:</strong>
                            <?php
                            if ($response['is_correct']) {
                                echo '<span class="correct">Correcta</span>';
                            } else {
                                echo '<span class="incorrect">Incorrecta</span>';
                            }
                            ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="score">
                    <strong>Tu puntuación: </strong><?php echo $correct_count . " de " . count($questions); ?> respuestas correctas.
                    <br>
                    <strong>Nota: </strong> 
                    <?php
                        $score = ($correct_count / count($questions)) * 100;
                        echo round($score) . "%";
                    ?>
                </div>
                <a href="http://localhost/my%20project/ejercicios/if.php" class="retry-link">Volver a intentarlo</a>
                <a href="http://localhost/my%20project/Curso/curso.html#intro" class="next-page-btn">Ir a la siguiente página</a>
            </div>
        <?php else: ?>
            <form method="POST">
                <?php foreach ($questions as $id => $question): ?>
                    <div class="question-item">
                        <strong><?php echo $question['question']; ?></strong><br>
                        <input type="text" name="answers[<?php echo $id; ?>]" placeholder="Tu respuesta aquí">
                    </div>
                <?php endforeach; ?>
                <button type="submit">Enviar respuestas</button>
            </form>
        <?php endif; ?>
    </div>

</body>
</html>
