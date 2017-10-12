<?php
	require('seguridad.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Joyeria Claro</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="w3.css">
		<link type="text/css" rel="stylesheet" href="css.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		

	
	</head>
	<body class="w3-light-grey">
		<div class="w3-bar w3-black w3-hide-small">
		  <a href="inicio.php" class="w3-bar-item w3-button">Cerrar sesión</a>
		  <a href="historial.php" class="w3-bar-item w3-button">Ver historial</a>
		  <a href="#" class="w3-bar-item w3-button w3-right"><i class="fa fa-info-circle"></i></a>
		</div>

		<div class="w3-content">
		  <header class="w3-container w3-center w3-white">
		    <h1 class="w3-xxxlarge"><b>JOYERIA CLARO'S</b></h1>
		  </header>
		  <div class="w3-row w3-padding w3-border">

		    <!-- PROCESOS EN CURSO -->
		    <div class="w3-col l8 s12">
		      <div class="w3-container w3-white w3-margin w3-padding-large">
		        <div class="w3-center">
		          <h3>PROCESOS EN CURSO</h3>

		          <!-- TABLAS -->
		          <div class="colas">
		          	<?php
		          		include 'conexion.php';
		          		$sql = "SELECT * FROM usuario WHERE tipo='operador'";
		          		$result = mysqli_query($con, $sql);
		          		$rows = $result->num_rows;
		          		for ($i=0 ; $i < $rows ; $i++){
		          			$row = $result->fetch_assoc();
		          			$nombre= $row["nombre"];
		          			$usuario= $row["usuario"];
		          			?>
		          				<div class="cola">
		          					<table class="tableSection">
										<thead>
											<tr>
												<th>
												<?php 
													echo $nombre;
													$sql2 = "SELECT * FROM cola WHERE operador='$usuario' ORDER BY urgencia DESC";
													$result2 = mysqli_query($con, $sql2);
													$rows2 = $result2->num_rows;
												?>
												</th>
											</tr>
										</thead>
										<tbody>
										<?php
											for($j=0 ; $j<$rows2 ; $j++){
												$row2 = $result2->fetch_assoc();
												if ($usuario == $row2["operador"]){
													echo "<tr onclick=click();><td>";
													echo $row2["folio"];
													echo "</td></tr>";
												}
											}
										?>
										</tbody>
									</table>
					          	</div>
		          			<?php
		          		}
		          	?>
		          	
		          </div>
		        </div>
		      </div>
		    </div>


		    <!-- PANEL DE CONTROL -->
		    <div style="display: block" id="divPanel" class="w3-col l4">
		      <div class="w3-white w3-margin">
		        <div class="w3-container w3-padding w3-black">
		          <h4>Panel de control
		          </h4>
		        </div>
		        <div style="padding:15px" class="w3-ul w3-hoverable w3-white">
		        
		        <!-- AGREGAR NUEVO PEDIDO -->
		          <form class="panelControl" action="pedido.php" method="post">
		          	<table style="width: 100%;">
		          	  <tr>
		          	    <td><label class="w3-padding-16 w3-large">Nombre: </label></td>
		          	    <td><input type="text" name="nombreCliente" style="width: 100%;"><br></td>
		          	  </tr>
		           	  <tr>
		           	    <td><label class="w3-padding-16 w3-large">Folio: </label></td>
		           	    <td><input type="text" name="folio" style="width: 100%;"></td>
		           	  </tr>
		           	  <tr>
		           	    <td><label class="w3-padding-16 w3-large">Prenda:</label></td>
			      		<td style="text-align: left">
				      		<select id="prenda_select" name="prendas_select" onChange="if (this.selectedIndex) prenda()">
		           	    		<option selected>------------</option>
		           	    		<?php
		           	    			$sqlPrendas= "SELECT * FROM prenda;";
		           	    			$resultPrendas = mysqli_query($con, $sqlPrendas);
									$prendas = $resultPrendas->num_rows;
									for($x=0 ; $x<$prendas ; $x++){
										$prenda = $resultPrendas->fetch_assoc();
										echo "<option value=".$prenda["id_prenda"].">".$prenda["nombre_prenda"]."</option>";
									}
		           	    		?>   
			      			</select>
			      		</td>
		           	  </tr>
		            	<tr style="text-align: center;">
		            		<td colspan="2"><label class="w3-padding-16 w3-large">Procesos:</label><br></td>
		            	</tr>
		            	
		            	</tr>
		            	<tr>
		            		<td colspan="2">
		            			<select multiple="multiple" multiple class="selectpicker" id="procesos" name="Nameprocesos">
		            			
							        
				      			</select></td>
		            	</tr>
		            	<tr>
		            		<td colspan="2" style="height: 40px;"><a class= "button-agregar" onclick="agregarPrendaProceso()">AGREGAR</a></td>
		            	</tr>
		            </table><br>
		            <table style="width: 100%;" >
		            	<tr>
		            		<td><label class="w3-padding-16 w3-large">Operador:</label></td>
		            		<td>
		            			<select style="text-transform: uppercase;" name="operador_select" id="operador">
		            				<option selected>----------</option>
			            			<?php
			           	    			$sqlOperadores= "SELECT * FROM usuario WHERE tipo='operador';";
			           	    			$resultOperadores = mysqli_query($con, $sqlOperadores);
										$procesos = $resultOperadores->num_rows;
										for($z=0 ; $z<$procesos ; $z++){
											$operador = $resultOperadores->fetch_assoc();
											echo "<option value=".$operador["usuario"].">".$operador["nombre"]."</option>";
										}
			           	    		?>   
				      			</select>
				      		</td>
				      		<td><label class="w3-padding-16 w3-large">Urgencia:</label></td>
		            		<td>
		            			<select name="urgencia_select" id="urgencia">
							        <option value="1" >BAJA</option>
							        <option value="2" >MEDIA</option>
							        <option value="3" >ALTA</option>
				      			</select>
				      		</td>
		            	</tr>
		            	
		            	<tr>
		            		<td colspan="2"><label class="w3-padding-16 w3-large">Tiempo estimado:</label></td>
							<td colspan="2"><input type="text" name="tiempoEstimado" style="width: 100%;"></td>
		            	</tr>
		            	<tr>
		            		<td style="text-align: center;" colspan="4"><input type="checkbox" name="comentario" value="comentario" id="checkbox" onchange="popUpComentario()"><label class="w3-padding-16 w3-large"> Agregar comentario</label>
		            		</td>
		            	</tr>
		            	<tr>
							<td colspan="2"><a id="btn_agregados" class= "button-agregados" onclick="agregados()">AGREGADOS</a></td>
							<td colspan="2"><button class="button-aceptar">ACEPTAR</button></td>
		            	</tr>
		            </table>
		            <input type="hidden" name="comentario" id="comentarioInput" value="">
		            <input type="hidden" name="tablaName" id="tablaId" value="">
		          </form>
		        </div>
		      </div>
		      <hr>
		    </div>





		    <!-- PROCESOS AGREGADOS -->
		    <?php
		    	$agregados[][]=array();
		    ?>

		    <div id="divAgregados" style = "display: none;" class="w3-col l4">
		      <div class="w3-white w3-margin">
		        <div class="w3-container w3-padding w3-black">
		          <h4>Procesos agregados</h4>
		        </div>
		        <div style="padding:15px" class="w3-ul w3-hoverable w3-white">
		        	<div id="procesos_agregados" class="tablaAgregados">
		          	<table id=tablaPrendasProcesos>
		          		<tr>
		          			<th></th>
		          			<th><label class="w3-padding-16 w3-large">Prenda:</label></th>
		          			<th><label class="w3-padding-16 w3-large">Proceso:</label></th>
		          		</tr>
		          	</table><br>
		          	<a id="btn_agregados" class= "button-cancelar">QUITAR</a>
		          	<a style="margin-left: 15%;" onclick="aceptar();" id="btn_agregados" class= "button-aceptar">ACEPTAR</a>
		          </div>
		          
		        </div>
		      </div>
		      <hr>
		    </div>
		          

		  </div>
		</div>
		<footer class="w3-container w3-dark-grey" >
		  <p>Powered by BARRAZA.MX</p>
		</footer>


	</body>
</html>
<script>

</script>

<script type="text/javascript">
	var tablaPrendaProcesos = [];
	function popUpComentario(){
		var checked = document.getElementById("checkbox").checked;
		if (checked == true){
			var comentario = prompt("Agregar comentario:");
		}
	}
	function click(){
		alert("Click");
	}

	function agregados(){
		document.getElementById("divAgregados").style.display = "block";
		document.getElementById("divPanel").style.display = "none";
	}

	function aceptar(){
		document.getElementById("divAgregados").style.display = "none";
		document.getElementById("divPanel").style.display = "block";
		document.getElementById("tablaId").value = tablaPrendaProcesos;
		console.log(tablaPrendaProcesos);
	}

	function prenda() {
		document.getElementById('procesos').options.length = 0;
		var p = document.getElementById("prenda_select");
		var prendaSeleccionada = p.options[p.selectedIndex].value;
		var urlString = "procesos.php";
		var response = [];

		if (prendaSeleccionada){
			$.get(urlString, {prenda: prendaSeleccionada}, (response) => {
				procesos(JSON.parse(response));
			});
		}
	}

	function procesos(response){
		
		var resp = response;
		var procesos = document.getElementById("procesos");
		for (var i=0 ; i< resp.length ;i++){
			var option = document.createElement("option");
			option.value = resp[i]['proceso'];
			option.innerHTML = resp[i]['nombre_proceso'];
			procesos.appendChild(option);

		}
		
	}
	
	function agregarPrendaProceso(){
		var p1 = document.getElementById("prenda_select");
		var prenda = p1.options[p1.selectedIndex].value;
		p2 = document.getElementById("procesos");
		
		var prendaProcesos = [];

		for (var i=0 ; i<p2.length; i++){
			if(p2[i].selected){
				var proceso = p2[i].value;
				prendaProcesos.push(prenda,proceso);
			}
		}
		tablaPrendaProcesos.push(prendaProcesos);
		console.log(tablaPrendaProcesos);
		var x = tablaPrendaProcesos[0];
		console.log(x);
		
		var urlString = 'prendaProceso.php';

		$.get(urlString, {prenda:prenda , proceso: proceso }, (response) =>{
			llenarTabla(JSON.parse(response));
		});

		document.getElementById("tablaId").value = tablaPrendaProcesos;
		console.log(tablaPrendaProcesos);
	}

	function llenarTabla(response){
		var tabla = document.getElementById("tablaPrendasProcesos");
		var tr = document.createElement("tr");
		var td = document.createElement("td");
		var td1 = document.createElement("td");
		var td2 = document.createElement("td");

		var prenda = document.createTextNode(response[0]['nombre_prenda']);
		var proceso = document.createTextNode(response[0]['nombre_proceso']);
		  
		var checkbox = document.createElement("input");
		checkbox.type = "checkbox";
		checkbox.id = tablaPrendaProcesos.length;

		td.appendChild(checkbox);
		td1.appendChild(prenda);
		td2.appendChild(proceso);

		tr.appendChild(td);
		tr.appendChild(td1);
		tr.appendChild(td2);
		tabla.appendChild(tr);
	}

</script>

