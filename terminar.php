<?php
	require('seguridad.php');
    include 'conexion.php';
	$folio = $_POST["folio2"];
	$sql="SELECT * FROM pedido where folio=$folio;";
	$result = mysqli_query($con, $sql);
	$rows = $result->num_rows;
      for ($i=0 ; $i < $rows ; $i++){
        $row = $result->fetch_assoc();
        $nombreCliente= $row["nombre_cliente"];
        $operador= $row["operador"];
        $prenda= $row["prenda"];
        $proceso= $row["proceso"];
        $tiempo_estimado= $row["tiempoEstimado"];
        $fecha= $row["fecha"];
  

  $sql2="INSERT INTO historial (folio, nombre_cliente, operador, prenda, proceso, tiempo_esperado, fecha) VALUES ($folio, '$nombreCliente', '$operador', $prenda, $proceso, $tiempo_estimado, '$fecha');";    
  $result2= mysqli_query  ($con, $sql2);
}
  $sql3= "DELETE FROM pedido WHERE folio=$folio;";
  $result3=mysqli_query ($con,$sql3);
  $sql4="DELETE FROM cola WHERE folio=$folio;";
  $result4=mysqli_query($con,$sql4);
  header("Refresh:0; url=operador2.php");

 ?>
