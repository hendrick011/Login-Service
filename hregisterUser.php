<?php 

session_start();
error_reporting(0);

$host = "localhost";
$user = "root";
$clave = "";
$Dbname = "android";

$response = array();
$conexion = mysqli_connect($host, $user, $clave, $Dbname);

if (!$conexion) {
    echo "Error de conexion";
    exit();

} else 
{
    echo "Conectada correctamente \n"."\n";
}

$user = $_POST['username'];
$pass = md5($_POST['password']);
$mail = $_POST['email'];

$registros = mysqli_query($conexion, "SELECT * FROM users WHERE username = '$user'")  or
  die("".mysqli_error($conexion));

while ($reg=mysqli_fetch_array($registros))
{
 if ($user == $reg['username'] or $mail == $reg['email']) {
     echo "usuario existente";
     mysqli_close($conexion);
 } 
}
    

try{
mysqli_query($conexion,"insert into users (username,password,email) values
                       ('$user','$pass','$mail')")
  or die("Problemas en el select".mysqli_error($conexion));


mysqli_close($conexion);
echo 'Usuario registrado Exitosamente!';

}
catch(Exception $e)
{
    echo 'Error al registrar usuario!';
}

