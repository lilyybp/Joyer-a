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
        <div class="w3-col l12 s12">
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
                      <div class="colaOperador">
                        <table>
                          <thead><tr><th colspan="2">
                        <?php 
                          echo $nombre;
                          $sql2 = "SELECT * FROM cola WHERE operador='$usuario'";
                          $result2 = mysqli_query($con, $sql2);
                          $rows2 = $result2->num_rows;
                        ?>
                        </th></tr></thead><tbody>
                    <?php
                      for($j=0 ; $j<1 ; $j++){
                        $row2 = $result2->fetch_assoc();
                        if ($usuario == $row2["operador"]){

                          echo "<tr><td>Folio:</td><td>";
                          echo $row2["folio"];
                          echo "</td></tr>";
                        }
                      }
                    ?>    </tbody>
                        </table>
                      </div>
                    <?php
                  }
                ?>
                
              </div>
            </div>
          </div>
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
  }

  function prenda() {
    var p = document.getElementById("prenda_select");
    var prendaSeleccionada = p.options[p.selectedIndex].value;

    $.ajax({
          url:"procesos.php/prenda="+prendaSeleccionada, //the page containing php script
          type: "GET", //request type
          success:function(result){
            procesos(JSON.parse(response))

          },error: function(){console.log("ERROR");}
      });
  }

</script>
 

