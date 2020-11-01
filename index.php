<?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id, nombres, apellidos,provincia,ciudad,edad,cu FROM estudiantes";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="pagina,html5,css">
	<meta name="description" content="Esto es una pagina de sistemas">
	<title>SISTEMA DE BIBLIOTECA -TRABAJO DE CLIENTE-SERVIDOR</title>
	<link rel="stylesheet" href="estilos.css">
</head>
<body> <br>
	<center  class="center"><b><h3>TRABAJO DE CLIENTE SERVIDOR</h3></b></center>
	<header>
		<nav class="navegacion">
			<ul class="menu">
				<li><a href="alumno.php">REGISTRO DE ALUMNO</a></li>
				<li><a href="libro.php">REGISTRO DE LIBRO</a></li>

			</ul>

		</header>

</body>
</html>



            <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>

    <script type="text/javascript" src="main.js"></script>

</body>
</html>
