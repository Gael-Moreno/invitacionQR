<?php
// Datos de conexión a la base de datos
$servername = "localhost";  // Normalmente 'localhost' si la base de datos está en el mismo servidor
$username = "root";         // Cambia esto por el usuario de tu base de datos
$password = "";             // Cambia esto por la contraseña de tu base de datos
$dbname = "fiesta";         // El nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$edad = $_POST['edad'];

// Insertar datos en la base de datos
$sql = "INSERT INTO invitados (nombre, edad) VALUES ('$nombre', '$edad')";

if ($conn->query($sql) === TRUE) {
    echo "¡Gracias por confirmar tu asistencia!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();
?>