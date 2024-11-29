<?php
// Obtener el código PHP del formulario
if (isset($_POST['code'])) {
    // Obtener el código PHP enviado por el usuario
    $code = $_POST['code'];

    // Hacer que el código PHP se ejecute
    ob_start(); // Comienza la captura de salida
    try {
        eval('?>' . $code);
    } catch (Exception $e) {
        echo 'Error: ' . htmlspecialchars($e->getMessage());
    }
    $output = ob_get_clean(); // Obtener la salida capturada y limpiarla

    // Mostrar el resultado
    echo "<h3>Resultado</h3><div>$output</div>";
} else {
    echo "No se ha recibido ningún código PHP.";
}
?>
