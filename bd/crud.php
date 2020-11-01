<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$nombres = (isset($_POST['nombres'])) ? $_POST['nombres'] : '';
$apellidos = (isset($_POST['apellidos'])) ? $_POST['apellidos'] : '';
$provincia =(isset($_POST['provincia'])) ? $_POST['provincia'] : '';
$ciudad = (isset($_POST['ciudad'])) ? $_POST['ciudad'] : '';
$edad = (isset($_POST['edad'])) ? $_POST['edad'] : '';
$cu = (isset($_POST['cu'])) ? $_POST['cu'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO estudiantes (nombres, apellidos, provincia, ciudad, edad, cu) VALUES('$nombres', '$apellidos', '$provincia' , '$ciudad' , '$edad', '$cu')";
      // $consulta ="INSERT INTO estudiantes(nombres,apellidos,provincia,ciudad,edad,cu) VALUES ('$nombres','$apellidos ', :$provincia1,:$ciudad, :$edad,:'$cu' )";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT id, nombres,apellidos,provincia,ciudad,edad,cu FROM estudiantes ORDER BY id DESC LIMIT 1";
     //  $consulta1 =" SELECT id, nombres, apellidos, cu FROM estudiantes ORDER BY id DESC LIMIT 1";
       // SELECT id, nombres, apellidos,provincia,ciudad,edad,cu FROM estudiantes
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE estudiantes SET nombres='$nombres', apellidos='$apellidos', provincia='$provincia', ciudad='$ciudad',edad='$edad', cu='$cu' WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id, nombres, apellidos, provincia, ciudad, edad, cu FROM estudiantes WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM estudiantes WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
