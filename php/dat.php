<?php

include 'conexion.php';

$nombre = $_POST['nombres'];
$apellido = $_POST['apellidos'];
$correo = $_POST['correo'];
$usuario =$_POST['usuario'];
$password =$_POST['password'];
$password = hash('sha512', $password);//contraseña

$query = "INSERT INTO usuario(nombre, apellido, correo, usuario, password)
VALUES('$nombre','$apellido','$correo','$usuario','$password')";

//Verificamos que los correos no se repita en la base de datos
$verificar_correo = mysqli_query($conexion, "SELECT * FROM usuario WHERE correo='$correo' ");

if(mysqli_num_rows($verificar_correo) > 0){
    echo '
       <script>
       alert("Este correo ya esta registrado, intenta con otro diferente");
       window.location = "../index.php";       
       </script>
    ';
    exit();
}
/**/
//Verificamos que el nombres no se repita en la base de datos
$verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuario WHERE usuario='$usuario' ");

if(mysqli_num_rows($verificar_usuario) > 0){
    echo '
       <script>
       alert("Este usuario ya esta registrado, intenta con otro diferente");
       window.location = "../index.php";       
       </script>
    ';
    exit();
}

$ejecutar = mysqli_query($conexion, $query);

if($ejecutar){
    echo '
        <script>
           alert("Usuario almacenado exitosamente")
           window.location = "../index.php";
       </script>
    ';
}else{
    echo '
        <script>
           alert("Inténtalo de nuevo, usuario no almacenado")
           window.location = "../index.php";
       </script>
    ';
}

mysqli_close($conexion);
?>