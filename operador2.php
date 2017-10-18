<?php
  require('seguridad.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Joyeria Claro</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="10;url=operador2.php">
    <link rel="stylesheet" href="w3.css">
    <link type="text/css" rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <style>
    #folio2
    {
        padding: 1px;           /*To make sure that the input and the label will not overlap the border, If you remove this line it will not display correctly on Opera 15.0*/
        border: 1px solid activeborder; /*Create our fake border :D*/
    }
    #folio2{
        width: 138px;
        background-color: white;    
        text-align:center;
        -webkit-touch-callout: none;    /*Make the label text unselectable*/
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
    }
    #folio2
    {
        border: none;           /*We have our fake border already :D*/
    }
    </style>

  
  </head>
  <body class="w3-light-grey">
    <div class="w3-bar w3-black w3-hide-small">
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
                        <table style="min-height: 250px; table-layout: fixed;">
                          <thead>
                            <tr>
                              <th colspan="2">
                                <?php 
                                  echo $nombre;
                                  
                                  $sql3 = "SELECT folio FROM cola WHERE operador= '$usuario' ORDER BY urgencia DESC limit 1";
                                  $result3 = mysqli_query($con, $sql3);
                                  $row3 = $result3->fetch_assoc();
                                  $folioo= $row3['folio'];  
                              //    $sql2 = "SELECT * FROM pedido WHERE operador='$usuario' ORDER BY urgencia DESC";
                                 $sql2="SELECT DISTINCT pedido.folio, pedido.nombre_cliente, pedido.operador, prenda.nombre_prenda, proceso.nombre_proceso, pedido.tiempoEstimado, pedido.urgencia, pedido.comentario FROM pedido JOIN prenda ON pedido.prenda = prenda.id_prenda JOIN prenda_proceso ON pedido.prenda = prenda_proceso.prenda JOIN proceso ON pedido.proceso = proceso.id_proceso where folio=$folioo;";
                                  $result2 = mysqli_query($con, $sql2);
                                  if(!$result2){
                                    $rows2=0;
                                    $penultimo=0;
                                  }else{
                                    $rows2=$result2->num_rows;
                                    $penultimo=$rows2-1;
                                  }

                                                            ?>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <form method='post' action="terminar.php">
                              <?php
                                if ($rows2 != 0){
                                  for($j=0 ; $j<$rows2 ; $j++){
                                    $row2 = $result2->fetch_assoc();
                                    if ($usuario == $row2["operador"]){

                                      if ($j==0) {
                                      echo "<tr style='border-bottom:solid 1px black;'><td style='width:140px;'>Folio:</td><td><input type='text' name='folio2' id='folio2'  value='";
                                      echo $row2["folio"];
                                      echo "'></td></tr>";                                                                                
                                         }

                                      echo "<tr><td>";
                                      echo $row2["nombre_prenda"];
                                      echo "</td><td>";
                                      echo $row2["nombre_proceso"];
                                      echo "</td></tr>";
                                      if ($j==$penultimo){
                                        echo "<tr style='border-top:solid 1px black;'><td colspan='2'> Comentario </td></tr><tr><td colspan='2'>";
                                        echo $row2["comentario"];
                                        echo "</td></tr><tr style='border-top:solid 1px black; height:70px;'><td colspan='2'><input  style='margin:10px auto;' class='button-aceptar' type='submit' value='terminar' onclick='terminarproc(".$row2['folio'].")';></td></tr>";
                                      }
                                    }
                                  }
                                }
                              ?>  
                            </form>  
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

</script>
 

