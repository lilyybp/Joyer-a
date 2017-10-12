<?php
	include 'conexion.php';
	

	$nombreCliente = $_POST["nombreCliente"];
	$folio = $_POST["folio"];
	$pp = $_POST["tablaName"];
	$operador = $_POST["operador_select"];
	$urgencia = $_POST["urgencia_select"];
	$tiempo_estimado = $_POST["tiempoEstimado"];
	$comentario = $_POST["comentario"];
	$fecha = date("Y-m-d");

	$prenda_proceso= explode(",",$pp);

	$mod = count($prenda_proceso);
	$mod= $mod/2;

	

	for ($i=0 ; $i < $mod ; $i++){
		$prenda = $prenda_proceso[0];
		$proceso = $prenda_proceso[1];

		$sql = "INSERT INTO pedido (folio, nombre_cliente, operador, prenda, proceso, comentario, tiempoEstimado, urgencia, fecha) VALUES ($folio, '$nombreCliente', '$operador', $prenda, $proceso, '$comentario', $tiempo_estimado, $urgencia, '$fecha');";
		$result = mysqli_query($con, $sql);

		//echo "<br> INSERT INTO pedido (folio, nombre_cliente, operador, prenda, proceso, comentario, tiempoEstimado, urgencia, fecha) VALUES ($folio, '$nombreCliente', '$operador', $prenda, $proceso, '$comentario', $tiempo_estimado, $urgencia, '$fecha');";
	}

	$sql2 = "INSERT INTO cola VALUES ($folio, '$operador', $tiempo_estimado, $urgencia);";
	$result = mysqli_query($con, $sql2);
	//echo "cola: ".$sql2;

	header("Refresh:0; url=index.php");
	

?>