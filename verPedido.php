<?php
  require('seguridad.php');
  include 'conexion.php';

  $folio = $_POST["folioName"];

  $sqlPedido = "SELECT DISTINCT pedido.folio, pedido.nombre_cliente, pedido.operador,pedido.prenda, pedido.proceso, prenda.nombre_prenda, proceso.nombre_proceso, pedido.tiempoEstimado, pedido.urgencia FROM pedido JOIN prenda ON pedido.prenda = prenda.id_prenda JOIN prenda_proceso ON pedido.prenda = prenda_proceso.prenda JOIN proceso ON pedido.proceso = proceso.id_proceso WHERE folio = $folio;";

  $resultPedido = mysqli_query($con, $sqlPedido);
  $row = $resultPedido->fetch_assoc();
  $nombre = $row["nombre_cliente"];
  $operadorPedido = $row["operador"];
  $tiempo = $row["tiempoEstimado"];
  $urgencia = $row["urgencia"];
  $prendaprocesoArray=[];

?>
<!DOCTYPE html>
<html>
  <title>Joyeria Claro</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link type="text/css" rel="stylesheet" href="css.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <body class="w3-light-grey" onload="arrayActual();">
    <div class="w3-bar w3-black w3-hide-small">
      <a href="logout.php" class="w3-bar-item w3-button">Cerrar sesión</a>
      <a href="index.php" class="w3-bar-item w3-button">Panel de control</a>
    </div>
    <div class="w3-content">
      <header class="w3-container w3-center w3-white">
        <h1 class="w3-xxxlarge"><b>JOYERIA CLARO'S</b></h1>
      </header>
    </div>

    <div style="margin-left: 15%; margin-top: 2%;" id="divFolio" class="w3-col l4">
      <div class="w3-white w3-margin">
        <div class="w3-container w3-padding w3-black">
          <h4 style="text-align: center">DATOS DEL FOLIO: <spam id="folioUpdate">
            <?php echo $folio;?></spam>
          </h4>
        </div>
        <div style="padding:15px" class="w3-ul w3-hoverable w3-white">
        
        <!-- DATOS DEL FOLIO SELECCIONADO -->
          <form class="panelControl" action="verPedido.php" method="post">
            <input type="hidden" name="folio" id="folioID" value="<?php echo $folio;?>">
            <table style="width: 100%;">
              <tr>
                <td><label class="w3-padding-16 w3-large">Nombre: </label></td>
                <td><input type="text" name="nombreCliente" id="nombreCliente" style="width: 100%;" required value="<?php echo $nombre;?>"><br></td>
              </tr>
            </table><br>
            <table style="width: 100%;" >
              <tr>
                <td><label class="w3-padding-16 w3-large">Operador:</label></td>
                <td>
                  <select style="text-transform: uppercase;" name="operador_select" id="operador">
                    <?php
                      $sqlOperadores= "SELECT * FROM usuario WHERE tipo='operador';";
                      $resultOperadores = mysqli_query($con, $sqlOperadores);
                      $procesos = $resultOperadores->num_rows;
                      for($z=0 ; $z<$procesos ; $z++){
                        $operador = $resultOperadores->fetch_assoc();
                        if ($operador["usuario"] == $operadorPedido){
                          echo "<option value=".$operador["usuario"]." selected>".$operador["nombre"]."</option>";
                        }else{
                          echo "<option value=".$operador["usuario"].">".$operador["nombre"]."</option>";
                        }
                      }
                    ?>   
                  </select>
                </td>
                <td><label class="w3-padding-16 w3-large">Urgencia:</label></td>
                  <td>
                    <select name="urgencia_select" id="urgencia">
                      <option value="1" <?php if ($urgencia==1) echo "selected"; ?>>BAJA</option>
                      <option value="2" <?php if ($urgencia==2) echo "selected"; ?>>MEDIA</option>
                      <option value="3" <?php if ($urgencia==3) echo "selected"; ?>>ALTA</option>
                    </select>
                </td>
              </tr>
              <tr>
                <td colspan="2"><label class="w3-padding-16 w3-large">Tiempo Estimado:</label></td>
                <td colspan="2" style="text-align: left"><input type="text" name="tiempoEstimadoFolio" id="tiempoFolio" style="width: 100%;" value="<?php echo $tiempo;?>" required></td>
              </tr>
              <tr>
                <td colspan="1"><label class="w3-padding-16 w3-large">Comentario:</label></td>
                <td colspan="3"><input type="text" name="comentarioNameFolio" id="comentarioFolio" style="width: 100%;"></td>
              </tr>


            </table><br>
            <table style="width: 100%;">
              <tr>
                <td><label class="w3-padding-16 w3-large">AGREGAR</label></td>
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

              <tr>
                <td colspan="1"><label class="w3-padding-16 w3-large">Proceso:</label></td>
                <td colspan="3">
                  <select id="proceso_select" name="Nameprocesos" >
                    <option selected>-------------------------------------------</option> 
                  </select>
                </td>
              </tr>

              <tr>
                <td colspan="4" style="height: 60px;"><a class= "button-agregar" onclick="agregarPrendaProceso();" style="margin-left: 33%;">AGREGAR PRENDA</a></td>
              </tr>
              </table><br><br>
              <table style="width:100%">
              <tr>
                <td >
                  <a id="btn_quitar" class= "button-quitar">CANCELAR</a>
                </td>
                <td>
                  <a id="btn_quitar" class= "button-guardar" >GUARDAR</a>
                </td>
              </tr>
            </table>
        </div>
      </div>
      <hr>
    </div>


    <!-- TABLA DE PROCESOS Y PRENDAS -->


    <div style="margin-left: 5%; margin-top: 2%;" id="divFolio" class="w3-col l4">
      <div class="w3-white w3-margin">
        <div class="w3-container w3-padding w3-black">
          <h4 style="text-align: center">PRENDAS & PROCESOS SELECCIONADAS</h4>
        </div>
        <div style="padding:15px" class="w3-ul w3-hoverable w3-white">
        
        <!-- DATOS DEL FOLIO SELECCIONADO -->

          <div id="procesos_agregados" class="tablaAgregados">
            <table id=tablaPrendasProcesos>
              <tr>
                <th></th>
                <th><label class="w3-padding-16 w3-large">Prenda:</label></th>
                <th><label class="w3-padding-16 w3-large">Proceso:</label></th>
              </tr>

              <?php 
                for ($i=0; $i < $resultPedido->num_rows; $i++) {      
                  $pp=[];
                  echo "<tr>";
                    echo "<td><input type='checkbox' value='".$i."'></td>";
                    echo "<td id='".$row['prenda']."'>".$row['nombre_prenda']."</td>";
                    echo "<td>".$row['nombre_proceso']."</td>";
                  echo "</tr>";

                  array_push($pp,$row['nombre_prenda'],$row['nombre_proceso']);
                  array_push($prendaprocesoArray,$pp);


                  $row = $resultPedido->fetch_assoc();
                }
                //echo "<input type='hidden' id='hiddenArray' value =".json_encode($prendaprocesoArray).">";
              ?>
            </table><br>
            <a style="margin-left: 40%" id="btn_quitar" class= "button-quitar" onclick="quitar();">QUITAR</a>
          </div>
          
      
          
        </div>
      </div>
      <hr>
    </div><br>
    <table style="width: 100%; margin-top: 10%; margin-left: -3%;">
      
    </table>
    </form>

  </body>
</html>

<script type="text/javascript">
  var arrayFinalPrendaProceso = [];

  function arrayActual(){
    var folio = document.getElementById("folioID").value;
      var urlString = "ppPedido.php";
      var response = [];
      $.get(urlString, {folio: folio}, (response) => {
          arrayDePrendaProceso(JSON.parse(response));
        });
  }

  function arrayDePrendaProceso(response){
      
      for (var i = 0; i < response.length ; i++){
        var pp = [];
        var prenda = response[i]['prenda'];
        var proceso = response[i]['proceso'];
        pp.push(prenda,proceso);
        console.log(pp);
        arrayFinalPrendaProceso.push(pp);
      }
      console.log(arrayFinalPrendaProceso);

      
      
    }


  function prenda() {
      document.getElementById('proceso_select').options.length = 0;
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
      var procesos = document.getElementById("proceso_select");
      for (var i=0 ; i< resp.length ;i++){
        var option = document.createElement("option");
        option.value = resp[i]['proceso'];
        option.innerHTML = resp[i]['nombre_proceso'];
        procesos.appendChild(option);

      }
      
    }

    function agregarPrendaProceso(){
      var pp = [];
      var p1 = document.getElementById("prenda_select").value;
      var p2 = document.getElementById("proceso_select").value;
      console.log(arrayFinalPrendaProceso);
      
      console.log(p1);
      console.log(p2);

      pp.push(p1,p2);
      arrayFinalPrendaProceso.push(pp);
      
      console.log(pp);
      console.log(arrayFinalPrendaProceso);
      
      tabla();
      
    }

    function tabla(){
      $(function () {
        for (var i = $("#tablaPrendasProcesos").length; i >= 0; i--) {
          $("#tablaPrendasProcesos").find("tr:not(:first)")[i].remove();
        }
      });

      
      
      for (var i = 0 ; i < arrayFinalPrendaProceso.length ; i++){
        var urlString = "prendaProceso.php";

        var prenda = arrayFinalPrendaProceso[i][0];
        var proceso = arrayFinalPrendaProceso[i][1];
        
        $.get(urlString, {prenda:prenda , proceso: proceso }, (response) =>{
          llenarTabla(JSON.parse(response),i);
        });

      }

      

      // tabla.appendChild(tr);

    }
    function llenarTabla(response,i){

        var tabla = document.getElementById("tablaPrendasProcesos");
        var tr = document.createElement("tr");
        var th = document.createElement("td");
        var th1 = document.createElement("td");
        var th2 = document.createElement("td");
        var td = document.createElement("td");
        var td1 = document.createElement("td");
        var td2 = document.createElement("td");
        var checkbox = document.createElement("input");
        checkbox.type = "checkbox";
        checkbox.id = i;
        td.appendChild(checkbox);
         
        var prenda = document.createTextNode(response[0]["nombre_prenda"]);
        var proceso = document.createTextNode(response[0]["nombre_proceso"]);

        td1.appendChild(prenda);
        td2.appendChild(proceso);

        tr.appendChild(td);
        tr.appendChild(td1);
        tr.appendChild(td2);

        tabla.appendChild(tr);
        debugger;
      

    }
    

  
</script>



