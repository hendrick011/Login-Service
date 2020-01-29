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

$registros = mysqli_query($conexion, "SELECT * FROM users WHERE username = '$user'")  or
  die("Problemas en el select:".mysqli_error($conexion));

while ($reg=mysqli_fetch_array($registros))
{
	$response['id'] = $reg['id'];
    $response['email'] = $reg['email'];
    $response['username'] = $reg['username'];
    $clave = md5($_POST['password']);
    
    if($clave == $reg['password']) {

	    echo 'Bienvenido a tu Perfil '.$user. "\n";
	    echo json_encode($response);
	    mysqli_free_result($registros);
        mysqli_close($conexion);

    } else {
    	echo "verifica los datos";
    }
}


