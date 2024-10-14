<?php
require "phpqrcode/qrlib.php";

// Directorio de la imagen
$dir = "imagen/";
if (!file_exists($dir)) {
    mkdir($dir);
}

// Archivo de la imagen QR
$filename = $dir . 'imgqr.png';

$tam = 10;
$precision = 'L';
$contenido = "http://192.168.1.10/Diploma/invitacion.html";

// Generar código QR
QRcode::png($contenido, $filename, $precision, $tam);

// Conexión a la base de datos
$servername = "localhost"; 
$username = "root"; 
$password = "";  
$dbname = "registro";  

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insertar un nuevo escaneo
$stmt = $conn->prepare("INSERT INTO qr_scans (scan_time) VALUES (NOW())");
$stmt->execute();

// Contar escaneos
$result = $conn->query("SELECT COUNT(*) AS total FROM qr_scans");
$row = $result->fetch_assoc();
$total_scans = $row['total'];

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-image: url(foto2.jpg);
            background-repeat: no-repeat;

         
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #00fff2;
            text-shadow: 1px 1px 2px #00fff2;
        }
        .qr-container {
            text-align: center;
            background-color: transparent;
            padding: 20px;
            border-radius: 10px;
        }
        img {
            display: block;
            margin: 20px auto;
            width: 300px; 
            height: auto;
        }
    </style> 
</head>
<body>
    <div class="qr-container">
        <h1>Escanea el Código QR</h1>
        <h2>¡Estás invitado a nuestra Fiesta de Disfrases!</h2>
        <p>Te esperamos en el CBTIS 254</p>
        <p>Fecha:31 de octubre del 2024</p>
        <p>Hora:09:00am</p>
        



        <img src="<?php echo $filename; ?>" alt="Código QR"/>
        <h2>Total de escaneos: <?php echo $total_scans; ?></h2>
        
    </div>
</body>
</html>