<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$editor = (isset($_POST['editor'])) ? $_POST['editor'] : '';
$año =(isset($_POST['año'])) ? $_POST['año'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO libro (nombre, editor, año) VALUES('$nombre', '$editor', '$año')";
      // $consulta ="INSERT INTO estudiantes(nombres,apellidos,provincia,ciudad,edad,cu) VALUES ('$nombres','$apellidos ', :$provincia1,:$ciudad, :$edad,:'$cu' )";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, nombre,editor,año FROM libro ORDER BY id DESC LIMIT 1";
     //  $consulta1 =" SELECT id, nombres, apellidos, cu FROM estudiantes ORDER BY id DESC LIMIT 1";
       // SELECT id, nombres, apellidos,provincia,ciudad,edad,cu FROM estudiantes
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE libro SET nombre='$nombre', editor='$editor', año='$año' WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, nombre, editor, año FROM libro WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3://baja
        $consulta = "DELETE FROM libro WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
