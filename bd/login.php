<?php

session_start();

$_SESSION["s_usuario"] = null;
$_SESSION["i_usuaid"] = null;
$_SESSION["i_emprcodigo"] = null;
$_SESSION["s_namehost"] = gethostname();

include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

//recepción de datos enviados mediante POST desde ajax
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';

$pass = md5($password); //encripto la clave enviada por el usuario para compararla con la clava encriptada y almacenada en la BD

$consulta = "SELECT usua_id, usua_nombres,usua_apellidos, usua_imagepath FROM usuarios WHERE usua_login='$usuario' AND usua_password='$pass' AND usua_estado=TRUE ";
$resultado = $conexion->prepare($consulta);
$resultado->execute();

if($resultado->rowCount() >= 1){
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    foreach($data as $row){
        $_SESSION["s_usuario"] = $row['usua_nombres'] . ' ' .  $row['usua_apellidos'];
        $_SESSION["i_usuaid"] = $row['usua_id'];
        $_SESSION["i_emprcodigo"] = 1;
        if($row["usua_imagepath"] != ''){
            $_SESSION["s_foto"] = "../images/" . $row['usua_imagepath'];
        }else{
            $_SESSION["s_foto"] = "../images/sin-user.png";
        }        
    }  
}else{
    $_SESSION["s_usuario"] = null;
    $_SESSION["i_usuaid"] = null;
    $_SESSION["s_foto"] = null;
    $data = null;
}

print json_encode($data);
$conexion = null;