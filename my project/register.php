<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Preparar y ejecutar la consulta
    $stmt = $conn->prepare("INSERT INTO users (fullName, phone, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fullName, $phone, $email, $hashed_password);
    
    if ($stmt->execute()) {
        echo "Registro exitoso";
        header("http://localhost/my%20project/nosotros/nosotros.php");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
