<?php


// IDEA: para evitar las inyecciones de código sql, utilizar un usuario cuyos privilegios estén restringidos a lectura de la tabla exámenes
$servername = "localhost";
$username = "root";
$password = "root";
$database = "pruebas";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Comprobar que todo fue bien
if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
}
                          
$sql = "select * from examenes where";

if($_GET['grado']!="null")
  $sql .= " grado=\"".$_GET['grado']."\" and";
  
if($_GET['curso']!="null")
  $sql .= " curso=".$_GET['curso']." and";

if($_GET['asig']!="null")
  $sql .= " asignatura=\"".$_GET['asig']."\" and";

if($_GET['prof']!="null")
  $sql .= " profesor=\"".$_GET['prof']."\" and";

// si los tres últimos carácteres son un "and", los quitamos
if( substr($sql, -3) == "and" )
  $sql = substr($sql, 0, -3);

$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
  echo "<option>".$row[$_GET['caller']]."</option>";
}

// cerramos la conexión
$conn->close();

    
?>