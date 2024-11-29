<?php

if (isset($_POST['code'])) {

    $code = $_POST['code'];


    ob_start(); 
    try {
        eval('?>' . $code);
    } catch (Exception $e) {
        echo 'Error: ' . htmlspecialchars($e->getMessage());
    }
    $output = ob_get_clean(); 

    
    echo "<h3>Resultado</h3><div>$output</div>";
} else {
    echo "No se ha recibido ningún código PHP.";
}
?>
